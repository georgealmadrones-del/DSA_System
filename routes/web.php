<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;

/*
|--------------------------------------------------------------------------
| Public / Auth Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');

    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');

    Route::post('/register', function (Request $request) {
        $normalizedEmail = Str::lower(trim((string) $request->input('email')));
        $request->merge(['email' => $normalizedEmail]);

        $validated = $request->validate([
            'workspace_name' => ['required', 'string', 'max:120'],
            'admin_name'     => ['required', 'string', 'max:120'],
            'email'          => [
                'required',
                'string',
                'max:255',
                'email:rfc',
                'regex:/^[A-Za-z0-9._%+-]+@gmail\.com$/i',
                'unique:users,email',
            ],
            'password'       => ['required', 'string', Password::min(8)->max(128), 'confirmed'],
        ], [
            'email.regex'  => 'Please use a valid @gmail.com email address.',
            'email.unique' => 'This @gmail.com address is already registered.',
        ]);

        $cleanAdminName = trim($validated['admin_name']);
        $cleanWorkspaceName = trim($validated['workspace_name']);

        $userData = [
            'name'       => $cleanAdminName,
            'admin_name' => $cleanAdminName,
            'email'      => $normalizedEmail,
            'password'   => Hash::make($validated['password']),
        ];

        if (Schema::hasColumn('users', 'workspace_name')) {
            $userData['workspace_name'] = $cleanWorkspaceName;
        }

        if (Schema::hasColumn('users', 'role') && !array_key_exists('role', $userData)) {
            $userData['role'] = 'admin';
        }

        $user = User::create($userData);

        if (Schema::hasTable('audit_logs')) {
            DB::table('audit_logs')->insert([
                'user_id'    => $user->id,
                'event'      => 'user.registered',
                'ip_address' => $request->ip(),
                'user_agent' => Str::limit((string) $request->userAgent(), 255),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->intended('/dashboard');
    })->name('auth.register.store');

    Route::post('/login', function (Request $request) {
        $normalizedEmail = Str::lower(trim((string) $request->input('email')));
        $request->merge(['email' => $normalizedEmail]);

        $credentials = $request->validate([
            'email'    => [
                'required',
                'string',
                'max:255',
                'email:rfc',
                'regex:/^[A-Za-z0-9._%+-]+@gmail\.com$/i',
            ],
            'password' => ['required', 'string', 'max:128'],
        ], [
            'email.regex' => 'Please use a valid @gmail.com email address.',
        ]);

        $throttleKey = 'login:' . sha1($normalizedEmail . '|' . $request->ip());

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            return back()
                ->withInput($request->only('email', 'remember'))
                ->withErrors([
                    'email' => "Too many login attempts. Try again in {$seconds} seconds.",
                ]);
        }

        $remember = $request->boolean('remember');

        if (!Auth::attempt([
            'email'    => $normalizedEmail,
            'password' => $credentials['password'],
        ], $remember)) {
            RateLimiter::hit($throttleKey, 60);

            if (Schema::hasTable('audit_logs')) {
                DB::table('audit_logs')->insert([
                    'user_id'    => null,
                    'event'      => 'auth.login_failed',
                    'ip_address' => $request->ip(),
                    'user_agent' => Str::limit((string) $request->userAgent(), 255),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            return back()
                ->withInput($request->only('email', 'remember'))
                ->withErrors([
                    'email' => 'Invalid @gmail.com address or password.',
                ]);
        }

        RateLimiter::clear($throttleKey);
        $request->session()->regenerate();

        $loggedInUser = Auth::user();
        if ($loggedInUser && Schema::hasTable('audit_logs')) {
            DB::table('audit_logs')->insert([
                'user_id'    => $loggedInUser->id,
                'event'      => 'auth.login_success',
                'ip_address' => $request->ip(),
                'user_agent' => Str::limit((string) $request->userAgent(), 255),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return redirect()->intended('/dashboard');
    })->name('auth.login.store');

    Route::post('/forgot-password/code', function (Request $request) {
        $normalizedEmail = Str::lower(trim((string) $request->input('reset_email')));
        $request->merge(['reset_email' => $normalizedEmail]);

        $request->validate([
            'reset_email' => [
                'required',
                'string',
                'max:255',
                'email:rfc',
                'regex:/^[A-Za-z0-9._%+-]+@gmail\.com$/i',
            ],
        ], [
            'reset_email.regex' => 'Please enter a valid @gmail.com address.',
        ]);

        $codeKey = 'reset-code:' . sha1($normalizedEmail . '|' . $request->ip());

        if (RateLimiter::tooManyAttempts($codeKey, 3)) {
            $seconds = RateLimiter::availableIn($codeKey);
            return back()
                ->withInput()
                ->with('open_forgot_modal', true)
                ->withErrors([
                    'reset_email' => "Too many code requests. Please wait {$seconds} seconds before trying again.",
                ]);
        }

        RateLimiter::hit($codeKey, 120);

        $neutralNotice = "If {$normalizedEmail} is registered, a 6-digit verification code has been sent to that Gmail inbox (valid for 15 minutes).";
        $user = User::where('email', $normalizedEmail)->first();

        if ($user) {
            $plainCode = str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            $expiresAt = now()->addMinutes(15);

            $recordPayload = [
                'email'      => $normalizedEmail,
                'code_hash'  => Hash::make($plainCode),
                'attempts'   => 0,
                'expires_at' => $expiresAt,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $existing = DB::table('password_reset_codes')->where('email', $normalizedEmail)->first();
            if ($existing) {
                DB::table('password_reset_codes')
                    ->where('email', $normalizedEmail)
                    ->update($recordPayload);
            } else {
                DB::table('password_reset_codes')->insert($recordPayload);
            }

            try {
                $body = "Hello,\n\n"
                    . "Your EduCore SaaS password reset verification code is: {$plainCode}\n\n"
                    . "This code expires in 15 minutes. If you did not request this, you can safely ignore this email.";

                Mail::raw($body, function ($message) use ($normalizedEmail) {
                    $message->to($normalizedEmail)
                        ->subject('EduCore SaaS — Password Reset Verification Code');
                });

                if (Schema::hasTable('audit_logs')) {
                    DB::table('audit_logs')->insert([
                        'user_id'    => $user->id,
                        'event'      => 'auth.reset_code_sent',
                        'ip_address' => $request->ip(),
                        'user_agent' => Str::limit((string) $request->userAgent(), 255),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            } catch (\Throwable $e) {
                Log::error('Password reset mail failed', [
                    'email' => $normalizedEmail,
                    'error' => $e->getMessage(),
                ]);

                return back()
                    ->withInput()
                    ->with('open_forgot_modal', true)
                    ->withErrors([
                        'reset_email' => 'Unable to send verification email right now. Please try again shortly.',
                    ]);
            }
        }

        return back()
            ->withInput()
            ->with('open_forgot_modal', true)
            ->with('reset_notice', $neutralNotice);
    })->name('auth.password.code');

    Route::post('/forgot-password/reset', function (Request $request) {
        $normalizedEmail = Str::lower(trim((string) $request->input('reset_email')));
        $cleanCode = trim((string) $request->input('reset_code'));

        $request->merge([
            'reset_email' => $normalizedEmail,
            'reset_code'  => $cleanCode,
        ]);

        $validated = $request->validate([
            'reset_email'  => [
                'required',
                'string',
                'max:255',
                'email:rfc',
                'regex:/^[A-Za-z0-9._%+-]+@gmail\.com$/i',
            ],
            'reset_code'   => ['required', 'digits:6'],
            'new_password' => ['required', 'string', Password::min(8)->max(128), 'confirmed'],
        ], [
            'reset_email.regex' => 'Please enter a valid @gmail.com address.',
            'reset_code.digits' => 'The verification code must be 6 digits.',
        ]);

        $resetKey = 'reset-verify:' . sha1($normalizedEmail . '|' . $request->ip());

        if (RateLimiter::tooManyAttempts($resetKey, 6)) {
            $seconds = RateLimiter::availableIn($resetKey);
            return back()
                ->withInput()
                ->with('open_forgot_modal', true)
                ->withErrors([
                    'reset_code' => "Too many verification attempts. Wait {$seconds} seconds and try again.",
                ]);
        }

        $record = DB::table('password_reset_codes')->where('email', $normalizedEmail)->first();
        $user = User::where('email', $normalizedEmail)->first();

        if (!$record || !$user) {
            RateLimiter::hit($resetKey, 120);
            return back()
                ->withInput()
                ->with('open_forgot_modal', true)
                ->withErrors([
                    'reset_code' => 'Invalid or expired verification code.',
                ]);
        }

        if (now()->greaterThan($record->expires_at)) {
            DB::table('password_reset_codes')->where('email', $normalizedEmail)->delete();
            return back()
                ->withInput()
                ->with('open_forgot_modal', true)
                ->withErrors([
                    'reset_code' => 'That verification code has expired. Please request a new code.',
                ]);
        }

        $attempts = (int) ($record->attempts ?? 0);
        if ($attempts >= 5) {
            DB::table('password_reset_codes')->where('email', $normalizedEmail)->delete();
            return back()
                ->withInput()
                ->with('open_forgot_modal', true)
                ->withErrors([
                    'reset_code' => 'Too many incorrect code attempts. Please request a new code.',
                ]);
        }

        if (!Hash::check($validated['reset_code'], (string) $record->code_hash)) {
            RateLimiter::hit($resetKey, 120);
            DB::table('password_reset_codes')
                ->where('email', $normalizedEmail)
                ->update([
                    'attempts'   => $attempts + 1,
                    'updated_at' => now(),
                ]);

            return back()
                ->withInput()
                ->with('open_forgot_modal', true)
                ->withErrors([
                    'reset_code' => 'Invalid verification code. Please check your Gmail and try again.',
                ]);
        }

        DB::transaction(function () use ($user, $validated, $normalizedEmail, $request) {
            $user->forceFill([
                'password'       => Hash::make($validated['new_password']),
                'remember_token' => Str::random(60),
            ])->save();

            DB::table('password_reset_codes')->where('email', $normalizedEmail)->delete();

            if (Schema::hasTable('audit_logs')) {
                DB::table('audit_logs')->insert([
                    'user_id'    => $user->id,
                    'event'      => 'auth.password_reset',
                    'ip_address' => $request->ip(),
                    'user_agent' => Str::limit((string) $request->userAgent(), 255),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        });

        RateLimiter::clear($resetKey);
        RateLimiter::clear('login:' . sha1($normalizedEmail . '|' . $request->ip()));

        return redirect()
            ->route('login')
            ->with('status', 'Your password has been updated. You can now log in with your new password.');
    })->name('auth.password.reset');
});

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::post('/logout', function (Request $request) {
        $user = Auth::user();

        if ($user && Schema::hasTable('audit_logs')) {
            DB::table('audit_logs')->insert([
                'user_id'    => $user->id,
                'event'      => 'auth.logout',
                'ip_address' => $request->ip(),
                'user_agent' => Str::limit((string) $request->userAgent(), 255),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('status', 'You have been logged out.');
    })->name('auth.logout');
});
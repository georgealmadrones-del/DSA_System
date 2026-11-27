<?php

use App\Http\Controllers\StudentController;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
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

if (!function_exists('recordAuditLog')) {
    function recordAuditLog(string $event, ?int $userId, Request $request): void
    {
        if (!Schema::hasTable('audit_logs')) {
            return;
        }

        $payload = [];

        if (Schema::hasColumn('audit_logs', 'user_id')) {
            $payload['user_id'] = $userId;
        }
        if (Schema::hasColumn('audit_logs', 'event')) {
            $payload['event'] = $event;
        } elseif (Schema::hasColumn('audit_logs', 'action')) {
            $payload['action'] = $event;
        }
        if (Schema::hasColumn('audit_logs', 'ip_address')) {
            $payload['ip_address'] = $request->ip();
        }
        if (Schema::hasColumn('audit_logs', 'user_agent')) {
            $payload['user_agent'] = Str::limit((string) $request->userAgent(), 255);
        }
        if (Schema::hasColumn('audit_logs', 'created_at')) {
            $payload['created_at'] = now();
        }
        if (Schema::hasColumn('audit_logs', 'updated_at')) {
            $payload['updated_at'] = now();
        }

        if (!empty($payload)) {
            DB::table('audit_logs')->insert($payload);
        }
    }
}

// Ensure database tables, columns, and indexes exist safely
try {
    $connection = config('database.default');

    if ($connection === 'sqlite') {
        $dbPath = database_path('database.sqlite');
        if (!file_exists($dbPath)) {
            if (!file_exists(dirname($dbPath))) {
                mkdir(dirname($dbPath), 0755, true);
            }
            file_put_contents($dbPath, '');
        }
    }

    // Run pending migrations automatically if core tables are missing
    if (!Schema::hasTable('users') || !Schema::hasTable('sessions')) {
        Artisan::call('migrate', [
            '--force' => true,
            '--no-interaction' => true,
        ]);
    }

    // Ensure 'course' and 'user_id' columns exist on students table
    if (Schema::hasTable('students')) {
        if (!Schema::hasColumn('students', 'course')) {
            Schema::table('students', function (Blueprint $table) {
                $table->string('course')->nullable();
            });
        }

        if (!Schema::hasColumn('students', 'user_id')) {
            Schema::table('students', function (Blueprint $table) {
                $table->unsignedBigInteger('user_id')->nullable()->index();
            });

            $defaultUser = User::first();
            if ($defaultUser) {
                Student::whereNull('user_id')->update(['user_id' => $defaultUser->id]);
            }
        }

        // Scope student_id uniqueness per user_id so different accounts can use the same Student ID
        if (Schema::hasColumn('students', 'user_id') && Schema::hasColumn('students', 'student_id')) {
            if ($connection === 'pgsql') {
                DB::statement('ALTER TABLE students DROP CONSTRAINT IF EXISTS students_student_id_unique');
                DB::statement('DROP INDEX IF EXISTS students_student_id_unique');
                DB::statement('CREATE UNIQUE INDEX IF NOT EXISTS students_user_id_student_id_unique ON students (user_id, student_id)');
            }
        }
    }
} catch (\Throwable $e) {
    report($e);
}

// Root URL -> Welcome / Landing Page
Route::get('/', function () {
    try {
        $userId = session('user_id') ?? Auth::id();
        $query = $userId ? Student::where('user_id', $userId) : Student::query();

        $totalStudents = (clone $query)->count();
        $averageGpa = (clone $query)->avg('gpa') ?? 0;
        $activeCoursesCount = (clone $query)
            ->whereNotNull('course')
            ->where('course', '!=', '')
            ->distinct()
            ->count('course');
        $students = (clone $query)->latest()->take(5)->get();
    } catch (\Throwable $e) {
        $totalStudents = 0;
        $averageGpa = 0.00;
        $activeCoursesCount = 0;
        $students = collect();
    }

    return view('welcome', compact('totalStudents', 'averageGpa', 'activeCoursesCount', 'students'));
})->name('welcome');

// Auth Views
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// Handle Database Registration
Route::post('/auth/register', function (Request $request) {
    $normalizedEmail = Str::lower(trim((string) $request->input('email')));
    $request->merge(['email' => $normalizedEmail]);

    $validated = $request->validate([
        'workspace_name' => ['required', 'string', 'max:255'],
        'admin_name'     => ['required', 'string', 'max:255'],
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
    recordAuditLog('user.registered', $user->id, $request);

    Auth::login($user);
    $request->session()->regenerate();
    session([
        'user_id'        => $user->id,
        'workspace_name' => $user->workspace_name ?? $cleanWorkspaceName,
        'admin_name'     => $user->admin_name ?? $cleanAdminName,
    ]);

    return redirect()->route('students.index');
})->name('auth.register.store');

// Handle Database Login
Route::post('/auth/login', function (Request $request) {
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
        recordAuditLog('auth.login_failed', null, $request);

        return back()
            ->withInput($request->only('email', 'remember'))
            ->withErrors([
                'email' => 'Invalid @gmail.com address or password.',
            ]);
    }

    RateLimiter::clear($throttleKey);
    $request->session()->regenerate();

    $loggedInUser = Auth::user();
    recordAuditLog('auth.login_success', $loggedInUser?->id, $request);

    session([
        'user_id'        => $loggedInUser->id,
        'workspace_name' => $loggedInUser->workspace_name ?? '',
        'admin_name'     => $loggedInUser->admin_name ?? $loggedInUser->name,
    ]);

    return redirect()->route('students.index');
})->name('auth.login.store');

// Handle Forgot Password Code Request
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

            recordAuditLog('auth.reset_code_sent', $user->id, $request);
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

// Handle Forgot Password Verification & Reset
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
        recordAuditLog('auth.password_reset', $user->id, $request);
    });

    RateLimiter::clear($resetKey);
    RateLimiter::clear('login:' . sha1($normalizedEmail . '|' . $request->ip()));

    return redirect()
        ->route('login')
        ->with('status', 'Your password has been updated. You can now log in with your new password.');
})->name('auth.password.reset');

// Main SaaS Dashboard & Module Routes
Route::get('/students', [StudentController::class, 'index'])->name('students.index');
Route::get('/directory', [StudentController::class, 'directory'])->name('students.directory');
Route::get('/actions', [StudentController::class, 'actions'])->name('actions');
Route::get('/settings', [StudentController::class, 'settings'])->name('settings');

Route::post('/students', [StudentController::class, 'store'])->name('students.store');
Route::put('/students/{student}', [StudentController::class, 'update'])->name('students.update');
Route::delete('/students/{student}', [StudentController::class, 'destroy'])->name('students.destroy');
Route::post('/settings', [StudentController::class, 'updateSettings'])->name('settings.update');

// Handle Logout -> Redirects to Welcome page
Route::post('/logout', function (Request $request) {
    $loggedInUser = Auth::user();
    $sessionUserId = $loggedInUser?->id ?? session('user_id');
    recordAuditLog('auth.logout', is_numeric($sessionUserId) ? (int) $sessionUserId : null, $request);

    Auth::logout();
    $request->session()->flush();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('welcome');
})->name('logout');
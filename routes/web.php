<?php

use App\Http\Controllers\StudentController;
use App\Models\AuditLog;
use App\Models\Student;
use App\Models\User;
use App\Models\WorkspaceSetting;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

// Ensure database tables, columns, indexes, and default fallback user exist safely
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

    if (!Schema::hasTable('users') || !Schema::hasTable('sessions')) {
        Artisan::call('migrate', [
            '--force' => true,
            '--no-interaction' => true,
        ]);
    }

    if (Schema::hasTable('users')) {
        if (!Schema::hasColumn('users', 'remember_token')) {
            Schema::table('users', function (Blueprint $table) {
                $table->rememberToken();
            });
        }

        if (User::where('email', 'george@edu.core')->doesntExist()) {
            User::create([
                'workspace_name' => 'EduCore Workspace',
                'admin_name' => 'George',
                'name' => 'George',
                'email' => 'george@edu.core',
                'password' => '123456789',
            ]);
        }
    }

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

            $defaultUser = User::where('email', 'george@edu.core')->first() ?? User::first();
            if ($defaultUser) {
                Student::whereNull('user_id')->update(['user_id' => $defaultUser->id]);
            }
        }

        if (Schema::hasColumn('students', 'user_id') && Schema::hasColumn('students', 'student_id') && $connection === 'pgsql') {
            DB::statement('ALTER TABLE students DROP CONSTRAINT IF EXISTS students_student_id_unique');
            DB::statement('DROP INDEX IF EXISTS students_student_id_unique');
            DB::statement('CREATE UNIQUE INDEX IF NOT EXISTS students_user_id_student_id_unique ON students (user_id, student_id)');
        }
    }

    if (!Schema::hasTable('workspace_settings')) {
        Schema::create('workspace_settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unique();
            $table->string('workspace_name')->default('EduCore Workspace');
            $table->string('student_id_prefix', 32)->default('STU-');
            $table->decimal('gpa_scale', 3, 2)->default(3.00);
            $table->string('academic_term')->default('1st Semester AY 2026-2027');
            $table->boolean('data_integrity')->default(true);
            $table->boolean('audit_telemetry')->default(true);
            $table->timestamps();
        });
    }

    if (!Schema::hasTable('audit_logs')) {
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->string('actor_name')->nullable();
            $table->string('event');
            $table->text('meta')->nullable();
            $table->timestamps();
        });
    }

    if (!Schema::hasTable('password_reset_codes')) {
        Schema::create('password_reset_codes', function (Blueprint $table) {
            $table->id();
            $table->string('email')->index();
            $table->string('code_hash');
            $table->unsignedTinyInteger('attempts')->default(0);
            $table->timestamp('expires_at');
            $table->timestamps();
        });
    }
} catch (\Throwable $e) {
    report($e);
}

$eduCoreEmailRule = ['required', 'email', 'max:255', 'regex:/^[A-Za-z0-9._%+-]+@edu\.core$/i'];

// Helper closure to restore session from Remember Me cookie if session expired
$restoreRememberedUser = function (Request $request): void {
    if ($request->session()->has('user_id')) {
        return;
    }

    $cookieValue = $request->cookie('educore_remember');
    if (!$cookieValue || !str_contains($cookieValue, '|')) {
        return;
    }

    [$userId, $plainToken] = explode('|', $cookieValue, 2);
    if (!$userId || !$plainToken) {
        return;
    }

    $user = User::find($userId);
    if ($user && $user->remember_token && hash_equals($user->remember_token, hash('sha256', $plainToken))) {
        $settings = WorkspaceSetting::where('user_id', $user->id)->first();
        $request->session()->put([
            'user_id' => $user->id,
            'workspace_name' => $settings->workspace_name ?? ($user->workspace_name ?? 'EduCore Workspace'),
            'admin_name' => $user->admin_name ?? $user->name,
        ]);
    }
};

// Root URL -> Welcome / Landing Page
Route::get('/', function (Request $request) use ($restoreRememberedUser) {
    $restoreRememberedUser($request);

    try {
        $userId = session('user_id');
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
Route::get('/login', function (Request $request) use ($restoreRememberedUser) {
    $restoreRememberedUser($request);

    if (session('user_id')) {
        return redirect()->route('students.index');
    }

    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// Handle Database Registration
Route::post('/auth/register', function (Request $request) use ($eduCoreEmailRule) {
    $validated = $request->validate([
        'workspace_name' => 'required|string|max:255',
        'admin_name' => 'required|string|max:255',
        'email' => array_merge($eduCoreEmailRule, ['unique:users,email']),
        'password' => 'required|string|min:6|max:128',
    ], [
        'email.regex' => 'Only @edu.core email addresses are allowed.',
        'password.min' => 'Password must be at least 6 characters.',
        'password.max' => 'Password must not exceed 128 characters.',
    ]);

    $user = User::create([
        'workspace_name' => $validated['workspace_name'],
        'admin_name' => $validated['admin_name'],
        'name' => $validated['admin_name'],
        'email' => Str::lower($validated['email']),
        'password' => $validated['password'],
    ]);

    WorkspaceSetting::firstOrCreate(
        ['user_id' => $user->id],
        [
            'workspace_name' => $user->workspace_name,
            'student_id_prefix' => 'STU-',
            'gpa_scale' => 3.00,
            'academic_term' => '1st Semester AY 2026-2027',
            'data_integrity' => true,
            'audit_telemetry' => true,
        ]
    );

    session([
        'user_id' => $user->id,
        'workspace_name' => $user->workspace_name,
        'admin_name' => $user->admin_name,
    ]);

    return redirect()->route('students.index');
})->name('auth.register.store');

// Handle Database Login (with Rate Limiting + Remember Me)
Route::post('/auth/login', function (Request $request) use ($eduCoreEmailRule) {
    $request->validate([
        'email' => $eduCoreEmailRule,
        'password' => 'required|string|min:6|max:128',
    ], [
        'email.regex' => 'Only @edu.core email addresses are allowed.',
        'password.min' => 'Password must be at least 6 characters.',
        'password.max' => 'Password must not exceed 128 characters.',
    ]);

    $normalizedEmail = Str::lower(trim($request->email));
    $throttleKey = 'login:' . sha1($normalizedEmail . '|' . $request->ip());
    $maxAttempts = 5;

    if (RateLimiter::tooManyAttempts($throttleKey, $maxAttempts)) {
        $seconds = RateLimiter::availableIn($throttleKey);
        return back()
            ->withInput($request->only('email', 'remember'))
            ->withErrors([
                'email' => "Too many login attempts. Please try again in {$seconds} seconds.",
            ]);
    }

    $user = User::whereRaw('LOWER(email) = ?', [$normalizedEmail])->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        RateLimiter::hit($throttleKey, 60);
        $remaining = max(0, $maxAttempts - RateLimiter::attempts($throttleKey));

        return back()
            ->withInput($request->only('email', 'remember'))
            ->withErrors([
                'email' => "Invalid @edu.core email or password. ({$remaining} attempts remaining)",
            ]);
    }

    RateLimiter::clear($throttleKey);

    $settings = WorkspaceSetting::firstOrCreate(
        ['user_id' => $user->id],
        [
            'workspace_name' => $user->workspace_name ?? 'EduCore Workspace',
            'student_id_prefix' => 'STU-',
            'gpa_scale' => 3.00,
            'academic_term' => '1st Semester AY 2026-2027',
            'data_integrity' => true,
            'audit_telemetry' => true,
        ]
    );

    session([
        'user_id' => $user->id,
        'workspace_name' => $settings->workspace_name ?: ($user->workspace_name ?? 'EduCore Workspace'),
        'admin_name' => $user->admin_name ?? $user->name,
    ]);

    if (Schema::hasTable('audit_logs') && $settings->audit_telemetry) {
        AuditLog::create([
            'user_id' => $user->id,
            'actor_name' => $user->admin_name ?? $user->name,
            'event' => 'Account signed in',
            'meta' => $user->email . ($request->boolean('remember') ? ' (Remember Me enabled)' : ''),
        ]);
    }

    $response = redirect()->route('students.index');

    if ($request->boolean('remember')) {
        $plainToken = Str::random(60);
        $user->remember_token = hash('sha256', $plainToken);
        $user->save();

        // Persist Remember Me cookie for 30 days (43,200 minutes)
        $response->withCookie(cookie('educore_remember', $user->id . '|' . $plainToken, 43200));
    } else {
        $user->remember_token = null;
        $user->save();
        $response->withCookie(Cookie::forget('educore_remember'));
    }

    return $response;
})->name('auth.login.store');

// Step 1: Generate a 6-digit verification code for an @edu.core account
Route::post('/auth/forgot-password/request', function (Request $request) use ($eduCoreEmailRule) {
    $validated = $request->validate([
        'reset_email' => $eduCoreEmailRule,
    ], [
        'reset_email.regex' => 'Only @edu.core email addresses can request a password reset.',
    ]);

    $normalizedEmail = Str::lower(trim($validated['reset_email']));
    $throttleKey = 'reset-code:' . sha1($normalizedEmail . '|' . $request->ip());

    if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
        $seconds = RateLimiter::availableIn($throttleKey);
        return back()
            ->withInput($request->only('reset_email'))
            ->with('open_forgot_modal', true)
            ->with('reset_step', 'verify')
            ->withErrors(['reset_email' => "Too many code requests. Try again in {$seconds} seconds."]);
    }

    RateLimiter::hit($throttleKey, 300);

    $user = User::whereRaw('LOWER(email) = ?', [$normalizedEmail])->first();
    $code = (string) random_int(100000, 999999);

    if ($user && Schema::hasTable('password_reset_codes')) {
        DB::table('password_reset_codes')->where('email', $normalizedEmail)->delete();
        DB::table('password_reset_codes')->insert([
            'email' => $normalizedEmail,
            'code_hash' => hash('sha256', $code),
            'attempts' => 0,
            'expires_at' => now()->addMinutes(15),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $settings = WorkspaceSetting::where('user_id', $user->id)->first();
        if (Schema::hasTable('audit_logs') && (!$settings || $settings->audit_telemetry)) {
            AuditLog::create([
                'user_id' => $user->id,
                'actor_name' => $user->admin_name ?? $user->name,
                'event' => 'Requested password reset verification code',
                'meta' => $user->email,
            ]);
        }
    }

    // Without SMTP configured, show the generated code on screen for testing/verification;
    // when SMTP is wired up later, send $code via Mail::raw(...) instead of flashing it.
    return back()
        ->withInput(['reset_email' => $normalizedEmail])
        ->with('open_forgot_modal', true)
        ->with('reset_step', 'verify')
        ->with('reset_code_preview', $user ? $code : null)
        ->with('reset_notice', 'If ' . $normalizedEmail . ' is registered, a 6-digit verification code valid for 15 minutes has been generated.');
})->name('auth.password.code');

// Step 2: Verify the 6-digit code and update the password
Route::post('/auth/forgot-password', function (Request $request) use ($eduCoreEmailRule) {
    $validated = $request->validate([
        'reset_email' => $eduCoreEmailRule,
        'reset_code' => 'required|digits:6',
        'new_password' => 'required|string|min:6|max:128|confirmed',
    ], [
        'reset_email.regex' => 'Only @edu.core email addresses can reset passwords.',
        'reset_code.required' => 'Enter the 6-digit verification code.',
        'reset_code.digits' => 'Verification code must be exactly 6 digits.',
        'new_password.min' => 'New password must be at least 6 characters.',
        'new_password.max' => 'New password must not exceed 128 characters.',
        'new_password.confirmed' => 'New password confirmation does not match.',
    ]);

    $normalizedEmail = Str::lower(trim($validated['reset_email']));
    $user = User::whereRaw('LOWER(email) = ?', [$normalizedEmail])->first();
    $tokenRow = Schema::hasTable('password_reset_codes')
        ? DB::table('password_reset_codes')->where('email', $normalizedEmail)->first()
        : null;

    if (!$user || !$tokenRow) {
        return back()
            ->withInput($request->only('reset_email'))
            ->with('open_forgot_modal', true)
            ->with('reset_step', 'request')
            ->withErrors(['reset_code' => 'Invalid or expired verification code. Request a new code first.']);
    }

    if (now()->greaterThan($tokenRow->expires_at)) {
        DB::table('password_reset_codes')->where('email', $normalizedEmail)->delete();
        return back()
            ->withInput($request->only('reset_email'))
            ->with('open_forgot_modal', true)
            ->with('reset_step', 'request')
            ->withErrors(['reset_code' => 'Verification code expired. Request a new code.']);
    }

    if ((int) $tokenRow->attempts >= 5) {
        DB::table('password_reset_codes')->where('email', $normalizedEmail)->delete();
        return back()
            ->withInput($request->only('reset_email'))
            ->with('open_forgot_modal', true)
            ->with('reset_step', 'request')
            ->withErrors(['reset_code' => 'Too many invalid code attempts. Request a new code.']);
    }

    if (!hash_equals($tokenRow->code_hash, hash('sha256', $validated['reset_code']))) {
        DB::table('password_reset_codes')
            ->where('email', $normalizedEmail)
            ->increment('attempts');

        $attemptsLeft = max(0, 5 - ((int) $tokenRow->attempts + 1));

        return back()
            ->withInput($request->only('reset_email', 'reset_code'))
            ->with('open_forgot_modal', true)
            ->with('reset_step', 'verify')
            ->with('reset_code_preview', session('reset_code_preview'))
            ->withErrors(['reset_code' => "Invalid verification code. ({$attemptsLeft} code attempts remaining)"]);
    }

    DB::table('password_reset_codes')->where('email', $normalizedEmail)->delete();

    $user->password = $validated['new_password'];
    $user->remember_token = null;
    $user->save();

    $settings = WorkspaceSetting::where('user_id', $user->id)->first();
    if (Schema::hasTable('audit_logs') && (!$settings || $settings->audit_telemetry)) {
        AuditLog::create([
            'user_id' => $user->id,
            'actor_name' => $user->admin_name ?? $user->name,
            'event' => 'Password reset verified and completed',
            'meta' => $user->email,
        ]);
    }

    return redirect()->route('login')
        ->withInput(['email' => $user->email])
        ->with('status', 'Password updated for ' . $user->email . '. You can now log in.');
})->name('auth.password.reset');

// Main SaaS Dashboard & Module Routes
Route::get('/students', [StudentController::class, 'index'])->name('students.index');
Route::get('/directory', [StudentController::class, 'directory'])->name('students.directory');
Route::get('/actions', [StudentController::class, 'actions'])->name('actions');
Route::get('/settings', [StudentController::class, 'settings'])->name('settings');
Route::get('/settings/export', [StudentController::class, 'exportCsv'])->name('settings.export');

Route::post('/students', [StudentController::class, 'store'])->name('students.store');
Route::put('/students/{student}', [StudentController::class, 'update'])->name('students.update');
Route::delete('/students/{student}', [StudentController::class, 'destroy'])->name('students.destroy');
Route::post('/settings', [StudentController::class, 'updateSettings'])->name('settings.update');

// Handle Logout -> Clears session and Remember Me cookie
Route::post('/logout', function (Request $request) {
    $userId = session('user_id');
    if ($userId) {
        User::where('id', $userId)->update(['remember_token' => null]);
    }

    $request->session()->flush();

    return redirect()->route('welcome')->withCookie(Cookie::forget('educore_remember'));
})->name('logout');
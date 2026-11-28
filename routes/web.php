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
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;

if (!function_exists('recordAuditLog')) {
    function recordAuditLog(string $event, ?int $userId, Request $request, ?string $meta = null): void
    {
        if (!Schema::hasTable('audit_logs')) {
            return;
        }

        $payload = [];

        if (Schema::hasColumn('audit_logs', 'user_id')) {
            $payload['user_id'] = $userId;
        }
        if (Schema::hasColumn('audit_logs', 'actor_name')) {
            $payload['actor_name'] = session('admin_name', 'Administrator');
        }
        if (Schema::hasColumn('audit_logs', 'event')) {
            $payload['event'] = $event;
        } elseif (Schema::hasColumn('audit_logs', 'action')) {
            $payload['action'] = $event;
        }
        if ($meta !== null) {
            if (Schema::hasColumn('audit_logs', 'meta')) {
                $payload['meta'] = Str::limit($meta, 500);
            } elseif (Schema::hasColumn('audit_logs', 'description')) {
                $payload['description'] = Str::limit($meta, 500);
            }
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

if (!function_exists('getAvailableCourses')) {
    function getAvailableCourses(?int $userId = null): array
    {
        $courses = collect();

        if (Schema::hasTable('courses')) {
            $query = DB::table('courses');
            if ($userId && Schema::hasColumn('courses', 'user_id')) {
                $query->where(function ($q) use ($userId) {
                    $q->where('user_id', $userId)->orWhereNull('user_id');
                });
            }
            $courses = $courses->merge($query->pluck('name'));
        }

        if (Schema::hasTable('students') && Schema::hasColumn('students', 'course')) {
            $studentQuery = Student::query()->whereNotNull('course')->where('course', '!=', '');
            if ($userId && Schema::hasColumn('students', 'user_id')) {
                $studentQuery->where('user_id', $userId);
            }
            $courses = $courses->merge($studentQuery->pluck('course'));
        }

        return $courses
            ->map(fn ($c) => trim((string) $c))
            ->filter(fn ($c) => $c !== '')
            ->unique()
            ->sort()
            ->values()
            ->all();
    }
}

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

    if (Schema::hasTable('users') && !Schema::hasColumn('users', 'avatar')) {
        Schema::table('users', function (Blueprint $table) {
            $table->longText('avatar')->nullable();
        });
    }

    if (!Schema::hasTable('courses')) {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->string('name');
            $table->timestamps();
        });
    } elseif (!Schema::hasColumn('courses', 'user_id')) {
        Schema::table('courses', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->index();
        });
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

            $defaultUser = User::first();
            if ($defaultUser) {
                Student::whereNull('user_id')->update(['user_id' => $defaultUser->id]);
            }
        }

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

Route::get('/', function () {
    try {
        $userId = session('user_id') ?? Auth::id();
        $query = $userId ? Student::where('user_id', $userId) : Student::query();

        $totalStudents = (clone $query)->count();
        $averageGpa = (clone $query)->avg('gpa') ?? 0;
        $activeCoursesCount = count(getAvailableCourses(is_numeric($userId) ? (int) $userId : null));
        $students = (clone $query)->latest()->take(5)->get();
    } catch (\Throwable $e) {
        $totalStudents = 0;
        $averageGpa = 0.00;
        $activeCoursesCount = 0;
        $students = collect();
    }

    return view('welcome', compact('totalStudents', 'averageGpa', 'activeCoursesCount', 'students'));
})->name('welcome');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/auth/login', function () {
    return redirect()->route('login');
});

$registerHandler = function (Request $request) {
    $normalizedEmail = Str::lower(trim((string) $request->input('email')));
    $request->merge(['email' => $normalizedEmail]);

    $validated = $request->validate([
        'workspace_name' => ['required', 'string', 'max:255'],
        'admin_name'     => ['required', 'string', 'max:255'],
        'email'          => ['required', 'string', 'max:255', 'email:rfc', 'unique:users,email'],
        'password'       => ['required', 'string', Password::min(8)->max(128), 'confirmed'],
    ], [
        'email.unique' => 'This email address is already registered.',
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
    recordAuditLog('user.registered', $user->id, $request, "Registered workspace: {$cleanWorkspaceName}");

    Auth::login($user);
    $request->session()->regenerate();
    session([
        'user_id'        => $user->id,
        'workspace_name' => $user->workspace_name ?? $cleanWorkspaceName,
        'admin_name'     => $user->admin_name ?? $cleanAdminName,
        'admin_email'    => $user->email,
        'admin_avatar'   => $user->avatar ?? null,
    ]);

    return redirect()->route('students.index');
};

Route::post('/register', $registerHandler);
Route::post('/auth/register', $registerHandler)->name('auth.register.store');

Route::post('/auth/login', function (Request $request) {
    $normalizedEmail = Str::lower(trim((string) $request->input('email')));
    $request->merge(['email' => $normalizedEmail]);

    $credentials = $request->validate([
        'email'    => ['required', 'string', 'max:255', 'email:rfc'],
        'password' => ['required', 'string', 'min:8', 'max:128'],
    ], [
        'password.min' => 'Password must be at least 8 characters.',
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
        recordAuditLog('auth.login_failed', null, $request, "Failed login for {$normalizedEmail}");

        return back()
            ->withInput($request->only('email', 'remember'))
            ->withErrors([
                'email' => 'Invalid email address or password.',
            ]);
    }

    RateLimiter::clear($throttleKey);
    $request->session()->regenerate();

    $loggedInUser = Auth::user();
    recordAuditLog('auth.login_success', $loggedInUser?->id, $request, "Logged in as {$normalizedEmail}");

    session([
        'user_id'        => $loggedInUser->id,
        'workspace_name' => $loggedInUser->workspace_name ?? '',
        'admin_name'     => $loggedInUser->admin_name ?? $loggedInUser->name,
        'admin_email'    => $loggedInUser->email,
        'admin_avatar'   => $loggedInUser->avatar ?? null,
    ]);

    return redirect()->route('students.index');
})->name('auth.login.store');

Route::post('/forgot-password/code', function (Request $request) {
    $normalizedEmail = Str::lower(trim((string) $request->input('reset_email')));
    $request->merge(['reset_email' => $normalizedEmail]);

    $request->validate([
        'reset_email' => ['required', 'string', 'max:255', 'email:rfc'],
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

    $neutralNotice = "If {$normalizedEmail} is registered, a 6-digit verification code has been issued (valid for 15 minutes).";
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

        if (Schema::hasTable('password_reset_codes')) {
            $existing = DB::table('password_reset_codes')->where('email', $normalizedEmail)->first();
            if ($existing) {
                DB::table('password_reset_codes')
                    ->where('email', $normalizedEmail)
                    ->update($recordPayload);
            } else {
                DB::table('password_reset_codes')->insert($recordPayload);
            }
        }

        try {
            $body = "Hello,\n\n"
                . "Your EduCore SaaS password reset verification code is: {$plainCode}\n\n"
                . "This code expires in 15 minutes.";

            Mail::raw($body, function ($message) use ($normalizedEmail) {
                $message->to($normalizedEmail)
                    ->subject('EduCore SaaS - Password Reset Verification Code');
            });

            recordAuditLog('auth.reset_code_sent', $user->id, $request, "Reset code requested for {$normalizedEmail}");
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
        'reset_email'  => ['required', 'string', 'max:255', 'email:rfc'],
        'reset_code'   => ['required', 'digits:6'],
        'new_password' => ['required', 'string', Password::min(8)->max(128), 'confirmed'],
    ], [
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

    $record = Schema::hasTable('password_reset_codes')
        ? DB::table('password_reset_codes')->where('email', $normalizedEmail)->first()
        : null;
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
                'reset_code' => 'Invalid verification code. Please try again.',
            ]);
    }

    DB::transaction(function () use ($user, $validated, $normalizedEmail, $request) {
        $user->forceFill([
            'password'       => Hash::make($validated['new_password']),
            'remember_token' => Str::random(60),
        ])->save();

        DB::table('password_reset_codes')->where('email', $normalizedEmail)->delete();
        recordAuditLog('auth.password_reset', $user->id, $request, "Password reset for {$normalizedEmail}");
    });

    RateLimiter::clear($resetKey);
    RateLimiter::clear('login:' . sha1($normalizedEmail . '|' . $request->ip()));

    return redirect()
        ->route('login')
        ->with('status', 'Your password has been updated. You can now log in with your new password.');
})->name('auth.password.reset');

Route::post('/profile', function (Request $request) {
    $validated = $request->validate([
        'name'             => ['required', 'string', 'max:120'],
        'email'            => ['required', 'string', 'max:255', 'email:rfc'],
        'avatar_photo'     => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,gif', 'max:2048'],
        'current_password' => ['nullable', 'string'],
        'new_password'     => ['nullable', 'string', Password::min(8)->max(128), 'confirmed'],
    ], [
        'new_password.min'       => 'New password must be at least 8 characters.',
        'new_password.confirmed' => 'New password confirmation does not match.',
    ]);

    $cleanName = trim($validated['name']);
    $cleanEmail = Str::lower(trim($validated['email']));
    $userId = Auth::id() ?? session('user_id');
    $user = is_numeric($userId) ? User::find((int) $userId) : null;

    $wantsPasswordChange = filled($validated['new_password'] ?? null);
    $passwordUpdated = false;

    if ($wantsPasswordChange) {
        if (!$user) {
            return back()
                ->withInput($request->except(['current_password', 'new_password', 'new_password_confirmation']))
                ->withErrors([
                    'new_password' => 'Unable to locate an authenticated account to update the password.',
                ]);
        }

        if (!empty($user->password)) {
            $currentInput = (string) ($validated['current_password'] ?? '');
            if ($currentInput === '' || !Hash::check($currentInput, (string) $user->password)) {
                return back()
                    ->withInput($request->except(['current_password', 'new_password', 'new_password_confirmation']))
                    ->withErrors([
                        'current_password' => 'Current password is incorrect.',
                    ]);
            }
        }
    }

    $avatarDataUrl = session('admin_avatar') ?? ($user->avatar ?? null);

    if ($request->hasFile('avatar_photo')) {
        $file = $request->file('avatar_photo');
        $mime = $file->getMimeType() ?: 'image/png';
        $base64 = base64_encode(file_get_contents($file->getRealPath()));
        $avatarDataUrl = "data:{$mime};base64,{$base64}";

        if ($user && Schema::hasTable('users') && Schema::hasColumn('users', 'avatar')) {
            $user->forceFill(['avatar' => $avatarDataUrl])->save();
        }
    }

    if ($user) {
        $updates = [
            'name'  => $cleanName,
            'email' => $cleanEmail,
        ];
        if (Schema::hasColumn('users', 'admin_name')) {
            $updates['admin_name'] = $cleanName;
        }
        if ($wantsPasswordChange) {
            $updates['password'] = Hash::make($validated['new_password']);
            $updates['remember_token'] = Str::random(60);
            $passwordUpdated = true;
        }

        $user->forceFill($updates)->save();

        if ($passwordUpdated) {
            $request->session()->regenerate();
        }

        recordAuditLog(
            $passwordUpdated ? 'profile.password_updated' : 'profile.updated',
            $user->id,
            $request,
            $passwordUpdated ? "Updated profile and password for {$cleanEmail}" : "Updated profile for {$cleanEmail}"
        );
    }

    session([
        'user_id'      => $user?->id ?? session('user_id'),
        'admin_name'   => $cleanName,
        'admin_email'  => $cleanEmail,
        'admin_avatar' => $avatarDataUrl,
    ]);

    $message = $passwordUpdated
        ? 'Admin profile and password updated.'
        : 'Admin profile updated.';

    return redirect()->back()->with('success', $message);
})->name('profile.update');

Route::get('/students', [StudentController::class, 'index'])->name('students.index');
Route::get('/directory', [StudentController::class, 'directory'])->name('students.directory');
Route::get('/gpa-analytics', [StudentController::class, 'gpaAnalytics'])->name('students.gpa');
Route::get('/courses', function (Request $request) {
    $response = app(StudentController::class)->courses($request);

    if ($response instanceof \Illuminate\View\View) {
        $data = $response->getData();
        $existingCourses = collect($data['courses'] ?? []);

        $knownNames = $existingCourses->map(function ($item) {
            if (is_string($item)) return trim($item);
            if (is_array($item)) return trim((string) ($item['course'] ?? $item['name'] ?? $item['course_name'] ?? ''));
            if (is_object($item)) return trim((string) ($item->course ?? $item->name ?? $item->course_name ?? ''));
            return '';
        })->filter()->map(fn ($n) => Str::lower($n))->all();

        $userId = Auth::id() ?? session('user_id');
        $allAvailable = getAvailableCourses(is_numeric($userId) ? (int) $userId : null);

        foreach ($allAvailable as $courseName) {
            if (!in_array(Str::lower($courseName), $knownNames, true)) {
                $existingCourses->push((object) [
                    'name'           => $courseName,
                    'course'         => $courseName,
                    'students_count' => 0,
                    'average_gpa'    => '0.00',
                ]);
            }
        }

        $response->with('courses', $existingCourses);
    }

    return $response;
})->name('students.courses');
Route::post('/courses', function (Request $request) {
    $validated = $request->validate([
        'name' => ['required', 'string', 'max:60'],
    ]);

    $cleanName = trim($validated['name']);
    $userId = Auth::id() ?? session('user_id');
    $uid = is_numeric($userId) ? (int) $userId : null;

    if (Schema::hasTable('courses')) {
        $existsQuery = DB::table('courses')->whereRaw('LOWER(name) = ?', [Str::lower($cleanName)]);
        if ($uid && Schema::hasColumn('courses', 'user_id')) {
            $existsQuery->where('user_id', $uid);
        }

        if (!$existsQuery->exists()) {
            $row = [
                'name'       => $cleanName,
                'created_at' => now(),
                'updated_at' => now(),
            ];
            if ($uid && Schema::hasColumn('courses', 'user_id')) {
                $row['user_id'] = $uid;
            }
            DB::table('courses')->insert($row);
        }
    }

    recordAuditLog('course.created', $uid, $request, "Added course: {$cleanName}");

    return redirect()->back()->with('success', "Course \"{$cleanName}\" added.");
})->name('courses.store');
Route::put('/courses/rename', [StudentController::class, 'renameCourse'])->name('courses.rename');
Route::delete('/courses/delete', [StudentController::class, 'deleteCourse'])->name('courses.delete');
Route::get('/actions', [StudentController::class, 'actions'])->name('actions');
Route::get('/settings', [StudentController::class, 'settings'])->name('settings');
Route::get('/settings/export-csv', [StudentController::class, 'exportCsv'])->name('settings.export.csv');

Route::post('/students', [StudentController::class, 'store'])->name('students.store');
Route::put('/students/{student}', [StudentController::class, 'update'])->name('students.update');
Route::delete('/students/{student}', [StudentController::class, 'destroy'])->name('students.destroy');
Route::post('/settings', [StudentController::class, 'updateSettings'])->name('settings.update');

Route::post('/logout', function (Request $request) {
    $loggedInUser = Auth::user();
    $sessionUserId = $loggedInUser?->id ?? session('user_id');
    recordAuditLog('auth.logout', is_numeric($sessionUserId) ? (int) $sessionUserId : null, $request, 'User logged out');

    Auth::logout();
    $request->session()->flush();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('welcome');
})->name('logout');

View::composer('students.index', function ($view) {
    if (!$view->offsetExists('courses')) {
        $userId = Auth::id() ?? session('user_id');
        $view->with('courses', getAvailableCourses(is_numeric($userId) ? (int) $userId : null));
    }
});
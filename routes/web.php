<?php

use App\Http\Controllers\StudentController;
use App\Models\AuditLog;
use App\Models\Student;
use App\Models\User;
use App\Models\WorkspaceSetting;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

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

    if (Schema::hasTable('users') && User::where('email', 'george@edu.core')->doesntExist()) {
        User::create([
            'workspace_name' => 'EduCore Workspace',
            'admin_name' => 'George',
            'name' => 'George',
            'email' => 'george@edu.core',
            'password' => '123456789',
        ]);
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
} catch (\Throwable $e) {
    report($e);
}

Route::get('/', function () {
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

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/auth/register', function (Request $request) {
    $validated = $request->validate([
        'workspace_name' => 'required|string|max:255',
        'admin_name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:6',
    ]);

    $user = User::create([
        'workspace_name' => $validated['workspace_name'],
        'admin_name' => $validated['admin_name'],
        'name' => $validated['admin_name'],
        'email' => $validated['email'],
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

Route::post('/auth/login', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return back()->withErrors(['email' => 'Invalid email or password provided.']);
    }

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

    return redirect()->route('students.index');
})->name('auth.login.store');

Route::get('/students', [StudentController::class, 'index'])->name('students.index');
Route::get('/directory', [StudentController::class, 'directory'])->name('students.directory');
Route::get('/actions', [StudentController::class, 'actions'])->name('actions');
Route::get('/settings', [StudentController::class, 'settings'])->name('settings');
Route::get('/settings/export', [StudentController::class, 'exportCsv'])->name('settings.export');

Route::post('/students', [StudentController::class, 'store'])->name('students.store');
Route::put('/students/{student}', [StudentController::class, 'update'])->name('students.update');
Route::delete('/students/{student}', [StudentController::class, 'destroy'])->name('students.destroy');
Route::post('/settings', [StudentController::class, 'updateSettings'])->name('settings.update');

Route::post('/logout', function (Request $request) {
    $request->session()->flush();
    return redirect()->route('welcome');
})->name('logout');
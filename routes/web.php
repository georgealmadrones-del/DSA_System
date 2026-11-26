<?php

use App\Http\Controllers\StudentController;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

// Ensure database tables, columns, and default fallback user exist safely
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

    // Ensure default fallback user exists so login works after container restarts
    if (Schema::hasTable('users') && User::where('email', 'george@edu.core')->doesntExist()) {
        User::create([
            'workspace_name' => 'EduCore Workspace',
            'admin_name' => 'George',
            'name' => 'George',
            'email' => 'george@edu.core',
            'password' => '123456789',
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

            $defaultUser = User::where('email', 'george@edu.core')->first() ?? User::first();
            if ($defaultUser) {
                Student::whereNull('user_id')->update(['user_id' => $defaultUser->id]);
            }
        }
    }
} catch (\Throwable $e) {
    report($e);
}

// Root URL -> Welcome / Landing Page
Route::get('/', function () {
    try {
        $userId = session('user_id');

        if ($userId) {
            $query = Student::where('user_id', $userId);
        } else {
            $query = Student::query();
        }

        $totalStudents = (clone $query)->count();
        $averageGpa = (clone $query)->avg('gpa') ?? 0;
        $activeCoursesCount = $totalStudents > 0 ? 1 : 0;
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

    session([
        'user_id' => $user->id,
        'workspace_name' => $user->workspace_name,
        'admin_name' => $user->admin_name,
    ]);

    return redirect()->route('students.index');
})->name('auth.register.store');

// Handle Database Login
Route::post('/auth/login', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return back()->withErrors(['email' => 'Invalid email or password provided.']);
    }

    session([
        'user_id' => $user->id,
        'workspace_name' => $user->workspace_name,
        'admin_name' => $user->admin_name,
    ]);

    return redirect()->route('students.index');
})->name('auth.login.store');

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
    $request->session()->flush();
    return redirect()->route('welcome');
})->name('logout');
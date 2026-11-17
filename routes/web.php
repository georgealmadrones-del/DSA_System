<?php

use App\Http\Controllers\StudentController;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

// Welcome / Landing Page (Real-time DB stats)
Route::get('/welcome', function () {
    $totalStudents = Student::count();
    $averageGpa = Student::avg('gpa') ?? 0;
    $activeCoursesCount = Student::count() > 0 ? 1 : 0;
    $students = Student::latest()->take(5)->get();

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
        'password' => $validated['password'], // Handled automatically by User model 'hashed' cast
    ]);

    // Store user session data
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

    // Bind session to this specific user account
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
    $request->session()->flush(); // Clears all session data
    return redirect()->route('welcome');
})->name('logout');
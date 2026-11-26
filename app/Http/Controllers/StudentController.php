<?php

namespace App\Http\Controllers;

use App\Models\ActionLog;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    private function requireAuthenticatedUser()
    {
        $userId = session('user_id');

        if (!$userId) {
            abort(redirect()->route('login'));
        }

        return $userId;
    }

    private function logAction(string $event): void
    {
        try {
            if (class_exists(ActionLog::class)) {
                ActionLog::create([
                    'event' => $event,
                ]);
            }
        } catch (\Throwable $e) {
            // Ignore logging errors so main CRUD actions never fail
        }
    }

    public function index(Request $request)
    {
        $userId = $this->requireAuthenticatedUser();
        $query = Student::where('user_id', $userId);

        // Search functionality
        if ($request->filled('search')) {
            $search = trim($request->input('search'));
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('student_id', 'like', "%{$search}%")
                  ->orWhere('course', 'like', "%{$search}%");
            });
        }

        // Sorting functionality
        $sortBy = $request->input('sort_by', 'student_id');
        if ($sortBy === 'name') {
            $query->orderBy('name', 'asc');
        } elseif ($sortBy === 'gpa') {
            $query->orderBy('gpa', 'asc');
        } else {
            $query->orderBy('student_id', 'desc');
        }

        $students = $query->get();
        $allUserStudents = Student::where('user_id', $userId);
        $totalStudents = (clone $allUserStudents)->count();
        $averageGpa = (clone $allUserStudents)->avg('gpa') ?? 0;

        // Safe count for active courses in current user's workspace
        try {
            $activeCoursesCount = (clone $allUserStudents)
                ->whereNotNull('course')
                ->where('course', '!=', '')
                ->distinct('course')
                ->count('course');
        } catch (\Throwable $e) {
            $activeCoursesCount = 0;
        }

        return view('students.index', compact(
            'students',
            'totalStudents',
            'averageGpa',
            'activeCoursesCount'
        ));
    }

    public function directory()
    {
        $userId = $this->requireAuthenticatedUser();
        $students = Student::where('user_id', $userId)->latest()->get();
        $totalStudents = Student::where('user_id', $userId)->count();

        if (view()->exists('students.directory')) {
            return view('students.directory', compact('students', 'totalStudents'));
        }

        return view('students.index', compact('students', 'totalStudents'));
    }

    public function actions()
    {
        $this->requireAuthenticatedUser();
        $logs = class_exists(ActionLog::class) ? ActionLog::latest()->take(20)->get() : collect();

        if (view()->exists('students.actions')) {
            return view('students.actions', compact('logs'));
        } elseif (view()->exists('actions')) {
            return view('actions', compact('logs'));
        }

        return view('students.index', compact('logs'));
    }

    public function settings()
    {
        $this->requireAuthenticatedUser();

        if (view()->exists('students.settings')) {
            return view('students.settings');
        } elseif (view()->exists('settings')) {
            return view('settings');
        }

        return view('students.index');
    }

    public function store(Request $request)
    {
        $userId = $this->requireAuthenticatedUser();

        $validated = $request->validate([
            'student_id' => [
                'required',
                'string',
                'max:255',
                Rule::unique('students', 'student_id')->where(function ($query) use ($userId) {
                    return $query->where('user_id', $userId);
                }),
            ],
            'name' => 'required|string|max:255',
            'course' => 'required|string|max:255',
            'gpa' => 'required|numeric|between:1.00,3.00',
        ], [
            'student_id.unique' => 'That Student ID already exists in your workspace.',
        ]);

        $validated['user_id'] = $userId;

        $student = Student::create($validated);

        $this->logAction("Added new student: {$student->name} ({$student->student_id})");

        return redirect()->route('students.index');
    }

    public function update(Request $request, Student $student)
    {
        $userId = $this->requireAuthenticatedUser();
        $ownedStudent = Student::where('user_id', $userId)->findOrFail($student->id);

        $validated = $request->validate([
            'student_id' => [
                'required',
                'string',
                'max:255',
                Rule::unique('students', 'student_id')
                    ->ignore($ownedStudent->id)
                    ->where(function ($query) use ($userId) {
                        return $query->where('user_id', $userId);
                    }),
            ],
            'name' => 'required|string|max:255',
            'course' => 'required|string|max:255',
            'gpa' => 'required|numeric|between:1.00,3.00',
        ], [
            'student_id.unique' => 'That Student ID already exists in your workspace.',
        ]);

        $ownedStudent->update($validated);

        $this->logAction("Updated student: {$ownedStudent->name} ({$ownedStudent->student_id})");

        return redirect()->route('students.index');
    }

    public function destroy(Student $student)
    {
        $userId = $this->requireAuthenticatedUser();
        $ownedStudent = Student::where('user_id', $userId)->findOrFail($student->id);

        $name = $ownedStudent->name;
        $studentId = $ownedStudent->student_id;
        $ownedStudent->delete();

        $this->logAction("Deleted student: {$name} ({$studentId})");

        return redirect()->route('students.index');
    }

    public function updateSettings(Request $request)
    {
        $this->requireAuthenticatedUser();
        $this->logAction('Updated workspace settings');

        return back()->with('success', 'Settings updated successfully.');
    }
}
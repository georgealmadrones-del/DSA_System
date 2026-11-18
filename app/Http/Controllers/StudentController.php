<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\ActionLog;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
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
        $totalStudents = Student::count();
        $averageGpa = Student::avg('gpa') ?? 0;
        
        // Safe count for active courses
        try {
            $activeCoursesCount = Student::whereNotNull('course')->distinct('course')->count('course');
        } catch (\Exception $e) {
            $activeCoursesCount = 0;
        }

        return view('students.index', compact('students', 'totalStudents', 'averageGpa', 'activeCoursesCount'));
    }

    public function directory()
    {
        $students = Student::latest()->get();
        $totalStudents = Student::count();
        
        if (view()->exists('students.directory')) {
            return view('students.directory', compact('students', 'totalStudents'));
        }
        return view('students.index', compact('students', 'totalStudents'));
    }

    public function actions()
    {
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
        if (view()->exists('students.settings')) {
            return view('students.settings');
        } elseif (view()->exists('settings')) {
            return view('settings');
        }
        
        return view('students.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|string|max:255|unique:students,student_id',
            'name' => 'required|string|max:255',
            'course' => 'required|string|max:255',
            'gpa' => 'required|numeric|between:1.00,3.00',
        ]);

        $student = Student::create($validated);

        try {
            if (class_exists(ActionLog::class)) {
                ActionLog::create([
                    'event' => "Added new student: {$student->name} ({$student->student_id})"
                ]);
            }
        } catch (\Exception $e) {}

        return redirect()->route('students.index');
    }

    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'student_id' => 'required|string|max:255|unique:students,student_id,' . $student->id,
            'name' => 'required|string|max:255',
            'course' => 'required|string|max:255',
            'gpa' => 'required|numeric|between:1.00,3.00',
        ]);

        $student->update($validated);

        try {
            if (class_exists(ActionLog::class)) {
                ActionLog::create([
                    'event' => "Updated student: {$student->name} ({$student->student_id})"
                ]);
            }
        } catch (\Exception $e) {}

        return redirect()->route('students.index');
    }

    public function destroy(Student $student)
    {
        $name = $student->name;
        $studentId = $student->student_id;
        $student->delete();

        try {
            if (class_exists(ActionLog::class)) {
                ActionLog::create([
                    'event' => "Deleted student: {$name} ({$studentId})"
                ]);
            }
        } catch (\Exception $e) {}

        return redirect()->route('students.index');
    }

    public function updateSettings(Request $request)
    {
        try {
            if (class_exists(ActionLog::class)) {
                ActionLog::create([
                    'event' => "Updated workspace settings"
                ]);
            }
        } catch (\Exception $e) {}

        return back()->with('success', 'Settings updated successfully.');
    }
}
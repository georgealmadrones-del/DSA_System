<?php

namespace App\Models;

use App\Http\Controllers\StudentController;
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
        
        // Safe count for active courses to prevent SQL/collection errors
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
        return view('students.directory', compact('students', 'totalStudents'));
    }

    public function actions()
    {
        return view('students.actions');
    }

    public function settings()
    {
        return view('students.settings');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|string|max:255|unique:students,student_id',
            'name' => 'required|string|max:255',
            'course' => 'required|string|max:255',
            'gpa' => 'required|numeric|between:1.00,3.00',
        ]);

        Student::create($validated);

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

        return redirect()->route('students.index');
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index');
    }

    public function updateSettings(Request $request)
    {
        return back()->with('success', 'Settings updated successfully.');
    }
}
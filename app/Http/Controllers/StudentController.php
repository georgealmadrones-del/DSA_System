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
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('student_id', 'like', "%{$search}%")
                  ->orWhere('course', 'like', "%{$search}%");
            });
        }

        // Sort functionality
        $sortBy = $request->get('sort_by', 'student_id');
        $query->orderBy($sortBy, 'desc');

        $students = $query->get();

        // Real-time metric computations from database
        $totalStudents = $students->count();
        $averageGpa = $totalStudents > 0 ? $students->avg('gpa') : 0.00;
        
        $activeCoursesCount = $students->pluck('course')->unique()->filter()->count();
        if ($activeCoursesCount === 0 && $totalStudents > 0) {
            $activeCoursesCount = 1; 
        }

        return view('students.index', compact('students', 'totalStudents', 'averageGpa', 'activeCoursesCount'));
    }

    public function directory(Request $request)
    {
        $query = Student::query();
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('student_id', 'like', "%{$search}%");
        }
        $students = $query->get();
        return view('students.directory', compact('students'));
    }

    public function actions(Request $request)
    {
        $logs = ActionLog::latest()->get();
        return view('actions', compact('logs')); // Points to resources/views/actions.blade.php
    }

    public function settings(Request $request)
    {
        return view('settings'); // Points to resources/views/settings.blade.php
    }

    public function updateSettings(Request $request)
    {
        $validated = $request->validate([
            'workspace_name' => 'required|string|max:255',
            'admin_name' => 'nullable|string|max:255',
        ]);

        session(['workspace_name' => $validated['workspace_name']]);
        if (!empty($validated['admin_name'])) {
            session(['admin_name' => $validated['admin_name']]);
        }

        // Record real-time audit log
        ActionLog::create(['event' => 'Workspace Settings Updated (' . $validated['workspace_name'] . ')']);

        return redirect()->route('settings')->with('success', 'Workspace settings updated successfully.');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|string|unique:students,student_id',
            'name' => 'required|string|max:255',
            'course' => 'required|string|max:255',
            'gpa' => 'required|numeric|between:1.00,3.00',
        ]);

        Student::create($validated);

        ActionLog::create(['event' => 'Student Record Created (' . $validated['student_id'] . ')']);

        return redirect()->route('students.index')->with('success', 'Student record created successfully.');
    }

    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'student_id' => 'required|string|unique:students,student_id,' . $student->id,
            'name' => 'required|string|max:255',
            'course' => 'required|string|max:255',
            'gpa' => 'required|numeric|between:1.00,3.00',
        ]);

        $student->update($validated);

        ActionLog::create(['event' => 'Student Record Updated (' . $validated['student_id'] . ')']);

        return redirect()->route('students.index')->with('success', 'Student record updated successfully.');
    }

    public function destroy(Student $student)
    {
        $studentId = $student->student_id;
        $student->delete();

        ActionLog::create(['event' => 'Student Record Deleted (' . $studentId . ')']);

        return redirect()->route('students.index')->with('success', 'Student record deleted successfully.');
    }
}
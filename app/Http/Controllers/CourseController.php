<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        // Merge any courses already in students table so existing courses stay visible
        $studentCourses = Student::query()->whereNotNull('course')->pluck('course');
        foreach ($studentCourses as $courseName) {
            if (trim($courseName) !== '') {
                Course::firstOrCreate(['name' => trim($courseName)]);
            }
        }

        $courses = Course::orderBy('name')->get()->map(function ($course) {
            $matchingStudents = Student::where('course', $course->name)->get();
            return (object) [
                'id' => $course->id,
                'name' => $course->name,
                'students_count' => $matchingStudents->count(),
                'average_gpa' => $matchingStudents->count() > 0
                    ? number_format((float) $matchingStudents->avg('gpa'), 2)
                    : '0.00',
            ];
        });

        return view('courses.index', compact('courses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:60', 'unique:courses,name'],
        ]);

        Course::create([
            'name' => trim($validated['name']),
        ]);

        return redirect()->back()->with('success', 'Course added.');
    }
}
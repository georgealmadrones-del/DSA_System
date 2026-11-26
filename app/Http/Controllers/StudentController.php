<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    private function currentUserId()
    {
        $userId = session('user_id');

        if (!$userId) {
            return null;
        }

        return $userId;
    }

    private function requireAuthenticatedUser()
    {
        $userId = $this->currentUserId();

        if (!$userId) {
            abort(redirect()->route('login'));
        }

        return $userId;
    }

    private function computeActiveCoursesCount($userId): int
    {
        return (int) Student::where('user_id', $userId)
            ->whereNotNull('course')
            ->where('course', '!=', '')
            ->distinct()
            ->count('course');
    }

    public function index(Request $request)
    {
        $userId = $this->requireAuthenticatedUser();
        $query = Student::where('user_id', $userId);

        if ($request->filled('search')) {
            $search = trim($request->input('search'));
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('student_id', 'like', "%{$search}%")
                  ->orWhere('course', 'like', "%{$search}%");
            });
        }

        if ($request->filled('course')) {
            $query->where('course', $request->input('course'));
        }

        $students = (clone $query)->latest()->get();
        $allUserStudents = Student::where('user_id', $userId);
        $totalStudents = (clone $allUserStudents)->count();
        $averageGpa = (clone $allUserStudents)->avg('gpa') ?? 0;
        $activeCoursesCount = $this->computeActiveCoursesCount($userId);

        return view('students.index', compact(
            'students',
            'totalStudents',
            'averageGpa',
            'activeCoursesCount'
        ));
    }

    public function directory(Request $request)
    {
        $userId = $this->requireAuthenticatedUser();
        $query = Student::where('user_id', $userId);

        if ($request->filled('search')) {
            $search = trim($request->input('search'));
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('student_id', 'like', "%{$search}%")
                  ->orWhere('course', 'like', "%{$search}%");
            });
        }

        $students = $query->latest()->get();
        $activeCoursesCount = $this->computeActiveCoursesCount($userId);

        return view('students.directory', compact('students', 'activeCoursesCount'));
    }

    public function actions()
    {
        $userId = $this->requireAuthenticatedUser();
        $students = Student::where('user_id', $userId)->latest()->get();
        $activeCoursesCount = $this->computeActiveCoursesCount($userId);

        return view('students.actions', compact('students', 'activeCoursesCount'));
    }

    public function settings()
    {
        $userId = $this->requireAuthenticatedUser();
        $user = User::find($userId);

        return view('students.settings', compact('user'));
    }

    public function store(Request $request)
    {
        $userId = $this->requireAuthenticatedUser();

        $validated = $request->validate([
            'student_id' => 'nullable|string|max:100',
            'name' => 'required|string|max:255',
            'course' => 'nullable|string|max:255',
            'gpa' => 'nullable|numeric|min:0|max:5',
        ]);

        $data = $validated;
        $data['user_id'] = $userId;

        foreach ($request->except(['_token', '_method', 'user_id']) as $key => $value) {
            if (!array_key_exists($key, $data)) {
                $data[$key] = $value;
            }
        }

        Student::create($data);

        return redirect()->back()->with('success', 'Student record saved to your workspace.');
    }

    public function update(Request $request, Student $student)
    {
        $userId = $this->requireAuthenticatedUser();

        $ownedStudent = Student::where('user_id', $userId)->findOrFail($student->id);

        $validated = $request->validate([
            'student_id' => 'nullable|string|max:100',
            'name' => 'required|string|max:255',
            'course' => 'nullable|string|max:255',
            'gpa' => 'nullable|numeric|min:0|max:5',
        ]);

        $data = $validated;
        foreach ($request->except(['_token', '_method', 'user_id']) as $key => $value) {
            if (!array_key_exists($key, $data)) {
                $data[$key] = $value;
            }
        }

        $ownedStudent->update($data);

        return redirect()->back()->with('success', 'Student record updated.');
    }

    public function destroy(Student $student)
    {
        $userId = $this->requireAuthenticatedUser();

        $ownedStudent = Student::where('user_id', $userId)->findOrFail($student->id);
        $ownedStudent->delete();

        return redirect()->back()->with('success', 'Student record deleted.');
    }

    public function updateSettings(Request $request)
    {
        $userId = $this->requireAuthenticatedUser();
        $user = User::findOrFail($userId);

        $validated = $request->validate([
            'workspace_name' => 'nullable|string|max:255',
            'admin_name' => 'nullable|string|max:255',
            'name' => 'nullable|string|max:255',
        ]);

        if (!empty($validated['workspace_name'])) {
            $user->workspace_name = $validated['workspace_name'];
            session(['workspace_name' => $user->workspace_name]);
        }

        $adminName = $validated['admin_name'] ?? $validated['name'] ?? null;
        if (!empty($adminName)) {
            $user->admin_name = $adminName;
            $user->name = $adminName;
            session(['admin_name' => $user->admin_name]);
        }

        $user->save();

        return redirect()->back()->with('success', 'Workspace settings updated.');
    }
}
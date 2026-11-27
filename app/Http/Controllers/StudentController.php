<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use App\Models\Student;
use App\Models\User;
use App\Models\WorkspaceSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
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

    private function getSettings($userId): array
    {
        $fallbackWorkspace = session('workspace_name', 'EduCore Workspace');

        if (!Schema::hasTable('workspace_settings')) {
            return [
                'workspace_name' => $fallbackWorkspace,
                'student_id_prefix' => 'STU-',
                'gpa_scale' => 3.00,
                'academic_term' => '1st Semester AY 2026-2027',
                'data_integrity' => true,
                'audit_telemetry' => true,
            ];
        }

        $record = WorkspaceSetting::firstOrCreate(
            ['user_id' => $userId],
            [
                'workspace_name' => $fallbackWorkspace,
                'student_id_prefix' => 'STU-',
                'gpa_scale' => 3.00,
                'academic_term' => '1st Semester AY 2026-2027',
                'data_integrity' => true,
                'audit_telemetry' => true,
            ]
        );

        session(['workspace_name' => $record->workspace_name]);

        return [
            'workspace_name' => $record->workspace_name,
            'student_id_prefix' => $record->student_id_prefix ?: 'STU-',
            'gpa_scale' => (float) ($record->gpa_scale ?: 3.00),
            'academic_term' => $record->academic_term ?: '1st Semester AY 2026-2027',
            'data_integrity' => (bool) $record->data_integrity,
            'audit_telemetry' => (bool) $record->audit_telemetry,
        ];
    }

    private function logAction($userId, string $event, ?string $meta = null, ?array $settings = null): void
    {
        $activeSettings = $settings ?? $this->getSettings($userId);

        if (!$activeSettings['audit_telemetry']) {
            return;
        }

        try {
            if (Schema::hasTable('audit_logs')) {
                AuditLog::create([
                    'user_id' => $userId,
                    'actor_name' => session('admin_name', 'Administrator'),
                    'event' => $event,
                    'meta' => $meta,
                ]);
            }
        } catch (\Throwable $e) {
            report($e);
        }
    }

    private function computeActiveCoursesCount($userId): int
    {
        try {
            return (int) Student::where('user_id', $userId)
                ->whereNotNull('course')
                ->where('course', '!=', '')
                ->distinct()
                ->count('course');
        } catch (\Throwable $e) {
            return 0;
        }
    }

    private function nextStudentId($userId, string $prefix): string
    {
        $cleanPrefix = trim($prefix) !== '' ? trim($prefix) : 'STU-';
        $records = Student::where('user_id', $userId)->pluck('student_id');
        $maxNum = 1000;

        foreach ($records as $existingId) {
            if (preg_match('/(\d+)$/', (string) $existingId, $matches)) {
                $num = (int) $matches[1];
                if ($num > $maxNum) {
                    $maxNum = $num;
                }
            }
        }

        return $cleanPrefix . ($maxNum + 1);
    }

    private function resolveView(array $candidates, array $data = [])
    {
        foreach ($candidates as $viewName) {
            if (view()->exists($viewName)) {
                return view($viewName, $data);
            }
        }

        return view('students.index', $data);
    }

    public function index(Request $request)
    {
        $userId = $this->requireAuthenticatedUser();
        $settings = $this->getSettings($userId);
        $query = Student::where('user_id', $userId);

        if ($request->filled('search')) {
            $search = trim($request->input('search'));
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('student_id', 'like', "%{$search}%")
                  ->orWhere('course', 'like', "%{$search}%");
            });
        }

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
        $activeCoursesCount = $this->computeActiveCoursesCount($userId);
        $nextStudentId = $this->nextStudentId($userId, $settings['student_id_prefix']);

        return view('students.index', compact(
            'students',
            'totalStudents',
            'averageGpa',
            'activeCoursesCount',
            'settings',
            'nextStudentId'
        ));
    }

    public function directory(Request $request)
    {
        $userId = $this->requireAuthenticatedUser();
        $settings = $this->getSettings($userId);
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
        $totalStudents = Student::where('user_id', $userId)->count();
        $averageGpa = Student::where('user_id', $userId)->avg('gpa') ?? 0;
        $activeCoursesCount = $this->computeActiveCoursesCount($userId);

        return $this->resolveView(
            ['students.directory', 'directory'],
            compact('students', 'totalStudents', 'averageGpa', 'activeCoursesCount', 'settings')
        );
    }

    public function actions()
    {
        $userId = $this->requireAuthenticatedUser();
        $settings = $this->getSettings($userId);
        $students = Student::where('user_id', $userId)->latest()->get();
        $totalStudents = Student::where('user_id', $userId)->count();
        $averageGpa = Student::where('user_id', $userId)->avg('gpa') ?? 0;
        $activeCoursesCount = $this->computeActiveCoursesCount($userId);
        $logs = Schema::hasTable('audit_logs')
            ? AuditLog::where('user_id', $userId)->latest()->take(50)->get()
            : collect();

        return $this->resolveView(
            ['students.actions', 'actions'],
            compact('students', 'totalStudents', 'averageGpa', 'activeCoursesCount', 'logs', 'settings')
        );
    }

    public function settings()
    {
        $userId = $this->requireAuthenticatedUser();
        $settings = $this->getSettings($userId);
        $students = Student::where('user_id', $userId)->latest()->get();
        $totalStudents = Student::where('user_id', $userId)->count();
        $averageGpa = Student::where('user_id', $userId)->avg('gpa') ?? 0;
        $activeCoursesCount = $this->computeActiveCoursesCount($userId);

        return $this->resolveView(
            ['students.settings', 'settings'],
            compact('students', 'totalStudents', 'averageGpa', 'activeCoursesCount', 'settings')
        );
    }

    public function store(Request $request)
    {
        $userId = $this->requireAuthenticatedUser();
        $settings = $this->getSettings($userId);

        $cleanedGpa = preg_replace('/[^0-9.]/', '', (string) $request->input('gpa'));
        $request->merge(['gpa' => $cleanedGpa]);

        $maxGpa = $settings['gpa_scale'] >= 4.0 ? 4.00 : 3.00;
        $minGpa = $settings['data_integrity'] ? 1.00 : 0.00;

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
            'gpa' => "required|numeric|between:{$minGpa},{$maxGpa}",
        ], [
            'student_id.unique' => 'That Student ID already exists in your workspace.',
            'gpa.between' => "GPA must be between {$minGpa} and {$maxGpa} based on your active scale.",
        ]);

        $validated['user_id'] = $userId;
        $student = Student::create($validated);

        $this->logAction(
            $userId,
            "Added new student: {$student->name} ({$student->student_id})",
            "Course: {$student->course}, GPA: " . number_format((float) $student->gpa, 2),
            $settings
        );

        return redirect()->route('students.index')->with('success', 'Student record saved.');
    }

    public function update(Request $request, Student $student)
    {
        $userId = $this->requireAuthenticatedUser();
        $settings = $this->getSettings($userId);
        $ownedStudent = Student::where('user_id', $userId)->findOrFail($student->id);

        $cleanedGpa = preg_replace('/[^0-9.]/', '', (string) $request->input('gpa'));
        $request->merge(['gpa' => $cleanedGpa]);

        $maxGpa = $settings['gpa_scale'] >= 4.0 ? 4.00 : 3.00;
        $minGpa = $settings['data_integrity'] ? 1.00 : 0.00;

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
            'gpa' => "required|numeric|between:{$minGpa},{$maxGpa}",
        ], [
            'student_id.unique' => 'That Student ID already exists in your workspace.',
            'gpa.between' => "GPA must be between {$minGpa} and {$maxGpa} based on your active scale.",
        ]);

        $ownedStudent->update([
            'user_id' => $userId,
            'student_id' => $validated['student_id'],
            'name' => $validated['name'],
            'course' => $validated['course'],
            'gpa' => $validated['gpa'],
        ]);

        $this->logAction(
            $userId,
            "Updated student: {$ownedStudent->name} ({$ownedStudent->student_id})",
            "Course: {$ownedStudent->course}, GPA: " . number_format((float) $ownedStudent->gpa, 2),
            $settings
        );

        return redirect()->route('students.index')->with('success', 'Student record updated.');
    }

    public function destroy(Student $student)
    {
        $userId = $this->requireAuthenticatedUser();
        $settings = $this->getSettings($userId);
        $ownedStudent = Student::where('user_id', $userId)->findOrFail($student->id);

        $name = $ownedStudent->name;
        $studentId = $ownedStudent->student_id;
        $ownedStudent->delete();

        $this->logAction(
            $userId,
            "Deleted student: {$name} ({$studentId})",
            null,
            $settings
        );

        return redirect()->route('students.index')->with('success', 'Student record deleted.');
    }

    public function updateSettings(Request $request)
    {
        $userId = $this->requireAuthenticatedUser();
        $current = $this->getSettings($userId);

        $validated = $request->validate([
            'workspace_name' => 'required|string|max:255',
            'student_id_prefix' => 'nullable|string|max:32',
            'gpa_scale' => 'required|in:3.00,4.00,3,4',
            'academic_term' => 'required|string|max:255',
        ]);

        $prefix = trim((string) ($validated['student_id_prefix'] ?? 'STU-'));
        if ($prefix === '') {
            $prefix = 'STU-';
        }

        $scale = (float) $validated['gpa_scale'] >= 4.0 ? 4.00 : 3.00;
        $dataIntegrity = $request->has('data_integrity');
        $auditTelemetry = $request->has('audit_telemetry');

        if (Schema::hasTable('workspace_settings')) {
            WorkspaceSetting::updateOrCreate(
                ['user_id' => $userId],
                [
                    'workspace_name' => $validated['workspace_name'],
                    'student_id_prefix' => $prefix,
                    'gpa_scale' => $scale,
                    'academic_term' => $validated['academic_term'],
                    'data_integrity' => $dataIntegrity,
                    'audit_telemetry' => $auditTelemetry,
                ]
            );
        }

        if (Schema::hasTable('users') && Schema::hasColumn('users', 'workspace_name')) {
            User::where('id', $userId)->update(['workspace_name' => $validated['workspace_name']]);
        }

        session([
            'workspace_name' => $validated['workspace_name'],
        ]);

        $updatedSettings = [
            'workspace_name' => $validated['workspace_name'],
            'student_id_prefix' => $prefix,
            'gpa_scale' => $scale,
            'academic_term' => $validated['academic_term'],
            'data_integrity' => $dataIntegrity,
            'audit_telemetry' => $auditTelemetry,
        ];

        $this->logAction(
            $userId,
            'Updated workspace settings',
            "Workspace: {$prefix}, Scale: {$scale}, Term: {$validated['academic_term']}",
            $updatedSettings
        );

        return back()->with('success', 'Workspace settings saved.');
    }

    public function exportCsv()
    {
        $userId = $this->requireAuthenticatedUser();
        $settings = $this->getSettings($userId);
        $students = Student::where('user_id', $userId)->orderBy('student_id')->get();

        $this->logAction($userId, 'Exported student records CSV', "Rows exported: {$students->count()}", $settings);

        $filename = 'students-export-' . now()->format('Y-m-d') . '.csv';

        return response()->streamDownload(function () use ($students) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['Student ID', 'Full Name', 'Course', 'GPA']);

            foreach ($students as $student) {
                fputcsv($handle, [
                    $student->student_id,
                    $student->name,
                    $student->course,
                    number_format((float) $student->gpa, 2),
                ]);
            }

            fclose($handle);
        }, $filename, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use App\Models\Student;
use App\Models\User;
use App\Models\WorkspaceSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    private function requireAuthenticatedUser()
    {
        $userId = session('user_id');

        if (!$userId) {
            $cookieValue = request()->cookie('educore_remember');
            if ($cookieValue && str_contains($cookieValue, '|')) {
                [$cookieUserId, $plainToken] = explode('|', $cookieValue, 2);
                $user = User::find($cookieUserId);
                if ($user && $user->remember_token && hash_equals($user->remember_token, hash('sha256', $plainToken))) {
                    $settings = Schema::hasTable('workspace_settings')
                        ? WorkspaceSetting::where('user_id', $user->id)->first()
                        : null;

                    session([
                        'user_id'        => $user->id,
                        'workspace_name' => $settings->workspace_name ?? ($user->workspace_name ?? 'EduCore Workspace'),
                        'admin_name'     => $user->admin_name ?? $user->name,
                    ]);

                    return $user->id;
                }
            }

            abort(redirect()->route('login'));
        }

        return $userId;
    }

    private function getSettings($userId): array
    {
        $fallbackWorkspace = session('workspace_name', 'EduCore Workspace');

        if (!Schema::hasTable('workspace_settings')) {
            return [
                'workspace_name'    => $fallbackWorkspace,
                'student_id_prefix' => 'STU-',
                'gpa_scale'         => 3.00,
                'academic_term'     => '1st Semester AY 2026-2027',
                'data_integrity'    => true,
                'audit_telemetry'   => true,
            ];
        }

        $record = WorkspaceSetting::firstOrCreate(
            ['user_id' => $userId],
            [
                'workspace_name'    => $fallbackWorkspace,
                'student_id_prefix' => 'STU-',
                'gpa_scale'         => 3.00,
                'academic_term'     => '1st Semester AY 2026-2027',
                'data_integrity'    => true,
                'audit_telemetry'   => true,
            ]
        );

        session(['workspace_name' => $record->workspace_name]);

        return [
            'workspace_name'    => $record->workspace_name ?: $fallbackWorkspace,
            'student_id_prefix' => $record->student_id_prefix ?: 'STU-',
            'gpa_scale'         => (float) ($record->gpa_scale ?: 3.00),
            'academic_term'     => $record->academic_term ?: '1st Semester AY 2026-2027',
            'data_integrity'    => (bool) $record->data_integrity,
            'audit_telemetry'   => (bool) $record->audit_telemetry,
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
                $payload = [];
                if (Schema::hasColumn('audit_logs', 'user_id')) {
                    $payload['user_id'] = $userId;
                }
                if (Schema::hasColumn('audit_logs', 'actor_name')) {
                    $payload['actor_name'] = session('admin_name', 'Administrator');
                }
                if (Schema::hasColumn('audit_logs', 'event')) {
                    $payload['event'] = $event;
                } elseif (Schema::hasColumn('audit_logs', 'action')) {
                    $payload['action'] = $event;
                }
                if (Schema::hasColumn('audit_logs', 'meta') && $meta !== null) {
                    $payload['meta'] = $meta;
                } elseif (Schema::hasColumn('audit_logs', 'description') && $meta !== null) {
                    $payload['description'] = $meta;
                }
                if (Schema::hasColumn('audit_logs', 'created_at')) {
                    $payload['created_at'] = now();
                }
                if (Schema::hasColumn('audit_logs', 'updated_at')) {
                    $payload['updated_at'] = now();
                }

                if (!empty($payload)) {
                    DB::table('audit_logs')->insert($payload);
                }
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

    private function normalizePrefix(string $prefix): string
    {
        $letters = preg_replace('/[^A-Za-z]/', '', strtoupper(trim($prefix))) ?? '';
        if ($letters === '') {
            $letters = 'STU';
        }
        return substr($letters, 0, 12) . '-';
    }

    private function extractPrefixLetters(string $studentId): string
    {
        if (preg_match('/^([A-Za-z]+)/', trim($studentId), $matches)) {
            return strtoupper($matches[1]);
        }
        return '';
    }

    private function extractNumericSuffix(string $studentId): string
    {
        if (preg_match('/(\d+)\s*$/', trim($studentId), $matches)) {
            return $matches[1];
        }
        return '0001';
    }

    private function nextStudentId($userId, string $prefix): string
    {
        $cleanPrefix = $this->normalizePrefix($prefix);
        $records = Student::where('user_id', $userId)->pluck('student_id');
        $maxNum = 0;

        foreach ($records as $existingId) {
            if (preg_match('/(\d+)\s*$/', (string) $existingId, $matches)) {
                $num = (int) $matches[1];
                if ($num > $maxNum) {
                    $maxNum = $num;
                }
            }
        }

        $nextNumber = $maxNum + 1;
        return $cleanPrefix . str_pad((string) $nextNumber, 4, '0', STR_PAD_LEFT);
    }

    private function sanitizeGpaInput($rawGpa): string
    {
        $stripped = preg_replace('/[^0-9.]/', '', (string) $rawGpa) ?? '';
        $parts = explode('.', $stripped);
        if (count($parts) > 2) {
            $stripped = array_shift($parts) . '.' . implode('', $parts);
        }
        return $stripped;
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
        $nextStudentId = $this->nextStudentId($userId, $settings['student_id_prefix']);

        return $this->resolveView(
            ['students.directory', 'directory'],
            compact('students', 'totalStudents', 'averageGpa', 'activeCoursesCount', 'settings', 'nextStudentId')
        );
    }

    public function gpaAnalytics()
    {
        $userId = $this->requireAuthenticatedUser();
        $settings = $this->getSettings($userId);
        $students = Student::where('user_id', $userId)->orderBy('student_id')->get();
        $totalStudents = $students->count();
        $averageGpa = $students->avg('gpa') ?? 0;
        $activeCoursesCount = $this->computeActiveCoursesCount($userId);

        return $this->resolveView(
            ['students.gpa', 'gpa'],
            compact('students', 'totalStudents', 'averageGpa', 'activeCoursesCount', 'settings')
        );
    }

    public function courses()
    {
        $userId = $this->requireAuthenticatedUser();
        $settings = $this->getSettings($userId);
        $students = Student::where('user_id', $userId)->get();
        $totalStudents = $students->count();
        $averageGpa = $students->avg('gpa') ?? 0;
        $activeCoursesCount = $this->computeActiveCoursesCount($userId);

        $courses = Student::where('user_id', $userId)
            ->whereNotNull('course')
            ->where('course', '!=', '')
            ->select('course', DB::raw('COUNT(*) as student_count'), DB::raw('AVG(gpa) as avg_gpa'))
            ->groupBy('course')
            ->orderBy('course')
            ->get();

        return $this->resolveView(
            ['students.courses', 'courses'],
            compact('courses', 'students', 'totalStudents', 'averageGpa', 'activeCoursesCount', 'settings')
        );
    }

    public function renameCourse(Request $request)
    {
        $userId = $this->requireAuthenticatedUser();
        $settings = $this->getSettings($userId);

        $validated = $request->validate([
            'old_course' => ['required', 'string', 'max:255'],
            'new_course' => ['required', 'string', 'max:255'],
        ]);

        $oldName = trim($validated['old_course']);
        $newName = trim($validated['new_course']);

        Student::where('user_id', $userId)
            ->where('course', $oldName)
            ->update(['course' => $newName]);

        $this->logAction($userId, "Renamed course: {$oldName} -> {$newName}", null, $settings);

        return back()->with('success', 'Course updated.');
    }

    public function deleteCourse(Request $request)
    {
        $userId = $this->requireAuthenticatedUser();
        $settings = $this->getSettings($userId);

        $validated = $request->validate([
            'course' => ['required', 'string', 'max:255'],
        ]);

        $courseName = trim($validated['course']);

        Student::where('user_id', $userId)
            ->where('course', $courseName)
            ->update(['course' => null]);

        $this->logAction($userId, "Removed course: {$courseName}", null, $settings);

        return back()->with('success', 'Course removed.');
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

        if (view()->exists('settings')) {
            return view('settings', compact('students', 'totalStudents', 'averageGpa', 'activeCoursesCount', 'settings'));
        }

        return view('students.settings', compact('students', 'totalStudents', 'averageGpa', 'activeCoursesCount', 'settings'));
    }

    public function store(Request $request)
    {
        $userId = $this->requireAuthenticatedUser();
        $settings = $this->getSettings($userId);

        $cleanedGpa = $this->sanitizeGpaInput($request->input('gpa'));
        $request->merge([
            'gpa'        => $cleanedGpa,
            'student_id' => trim((string) $request->input('student_id')),
            'course'     => trim((string) $request->input('course')),
        ]);

        $maxGpa = (float) $settings['gpa_scale'];
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
            'name'   => ['required', 'string', 'max:255'],
            'course' => ['required', 'string', 'max:255'],
            'gpa'    => ['required', 'numeric', "between:{$minGpa},{$maxGpa}"],
        ], [
            'student_id.unique' => 'That Student ID already exists in your workspace.',
            'gpa.between'       => "GPA must be between {$minGpa} and {$maxGpa} based on your active scale.",
        ]);

        $validated['user_id'] = $userId;
        $student = Student::create($validated);

        $this->logAction(
            $userId,
            "Added new student: {$student->name} ({$student->student_id})",
            'Course: ' . $student->course . ', GPA: ' . number_format((float) $student->gpa, 2),
            $settings
        );

        return redirect()->route('students.index')->with('success', 'Student record saved.');
    }

    public function update(Request $request, Student $student)
    {
        $userId = $this->requireAuthenticatedUser();
        $settings = $this->getSettings($userId);
        $ownedStudent = Student::where('user_id', $userId)->findOrFail($student->id);

        $cleanedGpa = $this->sanitizeGpaInput($request->input('gpa'));
        $permanentPrefix = $this->extractPrefixLetters((string) $ownedStudent->student_id)
            ?: rtrim($this->normalizePrefix((string) $settings['student_id_prefix']), '-');
        $numericPart = $this->extractNumericSuffix((string) $request->input('student_id', $ownedStudent->student_id));
        $lockedStudentId = $permanentPrefix . '-' . $numericPart;

        $request->merge([
            'gpa'        => $cleanedGpa,
            'student_id' => $lockedStudentId,
            'course'     => trim((string) $request->input('course')),
        ]);

        $maxGpa = (float) $settings['gpa_scale'];
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
            'name'   => ['required', 'string', 'max:255'],
            'course' => ['required', 'string', 'max:255'],
            'gpa'    => ['required', 'numeric', "between:{$minGpa},{$maxGpa}"],
        ], [
            'student_id.unique' => 'That Student ID already exists in your workspace.',
            'gpa.between'       => "GPA must be between {$minGpa} and {$maxGpa} based on your active scale.",
        ]);

        $ownedStudent->update([
            'user_id'    => $userId,
            'student_id' => $validated['student_id'],
            'name'       => $validated['name'],
            'course'     => $validated['course'],
            'gpa'        => $validated['gpa'],
        ]);

        $this->logAction(
            $userId,
            "Updated student: {$ownedStudent->name} ({$ownedStudent->student_id})",
            'Course: ' . $ownedStudent->course . ', GPA: ' . number_format((float) $ownedStudent->gpa, 2),
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

        $this->logAction($userId, "Deleted student: {$name} ({$studentId})", null, $settings);

        return redirect()->route('students.index')->with('success', 'Student record deleted.');
    }

    public function updateSettings(Request $request)
    {
        $userId = $this->requireAuthenticatedUser();
        $current = $this->getSettings($userId);

        $validated = $request->validate([
            'workspace_name'    => ['required', 'string', 'max:255'],
            'student_id_prefix' => ['nullable', 'string', 'max:32'],
            'gpa_scale'         => ['required', 'in:3.00,4.00,5.00,3,4,5'],
            'academic_term'     => ['required', 'string', 'max:255'],
        ]);

        $prefix = $this->normalizePrefix((string) ($validated['student_id_prefix'] ?? 'STU-'));
        $rawScale = (float) $validated['gpa_scale'];
        $scale = $rawScale >= 5.0 ? 5.00 : ($rawScale >= 4.0 ? 4.00 : 3.00);
        $dataIntegrity = $request->has('data_integrity');
        $auditTelemetry = $request->has('audit_telemetry');

        if (Schema::hasTable('workspace_settings')) {
            WorkspaceSetting::updateOrCreate(
                ['user_id' => $userId],
                [
                    'workspace_name'    => $validated['workspace_name'],
                    'student_id_prefix' => $prefix,
                    'gpa_scale'         => $scale,
                    'academic_term'     => $validated['academic_term'],
                    'data_integrity'    => $dataIntegrity,
                    'audit_telemetry'   => $auditTelemetry,
                ]
            );
        }

        if (Schema::hasTable('users') && Schema::hasColumn('users', 'workspace_name')) {
            User::where('id', $userId)->update(['workspace_name' => $validated['workspace_name']]);
        }

        session(['workspace_name' => $validated['workspace_name']]);

        $updatedSettings = [
            'workspace_name'    => $validated['workspace_name'],
            'student_id_prefix' => $prefix,
            'gpa_scale'         => $scale,
            'academic_term'     => $validated['academic_term'],
            'data_integrity'    => $dataIntegrity,
            'audit_telemetry'   => $auditTelemetry,
        ];

        $this->logAction(
            $userId,
            'Updated workspace settings',
            "Workspace: {$validated['workspace_name']}, Prefix: {$prefix}, Scale: {$scale}, Term: {$validated['academic_term']}",
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
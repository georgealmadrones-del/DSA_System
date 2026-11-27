<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduCore SaaS Workspace Settings</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        charcoal: '#4A4A4A',
                        coolgrey: '#CBCBCB',
                        ivory: '#FFFFE3',
                        slateblue: '#6D8196',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-[#FCFBF7] text-charcoal font-sans antialiased h-screen overflow-hidden flex selection:bg-slateblue/20">
    @php
        $currentWorkspaceName = $settings['workspace_name'] ?? session('workspace_name', 'EduCore Workspace');
        $currentTerm = $settings['academic_term'] ?? '1st Semester AY 2026-2027';
        $currentScale = number_format((float) ($settings['gpa_scale'] ?? 3.00), 2);
        $currentPrefix = $settings['student_id_prefix'] ?? 'STU-';
        $dataIntegrityOn = !empty($settings['data_integrity']);
        $auditTelemetryOn = !empty($settings['audit_telemetry']);
        $termOptions = [
            '1st Semester AY 2026-2027',
            '2nd Semester AY 2026-2027',
            'Midyear / Summer 2027',
            'Fall 2026-2027',
            'Spring 2027',
        ];
    @endphp

    <!-- Fixed Left Sidebar Navigation -->
    <aside class="w-64 h-full bg-[#FFFEEB]/80 backdrop-blur-md border-r border-coolgrey/30 flex-col justify-between hidden md:flex shrink-0 shadow-lg">
        <div>
            <div class="p-6 border-b border-coolgrey/20 flex items-center space-x-3">
                <div class="w-8 h-8 rounded-xl bg-charcoal flex items-center justify-center text-white shadow-md">
                    <div class="grid grid-cols-2 gap-0.5">
                        <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                        <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                        <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                        <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                    </div>
                </div>
                <span class="font-extrabold text-sm tracking-tight text-charcoal">EduCore SaaS</span>
            </div>

            <div class="p-4">
                <div class="p-3 bg-white rounded-2xl border border-coolgrey/30 flex items-center justify-between text-xs shadow-sm">
                    <div class="flex items-center space-x-2.5">
                        <div class="w-7 h-7 rounded-xl bg-gray-50 border border-coolgrey/30 flex items-center justify-center font-bold text-[10px] text-charcoal">EA</div>
                        <div>
                            <p class="font-bold text-charcoal leading-tight">{{ $currentWorkspaceName }}</p>
                            <p class="text-[10px] text-slateblue font-medium mt-0.5">Academic workspace</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="px-4 py-2">
                <p class="px-3 text-[10px] font-bold uppercase tracking-wider text-slateblue/70 mb-2">Workspace</p>
                <nav class="space-y-1">
                    <a href="{{ route('students.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-2xl text-charcoal/70 hover:bg-white/60 text-xs font-semibold transition">
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('students.directory') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-2xl text-charcoal/70 hover:bg-white/60 text-xs font-semibold transition">
                        <span>Student Directory</span>
                    </a>
                    <a href="{{ route('actions') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-2xl text-charcoal/70 hover:bg-white/60 text-xs font-semibold transition">
                        <span>Actions Log</span>
                    </a>
                </nav>
            </div>
        </div>

        <div class="p-4 border-t border-coolgrey/20 space-y-4">
            <div class="px-2">
                <p class="px-3 text-[10px] font-bold uppercase tracking-wider text-slateblue/70 mb-1">Manage</p>
                <a href="{{ route('settings') }}" class="flex items-center space-x-3 px-3 py-2 rounded-2xl bg-white text-charcoal font-bold text-xs border border-coolgrey/30 shadow-md">
                    <span>Settings</span>
                </a>
            </div>

            <div class="flex items-center justify-between p-3 bg-white border border-coolgrey/30 rounded-2xl shadow-md">
                <div onclick="document.getElementById('profileModal').classList.remove('hidden')" class="flex items-center space-x-3 cursor-pointer min-w-0 flex-1">
                    <div class="w-8 h-8 rounded-full bg-slateblue/20 text-slateblue font-bold flex items-center justify-center text-xs shrink-0">
                        {{ strtoupper(substr(session('admin_name', 'Alex Davis'), 0, 2)) }}
                    </div>
                    <div class="min-w-0">
                        <p class="text-xs font-bold text-charcoal truncate">{{ session('admin_name', 'Alex Davis') }}</p>
                        <p class="text-[10px] text-slateblue font-medium truncate">Administrator</p>
                    </div>
                </div>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" title="Log Out" class="p-1.5 text-gray-400 hover:text-rose-600 hover:bg-rose-50 rounded-xl transition shrink-0 ml-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Scrollable Right Main Content Wrapper -->
    <main class="flex-1 h-full flex flex-col min-w-0 overflow-hidden">
        <header class="bg-[#FCFBF7] border-b border-coolgrey/20 h-16 flex items-center justify-between px-8 shrink-0 shadow-sm">
            <div class="text-xs text-slateblue font-medium">Manage / <span class="text-charcoal font-semibold">Settings</span></div>
            <div class="flex items-center space-x-3">
                <div onclick="document.getElementById('profileModal').classList.remove('hidden')" class="w-8 h-8 rounded-xl bg-charcoal text-white font-bold text-xs flex items-center justify-center shadow-md cursor-pointer">
                    {{ strtoupper(substr(session('admin_name', 'Alex Davis'), 0, 2)) }}
                </div>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto p-6 md:p-8 space-y-6 max-w-5xl">
            <div>
                <h1 class="text-2xl font-extrabold tracking-tight text-charcoal">Workspace Settings</h1>
                <p class="text-xs text-slateblue mt-0.5">Configure academic parameters, validation rules, and system maintenance preferences.</p>
            </div>

            @if (session('success'))
                <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-bold rounded-2xl shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="p-4 bg-rose-50 border border-rose-200 text-rose-700 text-xs rounded-2xl shadow-sm">
                    <ul class="list-disc pl-4 space-y-0.5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('settings.update') }}" method="POST" class="bg-white rounded-3xl border border-coolgrey/20 shadow-md p-8 space-y-8">
                @csrf

                <!-- General Configuration -->
                <div>
                    <h3 class="text-xs font-bold text-charcoal uppercase tracking-wider mb-4">General Configuration</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-[11px] font-bold text-slateblue uppercase tracking-wider mb-1">Workspace Name</label>
                            <input type="text" name="workspace_name" value="{{ old('workspace_name', $currentWorkspaceName) }}" required class="w-full px-3.5 py-2.5 bg-gray-50 border border-coolgrey/30 rounded-xl text-xs shadow-inner focus:outline-none focus:ring-2 focus:ring-slateblue/50">
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-slateblue uppercase tracking-wider mb-1">Active Term / Academic Year</label>
                            <select name="academic_term" class="w-full px-3.5 py-2.5 bg-gray-50 border border-coolgrey/30 rounded-xl text-xs text-charcoal font-medium shadow-inner focus:outline-none">
                                @if (!in_array($currentTerm, $termOptions, true))
                                    <option value="{{ $currentTerm }}" selected>{{ $currentTerm }}</option>
                                @endif
                                @foreach ($termOptions as $termOption)
                                    <option value="{{ $termOption }}" {{ old('academic_term', $currentTerm) === $termOption ? 'selected' : '' }}>
                                        {{ $termOption }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Grading & Analytics Scale -->
                <div class="pt-6 border-t border-coolgrey/10">
                    <h3 class="text-xs font-bold text-charcoal uppercase tracking-wider mb-4">Grading & Analytics Scale</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-[11px] font-bold text-slateblue uppercase tracking-wider mb-1">GPA Scale System</label>
                            <select name="gpa_scale" class="w-full px-3.5 py-2.5 bg-gray-50 border border-coolgrey/30 rounded-xl text-xs text-charcoal font-medium shadow-inner focus:outline-none">
                                <option value="3.00" {{ old('gpa_scale', $currentScale) === '3.00' ? 'selected' : '' }}>3.00 Scale</option>
                                <option value="4.00" {{ old('gpa_scale', $currentScale) === '4.00' ? 'selected' : '' }}>4.00 Scale</option>
                                <option value="5.00" {{ old('gpa_scale', $currentScale) === '5.00' ? 'selected' : '' }}>5.00 Scale</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-slateblue uppercase tracking-wider mb-1">Default Student ID Prefix</label>
                            <input type="text" name="student_id_prefix" value="{{ old('student_id_prefix', $currentPrefix) }}" required class="w-full px-3.5 py-2.5 bg-gray-50 border border-coolgrey/30 rounded-xl text-xs shadow-inner focus:outline-none focus:ring-2 focus:ring-slateblue/50">
                        </div>
                    </div>
                </div>

                <!-- Data Integrity & Validation -->
                <div class="pt-6 border-t border-coolgrey/10">
                    <h3 class="text-xs font-bold text-charcoal uppercase tracking-wider mb-4">Data Integrity & Validation</h3>
                    <div class="space-y-4">
                        <label class="flex items-start space-x-3 cursor-pointer">
                            <input type="checkbox" name="data_integrity" value="1" {{ old('data_integrity', $dataIntegrityOn) ? 'checked' : '' }} class="mt-0.5 rounded border-coolgrey/40 text-charcoal focus:ring-slateblue/50">
                            <div>
                                <p class="text-xs font-bold text-charcoal">Strict Duplicate Record & GPA Integrity</p>
                                <p class="text-[11px] text-slateblue">Enforce unique student IDs per workspace and validate GPA bounds.</p>
                            </div>
                        </label>
                        <label class="flex items-start space-x-3 cursor-pointer">
                            <input type="checkbox" name="audit_telemetry" value="1" {{ old('audit_telemetry', $auditTelemetryOn) ? 'checked' : '' }} class="mt-0.5 rounded border-coolgrey/40 text-charcoal focus:ring-slateblue/50">
                            <div>
                                <p class="text-xs font-bold text-charcoal">Automated Audit Telemetry Logging</p>
                                <p class="text-[11px] text-slateblue">Record all CRUD executions and settings updates in the Audit Logs.</p>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Data Maintenance (Export CSV) -->
                <div class="pt-6 border-t border-coolgrey/10 flex items-center justify-between">
                    <div>
                        <h3 class="text-xs font-bold text-charcoal uppercase tracking-wider">Data Maintenance</h3>
                        <p class="text-[11px] text-slateblue mt-0.5">Export active student records as a formatted CSV report.</p>
                    </div>
                    <a href="{{ Route::has('settings.export.csv') ? route('settings.export.csv') : url('/settings/export-csv') }}" class="px-4 py-2 bg-gray-50 hover:bg-gray-100 border border-coolgrey/30 rounded-xl text-xs font-semibold text-charcoal transition shadow-sm">
                        Export CSV
                    </a>
                </div>

                <!-- Save Changes -->
                <div class="pt-6 border-t border-coolgrey/10 flex justify-end">
                    <button type="submit" class="px-6 py-3 bg-charcoal text-white rounded-xl text-xs font-bold hover:bg-charcoal/90 transition shadow-md">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </main>

    <!-- Admin Profile Modal -->
    <div id="profileModal" class="fixed inset-0 bg-charcoal/50 backdrop-blur-sm hidden flex items-center justify-center p-4 z-50">
        <div class="bg-white rounded-3xl max-w-md w-full p-6 shadow-2xl border border-coolgrey/20 space-y-4">
            <div class="flex justify-between items-center">
                <h3 class="text-base font-bold text-charcoal">Admin Profile & Session</h3>
                <button type="button" onclick="document.getElementById('profileModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600 text-sm font-bold">X</button>
            </div>
            <div class="flex items-center space-x-4 p-4 bg-gray-50 rounded-2xl border border-coolgrey/20">
                <div class="w-12 h-12 rounded-full bg-slateblue/20 text-slateblue font-bold flex items-center justify-center text-sm">
                    {{ strtoupper(substr(session('admin_name', 'Alex Davis'), 0, 2)) }}
                </div>
                <div>
                    <p class="text-sm font-bold text-charcoal">{{ session('admin_name', 'Alex Davis') }}</p>
                    <p class="text-xs text-slateblue">Administrator</p>
                    <span class="inline-block mt-1 px-2 py-0.5 bg-emerald-100 text-emerald-800 text-[10px] font-bold rounded-full">System Administrator</span>
                </div>
            </div>
            <div class="flex items-center justify-between pt-2 border-t border-coolgrey/10">
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-rose-50 hover:bg-rose-100 text-rose-600 rounded-xl text-xs font-bold transition flex items-center space-x-1.5 shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        <span>Log Out</span>
                    </button>
                </form>
                <button type="button" onclick="document.getElementById('profileModal').classList.add('hidden')" class="px-4 py-2 bg-gray-100 text-charcoal rounded-xl text-xs font-semibold shadow-sm">Close</button>
            </div>
        </div>
    </div>
</body>
</html>
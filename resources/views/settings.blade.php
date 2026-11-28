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
                        nordic: '#2C6B8E',
                        pine: '#718082',
                        sage: '#A3B2B1',
                        glacier: '#ADC6D6',
                        frost: '#E8ECF1',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-frost text-pine font-sans antialiased h-screen overflow-hidden flex selection:bg-glacier/40">
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

    <!-- Fixed Left Sidebar Navigation (No snow) -->
    <aside class="w-64 h-full bg-[#DCE5EE]/90 border-r border-glacier flex-col justify-between hidden md:flex shrink-0 shadow-sm z-20">
        <div>
            <div class="p-6 border-b border-glacier/70 flex items-center space-x-3">
                <div class="w-8 h-8 rounded-xl bg-nordic flex items-center justify-center text-white shadow-sm">
                    <div class="grid grid-cols-2 gap-0.5">
                        <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                        <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                        <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                        <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                    </div>
                </div>
                <span class="font-extrabold text-sm tracking-tight text-nordic">EduCore SaaS</span>
            </div>

            <div class="p-4">
                <div class="p-3 bg-white/95 rounded-2xl border border-glacier flex items-center justify-between text-xs shadow-sm">
                    <div class="flex items-center space-x-2.5">
                        <div class="w-7 h-7 rounded-xl bg-frost border border-glacier flex items-center justify-center font-bold text-[10px] text-nordic">EA</div>
                        <div>
                            <p class="font-bold text-nordic leading-tight">{{ $currentWorkspaceName }}</p>
                            <p class="text-[10px] text-pine font-medium mt-0.5">Academic workspace</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="px-4 py-2">
                <p class="px-3 text-[10px] font-bold uppercase tracking-wider text-pine mb-2">Workspace</p>
                <nav class="space-y-1">
                    <a href="{{ route('students.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-2xl text-pine hover:bg-white/70 text-xs font-semibold transition">
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('students.directory') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-2xl text-pine hover:bg-white/70 text-xs font-semibold transition">
                        <span>Student Directory</span>
                    </a>
                    <a href="{{ route('actions') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-2xl text-pine hover:bg-white/70 text-xs font-semibold transition">
                        <span>Actions Log</span>
                    </a>
                </nav>
            </div>
        </div>

        <div class="p-4 border-t border-glacier/70 space-y-4">
            <div class="px-2">
                <p class="px-3 text-[10px] font-bold uppercase tracking-wider text-pine mb-1">Manage</p>
                <a href="{{ route('settings') }}" class="flex items-center space-x-3 px-3 py-2 rounded-2xl bg-white text-nordic font-bold text-xs border border-glacier shadow-sm">
                    <span>Settings</span>
                </a>
            </div>

            <div class="flex items-center justify-between p-3 bg-white/95 border border-glacier rounded-2xl shadow-sm">
                <div onclick="document.getElementById('profileModal').classList.remove('hidden')" class="flex items-center space-x-3 cursor-pointer min-w-0 flex-1">
                    <div class="w-8 h-8 rounded-full bg-glacier/40 text-nordic font-bold flex items-center justify-center text-xs shrink-0">
                        {{ strtoupper(substr(session('admin_name', 'Alex Davis'), 0, 2)) }}
                    </div>
                    <div class="min-w-0">
                        <p class="text-xs font-bold text-nordic truncate">{{ session('admin_name', 'Alex Davis') }}</p>
                        <p class="text-[10px] text-pine font-medium truncate">Administrator</p>
                    </div>
                </div>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" title="Log Out" class="p-1.5 text-pine hover:text-rose-600 hover:bg-rose-50 rounded-xl transition shrink-0 ml-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Scrollable Right Main Content Wrapper (Snow only inside right panel) -->
    <main class="relative flex-1 h-full flex flex-col min-w-0 overflow-hidden bg-frost">
        <canvas id="rightPanelSnow" class="pointer-events-none absolute inset-0 w-full h-full z-0"></canvas>

        <header class="relative z-10 bg-[#F2F6FA]/90 border-b border-glacier/70 h-16 flex items-center justify-between px-8 shrink-0">
            <div class="text-xs text-pine font-medium">Manage / <span class="text-nordic font-semibold">Settings</span></div>
            <div class="flex items-center space-x-3">
                <div onclick="document.getElementById('profileModal').classList.remove('hidden')" class="w-8 h-8 rounded-xl bg-nordic text-white font-bold text-xs flex items-center justify-center shadow-sm cursor-pointer">
                    {{ strtoupper(substr(session('admin_name', 'Alex Davis'), 0, 2)) }}
                </div>
            </div>
        </header>

        <div class="relative z-10 flex-1 overflow-y-auto p-6 md:p-8 space-y-6 max-w-5xl">
            <div>
                <h1 class="text-2xl font-extrabold tracking-tight text-nordic">Workspace Settings</h1>
                <p class="text-xs text-pine mt-0.5">Configure academic parameters, validation rules, and system maintenance preferences.</p>
            </div>

            @if (session('success'))
                <div class="p-4 bg-white/95 border border-glacier text-nordic text-xs font-bold rounded-2xl shadow-sm">
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

            <form action="{{ route('settings.update') }}" method="POST" class="bg-white/95 rounded-3xl border border-glacier shadow-sm p-8 space-y-8">
                @csrf

                <div>
                    <h3 class="text-xs font-bold text-nordic uppercase tracking-wider mb-4">General Configuration</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-[11px] font-bold text-pine uppercase tracking-wider mb-1">Workspace Name</label>
                            <input type="text" name="workspace_name" value="{{ old('workspace_name', $currentWorkspaceName) }}" required class="w-full px-3.5 py-2.5 bg-frost/70 border border-glacier rounded-xl text-xs text-nordic shadow-inner focus:outline-none focus:ring-2 focus:ring-nordic/40">
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold text-pine uppercase tracking-wider mb-1">Active Term / Academic Year</label>
                            <select name="academic_term" class="w-full px-3.5 py-2.5 bg-frost/70 border border-glacier rounded-xl text-xs text-nordic font-medium shadow-inner focus:outline-none">
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

                <div class="pt-6 border-t border-glacier/60">
                    <h3 class="text-xs font-bold text-nordic uppercase tracking-wider mb-4">Grading &amp; Analytics Scale</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-[11px] font-bold text-pine uppercase tracking-wider mb-1">GPA Scale System</label>
                            <select name="gpa_scale" class="w-full px-3.5 py-2.5 bg-frost/70 border border-glacier rounded-xl text-xs text-nordic font-medium shadow-inner focus:outline-none">
                                <option value="3.00" {{ old('gpa_scale', $currentScale) === '3.00' ? 'selected' : '' }}>3.00 Scale</option>
                                <option value="4.00" {{ old('gpa_scale', $currentScale) === '4.00' ? 'selected' : '' }}>4.00 Scale</option>
                                <option value="5.00" {{ old('gpa_scale', $currentScale) === '5.00' ? 'selected' : '' }}>5.00 Scale</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold text-pine uppercase tracking-wider mb-1">Default Student ID Prefix</label>
                            <input type="text" name="student_id_prefix" value="{{ old('student_id_prefix', $currentPrefix) }}" required class="w-full px-3.5 py-2.5 bg-frost/70 border border-glacier rounded-xl text-xs text-nordic shadow-inner focus:outline-none focus:ring-2 focus:ring-nordic/40">
                        </div>
                    </div>
                </div>

                <div class="pt-6 border-t border-glacier/60">
                    <h3 class="text-xs font-bold text-nordic uppercase tracking-wider mb-4">Data Integrity &amp; Validation</h3>
                    <div class="space-y-4">
                        <label class="flex items-start space-x-3 cursor-pointer">
                            <input type="checkbox" name="data_integrity" value="1" {{ old('data_integrity', $dataIntegrityOn) ? 'checked' : '' }} class="mt-0.5 rounded border-glacier text-nordic focus:ring-nordic/40">
                            <div>
                                <p class="text-xs font-bold text-nordic">Strict Duplicate Record &amp; GPA Integrity</p>
                                <p class="text-[11px] text-pine">Enforce unique student IDs per workspace and validate GPA bounds.</p>
                            </div>
                        </label>

                        <label class="flex items-start space-x-3 cursor-pointer">
                            <input type="checkbox" name="audit_telemetry" value="1" {{ old('audit_telemetry', $auditTelemetryOn) ? 'checked' : '' }} class="mt-0.5 rounded border-glacier text-nordic focus:ring-nordic/40">
                            <div>
                                <p class="text-xs font-bold text-nordic">Automated Activity Telemetry Logging</p>
                                <p class="text-[11px] text-pine">Record CRUD executions and settings updates in the activity log.</p>
                            </div>
                        </label>
                    </div>
                </div>

                <div class="pt-6 border-t border-glacier/60 flex items-center justify-between">
                    <div>
                        <h3 class="text-xs font-bold text-nordic uppercase tracking-wider">Data Maintenance</h3>
                        <p class="text-[11px] text-pine mt-0.5">Export active student records as a formatted CSV report.</p>
                    </div>
                    <a href="{{ Route::has('settings.export.csv') ? route('settings.export.csv') : url('/settings/export-csv') }}" class="px-4 py-2 bg-frost hover:bg-glacier/40 border border-glacier rounded-xl text-xs font-semibold text-nordic transition shadow-sm">
                        Export CSV
                    </a>
                </div>

                <div class="pt-6 border-t border-glacier/60 flex justify-end">
                    <button type="submit" class="px-6 py-3 bg-nordic text-white rounded-xl text-xs font-bold hover:bg-[#235673] transition shadow-sm">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </main>

    <!-- Admin Profile Modal -->
    <div id="profileModal" class="fixed inset-0 bg-nordic/35 backdrop-blur-sm hidden flex items-center justify-center p-4 z-50">
        <div class="bg-white rounded-3xl max-w-md w-full p-6 shadow-xl border border-glacier space-y-4">
            <div class="flex justify-between items-center">
                <h3 class="text-base font-bold text-nordic">Admin Profile &amp; Session</h3>
                <button type="button" onclick="document.getElementById('profileModal').classList.add('hidden')" class="text-pine hover:text-nordic text-sm font-bold">X</button>
            </div>
            <div class="flex items-center space-x-4 p-4 bg-frost/70 rounded-2xl border border-glacier">
                <div class="w-12 h-12 rounded-full bg-glacier/50 text-nordic font-bold flex items-center justify-center text-sm">
                    {{ strtoupper(substr(session('admin_name', 'Alex Davis'), 0, 2)) }}
                </div>
                <div>
                    <p class="text-sm font-bold text-nordic">{{ session('admin_name', 'Alex Davis') }}</p>
                    <p class="text-xs text-pine">Administrator</p>
                    <span class="inline-block mt-1 px-2 py-0.5 bg-white border border-glacier text-nordic text-[10px] font-bold rounded-full">System Administrator</span>
                </div>
            </div>
            <div class="flex items-center justify-between pt-2 border-t border-glacier/60">
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-rose-50 text-rose-600 border border-rose-200 hover:bg-rose-100 rounded-xl text-xs font-bold transition flex items-center space-x-1.5 shadow-sm">
                        <span>Log Out</span>
                    </button>
                </form>
                <button type="button" onclick="document.getElementById('profileModal').classList.add('hidden')" class="px-4 py-2 bg-nordic text-white rounded-xl text-xs font-semibold shadow-sm">Close</button>
            </div>
        </div>
    </div>

    <script>
        (function initRightSnow() {
            const canvas = document.getElementById('rightPanelSnow');
            const panel = canvas ? canvas.parentElement : null;
            if (!canvas || !panel) return;
            const ctx = canvas.getContext('2d');
            let width = 0;
            let height = 0;
            const flakes = Array.from({ length: 34 }, () => ({
                x: Math.random() * 1200,
                y: Math.random() * 900,
                r: 1.3 + Math.random() * 2.2,
                vy: 0.35 + Math.random() * 0.65,
                vx: -0.25 + Math.random() * 0.5,
                alpha: 0.4 + Math.random() * 0.45,
            }));

            function resize() {
                width = canvas.width = panel.clientWidth;
                height = canvas.height = panel.clientHeight;
            }
            resize();
            window.addEventListener('resize', resize);

            function tick() {
                ctx.clearRect(0, 0, width, height);
                for (const f of flakes) {
                    f.x += f.vx;
                    f.y += f.vy;
                    if (f.y > height) {
                        f.y = -4;
                        f.x = Math.random() * width;
                    }
                    if (f.x < 0) f.x = width;
                    if (f.x > width) f.x = 0;

                    ctx.beginPath();
                    ctx.arc(f.x, f.y, f.r, 0, Math.PI * 2);
                    ctx.fillStyle = `rgba(255, 255, 255, ${f.alpha})`;
                    ctx.fill();
                }
                requestAnimationFrame(tick);
            }
            tick();
        })();
    </script>
</body>
</html>
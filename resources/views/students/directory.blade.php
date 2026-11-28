<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Directory — EduCore SaaS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        midnight: '#0B1A28',
                        deepnavy: '#102E47',
                        twilight: '#273B5C',
                        starlight: '#4572AB',
                        candlelight: '#DAA985',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-midnight text-slate-200 font-sans antialiased h-screen overflow-hidden flex selection:bg-candlelight/30 selection:text-candlelight">
    @php
        $gpaScale = number_format((float) ($settings['gpa_scale'] ?? 3.00), 2);
        $minGpaLabel = !empty($settings['data_integrity']) ? '1.00' : '0.00';
    @endphp

    <!-- Fixed Left Sidebar Navigation (No snow) -->
    <aside class="w-64 h-full bg-gradient-to-b from-deepnavy via-deepnavy/95 to-midnight border-r border-twilight flex-col justify-between hidden md:flex shrink-0 shadow-2xl z-20">
        <div>
            <div class="p-6 border-b border-twilight flex items-center space-x-3">
                <div class="w-8 h-8 rounded-xl bg-midnight border border-starlight/50 flex items-center justify-center text-candlelight shadow-md">
                    <div class="grid grid-cols-2 gap-0.5">
                        <span class="w-1.5 h-1.5 bg-candlelight rounded-full"></span>
                        <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                        <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                        <span class="w-1.5 h-1.5 bg-candlelight rounded-full"></span>
                    </div>
                </div>
                <span class="font-extrabold text-sm tracking-tight text-white">EduCore <span class="text-candlelight">SaaS</span></span>
            </div>

            <div class="p-4">
                <div class="p-3 bg-midnight/90 rounded-2xl border border-twilight flex items-center justify-between text-xs shadow-sm">
                    <div class="flex items-center space-x-2.5">
                        <div class="w-7 h-7 rounded-xl bg-deepnavy border border-starlight/40 flex items-center justify-center font-bold text-[10px] text-candlelight">EA</div>
                        <div>
                            <p class="font-bold text-white leading-tight">{{ $settings['workspace_name'] ?? session('workspace_name', 'EduCore Workspace') }}</p>
                            <p class="text-[10px] text-slate-400 font-medium mt-0.5">Records space</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="px-4 py-2">
                <p class="px-3 text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-2">Menu</p>
                <nav class="space-y-1">
                    <a href="{{ route('students.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-2xl text-slate-300 hover:bg-midnight/60 hover:text-white text-xs font-semibold transition">
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('students.directory') }}" class="flex items-center justify-between px-3 py-2.5 rounded-2xl bg-midnight text-candlelight font-bold text-xs border border-starlight/50 shadow-sm">
                        <span>Student Directory</span>
                        <span class="px-1.5 py-0.5 bg-deepnavy text-candlelight border border-twilight rounded-md text-[10px] font-bold">{{ $totalStudents ?? $students->count() }}</span>
                    </a>
                    <a href="{{ route('actions') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-2xl text-slate-300 hover:bg-midnight/60 hover:text-white text-xs font-semibold transition">
                        <span>Actions</span>
                    </a>
                </nav>
            </div>
        </div>

        <div class="p-4 border-t border-twilight space-y-4">
            <div class="px-2">
                <p class="px-3 text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1">Manage</p>
                <a href="{{ route('settings') }}" class="flex items-center space-x-3 px-3 py-2 rounded-2xl text-slate-300 hover:bg-midnight/60 hover:text-white text-xs font-semibold transition">
                    <span>Settings</span>
                </a>
            </div>

            <div class="flex items-center justify-between p-3 bg-midnight/90 border border-twilight rounded-2xl shadow-sm">
                <div onclick="document.getElementById('profileModal').classList.remove('hidden')" class="flex items-center space-x-3 cursor-pointer min-w-0 flex-1">
                    <div class="w-8 h-8 rounded-full bg-deepnavy border border-candlelight/40 text-candlelight font-bold flex items-center justify-center text-xs shrink-0">
                        {{ strtoupper(substr(session('admin_name', 'Alex Davis'), 0, 2)) }}
                    </div>
                    <div class="min-w-0">
                        <p class="text-xs font-bold text-white truncate">{{ session('admin_name', 'Alex Davis') }}</p>
                        <p class="text-[10px] text-slate-400 font-medium truncate">Administrator</p>
                    </div>
                </div>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" title="Log Out" class="p-1.5 text-slate-400 hover:text-rose-300 hover:bg-rose-950/50 rounded-xl transition shrink-0 ml-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Scrollable Right Content (Snow only inside right panel) -->
    <main class="relative flex-1 h-full flex flex-col min-w-0 overflow-hidden bg-midnight">
        <div class="pointer-events-none fixed inset-0 bg-[radial-gradient(ellipse_at_top,_rgba(69,114,171,0.22),_transparent_65%),radial-gradient(ellipse_at_bottom,_rgba(218,169,133,0.08),_transparent_60%)] z-0"></div>
        <canvas id="rightPanelSnow" class="pointer-events-none absolute inset-0 w-full h-full z-0"></canvas>

        <div class="pointer-events-none absolute inset-x-0 bottom-0 h-14 z-10 overflow-hidden">
            <svg class="w-full h-full" viewBox="0 0 1440 80" preserveAspectRatio="none" fill="none">
                <path d="M0 42C240 16 480 62 760 36C1020 12 1240 54 1440 28V80H0V42Z" fill="#273B5C" fill-opacity="0.45"/>
                <path d="M0 56C320 38 620 70 960 48C1180 34 1330 62 1440 50V80H0V56Z" fill="#E8F1F8" fill-opacity="0.1"/>
            </svg>
        </div>

        <header class="relative z-10 bg-midnight/90 backdrop-blur-md border-b border-twilight h-16 flex items-center justify-between px-8 shrink-0 shadow-md shadow-black/20">
            <div class="text-xs text-slate-400 font-medium">Records / <span class="text-candlelight font-semibold">Directory</span></div>
            <div onclick="document.getElementById('profileModal').classList.remove('hidden')" class="w-8 h-8 rounded-xl bg-candlelight text-midnight font-extrabold text-xs flex items-center justify-center shadow-md shadow-candlelight/15 cursor-pointer">
                {{ strtoupper(substr(session('admin_name', 'Alex Davis'), 0, 2)) }}
            </div>
        </header>

        <div class="relative z-10 flex-1 overflow-y-auto p-6 md:p-8 space-y-6 pb-16">
            @if (session('success'))
                <div class="p-4 bg-deepnavy/95 border border-starlight/50 rounded-2xl text-xs font-bold text-candlelight shadow-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="p-4 bg-rose-950/70 border border-rose-500/40 rounded-2xl text-xs text-rose-200 shadow-lg">
                    <ul class="list-disc pl-4 space-y-0.5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-gradient-to-r from-deepnavy/95 via-deepnavy/90 to-midnight/95 backdrop-blur-md rounded-3xl border border-twilight shadow-2xl shadow-black/30 p-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-xl font-extrabold text-white">Student directory</h1>
                    <p class="text-xs text-slate-300 mt-0.5">Browse everyone on the list, check details, or remove old entries.</p>
                </div>
                <div class="flex items-center gap-2">
                    <span id="selectedCountBadge" class="px-3 py-1.5 bg-midnight border border-twilight text-candlelight rounded-xl text-xs font-bold">0 selected</span>
                    <button type="button" id="bulkDeleteBtn" onclick="deleteSelectedStudents()" disabled class="px-3.5 py-2 bg-rose-950/60 text-rose-200 border border-rose-500/40 rounded-xl text-xs font-bold hover:bg-rose-900/70 transition disabled:opacity-40 disabled:cursor-not-allowed">
                        Delete selected
                    </button>
                </div>
            </div>

            <div class="bg-gradient-to-b from-deepnavy/95 to-midnight/95 backdrop-blur-md rounded-3xl border border-twilight shadow-2xl shadow-black/30 overflow-hidden">
                <div class="p-6 border-b border-twilight flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <h2 class="text-sm font-bold text-white">All students</h2>

                    <form method="GET" action="{{ route('students.directory') }}" class="flex flex-wrap items-center gap-2">
                        <input type="text" id="directorySearchInput" name="search" value="{{ request('search') }}" placeholder="Search ID, name, or course..." oninput="filterDirectoryRows()" class="px-3.5 py-2 bg-midnight/85 border border-twilight rounded-xl text-xs text-white placeholder-slate-400 shadow-inner focus:outline-none focus:ring-2 focus:ring-candlelight/40 w-64">
                        <button type="submit" class="px-4 py-2 bg-candlelight text-midnight rounded-xl text-xs font-extrabold hover:bg-[#e5ba99] transition shadow-md shadow-candlelight/15">
                            Search
                        </button>
                        @if (request()->filled('search'))
                            <a href="{{ route('students.directory') }}" class="px-3 py-2 bg-midnight text-slate-200 border border-twilight rounded-xl text-xs font-semibold hover:bg-twilight transition">
                                Clear
                            </a>
                        @endif
                    </form>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse text-xs">
                        <thead>
                            <tr class="bg-midnight/85 border-b border-twilight text-[10px] font-bold text-candlelight uppercase tracking-wider">
                                <th class="py-3.5 px-4 w-10 text-center">
                                    <input type="checkbox" id="selectAllStudents" onchange="toggleSelectAll(this)" class="rounded border-twilight bg-midnight text-candlelight focus:ring-candlelight/40 cursor-pointer">
                                </th>
                                <th class="py-3.5 px-4">Student ID</th>
                                <th class="py-3.5 px-4">Full Name</th>
                                <th class="py-3.5 px-4">Course</th>
                                <th class="py-3.5 px-4">GPA</th>
                                <th class="py-3.5 px-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="directoryTableBody" class="divide-y divide-twilight/60">
                            @forelse ($students as $student)
                                <tr class="directory-row hover:bg-midnight/50 transition" data-search="{{ strtolower(($student->student_id ?? '') . ' ' . ($student->name ?? '') . ' ' . ($student->course ?? '')) }}">
                                    <td class="py-4 px-4 text-center">
                                        <input type="checkbox" value="{{ $student->id }}" onchange="updateSelectionCount()" class="student-row-checkbox rounded border-twilight bg-midnight text-candlelight focus:ring-candlelight/40 cursor-pointer">
                                    </td>
                                    <td class="py-4 px-4 font-mono font-bold text-candlelight">{{ $student->student_id }}</td>
                                    <td class="py-4 px-4 font-bold text-white">{{ $student->name }}</td>
                                    <td class="py-4 px-4 text-slate-300 font-medium">{{ $student->course }}</td>
                                    <td class="py-4 px-4 font-extrabold text-candlelight">{{ number_format((float) $student->gpa, 2) }}</td>
                                    <td class="py-4 px-4 text-right space-x-1.5 whitespace-nowrap">
                                        <button type="button"
                                            onclick="openViewModal(@js($student->student_id), @js($student->name), @js($student->course), @js(number_format((float) $student->gpa, 2)))"
                                            class="px-2.5 py-1 bg-midnight hover:bg-twilight text-candlelight border border-twilight rounded-lg text-[11px] font-bold transition">
                                            Details
                                        </button>
                                        <button type="button"
                                            onclick="openEditModal(@js($student->id), @js($student->student_id), @js($student->name), @js($student->course), @js($student->gpa))"
                                            class="px-2.5 py-1 bg-deepnavy hover:bg-twilight text-white border border-starlight/40 rounded-lg text-[11px] font-bold transition">
                                            Edit
                                        </button>
                                        <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete this student record?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-2.5 py-1 bg-rose-950/60 hover:bg-rose-900/70 text-rose-200 border border-rose-500/40 rounded-lg text-[11px] font-bold transition">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-8 text-center text-slate-400">No students match this view.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <!-- View Student Modal -->
    <div id="viewModal" class="fixed inset-0 bg-black/65 backdrop-blur-sm hidden flex items-center justify-center p-4 z-50">
        <div class="bg-deepnavy rounded-3xl max-w-md w-full p-6 shadow-2xl border border-twilight space-y-4">
            <div class="flex justify-between items-center">
                <h3 class="text-base font-bold text-white">Student details</h3>
                <button type="button" onclick="document.getElementById('viewModal').classList.add('hidden')" class="text-slate-400 hover:text-candlelight text-sm font-bold">X</button>
            </div>
            <div class="p-4 bg-midnight/85 rounded-2xl border border-twilight space-y-2 text-xs">
                <p><span class="font-bold text-slate-400">Student ID:</span> <span id="view_student_id" class="font-mono font-bold text-candlelight"></span></p>
                <p><span class="font-bold text-slate-400">Name:</span> <span id="view_name" class="font-bold text-white"></span></p>
                <p><span class="font-bold text-slate-400">Course:</span> <span id="view_course" class="font-semibold text-slate-200"></span></p>
                <p><span class="font-bold text-slate-400">GPA:</span> <span id="view_gpa" class="font-extrabold text-candlelight"></span></p>
            </div>
            <div class="flex justify-end">
                <button type="button" onclick="document.getElementById('viewModal').classList.add('hidden')" class="px-4 py-2 bg-candlelight text-midnight rounded-xl text-xs font-extrabold">Close</button>
            </div>
        </div>
    </div>

    <!-- Edit Student Modal -->
    <div id="editModal" class="fixed inset-0 bg-black/65 backdrop-blur-sm hidden flex items-center justify-center p-4 z-50">
        <div class="bg-deepnavy rounded-3xl max-w-md w-full p-6 shadow-2xl border border-twilight">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-base font-bold text-white">Edit student</h3>
                <button type="button" onclick="document.getElementById('editModal').classList.add('hidden')" class="text-slate-400 hover:text-candlelight text-sm font-bold">X</button>
            </div>
            <form id="editForm" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-[11px] font-bold text-candlelight uppercase tracking-wider mb-1">Student ID (Prefix Locked)</label>
                    <input type="text" id="edit_student_id" name="student_id" required oninput="enforcePrefixLock(this)" class="w-full px-3 py-2 bg-midnight/85 border border-twilight rounded-xl text-xs text-white shadow-inner">
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-candlelight uppercase tracking-wider mb-1">Full Name</label>
                    <input type="text" id="edit_name" name="name" required class="w-full px-3 py-2 bg-midnight/85 border border-twilight rounded-xl text-xs text-white shadow-inner">
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-candlelight uppercase tracking-wider mb-1">Course</label>
                    <input type="text" id="edit_course" name="course" required placeholder="e.g. BSIT" class="w-full px-3 py-2 bg-midnight/85 border border-twilight rounded-xl text-xs text-white placeholder-slate-400 shadow-inner">
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-candlelight uppercase tracking-wider mb-1">GPA ({{ $minGpaLabel }} - {{ $gpaScale }})</label>
                    <input type="text" inputmode="decimal" id="edit_gpa" name="gpa" required oninput="cleanGpaInput(this)" class="w-full px-3 py-2 bg-midnight/85 border border-twilight rounded-xl text-xs text-white shadow-inner">
                </div>
                <div class="flex justify-end space-x-3 pt-2">
                    <button type="button" onclick="document.getElementById('editModal').classList.add('hidden')" class="px-4 py-2 bg-midnight text-slate-200 border border-twilight rounded-xl text-xs font-semibold">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-candlelight text-midnight rounded-xl text-xs font-extrabold hover:bg-[#e5ba99] transition shadow-sm">Save changes</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Profile Modal -->
    <div id="profileModal" class="fixed inset-0 bg-black/65 backdrop-blur-sm hidden flex items-center justify-center p-4 z-50">
        <div class="bg-deepnavy rounded-3xl max-w-md w-full p-6 shadow-2xl border border-twilight space-y-4">
            <div class="flex justify-between items-center">
                <h3 class="text-base font-bold text-white">Account info</h3>
                <button type="button" onclick="document.getElementById('profileModal').classList.add('hidden')" class="text-slate-400 hover:text-candlelight text-sm font-bold">X</button>
            </div>
            <div class="flex items-center space-x-4 p-4 bg-midnight/85 rounded-2xl border border-twilight">
                <div class="w-12 h-12 rounded-full bg-deepnavy border border-candlelight/40 text-candlelight font-bold flex items-center justify-center text-sm">
                    {{ strtoupper(substr(session('admin_name', 'Alex Davis'), 0, 2)) }}
                </div>
                <div>
                    <p class="text-sm font-bold text-white">{{ session('admin_name', 'Alex Davis') }}</p>
                    <p class="text-xs text-slate-400">Administrator</p>
                    <span class="inline-block mt-1 px-2 py-0.5 bg-deepnavy border border-candlelight/40 text-candlelight text-[10px] font-bold rounded-full">Workspace Admin</span>
                </div>
            </div>
            <div class="flex justify-end pt-2">
                <button type="button" onclick="document.getElementById('profileModal').classList.add('hidden')" class="px-4 py-2 bg-candlelight text-midnight rounded-xl text-xs font-extrabold shadow-sm">Close</button>
            </div>
        </div>
    </div>

    <script>
        let lockedEditPrefix = 'STU-';

        function toggleSelectAll(masterCheckbox) {
            const checkboxes = document.querySelectorAll('.student-row-checkbox');
            checkboxes.forEach((cb) => {
                const row = cb.closest('tr');
                if (!row || !row.classList.contains('hidden')) {
                    cb.checked = masterCheckbox.checked;
                }
            });
            updateSelectionCount();
        }

        function updateSelectionCount() {
            const checked = document.querySelectorAll('.student-row-checkbox:checked');
            const badge = document.getElementById('selectedCountBadge');
            const bulkBtn = document.getElementById('bulkDeleteBtn');
            if (badge) {
                badge.textContent = `${checked.length} selected`;
            }
            if (bulkBtn) {
                bulkBtn.disabled = checked.length === 0;
            }
        }

        async function deleteSelectedStudents() {
            const checked = Array.from(document.querySelectorAll('.student-row-checkbox:checked'));
            if (checked.length === 0) return;
            if (!confirm(`Delete ${checked.length} selected student record(s)?`)) return;

            const csrfToken = document.querySelector('input[name="_token"]')?.value || '';
            for (const cb of checked) {
                const id = cb.value;
                const formData = new URLSearchParams();
                formData.append('_token', csrfToken);
                formData.append('_method', 'DELETE');
                await fetch(`/students/${id}`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded', 'X-Requested-With': 'XMLHttpRequest' },
                    body: formData.toString(),
                });
            }
            window.location.reload();
        }

        function filterDirectoryRows() {
            const query = String(document.getElementById('directorySearchInput')?.value || '').trim().toLowerCase();
            const rows = document.querySelectorAll('.directory-row');
            rows.forEach((row) => {
                const haystack = String(row.getAttribute('data-search') || '');
                row.classList.toggle('hidden', query !== '' && !haystack.includes(query));
            });
            const selectAll = document.getElementById('selectAllStudents');
            if (selectAll) {
                selectAll.checked = false;
            }
            updateSelectionCount();
        }

        function openViewModal(studentId, name, course, gpa) {
            document.getElementById('view_student_id').textContent = studentId;
            document.getElementById('view_name').textContent = name;
            document.getElementById('view_course').textContent = course;
            document.getElementById('view_gpa').textContent = gpa;
            document.getElementById('viewModal').classList.remove('hidden');
        }

        function cleanGpaInput(input) {
            let val = String(input.value || '').replace(/[^0-9.]/g, '');
            const parts = val.split('.');
            if (parts.length > 2) {
                val = parts.shift() + '.' + parts.join('');
            }
            input.value = val;
        }

        function enforcePrefixLock(input) {
            const raw = String(input.value || '');
            const match = raw.match(/(\d+)\s*$/);
            const digits = match ? match[1] : '';
            input.value = lockedEditPrefix + digits;
        }

        function openEditModal(id, studentId, name, course, gpa) {
            const form = document.getElementById('editForm');
            form.action = `/students/${id}`;
            const prefixMatch = String(studentId || '').match(/^([A-Za-z]+-?)/);
            if (prefixMatch) {
                const lettersOnly = prefixMatch[1].replace(/[^A-Za-z]/g, '').toUpperCase();
                lockedEditPrefix = (lettersOnly || 'STU') + '-';
            } else {
                lockedEditPrefix = @js($settings['student_id_prefix'] ?? 'STU-');
            }
            document.getElementById('edit_student_id').value = studentId;
            document.getElementById('edit_name').value = name;
            document.getElementById('edit_course').value = course || '';
            document.getElementById('edit_gpa').value = gpa;
            document.getElementById('editModal').classList.remove('hidden');
        }

        (function initRightSnow() {
            const canvas = document.getElementById('rightPanelSnow');
            const panel = canvas ? canvas.parentElement : null;
            if (!canvas || !panel) return;
            const ctx = canvas.getContext('2d');
            let width = 0;
            let height = 0;
            const flakes = Array.from({ length: 42 }, (_, idx) => ({
                x: Math.random() * 1200,
                y: Math.random() * 900,
                size: 4 + Math.random() * 5.5,
                vy: 0.4 + Math.random() * 0.7,
                vx: -0.3 + Math.random() * 0.6,
                angle: Math.random() * Math.PI * 2,
                spin: -0.012 + Math.random() * 0.024,
                alpha: 0.45 + Math.random() * 0.35,
                warm: idx % 7 === 0,
            }));

            function resize() {
                width = canvas.width = panel.clientWidth;
                height = canvas.height = panel.clientHeight;
            }
            resize();
            window.addEventListener('resize', resize);

            function drawFlake(f) {
                ctx.save();
                ctx.translate(f.x, f.y);
                if (f.warm) {
                    const grad = ctx.createRadialGradient(0, 0, 0.5, 0, 0, f.size * 1.35);
                    grad.addColorStop(0, `rgba(255, 243, 220, ${f.alpha})`);
                    grad.addColorStop(0.55, `rgba(218, 169, 133, ${f.alpha * 0.5})`);
                    grad.addColorStop(1, 'rgba(218, 169, 133, 0)');
                    ctx.fillStyle = grad;
                    ctx.beginPath();
                    ctx.arc(0, 0, f.size * 1.35, 0, Math.PI * 2);
                    ctx.fill();
                    ctx.restore();
                    return;
                }
                ctx.rotate(f.angle);
                ctx.strokeStyle = `rgba(226, 239, 250, ${f.alpha})`;
                ctx.lineWidth = 1.1;
                const r = f.size;
                for (let i = 0; i < 6; i++) {
                    ctx.save();
                    ctx.rotate((i * Math.PI) / 3);
                    ctx.beginPath();
                    ctx.moveTo(0, 0);
                    ctx.lineTo(0, -r);
                    ctx.moveTo(0, -r * 0.55);
                    ctx.lineTo(-r * 0.25, -r * 0.78);
                    ctx.moveTo(0, -r * 0.55);
                    ctx.lineTo(r * 0.25, -r * 0.78);
                    ctx.stroke();
                    ctx.restore();
                }
                ctx.restore();
            }

            function tick() {
                ctx.clearRect(0, 0, width, height);
                for (const f of flakes) {
                    f.x += f.vx;
                    f.y += f.vy;
                    f.angle += f.spin;
                    if (f.y - f.size > height) {
                        f.y = -f.size * 2;
                        f.x = Math.random() * width;
                    }
                    if (f.x + f.size < 0) f.x = width + f.size;
                    if (f.x - f.size > width) f.x = -f.size;
                    drawFlake(f);
                }
                requestAnimationFrame(tick);
            }
            tick();
        })();
    </script>
</body>
</html>
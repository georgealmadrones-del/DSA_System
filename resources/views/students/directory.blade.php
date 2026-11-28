<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduCore SaaS Student Directory</title>
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
        $gpaScale = number_format((float) ($settings['gpa_scale'] ?? 3.00), 2);
        $minGpaLabel = !empty($settings['data_integrity']) ? '1.00' : '0.00';
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
                            <p class="font-bold text-nordic leading-tight">{{ $settings['workspace_name'] ?? session('workspace_name', 'EduCore Workspace') }}</p>
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
                    <a href="{{ route('students.directory') }}" class="flex items-center justify-between px-3 py-2.5 rounded-2xl bg-white text-nordic font-bold text-xs border border-glacier shadow-sm">
                        <span>Student Directory</span>
                        <span class="px-1.5 py-0.5 bg-frost text-nordic border border-glacier rounded-md text-[10px] font-bold">{{ $totalStudents ?? $students->count() }}</span>
                    </a>
                    <a href="{{ route('actions') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-2xl text-pine hover:bg-white/70 text-xs font-semibold transition">
                        <span>Actions</span>
                    </a>
                </nav>
            </div>
        </div>

        <div class="p-4 border-t border-glacier/70 space-y-4">
            <div class="px-2">
                <p class="px-3 text-[10px] font-bold uppercase tracking-wider text-pine mb-1">Manage</p>
                <a href="{{ route('settings') }}" class="flex items-center space-x-3 px-3 py-2 rounded-2xl text-pine hover:bg-white/70 text-xs font-semibold transition">
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

    <!-- Scrollable Right Content (Snow only inside right panel) -->
    <main class="relative flex-1 h-full flex flex-col min-w-0 overflow-hidden bg-frost">
        <canvas id="rightPanelSnow" class="pointer-events-none absolute inset-0 w-full h-full z-0"></canvas>

        <header class="relative z-10 bg-[#F2F6FA]/90 border-b border-glacier/70 h-16 flex items-center justify-between px-8 shrink-0">
            <div class="text-xs text-pine font-medium">Workspace / <span class="text-nordic font-semibold">Directory</span></div>
            <div onclick="document.getElementById('profileModal').classList.remove('hidden')" class="w-8 h-8 rounded-xl bg-nordic text-white font-bold text-xs flex items-center justify-center shadow-sm cursor-pointer">
                {{ strtoupper(substr(session('admin_name', 'Alex Davis'), 0, 2)) }}
            </div>
        </header>

        <div class="relative z-10 flex-1 overflow-y-auto p-6 md:p-8 space-y-6">
            @if (session('success'))
                <div class="p-4 bg-white/95 border border-glacier rounded-2xl text-xs font-bold text-nordic shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="p-4 bg-rose-50 border border-rose-200 rounded-2xl text-xs text-rose-700 shadow-sm">
                    <ul class="list-disc pl-4 space-y-0.5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white/95 rounded-3xl border border-glacier shadow-sm p-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-xl font-extrabold text-nordic">Complete Student Directory</h1>
                    <p class="text-xs text-pine mt-0.5">Review, filter, inspect, edit, or remove active student records.</p>
                </div>
                <div class="flex items-center gap-2">
                    <span id="selectedCountBadge" class="px-3 py-1.5 bg-frost border border-glacier text-nordic rounded-xl text-xs font-bold">0 selected</span>
                    <button type="button" id="bulkDeleteBtn" onclick="deleteSelectedStudents()" disabled class="px-3.5 py-2 bg-rose-50 text-rose-600 border border-rose-200 rounded-xl text-xs font-bold hover:bg-rose-100 transition disabled:opacity-40 disabled:cursor-not-allowed">
                        Delete Selected
                    </button>
                </div>
            </div>

            <div class="bg-white/95 rounded-3xl border border-glacier shadow-sm overflow-hidden">
                <div class="p-6 border-b border-glacier/70 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <h2 class="text-sm font-bold text-nordic">Enrolled Records</h2>

                    <form method="GET" action="{{ route('students.directory') }}" class="flex flex-wrap items-center gap-2">
                        <input type="text" id="directorySearchInput" name="search" value="{{ request('search') }}" placeholder="Search student ID, name, course..." oninput="filterDirectoryRows()" class="px-3.5 py-2 bg-frost/70 border border-glacier rounded-xl text-xs text-nordic shadow-inner focus:outline-none focus:ring-2 focus:ring-nordic/40 w-64">
                        <button type="submit" class="px-4 py-2 bg-nordic text-white rounded-xl text-xs font-bold hover:bg-[#235673] transition shadow-sm">
                            Search
                        </button>
                        @if (request()->filled('search'))
                            <a href="{{ route('students.directory') }}" class="px-3 py-2 bg-frost text-nordic border border-glacier rounded-xl text-xs font-semibold hover:bg-glacier/40 transition">
                                Reset
                            </a>
                        @endif
                    </form>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse text-xs">
                        <thead>
                            <tr class="bg-frost/80 border-b border-glacier/70 text-[10px] font-bold text-pine uppercase tracking-wider">
                                <th class="py-3.5 px-4 w-10 text-center">
                                    <input type="checkbox" id="selectAllStudents" onchange="toggleSelectAll(this)" class="rounded border-glacier text-nordic focus:ring-nordic/40 cursor-pointer">
                                </th>
                                <th class="py-3.5 px-4">Student ID</th>
                                <th class="py-3.5 px-4">Full Name</th>
                                <th class="py-3.5 px-4">Course</th>
                                <th class="py-3.5 px-4">GPA</th>
                                <th class="py-3.5 px-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="directoryTableBody" class="divide-y divide-glacier/30">
                            @forelse ($students as $student)
                                <tr class="directory-row hover:bg-frost/40 transition" data-search="{{ strtolower(($student->student_id ?? '') . ' ' . ($student->name ?? '') . ' ' . ($student->course ?? '')) }}">
                                    <td class="py-4 px-4 text-center">
                                        <input type="checkbox" value="{{ $student->id }}" onchange="updateSelectionCount()" class="student-row-checkbox rounded border-glacier text-nordic focus:ring-nordic/40 cursor-pointer">
                                    </td>
                                    <td class="py-4 px-4 font-mono font-bold text-nordic">{{ $student->student_id }}</td>
                                    <td class="py-4 px-4 font-bold text-nordic">{{ $student->name }}</td>
                                    <td class="py-4 px-4 text-pine font-medium">{{ $student->course }}</td>
                                    <td class="py-4 px-4 font-extrabold text-nordic">{{ number_format((float) $student->gpa, 2) }}</td>
                                    <td class="py-4 px-4 text-right space-x-1.5 whitespace-nowrap">
                                        <button type="button"
                                            onclick="openViewModal(@js($student->student_id), @js($student->name), @js($student->course), @js(number_format((float) $student->gpa, 2)))"
                                            class="px-2.5 py-1 bg-frost hover:bg-glacier/40 text-nordic border border-glacier rounded-lg text-[11px] font-bold transition">
                                            See
                                        </button>
                                        <button type="button"
                                            onclick="openEditModal(@js($student->id), @js($student->student_id), @js($student->name), @js($student->course), @js($student->gpa))"
                                            class="px-2.5 py-1 bg-white hover:bg-frost text-nordic border border-glacier rounded-lg text-[11px] font-bold transition">
                                            Edit
                                        </button>
                                        <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete this student record?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-2.5 py-1 bg-rose-50 hover:bg-rose-100 text-rose-600 border border-rose-200 rounded-lg text-[11px] font-bold transition">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-8 text-center text-pine">No records found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <!-- View Student Modal -->
    <div id="viewModal" class="fixed inset-0 bg-nordic/35 backdrop-blur-sm hidden flex items-center justify-center p-4 z-50">
        <div class="bg-white rounded-3xl max-w-md w-full p-6 shadow-xl border border-glacier space-y-4">
            <div class="flex justify-between items-center">
                <h3 class="text-base font-bold text-nordic">Student Record Details</h3>
                <button type="button" onclick="document.getElementById('viewModal').classList.add('hidden')" class="text-pine hover:text-nordic text-sm font-bold">X</button>
            </div>
            <div class="p-4 bg-frost/70 rounded-2xl border border-glacier space-y-2 text-xs">
                <p><span class="font-bold text-pine">Student ID:</span> <span id="view_student_id" class="font-mono font-bold text-nordic"></span></p>
                <p><span class="font-bold text-pine">Full Name:</span> <span id="view_name" class="font-bold text-nordic"></span></p>
                <p><span class="font-bold text-pine">Course:</span> <span id="view_course" class="font-semibold text-nordic"></span></p>
                <p><span class="font-bold text-pine">GPA:</span> <span id="view_gpa" class="font-extrabold text-nordic"></span></p>
            </div>
            <div class="flex justify-end">
                <button type="button" onclick="document.getElementById('viewModal').classList.add('hidden')" class="px-4 py-2 bg-nordic text-white rounded-xl text-xs font-semibold">Close</button>
            </div>
        </div>
    </div>

    <!-- Edit Student Modal -->
    <div id="editModal" class="fixed inset-0 bg-nordic/35 backdrop-blur-sm hidden flex items-center justify-center p-4 z-50">
        <div class="bg-white rounded-3xl max-w-md w-full p-6 shadow-xl border border-glacier">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-base font-bold text-nordic">Edit Student Record</h3>
                <button type="button" onclick="document.getElementById('editModal').classList.add('hidden')" class="text-pine hover:text-nordic text-sm font-bold">X</button>
            </div>
            <form id="editForm" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-[11px] font-bold text-nordic uppercase tracking-wider mb-1">Student ID (Prefix Locked)</label>
                    <input type="text" id="edit_student_id" name="student_id" required oninput="enforcePrefixLock(this)" class="w-full px-3 py-2 bg-frost/70 border border-glacier rounded-xl text-xs text-nordic shadow-inner">
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-nordic uppercase tracking-wider mb-1">Full Name</label>
                    <input type="text" id="edit_name" name="name" required class="w-full px-3 py-2 bg-frost/70 border border-glacier rounded-xl text-xs text-nordic shadow-inner">
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-nordic uppercase tracking-wider mb-1">Course</label>
                    <input type="text" id="edit_course" name="course" required placeholder="Enter a course" class="w-full px-3 py-2 bg-frost/70 border border-glacier rounded-xl text-xs text-nordic shadow-inner">
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-nordic uppercase tracking-wider mb-1">GPA ({{ $minGpaLabel }} - {{ $gpaScale }})</label>
                    <input type="text" inputmode="decimal" id="edit_gpa" name="gpa" required oninput="cleanGpaInput(this)" class="w-full px-3 py-2 bg-frost/70 border border-glacier rounded-xl text-xs text-nordic shadow-inner">
                </div>
                <div class="flex justify-end space-x-3 pt-2">
                    <button type="button" onclick="document.getElementById('editModal').classList.add('hidden')" class="px-4 py-2 bg-frost text-nordic border border-glacier rounded-xl text-xs font-semibold">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-nordic text-white rounded-xl text-xs font-semibold hover:bg-[#235673] transition shadow-sm">Update Changes</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Profile Modal -->
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
            <div class="flex justify-end pt-2">
                <button type="button" onclick="document.getElementById('profileModal').classList.add('hidden')" class="px-4 py-2 bg-nordic text-white rounded-xl text-xs font-semibold shadow-sm">Close</button>
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
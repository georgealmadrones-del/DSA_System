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
        $gpaScale = number_format((float) ($settings['gpa_scale'] ?? 3.00), 2);
        $minGpaLabel = !empty($settings['data_integrity']) ? '1.00' : '0.00';
        $auditEntries = isset($logs) ? collect($logs) : collect();
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
                            <p class="font-bold text-charcoal leading-tight">{{ $settings['workspace_name'] ?? session('workspace_name', 'EduCore Workspace') }}</p>
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
                    <a href="{{ route('students.directory') }}" class="flex items-center justify-between px-3 py-2.5 rounded-2xl bg-white text-charcoal font-bold text-xs border border-coolgrey/30 shadow-md">
                        <span>Student Directory</span>
                        <span class="px-1.5 py-0.5 bg-gray-100 text-charcoal rounded-md text-[10px] font-bold">{{ $totalStudents ?? $students->count() }}</span>
                    </a>
                    <a href="{{ route('actions') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-2xl text-charcoal/70 hover:bg-white/60 text-xs font-semibold transition">
                        <span>Actions</span>
                    </a>
                </nav>
            </div>
        </div>

        <div class="p-4 border-t border-coolgrey/20 space-y-4">
            <div class="px-2">
                <p class="px-3 text-[10px] font-bold uppercase tracking-wider text-slateblue/70 mb-1">Manage</p>
                <a href="{{ route('settings') }}" class="flex items-center space-x-3 px-3 py-2 rounded-2xl text-charcoal/70 hover:bg-white/60 text-xs font-semibold transition">
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

    <!-- Scrollable Right Content -->
    <main class="flex-1 h-full flex flex-col min-w-0 overflow-hidden">
        <header class="bg-[#FCFBF7] border-b border-coolgrey/20 h-16 flex items-center justify-between px-8 shrink-0 shadow-sm">
            <div class="text-xs text-slateblue font-medium">Workspace / <span class="text-charcoal font-semibold">Directory</span></div>
            <div onclick="document.getElementById('profileModal').classList.remove('hidden')" class="w-8 h-8 rounded-xl bg-charcoal text-white font-bold text-xs flex items-center justify-center shadow-md cursor-pointer">
                {{ strtoupper(substr(session('admin_name', 'Alex Davis'), 0, 2)) }}
            </div>
        </header>

        <div class="flex-1 overflow-y-auto p-6 md:p-8 space-y-6">
            @if (session('success'))
                <div class="p-4 bg-emerald-50 border border-emerald-200 rounded-2xl text-xs font-bold text-emerald-800 shadow-sm">
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

            <div class="bg-white rounded-3xl border border-coolgrey/20 shadow-md p-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-xl font-extrabold text-charcoal">Complete Student Directory</h1>
                    <p class="text-xs text-slateblue mt-0.5">Review, filter, inspect, edit, or remove active student records.</p>
                </div>
                <div class="flex items-center gap-2">
                    <span id="selectedCountBadge" class="px-3 py-1.5 bg-gray-100 text-charcoal rounded-xl text-xs font-bold">0 selected</span>
                    <button type="button" id="bulkDeleteBtn" onclick="deleteSelectedStudents()" disabled class="px-3.5 py-2 bg-rose-50 text-rose-600 border border-rose-200 rounded-xl text-xs font-bold hover:bg-rose-100 transition disabled:opacity-40 disabled:cursor-not-allowed">
                        Delete Selected
                    </button>
                </div>
            </div>

            <!-- Enrolled Records Table -->
            <div class="bg-white rounded-3xl border border-coolgrey/20 shadow-md overflow-hidden">
                <div class="p-6 border-b border-coolgrey/20 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <h2 class="text-sm font-bold text-charcoal">Enrolled Records</h2>

                    <form method="GET" action="{{ route('students.directory') }}" class="flex flex-wrap items-center gap-2">
                        <input type="text" id="directorySearchInput" name="search" value="{{ request('search') }}" placeholder="Search student ID, name, course..." oninput="filterDirectoryRows()" class="px-3.5 py-2 bg-gray-50 border border-coolgrey/30 rounded-xl text-xs shadow-inner focus:outline-none focus:ring-2 focus:ring-slateblue/50 w-64">
                        <button type="submit" class="px-4 py-2 bg-charcoal text-white rounded-xl text-xs font-bold hover:bg-charcoal/90 transition shadow-sm">
                            Search
                        </button>
                        @if (request()->filled('search'))
                            <a href="{{ route('students.directory') }}" class="px-3 py-2 bg-gray-100 text-charcoal rounded-xl text-xs font-semibold hover:bg-gray-200 transition">
                                Reset
                            </a>
                        @endif
                    </form>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse text-xs">
                        <thead>
                            <tr class="bg-gray-50/70 border-b border-coolgrey/20 text-[10px] font-bold text-slateblue uppercase tracking-wider">
                                <th class="py-3.5 px-4 w-10 text-center">
                                    <input type="checkbox" id="selectAllStudents" onchange="toggleSelectAll(this)" class="rounded border-coolgrey/40 text-charcoal focus:ring-slateblue/50 cursor-pointer">
                                </th>
                                <th class="py-3.5 px-4">Student ID</th>
                                <th class="py-3.5 px-4">Full Name</th>
                                <th class="py-3.5 px-4">Course</th>
                                <th class="py-3.5 px-4">GPA</th>
                                <th class="py-3.5 px-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="directoryTableBody" class="divide-y divide-coolgrey/10">
                            @forelse ($students as $student)
                                <tr class="directory-row hover:bg-gray-50/50 transition" data-search="{{ strtolower(($student->student_id ?? '') . ' ' . ($student->name ?? '') . ' ' . ($student->course ?? '')) }}">
                                    <td class="py-4 px-4 text-center">
                                        <input type="checkbox" value="{{ $student->id }}" onchange="updateSelectionCount()" class="student-row-checkbox rounded border-coolgrey/40 text-charcoal focus:ring-slateblue/50 cursor-pointer">
                                    </td>
                                    <td class="py-4 px-4 font-mono font-bold text-charcoal">{{ $student->student_id }}</td>
                                    <td class="py-4 px-4 font-bold text-charcoal">{{ $student->name }}</td>
                                    <td class="py-4 px-4 text-slateblue font-medium">{{ $student->course }}</td>
                                    <td class="py-4 px-4 font-extrabold text-charcoal">{{ number_format((float) $student->gpa, 2) }}</td>
                                    <td class="py-4 px-4 text-right space-x-1.5 whitespace-nowrap">
                                        <button type="button"
                                            onclick="openViewModal(@js($student->student_id), @js($student->name), @js($student->course), @js(number_format((float) $student->gpa, 2)))"
                                            class="px-2.5 py-1 bg-gray-50 hover:bg-gray-100 text-charcoal border border-coolgrey/30 rounded-lg text-[11px] font-bold transition">
                                            See
                                        </button>
                                        <button type="button"
                                            onclick="openEditModal(@js($student->id), @js($student->student_id), @js($student->name), @js($student->course), @js($student->gpa))"
                                            class="px-2.5 py-1 bg-gray-50 hover:bg-gray-100 text-slateblue border border-coolgrey/30 rounded-lg text-[11px] font-bold transition">
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
                                    <td colspan="6" class="py-8 text-center text-slateblue">No records found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Functional Audit Logs Section -->
            <div class="bg-white rounded-3xl border border-coolgrey/20 shadow-md overflow-hidden">
                <div class="p-6 border-b border-coolgrey/20 flex items-center justify-between">
                    <div>
                        <h2 class="text-sm font-bold text-charcoal">Audit Logs</h2>
                        <p class="text-xs text-slateblue mt-0.5">Recent workspace and student record activity.</p>
                    </div>
                    <span class="px-2.5 py-1 bg-gray-100 text-charcoal rounded-xl text-[11px] font-bold">{{ $auditEntries->count() }} entries</span>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse text-xs">
                        <thead>
                            <tr class="bg-gray-50/70 border-b border-coolgrey/20 text-[10px] font-bold text-slateblue uppercase tracking-wider">
                                <th class="py-3.5 px-6">Event</th>
                                <th class="py-3.5 px-6">Details</th>
                                <th class="py-3.5 px-6">Actor</th>
                                <th class="py-3.5 px-6 text-right">Timestamp</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-coolgrey/10">
                            @forelse ($auditEntries as $log)
                                <tr class="hover:bg-gray-50/50 transition">
                                    <td class="py-3.5 px-6 font-bold text-charcoal">{{ $log->event ?? ($log->action ?? 'activity') }}</td>
                                    <td class="py-3.5 px-6 text-slateblue">{{ $log->meta ?? ($log->description ?? '—') }}</td>
                                    <td class="py-3.5 px-6 text-charcoal">{{ $log->actor_name ?? 'Administrator' }}</td>
                                    <td class="py-3.5 px-6 text-right text-slateblue font-mono text-[11px]">
                                        {{ $log->created_at ? \Illuminate\Support\Carbon::parse($log->created_at)->format('M d, Y H:i') : '—' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-6 text-center text-slateblue">No audit logs recorded yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <!-- View Student Modal -->
    <div id="viewModal" class="fixed inset-0 bg-charcoal/50 backdrop-blur-sm hidden flex items-center justify-center p-4 z-50">
        <div class="bg-white rounded-3xl max-w-md w-full p-6 shadow-2xl border border-coolgrey/20 space-y-4">
            <div class="flex justify-between items-center">
                <h3 class="text-base font-bold text-charcoal">Student Record Details</h3>
                <button type="button" onclick="document.getElementById('viewModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600 text-sm font-bold">X</button>
            </div>
            <div class="p-4 bg-gray-50 rounded-2xl border border-coolgrey/20 space-y-2 text-xs">
                <p><span class="font-bold text-slateblue">Student ID:</span> <span id="view_student_id" class="font-mono font-bold text-charcoal"></span></p>
                <p><span class="font-bold text-slateblue">Full Name:</span> <span id="view_name" class="font-bold text-charcoal"></span></p>
                <p><span class="font-bold text-slateblue">Course:</span> <span id="view_course" class="font-semibold text-charcoal"></span></p>
                <p><span class="font-bold text-slateblue">GPA:</span> <span id="view_gpa" class="font-extrabold text-charcoal"></span></p>
            </div>
            <div class="flex justify-end">
                <button type="button" onclick="document.getElementById('viewModal').classList.add('hidden')" class="px-4 py-2 bg-charcoal text-white rounded-xl text-xs font-semibold">Close</button>
            </div>
        </div>
    </div>

    <!-- Edit Student Modal -->
    <div id="editModal" class="fixed inset-0 bg-charcoal/50 backdrop-blur-sm hidden flex items-center justify-center p-4 z-50">
        <div class="bg-white rounded-3xl max-w-md w-full p-6 shadow-2xl border border-coolgrey/20">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-base font-bold text-charcoal">Edit Student Record</h3>
                <button type="button" onclick="document.getElementById('editModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600 text-sm font-bold">X</button>
            </div>
            <form id="editForm" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-[11px] font-bold text-slateblue uppercase tracking-wider mb-1">Student ID (Prefix Locked)</label>
                    <input type="text" id="edit_student_id" name="student_id" required oninput="enforcePrefixLock(this)" class="w-full px-3 py-2 bg-gray-50 border border-coolgrey/30 rounded-xl text-xs shadow-inner">
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-slateblue uppercase tracking-wider mb-1">Full Name</label>
                    <input type="text" id="edit_name" name="name" required class="w-full px-3 py-2 bg-gray-50 border border-coolgrey/30 rounded-xl text-xs shadow-inner">
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-slateblue uppercase tracking-wider mb-1">Course</label>
                    <input type="text" id="edit_course" name="course" required placeholder="Enter a course" class="w-full px-3 py-2 bg-gray-50 border border-coolgrey/30 rounded-xl text-xs shadow-inner">
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-slateblue uppercase tracking-wider mb-1">GPA ({{ $minGpaLabel }} - {{ $gpaScale }})</label>
                    <input type="text" inputmode="decimal" id="edit_gpa" name="gpa" required oninput="cleanGpaInput(this)" class="w-full px-3 py-2 bg-gray-50 border border-coolgrey/30 rounded-xl text-xs shadow-inner">
                </div>
                <div class="flex justify-end space-x-3 pt-2">
                    <button type="button" onclick="document.getElementById('editModal').classList.add('hidden')" class="px-4 py-2 bg-gray-100 text-charcoal rounded-xl text-xs font-semibold">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-charcoal text-white rounded-xl text-xs font-semibold hover:bg-charcoal/90 transition shadow-md">Update Changes</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Profile Modal -->
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
            <div class="flex justify-end pt-2">
                <button type="button" onclick="document.getElementById('profileModal').classList.add('hidden')" class="px-4 py-2 bg-gray-100 text-charcoal rounded-xl text-xs font-semibold shadow-sm">Close</button>
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
    </script>
</body>
</html>
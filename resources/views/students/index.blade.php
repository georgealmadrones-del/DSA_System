<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduCore Student Records SaaS</title>
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
        $defaultStudentId = $nextStudentId ?? (($settings['student_id_prefix'] ?? 'STU-') . '0001');
    @endphp

    <!-- Mobile Sidebar Overlay Drawer -->
    <div id="mobileSidebar" class="fixed inset-0 bg-nordic/35 backdrop-blur-sm z-50 hidden md:hidden flex">
        <div class="w-64 h-full bg-[#DCE5EE] border-r border-glacier flex flex-col justify-between shadow-xl p-4">
            <div>
                <div class="flex items-center justify-between pb-4 border-b border-glacier/70">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 rounded-xl bg-nordic flex items-center justify-center text-white shadow-sm">
                            <div class="grid grid-cols-2 gap-0.5">
                                <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                                <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                                <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                                <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                            </div>
                        </div>
                        <span class="font-extrabold text-sm text-nordic">EduCore SaaS</span>
                    </div>
                    <button type="button" onclick="toggleMobileSidebar()" class="text-pine hover:text-nordic font-bold text-lg p-1">X</button>
                </div>

                <div class="py-4">
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

                <nav class="space-y-1">
                    <p class="px-3 text-[10px] font-bold uppercase tracking-wider text-pine mb-2">Workspace</p>
                    <a href="{{ route('students.index') }}" class="flex items-center justify-between px-3 py-2.5 rounded-2xl bg-white text-nordic font-bold text-xs border border-glacier shadow-sm">
                        <div class="flex items-center space-x-3">
                            <span class="w-1.5 h-1.5 rounded-full bg-nordic"></span>
                            <span>Dashboard</span>
                        </div>
                    </a>
                    <a href="{{ route('students.directory') }}" class="flex items-center justify-between px-3 py-2.5 rounded-2xl text-pine hover:bg-white/70 text-xs font-semibold transition">
                        <span>Student Directory</span>
                        <span class="px-1.5 py-0.5 bg-white text-nordic border border-glacier rounded-md text-[10px] font-bold">{{ $totalStudents }}</span>
                    </a>
                    <a href="{{ route('actions') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-2xl text-pine hover:bg-white/70 text-xs font-semibold transition">
                        <span>Actions</span>
                    </a>
                    <a href="{{ route('settings') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-2xl text-pine hover:bg-white/70 text-xs font-semibold transition">
                        <span>Settings</span>
                    </a>
                </nav>
            </div>

            <div class="pt-4 border-t border-glacier/70">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full py-2.5 bg-rose-50 text-rose-600 border border-rose-200 rounded-xl text-xs font-bold hover:bg-rose-100 transition flex items-center justify-center space-x-2">
                        <span>Log Out</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Fixed Desktop Left Sidebar Navigation (No snow) -->
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
                    <a href="{{ route('students.index') }}" class="flex items-center justify-between px-3 py-2.5 rounded-2xl bg-white text-nordic font-bold text-xs border border-glacier shadow-sm">
                        <div class="flex items-center space-x-3">
                            <span class="w-1.5 h-1.5 rounded-full bg-nordic"></span>
                            <span>Dashboard</span>
                        </div>
                    </a>
                    <a href="{{ route('students.directory') }}" class="flex items-center justify-between px-3 py-2.5 rounded-2xl text-pine hover:bg-white/70 text-xs font-semibold transition">
                        <div class="flex items-center space-x-3">
                            <span>Student Directory</span>
                        </div>
                        <span class="px-1.5 py-0.5 bg-white text-nordic border border-glacier rounded-md text-[10px] font-bold">{{ $totalStudents }}</span>
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

    <!-- Scrollable Right Main Content Wrapper (Snow only inside right panel) -->
    <main class="relative flex-1 h-full flex flex-col min-w-0 overflow-hidden bg-frost">
        <canvas id="rightPanelSnow" class="pointer-events-none absolute inset-0 w-full h-full z-0"></canvas>

        <header class="relative z-10 bg-[#F2F6FA]/90 border-b border-glacier/70 h-16 flex items-center justify-between px-6 shrink-0">
            <div class="flex items-center space-x-3">
                <button type="button" onclick="toggleMobileSidebar()" class="md:hidden p-2 text-nordic hover:bg-white rounded-xl transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
                <div class="text-xs text-pine font-medium">Workspace / <span class="text-nordic font-semibold">Dashboard</span></div>
            </div>

            <div class="flex items-center space-x-3">
                <div onclick="document.getElementById('profileModal').classList.remove('hidden')" class="w-8 h-8 rounded-xl bg-nordic text-white font-bold text-xs flex items-center justify-center shadow-sm cursor-pointer">
                    {{ strtoupper(substr(session('admin_name', 'Alex Davis'), 0, 2)) }}
                </div>
            </div>
        </header>

        <div class="relative z-10 flex-1 overflow-y-auto p-4 md:p-8 space-y-6">
            @if (session('success'))
                <div class="p-4 bg-white/95 border border-glacier rounded-2xl text-xs font-semibold text-nordic shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="p-4 bg-rose-50 border border-rose-200 rounded-2xl text-xs text-rose-700">
                    <p class="font-bold mb-1">Please fix the following before saving:</p>
                    <ul class="list-disc pl-4 space-y-0.5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Greeting Banner -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between bg-white/95 p-6 rounded-3xl border border-glacier shadow-sm">
                <div>
                    <p id="live-date" class="text-[10px] font-extrabold tracking-widest text-nordic uppercase mb-1">MONDAY, MAY 26</p>
                    <h1 id="live-greeting" class="text-2xl font-extrabold tracking-tight text-nordic">Good morning, {{ session('admin_name', 'Alex') }}.</h1>
                    <p class="text-xs text-pine mt-0.5">Here's what's happening with your student records today.</p>
                </div>
                <button type="button" onclick="openAddModal()" class="mt-4 md:mt-0 px-5 py-3 bg-nordic text-white rounded-2xl text-xs font-bold hover:bg-[#235673] transition shadow-sm flex items-center justify-center space-x-2">
                    <span>+ Add Student</span>
                </button>
            </div>

            <!-- Metric Stats Row -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <a href="{{ route('students.directory') }}" class="bg-white/95 p-6 rounded-3xl border border-glacier shadow-sm flex flex-col justify-between hover:shadow-md transition block">
                    <div>
                        <div class="flex items-center justify-between">
                            <span class="text-[11px] font-bold text-pine uppercase tracking-wider">Total Students</span>
                            <span class="w-8 h-8 rounded-xl bg-frost border border-glacier flex items-center justify-center text-nordic">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0"/></svg>
                            </span>
                        </div>
                        <div class="flex items-baseline space-x-2 mt-3">
                            <span class="text-3xl font-extrabold text-nordic">{{ $totalStudents }}</span>
                            <span class="text-[11px] text-nordic bg-frost border border-glacier/70 px-2.5 py-0.5 rounded-lg font-bold">Live</span>
                        </div>
                        <p class="text-[11px] text-pine mt-1">database records</p>
                    </div>
                    <div class="mt-6 pt-3 border-t border-glacier/50 flex items-center justify-between">
                        <span class="text-[10px] text-pine font-medium">Open Student Directory</span>
                        <span class="text-[10px] font-bold text-nordic">View &rarr;</span>
                    </div>
                </a>

                <a href="{{ Route::has('students.gpa') ? route('students.gpa') : url('/gpa-analytics') }}" class="bg-white/95 p-6 rounded-3xl border border-glacier shadow-sm flex flex-col justify-between hover:shadow-md transition block">
                    <div>
                        <div class="flex items-center justify-between">
                            <span class="text-[11px] font-bold text-pine uppercase tracking-wider">Average GPA</span>
                            <span class="w-8 h-8 rounded-xl bg-frost border border-glacier flex items-center justify-center text-nordic">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                            </span>
                        </div>
                        <div class="flex items-baseline space-x-2 mt-3">
                            <span class="text-3xl font-extrabold text-nordic">{{ number_format((float) $averageGpa, 2) }}</span>
                            <span class="text-[11px] text-nordic bg-frost border border-glacier/70 px-2.5 py-0.5 rounded-lg font-bold">Live</span>
                        </div>
                        <p class="text-[11px] text-pine mt-1">calculated mean (Scale {{ $gpaScale }})</p>
                    </div>
                    <div class="mt-6 pt-3 border-t border-glacier/50 flex items-center justify-between">
                        <span class="text-[11px] text-pine font-medium">View GPA Breakdown</span>
                        <span class="text-[10px] font-bold text-nordic">Open &rarr;</span>
                    </div>
                </a>

                <a href="{{ Route::has('students.courses') ? route('students.courses') : url('/courses') }}" class="bg-white/95 p-6 rounded-3xl border border-glacier shadow-sm flex flex-col justify-between hover:shadow-md transition block">
                    <div>
                        <div class="flex items-center justify-between">
                            <span class="text-[11px] font-bold text-pine uppercase tracking-wider">Active Courses</span>
                            <span class="w-8 h-8 rounded-xl bg-frost border border-glacier flex items-center justify-center text-nordic">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                            </span>
                        </div>
                        <div class="flex items-baseline space-x-2 mt-3">
                            <span class="text-3xl font-extrabold text-nordic">{{ $activeCoursesCount }}</span>
                            <span class="text-[11px] text-nordic bg-frost border border-glacier/70 px-2.5 py-0.5 rounded-lg font-bold">Live</span>
                        </div>
                        <p class="text-[11px] text-pine mt-1">registered courses</p>
                    </div>
                    <div class="mt-6 pt-3 border-t border-glacier/50 flex items-center justify-between">
                        <span class="text-[10px] text-pine font-medium">Manage Courses</span>
                        <span class="text-[10px] font-bold text-nordic">Edit / Delete &rarr;</span>
                    </div>
                </a>
            </div>

            <!-- Student Directory Section -->
            <div class="bg-white/95 rounded-3xl border border-glacier shadow-sm overflow-hidden">
                <div class="p-6 border-b border-glacier/70 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <h2 class="text-base font-bold text-nordic">Student Directory</h2>
                        <p class="text-xs text-pine mt-0.5">Manage and review all enrolled student records.</p>
                    </div>

                    <form method="GET" action="{{ route('students.index') }}" class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                        <div class="relative">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search student..." class="w-full sm:w-64 pl-9 pr-3 py-2 bg-frost/70 border border-glacier rounded-xl text-xs text-nordic focus:outline-none focus:ring-2 focus:ring-nordic/40 shadow-inner">
                            <svg class="w-4 h-4 text-pine absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </div>
                        <select name="sort_by" onchange="this.form.submit()" class="py-2 px-3 bg-frost/70 border border-glacier rounded-xl text-xs text-nordic font-medium focus:outline-none cursor-pointer">
                            <option value="student_id" {{ request('sort_by') == 'student_id' ? 'selected' : '' }}>ID Descending</option>
                            <option value="name" {{ request('sort_by') == 'name' ? 'selected' : '' }}>Sort by Name</option>
                            <option value="gpa" {{ request('sort_by') == 'gpa' ? 'selected' : '' }}>Sort by GPA</option>
                        </select>
                        <button type="button" onclick="openAddModal()" class="px-4 py-2 bg-nordic text-white rounded-xl text-xs font-bold hover:bg-[#235673] transition shadow-sm">
                            + Add Student
                        </button>
                    </form>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-frost/80 border-b border-glacier/70 text-[10px] font-bold text-pine uppercase tracking-wider">
                                <th class="py-3.5 px-4">Student ID</th>
                                <th class="py-3.5 px-4">Full Name</th>
                                <th class="py-3.5 px-4">Course</th>
                                <th class="py-3.5 px-4">GPA</th>
                                <th class="py-3.5 px-4">Status</th>
                                <th class="py-3.5 px-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-glacier/30 text-xs">
                            @forelse ($students as $student)
                                <tr class="hover:bg-frost/40 transition">
                                    <td class="py-4 px-4 font-mono font-semibold text-nordic">{{ $student->student_id }}</td>
                                    <td class="py-4 px-4">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-7 h-7 rounded-full bg-glacier/40 text-nordic font-bold flex items-center justify-center text-[11px] shrink-0">
                                                {{ strtoupper(substr($student->name, 0, 1)) }}
                                            </div>
                                            <p class="font-bold text-nordic">{{ $student->name }}</p>
                                        </div>
                                    </td>
                                    <td class="py-4 px-4 text-pine font-medium">{{ $student->course }}</td>
                                    <td class="py-4 px-4 font-bold text-nordic">{{ number_format((float) $student->gpa, 2) }}</td>
                                    <td class="py-4 px-4">
                                        <span class="inline-flex items-center text-xs text-nordic font-medium bg-frost border border-glacier/70 px-2.5 py-0.5 rounded-full">
                                            <span class="w-1.5 h-1.5 rounded-full bg-nordic mr-1.5"></span> Active
                                        </span>
                                    </td>
                                    <td class="py-4 px-4 text-right space-x-2 whitespace-nowrap">
                                        <button type="button"
                                            onclick="openEditModal(@js($student->id), @js($student->student_id), @js($student->name), @js($student->course), @js($student->gpa))"
                                            class="p-1.5 text-nordic bg-frost hover:bg-glacier/40 rounded-lg border border-glacier transition inline-flex items-center"
                                            title="Edit">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                        </button>
                                        <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-1.5 text-rose-600 hover:text-rose-700 bg-rose-50 hover:bg-rose-100 rounded-lg border border-rose-200 transition inline-flex items-center"
                                                title="Delete"
                                                onclick="return confirm('Are you sure you want to delete this record?')">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-8 text-pine">No student records found in the database.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <!-- Add Student Modal -->
    <div id="addModal" class="fixed inset-0 bg-nordic/35 backdrop-blur-sm hidden flex items-center justify-center p-4 z-50">
        <div class="bg-white rounded-3xl max-w-md w-full p-6 shadow-xl border border-glacier">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-base font-bold text-nordic">Add New Student Record</h3>
                <button type="button" onclick="closeAddModal()" class="text-pine hover:text-nordic text-sm font-bold">X</button>
            </div>
            <form id="addStudentForm" action="{{ route('students.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-[11px] font-bold text-nordic uppercase tracking-wider mb-1">Student ID</label>
                    <input type="text" id="add_student_id" name="student_id" value="{{ old('student_id', $defaultStudentId) }}" required class="w-full px-3 py-2 bg-frost/70 border border-glacier rounded-xl text-xs text-nordic focus:outline-none focus:ring-2 focus:ring-nordic/40 shadow-inner">
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-nordic uppercase tracking-wider mb-1">Full Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" required placeholder="Enter a name" class="w-full px-3 py-2 bg-frost/70 border border-glacier rounded-xl text-xs text-nordic focus:outline-none focus:ring-2 focus:ring-nordic/40 shadow-inner">
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-nordic uppercase tracking-wider mb-1">Course</label>
                    <input type="text" name="course" value="{{ old('course', '') }}" required placeholder="Enter a course" class="w-full px-3 py-2 bg-frost/70 border border-glacier rounded-xl text-xs text-nordic focus:outline-none focus:ring-2 focus:ring-nordic/40 shadow-inner">
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-nordic uppercase tracking-wider mb-1">GPA ({{ $minGpaLabel }} - {{ $gpaScale }})</label>
                    <input type="text" inputmode="decimal" id="add_gpa" name="gpa" value="{{ old('gpa') }}" required placeholder="e.g. 1.75" oninput="cleanGpaInput(this)" class="w-full px-3 py-2 bg-frost/70 border border-glacier rounded-xl text-xs text-nordic focus:outline-none focus:ring-2 focus:ring-nordic/40 shadow-inner">
                </div>
                <div class="flex justify-end space-x-3 pt-2">
                    <button type="button" onclick="closeAddModal()" class="px-4 py-2 bg-frost text-nordic border border-glacier rounded-xl text-xs font-semibold">Cancel</button>
                    <button type="submit" id="saveRecordBtn" class="px-4 py-2 bg-nordic text-white rounded-xl text-xs font-semibold hover:bg-[#235673] transition shadow-sm">Save Record</button>
                </div>
            </form>
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
                    <input type="text" id="edit_student_id" name="student_id" required oninput="enforcePrefixLock(this)" class="w-full px-3 py-2 bg-frost/70 border border-glacier rounded-xl text-xs text-nordic focus:outline-none focus:ring-2 focus:ring-nordic/40 shadow-inner">
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-nordic uppercase tracking-wider mb-1">Full Name</label>
                    <input type="text" id="edit_name" name="name" required class="w-full px-3 py-2 bg-frost/70 border border-glacier rounded-xl text-xs text-nordic focus:outline-none focus:ring-2 focus:ring-nordic/40 shadow-inner">
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-nordic uppercase tracking-wider mb-1">Course</label>
                    <input type="text" id="edit_course" name="course" required placeholder="Enter a course" class="w-full px-3 py-2 bg-frost/70 border border-glacier rounded-xl text-xs text-nordic focus:outline-none focus:ring-2 focus:ring-nordic/40 shadow-inner">
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-nordic uppercase tracking-wider mb-1">GPA ({{ $minGpaLabel }} - {{ $gpaScale }})</label>
                    <input type="text" inputmode="decimal" id="edit_gpa" name="gpa" required oninput="cleanGpaInput(this)" class="w-full px-3 py-2 bg-frost/70 border border-glacier rounded-xl text-xs text-nordic focus:outline-none focus:ring-2 focus:ring-nordic/40 shadow-inner">
                </div>
                <div class="flex justify-end space-x-3 pt-2">
                    <button type="button" onclick="document.getElementById('editModal').classList.add('hidden')" class="px-4 py-2 bg-frost text-nordic border border-glacier rounded-xl text-xs font-semibold">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-nordic text-white rounded-xl text-xs font-semibold hover:bg-[#235673] transition shadow-sm">Update Changes</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Admin Profile Modal -->
    <div id="profileModal" class="fixed inset-0 bg-nordic/35 backdrop-blur-sm hidden flex items-center justify-center p-4 z-50">
        <div class="bg-white rounded-3xl max-w-md w-full p-6 shadow-xl border border-glacier space-y-4">
            <div class="flex justify-between items-center">
                <h3 class="text-base font-bold text-nordic">Admin Profile Settings</h3>
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

        function toggleMobileSidebar() {
            document.getElementById('mobileSidebar').classList.toggle('hidden');
        }

        function openAddModal() {
            const addIdInput = document.getElementById('add_student_id');
            if (addIdInput) {
                addIdInput.value = @js($defaultStudentId);
            }
            const saveBtn = document.getElementById('saveRecordBtn');
            if (saveBtn) {
                saveBtn.disabled = false;
                saveBtn.innerHTML = 'Save Record';
            }
            document.getElementById('addModal').classList.remove('hidden');
        }

        function closeAddModal() {
            document.getElementById('addModal').classList.add('hidden');
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

        document.addEventListener('DOMContentLoaded', function () {
            const addForm = document.getElementById('addStudentForm');
            if (addForm) {
                addForm.addEventListener('submit', function () {
                    const gpaInput = document.getElementById('add_gpa');
                    if (gpaInput) cleanGpaInput(gpaInput);
                    const btn = document.getElementById('saveRecordBtn');
                    if (btn) {
                        btn.disabled = true;
                        btn.innerHTML = 'Saving...';
                    }
                });
            }

            const now = new Date();
            const options = { weekday: 'long', month: 'short', day: 'numeric' };
            const dateElement = document.getElementById('live-date');
            if (dateElement) {
                dateElement.textContent = now.toLocaleDateString('en-US', options).toUpperCase();
            }

            const hours = now.getHours();
            let timeGreeting = 'Good morning';
            if (hours >= 12 && hours < 18) {
                timeGreeting = 'Good afternoon';
            } else if (hours >= 18) {
                timeGreeting = 'Good evening';
            }
            const userName = @js(session('admin_name', 'Alex'));
            const greetingElement = document.getElementById('live-greeting');
            if (greetingElement) {
                greetingElement.textContent = `${timeGreeting}, ${userName}.`;
            }
        });

        // Snow strictly inside right panel
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
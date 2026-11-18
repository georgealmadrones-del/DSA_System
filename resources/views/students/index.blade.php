<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>EduCore Student Records SaaS</title>
<!-- Tailwind CSS CDN -->
<script src="https://cdn.tailwindcss.com"></script>
<script>
tailwind.config = {
    theme: {
        extend: {
            colors: {
                charcoal: '#4A4A4A',
                coolgrey: '#CBCBCB',
                ivory: '#FFFFE3',
                slateblue: '#2B6CB0',
            }
        }
    }
}
</script>
</head>
<body class="bg-[#FCFBF7] text-charcoal font-sans antialiased h-screen overflow-hidden flex selection:bg-slateblue/20">

<!-- Mobile Sidebar Overlay Drawer -->
<div id="mobileSidebar" class="fixed inset-0 bg-charcoal/50 backdrop-blur-sm z-50 hidden md:hidden flex">
    <div class="w-64 h-full bg-[#FFFEEB] border-r border-coolgrey/30 flex flex-col justify-between shadow-2xl p-4">
        <div>
            <!-- Drawer Header & Close Button -->
            <div class="flex items-center justify-between pb-4 border-b border-coolgrey/20">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 rounded-xl bg-charcoal flex items-center justify-center text-white shadow-md">
                        <div class="grid grid-cols-2 gap-0.5">
                            <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                            <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                            <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                            <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                        </div>
                    </div>
                    <span class="font-extrabold text-sm text-charcoal">EduCore SaaS</span>
                </div>
                <button onclick="toggleMobileSidebar()" class="text-gray-400 hover:text-charcoal font-bold text-lg p-1">✕</button>
            </div>

            <!-- Workspace Selector -->
            <div class="py-4">
                <div class="p-3 bg-white rounded-2xl border border-coolgrey/30 flex items-center justify-between text-xs shadow-sm">
                    <div class="flex items-center space-x-2.5">
                        <div class="w-7 h-7 rounded-xl bg-gray-50 border border-coolgrey/30 flex items-center justify-center font-bold text-[10px] text-charcoal">EA</div>
                        <div>
                            <p class="font-bold text-charcoal leading-tight">{{ session('workspace_name', 'Eastwood Academy') }}</p>
                            <p class="text-[10px] text-slateblue font-medium mt-0.5">Academic workspace</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mobile Navigation Links -->
            <nav class="space-y-1">
                <p class="px-3 text-[10px] font-bold uppercase tracking-wider text-slateblue/70 mb-2">Workspace</p>
                <a href="{{ route('students.index') }}" class="flex items-center justify-between px-3 py-2.5 rounded-2xl bg-white text-charcoal font-bold text-xs border border-coolgrey/30 shadow-md">
                    <div class="flex items-center space-x-3">
                        <span class="w-1.5 h-1.5 rounded-full bg-charcoal"></span>
                        <span>Dashboard</span>
                    </div>
                </a>
                <a href="{{ route('students.directory') }}" class="flex items-center justify-between px-3 py-2.5 rounded-2xl text-charcoal/70 hover:bg-white/60 text-xs font-semibold transition">
                    <span>Student Directory</span>
                    <span class="px-1.5 py-0.5 bg-gray-100 text-charcoal rounded-md text-[10px] font-bold">{{ $totalStudents }}</span>
                </a>
                <a href="{{ route('actions') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-2xl text-charcoal/70 hover:bg-white/60 text-xs font-semibold transition">
                    <span>Actions</span>
                </a>
                <a href="{{ route('settings') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-2xl text-charcoal/70 hover:bg-white/60 text-xs font-semibold transition">
                    <span>Settings</span>
                </a>
            </nav>
        </div>

        <!-- Mobile Drawer Footer / Logout -->
        <div class="pt-4 border-t border-coolgrey/20">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full py-2.5 bg-rose-50 text-rose-600 rounded-xl text-xs font-bold hover:bg-rose-100 transition flex items-center justify-center space-x-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    <span>Log Out</span>
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Fixed Desktop Left Sidebar Navigation -->
<aside class="w-64 h-full bg-[#FFFEEB]/80 backdrop-blur-md border-r border-coolgrey/30 flex flex-col justify-between hidden md:flex shrink-0 shadow-lg">
    <div>
        <!-- Logo Area -->
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

        <!-- Workspace Selector -->
        <div class="p-4">
            <div class="p-3 bg-white rounded-2xl border border-coolgrey/30 flex items-center justify-between text-xs shadow-sm">
                <div class="flex items-center space-x-2.5">
                    <div class="w-7 h-7 rounded-xl bg-gray-50 border border-coolgrey/30 flex items-center justify-center font-bold text-[10px] text-charcoal">EA</div>
                    <div>
                        <p class="font-bold text-charcoal leading-tight">{{ session('workspace_name', 'Eastwood Academy') }}</p>
                        <p class="text-[10px] text-slateblue font-medium mt-0.5">Academic workspace</p>
                    </div>
                </div>
                <svg class="w-4 h-4 text-coolgrey" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
            </div>
        </div>

        <!-- Navigation Links -->
        <div class="px-4 py-2">
            <p class="px-3 text-[10px] font-bold uppercase tracking-wider text-slateblue/70 mb-2">Workspace</p>
            <nav class="space-y-1">
                <a href="{{ route('students.index') }}" class="flex items-center justify-between px-3 py-2.5 rounded-2xl bg-white text-charcoal font-bold text-xs border border-coolgrey/30 shadow-md">
                    <div class="flex items-center space-x-3">
                        <span class="w-1.5 h-1.5 rounded-full bg-charcoal"></span>
                        <span>Dashboard</span>
                    </div>
                </a>
                <a href="{{ route('students.directory') }}" class="flex items-center justify-between px-3 py-2.5 rounded-2xl text-charcoal/70 hover:bg-white/60 text-xs font-semibold transition">
                    <div class="flex items-center space-x-3">
                        <span>Student Directory</span>
                    </div>
                    <span class="px-1.5 py-0.5 bg-gray-100 text-charcoal rounded-md text-[10px] font-bold">{{ $totalStudents }}</span>
                </a>
                <a href="{{ route('actions') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-2xl text-charcoal/70 hover:bg-white/60 text-xs font-semibold transition">
                    <span>Actions</span>
                </a>
            </nav>
        </div>
    </div>

    <!-- Bottom Pinned Manage & Admin Profile -->
    <div class="p-4 border-t border-coolgrey/20 space-y-4">
        <div class="px-2">
            <p class="px-3 text-[10px] font-bold uppercase tracking-wider text-slateblue/70 mb-1">Manage</p>
            <a href="{{ route('settings') }}" class="flex items-center space-x-3 px-3 py-2 rounded-2xl text-charcoal/70 hover:bg-white/60 text-xs font-semibold transition">
                <span>Settings</span>
            </a>
        </div>
        <!-- Admin Profile Card with Secure Log Out Form -->
        <div class="flex items-center justify-between p-3 bg-white border border-coolgrey/30 rounded-2xl shadow-md">
            <div onclick="document.getElementById('profileModal').classList.remove('hidden')" class="flex items-center space-x-3 cursor-pointer min-w-0 flex-1">
                <div class="w-8 h-8 rounded-full bg-slateblue/20 text-slateblue font-bold flex items-center justify-center text-xs shrink-0">AD</div>
                <div class="min-w-0">
                    <p class="text-xs font-bold text-charcoal truncate">{{ session('admin_name', 'Alex Davis') }}</p>
                    <p class="text-[10px] text-slateblue font-medium truncate">Administrator</p>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" title="Log Out" class="p-1.5 text-gray-400 hover:text-rose-600 hover:bg-rose-50 rounded-xl transition shrink-0 ml-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                </button>
            </form>
        </div>
    </div>
</aside>

<!-- Scrollable Right Main Content Wrapper -->
<main class="flex-1 h-full flex flex-col min-w-0 overflow-hidden">
    <!-- Top Header Bar with Mobile Hamburger -->
    <header class="bg-[#FCFBF7] border-b border-coolgrey/20 h-16 flex items-center justify-between px-6 shrink-0 shadow-sm">
        <div class="flex items-center space-x-3">
            <button onclick="toggleMobileSidebar()" class="md:hidden p-2 text-charcoal hover:bg-gray-100 rounded-xl transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
            <div class="text-xs text-slateblue font-medium">Workspace / <span class="text-charcoal font-semibold">Dashboard</span></div>
        </div>
        <div class="flex items-center space-x-3">
            <div onclick="document.getElementById('profileModal').classList.remove('hidden')" class="w-8 h-8 rounded-xl bg-charcoal text-white font-bold text-xs flex items-center justify-center shadow-md cursor-pointer">AD</div>
        </div>
    </header>

    <!-- Independent Scrolling Area -->
    <div class="flex-1 overflow-y-auto p-4 md:p-8 space-y-6">
        <!-- Greeting Banner -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between bg-white p-6 rounded-3xl border border-coolgrey/20 shadow-md">
            <div>
                <!-- Real-time Date ID -->
                <p id="live-date" class="text-[10px] font-extrabold uppercase tracking-widest text-slateblue mb-1">MONDAY, MAY 26</p>
                <!-- Real-time Greeting ID -->
                <h1 id="live-greeting" class="text-2xl font-extrabold tracking-tight text-charcoal">Good morning, {{ session('admin_name', 'Alex') }}.</h1>
                <p class="text-xs text-slateblue mt-0.5">Here's what's happening with your student records today.</p>
            </div>
            <button onclick="document.getElementById('addModal').classList.remove('hidden')" class="mt-4 md:mt-0 px-5 py-3 bg-charcoal text-white rounded-2xl text-xs font-bold hover:bg-charcoal/90 transition shadow-lg flex items-center justify-center space-x-2">
                <span>+ Add Student</span>
            </button>
        </div>

        <!-- Metric Stats Row -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Total Students Card -->
            <div class="bg-white p-6 rounded-3xl border border-coolgrey/20 shadow-md flex flex-col justify-between hover:shadow-lg transition">
                <div>
                    <div class="flex items-center justify-between">
                        <span class="text-[11px] font-bold text-slateblue uppercase tracking-wider">Total Students</span>
                        <span class="w-8 h-8 rounded-xl bg-gray-50 border border-coolgrey/30 flex items-center justify-center text-slateblue">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0"/></svg>
                        </span>
                    </div>
                    <div class="flex items-baseline space-x-2 mt-3">
                        <span class="text-3xl font-extrabold text-charcoal">{{ $totalStudents }}</span>
                        <span class="text-[11px] text-emerald-700 bg-emerald-50 px-2.5 py-0.5 rounded-lg font-bold">Live</span>
                    </div>
                    <p class="text-[11px] text-slateblue mt-1">database records</p>
                </div>
                <div class="mt-6 pt-3 border-t border-coolgrey/10 flex items-center justify-between">
                    <span class="text-[10px] text-slateblue font-medium">Growth trend</span>
                    <svg class="w-32 h-8 text-slateblue/70" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 120 30">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 25 Q 35 20, 60 15 T 115 5"></path>
                    </svg>
                </div>
            </div>

            <!-- Average GPA Card -->
            <div class="bg-white p-6 rounded-3xl border border-coolgrey/20 shadow-md flex flex-col justify-between hover:shadow-lg transition">
                <div>
                    <div class="flex items-center justify-between">
                        <span class="text-[11px] font-bold text-slateblue uppercase tracking-wider">Average GPA</span>
                        <span class="w-8 h-8 rounded-xl bg-gray-50 border border-coolgrey/30 flex items-center justify-center text-slateblue">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                        </span>
                    </div>
                    <div class="flex items-baseline space-x-2 mt-3">
                        <span class="text-3xl font-extrabold text-charcoal">{{ number_format($averageGpa, 2) }}</span>
                        <span class="text-[11px] text-emerald-700 bg-emerald-50 px-2.5 py-0.5 rounded-lg font-bold">Live</span>
                    </div>
                    <p class="text-[11px] text-slateblue mt-1">calculated mean</p>
                </div>
                <div class="mt-6 pt-3 border-t border-coolgrey/10 flex items-center justify-between">
                    <span class="text-[11px] text-slateblue font-medium">Scale System</span>
                    <div class="relative w-8 h-8 flex items-center justify-center">
                        <svg class="w-8 h-8 transform -rotate-90" viewBox="0 0 36 36">
                            <path class="text-gray-200" stroke-width="3.5" stroke="currentColor" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"/>
                            <path class="text-charcoal" stroke-dasharray="95, 100" stroke-width="3.5" stroke-linecap="round" stroke="currentColor" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"/>
                        </svg>
                        <span class="absolute text-[9px] font-extrabold text-charcoal">95%</span>
                    </div>
                </div>
            </div>

            <!-- Active Courses Card -->
            <div class="bg-white p-6 rounded-3xl border border-coolgrey/20 shadow-md flex flex-col justify-between hover:shadow-lg transition">
                <div>
                    <div class="flex items-center justify-between">
                        <span class="text-[11px] font-bold text-slateblue uppercase tracking-wider">Active Courses</span>
                        <span class="w-8 h-8 rounded-xl bg-gray-50 border border-coolgrey/30 flex items-center justify-center text-slateblue">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        </span>
                    </div>
                    <div class="flex items-baseline space-x-2 mt-3">
                        <span class="text-3xl font-extrabold text-charcoal">{{ $activeCoursesCount }}</span>
                        <span class="text-[11px] text-emerald-700 bg-emerald-50 px-2.5 py-0.5 rounded-lg font-bold">Live</span>
                    </div>
                    <p class="text-[11px] text-slateblue mt-1">unique programs registered</p>
                </div>
                <div class="mt-6 pt-3 border-t border-coolgrey/10 flex items-center justify-between">
                    <span class="text-[10px] text-slateblue font-medium">Database Synced</span>
                    <span class="text-[10px] font-bold text-charcoal bg-gray-100 px-2 py-0.5 rounded-md">BSIT Active</span>
                </div>
            </div>
        </div>

        <!-- Dismissible Duplicate Record Check Banner -->
        <div class="bg-white p-4 rounded-3xl border border-coolgrey/20 shadow-md flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 rounded-xl bg-gray-50 border border-coolgrey/30 flex items-center justify-center text-slateblue">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </div>
                <div>
                    <p class="text-xs font-bold text-charcoal">Duplicate record check is active</p>
                    <p class="text-[11px] text-slateblue">EduCore automatically checks student IDs and email addresses before saving new records.</p>
                </div>
            </div>
            <button onclick="this.closest('div.flex').remove()" class="text-coolgrey hover:text-charcoal text-sm font-bold px-2">X</button>
        </div>

        <!-- Student Directory Section -->
        <div class="bg-white rounded-3xl border border-coolgrey/20 shadow-md overflow-hidden">
            <div class="p-6 border-b border-coolgrey/20 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h2 class="text-base font-bold text-charcoal">Student Directory</h2>
                    <p class="text-xs text-slateblue mt-0.5">Manage and review all enrolled student records.</p>
                </div>
                <!-- Search and Sort Toolbar -->
                <form method="GET" action="{{ route('students.index') }}" class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                    <div class="relative">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search student..." class="w-full sm:w-64 pl-9 pr-12 py-2 bg-gray-50 border border-coolgrey/30 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-slateblue/50 shadow-inner">
                        <svg class="w-4 h-4 text-coolgrey absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        <span class="absolute right-2.5 top-2 text-charcoal px-1.5 py-0.5 rounded text-[10px] bg-gray-200 font-mono">HK</span>
                    </div>
                    <select name="sort_by" onchange="this.form.submit()" class="py-2 px-3 bg-gray-50 border border-coolgrey/30 rounded-xl text-xs text-charcoal font-medium focus:outline-none cursor-pointer shadow-sm">
                        <option value="student_id" {{ request('sort_by') == 'student_id' ? 'selected' : '' }}>ID Descending</option>
                        <option value="name" {{ request('sort_by') == 'name' ? 'selected' : '' }}>Sort by Name</option>
                        <option value="gpa" {{ request('sort_by') == 'gpa' ? 'selected' : '' }}>Sort by GPA</option>
                    </select>
                    <button type="button" onclick="document.getElementById('addModal').classList.remove('hidden')" class="px-4 py-2 bg-charcoal text-white rounded-xl text-xs font-bold hover:bg-charcoal/90 transition shadow-md">
                        + Add Student
                    </button>
                </form>
            </div>

            <!-- Data Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/70 border-b border-coolgrey/20 text-[10px] font-bold text-slateblue uppercase tracking-wider">
                            <th class="py-3.5 px-4 w-10 text-center"><input type="checkbox" class="rounded border-coolgrey/40"></th>
                            <th class="py-3.5 px-4">Student ID</th>
                            <th class="py-3.5 px-4">Full Name</th>
                            <th class="py-3.5 px-4">Course</th>
                            <th class="py-3.5 px-4">GPA</th>
                            <th class="py-3.5 px-4">Status</th>
                            <th class="py-3.5 px-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-coolgrey/10 text-xs">
                        @forelse ($students as $student)
                        <tr class="hover:bg-gray-50/50 transition">
                            <td class="py-4 px-4 text-center"><input type="checkbox" class="rounded border-coolgrey/40"></td>
                            <td class="py-4 px-4 font-mono font-semibold text-charcoal">{{ $student->student_id }}</td>
                            <td class="py-4 px-4 flex items-center space-x-3">
                                <div class="w-7 h-7 rounded-full bg-slateblue/15 text-slateblue font-bold flex items-center justify-center text-[11px] shrink-0">
                                    {{ substr($student->name, 0, 1) }}
                                </div>
                                <div>
                                    <p class="font-bold text-charcoal">{{ $student->name }}</p>
                                    <p class="text-[11px] text-slateblue">{{ strtolower(str_replace(' ', '', $student->name)) }}@educore.edu</p>
                                </div>
                            </td>
                            <td class="py-4 px-4 text-slateblue font-medium">{{ $student->course ?? 'BSIT' }}</td>
                            <td class="py-4 px-4 font-bold text-charcoal">{{ number_format($student->gpa, 2) }}</td>
                            <td class="py-4 px-4">
                                <span class="inline-flex items-center text-xs text-emerald-700 font-medium bg-emerald-50 px-2.5 py-0.5 rounded-full">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5"></span> Active
                                </span>
                            </td>
                            <td class="py-4 px-4 text-right space-x-2">
                                <button type="button" onclick="openEditModal('{{ $student->id }}', '{{ $student->student_id }}', '{{ $student->name }}', '{{ $student->course ?? 'BSIT' }}', '{{ $student->gpa }}')" class="p-1.5 text-slateblue hover:text-charcoal bg-gray-50 hover:bg-gray-100 rounded-lg border border-coolgrey/30 transition inline-flex items-center shadow-sm" title="Edit">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                </button>
                                <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 text-rose-500 hover:text-rose-700 bg-rose-50 hover:bg-rose-100 rounded-lg border border-rose-200 transition inline-flex items-center shadow-sm" title="Delete" onclick="return confirm('Are you sure you want to delete this record?')">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-8 text-slateblue">No student records found in the database.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<!-- Add Student Modal -->
<div id="addModal" class="fixed inset-0 bg-charcoal/50 backdrop-blur-sm hidden flex items-center justify-center p-4 z-50">
    <div class="bg-white rounded-3xl max-w-md w-full p-6 shadow-2xl border border-coolgrey/20">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-base font-bold text-charcoal">Add New Student Record</h3>
            <button onclick="document.getElementById('addModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600 text-sm font-bold">X</button>
        </div>
        
        <!-- Validation Error Display -->
        @if ($errors->any())
            <div class="mb-4 p-3 bg-rose-50 border border-rose-200 rounded-xl text-xs text-rose-600">
                <ul class="list-disc pl-4">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('students.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-[11px] font-bold text-slateblue uppercase tracking-wider mb-1">Student ID (Unique)</label>
                <input type="text" name="student_id" required placeholder="e.g. STU-1043" class="w-full px-3 py-2 bg-gray-50 border border-coolgrey/30 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-slateblue/50 shadow-inner">
            </div>
            <div>
                <label class="block text-[11px] font-bold text-slateblue uppercase tracking-wider mb-1">Full Name</label>
                <input type="text" name="name" required placeholder="Enter a name" class="w-full px-3 py-2 bg-gray-50 border border-coolgrey/30 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-slateblue/50 shadow-inner">
            </div>
            <div>
                <label class="block text-[11px] font-bold text-slateblue uppercase tracking-wider mb-1">Course</label>
                <input type="text" name="course" value="BSIT" required class="w-full px-3 py-2 bg-gray-50 border border-coolgrey/30 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-slateblue/50 shadow-inner">
            </div>
            <div>
                <label class="block text-[11px] font-bold text-slateblue uppercase tracking-wider mb-1">GPA (1.00 - 3.00)</label>
                <input type="number" step="0.01" min="1" max="3" name="gpa" required placeholder="e.g. 1.75" class="w-full px-3 py-2 bg-gray-50 border border-coolgrey/30 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-slateblue/50 shadow-inner">
            </div>
            <div class="flex justify-end space-x-3 pt-2">
                <button type="button" onclick="document.getElementById('addModal').classList.add('hidden')" class="px-4 py-2 bg-gray-100 text-charcoal rounded-xl text-xs font-semibold">Cancel</button>
                <button type="submit" onclick="this.innerHTML='Saving...'; this.disabled=true; this.form.submit();" class="px-4 py-2 bg-charcoal text-white rounded-xl text-xs font-semibold hover:bg-charcoal/90 transition shadow-md">Save Record</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Student Modal -->
<div id="editModal" class="fixed inset-0 bg-charcoal/50 backdrop-blur-sm hidden flex items-center justify-center p-4 z-50">
    <div class="bg-white rounded-3xl max-w-md w-full p-6 shadow-2xl border border-coolgrey/20">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-base font-bold text-charcoal">Edit Student Record</h3>
            <button onclick="document.getElementById('editModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600 text-sm font-bold">X</button>
        </div>
        <form id="editForm" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-[11px] font-bold text-slateblue uppercase tracking-wider mb-1">Student ID (Unique)</label>
                <input type="text" id="edit_student_id" name="student_id" required class="w-full px-3 py-2 bg-gray-50 border border-coolgrey/30 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-slateblue/50 shadow-inner">
            </div>
            <div>
                <label class="block text-[11px] font-bold text-slateblue uppercase tracking-wider mb-1">Full Name</label>
                <input type="text" id="edit_name" name="name" required class="w-full px-3 py-2 bg-gray-50 border border-coolgrey/30 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-slateblue/50 shadow-inner">
            </div>
            <div>
                <label class="block text-[11px] font-bold text-slateblue uppercase tracking-wider mb-1">Course</label>
                <input type="text" id="edit_course" name="course" required class="w-full px-3 py-2 bg-gray-50 border border-coolgrey/30 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-slateblue/50 shadow-inner">
            </div>
            <div>
                <label class="block text-[11px] font-bold text-slateblue uppercase tracking-wider mb-1">GPA (1.00 - 3.00)</label>
                <input type="number" step="0.01" min="1" max="3" id="edit_gpa" name="gpa" required class="w-full px-3 py-2 bg-gray-50 border border-coolgrey/30 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-slateblue/50 shadow-inner">
            </div>
            <div class="flex justify-end space-x-3 pt-2">
                <button type="button" onclick="document.getElementById('editModal').classList.add('hidden')" class="px-4 py-2 bg-gray-100 text-charcoal rounded-xl text-xs font-semibold">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-charcoal text-white rounded-xl text-xs font-semibold hover:bg-charcoal/90 transition shadow-md">Update Changes</button>
            </div>
        </form>
    </div>
</div>

<!-- Admin Profile Modal -->
<div id="profileModal" class="fixed inset-0 bg-charcoal/50 backdrop-blur-sm hidden flex items-center justify-center p-4 z-50">
    <div class="bg-white rounded-3xl max-w-md w-full p-6 shadow-2xl border border-coolgrey/20 space-y-4">
        <div class="flex justify-between items-center">
            <h3 class="text-base font-bold text-charcoal">Admin Profile Settings</h3>
            <button onclick="document.getElementById('profileModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600 text-sm font-bold">X</button>
        </div>
        <div class="flex items-center space-x-4 p-4 bg-gray-50 rounded-2xl border border-coolgrey/20">
            <div class="w-12 h-12 rounded-full bg-slateblue/20 text-slateblue font-bold flex items-center justify-center text-sm">AD</div>
            <div>
                <p class="text-sm font-bold text-charcoal">{{ session('admin_name', 'Alex Davis') }}</p>
                <p class="text-xs text-slateblue">alex.davis@educore.edu</p>
                <span class="inline-block mt-1 px-2 py-0.5 bg-emerald-100 text-emerald-800 text-[10px] font-bold rounded-full">System Administrator</span>
            </div>
        </div>
        <div class="flex justify-end pt-2">
            <button onclick="document.getElementById('profileModal').classList.add('hidden')" class="px-4 py-2 bg-charcoal text-white rounded-xl text-xs font-semibold shadow-md">Close</button>
        </div>
    </div>
</div>

<!-- JavaScript for Mobile Drawer, Modals, and Real-Time Date/Greeting -->
<script>
function toggleMobileSidebar() {
    const sidebar = document.getElementById('mobileSidebar');
    sidebar.classList.toggle('hidden');
}

function openEditModal(id, studentId, name, course, gpa) {
    const form = document.getElementById('editForm');
    form.action = `/students/${id}`;
    document.getElementById('edit_student_id').value = studentId;
    document.getElementById('edit_name').value = name;
    document.getElementById('edit_course').value = course;
    document.getElementById('edit_gpa').value = gpa;
    document.getElementById('editModal').classList.remove('hidden');
}

document.addEventListener("DOMContentLoaded", function () {
    const now = new Date();

    // 1. Real-Time Date (e.g., "WEDNESDAY, NOVEMBER 18")
    const options = { weekday: 'long', month: 'short', day: 'numeric' };
    const dateString = now.toLocaleDateString('en-US', options).toUpperCase();
    const dateElement = document.getElementById('live-date');
    if (dateElement) {
        dateElement.textContent = dateString;
    }

    // 2. Real-Time Dynamic Greeting based on Local Hour
    const hours = now.getHours();
    let timeGreeting = "Good morning";
    if (hours >= 12 && hours < 18) {
        timeGreeting = "Good afternoon";
    } else if (hours >= 18) {
        timeGreeting = "Good evening";
    }

    const userName = "{{ session('admin_name', 'Alex') }}";
    const greetingElement = document.getElementById('live-greeting');
    if (greetingElement) {
        greetingElement.textContent = `${timeGreeting}, ${userName}.`;
    }
});
</script>
</body>
</html>
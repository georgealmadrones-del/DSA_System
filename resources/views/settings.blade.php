<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>EduCore SaaS Workspace Settings</title>
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
                slateblue: '#6D8196',
            }
        }
    }
}
</script>
</head>
<body class="bg-[#FCFBF7] text-charcoal font-sans antialiased h-screen overflow-hidden flex selection:bg-slateblue/20">

<!-- Fixed Left Sidebar Navigation -->
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

<!-- Manage Section & Admin Profile Card -->
<div class="p-4 border-t border-coolgrey/20 space-y-4">
<div class="px-2">
<p class="px-3 text-[10px] font-bold uppercase tracking-wider text-slateblue/70 mb-1">Manage</p>
<a href="{{ route('settings') }}" class="flex items-center space-x-3 px-3 py-2 rounded-2xl bg-white text-charcoal font-bold text-xs border border-coolgrey/30 shadow-md">
<span>Settings</span>
</a>
</div>

<!-- Admin Profile Card with Direct Log Out Icon Button -->
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
<!-- Top Header Bar -->
<header class="bg-[#FCFBF7] border-b border-coolgrey/20 h-16 flex items-center justify-between px-8 shrink-0 shadow-sm">
<div class="text-xs text-slateblue font-medium">Manage / <span class="text-charcoal font-semibold">Settings</span></div>
<div class="flex items-center space-x-3">
<div onclick="document.getElementById('profileModal').classList.remove('hidden')" class="w-8 h-8 rounded-xl bg-charcoal text-white font-bold text-xs flex items-center justify-center shadow-md cursor-pointer">
{{ strtoupper(substr(session('admin_name', 'Alex Davis'), 0, 2)) }}
</div>
</div>
</header>

<!-- Settings Content Scroll Area -->
<div class="flex-1 overflow-y-auto p-8 space-y-6 max-w-5xl">
<!-- Page Title Banner -->
<div>
<h1 class="text-2xl font-extrabold tracking-tight text-charcoal">Workspace Settings</h1>
<p class="text-xs text-slateblue mt-0.5">Configure academic parameters, validation rules, and system maintenance preferences.</p>
</div>

@if(session('success'))
<div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-bold rounded-2xl shadow-sm">
{{ session('success') }}
</div>
@endif

<!-- Settings Form -->
<form action="{{ route('settings.update') }}" method="POST" class="bg-white rounded-3xl border border-coolgrey/20 shadow-md p-8 space-y-8">
@csrf
<!-- General Configuration Section -->
<div>
<h3 class="text-xs font-bold text-charcoal uppercase tracking-wider mb-4">General Configuration</h3>
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
<div>
<label class="block text-[11px] font-bold text-slateblue uppercase tracking-wider mb-1">Workspace Name</label>
<input type="text" name="workspace_name" value="{{ session('workspace_name', 'Eastwood Academy') }}" required class="w-full px-3.5 py-2.5 bg-gray-50 border border-coolgrey/30 rounded-xl text-xs shadow-inner focus:outline-none focus:ring-2 focus:ring-slateblue/50">
</div>
<div>
<label class="block text-[11px] font-bold text-slateblue uppercase tracking-wider mb-1">Active Term / Academic Year</label>
<select class="w-full px-3.5 py-2.5 bg-gray-50 border border-coolgrey/30 rounded-xl text-xs text-charcoal font-medium shadow-inner focus:outline-none">
<option>Fall 2026 - 2027</option>
</select>
</div>
</div>
</div>

<!-- Grading & Analytics Scale Section -->
<div class="pt-6 border-t border-coolgrey/10">
<h3 class="text-xs font-bold text-charcoal uppercase tracking-wider mb-4">Grading & Analytics Scale</h3>
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
<div>
<label class="block text-[11px] font-bold text-slateblue uppercase tracking-wider mb-1">GPA Scale System</label>
<select class="w-full px-3.5 py-2.5 bg-gray-50 border border-coolgrey/30 rounded-xl text-xs text-charcoal font-medium shadow-inner focus:outline-none">
<option>4.00 Standard Scale</option>
</select>
</div>
<div>
<label class="block text-[11px] font-bold text-slateblue uppercase tracking-wider mb-1">Default Student ID Prefix</label>
<input type="text" value="STU-" class="w-full px-3.5 py-2.5 bg-gray-50 border border-coolgrey/30 rounded-xl text-xs shadow-inner focus:outline-none focus:ring-2 focus:ring-slateblue/50">
</div>
</div>
</div>

<!-- Data Integrity & Validation Section -->
<div class="pt-6 border-t border-coolgrey/10">
<h3 class="text-xs font-bold text-charcoal uppercase tracking-wider mb-4">Data Integrity & Validation</h3>
<div class="space-y-4">
<label class="flex items-start space-x-3 cursor-pointer">
<input type="checkbox" checked class="mt-0.5 rounded border-coolgrey/40 text-charcoal focus:ring-slateblue/50">
<div>
<p class="text-xs font-bold text-charcoal">Strict Duplicate Record Checking</p>
<p class="text-[11px] text-slateblue">Automatically check student IDs and prevent duplicate entries on creation.</p>
</div>
</label>
<label class="flex items-start space-x-3 cursor-pointer">
<input type="checkbox" checked class="mt-0.5 rounded border-coolgrey/40 text-charcoal focus:ring-slateblue/50">
<div>
<p class="text-xs font-bold text-charcoal">Automated Audit Telemetry Logging</p>
<p class="text-[11px] text-slateblue">Record all CRUD executions and modifications in the Actions Log.</p>
</div>
</label>
</div>
</div>

<!-- Data Maintenance Section -->
<div class="pt-6 border-t border-coolgrey/10 flex items-center justify-between">
<div>
<h3 class="text-xs font-bold text-charcoal uppercase tracking-wider">Data Maintenance</h3>
<p class="text-[11px] text-slateblue mt-0.5">Export active student records as a formatted CSV report.</p>
</div>
<button type="button" class="px-4 py-2 bg-gray-50 hover:bg-gray-100 border border-coolgrey/30 rounded-xl text-xs font-semibold text-charcoal transition shadow-sm">Export CSV</button>
</div>

<!-- Save Changes Submit Button -->
<div class="pt-6 border-t border-coolgrey/10 flex justify-end">
<button type="submit" class="px-6 py-3 bg-charcoal text-white rounded-xl text-xs font-bold hover:bg-charcoal/90 transition shadow-md">Save Changes</button>
</div>
</form>
</div>
</main>

<!-- Admin Profile & Log Out Modal -->
<div id="profileModal" class="fixed inset-0 bg-charcoal/50 backdrop-blur-sm hidden flex items-center justify-center p-4 z-50">
<div class="bg-white rounded-3xl max-w-md w-full p-6 shadow-2xl border border-coolgrey/20 space-y-4">
<div class="flex justify-between items-center">
<h3 class="text-base font-bold text-charcoal">Admin Profile & Session</h3>
<button onclick="document.getElementById('profileModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600 text-sm font-bold">X</button>
</div>
<div class="flex items-center space-x-4 p-4 bg-gray-50 rounded-2xl border border-coolgrey/20">
<div class="w-12 h-12 rounded-full bg-slateblue/20 text-slateblue font-bold flex items-center justify-center text-sm">
{{ strtoupper(substr(session('admin_name', 'Alex Davis'), 0, 2)) }}
</div>
<div>
<p class="text-sm font-bold text-charcoal">{{ session('admin_name', 'Alex Davis') }}</p>
<p class="text-xs text-slateblue">{{ strtolower(str_replace(' ', '', session('admin_name', 'alex.davis'))) }}@educore.edu</p>
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
<button onclick="document.getElementById('profileModal').classList.add('hidden')" class="px-4 py-2 bg-gray-100 text-charcoal rounded-xl text-xs font-semibold shadow-sm">Close</button>
</div>
</div>
</div>

</body>
</html>
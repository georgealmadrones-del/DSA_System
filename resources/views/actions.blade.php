<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduCore SaaS Actions Log</title>
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
                    <a href="{{ route('actions') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-2xl bg-white text-charcoal font-bold text-xs border border-coolgrey/30 shadow-md">
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
            <div class="text-xs text-slateblue font-medium">Workspace / <span class="text-charcoal font-semibold">Actions Log</span></div>
            <div onclick="document.getElementById('profileModal').classList.remove('hidden')" class="w-8 h-8 rounded-xl bg-charcoal text-white font-bold text-xs flex items-center justify-center shadow-md cursor-pointer">
                {{ strtoupper(substr(session('admin_name', 'Alex Davis'), 0, 2)) }}
            </div>
        </header>

        <div class="flex-1 overflow-y-auto p-8 space-y-6 max-w-5xl">
            <div class="bg-white rounded-3xl border border-coolgrey/20 shadow-md p-6">
                <h1 class="text-xl font-extrabold text-charcoal">Audit Telemetry Log</h1>
                <p class="text-xs text-slateblue mt-0.5">Real-time audit record of all CRUD operations and workspace changes.</p>
            </div>

            <div class="bg-white rounded-3xl border border-coolgrey/20 shadow-md overflow-hidden">
                <div class="p-6 border-b border-coolgrey/20">
                    <h2 class="text-sm font-bold text-charcoal">Recent Events</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse text-xs">
                        <thead>
                            <tr class="bg-gray-50/70 border-b border-coolgrey/20 text-[10px] font-bold text-slateblue uppercase tracking-wider">
                                <th class="py-3.5 px-6">Event Details</th>
                                <th class="py-3.5 px-6 text-right">Timestamp</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-coolgrey/10">
                            @forelse ($logs as $log)
                            <tr class="hover:bg-gray-50/50 transition">
                                <td class="py-4 px-6 font-bold text-charcoal flex items-center space-x-2">
                                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                    <span>{{ $log->event }}</span>
                                </td>
                                <td class="py-4 px-6 text-right text-slateblue font-mono">{{ $log->created_at->format('M d, Y h:i A') }}</td>
                            </tr>
                            @empty
                            <tr><td colspan="2" class="py-8 text-center text-slateblue">No actions logged yet.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <!-- Profile Modal -->
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
            <div class="flex justify-end pt-2">
                <button onclick="document.getElementById('profileModal').classList.add('hidden')" class="px-4 py-2 bg-gray-100 text-charcoal rounded-xl text-xs font-semibold shadow-sm">Close</button>
            </div>
        </div>
    </div>
</body>
</html>
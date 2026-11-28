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
                            <p class="font-bold text-nordic leading-tight">{{ session('workspace_name', 'EduCore Workspace') }}</p>
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
                    <a href="{{ route('actions') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-2xl bg-white text-nordic font-bold text-xs border border-glacier shadow-sm">
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
            <div class="text-xs text-pine font-medium">Workspace / <span class="text-nordic font-semibold">Actions Log</span></div>
            <div onclick="document.getElementById('profileModal').classList.remove('hidden')" class="w-8 h-8 rounded-xl bg-nordic text-white font-bold text-xs flex items-center justify-center shadow-sm cursor-pointer">
                {{ strtoupper(substr(session('admin_name', 'Alex Davis'), 0, 2)) }}
            </div>
        </header>

        <div class="relative z-10 flex-1 overflow-y-auto p-8 space-y-6 max-w-5xl">
            <div class="bg-white/95 rounded-3xl border border-glacier shadow-sm p-6">
                <h1 class="text-xl font-extrabold text-nordic">Activity Log</h1>
                <p class="text-xs text-pine mt-0.5">Recent CRUD operations and workspace changes.</p>
            </div>

            <div class="bg-white/95 rounded-3xl border border-glacier shadow-sm overflow-hidden">
                <div class="p-6 border-b border-glacier/70">
                    <h2 class="text-sm font-bold text-nordic">Recent Events</h2>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse text-xs">
                        <thead>
                            <tr class="bg-frost/80 border-b border-glacier/70 text-[10px] font-bold text-pine uppercase tracking-wider">
                                <th class="py-3.5 px-6">Event</th>
                                <th class="py-3.5 px-6">Details</th>
                                <th class="py-3.5 px-6 text-right">Timestamp</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-glacier/30">
                            @forelse ($logs as $log)
                                <tr class="hover:bg-frost/40 transition">
                                    <td class="py-4 px-6 font-bold text-nordic">
                                        <span class="inline-flex items-center space-x-2">
                                            <span class="w-2 h-2 rounded-full bg-nordic"></span>
                                            <span>{{ $log->event ?? ($log->action ?? 'activity') }}</span>
                                        </span>
                                    </td>
                                    <td class="py-4 px-6 text-pine">{{ $log->meta ?? ($log->description ?? '—') }}</td>
                                    <td class="py-4 px-6 text-right text-pine font-mono">
                                        {{ $log->created_at ? \Illuminate\Support\Carbon::parse($log->created_at)->format('M d, Y h:i A') : '—' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="py-8 text-center text-pine">No actions logged yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

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
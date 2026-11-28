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
    <!-- Fixed Left Sidebar Navigation (No snow) -->
    <aside class="w-64 h-full bg-deepnavy/95 border-r border-twilight flex-col justify-between hidden md:flex shrink-0 shadow-lg z-20">
        <div>
            <div class="p-6 border-b border-twilight flex items-center space-x-3">
                <div class="w-8 h-8 rounded-xl bg-midnight border border-starlight/50 flex items-center justify-center text-candlelight shadow-sm">
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
                <div class="p-3 bg-midnight/85 rounded-2xl border border-twilight flex items-center justify-between text-xs shadow-sm">
                    <div class="flex items-center space-x-2.5">
                        <div class="w-7 h-7 rounded-xl bg-deepnavy border border-starlight/40 flex items-center justify-center font-bold text-[10px] text-candlelight">EA</div>
                        <div>
                            <p class="font-bold text-white leading-tight">{{ session('workspace_name', 'EduCore Workspace') }}</p>
                            <p class="text-[10px] text-slate-400 font-medium mt-0.5">Academic workspace</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="px-4 py-2">
                <p class="px-3 text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-2">Workspace</p>
                <nav class="space-y-1">
                    <a href="{{ route('students.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-2xl text-slate-300 hover:bg-midnight/60 hover:text-white text-xs font-semibold transition">
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('students.directory') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-2xl text-slate-300 hover:bg-midnight/60 hover:text-white text-xs font-semibold transition">
                        <span>Student Directory</span>
                    </a>
                    <a href="{{ route('actions') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-2xl bg-midnight text-candlelight font-bold text-xs border border-starlight/50 shadow-sm">
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

            <div class="flex items-center justify-between p-3 bg-midnight/85 border border-twilight rounded-2xl shadow-sm">
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
        <div class="pointer-events-none fixed inset-0 bg-[radial-gradient(ellipse_at_top_right,_rgba(69,114,171,0.18),_transparent_60%)] z-0"></div>
        <canvas id="rightPanelSnow" class="pointer-events-none absolute inset-0 w-full h-full z-0"></canvas>

        <header class="relative z-10 bg-deepnavy/85 backdrop-blur-md border-b border-twilight h-16 flex items-center justify-between px-8 shrink-0">
            <div class="text-xs text-slate-400 font-medium">Workspace / <span class="text-candlelight font-semibold">Actions Log</span></div>
            <div onclick="document.getElementById('profileModal').classList.remove('hidden')" class="w-8 h-8 rounded-xl bg-candlelight text-midnight font-extrabold text-xs flex items-center justify-center shadow-sm cursor-pointer">
                {{ strtoupper(substr(session('admin_name', 'Alex Davis'), 0, 2)) }}
            </div>
        </header>

        <div class="relative z-10 flex-1 overflow-y-auto p-8 space-y-6 max-w-5xl">
            <div class="bg-deepnavy/95 rounded-3xl border border-twilight shadow-lg p-6">
                <h1 class="text-xl font-extrabold text-white">Activity Log</h1>
                <p class="text-xs text-slate-300 mt-0.5">Recent CRUD operations and workspace changes &bull; <span class="text-candlelight/80">&#10023; Happy holidays</span></p>
            </div>

            <div class="bg-deepnavy/95 rounded-3xl border border-twilight shadow-lg overflow-hidden">
                <div class="p-6 border-b border-twilight">
                    <h2 class="text-sm font-bold text-white">Recent Events</h2>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse text-xs">
                        <thead>
                            <tr class="bg-midnight/80 border-b border-twilight text-[10px] font-bold text-candlelight uppercase tracking-wider">
                                <th class="py-3.5 px-6">Event</th>
                                <th class="py-3.5 px-6">Details</th>
                                <th class="py-3.5 px-6 text-right">Timestamp</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-twilight/60">
                            @forelse ($logs as $log)
                                <tr class="hover:bg-midnight/50 transition">
                                    <td class="py-4 px-6 font-bold text-white">
                                        <span class="inline-flex items-center space-x-2">
                                            <span class="w-2 h-2 rounded-full bg-candlelight"></span>
                                            <span>{{ $log->event ?? ($log->action ?? 'activity') }}</span>
                                        </span>
                                    </td>
                                    <td class="py-4 px-6 text-slate-300">{{ $log->meta ?? ($log->description ?? '—') }}</td>
                                    <td class="py-4 px-6 text-right text-slate-400 font-mono">
                                        {{ $log->created_at ? \Illuminate\Support\Carbon::parse($log->created_at)->format('M d, Y h:i A') : '—' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="py-8 text-center text-slate-400">No actions logged yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <!-- Profile Modal -->
    <div id="profileModal" class="fixed inset-0 bg-black/65 backdrop-blur-sm hidden flex items-center justify-center p-4 z-50">
        <div class="bg-deepnavy rounded-3xl max-w-md w-full p-6 shadow-2xl border border-twilight space-y-4">
            <div class="flex justify-between items-center">
                <h3 class="text-base font-bold text-white">Admin Profile &amp; Session</h3>
                <button type="button" onclick="document.getElementById('profileModal').classList.add('hidden')" class="text-slate-400 hover:text-candlelight text-sm font-bold">X</button>
            </div>
            <div class="flex items-center space-x-4 p-4 bg-midnight/85 rounded-2xl border border-twilight">
                <div class="w-12 h-12 rounded-full bg-deepnavy border border-candlelight/40 text-candlelight font-bold flex items-center justify-center text-sm">
                    {{ strtoupper(substr(session('admin_name', 'Alex Davis'), 0, 2)) }}
                </div>
                <div>
                    <p class="text-sm font-bold text-white">{{ session('admin_name', 'Alex Davis') }}</p>
                    <p class="text-xs text-slate-400">Administrator</p>
                    <span class="inline-block mt-1 px-2 py-0.5 bg-deepnavy border border-candlelight/40 text-candlelight text-[10px] font-bold rounded-full">System Administrator</span>
                </div>
            </div>
            <div class="flex justify-end pt-2">
                <button type="button" onclick="document.getElementById('profileModal').classList.add('hidden')" class="px-4 py-2 bg-candlelight text-midnight rounded-xl text-xs font-extrabold shadow-sm">Close</button>
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
            const flakes = Array.from({ length: 34 }, (_, idx) => ({
                x: Math.random() * 1200,
                y: Math.random() * 900,
                size: 4 + Math.random() * 5,
                vy: 0.35 + Math.random() * 0.65,
                vx: -0.25 + Math.random() * 0.5,
                angle: Math.random() * Math.PI * 2,
                spin: -0.01 + Math.random() * 0.02,
                alpha: 0.35 + Math.random() * 0.35,
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
                ctx.rotate(f.angle);
                ctx.strokeStyle = f.warm ? `rgba(218, 169, 133, ${f.alpha})` : `rgba(226, 239, 250, ${f.alpha})`;
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduCore SaaS Activity Log</title>
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
    <!-- Fixed Left Sidebar Navigation -->
    <aside class="relative w-64 h-full bg-gradient-to-b from-[#0E2438] via-deepnavy to-[#091622] border-r border-twilight/90 flex-col justify-between hidden md:flex shrink-0 shadow-2xl z-20 overflow-hidden">
        <div class="pointer-events-none absolute inset-x-0 top-0 h-28 bg-[radial-gradient(circle_at_top_left,_rgba(218,169,133,0.14),_transparent_70%)]"></div>
        <svg class="pointer-events-none absolute top-16 right-3 w-12 h-12 text-candlelight/20" viewBox="0 0 48 48" fill="none">
            <path d="M24 6V42M6 24H42M11.3 11.3L36.7 36.7M36.7 11.3L11.3 36.7" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>
            <circle cx="24" cy="24" r="3" fill="currentColor"/>
        </svg>

        <div class="relative z-10">
            <div class="relative p-6 border-b border-twilight/80 flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 rounded-xl bg-midnight border border-starlight/60 flex items-center justify-center text-candlelight shadow-md shadow-black/30">
                        <div class="grid grid-cols-2 gap-0.5">
                            <span class="w-1.5 h-1.5 bg-candlelight rounded-full"></span>
                            <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                            <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                            <span class="w-1.5 h-1.5 bg-candlelight rounded-full"></span>
                        </div>
                    </div>
                    <span class="font-extrabold text-sm tracking-tight text-white">EduCore <span class="text-candlelight">SaaS</span></span>
                </div>
                <span class="text-candlelight/70 text-xs">&#10022;</span>

                <svg class="pointer-events-none absolute inset-x-0 -bottom-2.5 w-full h-5 overflow-visible" viewBox="0 0 256 20" preserveAspectRatio="none" fill="none">
                    <path d="M0 2Q42 14 85 2T170 2T256 2" stroke="#4572AB" stroke-width="1" stroke-opacity="0.65"/>
                    <circle cx="42" cy="8" r="2.2" fill="#DAA985"/>
                    <circle cx="42" cy="8" r="5" fill="#DAA985" fill-opacity="0.22"/>
                    <circle cx="128" cy="8" r="2.2" fill="#FFF3DC"/>
                    <circle cx="128" cy="8" r="5" fill="#DAA985" fill-opacity="0.22"/>
                    <circle cx="213" cy="8" r="2.2" fill="#DAA985"/>
                    <circle cx="213" cy="8" r="5" fill="#DAA985" fill-opacity="0.22"/>
                </svg>
            </div>

            <div class="p-4 pt-5">
                <div class="p-3 bg-midnight/90 rounded-2xl border border-twilight/90 flex items-center justify-between text-xs shadow-inner shadow-black/30">
                    <div class="flex items-center space-x-2.5 min-w-0">
                        <div class="w-8 h-8 rounded-xl bg-gradient-to-br from-deepnavy to-midnight border border-candlelight/40 flex items-center justify-center font-extrabold text-[10px] text-candlelight shrink-0">EA</div>
                        <div class="min-w-0">
                            <p class="font-bold text-white leading-tight truncate">{{ session('workspace_name', 'EduCore Workspace') }}</p>
                            <p class="text-[10px] text-slate-400 font-medium mt-0.5 truncate">Records space</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="px-4 py-2">
                <div class="flex items-center justify-between px-3 mb-2">
                    <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Menu</p>
                    <span class="text-[10px] text-candlelight/60">&#10052;</span>
                </div>
                <nav class="space-y-1">
                    <a href="{{ route('students.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-2xl text-slate-300 hover:bg-midnight/65 hover:text-white text-xs font-semibold transition">
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('students.directory') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-2xl text-slate-300 hover:bg-midnight/65 hover:text-white text-xs font-semibold transition">
                        <span>Student Directory</span>
                    </a>
                    <a href="{{ route('actions') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-2xl bg-gradient-to-r from-midnight to-deepnavy/90 text-candlelight font-bold text-xs border border-candlelight/35 shadow-md shadow-black/25">
                        <span class="w-1.5 h-1.5 rounded-full bg-candlelight shadow-[0_0_8px_rgba(218,169,133,0.8)]"></span>
                        <span>Actions</span>
                    </a>
                </nav>
            </div>
        </div>

        <div class="relative z-10 p-4 border-t border-twilight/80 bg-midnight/35 space-y-4">
            <div class="px-2">
                <p class="px-3 text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1">Manage</p>
                <a href="{{ route('settings') }}" class="flex items-center space-x-3 px-3 py-2 rounded-2xl text-slate-300 hover:bg-midnight/65 hover:text-white text-xs font-semibold transition">
                    <span>Settings</span>
                </a>
            </div>

            <div class="flex items-center justify-between p-3 bg-midnight/95 border border-twilight rounded-2xl shadow-md shadow-black/30">
                <div onclick="document.getElementById('profileModal').classList.remove('hidden')" class="flex items-center space-x-3 cursor-pointer min-w-0 flex-1">
                    <div class="w-8 h-8 rounded-full bg-deepnavy border border-candlelight/50 text-candlelight font-bold flex items-center justify-center text-xs shrink-0">
                        {{ strtoupper(substr(session('admin_name', 'Alex Davis'), 0, 2)) }}
                    </div>
                    <div class="min-w-0">
                        <p class="text-xs font-bold text-white truncate">{{ session('admin_name', 'Alex Davis') }}</p>
                        <p class="text-[10px] text-slate-400 font-medium truncate">Administrator</p>
                    </div>
                </div>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" title="Log out" class="p-1.5 text-slate-400 hover:text-rose-300 hover:bg-rose-950/50 rounded-xl transition shrink-0 ml-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Scrollable Right Content -->
    <main class="relative flex-1 h-full flex flex-col min-w-0 overflow-hidden bg-midnight">
        <div class="pointer-events-none fixed inset-0 bg-[radial-gradient(ellipse_at_top,_rgba(69,114,171,0.24),_transparent_65%),radial-gradient(ellipse_at_bottom,_rgba(218,169,133,0.09),_transparent_60%)] z-0"></div>
        <canvas id="rightPanelSnow" class="pointer-events-none absolute inset-0 w-full h-full z-0"></canvas>

        <div class="pointer-events-none absolute inset-x-0 bottom-0 h-14 z-10 overflow-hidden">
            <svg class="w-full h-full" viewBox="0 0 1440 80" preserveAspectRatio="none" fill="none">
                <path d="M0 42C240 16 480 62 760 36C1020 12 1240 54 1440 28V80H0V42Z" fill="#273B5C" fill-opacity="0.5"/>
                <path d="M0 56C320 38 620 70 960 48C1180 34 1330 62 1440 50V80H0V56Z" fill="#E8F1F8" fill-opacity="0.12"/>
            </svg>
        </div>

        <header class="relative z-10 bg-midnight/90 backdrop-blur-md border-b border-twilight h-16 flex items-center justify-between px-8 shrink-0 shadow-lg shadow-black/25">
            <svg class="pointer-events-none absolute inset-x-0 -bottom-2.5 w-full h-5 z-20 overflow-visible" viewBox="0 0 1200 20" preserveAspectRatio="none" fill="none">
                <path d="M0 2Q150 15 300 2T600 2T900 2T1200 2" stroke="#4572AB" stroke-width="1.1" stroke-opacity="0.65"/>
                <circle cx="150" cy="9.5" r="2.6" fill="#DAA985"/>
                <circle cx="150" cy="9.5" r="6" fill="#DAA985" fill-opacity="0.22"/>
                <circle cx="450" cy="9.5" r="2.6" fill="#FFF3DC"/>
                <circle cx="450" cy="9.5" r="6" fill="#DAA985" fill-opacity="0.22"/>
                <circle cx="750" cy="9.5" r="2.6" fill="#DAA985"/>
                <circle cx="750" cy="9.5" r="6" fill="#DAA985" fill-opacity="0.22"/>
                <circle cx="1050" cy="9.5" r="2.6" fill="#FFF3DC"/>
                <circle cx="1050" cy="9.5" r="6" fill="#DAA985" fill-opacity="0.22"/>
            </svg>

            <div class="text-xs text-slate-400 font-medium">Records / <span class="text-candlelight font-semibold">Activity Log</span></div>
            <div onclick="document.getElementById('profileModal').classList.remove('hidden')" class="w-8 h-8 rounded-xl bg-candlelight text-midnight font-extrabold text-xs flex items-center justify-center shadow-md shadow-candlelight/20 cursor-pointer">
                {{ strtoupper(substr(session('admin_name', 'Alex Davis'), 0, 2)) }}
            </div>
        </header>

        <div class="relative z-10 flex-1 overflow-y-auto p-8 space-y-6 max-w-5xl pb-16">
            <div class="bg-gradient-to-r from-deepnavy via-[#133450] to-midnight/95 backdrop-blur-md rounded-3xl border border-twilight shadow-2xl shadow-black/35 p-6">
                <h1 class="text-xl font-extrabold text-white">Activity Log</h1>
                <p class="text-xs text-slate-300 mt-0.5">Recent student updates, course edits, and workspace changes.</p>
            </div>

            <div class="bg-gradient-to-b from-deepnavy/95 to-midnight/95 backdrop-blur-md rounded-3xl border border-twilight shadow-2xl shadow-black/35 overflow-hidden">
                <div class="p-6 border-b border-twilight">
                    <h2 class="text-sm font-bold text-white">Recent Activity</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse text-xs">
                        <thead>
                            <tr class="bg-midnight/85 border-b border-twilight text-[10px] font-bold text-candlelight uppercase tracking-wider">
                                <th class="py-3.5 px-6">Action</th>
                                <th class="py-3.5 px-6 text-right">When</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-twilight/60">
                            @forelse ($logs as $log)
                                <tr class="hover:bg-midnight/55 transition">
                                    <td class="py-4 px-6 font-bold text-white flex items-center space-x-2">
                                        <span class="w-2 h-2 rounded-full bg-candlelight"></span>
                                        <span>{{ $log->event }}</span>
                                    </td>
                                    <td class="py-4 px-6 text-right text-slate-400 font-mono">{{ $log->created_at->format('M d, Y h:i A') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="py-8 text-center text-slate-400">No activity recorded yet.</td>
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
                <h3 class="text-base font-bold text-white">Account info</h3>
                <button type="button" onclick="document.getElementById('profileModal').classList.add('hidden')" class="text-slate-400 hover:text-candlelight text-sm font-bold">X</button>
            </div>
            <div class="flex items-center space-x-4 p-4 bg-midnight/85 rounded-2xl border border-twilight">
                <div class="w-12 h-12 rounded-full bg-deepnavy border border-candlelight/40 text-candlelight font-bold flex items-center justify-center text-sm">
                    {{ strtoupper(substr(session('admin_name', 'Alex Davis'), 0, 2)) }}
                </div>
                <div>
                    <p class="text-sm font-bold text-white">{{ session('admin_name', 'Alex Davis') }}</p>
                    <p class="text-xs text-slate-400">{{ strtolower(str_replace(' ', '', session('admin_name', 'alex.davis'))) }}@educore.edu</p>
                    <span class="inline-block mt-1 px-2 py-0.5 bg-deepnavy border border-candlelight/40 text-candlelight text-[10px] font-bold rounded-full">Workspace Admin</span>
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
            let width = 0, height = 0;
            const flakes = Array.from({ length: 42 }, (_, idx) => ({
                x: Math.random() * 1200, y: Math.random() * 900,
                size: 4 + Math.random() * 5, vy: 0.4 + Math.random() * 0.65,
                vx: -0.3 + Math.random() * 0.6, angle: Math.random() * Math.PI * 2,
                spin: -0.012 + Math.random() * 0.024, alpha: 0.45 + Math.random() * 0.35,
                warm: idx % 7 === 0,
            }));
            function resize() { width = canvas.width = panel.clientWidth; height = canvas.height = panel.clientHeight; }
            resize();
            window.addEventListener('resize', resize);
            function tick() {
                ctx.clearRect(0, 0, width, height);
                for (const f of flakes) {
                    f.x += f.vx; f.y += f.vy; f.angle += f.spin;
                    if (f.y - f.size > height) { f.y = -f.size * 2; f.x = Math.random() * width; }
                    ctx.save(); ctx.translate(f.x, f.y);
                    if (f.warm) {
                        const g = ctx.createRadialGradient(0, 0, 0.5, 0, 0, f.size * 1.4);
                        g.addColorStop(0, `rgba(255, 243, 220, ${f.alpha})`);
                        g.addColorStop(1, 'rgba(218, 169, 133, 0)');
                        ctx.fillStyle = g; ctx.beginPath(); ctx.arc(0, 0, f.size * 1.4, 0, Math.PI * 2); ctx.fill();
                    } else {
                        ctx.rotate(f.angle); ctx.strokeStyle = `rgba(226, 239, 250, ${f.alpha})`; ctx.lineWidth = 1.1;
                        for (let k = 0; k < 6; k++) { ctx.save(); ctx.rotate((k * Math.PI) / 3); ctx.beginPath(); ctx.moveTo(0, 0); ctx.lineTo(0, -f.size); ctx.stroke(); ctx.restore(); }
                    }
                    ctx.restore();
                }
                requestAnimationFrame(tick);
            }
            tick();
        })();
    </script>
</body>
</html>
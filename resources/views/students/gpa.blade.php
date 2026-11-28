<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GPA Analytics - EduCore SaaS</title>
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
<body class="bg-midnight text-slate-200 font-sans antialiased min-h-screen p-4 md:p-8 relative overflow-x-hidden selection:bg-candlelight/30 selection:text-candlelight">
    @php
        $scaleVal = number_format((float) ($settings['gpa_scale'] ?? 3.00), 2);
        $maxScale = max((float) ($settings['gpa_scale'] ?? 3.00), 0.01);
        $meanPct = min(100, max(6, round(((float) $averageGpa / $maxScale) * 100)));
    @endphp

    <div class="pointer-events-none fixed inset-0 bg-[radial-gradient(ellipse_at_top,_rgba(69,114,171,0.24),_transparent_65%),radial-gradient(ellipse_at_bottom,_rgba(218,169,133,0.09),_transparent_60%)] z-0"></div>
    <canvas id="winterCanvas" class="pointer-events-none fixed inset-0 w-full h-full z-0"></canvas>

    <div class="pointer-events-none fixed inset-x-0 bottom-0 h-14 z-0 overflow-hidden">
        <svg class="w-full h-full" viewBox="0 0 1440 80" preserveAspectRatio="none" fill="none">
            <path d="M0 42C240 16 480 62 760 36C1020 12 1240 54 1440 28V80H0V42Z" fill="#273B5C" fill-opacity="0.5"/>
            <path d="M0 56C320 38 620 70 960 48C1180 34 1330 62 1440 50V80H0V56Z" fill="#E8F1F8" fill-opacity="0.12"/>
        </svg>
    </div>

    <div class="relative z-10 max-w-6xl mx-auto space-y-6 pb-10">
        <div class="relative flex flex-col sm:flex-row sm:items-center sm:justify-between bg-gradient-to-r from-deepnavy via-[#133450] to-midnight/95 backdrop-blur-md p-6 rounded-3xl border border-twilight shadow-2xl shadow-black/35 gap-4">
            <svg class="pointer-events-none absolute inset-x-6 -bottom-2.5 h-5 overflow-visible" viewBox="0 0 900 20" preserveAspectRatio="none" fill="none">
                <path d="M0 2Q150 15 300 2T600 2T900 2" stroke="#4572AB" stroke-width="1" stroke-opacity="0.65"/>
                <circle cx="150" cy="9.5" r="2.3" fill="#DAA985"/>
                <circle cx="450" cy="9.5" r="2.3" fill="#FFF3DC"/>
                <circle cx="750" cy="9.5" r="2.3" fill="#DAA985"/>
            </svg>

            <div>
                <p class="text-[10px] font-extrabold uppercase tracking-widest text-candlelight">Grade Overview</p>
                <h1 class="text-2xl font-extrabold text-white mt-0.5">Average GPA & Student Scores</h1>
                <p class="text-xs text-slate-300 mt-0.5">
                    Average across {{ $students->count() }} {{ \Illuminate\Support\Str::plural('student', $students->count()) }} on a {{ $scaleVal }} scale.
                </p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('students.index') }}" class="px-4 py-2.5 bg-midnight text-slate-200 border border-twilight rounded-2xl text-xs font-bold hover:bg-twilight transition">
                    &larr; Dashboard
                </a>
                <a href="{{ route('students.directory') }}" class="px-4 py-2.5 bg-candlelight text-midnight rounded-2xl text-xs font-extrabold hover:bg-[#e5ba99] transition shadow-md shadow-candlelight/20">
                    Student Directory
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-gradient-to-b from-deepnavy/95 to-[#0D2133] backdrop-blur-md p-6 rounded-3xl border border-twilight shadow-xl">
                <p class="text-[11px] font-bold uppercase tracking-wider text-slate-300">Average GPA</p>
                <p class="text-3xl font-extrabold text-candlelight mt-2">{{ number_format((float) $averageGpa, 2) }}</p>
                <div class="w-full h-1.5 bg-midnight rounded-full overflow-hidden mt-3 border border-twilight/70">
                    <div class="h-full bg-gradient-to-r from-starlight to-candlelight rounded-full" style="width: {{ $meanPct }}%"></div>
                </div>
            </div>
            <div class="bg-gradient-to-b from-deepnavy/95 to-[#0D2133] backdrop-blur-md p-6 rounded-3xl border border-twilight shadow-xl">
                <p class="text-[11px] font-bold uppercase tracking-wider text-slate-300">GPA Scale</p>
                <p class="text-3xl font-extrabold text-white mt-2">{{ $scaleVal }}</p>
                <p class="text-[11px] text-slate-400 mt-2">active grading scale</p>
            </div>
            <div class="bg-gradient-to-b from-deepnavy/95 to-[#0D2133] backdrop-blur-md p-6 rounded-3xl border border-twilight shadow-xl">
                <p class="text-[11px] font-bold uppercase tracking-wider text-slate-300">Students Counted</p>
                <p class="text-3xl font-extrabold text-white mt-2">{{ $students->count() }}</p>
                <p class="text-[11px] text-slate-400 mt-2">with recorded grades</p>
            </div>
        </div>

        <div class="bg-gradient-to-b from-deepnavy/95 to-midnight/95 backdrop-blur-md rounded-3xl border border-twilight shadow-2xl shadow-black/35 overflow-hidden">
            <div class="p-6 border-b border-twilight">
                <h2 class="text-base font-bold text-white">GPA by Student</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-midnight/85 border-b border-twilight text-[10px] font-bold text-candlelight uppercase tracking-wider">
                            <th class="py-3.5 px-4">Student ID</th>
                            <th class="py-3.5 px-4">Full Name</th>
                            <th class="py-3.5 px-4">Course</th>
                            <th class="py-3.5 px-4 text-right">GPA</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-twilight/60 text-xs">
                        @forelse ($students as $student)
                            <tr class="hover:bg-midnight/55 transition">
                                <td class="py-4 px-4 font-mono font-semibold text-candlelight">{{ $student->student_id }}</td>
                                <td class="py-4 px-4 font-bold text-white">{{ $student->name }}</td>
                                <td class="py-4 px-4 text-slate-300 font-medium">{{ $student->course }}</td>
                                <td class="py-4 px-4 font-extrabold text-candlelight text-right">{{ number_format((float) $student->gpa, 2) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-8 text-center text-slate-400">No GPA records available yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        (function initSnow() {
            const canvas = document.getElementById('winterCanvas');
            if (!canvas) return;
            const ctx = canvas.getContext('2d');
            let w = 0, h = 0;
            const flakes = Array.from({ length: 38 }, (_, i) => ({
                x: Math.random() * 1400, y: Math.random() * 900,
                size: 4 + Math.random() * 5, vy: 0.4 + Math.random() * 0.6,
                vx: -0.25 + Math.random() * 0.5, angle: Math.random() * Math.PI * 2,
                spin: -0.01 + Math.random() * 0.02, alpha: 0.4 + Math.random() * 0.35,
                warm: i % 7 === 0,
            }));
            function resize() { w = canvas.width = window.innerWidth; h = canvas.height = window.innerHeight; }
            resize();
            window.addEventListener('resize', resize);
            function tick() {
                ctx.clearRect(0, 0, w, h);
                for (const f of flakes) {
                    f.x += f.vx; f.y += f.vy; f.angle += f.spin;
                    if (f.y - f.size > h) { f.y = -f.size * 2; f.x = Math.random() * w; }
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
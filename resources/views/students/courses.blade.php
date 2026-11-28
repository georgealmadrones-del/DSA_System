<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Active Courses - EduCore SaaS</title>
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
<body class="bg-midnight text-slate-200 font-sans antialiased min-h-screen relative overflow-x-hidden selection:bg-candlelight/30 selection:text-candlelight">
    <div class="pointer-events-none fixed inset-0 bg-[radial-gradient(ellipse_at_top,_rgba(69,114,171,0.26),_transparent_65%),radial-gradient(ellipse_at_bottom,_rgba(218,169,133,0.1),_transparent_60%)] z-0"></div>
    <canvas id="coursesSnowCanvas" class="pointer-events-none fixed inset-0 w-full h-full z-0"></canvas>

    <div class="pointer-events-none fixed inset-x-0 bottom-0 h-14 z-0 overflow-hidden">
        <svg class="w-full h-full" viewBox="0 0 1440 80" preserveAspectRatio="none" fill="none">
            <path d="M0 42C240 16 480 62 760 36C1020 12 1240 54 1440 28V80H0V42Z" fill="#273B5C" fill-opacity="0.5"/>
            <path d="M0 56C320 38 620 70 960 48C1180 34 1330 62 1440 50V80H0V56Z" fill="#E8F1F8" fill-opacity="0.12"/>
        </svg>
    </div>

    @php
        $courseItems = collect($courses ?? []);
    @endphp

    <div class="relative z-10 max-w-6xl mx-auto px-4 sm:px-6 py-8 space-y-6 pb-20">
        @if (session('success'))
            <div class="p-4 bg-deepnavy/95 border border-starlight/50 rounded-2xl text-xs font-semibold text-candlelight shadow-lg">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="p-4 bg-rose-950/70 border border-rose-500/40 rounded-2xl text-xs text-rose-200 shadow-lg">
                <ul class="list-disc pl-4 space-y-0.5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Top Course Roster Banner -->
        <div class="relative bg-gradient-to-r from-deepnavy via-[#133450] to-midnight/95 backdrop-blur-md rounded-3xl border border-twilight shadow-2xl shadow-black/35 p-6 md:p-7 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <svg class="pointer-events-none absolute inset-x-8 -bottom-2.5 h-5 overflow-visible" viewBox="0 0 800 20" preserveAspectRatio="none" fill="none">
                <path d="M0 2Q133 15 266 2T533 2T800 2" stroke="#4572AB" stroke-width="1" stroke-opacity="0.65"/>
                <circle cx="133" cy="9.5" r="2.2" fill="#DAA985"/>
                <circle cx="400" cy="9.5" r="2.2" fill="#FFF3DC"/>
                <circle cx="666" cy="9.5" r="2.2" fill="#DAA985"/>
            </svg>

            <div>
                <p class="text-[10px] font-extrabold uppercase tracking-widest text-candlelight">Course Roster</p>
                <h1 class="text-2xl md:text-3xl font-extrabold text-white mt-0.5">Active Courses</h1>
                <p class="text-xs text-slate-300 mt-1">Rename courses across enrolled students or remove unused courses.</p>
            </div>

            <div class="flex flex-wrap items-center gap-3 shrink-0">
                <button type="button" onclick="openAddCourseModal()" class="px-4 py-2.5 bg-candlelight text-midnight rounded-2xl text-xs font-extrabold hover:bg-[#e5ba99] transition shadow-lg shadow-candlelight/20">
                    + Add Course
                </button>
                <a href="{{ route('students.index') }}" class="px-4 py-2.5 bg-midnight text-slate-200 border border-twilight rounded-2xl text-xs font-bold hover:bg-twilight transition">
                    &larr; Back to Dashboard
                </a>
            </div>
        </div>

        <!-- Courses Table Card -->
        <div class="bg-gradient-to-b from-deepnavy/95 to-midnight/95 backdrop-blur-md rounded-3xl border border-twilight shadow-2xl shadow-black/35 overflow-hidden">
            <div class="p-6 border-b border-twilight flex items-center justify-between">
                <h2 class="text-sm font-bold text-white">Courses in Use ({{ $courseItems->count() }})</h2>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-xs">
                    <thead>
                        <tr class="bg-midnight/85 border-b border-twilight text-[10px] font-bold text-candlelight uppercase tracking-wider">
                            <th class="py-3.5 px-6">Course</th>
                            <th class="py-3.5 px-6">Students</th>
                            <th class="py-3.5 px-6">Average GPA</th>
                            <th class="py-3.5 px-6 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-twilight/60">
                        @forelse ($courseItems as $course)
                            @php
                                $courseName = is_array($course) ? ($course['name'] ?? '') : ($course->name ?? '');
                                $studentCount = is_array($course)
                                    ? ($course['students_count'] ?? $course['student_count'] ?? 0)
                                    : ($course->students_count ?? $course->student_count ?? 0);
                                $avgGpa = is_array($course)
                                    ? ($course['average_gpa'] ?? $course['avg_gpa'] ?? '0.00')
                                    : ($course->average_gpa ?? $course->avg_gpa ?? '0.00');
                            @endphp
                            <tr class="hover:bg-midnight/55 transition">
                                <td class="py-4 px-6">
                                    <form action="{{ Route::has('courses.rename') ? route('courses.rename') : url('/courses/rename') }}" method="POST" class="flex items-center gap-2 max-w-xs">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="old_name" value="{{ $courseName }}">
                                        <input
                                            type="text"
                                            name="new_name"
                                            value="{{ $courseName }}"
                                            required
                                            maxlength="60"
                                            class="w-44 px-3 py-1.5 bg-midnight/85 border border-twilight rounded-xl text-xs text-white font-semibold focus:outline-none focus:ring-2 focus:ring-candlelight/40 shadow-inner"
                                        >
                                        <button type="submit" class="px-3 py-1.5 bg-candlelight text-midnight rounded-xl text-[11px] font-extrabold hover:bg-[#e5ba99] transition shadow-sm">
                                            Save
                                        </button>
                                    </form>
                                </td>
                                <td class="py-4 px-6 font-bold text-white">{{ $studentCount }}</td>
                                <td class="py-4 px-6 font-bold text-candlelight">{{ is_numeric($avgGpa) ? number_format((float) $avgGpa, 2) : $avgGpa }}</td>
                                <td class="py-4 px-6 text-right">
                                    <form action="{{ Route::has('courses.delete') ? route('courses.delete') : url('/courses/delete') }}" method="POST" class="inline" onsubmit="return confirm('Delete this course?')">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="name" value="{{ $courseName }}">
                                        <button type="submit" class="px-3 py-1.5 bg-rose-950/60 hover:bg-rose-900/70 text-rose-200 border border-rose-500/40 rounded-xl text-[11px] font-bold transition">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-8 text-center text-slate-400">
                                    No courses yet. Click <span class="text-candlelight font-bold">+ Add Course</span> above to create one.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Course Modal -->
    <div id="addCourseModal" class="fixed inset-0 bg-black/65 backdrop-blur-sm {{ $errors->has('name') ? '' : 'hidden' }} flex items-center justify-center p-4 z-50">
        <div class="bg-deepnavy rounded-3xl max-w-md w-full p-6 shadow-2xl border border-twilight">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-base font-bold text-white">Add course</h3>
                <button type="button" onclick="closeAddCourseModal()" class="text-slate-400 hover:text-candlelight text-sm font-bold">X</button>
            </div>
            <form action="{{ route('courses.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-[11px] font-bold text-candlelight uppercase tracking-wider mb-1">Course Name</label>
                    <input
                        type="text"
                        id="new_course_name"
                        name="name"
                        value="{{ old('name') }}"
                        required
                        maxlength="60"
                        placeholder="e.g. BSCS, BSA, Nursing"
                        class="w-full px-3.5 py-2.5 bg-midnight/85 border border-twilight rounded-xl text-xs text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-candlelight/40 shadow-inner"
                    >
                </div>
                <div class="flex justify-end space-x-3 pt-2">
                    <button type="button" onclick="closeAddCourseModal()" class="px-4 py-2 bg-midnight text-slate-200 border border-twilight rounded-xl text-xs font-semibold">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-candlelight text-midnight rounded-xl text-xs font-extrabold hover:bg-[#e5ba99] transition shadow-sm">Save course</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openAddCourseModal() {
            document.getElementById('addCourseModal').classList.remove('hidden');
            const input = document.getElementById('new_course_name');
            if (input) setTimeout(() => input.focus(), 50);
        }

        function closeAddCourseModal() {
            document.getElementById('addCourseModal').classList.add('hidden');
        }

        (function initCoursesSnow() {
            const canvas = document.getElementById('coursesSnowCanvas');
            if (!canvas) return;
            const ctx = canvas.getContext('2d');
            let w = 0, h = 0;
            const flakes = Array.from({ length: 36 }, (_, i) => ({
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
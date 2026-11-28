<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduCore — Holiday Split Edition</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        slatebase: '#11181D',
                        frostsurf: '#19232B',
                        pinewarm: '#1E1916',
                        borderline: '#2A3945',
                        goldleaf: '#E3B25C',
                        goldhover: '#CE9B43',
                        cranberry: '#C94A54',
                        cranberryhover: '#AD3943',
                        snowink: '#F3F6F8',
                        mutedink: '#98A8B5',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-slatebase text-snowink font-sans antialiased selection:bg-goldleaf/25 selection:text-goldleaf overflow-x-hidden relative">
    <!-- Ambient Holiday Glow (60% Base) -->
    <div class="pointer-events-none fixed inset-0 bg-[radial-gradient(circle_at_top_left,_rgba(227,178,92,0.11),_transparent_45%),radial-gradient(circle_at_bottom_right,_rgba(201,74,84,0.09),_transparent_50%)] z-0"></div>

    <!-- Drifting Snowflakes & Warm Glints (Skips #authActionZone) -->
    <canvas id="splitHolidaySnow" class="pointer-events-none fixed inset-0 w-full h-full z-30"></canvas>

    <!-- Compact Top Bar -->
    <header class="sticky top-0 z-40 relative w-full bg-slatebase/90 backdrop-blur-md border-b border-borderline h-18 flex items-center justify-between px-6 md:px-10">
        <!-- Subtle Fairy Light Line -->
        <svg class="pointer-events-none absolute inset-x-0 -bottom-2.5 w-full h-5 overflow-visible" viewBox="0 0 1440 20" preserveAspectRatio="none" fill="none">
            <path d="M0 1Q360 13 720 1T1440 1" stroke="#E3B25C" stroke-width="1" stroke-opacity="0.45"/>
            <circle cx="360" cy="7" r="2.6" fill="#E3B25C"/>
            <circle cx="720" cy="7" r="2.6" fill="#C94A54"/>
            <circle cx="1080" cy="7" r="2.6" fill="#F3F6F8"/>
        </svg>

        <a href="#" class="flex items-center space-x-3">
            <span class="w-8 h-8 rounded-xl bg-frostsurf border border-goldleaf/40 flex items-center justify-center text-goldleaf text-sm">&#10022;</span>
            <div>
                <span class="font-extrabold text-base tracking-tight text-white">EduCore <span class="text-goldleaf">SaaS</span></span>
                <span class="hidden sm:inline text-[10px] font-mono text-mutedink ml-2">HOLIDAY EDITION</span>
            </div>
        </a>

        <nav class="hidden md:flex items-center space-x-6 text-xs font-semibold text-mutedink">
            <a href="#ledger" class="hover:text-goldleaf transition">Live Ledger</a>
            <a href="#highlights" class="hover:text-goldleaf transition">Highlights</a>
            <a href="#plans" class="hover:text-goldleaf transition">Plans</a>
            <a href="#faq" class="hover:text-goldleaf transition">FAQ</a>
        </nav>

        <!-- Excluded Zone: Keep Log in and Get started clean -->
        <div id="authActionZone" class="relative z-50 flex items-center space-x-2.5 px-2 py-1 rounded-2xl">
            <a href="{{ route('login') }}" class="px-3.5 py-2 text-xs font-bold text-snowink hover:text-goldleaf hover:bg-frostsurf rounded-xl transition">Log in</a>
            <a href="{{ route('register') }}" class="px-4 py-2 bg-cranberry hover:bg-cranberryhover text-white text-xs font-extrabold rounded-xl shadow-sm transition">Get started &rarr;</a>
        </div>
    </header>

    <!-- Split Screen Container -->
    <div class="relative z-10 max-w-6xl mx-auto px-6 py-10 md:py-14 grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

        <!-- Left Sticky Holiday Desk Rail -->
        <aside class="lg:col-span-5 lg:sticky lg:top-24 bg-frostsurf/95 border border-borderline rounded-3xl p-7 md:p-8 shadow-xl space-y-6">
            <div class="inline-flex items-center space-x-2 px-3 py-1 rounded-full bg-slatebase border border-borderline text-[11px] font-semibold text-goldleaf">
                <span>&#10052;</span>
                <span>Happy Holidays &bull; Group 1</span>
            </div>

            <div class="space-y-3">
                <h1 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight leading-[1.12]">
                    Simplify student records.
                    <span class="block text-goldleaf mt-1">Elevate every outcome.</span>
                </h1>
                <p class="text-xs sm:text-sm text-mutedink leading-relaxed">
                    Keep student IDs, GPAs, and courses tidy in one calm workspace—with seasonal warmth for your team all winter long.
                </p>
            </div>

            <div class="grid grid-cols-3 gap-2.5 pt-1">
                <div class="bg-slatebase/85 border border-borderline rounded-2xl p-3 text-center">
                    <p class="text-[10px] font-mono uppercase text-mutedink">Students</p>
                    <p class="text-xl font-extrabold text-white mt-0.5 tabular-nums">{{ $totalStudents }}</p>
                </div>
                <div class="bg-slatebase/85 border border-borderline rounded-2xl p-3 text-center">
                    <p class="text-[10px] font-mono uppercase text-mutedink">Avg GPA</p>
                    <p class="text-xl font-extrabold text-goldleaf mt-0.5 tabular-nums">{{ number_format((float) $averageGpa, 2) }}</p>
                </div>
                <div class="bg-slatebase/85 border border-borderline rounded-2xl p-3 text-center">
                    <p class="text-[10px] font-mono uppercase text-mutedink">Courses</p>
                    <p class="text-xl font-extrabold text-white mt-0.5 tabular-nums">{{ $activeCoursesCount }}</p>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row lg:flex-col gap-3 pt-1">
                <a href="{{ route('register') }}" class="w-full py-3.5 px-5 bg-goldleaf hover:bg-goldhover text-slatebase text-xs font-extrabold rounded-2xl text-center transition shadow-sm">
                    Start managing free &rarr;
                </a>
                <a href="#ledger" class="w-full py-3 px-5 bg-slatebase hover:bg-pinewarm text-snowink border border-borderline text-xs font-bold rounded-2xl text-center transition">
                    Browse live records
                </a>
            </div>

            <div class="pt-4 border-t border-borderline/80 flex items-center justify-between text-[11px] text-mutedink">
                <span>Season&apos;s greetings from Group 1</span>
                <span class="font-mono text-goldleaf">DB LIVE</span>
            </div>
        </aside>

        <!-- Right Flowing Content Column -->
        <main class="lg:col-span-7 space-y-8">

            <!-- Live Workspace Ledger -->
            <section id="ledger" class="bg-frostsurf/90 border border-borderline rounded-3xl overflow-hidden shadow-xl">
                <div class="px-6 py-4 bg-slatebase/80 border-b border-borderline flex flex-wrap items-center justify-between gap-3">
                    <div class="flex items-center space-x-2 text-xs font-mono text-mutedink">
                        <span class="w-2 h-2 rounded-full bg-goldleaf"></span>
                        <span>educore.app/workspace/dashboard</span>
                    </div>

                    <div class="flex items-center space-x-1 bg-slatebase p-1 rounded-xl border border-borderline">
                        <button type="button" onclick="switchTab('overview')" id="tab-overview" class="px-3.5 py-1.5 rounded-lg text-xs font-bold bg-cranberry text-white transition">Overview</button>
                        <button type="button" onclick="switchTab('roster')" id="tab-roster" class="px-3.5 py-1.5 rounded-lg text-xs font-bold text-mutedink hover:text-white transition">Student Roster</button>
                    </div>
                </div>

                <div class="p-6">
                    <!-- Overview Tab -->
                    <div id="content-overview" class="space-y-4">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="bg-slatebase/80 p-4 rounded-2xl border border-borderline">
                                <p class="text-[10px] font-mono uppercase text-mutedink">Active GPA Scales</p>
                                <p class="text-sm font-bold text-white mt-1">3.00, 4.00 &amp; 5.00 Supported</p>
                                <p class="text-xs text-mutedink mt-1">Switch scales anytime in workspace settings.</p>
                            </div>
                            <div class="bg-slatebase/80 p-4 rounded-2xl border border-borderline">
                                <p class="text-[10px] font-mono uppercase text-mutedink">Roster Portability</p>
                                <p class="text-sm font-bold text-goldleaf mt-1">One-Click CSV Export</p>
                                <p class="text-xs text-mutedink mt-1">Download clean student lists whenever needed.</p>
                            </div>
                        </div>

                        <div class="bg-pinewarm/80 p-4 rounded-2xl border border-borderline flex items-center justify-between gap-3 text-xs">
                            <span class="text-mutedink">Workspace sync &amp; ID prefix validation active</span>
                            <span class="font-mono text-goldleaf font-bold shrink-0">&#10022; READY</span>
                        </div>
                    </div>

                    <!-- Roster Tab -->
                    <div id="content-roster" class="hidden space-y-4">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                            <span class="text-xs text-mutedink">Live records from your database</span>
                            <input
                                type="text"
                                id="previewSearchInput"
                                oninput="filterPreviewStudents()"
                                placeholder="Filter ID, name, or course..."
                                class="w-full sm:w-64 px-3.5 py-1.5 bg-slatebase border border-borderline rounded-xl text-xs text-white placeholder-mutedink/60 focus:outline-none focus:border-goldleaf"
                            >
                        </div>

                        <div class="bg-slatebase/80 rounded-2xl border border-borderline divide-y divide-borderline/70 text-xs">
                            @forelse ($students as $student)
                                <div class="preview-student-row px-4 py-3 flex items-center justify-between gap-3 hover:bg-frostsurf/60 transition" data-filter="{{ strtolower(($student->student_id ?? '') . ' ' . ($student->name ?? '') . ' ' . ($student->course ?? 'BSIT')) }}">
                                    <div class="min-w-0">
                                        <div class="flex items-center space-x-2">
                                            <span class="font-mono text-[11px] text-goldleaf font-bold">{{ $student->student_id }}</span>
                                            <span class="font-bold text-white truncate">{{ $student->name }}</span>
                                        </div>
                                        <p class="text-[11px] text-mutedink mt-0.5">{{ $student->course ?? 'BSIT' }}</p>
                                    </div>
                                    <span class="font-mono font-extrabold text-goldleaf tabular-nums shrink-0">{{ number_format((float) $student->gpa, 2) }}</span>
                                </div>
                            @empty
                                <div class="p-6 text-center text-mutedink">No student records found in database.</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </section>

            <!-- Highlights -->
            <section id="highlights" class="bg-frostsurf/90 border border-borderline rounded-3xl p-6 md:p-8 shadow-xl space-y-5">
                <div>
                    <p class="text-[10px] font-mono font-bold uppercase tracking-widest text-goldleaf">Core Tools</p>
                    <h2 class="text-xl md:text-2xl font-extrabold text-white mt-1">Less admin. More clarity.</h2>
                </div>

                <div class="space-y-4 divide-y divide-borderline/70">
                    <div class="pt-4 first:pt-0 flex items-start justify-between gap-4">
                        <div class="space-y-1">
                            <h3 class="text-sm font-bold text-white">Instant CRUD Management</h3>
                            <p class="text-xs text-mutedink leading-relaxed">Add, update, and manage student records quickly with prefix rules and GPA validation.</p>
                        </div>
                        <span class="text-xs font-mono text-goldleaf shrink-0">01</span>
                    </div>

                    <div class="pt-4 flex items-start justify-between gap-4">
                        <div class="space-y-1">
                            <h3 class="text-sm font-bold text-white">Interactive Grading Statistics</h3>
                            <p class="text-xs text-mutedink leading-relaxed">Track GPA averages across 3.00, 4.00, or 5.00 scales and inspect course breakdowns.</p>
                        </div>
                        <span class="text-xs font-mono text-cranberry shrink-0">02</span>
                    </div>

                    <div class="pt-4 flex items-start justify-between gap-4">
                        <div class="space-y-1">
                            <h3 class="text-sm font-bold text-white">Search, Filter &amp; CSV Export</h3>
                            <p class="text-xs text-mutedink leading-relaxed">Search by ID, name, or course, sort records cleanly, and export rosters to CSV when needed.</p>
                        </div>
                        <span class="text-xs font-mono text-goldleaf shrink-0">03</span>
                    </div>
                </div>
            </section>

            <!-- Plans -->
            <section id="plans" class="bg-frostsurf/90 border border-borderline rounded-3xl p-6 md:p-8 shadow-xl space-y-6">
                <div class="flex flex-wrap items-center justify-between gap-4">
                    <div>
                        <p class="text-[10px] font-mono font-bold uppercase tracking-widest text-goldleaf">Plans</p>
                        <h2 class="text-xl md:text-2xl font-extrabold text-white mt-1">Simple plans for academic teams</h2>
                    </div>

                    <div class="inline-flex items-center space-x-1 bg-slatebase border border-borderline p-1 rounded-xl">
                        <button type="button" onclick="setPricing('monthly')" id="btn-monthly" class="px-3.5 py-1.5 rounded-lg text-xs font-bold bg-goldleaf text-slatebase transition">Monthly</button>
                        <button type="button" onclick="setPricing('annual')" id="btn-annual" class="px-3.5 py-1.5 rounded-lg text-xs font-semibold text-mutedink hover:text-white transition">
                            Annual <span class="text-[10px] text-goldleaf ml-0.5">-20%</span>
                        </button>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="bg-slatebase/85 border border-borderline rounded-2xl p-5 flex flex-col justify-between space-y-4">
                        <div class="space-y-2">
                            <h3 class="text-xs font-extrabold uppercase tracking-wider text-mutedink">Department Workspace</h3>
                            <div class="flex items-baseline space-x-1">
                                <span class="text-3xl font-extrabold text-white price-starter tabular-nums">&#8369;0</span>
                                <span class="text-xs text-mutedink billing-cycle">/ month</span>
                            </div>
                            <p class="text-xs text-mutedink">Good for individual departments and small student rosters.</p>
                        </div>
                        <a href="{{ route('register') }}" class="w-full py-2.5 bg-frostsurf hover:bg-pinewarm text-white border border-borderline rounded-xl text-xs font-bold text-center transition">Get Started Free</a>
                    </div>

                    <div class="bg-slatebase border-2 border-goldleaf rounded-2xl p-5 flex flex-col justify-between space-y-4">
                        <div class="space-y-2">
                            <div class="flex items-center justify-between">
                                <h3 class="text-xs font-extrabold uppercase tracking-wider text-goldleaf">Full Institution SaaS</h3>
                                <span class="text-[10px] font-bold text-goldleaf">Popular</span>
                            </div>
                            <div class="flex items-baseline space-x-1">
                                <span class="text-3xl font-extrabold text-goldleaf price-pro tabular-nums">&#8369;500</span>
                                <span class="text-xs text-mutedink billing-cycle">/ month</span>
                            </div>
                            <p class="text-xs text-mutedink">For multi-course academic teams managing larger student directories.</p>
                        </div>
                        <a href="{{ route('register') }}" class="w-full py-2.5 bg-cranberry hover:bg-cranberryhover text-white rounded-xl text-xs font-extrabold text-center transition">Deploy Workspace</a>
                    </div>
                </div>
            </section>

            <!-- FAQ -->
            <section id="faq" class="bg-frostsurf/90 border border-borderline rounded-3xl p-6 md:p-8 shadow-xl space-y-5">
                <div>
                    <p class="text-[10px] font-mono font-bold uppercase tracking-widest text-goldleaf">FAQ</p>
                    <h2 class="text-xl font-extrabold text-white mt-1">Frequently Asked Questions</h2>
                </div>

                <div class="divide-y divide-borderline/70">
                    <div>
                        <button type="button" onclick="toggleFaq(1)" class="w-full py-3.5 text-left flex justify-between items-center text-xs font-bold text-white hover:text-goldleaf transition">
                            <span>How does workspace session persistence work?</span>
                            <span id="icon-1" class="text-base font-mono text-goldleaf">+</span>
                        </button>
                        <div id="faq-1" class="hidden pb-3.5 text-xs text-mutedink leading-relaxed">
                            EduCore keeps your active workspace session, workspace name, and selected GPA scale synced across dashboard, directory, and settings views.
                        </div>
                    </div>

                    <div>
                        <button type="button" onclick="toggleFaq(2)" class="w-full py-3.5 text-left flex justify-between items-center text-xs font-bold text-white hover:text-goldleaf transition">
                            <span>Can I export student records into CSV files?</span>
                            <span id="icon-2" class="text-base font-mono text-goldleaf">+</span>
                        </button>
                        <div id="faq-2" class="hidden pb-3.5 text-xs text-mutedink leading-relaxed">
                            Yes. You can download your current student records as a CSV file directly from the Settings page.
                        </div>
                    </div>

                    <div>
                        <button type="button" onclick="toggleFaq(3)" class="w-full py-3.5 text-left flex justify-between items-center text-xs font-bold text-white hover:text-goldleaf transition">
                            <span>Which GPA scales and Student ID prefixes are supported?</span>
                            <span id="icon-3" class="text-base font-mono text-goldleaf">+</span>
                        </button>
                        <div id="faq-3" class="hidden pb-3.5 text-xs text-mutedink leading-relaxed">
                            You can switch between 3.00, 4.00, and 5.00 GPA scales and customize your default Student ID prefix in Settings.
                        </div>
                    </div>
                </div>
            </section>

        </main>
    </div>

    <!-- Footer -->
    <footer class="relative z-10 max-w-6xl mx-auto px-6 py-8 border-t border-borderline flex flex-col sm:flex-row items-center justify-between text-xs text-mutedink gap-4">
        <span class="font-bold text-white">EduCore SaaS</span>
        <p>&copy; 2026 EduCore &bull; Built by Group 1 &bull; <span class="text-goldleaf">Happy holidays</span></p>
        <div class="flex items-center space-x-6">
            <a href="#ledger" class="hover:text-goldleaf transition">Ledger</a>
            <a href="#plans" class="hover:text-goldleaf transition">Plans</a>
            <a href="#faq" class="hover:text-goldleaf transition">FAQ</a>
        </div>
    </footer>

    <script>
        function switchTab(tab) {
            const overview = document.getElementById('content-overview');
            const roster = document.getElementById('content-roster');
            const btnOverview = document.getElementById('tab-overview');
            const btnRoster = document.getElementById('tab-roster');

            if (tab === 'overview') {
                overview.classList.remove('hidden');
                roster.classList.add('hidden');
                btnOverview.className = 'px-3.5 py-1.5 rounded-lg text-xs font-bold bg-cranberry text-white transition';
                btnRoster.className = 'px-3.5 py-1.5 rounded-lg text-xs font-bold text-mutedink hover:text-white transition';
            } else {
                roster.classList.remove('hidden');
                overview.classList.add('hidden');
                btnRoster.className = 'px-3.5 py-1.5 rounded-lg text-xs font-bold bg-cranberry text-white transition';
                btnOverview.className = 'px-3.5 py-1.5 rounded-lg text-xs font-bold text-mutedink hover:text-white transition';
            }
        }

        function filterPreviewStudents() {
            const query = String(document.getElementById('previewSearchInput')?.value || '').trim().toLowerCase();
            document.querySelectorAll('.preview-student-row').forEach((row) => {
                const hay = String(row.getAttribute('data-filter') || '');
                row.classList.toggle('hidden', query !== '' && !hay.includes(query));
            });
        }

        function setPricing(plan) {
            const mBtn = document.getElementById('btn-monthly');
            const aBtn = document.getElementById('btn-annual');
            const starter = document.querySelector('.price-starter');
            const pro = document.querySelector('.price-pro');
            const cycles = document.querySelectorAll('.billing-cycle');

            if (plan === 'annual') {
                aBtn.className = 'px-3.5 py-1.5 rounded-lg text-xs font-bold bg-goldleaf text-slatebase transition';
                mBtn.className = 'px-3.5 py-1.5 rounded-lg text-xs font-semibold text-mutedink hover:text-white transition';
                starter.innerText = '\u20B10';
                pro.innerText = '\u20B1400';
                cycles.forEach(el => el.innerText = '/ month (billed annually)');
            } else {
                mBtn.className = 'px-3.5 py-1.5 rounded-lg text-xs font-bold bg-goldleaf text-slatebase transition';
                aBtn.className = 'px-3.5 py-1.5 rounded-lg text-xs font-semibold text-mutedink hover:text-white transition';
                starter.innerText = '\u20B10';
                pro.innerText = '\u20B1500';
                cycles.forEach(el => el.innerText = '/ month');
            }
        }

        function toggleFaq(id) {
            const el = document.getElementById(`faq-${id}`);
            const icon = document.getElementById(`icon-${id}`);
            if (!el || !icon) return;
            const open = el.classList.contains('hidden');
            el.classList.toggle('hidden', !open);
            icon.innerText = open ? '−' : '+';
        }

        // Gentle snow & warm glints skipping #authActionZone
        (function initSplitHolidaySnow() {
            const canvas = document.getElementById('splitHolidaySnow');
            const excluded = document.getElementById('authActionZone');
            if (!canvas) return;
            const ctx = canvas.getContext('2d');
            let w = 0, h = 0;

            const specks = Array.from({ length: 36 }, (_, i) => ({
                x: Math.random() * 1500,
                y: Math.random() * 950,
                r: 1.6 + Math.random() * 2.5,
                vy: 0.35 + Math.random() * 0.55,
                vx: -0.22 + Math.random() * 0.44,
                isGold: i % 4 === 0,
            }));

            function resize() {
                w = canvas.width = window.innerWidth;
                h = canvas.height = window.innerHeight;
            }
            resize();
            window.addEventListener('resize', resize);

            function insideAuth(x, y) {
                if (!excluded) return false;
                const rect = excluded.getBoundingClientRect();
                return x >= rect.left - 10 && x <= rect.right + 10 && y >= rect.top - 10 && y <= rect.bottom + 10;
            }

            function loop() {
                ctx.clearRect(0, 0, w, h);
                for (const s of specks) {
                    s.x += s.vx;
                    s.y += s.vy;
                    if (s.y > h) { s.y = -6; s.x = Math.random() * w; }
                    if (s.x < 0) s.x = w;
                    if (s.x > w) s.x = 0;
                    if (!insideAuth(s.x, s.y)) {
                        ctx.fillStyle = s.isGold ? 'rgba(227, 178, 92, 0.55)' : 'rgba(243, 246, 248, 0.35)';
                        ctx.beginPath();
                        ctx.arc(s.x, s.y, s.r, 0, Math.PI * 2);
                        ctx.fill();
                    }
                }
                requestAnimationFrame(loop);
            }
            loop();
        })();
    </script>
</body>
</html>
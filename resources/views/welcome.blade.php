<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduCore — Fjord Holiday Bento Edition</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        fjordbase: '#0F1722',
                        fjordcard: '#172230',
                        fjordhover: '#1E2C3E',
                        fjordborder: '#2A3B50',
                        fjordgold: '#E5B567',
                        fjordgolddark: '#C99643',
                        fjordberry: '#D1495B',
                        fjordberrydark: '#B23647',
                        fjordtext: '#F1F5F9',
                        fjordmuted: '#94A3B8',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-fjordbase text-fjordtext font-sans antialiased selection:bg-fjordgold/25 selection:text-fjordgold overflow-x-hidden relative">
    <!-- Subtle Winter Sky & Candlelight Glow (60% Base) -->
    <div class="pointer-events-none fixed inset-0 bg-[radial-gradient(circle_at_15%_10%,_rgba(229,181,103,0.11),_transparent_42%),radial-gradient(circle_at_85%_85%,_rgba(209,73,91,0.09),_transparent_45%)] z-0"></div>

    <!-- Drifting Snowflakes & Warm Glints (Skips #authActionZone) -->
    <canvas id="fjordSnow" class="pointer-events-none fixed inset-0 w-full h-full z-30"></canvas>

    <!-- Top Navigation Bar -->
    <header class="sticky top-0 z-40 relative w-full bg-fjordbase/90 backdrop-blur-md border-b border-fjordborder h-18 flex items-center justify-between px-6 md:px-10">
        <!-- Subtle Fairy Lights Along Header Edge -->
        <svg class="pointer-events-none absolute inset-x-0 -bottom-2.5 w-full h-5 overflow-visible" viewBox="0 0 1440 20" preserveAspectRatio="none" fill="none">
            <path d="M0 1Q240 13 480 1T960 1T1440 1" stroke="#E5B567" stroke-width="1" stroke-opacity="0.45"/>
            <circle cx="240" cy="7" r="2.6" fill="#E5B567"/>
            <circle cx="480" cy="7" r="2.6" fill="#D1495B"/>
            <circle cx="720" cy="7" r="2.6" fill="#F1F5F9"/>
            <circle cx="960" cy="7" r="2.6" fill="#E5B567"/>
            <circle cx="1200" cy="7" r="2.6" fill="#D1495B"/>
        </svg>

        <a href="#" class="flex items-center space-x-3">
            <div class="w-9 h-9 rounded-xl bg-fjordcard border border-fjordgold/40 flex items-center justify-center text-fjordgold text-sm font-bold">
                &#10052;
            </div>
            <div>
                <span class="font-extrabold text-base tracking-tight text-white">EduCore <span class="text-fjordgold">SaaS</span></span>
                <span class="hidden sm:inline text-[10px] font-mono text-fjordmuted ml-2">WINTER BENTO</span>
            </div>
        </a>

        <nav class="hidden md:flex items-center space-x-6 text-xs font-semibold text-fjordmuted">
            <a href="#bento-showcase" class="hover:text-fjordgold transition">Workspace</a>
            <a href="#features" class="hover:text-fjordgold transition">Features</a>
            <a href="#pricing" class="hover:text-fjordgold transition">Pricing</a>
            <a href="#faq" class="hover:text-fjordgold transition">FAQ</a>
        </nav>

        <!-- Excluded Zone: Keep Log in and Get started clean -->
        <div id="authActionZone" class="relative z-50 flex items-center space-x-2.5 px-2 py-1 rounded-2xl">
            <a href="{{ route('login') }}" class="px-3.5 py-2 text-xs font-bold text-fjordtext hover:text-fjordgold hover:bg-fjordcard rounded-xl transition">Log in</a>
            <a href="{{ route('register') }}" class="px-4 py-2 bg-fjordberry hover:bg-fjordberrydark text-white text-xs font-extrabold rounded-xl shadow-sm transition">Get started &rarr;</a>
        </div>
    </header>

    <!-- Hero & Bento Grid Showcase -->
    <section id="bento-showcase" class="relative z-10 max-w-6xl mx-auto px-6 pt-14 pb-16 space-y-6">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-5">

            <!-- Main Hero Bento Tile -->
            <div class="lg:col-span-8 bg-fjordcard/95 border border-fjordborder rounded-3xl p-8 md:p-10 shadow-xl flex flex-col justify-between space-y-8">
                <div class="space-y-4">
                    <div class="inline-flex items-center space-x-2 px-3.5 py-1 rounded-full bg-fjordbase border border-fjordborder text-[11px] font-semibold text-fjordgold">
                        <span>&#10022;</span>
                        <span>Happy Holidays &bull; Group 1 Student Records Cloud</span>
                    </div>

                    <h1 class="text-4xl sm:text-5xl font-extrabold text-white tracking-tight leading-[1.08]">
                        Simplify student records.
                        <span class="block text-fjordgold mt-1">Elevate every outcome.</span>
                    </h1>

                    <p class="text-sm text-fjordmuted max-w-2xl leading-relaxed">
                        Organize student IDs, track cohort GPAs across 3.00, 4.00, or 5.00 scales, filter courses fast, and export clean CSV rosters from one calm workspace.
                    </p>
                </div>

                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3.5">
                    <a href="{{ route('register') }}" class="px-7 py-3.5 bg-fjordgold hover:bg-fjordgolddark text-fjordbase text-xs font-extrabold rounded-2xl transition text-center shadow-sm">
                        Start managing free &rarr;
                    </a>
                    <a href="#live-preview" class="px-7 py-3.5 bg-fjordbase hover:bg-fjordhover text-fjordtext border border-fjordborder text-xs font-bold rounded-2xl transition text-center">
                        View live workspace
                    </a>
                </div>
            </div>

            <!-- Right Stacked Bento Metrics -->
            <div class="lg:col-span-4 grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-1 gap-5">
                <div class="bg-fjordcard/95 border border-fjordborder rounded-3xl p-6 shadow-lg flex flex-col justify-between">
                    <span class="text-[10px] font-mono uppercase tracking-wider text-fjordmuted">Enrolled Students</span>
                    <div class="text-3xl font-extrabold text-white mt-2 tabular-nums">{{ $totalStudents }}</div>
                    <span class="text-[11px] text-fjordgold mt-2">Live DB synced</span>
                </div>

                <div class="bg-fjordcard/95 border border-fjordborder rounded-3xl p-6 shadow-lg flex flex-col justify-between">
                    <span class="text-[10px] font-mono uppercase tracking-wider text-fjordmuted">Average Cohort GPA</span>
                    <div class="text-3xl font-extrabold text-fjordgold mt-2 tabular-nums">{{ number_format((float) $averageGpa, 2) }}</div>
                    <span class="text-[11px] text-fjordmuted mt-2">Calculated mean</span>
                </div>

                <div class="bg-fjordcard/95 border border-fjordborder rounded-3xl p-6 shadow-lg flex flex-col justify-between">
                    <span class="text-[10px] font-mono uppercase tracking-wider text-fjordmuted">Active Courses</span>
                    <div class="text-3xl font-extrabold text-white mt-2 tabular-nums">{{ $activeCoursesCount }}</div>
                    <span class="text-[11px] text-fjordberry font-semibold mt-2">&#10052; Season&apos;s greetings</span>
                </div>
            </div>
        </div>

        <!-- Interactive Live Workspace Panel -->
        <div id="live-preview" class="bg-fjordcard border border-fjordborder rounded-3xl shadow-2xl overflow-hidden">
            <div class="px-6 py-4 bg-fjordbase/85 border-b border-fjordborder flex flex-wrap items-center justify-between gap-4">
                <div class="flex items-center space-x-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-fjordberry"></span>
                    <span class="w-2.5 h-2.5 rounded-full bg-fjordgold"></span>
                    <span class="w-2.5 h-2.5 rounded-full bg-fjordborder"></span>
                    <span class="text-xs font-mono text-fjordmuted ml-2">educore.app/workspace/dashboard</span>
                    <span class="hidden sm:inline-flex text-[10px] font-mono text-fjordgold bg-fjordcard border border-fjordborder px-2.5 py-0.5 rounded-full">Live DB Connected</span>
                </div>

                <div class="flex items-center space-x-1.5 bg-fjordbase p-1 rounded-xl border border-fjordborder">
                    <button type="button" onclick="switchTab('dashboard')" id="tab-dashboard" class="px-4 py-1.5 rounded-lg text-xs font-bold bg-fjordgold text-fjordbase transition">Dashboard View</button>
                    <button type="button" onclick="switchTab('directory')" id="tab-directory" class="px-4 py-1.5 rounded-lg text-xs font-bold text-fjordmuted hover:text-white transition">Directory Table</button>
                </div>
            </div>

            <div class="p-6 md:p-8">
                <!-- Tab 1: Dashboard Summary -->
                <div id="content-dashboard" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="bg-fjordbase/85 p-5 rounded-2xl border border-fjordborder">
                        <p class="text-[10px] font-mono uppercase text-fjordmuted">Total Enrolled (Live DB)</p>
                        <p class="text-3xl font-extrabold text-white mt-1.5 tabular-nums">{{ $totalStudents }}</p>
                        <span class="text-[10px] text-fjordgold bg-fjordcard border border-fjordborder px-2.5 py-0.5 rounded font-bold mt-3 inline-block">Synced Database</span>
                    </div>

                    <div class="bg-fjordbase/85 p-5 rounded-2xl border border-fjordborder">
                        <p class="text-[10px] font-mono uppercase text-fjordmuted">Average Cohort GPA</p>
                        <p class="text-3xl font-extrabold text-fjordgold mt-1.5 tabular-nums">{{ number_format((float) $averageGpa, 2) }}</p>
                        <span class="text-[10px] text-fjordtext bg-fjordcard border border-fjordborder px-2.5 py-0.5 rounded font-bold mt-3 inline-block">Calculated Mean</span>
                    </div>

                    <div class="bg-fjordbase/85 p-5 rounded-2xl border border-fjordborder">
                        <p class="text-[10px] font-mono uppercase text-fjordmuted">Active Departments</p>
                        <p class="text-3xl font-extrabold text-white mt-1.5 tabular-nums">{{ $activeCoursesCount }}</p>
                        <span class="text-[10px] text-fjordmuted bg-fjordcard border border-fjordborder px-2.5 py-0.5 rounded font-bold mt-3 inline-block">Unique Courses</span>
                    </div>
                </div>

                <!-- Tab 2: Live Directory Table -->
                <div id="content-directory" class="hidden space-y-4">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                        <p class="text-xs text-fjordmuted">Live student records preview from your workspace database.</p>
                        <input
                            type="text"
                            id="previewSearchInput"
                            oninput="filterPreviewStudents()"
                            placeholder="Filter by ID, name, or course..."
                            class="w-full sm:w-72 px-3.5 py-2 bg-fjordbase border border-fjordborder rounded-xl text-xs text-white placeholder-fjordmuted/60 focus:outline-none focus:border-fjordgold transition"
                        >
                    </div>

                    <div class="bg-fjordbase/85 rounded-2xl border border-fjordborder overflow-hidden">
                        <div class="grid grid-cols-12 px-5 py-3 bg-fjordhover border-b border-fjordborder text-[10px] font-mono font-bold text-fjordgold uppercase tracking-wider">
                            <span class="col-span-5">Student ID &amp; Name</span>
                            <span class="col-span-3">Course</span>
                            <span class="col-span-2">GPA</span>
                            <span class="col-span-2 text-right">Status</span>
                        </div>
                        <div class="divide-y divide-fjordborder/60 text-xs">
                            @forelse ($students as $student)
                                <div class="preview-student-row grid grid-cols-12 px-5 py-3.5 items-center hover:bg-fjordcard/70 transition" data-filter="{{ strtolower(($student->student_id ?? '') . ' ' . ($student->name ?? '') . ' ' . ($student->course ?? 'BSIT')) }}">
                                    <div class="col-span-5 flex items-center space-x-2.5 min-w-0 pr-2">
                                        <span class="font-mono text-[11px] font-bold text-fjordgold bg-fjordcard border border-fjordborder px-2 py-0.5 rounded-md shrink-0">{{ $student->student_id }}</span>
                                        <span class="font-bold text-white truncate">{{ $student->name }}</span>
                                    </div>
                                    <span class="col-span-3 text-fjordmuted font-medium truncate pr-2">{{ $student->course ?? 'BSIT' }}</span>
                                    <span class="col-span-2 font-extrabold text-fjordgold tabular-nums">{{ number_format((float) $student->gpa, 2) }}</span>
                                    <div class="col-span-2 text-right">
                                        <span class="inline-flex items-center px-2.5 py-0.5 bg-fjordcard border border-fjordborder text-fjordtext rounded-full font-bold text-[11px]">Active</span>
                                    </div>
                                </div>
                            @empty
                                <div class="p-8 text-center text-fjordmuted">No records found in database.</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Bento -->
    <section id="features" class="relative z-10 max-w-6xl mx-auto px-6 py-14 space-y-6">
        <div class="space-y-1">
            <span class="text-[10px] font-mono font-extrabold uppercase tracking-widest text-fjordgold">Core Capabilities</span>
            <h2 class="text-2xl md:text-3xl font-extrabold text-white">Less admin. More clarity.</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            <div class="bg-fjordcard/95 p-6 rounded-3xl border border-fjordborder hover:border-fjordgold/50 transition space-y-2.5">
                <span class="text-xs font-mono text-fjordgold font-bold">&#10022; 01</span>
                <h3 class="text-sm font-bold text-white">Instant CRUD Management</h3>
                <p class="text-xs text-fjordmuted leading-relaxed">Add, update, and manage student records quickly with prefix rules and GPA validation.</p>
            </div>

            <div class="bg-fjordcard/95 p-6 rounded-3xl border border-fjordborder hover:border-fjordgold/50 transition space-y-2.5">
                <span class="text-xs font-mono text-fjordberry font-bold">&#10022; 02</span>
                <h3 class="text-sm font-bold text-white">Interactive Grading Statistics</h3>
                <p class="text-xs text-fjordmuted leading-relaxed">Track GPA averages across 3.00, 4.00, or 5.00 scales and inspect course breakdowns.</p>
            </div>

            <div class="bg-fjordcard/95 p-6 rounded-3xl border border-fjordborder hover:border-fjordgold/50 transition space-y-2.5">
                <span class="text-xs font-mono text-fjordgold font-bold">&#10022; 03</span>
                <h3 class="text-sm font-bold text-white">Search, Filter &amp; CSV Export</h3>
                <p class="text-xs text-fjordmuted leading-relaxed">Search by ID, name, or course, sort records cleanly, and export rosters to CSV when needed.</p>
            </div>
        </div>
    </section>

    <!-- Pricing -->
    <section id="pricing" class="relative z-10 max-w-6xl mx-auto px-6 py-14 space-y-8">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div class="space-y-1">
                <span class="text-[10px] font-mono font-extrabold uppercase tracking-widest text-fjordgold">Transparent Pricing</span>
                <h2 class="text-2xl md:text-3xl font-extrabold text-white">Simple plans for academic teams</h2>
            </div>

            <div class="inline-flex items-center space-x-1.5 bg-fjordcard border border-fjordborder p-1.5 rounded-2xl">
                <button type="button" onclick="setPricing('monthly')" id="btn-monthly" class="px-4 py-2 rounded-xl text-xs font-extrabold bg-fjordgold text-fjordbase transition">Monthly Billing</button>
                <button type="button" onclick="setPricing('annual')" id="btn-annual" class="px-4 py-2 rounded-xl text-xs font-bold text-fjordmuted hover:text-white transition">
                    Annual Billing <span class="text-[10px] text-fjordgold font-bold bg-fjordbase px-2 py-0.5 rounded-full ml-1">Save 20%</span>
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-4xl mx-auto">
            <div class="bg-fjordcard/95 p-8 rounded-3xl border border-fjordborder space-y-6 flex flex-col justify-between">
                <div class="space-y-3">
                    <h3 class="text-xs font-extrabold text-white uppercase tracking-wider">Department Workspace</h3>
                    <div class="flex items-baseline space-x-1">
                        <span class="text-4xl font-extrabold text-white price-starter tabular-nums">&#8369;0</span>
                        <span class="text-xs text-fjordmuted billing-cycle">/ month</span>
                    </div>
                    <p class="text-xs text-fjordmuted">Good for individual departments and small student rosters.</p>
                </div>
                <a href="{{ route('register') }}" class="w-full py-3 bg-fjordbase hover:bg-fjordhover text-white border border-fjordborder rounded-xl text-xs font-bold transition text-center block">Get Started Free</a>
            </div>

            <div class="bg-fjordcard p-8 rounded-3xl border-2 border-fjordgold shadow-xl space-y-6 flex flex-col justify-between relative overflow-hidden">
                <div class="absolute top-0 right-0 bg-fjordgold text-fjordbase text-[9px] font-extrabold px-3.5 py-1 rounded-bl-xl uppercase tracking-widest">Most Popular</div>
                <div class="space-y-3">
                    <h3 class="text-xs font-extrabold text-white uppercase tracking-wider">Full Institution SaaS</h3>
                    <div class="flex items-baseline space-x-1">
                        <span class="text-4xl font-extrabold text-fjordgold price-pro tabular-nums">&#8369;500</span>
                        <span class="text-xs text-fjordmuted billing-cycle">/ month</span>
                    </div>
                    <p class="text-xs text-fjordmuted">For multi-course academic teams managing larger student directories.</p>
                </div>
                <a href="{{ route('register') }}" class="w-full py-3 bg-fjordberry hover:bg-fjordberrydark text-white rounded-xl text-xs font-extrabold transition text-center block">Deploy Workspace</a>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section id="faq" class="relative z-10 max-w-4xl mx-auto px-6 py-14 space-y-6">
        <div class="space-y-1">
            <span class="text-[10px] font-mono font-extrabold uppercase tracking-widest text-fjordgold">Got Questions?</span>
            <h2 class="text-2xl font-extrabold text-white">Frequently Asked Questions</h2>
        </div>

        <div class="space-y-3">
            <div class="bg-fjordcard/95 rounded-2xl border border-fjordborder overflow-hidden">
                <button type="button" onclick="toggleFaq(1)" class="w-full p-5 text-left flex justify-between items-center text-xs font-bold text-white hover:bg-fjordhover/50 transition">
                    <span>How does workspace session persistence work?</span>
                    <span id="icon-1" class="text-lg font-mono text-fjordgold">+</span>
                </button>
                <div id="faq-1" class="hidden p-5 pt-3 text-xs text-fjordmuted leading-relaxed border-t border-fjordborder">
                    EduCore keeps your active workspace session, workspace name, and selected GPA scale synced across dashboard, directory, and settings views.
                </div>
            </div>

            <div class="bg-fjordcard/95 rounded-2xl border border-fjordborder overflow-hidden">
                <button type="button" onclick="toggleFaq(2)" class="w-full p-5 text-left flex justify-between items-center text-xs font-bold text-white hover:bg-fjordhover/50 transition">
                    <span>Can I export student records into CSV files?</span>
                    <span id="icon-2" class="text-lg font-mono text-fjordgold">+</span>
                </button>
                <div id="faq-2" class="hidden p-5 pt-3 text-xs text-fjordmuted leading-relaxed border-t border-fjordborder">
                    Yes. You can download your current student records as a CSV file directly from the Settings page.
                </div>
            </div>

            <div class="bg-fjordcard/95 rounded-2xl border border-fjordborder overflow-hidden">
                <button type="button" onclick="toggleFaq(3)" class="w-full p-5 text-left flex justify-between items-center text-xs font-bold text-white hover:bg-fjordhover/50 transition">
                    <span>Which GPA scales and Student ID prefixes are supported?</span>
                    <span id="icon-3" class="text-lg font-mono text-fjordgold">+</span>
                </button>
                <div id="faq-3" class="hidden p-5 pt-3 text-xs text-fjordmuted leading-relaxed border-t border-fjordborder">
                    You can switch between 3.00, 4.00, and 5.00 GPA scales and customize your default Student ID prefix in Settings while keeping IDs clean and validated.
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="relative z-10 max-w-6xl mx-auto px-6 py-8 border-t border-fjordborder flex flex-col sm:flex-row items-center justify-between text-xs text-fjordmuted gap-4">
        <span class="font-bold text-white">EduCore SaaS</span>
        <p>&copy; 2026 EduCore &bull; Built by Group 1 &bull; <span class="text-fjordgold">Happy holidays</span></p>
        <div class="flex items-center space-x-6">
            <a href="#features" class="hover:text-fjordgold transition">Features</a>
            <a href="#pricing" class="hover:text-fjordgold transition">Pricing</a>
            <a href="#faq" class="hover:text-fjordgold transition">FAQ</a>
        </div>
    </footer>

    <script>
        function switchTab(tab) {
            const dashContent = document.getElementById('content-dashboard');
            const dirContent = document.getElementById('content-directory');
            const dashBtn = document.getElementById('tab-dashboard');
            const dirBtn = document.getElementById('tab-directory');

            if (tab === 'dashboard') {
                dashContent.classList.remove('hidden');
                dirContent.classList.add('hidden');
                dashBtn.className = 'px-4 py-1.5 rounded-lg text-xs font-bold bg-fjordgold text-fjordbase transition';
                dirBtn.className = 'px-4 py-1.5 rounded-lg text-xs font-bold text-fjordmuted hover:text-white transition';
            } else {
                dirContent.classList.remove('hidden');
                dashContent.classList.add('hidden');
                dirBtn.className = 'px-4 py-1.5 rounded-lg text-xs font-bold bg-fjordgold text-fjordbase transition';
                dashBtn.className = 'px-4 py-1.5 rounded-lg text-xs font-bold text-fjordmuted hover:text-white transition';
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
                aBtn.className = 'px-4 py-2 rounded-xl text-xs font-extrabold bg-fjordgold text-fjordbase transition';
                mBtn.className = 'px-4 py-2 rounded-xl text-xs font-bold text-fjordmuted hover:text-white transition';
                starter.innerText = '\u20B10';
                pro.innerText = '\u20B1400';
                cycles.forEach(el => el.innerText = '/ month (billed annually)');
            } else {
                mBtn.className = 'px-4 py-2 rounded-xl text-xs font-extrabold bg-fjordgold text-fjordbase transition';
                aBtn.className = 'px-4 py-2 rounded-xl text-xs font-bold text-fjordmuted hover:text-white transition';
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

        // Snow & warm gold glints skipping #authActionZone
        (function initFjordSnow() {
            const canvas = document.getElementById('fjordSnow');
            const excluded = document.getElementById('authActionZone');
            if (!canvas) return;
            const ctx = canvas.getContext('2d');
            let w = 0, h = 0;

            const specks = Array.from({ length: 38 }, (_, i) => ({
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
                        ctx.fillStyle = s.isGold ? 'rgba(229, 181, 103, 0.55)' : 'rgba(241, 245, 249, 0.35)';
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
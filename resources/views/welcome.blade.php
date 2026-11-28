<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduCore Student Records SaaS</title>
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
<body class="bg-midnight text-slate-200 font-sans antialiased selection:bg-candlelight/30 selection:text-candlelight overflow-x-hidden relative">
    <!-- Subtle Midnight Radial Glow -->
    <div class="pointer-events-none fixed inset-0 bg-[radial-gradient(ellipse_at_top,_rgba(69,114,171,0.22),_transparent_65%),radial-gradient(ellipse_at_bottom,_rgba(218,169,133,0.08),_transparent_60%)] z-0"></div>

    <!-- Full-Page Crystalline Snowflakes (Skips Log in & Get started action zone) -->
    <canvas id="pageSnowflakes" class="pointer-events-none fixed inset-0 w-full h-full z-30"></canvas>

    <!-- Subtle Moonlit Snowdrift along Viewport Bottom -->
    <div class="pointer-events-none fixed inset-x-0 bottom-0 h-14 z-20 overflow-hidden">
        <svg class="w-full h-full" viewBox="0 0 1440 80" preserveAspectRatio="none" fill="none">
            <path d="M0 42C240 16 480 62 760 36C1020 12 1240 54 1440 28V80H0V42Z" fill="#273B5C" fill-opacity="0.55"/>
            <path d="M0 56C320 38 620 70 960 48C1180 34 1330 62 1440 50V80H0V56Z" fill="#E8F1F8" fill-opacity="0.14"/>
        </svg>
    </div>

    <!-- Top Bar -->
    <header class="relative w-full bg-midnight/90 backdrop-blur-md border-b border-twilight h-20 flex items-center justify-between px-6 md:px-10 sticky top-0 z-40 shadow-lg shadow-black/30">
        <!-- Warm Candlelight Fairy Lights Garland along Header Bottom Edge -->
        <svg class="pointer-events-none absolute inset-x-0 -bottom-3 w-full h-6 z-30 overflow-visible" viewBox="0 0 1440 24" preserveAspectRatio="none" fill="none">
            <path d="M0 2Q180 17 360 2T720 2T1080 2T1440 2" stroke="#4572AB" stroke-width="1.2" stroke-opacity="0.7"/>
            <!-- Glowing Warm Candlelight Bulbs -->
            <circle cx="180" cy="11.5" r="3.2" fill="#DAA985"/>
            <circle cx="180" cy="11.5" r="7" fill="#DAA985" fill-opacity="0.25"/>
            <circle cx="360" cy="11.5" r="3.2" fill="#FFF3DC"/>
            <circle cx="360" cy="11.5" r="7" fill="#DAA985" fill-opacity="0.25"/>
            <circle cx="540" cy="11.5" r="3.2" fill="#DAA985"/>
            <circle cx="540" cy="11.5" r="7" fill="#DAA985" fill-opacity="0.25"/>
            <circle cx="720" cy="11.5" r="3.2" fill="#FFF3DC"/>
            <circle cx="720" cy="11.5" r="7" fill="#DAA985" fill-opacity="0.25"/>
            <circle cx="900" cy="11.5" r="3.2" fill="#DAA985"/>
            <circle cx="900" cy="11.5" r="7" fill="#DAA985" fill-opacity="0.25"/>
        </svg>

        <div class="flex items-center space-x-3">
            <div class="w-9 h-9 rounded-xl bg-deepnavy border border-starlight/50 flex items-center justify-center text-candlelight shadow-sm">
                <div class="grid grid-cols-2 gap-0.5">
                    <span class="w-1.5 h-1.5 bg-candlelight rounded-full"></span>
                    <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                    <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                    <span class="w-1.5 h-1.5 bg-candlelight rounded-full"></span>
                </div>
            </div>
            <span class="font-extrabold text-base tracking-tight text-white">EduCore <span class="text-candlelight">SaaS</span></span>
        </div>

        <nav class="hidden md:flex items-center space-x-8 text-xs font-semibold text-slate-300">
            <a href="#features" class="hover:text-candlelight transition">Features</a>
            <a href="#pricing" class="hover:text-candlelight transition">Pricing</a>
            <a href="#faq" class="hover:text-candlelight transition">FAQ</a>
        </nav>

        <!-- Excluded Zone: Keep Log in and Get started clean without snowflakes -->
        <div id="authActionZone" class="relative z-50 flex items-center space-x-3 md:space-x-4 px-2 py-1 rounded-2xl">
            <a href="{{ route('login') }}" class="px-4 py-2 text-xs font-bold text-slate-100 hover:text-candlelight hover:bg-deepnavy rounded-xl transition">Log in</a>
            <a href="{{ route('register') }}" class="px-5 py-2.5 bg-candlelight text-midnight text-xs font-extrabold rounded-xl shadow-md shadow-candlelight/20 hover:bg-[#e5ba99] transition transform hover:-translate-y-0.5">Get started &rarr;</a>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="relative z-10 max-w-5xl mx-auto px-6 pt-20 pb-12 text-center space-y-8">
        <div class="inline-flex items-center space-x-2 px-4 py-1.5 bg-deepnavy/90 border border-twilight rounded-full shadow-md text-xs font-semibold text-slate-200">
            <span class="text-candlelight text-sm leading-none">&#10022;</span>
            <span>Winter Term &bull; Student management, thoughtfully simplified</span>
            <span class="w-1.5 h-1.5 rounded-full bg-candlelight"></span>
        </div>

        <div class="space-y-4">
            <h1 class="text-4xl md:text-6xl font-extrabold text-white tracking-tight leading-tight">
                <span class="relative inline-block">
                    <!-- Midnight & Candlelight Winter Hat -->
                    <svg class="w-10 h-10 md:w-12 md:h-12 absolute -top-7 -left-6 -rotate-12 pointer-events-none drop-shadow" viewBox="0 0 48 48" fill="none">
                        <path d="M9 32C11 17 20 7 35 6C29 13 28 21 31 32H9Z" fill="#273B5C" stroke="#4572AB" stroke-width="1.2"/>
                        <path d="M24 14C27.5 14.5 29.5 16 31 18.5" stroke="#DAA985" stroke-width="2.2" stroke-linecap="round"/>
                        <path d="M35 6C40 7 43 11 44 15.5" stroke="#4572AB" stroke-width="3.5" stroke-linecap="round"/>
                        <circle cx="44.5" cy="16" r="4" fill="#DAA985" stroke="#FFF3DC" stroke-width="1.2"/>
                        <rect x="6.5" y="31" width="27" height="7" rx="3.5" fill="#F8FAFC" stroke="#C4D5E0" stroke-width="1.2"/>
                    </svg>
                    Simplify student records.
                </span>
                <br>
                <span class="text-candlelight">Elevate every outcome.</span>
            </h1>

            <p class="text-xs md:text-sm font-bold text-candlelight tracking-widest uppercase pt-1 bg-deepnavy/90 border border-twilight inline-block px-4 py-1.5 rounded-full shadow-sm">
                CREATED BY GROUP 1
            </p>
        </div>

        <p class="text-sm md:text-base text-slate-300 max-w-2xl mx-auto leading-relaxed">
            One workspace to organize student records, track academic performance, and keep department data clean.
        </p>

        <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-2">
            <a href="{{ route('register') }}" class="w-full sm:w-auto px-8 py-4 bg-candlelight text-midnight text-xs font-extrabold rounded-2xl shadow-lg shadow-candlelight/20 hover:bg-[#e5ba99] transition transform hover:-translate-y-0.5 flex items-center justify-center space-x-2">
                <span>Start managing free</span>
                <span>&rarr;</span>
            </a>
            <a href="#features" class="w-full sm:w-auto px-8 py-4 bg-deepnavy/90 text-white border border-twilight text-xs font-bold rounded-2xl shadow-sm hover:border-starlight hover:bg-twilight/70 transition">
                Explore live demo
            </a>
        </div>
    </section>

    <!-- Interactive Live Database Mockup Showcase -->
    <section class="relative z-10 max-w-6xl mx-auto px-6 pb-24">
        <div class="bg-gradient-to-b from-deepnavy/95 to-midnight/95 border border-twilight p-6 md:p-8 rounded-3xl shadow-2xl shadow-black/40 relative overflow-hidden">
            <div class="flex flex-wrap items-center justify-between gap-4 pb-6 border-b border-twilight">
                <div class="flex items-center space-x-2">
                    <div class="w-3 h-3 rounded-full bg-starlight"></div>
                    <div class="w-3 h-3 rounded-full bg-twilight"></div>
                    <div class="w-3 h-3 rounded-full bg-candlelight"></div>
                    <span class="text-xs font-mono text-slate-300 ml-2">educore.app/workspace/dashboard (Live DB Connected)</span>
                </div>
                <div class="flex items-center space-x-2 bg-midnight p-1 rounded-xl border border-twilight">
                    <button type="button" onclick="switchTab('dashboard')" id="tab-dashboard" class="px-4 py-1.5 rounded-lg text-xs font-bold bg-starlight text-white shadow-sm transition">Dashboard View</button>
                    <button type="button" onclick="switchTab('directory')" id="tab-directory" class="px-4 py-1.5 rounded-lg text-xs font-bold text-slate-300 hover:text-white transition">Directory Table</button>
                </div>
            </div>

            <!-- Tab 1: Live Database Analytics -->
            <div id="content-dashboard" class="pt-6 space-y-6 transition-all duration-300">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="bg-midnight/80 p-5 rounded-2xl border border-twilight shadow-sm">
                        <p class="text-[10px] font-bold uppercase text-slate-400">Total Enrolled (Live DB)</p>
                        <p class="text-3xl font-extrabold text-white mt-1">{{ $totalStudents }}</p>
                        <span class="text-[10px] text-candlelight bg-deepnavy border border-twilight px-2.5 py-0.5 rounded font-bold mt-2 inline-block">Synced Database</span>
                    </div>
                    <div class="bg-midnight/80 p-5 rounded-2xl border border-twilight shadow-sm">
                        <p class="text-[10px] font-bold uppercase text-slate-400">Average Cohort GPA</p>
                        <p class="text-3xl font-extrabold text-candlelight mt-1">{{ number_format((float) $averageGpa, 2) }}</p>
                        <span class="text-[10px] text-slate-200 bg-deepnavy border border-twilight px-2.5 py-0.5 rounded font-bold mt-2 inline-block">Calculated Mean</span>
                    </div>
                    <div class="bg-midnight/80 p-5 rounded-2xl border border-twilight shadow-sm">
                        <p class="text-[10px] font-bold uppercase text-slate-400">Active Departments</p>
                        <p class="text-3xl font-extrabold text-white mt-1">{{ $activeCoursesCount }}</p>
                        <span class="text-[10px] text-slate-300 bg-deepnavy border border-twilight px-2.5 py-0.5 rounded font-bold mt-2 inline-block">Unique Courses</span>
                    </div>
                </div>

                <div class="bg-midnight/80 p-6 rounded-2xl border border-twilight shadow-sm flex items-center justify-between gap-4">
                    <div>
                        <p class="text-xs font-bold text-white">Workspace Telemetry Active</p>
                        <p class="text-[11px] text-slate-400">Displaying live summary figures from your EduCore workspace database.</p>
                    </div>
                    <span class="px-3 py-1 bg-deepnavy border border-candlelight/50 text-candlelight text-xs font-bold rounded-xl shrink-0">Live DB Connected</span>
                </div>
            </div>

            <!-- Tab 2: Live Database Directory Table -->
            <div id="content-directory" class="pt-6 hidden space-y-4 transition-all duration-300">
                <div class="bg-midnight/80 rounded-2xl border border-twilight shadow-sm overflow-hidden">
                    <div class="p-4 bg-deepnavy border-b border-twilight flex justify-between items-center text-xs font-bold text-candlelight uppercase">
                        <span>Student ID &amp; Name</span>
                        <span>Course</span>
                        <span>GPA</span>
                        <span>Status</span>
                    </div>
                    <div class="divide-y divide-twilight/60 text-xs">
                        @forelse ($students as $student)
                            <div class="p-4 flex justify-between items-center hover:bg-deepnavy/50">
                                <span class="font-bold text-white">{{ $student->student_id }} {{ $student->name }}</span>
                                <span class="text-slate-300 font-medium">{{ $student->course ?? 'BSIT' }}</span>
                                <span class="font-extrabold text-candlelight">{{ number_format((float) $student->gpa, 2) }}</span>
                                <span class="px-2.5 py-0.5 bg-deepnavy border border-starlight/50 text-slate-200 rounded-full font-bold">Active</span>
                            </div>
                        @empty
                            <div class="p-6 text-center text-slate-400">No records found in database.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="relative z-10 max-w-6xl mx-auto px-6 py-16 space-y-12 border-t border-twilight">
        <div class="text-center space-y-3">
            <span class="text-[10px] font-extrabold uppercase tracking-widest text-candlelight">Everything you need</span>
            <h2 class="text-2xl md:text-3xl font-extrabold text-white">Less admin. More clarity.</h2>
            <p class="text-xs text-slate-300 max-w-xl mx-auto">Tools built for student record management, GPA tracking, and organized department rosters.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-deepnavy/90 p-6 rounded-3xl border border-twilight shadow-lg hover:border-starlight transition space-y-3">
                <div class="w-10 h-10 rounded-2xl bg-midnight border border-twilight text-candlelight flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
                <h3 class="text-sm font-bold text-white">Instant CRUD Management</h3>
                <p class="text-xs text-slate-300 leading-relaxed">Add, update, and manage student records quickly with prefix rules and GPA validation.</p>
            </div>

            <div class="bg-deepnavy/90 p-6 rounded-3xl border border-twilight shadow-lg hover:border-starlight transition space-y-3">
                <div class="w-10 h-10 rounded-2xl bg-midnight border border-twilight text-candlelight flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                </div>
                <h3 class="text-sm font-bold text-white">Interactive Grading Statistics</h3>
                <p class="text-xs text-slate-300 leading-relaxed">Track GPA averages across 3.00, 4.00, or 5.00 scales and inspect course breakdowns.</p>
            </div>

            <div class="bg-deepnavy/90 p-6 rounded-3xl border border-twilight shadow-lg hover:border-starlight transition space-y-3">
                <div class="w-10 h-10 rounded-2xl bg-midnight border border-twilight text-candlelight flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <h3 class="text-sm font-bold text-white">Search, Filter &amp; CSV Export</h3>
                <p class="text-xs text-slate-300 leading-relaxed">Search by ID, name, or course, sort records cleanly, and export rosters to CSV when needed.</p>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section id="pricing" class="relative z-10 max-w-5xl mx-auto px-6 py-16 space-y-10">
        <div class="text-center space-y-3">
            <span class="text-[10px] font-extrabold uppercase tracking-widest text-candlelight">Transparent Pricing</span>
            <h2 class="text-2xl md:text-3xl font-extrabold text-white">Simple plans for academic teams</h2>
            <div class="inline-flex items-center space-x-2 bg-deepnavy border border-twilight p-1.5 rounded-2xl mt-4">
                <button type="button" onclick="setPricing('monthly')" id="btn-monthly" class="px-4 py-2 rounded-xl text-xs font-extrabold bg-candlelight text-midnight shadow-sm transition">Monthly Billing</button>
                <button type="button" onclick="setPricing('annual')" id="btn-annual" class="px-4 py-2 rounded-xl text-xs font-bold text-slate-300 hover:text-white transition">
                    Annual Billing
                    <span class="text-[10px] text-candlelight font-bold bg-midnight px-2 py-0.5 rounded-full ml-1">Save 20%</span>
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-3xl mx-auto">
            <div class="bg-deepnavy/90 p-8 rounded-3xl border border-twilight shadow-lg space-y-6 flex flex-col justify-between">
                <div class="space-y-4">
                    <h3 class="text-sm font-extrabold text-white uppercase tracking-wider">Department Workspace</h3>
                    <div class="flex items-baseline space-x-1">
                        <span class="text-4xl font-extrabold text-white price-starter">&#8369;0</span>
                        <span class="text-xs text-slate-400 billing-cycle">/ month</span>
                    </div>
                    <p class="text-xs text-slate-300">Good for individual departments and small student rosters.</p>
                </div>
                <a href="{{ route('register') }}" class="w-full py-3 bg-midnight hover:bg-twilight text-white border border-twilight rounded-xl text-xs font-bold transition text-center block">Get Started Free</a>
            </div>

            <div class="bg-deepnavy p-8 rounded-3xl border-2 border-candlelight shadow-xl shadow-black/40 space-y-6 flex flex-col justify-between relative overflow-hidden">
                <div class="absolute top-0 right-0 bg-candlelight text-midnight text-[9px] font-extrabold px-3 py-1 rounded-bl-xl uppercase tracking-widest">Most Popular</div>
                <div class="space-y-4">
                    <h3 class="text-sm font-extrabold text-white uppercase tracking-wider">Full Institution SaaS</h3>
                    <div class="flex items-baseline space-x-1">
                        <span class="text-4xl font-extrabold text-candlelight price-pro">&#8369;500</span>
                        <span class="text-xs text-slate-400 billing-cycle">/ month</span>
                    </div>
                    <p class="text-xs text-slate-300">For multi-course academic teams managing larger student directories.</p>
                </div>
                <a href="{{ route('register') }}" class="w-full py-3 bg-candlelight hover:bg-[#e5ba99] text-midnight rounded-xl text-xs font-extrabold transition text-center block shadow-sm">Deploy Workspace</a>
            </div>
        </div>
    </section>

    <!-- Interactive FAQ Section -->
    <section id="faq" class="relative z-10 max-w-4xl mx-auto px-6 py-16 space-y-8">
        <div class="text-center space-y-2">
            <span class="text-[10px] font-extrabold uppercase tracking-widest text-candlelight">Got Questions?</span>
            <h2 class="text-2xl font-extrabold text-white">Frequently Asked Questions</h2>
        </div>

        <div class="space-y-4">
            <div class="bg-deepnavy/90 rounded-2xl border border-twilight shadow-md overflow-hidden">
                <button type="button" onclick="toggleFaq(1)" class="w-full p-5 text-left flex justify-between items-center text-xs font-bold text-white hover:bg-twilight/40 transition">
                    <span>How does workspace session persistence work?</span>
                    <span id="icon-1" class="text-lg font-bold text-candlelight transition-transform">+</span>
                </button>
                <div id="faq-1" class="hidden p-5 pt-3 text-xs text-slate-300 leading-relaxed border-t border-twilight">
                    EduCore keeps your active workspace session, workspace name, and selected GPA scale synced across dashboard, directory, and settings views.
                </div>
            </div>

            <div class="bg-deepnavy/90 rounded-2xl border border-twilight shadow-md overflow-hidden">
                <button type="button" onclick="toggleFaq(2)" class="w-full p-5 text-left flex justify-between items-center text-xs font-bold text-white hover:bg-twilight/40 transition">
                    <span>Can I export student records into CSV files?</span>
                    <span id="icon-2" class="text-lg font-bold text-candlelight transition-transform">+</span>
                </button>
                <div id="faq-2" class="hidden p-5 pt-3 text-xs text-slate-300 leading-relaxed border-t border-twilight">
                    Yes. You can download your current student records as a CSV file directly from the Settings page.
                </div>
            </div>
        </div>
    </section>

    <!-- Bottom CTA Banner -->
    <section class="relative z-10 max-w-6xl mx-auto px-6 py-12">
        <div class="bg-gradient-to-r from-deepnavy via-twilight to-deepnavy text-white rounded-3xl p-8 md:p-12 flex flex-col md:flex-row items-center justify-between gap-6 shadow-2xl border border-starlight/40">
            <div class="space-y-2 text-center md:text-left">
                <p class="text-[10px] font-bold uppercase tracking-widest text-candlelight">Winter Term Ready</p>
                <h3 class="text-xl md:text-2xl font-extrabold">Give your team time back.</h3>
                <p class="text-xs text-slate-300 max-w-md">Set up your workspace and keep student records organized in one place.</p>
            </div>
            <a href="{{ route('register') }}" class="px-8 py-4 bg-candlelight text-midnight text-xs font-extrabold rounded-2xl shadow-md hover:bg-[#e5ba99] transition transform hover:-translate-y-0.5 shrink-0">
                Get started for free
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="relative z-10 max-w-6xl mx-auto px-6 py-8 border-t border-twilight flex flex-col md:flex-row items-center justify-between text-xs text-slate-400 gap-4">
        <div class="flex items-center space-x-2">
            <div class="w-6 h-6 rounded-lg bg-deepnavy border border-starlight/50 flex items-center justify-center text-candlelight text-[9px] font-bold">EA</div>
            <span class="font-bold text-white">EduCore SaaS</span>
        </div>
        <p>&copy; 2026 EduCore. Built for better education by Group 1.</p>
        <div class="flex items-center space-x-6">
            <a href="#" class="hover:text-candlelight transition">Privacy</a>
            <a href="#" class="hover:text-candlelight transition">Terms</a>
            <a href="#" class="hover:text-candlelight transition">Contact</a>
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
                dashBtn.className = 'px-4 py-1.5 rounded-lg text-xs font-bold bg-starlight text-white shadow-sm transition';
                dirBtn.className = 'px-4 py-1.5 rounded-lg text-xs font-bold text-slate-300 hover:text-white transition';
            } else {
                dirContent.classList.remove('hidden');
                dashContent.classList.add('hidden');
                dirBtn.className = 'px-4 py-1.5 rounded-lg text-xs font-bold bg-starlight text-white shadow-sm transition';
                dashBtn.className = 'px-4 py-1.5 rounded-lg text-xs font-bold text-slate-300 hover:text-white transition';
            }
        }

        function setPricing(plan) {
            const monthlyBtn = document.getElementById('btn-monthly');
            const annualBtn = document.getElementById('btn-annual');
            const priceStarter = document.querySelector('.price-starter');
            const pricePro = document.querySelector('.price-pro');
            const cycles = document.querySelectorAll('.billing-cycle');

            if (plan === 'annual') {
                annualBtn.className = 'px-4 py-2 rounded-xl text-xs font-extrabold bg-candlelight text-midnight shadow-sm transition';
                monthlyBtn.className = 'px-4 py-2 rounded-xl text-xs font-bold text-slate-300 hover:text-white transition';
                priceStarter.innerText = '\u20B10';
                pricePro.innerText = '\u20B1400';
                cycles.forEach(el => el.innerText = '/ month (billed annually)');
            } else {
                monthlyBtn.className = 'px-4 py-2 rounded-xl text-xs font-extrabold bg-candlelight text-midnight shadow-sm transition';
                annualBtn.className = 'px-4 py-2 rounded-xl text-xs font-bold text-slate-300 hover:text-white transition';
                priceStarter.innerText = '\u20B10';
                pricePro.innerText = '\u20B1500';
                cycles.forEach(el => el.innerText = '/ month');
            }
        }

        function toggleFaq(id) {
            const content = document.getElementById(`faq-${id}`);
            const icon = document.getElementById(`icon-${id}`);
            if (!content || !icon) return;
            if (content.classList.contains('hidden')) {
                content.classList.remove('hidden');
                icon.innerText = '−';
            } else {
                content.classList.add('hidden');
                icon.innerText = '+';
            }
        }

        // Full-page crystalline snowflakes & warm bokeh glints that skip #authActionZone
        (function initPageSnowflakes() {
            const canvas = document.getElementById('pageSnowflakes');
            const excludedEl = document.getElementById('authActionZone');
            if (!canvas) return;
            const ctx = canvas.getContext('2d');
            let width = 0;
            let height = 0;

            const flakes = Array.from({ length: 50 }, (_, idx) => ({
                x: Math.random() * 1600,
                y: Math.random() * 1000,
                size: 4.5 + Math.random() * 6.5,
                vy: 0.45 + Math.random() * 0.75,
                vx: -0.35 + Math.random() * 0.7,
                angle: Math.random() * Math.PI * 2,
                spin: (-0.012 + Math.random() * 0.024),
                alpha: 0.5 + Math.random() * 0.4,
                isWarmGlint: idx % 7 === 0,
            }));

            function resize() {
                width = canvas.width = window.innerWidth;
                height = canvas.height = window.innerHeight;
            }
            resize();
            window.addEventListener('resize', resize);

            function isInsideExcludedZone(x, y, pad = 12) {
                if (!excludedEl) return false;
                const rect = excludedEl.getBoundingClientRect();
                return (
                    x >= rect.left - pad &&
                    x <= rect.right + pad &&
                    y >= rect.top - pad &&
                    y <= rect.bottom + pad
                );
            }

            function drawSnowflake(f) {
                ctx.save();
                ctx.translate(f.x, f.y);

                if (f.isWarmGlint) {
                    const grad = ctx.createRadialGradient(0, 0, 0.5, 0, 0, f.size * 1.4);
                    grad.addColorStop(0, `rgba(255, 243, 220, ${f.alpha})`);
                    grad.addColorStop(0.5, `rgba(218, 169, 133, ${f.alpha * 0.55})`);
                    grad.addColorStop(1, 'rgba(218, 169, 133, 0)');
                    ctx.fillStyle = grad;
                    ctx.beginPath();
                    ctx.arc(0, 0, f.size * 1.4, 0, Math.PI * 2);
                    ctx.fill();
                    ctx.restore();
                    return;
                }

                ctx.rotate(f.angle);
                ctx.strokeStyle = `rgba(226, 239, 250, ${f.alpha})`;
                ctx.fillStyle = `rgba(255, 255, 255, ${f.alpha})`;
                ctx.lineWidth = Math.max(1, f.size * 0.14);
                ctx.lineCap = 'round';

                const r = f.size;
                const branch = r * 0.36;

                for (let i = 0; i < 6; i++) {
                    ctx.save();
                    ctx.rotate((i * Math.PI) / 3);

                    ctx.beginPath();
                    ctx.moveTo(0, 0);
                    ctx.lineTo(0, -r);
                    ctx.stroke();

                    ctx.beginPath();
                    ctx.moveTo(0, -r * 0.58);
                    ctx.lineTo(-branch * 0.75, -r * 0.82);
                    ctx.moveTo(0, -r * 0.58);
                    ctx.lineTo(branch * 0.75, -r * 0.82);
                    ctx.stroke();

                    ctx.restore();
                }

                ctx.beginPath();
                ctx.arc(0, 0, Math.max(1.2, r * 0.18), 0, Math.PI * 2);
                ctx.fill();
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

                    if (!isInsideExcludedZone(f.x, f.y, f.size + 10)) {
                        drawSnowflake(f);
                    }
                }
                requestAnimationFrame(tick);
            }
            tick();
        })();
    </script>
</body>
</html>
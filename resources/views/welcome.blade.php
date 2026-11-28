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
                        sandbase: '#DECBB9',     // ~60% warm dominant base
                        creamsoft: '#F7F3EE',    // soft light surface for easy reading
                        pineink: '#2C312B',      // dark pine-charcoal for readable text & cards
                        olivecard: '#5A6147',    // ~30% secondary olive green
                        burgundy: '#5A1E24',     // ~30% secondary deep burgundy
                        crimsonacc: '#B8292F',   // ~10% primary accent (CTAs & highlights)
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-sandbase text-pineink font-sans antialiased selection:bg-crimsonacc/20 selection:text-burgundy overflow-x-hidden relative">
    <!-- Gentle Warm Radial Glow (60% Dominant Base) -->
    <div class="pointer-events-none fixed inset-0 bg-[radial-gradient(ellipse_at_top,_rgba(247,243,238,0.65),_transparent_65%),radial-gradient(ellipse_at_bottom,_rgba(90,97,71,0.14),_transparent_65%)] z-0"></div>

    <!-- Top Bar (30% Secondary Structure + 10% Accent CTA) -->
    <header class="sticky top-0 z-40 w-full bg-creamsoft/95 backdrop-blur-md border-b border-pineink/15 h-20 flex items-center justify-between px-6 md:px-10 shadow-sm">
        <div class="flex items-center space-x-3">
            <div class="w-9 h-9 rounded-xl bg-burgundy border border-pineink/20 flex items-center justify-center text-creamsoft shadow-sm">
                <div class="grid grid-cols-2 gap-0.5">
                    <span class="w-1.5 h-1.5 bg-sandbase rounded-full"></span>
                    <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                    <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                    <span class="w-1.5 h-1.5 bg-sandbase rounded-full"></span>
                </div>
            </div>
            <span class="font-extrabold text-base tracking-tight text-pineink">EduCore <span class="text-crimsonacc">SaaS</span></span>
        </div>

        <nav class="hidden md:flex items-center space-x-8 text-xs font-semibold text-pineink/80">
            <a href="#features" class="hover:text-crimsonacc transition">Features</a>
            <a href="#pricing" class="hover:text-crimsonacc transition">Pricing</a>
            <a href="#faq" class="hover:text-crimsonacc transition">FAQ</a>
        </nav>

        <div id="authActionZone" class="relative z-50 flex items-center space-x-3 md:space-x-4 px-2 py-1 rounded-2xl">
            <a href="{{ route('login') }}" class="px-4 py-2 text-xs font-bold text-pineink hover:text-burgundy hover:bg-sandbase rounded-xl transition">Log in</a>
            <a href="{{ route('register') }}" class="px-5 py-2.5 bg-crimsonacc text-white text-xs font-extrabold rounded-xl shadow-sm hover:bg-burgundy transition transform hover:-translate-y-0.5">Get started &rarr;</a>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="relative z-10 max-w-5xl mx-auto px-6 pt-20 pb-12 text-center space-y-8">
        <div class="inline-flex items-center space-x-2 px-4 py-1.5 bg-creamsoft border border-olivecard/30 rounded-full shadow-sm text-xs font-semibold text-pineink">
            <span class="text-crimsonacc text-sm leading-none">&#10022;</span>
            <span>Student management, thoughtfully simplified</span>
            <span class="w-1.5 h-1.5 rounded-full bg-olivecard"></span>
        </div>

        <div class="space-y-4">
            <h1 class="text-4xl md:text-6xl font-extrabold text-pineink tracking-tight leading-tight">
                Simplify student records.
                <br>
                <span class="text-burgundy">Elevate every outcome.</span>
            </h1>
            <p class="text-xs md:text-sm font-bold text-burgundy tracking-widest uppercase pt-1 bg-creamsoft border border-pineink/15 inline-block px-4 py-1.5 rounded-full shadow-sm">
                CREATED BY GROUP 1
            </p>
        </div>

        <p class="text-sm md:text-base text-pineink/85 max-w-2xl mx-auto leading-relaxed">
            One workspace to organize student records, track academic performance, and keep department data clean.
        </p>

        <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-2">
            <a href="{{ route('register') }}" class="w-full sm:w-auto px-8 py-4 bg-crimsonacc text-white text-xs font-extrabold rounded-2xl shadow-md hover:bg-burgundy transition transform hover:-translate-y-0.5 flex items-center justify-center space-x-2">
                <span>Start managing free</span>
                <span>&rarr;</span>
            </a>
            <a href="#features" class="w-full sm:w-auto px-8 py-4 bg-creamsoft text-pineink border border-olivecard/40 text-xs font-bold rounded-2xl shadow-sm hover:bg-white transition">
                Explore live demo
            </a>
        </div>
    </section>

    <!-- Interactive Live Database Mockup Showcase (30% Secondary Cards on 60% Base) -->
    <section class="relative z-10 max-w-6xl mx-auto px-6 pb-24">
        <div class="bg-creamsoft border border-pineink/15 p-6 md:p-8 rounded-3xl shadow-xl relative overflow-hidden">
            <div class="flex flex-wrap items-center justify-between gap-4 pb-6 border-b border-pineink/15">
                <div class="flex items-center space-x-2">
                    <div class="w-3 h-3 rounded-full bg-crimsonacc"></div>
                    <div class="w-3 h-3 rounded-full bg-olivecard"></div>
                    <div class="w-3 h-3 rounded-full bg-burgundy"></div>
                    <span class="text-xs font-mono text-pineink/80 ml-2">educore.app/workspace/dashboard (Live DB Connected)</span>
                </div>

                <div class="flex items-center space-x-2 bg-sandbase p-1 rounded-xl border border-pineink/15">
                    <button type="button" onclick="switchTab('dashboard')" id="tab-dashboard" class="px-4 py-1.5 rounded-lg text-xs font-bold bg-crimsonacc text-white shadow-sm transition">Dashboard View</button>
                    <button type="button" onclick="switchTab('directory')" id="tab-directory" class="px-4 py-1.5 rounded-lg text-xs font-bold text-pineink/80 hover:text-pineink transition">Directory Table</button>
                </div>
            </div>

            <!-- Tab 1: Live Database Analytics -->
            <div id="content-dashboard" class="pt-6 space-y-6 transition-all duration-300">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="bg-white p-5 rounded-2xl border border-pineink/15 shadow-sm">
                        <p class="text-[10px] font-bold uppercase text-olivecard">Total Enrolled (Live DB)</p>
                        <p class="text-3xl font-extrabold text-pineink mt-1">{{ $totalStudents }}</p>
                        <span class="text-[10px] text-burgundy bg-sandbase border border-burgundy/20 px-2.5 py-0.5 rounded font-bold mt-2 inline-block">Synced Database</span>
                    </div>

                    <div class="bg-white p-5 rounded-2xl border border-pineink/15 shadow-sm">
                        <p class="text-[10px] font-bold uppercase text-olivecard">Average Cohort GPA</p>
                        <p class="text-3xl font-extrabold text-crimsonacc mt-1">{{ number_format((float) $averageGpa, 2) }}</p>
                        <span class="text-[10px] text-pineink bg-sandbase border border-pineink/15 px-2.5 py-0.5 rounded font-bold mt-2 inline-block">Calculated Mean</span>
                    </div>

                    <div class="bg-white p-5 rounded-2xl border border-pineink/15 shadow-sm">
                        <p class="text-[10px] font-bold uppercase text-olivecard">Active Departments</p>
                        <p class="text-3xl font-extrabold text-pineink mt-1">{{ $activeCoursesCount }}</p>
                        <span class="text-[10px] text-olivecard bg-sandbase border border-olivecard/25 px-2.5 py-0.5 rounded font-bold mt-2 inline-block">Unique Courses</span>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl border border-pineink/15 shadow-sm flex items-center justify-between gap-4">
                    <div>
                        <p class="text-xs font-bold text-pineink">Workspace Telemetry Active</p>
                        <p class="text-[11px] text-pineink/70">Displaying live summary figures from your EduCore workspace database.</p>
                    </div>
                    <span class="px-3 py-1 bg-olivecard/15 border border-olivecard/30 text-olivecard text-xs font-bold rounded-xl shrink-0">Live DB Connected</span>
                </div>
            </div>

            <!-- Tab 2: Live Database Directory Table -->
            <div id="content-directory" class="pt-6 hidden space-y-4 transition-all duration-300">
                <div class="bg-white rounded-2xl border border-pineink/15 shadow-sm overflow-hidden">
                    <div class="p-4 bg-burgundy border-b border-pineink/15 flex justify-between items-center text-xs font-bold text-creamsoft uppercase">
                        <span>Student ID &amp; Name</span>
                        <span>Course</span>
                        <span>GPA</span>
                        <span>Status</span>
                    </div>
                    <div class="divide-y divide-pineink/10 text-xs">
                        @forelse ($students as $student)
                            <div class="p-4 flex justify-between items-center hover:bg-sandbase/45">
                                <span class="font-bold text-pineink">{{ $student->student_id }} {{ $student->name }}</span>
                                <span class="text-pineink/80 font-medium">{{ $student->course ?? 'BSIT' }}</span>
                                <span class="font-extrabold text-crimsonacc">{{ number_format((float) $student->gpa, 2) }}</span>
                                <span class="px-2.5 py-0.5 bg-olivecard/15 border border-olivecard/30 text-olivecard rounded-full font-bold">Active</span>
                            </div>
                        @empty
                            <div class="p-6 text-center text-pineink/70">No records found in database.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="relative z-10 max-w-6xl mx-auto px-6 py-16 space-y-12 border-t border-pineink/15">
        <div class="text-center space-y-3">
            <span class="text-[10px] font-extrabold uppercase tracking-widest text-crimsonacc">Everything you need</span>
            <h2 class="text-2xl md:text-3xl font-extrabold text-pineink">Less admin. More clarity.</h2>
            <p class="text-xs text-pineink/80 max-w-xl mx-auto">Tools built for student record management, GPA tracking, and organized department rosters.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-creamsoft p-6 rounded-3xl border border-pineink/15 shadow-sm hover:border-olivecard transition space-y-3">
                <div class="w-10 h-10 rounded-2xl bg-burgundy text-creamsoft flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
                <h3 class="text-sm font-bold text-pineink">Instant CRUD Management</h3>
                <p class="text-xs text-pineink/80 leading-relaxed">Add, update, and manage student records quickly with prefix rules and GPA validation.</p>
            </div>

            <div class="bg-creamsoft p-6 rounded-3xl border border-pineink/15 shadow-sm hover:border-olivecard transition space-y-3">
                <div class="w-10 h-10 rounded-2xl bg-olivecard text-creamsoft flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                </div>
                <h3 class="text-sm font-bold text-pineink">Interactive Grading Statistics</h3>
                <p class="text-xs text-pineink/80 leading-relaxed">Track GPA averages across 3.00, 4.00, or 5.00 scales and inspect course breakdowns.</p>
            </div>

            <div class="bg-creamsoft p-6 rounded-3xl border border-pineink/15 shadow-sm hover:border-olivecard transition space-y-3">
                <div class="w-10 h-10 rounded-2xl bg-burgundy text-creamsoft flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <h3 class="text-sm font-bold text-pineink">Search, Filter &amp; CSV Export</h3>
                <p class="text-xs text-pineink/80 leading-relaxed">Search by ID, name, or course, sort records cleanly, and export rosters to CSV when needed.</p>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section id="pricing" class="relative z-10 max-w-5xl mx-auto px-6 py-16 space-y-10">
        <div class="text-center space-y-3">
            <span class="text-[10px] font-extrabold uppercase tracking-widest text-crimsonacc">Transparent Pricing</span>
            <h2 class="text-2xl md:text-3xl font-extrabold text-pineink">Simple plans for academic teams</h2>
            <div class="inline-flex items-center space-x-2 bg-creamsoft border border-pineink/15 p-1.5 rounded-2xl mt-4">
                <button type="button" onclick="setPricing('monthly')" id="btn-monthly" class="px-4 py-2 rounded-xl text-xs font-extrabold bg-crimsonacc text-white shadow-sm transition">Monthly Billing</button>
                <button type="button" onclick="setPricing('annual')" id="btn-annual" class="px-4 py-2 rounded-xl text-xs font-bold text-pineink/80 hover:text-pineink transition">
                    Annual Billing
                    <span class="text-[10px] text-burgundy font-bold bg-sandbase px-2 py-0.5 rounded-full ml-1">Save 20%</span>
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-3xl mx-auto">
            <div class="bg-creamsoft p-8 rounded-3xl border border-pineink/15 shadow-sm space-y-6 flex flex-col justify-between">
                <div class="space-y-4">
                    <h3 class="text-sm font-extrabold text-pineink uppercase tracking-wider">Department Workspace</h3>
                    <div class="flex items-baseline space-x-1">
                        <span class="text-4xl font-extrabold text-pineink price-starter">&#8369;0</span>
                        <span class="text-xs text-pineink/70 billing-cycle">/ month</span>
                    </div>
                    <p class="text-xs text-pineink/80">Good for individual departments and small student rosters.</p>
                </div>
                <a href="{{ route('register') }}" class="w-full py-3 bg-sandbase hover:bg-white text-pineink border border-pineink/20 rounded-xl text-xs font-bold transition text-center block">Get Started Free</a>
            </div>

            <div class="bg-creamsoft p-8 rounded-3xl border-2 border-crimsonacc shadow-lg space-y-6 flex flex-col justify-between relative overflow-hidden">
                <div class="absolute top-0 right-0 bg-crimsonacc text-white text-[9px] font-extrabold px-3 py-1 rounded-bl-xl uppercase tracking-widest">Most Popular</div>
                <div class="space-y-4">
                    <h3 class="text-sm font-extrabold text-pineink uppercase tracking-wider">Full Institution SaaS</h3>
                    <div class="flex items-baseline space-x-1">
                        <span class="text-4xl font-extrabold text-crimsonacc price-pro">&#8369;500</span>
                        <span class="text-xs text-pineink/70 billing-cycle">/ month</span>
                    </div>
                    <p class="text-xs text-pineink/80">For multi-course academic teams managing larger student directories.</p>
                </div>
                <a href="{{ route('register') }}" class="w-full py-3 bg-crimsonacc hover:bg-burgundy text-white rounded-xl text-xs font-extrabold transition text-center block shadow-sm">Deploy Workspace</a>
            </div>
        </div>
    </section>

    <!-- Interactive FAQ Section -->
    <section id="faq" class="relative z-10 max-w-4xl mx-auto px-6 py-16 space-y-8">
        <div class="text-center space-y-2">
            <span class="text-[10px] font-extrabold uppercase tracking-widest text-crimsonacc">Got Questions?</span>
            <h2 class="text-2xl font-extrabold text-pineink">Frequently Asked Questions</h2>
        </div>

        <div class="space-y-4">
            <div class="bg-creamsoft rounded-2xl border border-pineink/15 shadow-sm overflow-hidden">
                <button type="button" onclick="toggleFaq(1)" class="w-full p-5 text-left flex justify-between items-center text-xs font-bold text-pineink hover:bg-sandbase/50 transition">
                    <span>How does workspace session persistence work?</span>
                    <span id="icon-1" class="text-lg font-bold text-crimsonacc transition-transform">+</span>
                </button>
                <div id="faq-1" class="hidden p-5 pt-3 text-xs text-pineink/80 leading-relaxed border-t border-pineink/10">
                    EduCore keeps your active workspace session, workspace name, and selected GPA scale synced across dashboard, directory, and settings views.
                </div>
            </div>

            <div class="bg-creamsoft rounded-2xl border border-pineink/15 shadow-sm overflow-hidden">
                <button type="button" onclick="toggleFaq(2)" class="w-full p-5 text-left flex justify-between items-center text-xs font-bold text-pineink hover:bg-sandbase/50 transition">
                    <span>Can I export student records into CSV files?</span>
                    <span id="icon-2" class="text-lg font-bold text-crimsonacc transition-transform">+</span>
                </button>
                <div id="faq-2" class="hidden p-5 pt-3 text-xs text-pineink/80 leading-relaxed border-t border-pineink/10">
                    Yes. You can download your current student records as a CSV file directly from the Settings page.
                </div>
            </div>
        </div>
    </section>

    <!-- Bottom CTA Banner -->
    <section class="relative z-10 max-w-6xl mx-auto px-6 py-12">
        <div class="bg-gradient-to-r from-burgundy via-pineink to-olivecard text-creamsoft rounded-3xl p-8 md:p-12 flex flex-col md:flex-row items-center justify-between gap-6 shadow-xl border border-pineink/20">
            <div class="space-y-2 text-center md:text-left">
                <p class="text-[10px] font-bold uppercase tracking-widest text-sandbase">Ready when you are</p>
                <h3 class="text-xl md:text-2xl font-extrabold">Give your team time back.</h3>
                <p class="text-xs text-creamsoft/85 max-w-md">Set up your workspace and keep student records organized in one place.</p>
            </div>
            <a href="{{ route('register') }}" class="px-8 py-4 bg-crimsonacc text-white text-xs font-extrabold rounded-2xl shadow-md hover:bg-burgundy transition transform hover:-translate-y-0.5 shrink-0">
                Get started for free
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="relative z-10 max-w-6xl mx-auto px-6 py-8 border-t border-pineink/15 flex flex-col md:flex-row items-center justify-between text-xs text-pineink/75 gap-4">
        <div class="flex items-center space-x-2">
            <div class="w-6 h-6 rounded-lg bg-burgundy text-creamsoft flex items-center justify-center text-[9px] font-bold">EA</div>
            <span class="font-bold text-pineink">EduCore SaaS</span>
        </div>
        <p>&copy; 2026 EduCore. Built for better education by Group 1</p>
        <div class="flex items-center space-x-6">
            <a href="#" class="hover:text-crimsonacc transition">Privacy</a>
            <a href="#" class="hover:text-crimsonacc transition">Terms</a>
            <a href="#" class="hover:text-crimsonacc transition">Contact</a>
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
                dashBtn.className = 'px-4 py-1.5 rounded-lg text-xs font-bold bg-crimsonacc text-white shadow-sm transition';
                dirBtn.className = 'px-4 py-1.5 rounded-lg text-xs font-bold text-pineink/80 hover:text-pineink transition';
            } else {
                dirContent.classList.remove('hidden');
                dashContent.classList.add('hidden');
                dirBtn.className = 'px-4 py-1.5 rounded-lg text-xs font-bold bg-crimsonacc text-white shadow-sm transition';
                dashBtn.className = 'px-4 py-1.5 rounded-lg text-xs font-bold text-pineink/80 hover:text-pineink transition';
            }
        }

        function setPricing(plan) {
            const monthlyBtn = document.getElementById('btn-monthly');
            const annualBtn = document.getElementById('btn-annual');
            const priceStarter = document.querySelector('.price-starter');
            const pricePro = document.querySelector('.price-pro');
            const cycles = document.querySelectorAll('.billing-cycle');

            if (plan === 'annual') {
                annualBtn.className = 'px-4 py-2 rounded-xl text-xs font-extrabold bg-crimsonacc text-white shadow-sm transition';
                monthlyBtn.className = 'px-4 py-2 rounded-xl text-xs font-bold text-pineink/80 hover:text-pineink transition';
                priceStarter.innerText = '\u20B10';
                pricePro.innerText = '\u20B1400';
                cycles.forEach(el => el.innerText = '/ month (billed annually)');
            } else {
                monthlyBtn.className = 'px-4 py-2 rounded-xl text-xs font-extrabold bg-crimsonacc text-white shadow-sm transition';
                annualBtn.className = 'px-4 py-2 rounded-xl text-xs font-bold text-pineink/80 hover:text-pineink transition';
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
                icon.innerText = '-';
            } else {
                content.classList.add('hidden');
                icon.innerText = '+';
            }
        }
    </script>
</body>
</html>
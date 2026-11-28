<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduCore — Winter Conservatory Edition</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        sprucebase: '#101B18',
                        glasspanel: '#172622',
                        cedarwarm: '#221C18',
                        botline: '#2D423B',
                        lantern: '#E2A857',
                        lanternhover: '#D19542',
                        hollyberry: '#C84B52',
                        hollyhover: '#AE3B42',
                        frostpaper: '#F2EFE9',
                        mistmuted: '#9FB0A9',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-sprucebase text-frostpaper font-sans antialiased selection:bg-lantern/25 selection:text-lantern overflow-x-hidden relative">
    <!-- Subtle Conservatory Lantern & Frost Glow (60% Base) -->
    <div class="pointer-events-none fixed inset-0 bg-[radial-gradient(ellipse_at_top,_rgba(226,168,87,0.11),_transparent_60%),radial-gradient(ellipse_at_bottom_right,_rgba(200,75,82,0.08),_transparent_62%)] z-0"></div>

    <!-- Drifting Winter Snowflakes & Warm Lantern Dust (Skips #authActionZone) -->
    <canvas id="conservatorySnow" class="pointer-events-none fixed inset-0 w-full h-full z-30"></canvas>

    <!-- Header with Botanical Lantern Strand -->
    <header class="sticky top-0 z-40 relative w-full bg-sprucebase/90 backdrop-blur-md border-b border-botline h-20 flex items-center justify-between px-6 md:px-10">
        <!-- Hanging Lantern Strand -->
        <svg class="pointer-events-none absolute inset-x-0 -bottom-3 w-full h-6 overflow-visible" viewBox="0 0 1440 24" preserveAspectRatio="none" fill="none">
            <path d="M0 2Q240 16 480 2T960 2T1440 2" stroke="#E2A857" stroke-width="1.1" stroke-opacity="0.45"/>
            <circle cx="240" cy="11" r="3" fill="#E2A857"/>
            <circle cx="240" cy="11" r="7" fill="#E2A857" fill-opacity="0.22"/>
            <circle cx="480" cy="11" r="3" fill="#C84B52"/>
            <circle cx="480" cy="11" r="7" fill="#C84B52" fill-opacity="0.22"/>
            <circle cx="720" cy="11" r="3" fill="#F2EFE9"/>
            <circle cx="720" cy="11" r="7" fill="#E2A857" fill-opacity="0.18"/>
            <circle cx="960" cy="11" r="3" fill="#E2A857"/>
            <circle cx="960" cy="11" r="7" fill="#E2A857" fill-opacity="0.22"/>
            <circle cx="1200" cy="11" r="3" fill="#C84B52"/>
            <circle cx="1200" cy="11" r="7" fill="#C84B52" fill-opacity="0.22"/>
        </svg>

        <a href="#" class="flex items-center space-x-3 group">
            <!-- Botanical Star-Leaf Emblem -->
            <div class="w-9 h-9 rounded-xl bg-glasspanel border border-botline flex items-center justify-center text-lantern group-hover:border-lantern/70 transition">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M12 2L14.5 9.5L22 12L14.5 14.5L12 22L9.5 14.5L2 12L9.5 9.5L12 2Z"/>
                </svg>
            </div>
            <div class="flex flex-col">
                <span class="font-extrabold text-base tracking-tight text-white leading-none">EduCore <span class="text-lantern">SaaS</span></span>
                <span class="text-[10px] text-mistmuted tracking-wide mt-0.5">Solstice &amp; Conservatory</span>
            </div>
        </a>

        <nav class="hidden md:flex items-center space-x-7 text-xs font-semibold text-mistmuted">
            <a href="#features" class="hover:text-lantern transition">Features</a>
            <a href="#pricing" class="hover:text-lantern transition">Pricing</a>
            <a href="#faq" class="hover:text-lantern transition">FAQ</a>
        </nav>

        <!-- Excluded from Snow -->
        <div id="authActionZone" class="relative z-50 flex items-center space-x-2.5 md:space-x-3 px-2 py-1 rounded-2xl">
            <a href="{{ route('login') }}" class="px-4 py-2 text-xs font-bold text-frostpaper hover:text-lantern hover:bg-glasspanel rounded-xl transition">Log in</a>
            <a href="{{ route('register') }}" class="px-5 py-2.5 bg-hollyberry hover:bg-hollyhover text-white text-xs font-extrabold rounded-xl shadow-sm transition transform hover:-translate-y-0.5">Get started &rarr;</a>
        </div>
    </header>

    <!-- Conservatory Arch Hero -->
    <section class="relative z-10 max-w-5xl mx-auto px-6 pt-20 pb-14 text-center space-y-7">
        <div class="inline-flex items-center space-x-2.5 px-4 py-1.5 bg-glasspanel/90 border border-botline rounded-full text-xs font-semibold text-frostpaper">
            <span class="text-lantern">&#10022;</span>
            <span>Winter Solstice &bull; Student Records Workspace</span>
            <span class="w-1.5 h-1.5 rounded-full bg-hollyberry"></span>
        </div>

        <div class="space-y-4">
            <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold text-white tracking-tight leading-[1.1]">
                Simplify student records.
                <span class="block text-lantern mt-1">Elevate every outcome.</span>
            </h1>

            <div>
                <span class="inline-flex items-center space-x-2 px-4 py-1.5 rounded-full bg-cedarwarm border border-botline text-[11px] font-bold uppercase tracking-widest text-lantern">
                    <span class="w-1.5 h-1.5 rounded-full bg-lantern"></span>
                    <span>Created by Group 1</span>
                </span>
            </div>
        </div>

        <div class="space-y-2">
            <p class="text-sm md:text-base text-mistmuted max-w-2xl mx-auto leading-relaxed">
                Keep student rosters, GPA scales, and course records calm and organized in a glasshouse-inspired workspace built for academic teams.
            </p>
            <p class="text-xs text-lantern/90 italic">
                Warm wishes for a peaceful holiday season and a bright new term.
            </p>
        </div>

        <div class="flex flex-col sm:flex-row items-center justify-center gap-3.5 pt-2">
            <a href="{{ route('register') }}" class="w-full sm:w-auto px-8 py-4 bg-lantern hover:bg-lanternhover text-sprucebase text-xs font-extrabold rounded-2xl shadow-md transition transform hover:-translate-y-0.5 flex items-center justify-center space-x-2">
                <span>Start managing free</span>
                <span>&rarr;</span>
            </a>
            <a href="#showcase" class="w-full sm:w-auto px-8 py-4 bg-glasspanel hover:bg-cedarwarm text-frostpaper border border-botline text-xs font-bold rounded-2xl transition">
                Explore live demo
            </a>
        </div>
    </section>

    <!-- Glasshouse Showcase Panel -->
    <section id="showcase" class="relative z-10 max-w-6xl mx-auto px-6 pb-20">
        <div class="bg-glasspanel/95 border border-botline rounded-t-[2.25rem] rounded-b-3xl shadow-2xl overflow-hidden">
            <div class="px-6 py-4 bg-sprucebase/80 border-b border-botline flex flex-wrap items-center justify-between gap-4">
                <div class="flex items-center space-x-2.5">
                    <span class="w-2.5 h-2.5 rounded-full bg-hollyberry"></span>
                    <span class="w-2.5 h-2.5 rounded-full bg-lantern"></span>
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-500/75"></span>
                    <span class="text-xs font-mono text-mistmuted ml-1">educore.app/workspace/dashboard</span>
                    <span class="hidden sm:inline-flex items-center text-[10px] text-lantern bg-glasspanel border border-botline px-2.5 py-0.5 rounded-full font-semibold">&#10052; Live DB Connected</span>
                </div>

                <div class="flex items-center space-x-1.5 bg-sprucebase p-1 rounded-xl border border-botline">
                    <button type="button" onclick="switchTab('dashboard')" id="tab-dashboard" class="px-4 py-1.5 rounded-lg text-xs font-bold bg-lantern text-sprucebase transition">Dashboard View</button>
                    <button type="button" onclick="switchTab('directory')" id="tab-directory" class="px-4 py-1.5 rounded-lg text-xs font-bold text-mistmuted hover:text-white transition">Directory Table</button>
                </div>
            </div>

            <div class="p-6 md:p-8">
                <!-- Tab 1: Dashboard -->
                <div id="content-dashboard" class="space-y-6 transition-all duration-300">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                        <div class="bg-sprucebase/80 p-5 rounded-2xl border border-botline hover:border-lantern/50 transition">
                            <p class="text-[10px] font-bold uppercase tracking-wider text-mistmuted">Total Enrolled (Live DB)</p>
                            <p class="text-3xl font-extrabold text-white mt-2 tabular-nums">{{ $totalStudents }}</p>
                            <span class="text-[10px] text-lantern bg-glasspanel border border-botline px-2.5 py-0.5 rounded font-semibold mt-3 inline-block">Synced Database</span>
                        </div>

                        <div class="bg-sprucebase/80 p-5 rounded-2xl border border-botline hover:border-lantern/60 transition">
                            <p class="text-[10px] font-bold uppercase tracking-wider text-mistmuted">Average Cohort GPA</p>
                            <p class="text-3xl font-extrabold text-lantern mt-2 tabular-nums">{{ number_format((float) $averageGpa, 2) }}</p>
                            <span class="text-[10px] text-frostpaper bg-glasspanel border border-botline px-2.5 py-0.5 rounded font-semibold mt-3 inline-block">Calculated Mean</span>
                        </div>

                        <div class="bg-sprucebase/80 p-5 rounded-2xl border border-botline hover:border-lantern/50 transition">
                            <p class="text-[10px] font-bold uppercase tracking-wider text-mistmuted">Active Departments</p>
                            <p class="text-3xl font-extrabold text-white mt-2 tabular-nums">{{ $activeCoursesCount }}</p>
                            <span class="text-[10px] text-mistmuted bg-glasspanel border border-botline px-2.5 py-0.5 rounded font-semibold mt-3 inline-block">Unique Courses</span>
                        </div>
                    </div>

                    <div class="bg-cedarwarm/75 p-5 rounded-2xl border border-botline flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div>
                            <p class="text-xs font-bold text-white">Workspace Telemetry Active</p>
                            <p class="text-[11px] text-mistmuted">Displaying live summary figures from your EduCore workspace database.</p>
                        </div>
                        <span class="px-3.5 py-1.5 bg-sprucebase border border-lantern/45 text-lantern text-xs font-bold rounded-xl shrink-0">Live DB Connected</span>
                    </div>
                </div>

                <!-- Tab 2: Directory Table -->
                <div id="content-directory" class="hidden space-y-4 transition-all duration-300">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                        <p class="text-xs text-mistmuted">Live student records preview from your workspace database.</p>
                        <input
                            type="text"
                            id="previewSearchInput"
                            oninput="filterPreviewStudents()"
                            placeholder="Filter by ID, name, or course..."
                            class="w-full sm:w-72 px-3.5 py-2 bg-sprucebase border border-botline rounded-xl text-xs text-white placeholder-mistmuted/60 focus:outline-none focus:border-lantern transition"
                        >
                    </div>

                    <div class="bg-sprucebase/80 rounded-2xl border border-botline overflow-hidden">
                        <div class="grid grid-cols-12 px-5 py-3.5 bg-cedarwarm border-b border-botline text-[10px] font-bold text-lantern uppercase tracking-wider">
                            <span class="col-span-5">Student ID &amp; Name</span>
                            <span class="col-span-3">Course</span>
                            <span class="col-span-2">GPA</span>
                            <span class="col-span-2 text-right">Status</span>
                        </div>
                        <div class="divide-y divide-botline/70 text-xs">
                            @forelse ($students as $student)
                                <div class="preview-student-row grid grid-cols-12 px-5 py-3.5 items-center hover:bg-glasspanel/60 transition" data-filter="{{ strtolower(($student->student_id ?? '') . ' ' . ($student->name ?? '') . ' ' . ($student->course ?? 'BSIT')) }}">
                                    <div class="col-span-5 flex items-center space-x-2.5 min-w-0 pr-2">
                                        <span class="font-mono text-[11px] font-bold text-lantern bg-glasspanel border border-botline px-2 py-0.5 rounded-md shrink-0">{{ $student->student_id }}</span>
                                        <span class="font-bold text-white truncate">{{ $student->name }}</span>
                                    </div>
                                    <span class="col-span-3 text-mistmuted font-medium truncate pr-2">{{ $student->course ?? 'BSIT' }}</span>
                                    <span class="col-span-2 font-extrabold text-lantern tabular-nums">{{ number_format((float) $student->gpa, 2) }}</span>
                                    <div class="col-span-2 text-right">
                                        <span class="inline-flex items-center px-2.5 py-0.5 bg-glasspanel border border-botline text-frostpaper rounded-full font-bold text-[11px]">Active</span>
                                    </div>
                                </div>
                            @empty
                                <div class="p-8 text-center text-mistmuted">No records found in database.</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section id="features" class="relative z-10 max-w-6xl mx-auto px-6 py-16 border-t border-botline space-y-10">
        <div class="text-center space-y-2">
            <span class="text-[10px] font-extrabold uppercase tracking-widest text-lantern">Everything you need</span>
            <h2 class="text-2xl md:text-3xl font-extrabold text-white">Less admin. More clarity.</h2>
            <p class="text-xs text-mistmuted max-w-xl mx-auto">Tools built for student record management, GPA tracking, and organized department rosters.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-glasspanel/90 p-6 rounded-3xl border border-botline hover:border-lantern/50 transition space-y-3">
                <div class="flex items-center justify-between">
                    <div class="w-10 h-10 rounded-2xl bg-sprucebase border border-botline text-lantern flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <span class="text-[10px] font-mono text-lantern">&#10022; 01</span>
                </div>
                <h3 class="text-sm font-bold text-white">Instant CRUD Management</h3>
                <p class="text-xs text-mistmuted leading-relaxed">Add, update, and manage student records quickly with prefix rules and GPA validation.</p>
            </div>

            <div class="bg-glasspanel/90 p-6 rounded-3xl border border-botline hover:border-lantern/50 transition space-y-3">
                <div class="flex items-center justify-between">
                    <div class="w-10 h-10 rounded-2xl bg-sprucebase border border-botline text-lantern flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    </div>
                    <span class="text-[10px] font-mono text-hollyberry">&#10022; 02</span>
                </div>
                <h3 class="text-sm font-bold text-white">Interactive Grading Statistics</h3>
                <p class="text-xs text-mistmuted leading-relaxed">Track GPA averages across 3.00, 4.00, or 5.00 scales and inspect course breakdowns.</p>
            </div>

            <div class="bg-glasspanel/90 p-6 rounded-3xl border border-botline hover:border-lantern/50 transition space-y-3">
                <div class="flex items-center justify-between">
                    <div class="w-10 h-10 rounded-2xl bg-sprucebase border border-botline text-lantern flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                    <span class="text-[10px] font-mono text-lantern">&#10022; 03</span>
                </div>
                <h3 class="text-sm font-bold text-white">Search, Filter &amp; CSV Export</h3>
                <p class="text-xs text-mistmuted leading-relaxed">Search by ID, name, or course, sort records cleanly, and export rosters to CSV when needed.</p>
            </div>
        </div>
    </section>

    <!-- Pricing -->
    <section id="pricing" class="relative z-10 max-w-5xl mx-auto px-6 py-16 border-t border-botline space-y-10">
        <div class="text-center space-y-3">
            <span class="text-[10px] font-extrabold uppercase tracking-widest text-lantern">Transparent Pricing</span>
            <h2 class="text-2xl md:text-3xl font-extrabold text-white">Simple plans for academic teams</h2>
            <div class="inline-flex items-center space-x-2 bg-glasspanel border border-botline p-1.5 rounded-2xl mt-3">
                <button type="button" onclick="setPricing('monthly')" id="btn-monthly" class="px-4 py-2 rounded-xl text-xs font-extrabold bg-lantern text-sprucebase transition">Monthly Billing</button>
                <button type="button" onclick="setPricing('annual')" id="btn-annual" class="px-4 py-2 rounded-xl text-xs font-bold text-mistmuted hover:text-white transition">
                    Annual Billing
                    <span class="text-[10px] text-lantern font-bold bg-sprucebase px-2 py-0.5 rounded-full ml-1">Save 20%</span>
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-3xl mx-auto">
            <div class="bg-glasspanel/90 p-8 rounded-3xl border border-botline space-y-6 flex flex-col justify-between">
                <div class="space-y-4">
                    <h3 class="text-xs font-extrabold text-white uppercase tracking-wider">Department Workspace</h3>
                    <div class="flex items-baseline space-x-1">
                        <span class="text-4xl font-extrabold text-white price-starter tabular-nums">&#8369;0</span>
                        <span class="text-xs text-mistmuted billing-cycle">/ month</span>
                    </div>
                    <p class="text-xs text-mistmuted">Good for individual departments and small student rosters.</p>
                </div>
                <a href="{{ route('register') }}" class="w-full py-3 bg-sprucebase hover:bg-cedarwarm text-white border border-botline rounded-xl text-xs font-bold transition text-center block">Get Started Free</a>
            </div>

            <div class="bg-glasspanel p-8 rounded-3xl border-2 border-lantern shadow-xl space-y-6 flex flex-col justify-between relative overflow-hidden">
                <div class="absolute top-0 right-0 bg-lantern text-sprucebase text-[9px] font-extrabold px-3.5 py-1 rounded-bl-xl uppercase tracking-widest">Most Popular</div>
                <div class="space-y-4">
                    <h3 class="text-xs font-extrabold text-white uppercase tracking-wider">Full Institution SaaS</h3>
                    <div class="flex items-baseline space-x-1">
                        <span class="text-4xl font-extrabold text-lantern price-pro tabular-nums">&#8369;500</span>
                        <span class="text-xs text-mistmuted billing-cycle">/ month</span>
                    </div>
                    <p class="text-xs text-mistmuted">For multi-course academic teams managing larger student directories.</p>
                </div>
                <a href="{{ route('register') }}" class="w-full py-3 bg-hollyberry hover:bg-hollyhover text-white rounded-xl text-xs font-extrabold transition text-center block">Deploy Workspace</a>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section id="faq" class="relative z-10 max-w-4xl mx-auto px-6 py-16 border-t border-botline space-y-8">
        <div class="text-center space-y-2">
            <span class="text-[10px] font-extrabold uppercase tracking-widest text-lantern">Got Questions?</span>
            <h2 class="text-2xl font-extrabold text-white">Frequently Asked Questions</h2>
        </div>

        <div class="space-y-3.5">
            <div class="bg-glasspanel/90 rounded-2xl border border-botline overflow-hidden">
                <button type="button" onclick="toggleFaq(1)" class="w-full p-5 text-left flex justify-between items-center text-xs font-bold text-white hover:bg-cedarwarm/50 transition">
                    <span>How does workspace session persistence work?</span>
                    <span id="icon-1" class="text-lg font-mono text-lantern">+</span>
                </button>
                <div id="faq-1" class="hidden p-5 pt-3 text-xs text-mistmuted leading-relaxed border-t border-botline">
                    EduCore keeps your active workspace session, workspace name, and selected GPA scale synced across dashboard, directory, and settings views.
                </div>
            </div>

            <div class="bg-glasspanel/90 rounded-2xl border border-botline overflow-hidden">
                <button type="button" onclick="toggleFaq(2)" class="w-full p-5 text-left flex justify-between items-center text-xs font-bold text-white hover:bg-cedarwarm/50 transition">
                    <span>Can I export student records into CSV files?</span>
                    <span id="icon-2" class="text-lg font-mono text-lantern">+</span>
                </button>
                <div id="faq-2" class="hidden p-5 pt-3 text-xs text-mistmuted leading-relaxed border-t border-botline">
                    Yes. You can download your current student records as a CSV file directly from the Settings page.
                </div>
            </div>

            <div class="bg-glasspanel/90 rounded-2xl border border-botline overflow-hidden">
                <button type="button" onclick="toggleFaq(3)" class="w-full p-5 text-left flex justify-between items-center text-xs font-bold text-white hover:bg-cedarwarm/50 transition">
                    <span>Which GPA scales and Student ID prefixes are supported?</span>
                    <span id="icon-3" class="text-lg font-mono text-lantern">+</span>
                </button>
                <div id="faq-3" class="hidden p-5 pt-3 text-xs text-mistmuted leading-relaxed border-t border-botline">
                    You can switch between 3.00, 4.00, and 5.00 GPA scales and customize your default Student ID prefix in Settings while keeping IDs clean and validated.
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="relative z-10 max-w-6xl mx-auto px-6 py-8 border-t border-botline flex flex-col md:flex-row items-center justify-between text-xs text-mistmuted gap-4">
        <div class="flex items-center space-x-2">
            <span class="font-bold text-white">EduCore SaaS</span>
        </div>
        <p>&copy; 2026 EduCore. Built for better education by Group 1 &bull; <span class="text-lantern">Happy holidays</span></p>
        <div class="flex items-center space-x-6">
            <a href="#features" class="hover:text-lantern transition">Features</a>
            <a href="#pricing" class="hover:text-lantern transition">Pricing</a>
            <a href="#faq" class="hover:text-lantern transition">FAQ</a>
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
                dashBtn.className = 'px-4 py-1.5 rounded-lg text-xs font-bold bg-lantern text-sprucebase transition';
                dirBtn.className = 'px-4 py-1.5 rounded-lg text-xs font-bold text-mistmuted hover:text-white transition';
            } else {
                dirContent.classList.remove('hidden');
                dashContent.classList.add('hidden');
                dirBtn.className = 'px-4 py-1.5 rounded-lg text-xs font-bold bg-lantern text-sprucebase transition';
                dashBtn.className = 'px-4 py-1.5 rounded-lg text-xs font-bold text-mistmuted hover:text-white transition';
            }
        }

        function filterPreviewStudents() {
            const query = String(document.getElementById('previewSearchInput')?.value || '').trim().toLowerCase();
            const rows = document.querySelectorAll('.preview-student-row');
            rows.forEach((row) => {
                const haystack = String(row.getAttribute('data-filter') || '');
                row.classList.toggle('hidden', query !== '' && !haystack.includes(query));
            });
        }

        function setPricing(plan) {
            const monthlyBtn = document.getElementById('btn-monthly');
            const annualBtn = document.getElementById('btn-annual');
            const priceStarter = document.querySelector('.price-starter');
            const pricePro = document.querySelector('.price-pro');
            const cycles = document.querySelectorAll('.billing-cycle');

            if (plan === 'annual') {
                annualBtn.className = 'px-4 py-2 rounded-xl text-xs font-extrabold bg-lantern text-sprucebase transition';
                monthlyBtn.className = 'px-4 py-2 rounded-xl text-xs font-bold text-mistmuted hover:text-white transition';
                priceStarter.innerText = '\u20B10';
                pricePro.innerText = '\u20B1400';
                cycles.forEach(el => el.innerText = '/ month (billed annually)');
            } else {
                monthlyBtn.className = 'px-4 py-2 rounded-xl text-xs font-extrabold bg-lantern text-sprucebase transition';
                annualBtn.className = 'px-4 py-2 rounded-xl text-xs font-bold text-mistmuted hover:text-white transition';
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

        // Snow & warm lantern specks skipping #authActionZone
        (function initConservatorySnow() {
            const canvas = document.getElementById('conservatorySnow');
            const excludedEl = document.getElementById('authActionZone');
            if (!canvas) return;
            const ctx = canvas.getContext('2d');
            let width = 0;
            let height = 0;
            const particles = Array.from({ length: 42 }, (_, idx) => ({
                x: Math.random() * 1600,
                y: Math.random() * 1000,
                size: 3.2 + Math.random() * 4.8,
                vy: 0.35 + Math.random() * 0.6,
                vx: -0.25 + Math.random() * 0.5,
                alpha: 0.4 + Math.random() * 0.38,
                isLantern: idx % 5 === 0,
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

            function drawParticle(p) {
                ctx.save();
                ctx.translate(p.x, p.y);
                if (p.isLantern) {
                    const grad = ctx.createRadialGradient(0, 0, 0.5, 0, 0, p.size * 1.3);
                    grad.addColorStop(0, `rgba(226, 168, 87, ${p.alpha})`);
                    grad.addColorStop(1, 'rgba(226, 168, 87, 0)');
                    ctx.fillStyle = grad;
                    ctx.beginPath();
                    ctx.arc(0, 0, p.size * 1.3, 0, Math.PI * 2);
                    ctx.fill();
                } else {
                    ctx.fillStyle = `rgba(242, 239, 233, ${p.alpha * 0.8})`;
                    ctx.beginPath();
                    ctx.arc(0, 0, p.size * 0.52, 0, Math.PI * 2);
                    ctx.fill();
                }
                ctx.restore();
            }

            function tick() {
                ctx.clearRect(0, 0, width, height);
                for (const p of particles) {
                    p.x += p.vx;
                    p.y += p.vy;
                    if (p.y - p.size > height) {
                        p.y = -p.size * 2;
                        p.x = Math.random() * width;
                    }
                    if (p.x + p.size < 0) p.x = width + p.size;
                    if (p.x - p.size > width) p.x = -p.size;
                    if (!isInsideExcludedZone(p.x, p.y, p.size + 10)) {
                        drawParticle(p);
                    }
                }
                requestAnimationFrame(tick);
            }
            tick();
        })();
    </script>
</body>
</html>
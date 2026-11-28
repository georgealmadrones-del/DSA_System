<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
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
                        cocoabase: '#191411',
                        cocoadeep: '#231C17',
                        walnutcard: '#2E231D',
                        spiceline: '#5B4537',
                        gingergold: '#E5A95C',
                        gingerdeep: '#C88A3E',
                        berrypop: '#D1495B',
                        berrydark: '#B23747',
                        icingcream: '#FAF5EE',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-cocoabase text-icingcream font-sans antialiased selection:bg-gingergold/25 selection:text-gingergold overflow-x-hidden relative">
    <!-- Warm Gingerbread & Spiced Glow (60% Base) -->
    <div class="pointer-events-none fixed inset-0 bg-[radial-gradient(ellipse_at_top,_rgba(229,169,92,0.12),_transparent_58%),radial-gradient(ellipse_at_bottom_left,_rgba(209,73,91,0.09),_transparent_62%)] z-0"></div>

    <!-- Drifting Frost-Flakes & Warm Spice Glints (Skips #authActionZone) -->
    <canvas id="gingerSnow" class="pointer-events-none fixed inset-0 w-full h-full z-30"></canvas>

    <!-- Top Bar (30% Secondary Structure + 10% Gingerbread Gold & Berry Accent) -->
    <header class="sticky top-0 z-40 relative w-full bg-cocoabase/90 backdrop-blur-md border-b border-spiceline h-20 flex items-center justify-between px-6 md:px-10 shadow-lg shadow-black/30">
        <!-- Festive Fairy Lights along Header Bottom Edge -->
        <svg class="pointer-events-none absolute inset-x-0 -bottom-3 w-full h-6 z-30 overflow-visible" viewBox="0 0 1440 24" preserveAspectRatio="none" fill="none">
            <path d="M0 2Q180 16 360 2T720 2T1080 2T1440 2" stroke="#E5A95C" stroke-width="1.15" stroke-opacity="0.55"/>
            <circle cx="180" cy="10.5" r="3" fill="#E5A95C"/>
            <circle cx="180" cy="10.5" r="7" fill="#E5A95C" fill-opacity="0.24"/>
            <circle cx="360" cy="10.5" r="3" fill="#D1495B"/>
            <circle cx="360" cy="10.5" r="7" fill="#D1495B" fill-opacity="0.24"/>
            <circle cx="540" cy="10.5" r="3" fill="#FAF5EE"/>
            <circle cx="540" cy="10.5" r="7" fill="#E5A95C" fill-opacity="0.2"/>
            <circle cx="720" cy="10.5" r="3" fill="#E5A95C"/>
            <circle cx="720" cy="10.5" r="7" fill="#E5A95C" fill-opacity="0.24"/>
            <circle cx="900" cy="10.5" r="3" fill="#D1495B"/>
            <circle cx="900" cy="10.5" r="7" fill="#D1495B" fill-opacity="0.24"/>
            <circle cx="1080" cy="10.5" r="3" fill="#FAF5EE"/>
            <circle cx="1080" cy="10.5" r="7" fill="#E5A95C" fill-opacity="0.2"/>
            <circle cx="1260" cy="10.5" r="3" fill="#E5A95C"/>
            <circle cx="1260" cy="10.5" r="7" fill="#E5A95C" fill-opacity="0.24"/>
        </svg>

        <a href="#" class="flex items-center space-x-3 group">
            <div class="w-9 h-9 rounded-xl bg-cocoadeep border border-gingergold/45 flex items-center justify-center text-gingergold shadow-sm group-hover:border-gingergold transition">
                <div class="grid grid-cols-2 gap-0.5">
                    <span class="w-1.5 h-1.5 bg-gingergold rounded-full"></span>
                    <span class="w-1.5 h-1.5 bg-berrypop rounded-full"></span>
                    <span class="w-1.5 h-1.5 bg-berrypop rounded-full"></span>
                    <span class="w-1.5 h-1.5 bg-gingergold rounded-full"></span>
                </div>
            </div>
            <div class="flex flex-col">
                <span class="font-extrabold text-base tracking-tight text-white leading-none">EduCore <span class="text-gingergold">SaaS</span></span>
                <span class="text-[10px] font-medium text-amber-100/60 tracking-wide mt-0.5">Gingerbread &amp; Spice Edition</span>
            </div>
        </a>

        <nav class="hidden md:flex items-center space-x-1 bg-cocoadeep/90 p-1 rounded-2xl border border-spiceline text-xs font-semibold text-amber-100/80">
            <a href="#features" class="px-3.5 py-1.5 rounded-xl hover:text-gingergold hover:bg-cocoabase/75 transition">Features</a>
            <a href="#pricing" class="px-3.5 py-1.5 rounded-xl hover:text-gingergold hover:bg-cocoabase/75 transition">Pricing</a>
            <a href="#faq" class="px-3.5 py-1.5 rounded-xl hover:text-gingergold hover:bg-cocoabase/75 transition">FAQ</a>
        </nav>

        <!-- Excluded Zone: Keep Log in and Get started clean -->
        <div id="authActionZone" class="relative z-50 flex items-center space-x-2.5 md:space-x-3 px-2 py-1 rounded-2xl">
            <a href="{{ route('login') }}" class="px-4 py-2 text-xs font-bold text-icingcream hover:text-gingergold hover:bg-cocoadeep rounded-xl transition">Log in</a>
            <a href="{{ route('register') }}" class="px-5 py-2.5 bg-gingergold text-cocoabase text-xs font-extrabold rounded-xl shadow-md shadow-gingergold/20 hover:bg-gingerdeep transition transform hover:-translate-y-0.5">Get started &rarr;</a>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="relative z-10 max-w-5xl mx-auto px-6 pt-20 pb-14 text-center space-y-8">
        <div class="inline-flex items-center space-x-2.5 px-4 py-1.5 bg-cocoadeep/95 border border-spiceline rounded-full shadow-md text-xs font-semibold text-icingcream">
            <span class="text-gingergold text-sm leading-none">&#10022;</span>
            <span>Holiday Term &bull; Student management, thoughtfully simplified</span>
            <span class="w-1.5 h-1.5 rounded-full bg-berrypop"></span>
        </div>

        <div class="space-y-4">
            <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold text-white tracking-tight leading-tight">
                <span class="relative inline-block">
                    <!-- Festive Star & Ginger-Swirl Crest -->
                    <svg class="w-9 h-9 md:w-11 md:h-11 text-gingergold absolute -top-6 -left-6 -rotate-12 pointer-events-none drop-shadow" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2l2.5 5.7L20.5 8.3l-4.6 4 1.4 6.1L12 15.2l-5.3 3.2 1.4-6.1-4.6-4 6-.6L12 2z"/>
                    </svg>
                </span>
                Simplify student records.
                <br>
                <span class="text-gingergold">Elevate every outcome.</span>
            </h1>

            <div>
                <span class="text-xs md:text-sm font-bold text-gingergold tracking-widest uppercase bg-cocoadeep/95 border border-spiceline inline-flex items-center space-x-2 px-4 py-1.5 rounded-full shadow-sm">
                    <span class="w-2 h-2 rounded-full bg-berrypop"></span>
                    <span>CREATED BY GROUP 1</span>
                </span>
            </div>
        </div>

        <div class="space-y-2">
            <p class="text-sm md:text-base text-amber-100/80 max-w-2xl mx-auto leading-relaxed">
                One workspace to organize student records, track academic performance, and keep department data clean.
            </p>
            <p class="text-[11px] text-gingergold/85 tracking-wider font-medium inline-flex items-center space-x-1.5">
                <span>&#10023;</span>
                <span>Happy holidays &mdash; wishing your team a warm and bright season.</span>
            </p>
        </div>

        <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-2">
            <a href="{{ route('register') }}" class="w-full sm:w-auto px-8 py-4 bg-gingergold text-cocoabase text-xs font-extrabold rounded-2xl shadow-lg shadow-gingergold/20 hover:bg-gingerdeep transition transform hover:-translate-y-0.5 flex items-center justify-center space-x-2">
                <span>Start managing free</span>
                <span>&rarr;</span>
            </a>
            <a href="#showcase" class="w-full sm:w-auto px-8 py-4 bg-cocoadeep/95 text-white border border-spiceline text-xs font-bold rounded-2xl shadow-sm hover:border-gingergold/60 hover:bg-walnutcard transition">
                Explore live demo
            </a>
        </div>

        <!-- Subtle Highlight Strip -->
        <div class="pt-3 flex flex-wrap items-center justify-center gap-x-6 gap-y-2 text-[11px] font-medium text-amber-100/75">
            <span class="inline-flex items-center space-x-1.5">
                <span class="text-gingergold font-bold">&#10022;</span>
                <span>Prefix-Locked Student IDs</span>
            </span>
            <span class="inline-flex items-center space-x-1.5">
                <span class="text-berrypop font-bold">&#10022;</span>
                <span>3.00 / 4.00 / 5.00 GPA Scales</span>
            </span>
            <span class="inline-flex items-center space-x-1.5">
                <span class="text-gingergold font-bold">&#10022;</span>
                <span>Instant CSV Roster Export</span>
            </span>
        </div>
    </section>

    <!-- Live Database Showcase -->
    <section id="showcase" class="relative z-10 max-w-6xl mx-auto px-6 pb-24">
        <div class="bg-gradient-to-b from-cocoadeep/95 to-cocoabase/95 border border-spiceline rounded-3xl shadow-2xl shadow-black/40 overflow-hidden">
            <div class="px-6 py-4 bg-cocoabase/80 border-b border-spiceline flex flex-wrap items-center justify-between gap-4">
                <div class="flex items-center space-x-2">
                    <div class="flex items-center space-x-1.5 mr-1">
                        <span class="w-2.5 h-2.5 rounded-full bg-berrypop"></span>
                        <span class="w-2.5 h-2.5 rounded-full bg-gingergold"></span>
                        <span class="w-2.5 h-2.5 rounded-full bg-spiceline"></span>
                    </div>
                    <span class="text-xs font-mono text-amber-100/80 bg-cocoadeep px-3 py-1 rounded-lg border border-spiceline">educore.app/workspace/dashboard</span>
                    <span class="hidden sm:inline-flex items-center space-x-1.5 text-[10px] text-gingergold bg-cocoadeep border border-gingergold/35 px-2.5 py-1 rounded-full font-semibold">
                        <span>&#10052;</span>
                        <span>Live DB Connected</span>
                    </span>
                </div>

                <div class="flex items-center space-x-1.5 bg-cocoabase p-1 rounded-xl border border-spiceline">
                    <button type="button" onclick="switchTab('dashboard')" id="tab-dashboard" class="px-4 py-1.5 rounded-lg text-xs font-bold bg-gingergold text-cocoabase shadow-sm transition">Dashboard View</button>
                    <button type="button" onclick="switchTab('directory')" id="tab-directory" class="px-4 py-1.5 rounded-lg text-xs font-bold text-amber-100/75 hover:text-white transition">Directory Table</button>
                </div>
            </div>

            <div class="p-6 md:p-8">
                <!-- Tab 1: Live Database Analytics -->
                <div id="content-dashboard" class="space-y-6 transition-all duration-300">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                        <div class="bg-cocoabase/85 p-5 rounded-2xl border border-spiceline hover:border-gingergold/50 transition shadow-sm">
                            <div class="flex items-center justify-between">
                                <p class="text-[10px] font-bold uppercase tracking-wider text-amber-100/65">Total Enrolled (Live DB)</p>
                                <span class="text-[10px] font-mono text-amber-100/60">ROSTER</span>
                            </div>
                            <p class="text-3xl font-extrabold text-white mt-2 tabular-nums">{{ $totalStudents }}</p>
                            <div class="mt-3 pt-3 border-t border-spiceline/70 flex items-center justify-between text-[11px]">
                                <span class="text-amber-100/60">Workspace database</span>
                                <span class="text-gingergold bg-cocoadeep border border-spiceline px-2.5 py-0.5 rounded-md font-bold">Synced</span>
                            </div>
                        </div>

                        <div class="bg-cocoabase/85 p-5 rounded-2xl border border-spiceline hover:border-gingergold/60 transition shadow-sm">
                            <div class="flex items-center justify-between">
                                <p class="text-[10px] font-bold uppercase tracking-wider text-amber-100/65">Average Cohort GPA</p>
                                <span class="text-[10px] font-mono text-gingergold">MEAN</span>
                            </div>
                            <p class="text-3xl font-extrabold text-gingergold mt-2 tabular-nums">{{ number_format((float) $averageGpa, 2) }}</p>
                            <div class="mt-3 pt-3 border-t border-spiceline/70 flex items-center justify-between text-[11px]">
                                <span class="text-amber-100/60">Calculated mean</span>
                                <span class="text-berrypop bg-cocoadeep border border-berrypop/30 px-2.5 py-0.5 rounded-md font-bold">Active Scale</span>
                            </div>
                        </div>

                        <div class="bg-cocoabase/85 p-5 rounded-2xl border border-spiceline hover:border-gingergold/50 transition shadow-sm">
                            <div class="flex items-center justify-between">
                                <p class="text-[10px] font-bold uppercase tracking-wider text-amber-100/65">Active Departments</p>
                                <span class="text-[10px] font-mono text-amber-100/60">COURSES</span>
                            </div>
                            <p class="text-3xl font-extrabold text-white mt-2 tabular-nums">{{ $activeCoursesCount }}</p>
                            <div class="mt-3 pt-3 border-t border-spiceline/70 flex items-center justify-between text-[11px]">
                                <span class="text-amber-100/60">Unique courses</span>
                                <span class="text-icingcream bg-cocoadeep border border-spiceline px-2.5 py-0.5 rounded-md font-bold">Verified</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-cocoabase/85 p-5 rounded-2xl border border-spiceline shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div class="space-y-1">
                            <div class="flex items-center space-x-2">
                                <span class="w-2 h-2 rounded-full bg-gingergold"></span>
                                <p class="text-xs font-bold text-white">Workspace Telemetry Active</p>
                            </div>
                            <p class="text-[11px] text-amber-100/65">Displaying live summary figures from your EduCore workspace database with integrity &amp; audit checks.</p>
                        </div>
                        <span class="px-3.5 py-1.5 bg-cocoadeep border border-gingergold/45 text-gingergold text-xs font-bold rounded-xl shrink-0">Live DB Connected</span>
                    </div>
                </div>

                <!-- Tab 2: Live Database Directory Table -->
                <div id="content-directory" class="hidden space-y-4 transition-all duration-300">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                        <p class="text-xs text-amber-100/80">Live student records preview from your workspace database.</p>
                        <input
                            type="text"
                            id="previewSearchInput"
                            oninput="filterPreviewStudents()"
                            placeholder="Filter by ID, name, or course..."
                            class="w-full sm:w-72 px-3.5 py-2 bg-cocoabase/90 border border-spiceline rounded-xl text-xs text-white placeholder-amber-100/45 focus:outline-none focus:ring-2 focus:ring-gingergold/40 focus:border-gingergold transition"
                        >
                    </div>

                    <div class="bg-cocoabase/85 rounded-2xl border border-spiceline shadow-sm overflow-hidden">
                        <div class="grid grid-cols-12 px-5 py-3.5 bg-cocoadeep border-b border-spiceline text-[10px] font-bold text-gingergold uppercase tracking-wider">
                            <span class="col-span-5">Student ID &amp; Name</span>
                            <span class="col-span-3">Course</span>
                            <span class="col-span-2">GPA</span>
                            <span class="col-span-2 text-right">Status</span>
                        </div>
                        <div class="divide-y divide-spiceline/70 text-xs">
                            @forelse ($students as $student)
                                <div class="preview-student-row grid grid-cols-12 px-5 py-3.5 items-center hover:bg-walnutcard/60 transition" data-filter="{{ strtolower(($student->student_id ?? '') . ' ' . ($student->name ?? '') . ' ' . ($student->course ?? 'BSIT')) }}">
                                    <div class="col-span-5 flex items-center space-x-2.5 min-w-0 pr-2">
                                        <span class="font-mono text-[11px] font-bold text-gingergold bg-cocoadeep border border-spiceline px-2 py-0.5 rounded-md shrink-0">{{ $student->student_id }}</span>
                                        <span class="font-bold text-white truncate">{{ $student->name }}</span>
                                    </div>
                                    <span class="col-span-3 text-amber-100/75 font-medium truncate pr-2">{{ $student->course ?? 'BSIT' }}</span>
                                    <span class="col-span-2 font-extrabold text-gingergold tabular-nums">{{ number_format((float) $student->gpa, 2) }}</span>
                                    <div class="col-span-2 text-right">
                                        <span class="inline-flex items-center px-2.5 py-0.5 bg-cocoadeep border border-spiceline text-icingcream rounded-full font-bold text-[11px]">Active</span>
                                    </div>
                                </div>
                            @empty
                                <div class="p-8 text-center text-amber-100/60">No records found in database.</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="relative z-10 max-w-6xl mx-auto px-6 py-16 space-y-12 border-t border-spiceline">
        <div class="text-center space-y-3">
            <span class="text-[10px] font-extrabold uppercase tracking-widest text-gingergold">Everything you need</span>
            <h2 class="text-2xl md:text-3xl font-extrabold text-white">Less admin. More clarity.</h2>
            <p class="text-xs text-amber-100/75 max-w-xl mx-auto">Tools built for student record management, GPA tracking, and organized department rosters.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-cocoadeep/90 p-6 rounded-3xl border border-spiceline shadow-lg hover:border-gingergold/50 transition space-y-3">
                <div class="flex items-center justify-between">
                    <div class="w-10 h-10 rounded-2xl bg-cocoabase border border-spiceline text-gingergold flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <span class="text-[10px] font-mono text-berrypop font-bold">&#10022; 01</span>
                </div>
                <h3 class="text-sm font-bold text-white">Instant CRUD Management</h3>
                <p class="text-xs text-amber-100/75 leading-relaxed">Add, update, and manage student records quickly with prefix rules and GPA validation.</p>
            </div>

            <div class="bg-cocoadeep/90 p-6 rounded-3xl border border-spiceline shadow-lg hover:border-gingergold/50 transition space-y-3">
                <div class="flex items-center justify-between">
                    <div class="w-10 h-10 rounded-2xl bg-cocoabase border border-spiceline text-gingergold flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    </div>
                    <span class="text-[10px] font-mono text-gingergold font-bold">&#10022; 02</span>
                </div>
                <h3 class="text-sm font-bold text-white">Interactive Grading Statistics</h3>
                <p class="text-xs text-amber-100/75 leading-relaxed">Track GPA averages across 3.00, 4.00, or 5.00 scales and inspect course breakdowns.</p>
            </div>

            <div class="bg-cocoadeep/90 p-6 rounded-3xl border border-spiceline shadow-lg hover:border-gingergold/50 transition space-y-3">
                <div class="flex items-center justify-between">
                    <div class="w-10 h-10 rounded-2xl bg-cocoabase border border-spiceline text-gingergold flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                    <span class="text-[10px] font-mono text-berrypop font-bold">&#10022; 03</span>
                </div>
                <h3 class="text-sm font-bold text-white">Search, Filter &amp; CSV Export</h3>
                <p class="text-xs text-amber-100/75 leading-relaxed">Search by ID, name, or course, sort records cleanly, and export rosters to CSV when needed.</p>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section id="pricing" class="relative z-10 max-w-5xl mx-auto px-6 py-16 space-y-10">
        <div class="text-center space-y-3">
            <span class="text-[10px] font-extrabold uppercase tracking-widest text-gingergold">Transparent Pricing</span>
            <h2 class="text-2xl md:text-3xl font-extrabold text-white">Simple plans for academic teams</h2>
            <div class="inline-flex items-center space-x-2 bg-cocoadeep border border-spiceline p-1.5 rounded-2xl mt-4">
                <button type="button" onclick="setPricing('monthly')" id="btn-monthly" class="px-4 py-2 rounded-xl text-xs font-extrabold bg-gingergold text-cocoabase shadow-sm transition">Monthly Billing</button>
                <button type="button" onclick="setPricing('annual')" id="btn-annual" class="px-4 py-2 rounded-xl text-xs font-bold text-amber-100/80 hover:text-white transition">
                    Annual Billing
                    <span class="text-[10px] text-gingergold font-bold bg-cocoabase px-2 py-0.5 rounded-full ml-1">Save 20%</span>
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-3xl mx-auto">
            <div class="bg-cocoadeep/90 p-8 rounded-3xl border border-spiceline shadow-lg space-y-6 flex flex-col justify-between">
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <h3 class="text-sm font-extrabold text-white uppercase tracking-wider">Department Workspace</h3>
                        <span class="text-[10px] text-amber-100/75 bg-cocoabase border border-spiceline px-2.5 py-0.5 rounded-full">Starter</span>
                    </div>
                    <div class="flex items-baseline space-x-1">
                        <span class="text-4xl font-extrabold text-white price-starter tabular-nums">&#8369;0</span>
                        <span class="text-xs text-amber-100/60 billing-cycle">/ month</span>
                    </div>
                    <p class="text-xs text-amber-100/75">Good for individual departments and small student rosters.</p>
                    <ul class="space-y-2 pt-2 border-t border-spiceline/70 text-xs text-icingcream">
                        <li class="flex items-center space-x-2"><span class="text-gingergold">&#10022;</span><span>Student directory &amp; GPA tracking</span></li>
                        <li class="flex items-center space-x-2"><span class="text-gingergold">&#10022;</span><span>Custom ID prefix &amp; scale settings</span></li>
                        <li class="flex items-center space-x-2"><span class="text-gingergold">&#10022;</span><span>CSV roster export</span></li>
                    </ul>
                </div>
                <a href="{{ route('register') }}" class="w-full py-3 bg-cocoabase hover:bg-walnutcard text-white border border-spiceline rounded-xl text-xs font-bold transition text-center block">Get Started Free</a>
            </div>

            <div class="bg-cocoadeep p-8 rounded-3xl border-2 border-gingergold shadow-xl shadow-black/40 space-y-6 flex flex-col justify-between relative overflow-hidden">
                <div class="absolute top-0 right-0 bg-gingergold text-cocoabase text-[9px] font-extrabold px-3 py-1 rounded-bl-xl uppercase tracking-widest">Most Popular</div>
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <h3 class="text-sm font-extrabold text-white uppercase tracking-wider">Full Institution SaaS</h3>
                        <span class="text-[10px] text-berrypop bg-cocoabase border border-berrypop/35 px-2.5 py-0.5 rounded-full font-bold">Complete</span>
                    </div>
                    <div class="flex items-baseline space-x-1">
                        <span class="text-4xl font-extrabold text-gingergold price-pro tabular-nums">&#8369;500</span>
                        <span class="text-xs text-amber-100/60 billing-cycle">/ month</span>
                    </div>
                    <p class="text-xs text-amber-100/75">For multi-course academic teams managing larger student directories.</p>
                    <ul class="space-y-2 pt-2 border-t border-spiceline/70 text-xs text-icingcream">
                        <li class="flex items-center space-x-2"><span class="text-gingergold">&#10022;</span><span>Everything in Department Workspace</span></li>
                        <li class="flex items-center space-x-2"><span class="text-gingergold">&#10022;</span><span>Automated workspace audit telemetry</span></li>
                        <li class="flex items-center space-x-2"><span class="text-gingergold">&#10022;</span><span>Multi-course breakdown &amp; bulk actions</span></li>
                    </ul>
                </div>
                <a href="{{ route('register') }}" class="w-full py-3 bg-gingergold hover:bg-gingerdeep text-cocoabase rounded-xl text-xs font-extrabold transition text-center block shadow-sm">Deploy Workspace</a>
            </div>
        </div>
    </section>

    <!-- Interactive FAQ Section -->
    <section id="faq" class="relative z-10 max-w-4xl mx-auto px-6 py-16 space-y-8">
        <div class="text-center space-y-2">
            <span class="text-[10px] font-extrabold uppercase tracking-widest text-gingergold">Got Questions?</span>
            <h2 class="text-2xl font-extrabold text-white">Frequently Asked Questions</h2>
        </div>

        <div class="space-y-4">
            <div class="bg-cocoadeep/90 rounded-2xl border border-spiceline shadow-md overflow-hidden">
                <button type="button" onclick="toggleFaq(1)" class="w-full p-5 text-left flex justify-between items-center text-xs font-bold text-white hover:bg-walnutcard/60 transition">
                    <span>How does workspace session persistence work?</span>
                    <span id="icon-1" class="text-lg font-bold text-gingergold transition-transform">+</span>
                </button>
                <div id="faq-1" class="hidden p-5 pt-3 text-xs text-amber-100/75 leading-relaxed border-t border-spiceline">
                    EduCore keeps your active workspace session, workspace name, and selected GPA scale synced across dashboard, directory, and settings views.
                </div>
            </div>

            <div class="bg-cocoadeep/90 rounded-2xl border border-spiceline shadow-md overflow-hidden">
                <button type="button" onclick="toggleFaq(2)" class="w-full p-5 text-left flex justify-between items-center text-xs font-bold text-white hover:bg-walnutcard/60 transition">
                    <span>Can I export student records into CSV files?</span>
                    <span id="icon-2" class="text-lg font-bold text-gingergold transition-transform">+</span>
                </button>
                <div id="faq-2" class="hidden p-5 pt-3 text-xs text-amber-100/75 leading-relaxed border-t border-spiceline">
                    Yes. You can download your current student records as a CSV file directly from the Settings page.
                </div>
            </div>

            <div class="bg-cocoadeep/90 rounded-2xl border border-spiceline shadow-md overflow-hidden">
                <button type="button" onclick="toggleFaq(3)" class="w-full p-5 text-left flex justify-between items-center text-xs font-bold text-white hover:bg-walnutcard/60 transition">
                    <span>Which GPA scales and Student ID prefixes are supported?</span>
                    <span id="icon-3" class="text-lg font-bold text-gingergold transition-transform">+</span>
                </button>
                <div id="faq-3" class="hidden p-5 pt-3 text-xs text-amber-100/75 leading-relaxed border-t border-spiceline">
                    You can switch between 3.00, 4.00, and 5.00 GPA scales and customize your default Student ID prefix in Settings while keeping IDs clean and validated.
                </div>
            </div>

            <div class="bg-cocoadeep/90 rounded-2xl border border-spiceline shadow-md overflow-hidden">
                <button type="button" onclick="toggleFaq(4)" class="w-full p-5 text-left flex justify-between items-center text-xs font-bold text-white hover:bg-walnutcard/60 transition">
                    <span>Are workspace edits and course changes logged?</span>
                    <span id="icon-4" class="text-lg font-bold text-gingergold transition-transform">+</span>
                </button>
                <div id="faq-4" class="hidden p-5 pt-3 text-xs text-amber-100/75 leading-relaxed border-t border-spiceline">
                    Yes. When workspace change logging is enabled, student edits, course updates, authentication events, and setting changes appear in Actions.
                </div>
            </div>
        </div>
    </section>

    <!-- Bottom CTA Banner -->
    <section class="relative z-10 max-w-6xl mx-auto px-6 py-12">
        <div class="bg-gradient-to-r from-cocoadeep via-walnutcard to-cocoadeep text-white rounded-3xl p-8 md:p-12 flex flex-col md:flex-row items-center justify-between gap-6 shadow-xl border border-gingergold/30 relative overflow-hidden">
            <div class="pointer-events-none absolute -right-14 -top-14 w-56 h-56 rounded-full bg-gingergold/15 blur-2xl"></div>
            <div class="space-y-2 text-center md:text-left relative z-10">
                <p class="text-[10px] font-bold uppercase tracking-widest text-gingergold">Holiday Term Ready &bull; Happy Holidays</p>
                <h3 class="text-xl md:text-2xl font-extrabold">Give your team time back.</h3>
                <p class="text-xs text-amber-100/75 max-w-md">Set up your workspace and keep student records organized in one place.</p>
            </div>
            <a href="{{ route('register') }}" class="relative z-10 px-8 py-4 bg-gingergold text-cocoabase text-xs font-extrabold rounded-2xl shadow-md hover:bg-gingerdeep transition transform hover:-translate-y-0.5 shrink-0">
                Get started for free
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="relative z-10 max-w-6xl mx-auto px-6 py-8 border-t border-spiceline flex flex-col md:flex-row items-center justify-between text-xs text-amber-100/60 gap-4">
        <div class="flex items-center space-x-2">
            <div class="w-6 h-6 rounded-lg bg-cocoadeep border border-gingergold/35 flex items-center justify-center text-gingergold text-[9px] font-bold">EA</div>
            <span class="font-bold text-white">EduCore SaaS</span>
        </div>
        <p>&copy; 2026 EduCore. Built for better education by Group 1 &bull; <span class="text-gingergold">Happy holidays</span></p>
        <div class="flex items-center space-x-6">
            <a href="#features" class="hover:text-gingergold transition">Features</a>
            <a href="#pricing" class="hover:text-gingergold transition">Pricing</a>
            <a href="#faq" class="hover:text-gingergold transition">FAQ</a>
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
                dashBtn.className = 'px-4 py-1.5 rounded-lg text-xs font-bold bg-gingergold text-cocoabase shadow-sm transition';
                dirBtn.className = 'px-4 py-1.5 rounded-lg text-xs font-bold text-amber-100/75 hover:text-white transition';
            } else {
                dirContent.classList.remove('hidden');
                dashContent.classList.add('hidden');
                dirBtn.className = 'px-4 py-1.5 rounded-lg text-xs font-bold bg-gingergold text-cocoabase shadow-sm transition';
                dashBtn.className = 'px-4 py-1.5 rounded-lg text-xs font-bold text-amber-100/75 hover:text-white transition';
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
                annualBtn.className = 'px-4 py-2 rounded-xl text-xs font-extrabold bg-gingergold text-cocoabase shadow-sm transition';
                monthlyBtn.className = 'px-4 py-2 rounded-xl text-xs font-bold text-amber-100/80 hover:text-white transition';
                priceStarter.innerText = '\u20B10';
                pricePro.innerText = '\u20B1400';
                cycles.forEach(el => el.innerText = '/ month (billed annually)');
            } else {
                monthlyBtn.className = 'px-4 py-2 rounded-xl text-xs font-extrabold bg-gingergold text-cocoabase shadow-sm transition';
                annualBtn.className = 'px-4 py-2 rounded-xl text-xs font-bold text-amber-100/80 hover:text-white transition';
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

        // Frost-flakes & warm spice glints skipping #authActionZone
        (function initGingerSnow() {
            const canvas = document.getElementById('gingerSnow');
            const excludedEl = document.getElementById('authActionZone');
            if (!canvas) return;
            const ctx = canvas.getContext('2d');
            let width = 0;
            let height = 0;
            const particles = Array.from({ length: 46 }, (_, idx) => ({
                x: Math.random() * 1600,
                y: Math.random() * 1000,
                size: 3.8 + Math.random() * 5.6,
                vy: 0.4 + Math.random() * 0.65,
                vx: -0.28 + Math.random() * 0.56,
                angle: Math.random() * Math.PI * 2,
                spin: (-0.011 + Math.random() * 0.022),
                alpha: 0.45 + Math.random() * 0.4,
                isGlint: idx % 6 === 0,
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
                ctx.rotate(p.angle);
                if (p.isGlint) {
                    const grad = ctx.createRadialGradient(0, 0, 0.5, 0, 0, p.size * 1.3);
                    grad.addColorStop(0, `rgba(229, 169, 92, ${p.alpha})`);
                    grad.addColorStop(1, 'rgba(229, 169, 92, 0)');
                    ctx.fillStyle = grad;
                    ctx.beginPath();
                    ctx.arc(0, 0, p.size * 1.3, 0, Math.PI * 2);
                    ctx.fill();
                    ctx.restore();
                    return;
                }
                ctx.strokeStyle = `rgba(250, 245, 238, ${p.alpha * 0.85})`;
                ctx.fillStyle = `rgba(229, 169, 92, ${p.alpha * 0.85})`;
                ctx.lineWidth = Math.max(1, p.size * 0.13);
                ctx.lineCap = 'round';
                const r = p.size;
                const branch = r * 0.35;
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
                ctx.restore();
            }

            function tick() {
                ctx.clearRect(0, 0, width, height);
                for (const p of particles) {
                    p.x += p.vx;
                    p.y += p.vy;
                    p.angle += p.spin;
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
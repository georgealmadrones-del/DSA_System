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
                        obsbase: '#0D1620',
                        panel: '#14222E',
                        panelalt: '#1B2B3A',
                        hearthcard: '#1D1816',
                        sysline: '#2A3D4D',
                        goldacc: '#E6B86A',
                        golddeep: '#C8994B',
                        crimson: '#C94A56',
                        crimsondeep: '#A93843',
                        frosttxt: '#F1F5F9',
                        mutedsys: '#94A3B8',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-obsbase text-frosttxt font-sans antialiased selection:bg-goldacc/25 selection:text-goldacc overflow-x-hidden relative">
    <!-- Subtle Ambient Winter Lighting (60% Base) -->
    <div class="pointer-events-none fixed inset-0 bg-[radial-gradient(ellipse_at_top,_rgba(230,184,106,0.09),_transparent_55%),radial-gradient(ellipse_at_bottom_right,_rgba(201,74,86,0.08),_transparent_60%)] z-0"></div>

    <!-- Subtle Festive Snowflakes & Warm Glints (Skips #authActionZone) -->
    <canvas id="sysHolidaySnow" class="pointer-events-none fixed inset-0 w-full h-full z-30"></canvas>

    <!-- System Top Bar -->
    <header class="sticky top-0 z-40 relative w-full bg-obsbase/90 backdrop-blur-md border-b border-sysline h-20 flex items-center justify-between px-6 md:px-10">
        <!-- Subtle Holiday Fairy Lights along Header Bottom Edge -->
        <svg class="pointer-events-none absolute inset-x-0 -bottom-2.5 w-full h-5 overflow-visible" viewBox="0 0 1440 20" preserveAspectRatio="none" fill="none">
            <path d="M0 1Q240 14 480 1T960 1T1440 1" stroke="#E6B86A" stroke-width="1" stroke-opacity="0.45"/>
            <circle cx="240" cy="7.5" r="2.6" fill="#E6B86A"/>
            <circle cx="240" cy="7.5" r="6" fill="#E6B86A" fill-opacity="0.22"/>
            <circle cx="480" cy="7.5" r="2.6" fill="#C94A56"/>
            <circle cx="480" cy="7.5" r="6" fill="#C94A56" fill-opacity="0.22"/>
            <circle cx="720" cy="7.5" r="2.6" fill="#F1F5F9"/>
            <circle cx="720" cy="7.5" r="6" fill="#E6B86A" fill-opacity="0.18"/>
            <circle cx="960" cy="7.5" r="2.6" fill="#E6B86A"/>
            <circle cx="960" cy="7.5" r="6" fill="#E6B86A" fill-opacity="0.22"/>
            <circle cx="1200" cy="7.5" r="2.6" fill="#C94A56"/>
            <circle cx="1200" cy="7.5" r="6" fill="#C94A56" fill-opacity="0.22"/>
        </svg>

        <a href="#" class="flex items-center space-x-3 group">
            <div class="w-9 h-9 rounded-xl bg-panel border border-goldacc/40 flex items-center justify-center text-goldacc shadow-xs group-hover:border-goldacc transition">
                <div class="grid grid-cols-2 gap-0.5">
                    <span class="w-1.5 h-1.5 bg-goldacc rounded-full"></span>
                    <span class="w-1.5 h-1.5 bg-crimson rounded-full"></span>
                    <span class="w-1.5 h-1.5 bg-frosttxt rounded-full"></span>
                    <span class="w-1.5 h-1.5 bg-goldacc rounded-full"></span>
                </div>
            </div>
            <div class="flex flex-col">
                <span class="font-extrabold text-base tracking-tight text-white leading-none">EduCore <span class="text-goldacc">SaaS</span></span>
                <span class="text-[10px] font-mono text-mutedsys tracking-wider mt-0.5">HOLIDAY RELEASE &bull; RECORDS CLOUD</span>
            </div>
        </a>

        <nav class="hidden md:flex items-center space-x-1 bg-panel/90 p-1 rounded-2xl border border-sysline text-xs font-semibold text-mutedsys">
            <a href="#architecture" class="px-3.5 py-1.5 rounded-xl hover:text-frosttxt hover:bg-panelalt transition">Architecture</a>
            <a href="#features" class="px-3.5 py-1.5 rounded-xl hover:text-frosttxt hover:bg-panelalt transition">Capabilities</a>
            <a href="#pricing" class="px-3.5 py-1.5 rounded-xl hover:text-frosttxt hover:bg-panelalt transition">Plans</a>
            <a href="#faq" class="px-3.5 py-1.5 rounded-xl hover:text-frosttxt hover:bg-panelalt transition">FAQ</a>
        </nav>

        <!-- Excluded Zone: Keep Log in and Get started clean -->
        <div id="authActionZone" class="relative z-50 flex items-center space-x-2.5 md:space-x-3 px-2 py-1 rounded-2xl">
            <a href="{{ route('login') }}" class="px-4 py-2 text-xs font-bold text-frosttxt hover:text-goldacc hover:bg-panel rounded-xl transition">Log in</a>
            <a href="{{ route('register') }}" class="px-5 py-2.5 bg-crimson text-white text-xs font-extrabold rounded-xl shadow-sm hover:bg-crimsondeep transition transform hover:-translate-y-0.5">Get started &rarr;</a>
        </div>
    </header>

    <!-- Hero & System Status Band -->
    <section class="relative z-10 max-w-6xl mx-auto px-6 pt-16 pb-14">
        <div class="bg-panel/85 border border-sysline rounded-3xl p-8 md:p-12 shadow-xl relative overflow-hidden">
            <div class="flex flex-wrap items-center justify-between gap-4 pb-6 mb-8 border-b border-sysline/80 text-xs">
                <div class="inline-flex items-center space-x-2.5 px-3.5 py-1.5 rounded-full bg-obsbase border border-sysline font-semibold text-frosttxt">
                    <span class="w-2 h-2 rounded-full bg-goldacc"></span>
                    <span>Holiday Term &bull; Multi-Workspace Student Record System</span>
                </div>
                <div class="flex items-center space-x-3 font-mono text-[11px] text-mutedsys">
                    <span class="text-goldacc">&#10022; Happy Holidays</span>
                    <span class="hidden sm:inline border-l border-sysline pl-3">CREATED BY GROUP 1</span>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
                <div class="lg:col-span-7 space-y-6">
                    <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold text-white tracking-tight leading-[1.07]">
                        Simplify student records.
                        <span class="block text-goldacc mt-1">Elevate every outcome.</span>
                    </h1>

                    <p class="text-sm md:text-base text-mutedsys max-w-2xl leading-relaxed">
                        A structured academic workspace for managing student rosters, enforcing ID prefix and GPA rules, inspecting course performance, and exporting clean CSV reports with full workspace persistence.
                    </p>

                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3.5 pt-1">
                        <a href="{{ route('register') }}" class="px-7 py-4 bg-crimson hover:bg-crimsondeep text-white text-xs font-extrabold rounded-2xl shadow-md transition transform hover:-translate-y-0.5 flex items-center justify-center space-x-2">
                            <span>Start managing free</span>
                            <span>&rarr;</span>
                        </a>
                        <a href="#workspace-preview" class="px-7 py-4 bg-obsbase hover:bg-panelalt text-frosttxt border border-sysline text-xs font-bold rounded-2xl transition text-center">
                            Inspect live workspace
                        </a>
                    </div>
                </div>

                <!-- Right System Telemetry Rail -->
                <div class="lg:col-span-5 bg-obsbase/90 border border-sysline rounded-2xl p-5 space-y-4">
                    <div class="flex items-center justify-between border-b border-sysline/70 pb-3">
                        <span class="text-[11px] font-mono uppercase tracking-wider text-goldacc">Workspace Telemetry</span>
                        <span class="text-[10px] font-mono px-2.5 py-0.5 rounded-full bg-panel border border-goldacc/35 text-goldacc">LIVE SYNC</span>
                    </div>

                    <div class="grid grid-cols-3 gap-2.5 text-center">
                        <div class="bg-panel/80 p-3.5 rounded-xl border border-sysline/80">
                            <p class="text-[10px] font-mono uppercase text-mutedsys">Enrolled</p>
                            <p class="text-xl font-extrabold text-white mt-1 tabular-nums">{{ $totalStudents }}</p>
                        </div>
                        <div class="bg-panel/80 p-3.5 rounded-xl border border-sysline/80">
                            <p class="text-[10px] font-mono uppercase text-mutedsys">Avg GPA</p>
                            <p class="text-xl font-extrabold text-goldacc mt-1 tabular-nums">{{ number_format((float) $averageGpa, 2) }}</p>
                        </div>
                        <div class="bg-panel/80 p-3.5 rounded-xl border border-sysline/80">
                            <p class="text-[10px] font-mono uppercase text-mutedsys">Courses</p>
                            <p class="text-xl font-extrabold text-white mt-1 tabular-nums">{{ $activeCoursesCount }}</p>
                        </div>
                    </div>

                    <div class="bg-hearthcard/90 p-3.5 rounded-xl border border-sysline/80 flex items-center justify-between text-[11px]">
                        <span class="text-mutedsys">Scales: <strong class="text-frosttxt font-mono">3.00 / 4.00 / 5.00</strong></span>
                        <span class="text-goldacc font-mono">&#10052; CSV Ready</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- System Architecture & Workflow Strip -->
    <section id="architecture" class="relative z-10 max-w-6xl mx-auto px-6 pb-16">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="bg-panel/80 border border-sysline rounded-2xl p-5 space-y-2">
                <span class="text-[10px] font-mono text-goldacc font-bold">01 &bull; WORKSPACE</span>
                <h3 class="text-xs font-extrabold text-white uppercase tracking-wider">Session &amp; Profile</h3>
                <p class="text-xs text-mutedsys leading-relaxed">Persistent workspace name, admin profile sync, and holiday-ready UI across views.</p>
            </div>
            <div class="bg-panel/80 border border-sysline rounded-2xl p-5 space-y-2">
                <span class="text-[10px] font-mono text-crimson font-bold">02 &bull; ROSTER</span>
                <h3 class="text-xs font-extrabold text-white uppercase tracking-wider">Prefix &amp; GPA Rules</h3>
                <p class="text-xs text-mutedsys leading-relaxed">Enforced Student ID prefixes, clean GPA symbol handling, and instant search/sorting.</p>
            </div>
            <div class="bg-panel/80 border border-sysline rounded-2xl p-5 space-y-2">
                <span class="text-[10px] font-mono text-goldacc font-bold">03 &bull; GOVERNANCE</span>
                <h3 class="text-xs font-extrabold text-white uppercase tracking-wider">Audit &amp; Courses</h3>
                <p class="text-xs text-mutedsys leading-relaxed">Department course management paired with activity logging for student and setting edits.</p>
            </div>
            <div class="bg-panel/80 border border-sysline rounded-2xl p-5 space-y-2">
                <span class="text-[10px] font-mono text-crimson font-bold">04 &bull; PORTABILITY</span>
                <h3 class="text-xs font-extrabold text-white uppercase tracking-wider">CSV Roster Export</h3>
                <p class="text-xs text-mutedsys leading-relaxed">Export live student records directly from Settings for reporting and offline backup.</p>
            </div>
        </div>
    </section>

    <!-- Interactive Live Workspace Showcase -->
    <section id="workspace-preview" class="relative z-10 max-w-6xl mx-auto px-6 pb-20">
        <div class="bg-panel border border-sysline rounded-3xl shadow-2xl overflow-hidden">
            <div class="px-6 py-4 bg-obsbase/85 border-b border-sysline flex flex-wrap items-center justify-between gap-4">
                <div class="flex items-center space-x-2.5">
                    <span class="w-2.5 h-2.5 rounded-full bg-crimson"></span>
                    <span class="w-2.5 h-2.5 rounded-full bg-goldacc"></span>
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-400/80"></span>
                    <span class="text-xs font-mono text-mutedsys ml-1">educore.app/workspace/dashboard</span>
                    <span class="hidden sm:inline-flex items-center text-[10px] font-mono text-goldacc bg-panel border border-goldacc/30 px-2.5 py-0.5 rounded-full">Live DB Connected</span>
                </div>

                <div class="flex items-center space-x-1.5 bg-obsbase p-1 rounded-xl border border-sysline">
                    <button type="button" onclick="switchTab('dashboard')" id="tab-dashboard" class="px-4 py-1.5 rounded-lg text-xs font-bold bg-crimson text-white shadow-2xs transition">Dashboard View</button>
                    <button type="button" onclick="switchTab('directory')" id="tab-directory" class="px-4 py-1.5 rounded-lg text-xs font-bold text-mutedsys hover:text-white transition">Directory Table</button>
                </div>
            </div>

            <div class="p-6 md:p-8">
                <!-- Tab 1: Dashboard Analytics -->
                <div id="content-dashboard" class="space-y-6 transition-all duration-300">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                        <div class="bg-obsbase/85 p-5 rounded-2xl border border-sysline hover:border-goldacc/45 transition">
                            <div class="flex items-center justify-between">
                                <p class="text-[10px] font-mono font-bold uppercase text-mutedsys">Total Enrolled (Live DB)</p>
                                <span class="text-[10px] font-mono text-mutedsys">ROSTER</span>
                            </div>
                            <p class="text-3xl font-extrabold text-white mt-2 tabular-nums">{{ $totalStudents }}</p>
                            <span class="text-[10px] text-goldacc bg-panel border border-sysline px-2.5 py-0.5 rounded font-semibold mt-3 inline-block">Synced Database</span>
                        </div>

                        <div class="bg-obsbase/85 p-5 rounded-2xl border border-sysline hover:border-goldacc/55 transition">
                            <div class="flex items-center justify-between">
                                <p class="text-[10px] font-mono font-bold uppercase text-mutedsys">Average Cohort GPA</p>
                                <span class="text-[10px] font-mono text-goldacc">MEAN</span>
                            </div>
                            <p class="text-3xl font-extrabold text-goldacc mt-2 tabular-nums">{{ number_format((float) $averageGpa, 2) }}</p>
                            <span class="text-[10px] text-frosttxt bg-panel border border-sysline px-2.5 py-0.5 rounded font-semibold mt-3 inline-block">Calculated Mean</span>
                        </div>

                        <div class="bg-obsbase/85 p-5 rounded-2xl border border-sysline hover:border-goldacc/45 transition">
                            <div class="flex items-center justify-between">
                                <p class="text-[10px] font-mono font-bold uppercase text-mutedsys">Active Departments</p>
                                <span class="text-[10px] font-mono text-mutedsys">COURSES</span>
                            </div>
                            <p class="text-3xl font-extrabold text-white mt-2 tabular-nums">{{ $activeCoursesCount }}</p>
                            <span class="text-[10px] text-mutedsys bg-panel border border-sysline px-2.5 py-0.5 rounded font-semibold mt-3 inline-block">Unique Courses</span>
                        </div>
                    </div>

                    <div class="bg-obsbase/85 p-5 rounded-2xl border border-sysline flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div>
                            <p class="text-xs font-bold text-white">Workspace Telemetry Active</p>
                            <p class="text-[11px] text-mutedsys">Displaying live summary figures from your EduCore workspace database.</p>
                        </div>
                        <span class="px-3.5 py-1.5 bg-panel border border-goldacc/45 text-goldacc text-xs font-bold rounded-xl shrink-0">Live DB Connected</span>
                    </div>
                </div>

                <!-- Tab 2: Directory Table -->
                <div id="content-directory" class="hidden space-y-4 transition-all duration-300">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                        <p class="text-xs text-mutedsys">Live student records preview from your workspace database.</p>
                        <input
                            type="text"
                            id="previewSearchInput"
                            oninput="filterPreviewStudents()"
                            placeholder="Filter by ID, name, or course..."
                            class="w-full sm:w-72 px-3.5 py-2 bg-obsbase border border-sysline rounded-xl text-xs text-white placeholder-mutedsys/60 focus:outline-none focus:border-goldacc transition"
                        >
                    </div>

                    <div class="bg-obsbase/85 rounded-2xl border border-sysline overflow-hidden">
                        <div class="grid grid-cols-12 px-5 py-3 bg-panelalt border-b border-sysline text-[10px] font-mono font-bold text-goldacc uppercase tracking-wider">
                            <span class="col-span-5">Student ID &amp; Name</span>
                            <span class="col-span-3">Course</span>
                            <span class="col-span-2">GPA</span>
                            <span class="col-span-2 text-right">Status</span>
                        </div>
                        <div class="divide-y divide-sysline/60 text-xs">
                            @forelse ($students as $student)
                                <div class="preview-student-row grid grid-cols-12 px-5 py-3.5 items-center hover:bg-panel/60 transition" data-filter="{{ strtolower(($student->student_id ?? '') . ' ' . ($student->name ?? '') . ' ' . ($student->course ?? 'BSIT')) }}">
                                    <div class="col-span-5 flex items-center space-x-2.5 min-w-0 pr-2">
                                        <span class="font-mono text-[11px] font-bold text-goldacc bg-panel border border-sysline px-2 py-0.5 rounded-md shrink-0">{{ $student->student_id }}</span>
                                        <span class="font-bold text-white truncate">{{ $student->name }}</span>
                                    </div>
                                    <span class="col-span-3 text-mutedsys font-medium truncate pr-2">{{ $student->course ?? 'BSIT' }}</span>
                                    <span class="col-span-2 font-extrabold text-goldacc tabular-nums">{{ number_format((float) $student->gpa, 2) }}</span>
                                    <div class="col-span-2 text-right">
                                        <span class="inline-flex items-center px-2.5 py-0.5 bg-panel border border-sysline text-frosttxt rounded-full font-bold text-[11px]">Active</span>
                                    </div>
                                </div>
                            @empty
                                <div class="p-8 text-center text-mutedsys">No records found in database.</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Capabilities Matrix -->
    <section id="features" class="relative z-10 max-w-6xl mx-auto px-6 py-16 border-t border-sysline space-y-10">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div class="space-y-2">
                <span class="text-[10px] font-mono font-extrabold uppercase tracking-widest text-goldacc">System Capabilities</span>
                <h2 class="text-2xl md:text-3xl font-extrabold text-white tracking-tight">Less admin. More clarity.</h2>
            </div>
            <p class="text-xs text-mutedsys max-w-md">Engineered for reliable student record operations, clear GPA tracking, and organized department rosters.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-panel/90 p-6 rounded-3xl border border-sysline hover:border-goldacc/45 transition space-y-3">
                <div class="flex items-center justify-between">
                    <div class="w-10 h-10 rounded-2xl bg-obsbase border border-sysline text-goldacc flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <span class="text-[10px] font-mono text-goldacc">01</span>
                </div>
                <h3 class="text-sm font-bold text-white">Instant CRUD Management</h3>
                <p class="text-xs text-mutedsys leading-relaxed">Add, update, and manage student records quickly with prefix rules and GPA validation.</p>
            </div>

            <div class="bg-panel/90 p-6 rounded-3xl border border-sysline hover:border-goldacc/45 transition space-y-3">
                <div class="flex items-center justify-between">
                    <div class="w-10 h-10 rounded-2xl bg-obsbase border border-sysline text-goldacc flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    </div>
                    <span class="text-[10px] font-mono text-crimson">02</span>
                </div>
                <h3 class="text-sm font-bold text-white">Interactive Grading Statistics</h3>
                <p class="text-xs text-mutedsys leading-relaxed">Track GPA averages across 3.00, 4.00, or 5.00 scales and inspect course breakdowns.</p>
            </div>

            <div class="bg-panel/90 p-6 rounded-3xl border border-sysline hover:border-goldacc/45 transition space-y-3">
                <div class="flex items-center justify-between">
                    <div class="w-10 h-10 rounded-2xl bg-obsbase border border-sysline text-goldacc flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                    <span class="text-[10px] font-mono text-goldacc">03</span>
                </div>
                <h3 class="text-sm font-bold text-white">Search, Filter &amp; CSV Export</h3>
                <p class="text-xs text-mutedsys leading-relaxed">Search by ID, name, or course, sort records cleanly, and export rosters to CSV when needed.</p>
            </div>
        </div>
    </section>

    <!-- Pricing Plans -->
    <section id="pricing" class="relative z-10 max-w-6xl mx-auto px-6 py-16 border-t border-sysline space-y-10">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="space-y-2">
                <span class="text-[10px] font-mono font-extrabold uppercase tracking-widest text-goldacc">Transparent Pricing</span>
                <h2 class="text-2xl md:text-3xl font-extrabold text-white tracking-tight">Simple plans for academic teams</h2>
            </div>

            <div class="inline-flex items-center space-x-1.5 bg-panel border border-sysline p-1.5 rounded-2xl self-start md:self-auto">
                <button type="button" onclick="setPricing('monthly')" id="btn-monthly" class="px-4 py-2 rounded-xl text-xs font-extrabold bg-crimson text-white shadow-2xs transition">Monthly Billing</button>
                <button type="button" onclick="setPricing('annual')" id="btn-annual" class="px-4 py-2 rounded-xl text-xs font-bold text-mutedsys hover:text-white transition">
                    Annual Billing
                    <span class="text-[10px] text-goldacc font-bold bg-obsbase px-2 py-0.5 rounded-full ml-1">Save 20%</span>
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
            <div class="bg-panel/90 p-8 rounded-3xl border border-sysline space-y-6 flex flex-col justify-between">
                <div class="space-y-4">
                    <h3 class="text-xs font-extrabold text-white uppercase tracking-wider">Department Workspace</h3>
                    <div class="flex items-baseline space-x-1">
                        <span class="text-4xl font-extrabold text-white price-starter tabular-nums">&#8369;0</span>
                        <span class="text-xs text-mutedsys billing-cycle">/ month</span>
                    </div>
                    <p class="text-xs text-mutedsys">Good for individual departments and small student rosters.</p>
                    <ul class="space-y-2 pt-2 border-t border-sysline/70 text-xs text-frosttxt">
                        <li class="flex items-center space-x-2"><span class="text-goldacc">&#10022;</span><span>Student directory &amp; GPA tracking</span></li>
                        <li class="flex items-center space-x-2"><span class="text-goldacc">&#10022;</span><span>Custom ID prefix &amp; scale settings</span></li>
                        <li class="flex items-center space-x-2"><span class="text-goldacc">&#10022;</span><span>CSV roster export</span></li>
                    </ul>
                </div>
                <a href="{{ route('register') }}" class="w-full py-3 bg-obsbase hover:bg-panelalt text-white border border-sysline rounded-xl text-xs font-bold transition text-center block">Get Started Free</a>
            </div>

            <div class="bg-panel p-8 rounded-3xl border-2 border-goldacc shadow-xl space-y-6 flex flex-col justify-between relative overflow-hidden">
                <div class="absolute top-0 right-0 bg-goldacc text-obsbase text-[9px] font-extrabold px-3.5 py-1 rounded-bl-xl uppercase tracking-widest">Most Popular</div>
                <div class="space-y-4">
                    <h3 class="text-xs font-extrabold text-white uppercase tracking-wider">Full Institution SaaS</h3>
                    <div class="flex items-baseline space-x-1">
                        <span class="text-4xl font-extrabold text-goldacc price-pro tabular-nums">&#8369;500</span>
                        <span class="text-xs text-mutedsys billing-cycle">/ month</span>
                    </div>
                    <p class="text-xs text-mutedsys">For multi-course academic teams managing larger student directories.</p>
                    <ul class="space-y-2 pt-2 border-t border-sysline/70 text-xs text-frosttxt">
                        <li class="flex items-center space-x-2"><span class="text-crimson font-bold">&#10022;</span><span>Everything in Department Workspace</span></li>
                        <li class="flex items-center space-x-2"><span class="text-crimson font-bold">&#10022;</span><span>Automated workspace audit telemetry</span></li>
                        <li class="flex items-center space-x-2"><span class="text-crimson font-bold">&#10022;</span><span>Multi-course breakdown &amp; bulk actions</span></li>
                    </ul>
                </div>
                <a href="{{ route('register') }}" class="w-full py-3 bg-crimson hover:bg-crimsondeep text-white rounded-xl text-xs font-extrabold transition text-center block shadow-sm">Deploy Workspace</a>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section id="faq" class="relative z-10 max-w-4xl mx-auto px-6 py-16 border-t border-sysline space-y-8">
        <div class="text-center space-y-2">
            <span class="text-[10px] font-mono font-extrabold uppercase tracking-widest text-goldacc">Got Questions?</span>
            <h2 class="text-2xl font-extrabold text-white">Frequently Asked Questions</h2>
        </div>

        <div class="space-y-3.5">
            <div class="bg-panel/90 rounded-2xl border border-sysline overflow-hidden">
                <button type="button" onclick="toggleFaq(1)" class="w-full p-5 text-left flex justify-between items-center text-xs font-bold text-white hover:bg-panelalt/60 transition">
                    <span>How does workspace session persistence work?</span>
                    <span id="icon-1" class="text-lg font-mono text-goldacc">+</span>
                </button>
                <div id="faq-1" class="hidden p-5 pt-3 text-xs text-mutedsys leading-relaxed border-t border-sysline">
                    EduCore keeps your active workspace session, workspace name, and selected GPA scale synced across dashboard, directory, and settings views.
                </div>
            </div>

            <div class="bg-panel/90 rounded-2xl border border-sysline overflow-hidden">
                <button type="button" onclick="toggleFaq(2)" class="w-full p-5 text-left flex justify-between items-center text-xs font-bold text-white hover:bg-panelalt/60 transition">
                    <span>Can I export student records into CSV files?</span>
                    <span id="icon-2" class="text-lg font-mono text-goldacc">+</span>
                </button>
                <div id="faq-2" class="hidden p-5 pt-3 text-xs text-mutedsys leading-relaxed border-t border-sysline">
                    Yes. You can download your current student records as a CSV file directly from the Settings page.
                </div>
            </div>

            <div class="bg-panel/90 rounded-2xl border border-sysline overflow-hidden">
                <button type="button" onclick="toggleFaq(3)" class="w-full p-5 text-left flex justify-between items-center text-xs font-bold text-white hover:bg-panelalt/60 transition">
                    <span>Which GPA scales and Student ID prefixes are supported?</span>
                    <span id="icon-3" class="text-lg font-mono text-goldacc">+</span>
                </button>
                <div id="faq-3" class="hidden p-5 pt-3 text-xs text-mutedsys leading-relaxed border-t border-sysline">
                    You can switch between 3.00, 4.00, and 5.00 GPA scales and customize your default Student ID prefix in Settings while keeping IDs clean and validated.
                </div>
            </div>
        </div>
    </section>

    <!-- Bottom CTA & Footer -->
    <section class="relative z-10 max-w-6xl mx-auto px-6 py-12">
        <div class="bg-gradient-to-r from-panel via-panelalt to-hearthcard text-white rounded-3xl p-8 md:p-12 flex flex-col md:flex-row items-center justify-between gap-6 border border-sysline shadow-xl">
            <div class="space-y-2 text-center md:text-left">
                <p class="text-[10px] font-mono font-bold uppercase tracking-widest text-goldacc">Holiday Term Ready &bull; Happy Holidays</p>
                <h3 class="text-xl md:text-2xl font-extrabold">Give your team time back.</h3>
                <p class="text-xs text-mutedsys max-w-md">Set up your workspace and keep student records organized in one place.</p>
            </div>
            <a href="{{ route('register') }}" class="px-8 py-4 bg-crimson hover:bg-crimsondeep text-white text-xs font-extrabold rounded-2xl shadow-md transition transform hover:-translate-y-0.5 shrink-0">
                Get started for free
            </a>
        </div>
    </section>

    <footer class="relative z-10 max-w-6xl mx-auto px-6 py-8 border-t border-sysline flex flex-col md:flex-row items-center justify-between text-xs text-mutedsys gap-4">
        <div class="flex items-center space-x-2">
            <div class="w-6 h-6 rounded-lg bg-panel border border-sysline flex items-center justify-center text-goldacc font-mono text-[9px] font-bold">EA</div>
            <span class="font-bold text-white">EduCore SaaS</span>
        </div>
        <p>&copy; 2026 EduCore. Built for better education by Group 1 &bull; <span class="text-goldacc">Happy holidays</span></p>
        <div class="flex items-center space-x-6">
            <a href="#features" class="hover:text-white transition">Features</a>
            <a href="#pricing" class="hover:text-white transition">Pricing</a>
            <a href="#faq" class="hover:text-white transition">FAQ</a>
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
                dashBtn.className = 'px-4 py-1.5 rounded-lg text-xs font-bold bg-crimson text-white shadow-2xs transition';
                dirBtn.className = 'px-4 py-1.5 rounded-lg text-xs font-bold text-mutedsys hover:text-white transition';
            } else {
                dirContent.classList.remove('hidden');
                dashContent.classList.add('hidden');
                dirBtn.className = 'px-4 py-1.5 rounded-lg text-xs font-bold bg-crimson text-white shadow-2xs transition';
                dashBtn.className = 'px-4 py-1.5 rounded-lg text-xs font-bold text-mutedsys hover:text-white transition';
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
                annualBtn.className = 'px-4 py-2 rounded-xl text-xs font-extrabold bg-crimson text-white shadow-2xs transition';
                monthlyBtn.className = 'px-4 py-2 rounded-xl text-xs font-bold text-mutedsys hover:text-white transition';
                priceStarter.innerText = '\u20B10';
                pricePro.innerText = '\u20B1400';
                cycles.forEach(el => el.innerText = '/ month (billed annually)');
            } else {
                monthlyBtn.className = 'px-4 py-2 rounded-xl text-xs font-extrabold bg-crimson text-white shadow-2xs transition';
                annualBtn.className = 'px-4 py-2 rounded-xl text-xs font-bold text-mutedsys hover:text-white transition';
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

        // Subtle holiday snow & gold glints skipping #authActionZone
        (function initSysHolidaySnow() {
            const canvas = document.getElementById('sysHolidaySnow');
            const excludedEl = document.getElementById('authActionZone');
            if (!canvas) return;
            const ctx = canvas.getContext('2d');
            let width = 0;
            let height = 0;
            const particles = Array.from({ length: 38 }, (_, idx) => ({
                x: Math.random() * 1600,
                y: Math.random() * 1000,
                size: 3 + Math.random() * 4.5,
                vy: 0.35 + Math.random() * 0.55,
                vx: -0.22 + Math.random() * 0.44,
                alpha: 0.35 + Math.random() * 0.35,
                isGold: idx % 4 === 0,
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
                ctx.fillStyle = p.isGold
                    ? `rgba(230, 184, 106, ${p.alpha})`
                    : `rgba(241, 245, 249, ${p.alpha * 0.8})`;
                ctx.beginPath();
                ctx.arc(0, 0, p.size * 0.52, 0, Math.PI * 2);
                ctx.fill();
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
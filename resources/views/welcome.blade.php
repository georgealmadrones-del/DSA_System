<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduCore — Holiday Studio Edition</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        paper: '#F4EFE6',
                        paperdark: '#E8DFCE',
                        pine: '#1B3B2B',
                        espresso: '#231B16',
                        cranberry: '#B8323A',
                        cranberrydeep: '#96242B',
                        brass: '#C68B2C',
                    },
                    fontFamily: {
                        mono: ['ui-monospace', 'SFMono-Regular', 'Menlo', 'Monaco', 'Consolas', 'monospace'],
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-paper text-espresso antialiased selection:bg-brass/25 overflow-x-hidden relative">

    <!-- Subtle paper grain / soft snow dots (skips #authActionZone) -->
    <canvas id="studioSnow" class="pointer-events-none fixed inset-0 w-full h-full z-30"></canvas>

    <!-- Hand-styled top bar with little string lights -->
    <header class="sticky top-0 z-40 bg-paper/95 backdrop-blur-sm border-b-2 border-espresso">
        <div class="max-w-5xl mx-auto px-5 h-16 flex items-center justify-between gap-4">
            <a href="#" class="flex items-center gap-2.5 group">
                <!-- Little hand-drawn star-in-circle mark -->
                <svg class="w-7 h-7 text-cranberry shrink-0" viewBox="0 0 28 28" fill="none">
                    <circle cx="14" cy="14" r="11.5" stroke="currentColor" stroke-width="2"/>
                    <path d="M14 6.5L16.1 11.4L21.4 11.9L17.4 15.4L18.6 20.6L14 17.8L9.4 20.6L10.6 15.4L6.6 11.9L11.9 11.4L14 6.5Z" fill="#C68B2C" stroke="#231B16" stroke-width="1.2" stroke-linejoin="round"/>
                </svg>
                <span class="font-mono font-bold text-sm tracking-tight text-espresso">
                    educore<span class="text-cranberry">.</span>holiday
                </span>
            </a>

            <nav class="hidden md:flex items-center gap-6 font-mono text-xs text-espresso/80">
                <a href="#roster" class="hover:text-cranberry underline decoration-brass/60 underline-offset-4 transition">roster</a>
                <a href="#notes" class="hover:text-cranberry underline decoration-brass/60 underline-offset-4 transition">notes</a>
                <a href="#plans" class="hover:text-cranberry underline decoration-brass/60 underline-offset-4 transition">plans</a>
                <a href="#faq" class="hover:text-cranberry underline decoration-brass/60 underline-offset-4 transition">faq</a>
            </nav>

            <!-- Excluded from snow -->
            <div id="authActionZone" class="relative z-50 flex items-center gap-2">
                <a href="{{ route('login') }}" class="px-3 py-1.5 font-mono text-xs font-semibold text-espresso hover:text-cranberry transition">
                    log in
                </a>
                <a href="{{ route('register') }}" class="px-3.5 py-1.5 bg-pine text-paper font-mono text-xs font-semibold rounded-md border-2 border-espresso shadow-[2px_2px_0px_#231B16] hover:bg-cranberry transition">
                    get started
                </a>
            </div>
        </div>

        <!-- Tiny holiday bulbs along the bottom edge -->
        <svg class="pointer-events-none absolute inset-x-0 -bottom-2.5 w-full h-5 overflow-visible" viewBox="0 0 1200 20" preserveAspectRatio="none" fill="none">
            <path d="M0 1Q150 13 300 1T600 1T900 1T1200 1" stroke="#231B16" stroke-width="1.2" stroke-dasharray="3 2"/>
            <circle cx="150" cy="7" r="3" fill="#B8323A"/>
            <circle cx="300" cy="7" r="3" fill="#C68B2C"/>
            <circle cx="450" cy="7" r="3" fill="#1B3B2B"/>
            <circle cx="600" cy="7" r="3" fill="#B8323A"/>
            <circle cx="750" cy="7" r="3" fill="#C68B2C"/>
            <circle cx="900" cy="7" r="3" fill="#1B3B2B"/>
            <circle cx="1050" cy="7" r="3" fill="#B8323A"/>
        </svg>
    </header>

    <!-- Editorial / Zine Hero -->
    <section class="relative z-10 max-w-5xl mx-auto px-5 pt-14 pb-12">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-end border-b-2 border-espresso pb-10">
            <div class="lg:col-span-8 space-y-4">
                <div class="inline-flex items-center gap-2 font-mono text-xs bg-paperdark border border-espresso px-3 py-1 rounded">
                    <span class="w-2 h-2 rounded-full bg-cranberry"></span>
                    <span>december edition &bull; group 1</span>
                </div>

                <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold tracking-tight text-espresso leading-[1.04]">
                    Student records,<br>
                    kept <span class="italic font-serif text-cranberry">calm &amp; tidy</span><br>
                    all season long.
                </h1>

                <p class="text-sm sm:text-base text-espresso/80 max-w-xl leading-relaxed">
                    A quiet, dependable place to track student IDs, GPAs, and courses without wrestling spreadsheets—made with holiday cheer for your department.
                </p>
            </div>

            <!-- Small "stamp" card on the right -->
            <div class="lg:col-span-4">
                <div class="bg-paperdark border-2 border-espresso rounded-lg p-4 shadow-[4px_4px_0px_#231B16] space-y-3">
                    <div class="flex items-center justify-between font-mono text-[11px] text-espresso/70 border-b border-espresso/25 pb-2">
                        <span>STATUS</span>
                        <span class="text-pine font-bold">&#10022; MERRY CHRISTMAS</span>
                    </div>
                    <div class="grid grid-cols-3 gap-2 text-center font-mono">
                        <div class="bg-paper border border-espresso/40 rounded p-2">
                            <div class="text-lg font-bold text-espresso tabular-nums">{{ $totalStudents }}</div>
                            <div class="text-[10px] text-espresso/65">students</div>
                        </div>
                        <div class="bg-paper border border-espresso/40 rounded p-2">
                            <div class="text-lg font-bold text-cranberry tabular-nums">{{ number_format((float) $averageGpa, 2) }}</div>
                            <div class="text-[10px] text-espresso/65">avg gpa</div>
                        </div>
                        <div class="bg-paper border border-espresso/40 rounded p-2">
                            <div class="text-lg font-bold text-pine tabular-nums">{{ $activeCoursesCount }}</div>
                            <div class="text-[10px] text-espresso/65">courses</div>
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-2 pt-1">
                        <a href="{{ route('register') }}" class="flex-1 text-center px-3 py-2 bg-cranberry text-paper font-mono text-xs font-bold rounded border border-espresso hover:bg-cranberrydeep transition">
                            open workspace &rarr;
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Live Roster & Summary Sheet -->
    <section id="roster" class="relative z-10 max-w-5xl mx-auto px-5 py-12">
        <div class="flex flex-wrap items-center justify-between gap-4 mb-5">
            <div>
                <p class="font-mono text-xs text-cranberry uppercase tracking-wider">live ledger</p>
                <h2 class="text-2xl font-bold text-espresso">Peek inside the current roster</h2>
            </div>

            <div class="inline-flex bg-paperdark border border-espresso rounded-md p-0.5 font-mono text-xs">
                <button type="button" onclick="switchTab('summary')" id="tab-summary" class="px-3 py-1 rounded bg-pine text-paper font-semibold transition">
                    summary
                </button>
                <button type="button" onclick="switchTab('table')" id="tab-table" class="px-3 py-1 rounded text-espresso hover:text-cranberry transition">
                    student list
                </button>
            </div>
        </div>

        <div class="bg-paperdark border-2 border-espresso rounded-lg shadow-[5px_5px_0px_#1B3B2B] overflow-hidden">
            <!-- Summary Tab -->
            <div id="content-summary" class="p-6 grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="border-b md:border-b-0 md:border-r border-espresso/25 pb-4 md:pb-0 md:pr-6">
                    <span class="font-mono text-xs text-espresso/60">01 / ENROLLMENT</span>
                    <div class="text-3xl font-bold text-espresso mt-1 tabular-nums">{{ $totalStudents }}</div>
                    <p class="text-xs text-espresso/75 mt-1">Active student records synced straight from your database.</p>
                </div>
                <div class="border-b md:border-b-0 md:border-r border-espresso/25 pb-4 md:pb-0 md:pr-6">
                    <span class="font-mono text-xs text-espresso/60">02 / GRADING</span>
                    <div class="text-3xl font-bold text-cranberry mt-1 tabular-nums">{{ number_format((float) $averageGpa, 2) }}</div>
                    <p class="text-xs text-espresso/75 mt-1">Mean GPA across enrolled students on your active scale.</p>
                </div>
                <div>
                    <span class="font-mono text-xs text-espresso/60">03 / DEPARTMENTS</span>
                    <div class="text-3xl font-bold text-pine mt-1 tabular-nums">{{ $activeCoursesCount }}</div>
                    <p class="text-xs text-espresso/75 mt-1">Distinct courses tracked in the current workspace.</p>
                </div>
            </div>

            <!-- Table Tab -->
            <div id="content-table" class="hidden p-6 space-y-4">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                    <span class="font-mono text-xs text-espresso/70">showing live records</span>
                    <input
                        type="text"
                        id="previewSearchInput"
                        oninput="filterPreviewStudents()"
                        placeholder="search id, name, or course..."
                        class="w-full sm:w-64 px-3 py-1.5 bg-paper border border-espresso rounded font-mono text-xs text-espresso placeholder-espresso/45 focus:outline-none focus:border-cranberry"
                    >
                </div>

                <div class="bg-paper border border-espresso rounded overflow-x-auto">
                    <table class="w-full text-left border-collapse text-xs">
                        <thead>
                            <tr class="border-b border-espresso bg-paperdark/70 font-mono text-[11px] text-espresso/75">
                                <th class="py-2.5 px-4">ID</th>
                                <th class="py-2.5 px-4">Student</th>
                                <th class="py-2.5 px-4">Course</th>
                                <th class="py-2.5 px-4 text-right">GPA</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-espresso/15">
                            @forelse ($students as $student)
                                <tr class="preview-student-row hover:bg-paperdark/40 transition" data-filter="{{ strtolower(($student->student_id ?? '') . ' ' . ($student->name ?? '') . ' ' . ($student->course ?? 'BSIT')) }}">
                                    <td class="py-2.5 px-4 font-mono font-semibold text-pine">{{ $student->student_id }}</td>
                                    <td class="py-2.5 px-4 font-medium text-espresso">{{ $student->name }}</td>
                                    <td class="py-2.5 px-4 text-espresso/75">{{ $student->course ?? 'BSIT' }}</td>
                                    <td class="py-2.5 px-4 text-right font-mono font-bold text-cranberry tabular-nums">{{ number_format((float) $student->gpa, 2) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-6 px-4 text-center font-mono text-xs text-espresso/60">no student records yet</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- What's Inside (Margin Notes Style) -->
    <section id="notes" class="relative z-10 max-w-5xl mx-auto px-5 py-12 border-t border-espresso/30">
        <div class="mb-8">
            <p class="font-mono text-xs text-cranberry uppercase tracking-wider">what it does</p>
            <h2 class="text-2xl font-bold text-espresso">Small details that save hours</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-paperdark/70 border border-espresso rounded-lg p-5 space-y-2">
                <div class="font-mono text-xs font-bold text-brass">&#9733; 01. QUICK ENTRIES</div>
                <h3 class="font-bold text-base text-espresso">Clean IDs &amp; GPA checks</h3>
                <p class="text-xs text-espresso/80 leading-relaxed">
                    Create and edit student entries fast, keep ID prefixes consistent, and catch invalid GPA values before they slip in.
                </p>
            </div>

            <div class="bg-paperdark/70 border border-espresso rounded-lg p-5 space-y-2">
                <div class="font-mono text-xs font-bold text-cranberry">&#9733; 02. COURSE SNAPSHOTS</div>
                <h3 class="font-bold text-base text-espresso">Averages at a glance</h3>
                <p class="text-xs text-espresso/80 leading-relaxed">
                    See cohort averages across 3.00, 4.00, or 5.00 scales and keep tabs on active courses without digging through menus.
                </p>
            </div>

            <div class="bg-paperdark/70 border border-espresso rounded-lg p-5 space-y-2">
                <div class="font-mono text-xs font-bold text-pine">&#9733; 03. READY TO SHARE</div>
                <h3 class="font-bold text-base text-espresso">Search &amp; CSV export</h3>
                <p class="text-xs text-espresso/80 leading-relaxed">
                    Filter by name, ID, or program in seconds, review workspace activity, and export a clean CSV whenever you need one.
                </p>
            </div>
        </div>
    </section>

    <!-- Plans -->
    <section id="plans" class="relative z-10 max-w-5xl mx-auto px-5 py-12 border-t border-espresso/30">
        <div class="flex flex-wrap items-end justify-between gap-4 mb-8">
            <div>
                <p class="font-mono text-xs text-cranberry uppercase tracking-wider">plans</p>
                <h2 class="text-2xl font-bold text-espresso">Keep it simple</h2>
            </div>

            <div class="inline-flex bg-paperdark border border-espresso rounded-md p-0.5 font-mono text-xs">
                <button type="button" onclick="setPricing('monthly')" id="btn-monthly" class="px-3 py-1 rounded bg-cranberry text-paper font-semibold transition">
                    monthly
                </button>
                <button type="button" onclick="setPricing('annual')" id="btn-annual" class="px-3 py-1 rounded text-espresso hover:text-cranberry transition">
                    annual <span class="text-pine font-bold">(-20%)</span>
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-paper border-2 border-espresso rounded-lg p-6 flex flex-col justify-between space-y-6">
                <div class="space-y-2">
                    <div class="font-mono text-xs uppercase text-espresso/65">starter</div>
                    <h3 class="text-lg font-bold text-espresso">Department Workspace</h3>
                    <div class="font-mono text-3xl font-bold text-espresso pt-1">
                        <span class="price-starter tabular-nums">&#8369;0</span>
                        <span class="text-xs font-normal text-espresso/65 billing-cycle">/ month</span>
                    </div>
                    <p class="text-xs text-espresso/75 pt-1">Great for a single department or small class roster.</p>
                </div>
                <a href="{{ route('register') }}" class="block text-center py-2.5 px-4 bg-paperdark hover:bg-paperdark/70 text-espresso font-mono text-xs font-bold rounded border border-espresso transition">
                    start for free
                </a>
            </div>

            <div class="bg-pine text-paper border-2 border-espresso rounded-lg p-6 shadow-[5px_5px_0px_#C68B2C] flex flex-col justify-between space-y-6">
                <div class="space-y-2">
                    <div class="flex items-center justify-between font-mono text-xs">
                        <span class="text-brass uppercase">institution</span>
                        <span class="px-2 py-0.5 rounded bg-paper text-espresso text-[10px] font-bold">popular</span>
                    </div>
                    <h3 class="text-lg font-bold">Full Institution</h3>
                    <div class="font-mono text-3xl font-bold text-brass pt-1">
                        <span class="price-pro tabular-nums">&#8369;500</span>
                        <span class="text-xs font-normal text-paper/75 billing-cycle">/ month</span>
                    </div>
                    <p class="text-xs text-paper/80 pt-1">For multi-course teams managing larger student directories.</p>
                </div>
                <a href="{{ route('register') }}" class="block text-center py-2.5 px-4 bg-cranberry hover:bg-cranberrydeep text-paper font-mono text-xs font-bold rounded border border-paper/30 transition">
                    deploy workspace
                </a>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section id="faq" class="relative z-10 max-w-4xl mx-auto px-5 py-12 border-t border-espresso/30">
        <div class="mb-6">
            <p class="font-mono text-xs text-cranberry uppercase tracking-wider">faq</p>
            <h2 class="text-2xl font-bold text-espresso">Quick answers</h2>
        </div>

        <div class="divide-y divide-espresso/25 border-t border-b border-espresso/25">
            <div>
                <button type="button" onclick="toggleFaq(1)" class="w-full py-4 text-left flex items-center justify-between text-sm font-semibold text-espresso hover:text-cranberry transition">
                    <span>Does my workspace remember my settings across pages?</span>
                    <span id="icon-1" class="font-mono text-base text-cranberry">+</span>
                </button>
                <div id="faq-1" class="hidden pb-4 text-xs text-espresso/80 leading-relaxed">
                    Yes—your workspace name, selected GPA scale, and session stay synced across your dashboard, directory, and settings.
                </div>
            </div>

            <div>
                <button type="button" onclick="toggleFaq(2)" class="w-full py-4 text-left flex items-center justify-between text-sm font-semibold text-espresso hover:text-cranberry transition">
                    <span>Can I export the student roster to CSV?</span>
                    <span id="icon-2" class="font-mono text-base text-cranberry">+</span>
                </button>
                <div id="faq-2" class="hidden pb-4 text-xs text-espresso/80 leading-relaxed">
                    Yep. Head over to Settings anytime and download your current student records as a CSV file.
                </div>
            </div>

            <div>
                <button type="button" onclick="toggleFaq(3)" class="w-full py-4 text-left flex items-center justify-between text-sm font-semibold text-espresso hover:text-cranberry transition">
                    <span>Which GPA scales and ID prefixes work?</span>
                    <span id="icon-3" class="font-mono text-base text-cranberry">+</span>
                </button>
                <div id="faq-3" class="hidden pb-4 text-xs text-espresso/80 leading-relaxed">
                    You can use 3.00, 4.00, or 5.00 GPA scales and customize your default Student ID prefix in Settings.
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="relative z-10 max-w-5xl mx-auto px-5 py-10 mt-6 border-t-2 border-espresso flex flex-col sm:flex-row items-center justify-between gap-4 font-mono text-xs text-espresso/75">
        <div>
            <span class="font-bold text-espresso">EduCore</span> &bull; built by Group 1
        </div>
        <div class="text-cranberry font-semibold">
            &#10022; season&apos;s greetings &amp; happy holidays &#10022;
        </div>
        <div class="flex items-center gap-4">
            <a href="#roster" class="hover:text-cranberry">roster</a>
            <a href="#plans" class="hover:text-cranberry">plans</a>
            <a href="#faq" class="hover:text-cranberry">faq</a>
        </div>
    </footer>

    <script>
        function switchTab(tab) {
            const summary = document.getElementById('content-summary');
            const table = document.getElementById('content-table');
            const tabSummary = document.getElementById('tab-summary');
            const tabTable = document.getElementById('tab-table');

            if (tab === 'summary') {
                summary.classList.remove('hidden');
                table.classList.add('hidden');
                tabSummary.className = 'px-3 py-1 rounded bg-pine text-paper font-semibold transition';
                tabTable.className = 'px-3 py-1 rounded text-espresso hover:text-cranberry transition';
            } else {
                table.classList.remove('hidden');
                summary.classList.add('hidden');
                tabTable.className = 'px-3 py-1 rounded bg-pine text-paper font-semibold transition';
                tabSummary.className = 'px-3 py-1 rounded text-espresso hover:text-cranberry transition';
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
                aBtn.className = 'px-3 py-1 rounded bg-cranberry text-paper font-semibold transition';
                mBtn.className = 'px-3 py-1 rounded text-espresso hover:text-cranberry transition';
                starter.innerText = '\u20B10';
                pro.innerText = '\u20B1400';
                cycles.forEach(el => el.innerText = '/ month (billed yearly)');
            } else {
                mBtn.className = 'px-3 py-1 rounded bg-cranberry text-paper font-semibold transition';
                aBtn.className = 'px-3 py-1 rounded text-espresso hover:text-cranberry transition';
                starter.innerText = '\u20B10';
                pro.innerText = '\u20B1500';
                cycles.forEach(el => el.innerText = '/ month');
            }
        }

        function toggleFaq(id) {
            const el = document.getElementById(`faq-${id}`);
            const icon = document.getElementById(`icon-${id}`);
            if (!el || !icon) return;
            const opening = el.classList.contains('hidden');
            el.classList.toggle('hidden', !opening);
            icon.innerText = opening ? '−' : '+';
        }

        // Gentle paper-snow specks skipping #authActionZone
        (function initStudioSnow() {
            const canvas = document.getElementById('studioSnow');
            const excluded = document.getElementById('authActionZone');
            if (!canvas) return;
            const ctx = canvas.getContext('2d');
            let w = 0, h = 0;

            const specks = Array.from({ length: 34 }, (_, i) => ({
                x: Math.random() * 1400,
                y: Math.random() * 900,
                r: 1.5 + Math.random() * 2.4,
                vy: 0.3 + Math.random() * 0.5,
                vx: -0.2 + Math.random() * 0.4,
                color: i % 5 === 0 ? 'rgba(184, 50, 58, 0.35)' : (i % 3 === 0 ? 'rgba(198, 139, 44, 0.45)' : 'rgba(27, 59, 43, 0.22)')
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
                    if (s.y > h) { s.y = -5; s.x = Math.random() * w; }
                    if (s.x < 0) s.x = w;
                    if (s.x > w) s.x = 0;
                    if (!insideAuth(s.x, s.y)) {
                        ctx.fillStyle = s.color;
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
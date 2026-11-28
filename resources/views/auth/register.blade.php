<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Workspace — EduCore SaaS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        nordic: '#2C6B8E',
                        pine: '#718082',
                        sage: '#A3B2B1',
                        glacier: '#ADC6D6',
                        frost: '#E8ECF1',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-frost text-pine font-sans antialiased min-h-screen flex items-center justify-center p-6 selection:bg-glacier/40">
    <div class="relative overflow-hidden max-w-md w-full bg-white/95 rounded-3xl border border-glacier shadow-xl p-8 space-y-6">
        <canvas id="cardSnowRegister" class="pointer-events-none absolute inset-0 w-full h-full z-0"></canvas>

        <div class="relative z-10 text-center space-y-2">
            <div class="w-10 h-10 rounded-2xl bg-nordic mx-auto flex items-center justify-center text-white shadow-sm">
                <div class="grid grid-cols-2 gap-0.5">
                    <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                    <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                    <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                    <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                </div>
            </div>
            <h2 class="text-xl font-extrabold text-nordic">Create Workspace</h2>
            <p class="text-xs text-pine">Set up your institution's EduCore SaaS portal with a Gmail account.</p>
        </div>

        @if ($errors->any())
            <div class="relative z-10 p-3 bg-rose-50 border border-rose-200 text-rose-700 rounded-xl text-xs">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('auth.register.store') }}" method="POST" class="relative z-10 space-y-4">
            @csrf
            <div>
                <label class="block text-[11px] font-bold text-nordic uppercase tracking-wider mb-1">
                    Institution / Workspace Name
                </label>
                <input
                    type="text"
                    name="workspace_name"
                    required
                    maxlength="120"
                    placeholder="Enter your institution"
                    value="{{ old('workspace_name') }}"
                    class="w-full px-3.5 py-2.5 bg-frost/70 border border-glacier rounded-xl text-xs text-nordic focus:outline-none focus:ring-2 focus:ring-nordic/40 shadow-inner"
                >
            </div>

            <div>
                <label class="block text-[11px] font-bold text-nordic uppercase tracking-wider mb-1">
                    Administrator Name
                </label>
                <input
                    type="text"
                    name="admin_name"
                    required
                    maxlength="120"
                    placeholder="Enter your name"
                    value="{{ old('admin_name') }}"
                    class="w-full px-3.5 py-2.5 bg-frost/70 border border-glacier rounded-xl text-xs text-nordic focus:outline-none focus:ring-2 focus:ring-nordic/40 shadow-inner"
                >
            </div>

            <div>
                <label class="block text-[11px] font-bold text-nordic uppercase tracking-wider mb-1">
                    Email Address (@gmail.com)
                </label>
                <input
                    type="email"
                    name="email"
                    required
                    autocomplete="email"
                    pattern="^[A-Za-z0-9._%+-]+@gmail\.com$"
                    title="Must be a valid @gmail.com email address"
                    placeholder="name@gmail.com"
                    value="{{ old('email') }}"
                    class="w-full px-3.5 py-2.5 bg-frost/70 border border-glacier rounded-xl text-xs text-nordic focus:outline-none focus:ring-2 focus:ring-nordic/40 shadow-inner"
                >
            </div>

            <div>
                <label class="block text-[11px] font-bold text-nordic uppercase tracking-wider mb-1">
                    Password
                </label>
                <div class="relative">
                    <input
                        type="password"
                        name="password"
                        id="register-password"
                        required
                        autocomplete="new-password"
                        minlength="8"
                        maxlength="128"
                        placeholder="Enter password (min 8 characters)"
                        class="w-full px-3.5 py-2.5 bg-frost/70 border border-glacier rounded-xl text-xs text-nordic focus:outline-none focus:ring-2 focus:ring-nordic/40 shadow-inner pr-10"
                    >
                    <button
                        type="button"
                        onclick="togglePassword('register-password', 'register-eye-icon')"
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-pine hover:text-nordic transition"
                        aria-label="Toggle password visibility"
                    >
                        <svg id="register-eye-icon" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>
            </div>

            <div>
                <label class="block text-[11px] font-bold text-nordic uppercase tracking-wider mb-1">
                    Confirm Password
                </label>
                <input
                    type="password"
                    name="password_confirmation"
                    required
                    autocomplete="new-password"
                    minlength="8"
                    maxlength="128"
                    placeholder="Re-enter password"
                    class="w-full px-3.5 py-2.5 bg-frost/70 border border-glacier rounded-xl text-xs text-nordic focus:outline-none focus:ring-2 focus:ring-nordic/40 shadow-inner"
                >
            </div>

            <button type="submit" class="w-full py-3 bg-nordic text-white rounded-xl text-xs font-bold hover:bg-[#235673] transition shadow-sm">
                Initialize Workspace
            </button>
        </form>

        <p class="relative z-10 text-center text-xs text-pine">
            Already have a workspace?
            <a href="{{ route('login') }}" class="font-bold text-nordic hover:underline">Log In</a>
        </p>
    </div>

    <script>
        function togglePassword(fieldId, iconId) {
            const field = document.getElementById(fieldId);
            const icon = document.getElementById(iconId);
            if (!field || !icon) return;
            if (field.type === 'password') {
                field.type = 'text';
                icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.05 10.05 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />`;
            } else {
                field.type = 'password';
                icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />`;
            }
        }

        (function initCardSnow() {
            const canvas = document.getElementById('cardSnowRegister');
            const card = canvas ? canvas.parentElement : null;
            if (!canvas || !card) return;
            const ctx = canvas.getContext('2d');
            let width = 0;
            let height = 0;
            const flakes = Array.from({ length: 24 }, () => ({
                x: Math.random() * 450,
                y: Math.random() * 620,
                r: 1.2 + Math.random() * 2,
                vy: 0.3 + Math.random() * 0.55,
                vx: -0.2 + Math.random() * 0.4,
                alpha: 0.35 + Math.random() * 0.45,
            }));

            function resize() {
                width = canvas.width = card.clientWidth;
                height = canvas.height = card.clientHeight;
            }
            resize();
            window.addEventListener('resize', resize);

            function tick() {
                ctx.clearRect(0, 0, width, height);
                for (const f of flakes) {
                    f.x += f.vx;
                    f.y += f.vy;
                    if (f.y > height) {
                        f.y = -4;
                        f.x = Math.random() * width;
                    }
                    if (f.x < 0) f.x = width;
                    if (f.x > width) f.x = 0;

                    ctx.beginPath();
                    ctx.arc(f.x, f.y, f.r, 0, Math.PI * 2);
                    ctx.fillStyle = `rgba(173, 198, 214, ${f.alpha})`;
                    ctx.fill();
                }
                requestAnimationFrame(tick);
            }
            tick();
        })();
    </script>
</body>
</html>
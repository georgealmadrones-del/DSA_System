<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Workspace — EduCore SaaS</title>
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
<body class="bg-midnight text-slate-200 font-sans antialiased min-h-screen flex items-center justify-center p-6 selection:bg-candlelight/30 selection:text-candlelight relative overflow-x-hidden">
    <div class="pointer-events-none fixed inset-0 bg-[radial-gradient(ellipse_at_top,_rgba(69,114,171,0.22),_transparent_65%),radial-gradient(ellipse_at_bottom,_rgba(218,169,133,0.08),_transparent_60%)] z-0"></div>

    <div class="pointer-events-none fixed inset-x-0 bottom-0 h-14 z-10 overflow-hidden">
        <svg class="w-full h-full" viewBox="0 0 1440 80" preserveAspectRatio="none" fill="none">
            <path d="M0 42C240 16 480 62 760 36C1020 12 1240 54 1440 28V80H0V42Z" fill="#273B5C" fill-opacity="0.45"/>
            <path d="M0 56C320 38 620 70 960 48C1180 34 1330 62 1440 50V80H0V56Z" fill="#E8F1F8" fill-opacity="0.1"/>
        </svg>
    </div>

    <div class="relative z-20 overflow-hidden max-w-md w-full bg-gradient-to-b from-deepnavy/95 to-midnight/95 backdrop-blur-md rounded-3xl border border-twilight shadow-2xl shadow-black/50 p-8 space-y-6">
        <canvas id="cardSnowRegister" class="pointer-events-none absolute inset-0 w-full h-full z-0"></canvas>

        <div class="relative z-10 text-center space-y-2">
            <div class="w-10 h-10 rounded-2xl bg-midnight border border-starlight/50 mx-auto flex items-center justify-center text-candlelight shadow-md">
                <div class="grid grid-cols-2 gap-0.5">
                    <span class="w-1.5 h-1.5 bg-candlelight rounded-full"></span>
                    <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                    <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                    <span class="w-1.5 h-1.5 bg-candlelight rounded-full"></span>
                </div>
            </div>
            <h2 class="text-xl font-extrabold text-white">Create your workspace</h2>
            <p class="text-xs text-slate-300">Start a student records space with your Gmail account.</p>
        </div>

        @if ($errors->any())
            <div class="relative z-10 p-3 bg-rose-950/70 border border-rose-500/40 text-rose-200 rounded-xl text-xs">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('auth.register.store') }}" method="POST" class="relative z-10 space-y-4">
            @csrf
            <div>
                <label class="block text-[11px] font-bold text-candlelight uppercase tracking-wider mb-1">
                    School or Department Name
                </label>
                <input
                    type="text"
                    name="workspace_name"
                    required
                    maxlength="120"
                    placeholder="e.g. BSIT Department"
                    value="{{ old('workspace_name') }}"
                    class="w-full px-3.5 py-2.5 bg-midnight/85 border border-twilight rounded-xl text-xs text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-candlelight/40 shadow-inner"
                >
            </div>

            <div>
                <label class="block text-[11px] font-bold text-candlelight uppercase tracking-wider mb-1">
                    Your Name
                </label>
                <input
                    type="text"
                    name="admin_name"
                    required
                    maxlength="120"
                    placeholder="Full name"
                    value="{{ old('admin_name') }}"
                    class="w-full px-3.5 py-2.5 bg-midnight/85 border border-twilight rounded-xl text-xs text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-candlelight/40 shadow-inner"
                >
            </div>

            <div>
                <label class="block text-[11px] font-bold text-candlelight uppercase tracking-wider mb-1">
                    Gmail Address
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
                    class="w-full px-3.5 py-2.5 bg-midnight/85 border border-twilight rounded-xl text-xs text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-candlelight/40 shadow-inner"
                >
            </div>

            <div>
                <label class="block text-[11px] font-bold text-candlelight uppercase tracking-wider mb-1">
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
                        placeholder="At least 8 characters"
                        class="w-full px-3.5 py-2.5 bg-midnight/85 border border-twilight rounded-xl text-xs text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-candlelight/40 shadow-inner pr-10"
                    >
                    <button
                        type="button"
                        onclick="togglePassword('register-password', 'register-eye-icon')"
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-candlelight transition"
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
                <label class="block text-[11px] font-bold text-candlelight uppercase tracking-wider mb-1">
                    Confirm Password
                </label>
                <input
                    type="password"
                    name="password_confirmation"
                    required
                    autocomplete="new-password"
                    minlength="8"
                    maxlength="128"
                    placeholder="Type it again"
                    class="w-full px-3.5 py-2.5 bg-midnight/85 border border-twilight rounded-xl text-xs text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-candlelight/40 shadow-inner"
                >
            </div>

            <button type="submit" class="w-full py-3 bg-candlelight text-midnight rounded-xl text-xs font-extrabold hover:bg-[#e5ba99] transition shadow-lg shadow-candlelight/20">
                Create workspace
            </button>
        </form>

        <p class="relative z-10 text-center text-xs text-slate-300">
            Already have an account?
            <a href="{{ route('login') }}" class="font-bold text-candlelight hover:underline">Log in</a>
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
            const flakes = Array.from({ length: 24 }, (_, idx) => ({
                x: Math.random() * 450,
                y: Math.random() * 620,
                size: 4 + Math.random() * 5,
                vy: 0.35 + Math.random() * 0.6,
                vx: -0.25 + Math.random() * 0.5,
                angle: Math.random() * Math.PI * 2,
                spin: -0.01 + Math.random() * 0.02,
                alpha: 0.4 + Math.random() * 0.35,
                warm: idx % 6 === 0,
            }));

            function resize() {
                width = canvas.width = card.clientWidth;
                height = canvas.height = card.clientHeight;
            }
            resize();
            window.addEventListener('resize', resize);

            function drawFlake(f) {
                ctx.save();
                ctx.translate(f.x, f.y);
                if (f.warm) {
                    const grad = ctx.createRadialGradient(0, 0, 0.5, 0, 0, f.size * 1.3);
                    grad.addColorStop(0, `rgba(255, 243, 220, ${f.alpha})`);
                    grad.addColorStop(0.55, `rgba(218, 169, 133, ${f.alpha * 0.5})`);
                    grad.addColorStop(1, 'rgba(218, 169, 133, 0)');
                    ctx.fillStyle = grad;
                    ctx.beginPath();
                    ctx.arc(0, 0, f.size * 1.3, 0, Math.PI * 2);
                    ctx.fill();
                    ctx.restore();
                    return;
                }
                ctx.rotate(f.angle);
                ctx.strokeStyle = `rgba(226, 239, 250, ${f.alpha})`;
                ctx.lineWidth = 1.1;
                const r = f.size;
                for (let i = 0; i < 6; i++) {
                    ctx.save();
                    ctx.rotate((i * Math.PI) / 3);
                    ctx.beginPath();
                    ctx.moveTo(0, 0);
                    ctx.lineTo(0, -r);
                    ctx.moveTo(0, -r * 0.55);
                    ctx.lineTo(-r * 0.25, -r * 0.78);
                    ctx.moveTo(0, -r * 0.55);
                    ctx.lineTo(r * 0.25, -r * 0.78);
                    ctx.stroke();
                    ctx.restore();
                }
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
                    drawFlake(f);
                }
                requestAnimationFrame(tick);
            }
            tick();
        })();
    </script>
</body>
</html>
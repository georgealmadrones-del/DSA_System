<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In — EduCore SaaS</title>
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

    <div class="relative z-10 overflow-hidden max-w-md w-full bg-deepnavy/95 rounded-3xl border border-twilight shadow-2xl shadow-black/50 p-8 space-y-6">
        <canvas id="cardSnowLogin" class="pointer-events-none absolute inset-0 w-full h-full z-0"></canvas>

        <div class="relative z-10 text-center space-y-2">
            <div class="w-10 h-10 rounded-2xl bg-midnight border border-starlight/50 mx-auto flex items-center justify-center text-candlelight shadow-sm">
                <div class="grid grid-cols-2 gap-0.5">
                    <span class="w-1.5 h-1.5 bg-candlelight rounded-full"></span>
                    <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                    <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                    <span class="w-1.5 h-1.5 bg-candlelight rounded-full"></span>
                </div>
            </div>
            <h2 class="text-xl font-extrabold text-white">Welcome Back</h2>
            <p class="text-xs text-slate-300">
                Log in to your academic workspace with your <span class="font-bold text-candlelight">@gmail.com</span> email.
            </p>
            <p class="text-[11px] text-candlelight/75">&#10023; Happy holidays &mdash; Winter Term Workspace</p>
        </div>

        @if (session('status'))
            <div class="relative z-10 p-3 bg-midnight/90 border border-starlight/50 text-candlelight rounded-xl text-xs font-medium">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->has('email') || $errors->has('password'))
            <div class="relative z-10 p-3 bg-rose-950/70 border border-rose-500/40 text-rose-200 rounded-xl text-xs">
                {{ $errors->first('email') ?: $errors->first('password') }}
            </div>
        @endif

        <form action="{{ route('auth.login.store') }}" method="POST" class="relative z-10 space-y-4">
            @csrf
            <div>
                <label class="block text-[11px] font-bold text-candlelight uppercase tracking-wider mb-1">
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
                        id="login-password"
                        required
                        autocomplete="current-password"
                        minlength="8"
                        maxlength="128"
                        placeholder="Enter your password"
                        class="w-full px-3.5 py-2.5 bg-midnight/85 border border-twilight rounded-xl text-xs text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-candlelight/40 shadow-inner pr-10"
                    >
                    <button
                        type="button"
                        onclick="togglePassword('login-password', 'login-eye-icon')"
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-candlelight transition"
                        aria-label="Toggle password visibility"
                    >
                        <svg id="login-eye-icon" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>
            </div>

            <div class="flex items-center justify-between pt-0.5">
                <label class="inline-flex items-center space-x-2 cursor-pointer select-none">
                    <input
                        type="checkbox"
                        name="remember"
                        value="1"
                        {{ old('remember') ? 'checked' : '' }}
                        class="w-3.5 h-3.5 rounded border-twilight bg-midnight text-candlelight focus:ring-candlelight/40"
                    >
                    <span class="text-xs text-slate-300 font-medium">Remember me</span>
                </label>
                <button
                    type="button"
                    onclick="openForgotModal()"
                    class="text-xs font-bold text-candlelight hover:underline"
                >
                    Forgot password?
                </button>
            </div>

            <button type="submit" class="w-full py-3 bg-candlelight text-midnight rounded-xl text-xs font-extrabold hover:bg-[#e5ba99] transition shadow-md shadow-candlelight/15">
                Log In
            </button>
        </form>

        <p class="relative z-10 text-center text-xs text-slate-300">
            Don't have an institution workspace?
            <a href="{{ route('register') }}" class="font-bold text-candlelight hover:underline">Register</a>
        </p>
    </div>

    <!-- Forgot Password Modal -->
    <div id="forgotModal" class="fixed inset-0 bg-black/65 backdrop-blur-sm {{ ($errors->has('reset_email') || $errors->has('reset_code') || $errors->has('new_password') || session('open_forgot_modal')) ? '' : 'hidden' }} flex items-center justify-center p-4 z-50">
        <div class="bg-deepnavy rounded-3xl max-w-md w-full p-6 shadow-2xl border border-twilight space-y-4">
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="text-base font-bold text-white">Reset Password</h3>
                    <p class="text-[11px] text-slate-300">Verify a 6-digit code sent to your Gmail before changing your password.</p>
                </div>
                <button type="button" onclick="closeForgotModal()" class="text-slate-400 hover:text-candlelight text-sm font-bold px-2">X</button>
            </div>

            @if (session('reset_notice'))
                <div class="p-3 bg-midnight border border-starlight/50 text-candlelight rounded-xl text-xs space-y-1">
                    <p>{{ session('reset_notice') }}</p>
                </div>
            @endif

            @if ($errors->has('reset_email') || $errors->has('reset_code') || $errors->has('new_password'))
                <div class="p-3 bg-rose-950/70 border border-rose-500/40 text-rose-200 rounded-xl text-xs">
                    {{ $errors->first('reset_email') ?: ($errors->first('reset_code') ?: $errors->first('new_password')) }}
                </div>
            @endif

            <form action="{{ route('auth.password.code') }}" method="POST" class="space-y-3 pb-3 border-b border-twilight">
                @csrf
                <div>
                    <label class="block text-[11px] font-bold text-candlelight uppercase tracking-wider mb-1">
                        Account Email (@gmail.com)
                    </label>
                    <div class="flex space-x-2">
                        <input
                            type="email"
                            id="reset-email-input"
                            name="reset_email"
                            required
                            autocomplete="email"
                            pattern="^[A-Za-z0-9._%+-]+@gmail\.com$"
                            title="Must be a valid @gmail.com email address"
                            placeholder="name@gmail.com"
                            value="{{ old('reset_email', old('email')) }}"
                            class="flex-1 px-3.5 py-2.5 bg-midnight/85 border border-twilight rounded-xl text-xs text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-candlelight/40 shadow-inner"
                        >
                        <button type="submit" class="px-3.5 py-2.5 bg-midnight hover:bg-twilight text-candlelight border border-twilight rounded-xl text-xs font-bold transition shrink-0">
                            Send Code
                        </button>
                    </div>
                </div>
            </form>

            <form action="{{ route('auth.password.reset') }}" method="POST" onsubmit="syncResetEmail()" class="space-y-3">
                @csrf
                <input type="hidden" id="reset-email-hidden" name="reset_email" value="{{ old('reset_email', old('email')) }}">

                <div>
                    <label class="block text-[11px] font-bold text-candlelight uppercase tracking-wider mb-1">
                        6-Digit Verification Code
                    </label>
                    <input
                        type="text"
                        name="reset_code"
                        required
                        inputmode="numeric"
                        pattern="[0-9]{6}"
                        maxlength="6"
                        placeholder="123456"
                        value="{{ old('reset_code') }}"
                        class="w-full px-3.5 py-2.5 bg-midnight/85 border border-twilight rounded-xl text-xs text-white font-mono tracking-widest focus:outline-none focus:ring-2 focus:ring-candlelight/40 shadow-inner"
                    >
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-candlelight uppercase tracking-wider mb-1">
                        New Password
                    </label>
                    <div class="relative">
                        <input
                            type="password"
                            name="new_password"
                            id="reset-new-password"
                            required
                            autocomplete="new-password"
                            minlength="8"
                            maxlength="128"
                            placeholder="Enter new password (min 8 characters)"
                            class="w-full px-3.5 py-2.5 bg-midnight/85 border border-twilight rounded-xl text-xs text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-candlelight/40 shadow-inner pr-10"
                        >
                        <button
                            type="button"
                            onclick="togglePassword('reset-new-password', 'reset-eye-1')"
                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-candlelight transition"
                            aria-label="Toggle new password visibility"
                        >
                            <svg id="reset-eye-1" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-candlelight uppercase tracking-wider mb-1">
                        Confirm New Password
                    </label>
                    <input
                        type="password"
                        name="new_password_confirmation"
                        required
                        autocomplete="new-password"
                        minlength="8"
                        maxlength="128"
                        placeholder="Re-enter new password"
                        class="w-full px-3.5 py-2.5 bg-midnight/85 border border-twilight rounded-xl text-xs text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-candlelight/40 shadow-inner"
                    >
                </div>

                <div class="flex justify-end space-x-2 pt-2">
                    <button type="button" onclick="closeForgotModal()" class="px-4 py-2 bg-midnight text-slate-200 border border-twilight rounded-xl text-xs font-semibold">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 bg-candlelight text-midnight rounded-xl text-xs font-extrabold hover:bg-[#e5ba99] transition shadow-sm">
                        Update Password
                    </button>
                </div>
            </form>
        </div>
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

        function openForgotModal() {
            const loginEmail = document.querySelector('input[name="email"]')?.value || '';
            const resetEmailInput = document.getElementById('reset-email-input');
            if (resetEmailInput && !resetEmailInput.value && loginEmail) {
                resetEmailInput.value = loginEmail;
            }
            document.getElementById('forgotModal').classList.remove('hidden');
        }

        function closeForgotModal() {
            document.getElementById('forgotModal').classList.add('hidden');
        }

        function syncResetEmail() {
            const visibleEmail = document.getElementById('reset-email-input')?.value || '';
            const hiddenEmail = document.getElementById('reset-email-hidden');
            if (hiddenEmail) {
                hiddenEmail.value = visibleEmail.trim();
            }
        }

        (function initCardSnow() {
            const canvas = document.getElementById('cardSnowLogin');
            const card = canvas ? canvas.parentElement : null;
            if (!canvas || !card) return;
            const ctx = canvas.getContext('2d');
            let width = 0;
            let height = 0;
            const flakes = Array.from({ length: 22 }, (_, idx) => ({
                x: Math.random() * 450,
                y: Math.random() * 520,
                size: 4 + Math.random() * 4.5,
                vy: 0.3 + Math.random() * 0.55,
                vx: -0.2 + Math.random() * 0.4,
                angle: Math.random() * Math.PI * 2,
                spin: -0.01 + Math.random() * 0.02,
                alpha: 0.35 + Math.random() * 0.35,
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
                ctx.rotate(f.angle);
                ctx.strokeStyle = f.warm ? `rgba(218, 169, 133, ${f.alpha})` : `rgba(226, 239, 250, ${f.alpha})`;
                ctx.lineWidth = 1;
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
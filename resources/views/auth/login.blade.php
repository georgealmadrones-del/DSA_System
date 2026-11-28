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
        <canvas id="cardSnowLogin" class="pointer-events-none absolute inset-0 w-full h-full z-0"></canvas>

        <div class="relative z-10 text-center space-y-2">
            <div class="w-10 h-10 rounded-2xl bg-nordic mx-auto flex items-center justify-center text-white shadow-sm">
                <div class="grid grid-cols-2 gap-0.5">
                    <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                    <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                    <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                    <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                </div>
            </div>
            <h2 class="text-xl font-extrabold text-nordic">Welcome Back</h2>
            <p class="text-xs text-pine">
                Log in to your academic workspace with your <span class="font-bold text-nordic">@gmail.com</span> email.
            </p>
        </div>

        @if (session('status'))
            <div class="relative z-10 p-3 bg-frost border border-glacier text-nordic rounded-xl text-xs font-medium">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->has('email') || $errors->has('password'))
            <div class="relative z-10 p-3 bg-rose-50 border border-rose-200 text-rose-700 rounded-xl text-xs">
                {{ $errors->first('email') ?: $errors->first('password') }}
            </div>
        @endif

        <form action="{{ route('auth.login.store') }}" method="POST" class="relative z-10 space-y-4">
            @csrf
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
                        id="login-password"
                        required
                        autocomplete="current-password"
                        minlength="8"
                        maxlength="128"
                        placeholder="Enter your password"
                        class="w-full px-3.5 py-2.5 bg-frost/70 border border-glacier rounded-xl text-xs text-nordic focus:outline-none focus:ring-2 focus:ring-nordic/40 shadow-inner pr-10"
                    >
                    <button
                        type="button"
                        onclick="togglePassword('login-password', 'login-eye-icon')"
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-pine hover:text-nordic transition"
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
                        class="w-3.5 h-3.5 rounded border-glacier text-nordic focus:ring-nordic/40"
                    >
                    <span class="text-xs text-pine font-medium">Remember me</span>
                </label>
                <button
                    type="button"
                    onclick="openForgotModal()"
                    class="text-xs font-bold text-nordic hover:underline"
                >
                    Forgot password?
                </button>
            </div>

            <button type="submit" class="w-full py-3 bg-nordic text-white rounded-xl text-xs font-bold hover:bg-[#235673] transition shadow-sm">
                Log In
            </button>
        </form>

        <p class="relative z-10 text-center text-xs text-pine">
            Don't have an institution workspace?
            <a href="{{ route('register') }}" class="font-bold text-nordic hover:underline">Register</a>
        </p>
    </div>

    <!-- Forgot Password Modal -->
    <div id="forgotModal" class="fixed inset-0 bg-nordic/35 backdrop-blur-sm {{ ($errors->has('reset_email') || $errors->has('reset_code') || $errors->has('new_password') || session('open_forgot_modal')) ? '' : 'hidden' }} flex items-center justify-center p-4 z-50">
        <div class="bg-white rounded-3xl max-w-md w-full p-6 shadow-xl border border-glacier space-y-4">
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="text-base font-bold text-nordic">Reset Password</h3>
                    <p class="text-[11px] text-pine">Verify a 6-digit code sent to your Gmail before changing your password.</p>
                </div>
                <button type="button" onclick="closeForgotModal()" class="text-pine hover:text-nordic text-sm font-bold px-2">X</button>
            </div>

            @if (session('reset_notice'))
                <div class="p-3 bg-frost border border-glacier text-nordic rounded-xl text-xs space-y-1">
                    <p>{{ session('reset_notice') }}</p>
                </div>
            @endif

            @if ($errors->has('reset_email') || $errors->has('reset_code') || $errors->has('new_password'))
                <div class="p-3 bg-rose-50 border border-rose-200 text-rose-700 rounded-xl text-xs">
                    {{ $errors->first('reset_email') ?: ($errors->first('reset_code') ?: $errors->first('new_password')) }}
                </div>
            @endif

            <form action="{{ route('auth.password.code') }}" method="POST" class="space-y-3 pb-3 border-b border-glacier/60">
                @csrf
                <div>
                    <label class="block text-[11px] font-bold text-nordic uppercase tracking-wider mb-1">
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
                            class="flex-1 px-3.5 py-2.5 bg-frost/70 border border-glacier rounded-xl text-xs text-nordic focus:outline-none focus:ring-2 focus:ring-nordic/40 shadow-inner"
                        >
                        <button type="submit" class="px-3.5 py-2.5 bg-frost hover:bg-glacier/40 text-nordic border border-glacier rounded-xl text-xs font-bold transition shrink-0">
                            Send Code
                        </button>
                    </div>
                </div>
            </form>

            <form action="{{ route('auth.password.reset') }}" method="POST" onsubmit="syncResetEmail()" class="space-y-3">
                @csrf
                <input type="hidden" id="reset-email-hidden" name="reset_email" value="{{ old('reset_email', old('email')) }}">

                <div>
                    <label class="block text-[11px] font-bold text-nordic uppercase tracking-wider mb-1">
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
                        class="w-full px-3.5 py-2.5 bg-frost/70 border border-glacier rounded-xl text-xs text-nordic font-mono tracking-widest focus:outline-none focus:ring-2 focus:ring-nordic/40 shadow-inner"
                    >
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-nordic uppercase tracking-wider mb-1">
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
                            class="w-full px-3.5 py-2.5 bg-frost/70 border border-glacier rounded-xl text-xs text-nordic focus:outline-none focus:ring-2 focus:ring-nordic/40 shadow-inner pr-10"
                        >
                        <button
                            type="button"
                            onclick="togglePassword('reset-new-password', 'reset-eye-1')"
                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-pine hover:text-nordic transition"
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
                    <label class="block text-[11px] font-bold text-nordic uppercase tracking-wider mb-1">
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
                        class="w-full px-3.5 py-2.5 bg-frost/70 border border-glacier rounded-xl text-xs text-nordic focus:outline-none focus:ring-2 focus:ring-nordic/40 shadow-inner"
                    >
                </div>

                <div class="flex justify-end space-x-2 pt-2">
                    <button type="button" onclick="closeForgotModal()" class="px-4 py-2 bg-frost text-nordic border border-glacier rounded-xl text-xs font-semibold">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 bg-nordic text-white rounded-xl text-xs font-bold hover:bg-[#235673] transition shadow-sm">
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
            const flakes = Array.from({ length: 24 }, () => ({
                x: Math.random() * 450,
                y: Math.random() * 520,
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
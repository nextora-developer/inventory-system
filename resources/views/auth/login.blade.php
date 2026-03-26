<x-guest-layout>
    <div class="min-h-screen flex bg-white">

        {{-- LEFT SIDE (FORM) --}}
        <div class="w-full md:w-[45%] lg:w-[40%] flex items-center justify-center px-8 lg:px-20">
            <div class="w-full max-w-sm">
                
                <div class="mb-10 flex items-center gap-2">
                    <div class="h-10 w-10 rounded-xl bg-gradient-to-tr from-[#8b5cf6] to-[#6d28d9] flex items-center justify-center text-white shadow-lg shadow-indigo-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" /></svg>
                    </div>
                    <span class="text-xl font-bold tracking-tight text-gray-900">INVENTORY<span class="text-[#8b5cf6]"> PRO MAX</span></span>
                </div>

                <div class="mb-8">
                    <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Welcome Back</h2>
                    <p class="text-gray-500 mt-2 text-sm">Please enter your details to access your inventory.</p>
                </div>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    {{-- Email --}}
                    <div class="space-y-1">
                        <label class="text-xs font-bold uppercase tracking-wider text-gray-500 ml-1">Email Address</label>
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus
                            placeholder="name@company.com"
                            class="w-full px-4 py-3.5 rounded-2xl bg-gray-50 border-gray-100 border-2 focus:bg-white focus:border-[#8b5cf6] focus:ring-4 focus:ring-[#8b5cf6]/10 transition-all duration-200 text-sm outline-none">
                        <x-input-error :messages="$errors->get('email')" class="mt-1" />
                    </div>

                    {{-- Password --}}
                    <div class="space-y-1">
                        <div class="flex justify-between items-center ml-1">
                            <label class="text-xs font-bold uppercase tracking-wider text-gray-500">Password</label>
                        </div>
                        <input type="password" name="password" required
                            placeholder="••••••••"
                            class="w-full px-4 py-3.5 rounded-2xl bg-gray-50 border-gray-100 border-2 focus:bg-white focus:border-[#8b5cf6] focus:ring-4 focus:ring-[#8b5cf6]/10 transition-all duration-200 text-sm outline-none">
                        <x-input-error :messages="$errors->get('password')" class="mt-1" />
                    </div>

                    {{-- Remember & Forgot --}}
                    <div class="flex items-center justify-between text-sm">
                        <label class="flex items-center gap-2 cursor-pointer group">
                            <input type="checkbox" name="remember" class="w-4 h-4 rounded border-gray-300 text-[#8b5cf6] focus:ring-[#8b5cf6] transition cursor-pointer">
                            <span class="text-gray-600 group-hover:text-gray-900 transition">Remember me</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a href="" class="font-semibold text-[#8b5cf6] hover:text-[#7c3aed] transition">
                                Forgot password?
                            </a>
                        @endif
                    </div>

                    {{-- BUTTON --}}
                    <button type="submit"
                        class="w-full py-4 rounded-2xl bg-[#8b5cf6] text-white font-bold shadow-lg shadow-indigo-200 hover:bg-[#7c3aed] hover:shadow-indigo-300 transform active:scale-[0.98] transition-all duration-200">
                        Sign In
                    </button>
                </form>

                {{-- REGISTER --}}
                {{-- <p class="text-sm text-gray-500 mt-8 text-center">
                    Don't have an account?
                    <a href="#" class="text-[#8b5cf6] font-bold hover:underline underline-offset-4">Create account</a>
                </p> --}}
            </div>
        </div>

        {{-- RIGHT SIDE (VISUAL) --}}
        <div class="hidden md:flex flex-1 relative bg-[#0f172a] items-center justify-center overflow-hidden">
            <div class="absolute top-[-10%] right-[-10%] w-96 h-96 bg-[#8b5cf6]/20 rounded-full blur-[120px]"></div>
            <div class="absolute bottom-[-10%] left-[-10%] w-96 h-96 bg-blue-500/10 rounded-full blur-[120px]"></div>

            <div class="relative z-10 w-full max-w-lg px-10">
                <div class="bg-white/5 backdrop-blur-2xl border border-white/10 rounded-3xl p-8 shadow-2xl">
                    <div class="flex items-center justify-between mb-8">
                        <div class="flex gap-2">
                            <div class="w-3 h-3 rounded-full bg-rose-500/50"></div>
                            <div class="w-3 h-3 rounded-full bg-amber-500/50"></div>
                            <div class="w-3 h-3 rounded-full bg-emerald-500/50"></div>
                        </div>
                        <div class="px-3 py-1 rounded-full bg-white/10 text-[10px] text-white/60 uppercase tracking-widest font-bold">Stock Insights</div>
                    </div>
                    
                    <div class="space-y-6">
                        <div class="flex items-end gap-3">
                            <div class="flex-1 h-32 bg-gradient-to-t from-[#8b5cf6] to-[#c084fc] rounded-xl opacity-80 animate-pulse"></div>
                            <div class="flex-1 h-48 bg-gradient-to-t from-[#8b5cf6] to-[#c084fc] rounded-xl shadow-lg"></div>
                            <div class="flex-1 h-24 bg-gradient-to-t from-[#8b5cf6] to-[#c084fc] rounded-xl opacity-60"></div>
                            <div class="flex-1 h-40 bg-gradient-to-t from-[#8b5cf6] to-[#c084fc] rounded-xl opacity-90 animate-pulse" style="animation-delay: 1s"></div>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div class="h-16 rounded-2xl bg-white/5 border border-white/5 p-3">
                                <div class="w-8 h-2 bg-white/20 rounded mb-2"></div>
                                <div class="w-12 h-4 bg-white/40 rounded"></div>
                            </div>
                            <div class="h-16 rounded-2xl bg-white/5 border border-white/5 p-3">
                                <div class="w-8 h-2 bg-white/20 rounded mb-2"></div>
                                <div class="w-12 h-4 bg-white/40 rounded"></div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- TEXT --}}
                <div class="mt-12 text-center lg:text-left">
                    <h3 class="text-white text-2xl font-bold mb-4">Master Your Stock Levels</h3>
                    <p class="text-slate-400 leading-relaxed max-w-md">
                        Our intelligent inventory system helps you track movements, manage suppliers, and generate insights in real-time.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
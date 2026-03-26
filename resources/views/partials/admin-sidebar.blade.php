<aside
    class="hidden md:flex fixed left-0 top-0 h-screen w-72 flex-col bg-[#0b1120] text-slate-400 border-r border-white/5 shadow-2xl z-40">
    <div class="px-8 py-10">
        <a href="{{ route('dashboard') }}" class="group flex items-center gap-3.5">
            <div class="relative">
                <div
                    class="absolute -inset-1 rounded-xl bg-indigo-500/20 blur-sm group-hover:bg-indigo-500/30 transition">
                </div>
                <div
                    class="relative flex h-11 w-11 items-center justify-center rounded-xl bg-gradient-to-tr from-indigo-600 to-violet-500 text-white shadow-xl transition-transform duration-300 group-hover:scale-105 group-hover:rotate-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="m7.5 4.27 9 5.15" />
                        <path
                            d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z" />
                        <path d="m3.3 7 8.7 5 8.7-5" />
                        <path d="M12 22V12" />
                    </svg>
                </div>
            </div>
            <div>
                <h2 class="text-xl font-black tracking-tight text-white">EX<span
                        class="text-indigo-500 shadow-indigo-500/50">INVENTORY</span></h2>
                <div class="flex items-center gap-1.5">
                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                    <p class="text-[10px] font-bold uppercase tracking-[0.2em] text-slate-500">Live Server</p>
                </div>
            </div>
        </a>
    </div>

    <div class="flex-1 overflow-y-auto px-4 py-6 custom-scrollbar">
        <nav class="space-y-6">

            {{-- CORE --}}
            <div>
                <div class="px-4 mb-3">
                    <p class="text-[11px] font-bold uppercase tracking-[0.2em] text-slate-500">Core</p>
                </div>

                <div class="space-y-1">
                    <a href="{{ route('dashboard') }}"
                        class="group flex items-center gap-3 rounded-xl px-4 py-2.5 text-sm font-medium transition-all duration-200
                        {{ request()->routeIs('dashboard') ? 'bg-indigo-500/10 text-indigo-400 border-l-2 border-indigo-500 shadow-[inset_0_0_20px_rgba(99,102,241,0.05)]' : 'text-slate-400 hover:bg-white/5 hover:text-slate-200 border-l-2 border-transparent' }}">
                        <svg class="h-5 w-5 opacity-70 group-hover:opacity-100" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Dashboard
                    </a>
                </div>
            </div>

            {{-- INVENTORY --}}
            <div>
                <div class="px-4 mb-3">
                    <p class="text-[11px] font-bold uppercase tracking-[0.2em] text-slate-500">Inventory</p>
                </div>

                <div class="space-y-1">
                    @if (auth()->user()->role === 'admin')
                        <a href="{{ route('categories.index') }}"
                            class="group flex items-center gap-3 rounded-xl px-4 py-2.5 text-sm font-medium transition-all duration-200
                            {{ request()->routeIs('categories.*') ? 'bg-indigo-500/10 text-indigo-400 border-l-2 border-indigo-500' : 'text-slate-400 hover:bg-white/5 hover:text-slate-200 border-l-2 border-transparent' }}">
                            <svg class="h-5 w-5 opacity-70 group-hover:opacity-100" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                            </svg>
                            Categories
                        </a>

                        <a href="{{ route('suppliers.index') }}"
                            class="group flex items-center gap-3 rounded-xl px-4 py-2.5 text-sm font-medium transition-all duration-200
                            {{ request()->routeIs('suppliers.*') ? 'bg-indigo-500/10 text-indigo-400 border-l-2 border-indigo-500' : 'text-slate-400 hover:bg-white/5 hover:text-slate-200 border-l-2 border-transparent' }}">
                            
                            <svg class="h-5 w-5 opacity-70 group-hover:opacity-100" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                            </svg>

                            Suppliers
                        </a>
                    @endif

                    @if (in_array(auth()->user()->role, ['admin', 'manager']))
                        <a href="{{ route('products.index') }}"
                            class="group flex items-center gap-3 rounded-xl px-4 py-2.5 text-sm font-medium transition-all duration-200
                            {{ request()->routeIs('products.*') ? 'bg-indigo-500/10 text-indigo-400 border-l-2 border-indigo-500' : 'text-slate-400 hover:bg-white/5 hover:text-slate-200 border-l-2 border-transparent' }}">
                            <svg class="h-5 w-5 opacity-70 group-hover:opacity-100" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                            Products
                        </a>
                    @endif
                </div>
            </div>

            {{-- STOCK --}}
            <div>
                <div class="px-4 mb-3">
                    <p class="text-[11px] font-bold uppercase tracking-[0.2em] text-slate-500">Stock</p>
                </div>

                <div class="space-y-1">
                    @if (in_array(auth()->user()->role, ['admin', 'manager', 'staff', 'storekeeper']))
                        <a href="{{ route('stock.in') }}"
                            class="group flex items-center gap-3 rounded-xl px-4 py-2.5 text-sm font-medium transition-all duration-200
                            {{ request()->routeIs('stock.in*') ? 'bg-emerald-500/10 text-emerald-400 border-l-2 border-emerald-500' : 'text-slate-400 hover:bg-white/5 hover:text-slate-200 border-l-2 border-transparent' }}">
                            <svg class="h-5 w-5 opacity-70 group-hover:opacity-100" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Stock In
                        </a>

                        <a href="{{ route('stock.out') }}"
                            class="group flex items-center gap-3 rounded-xl px-4 py-2.5 text-sm font-medium transition-all duration-200
                            {{ request()->routeIs('stock.out*') ? 'bg-rose-500/10 text-rose-400 border-l-2 border-rose-500' : 'text-slate-400 hover:bg-white/5 hover:text-slate-200 border-l-2 border-transparent' }}">
                            <svg class="h-5 w-5 opacity-70 group-hover:opacity-100" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Stock Out
                        </a>
                    @endif

                    @if (auth()->user()->role === 'admin')
                        <a href="{{ route('stock-adjustments.index') }}"
                            class="group flex items-center gap-3 rounded-xl px-4 py-2.5 text-sm font-medium transition-all duration-200
                            {{ request()->routeIs('stock-adjustments.*') ? 'bg-indigo-500/10 text-indigo-400 border-l-2 border-indigo-500' : 'text-slate-400 hover:bg-white/5 hover:text-slate-200 border-l-2 border-transparent' }}">
                            <svg class="h-5 w-5 opacity-70 group-hover:opacity-100" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                            </svg>
                            Stock Adjustments
                        </a>
                    @endif
                </div>
            </div>

            {{-- REPORTS --}}
            @if (in_array(auth()->user()->role, ['admin', 'manager']))
                <div>
                    <div class="px-4 mb-3">
                        <p class="text-[11px] font-bold uppercase tracking-[0.2em] text-slate-500">Reports</p>
                    </div>

                    <div class="space-y-1">
                        <a href="{{ route('reports.current-stock') }}"
                            class="group flex items-center gap-3 rounded-xl px-4 py-2.5 text-sm font-medium transition-all duration-200
                            {{ request()->routeIs('reports.current-stock') ? 'bg-indigo-500/10 text-indigo-400 border-l-2 border-indigo-500' : 'text-slate-400 hover:bg-white/5 hover:text-slate-200 border-l-2 border-transparent' }}">
                            <svg class="h-5 w-5 opacity-70 group-hover:opacity-100" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 17v-6m4 6V7m4 10V3M3 17h18" />
                            </svg>
                            Current Stock
                        </a>

                        <a href="{{ route('reports.low-stock') }}"
                            class="group flex items-center gap-3 rounded-xl px-4 py-2.5 text-sm font-medium transition-all duration-200
                            {{ request()->routeIs('reports.low-stock') ? 'bg-rose-500/10 text-rose-400 border-l-2 border-rose-500' : 'text-slate-400 hover:bg-white/5 hover:text-slate-200 border-l-2 border-transparent' }}">
                            <svg class="h-5 w-5 opacity-70 group-hover:opacity-100" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M12 20h.01M4 4h16v16H4z" />
                            </svg>
                            Low Stock
                        </a>

                        <a href="{{ route('reports.stock-movement') }}"
                            class="group flex items-center gap-3 rounded-xl px-4 py-2.5 text-sm font-medium transition-all duration-200
                            {{ request()->routeIs('reports.stock-movement') ? 'bg-emerald-500/10 text-emerald-400 border-l-2 border-emerald-500' : 'text-slate-400 hover:bg-white/5 hover:text-slate-200 border-l-2 border-transparent' }}">
                            <svg class="h-5 w-5 opacity-70 group-hover:opacity-100" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 3v18h18M7 14l4-4 4 4 6-6" />
                            </svg>
                            Stock Movement
                        </a>
                    </div>
                </div>
            @endif

            {{-- ADMINISTRATION --}}
            @if (auth()->user()->role === 'admin')
                <div>
                    <div class="px-4 mb-3">
                        <p class="text-[11px] font-bold uppercase tracking-[0.2em] text-slate-500">Administration</p>
                    </div>

                    <div class="space-y-1">
                        <a href="{{ route('users.index') }}"
                            class="group flex items-center gap-3 rounded-xl px-4 py-2.5 text-sm font-medium transition-all duration-200
                            {{ request()->routeIs('users.*') ? 'bg-indigo-500/10 text-indigo-400 border-l-2 border-indigo-500' : 'text-slate-400 hover:bg-white/5 hover:text-slate-200 border-l-2 border-transparent' }}">
                            <svg class="h-5 w-5 opacity-70 group-hover:opacity-100" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            Users
                        </a>
                    </div>
                </div>
            @endif

        </nav>
    </div>

    <div class="p-4">
        <div
            class="relative overflow-hidden rounded-2xl bg-gradient-to-b from-white/[0.07] to-transparent p-px shadow-2xl ring-1 ring-white/10">
            <div class="relative flex items-center gap-3 rounded-[15px] bg-[#111827]/90 p-3 backdrop-blur-xl">
                <div class="group relative">
                    <img class="h-10 w-10 rounded-xl object-cover ring-2 ring-indigo-500/20 group-hover:ring-indigo-500/50 transition"
                        src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=6366f1&color=fff"
                        alt="Avatar">
                    <div
                        class="absolute -right-1 -top-1 h-3 w-3 rounded-full border-2 border-[#111827] bg-emerald-500">
                    </div>
                </div>

                <div class="min-w-0 flex-1">
                    <p class="truncate text-sm font-bold text-white">{{ auth()->user()->name }}</p>
                    <p class="truncate text-[10px] font-medium uppercase tracking-tight text-indigo-400/80">
                        {{ auth()->user()->role }}</p>
                </div>

                <form method="POST" action="{{ route('logout') }}" class="ml-1">
                    @csrf
                    <button type="submit"
                        class="flex h-8 w-8 items-center justify-center rounded-lg bg-white/5 text-slate-400 hover:bg-rose-500/20 hover:text-rose-400 transition-all active:scale-95">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                            <polyline points="16 17 21 12 16 7" />
                            <line x1="21" x2="9" y1="12" y2="12" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
</aside>

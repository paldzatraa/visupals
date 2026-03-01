<!DOCTYPE html>
<html lang="id" x-data="{ darkMode: localStorage.getItem('theme') === 'dark', loaded: false }" :class="{ 'dark': darkMode }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VISUPALS - Portfolio</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: { brand: '#f97316' },
                    fontFamily: { sans: ['Plus Jakarta Sans', 'sans-serif'] }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
        html { scroll-behavior: auto; }
        [x-cloak] { display: none !important; }

        @keyframes loading-bar {
            0% { transform: translateX(-100%); }
            50% { transform: translateX(0); }
            100% { transform: translateX(100%); }
        }
        .animate-loading { animation: loading-bar 1.5s infinite ease-in-out; }
    </style>
</head>
<body class="bg-gray-50 dark:bg-[#0a0a0a] text-gray-900 dark:text-gray-100 transition-colors duration-300 overflow-hidden" 
      :class="{ 'overflow-hidden': !loaded, 'overflow-auto': loaded }"
      x-init="window.addEventListener('load', () => { setTimeout(() => { loaded = true }, 800) })">

    <div x-show="!loaded" 
         x-transition:leave="transition ease-in duration-700"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-[200] flex flex-col items-center justify-center bg-white dark:bg-[#0a0a0a]">
        <div class="flex flex-col items-center gap-6">
            <div class="text-3xl font-bold tracking-tighter uppercase animate-pulse">
                visupals<span class="text-brand">.</span>
            </div>
            <div class="w-40 h-[2px] bg-gray-100 dark:bg-white/5 rounded-full overflow-hidden relative">
                <div class="absolute inset-0 bg-brand w-1/2 animate-loading"></div>
            </div>
            <p class="text-[10px] font-bold uppercase tracking-[0.4em] text-gray-400">Initializing Experience</p>
        </div>
    </div>

    <nav class="fixed w-full top-0 z-50 bg-white/80 dark:bg-[#0a0a0a]/80 backdrop-blur-md border-b border-gray-200 dark:border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="text-xl font-bold tracking-tighter uppercase">
                    <a href="{{ url('/') }}#home" onclick="{{ request()->is('/') ? "smoothScroll('#home', 800); return false;" : "" }}">visupals<span class="text-brand">.</span></a>
                </div>
                
                <div class="hidden lg:flex items-center space-x-6 xl:space-x-8">
                    <a href="{{ request()->is('/') ? '#about' : url('/#about') }}" onclick="{{ request()->is('/') ? "smoothScroll('#about', 800); return false;" : "" }}" class="text-[13px] font-medium hover:text-brand transition-colors">About</a>
                    <a href="{{ request()->is('/') ? '#apps' : url('/#apps') }}" onclick="{{ request()->is('/') ? "smoothScroll('#apps', 800); return false;" : "" }}" class="text-[13px] font-medium hover:text-brand transition-colors">Mastery</a>
                    <a href="{{ request()->is('/') ? '#education' : url('/#education') }}" onclick="{{ request()->is('/') ? "smoothScroll('#education', 800); return false;" : "" }}" class="text-[13px] font-medium hover:text-brand transition-colors">Education</a>
                    <a href="{{ request()->is('/') ? '#experience' : url('/#experience') }}" onclick="{{ request()->is('/') ? "smoothScroll('#experience', 800); return false;" : "" }}" class="text-[13px] font-medium hover:text-brand transition-colors">Experience</a>
                    <a href="{{ request()->is('/') ? '#portfolio' : url('/#portfolio') }}" onclick="{{ request()->is('/') ? "smoothScroll('#portfolio', 800); return false;" : "" }}" class="text-[13px] font-medium hover:text-brand transition-colors">Portfolio</a>
                    
                    <button @click="darkMode = !darkMode; localStorage.setItem('theme', darkMode ? 'dark' : 'light')" 
                            class="w-11 h-11 flex items-center justify-center rounded-full bg-gray-100 dark:bg-white/5 border border-gray-200 dark:border-white/10 hover:border-brand/40 transition-all group">
                        <svg x-show="!darkMode" class="w-5 h-5 text-gray-700 group-hover:text-brand transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
                        <svg x-show="darkMode" class="w-5 h-5 text-yellow-400 group-hover:text-brand transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 9h-1m15.364-6.364l-.707.707M6.343 17.657l-.707.707M16.243 17.657l.707-.707M7.757 7.757l.707-.707"></path></svg>
                    </button>
                    
                    <a href="{{ request()->is('/') ? '#contact' : url('/#contact') }}" onclick="{{ request()->is('/') ? "smoothScroll('#contact', 1000); return false;" : "" }}" class="px-5 py-2 bg-black dark:bg-white text-white dark:text-black rounded-full text-[13px] font-bold hover:scale-105 transition-transform">Contact</a>
                </div>

                <div class="lg:hidden flex items-center gap-4" x-data="{ open: false }">
                    <button @click="darkMode = !darkMode; localStorage.setItem('theme', darkMode ? 'dark' : 'light')" 
                            class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-100 dark:bg-white/5 border border-gray-200 dark:border-white/10 transition-all">
                        <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
                        <svg x-show="darkMode" class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 9h-1m15.364-6.364l-.707.707M6.343 17.657l-.707.707M16.243 17.657l.707-.707M7.757 7.757l.707-.707"></path></svg>
                    </button>
                    <button @click="open = !open" class="p-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 6h16M4 12h16m-7 6h7" stroke-width="2" stroke-linecap="round"/></svg>
                    </button>
                    <div x-show="open" x-cloak x-transition class="absolute top-20 left-0 w-full bg-white dark:bg-[#0a0a0a] border-b border-gray-200 dark:border-white/10 p-6 space-y-5 shadow-2xl">
                        <a href="{{ url('/') }}#about" @click="open = false; {{ request()->is('/') ? "smoothScroll('#about', 800); return false;" : "" }}" class="block font-medium">About</a>
                        <a href="{{ url('/') }}#apps" @click="open = false; {{ request()->is('/') ? "smoothScroll('#apps', 800); return false;" : "" }}" class="block font-medium">Mastery</a>
                        <a href="{{ url('/') }}#education" @click="open = false; {{ request()->is('/') ? "smoothScroll('#education', 800); return false;" : "" }}" class="block font-medium">Education</a>
                        <a href="{{ url('/') }}#experience" @click="open = false; {{ request()->is('/') ? "smoothScroll('#experience', 800); return false;" : "" }}" class="block font-medium">Experience</a>
                        <a href="{{ url('/') }}#portfolio" @click="open = false; {{ request()->is('/') ? "smoothScroll('#portfolio', 800); return false;" : "" }}" class="block font-medium">Portfolio</a>
                        <a href="{{ url('/') }}#contact" @click="open = false; {{ request()->is('/') ? "smoothScroll('#contact', 1000); return false;" : "" }}" class="block font-bold text-brand pt-2 border-t border-gray-100 dark:border-white/5">Contact</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <main>@yield('content')</main>

    <footer class="py-16 border-t border-gray-200 dark:border-white/10 bg-white dark:bg-[#0a0a0a] text-center">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
            <div class="text-2xl font-bold tracking-tighter uppercase">visupals<span class="text-brand">.</span></div>
        
            <div class="flex justify-center gap-5">
                <a href="https://instagram.com/nfldss" target="_blank" class="w-12 h-12 flex items-center justify-center rounded-2xl border border-gray-200 dark:border-white/10 text-gray-400 hover:text-brand hover:border-brand transition-all duration-300">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c.796 0 1.441.645 1.441 1.44s-.645 1.44-1.441 1.44c-.795 0-1.44-.645-1.44-1.44s.645-1.44 1.44-1.44z"/></svg>
                </a>
                <a href="https://tiktok.com/@palpicts" target="_blank" class="w-12 h-12 flex items-center justify-center rounded-2xl border border-gray-200 dark:border-white/10 text-gray-400 hover:text-brand hover:border-brand transition-all duration-300">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 448 512"><path d="M448,209.91a210.06,210.06,0,0,1-122.77-39.25V349.38A162.55,162.55,0,1,1,185,188.31V278.2a74.62,74.62,0,1,0,52.23,71.18V0l88,0a121.18,121.18,0,0,0,1.86,22.17h0A122.18,122.18,0,0,0,381,102.39a121.43,121.43,0,0,0,67,20.14Z"/></svg>
                </a>
                <a href="https://linkedin.com/in/naufalds" target="_blank" class="w-12 h-12 flex items-center justify-center rounded-2xl border border-gray-200 dark:border-white/10 text-gray-400 hover:text-brand hover:border-brand transition-all duration-300">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 448 512"><path d="M416 32H31.9C14.3 32 0 46.5 0 64.3v383.4C0 465.5 14.3 480 31.9 480H416c17.6 0 32-14.5 32-32.3V64.3c0-17.8-14.4-32.3-32.1-32.3zM135.4 416H69V202.2h66.5V416zm-33.2-243c-21.3 0-38.5-17.3-38.5-38.5S80.9 96 102.2 96c21.2 0 38.5 17.3 38.5 38.5 0 21.3-17.2 38.5-38.5 38.5zm282.1 243h-66.4V312c0-24.8-.5-56.7-34.5-56.7-34.6 0-39.9 27-39.9 54.9V416h-66.4V202.2h63.7v29.2h.9c8.9-16.8 30.6-34.5 62.9-34.5 67.2 0 79.7 44.3 79.7 101.9V416z"/></svg>
                </a>
            </div>

            <div class="space-y-2">
                <p class="text-[10px] text-gray-400 uppercase tracking-[0.3em]">&copy; {{ date('Y') }}, Naufal Dzaky S.</p>
                <p class="text-[10px] text-gray-400 uppercase tracking-[0.3em]">Crafted with precision using Laravel.</p>
            </div>
        </div>
    </footer>

    <script>
        function smoothScroll(target, duration) {
            const targetEl = document.querySelector(target);
            if (!targetEl) return;
            const targetPosition = targetEl.getBoundingClientRect().top + window.pageYOffset - 80;
            const startPosition = window.pageYOffset;
            const distance = targetPosition - startPosition;
            let startTime = null;
            function animation(currentTime) {
                if (startTime === null) startTime = currentTime;
                const timeElapsed = currentTime - startTime;
                const run = ease(timeElapsed, startPosition, distance, duration);
                window.scrollTo(0, run);
                if (timeElapsed < duration) requestAnimationFrame(animation);
            }
            function ease(t, b, c, d) {
                t /= d / 2;
                if (t < 1) return c / 2 * t * t + b;
                t--;
                return -c / 2 * (t * (t - 2) - 1) + b;
            }
            requestAnimationFrame(animation);
        }
    </script>
</body>
</html>
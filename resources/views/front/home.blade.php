@extends('layouts.app')

@section('content')
    <style>
        /* Tipografi Editorial Custom untuk Hero */
        .hero-title {
            font-size: clamp(4rem, 15vw, 11rem);
            line-height: 0.85;
            letter-spacing: -0.06em;
        }
        [x-cloak] { display: none !important; }
    </style>

    <section id="home" class="min-h-screen flex items-center justify-center pt-20 px-4 bg-gray-50 dark:bg-[#0a0a0a] relative overflow-hidden text-center">
        <div class="space-y-8 relative z-10 w-full max-w-7xl mx-auto flex flex-col items-center">
            <div class="inline-flex items-center gap-2.5 px-5 py-2 rounded-full border border-gray-200 dark:border-white/10 bg-white dark:bg-zinc-900 shadow-sm text-brand text-[10px] font-bold uppercase tracking-[0.2em]">
                <span class="w-2 h-2 rounded-full bg-brand animate-pulse"></span>
                Personal Portfolio
            </div>
            
            <h1 class="hero-title font-black text-gray-950 dark:text-white relative">
                <span class="block">Creative</span>
                <span class="block text-gray-400 dark:text-brand">Media</span>
                <span class="block relative">Enthusiast<span class="text-brand dark:text-gray-400">.</span></span>
            </h1>

            <p class="text-gray-600 dark:text-gray-400 text-lg md:text-2xl max-w-2xl font-light leading-relaxed">
                <span class="font-semibold">Videographer</span> & <span class="text-brand font-semibold">Photographer</span> yang memadukan intuisi kreatif dengan keahlian teknis.
            </p>
            
            <div class="pt-10 flex flex-col sm:flex-row gap-4 items-center justify-center">
                <a href="#portfolio" onclick="smoothScroll('#portfolio', 1000)" class="px-10 py-5 bg-brand text-white rounded-full font-bold shadow-xl shadow-brand/20 hover:scale-105 transition-transform inline-block uppercase tracking-widest text-xs text-center">
                    Explore My works
                </a>
                <a href="#contact" onclick="smoothScroll('#contact', 1200)" class="px-10 py-5 bg-transparent text-gray-900 dark:text-white rounded-full font-semibold hover:bg-gray-100 dark:hover:bg-white/5 transition-colors inline-block uppercase tracking-widest text-xs border border-gray-200 dark:border-white/10 text-center">
                    Get in touch
                </a>
            </div>
        </div>
    </section>

    <section id="about" class="py-24 md:py-32 bg-white dark:bg-[#0c0c0c] border-y border-gray-100 dark:border-white/5 relative z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-12 gap-12 lg:gap-8 items-center">
                <div class="lg:col-span-5 relative lg:-ml-12">
                    <div class="aspect-[3/4] rounded-[2.5rem] bg-gray-100 dark:bg-zinc-900 border border-gray-200 dark:border-white/10 overflow-hidden shadow-2xl relative z-10">
                        @php
                            // Ambil user pertama (kamu)
                            $me = \App\Models\User::first();
                            $profileImg = ($me && $me->profile_photo) 
                                ? asset('storage/' . $me->profile_photo) 
                                : asset('storage/profile.png'); // Fallback ke file default
                        @endphp
                        <img src="{{ $profileImg }}" 
                             alt="Naufal" 
                             class="w-full h-full object-cover transition-all duration-700 grayscale scale-100 hover:grayscale-0 hover:scale-105 cursor-crosshair">
                    </div>
                    <div class="absolute -bottom-8 -right-8 w-2/3 bg-brand rounded-3xl text-white p-8 shadow-xl z-20 hidden lg:block">
                        <h4 class="text-xs uppercase tracking-widest font-bold">Based in</h4>
                        <p class="text-5xl font-extrabold tracking-tighter mt-1">Malang</p>
                        <p class="text-[10px] mt-4 uppercase tracking-[0.2em]">Freelancer</p>
                    </div>
                </div>
                
                <div class="lg:col-span-7 lg:-ml-10 relative z-30 space-y-10 lg:pl-10">
                    <div class="p-10 md:p-14 rounded-[3rem] bg-gray-50 dark:bg-zinc-900/60 border border-gray-100 dark:border-white/5 shadow-lg backdrop-blur-sm">
                        <h2 class="text-4xl md:text-6xl font-black tracking-tight mb-8 text-gray-900 dark:text-white">Halo, saya Naufal<span class="text-brand">.</span></h2>
                        <div class="space-y-6 text-gray-700 dark:text-gray-400 leading-relaxed text-xl font-light">
                            <p>Mahasiswa Fakultas Ilmu Komputer yang berfokus pada Computer Engineering di <span class="text-brand font-medium">Universitas Brawijaya</span>.</p>
                            <p>Sebagai <span class="text-black dark:text-white font-medium">Creative Media Enthusiast</span>, saya mengombinasikan teknik dengan seni untuk menghasilkan narasi visual sinematik.</p>
                            
                            <div class="flex gap-4 pt-6">
                                <a href="https://instagram.com/nfldss" target="_blank" class="w-12 h-12 flex items-center justify-center rounded-2xl border border-gray-300 dark:border-white/10 text-gray-500 dark:text-gray-400 hover:text-brand dark:hover:text-brand hover:border-brand dark:hover:border-brand hover:scale-110 transition-all duration-300" title="Instagram">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c.796 0 1.441.645 1.441 1.44s-.645 1.44-1.441 1.44c-.795 0-1.44-.645-1.44-1.44s.645-1.44 1.44-1.44z"/></svg>
                                </a>
                                <a href="https://tiktok.com/@palpicts" target="_blank" class="w-12 h-12 flex items-center justify-center rounded-2xl border border-gray-300 dark:border-white/10 text-gray-500 dark:text-gray-400 hover:text-brand dark:hover:text-brand hover:border-brand dark:hover:border-brand hover:scale-110 transition-all duration-300" title="TikTok">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 448 512"><path d="M448,209.91a210.06,210.06,0,0,1-122.77-39.25V349.38A162.55,162.55,0,1,1,185,188.31V278.2a74.62,74.62,0,1,0,52.23,71.18V0l88,0a121.18,121.18,0,0,0,1.86,22.17h0A122.18,122.18,0,0,0,381,102.39a121.43,121.43,0,0,0,67,20.14Z"/></svg>
                                </a>
                                <a href="https://linkedin.com/in/naufalds" target="_blank" class="w-12 h-12 flex items-center justify-center rounded-2xl border border-gray-300 dark:border-white/10 text-gray-500 dark:text-gray-400 hover:text-brand dark:hover:text-brand hover:border-brand dark:hover:border-brand hover:scale-110 transition-all duration-300" title="LinkedIn">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 448 512"><path d="M416 32H31.9C14.3 32 0 46.5 0 64.3v383.4C0 465.5 14.3 480 31.9 480H416c17.6 0 32-14.5 32-32.3V64.3c0-17.8-14.4-32.3-32.1-32.3zM135.4 416H69V202.2h66.5V416zm-33.2-243c-21.3 0-38.5-17.3-38.5-38.5S80.9 96 102.2 96c21.2 0 38.5 17.3 38.5 38.5 0 21.3-17.2 38.5-38.5 38.5zm282.1 243h-66.4V312c0-24.8-.5-56.7-34.5-56.7-34.6 0-39.9 27-39.9 54.9V416h-66.4V202.2h63.7v29.2h.9c8.9-16.8 30.6-34.5 62.9-34.5 67.2 0 79.7 44.3 79.7 101.9V416z"/></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="apps" class="py-24 md:py-32 bg-orange-50/50 dark:bg-orange-950/10 border-y border-brand/5 relative z-10" x-data="{ activeWork: 0 }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-16 items-start">
                <div class="space-y-12 lg:sticky lg:top-36 text-center lg:text-left">
                    <div class="space-y-3 flex flex-col items-center lg:items-start">
                        <h2 class="text-5xl font-black tracking-tight text-gray-950 dark:text-white">Mastery<span class="text-brand">.</span></h2>
                        <p class="text-gray-600 dark:text-gray-400 text-base max-w-md font-light">Software industri yang saya gunakan untuk produksi audio, videografi sinematik, dan motion graphics.</p>
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-5">
                        @php
                            $softwares = [
                                ['name' => 'Premiere Pro', 'icon' => 'https://upload.wikimedia.org/wikipedia/commons/4/40/Adobe_Premiere_Pro_CC_icon.svg', 'desc' => 'Video Editing'],
                                ['name' => 'After Effects', 'icon' => 'https://upload.wikimedia.org/wikipedia/commons/c/cb/Adobe_After_Effects_CC_icon.svg', 'desc' => 'Motion Graphics'],
                                ['name' => 'Audition', 'icon' => 'https://upload.wikimedia.org/wikipedia/commons/0/0e/Adobe_Audition_CC_icon_%282020%29.svg', 'desc' => 'Audio Post'],
                                ['name' => 'Photoshop', 'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/photoshop/photoshop-original.svg', 'desc' => 'Visual Design'],
                                ['name' => 'Figma', 'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/figma/figma-original.svg', 'desc' => 'UI/UX Design'],
                                ['name' => 'CapCut', 'icon' => 'https://upload.wikimedia.org/wikipedia/commons/0/0c/Capcut-icon.png', 'desc' => 'Video Editing']
                            ];
                        @endphp
                        @foreach($softwares as $app)
                            <div class="group p-6 rounded-2xl bg-white dark:bg-zinc-900 border border-gray-100 dark:border-white/10 shadow-sm transition-all hover:border-brand dark:hover:border-brand hover:-translate-y-2 flex flex-col items-center text-center">
                                <div class="w-16 h-16 mb-5 p-3 flex items-center justify-center rounded-2xl bg-gray-50 dark:bg-zinc-800 border border-gray-100 dark:border-white/5 transition-all group-hover:bg-brand/5 dark:group-hover:bg-brand/10 overflow-hidden">
                                    <img src="{{ $app['icon'] }}" alt="icon" class="w-full h-full object-contain grayscale group-hover:grayscale-0 transition-all duration-300">
                                </div>
                                <h4 class="text-sm font-bold tracking-tight text-gray-950 dark:text-white group-hover:text-brand transition-colors">{{ $app['name'] }}</h4>
                                <p class="text-[9px] mt-1.5 uppercase tracking-widest text-brand font-bold">{{ $app['desc'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="space-y-10">
                    <div class="flex items-center justify-between">
                        <h3 class="text-sm font-black uppercase tracking-[0.4em] text-gray-500 dark:text-white">Featured Works</h3>
                        <div class="flex gap-3">
                            <button @click="activeWork = activeWork === 0 ? 2 : activeWork - 1" class="w-10 h-10 rounded-full border border-gray-200 dark:border-white/10 flex items-center justify-center text-gray-400 hover:border-brand hover:text-brand transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                            </button>
                            <button @click="activeWork = activeWork === 2 ? 0 : activeWork + 1" class="w-10 h-10 rounded-full border border-gray-200 dark:border-white/10 flex items-center justify-center text-gray-400 hover:border-brand hover:text-brand transition-all">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </button>
                        </div>
                    </div>
                    <div class="relative overflow-visible">
                        @foreach($recentPortfolios->take(3) as $index => $item)
                            <div x-show="activeWork === {{ $index }}" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 translate-x-8" x-transition:enter-end="opacity-100 translate-x-0" x-transition:leave="transition ease-in duration-300 absolute top-0 w-full" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0 -translate-x-8" class="w-full">
                                <a href="{{ route('portfolio.show', $item->slug) }}" class="group relative block rounded-[2.5rem] bg-white dark:bg-zinc-900 border border-gray-100 dark:border-white/10 transition-all hover:border-brand/30 hover:shadow-2xl overflow-hidden isolation-auto" style="isolation: isolate;">
                                    <div class="aspect-[3/2] relative overflow-hidden">
                                        @php 
                                            $thumb = $item->media->where('is_featured', true)->first() ?? $item->media->first();
                                            $thumbnailUrl = '';
                                            $isVideo = false;

                                            if ($thumb) {
                                                $path = $thumb->file_path ?? $thumb->video_url; // Cek kedua kolom untuk backward compatibility
                                                if (filter_var($path, FILTER_VALIDATE_URL) && (str_contains($path, 'youtube.com') || str_contains($path, 'youtu.be'))) {
                                                    preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $path, $match);
                                                    $youtubeId = $match[1] ?? null;
                                                    $thumbnailUrl = $youtubeId ? "https://img.youtube.com/vi/{$youtubeId}/hqdefault.jpg" : '';
                                                    $isVideo = true;
                                                } elseif ($thumb->type === 'photo' && $thumb->file_path) {
                                                    $thumbnailUrl = asset('storage/' . $thumb->file_path);
                                                }
                                            }   
                                        @endphp

                                        @if($thumbnailUrl)
                                            <img src="{{ $thumbnailUrl }}" alt="{{ $item->title }}" class="w-full h-full object-cover transition duration-[1.5s] group-hover:scale-110 grayscale group-hover:grayscale-0">
                                            @if($isVideo)
                                                <div class="absolute inset-0 flex items-center justify-center">
                                                    <div class="w-12 h-12 rounded-full bg-brand/90 flex items-center justify-center text-white shadow-lg">
                                                        <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                                    </div>
                                                </div>
                                            @endif
                                        @else
                                            <div class="w-full h-full bg-gray-200 dark:bg-zinc-800 flex items-center justify-center">
                                                <span class="text-[10px] text-gray-400">NO MEDIA DATA</span>
                                            </div>
                                        @endif
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/10 to-transparent"></div>
                                        <div class="absolute top-6 left-6">
                                            <span class="px-3 py-1 bg-white/20 backdrop-blur-sm border border-white/30 text-white text-[9px] font-bold uppercase tracking-widest rounded-full">{{ $item->category->name }}</span>
                                        </div>
                                    </div>
                                    <div class="p-8">
                                        <h3 class="text-2xl font-bold group-hover:text-brand transition-colors tracking-tight text-gray-900 dark:text-white">{{ $item->title }}</h3>
                                        <p class="text-[10px] text-gray-500 mt-2 uppercase tracking-[0.2em]">Explore Story &rarr;</p>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="education" class="py-24 md:py-32 bg-gray-50 dark:bg-[#0a0a0a] border-b border-gray-100 dark:border-white/5">
        <div class="max-w-4xl mx-auto px-10 sm:px-6 lg:px-8">
            <h2 class="text-4xl md:text-6xl font-black tracking-tight mb-16 text-center md:text-left text-gray-950 dark:text-white">Edukasi<span class="text-brand">.</span></h2>
            <div class="relative pl-12 border-l-2 border-brand/20">
                <div class="absolute -left-[9px] top-2 w-4 h-4 rounded-full bg-brand shadow-[0_0_15px_rgba(249,115,22,0.5)]"></div>
                <h4 class="text-2xl font-bold text-gray-900 dark:text-white">Universitas Brawijaya</h4>
                <p class="text-gray-600 dark:text-gray-400 mt-1 leading-relaxed text-lg font-light">Fakultas Ilmu Komputer</p>
                <p class="text-brand text-sm font-semibold mt-1 uppercase tracking-widest">Teknik Komputer | 2022 - Sekarang</p>
            </div>
        </div>
    </section>

    <section id="experience" class="py-24 md:py-32 bg-white dark:bg-[#0c0c0c]">
        <div class="max-w-4xl mx-auto px-10 sm:px-6 lg:px-8">
            <h2 class="text-4xl md:text-6xl font-black tracking-tight mb-16 text-center md:text-left text-gray-950 dark:text-white">Pengalaman<span class="text-brand">.</span></h2>
            
            <div class="space-y-16 relative">
                <div class="absolute left-[11px] top-2 bottom-0 w-0.5 border-l-2 border-dashed border-gray-200 dark:border-white/10 hidden md:block"></div>

                <div class="relative pl-0 md:pl-12 border-l-2 md:border-l-0 border-gray-200 dark:border-white/10">
                    <div class="hidden md:block absolute left-[12px] -translate-x-1/2 top-2 w-4 h-4 rounded-full bg-gray-300 dark:bg-zinc-800 border-2 border-white dark:border-[#0c0c0c]"></div>
                    <div class="md:hidden absolute -left-[10px] top-2 w-4 h-4 rounded-full bg-gray-300 dark:bg-zinc-800"></div>
                    <h4 class="text-2xl font-bold text-gray-900 dark:text-white">Videographer & Video Editor</h4>
                    <p class="text-brand text-[11px] md:text-sm font-semibold mt-1 uppercase tracking-[0.2em]">UPMD FILKOM UB | Feb 2025 - Des 2025 <span class="mx-1 opacity-40">•</span> Part-Time</p>
                    <p class="text-gray-600 dark:text-gray-400 mt-6 leading-relaxed text-lg font-light">
                        Bertanggung jawab dalam <span class="text-gray-500 font-semibold">merancang konsep visual dan mengeksekusi proses editing</span> konten digital fakultas untuk meningkatkan engagement audiens di berbagai platform media sosial.
                    </p>
                </div>

                <div class="relative pl-0 md:pl-12 border-l-2 md:border-l-0 border-gray-200 dark:border-white/10">
                    <div class="hidden md:block absolute left-[12px] -translate-x-1/2 top-2 w-4 h-4 rounded-full bg-gray-300 dark:bg-zinc-800 border-2 border-white dark:border-[#0c0c0c]"></div>
                    <div class="md:hidden absolute -left-[10px] top-2 w-4 h-4 rounded-full bg-gray-300 dark:bg-zinc-800"></div>
                    <h4 class="text-2xl font-bold text-gray-900 dark:text-white">Videographer & Video Editor</h4>
                    <p class="text-brand text-[11px] md:text-sm font-semibold mt-1 uppercase tracking-[0.2em]">Akademi Rumah Mahasiswa | Juli 2025 <span class="mx-1 opacity-40">•</span> Freelance</p>
                    <p class="text-gray-600 dark:text-gray-400 mt-6 leading-relaxed text-lg font-light">
                        Memproduksi video <span class="text-gray-500 font-semibold">digital learning</span> untuk E-Camp Business Plan Akademi Rumah Mahasiswa, menangkap esensi inovasi dan semangat kewirausahaan mahasiswa.
                    </p>
                </div>

                <div class="relative pl-0 md:pl-12 border-l-2 md:border-l-0 border-gray-200 dark:border-white/10">
                    <div class="hidden md:block absolute left-[12px] -translate-x-1/2 top-2 w-4 h-4 rounded-full bg-gray-300 dark:bg-zinc-800 border-2 border-white dark:border-[#0c0c0c]"></div>
                    <div class="md:hidden absolute -left-[10px] top-2 w-4 h-4 rounded-full bg-gray-300 dark:bg-zinc-800"></div>
                    <h4 class="text-2xl font-bold text-gray-900 dark:text-white">Videographer & Video Editor</h4>
                    <p class="text-brand text-[11px] md:text-sm font-semibold mt-1 uppercase tracking-[0.2em]">PMM Batch 4 UB | Juni 2024 <span class="mx-1 opacity-40">•</span> Freelance</p>
                    <p class="text-gray-600 dark:text-gray-400 mt-6 leading-relaxed text-lg font-light">
                        Mengelola dokumentasi visual festival budaya berskala universitas, menyajikan keberagaman identitas nusantara melalui konten video yang <span class="text-gray-500 font-semibold">dinamis dan bercerita.</span>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section id="portfolio" class="py-24 md:py-32 bg-gray-50 dark:bg-[#0a0a0a]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center mb-20 space-y-4">
            <h2 class="text-5xl md:text-6xl font-black tracking-tight text-gray-950 dark:text-white">Selected Works<span class="text-brand">.</span></h2>
            <p class="text-gray-500 dark:text-gray-400 font-light">Visi visual yang diwujudkan melalui presisi teknis dan seni.</p>
        </div>
        <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10 md:gap-12">
            @foreach($recentPortfolios as $item)
                <div class="group relative block rounded-[2.5rem] overflow-hidden bg-white dark:bg-zinc-900 border border-gray-200 dark:border-white/10 aspect-[4/5] shadow-xl transition-all duration-500 hover:border-brand/50 hover:-translate-y-2 overflow-hidden isolate">
                    
                    <div class="w-full h-full relative overflow-hidden">
                        @php 
                            $thumb = $item->media->where('is_featured', true)->first() ?? $item->media->first(); 
                            $thumbnailUrl = '';
                            $embedUrl = '';
                            $isVideo = false;

                            if ($thumb) {
                                $path = $thumb->file_path ?? $thumb->video_url; // Cek kedua kolom
                                
                                if (filter_var($path, FILTER_VALIDATE_URL) && (str_contains($path, 'youtube.com') || str_contains($path, 'youtu.be'))) {
                                    preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $path, $match);
                                    $youtubeId = $match[1] ?? null;
                                    if ($youtubeId) {
                                        $thumbnailUrl = "https://img.youtube.com/vi/{$youtubeId}/hqdefault.jpg";
                                        $embedUrl = "https://www.youtube.com/embed/{$youtubeId}?rel=0&showinfo=0&autoplay=0";
                                        $isVideo = true;
                                    }
                                } else {
                                    $thumbnailUrl = str_contains($path, 'http') ? $path : asset('storage/' . $path);
                                }
                            }
                        @endphp

                        @if($isVideo)
                            {{-- Pattern: Tampilkan Thumbnail dengan Ikon Play, Klik untuk buka Video/Detail --}}
                            <a href="{{ route('portfolio.show', $item->slug) }}" class="block w-full h-full relative">
                                <img src="{{ $thumbnailUrl }}" alt="{{ $item->title }}" class="object-cover w-full h-full transition duration-[1.5s] group-hover:scale-110 grayscale group-hover:grayscale-0 brightness-95 group-hover:brightness-105 transform-gpu">
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <div class="w-16 h-16 rounded-full bg-brand/90 flex items-center justify-center text-white shadow-2xl">
                                        <svg class="w-8 h-8 fill-current" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                    </div>
                                </div>
                                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-90 transition-all duration-700"></div>
                            </a>
                        @else
                            {{-- Tampilkan Gambar Foto --}}
                            <a href="{{ route('portfolio.show', $item->slug) }}" class="block w-full h-full">
                                @if($thumbnailUrl)
                                    <img src="{{ $thumbnailUrl }}" alt="{{ $item->title }}" class="object-cover w-full h-full transition duration-[1.5s] group-hover:scale-110 grayscale group-hover:grayscale-0 brightness-95 group-hover:brightness-105">
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-90 transition-all duration-700"></div>
                            </a>
                        @endif
                    </div>

                    {{-- Info Judul di Bagian Bawah --}}
                    <div class="absolute inset-x-5 bottom-5 p-7 bg-black/40 backdrop-blur-md rounded-[2.5rem] border border-white/5 transform translate-y-3 group-hover:translate-y-0 transition-all duration-700 ease-out flex flex-col items-center text-center pointer-events-none">
                        <h3 class="text-2xl md:text-3xl font-extrabold text-white leading-tight tracking-tighter mb-2">{{ $item->title }}</h3>
                        <span class="px-3 py-1 rounded-full bg-brand text-black text-[8px] font-bold uppercase tracking-widest shadow-lg">{{ $item->category->name ?? 'Work' }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <section id="contact" class="py-24 md:py-40 bg-white dark:bg-[#0a0a0a]">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <h2 class="text-5xl md:text-7xl font-black tracking-tighter mb-8 text-gray-950 dark:text-white">Let's Connect<span class="text-brand">.</span></h2>
            <p class="text-gray-500 text-lg mb-16 font-light">Bawa visi Anda ke level selanjutnya melalui kolaborasi teknologi dan kreatif.</p>
            <form action="#" class="grid grid-cols-1 gap-6 text-left">
                <div class="grid md:grid-cols-2 gap-6">
                    <input type="text" placeholder="Name" class="w-full px-6 py-4 rounded-2xl bg-gray-50 dark:bg-white/5 border border-gray-100 dark:border-white/10 focus:border-brand outline-none transition-all placeholder:text-gray-400 dark:text-white">
                    <input type="email" placeholder="Email" class="w-full px-6 py-4 rounded-2xl bg-gray-50 dark:bg-white/5 border border-gray-100 dark:border-white/10 focus:border-brand outline-none transition-all placeholder:text-gray-400 dark:text-white">
                </div>
                <textarea rows="5" placeholder="Your Message..." class="w-full px-6 py-4 rounded-3xl bg-gray-50 dark:bg-white/5 border border-gray-100 dark:border-white/10 focus:border-brand outline-none transition-all placeholder:text-gray-400 dark:text-white"></textarea>
                <button type="submit" class="w-full px-6 py-4 rounded-2xl bg-black dark:bg-brand text-white rounded-full font-bold hover:scale-105 transition-transform shadow-xl shadow-brand/10 uppercase tracking-widest text-xs">Send Proposal</button>
            </form>
        </div>
    </section>
@endsection
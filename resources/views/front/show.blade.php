@extends('layouts.app')

@section('content')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const logoLink = document.querySelector('nav a[href="#home"]');
            if (logoLink) {
                logoLink.setAttribute('href', '{{ url("/") }}#home');
                logoLink.setAttribute('onclick', ''); // Menonaktifkan smoothScroll internal jika beda halaman
            }
        });
    </script>

    <section x-data="{ open: false, activeImage: '' }" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-32 md:pt-44 pb-24 relative z-10">
        
        <div class="mb-12">
            <a href="{{ url('/') }}#portfolio" class="inline-flex items-center gap-3 text-gray-400 dark:text-white/50 hover:text-brand font-black uppercase tracking-[0.3em] text-[10px] transition-all group">
                <div class="w-8 h-8 rounded-full border border-gray-200 dark:border-white/10 flex items-center justify-center group-hover:border-brand/50 transition-colors">
                    <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"></path></svg>
                </div>
                Back to Gallery
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-20">
            <div class="lg:col-span-4">
                <div class="sticky top-32 space-y-10">
                    <div class="p-8 md:p-10 rounded-[3rem] bg-white dark:bg-zinc-900 border border-gray-100 dark:border-white/10 shadow-xl dark:shadow-2xl">
                        <span class="block text-brand font-black tracking-[0.4em] text-[10px] uppercase mb-4">{{ $portfolio->category->name }}</span>
                        <h1 class="text-4xl md:text-5xl font-black tracking-tighter text-gray-900 dark:text-white leading-none">{{ $portfolio->title }}</h1>
                        
                        <div class="mt-10 space-y-8 border-t border-gray-100 dark:border-white/10 pt-8">
                            @if($portfolio->client_name)
                            <div>
                                <p class="text-gray-400 dark:text-white/30 text-[9px] font-black uppercase tracking-[0.3em]">Project Client</p>
                                <p class="text-gray-900 dark:text-white text-xl font-bold mt-2 tracking-tight">{{ $portfolio->client_name }}</p>
                            </div>
                            @endif

                            @if($portfolio->date_taken)
                            <div>
                                <p class="text-gray-400 dark:text-white/30 text-[9px] font-black uppercase tracking-[0.3em]">Release Date</p>
                                <p class="text-gray-900 dark:text-white text-xl font-bold mt-2 tracking-tight">{{ \Carbon\Carbon::parse($portfolio->date_taken)->format('F Y') }}</p>
                            </div>
                            @endif

                            <div class="pt-4">
                                <p class="text-gray-600 dark:text-gray-300 leading-relaxed font-light text-lg border-l-2 border-brand pl-6">
                                    {{ $portfolio->description }}
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="px-8 py-4">
                        <p class="text-gray-400 dark:text-white/20 text-[10px] font-medium leading-relaxed">
                            Karya ini merupakan bagian dari eksplorasi kreatif <span class="text-gray-900 dark:text-white/40 font-bold">Naufal (FILKOM UB)</span>.
                        </p>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @foreach($portfolio->media as $item)
                        <div class="relative group overflow-hidden rounded-[2.5rem] bg-gray-100 dark:bg-zinc-900 border border-gray-100 dark:border-white/5 shadow-lg transition-all duration-500 hover:border-brand/30 {{ $item->type === 'video' ? 'md:col-span-2' : '' }}">
                            @if($item->type === 'photo')
                                <div class="w-full h-full overflow-hidden relative cursor-zoom-in" @click="open = true; activeImage = '{{ asset('storage/' . $item->file_path) }}'">
                                    <div class="absolute inset-0 z-20 flex items-center justify-center bg-brand/5 opacity-0 group-hover:opacity-100 transition-all duration-500 backdrop-blur-[2px]">
                                        <div class="w-14 h-14 rounded-full bg-white/20 dark:bg-black/20 border border-white/40 dark:border-white/10 flex items-center justify-center text-gray-900 dark:text-white shadow-2xl transform scale-50 group-hover:scale-100 transition-transform duration-500">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path></svg>
                                        </div>
                                    </div>

                                    <img src="{{ asset('storage/' . $item->file_path) }}" 
                                         class="w-full h-full object-cover transition duration-[1.5s] group-hover:scale-110 brightness-100 dark:brightness-95 group-hover:dark:brightness-105">
                                </div>
                            @elseif($item->type === 'video')
                                <div class="aspect-video w-full">
                                    @php $embedUrl = str_replace(['watch?v=', 'youtu.be/'], ['embed/', 'youtube.com/embed/'], $item->video_url); @endphp
                                    <iframe class="w-full h-full opacity-100 dark:opacity-90 hover:opacity-100 transition-opacity" src="{{ $embedUrl }}" frameborder="0" allowfullscreen></iframe>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div x-show="open" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-[100] flex items-center justify-center bg-white/95 dark:bg-black/95 p-4 md:p-12 cursor-zoom-out" 
             @click.self="open = false"
             @keydown.window.escape="open = false" 
             style="display: none;">
            
            <button @click="open = false" class="absolute top-6 right-6 z-[110] w-12 h-12 flex items-center justify-center rounded-full bg-gray-100 dark:bg-white/10 text-gray-900 dark:text-white hover:bg-brand hover:text-white transition-all border border-gray-200 dark:border-white/10">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
            
            <div class="relative max-w-5xl max-h-full flex items-center justify-center">
                <img :src="activeImage" 
                     class="max-w-full max-h-[85vh] md:max-h-[90vh] rounded-xl shadow-2xl border border-gray-100 dark:border-white/10 object-contain pointer-events-none">
                
                <p class="absolute -bottom-10 left-0 right-0 text-center text-gray-400 dark:text-white/40 text-[10px] font-bold uppercase tracking-widest">
                    Click anywhere to close
                </p>
            </div>
        </div>
    </section>
@endsection
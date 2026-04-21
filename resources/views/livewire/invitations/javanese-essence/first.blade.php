<div x-data="{ loading: true, isOpening: false }" x-init="setTimeout(() => loading = false, 3000)" class="relative">
    <!-- 1. LOADING SCREEN LAYER -->
    <div x-show="loading" x-transition:leave="transition ease-in duration-1000" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-999 flex flex-col items-center justify-center bg-[#5a3a2e]">

        <!-- Logo Brand Voeu dengan Efek Sorot Cahaya -->
        <div class="relative flex flex-col items-center">

            <!-- Teks Logo Utama -->
            <h1 class="font-utama text-7xl tracking-[0.3em] uppercase leading-none text-shimmer">
                Voeu
            </h1>

            <!-- Tagline dengan animasi fade tipis -->
            <div class="mt-4 overflow-hidden">
                <span class="font-poppins text-[10px] tracking-[1em] text-[#F5E9D8] uppercase opacity-30 animate-pulse">
                    Digital Invitation
                </span>
            </div>
        </div>

        <!-- Progress Bar Halus -->
        <div class="mt-16 w-32 h-px bg-[#F5E9D8]/10 overflow-hidden">
            <div class="h-full bg-[#F5E9D8] animate-progress"></div>
        </div>
    </div>

    <div class="relative h-screen w-full bg-cover bg-center overflow-hidden max-w-md mx-auto"
        style="background-image: url('{{ $invitation->getPhoto('c1') }}')">
        @php
            // Samakan dengan logika di Controller/Gallery
            $rawData = $invitation->content['dynamic_photos'] ?? ($invitation->dynamic_photos ?? []);

            $galleryPhotos = collect($rawData)
                ->filter(fn($photo) => isset($photo['label']) && str_contains(strtolower($photo['label']), 'gallery'))
                ->take(5) // <--- AMBIL 4 FOTO SAJA BIAR TIDAK TERLALU CEPAT
                ->map(fn($photo) => asset('storage/' . (is_array($photo) ? $photo['path'] ?? '' : $photo)))
                ->values()
                ->toArray();
        @endphp
        {{-- OPENING SLIDER LAYER --}}
        <template x-if="isOpening">
            <div x-transition.opacity.duration.800ms
                class="fixed inset-0 z-9999 bg-[#2d1e18] flex items-center justify-center overflow-hidden">

                <div class="relative w-full h-full max-w-md mx-auto" x-data="{
                    activeSlide: 0,
                    slides: @js($galleryPhotos),
                    init() {
                        if (this.slides.length > 0) {
                            // Setiap slide tampil selama 1.6 detik (1600ms)
                            // Dengan 3-4 foto, ini pas dengan total durasi 5 detik
                            setInterval(() => {
                                this.activeSlide = (this.activeSlide + 1) % this.slides.length
                            }, 1600);
                        }
                    }
                }">
                    <template x-for="(img, index) in slides" :key="index">
                        <div x-show="activeSlide === index" {{-- Transisi diperhalus (masuk 1000ms, keluar 1000ms) --}}
                            x-transition:enter="transition ease-out duration-[1000ms]"
                            x-transition:enter-start="opacity-0 scale-110"
                            x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-[1000ms]"
                            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                            class="absolute inset-0">
                            <img :src="img" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-black/50"></div>
                        </div>
                    </template>

                    <div class="absolute inset-0 flex flex-col items-center justify-center text-white px-6">
                        <div class="relative flex flex-col items-center">

                            <h2
                                class="font-abigail text-6xl md:text-7xl leading-none self-start -mb-4 opacity-90 text-shimmer tracking-normal">
                                {{ $invitation->content['nama_pria'] }}
                            </h2>

                            <div class="flex items-center gap-4 w-full justify-center z-10">
                                <div class="h-[0.5px] w-12 bg-white/30"></div>
                                <span class="font-poppins text-[10px] tracking-[0.8em] uppercase opacity-60">And</span>
                                <div class="h-[0.5px] w-12 bg-white/30"></div>
                            </div>

                            <h2
                                class="font-abigail text-6xl md:text-7xl leading-none self-end -mt-4 opacity-90 text-shimmer tracking-normal">
                                {{ $invitation->content['nama_wanita'] }}
                            </h2>

                            <div class="mt-12 flex flex-col items-center gap-3">
                                <p class="font-poppins text-[8px] tracking-[1em] uppercase opacity-40">The Wedding of
                                </p>
                                <div class="w-20 h-px bg-white/20 overflow-hidden relative">
                                    <div class="absolute inset-0 bg-white/80 animate-progress"></div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="absolute bottom-0 left-0 h-1 bg-white/20 w-full">
                        <div class="h-full bg-white transition-all duration-5000 ease-linear"
                            :style="isOpening ? 'width: 100%' : 'width: 0%'"></div>
                    </div>
                </div>
            </div>
        </template>
        {{-- TAMPILAN DEPAN --}}
        <div class="absolute inset-x-0 bottom-0 h-1/2 bg-linear-to-t from-[#5a3a2e] via-[#5a3a2e]/60 to-transparent">
        </div>

        <div
            class="absolute -bottom-75 -left-40 w-full z-10 transition-transform duration-1000 transform hover:scale-105 origin-bottom-left pointer-events-none">
            <img src="{{ asset('assets/png/javaneseessence/cowo.png') }}" alt="Wayang Pria"
                class="w-full h-auto object-contain brightness-0 opacity-10 contrast-100">
        </div>

        <div
            class="absolute -bottom-75 -right-40 w-full z-10 transition-transform duration-1000 transform hover:scale-105 origin-bottom-right pointer-events-none">
            <img src="{{ asset('assets/png/javaneseessence/cewe.png') }}" alt="Wayang Wanita"
                class="w-full h-auto object-contain brightness-0 opacity-10 contrast-100">
        </div>

        <div class="relative z-20 flex flex-col items-center h-full w-full px-8 pt-10">
            <div class="w-full max-w-5xl flex flex-col">
                <div class="flex items-baseline gap-4 mb-4 border-b border-white/20 pb-2 justify-center">
                    <span class="text-white text-[10px] md:text-xs tracking-[0.5em] uppercase font-light">The Union of
                        Two
                        Souls</span>
                </div>

                <h1
                    class="font-abigail text-white text-[5rem] leading-none self-start opacity-90 hover:opacity-100 transition-opacity">
                    {{ $invitation->content['nama_pria'] }}</h1>

                <div class="flex items-center self-end -mt-7">
                    <span class="text-white font-poppins text-xs tracking-[1em] uppercase mr-4 opacity-50">And</span>
                    <h1 class="font-abigail text-white text-[5rem] leading-none">
                        {{ $invitation->content['nama_wanita'] }}</h1>
                </div>

                <div class="self-end mt-4">
                    <p
                        class="text-white text-xs md:text-sm font-light tracking-[0.5em] uppercase bg-white/10 px-4 py-2 rounded-full">
                        {{ Carbon\Carbon::parse($invitation->content['tanggal_resepsi'])->format('F jS, Y') }}</p>
                </div>
            </div>

            <div class="flex flex-col items-center justify-center mt-auto pb-10">
                <button
                    @click="
        document.getElementById('weddingMusic').play();
        isOpening = true;
        setTimeout(() => { $wire.open() }, 5000);
    "
                    class="group relative px-10 py-3 overflow-hidden rounded-full border border-white/30 bg-white/10 backdrop-blur-md transition-all duration-300 active:scale-95">
                    <div class="relative flex items-center gap-3">
                        <span class="text-white text-[10px] tracking-[0.4em] uppercase font-light">
                            Open Invitation
                        </span>
                    </div>
                </button>
                <div class="mt-4 opacity-40">
                    <div class="w-px h-8 bg-linear-to-b from-white to-transparent"></div>
                </div>
            </div>
        </div>
    </div>
    @persist('music')
        <audio id="weddingMusic" loop>
            <source src="{{ $invitation->getMusic() }}" type="audio/mpeg">
        </audio>
    @endpersist
</div>
<style>
    /* Inti dari Efek Sorot Cahaya pada Tulisan */
    .text-shimmer {
        background: linear-gradient(to right,
                #512804 20%,
                #F5E9D8 40%,
                #F5E9D8 60%,
                #512804 80%);
        background-size: 200% auto;
        color: #000;
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: shine 3s linear infinite;
    }

    @keyframes shine {
        to {
            background-position: 200% center;
        }
    }

    @keyframes progress {
        0% {
            transform: translateX(-100%);
        }

        100% {
            transform: translateX(100%);
        }
    }

    .animate-progress {
        animation: progress 2.5s infinite ease-in-out;
    }
</style>

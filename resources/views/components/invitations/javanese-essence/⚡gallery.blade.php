<?php

use Livewire\Component;

new class extends Component {
    public $invitation;
    public $topPhotos = [];
    public $bottomPhotos = [];
    public $videoEmbed;
    public function mount($invitation)
    {
        $this->invitation = $invitation;
        // Ambil link video dari database
        $rawVideo = $this->invitation->content['link_video'] ?? null;
        $this->videoEmbed = null;
        if ($rawVideo) {
            // Logika merubah link youtube biasa ke embed
            // Contoh: https://youtu.be/abc atau https://youtube.com/watch?v=abc
            $videoId = null;
            if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $rawVideo, $match)) {
                $videoId = $match[1];
            }

            if ($videoId) {
                $this->videoEmbed = 'https://www.youtube.com/embed/' . $videoId;
            }
        }
        // Ambil semua foto gallery seperti biasa
        $rawData = $this->invitation->content['dynamic_photos'] ?? ($this->invitation->dynamic_photos ?? []);
        $allPhotos = collect($rawData)
            ->filter(function ($photo) {
                return isset($photo['label']) && str_contains(strtolower($photo['label']), 'gallery');
            })
            ->map(function ($photo) {
                return asset('storage/' . ($photo['path'] ?? $photo));
            })
            ->values()
            ->toArray();

        if (empty($allPhotos)) {
            $allPhotos = [asset('assets/img/placeholder.png')];
        }

        // PECAH DATA: 5 foto pertama untuk di atas, sisanya untuk di bawah
        $this->topPhotos = array_slice($allPhotos, 0, 5);
        $this->bottomPhotos = array_slice($allPhotos, 5);
    }
};
?>

<section x-data="{ open: false, activeImg: '' }" class="relative flex flex-col py-10 overflow-hidden max-w-md mx-auto">

    <div x-show="open" x-transition.opacity class="fixed inset-0 z-999 bg-black/90 flex items-center justify-center p-4"
        @click="open = false" style="display: none;">
        <button class="absolute top-10 right-10 text-white text-3xl font-light">&times;</button>
        <img :src="activeImg" class="max-w-full max-h-[80vh] shadow-2xl ">
    </div>

    <div x-data="{ show: false }" x-intersect="show = true" class="relative w-full mb-16 flex flex-col items-end px-6">
        <h3 x-show="show" x-transition:enter="transition ease-out duration-1000"
            x-transition:enter-start="translate-x-100" x-transition:enter-end="translate-x-0"
            class="absolute -top-10 right-4 font-abigail text-[#5a3a2e]/5 text-[4rem] leading-none pointer-events-none uppercase">
            Moments
        </h3>
        <div class="relative z-10 mt-6 mr-4 text-right">
            <h2 x-show="show" x-transition:enter="transition ease-out duration-1000 delay-500"
                x-transition:enter-start="opacity-0 -translate-x-100" x-transition:enter-end="opacity-100 translate-x-0"
                class="font-abigail text-[#5a3a2e] text-[4rem] leading-[0.8] tracking-tighter drop-shadow-sm">
                Our <br> <span class="mr-12 border-b border-[#5a3a2e]/10">Gallery</span>
            </h2>
            <div x-show="show" x-transition:enter="transition ease-out duration-1000 delay-1000"
                x-transition:enter-start="translate-x-100" x-transition:enter-end="translate-x-0"
                class="mt-8 flex items-center justify-end gap-3 opacity-40">
                <p class="font-poppins text-[#5a3a2e] text-[9px] tracking-[0.5em] uppercase">Captured Love</p>
                <div class="w-8 h-[0.5px] bg-[#5a3a2e]"></div>
            </div>
        </div>
    </div>
    {{-- VIDEO SECTION --}}
    @if ($videoEmbed)
        <div class="px-6 mb-12">
            <div class="relative w-full aspect-video overflow-hidden shadow-2xl border border-[#5a3a2e]/10">
                <iframe class="absolute inset-0 w-full h-full" src="{{ $videoEmbed }}" title="YouTube video player"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                </iframe>
            </div>

            {{-- Caption Pendek --}}
            <div class="mt-4 flex items-center gap-3 opacity-30">
                <div class="w-8 h-[0.5px] bg-[#5a3a2e]"></div>
                <p class="font-poppins text-[#5a3a2e] text-[8px] tracking-[0.4em] uppercase">Love Story in Motion</p>
            </div>
        </div>
    @endif
    {{-- TOP PHOTOS SECTION --}}
    @if (count($topPhotos) > 0)
        <div class="px-6" x-data="{
            images: @js($topPhotos),
            activeMain: '{{ $topPhotos[0] ?? '' }}'
        }">
            {{-- Main Display --}}
            <div class="shadow-lg cursor-pointer group overflow-hidden">
                <img :src="activeMain" @click="open = true; activeImg = activeMain"
                    class="w-full aspect-4/5 object-cover group-hover:scale-105 transition duration-700">
            </div>

            {{-- Thumbnails --}}
            <div class="flex overflow-x-auto gap-3 mt-4 pb-4 snap-x [&::-webkit-scrollbar]:hidden">
                <template x-for="(img, index) in images" :key="index">
                    <div @click="activeMain = img"
                        class="shrink-0 w-20 aspect-square shadow-md cursor-pointer snap-start transition-all duration-300"
                        :class="activeMain === img ? 'scale-105 opacity-100' :
                            ' opacity-50 hover:opacity-100'">
                        <img :src="img" class="w-full h-full object-cover">
                    </div>
                </template>
            </div>
        </div>
    @endif

    {{-- BOTTOM PHOTOS SECTION --}}
    @if (count($bottomPhotos) > 0)
        <div class="px-6 mt-6 space-y-4">
            <div class="flex items-center gap-2 opacity-50 mb-6">
                <div class="w-full h-[0.5px] bg-[#5a3a2e]"></div>
                <p class="font-poppins text-[8px] tracking-[0.4em] uppercase text-[#5a3a2e] whitespace-nowrap">
                    More Memories
                </p>
            </div>

            {{-- Menggunakan Grid 3 kolom agar bisa col-span-2 --}}
            <div class="grid grid-cols-3 gap-2 auto-rows-auto">
                @foreach ($bottomPhotos as $img)
                    @php
                        // Deteksi dimensi gambar
                        // Kita asumsikan $img adalah URL lengkap, jadi kita ambil path lokalnya untuk getimagesize
                        $path = str_replace(asset('storage'), storage_path('app/public'), $img);
                        $isLandscape = false;

                        if (file_exists($path)) {
                            [$width, $height] = getimagesize($path);
                            $isLandscape = $width > $height;
                        }
                    @endphp

                    <div @click="open = true; activeImg = '{{ $img }}'"
                        class="shadow-sm cursor-pointer overflow-hidden group {{ $isLandscape ? 'col-span-2' : 'col-span-1' }}">
                        <img src="{{ $img }}" {{-- Aspect ratio disesuaikan: Portrait 3:4, Landscape 4:3 (biar tinggi sejajar) --}}
                            class="w-full h-full  object-cover object-center transition duration-500 group-hover:scale-105 
                               {{ $isLandscape ? 'aspect-4/3' : 'aspect-2/3' }}"
                            loading="lazy">
                    </div>
                @endforeach
            </div>

            <div class="flex flex-col items-end opacity-40 mt-8">
                <img src="{{ asset('assets/png/javaneseessence/gunungan.png') }}" class="w-10 h-10 mb-2">
                <p class="font-poppins text-[10px] tracking-[0.3em] uppercase text-[#5a3a2e]">Mekar ing asmoro</p>
            </div>
        </div>
    @endif



    <div class="mt-20 flex flex-col items-center opacity-10">
        <div class="w-12 h-[0.5px] bg-[#5a3a2e]"></div>
    </div>
</section>

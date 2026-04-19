<?php

use Livewire\Component;

new class extends Component {
    public $invitation;
    public $photos = [];
    public function mount($invitation)
    {
        $this->invitation = $invitation;

        // 1. Ambil data mentah
        $rawData = $this->invitation->content['dynamic_photos'] ?? ($this->invitation->dynamic_photos ?? []);

        // 2. Filter hanya yang labelnya ada kata 'gallery'
        $this->photos = collect($rawData)
            ->filter(function ($photo) {
                // Kita cek apakah key 'label' mengandung kata 'gallery' (case insensitive)
                return isset($photo['label']) && str_contains(strtolower($photo['label']), 'gallery');
            })
            ->map(function ($photo) {
                return asset('storage/' . $photo['path']);
            })
            ->values() // Reset index array setelah difilter agar mulai dari 0 lagi
            ->toArray();

        // 3. Jika hasil filter kosong, beri placeholder
        if (empty($this->photos)) {
            $this->photos = [asset('assets/img/placeholder.png')];
        }
    }
};
?>

<div class="flex flex-col py-10 overflow-hidden">

    <!-- Header Galeri (Disamakan dengan gaya "The Ceremony") -->
    <div class="mb-5 relative " x-data="{ show: false }" x-intersect="show = true">
        <div x-show="show" x-transition:enter="transition ease-out duration-1000"
            x-transition:enter-start="opacity-0 translate-y-10" x-transition:enter-end="opacity-100 translate-y-0">
            <h2 class="font-utama text-5xl text-[#8C5A3C] leading-none italic text-left">The</h2>
            <h2 class="font-utama text-5xl text-black leading-none ml-10 -mt-2 text-left">Journey</h2>
            <div class="w-10 h-[2px] bg-[#8C5A3C] mt-4 ml-2"></div>
            <p class="font-poppins text-[9px] tracking-[0.4em] uppercase text-gray-400 mt-4 ml-2">Our Precious Moments
            </p>
        </div>
    </div>

    <!-- Slider Container dengan Alpine.js -->
    <div x-data="{
        active: 0,
        images: @js($photos),
        next() { this.active = (this.active + 1) % this.images.length },
        prev() { this.active = (this.active - 1 + this.images.length) % this.images.length }
    }" class="relative w-full overflow-hidden py-6">

        <!-- Track Slides -->
        <div class="flex items-center justify-center  relative min-h-[400px]">
            <template x-for="(img, index) in images" :key="index">
                <div class="absolute transition-all duration-700 ease-in-out transform cursor-pointer"
                    :class="{
                        'scale-110 z-30 opacity-100 translate-x-0': active === index,
                        'scale-90 z-20 opacity-40 -translate-x-36 ': active === (index + 1) % images
                            .length || (active === 0 && index === images.length - 1),
                        'scale-90 z-20 opacity-40 translate-x-36 ]': active === (index - 1 + images
                            .length) % images.length || (active === images.length - 1 && index === 0),
                        'opacity-0 scale-75 z-10': active !== index && active !== (index + 1) % images.length &&
                            active !== (index - 1 + images.length) % images.length
                    }"
                    @click="active = index">
                    <!-- Frame Foto Gaya Majalah -->
                    <div class="w-60 md:w-80 aspect-3/4 rounded-lg overflow-hidden shadow-md  relative">
                        <img :src="img" class="w-full h-full object-cover" alt="Gallery">
                        <!-- Overlay tipis agar lebih mewah -->
                        <div class="absolute inset-0 bg-black/5"></div>
                    </div>
                </div>
            </template>
        </div>

        <!-- Area Klik untuk Navigasi -->
        <div class="absolute inset-0 flex">
            <div @click="prev()" class="w-1/2 h-full cursor-pointer z-40"></div>
            <div @click="next()" class="w-1/2 h-full cursor-pointer z-40"></div>
        </div>

        <!-- Dot Pagination Minimalis -->
        <div class="flex justify-center gap-3 mt-10">
            <template x-for="(img, index) in images" :key="index">
                <button @click="active = index" class="h-1 transition-all duration-500 rounded-full"
                    :class="active === index ? 'w-10 bg-[#8C5A3C]' : 'w-2 bg-gray-200'"></button>
            </template>
        </div>
    </div>

    <!-- Petunjuk Halus -->
    <div class="mt-2 flex flex-col items-center justify-center gap-2">
        <div class="w-px h-8 bg-gray-100"></div>
        <p class="text-center font-poppins text-[9px] text-gray-400 tracking-[0.3em] uppercase">Tap to explore</p>
    </div>
</div>

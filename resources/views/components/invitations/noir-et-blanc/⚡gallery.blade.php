<?php
use Livewire\Component;

new class extends Component {
    public $invitation;
    public $galleryPhotos = [];
    public function mount($invitation)
    {
        $this->invitation = $invitation;
        // Ambil foto gallery secara berurutan
        for ($i = 1; $i <= 5; $i++) {
            $photo = $this->invitation->getPhoto("gallery$i");
            if ($photo) {
                $this->galleryPhotos[] = $photo;
            }
        }
    }
};
?>

<!-- Section: Gallery (The Lookbook) -->
<!-- Jarak & Padding tetap sama: py-24 px-6 -->
<div class="bg-white py-24 px-6 overflow-hidden" x-data="{
    activeIndex: 0,
    photos: @js($galleryPhotos)
}">
    <!-- Title Section: x-show diganti class binding agar jarak tidak lompat -->
    <div class="mb-16 relative" x-data="{ visible: false }" x-intersect.once="visible = true">
        <div class="flex flex-col transition-all duration-1000 transform"
            :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">
            <span class="font-serif italic text-xs text-gray-400 tracking-[0.4em] uppercase mb-2">Visual Narrative</span>
            <h2 class="font-vogue text-5xl text-black tracking-tighter uppercase leading-none">Our<br>Journey</h2>
        </div>
        <div class="absolute top-0 right-0 transition-opacity duration-1000 delay-500"
            :class="visible ? 'opacity-100' : 'opacity-0'">
            <p class="font-vogue text-[5rem] text-black/3 leading-none">2025</p>
        </div>
    </div>

    <!-- Gallery Grid: Struktur tetap sama -->
    <div class="space-y-5">

        <div class="grid grid-cols-12 gap-4 items-start" x-data="{ visible: false }" x-intersect.once="visible = true">
            <div class="col-span-8 shadow-2xl transition-all duration-1000 transform"
                :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">
                <img :src="photos[activeIndex]"
                    class="w-full aspect-3/4 object-cover grayscale hover:grayscale-0 transition-all duration-700">
            </div>

            <div class="col-span-4 mt-12 transition-all duration-1000 delay-300 transform"
                :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">
                <img src="{{ $invitation->getPhoto('gallery2') }}"
                    class="w-full aspect-square object-cover grayscale hover:grayscale-0 transition duration-700">
                <p class="mt-4 font-serif italic text-[9px] text-gray-400 leading-tight uppercase tracking-widest">
                    Captured Moments / 01</p>
            </div>
        </div>

        <div class="flex gap-2 overflow-x-auto [&::-webkit-scrollbar]:hidden snap-x">
            <template x-for="(photo, index) in photos" :key="index">
                <button @click="activeIndex = index" class="relative shrink-0 transition-all duration-500 snap-start"
                    :class="activeIndex === index ? 'w-13' : 'w-12'">
                    <img :src="photo"
                        class="aspect-square object-cover grayscale hover:grayscale-0 transition-all duration-500"
                        :class="activeIndex === index ? 'grayscale-0 border-b-2 border-black' : 'opacity-50'">
                </button>
            </template>
        </div>

        <!-- Row 2 -->
        <div class="relative" x-data="{ visible: false }" x-intersect.once="visible = true">
            <div class="transition-all duration-1000 transform"
                :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">
                <div class="w-full h-px bg-black/10 mb-8"></div>
                <div class="aspect-video overflow-hidden shadow-xl">
                    <img src="{{ $invitation->getPhoto('gallery3') }}"
                        class="w-full h-full object-cover grayscale hover:grayscale-0 transition duration-700">
                </div>
                <div class="absolute -bottom-4 right-6 bg-white p-4 shadow-lg border border-black/5">
                    <p class="font-vogue text-[10px] tracking-[0.3em] text-black uppercase">The Essence of Love</p>
                </div>
            </div>
        </div>

        <!-- Row 3 -->
        <div class="grid grid-cols-2 gap-6 pt-10" x-data="{ visible: false }" x-intersect.once="visible = true">
            <div class="space-y-4 transition-all duration-1000 transform"
                :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">
                <img src="{{ $invitation->getPhoto('gallery4') }}"
                    class="w-full aspect-4/5 object-cover grayscale hover:grayscale-0 transition duration-700">
                <div class="h-10 w-px bg-black mx-auto"></div>
            </div>
            <div class="pt-20 space-y-4 transition-all duration-1000 delay-300 transform"
                :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">
                <img src="{{ $invitation->getPhoto('gallery5') }}"
                    class="w-full aspect-4/5 object-cover grayscale hover:grayscale-0 transition duration-700 shadow-2xl">
                <p class="font-serif italic text-[9px] text-gray-400 uppercase tracking-widest text-right">Eternal
                    Archives / 02</p>
            </div>
        </div>

    </div>

    <!-- Quote Interlude -->
    <div class="mt-24 text-center px-10" x-data="{ visible: false }" x-intersect.once="visible = true">
        <div class="transition-all duration-1000 transform"
            :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">
            <p class="font-serif italic text-xs text-black/70 leading-relaxed">
                "In all the world, there is no heart for me like yours. In all the world, there is no love for you like
                mine."
            </p>
            <p class="mt-6 font-vogue text-[10px] tracking-[0.5em] text-black uppercase">— Maya Angelou</p>
        </div>
    </div>
</div>

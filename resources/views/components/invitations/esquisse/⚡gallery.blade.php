<?php

use Livewire\Component;

new class extends Component {
    public $invitation;
    public $photos = [];
    public $videoEmbed = null;

    public function mount($invitation)
    {
        $this->invitation = $invitation;

        // Video Embed Youtube (jika ada)
        $rawVideo = $this->invitation->content['link_video'] ?? null;
        if ($rawVideo) {
            $videoId = null;
            if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $rawVideo, $match)) {
                $videoId = $match[1];
            }
            if ($videoId) {
                $this->videoEmbed = 'https://www.youtube.com/embed/' . $videoId;
            }
        }

        // Ambil semua foto gallery dari dynamic_photos
        $rawData = $this->invitation->content['dynamic_photos'] ?? ($this->invitation->dynamic_photos ?? []);
        $this->photos = collect($rawData)
            ->filter(function ($photo) {
                return isset($photo['label']) && str_contains(strtolower($photo['label']), 'gallery');
            })
            ->map(function ($photo) {
                $path = is_array($photo) ? $photo['path'] ?? '' : $photo;
                return asset('storage/' . $path);
            })
            ->values()
            ->toArray();

        // Fallback jika foto gallery belum diisi
        if (empty($this->photos)) {
            $this->photos = array_filter([$this->invitation->getPhoto('c1'), $this->invitation->getPhoto('c2'), $this->invitation->getPhoto('groom'), $this->invitation->getPhoto('bride')]);
        }
    }
};
?>

<section x-data="{
    open: false,
    activeImg: '',
    activeIndex: 0,
    photos: @js($photos),
    selectPhoto(idx) {
        this.activeIndex = idx;
    },
    prev() {
        this.activeIndex = (this.activeIndex > 0) ? this.activeIndex - 1 : this.photos.length - 1;
        this.activeImg = this.photos[this.activeIndex];
    },
    next() {
        this.activeIndex = (this.activeIndex < this.photos.length - 1) ? this.activeIndex + 1 : 0;
        this.activeImg = this.photos[this.activeIndex];
    },
    openLightbox() {
        this.activeImg = this.photos[this.activeIndex];
        this.open = true;
    }
}"
    class="relative w-full bg-[#F9F8F6] py-14 px-5 overflow-hidden max-w-md mx-auto text-gray-800">

    <!-- Background Texture bg3.png (Doodle / Paper Texture) -->
    <img src="{{ asset('assets/png/esquisse/bg3.png') }}"
        class="absolute inset-0 w-full h-full object-cover opacity-5 pointer-events-none z-0" alt="Background Texture">

    <!-- ========================================== -->
    <!-- LIGHTBOX MODAL (FULLSCREEN PREVIEW) -->
    <!-- ========================================== -->
    <div x-show="open" x-transition.opacity.duration.300ms @keydown.escape.window="open = false"
        @keydown.arrow-left.window="prev()" @keydown.arrow-right.window="next()"
        class="fixed inset-0 z-50 bg-black/95 backdrop-blur-md flex items-center justify-center p-4 select-none"
        style="display: none;">

        <!-- Close Button -->
        <button @click="open = false" type="button"
            class="absolute top-6 right-6 text-white/70 hover:text-white p-2 rounded-full focus:outline-none transition-colors z-20">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <!-- Prev Button -->
        <button @click="prev()" type="button"
            class="absolute left-3 top-1/2 -translate-y-1/2 text-white/70 hover:text-white p-2.5 rounded-full bg-white/10 hover:bg-white/20 transition-all z-20">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </button>

        <!-- Next Button -->
        <button @click="next()" type="button"
            class="absolute right-3 top-1/2 -translate-y-1/2 text-white/70 hover:text-white p-2.5 rounded-full bg-white/10 hover:bg-white/20 transition-all z-20">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </button>

        <!-- Preview Image -->
        <div class="relative max-w-full max-h-[85vh] flex flex-col items-center">
            <img :src="activeImg" class="max-w-full max-h-[78vh] object-contain rounded-lg shadow-2xl">
            <p class="font-indie text-xs text-white/60 tracking-widest mt-4 uppercase"
                x-text="`Photo ${(activeIndex + 1)} of ${photos.length}`"></p>
        </div>
    </div>

    <div class="relative z-10 flex flex-col items-center">

        <!-- ========================================== -->
        <!-- HEADER / TITLE SECTION -->
        <!-- ========================================== -->
        <div x-data="{ show: false }" x-intersect.half.once="show = true"
            class="mb-10 flex flex-col items-center text-center relative w-full">

            <!-- Watermark Typography "Moments" -->
            {{-- <h3 x-show="show" x-transition:enter="transition ease-in-out duration-1200 delay-200"
                x-transition:enter-start="opacity-0 -translate-x-10" x-transition:enter-end="opacity-100 translate-x-0"
                class="absolute -top-12 -left-2 font-abigail text-black/[0.05] text-[7.5rem] sm:text-[9rem] leading-none pointer-events-none select-none z-0">
                Moments
            </h3> --}}

            <div class="relative z-10 flex flex-col items-center">
                <h2 x-show="show" x-transition:enter="transition ease-out duration-1000"
                    x-transition:enter-start="opacity-0 -translate-y-4"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    class="font-samantha text-4xl  text-black mb-2 select-none">
                    Our Moments
                </h2>
                <div x-show="show" x-transition:enter="transition ease-out duration-1000 delay-300"
                    x-transition:enter-start="opacity-0 scale-75" x-transition:enter-end="opacity-100 scale-100"
                    class="flex items-center gap-3">
                    <div class="h-px w-10 bg-black/20"></div>
                    <p class="font-indie text-xs tracking-[0.35em] uppercase text-black/60 font-bold">The Gallery</p>
                    <div class="h-px w-10 bg-black/20"></div>
                </div>
            </div>
        </div>

        <!-- ========================================== -->
        <!-- VIDEO EMBED (JIKA ADA) -->
        <!-- ========================================== -->
        @if ($videoEmbed)
            <div x-data="{ show: false }" x-intersect.half.once="show = true" class="w-full mb-10 relative z-10">
                <div x-show="show" x-transition:enter="transition ease-out duration-1000"
                    x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                    class="relative w-full aspect-video rounded-3xl overflow-hidden shadow-md border border-black/15 bg-black">
                    <iframe class="absolute inset-0 w-full h-full" src="{{ $videoEmbed }}" title="Wedding Video"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen>
                    </iframe>
                </div>
                <div class="flex items-center justify-center gap-2 mt-3">
                    <span class="w-2 h-2 rounded-full bg-red-500 animate-pulse"></span>
                    <p class="font-indie text-xs tracking-wider text-black/60">Our Wedding Video</p>
                </div>
            </div>
        @endif

        @if (count($photos) > 0)
            <!-- ========================================== -->
            <!-- HERO POLAROID SHOWCASE + FILMSTRIP (RINGKAS & BOLD) -->
            <!-- ========================================== -->
            <div x-data="{ show: false }" x-intersect.half.once="show = true" class="w-full flex flex-col items-center">

                <!-- 1. HERO POLAROID CARD -->
                <div x-show="show" x-transition:enter="transition ease-out duration-1000"
                    x-transition:enter-start="opacity-0 scale-90 -rotate-3"
                    x-transition:enter-end="opacity-100 scale-100 -rotate-1"
                    class="relative w-full max-w-sm bg-white p-3.5 sm:p-4 rounded-3xl shadow-lg border border-black/15 -rotate-1 hover:rotate-0 transition-transform duration-500">

                    {{-- <!-- Washi Tape Sketsa di Atas -->
                    <div
                        class="absolute -top-3.5 left-1/2 -translate-x-1/2 w-24 h-7 bg-amber-100/90 border-t border-b border-black/15 rotate-1 shadow-2xs pointer-events-none z-30 flex items-center justify-center">
                        <div class="w-14 h-px bg-black/15"></div>
                    </div> --}}

                    <!-- Frame Foto Utama -->
                    <div @click="openLightbox()"
                        class="relative w-full aspect-[4/5] rounded-2xl overflow-hidden bg-neutral-100 cursor-pointer group shadow-inner">

                        <!-- Active Image -->
                        <img :src="photos[activeIndex]" alt="Our Moment"
                            class="w-full h-full object-cover transition-all duration-500 group-hover:scale-105">

                        <!-- Tombol Prev -->
                        <button @click.stop="prev()" type="button" aria-label="Previous Photo"
                            class="absolute left-2.5 top-1/2 -translate-y-1/2 w-9 h-9 rounded-full bg-white/85 hover:bg-white text-black shadow-md border border-black/10 flex items-center justify-center transition-all hover:scale-110 z-20 focus:outline-none">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>

                        <!-- Tombol Next -->
                        <button @click.stop="next()" type="button" aria-label="Next Photo"
                            class="absolute right-2.5 top-1/2 -translate-y-1/2 w-9 h-9 rounded-full bg-white/85 hover:bg-white text-black shadow-md border border-black/10 flex items-center justify-center transition-all hover:scale-110 z-20 focus:outline-none">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </button>

                        <!-- Expand / Zoom Hint Icon -->
                        <div
                            class="absolute bottom-2.5 right-2.5 bg-black/50 hover:bg-black/70 text-white p-2 rounded-xl backdrop-blur-xs opacity-75 group-hover:opacity-100 transition-all pointer-events-none">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4" />
                            </svg>
                        </div>
                    </div>

                    <!-- Footer Caption Polaroid -->
                    <div class="mt-3.5 px-1.5 flex items-center justify-between">
                        <div>
                            <p class="font-indie text-sm text-black font-bold tracking-wide">
                                Forever & Always
                            </p>
                            <p class="font-indie text-[11px] text-black/50">
                                Click photo to enlarge
                            </p>
                        </div>
                        <div class="flex items-center gap-1.5">
                            <span
                                class="font-indie text-xs text-black/70 font-bold bg-[#F9F8F6] px-2.5 py-0.5 rounded-full border border-black/10"
                                x-text="`${String(activeIndex + 1).padStart(2, '0')} / ${String(photos.length).padStart(2, '0')}`">
                            </span>
                        </div>
                    </div>
                </div>

                <!-- 2. MINI FILMSTRIP / THUMBNAILS RIBBON -->
                <div x-show="show" x-transition:enter="transition ease-out duration-1000 delay-200"
                    x-transition:enter-start="opacity-0 translate-y-4"
                    x-transition:enter-end="opacity-100 translate-y-0" class="w-full mt-6 flex flex-col items-center">

                    <div
                        class="w-full flex gap-2.5 overflow-x-auto pb-2 pt-1 px-1 snap-x [&::-webkit-scrollbar]:hidden justify-start sm:justify-center">
                        <template x-for="(photo, index) in photos" :key="index">
                            <button type="button" @click="selectPhoto(index)"
                                class="shrink-0 w-14 h-14 sm:w-16 sm:h-16 rounded-xl overflow-hidden cursor-pointer snap-start transition-all duration-300 focus:outline-none"
                                :class="activeIndex === index ?
                                    'border-2 border-black scale-105 shadow-md opacity-100 -translate-y-1' :
                                    'border border-black/20 opacity-50 hover:opacity-90 hover:scale-100'">
                                <img :src="photo" class="w-full h-full object-cover">
                            </button>
                        </template>
                    </div>

                    <!-- Dot Progress Indicator -->
                    <div class="flex items-center gap-1.5 mt-3">
                        <template x-for="(photo, index) in photos" :key="'dot-' + index">
                            <button type="button" @click="selectPhoto(index)"
                                class="h-1.5 rounded-full transition-all duration-300 focus:outline-none"
                                :class="activeIndex === index ? 'w-5 bg-black' : 'w-1.5 bg-black/20 hover:bg-black/40'">
                            </button>
                        </template>
                    </div>
                </div>

            </div>
        @endif

    </div>
</section>

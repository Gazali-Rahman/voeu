<?php

use Livewire\Component;

new class extends Component {
    public $invitation;
    public $stories = [];

    public function mount($invitation)
    {
        $this->invitation = $invitation;
        $this->stories = collect($this->invitation->content['love_stories'] ?? [])->toArray();
    }
};
?>

<section class="relative w-full bg-[#F9F8F6] py-16 px-5 overflow-hidden max-w-md mx-auto text-gray-800">

    {{-- <!-- Background Texture bg3.png (Doodle / Paper Texture) -->
    <img src="{{ asset('assets/png/esquisse/bg3.png') }}"
        class="absolute inset-0 w-full h-full object-cover opacity-5 pointer-events-none z-0"
        alt="Background Texture"> --}}

    <div class="relative z-10 flex flex-col items-center">

        <!-- ========================================== -->
        <!-- HEADER / TITLE SECTION -->
        <!-- ========================================== -->
        <div x-data="{ show: false }" x-intersect.half.once="show = true"
            class="mb-14 flex flex-col items-center text-center relative w-full">

            <!-- Watermark Typography "Journey" -->
            {{-- <h3 x-show="show" x-transition:enter="transition ease-in-out duration-1200 delay-200"
                x-transition:enter-start="opacity-0 -translate-x-10" x-transition:enter-end="opacity-100 translate-x-0"
                class="absolute -top-12 -left-2 font-abigail text-black/[0.05] text-[7.5rem] sm:text-[9rem] leading-none pointer-events-none select-none z-0">
                Journey
            </h3> --}}



            <div class="relative z-10 flex flex-col items-center">
                <h2 x-show="show" x-transition:enter="transition ease-out duration-1000"
                    x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
                    class="font-samantha text-5xl sm:text-6xl text-black mb-2 select-none">
                    Love Story
                </h2>
                <div x-show="show" x-transition:enter="transition ease-out duration-1000 delay-300"
                    x-transition:enter-start="opacity-0 scale-75" x-transition:enter-end="opacity-100 scale-100"
                    class="flex items-center gap-3">
                    <div class="h-px w-10 bg-black/20"></div>
                    <p class="font-indie text-xs tracking-[0.35em] uppercase text-black/60 font-bold">The Chronicles</p>
                    <div class="h-px w-10 bg-black/20"></div>
                </div>
            </div>
        </div>

        @if (count($stories) > 0)
            <!-- ========================================== -->
            <!-- SCRAPBOOK TIMELINE JOURNAL -->
            <!-- ========================================== -->
            <div class="relative w-full max-w-sm">

                <!-- Hand-drawn Dashed Timeline Stem -->
                <div
                    class="absolute left-6 top-6 bottom-6 w-0.5 border-l-2 border-dashed border-black/20 pointer-events-none">
                </div>

                <div class="flex flex-col space-y-8">
                    @foreach ($stories as $index => $story)
                        @php
                            $rot = $index % 2 === 0 ? '-rotate-1' : 'rotate-1';
                            $tapeRot = $index % 2 === 0 ? 'rotate-6' : '-rotate-6';
                            $storyText = $story['story'] ?? ($story['description'] ?? '');
                        @endphp

                        <div x-data="{ show: false }" x-intersect.half.once="show = true"
                            class="relative flex items-start pl-12 group">

                            <!-- Timeline Pin Marker -->
                            <div x-show="show" x-transition:enter="transition ease-out duration-600 delay-100"
                                x-transition:enter-start="opacity-0 scale-50"
                                x-transition:enter-end="opacity-100 scale-100"
                                class="absolute left-6 top-5 -translate-x-1/2 w-6 h-6 rounded-full bg-white border-2 border-black flex items-center justify-center shadow-xs z-20 group-hover:scale-110 transition-transform">
                                <span class="w-2 h-2 rounded-full bg-black"></span>
                            </div>

                            <!-- Scrapbook Journal Card -->
                            <div x-show="show" x-transition:enter="transition ease-out duration-1000 delay-200"
                                x-transition:enter-start="opacity-0 translate-x-8"
                                x-transition:enter-end="opacity-100 translate-x-0"
                                class="relative w-full bg-white/95 border border-black/15 rounded-2xl p-5 sm:p-6 shadow-sm hover:shadow-md transition-all duration-300 {{ $rot }} hover:rotate-0">

                                <!-- Washi Tape Accent at Top Corner -->
                                <div
                                    class="absolute -top-3.5 right-6 w-14 h-5 bg-amber-100/90 border-t border-b border-black/15 {{ $tapeRot }} shadow-2xs pointer-events-none z-20 flex items-center justify-center">
                                    <div class="w-8 h-px bg-black/15"></div>
                                </div>

                                <!-- Chapter Header: Year & Index -->
                                <div class="flex items-center justify-between mb-4">
                                    <span
                                        class="inline-flex items-center px-3 py-0.5 rounded-full bg-[#F9F8F6] border border-black/15 font-indie text-xs text-black/80 font-bold tracking-wider">
                                        {{ $story['year'] ?? 'Chapter ' . ($index + 1) }}
                                    </span>
                                    <span class="font-indie text-xs text-black/35 font-bold">
                                        #{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                                    </span>
                                </div>

                                <!-- Story Title -->
                                <h3 class="font-samantha text-2xl text-black mb-2 leading-tight">
                                    {{ $story['title'] ?? 'Our Story' }}
                                </h3>

                                <!-- Story Body -->
                                <p class="font-indie text-xs  text-black/75 leading-relaxed text-justify">
                                    {{ $storyText }}
                                </p>

                                <!-- Card Decorative Corner Star -->
                                <div class="mt-3 flex justify-end items-center opacity-40">
                                    <span class="font-indie text-xs">✦</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Closing Note -->
                <div x-data="{ show: false }" x-intersect.half.once="show = true"
                    class="mt-14 flex flex-col items-center text-center">
                    <div x-show="show" x-transition:enter="transition ease-out duration-1000"
                        x-transition:enter-start="opacity-0 translate-y-4"
                        x-transition:enter-end="opacity-100 translate-y-0" class="flex flex-col items-center">

                        <p class="font-samantha text-2xl text-black/80 mb-1">To Be Continued...</p>
                        <p class="font-indie text-xs text-black/50 tracking-wider">Our best chapters are yet to come</p>
                    </div>
                </div>

            </div>
        @else
            <div class="text-center py-10 px-6 bg-white/80 border border-black/15 rounded-3xl max-w-sm">
                <p class="font-indie text-sm text-black/60 italic">Kisah cinta kami akan segera dibagikan di sini.</p>
            </div>
        @endif

    </div>
</section>

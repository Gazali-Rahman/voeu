<?php

use Livewire\Component;

new class extends Component {
    public $invitation;
    public $stories = [];

    public function mount($invitation)
    {
        $this->invitation = $invitation;

        // Ambil data love_stories dari kolom content di database
        // Kita gunakan collect agar aman jika datanya kosong
        $this->stories = collect($this->invitation->content['love_stories'] ?? [])->toArray();
    }
};
?>

<section class="relative flex flex-col py-20 overflow-hidden max-w-md mx-auto">

    <div x-data="{ show: false }" x-intersect="show = true" class="relative w-full mb-24 flex flex-col items-start px-6">
        <h3 x-show="show" x-transition:enter="transition ease-in-out duration-1000 "
            x-transition:enter-start="-translate-x-full " x-transition:enter-end="translate-x-0"
            class="absolute -top-10 left-4 font-abigail text-[#5a3a2e]/5 text-[6rem] leading-none pointer-events-none uppercase">
            Story
        </h3>

        <div class="relative z-10 mt-6 ml-4">
            <h2 x-show="show" x-transition:enter="transition ease-in-out duration-1000 delay-500"
                x-transition:enter-start="opacity-0 translate-x-100 " x-transition:enter-end="opacity-100 translate-x-0"
                class="font-abigail text-[#5a3a2e] text-[4rem] leading-[0.8] tracking-tighter drop-shadow-sm">
                Love <br> <span class="ml-12 border-b border-[#5a3a2e]/10">Journey</span>
            </h2>

            <div x-show="show" x-transition:enter="transition ease-in-out duration-1000 delay-1000"
                x-transition:enter-start="opacity-0 -translate-x-100 "
                x-transition:enter-end="opacity-100 translate-x-0" class="mt-8 flex items-center gap-3 opacity-40">
                <div class="w-8 h-[0.5px] bg-[#5a3a2e]"></div>
                <p class="font-poppins text-[#5a3a2e] text-[9px] tracking-[0.5em] uppercase">How It Started</p>
            </div>
        </div>
    </div>

    <div class="relative px-8">
        <div class="space-y-20">
            @foreach ($stories as $index => $story)
                {{-- Kita pindahkan x-data ke sini dengan konfigurasi intersect --}}
                <div x-data="{ show: false }" {{-- .margin="-10% 0px -10% 0px" artinya elemen baru dianggap 'masuk' 
                      setelah lewat 10% dari bawah layar. Ini mencegah mereka muncul barengan --}} x-intersect.margin.-10%.0px.-10%.0px="show = true"
                    class="relative pl-12 min-h-[100px]"> {{-- min-h membantu agar pemicu tidak menumpuk --}}

                    <div class="absolute left-0 top-1 w-6 h-6 flex items-center justify-center">
                        <img src="{{ asset('assets/png/javaneseessence/gunungan.png') }}"
                            class="w-10 h-auto {{ $loop->last ? 'opacity-80' : 'opacity-60' }}">
                    </div>

                    {{-- Animasi --}}
                    <div x-show="show" x-transition:enter="transition ease-out duration-1000"
                        x-transition:enter-start="opacity-0 translate-y-8" {{-- Ubah ke translate-y agar lebih smooth --}}
                        x-transition:enter-end="opacity-100 translate-y-0" class="space-y-3">

                        <span
                            class="font-poppins text-[10px] tracking-[0.3em] text-[#5a3a2e]/50 uppercase font-semibold">
                            {{ $story['year'] ?? '' }}
                        </span>

                        <h4 class="font-abigail text-2xl text-[#5a3a2e] tracking-wide">
                            {{ $story['title'] ?? '' }}
                        </h4>

                        <p class="font-poppins text-[11px] leading-relaxed text-[#5a3a2e]/70 text-justify">
                            {{ $story['story'] ?? '' }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="mt-24 flex flex-col items-center opacity-20">
        <div class="w-px h-12 bg-linear-to-b from-[#5a3a2e] to-transparent"></div>
    </div>
</section>

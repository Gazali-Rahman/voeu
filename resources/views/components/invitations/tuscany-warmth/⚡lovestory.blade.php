<?php

use Livewire\Component;

new class extends Component {
    public $stories; // Ubah nama biar lebih jelas kalau ini list stories

    public function mount($invitation)
    {
        // Ambil array love_stories dari kolom content
        $this->stories = $invitation->content['love_stories'] ?? [];
    }
};
?>

<div class="flex flex-col py-10 overflow-hidden ">

    <!-- Header Section -->
    <div class="mb-16 relative px-2" x-data="{ show: false }" x-intersect="show = true">
        <div x-show="show" x-transition:enter="transition ease-out duration-1000">
            <h2 class="font-utama text-5xl text-[#8C5A3C] leading-none italic text-left">Our</h2>
            <h2 class="font-utama text-5xl text-black leading-none ml-10 -mt-2 text-left">Love Story</h2>
            <div class="w-10 h-[2px] bg-[#8C5A3C] mt-4 ml-2"></div>
        </div>
    </div>

    <!-- Timeline Container -->
    <div class="relative">
        <!-- Garis Tengah Timeline -->
        <div class="absolute left-6 top-0 h-full w-px bg-[#8C5A3C]/30"></div>

        <div class="space-y-16">
            @foreach ($stories as $index => $story)
                <div x-data="{ show: false }" x-intersect="show = true" class="relative pl-14">
                    <div
                        class="absolute left-[21px] top-2 w-2.5 h-2.5 rounded-full bg-[#8C5A3C] shadow-[0_0_10px_rgba(140,90,60,0.5)]">
                    </div>

                    <div x-show="show" x-transition:enter="transition ease-out duration-1000"
                        x-transition:enter-start="opacity-0 translate-x-10"
                        x-transition:enter-end="opacity-100 translate-x-0"
                        style="transition-delay: {{ $index * 200 }}ms">

                        <span class="font-poppins text-[10px] tracking-[0.3em] text-[#8C5A3C] font-bold uppercase">
                            {{ $story['date'] ?? '' }}
                        </span>

                        <h3 class="font-utama text-2xl text-black mt-2 mb-3">
                            {{ $story['title'] ?? '' }}
                        </h3>

                        <p class="font-poppins text-xs text-gray-500 leading-relaxed italic pr-4">
                            "{{ $story['story'] ?? '' }}"
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Dekorasi Kutipan Penutup -->
    <div class="mt-20 flex flex-col items-center text-center px-8" x-data="{ show: false }" x-intersect="show = true">
        <div x-show="show" x-transition:enter="transition ease-out duration-1000 delay-700">
            <img src="{{ asset('/assets/png/tuscanywarmth/cincin1.png') }}"
                class="w-8 h-8 object-contain mb-6 opacity-20 brightness-0">
            <p class="font-poppins text-sm text-black leading-relaxed italic ">
                "And we created you in pairs"
            </p>
            <p class="font-poppins text-[10px] tracking-[0.2em] text-gray-400 mt-2 uppercase">( An-Naba' : 8 )</p>
        </div>
    </div>
</div>

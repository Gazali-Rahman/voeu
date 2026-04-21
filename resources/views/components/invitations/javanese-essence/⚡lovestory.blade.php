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

    <div class="relative w-full mb-24 flex flex-col items-start px-6">
        <h3
            class="absolute -top-10 left-4 font-abigail text-[#5a3a2e]/5 text-[6rem] leading-none pointer-events-none uppercase">
            Story
        </h3>

        <div class="relative z-10 mt-6 ml-4">
            <h2 class="font-abigail text-[#5a3a2e] text-[4rem] leading-[0.8] tracking-tighter drop-shadow-sm">
                Love <br> <span class="ml-12 border-b border-[#5a3a2e]/10">Journey</span>
            </h2>

            <div class="mt-8 flex items-center gap-3 opacity-40">
                <div class="w-8 h-[0.5px] bg-[#5a3a2e]"></div>
                <p class="font-poppins text-[#5a3a2e] text-[9px] tracking-[0.5em] uppercase">How It Started</p>
            </div>
        </div>
    </div>

    <div class="relative px-8">
        <div class="space-y-20">
            @foreach ($stories as $index => $story)
                <div class="relative pl-12">
                    <div class="absolute left-0 top-1 w-6 h-6 flex items-center justify-center ">
                        <img src="{{ asset('assets/png/javaneseessence/gunungan.png') }}"
                            class="w-10 h-auto {{ $loop->last ? 'opacity-80' : 'opacity-60' }}">
                    </div>

                    <div class="space-y-3">
                        <span
                            class="font-poppins text-[10px] tracking-[0.3em] text-[#5a3a2e]/50 uppercase font-semibold">
                            {{ $story['year'] ?? '' }}
                        </span>

                        <h4 class="font-abigail text-2xl text-[#5a3a2e] tracking-wide ">
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

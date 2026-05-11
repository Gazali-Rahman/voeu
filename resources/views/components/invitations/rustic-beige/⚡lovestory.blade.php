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

<div>
    <div class="py-20 px-6 relative flex flex-col items-center overflow-hidden ">

        <div class="text-center z-10 mb-12">
            <p class="text-[9px] font-['Poppins'] text-[#3E2C23]/60 uppercase tracking-[0.5em] mb-3">
                Our Journey
            </p>
            <h2 class="text-4xl font-['Abigail'] text-[#3E2C23] drop-shadow-sm">Love Story</h2>
        </div>

        <div class="absolute top-1/4 -right-16 transform rotate-90 origin-center z-0 opacity-[0.03] pointer-events-none">
            <span class="text-[7rem] font-['Abigail'] text-[#3E2C23] whitespace-nowrap">Endless Love</span>
        </div>
        {{-- 
        <div class="absolute top-10 -left-10 w-40 z-0 opacity-30 pointer-events-none">
            <img src="{{ asset('assets/png/catalog6/bunga3.png') }}" alt="Bunga" class="w-full object-cover">
        </div> --}}

        <div class="w-full max-w-sm relative z-10">

            @if (count($stories) > 0)
                <div
                    class="absolute left-[1.35rem] top-8 bottom-8 w-[1px] bg-gradient-to-b from-transparent via-[#3E2C23]/20 to-transparent">
                </div>

                <div class="flex flex-col gap-8">
                    @foreach ($stories as $index => $story)
                        <div class="relative pl-14">

                            <div
                                class="absolute left-4 top-5 w-3.5 h-3.5 rounded-full bg-white border-[3px] border-[#3E2C23] shadow-sm z-10">
                            </div>

                            <div
                                class="bg-[#F5EBE1] border border-[#3E2C23]/10 rounded-[2rem] p-6 shadow-sm relative overflow-hidden group hover:shadow-md transition-all duration-300">

                                <div class="absolute -top-4 -right-4 w-25  -rotate-90 pointer-events-none">
                                    <img src="{{ asset('assets/png/catalog6/bunga3.png') }}" alt="Ornamen"
                                        class="w-full object-cover">
                                </div>

                                <span
                                    class="inline-block px-3 py-1 bg-[#3E2C23]/5 rounded-full text-[9px] font-['Poppins'] text-[#3E2C23] tracking-widest uppercase font-medium mb-4">
                                    {{ $story['year'] ?? '20XX' }}
                                </span>

                                <h3 class="text-2xl font-['Abigail'] text-[#3E2C23] mb-2 relative z-10">
                                    {{ $story['title'] ?? 'Awal Bertemu' }}
                                </h3>

                                <p class="text-[10px] font-['Poppins'] text-[#3E2C23]/70 leading-relaxed relative z-10">
                                    {{ $story['description'] ?? 'Cerita cinta kami bermula dari sini, sebuah momen sederhana yang tak pernah kami sangka akan membawa kami pada hari yang paling membahagiakan ini.' }}
                                </p>
                            </div>

                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-10 bg-gray-50 border border-[#3E2C23]/10 rounded-[2rem]">
                    <p class="text-[10px] font-['Poppins'] text-[#3E2C23]/50 italic">Kisah cinta kami akan segera
                        dibagikan di sini.</p>
                </div>
            @endif

        </div>

    </div>
</div>

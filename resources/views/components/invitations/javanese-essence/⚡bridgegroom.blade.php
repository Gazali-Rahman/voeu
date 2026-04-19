<?php

use Livewire\Component;

new class extends Component {
    public $invitation;

    public function mount($invitation)
    {
        $this->invitation = $invitation;
    }
};
?>

<section class="relative w-full  py-10 px-6 overflow-hidden max-w-md mx-auto ">

    <div class="absolute top-20 left-[-20%] opacity-[0.05] grayscale pointer-events-none">
        <img src="{{ asset('assets/png/javaneseessence/cowo.png') }}" class="w-80 h-auto rotate-12">
    </div>
    <div class="absolute top-[42%] right-[-20%] opacity-[0.05] grayscale pointer-events-none">
        <img src="{{ asset('assets/png/javaneseessence/cewe.png') }}" class="w-80 h-auto -rotate-12">
    </div>

    <div class="relative z-10 flex flex-col items-center">

        <div class="mb-24 flex flex-col items-center">
            <h2 class="font-abigail text-[#5a3a2e] text-5xl tracking-[0.2em] mb-2 uppercase opacity-90">The Profile</h2>
            <div class="flex items-center gap-4">
                <div class="h-px w-12 bg-[#5a3a2e]/20"></div>
                <p class="text-[#5a3a2e]/50 text-[9px] tracking-[0.6em] uppercase font-light">Bridge & Groom</p>
                <div class="h-px w-12 bg-[#5a3a2e]/20"></div>
            </div>
        </div>

        <div class="relative w-full mb-40 flex flex-col items-start">
            <h3
                class="absolute -top-12 left-4 font-abigail text-[#5a3a2e]/10 text-[9rem] leading-none pointer-events-none">
                Bridge</h3>

            <div class="relative w-64 h-80 self-end mr-4">
                <div class="absolute -inset-4 border border-[#5a3a2e]/10 -z-10"></div>
                <div class="w-full h-full overflow-hidden shadow-2xl ">
                    <img src="{{ $invitation->getPhoto('bridge') }}" class="w-full h-full object-cover">
                </div>
                <div class="absolute -bottom-10 -left-16">
                    <h4 class="font-abigail text-[#5a3a2e] text-[5.5rem] leading-none drop-shadow-sm">Andrea</h4>
                </div>
            </div>

            <div class="mt-16 ml-4 text-left border-l-2 border-[#5a3a2e]/10 pl-4">
                <p class="font-poppins text-[#5a3a2e] text-[11px] tracking-[0.3em] uppercase font-bold mb-1">Heppy
                    Andriani, S.T.</p>
                <p class="font-poppins text-[#5a3a2e]/60 text-[10px] italic leading-relaxed">
                    Putra dari Bpk. Hansyah <br> & Ibu Noorhasanah
                </p>
            </div>
        </div>


        <div class="relative w-full mb-20 flex flex-col items-end">
            <h3
                class="absolute -top-12 right-4 font-abigail text-[#5a3a2e]/10 text-[9rem] leading-none pointer-events-none text-right">
                Groom</h3>

            <div class="relative w-64 h-80 self-start ml-4">
                <div class="absolute -inset-4 border border-[#5a3a2e]/10 -z-10"></div>
                <div class="w-full h-full overflow-hidden shadow-2xl ">
                    <img src="{{ $invitation->getPhoto('groom') }}" class="w-full h-full object-cover">
                </div>
                <div class="absolute -bottom-10 -right-16 text-right">
                    <h4 class="font-abigail text-[#5a3a2e] text-[5.5rem] leading-none drop-shadow-sm">Dinda</h4>
                </div>
            </div>

            <div class="mt-16 mr-4 text-right border-r-2 border-[#5a3a2e]/10 pr-4">
                <p class="font-poppins text-[#5a3a2e] text-[11px] tracking-[0.3em] uppercase font-bold mb-1">Dinda
                    Wulandari, S.T.</p>
                <p class="font-poppins text-[#5a3a2e]/60 text-[10px] italic leading-relaxed">
                    Putri dari Bpk. Suyoto <br> & Ibu Sri Kusni
                </p>
            </div>
        </div>

        <div class="mt-10 mb-8 flex flex-col items-center">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10">
                    <img src="{{ asset('assets/png/javaneseessence/gunungan.png') }}" alt="Gunungan"
                        class="w-full h-full object-contain grayscale"
                        style="filter: sepia(1) saturate(2) hue-rotate(-20deg);">
                    {{-- Filter di atas untuk menyamakan warna PNG dengan tema coklat tua #5a3a2e jika file asli berwarna hitam --}}
                </div>
            </div>
            <p class="font-poppins text-[#5a3a2e] text-xs tracking-widest  opacity-80 mb-6">
                Nyawiji ing tresno jati
            </p>
        </div>

    </div>
</section>

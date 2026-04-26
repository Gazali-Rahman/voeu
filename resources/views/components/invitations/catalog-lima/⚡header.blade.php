<?php
use Livewire\Component;

new class extends Component {
    //
};
?>

<section class="max-w-md mx-auto bg-black h-screen relative overflow-hidden flex flex-col justify-center items-center">

    <div class="absolute inset-0 z-0">
        <img src="{{ $invitation->getPhoto('c1') }}" class="w-full h-full object-cover opacity-60 brightness-[0.8]"
            alt="Background Couple">

    </div>

    <div class="absolute inset-6 pointer-events-none z-20">
        <div class="absolute top-0 left-0 w-8 h-8 border-t-[1px] border-l-[1px] border-white/40"></div>
        <div class="absolute top-0 right-0 w-8 h-8 border-t-[1px] border-r-[1px] border-white/40"></div>
        <div class="absolute bottom-0 left-0 w-8 h-8 border-b-[1px] border-l-[1px] border-white/40"></div>
        <div class="absolute bottom-0 right-0 w-8 h-8 border-b-[1px] border-r-[1px] border-white/40"></div>
    </div>

    <div class="absolute top-10 left-10 right-10 flex justify-between items-center z-20 font-mono">
        <div class="flex items-center gap-1.5">
            <div class="w-1.5 h-1.5 rounded-full bg-red-500 animate-pulse"></div>
            <span class="text-[8px] uppercase tracking-[0.2em] text-white/90">REC 00:12:12:26</span>
        </div>
        <span class="text-[8px] uppercase tracking-[0.2em] text-white/90">RAW 4K f/2.8</span>
    </div>

    <div class="relative z-10 flex flex-col items-center text-center px-6">

        <div class="mb-4 flex items-center justify-center opacity-40">
            <div class="w-4 h-[0.5px] bg-white"></div>
            <div class="w-2 h-2 border-[0.5px] border-white mx-2 rotate-45"></div>
            <div class="w-4 h-[0.5px] bg-white"></div>
        </div>

        <p class="text-[10px] font-mono tracking-[0.6em] uppercase text-white/60 mb-2 ml-[0.6em]">The Wedding Of</p>
        <h1 class="font-abigail text-4xl text-white drop-shadow-2xl">Romi & Sari</h1>

        <div class="mt-8 flex items-center gap-4 font-mono">
            <span class="text-[9px] tracking-[0.3em] text-white/80 uppercase">12.12.26</span>
            <span class="text-white/30 text-[8px]">•</span>
            <span class="text-[9px] tracking-[0.3em] text-white/80 uppercase">Jakarta</span>
        </div>
    </div>

    <div class="absolute bottom-10 left-10 right-10 z-20 font-mono">
        <div class="flex justify-between items-end">
            <div class="flex flex-col gap-1">
                <span class="text-[7px] text-white/40 tracking-widest uppercase">Shutter: 1/125</span>
                <span class="text-[7px] text-white/40 tracking-widest uppercase">ISO: 100</span>
            </div>

            <div class="flex flex-col items-end gap-2">
                <span class="text-[8px] tracking-[0.2em] text-white animate-pulse">● SLIDE</span>
                <div class="w-20 h-[1px] bg-gradient-to-r from-transparent to-white/50"></div>
            </div>
        </div>
    </div>

</section>

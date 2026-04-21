<?php

use Livewire\Component;

new class extends Component {
    //
};
?>

<section class="relative flex flex-col py-24  overflow-hidden max-w-md mx-auto ">

    <div class="relative w-full mb-28 flex flex-col items-start px-6">
        <h3
            class="absolute -top-10 left-4 font-abigail text-[#5a3a2e]/5 text-[5rem] leading-none pointer-events-none uppercase">
            Event</h3>

        <div class="relative z-10 mt-6">
            <h2 class="font-abigail text-[#5a3a2e] text-6xl leading-[0.8] tracking-tighter drop-shadow-sm">
                The <br> <span class="ml-12 border-b border-[#5a3a2e]/10">Celebration</span>
            </h2>

            <div class="mt-8 flex items-center gap-3 opacity-40">
                <div class="w-8 h-[0.5px] bg-[#5a3a2e]"></div>
                <p class="font-poppins text-[#5a3a2e] text-[9px] tracking-[0.5em] uppercase">Save The Date</p>
            </div>
        </div>
    </div>

    <div class="relative mx-4 -mt-10 space-y-16 bg-[#2d1e18] rounded-[2.5rem] py-20 px-8 shadow-2xl overflow-hidden">

        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full opacity-17 rotate-180">
            <img src="{{ asset('assets/png/javaneseessence/bgawan.png') }}" class="w-full h-auto"
                style="mask-image: linear-gradient(to top, black 10%, transparent 100%); -webkit-mask-image: linear-gradient(to top, black 50%, transparent 100%);">
        </div>
        <div class="absolute -bottom-30 left-1/2 -translate-x-1/2 w-full opacity-10">
            <img src="{{ asset('assets/png/javaneseessence/bgbatik.png') }}" class="w-full h-auto"
                style="mask-image: linear-gradient(to top, black 50%, transparent 100%); -webkit-mask-image: linear-gradient(to top, black 50%, transparent 100%);">
        </div>


        <div class="relative z-10">
            <div class="flex items-center gap-4 mb-8">
                <img src="{{ asset('assets/png/javaneseessence/cincin1.png') }}" alt="Akad"
                    class="w-10 h-10 object-contain brightness-0 invert opacity-70">
                <h3 class="font-abigail text-2xl text-white tracking-[0.2em] uppercase">Akad Nikah</h3>
            </div>

            <div class="border-l border-white/10 pl-6 py-2">
                <p class="font-poppins text-lg tracking-[0.2em] text-[#fdfaf7] uppercase font-light">
                    {{ \Carbon\Carbon::parse($invitation->content['tanggal_akad'])->locale('id')->isoFormat('dddd, D MMMM Y') }}
                </p>
                <p class="font-abigail text-xs text-white/40 mt-1 uppercase tracking-[0.3em]">
                    {{ \Carbon\Carbon::parse($invitation->content['tanggal_akad'])->locale('id')->isoFormat('HH:mm') }}
                    -
                    {{ \Carbon\Carbon::parse($invitation->content['tanggal_resepsi'])->locale('id')->isoFormat('HH:mm') }}
                </p>

                <div class="mt-8">
                    <p
                        class="font-poppins text-[11px] uppercase tracking-[0.3em] text-[#fdfaf7] font-semibold leading-relaxed">
                        {{ $invitation->content['tempat_akad'] }}
                    </p>
                    <p
                        class="font-poppins font-light text-[10px] text-white/30 leading-relaxed mt-2 uppercase tracking-widest">
                        {{ $invitation->content['alamat_akad'] }}
                    </p>
                </div>
            </div>
        </div>

        <div class="w-full flex justify-center items-center gap-4 py-4">
            <div class="h-[0.5px] flex-1 bg-linear-to-r from-transparent to-white/10"></div>
            <img src="{{ asset('assets/png/javaneseessence/gunungan.png') }}" class="w-10 h-10 ">
            <div class="h-[0.5px] flex-1 bg-linear-to-l from-transparent to-white/10"></div>
        </div>

        <div class="relative z-10 text-right">
            <div class="flex items-center justify-end gap-4 mb-8">
                <h3 class="font-abigail text-2xl text-white tracking-[0.2em] uppercase">Resepsi</h3>
                <img src="{{ asset('assets/png/javaneseessence/glas2.png') }}" alt="Resepsi"
                    class="w-15 h-15 object-contain brightness-0 invert opacity-70">
            </div>

            <div class="border-r border-white/10 pr-6 py-2">
                <p class="font-poppins text-lg tracking-[0.2em] text-[#fdfaf7] uppercase font-light">
                    {{ \Carbon\Carbon::parse($invitation->content['tanggal_resepsi'])->locale('id')->isoFormat('dddd, D MMMM Y') }}
                </p>
                <p class="font-abigail  text-xs text-white/40 mt-1 uppercase tracking-[0.3em]">
                    {{ \Carbon\Carbon::parse($invitation->content['tanggal_resepsi'])->locale('id')->isoFormat('HH:mm') }}
                    -
                    selesai
                </p>

                <div class="mt-8">
                    <p
                        class="font-poppins text-[11px] uppercase tracking-[0.3em] text-[#fdfaf7] font-semibold leading-relaxed">
                        {{ $invitation->content['tempat_resepsi'] }}
                    </p>
                    <p
                        class="font-poppins font-light text-[10px] text-white/30 leading-relaxed mt-2 uppercase tracking-widest">
                        {{ $invitation->content['alamat_resepsi'] }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-14 flex flex-col items-center w-full  px-8">
        <a href="https://maps.app.goo.gl/1BgPxjovRRLksG249?g_st=ic" target="_blank"
            class="w-full relative flex items-center justify-center bg-[#2d1e18] border border-[#5a3a2e]/30 py-5 transition-all duration-500 rounded-2xl">
            <span class="relative z-10 font-poppins text-[10px] tracking-[0.4em] uppercase text-[#fdfaf7]">
                View Location
            </span>
        </a>
    </div>
</section>

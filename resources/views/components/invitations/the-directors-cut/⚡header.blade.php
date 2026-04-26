<?php
use Livewire\Component;

new class extends Component {
    //
};
?>

<section x-data="{
    targetDate: new Date('{{ $invitation->content['tanggal_resepsi'] }}').getTime(),
    days: '00',
    hours: '00',
    minutes: '00',
    seconds: '00',
    updateCountdown() {
        const now = new Date().getTime();
        const distance = this.targetDate - now;

        if (distance < 0) return;

        this.days = Math.floor(distance / (1000 * 60 * 60 * 24)).toString().padStart(2, '0');
        this.hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)).toString().padStart(2, '0');
        this.minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60)).toString().padStart(2, '0');
        this.seconds = Math.floor((distance % (1000 * 60)) / 1000).toString().padStart(2, '0');
    }
}" x-init="updateCountdown();
setInterval(() => updateCountdown(), 1000)"
    class=" bg-black h-screen relative overflow-hidden flex flex-col justify-center items-center">

    <div class="absolute inset-0 z-0">
        <img src="{{ $invitation->getPhoto('c2') }}" class="w-full h-full object-cover " alt="Background Couple">
    </div>
    <div class="absolute inset-0 bg-black/40 z-0"></div>
    <div class="absolute inset-6 pointer-events-none z-20">
        <div class="absolute top-0 left-0 w-8 h-8 border-t border-l border-white/40"></div>
        <div class="absolute top-0 right-0 w-8 h-8 border-t border-r border-white/40"></div>
        <div class="absolute bottom-0 left-0 w-8 h-8 border-b border-l border-white/40"></div>
        <div class="absolute bottom-0 right-0 w-8 h-8 border-b border-r border-white/40"></div>
    </div>

    <div class="absolute top-10 left-10 right-10 flex justify-between items-center z-20 font-mono">
        <div class="flex items-center gap-1.5">
            <div class="w-1.5 h-1.5 rounded-full bg-red-500 animate-pulse"></div>
            <span class="text-[8px] uppercase tracking-[0.2em] text-white/90">
                REC <span x-text="days + ':' + hours + ':' + minutes + ':' + seconds"></span>
            </span>
        </div>
        <span class="text-[8px] uppercase tracking-[0.2em] text-white/90">RAW 4K f/2.8</span>
    </div>
    <div class="relative z-10 flex flex-col items-center w-full px-10">
        <div class="text-center">
            <h1 class="font-abigail text-4xl text-white drop-shadow-xl mb-4">
                {{ $invitation->content['nama_pria'] }}
            </h1>
            <div class="flex items-center justify-center gap-6 mb-4">
                <div class="h-[0.5px] w-12 bg-white/30"></div>
                <span class="font-mono text-xs text-white/60 tracking-widest uppercase text-[10px]">With</span>
                <div class="h-[0.5px] w-12 bg-white/30"></div>
            </div>
            <h1 class="font-abigail text-4xl text-white drop-shadow-xl">
                {{ $invitation->content['nama_wanita'] }}
            </h1>
        </div>

        <div class="mt-12 flex flex-col items-center gap-3">
            <div class="px-6 py-1.5 border border-white/20 rounded-full backdrop-blur-sm">
                <p class="text-[9px] font-mono tracking-[0.4em] text-white uppercase">
                    {{ \Carbon\Carbon::parse($invitation->content['tanggal_resepsi'])->format('d . m . Y') }}
                </p>
            </div>
            <p
                class="text-[8px] font-mono tracking-[0.2em] text-white/40 uppercase max-w-[200px] text-center leading-relaxed">
                Live from: {{ $invitation->content['tempat_resepsi'] }}
            </p>
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
                <div class="w-20 h-px bg-linear-to-r from-transparent to-white/50"></div>
            </div>
        </div>
    </div>

</section>

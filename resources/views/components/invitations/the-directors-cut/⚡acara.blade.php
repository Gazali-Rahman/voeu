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

<section class="relative py-20 px-6">
    <div class="mb-12 flex flex-col items-center text-center">
        <div class="font-mono text-[9px] tracking-[0.4em] uppercase text-black/40 mb-2">Schedule & Location</div>
        <h1 class="font-abigail text-5xl text-black/90">The Ceremony</h1>
    </div>

    <div class="border-t border-black/20 relative z-10">

        <div class="flex flex-col py-6 border-b border-black/20">
            <div class="flex justify-between items-center mb-6">
                <span class="bg-black text-[#EAE8E3] font-mono text-[8px] px-2 py-1 tracking-[0.2em] uppercase">Seq 01:
                    Akad</span>
                <span
                    class="font-mono text-[9px] tracking-[0.2em] text-black/50">{{ Carbon\Carbon::parse($invitation->content['tanggal_akad'])->format('H:i') }}
                    - END</span>
            </div>

            <h2 class="font-sans font-bold text-xl tracking-tight text-black/80 uppercase mb-4">
                {{ Carbon\Carbon::parse($invitation->content['tanggal_akad'])->locale('id')->isoFormat('dddd, DD MMM YYYY') }}
            </h2>

            <div class="grid grid-cols-3 gap-4">
                <div class="col-span-1 border-t border-black/20 pt-2">
                    <p class="font-mono text-[8px] tracking-[0.2em] text-black/40 uppercase">Location</p>
                </div>
                <div class="col-span-2 border-t border-black/20 pt-2">
                    <p
                        class="font-mono text-[10px] leading-relaxed text-black/80 font-semibold tracking-wide uppercase">
                        {{ $invitation->content['tempat_akad'] }}
                    </p>
                    <p class="font-mono text-[9px] leading-relaxed text-black/50 mt-1 uppercase">
                        {{ $invitation->content['alamat_akad'] }}
                    </p>
                </div>
            </div>
        </div>

        <div class="flex flex-col py-6 border-b border-black/20">
            <div class="flex justify-between items-center mb-6">
                <span class="bg-black text-[#EAE8E3] font-mono text-[8px] px-2 py-1 tracking-[0.2em] uppercase">Seq 02:
                    Resepsi</span>
                <span
                    class="font-mono text-[9px] tracking-[0.2em] text-black/50">{{ Carbon\Carbon::parse($invitation->content['tanggal_resepsi'])->format('H:i') }}
                    - END</span>
            </div>

            <h2 class="font-sans font-bold text-xl tracking-tight text-black/80 uppercase mb-4">
                {{ Carbon\Carbon::parse($invitation->content['tanggal_resepsi'])->locale('id')->isoFormat('dddd, DD MMM YYYY') }}
            </h2>

            <div class="grid grid-cols-3 gap-4">
                <div class="col-span-1 border-t border-black/20 pt-2">
                    <p class="font-mono text-[8px] tracking-[0.2em] text-black/40 uppercase">Location</p>
                </div>
                <div class="col-span-2 border-t border-black/20 pt-2">
                    <p
                        class="font-mono text-[10px] leading-relaxed text-black/80 font-semibold tracking-wide uppercase">
                        {{ $invitation->content['tempat_resepsi'] }}
                    </p>
                    <p class="font-mono text-[9px] leading-relaxed text-black/50 mt-1 uppercase">
                        {{ $invitation->content['alamat_resepsi'] }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="pt-12 flex flex-col items-center">
        <a href="{{ $invitation->content['maps'] }}" target="_blank"
            class="inline-flex flex-col items-center group w-full">
            <div
                class="w-full border border-black/80 flex justify-between items-center px-6 py-4 hover:bg-black hover:text-[#EAE8E3] transition-all duration-300">
                <span class="font-mono text-[10px] tracking-[0.3em] uppercase font-bold">Open Maps Direction</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="square" stroke-linejoin="miter" stroke-width="1.5"
                        d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
            </div>
        </a>
    </div>

    <div class="mt-16">
        <div class="flex justify-between font-mono text-[7px] text-black/40 uppercase tracking-[0.3em]">
            <span>Gps: 6.2088° S, 106.8456° E</span>
            <span>Target: Resepsi</span>
        </div>
        <div class="w-full h-[0.5px] bg-black/20 mt-2"></div>
    </div>
</section>

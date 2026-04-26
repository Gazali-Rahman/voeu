<?php
use Livewire\Component;

new class extends Component {
    //
};
?>

<section class="max-w-md mx-auto bg-[#EAE8E3] relative py-20 px-6">

    <div class="mb-16 flex flex-col items-center text-center">
        <div class="font-mono text-[9px] tracking-[0.4em] uppercase text-black/30 mb-2">Schedule & Location</div>
        <h1 class="font-abigail text-5xl text-black/80">The Ceremony</h1>
        <div class="mt-4 flex items-center gap-2">
            <div class="w-8 h-[0.5px] bg-black/20"></div>
            <span class="font-mono text-[8px] tracking-[0.3em] text-black/40 uppercase">Mark the Date</span>
            <div class="w-8 h-[0.5px] bg-black/20"></div>
        </div>
    </div>

    <div class="space-y-10 relative z-10">

        <div class="relative bg-white/40 border border-black/10 p-8 shadow-sm">
            <div
                class="absolute -top-[1px] left-8 -translate-y-1/2 bg-black text-[#EAE8E3] font-mono text-[8px] px-3 py-1 tracking-[0.2em] uppercase">
                Event 01: Akad Nikah
            </div>

            <div class="flex flex-col items-center text-center space-y-5 pt-2">
                <div class="space-y-1">
                    <p class="font-mono text-[8px] tracking-[0.3em] text-black/40 uppercase">Date & Time</p>
                    <p class="font-sans font-bold text-lg tracking-tight text-black/80 uppercase">Saturday, 12 Dec 2026
                    </p>
                    <p class="font-mono text-[10px] text-black/60 tracking-[0.2em] uppercase">09:00 — 10:00 WIB</p>
                </div>

                <div class="w-full h-[0.5px] bg-black/10"></div>

                <div class="space-y-2 px-4">
                    <p class="font-mono text-[8px] tracking-[0.3em] text-black/40 uppercase">Location</p>
                    <p
                        class="font-mono text-[10px] leading-relaxed text-black/70 font-semibold tracking-wide uppercase">
                        Kediaman Mempelai Wanita <br>
                        Jl. Raya Jakarta No. 123
                    </p>
                </div>
            </div>
        </div>

        <div class="relative bg-white/40 border border-black/10 p-8 shadow-sm">
            <div
                class="absolute -top-[1px] left-8 -translate-y-1/2 bg-black text-[#EAE8E3] font-mono text-[8px] px-3 py-1 tracking-[0.2em] uppercase">
                Event 02: Resepsi
            </div>

            <div class="flex flex-col items-center text-center space-y-5 pt-2">
                <div class="space-y-1">
                    <p class="font-mono text-[8px] tracking-[0.3em] text-black/40 uppercase">Date & Time</p>
                    <p class="font-sans font-bold text-lg tracking-tight text-black/80 uppercase">Saturday, 12 Dec 2026
                    </p>
                    <p class="font-mono text-[10px] text-black/60 tracking-[0.2em] uppercase">11:00 — Finish</p>
                </div>

                <div class="w-full h-[0.5px] bg-black/10"></div>

                <div class="space-y-2 px-4">
                    <p class="font-mono text-[8px] tracking-[0.3em] text-black/40 uppercase">Location</p>
                    <p
                        class="font-mono text-[10px] leading-relaxed text-black/70 font-semibold tracking-wide uppercase">
                        The Grand Ballroom Hotel <br>
                        Jakarta International Area
                    </p>
                </div>
            </div>
        </div>

        <div class="pt-6 flex flex-col items-center">
            <div class="w-[1px] h-10 bg-black/10 mb-6"></div>

            <a href="#" class="inline-flex flex-col items-center group">
                <div class="mb-3 border border-black px-10 py-3 group-hover:bg-black transition-all duration-300">
                    <span
                        class="font-mono text-[10px] tracking-[0.5em] text-black group-hover:text-white uppercase font-bold">Open
                        Google Maps</span>
                </div>
                <span class="font-mono text-[7px] tracking-[0.3em] text-black/40 uppercase">Direction to Venue</span>
            </a>
        </div>

    </div>

    <div class="mt-20 px-4">
        <div class="flex justify-between font-mono text-[7px] text-black/30 uppercase tracking-[0.3em]">
            <span>Gps: 6.2088° S, 106.8456° E</span>
            <span>Target: Resepsi</span>
        </div>
        <div class="w-full h-[0.5px] bg-black/20 mt-2"></div>
    </div>

</section>

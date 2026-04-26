<div class="max-w-md h-screen bg-cover bg-center mx-auto relative flex items-center justify-end pr-6 overflow-hidden"
    style="background-image: url('{{ $invitation->getPhoto('c1') }}')">

    <div class="absolute inset-0 bg-black/50 backdrop-blur-xs"></div>

    <div class="absolute top-[10vh] left-0 z-20 w-[55%] h-fit p-4 text-white flex flex-col">
        <div class="mb-10">
            <p class="text-[9px] tracking-[0.5em] uppercase text-white/50 border-b border-white/20 pb-2 inline-block">
                Wedding Celebration
            </p>
        </div>

        <div class="mb-10">
            <h1 class="font-abigail text-4xl leading-none tracking-tighter">{{ $invitation->content['nama_pria'] }}
            </h1>
            <div class="py-2">
                <span class="text-[10px] tracking-[0.4em] font-light text-white/40 block">AND</span>
            </div>
            <h1 class="font-abigail text-4xl leading-none tracking-tighter">{{ $invitation->content['nama_wanita'] }}
            </h1>
        </div>

        <div class="space-y-6">
            <div class="space-y-1">
                <p class="text-[8px] tracking-[0.3em] uppercase text-white/30">The Date</p>
                <p class="text-sm tracking-[0.2em] font-light">12 . 12 . 2026</p>
            </div>

            <div class="space-y-1">
                <p class="text-[8px] tracking-[0.3em] uppercase text-white/30">The Place</p>
                <p class="text-[10px] leading-relaxed tracking-wider opacity-80 uppercase">
                    The Grand Ballroom <br>
                    Jakarta, Indonesia
                </p>
            </div>
        </div>
    </div>

    <div class="absolute bottom-[10vh] left-4 z-30">
        <button wire:click="open"
            class="group flex items-center gap-3 bg-white/10 hover:bg-white/20 backdrop-blur-md border border-white/30 px-4 py-3 transition-all duration-300">
            <span class="text-[10px] uppercase tracking-[0.3em] text-white font-light">Open Invitation</span>
        </button>
    </div>

    <div class="relative z-10 w-36 h-[80vh] bg-white p-1.5 shadow-2xl flex flex-col gap-1.5 border-x border-black/5">
        <div class="relative flex-1 bg-neutral-200 overflow-hidden">
            <img src="{{ $invitation->getPhoto('c2') }}" class="w-full h-full object-cover">
            <div class="absolute top-1 left-1 text-[6px] font-mono text-black/40 uppercase">Shot 01</div>
        </div>

        <div class="relative flex-1 bg-neutral-200 overflow-hidden">
            <img src="{{ $invitation->getPhoto('c1') }}" class="w-full h-full object-cover">
            <div class="absolute top-1 left-1 text-[6px] font-mono text-black/40 uppercase">Shot 02</div>
        </div>

        <div class="relative flex-1 bg-neutral-200 overflow-hidden">
            <img src="{{ $invitation->getPhoto('c2') }}" class="w-full h-full object-cover">
            <div class="absolute top-1 left-1 text-[6px] font-mono text-black/40 uppercase">Shot 03</div>
        </div>

        <div
            class="absolute -right-5 top-1/2 -translate-y-1/2 rotate-90 text-[7px] font-mono text-white/60 tracking-[0.8em] uppercase whitespace-nowrap">
            Kodak Portra 400
        </div>
    </div>

</div>

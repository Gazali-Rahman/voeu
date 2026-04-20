<?php

use Livewire\Component;

new class extends Component {
    public $invitation;
    public $content;
    public $initialGroom;
    public $initialBride;

    public function mount($invitation)
    {
        $this->invitation = $invitation;
        $this->content = $invitation->content;

        // Ambil huruf pertama untuk watermark
        $this->initialGroom = substr(strtoupper($this->content['nama_pria'] ?? 'B'), 0, 1);
        $this->initialBride = substr(strtoupper($this->content['nama_wanita'] ?? 'K'), 0, 1);
    }
};
?>

<div class="bg-white px-8 py-24 relative overflow-hidden h-fit space-y-32">

    <!-- Section: Baskara (Groom) -->
    <div class="relative" x-data="{ visible: false }" x-intersect.once.margin.-20%="visible = true">

        <div class="transition-all duration-1000 transform"
            :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-12'">

            <!-- Watermark B -->
            <div class="absolute -top-10 left-0 z-0">
                <span
                    class="font-vogue text-[15rem] leading-none text-black/3 italic select-none">{{ $initialGroom }}</span>
            </div>

            <!-- Foto & Nama -->
            <div class="relative z-10 flex flex-col items-end">
                <div class="w-3/4 relative">
                    <div class="absolute inset-0 border-[0.5px] border-black/20 translate-x-3 -translate-y-3 z-0"></div>
                    <div
                        class="aspect-3/4 overflow-hidden relative z-10 grayscale hover:grayscale-0 transition duration-1000">
                        <img src="{{ $invitation->getPhoto('bridge') }}" class="w-full h-full object-cover">
                    </div>
                </div>

                <div class="w-full mt-[-20px] relative z-20 flex flex-col items-start pl-4">
                    <h2 class="font-vogue text-5xl text-black tracking-tighter leading-none">
                        {{ $content['nama_pria'] }}
                    </h2>
                    <div class="flex items-center gap-2 mt-2">
                        <div class="w-12 h-px bg-black"></div>
                        <span class="font-serif italic text-xs text-gray-400">the bridge</span>
                    </div>
                </div>
            </div>

            <!-- Detail Orang Tua -->
            <div class="mt-10 flex justify-between items-start pl-4">
                <div class="space-y-1">
                    <p class="font-vogue text-sm text-black tracking-widest uppercase">
                        {{ $content['nama_pria_lengkap'] }}
                    </p>
                    <p class="font-light text-[10px] text-gray-400 uppercase tracking-[0.3em]">
                        {{ $content['label_ortu_pria'] }}</p>
                    <p class="font-poppins text-xs text-black tracking-widest uppercase">
                        {{ $content['ayah_pria'] }} <br> & {{ $content['ibu_pria'] }}
                    </p>
                </div>
                <div class="h-12 w-[0.5px] bg-black/10 rotate-25"></div>
            </div>
        </div>
    </div>

    <!-- Section: Kirana (Bride) -->
    <div class="relative" x-data="{ visible: false }" x-intersect.once.margin.-20%="visible = true">

        <div class="transition-all duration-1000 transform"
            :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-12'">

            <!-- Watermark K -->
            <div class="absolute -top-10 right-0 z-0 text-right">
                <span
                    class="font-vogue text-[15rem] leading-none text-black/3 italic select-none">{{ $initialBride }}</span>
            </div>

            <!-- Foto & Nama -->
            <div class="relative z-10 flex flex-col items-start w-full">
                <div class="w-3/4 relative self-start">
                    <div class="absolute inset-0 border-[0.5px] border-black/20 -translate-x-3 -translate-y-3 z-0">
                    </div>
                    <div
                        class="aspect-3/4 overflow-hidden relative z-10 grayscale hover:grayscale-0 transition duration-1000">
                        <img src="{{ $invitation->getPhoto('groom') }}" class="w-full h-full object-cover">
                    </div>
                </div>

                <div class="w-full mt-[-20px] relative z-20 flex flex-col items-end pr-4">
                    <h2 class="font-vogue text-5xl text-black tracking-tighter leading-none text-right">
                        {{ $content['nama_wanita'] }}
                    </h2>
                    <div class="flex flex-row-reverse items-center gap-2 mt-2">
                        <div class="w-12 h-px bg-black"></div>
                        <span class="font-serif italic text-xs text-gray-400">the groom</span>
                    </div>
                </div>
            </div>

            <!-- Detail Orang Tua -->
            <div class="mt-10 flex flex-row-reverse justify-between items-start pr-4 w-full">
                <div class="space-y-1 text-right">
                    <p class="font-vogue text-sm text-black tracking-widest uppercase">
                        {{ $content['nama_wanita_lengkap'] }}
                    </p>
                    <p class="font-light text-[10px] text-gray-400 uppercase tracking-[0.3em]">
                        {{ $content['label_ortu_wanita'] }}
                    </p>
                    <p class="font-poppins text-xs text-black tracking-widest uppercase">
                        {{ $content['ayah_wanita'] }} <br> & {{ $content['ibu_wanita'] }}
                    </p>
                </div>
                <div class="h-12 w-[0.5px] bg-black/10 -rotate-25"></div>
            </div>
        </div>
    </div>

</div>

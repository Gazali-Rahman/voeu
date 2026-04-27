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

<section class=" relative py-20 px-4">

    <div class="mb-20 flex flex-col items-center text-center px-6">
        <div class="flex items-center gap-3 font-mono text-[9px] tracking-[0.4em] uppercase text-black/30 mb-2">
            <div class="w-2 h-[0.5px] bg-black/30"></div>
            <span>Profile Selection</span>
            <div class="w-2 h-[0.5px] bg-black/30"></div>
        </div>
        <h1 class="font-abigail text-4xl text-black/80">Bride & Groom</h1>
        <p class="font-mono text-[8px] tracking-[0.5em] uppercase text-black/40 mt-4">
            [ ID: {{ Carbon\Carbon::parse($invitation->content['tanggal_resepsi'])->format('d.m.y') }} / SUBJECTS: 02 ]
        </p>
    </div>

    <div class="space-y-32 relative z-10">

        <div class="relative">
            <div class="absolute -top-8 left-4 font-mono text-[9px] text-black/30 tracking-widest">
                REF: 001/BRIDE
            </div>

            <div class="flex items-start gap-6">
                <div class="relative w-[55%] aspect-4/5 bg-neutral-300 shadow-sm ml-2">
                    <img src="{{ $invitation->getPhoto('bride') }}"
                        class="w-full h-full object-cover grayscale-[0.1] contrast-[1.05]" alt="Bride">

                    <div class="absolute -inset-3 pointer-events-none opacity-40">
                        <div class="absolute top-0 left-0 w-3 h-3 border-t border-l border-black"></div>
                        <div class="absolute bottom-0 right-0 w-3 h-3 border-b border-r border-black"></div>
                    </div>
                </div>

                <div class="flex-1 pt-4">
                    <div class="font-mono text-[7px] tracking-[0.3em] text-black/40 mb-2 uppercase italic">Verified
                        Bride</div>
                    <h2 class="font-abigail text-2xl text-black/80 leading-none">
                        {{ $invitation->content['nama_wanita_lengkap'] }}</h2>

                    <div class="mt-4 flex flex-col gap-4">
                        <div class="h-[0.5px] w-full bg-black/10"></div>
                        <p class="font-mono text-[8px] leading-relaxed text-black/50 uppercase tracking-tighter">
                            {{ $invitation->content['label_ortu_wanita'] }} <br>
                            Bpk. {{ $invitation->content['ayah_wanita'] }} & <br>
                            Ibu {{ $invitation->content['ibu_wanita'] }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="relative">
            <div class="absolute -top-8 right-4 font-mono text-[9px] text-black/30 tracking-widest text-right">
                REF: 002/GROOM
            </div>

            <div class="flex flex-row-reverse items-start gap-6">
                <div class="relative w-[55%] aspect-4/5 bg-neutral-300 shadow-sm mr-2">
                    <img src="{{ $invitation->getPhoto('groom') }}"
                        class="w-full h-full object-cover grayscale-[0.1] contrast-[1.05]" alt="Groom">

                    <div class="absolute -inset-3 pointer-events-none opacity-40">
                        <div class="absolute top-0 right-0 w-3 h-3 border-t border-r border-black"></div>
                        <div class="absolute bottom-0 left-0 w-3 h-3 border-b border-l border-black"></div>
                    </div>
                </div>

                <div class="flex-1 pt-4 text-right">
                    <div class="font-mono text-[7px] tracking-[0.3em] text-black/40 mb-2 uppercase italic">Verified
                        Groom</div>
                    <h2 class="font-abigail text-2xl text-black/80 leading-none">
                        {{ $invitation->content['nama_pria_lengkap'] }}
                    </h2>

                    <div class="mt-4 flex flex-col items-end gap-4">
                        <div class="h-[0.5px] w-full bg-black/10"></div>
                        <p class="font-mono text-[8px] leading-relaxed text-black/50 uppercase tracking-tighter">
                            {{ $invitation->content['label_ortu_pria'] }} <br>
                            Bpk. {{ $invitation->content['ayah_pria'] }} & <br>
                            Ibu {{ $invitation->content['ibu_pria'] }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div
        class="mt-24 flex justify-between items-center font-mono text-[7px] opacity-40 px-4 uppercase tracking-[0.2em]">
        <div class="flex items-center gap-2">
            <div class="w-1.5 h-1.5 bg-black rounded-full animate-pulse"></div>
            <span>LIVE TRACKING</span>
        </div>
        <div class="flex gap-2">
            <span class="px-1 border border-black italic">AF-LOCK</span>
            <span
                class="px-1 border border-black bg-black text-[#EAE8E3]">{{ Carbon\Carbon::parse($invitation->content['tanggal_resepsi'])->format('d.m.y') }}</span>
        </div>
    </div>

</section>

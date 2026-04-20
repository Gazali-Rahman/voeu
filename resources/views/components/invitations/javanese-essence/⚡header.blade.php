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

<div class="relative h-screen w-full bg-cover bg-center overflow-hidden max-w-md mx-auto shadow-2xl flex flex-col justify-between"
    style="background-image: url('{{ $invitation->getPhoto('c2') }}')">

    <div class="absolute inset-0 bg-black/40"></div>
    <div class="absolute inset-x-0 bottom-0 h-2/3 bg-linear-to-t from-black/90 via-black/50 to-transparent"></div>

    <div class="relative z-20 flex flex-col w-full px-8 pt-16">

        <div class="flex items-baseline gap-3 mb-6 border-b border-white/20 pb-3 self-start">
            <span class="text-white text-[10px] tracking-[0.5em] uppercase font-light opacity-70">The Wedding Of</span>
        </div>

        <div class="relative flex flex-col">
            <h1 class="font-abigail text-white text-[5.5rem] leading-none self-start drop-shadow-2xl">
                {{ $invitation->content['nama_pria'] }}
            </h1>

            <div class="flex items-center justify-end -mt-8">
                <span class="text-white font-poppins text-[10px] tracking-[0.8em] uppercase mr-4 opacity-40">And</span>
                <h1 class="font-abigail text-white text-[5.5rem] leading-none">
                    {{ $invitation->content['nama_wanita'] }}
                </h1>
            </div>
        </div>

        <div class="self-end mt-6 text-right border-r-2 border-white/30 pr-4">
            <p class="text-white text-[10px] font-light tracking-[0.4em] uppercase opacity-80">
                {{ Carbon\Carbon::parse($invitation->content['tanggal_resepsi'])->format('l') }}</p>
            <p class="text-white text-xl font-abigail tracking-[0.2em] mt-1">
                {{ Carbon\Carbon::parse($invitation->content['tanggal_resepsi'])->format('F j, Y') }}</p>
        </div>
    </div>


    <div class="relative z-20 w-full px-6 pb-8">

        <div class="relative bg-white/10 backdrop-blur-xs  border border-white/20 rounded-4xl py-6 px-4 overflow-hidden shadow-2xl"
            x-data="{
                expiry: new Date('{{ $invitation->content['tanggal_resepsi'] }}').getTime(),
                remaining: { days: '00', hours: '00', minutes: '00', seconds: '00' },
                update() {
                    let distance = this.expiry - new Date().getTime();
                    if (distance < 0) return;
                    this.remaining.days = String(Math.floor(distance / (1000 * 60 * 60 * 24))).padStart(2, '0');
                    this.remaining.hours = String(Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60))).padStart(2, '0');
                    this.remaining.minutes = String(Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60))).padStart(2, '0');
                    this.remaining.seconds = String(Math.floor((distance % (1000 * 60)) / 1000)).padStart(2, '0');
                }
            }" x-init="update();
            setInterval(() => update(), 1000)">

            <div class="absolute -bottom-30 w-[50%] left-[-40px] z-0 opacity-5 invert  pointer-events-none">
                <img src="{{ asset('assets/png/javaneseessence/cowo.png') }}"
                    class="h-full w-auto object-contain scale-110">
            </div>
            <div class="absolute -bottom-25 w-[50%] right-[-40px] z-0 opacity-5 invert  pointer-events-none">
                <img src="{{ asset('assets/png/javaneseessence/cewe.png') }}"
                    class="h-full w-auto object-contain scale-110">
            </div>

            <div class="relative z-10 flex flex-col items-center">
                <p class="text-white/60 text-[9px] tracking-[0.4em] uppercase font-light mb-5">Counting Down To Big Day
                </p>

                <div class="flex justify-around items-center w-full text-white">
                    <div class="text-center">
                        <span class="block text-2xl font-bold tracking-tighter" x-text="remaining.days">00</span>
                        <span class="text-[7px] uppercase tracking-[0.2em] text-white/50">Days</span>
                    </div>
                    <div class="w-px h-6 bg-white/20"></div>
                    <div class="text-center">
                        <span class="block text-2xl font-bold tracking-tighter" x-text="remaining.hours">00</span>
                        <span class="text-[7px] uppercase tracking-[0.2em] text-white/50">Hours</span>
                    </div>
                    <div class="w-px h-6 bg-white/20"></div>
                    <div class="text-center">
                        <span class="block text-2xl font-bold tracking-tighter" x-text="remaining.minutes">00</span>
                        <span class="text-[7px] uppercase tracking-[0.2em] text-white/50">Mins</span>
                    </div>
                    <div class="w-1px h-6 bg-white/20"></div>
                    <div class="text-center">
                        <span class="block text-2xl font-bold tracking-tighter text-[#ccaa88]"
                            x-text="remaining.seconds">00</span>
                        <span class="text-[7px] uppercase tracking-[0.2em] text-white/50">Secs</span>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

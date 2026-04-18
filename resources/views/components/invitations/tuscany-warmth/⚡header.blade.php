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
<div class="flex flex-col items-center overflow-hidden h-screen" x-data="{ show: false }" x-init="setTimeout(() => show = true, 100)">

    <!-- Bagian Atas: Gambar & Teks -->
    <div class="flex justify-center items-center mt-10">

        <div class="overflow-hidden">
            <img x-show="show" x-transition:enter="transition ease-out duration-1000 delay-700"
                x-transition:enter-start="opacity-0 translate-x-full" x-transition:enter-end="opacity-100 translate-x-0"
                src="{{ $invitation->getPhoto('c2') }}" alt=""
                class="aspect-2/4 w-40  rounded-l-2xl object-cover object-center  block">
        </div>

        <div class="border-r-2 border-[#C08552] h-100 self-stretch transition-all duration-700 delay-100 origin-center relative z-10"
            :class="show ? 'scale-y-100 opacity-100' : 'scale-y-0 opacity-0'">
        </div>

        <div class="overflow-hidden pl-4">
            <div class="flex flex-col" x-show="show" x-transition:enter="transition ease-out duration-1000 delay-700"
                x-transition:enter-start="opacity-0 -translate-x-full"
                x-transition:enter-end="opacity-100 translate-x-0">

                <h1 class="font-utama tracking-widest text-black text-3xl leading-tight">The <br> Wedding <br> Of</h1>
                <h1 class="font-poppins tracking-[0.2em] text-[#C08552] text-xs mt-2 uppercase font-light">
                    {{ $invitation->content['nama_pria'] }} & {{ $invitation->content['nama_wanita'] }}</h1>

                <div class="w-8 border-t border-black my-6"></div>

                <div class="flex flex-col gap-1">
                    <p class="font-poppins font-light tracking-[0.4em] text-[9px] uppercase text-black">
                        {{ Carbon\Carbon::parse($invitation->content['tanggal_resepsi'])->format('l') }}</p>
                    <p class="font-utama text-2xl text-black">
                        {{ Carbon\Carbon::parse($invitation->content['tanggal_resepsi'])->format('d F') }}</p>
                    <p class="font-poppins font-light tracking-[0.4em] text-[9px] uppercase text-black">
                        {{ Carbon\Carbon::parse($invitation->content['tanggal_resepsi'])->format('Y') }}</p>
                </div>

                <div class="mt-6 max-w-[150px] ">
                    <p class="font-poppins font-bold text-[9px] tracking-widest uppercase">
                        {{ $invitation->content['tempat_resepsi'] }}</p>
                    <p class="font-poppins font-light text-[9px] tracking-widest uppercase text-black">
                        {{ $invitation->content['alamat_resepsi'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Countdown Section: Fade up dari bawah -->
    <div class="mt-12 w-full max-w-[80%]" x-show="show"
        x-transition:enter="transition ease-out duration-1000 delay-700"
        x-transition:enter-start="opacity-0 translate-y-10" x-transition:enter-end="opacity-100 translate-y-0"
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

        <div class="flex justify-between items-center text-center">
            <div class="flex flex-col">
                <span class="font-utama text-3xl text-black" x-text="remaining.days">00</span>
                <span class="font-poppins text-[8px] tracking-[0.3em] uppercase text-[#C08552]">Days</span>
            </div>
            <div class="h-8 border-r border-gray-200"></div>
            <div class="flex flex-col">
                <span class="font-utama text-3xl text-black" x-text="remaining.hours">00</span>
                <span class="font-poppins text-[8px] tracking-[0.3em] uppercase text-[#C08552]">Hours</span>
            </div>
            <div class="h-8 border-r border-gray-200"></div>
            <div class="flex flex-col">
                <span class="font-utama text-3xl text-black" x-text="remaining.minutes">00</span>
                <span class="font-poppins text-[8px] tracking-[0.3em] uppercase text-[#C08552]">Mins</span>
            </div>
            <div class="h-8 border-r border-gray-200"></div>
            <div class="flex flex-col">
                <span class="font-utama text-3xl text-black" x-text="remaining.seconds">00</span>
                <span class="font-poppins text-[8px] tracking-[0.3em] uppercase text-[#C08552]">Secs</span>
            </div>
        </div>

        <p
            class="mt-8 font-poppins font-light text-[9px] tracking-[0.5em] text-center uppercase text-gray-400 animate-pulse">
            Until we tie the knot
        </p>
    </div>
</div>

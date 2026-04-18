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
<div class="flex flex-col py-20 bg-white overflow-hidden">

    <!-- Header Section: Typography Play -->
    <div class="mb-12 relative px-4" x-data="{ show: false }" x-intersect.once="show = true">
        <!-- Pakai transition class, bukan x-show langsung di teksnya -->
        <h2 class="font-vogue text-6xl text-black/10 leading-none italic text-left transition-all duration-1000 transform"
            :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">
            The
        </h2>
        <h2 class="font-vogue text-5xl text-black leading-none ml-12 -mt-4 text-left tracking-tighter transition-all duration-1000 delay-300 transform"
            :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">
            Ceremony
        </h2>
        <div class="w-12 h-px bg-black mt-6 ml-2 transition-all duration-1000 delay-500"
            :class="show ? 'w-12 opacity-100' : 'w-0 opacity-0'"></div>
    </div>

    <!-- Container Event: Black Editorial Card -->
    <div class="relative mx-4 space-y-16 bg-[#1a1a1a] rounded-4xl py-20 px-8 shadow-2xl overflow-hidden">

        <!-- Abstract Background Text (Vogue Vibe) -->
        <div class="absolute top-0 right-0 font-vogue text-[15rem] text-white/2 leading-none -mr-10 -mt-10 select-none">
            01
        </div>
        <div
            class="absolute bottom-0 left-0 font-vogue text-[15rem] text-white/2 leading-none -ml-10 -mb-10 select-none">
            02
        </div>

        <!-- Bagian Akad Nikah (Rata Kiri) -->
        <div x-data="{ show: false }" x-intersect="show = true" class="relative">
            <div x-show="show" x-transition:enter="transition ease-out duration-1000"
                x-transition:enter-start="opacity-0 translate-y-10" x-transition:enter-end="opacity-100 translate-y-0"
                class="relative z-10">

                <div class="flex items-end gap-4 mb-8">
                    <img src="{{ asset('assets/png/noiretblanc/cincin1.png') }}" alt="Akad"
                        class="w-12 h-12 object-contain brightness-0 invert opacity-80">
                    <h3 class="font-vogue text-2xl text-white tracking-[0.2em] uppercase">Akad</h3>
                </div>

                <!-- Info Box -->
                <div class="border-l border-white/20 pl-6 py-2">
                    <p class="font-vogue text-lg tracking-widest text-white uppercase">
                        {{ \Carbon\Carbon::parse($invitation->content['tanggal_akad'])->locale('id')->isoFormat('dddd, D MMMM Y') }}
                    </p>
                    <p class="font-serif italic text-xs text-white/50 mt-1 uppercase tracking-widest">
                        {{ \Carbon\Carbon::parse($invitation->content['tanggal_akad'])->locale('id')->isoFormat('HH:mm') }}
                        -
                        {{ \Carbon\Carbon::parse($invitation->content['tanggal_resepsi'])->locale('id')->isoFormat('HH:mm') }}
                    </p>

                    <div class="mt-8">
                        <p class="font-vogue text-[11px] uppercase tracking-[0.3em] text-white">
                            {{ $invitation->content['tempat_akad'] }}</p>
                        <p class="font-light text-[10px] text-white/40 leading-relaxed mt-2 uppercase tracking-widest">
                            {{ $invitation->content['alamat_akad'] }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Divider Garis Tipis Luxury -->
        <div class="w-full flex justify-center items-center gap-4">
            <div class="h-[0.5px] flex-1 bg-linear-to-r from-transparent to-white/20"></div>
            <div class="w-2 h-2 rounded-full border border-white/20"></div>
            <div class="h-[0.5px] flex-1 bg-linear-to-l from-transparent to-white/20"></div>
        </div>

        <!-- Bagian Resepsi (Rata Kanan) -->
        <div x-data="{ show: false }" x-intersect="show = true" class="relative">
            <div x-show="show" x-transition:enter="transition ease-out duration-1000 delay-300"
                x-transition:enter-start="opacity-0 translate-y-10" x-transition:enter-end="opacity-100 translate-y-0"
                class="relative z-10 text-right">

                <div class="flex items-end justify-end gap-4 mb-8">
                    <h3 class="font-vogue text-2xl text-white tracking-[0.2em] uppercase">Resepsi</h3>
                    <img src="{{ asset('assets/png/noiretblanc/glas2.png') }}" alt="Resepsi"
                        class="w-15 h-15 object-contain brightness-0 invert opacity-80">
                </div>

                <!-- Info Box Rata Kanan -->
                <div class="border-r border-white/20 pr-6 py-2">
                    <p class="font-vogue text-lg tracking-widest text-white uppercase">
                        {{ \Carbon\Carbon::parse($invitation->content['tanggal_resepsi'])->locale('id')->isoFormat('dddd, D MMMM Y') }}
                    </p>
                    <p class="font-serif italic text-xs text-white/50 mt-1 uppercase tracking-widest">
                        {{ \Carbon\Carbon::parse($invitation->content['tanggal_resepsi'])->locale('id')->isoFormat('HH:mm') }}
                        -
                        Selesai
                    </p>

                    <div class="mt-8">
                        <p class="font-vogue text-[11px] uppercase tracking-[0.3em] text-white">
                            {{ $invitation->content['tempat_resepsi'] }}</p>
                        <p class="font-light text-[10px] text-white/40 leading-relaxed mt-2 uppercase tracking-widest">
                            {{ $invitation->content['alamat_resepsi'] }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tombol Google Maps: Minimalist Style (Perfect Center) -->
    <div x-data="{ show: false }" x-intersect="show = true" class="mt-12 flex flex-col items-center w-full px-8">
        <div x-show="show" x-transition:enter="transition ease-out duration-1000 delay-500" class="w-full group">
            <a href="{{ $invitation->content['maps'] }}" target="_blank"
                class="relative flex items-center justify-center border border-black py-5 overflow-hidden transition-all duration-500">

                <!-- Hover Background Effect -->
                <div
                    class="absolute inset-0 bg-black translate-y-full group-hover:translate-y-0 transition-transform duration-500">
                </div>

                <!-- Content -->
                <span
                    class="relative z-10 font-vogue text-[11px] tracking-[0.4em] mr-[-0.4em] uppercase text-black group-hover:text-white transition-colors duration-500">
                    Get Directions
                </span>
            </a>
            <p class="text-center mt-4 font-serif italic text-[10px] text-gray-400 tracking-widest uppercase">
                click to open in maps
            </p>
        </div>
    </div>
</div>

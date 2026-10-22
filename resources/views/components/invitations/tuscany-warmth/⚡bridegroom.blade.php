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

<div class="flex flex-col gap-20 py-10 overflow-hidden">
    <!-- Header Section: The Bride & Groom -->
    <div class="relative " x-data="{ show: false }" x-intersect="show = true">
        <div class="flex items-baseline gap-4">
            <!-- Teks Vertikal Kecil -->
            <div class="[writing-mode:vertical-lr] rotate-180" x-show="show"
                x-transition:enter="transition ease-out duration-1000" x-transition:enter-start="opacity-0 -translate-y-5"
                x-transition:enter-end="opacity-100 translate-y-0">
                <p class="font-poppins text-[10px] tracking-[0.5em] uppercase text-[#C08552] font-bold">
                    The Wedding
                </p>
            </div>

            <!-- Judul Utama -->
            <div class="flex flex-col">
                <h1 class="font-utama text-5xl text-black leading-none" x-show="show"
                    x-transition:enter="transition ease-out duration-1000 delay-300"
                    x-transition:enter-start="opacity-0 translate-x-5"
                    x-transition:enter-end="opacity-100 translate-x-0">
                    Bride <span class="text-[#C08552]">&</span>
                </h1>
                <h1 class="font-utama text-5xl text-black leading-none ml-8" x-show="show"
                    x-transition:enter="transition ease-out duration-1000 delay-500"
                    x-transition:enter-start="opacity-0 translate-x-5"
                    x-transition:enter-end="opacity-100 translate-x-0">
                    Groom
                </h1>
            </div>
        </div>

        <!-- Garis Aksen Horizontal -->
        <div class="w-full h-px bg-gray-200 mt-8 relative">
            <div class="absolute left-0 top-0 h-px bg-[#C08552] transition-all duration-1500 delay-700"
                :class="show ? 'w-20' : 'w-0'"></div>
        </div>
    </div>

    <!-- Bagian Mempelai Pria -->
    <div class="relative flex flex-col items-start" x-data="{ show: false }" x-intersect="show = true">
        <!-- Foto Mempelai Pria -->
        <div class="relative w-[70%] z-10">
            <img src="{{ $invitation->getphoto('groom') }}" alt="Adrian" x-show="show"
                x-transition:enter="transition ease-out duration-1000" x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                class="aspect-3/4 object-cover rounded-lg shadow-md border-white">

            <!-- Dekorasi Nama Belakang Transparan -->
            <span
                class="absolute -bottom-10 -right-10 font-utama text-6xl text-[#C08552]/20 -z-10 uppercase tracking-tighter"
                x-show="show" x-transition:enter="transition ease-out duration-1000 delay-700"
                x-transition:enter-start="opacity-0 translate-y-10" x-transition:enter-end="opacity-100 translate-y-0">
                {{ $invitation->content['nama_pria'] }}
            </span>
        </div>

        <!-- Detail Pria (Muncul seolah keluar dari garis cokelat) -->
        <div class="mt-8 pl-4 border-l-2 border-[#C08552]" x-show="show"
            x-transition:enter="transition ease-out duration-1000 delay-500"
            x-transition:enter-start="opacity-0 -translate-x-10" x-transition:enter-end="opacity-100 translate-x-0">
            <h2 class="font-utama text-3xl text-black">{{ $invitation->content['nama_pria_lengkap'] }}</h2>
            <p class="font-poppins text-[10px] tracking-[0.3em] uppercase text-[#C08552] mt-1">Putra Pertama dari</p>
            <p class="font-poppins font-light text-xs text-gray-500 mt-2 leading-relaxed">
                {{ $invitation->content['ayah_pria'] }} <br> & {{ $invitation->content['ibu_pria'] }}
            </p>
            {{-- 
            <a href="#" class="inline-flex items-center mt-4 text-gray-400 gap-2">
                <i class="fab fa-instagram text-xs"></i>
                <span class="text-[9px] tracking-widest uppercase">@adrianputra</span>
            </a> --}}
        </div>
    </div>

    <!-- Simbol "&" Tengah -->
    <div class="flex justify-center my-[-40px] z-20" x-data="{ show: false }" x-intersect="show = true">
        <span class="font-utama text-7xl text-[#C08552]/20 italic" x-show="show"
            x-transition:enter="transition ease-out duration-1000"
            x-transition:enter-start="opacity-0 scale-0 rotate-180"
            x-transition:enter-end="opacity-100 scale-100 rotate-0">
            &
        </span>
    </div>

    <!-- Bagian Mempelai Wanita -->
    <div class="relative flex flex-col items-end px-6" x-data="{ show: false }" x-intersect="show = true">
        <!-- Foto Mempelai Wanita -->
        <div class="relative w-[70%] z-10 text-right">
            <img src="{{ $invitation->getphoto('bride') }}" alt="Celine" x-show="show"
                x-transition:enter="transition ease-out duration-1000" x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                class="aspect-3/4 object-cover rounded-lg shadow-md ml-auto">

            <!-- Dekorasi Nama Belakang Transparan -->
            <span
                class="absolute -top-10 -left-10 font-utama text-6xl text-[#C08552]/20 -z-10 uppercase tracking-tighter text-left"
                x-show="show" x-transition:enter="transition ease-out duration-1000 delay-700"
                x-transition:enter-start="opacity-0 -translate-y-10" x-transition:enter-end="opacity-100 translate-y-0">
                {{ $invitation->content['nama_wanita'] }}
            </span>
        </div>

        <!-- Detail Wanita (Muncul seolah keluar dari garis cokelat) -->
        <div class="mt-8 pr-4 border-r-2 border-[#C08552] text-right" x-show="show"
            x-transition:enter="transition ease-out duration-1000 delay-500"
            x-transition:enter-start="opacity-0 translate-x-10" x-transition:enter-end="opacity-100 translate-x-0">
            <h2 class="font-utama text-3xl text-black">{{ $invitation->content['nama_wanita_lengkap'] }}</h2>
            <p class="font-poppins text-[10px] tracking-[0.3em] uppercase text-[#C08552] mt-1">Putri Kedua dari</p>
            <p class="font-poppins font-light text-xs text-gray-500 mt-2 leading-relaxed">
                {{ $invitation->content['ayah_wanita'] }} <br> & {{ $invitation->content['ibu_wanita'] }}
            </p>

            {{-- <a href="#" class="inline-flex flex-row-reverse items-center mt-4 text-gray-400 gap-2">
                <i class="fab fa-instagram text-xs"></i>
                <span class="text-[9px] tracking-widest uppercase">@celinegris</span>
            </a> --}}
        </div>
    </div>
</div>

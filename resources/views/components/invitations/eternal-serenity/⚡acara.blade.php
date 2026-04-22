<?php
use Livewire\Component;

new class extends Component {
    //
};
?>

<div class="bg-[#F5E9D8] overflow-hidden flex flex-col items-center justify-center px-4 py-16">

    <!-- Card Utama (Tanpa x-show agar background merah tetap ada) -->
    <div class="w-full max-w-sm bg-red-950 rounded-[3rem] py-14 px-8 shadow-2xl relative overflow-hidden">

        <!-- Ornamen Atas (Kanan) -->
        <div x-data="{ show: false }" x-intersect="show = true">
            <div x-show="show" x-transition:enter="transition ease-out duration-1000"
                x-transition:enter-start="opacity-0 scale-50 translate-x-10 -translate-y-10"
                x-transition:enter-end="opacity-100 scale-100 translate-x-0 translate-y-0">
                <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full -mr-16 -mt-16"></div>
            </div>
        </div>


        <!-- Bagian Akad Nikah - Dibungkus x-intersect sendiri -->
        <div x-data="{ show: false }" x-intersect="show = true"
            class="flex flex-col items-center justify-center mb-16 relative z-10">
            <div x-show="show" x-transition:enter="transition ease-out duration-1000"
                x-transition:enter-start="opacity-0 translate-y-10" x-transition:enter-end="opacity-100 translate-y-0"
                class="flex flex-col items-center">

                <img src="{{ asset('assets/png/eternalserenity/cincin2.png') }}" alt="Akad"
                    class="w-20 h-20 object-contain mb-6">
                <h2 class="text-white text-center font-utama text-4xl mb-8 tracking-widest">Akad Nikah</h2>

                <div class="flex items-center gap-4 text-white">
                    <div class="text-right">
                        <p class="font-poppins text-[10px] uppercase tracking-[0.2em] text-white/60">
                            {{ Carbon\Carbon::parse($invitation->content['tanggal_akad'])->locale('id')->isoFormat('dddd') }}
                        </p>
                        <p class="font-poppins text-sm font-light tracking-widest uppercase">
                            {{ Carbon\Carbon::parse($invitation->content['tanggal_akad'])->locale('id')->isoFormat('MMMM') }}
                        </p>
                    </div>
                    <div class="w-px h-10 bg-white/20"></div>
                    <h3 class="font-utama text-5xl">
                        {{ Carbon\Carbon::parse($invitation->content['tanggal_akad'])->locale('id')->isoFormat('DD') }}
                    </h3>
                    <div class="w-px h-10 bg-white/20"></div>
                    <div class="text-left">
                        <p class="font-poppins text-[10px] uppercase tracking-[0.2em] text-white/60">Pukul</p>
                        <p class="font-poppins text-sm font-light tracking-widest">
                            {{ Carbon\Carbon::parse($invitation->content['tanggal_akad'])->locale('id')->isoFormat('YYYY') }}
                        </p>
                    </div>
                </div>
                <p class="text-white/80 font-poppins text-xs tracking-[0.3em] uppercase mt-6">
                    {{ Carbon\Carbon::parse($invitation->content['tanggal_akad'])->locale('id')->isoFormat('HH:mm') }} —
                    Selesai
                </p>
            </div>
        </div>

        <!-- Divider - Dibungkus x-intersect sendiri -->
        <div x-data="{ show: false }" x-intersect="show = true" class="flex items-center justify-center mb-16">
            <div x-show="show" x-transition:enter="transition ease-out duration-1000 delay-300"
                x-transition:enter-start="opacity-0 scale-x-0" x-transition:enter-end="opacity-100 scale-x-100"
                class="h-px w-12 bg-white/20"></div>
        </div>

        <!-- Bagian Resepsi - Dibungkus x-intersect sendiri -->
        <div x-data="{ show: false }" x-intersect="show = true"
            class="flex flex-col items-center justify-center relative z-10">
            <div x-show="show" x-transition:enter="transition ease-out duration-1000"
                x-transition:enter-start="opacity-0 translate-y-10" x-transition:enter-end="opacity-100 translate-y-0"
                class="flex flex-col items-center">

                <img src="{{ asset('assets/png/eternalserenity/glas1.png') }}" alt="Resepsi"
                    class="w-20 h-20 object-contain mb-6">
                <h2 class="text-white text-center font-utama text-4xl mb-8 tracking-widest">Resepsi</h2>

                <div class="flex items-center gap-4 text-white">
                    <div class="text-right">
                        <p class="font-poppins text-[10px] uppercase tracking-[0.2em] text-white/60">
                            {{ Carbon\Carbon::parse($invitation->content['tanggal_resepsi'])->locale('id')->isoFormat('dddd') }}
                        </p>
                        <p class="font-poppins text-sm font-light tracking-widest uppercase">
                            {{ Carbon\Carbon::parse($invitation->content['tanggal_resepsi'])->locale('id')->isoFormat('MMMM') }}
                        </p>
                    </div>
                    <div class="w-px h-10 bg-white/20"></div>
                    <h3 class="font-utama text-5xl">
                        {{ Carbon\Carbon::parse($invitation->content['tanggal_resepsi'])->locale('id')->isoFormat('DD') }}
                    </h3>
                    <div class="w-px h-10 bg-white/20"></div>
                    <div class="text-left">
                        <p class="font-poppins text-[10px] uppercase tracking-[0.2em] text-white/60">Pukul</p>
                        <p class="font-poppins text-sm font-light tracking-widest">
                            {{ Carbon\Carbon::parse($invitation->content['tanggal_resepsi'])->locale('id')->isoFormat('YYYY') }}
                        </p>
                    </div>
                </div>
                <p class="text-white/80 font-poppins text-xs tracking-[0.3em] uppercase mt-6">
                    {{ Carbon\Carbon::parse($invitation->content['tanggal_resepsi'])->locale('id')->isoFormat('HH:mm') }}
                    —
                    Selesai
                </p>
            </div>
        </div>
        <!-- Ornamen Bawah (Kiri) -->
        <div x-data="{ show: false }" x-intersect="show = true">
            <div x-show="show" x-transition:enter="transition ease-out duration-1000 delay-300"
                x-transition:enter-start="opacity-0 scale-50 -translate-x-10 translate-y-10"
                x-transition:enter-end="opacity-100 scale-100 translate-x-0 translate-y-0">
                <div class="absolute bottom-0 left-0 w-32 h-32 bg-white/5 rounded-full -ml-12 -mb-12"></div>
            </div>
        </div>

    </div>

    <!-- Tombol Google Maps -->
    <div x-data="{ show: false }" x-intersect="show = true" class="mt-10 w-full max-w-xs">
        <div x-show="show" x-transition:enter="transition ease-out duration-700 delay-500"
            x-transition:enter-start="opacity-0 translate-y-5" x-transition:enter-end="opacity-100 translate-y-0">
            <a href="{{ $invitation->content['maps'] }}"
                class="group flex items-center justify-center gap-3 bg-red-950 text-white font-poppins text-[11px] py-4 rounded-full shadow-lg tracking-[0.2em] uppercase active:scale-95 transition-all duration-300">
                <i class="fa-solid fa-location-dot animate-bounce"></i>
                Buka Maps Lokasi
            </a>
        </div>
    </div>
</div>

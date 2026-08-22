<?php

use Livewire\Component;

new class extends Component {
    //
};
?>

<div x-data="{ show: false }" x-init="setTimeout(() => show = true, 150)">
    <div class="h-screen flex flex-col relative overflow-hidden">

        <!-- 1. Background Pagar (Silhouette) -->
        <div class="absolute w-full h-full z-0 -right-50 opacity-5 pointer-events-none"
             x-show="show"
             x-transition:enter="transition ease-out duration-[1500ms]"
             x-transition:enter-start="translate-x-20"
             x-transition:enter-end="translate-x-0">
            <img src="{{ asset('assets/png/rusticbeige/pagar.png') }}" alt="Siluet Pagar"
                class="w-full h-full object-cover">
        </div>

        <!-- 2. Bunga (Pojok Kiri Bawah) -->
        <div class="absolute -bottom-10 -left-15 w-70 z-20 drop-shadow-lg pointer-events-none"
             x-show="show"
             x-transition:enter="transition ease-out duration-1000 delay-300"
             x-transition:enter-start="opacity-0 translate-y-10 -translate-x-10"
             x-transition:enter-end="opacity-100 translate-y-0 translate-x-0">
            <img src="{{ asset('assets/png/rusticbeige/bunga1.png') }}" alt="Bunga" class="w-full object-cover">
        </div>

        <!-- 3. Bagian Visual: Foto Menggantung dari Atas -->
        <div class="relative w-full h-[55%] z-10"
             x-show="show"
             x-transition:enter="transition ease-out duration-1000"
             x-transition:enter-start="opacity-0 -translate-y-full"
             x-transition:enter-end="opacity-100 translate-y-0">
            <div class="absolute inset-x-8 top-0 bottom-0 rounded-b-full overflow-hidden shadow-lg bg-gray-50">
                <img src="{{ $invitation->getPhoto('c2') }}" alt="Mempelai"
                    class="w-full h-full object-cover object-center">
            </div>
        </div>

        <!-- 4. Bagian Tipografi: Teks di Bawah Foto (Opsi 2) -->
        <div class="flex-1 flex flex-col justify-center px-8 z-10 pb-8 text-right items-end w-full">

            <p class="text-[9px] font-['Poppins'] text-[#3E2C23]/60 uppercase tracking-[0.4em] mb-3"
               x-show="show" x-transition:enter="transition ease-out duration-700 delay-500" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                Save The Date
            </p>

            <!-- Teks Rata Kanan -->
            <h2 class="text-[3.5rem] font-['Abigail'] text-[#3E2C23] leading-none"
                x-show="show" x-transition:enter="transition ease-out duration-700 delay-700" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                {{ $invitation->content['nama_pria'] }}</h2>
            <span class="text-xl font-['Abigail'] text-[#3E2C23]/50 my-1 pr-16"
                  x-show="show" x-transition:enter="transition ease-out duration-700 delay-[850ms]" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">&</span>
            <h2 class="text-[3.5rem] font-['Abigail'] text-[#3E2C23] leading-none"
                x-show="show" x-transition:enter="transition ease-out duration-700 delay-1000" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                {{ $invitation->content['nama_wanita'] }}</h2>

            <!-- Garis & Tanggal -->
            <div class="mt-6 flex items-center justify-end gap-3 w-full"
                 x-show="show" x-transition:enter="transition ease-out duration-700 delay-[1200ms]" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                <div class="h-px w-12 bg-[#3E2C23]/30"></div>
                <p class="text-[10px] font-['Poppins'] text-[#3E2C23]/80 tracking-[0.2em] font-medium uppercase">
                    24 . 12 . 2026
                </p>
            </div>

        </div>

    </div>
</div>

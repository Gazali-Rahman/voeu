<?php

use Livewire\Component;

new class extends Component {
    //
};
?>

<div x-data="{ show: false }" x-intersect.half.once="show = true">
    <!-- Menggunakan min-h-screen agar halamannya bernapas lega -->
    <div class=" flex flex-col items-center justify-center  px-8 py-16 relative overflow-hidden">
        <!-- Watermark Tanda Kutip di Background (Sangat transparan) -->
        <span
            class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-[15rem] leading-none font-serif text-[#3E2C23]/5 z-0 pointer-events-none select-none"
            x-show="show" x-transition:enter="transition ease-out duration-[1500ms]" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100">
            "
        </span>

        <div class="relative z-10 flex flex-col items-center text-center max-w-sm">

            <!-- Ornamen Pembuka (Garis & Ikon Hati Kecil) -->
            <div class="flex items-center justify-center gap-4 mb-10 w-full"
                 x-show="show" x-transition:enter="transition ease-out duration-1000 delay-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">
                <div class="h-px w-10 bg-[#3E2C23]/20"></div>
                <!-- Ikon Hati (Heroicons) -->
                <img src="{{ asset('assets/png/rusticbeige/bunga2.png') }}" class="w-20" alt="">
                <div class="h-px w-10 bg-[#3E2C23]/20"></div>
            </div>

            <!-- Teks Kutipan -->
            <!-- leading-loose memberikan jarak antar baris yang luas agar nyaman dibaca -->
            <p class="text-[13px] font-['Poppins'] text-[#3E2C23]/80 leading-loose tracking-wide mb-10"
               x-show="show" x-transition:enter="transition ease-out duration-700 delay-500" x-transition:enter-start="opacity-0 translate-y-6" x-transition:enter-end="opacity-100 translate-y-0">
                "Dan di antara tanda-tanda kekuasaan-Nya ialah Dia menciptakan untukmu isteri-isteri dari jenismu
                sendiri, supaya kamu cenderung dan merasa tenteram kepadanya, dan dijadikan-Nya diantaramu rasa kasih
                dan sayang."
            </p>

            <!-- Sumber Kutipan -->
            <div class="flex flex-col items-center">
                <h3 class="text-3xl font-['Abigail'] text-[#3E2C23] mb-3"
                    x-show="show" x-transition:enter="transition ease-out duration-700 delay-700" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                    QS. Ar-Rum
                </h3>
                <p class="text-[10px] font-['Poppins'] text-[#3E2C23]/60 tracking-[0.5em] uppercase font-medium"
                   x-show="show" x-transition:enter="transition ease-out duration-700 delay-[850ms]" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                    Ayat 21
                </p>
            </div>

            <!-- Garis Penutup -->
            <div class="h-px w-16 bg-[#3E2C23]/20 mt-10"
                 x-show="show" x-transition:enter="transition ease-out duration-700 delay-1000" x-transition:enter-start="opacity-0 scale-x-0" x-transition:enter-end="opacity-100 scale-x-100 origin-center"></div>

        </div>
    </div>
</div>

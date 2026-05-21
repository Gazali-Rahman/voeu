<?php

use Livewire\Component;

new class extends Component {
    //
};
?>

<div>
    <!-- Menggunakan min-h-screen agar halamannya bernapas lega -->
    <div class=" flex flex-col items-center justify-center  px-8 py-16 relative overflow-hidden">
        <!-- Watermark Tanda Kutip di Background (Sangat transparan) -->
        <span
            class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-[15rem] leading-none font-serif text-[#3E2C23]/5 z-0 pointer-events-none select-none">
            "
        </span>

        <div class="relative z-10 flex flex-col items-center text-center max-w-sm">

            <!-- Ornamen Pembuka (Garis & Ikon Hati Kecil) -->
            <div class="flex items-center justify-center gap-4 mb-10 w-full">
                <div class="h-px w-10 bg-[#3E2C23]/20"></div>
                <!-- Ikon Hati (Heroicons) -->
                <img src="{{ asset('assets/png/rusticbeige/bunga2.png') }}" class="w-20" alt="">
                <div class="h-px w-10 bg-[#3E2C23]/20"></div>
            </div>

            <!-- Teks Kutipan -->
            <!-- leading-loose memberikan jarak antar baris yang luas agar nyaman dibaca -->
            <p class="text-[13px] font-['Poppins'] text-[#3E2C23]/80 leading-loose tracking-wide mb-10">
                "Dan di antara tanda-tanda kekuasaan-Nya ialah Dia menciptakan untukmu isteri-isteri dari jenismu
                sendiri, supaya kamu cenderung dan merasa tenteram kepadanya, dan dijadikan-Nya diantaramu rasa kasih
                dan sayang."
            </p>

            <!-- Sumber Kutipan -->
            <div class="flex flex-col items-center">
                <h3 class="text-3xl font-['Abigail'] text-[#3E2C23] mb-3">
                    QS. Ar-Rum
                </h3>
                <p class="text-[10px] font-['Poppins'] text-[#3E2C23]/60 tracking-[0.5em] uppercase font-medium">
                    Ayat 21
                </p>
            </div>

            <!-- Garis Penutup -->
            <div class="h-px w-16 bg-[#3E2C23]/20 mt-10"></div>

        </div>
    </div>
</div>

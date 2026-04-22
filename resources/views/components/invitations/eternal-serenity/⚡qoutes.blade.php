<?php

use Livewire\Component;

new class extends Component {
    //
};
?>

<div class="bg-[#F5E9D8] relative overflow-hidden flex flex-col items-center justify-center px-2">

    <!-- Ornamen Bunga Atas -->
    <!-- x-intersect akan memicu 'show = true' SAAT elemen ini terlihat di layar saat di-scroll -->
    <div x-data="{ show: false }" x-intersect="show = true" class="mb-8">
        <img x-show="show" x-transition:enter="transition ease-out duration-1000"
            x-transition:enter-start="opacity-0 -translate-y-10" x-transition:enter-end="opacity-40 translate-y-0"
            src="{{ asset('assets/png/eternalserenity/redflower.png') }}" alt=""
            class="w-16 h-auto grayscale opacity-40">
    </div>

    <!-- Konten Utama -->
    <div x-data="{ show: false }" x-intersect="show = true" class="max-w-md w-full">

        <div class="flex justify-center mb-6">
            <div class="w-12 h-px bg-red-950/20"></div>
        </div>

        <!-- Terjemahan Ayat -->
        <h1 x-show="show" x-transition:enter="transition ease-out duration-1000 delay-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            class="font-poppins text-red-950 text-[10px]  tracking-[0.05em] leading-relaxed font-light text-center italic px-4">
            "Dan di antara tanda-tanda (kebesaran)-Nya ialah Dia menciptakan pasangan-pasangan untukmu dari jenismu
            sendiri, agar kamu cenderung dan merasa tenteram kepadanya, dan Dia menjadikan di antaramu rasa kasih dan
            sayang. Sungguh, pada yang demikian itu benar-benar terdapat tanda-tanda (kebesaran Allah) bagi kaum yang
            berpikir."
        </h1>

        <!-- Nama Surah -->
        <p x-show="show" x-transition:enter="transition ease-out duration-1000 delay-700"
            class="font-utama text-red-950 text-lg mt-6 text-center tracking-widest">
            QS. AR-RUM: 21
        </p>

        <div class="flex justify-center mt-6">
            <div class="w-12 h-px bg-red-950/20"></div>
        </div>
    </div>
</div>

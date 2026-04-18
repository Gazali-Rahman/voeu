<?php

use Livewire\Component;

new class extends Component {
    // WAJIB ADA INI:
    public $guestName;

    public function mount($guestName = null)
    {
        $this->guestName = $guestName;
    }
};
?>

<div class="flex flex-col items-center justify-center text-center py-10 overflow-hidden">

    <!-- Ornamen Garis Atas -->
    <div x-data="{ show: false }" x-intersect="show = true" class="mb-10">
        <!-- H-16 ditaruh di class utama agar tidak hilang -->
        <div x-show="show" x-transition:enter="transition ease-out duration-[1500ms]"
            x-transition:enter-start="opacity-0 scale-y-0" x-transition:enter-end="opacity-100 scale-y-100"
            class="w-px h-16 bg-linear-to-t from-[#C08552] to-transparent origin-bottom"></div>
    </div>

    <div x-data="{ show: false }" x-intersect="show = true" class="max-w-xs mx-auto">
        <!-- Judul Kecil -->
        <h2 x-show="show" x-transition:enter="transition ease-out duration-1000 delay-300"
            x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
            class="font-poppins font-light tracking-[0.4em] text-[10px] uppercase text-gray-400 mb-8">
            The Holy Matrimony
        </h2>

        <!-- Konten Ayat/Quote -->
        <p x-show="show" x-transition:enter="transition ease-out duration-1000 delay-500"
            x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
            class="font-poppins text-[10px] font-light italic leading-relaxed text-black px-4">
            "Dan di antara tanda-tanda kekuasaan-Nya ialah Dia menciptakan untukmu isteri-isteri dari jenismu sendiri,
            supaya kamu cenderung dan merasa tenteram kepadanya, dan dijadikan-Nya diantaramu rasa kasih dan sayang."
        </p>

        <!-- Sumber Ayat -->
        <p x-show="show" x-transition:enter="transition ease-out duration-1000 delay-700"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            class="mt-6 font-utama font-bold text-[11px] tracking-widest uppercase text-[#C08552]">
            — Ar-Rum: 21
        </p>
    </div>

    <!-- Garis Pembatas Halus -->
    <div x-data="{ show: false }" x-intersect="show = true" class="flex items-center gap-4 my-12 w-full max-w-[200px]">
        <div x-show="show" x-transition:enter="transition ease-out duration-1000 delay-1000"
            x-transition:enter-start="opacity-0 scale-x-0" x-transition:enter-end="opacity-100 scale-x-100"
            class="h-px bg-gray-200 flex-1 origin-right"></div>

        <div x-show="show" x-transition:enter="transition ease-out duration-500 delay-900"
            x-transition:enter-start="opacity-0 scale-0" x-transition:enter-end="opacity-100 scale-100"
            class="w-1.5 h-1.5 rounded-full bg-[#C08552]"></div>

        <div x-show="show" x-transition:enter="transition ease-out duration-1000 delay-1000"
            x-transition:enter-start="opacity-0 scale-x-0" x-transition:enter-end="opacity-100 scale-x-100"
            class="h-px bg-gray-200 flex-1 origin-left"></div>
    </div>

    <div x-data="{ show: false }" x-intersect="show = true">
        <!-- Pesan Pembuka -->
        <p x-show="show" x-transition:enter="transition ease-out duration-1000 delay-300"
            x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
            class="font-poppins max-w-xs font-light text-[10px] leading-relaxed text-gray-500 tracking-wide">
            Atas doa dan restu keluarga serta sahabat, kami mengundang {{ $guestName }} untuk menyaksikan momen
            sakral penyatuan cinta kami.
        </p>

        <!-- Ornamen Garis Bawah -->
        <div x-show="show" x-transition:enter="transition ease-out duration-[1500ms] delay-500"
            x-transition:enter-start="opacity-0 scale-y-0" x-transition:enter-end="opacity-100 scale-y-100"
            class="w-px h-16 bg-linear-to-b from-[#C08552] to-transparent mx-auto mt-10 origin-top"></div>
    </div>
</div>

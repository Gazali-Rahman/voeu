<?php

use Livewire\Component;

new class extends Component {
    //
};
?>

<div class="bg-[#F5E9D8] overflow-hidden flex flex-col items-center justify-center px-6 py-20">

    <!-- Judul Section - Fade In Down -->
    <div x-data="{ show: false }" x-intersect="show = true">
        <h2 x-show="show" x-transition:enter="transition ease-out duration-1000"
            x-transition:enter-start="opacity-0 -translate-y-10" x-transition:enter-end="opacity-100 translate-y-0"
            class="font-utama text-red-950 text-4xl mb-10">
            Bride & Groom
        </h2>
    </div>

    <!-- Container Mempelai Pria - Slide In Left -->
    <div x-data="{ show: false }" x-intersect="show = true" class="flex flex-col items-center mb-5 w-full max-w-xs">

        <div x-show="show" x-transition:enter="transition ease-out duration-1000 delay-200"
            x-transition:enter-start="opacity-0 -translate-x-20" x-transition:enter-end="opacity-100 translate-x-0"
            class="flex flex-col items-center">

            <!-- Frame Foto -->
            <div class="p-2 border-2 border-red-950/20 rounded-full mb-3">
                <div class="rounded-full aspect-square w-48 bg-cover bg-center border-4 border-white shadow-lg"
                    style="background-image: url('{{ $invitation->getPhoto('groom') }}');">
                </div>
            </div>

            <h3 class="font-utama text-red-950 text-4xl mb-2">{{ $invitation->content['nama_pria'] }}</h3>
            <div class="w-10 h-px bg-red-950/30 mb-3"></div>
            <p class="font-poppins text-red-950/70 text-sm text-center leading-relaxed">
                {{ $invitation->content['label_ortu_pria'] }} {{ $invitation->content['ayah_pria'] }} <br> &
                {{ $invitation->content['ibu_pria'] }}
            </p>
        </div>
    </div>

    <!-- Simbol Penghubung (&) - Fade In Scale -->
    <div x-data="{ show: false }" x-intersect="show = true">
        <div x-show="show" x-transition:enter="transition ease-out duration-1000 delay-500"
            x-transition:enter-start="opacity-0 scale-50" x-transition:enter-end="opacity-100 scale-100"
            class="font-utama text-red-950/20 text-6xl my-2">
            &
        </div>
    </div>

    <!-- Container Mempelai Wanita - Slide In Right -->
    <div x-data="{ show: false }" x-intersect="show = true" class="flex flex-col items-center mt-5 w-full max-w-xs">

        <div x-show="show" x-transition:enter="transition ease-out duration-1000 delay-200"
            x-transition:enter-start="opacity-0 translate-x-20" x-transition:enter-end="opacity-100 translate-x-0"
            class="flex flex-col items-center">

            <!-- Frame Foto -->
            <div class="p-2 border-2 border-red-950/20 rounded-full mb-3">
                <div class="rounded-full aspect-square w-48 bg-cover bg-center border-4 border-white shadow-lg"
                    style="background-image: url('{{ $invitation->getPhoto('bride') }}');">
                </div>
            </div>

            <h3 class="font-utama text-red-950 text-4xl mb-2">{{ $invitation->content['nama_wanita'] }}</h3>
            <div class="w-10 h-px bg-red-950/30 mb-3"></div>
            <p class="font-poppins text-red-950/70 text-sm text-center leading-relaxed">
                {{ $invitation->content['label_ortu_wanita'] }} {{ $invitation->content['ayah_wanita'] }} <br> &
                {{ $invitation->content['ibu_wanita'] }}
            </p>
        </div>
    </div>
</div>

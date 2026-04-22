<?php

use Livewire\Component;

new class extends Component {
    //
};
?>
<section class="relative w-full  py-20 px-10 overflow-hidden max-w-md mx-auto">

    {{-- <div class="absolute  left-1/2 -translate-x-1/2 -translate-y-1/2  pointer-events-none">
        <img src="{{ asset('assets/png/javaneseessence/gunungan.png') }}" class="w-44 h-auto">
    </div> --}}
    {{-- <div class="absolute top-1/2 -right-20 -translate-y-1/2 opacity-[0.03] grayscale pointer-events-none">
        <img src="{{ asset('assets/png/javaneseessence/gunungan.png') }}" class="w-44 h-auto">
    </div> --}}

    <div class="relative z-10 flex flex-col items-center text-center">

        <div x-data="{ show: false }" x-intersect="show = true" class="mb-4">
            <img src="{{ asset('assets/png/javaneseessence/gunungan.png') }}" x-show="show"
                x-transition:enter="transition ease-out duration-1000 delay-500" x-transition:enter-start="opacity-0 "
                x-transition:enter-end="opacity-100 " class="w-20 h-auto">
        </div>

        <div x-data="{ show: false }" x-intersect="show = true" class="flex flex-col gap-4">
            <p x-show="show" x-transition:enter="transition ease-out duration-1000 delay-500"
                x-transition:enter-start="opacity-0 " x-transition:enter-end="opacity-100 "
                class="font-poppins text-[#5a3a2e]/80 text-[10px] leading-relaxed tracking-widest">
                Dan di antara tanda-tanda kekuasaan-Nya ialah Dia menciptakan untukmu isteri-isteri dari jenismu
                sendiri, supaya kamu merasa tenteram kepadanya, dan dijadikan-Nya diantaramu rasa kasih dan sayang.
            </p>

            <p x-show="show" x-transition:enter="transition ease-out duration-1000 delay-800"
                x-transition:enter-start="opacity-0 " x-transition:enter-end="opacity-100 "
                class="font-abigail text-[#5a3a2e] text-xl tracking-widest mt-2">
                QS. Ar-Rum: 21
            </p>
        </div>
    </div>
</section>

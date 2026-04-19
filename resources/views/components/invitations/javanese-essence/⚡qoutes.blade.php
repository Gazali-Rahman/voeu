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

        <div class="mb-4">
            <img src="{{ asset('assets/png/javaneseessence/gunungan.png') }}" class="w-20 h-auto">
        </div>

        <div class="flex flex-col gap-4">
            <p class="font-poppins text-[#5a3a2e]/80 text-[10px] leading-relaxed tracking-widest">
                Dan di antara tanda-tanda kekuasaan-Nya ialah Dia menciptakan untukmu isteri-isteri dari jenismu
                sendiri, supaya kamu merasa tenteram kepadanya, dan dijadikan-Nya diantaramu rasa kasih dan sayang.
            </p>

            <p class="font-abigail text-[#5a3a2e] text-xl tracking-widest mt-2">
                QS. Ar-Rum: 21
            </p>
        </div>

        {{-- <div class="mt-6 opacity-20 rotate-180">
            <svg width="30" height="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M10 7L8 11H11V17H5V11L7 7H10ZM19 7L17 11H20V17H14V11L16 7H19Z" fill="#5a3a2e" />
            </svg>
        </div> --}}


    </div>
</section>

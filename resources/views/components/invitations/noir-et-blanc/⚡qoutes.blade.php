<?php

use Livewire\Component;

new class extends Component {
    //
};
?>

<!-- Section: Mukadimah Typography Editorial (Fine Scale) -->
<div class="bg-white px-4 py-10 relative overflow-hidden h-fit space-y-20">

    <!-- 1. Watermark Background -->
    <div class="absolute top-0 -left-10 opacity-[0.02] select-none pointer-events-none" x-data="{ visible: false }"
        x-intersect.once="visible = true">
        <h2 class="font-vogue text-[10rem] leading-none uppercase italic text-black transition-opacity duration-1000"
            :class="visible ? 'opacity-100' : 'opacity-0'">
            Ar-Rum
        </h2>
    </div>

    <!-- 2. Header: AR-RUM 21 -->
    <div class="relative z-10 flex flex-col items-center text-center space-y-1" x-data="{ visible: false }"
        x-intersect.once="visible = true">
        <div class="transition-all duration-1000 transform"
            :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">
            <span class="font-serif italic text-[9px] tracking-[0.5em] text-gray-400 uppercase">Sacred Union</span>
            <h3 class="font-vogue text-lg tracking-[0.3em] text-black">AR-RUM • 21</h3>
        </div>
    </div>

    <!-- 3. Typography Content -->
    <div class="relative z-10 flex flex-col items-center text-center" x-data="{ visible: false }"
        x-intersect.once.margin.-10%="visible = true">
        <div class="max-w-[280px] space-y-5 transition-all duration-1000 delay-300 transform"
            :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">

            <div class="flex flex-col space-y-3">
                <span class="font-vogue text-3xl text-black leading-none self-start tracking-tighter">MENCIPTAKAN</span>
                <div class="flex items-center gap-3 justify-center">
                    <div class="h-[0.5px] flex-1 bg-black/10"></div>
                    <span class="font-poppins font-light text-sm text-gray-400 lowercase tracking-widest">untukmu</span>
                    <div class="h-[0.5px] flex-1 bg-black/10"></div>
                </div>
                <span class="font-vogue text-3xl text-black leading-none self-end tracking-tighter">PASANGAN</span>
                <p class="font-light text-gray-400 text-[9px] tracking-[0.2em] uppercase leading-relaxed pt-2">
                    Dari jenismu sendiri agar kamu <br>
                    <span class="text-black font-semibold italic">merasa tenteram</span> kepadanya.
                </p>
            </div>
        </div>
    </div>

    <!-- 4. Divider PNG -->
    <div class="relative z-10 flex flex-col items-center py-2" x-data="{ visible: false }"
        x-intersect.once="visible = true">
        <div class="transition-all duration-1000 delay-500 transform flex flex-col items-center"
            :class="visible ? 'opacity-100 scale-y-100' : 'opacity-0 scale-y-0'">
            <div class="h-12 w-px bg-black/10"></div>
            <img src="{{ asset('assets/png/noiretblanc/1.png') }}" alt="Icon" class="w-5 h-5 my-3 opacity-60">
            <div class="h-12 w-px bg-black/10"></div>
        </div>
    </div>

    <!-- 5. Bagian Kasih Sayang -->
    <div class="relative z-10 flex flex-col items-center text-center space-y-3" x-data="{ visible: false }"
        x-intersect.once="visible = true">
        <div class="transition-all duration-1000 delay-200 transform"
            :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">
            <p class="font-serif italic text-gray-400 text-xs lowercase">
                "Dan dijadikan-Nya diantaramu rasa"
            </p>
            <h4 class="font-vogue text-2xl text-black tracking-widest uppercase">Kasih & Sayang</h4>
        </div>
    </div>

</div>

<?php
use Livewire\Component;

new class extends Component {
    //
};
?>

<section class="relative py-20 px-8 flex flex-col items-center bg-[#EAE8E3]">
    <div class="absolute top-10 left-1/2 -translate-x-1/2 text-black/30 font-mono text-[10px]">+</div>

    <div x-data="{ show: false }" x-intersect="show = true" class="text-center w-full max-w-sm relative z-10 my-10">
        <span x-show="show" x-transition:enter="transition ease-in-out duration-1000"
            x-transition:enter-start="opacity-0 " x-transition:enter-end="opacity-100"
            class="inline-block font-mono text-[8px] text-black/40 tracking-[0.5em] mb-8 uppercase border border-black/10 py-1 px-3">
            [ The Prologue ]
        </span>

        <p x-show="show" x-transition:enter="transition ease-in-out duration-1000 delay-500"
            x-transition:enter-start="opacity-0 " x-transition:enter-end="opacity-100"
            class="font-abigail text-3xl leading-relaxed text-black/80">
            And we created <br> you in pairs.
        </p>

        <div x-show="show" x-transition:enter="transition ease-in-out duration-1000 delay-1000"
            x-transition:enter-start="opacity-0 " x-transition:enter-end="opacity-100"
            class="mt-10 flex items-center justify-center gap-4">
            <div class="w-8 h-[0.5px] bg-black/20"></div>
            <p class="font-mono text-[8px] tracking-[0.4em] uppercase text-black/50">
                QS. An-Naba : 8
            </p>
            <div class="w-8 h-[0.5px] bg-black/20"></div>
        </div>
    </div>

    <div class="absolute bottom-10 left-1/2 -translate-x-1/2 text-black/30 font-mono text-[10px]">+</div>
</section>

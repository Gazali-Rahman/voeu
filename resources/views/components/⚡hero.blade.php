<?php

use Livewire\Component;

new class extends Component {
    //
};
?>

<div class="relative min-h-[calc(100vh-80px)] w-full bg-[#F9F8F6] overflow-hidden">
    <div class="max-w-7xl mx-auto h-full px-4 sm:px-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 min-h-[calc(100vh-80px)] items-center">

            <div class="relative z-10 py-20 lg:py-0">


                <div class="mb-10">
                    <h1
                        class="text-6xl md:text-8xl font-utama tracking-[-0.02em] uppercase text-[#1a1a1a] leading-[0.9]">
                        Voeu
                    </h1>
                    <p class="mt-4 text-[10px] md:text-xs uppercase tracking-[0.6em] text-gray-500 font-medium">
                        Digital Invitations
                    </p>
                </div>

                <div class="max-w-sm mb-12">
                    <p class="text-[11px] leading-loose uppercase tracking-[0.2em] text-[#1a1a1a]/60">
                        Crafting timeless digital experiences for your most cherished moments.
                        Where every detail is curated with a fine art aesthetic.
                    </p>
                </div>

                <div class="flex items-center gap-8">
                    <a href="#catalog"
                        class="group relative border border-[#1a1a1a] px-12 py-4 transition-all duration-500 hover:bg-[#1a1a1a] flex justify-center items-center">
                        <span
                            class="relative z-10 text-[10px] uppercase tracking-[0.5em] text-[#1a1a1a] group-hover:text-white transition-colors -mr-[0.5em]">
                            Explore Now
                        </span>
                    </a>
                </div>
            </div>

            <div class="relative h-full w-full hidden lg:flex items-center justify-center">
                <div class="relative w-full h-[80%] flex items-center justify-center">
                    <img src="{{ asset('assets/png/1.png') }}" alt="" class="w-full h-full object-cover">
                </div>
            </div>

        </div>
    </div>

    <div class="absolute bottom-0 left-0 p-10 hidden md:block">
        <p class="text-[9px] text-gray-300 tracking-[0.4em] uppercase [writing-mode:vertical-lr] rotate-180">
            Est. 2026 &copy; Voeu
        </p>
    </div>
</div>

<style>
    @keyframes slide-up {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-slide-up {
        animation: slide-up 1.2s cubic-bezier(0.22, 1, 0.36, 1) forwards;
    }

    .animate-pulse-slow {
        animation: pulse 6s infinite ease-in-out;
    }

    @keyframes pulse {

        0%,
        100% {
            opacity: 0.2;
            transform: scale(1);
        }

        50% {
            opacity: 0.4;
            transform: scale(1.05);
        }
    }
</style>

<?php

use Livewire\Component;

new class extends Component {
    public $invitation;

    public function mount($invitation)
    {
        $this->invitation = $invitation;
    }
};
?>

<section class="relative w-full bg-[#F9F8F6] py-16 px-5 overflow-hidden max-w-md mx-auto text-gray-800">

    <div class="relative z-10 flex flex-col items-center">

        <!-- ========================================== -->
        <!-- HEADER / TITLE SECTION -->
        <!-- ========================================== -->
        <div x-data="{ show: false }" x-intersect.half.once="show = true"
            class="mb-12 flex flex-col items-center text-center">
            <h2 x-show="show" x-transition:enter="transition ease-out duration-1000"
                x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
                class="font-samantha text-5xl text-black mb-8 select-none">
                The Celebration
            </h2>
            <div x-show="show" x-transition:enter="transition ease-out duration-1000 delay-300"
                x-transition:enter-start="opacity-0 scale-75" x-transition:enter-end="opacity-100 scale-100"
                class="flex items-center gap-3">
                <div class="h-px w-10 bg-black/20"></div>
                <p class="font-indie text-xs tracking-[0.35em] uppercase text-black/60 font-bold">Save The Date</p>
                <div class="h-px w-10 bg-black/20"></div>
            </div>
        </div>

        <!-- ========================================== -->
        <!-- SINGLE UNIFIED EVENT CARD -->
        <!-- ========================================== -->
        <div x-data="{ show: false }" x-intersect.half.once="show = true"
            class="relative w-full bg-white/85 border border-black/15 rounded-[2.5rem] py-10 px-6 sm:px-8 shadow-sm overflow-hidden">

            <!-- Background Texture bg3.png (Single Unified BG) -->
            <img src="{{ asset('assets/png/esquisse/bg3.png') }}"
                class="absolute inset-0 w-full h-full object-cover opacity-5 pointer-events-none z-0"
                alt="Card Background">

            <!-- Inner Floating Sketch Frame -->
            <div class="absolute inset-2.5 border border-black/10 rounded-[2rem] pointer-events-none z-0"></div>

            <div class="relative z-10 flex flex-col">

                <!-- ========================================== -->
                <!-- 1. AKAD NIKAH (RATA KIRI) -->
                <!-- ========================================== -->
                <div class="flex flex-col items-start text-left">

                    <!-- Header Akad -->
                    <div x-show="show" x-transition:enter="transition ease-out duration-800"
                        x-transition:enter-start="opacity-0 -translate-x-4"
                        x-transition:enter-end="opacity-100 translate-x-0"
                        class="flex items-center justify-between w-full border-b border-black/10 pb-3 mb-4">
                        <h3 class="font-samantha text-3xl text-black leading-none">
                            Akad Nikah
                        </h3>
                        <span
                            class="inline-flex items-center px-3 py-0.5 rounded-full bg-black text-white font-indie text-[11px] tracking-wider">
                            Event 01
                        </span>
                    </div>

                    <!-- Detail Akad dengan Border Kiri -->
                    <div x-show="show" x-transition:enter="transition ease-out duration-1000 delay-200"
                        x-transition:enter-start="opacity-0 -translate-x-4"
                        x-transition:enter-end="opacity-100 translate-x-0"
                        class="border-l-2 border-black/25 pl-4 sm:pl-5 py-1 w-full">

                        <!-- Hari & Tanggal -->
                        <p class="font-poppins text-xs sm:text-[13px] font-bold tracking-[0.2em] uppercase text-black">
                            {{ \Carbon\Carbon::parse($invitation->content['tanggal_akad'])->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
                        </p>

                        <!-- Waktu -->
                        <div class="flex items-center gap-2 mt-1.5 text-black/75">
                            <img src="{{ asset('assets/png/esquisse/clock.png') }}" class="w-4 h-auto" alt="Clock">
                            <p class="font-indie text-xs tracking-wider">
                                Pukul
                                {{ \Carbon\Carbon::parse($invitation->content['tanggal_akad'])->locale('id')->isoFormat('HH:mm') }}
                                WIB - Selesai
                            </p>
                        </div>

                        <!-- Tempat & Alamat -->
                        <div class="mt-4">
                            <p class="font-indie text-sm font-bold text-black mb-0.5">
                                {{ $invitation->content['tempat_akad'] }}
                            </p>
                            <p class="font-indie text-xs text-black/60 leading-relaxed">
                                {{ $invitation->content['alamat_akad'] }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- ========================================== -->
                <!-- DIVIDER / PEMISAH TENGAH -->
                <!-- ========================================== -->
                <div class="my-8 flex items-center justify-center gap-4 w-full">
                    <div class="h-px flex-1 bg-black/15"></div>
                    <span class="font-samantha text-3xl text-black/40 select-none">&</span>
                    <div class="h-px flex-1 bg-black/15"></div>
                </div>

                <!-- ========================================== -->
                <!-- 2. RESEPSI PERNIKAHAN (RATA KANAN) -->
                <!-- ========================================== -->
                <div class="flex flex-col items-end text-right">

                    <!-- Header Resepsi -->
                    <div x-show="show" x-transition:enter="transition ease-out duration-800 delay-300"
                        x-transition:enter-start="opacity-0 translate-x-4"
                        x-transition:enter-end="opacity-100 translate-x-0"
                        class="flex items-center justify-between w-full border-b border-black/10 pb-3 mb-4">
                        <span
                            class="inline-flex items-center px-3 py-0.5 rounded-full bg-black text-white font-indie text-[11px] tracking-wider">
                            Event 02
                        </span>
                        <h3 class="font-samantha text-3xl text-black leading-none">
                            Resepsi
                        </h3>
                    </div>

                    <!-- Detail Resepsi dengan Border Kanan -->
                    <div x-show="show" x-transition:enter="transition ease-out duration-1000 delay-400"
                        x-transition:enter-start="opacity-0 translate-x-4"
                        x-transition:enter-end="opacity-100 translate-x-0"
                        class="border-r-2 border-black/25 pr-4 sm:pr-5 py-1 w-full flex flex-col items-end">

                        <!-- Hari & Tanggal -->
                        <p class="font-poppins text-xs sm:text-[13px] font-bold tracking-[0.2em] uppercase text-black">
                            {{ \Carbon\Carbon::parse($invitation->content['tanggal_resepsi'])->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
                        </p>

                        <!-- Waktu -->
                        <div class="flex items-center justify-end gap-2 mt-1.5 text-black/75">
                            <p class="font-indie text-xs tracking-wider">
                                Pukul
                                {{ \Carbon\Carbon::parse($invitation->content['tanggal_resepsi'])->locale('id')->isoFormat('HH:mm') }}
                                WIB - Selesai
                            </p>
                            <img src="{{ asset('assets/png/esquisse/clock.png') }}" class="w-4 h-auto" alt="Clock">
                        </div>

                        <!-- Tempat & Alamat -->
                        <div class="mt-4">
                            <p class="font-indie text-sm font-bold text-black mb-0.5">
                                {{ $invitation->content['tempat_resepsi'] }}
                            </p>
                            <p class="font-indie text-xs text-black/60 leading-relaxed">
                                {{ $invitation->content['alamat_resepsi'] }}
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- ========================================== -->
        <!-- GOOGLE MAPS BUTTON -->
        <!-- ========================================== -->
        @if (!empty($invitation->content['maps']))
            <div x-data="{ show: false }" x-intersect.half.once="show = true" class="mt-8 w-full flex justify-center">
                <a x-show="show" x-transition:enter="transition ease-out duration-1000 delay-300"
                    x-transition:enter-start="opacity-0 translate-y-4"
                    x-transition:enter-end="opacity-100 translate-y-0" href="{{ $invitation->content['maps'] }}"
                    target="_blank"
                    class="flex items-center justify-center gap-2.5 w-full bg-black text-white py-3.5 px-6 rounded-full font-indie tracking-wider text-sm shadow-md hover:bg-neutral-800 transition-all active:scale-95 group">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="w-4 h-4 group-hover:scale-110 transition-transform">
                        <path fill-rule="evenodd"
                            d="M11.54 22.351l.07.04.028.016a.76.76 0 00.723 0l.028-.015.071-.041a16.975 16.975 0 001.144-.742 19.58 19.58 0 002.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 00-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 002.682 2.282 16.975 16.975 0 001.145.742zM12 13.5a3 3 0 100-6 3 3 0 000 6z"
                            clip-rule="evenodd" />
                    </svg>
                    <span>Petunjuk Lokasi (Google Maps)</span>
                </a>
            </div>
        @endif

    </div>
</section>

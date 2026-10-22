<?php

use Livewire\Component;

new class extends Component {
    public $invitation;
    public $gifts = [];

    public function mount($invitation)
    {
        $this->invitation = $invitation;
        $this->gifts = $this->invitation->content['gifts'] ?? [];
    }
};
?>

<section class="relative w-full bg-[#F9F8F6] py-16 px-5 overflow-hidden max-w-md mx-auto text-gray-800">

    <div class="relative z-10 flex flex-col items-center">

        <!-- ========================================== -->
        <!-- HEADER / TITLE SECTION -->
        <!-- ========================================== -->
        <div x-data="{ show: false }" x-intersect.half.once="show = true"
            class="mb-8 flex flex-col items-center text-center relative w-full">

            <div class="relative z-10 flex flex-col items-center">
                <h2 x-show="show" x-transition:enter="transition ease-out duration-1000"
                    x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
                    class="font-samantha text-4xl text-black mb-2 select-none">
                    Wedding Gift
                </h2>
                <div x-show="show" x-transition:enter="transition ease-out duration-1000 delay-300"
                    x-transition:enter-start="opacity-0 scale-75" x-transition:enter-end="opacity-100 scale-100"
                    class="flex items-center gap-3">
                    <div class="h-px w-10 bg-black/20"></div>
                    <p class="font-indie text-xs tracking-[0.35em] uppercase text-black/60 font-bold">Digital Envelope</p>
                    <div class="h-px w-10 bg-black/20"></div>
                </div>
            </div>

            <!-- Pesan Pengantar -->
            <p x-show="show" x-transition:enter="transition ease-out duration-1000 delay-500"
                x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
                class="font-indie text-xs text-black/70 leading-relaxed text-center max-w-xs mt-6 px-2">
                Doa restu Anda merupakan karunia terindah bagi kami. Namun jika Anda ingin memberikan tanda kasih, kami menyediakan fitur amplop digital di bawah ini:
            </p>
        </div>

        <!-- ========================================== -->
        <!-- DIGITAL GIFT CARDS -->
        <!-- ========================================== -->
        <div x-data="{ show: false }" x-intersect.half.once="show = true"
            class="w-full max-w-sm flex flex-col gap-5">

            @forelse($gifts as $index => $gift)
                @php
                    $rot = ($index % 2 === 0) ? '-rotate-0.5' : 'rotate-0.5';
                @endphp

                <div x-show="show" x-transition:enter="transition ease-out duration-1000"
                    x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                    x-data="{ copied: false }"
                    class="relative bg-white/95 border border-black/15 rounded-3xl p-6 shadow-sm hover:shadow-md transition-all duration-300 {{ $rot }} hover:rotate-0 overflow-hidden">

                    <!-- Background Texture bg3.png (Inside Card) -->
                    <img src="{{ asset('assets/png/esquisse/bg3.png') }}"
                        class="absolute inset-0 w-full h-full object-cover opacity-10 rounded-3xl pointer-events-none z-0"
                        alt="Card Background">

                    <div class="relative z-10 flex flex-col">

                        <!-- Top Header: Bank Name & Icon -->
                        <div class="flex items-center justify-between mb-4">
                            <span class="inline-flex items-center px-3.5 py-1 rounded-full bg-[#F9F8F6] border border-black/15 font-indie text-xs font-bold uppercase tracking-wider text-black shadow-2xs">
                                {{ $gift['bank_name'] ?? 'Bank Transfer' }}
                            </span>
                            <div class="flex items-center gap-1.5 opacity-60">
                                <svg class="w-5 h-5 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                </svg>
                            </div>
                        </div>

                        <!-- Account Number & Owner -->
                        <div class="mb-5">
                            <p class="font-indie text-[11px] text-black/50 tracking-wider uppercase mb-1">
                                Nomor Rekening
                            </p>
                            <div class="flex items-center justify-between">
                                <span class="font-mono text-xl sm:text-2xl font-bold tracking-widest text-black select-all">
                                    {{ $gift['account_number'] ?? '-' }}
                                </span>
                            </div>
                            <p class="font-indie text-sm text-black/75 font-bold mt-1">
                                a.n {{ $gift['account_name'] ?? '-' }}
                            </p>
                        </div>

                        <!-- Copy Button -->
                        <button type="button"
                            @click="navigator.clipboard.writeText('{{ $gift['account_number'] ?? '' }}'); copied = true; setTimeout(() => copied = false, 2500)"
                            class="w-full py-2.5 rounded-full font-indie text-xs font-bold tracking-widest uppercase transition-all duration-300 shadow-xs flex items-center justify-center gap-2 cursor-pointer focus:outline-none"
                            :class="copied 
                                ? 'bg-emerald-600 text-white shadow-emerald-200' 
                                : 'bg-black text-white hover:bg-neutral-800 hover:scale-[1.01] active:scale-95'">
                            
                            <!-- State: Not Copied -->
                            <template x-if="!copied">
                                <span class="flex items-center gap-2">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                    </svg>
                                    Salin No. Rekening
                                </span>
                            </template>

                            <!-- State: Copied -->
                            <template x-if="copied">
                                <span class="flex items-center gap-1.5">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Tersalin ke Clipboard!
                                </span>
                            </template>
                        </button>

                    </div>
                </div>
            @empty
                <div class="text-center py-10 px-4 bg-white/70 border border-black/15 rounded-3xl">
                    <p class="font-indie text-xs text-black/50 italic">
                        Fitur amplop digital saat ini belum diaktifkan.
                    </p>
                </div>
            @endforelse

        </div>

        <!-- ========================================== -->
        <!-- CLOSING THANK YOU SECTION -->
        <!-- ========================================== -->
        <div x-data="{ show: false }" x-intersect.half.once="show = true"
            class="mt-14 flex flex-col items-center text-center">
            <div x-show="show" x-transition:enter="transition ease-out duration-1000"
                x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
                class="flex flex-col items-center">
                <p class="font-samantha text-3xl sm:text-4xl text-black mb-1">Thank You</p>
                <p class="font-indie text-xs text-black/60 tracking-wider">
                    {{ $invitation->content['nama_pria'] ?? 'Groom' }} & {{ $invitation->content['nama_wanita'] ?? 'Bride' }}
                </p>
                <div class="flex items-center gap-2 mt-4 opacity-30">
                    <div class="w-8 h-px bg-black"></div>
                    <span class="font-indie text-xs">✦</span>
                    <div class="w-8 h-px bg-black"></div>
                </div>
            </div>
        </div>

    </div>
</section>

<?php

use Livewire\Component;

new class extends Component {
    public $invitation;
    public $gifts = [];

    public function mount($invitation)
    {
        $this->invitation = $invitation;
        // Mengambil array daftar rekening dari JSON content
        $this->gifts = $this->invitation->content['gifts'] ?? [];
    }
};
?>

<section class="relative flex flex-col py-24 overflow-hidden max-w-md mx-auto">

    <div class="relative w-full mb-16 flex flex-col items-center px-6">
        <h3
            class="absolute -top-10 font-abigail text-[#5a3a2e]/5 text-[5rem] leading-none pointer-events-none uppercase text-center w-full">
            Envelope
        </h3>

        <div class="relative z-10 text-center">
            <h2 class="font-abigail text-[#5a3a2e] text-[3.5rem] leading-[0.8] tracking-tighter drop-shadow-sm">
                Digital <br> <span class="border-b border-[#5a3a2e]/10">Gift</span>
            </h2>
            <p
                class="mt-8 font-poppins text-[#5a3a2e]/60 text-[10px] uppercase tracking-[0.3em] leading-relaxed max-w-[250px] mx-auto text-center">
                Doa restu Anda adalah kado terindah, namun jika ingin memberi lebih, kami sediakan fitur ini.
            </p>
        </div>
    </div>

    {{-- Loop melalui daftar gift (rekening/dompet digital) --}}
    <div class="px-6 space-y-6">
        @foreach ($gifts as $gift)
            <div class="relative" x-data="{ copied: false }">
                <div
                    class="relative w-full aspect-[1.58/1] rounded-2xl p-8 text-white shadow-2xl overflow-hidden group">
                    <div class="absolute inset-0 bg-[#2d1e18]"></div>

                    <div class="absolute -top-10 -right-20 opacity-20 rotate-180">
                        <img src="{{ asset('assets/png/javaneseessence/motifawan.png') }}"
                            class="w-50 h-auto grayscale brightness-200">
                    </div>

                    <div class="absolute -bottom-10 -left-20 opacity-20">
                        <img src="{{ asset('assets/png/javaneseessence/motifawan.png') }}"
                            class="w-50 h-auto grayscale brightness-200">
                    </div>

                    <div class="relative z-10 h-full flex flex-col justify-between">
                        <div class="flex justify-between items-start">
                            {{-- Chip Emas --}}
                            <div
                                class="w-11 h-8 bg-linear-to-br from-[#d4af37] via-[#f9e498] to-[#aa8a2e] rounded-md shadow-lg flex flex-col justify-around p-1">
                                <div class="h-[0.5px] w-full bg-black/20"></div>
                                <div class="h-[0.5px] w-full bg-black/20"></div>
                                <div class="h-[0.5px] w-full bg-black/20"></div>
                            </div>
                            <div class="text-right">
                                <p class="font-poppins font-bold text-lg italic opacity-90 tracking-tighter uppercase">
                                    {{ $gift['bank_name'] ?? 'Bank' }}
                                </p>
                            </div>
                        </div>

                        <div class="space-y-1">
                            <p class="font-poppins text-[9px] tracking-[0.4em] uppercase opacity-40">Account Number</p>
                            <div class="flex items-center gap-3">
                                <h4 class="text-xl md:text-2xl font-mono tracking-[0.2em] font-medium">
                                    {{ $gift['account_number'] ?? '0000000000' }}
                                </h4>

                                {{-- Tombol Copy Dinamis --}}
                                <button
                                    @click="navigator.clipboard.writeText('{{ $gift['account_number'] }}'); copied = true; setTimeout(() => copied = false, 2000)"
                                    class="bg-white/10 hover:bg-[#d4af37]/20 p-2 rounded-full transition-all group-hover:scale-110 active:scale-90">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#d4af37]"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                    </svg>
                                </button>
                            </div>

                            {{-- Notifikasi Copied --}}
                            <div x-show="copied" x-cloak x-transition
                                class="absolute bg-[#d4af37] text-white text-[9px] font-bold py-1 px-3 rounded shadow-lg -mt-12 transition-all">
                                Tersalin!
                            </div>
                        </div>

                        <div class="flex justify-between items-end border-t border-white/10 pt-4">
                            <div class="space-y-0.5">
                                <p class="font-poppins text-[7px] tracking-[0.3em] uppercase opacity-40">Account Name
                                </p>
                                <p class="font-abigail text-lg text-[#d4af37] tracking-wider italic">
                                    {{ $gift['account_name'] ?? '' }}
                                </p>
                            </div>
                            {{-- Logo Mastercard/Visa Style --}}
                            <div class="flex -space-x-3 opacity-60">
                                <div class="w-8 h-8 rounded-full bg-[#eb001b]"></div>
                                <div class="w-8 h-8 rounded-full bg-[#ffab00]"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-20 flex flex-col items-center opacity-10">
        <div class="w-px h-16 bg-linear-to-b from-[#5a3a2e] to-transparent"></div>
    </div>
</section>

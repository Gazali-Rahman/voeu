<?php

use Livewire\Component;

new class extends Component {
    public $gifts = [];

    public function mount($invitation)
    {
        // Mengambil array gifts dari content
        // Kita simpan ke properti $gifts (jamak) agar lebih jelas
        $this->gifts = $invitation->content['gifts'] ?? [];
    }
};
?>

<div class="py-10 overflow-hidden">
    <div class="max-w-3xl mx-auto">

        <div x-data="{ show: false }" x-intersect="show = true" class="mb-20 relative px-2">
            <div x-show="show" x-transition:enter="transition ease-out duration-1000">
                <div class="flex flex-col px-2 relative">
                    <div class="relative">
                        <h2
                            class="font-utama text-black text-4xl leading-none lowercase italic tracking-tight mb-[-10px] ml-1">
                            wedding
                        </h2>
                        <h2
                            class="font-utama text-[#8C5A3C] text-7xl md:text-8xl leading-none uppercase tracking-tighter drop-shadow-sm">
                            Gift<span class="text-black italic lowercase text-4xl">s</span>
                        </h2>
                    </div>

                    <div class="flex items-center gap-3 mt-4 ml-1">
                        <div class="h-px w-12 bg-linear-to-r from-[#8C5A3C] to-transparent"></div>
                        <span class="w-1.5 h-1.5 rounded-full bg-[#8C5A3C]/40"></span>
                    </div>

                    <p
                        class="font-poppins text-[9px] tracking-[0.5em] uppercase text-gray-400 mt-8 ml-1 leading-relaxed border-l border-gray-100 pl-4">
                        Digital Envelope & <br>
                        <span class="text-[#8C5A3C]/60">Token of Appreciation</span>
                    </p>
                </div>
            </div>
        </div>

        <div class="space-y-8">
            @foreach ($gifts as $item)
                <div x-data="{ copied: false, show: false }" x-intersect="show = true"
                    class="relative group max-w-xl mx-auto transition-all duration-1000"
                    :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">

                    <div
                        class="relative aspect-[1.6/1] w-full bg-[#8C5A3C] rounded-4xl p-5 overflow-hidden border border-white/5 flex flex-col justify-between shadow-2xl">

                        <div class="absolute inset-0 opacity-10 pointer-events-none"
                            style="background-image: radial-gradient(circle at top left, rgba(255,255,255,0.2) 0%, transparent 70%);">
                        </div>
                        <div class="absolute -top-10 -right-10 opacity-10">
                            <svg width="200" height="200" viewBox="0 0 100 100" fill="none" class="text-white">
                                <circle cx="100" cy="0" r="80" stroke="currentColor" stroke-width="0.3" />
                                <circle cx="100" cy="0" r="60" stroke="currentColor" stroke-width="0.3" />
                            </svg>
                        </div>

                        <div class="relative z-10 flex justify-between items-start">
                            <div
                                class="w-12 h-9 bg-linear-to-br from-white/40 to-white/10 rounded-lg border border-white/10 p-2 overflow-hidden backdrop-blur-sm shadow-inner">
                                <div class="grid grid-cols-3 gap-1 h-full w-full opacity-40">
                                    <div class="border-b border-r border-white"></div>
                                    <div class="border-b border-r border-white"></div>
                                    <div class="border-b border-white"></div>
                                    <div class="border-r border-white"></div>
                                    <div class="border-r border-white"></div>
                                    <div></div>
                                </div>
                            </div>
                            <div class="text-right">
                                <h3 class="font-utama text-white text-2xl md:text-3xl tracking-widest uppercase">
                                    {{ $item['bank_name'] ?? 'Bank' }}
                                </h3>
                                <p class="font-poppins text-[7px] tracking-[0.3em] text-white/30 uppercase mt-1">Digital
                                    Member</p>
                            </div>
                        </div>

                        <div class="relative z-10">
                            <p
                                class="font-poppins text-[8px] md:text-[9px] tracking-[0.5em] text-white/40 uppercase mb-3 font-semibold">
                                Account Number
                            </p>
                            <h4 class="font-utama text-white text-xl tracking-[0.15em] drop-shadow-sm">
                                {{ $item['account_number'] ?? '0000 0000 00' }}
                            </h4>
                        </div>

                        <div class="relative z-10 flex justify-between items-end">
                            <div class="flex-1">
                                <p
                                    class="font-poppins text-[8px] md:text-[9px] tracking-[0.5em] text-white/40 uppercase mb-2 font-semibold">
                                    Account Holder
                                </p>
                                <p
                                    class="font-utama text-white text-xl md:text-2xl tracking-wide lowercase italic opacity-95">
                                    an. {{ $item['account_name'] ?? 'Name' }}
                                </p>
                            </div>

                            <button
                                @click="navigator.clipboard.writeText('{{ $item['account_number'] }}'); copied = true; setTimeout(() => copied = false, 2000)"
                                class="flex items-center gap-3 bg-white text-[#8C5A3C] hover:bg-black hover:text-white group/btn px-6 py-3 rounded-2xl transition-all duration-500 active:scale-95 shadow-xl font-bold">

                                <span x-show="!copied" class="transition-all duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                    </svg>
                                </span>
                                <span x-show="copied" x-cloak
                                    class="text-emerald-500 group-hover/btn:text-white transition-all duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                </span>
                                <span class="font-poppins text-[10px] tracking-widest uppercase"
                                    x-text="copied ? 'Copied' : 'Copy'"></span>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-16 text-center space-y-4 px-6">
            <p class="font-poppins text-[10px] text-gray-400 italic uppercase tracking-[0.3em] leading-relaxed">
                Terima kasih atas tanda kasih Anda <br> untuk perjalanan baru kami.
            </p>
            <div class="flex justify-center gap-2.5 opacity-20">
                <span class="w-1.5 h-1.5 rounded-full bg-[#8C5A3C]"></span>
                <span class="w-1.5 h-1.5 rounded-full bg-[#8C5A3C]"></span>
                <span class="w-1.5 h-1.5 rounded-full bg-[#8C5A3C]"></span>
            </div>
        </div>
    </div>
</div>

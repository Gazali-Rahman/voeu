<?php

use Livewire\Component;

new class extends Component {
    public $gift;

    public function mount($invitation)
    {
        $this->gift = $invitation->content['gifts'] ?? [];
    }
};
?>

<div class="bg-[#F5E9D8] py-24 px-4 overflow-hidden">
    <div class="max-w-3xl mx-auto">

        <div x-data="{ show: false }" x-intersect="show = true" class="text-center mb-16">
            <span class="font-poppins text-[10px] tracking-[0.8em] text-red-950/60 uppercase block mb-4">Wedding
                Gift</span>
            <h2 class="font-utama text-red-950 text-4xl">Digital Envelope</h2>
        </div>

        <div class="space-y-10">
            @foreach ($gift as $index => $item)
                <div x-data="{ copied: false, show: false }" x-intersect="show = true"
                    class="relative group max-w-xl mx-auto transition-all duration-1000"
                    :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'"
                    style="transition-delay: {{ $index * 200 }}ms">

                    <div
                        class="absolute inset-0 bg-red-950/25 rounded-4xl blur-3xl scale-90 group-hover:scale-100 transition-transform duration-700">
                    </div>

                    <div
                        class="relative aspect-[1.6/1] w-full bg-red-950 rounded-4xl p-8 md:p-10 overflow-hidden border border-red-900 shadow-2xl flex flex-col justify-between">

                        <div class="absolute inset-0 opacity-20 pointer-events-none"
                            style="background-image: linear-gradient(135deg, rgba(245,233,216,0.2) 0%, transparent 50%, rgba(245,233,216,0.1) 100%);">
                        </div>

                        <div class="absolute -top-10 -right-10 opacity-10">
                            <svg width="200" height="200" viewBox="0 0 100 100" fill="none"
                                class="text-[#F5E9D8]">
                                <circle cx="100" cy="0" r="80" stroke="currentColor" stroke-width="0.5" />
                                <circle cx="100" cy="0" r="60" stroke="currentColor" stroke-width="0.5" />
                            </svg>
                        </div>

                        <div class="relative z-10 flex justify-between items-start">
                            <div
                                class="w-12 h-9 bg-linear-to-br from-[#F5E9D8]/40 to-[#F5E9D8]/10 rounded-md border border-[#F5E9D8]/30 flex items-center justify-center">
                                <div class="grid grid-cols-2 gap-1 w-full h-full opacity-30 p-1.5">
                                    <div class="border-b border-r border-[#F5E9D8]"></div>
                                    <div class="border-b border-[#F5E9D8]"></div>
                                    <div class="border-r border-[#F5E9D8]"></div>
                                    <div></div>
                                </div>
                            </div>

                            <div class="flex flex-col items-end">
                                <h1 class="font-abigail text-white text-lg">{{ $item['bank_name'] ?? '' }}</h1>
                            </div>
                        </div>

                        <div class="relative z-10 my-4">
                            <p
                                class="font-poppins text-[8px] md:text-[10px] tracking-[0.4em] text-white/50 uppercase mb-2">
                                Account Number</p>
                            <h4 class="font-utama text-[#F5E9D8] text-2xl md:text-4xl tracking-[0.2em] drop-shadow-md">
                                {{ $item['account_number'] ?? '0000 0000 00' }}
                            </h4>
                        </div>

                        <div class="relative z-10 flex justify-between items-end">
                            <div class="flex-1">
                                <p
                                    class="font-poppins text-[8px] md:text-[10px] tracking-[0.4em] text-white/50 uppercase mb-1">
                                    Account Holder</p>
                                <p class="font-utama text-[#F5E9D8]  text-lg ">
                                    a.n {{ $item['account_name'] ?? '-' }}
                                </p>
                            </div>

                            <button
                                @click="navigator.clipboard.writeText('{{ $item['account_number'] }}'); copied = true; setTimeout(() => copied = false, 2000)"
                                class="flex items-center gap-2 bg-[#F5E9D8] px-4 py-2 md:px-6 md:py-2.5 rounded-xl transition-all active:scale-95 shadow-lg group/btn hover:bg-white">

                                <svg x-show="!copied" xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-red-950"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" />
                                </svg>
                                <svg x-show="copied" xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-emerald-600"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>

                                <span
                                    class="font-poppins text-[9px] md:text-[10px] tracking-widest uppercase text-red-950 font-bold"
                                    x-text="copied ? 'Copied' : 'Copy'">
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <p
            class="mt-16 text-center font-poppins text-[10px] text-red-950/40 italic uppercase tracking-widest leading-relaxed">
            Terima kasih atas tanda kasih Anda <br> untuk perjalanan baru kami.
        </p>
    </div>
</div>

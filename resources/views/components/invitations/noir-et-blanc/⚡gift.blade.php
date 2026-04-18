<?php
use Livewire\Component;

new class extends Component {
    public $invitation;
    public $gifts = [];

    public function mount($invitation)
    {
        $this->invitation = $invitation;
        // Ambil data gifts dari kolom content (JSON)
        $this->gifts = $invitation->content['gifts'] ?? [];
    }
};
?>

<!-- Section: Wedding Gift (Digital Envelope) -->
<div class="py-24 bg-white overflow-hidden">
    <div class="max-w-3xl mx-auto px-6">

        <div x-data="{ visible: false }" x-intersect.once="visible = true" class="mb-16 relative">
            <div class="flex flex-col relative transition-all duration-1000 transform"
                :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">
                <h2 class="font-vogue text-black text-3xl leading-none lowercase italic tracking-tight mb-[-8px]">
                    wedding
                </h2>
                <h2 class="font-vogue text-black text-7xl md:text-8xl leading-none uppercase tracking-tighter">
                    Gifts<span class="text-gray-300 italic lowercase text-4xl">s</span>
                </h2>
                <div class="flex items-center gap-3 mt-6">
                    <div class="h-px w-12 bg-black transition-all duration-1000 delay-500"
                        :class="visible ? 'w-12 opacity-100' : 'w-0 opacity-0'"></div>
                    <span
                        class="w-1.5 h-1.5 rounded-full border border-black transition-opacity duration-1000 delay-700"
                        :class="visible ? 'opacity-100' : 'opacity-0'"></span>
                </div>
            </div>
        </div>

        <div class="space-y-10">
            @foreach ($gifts as $index => $gift)
                <div x-data="{ copied: false, visible: false }" x-intersect.once.margin.-10%="visible = true"
                    wire:key="gift-{{ $index }}"
                    class="relative group max-w-xl mx-auto transition-all duration-[1.2s] transform"
                    :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-20'">

                    <div
                        class="relative aspect-[1.6/1] w-full bg-[#111111] rounded-[2.5rem] p-8 md:p-12 overflow-hidden shadow-2xl flex flex-col justify-between border border-white/5">

                        <div class="absolute inset-0 opacity-20 pointer-events-none"
                            style="background-image: url('https://www.transparenttextures.com/patterns/carbon-fibre.png');">
                        </div>

                        <div class="relative z-10 flex justify-between items-start">
                            <div
                                class="w-12 h-9 bg-linear-to-br from-gray-400 to-gray-600 rounded-md border border-white/10 p-2 opacity-50 shadow-inner">
                                <div class="grid grid-cols-3 gap-1 h-full w-full border-white/20">
                                    <div class="border-b border-r border-white/30"></div>
                                    <div class="border-b border-r border-white/30"></div>
                                    <div class="border-b border-white/30"></div>
                                    <div class="border-r border-white/30"></div>
                                    <div class="border-r border-white/30"></div>
                                </div>
                            </div>

                            <div class="text-right">
                                <h5 class="font-vogue text-white text-lg tracking-widest uppercase">
                                    {{ $gift['bank_name'] }}</h5>
                                <p class="font-serif italic text-[7px] tracking-[0.3em] text-white/30 uppercase mt-1">
                                    International Member</p>
                            </div>
                        </div>

                        <div class="relative z-10">
                            <p class="font-vogue text-[9px] tracking-[0.5em] text-white/30 uppercase mb-4">Account
                                Number</p>
                            <h4 class="font-vogue text-white text-xl  tracking-widest">
                                {{ $gift['account_number'] }}
                            </h4>
                        </div>

                        <div class="relative z-10 flex justify-between items-end">
                            <div class="flex-1">
                                <p class="font-vogue text-[9px] tracking-[0.5em] text-white/30 uppercase mb-2">Account
                                    Holder</p>
                                <p class="font-vogue text-white text-base tracking-widest uppercase opacity-90">
                                    {{ $gift['account_name'] }}
                                </p>
                            </div>

                            <button
                                @click="navigator.clipboard.writeText('{{ $gift['account_number'] }}'); copied = true; setTimeout(() => copied = false, 2000)"
                                class="flex items-center gap-3 bg-white text-black hover:bg-gray-200 px-6 py-3 rounded-full transition-all duration-500 active:scale-95 shadow-xl">

                                <span class="font-vogue text-[10px] tracking-[0.3em] uppercase mr-[-0.3em]"
                                    x-text="copied ? 'Copied' : 'Copy'">
                                </span>

                                <span x-show="!copied">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                    </svg>
                                </span>
                                <span x-show="copied" class="text-emerald-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-16 text-center space-y-4 px-6">
            <p class="font-serif italic text-[10px] text-gray-400 uppercase tracking-[0.3em] leading-relaxed">
                Terima kasih atas doa & tanda kasih Anda <br> untuk babak baru kehidupan kami.
            </p>
        </div>
    </div>
</div>

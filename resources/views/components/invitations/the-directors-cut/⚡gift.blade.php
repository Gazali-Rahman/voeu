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
<section class=" py-24 px-6 relative overflow-hidden">

    <div class="relative mb-16 text-center">
        <h2 class="font-abigail text-5xl text-black/80 mb-3">Wedding Gift</h2>
        <div class="flex justify-center items-center gap-3">
            <div class="h-px w-8 bg-black/20"></div>
            <p class="font-mono text-[9px] tracking-[0.4em] uppercase text-black/40">Digital Envelope</p>
            <div class="h-px w-8 bg-black/20"></div>
        </div>
        <p class="mt-8 text-[12px] text-black/50 leading-relaxed max-w-[240px] mx-auto font-light">
            Your presence is enough, but if you wish to give a gift, we provide a digital envelope below.
        </p>
    </div>

    <div class="space-y-6 relative z-10">
        @foreach ($gifts as $index => $gift)
            <div x-data="{
                copied: false,
                number: '{{ $gift['account_number'] ?? '' }}',
                copy() {
                    navigator.clipboard.writeText(this.number);
                    this.copied = true;
                    setTimeout(() => this.copied = false, 2000);
                }
            }" class="bg-white/40 border border-black/5 p-8 shadow-sm group">

                <div class="flex justify-between items-start mb-6">
                    <div class="flex flex-col">
                        <span
                            class="font-mono text-[10px] uppercase tracking-[0.3em] text-black/30 mb-1">Provider</span>
                        <h4 class="font-abigail text-2xl text-black/80">{{ $gift['bank_name'] ?? 'Bank Transfer' }}</h4>
                    </div>

                    <div class="w-8 h-8 opacity-20 group-hover:opacity-40 transition-opacity">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                            <rect x="3" y="5" width="18" height="14" rx="2" />
                            <line x1="3" y1="10" x2="21" y2="10" />
                        </svg>
                    </div>
                </div>

                <div class="space-y-1 mb-8">
                    <span class="font-mono text-[9px] uppercase tracking-widest text-black/30">Account Number</span>
                    <p class="text-xl font-mono tracking-tighter text-black/80">{{ $gift['account_number'] ?? '-' }}</p>
                    <p class="font-mono text-[10px] uppercase text-black/50 mt-2 tracking-wider">
                        a.n {{ $gift['account_name'] ?? 'Recipient Name' }}
                    </p>
                </div>

                <button @click="copy()"
                    class="w-full border border-black/10 py-3 flex items-center justify-center gap-3 group transition-all duration-500 hover:bg-black hover:text-white">
                    <span x-show="!copied" class="font-mono text-[9px] uppercase tracking-[0.3em]">Copy Number</span>
                    <span x-show="copied" x-cloak
                        class="font-mono text-[9px] uppercase tracking-[0.3em] animate-pulse">Copied!</span>

                    <svg x-show="!copied" class="w-3 h-3 opacity-30 group-hover:opacity-100 group-hover:invert"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2">
                        </path>
                    </svg>
                </button>
            </div>
        @endforeach
    </div>

</section>

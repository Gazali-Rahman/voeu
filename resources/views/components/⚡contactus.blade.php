<?php

use Livewire\Component;

new class extends Component {
    public function with(): array
    {
        return [
            'contacts' => [['label' => 'WhatsApp', 'value' => '0858 4987 1150', 'url' => 'https://wa.me/6285849871150'], ['label' => 'Instagram', 'value' => '@voeu.digitalinvitation', 'url' => 'https://instagram.com/voeu.digitalinvitation']],
        ];
    }
};
?>

<div class="min-h-screen bg-[#F9F8F6] font-sans selection:bg-neutral-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-10 py-24">

        <div class="space-y-6 mb-20 md:mb-32">
            <h1 class="text-4xl md:text-5xl  font-utama tracking-[-0.04em] uppercase text-[#1a1a1a] leading-none">
                Get In Touch
            </h1>
            <div class="flex items-center gap-4">
                <p
                    class="text-[10px] md:text-xs uppercase tracking-[0.6em] text-neutral-400 font-medium whitespace-nowrap">
                    Let's start your story
                </p>
                <span class="h-px w-12 md:w-24 bg-neutral-300"></span>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-16 md:gap-24">

            <div class="max-w-md">
                <p class="text-base  text-neutral-500 leading-relaxed font-light ">
                    "bingung atau ada kendala? silahkan hubungi kami dari kontak yang tersedia"
                </p>
            </div>

            <div class="space-y-12">
                @foreach ($contacts as $contact)
                    <div class="group">
                        <h4 class="text-[10px] uppercase tracking-[0.5em] text-neutral-400 mb-2">{{ $contact['label'] }}
                        </h4>
                        <a href="{{ $contact['url'] }}" target="_blank"
                            class="inline-flex items-center gap-2 text-xl md:text-2xl font-light text-[#1a1a1a] hover:text-neutral-500 transition-all duration-500">
                            {{ $contact['value'] }}
                            <svg class="w-6 h-6 md:w-8 md:h-8 transform -rotate-45 opacity-0 group-hover:opacity-100 group-hover:translate-x-2 transition-all duration-500"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

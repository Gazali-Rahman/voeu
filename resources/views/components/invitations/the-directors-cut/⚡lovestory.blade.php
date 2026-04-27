<?php

use Livewire\Component;

new class extends Component {
    public $invitation;
    public $stories = [];

    public function mount($invitation)
    {
        $this->invitation = $invitation;
        $this->stories = $this->invitation->content['love_stories'] ?? [];
    }
};
?>

<div>
    @if (count($stories) > 0)
        <section class="py-24 px-6 relative overflow-hidden">
            <div class="relative mb-20">
                <h2 class="font-abigail text-5xl text-black/80 mb-3 tracking-wide">Love Story</h2>
                <div class="flex items-center gap-3">
                    <div class="h-px w-10 bg-black/30"></div>
                    <p class="font-mono text-[9px] tracking-[0.4em] uppercase text-black/40">The Chronicles</p>
                </div>
            </div>

            <div class="relative border-l border-black/10 ml-2 pl-8 space-y-20">
                @foreach ($stories as $index => $story)
                    <div class="relative group" wire:key="story-{{ $index }}">

                        <div class="absolute -left-[36.5px] top-1 w-4 h-4 bg-[#EAE8E3] flex items-center justify-center">
                            <div
                                class="w-2 h-2 bg-black/10 rounded-full group-hover:bg-black transition-all duration-500">
                            </div>
                        </div>

                        <div class="mb-5">
                            <span
                                class="font-mono text-[10px] tracking-[0.4em] text-white bg-black px-4 py-1.5 rounded-sm uppercase inline-block shadow-sm">
                                {{ $story['year'] ?? '0000' }}
                            </span>
                        </div>

                        <div class="space-y-4">
                            <h3 class="font-abigail text-3xl text-black/80 leading-tight">
                                {{ $story['title'] ?? 'The Beginning' }}
                            </h3>

                            <div class="relative">
                                <div class="absolute -left-4 top-0 h-full w-px bg-black/5"></div>

                                <p
                                    class="text-[13px] text-black/60 leading-relaxed font-normal text-justify tracking-tight">
                                    {{ $story['story'] ?? '' }}
                                </p>
                            </div>
                        </div>

                        <div
                            class="absolute -right-2 -top-4 font-mono text-[50px] text-black/3 font-bold select-none pointer-events-none">
                            {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-28 flex flex-col items-center">
                <div class="h-16 w-px bg-black/10 mb-6"></div>
                <p class="font-mono text-[8px] tracking-[0.8em] uppercase text-black/20">Archive Closed</p>
            </div>

        </section>
    @endif
</div>

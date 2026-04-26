<?php

use Livewire\Component;

new class extends Component {
    public $invitation;
    public $photos = [];
    public $perPage = 6; // Kita naikkan ke 6 agar pas dengan grid 3 kolom
    public $currentPage = 0;

    public function mount($invitation)
    {
        $this->invitation = $invitation;
        $rawData = $this->invitation->content['dynamic_photos'] ?? ($this->invitation->dynamic_photos ?? []);

        $this->photos = collect($rawData)
            ->filter(function ($photo) {
                return isset($photo['label']) && str_contains(strtolower($photo['label']), 'gallery');
            })
            ->map(function ($photo) {
                $path = is_array($photo) ? $photo['path'] ?? '' : $photo;
                return asset('storage/' . $path);
            })
            ->values()
            ->toArray();
    }

    public function setPage($page)
    {
        $this->currentPage = $page;
    }

    public function getCurrentPhotosProperty()
    {
        return array_slice($this->photos, $this->currentPage * $this->perPage, $this->perPage);
    }
};
?>

<div x-data="{ open: false, activeImg: '' }">
    @if (count($photos) > 0)
        <section class="max-w-md mx-auto bg-[#EAE8E3] relative py-20 px-4 min-h-screen">

            <div class="mb-12 flex justify-between items-end border-b border-black/10 pb-6 px-2">
                <div class="flex flex-col">
                    <div class="font-mono text-[9px] tracking-[0.4em] uppercase text-black/30 mb-1">Visual Archive</div>
                    <h1 class="font-abigail text-4xl text-black/80">Our Gallery</h1>
                </div>
                <div class="text-right font-mono text-black/40">
                    <span class="text-[9px] font-bold uppercase">{{ count($photos) }} PCS</span>
                </div>
            </div>

            <div class="grid grid-cols-3 grid-rows-2 gap-3 relative z-10" wire:key="gallery-page-{{ $currentPage }}">
                @foreach ($this->currentPhotos as $index => $photoUrl)
                    @php
                        $itemClass = '';
                        if ($index == 0) {
                            $itemClass = 'col-span-2 row-span-2';
                        } else {
                            $itemClass = 'col-span-1';
                        }
                    @endphp

                    <div class="{{ $itemClass }} relative group cursor-pointer"
                        @click="activeImg = '{{ $photoUrl }}'; open = true">

                        <div
                            class="absolute top-2 left-2 z-20 font-mono text-[9px] font-bold text-white bg-black/40 px-1.5 py-0.5 rounded-sm backdrop-blur-sm shadow-sm">
                            {{ str_pad($currentPage * $perPage + $index + 1, 2, '0', STR_PAD_LEFT) }}
                        </div>

                        <div class="bg-neutral-300 shadow-sm overflow-hidden {{ $index == 0 ? 'h-full' : '' }}">
                            <img src="{{ $photoUrl }}"
                                class="w-full {{ $index == 0 ? 'h-full object-cover' : 'h-auto' }} grayscale-[0.2] group-hover:grayscale-0 transition-all duration-500 block"
                                alt="Gallery">
                        </div>
                    </div>
                @endforeach
            </div>

            @php $totalPages = ceil(count($photos) / $perPage); @endphp
            @if ($totalPages > 1)
                <div class="mt-10 flex flex-col items-center">
                    <div class="flex items-center gap-2">
                        @for ($i = 0; $i < $totalPages; $i++)
                            <button wire:click="setPage({{ $i }})"
                                class="w-10 h-10 flex items-center justify-center group focus:outline-none"
                                aria-label="Page {{ $i + 1 }}">

                                <div
                                    class="transition-all duration-300 rounded-full {{ $currentPage == $i ? 'w-3 h-3 bg-black' : 'w-2 h-2 bg-black/20 group-hover:bg-black/40' }}">
                                </div>

                                @if ($currentPage == $i)
                                    <div class="absolute w-6 h-6 border border-black/10 rounded-full animate-pulse">
                                    </div>
                                @endif
                            </button>
                        @endfor
                    </div>

                    <div class="mt-4 font-mono text-[8px] tracking-[0.4em] text-black/30 uppercase text-center">
                        Section {{ $currentPage + 1 }} OF {{ $totalPages }}
                    </div>
                </div>
            @endif

        </section>
    @endif

    <template x-teleport="body">
        <div x-show="open" x-transition.opacity.duration.300ms
            class="fixed inset-0 z-[999] flex items-center justify-center bg-[#EAE8E3]/95 p-4 backdrop-blur-md"
            @click="open = false">
            <div class="relative w-full h-full flex flex-col items-center justify-center">
                <img :src="activeImg" class="max-w-full max-h-[80vh] object-contain shadow-2xl">
                <button
                    class="mt-12 font-mono text-[10px] tracking-widest uppercase text-black/50 border-b border-black/20 pb-2">
                    [ Close Archive ]
                </button>
            </div>
        </div>
    </template>
</div>

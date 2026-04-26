<?php

use Livewire\Component;

new class extends Component {
    public $invitation;
    public $photos = [];
    public $perPage = 5; // Maksimal 5 foto per halaman
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

<div>
    @if (count($photos) > 0)
        <section class="max-w-md mx-auto bg-[#EAE8E3] relative py-20 px-4">

            <div class="mb-16 flex justify-between items-end px-4 border-b border-black/10 pb-6">
                <div class="flex flex-col">
                    <div class="font-mono text-[9px] tracking-[0.4em] uppercase text-black/30 mb-1">Visual Archive</div>
                    <h1 class="font-abigail text-4xl text-black/80">Our Gallery</h1>
                </div>
                <div class="text-right font-mono">
                    <span class="text-[10px] text-black/60 font-bold uppercase">{{ count($photos) }} Photos</span>
                </div>
            </div>

            <div class="grid grid-cols-12 gap-4 items-start relative z-10" wire:key="gallery-page-{{ $currentPage }}">
                @foreach ($this->currentPhotos as $index => $photoUrl)
                    @php
                        // Logika penentuan lebar kolom (Pattern 1-5)
                        $classes = [
                            0 => 'col-span-4', // Foto 1: Full
                            1 => 'col-span-4', // Foto 2: Lebar Kiri
                            2 => 'col-span-4', // Foto 3: Kecil Kanan
                            3 => 'col-span-5', // Foto 4: Kecil Kiri
                            4 => 'col-span-7', // Foto 5: Lebar Kanan
                        ];
                        $colClass = $classes[$index] ?? 'col-span-6';
                    @endphp

                    <div class="{{ $colClass }} relative group">
                        <div
                            class="absolute -top-3 left-1 font-mono text-[7px] text-black/30 uppercase tracking-tighter">
                            F_{{ str_pad($currentPage * $perPage + $index + 1, 2, '0', STR_PAD_LEFT) }}
                        </div>

                        <div class="bg-neutral-300 shadow-sm overflow-hidden">
                            <img src="{{ $photoUrl }}"
                                class="w-full h-auto grayscale-[0.2] hover:grayscale-0 transition-all duration-700 block"
                                alt="Gallery">
                        </div>
                    </div>
                @endforeach
            </div>

            @php $totalPages = ceil(count($photos) / $perPage); @endphp

            @if ($totalPages > 1)
                <div class="mt-20 flex flex-col items-center">
                    <div class="flex gap-4 items-center">
                        @for ($i = 0; $i < $totalPages; $i++)
                            <button wire:click="setPage({{ $i }})" class="group relative p-2">
                                <div
                                    class="w-1.5 h-1.5 rounded-full transition-all duration-300 {{ $currentPage == $i ? 'bg-black scale-150' : 'bg-black/20 group-hover:bg-black/40' }}">
                                </div>
                                @if ($currentPage == $i)
                                    <div class="absolute inset-0 border border-black/20 rounded-full animate-ping">
                                    </div>
                                @endif
                            </button>
                        @endfor
                    </div>
                    <p class="font-mono text-[7px] tracking-[0.5em] text-black/30 uppercase mt-4">Page
                        {{ $currentPage + 1 }} // {{ $totalPages }}</p>
                </div>
            @endif

        </section>
    @endif
</div>

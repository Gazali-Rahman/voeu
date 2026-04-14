<?php

use Livewire\Component;
use App\Models\Catalog;

new class extends Component {
    public function with(): array
    {
        return [
            'catalogs' => Catalog::where('is_active', true)->latest()->get(),
        ];
    }
    // Fungsi baru untuk mencatat view
    public function incrementView($id)
    {
        $catalog = Catalog::find($id);
        if ($catalog) {
            $catalog->increment('views_count');
        }
    }
    public function buy($id)
    {
        // Cek apakah produk ada
        $product = Catalog::findOrFail($id);

        // Redirect ke route checkout dengan parameter id
        return redirect()->route('checkout', ['id' => $id]);
    }
};
?>

<div id="catalog" class="min-h-screen bg-[#F9F8F6] font-sans" x-data="{ open: false, videoId: '' }">

    <div x-show="open" class="fixed inset-0 z-50 flex items-center justify-center bg-black/90 backdrop-blur-md p-4"
        x-transition.opacity @click="open = false; videoId = ''" x-cloak>

        <div class="relative w-full max-w-[320px] shadow-2xl" @click.stop>

            <button @click="open = false; videoId = ''"
                class="absolute -top-10 right-0 text-white text-[10px] uppercase tracking-[0.4em] opacity-70 hover:opacity-100 transition-opacity">
                ✕ Close
            </button>

            <div
                class="relative w-full aspect-9/16 bg-black rounded-2xl overflow-hidden border border-white/10 shadow-2xl">
                <template x-if="open">
                    <iframe class="absolute inset-0 w-full h-full"
                        :src="'https://www.youtube.com/embed/' + videoId + '?autoplay=1&modestbranding=1&rel=0&playsinline=1'"
                        frameborder="0" allow="autoplay; encrypted-media; picture-in-picture" allowfullscreen>
                    </iframe>
                </template>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-10 py-20">

        <div class="mb-16">
            <h1 class="text-5xl md:text-7xl font-utama tracking-[-0.02em] uppercase text-[#1a1a1a] leading-[0.9]">
                Catalog
            </h1>
            <p class="mt-4 text-[10px] md:text-xs uppercase tracking-[0.6em] text-gray-500 font-medium">
                Explore our curated collection of digital invitations
            </p>
        </div>

        <div class="grid grid-cols-2 lg:grid-cols-3 gap-x-4  md:gap-x-8 gap-y-16">
            @foreach ($catalogs as $item)
                <div class="group">
                    <div class="relative overflow-hidden rounded-lg mb-6 bg-white border border-neutral-100 cursor-pointer"
                        @click="open = true; videoId = '{{ $item->preview_url }}'; $wire.incrementView({{ $item->id }})">

                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}"
                            class="w-full aspect-square object-cover transition-transform duration-700 group-hover:scale-105">

                        <div
                            class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-center justify-center">
                            <div class="flex flex-col items-center gap-3">
                                <svg class="w-12 h-12 text-white/80" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8 5v14l11-7z" />
                                </svg>
                                <span
                                    class="text-white text-[9px] uppercase tracking-[0.5em] border border-white/50 bg-black/20 backdrop-blur-sm px-4 md:px-6 py-2">
                                    Watch Preview
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="text-center space-y-4">
                        <div>
                            <h3 class="text-[11px] uppercase tracking-[0.4em] text-[#1a1a1a] font-medium">
                                {{ $item->name }}
                            </h3>
                            <p class="text-[9px] uppercase tracking-[0.3em] text-gray-400 mt-1">
                                Rp {{ number_format($item->price, 0, ',', '.') }}
                            </p>
                        </div>

                        <div class="pt-2">
                            <button wire:click="buy({{ $item->id }})" wire:loading.attr="disabled"
                                class="w-full text-[10px] uppercase tracking-[0.3em] text-white bg-[#1a1a1a] py-4 transition-all duration-500 hover:tracking-[0.5em] active:scale-[0.98] disabled:opacity-50 disabled:cursor-not-allowed">

                                <span wire:loading.remove wire:target="buy({{ $item->id }})">Buy Now</span>
                                <span wire:loading wire:target="buy({{ $item->id }})">Processing...</span>

                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</div>

<style>
    [x-cloak] {
        display: none !important;
    }
</style>

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
    public function buy($slug)
    {
        // Cek apakah produk ada
        // $product = Catalog::findOrFail($id);
        $product = Catalog::where('slug', $slug)->firstOrFail();
        // Redirect ke route checkout dengan parameter id
        return redirect()->route('checkout', ['slug' => $product->slug]);
    }
};
?>

<div id="catalog" class="min-h-screen bg-[#F9F8F6] font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-10 py-20">
        <div class="mb-16">
            <h1 class="text-5xl md:text-7xl font-utama tracking-[-0.02em] uppercase text-[#1a1a1a] leading-[0.9]">
                Catalog
            </h1>
            <p class="mt-4 text-[10px] md:text-xs uppercase tracking-[0.6em] text-gray-500 font-medium">
                Explore our curated collection of digital invitations
            </p>
        </div>

        <div class="grid grid-cols-2 lg:grid-cols-3 gap-x-4 md:gap-x-8 gap-y-16">
            @foreach ($catalogs as $item)
                <div class="group">
                    <div class="relative overflow-hidden rounded-lg mb-6 bg-white border border-neutral-100">
                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}"
                            class="w-full aspect-square object-cover transition-transform duration-700 group-hover:scale-105">
                    </div>

                    <div class="text-center space-y-4">
                        <div>
                            <h3 class="text-[10px] uppercase tracking-[0.4em] text-[#1a1a1a] font-medium">
                                {{ $item->name }}
                            </h3>
                            <p class="text-[9px] uppercase tracking-[0.3em] text-gray-400 mt-1">
                                Rp {{ number_format($item->price, 0, ',', '.') }}
                            </p>
                        </div>

                        <div class="pt-2 space-y-2">
                            <button wire:click="buy('{{ $item->slug }}')" wire:loading.attr="disabled"
                                class="w-full text-[10px] uppercase tracking-[0.3em] text-white bg-[#1a1a1a] py-4 transition-all duration-500 hover:tracking-[0.5em] active:scale-[0.98] disabled:opacity-50">
                                <span wire:loading.remove wire:target="buy('{{ $item->slug }}')">Buy Now</span>
                                <span wire:loading wire:target="buy('{{ $item->slug }}')">Processing...</span>
                            </button>

                            <a href="{{ route('invitation.v', 'demo-' . $item->slug) }}" target="_blank"
                                wire:click="incrementView({{ $item->id }})"
                                class="block w-full text-center text-[10px] uppercase tracking-[0.3em] text-[#1a1a1a] border border-[#1a1a1a]/10 py-4 transition-all duration-500 hover:bg-[#1a1a1a] hover:text-white hover:tracking-[0.5em]">
                                Live Demo
                            </a>
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

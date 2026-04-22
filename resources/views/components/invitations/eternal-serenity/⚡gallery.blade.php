<?php
use Livewire\Component;

new class extends Component {
    public $gallery;

    public function mount($invitation)
    {
        $photos = $invitation->content['dynamic_photos'] ?? [];
        $this->gallery = collect($photos)
            ->filter(function ($item) {
                // Cek apakah kata 'gallery' ada di dalam label
                return isset($item['label']) && str_contains($item['label'], 'gallery');
            })
            ->values() // Reset index supaya rapi (0, 1, 2...)
            ->all();
    }
};
?>

<div x-data="{ open: false, activeImg: '' }" class="bg-[#F5E9D8] py-10 px-4 overflow-hidden">
    <!-- Header Section -->
    <div x-data="{ show: false }" x-intersect="show = true" class="text-center mb-20">
        <span class="font-poppins text-[10px] tracking-[0.8em] text-stone-400 uppercase block mb-4">
            A Glimpse of Our Love
        </span>
        <h2 x-show="show" x-transition:enter="transition ease-out duration-1000"
            x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0"
            class="font-utama text-red-950 text-6xl md:text-7xl">
            Our Gallery
        </h2>
        <div class="w-12 h-px bg-stone-300 mx-auto mt-8"></div>
    </div>

    <!-- Gallery Grid -->
    <div class="max-w-5xl mx-auto">
        <div class="grid grid-cols-12 gap-4 auto-rows-[80px] md:auto-rows-[100px]">
            @foreach ($gallery as $index => $img)
                @php
                    // Mengatur layout secara dinamis karena di array tidak ada data 'cols'/'rows'
                    // Contoh: Gambar pertama besar, sisanya kecil, atau variasi lainnya
                    $cols = $index % 5 == 0 ? 'col-span-8' : 'col-span-4';
                    $rows = $index % 5 == 0 ? 'row-span-4' : 'row-span-2';

                    // Pastikan path gambar benar, gunakan asset() jika file ada di public/storage
                    $imagePath = asset('storage/' . $img['path']);
                @endphp

                <div x-data="{ show: false }" x-intersect="show = true"
                    @click="open = true; activeImg = '{{ $imagePath }}'"
                    class="{{ $cols }} {{ $rows }} group relative cursor-pointer overflow-hidden rounded-2xl shadow-sm transition-all duration-1500"
                    :style="'transition-delay: ' + ({{ $index }} * 150) + 'ms'"
                    :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-16'">

                    <div
                        class="absolute inset-0 bg-stone-900/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500 z-10">
                    </div>

                    <img src="{{ $imagePath }}"
                        class="w-full h-full object-cover transform scale-105 group-hover:scale-110 transition duration-2000 ease-out"
                        alt="Wedding Moments">
                </div>
            @endforeach
        </div>
    </div>

    <!-- Wedding Quotes Section -->
    <div x-data="{ show: false }" x-intersect="show = true" class="mt-10 mb-20 text-center px-4">
        <div x-show="show" x-transition:enter="transition cubic-bezier(0.4, 0, 0.2, 1) duration-[2000ms]"
            x-transition:enter-start="opacity-0 translate-y-10" x-transition:enter-end="opacity-100 translate-y-0"
            class="max-w-2xl mx-auto space-y-6">

            <!-- Icon Dekoratif Bunga/Dedaunan (Opsional) -->
            <div class="flex justify-center mb-6 text-stone-300">
                <img src="{{ asset('assets/png/eternalserenity/redflower.png') }}" alt=""
                    class="w-16 h-auto grayscale opacity-40">
            </div>

            <p class="font-poppins text-stone-700 text-sm  leading-relaxed tracking-wide">
                "Aku ingin mencintaimu dengan sederhana; dengan kata yang tak sempat diucapkan kayu kepada api yang
                menjadikannya abu."
            </p>
        </div>
    </div>

    <!-- Simple Lightbox Modal -->
    <div x-show="open" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @keydown.escape.window="open = false"
        @click.self="open = false" class="fixed inset-0 z-999 flex items-center justify-center bg-stone-950/90 p-4"
        x-cloak>

        <button @click="open = false"
            class="absolute top-10 right-6 text-white hover:rotate-90 transition-transform duration-300 z-1000">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>

        <img :src="activeImg"
            class="w-full max-h-[90vh] max-w-md rounded-lg shadow-2xl object-contain relative z-1000">
    </div>
</div>

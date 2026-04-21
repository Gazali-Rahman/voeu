<div class="min-h-screen bg-[#F9F8F6] py-20 font-sans">
    <div class="max-w-4xl mx-auto px-4">
        <div class="mb-12">
            <h2 class="text-4xl font-utama uppercase tracking-tighter text-[#1a1a1a]">Checkout</h2>
            <p class="text-[10px] uppercase tracking-[0.4em] text-gray-500 mt-2">Personal & Wedding Details</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-16">
            {{-- Product Preview --}}
            {{-- Product Preview --}}
            <div class="space-y-6">
                <div class="aspect-square rounded-2xl overflow-hidden border border-neutral-200 shadow-sm">
                    <img src="{{ asset('storage/' . $catalog->image) }}" class="w-full h-full object-cover">
                </div>

                <div class="space-y-4" x-data="{ showDesc: false }">
                    <div class="flex justify-between items-end border-b border-neutral-100 pb-6">
                        <div>
                            <h3 class="text-xl font-medium uppercase tracking-widest text-[#1a1a1a]">
                                {{ $catalog->name }}</h3>
                            <p class="text-gray-400 mt-1 text-[10px] uppercase tracking-[0.3em]">Digital Invitation</p>
                        </div>
                        <p class="text-lg font-utama text-[#1a1a1a]">Rp
                            {{ number_format($catalog->price, 0, ',', '.') }}</p>
                    </div>

                    {{-- Dropdown Toggle Button --}}
                    <div class="border-b border-neutral-100 pb-4">
                        <button @click="showDesc = !showDesc" class="flex items-center justify-between w-full group">
                            <span
                                class="text-[10px] uppercase tracking-[0.2em] font-medium text-gray-500 group-hover:text-black transition-colors">
                                View Details & Features
                            </span>
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-4 w-4 text-gray-400 transition-transform duration-300"
                                :class="showDesc ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        {{-- Description Content --}}
                        <div x-show="showDesc" x-collapse x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform -translate-y-2"
                            x-transition:enter-end="opacity-100 transform translate-y-0" class="mt-4">

                            @php
                                // 1. Pecah teks dari database berdasarkan baris baru
                                $lines = explode("\n", $catalog->description);

                                $mainDescription = [];
                                $features = [];

                                foreach ($lines as $line) {
                                    $line = trim($line);
                                    if (empty($line)) {
                                        continue;
                                    }

                                    // 2. Cek apakah baris diawali tanda strip '-'
                                    if (str_starts_with($line, '-')) {
                                        // Simpan sebagai fitur (hapus tanda strip-nya)
                                        $features[] = ltrim($line, '- ');
                                    } else {
                                        // Simpan sebagai deskripsi biasa
                                        $mainDescription[] = $line;
                                    }
                                }
                            @endphp

                            {{-- Tampilkan Deskripsi Utama (Jika ada teks tanpa tanda strip) --}}
                            @if (!empty($mainDescription))
                                <div class="prose prose-sm max-w-none mb-4">
                                    <p
                                        class="text-[11px] leading-relaxed text-gray-600 font-light tracking-wide uppercase italic">
                                        {{ implode(' ', $mainDescription) }}
                                    </p>
                                </div>
                            @endif

                            {{-- Tampilkan List Fitur Otomatis (Jika ada teks dengan tanda strip) --}}
                            @if (!empty($features))
                                <ul class="space-y-2.5">
                                    @foreach ($features as $feature)
                                        <li
                                            class="flex items-start gap-3 text-[9px] text-gray-400 uppercase tracking-[0.2em]">
                                            {{-- Dot minimalis --}}
                                            <span class="w-1 h-1 bg-neutral-300 rounded-full mt-1 shrink-0"></span>
                                            <span class="leading-tight">{{ $feature }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Checkout Form --}}
            <form wire:submit.prevent="processCheckout" class="flex flex-col justify-center space-y-10">
                <div class="space-y-8">
                    {{-- Customer Info --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="relative">
                            <label class="block text-[10px] uppercase tracking-[0.3em] text-gray-400 mb-2">Nama
                                Pemesan</label>
                            <input type="text" wire:model="name" placeholder="John Doe"
                                class="w-full bg-transparent border-b border-neutral-300 py-3 focus:outline-none focus:border-black transition-colors text-sm">
                            @error('name')
                                <span class="text-red-500 text-[9px] uppercase mt-1 italic">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="relative">
                            <label class="block text-[10px] uppercase tracking-[0.3em] text-gray-400 mb-2">WhatsApp /
                                Phone</label>
                            <input type="text" wire:model="phone" placeholder="0812..."
                                class="w-full bg-transparent border-b border-neutral-300 py-3 focus:outline-none focus:border-black transition-colors text-sm">
                            @error('phone')
                                <span class="text-red-500 text-[9px] uppercase mt-1 italic">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <hr class="border-neutral-200">

                    {{-- Wedding Info --}}
                    <div class="space-y-8">
                        <div class="relative">
                            <label class="block text-[10px] uppercase tracking-[0.3em] text-gray-400 mb-2">Nama Mempelai
                                Pria</label>
                            <input type="text" wire:model="groom_name" placeholder="Nama Panggilan (Contoh: Rinaldi)"
                                class="w-full bg-transparent border-b border-neutral-300 py-3 focus:outline-none focus:border-black transition-colors text-sm font-medium">
                            @error('groom_name')
                                <span class="text-red-500 text-[9px] uppercase mt-1 italic">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="relative">
                            <label class="block text-[10px] uppercase tracking-[0.3em] text-gray-400 mb-2">Nama Mempelai
                                Wanita</label>
                            <input type="text" wire:model="bride_name" placeholder="Nama Panggilan (Contoh: Hanny)"
                                class="w-full bg-transparent border-b border-neutral-300 py-3 focus:outline-none focus:border-black transition-colors text-sm font-medium">
                            @error('bride_name')
                                <span class="text-red-500 text-[9px] uppercase mt-1 italic">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" wire:loading.attr="disabled"
                        class="w-full bg-[#1a1a1a] text-white py-6 rounded-xl text-[10px] uppercase tracking-[0.5em] font-bold hover:bg-black transition-all flex justify-center items-center shadow-xl">

                        <div wire:loading.remove wire:target="processCheckout" class="flex items-center gap-3">
                            <span>Proceed to Payment</span>
                        </div>

                        <div wire:loading wire:target="processCheckout" class="flex items-center gap-2">
                            <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                        </div>
                    </button>
                    <p class="text-[8px] text-gray-400 text-center mt-6 uppercase tracking-widest">
                        Secure transaction powered by Midtrans
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>

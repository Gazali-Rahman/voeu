<div class="min-h-screen bg-[#F9F8F6] py-20 font-sans">
    <div class="max-w-3xl mx-auto px-6">

        <div class="mb-12 text-center">
            <h2 class="text-4xl font-utama uppercase tracking-tighter text-[#1a1a1a]">
                {{ $order->groom_name }} & {{ $order->bride_name }}
            </h2>
            <p class="text-[10px] uppercase tracking-[0.4em] text-gray-500 mt-4 italic underline underline-offset-8">
                Invitation Dashboard
            </p>
        </div>

        <div class="bg-white border border-neutral-100 rounded-[2.5rem] p-10 mb-8 shadow-sm text-center">
            <p class="text-[9px] uppercase tracking-[0.3em] text-gray-400 mb-6">Main Invitation Link</p>

            <h3 class="text-lg font-medium mb-8 text-[#1a1a1a] break-all px-4">
                {{ str_replace(['http://', 'https://'], '', $mainUrl) }}
            </h3>

            <div class="flex flex-wrap justify-center gap-4">
                <button x-data="{ copied: false }"
                    @click="navigator.clipboard.writeText('{{ $mainUrl }}'); copied = true; setTimeout(() => copied = false, 2000)"
                    class="text-[9px] uppercase tracking-[0.2em] border border-neutral-200 px-8 py-4 rounded-full hover:bg-neutral-50 transition-all flex items-center gap-2 min-w-[160px] justify-center">
                    <span x-show="!copied">Copy Link</span>
                    <span x-show="copied" class="text-green-600 font-bold" x-cloak>✓ Copied!</span>
                </button>

                <a href="{{ $mainUrl }}" target="_blank"
                    class="text-[9px] uppercase tracking-[0.2em] bg-[#1a1a1a] text-white px-8 py-4 rounded-full hover:bg-black transition-all flex items-center gap-2 shadow-lg shadow-black/5">
                    Preview Undangan ↗
                </a>
            </div>
        </div>

        <div class="bg-white border border-neutral-100 rounded-[2.5rem] p-10 shadow-sm relative overflow-hidden">
            <div class="mb-10">
                <h4 class="text-xs font-bold uppercase tracking-[0.3em]">Guest Link Generator</h4>
                <p class="text-[9px] text-gray-400 mt-2 uppercase tracking-widest leading-relaxed">
                    Buat link khusus untuk tamu agar nama mereka muncul di undangan.
                </p>
            </div>

            <div class="space-y-6">
                <div class="group">
                    <label class="block text-[8px] uppercase tracking-widest text-gray-400 mb-3 ml-1">Nama Tamu
                        Undangan</label>
                    <input type="text" wire:model="guestName" placeholder="Contoh: Bpk. Rinaldi & Istri"
                        class="w-full bg-[#F9F8F6] border border-transparent rounded-2xl px-6 py-5 text-sm focus:bg-white focus:border-neutral-200 focus:ring-0 transition-all outline-none placeholder:text-gray-300">
                    @error('guestName')
                        <span
                            class="text-[8px] text-red-500 mt-2 uppercase tracking-widest block">{{ $message }}</span>
                    @enderror
                </div>

                <button wire:click="generateLink"
                    class="w-full bg-[#1a1a1a] text-white py-6 rounded-2xl text-[10px] uppercase tracking-[0.3em] font-bold hover:bg-black transition-all shadow-xl shadow-black/5">
                    Generate Guest Link
                </button>

                @if ($generatedLink)
                    <div x-data="{ copied: false }"
                        class="mt-12 p-8 bg-[#F9F8F6] rounded-4xl border border-dashed border-neutral-200 animate-in fade-in slide-in-from-bottom-4 duration-500">
                        <p class="text-[8px] uppercase tracking-widest text-gray-400 mb-4">Link Khusus untuk: <span
                                class="text-black font-bold">{{ $guestName }}</span></p>

                        <div
                            class="bg-white p-4 rounded-xl border border-neutral-100 mb-6 font-mono text-[10px] text-gray-500 break-all">
                            {{ $generatedLink }}
                        </div>

                        <div class="flex gap-3">
                            <button
                                @click="navigator.clipboard.writeText('{{ $generatedLink }}'); copied = true; setTimeout(() => copied = false, 2000)"
                                class="flex-1 bg-white border border-neutral-200 py-4 rounded-xl text-[9px] uppercase tracking-widest font-bold hover:bg-neutral-50 transition-all">
                                <span x-show="!copied text-black">Copy Link</span>
                                <span x-show="copied" class="text-green-600" x-cloak>✓ Berhasil!</span>
                            </button>
                            {{-- 
                            @php
                                $waMessage = "Halo {$guestName}, kami mengundang Anda ke acara kami. Silakan buka link berikut untuk informasi selengkapnya: {$generatedLink}";
                            @endphp --}}

                            <a href="{{ $this->waLink }}" target="_blank"
                                class="flex-1 bg-green-500 text-white py-4 rounded-xl text-[10px] uppercase tracking-[0.2em] font-bold text-center hover:bg-green-600 transition-all shadow-lg flex items-center justify-center gap-2">

                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                                </svg>
                                Kirim WhatsApp
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <div class="mt-12 text-center">
            <a href="{{ route('my-orders') }}" wire:navigate
                class="text-[9px] uppercase tracking-[0.4em] text-gray-400 hover:text-black transition-all italic underline underline-offset-4">
                ← Kembali ke Riwayat Pesanan
            </a>
        </div>
    </div>
</div>

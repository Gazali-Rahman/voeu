<?php

use Livewire\Component;
use App\Models\Promo;
use Carbon\Carbon;

new class extends Component {
    public function with()
    {
        return [
            'activePromos' => Promo::where('is_active', true)
                ->where(function ($query) {
                    $query->whereNull('expires_at')->orWhere('expires_at', '>=', Carbon::today());
                })
                ->whereColumn('used', '<', 'limit')
                ->latest()
                ->get(),
        ];
    }
};
?>

<div id="promo" class="max-w-7xl mx-auto px-6 py-12">
    @if ($activePromos->count() > 0)
        <div class="mb-8">
            <h2 class="text-sm font-utama tracking-[0.4em] uppercase mb-1">Special Offers</h2>
            <p class="text-[10px] text-gray-400 uppercase tracking-widest">Gunakan kode promo untuk penawaran terbatas
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($activePromos as $promo)
                <div
                    class="group relative border border-[#e5e1da]/50 p-8 overflow-hidden transition-all hover:border-black bg-white">
                    <div class="absolute top-0 right-0 p-4">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                            class="text-gray-200 group-hover:text-black transition-colors">
                            <path d="M0 1H19V20" stroke="currentColor" stroke-width="0.5" />
                        </svg>
                    </div>

                    <div class="space-y-4">
                        <div class="inline-block bg-black text-white px-3 py-1 text-[9px] tracking-[0.2em] uppercase">
                            {{ $promo->type == 'percent' ? 'Diskon ' . (int) $promo->value . '%' : 'Potongan Rp ' . number_format($promo->value, 0, ',', '.') }}
                        </div>

                        <div>
                            <h3 class="text-xl font-utama tracking-widest uppercase text-black">{{ $promo->code }}</h3>
                            <p class="text-[10px] text-gray-500 uppercase tracking-widest mt-1">
                                @if ($promo->expires_at)
                                    Berlaku hingga {{ \Carbon\Carbon::parse($promo->expires_at)->format('d M Y') }}
                                @else
                                    Penawaran Terbatas
                                @endif
                            </p>
                        </div>

                        <div class="pt-4 flex items-center justify-between border-t border-[#e5e1da]/50"
                            x-data="{ copied: false }">

                            <button
                                @click="
                                navigator.clipboard.writeText('{{ $promo->code }}');
                                copied = true;
                                setTimeout(() => copied = false, 2000)
                            "
                                class="text-[9px] font-bold uppercase tracking-[0.3em] transition-colors flex items-center gap-2"
                                :class="copied ? 'text-green-600' : 'text-black hover:text-gray-600'">

                                <span x-text="copied ? 'Berhasil Salin' : 'Salin Kode'"></span>

                                <template x-if="!copied">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" />
                                    </svg>
                                </template>
                                <template x-if="copied">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                </template>
                            </button>

                            <span class="text-[8px] text-gray-300 uppercase tracking-widest">
                                Sisa Kuota: {{ $promo->limit - $promo->used }}
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

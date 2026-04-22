<div class="min-h-screen bg-[#F9F8F6] py-20 flex flex-col items-center font-sans px-4">
    {{-- Notifikasi Error Sistem --}}
    @if (session()->has('error'))
        <div
            class="w-full max-w-md mb-6 p-4 bg-red-50 text-red-600 text-[10px] uppercase tracking-[0.3em] rounded-2xl border border-red-100 flex items-center gap-3 animate-bounce">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            {{ session('error') }}
        </div>
    @endif

    <div
        class="w-full max-w-md mb-8 bg-white/80 backdrop-blur-sm p-4 rounded-xl border border-white shadow-[0_20px_50px_rgba(0,0,0,0.02)]">
        <div class="text-center mb-8">
            <h2 class="text-[10px] uppercase tracking-[0.5em] text-gray-400 font-medium">Order Confirmation</h2>
            <div class="h-px w-10 bg-neutral-200 mx-auto mt-4"></div>
        </div>

        <div class="flex items-center gap-6 mb-8">
            <div
                class="h-20 w-20 bg-neutral-100 rounded-2xl overflow-hidden shrink-0 shadow-inner border border-neutral-50">
                <img src="{{ asset('storage/' . $order->catalog->image) }}"
                    class="h-full w-full object-cover grayscale-[0.2] hover:grayscale-0 transition-all duration-500">
            </div>
            <div class="space-y-1">
                <h3 class="text-sm font-bold uppercase tracking-widest text-[#1a1a1a]">{{ $order->catalog->name }}</h3>
                <p class="text-[9px] text-gray-400 uppercase tracking-widest">{{ $order->external_id }}</p>
                <div
                    class="inline-block px-2 py-0.5 bg-neutral-50 border border-neutral-100 rounded text-[8px] text-neutral-400 uppercase">
                    Digital License</div>
            </div>
        </div>

        {{-- Input Promo --}}
        <div class="mt-8 pt-8 border-t border-neutral-50">
            <label class="text-[9px] uppercase tracking-[0.3em] text-gray-400 block mb-3">
                {{ $hasAppliedPromo ? 'Promo Applied' : 'Have a promo code?' }}
            </label>

            <div class="flex gap-2">
                <input wire:model="promoCode" type="text" placeholder="ENTER CODE"
                    {{ $hasAppliedPromo ? 'readonly' : '' }}
                    class="flex-1 {{ $hasAppliedPromo ? 'bg-gray-100 text-gray-400' : 'bg-neutral-50' }} border-neutral-100 rounded-xl px-4 py-3 text-[10px] uppercase tracking-widest focus:ring-1 focus:ring-black focus:border-black transition-all">

                @if (!$hasAppliedPromo)
                    <button wire:click="applyPromo"
                        class="bg-[#1a1a1a] text-white px-6 py-3 rounded-xl text-[9px] uppercase tracking-widest font-bold hover:bg-black transition-all">
                        Apply
                    </button>
                @else
                    @if (!$order->checkout_url)
                        <button wire:click="resetPromo"
                            class="bg-red-50 text-red-500 px-6 py-3 rounded-xl text-[9px] uppercase tracking-widest font-bold hover:bg-red-100 transition-all">
                            Remove
                        </button>
                    @else
                        {{-- Opsional: Tampilkan icon kunci atau biarkan kosong agar user tidak bisa utak-atik --}}
                        <div
                            class="bg-neutral-100 text-neutral-400 px-6 py-3 rounded-xl text-[9px] uppercase tracking-widest font-bold flex items-center shadow-inner">
                            Locked
                        </div>
                    @endif
                @endif
            </div>
            @if (session()->has('error_promo'))
                <p class="text-[8px] text-red-500 uppercase tracking-widest mt-2 italic">{{ session('error_promo') }}
                </p>
            @endif
            @if (session()->has('success_promo'))
                <p class="text-[8px] text-green-600 uppercase tracking-widest mt-2 italic font-bold">
                    {{ session('success_promo') }}</p>
            @endif
        </div>

        {{-- Rincian Harga --}}
        <div class="pt-6 mt-6 border-t border-neutral-100 space-y-3">
            @if ($discount > 0)
                <div class="flex justify-between items-center text-gray-400">
                    <span class="text-[9px] uppercase tracking-[0.3em]">Original Price</span>
                    {{-- Ambil dari catalog->price agar selalu menampilkan harga asli sebelum diskon --}}
                    <span class="text-xs line-through font-utama">Rp
                        {{ number_format($order->catalog->price, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between items-center text-green-600">
                    <span class="text-[9px] uppercase tracking-[0.3em]">Promo Discount</span>
                    <span class="text-xs font-utama">- Rp {{ number_format($discount, 0, ',', '.') }}</span>
                </div>
            @endif

            <div class="flex justify-between items-end">
                <div>
                    <span class="text-[9px] uppercase tracking-[0.3em] text-gray-400 block mb-1">Total Amount</span>
                    <span class="text-2xl font-utama tracking-tighter text-[#1a1a1a]">Rp
                        {{ number_format($finalAmount, 0, ',', '.') }}</span>
                </div>
                <div class="text-[9px] text-gray-300 italic uppercase">Tax Included</div>
            </div>
        </div>
    </div>

    <div class="w-full max-w-md">
        @if ($order->status === 'pending')
            <div class="space-y-6">
                <button wire:click="processPayment" wire:loading.attr="disabled"
                    class="group w-full bg-[#1a1a1a] text-white py-8 rounded-2xl grid place-items-center hover:bg-black transition-all duration-500 shadow-xl shadow-black/5 relative overflow-hidden">
                    <span wire:loading.remove wire:target="processPayment"
                        class="text-[11px] uppercase tracking-[0.6em] font-bold">Bayar Sekarang</span>
                    <div wire:loading wire:target="processPayment">
                        <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                    </div>
                </button>
                <p class="text-[8px] text-center text-gray-400 uppercase tracking-[0.4em]">Secure Payment via Midtrans
                </p>
            </div>
        @elseif ($order->status === 'expired' || $order->status === 'failed')
            <div class="text-center space-y-6">
                <div class="p-10 bg-white rounded-2xl border border-red-50 shadow-sm">
                    <h3 class="text-[10px] uppercase tracking-[0.4em] font-bold text-red-600">Payment Failed</h3>
                    <p class="text-[9px] text-gray-400 uppercase tracking-widest mt-2">Sesi telah berakhir.</p>
                </div>
                <a href="{{ route('home') }}"
                    class="block w-full border border-neutral-200 text-[#1a1a1a] py-6 rounded-2xl text-[10px] uppercase tracking-[0.5em] font-bold hover:bg-neutral-50 transition-all text-center">Back
                    to Home</a>
            </div>
        @else
            <div class="text-center space-y-6">
                <div class="p-10 bg-white rounded-2xl border border-neutral-50 shadow-sm">
                    <h3 class="text-[10px] uppercase tracking-[0.4em] font-bold text-[#1a1a1a]">Success</h3>
                    <p class="text-[9px] text-gray-400 uppercase tracking-widest mt-2">Terima kasih atas pembayaran
                        Anda.</p>
                </div>
                <a href="{{ route('my-orders') }}" wire:navigate
                    class="block w-full bg-[#1a1a1a] text-white py-6 rounded-2xl text-[10px] uppercase tracking-[0.5em] font-bold hover:bg-black transition-all text-center shadow-lg shadow-black/5">My
                    Orders</a>
            </div>
        @endif
    </div>

    {{-- Script Midtrans --}}
    <script
        src="{{ config('services.midtrans.is_production') ? 'https://app.midtrans.com/snap/snap.js' : 'https://app.sandbox.midtrans.com/snap/snap.js' }}"
        data-client-key="{{ config('services.midtrans.client_key') }}"></script>
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('pay-via-midtrans', (event) => {
                const data = Array.isArray(event) ? event[0] : event;
                window.snap.pay(data.snapToken, {
                    onSuccess: function(result) {
                        window.location.href = "{{ route('my-orders') }}";
                    },
                    onPending: function(result) {
                        location.reload();
                    },
                    onError: function(result) {
                        alert("Pembayaran gagal!");
                    },
                    onClose: function() {
                        console.log('User closed the popup');
                    }
                });
            });
        });
    </script>
</div>

<div class="min-h-screen bg-[#F9F8F6] py-20 font-sans">
    <div class="max-w-5xl mx-auto px-6">
        <div class="mb-12">
            <h2 class="text-4xl font-utama uppercase tracking-tighter text-[#1a1a1a]">My Orders</h2>
            <p class="text-[10px] uppercase tracking-[0.4em] text-gray-500 mt-2">Track your digital invitation orders</p>
        </div>

        @if ($orders->isEmpty())
            <div class="text-center py-20 border border-dashed border-neutral-200 rounded-3xl">
                <p class="text-[10px] uppercase tracking-widest text-gray-400">You haven't made any orders yet.</p>
                <a href="{{ route('home') }}"
                    class="inline-block mt-6 text-[10px] uppercase tracking-[0.4em] underline">Explore Collection</a>
            </div>
        @else
            <div class="space-y-6">
                @foreach ($orders as $order)
                    <div
                        class="bg-white border border-neutral-100 rounded-3xl p-6 md:p-8 flex flex-col md:flex-row justify-between items-center gap-6 shadow-sm">

                        <div class="flex items-center gap-6 w-full md:w-auto">
                            <div class="h-20 w-20 rounded-2xl overflow-hidden shrink-0 border border-neutral-100">
                                <img src="{{ asset('storage/' . $order->catalog->image) }}"
                                    class="h-full w-full object-cover">
                            </div>
                            <div>
                                <h3 class="text-sm font-medium uppercase tracking-widest text-[#1a1a1a]">
                                    {{ $order->catalog->name }}</h3>
                                <p class="text-[9px] text-gray-400 uppercase tracking-widest mt-1">ID:
                                    {{ $order->external_id }}</p>
                                <p class="text-xs font-semibold mt-2">Rp
                                    {{ number_format($order->amount, 0, ',', '.') }}</p>
                            </div>
                        </div>

                        <div
                            class="flex flex-wrap items-center gap-4 md:gap-8 w-full md:w-auto justify-between md:justify-end">
                            <div class="text-left md:text-right">
                                <p class="text-[9px] uppercase tracking-widest text-gray-400 mb-1">Status</p>
                                @if ($order->status === 'selesai')
                                    <span
                                        class="px-4 py-1.5 bg-green-50 text-green-600 rounded-full text-[9px] font-bold uppercase tracking-widest">Selesai</span>
                                @elseif($order->status === 'proses')
                                    <span
                                        class="px-4 py-1.5 bg-blue-50 text-blue-600 rounded-full text-[9px] font-bold uppercase tracking-widest animate-pulse">Proses</span>
                                @elseif($order->status === 'expired')
                                    <span
                                        class="px-4 py-1.5 bg-red-50 text-red-600 rounded-full text-[9px] font-bold uppercase tracking-widest">Expired</span>
                                @elseif($order->status === 'failed')
                                    <span
                                        class="px-4 py-1.5 bg-red-50 text-red-600 rounded-full text-[9px] font-bold uppercase tracking-widest italic">Failed</span>
                                @else
                                    <span
                                        class="px-4 py-1.5 bg-amber-50 text-amber-600 rounded-full text-[9px] font-bold uppercase tracking-widest">Pending</span>
                                @endif
                            </div>

                            <div class="flex items-center gap-3">
                                @if ($order->status === 'pending')
                                    @if (!Str::contains($order->external_id, 'VOEU-WA'))
                                        {{-- Samakan semua pesanan pending untuk diarahkan ke halaman Payment --}}
                                        <a href="{{ route('payment', ['order_id' => $order->id]) }}" wire:navigate
                                            class="bg-[#1a1a1a] text-white px-8 py-4 rounded-xl text-[9px] uppercase tracking-[0.3em] hover:bg-black transition-all text-center font-bold shadow-md">
                                            Pay Now
                                        </a>
                                    @else
                                        <span
                                            class="bg-neutral-50 text-neutral-400 px-8 py-4 rounded-xl text-[9px] uppercase tracking-[0.3em] text-center border border-neutral-100">
                                            Waiting WA Confirmation
                                        </span>
                                    @endif
                                @elseif($order->status === 'proses')
                                    <button disabled
                                        class="bg-neutral-50 text-neutral-400 px-8 py-4 rounded-xl text-[9px] uppercase tracking-[0.3em] cursor-not-allowed text-center border border-neutral-100">
                                        In Progress
                                    </button>
                                @elseif($order->status === 'selesai')
                                    <a href="{{ route('invitation.dashboard', ['order_id' => $order->id]) }}"
                                        wire:navigate
                                        class="bg-white border border-[#1a1a1a] text-[#1a1a1a] px-8 py-4 rounded-xl text-[9px] uppercase tracking-[0.3em] hover:bg-[#1a1a1a] hover:text-white transition-all text-center font-bold">
                                        Manage Link
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

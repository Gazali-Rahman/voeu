<div class="min-h-screen bg-[#F9F8F6] py-20 font-sans">
    <div class="max-w-5xl mx-auto px-6">
        @if (session()->has('message'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
                class="mb-6 p-4 bg-green-50 border border-green-100 text-green-600 text-[10px] uppercase tracking-[0.2em] rounded-2xl flex justify-between items-center">
                <span>{{ session('message') }}</span>
                <button @click="show = false">✕</button>
            </div>
        @endif
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
                            class="flex flex-col md:flex-row items-start md:items-center gap-6 md:gap-8 w-full md:w-auto justify-start md:justify-end">

                            <div class="text-left md:text-right w-full md:w-auto">
                                <p class="text-[9px] uppercase tracking-widest text-gray-400 mb-1">Status</p>

                                @if ($order->status === 'selesai')
                                    <span
                                        class="inline-block px-4 py-1.5 bg-green-50 text-green-600 rounded-full text-[9px] font-bold uppercase tracking-widest">
                                        Selesai
                                    </span>
                                @elseif($order->status === 'proses')
                                    <span
                                        class="inline-block px-4 py-1.5 bg-blue-50 text-blue-600 rounded-full text-[9px] font-bold uppercase tracking-widest animate-pulse">
                                        Proses
                                    </span>
                                @elseif($order->status === 'expired')
                                    <span
                                        class="inline-block px-4 py-1.5 bg-red-50 text-red-600 rounded-full text-[9px] font-bold uppercase tracking-widest">
                                        Expired
                                    </span>
                                @elseif($order->status === 'failed')
                                    <span
                                        class="inline-block px-4 py-1.5 bg-red-50 text-red-600 rounded-full text-[9px] font-bold uppercase tracking-widest italic">
                                        Failed
                                    </span>
                                @else
                                    <span
                                        class="inline-block px-4 py-1.5 bg-amber-50 text-amber-600 rounded-full text-[9px] font-bold uppercase tracking-widest">
                                        Pending
                                    </span>
                                @endif
                            </div>

                            <div class="flex flex-col md:flex-row items-stretch md:items-center gap-3 w-full md:w-auto">
                                @if ($order->status === 'pending')
                                    <a href="{{ route('payment', ['external_id' => $order->external_id]) }}"
                                        wire:navigate
                                        class="bg-[#1a1a1a] text-white px-8 py-4 rounded-xl text-[9px] uppercase tracking-[0.3em] hover:bg-black transition-all text-center font-bold shadow-md w-full md:w-auto">
                                        Pay Now
                                    </a>
                                @elseif($order->status === 'proses')
                                    <button disabled
                                        class="bg-neutral-50 text-neutral-400 px-8 py-4 rounded-xl text-[9px] uppercase tracking-[0.3em] cursor-not-allowed text-center border border-neutral-100 w-full md:w-auto">
                                        In Progress
                                    </button>
                                @elseif($order->status === 'selesai')
                                    <a href="{{ route('invitation.dashboard', ['slug' => $order->slug]) }}"
                                        wire:navigate
                                        class="bg-white border border-[#1a1a1a] text-[#1a1a1a] px-8 py-4 rounded-xl text-[9px] uppercase tracking-[0.3em] hover:bg-[#1a1a1a] hover:text-white transition-all text-center font-bold w-full md:w-auto">
                                        Manage Link
                                    </a>

                                    @if ($order->ratings->isEmpty())
                                        <button wire:click="openRatingModal('{{ $order->external_id }}')"
                                            class="bg-[#F9F8F6] border border-neutral-200 text-neutral-600 px-8 py-4 rounded-xl text-[9px] uppercase tracking-[0.3em] hover:border-[#1a1a1a] hover:text-[#1a1a1a] transition-all text-center font-bold flex items-center justify-center gap-2 w-full md:w-auto">
                                            <svg class="w-3 h-3 text-yellow-500" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            Give Rating
                                        </button>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
    <div x-data="{ show: @entangle('showRatingModal') }" x-show="show" class="fixed inset-0 z-50 flex items-center justify-center p-4" x-cloak>

        <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" @click="show = false"></div>

        <div class="relative bg-white w-full max-w-md rounded-2xl p-8 shadow-2xl" x-show="show"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100">

            <h2 class="text-xl font-utama uppercase tracking-widest text-[#1a1a1a] mb-2">Give Your Rating</h2>
            <p class="text-[10px] text-gray-400 uppercase tracking-widest mb-8">Share your experience with Voeu</p>

            <div class="space-y-6">
                <div class="flex justify-center gap-3">
                    @foreach ([1, 2, 3, 4, 5] as $star)
                        <button wire:click="$set('rating_stars', {{ $star }})" class="focus:outline-none">
                            <svg class="w-8 h-8 {{ $rating_stars >= $star ? 'text-yellow-400' : 'text-gray-200' }} transition-colors"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        </button>
                    @endforeach
                </div>

                <div>
                    <textarea wire:model="rating_comment" placeholder="Your message (optional)"
                        class="w-full bg-[#F9F8F6] border-none rounded-xl p-4 text-xs focus:ring-1 focus:ring-[#1a1a1a] min-h-[100px]"></textarea>
                </div>

                <button wire:click="submitRating"
                    class="w-full bg-[#1a1a1a] text-white py-4 rounded-xl text-[10px] uppercase tracking-[0.4em] hover:bg-black transition-all">
                    Submit Review
                </button>
            </div>
        </div>
    </div>
</div>

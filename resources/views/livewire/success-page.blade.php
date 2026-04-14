<div class="min-h-screen bg-[#F9F8F6] flex items-center justify-center font-sans px-4">
    <div class="max-w-lg w-full text-center space-y-8">
        <div class="flex justify-center">
            <div class="w-20 h-20 bg-black rounded-full flex items-center justify-center text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 13l4 4L19 7" />
                </svg>
            </div>
        </div>

        <div class="space-y-4">
            <h1 class="text-4xl font-utama uppercase tracking-tighter text-[#1a1a1a]">Payment Received</h1>
            <p class="text-[10px] uppercase tracking-[0.4em] text-gray-500 leading-relaxed">
                Thank you, {{ $order->customer_name }}. <br>
                Your order for <strong>{{ $order->catalog->name }}</strong> is being processed.
            </p>
        </div>

        <div class="bg-white border border-neutral-100 p-8 rounded-3xl space-y-4 shadow-sm">
            <div class="flex justify-between text-[10px] uppercase tracking-widest text-gray-400">
                <span>Order ID</span>
                <span class="text-black font-medium">{{ $order->external_id }}</span>
            </div>
            <div class="flex justify-between text-[10px] uppercase tracking-widest text-gray-400">
                <span>Status</span>
                <span class="px-3 py-1 bg-green-50 text-green-600 rounded-full font-bold">Success</span>
            </div>
        </div>

        <div class="pt-4">
            <a href="{{ route('home') }}"
                class="inline-block w-full bg-[#1a1a1a] text-white py-5 text-[10px] uppercase tracking-[0.5em] transition-all hover:tracking-[0.6em]">
                Back to Catalog
            </a>
        </div>
    </div>
</div>

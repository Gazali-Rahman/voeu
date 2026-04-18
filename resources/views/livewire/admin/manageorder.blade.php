<div class="space-y-8 font-sans">
    <div class="flex justify-between items-end">
        <div>
            <h2 class="text-3xl font-utama uppercase tracking-tighter text-[#1a1a1a]">Order Management</h2>
            <p class="text-[10px] uppercase tracking-[0.4em] text-gray-400 mt-2">Manage and track customer transactions
            </p>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="p-4 bg-green-50 text-green-600 text-[10px] uppercase tracking-widest rounded-xl">
            {{ session('message') }}
        </div>
    @endif
    @if (session()->has('success'))
        <div
            class="mb-6 flex items-center gap-3 bg-green-50 border border-green-100 text-green-600 px-4 py-3 rounded-lg animate-fade-in-down">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <span class="text-[10px] uppercase tracking-[0.2em] font-medium">
                {{ session('success') }}
            </span>
        </div>
    @endif

    <div class="bg-white border border-neutral-100 rounded-3xl overflow-hidden shadow-sm">
        <table class="w-full text-left">
            <thead>
                <tr class="border-b border-neutral-50">
                    <th class="px-8 py-6 text-[9px] uppercase tracking-[0.2em] text-gray-400 font-medium">Customer / ID
                    </th>
                    <th class="px-8 py-6 text-[9px] uppercase tracking-[0.2em] text-gray-400 font-medium">Product</th>
                    <th class="px-8 py-6 text-[9px] uppercase tracking-[0.2em] text-gray-400 font-medium">Amount</th>
                    <th class="px-8 py-6 text-[9px] uppercase tracking-[0.2em] text-gray-400 font-medium text-center">
                        Status</th>
                    <th class="px-8 py-6 text-[9px] uppercase tracking-[0.2em] text-gray-400 font-medium text-right">
                        Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-neutral-50">
                @foreach ($orders as $order)
                    <tr class="hover:bg-[#F9F8F6]/50 transition-colors">
                        <td class="px-8 py-6">
                            <p class="text-xs font-bold text-[#1a1a1a] uppercase tracking-wide">
                                {{ $order->customer_name }}</p>
                            <p class="text-[9px] text-gray-400 mt-1 italic">{{ $order->external_id }}</p>
                        </td>
                        <td class="px-8 py-6 text-xs uppercase tracking-widest text-gray-600">
                            {{ $order->catalog->name }}
                        </td>
                        <td class="px-8 py-6 text-xs font-semibold">
                            Rp {{ number_format($order->amount, 0, ',', '.') }}
                        </td>
                        <td class="px-8 py-6 text-center">
                            @if ($order->status === 'paid')
                                <span
                                    class="px-3 py-1 bg-green-50 text-green-600 rounded-full text-[8px] font-bold uppercase tracking-widest">Paid</span>
                            @elseif($order->status === 'proses')
                                <span
                                    class="px-3 py-1 bg-blue-50 text-blue-600 rounded-full text-[8px] font-bold uppercase tracking-widest">Proses</span>
                            @elseif($order->status === 'selesai')
                                <span
                                    class="px-3 py-1 bg-neutral-100 text-neutral-500 rounded-full text-[8px] font-bold uppercase tracking-widest italic">Selesai</span>
                            @elseif($order->status === 'failed')
                                <span
                                    class="px-3 py-1 bg-red-50 text-red-600 rounded-full text-[8px] font-bold uppercase tracking-widest italic">Failed</span>
                            @else
                                <span
                                    class="px-3 py-1 bg-amber-50 text-amber-600 rounded-full text-[8px] font-bold uppercase tracking-widest">Pending</span>
                            @endif
                        </td>
                        <td class="px-8 py-6 text-right">
                            <div class="flex justify-end items-center gap-2">
                                @if ($order->status === 'proses')
                                    <a href="{{ $this->getWhatsAppLink($order->id) }}" target="_blank"
                                        class="bg-green-500 text-white px-5 py-2.5 rounded-lg text-[8px] uppercase tracking-[0.2em] hover:bg-green-600 transition-all flex items-center gap-2">
                                        Hubungi
                                    </a>
                                    {{-- Tombol Buat / Edit Undangan --}}
                                    <a href="{{ route('invitation.create', ['order_id' => $order->id]) }}"
                                        class="border border-[#1a1a1a] text-[#1a1a1a] px-5 py-2.5 rounded-lg text-[8px] uppercase tracking-[0.2em] hover:bg-[#1a1a1a] hover:text-white transition-all flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4v16m8-8H4" />
                                        </svg>
                                        Buat Undangan
                                    </a>
                                    @if ($order->invitation)
                                        <a href="{{ route('invitation.v', $order->invitation->slug) }}" target="_blank"
                                            class="bg-[#1a1a1a] text-white px-5 py-2.5 rounded-lg text-[8px] uppercase tracking-[0.2em] hover:bg-black transition-all flex items-center gap-2">
                                            Buka Undangan
                                        </a>
                                    @endif
                                    <button wire:click="markAsCompleted({{ $order->id }})"
                                        class="bg-[#1a1a1a] text-white px-5 py-2.5 rounded-lg text-[8px] uppercase tracking-[0.2em] hover:bg-black transition-all">
                                        Set Selesai
                                    </button>

                                    {{-- JIKA STATUS LAINNYA --}}
                                @else
                                    <span class="text-[8px] uppercase tracking-widest text-gray-300 italic">No Action
                                        Required</span>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $orders->links() }}
    </div>
</div>

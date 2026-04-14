<div class="space-y-10 font-sans pb-20">
    <div>
        <h2 class="text-3xl font-utama uppercase tracking-tighter text-[#1a1a1a]">Business Analytics</h2>
        <p class="text-[10px] uppercase tracking-[0.4em] text-gray-400 mt-2">Overview of your digital invitation service
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white border border-neutral-100 p-8 rounded-4xl shadow-sm">
            <p class="text-[9px] uppercase tracking-[0.2em] text-gray-400 mb-4">Total Revenue</p>
            <h3 class="text-2xl font-bold text-[#1a1a1a]">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
            <div class="mt-4 flex items-center text-[8px] text-green-500 uppercase tracking-widest font-bold">
                <span>+ Real-time Data</span>
            </div>
        </div>

        <div class="bg-white border border-neutral-100 p-8 rounded-4xl shadow-sm">
            <p class="text-[9px] uppercase tracking-[0.2em] text-gray-400 mb-4">Total Orders</p>
            <h3 class="text-2xl font-bold text-[#1a1a1a]">{{ $totalOrders }}</h3>
            <p class="text-[8px] uppercase tracking-widest text-blue-500 mt-4 font-bold">
                {{ $processOrders }} In Progress
            </p>
        </div>

        <div class="bg-white border border-neutral-100 p-8 rounded-4xl shadow-sm">
            <p class="text-[9px] uppercase tracking-[0.2em] text-gray-400 mb-4">Pending Payment</p>
            <h3 class="text-2xl font-bold text-[#1a1a1a]">{{ $pendingOrders }}</h3>
            <p class="text-[8px] uppercase tracking-widest text-amber-500 mt-4 font-bold italic">Awaiting Action</p>
        </div>

        <div class="bg-white border border-neutral-100 p-8 rounded-4xl shadow-sm">
            <p class="text-[9px] uppercase tracking-[0.2em] text-gray-400 mb-4">Active Catalogs</p>
            <h3 class="text-2xl font-bold text-[#1a1a1a]">{{ $totalCatalogs }}</h3>
            <p class="text-[8px] uppercase tracking-widest text-gray-400 mt-4">Design Templates</p>
        </div>
    </div>

    <div class="bg-white border border-neutral-100 rounded-[2.5rem] p-10 shadow-sm mt-10">
        <div class="flex justify-between items-center mb-12">
            <div>
                <h4 class="text-xs font-bold uppercase tracking-[0.3em]">Conversion Analytics</h4>
                <p class="text-[9px] text-gray-400 mt-1 uppercase tracking-widest">Analisis minat pengunjung vs total
                    pembelian</p>
            </div>
            <span class="text-[10px] font-medium py-2 px-6 bg-[#F9F8F6] rounded-full uppercase tracking-tighter">
                Total {{ number_format($totalViews) }} Views
            </span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-16 gap-y-12">
            @foreach ($topProducts as $product)
                <div class="group">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-5">
                            <div class="w-14 h-14 rounded-2xl overflow-hidden bg-neutral-100 shrink-0">
                                <img src="{{ asset('storage/' . $product->image) }}"
                                    class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700">
                            </div>
                            <div>
                                <p class="text-[10px] font-bold uppercase tracking-widest text-[#1a1a1a]">
                                    {{ $product->name }}
                                </p>
                                <p class="text-[8px] text-gray-400 uppercase tracking-[0.2em] mt-1">
                                    {{ $product->views_count }} Views • {{ $product->purchase_count ?? 0 }} Sales
                                </p>
                            </div>
                        </div>
                        <div class="text-right">
                            <span
                                class="text-[11px] font-bold text-[#1a1a1a]">{{ $product->conversion_rate ?? 0 }}%</span>
                            <p class="text-[7px] uppercase tracking-widest text-gray-400 mt-0.5">Rate</p>
                        </div>
                    </div>

                    <div class="relative w-full h-[4px] bg-neutral-50 rounded-full overflow-hidden">
                        @php
                            $viewPercent = $totalViews > 0 ? ($product->views_count / $totalViews) * 100 : 0;
                            $convPercent =
                                $product->views_count > 0
                                    ? (($product->purchase_count ?? 0) / $product->views_count) * 100
                                    : 0;
                        @endphp

                        <div class="absolute inset-0 bg-neutral-100"></div>

                        <div class="absolute h-full bg-black transition-all duration-1000"
                            style="width: {{ $convPercent }}%"></div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="bg-white border border-neutral-100 rounded-[2.5rem] shadow-sm overflow-hidden">
        <div class="px-10 py-8 border-b border-neutral-50 flex justify-between items-center">
            <h4 class="text-xs font-bold uppercase tracking-[0.3em]">Recent Transactions</h4>
            <a href="{{ route('admin.orders') }}" wire:navigate
                class="text-[8px] uppercase tracking-widest text-gray-400 hover:text-black transition-all">
                View All Transactions →
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-[#F9F8F6]/50">
                    <tr>
                        <th class="px-10 py-5 text-[8px] uppercase tracking-widest text-gray-400 font-medium">Customer
                        </th>
                        <th class="px-10 py-5 text-[8px] uppercase tracking-widest text-gray-400 font-medium">Design
                        </th>
                        <th class="px-10 py-5 text-[8px] uppercase tracking-widest text-gray-400 font-medium">Status
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-50">
                    @forelse ($recentOrders as $order)
                        <tr class="hover:bg-neutral-50/30 transition-all">
                            <td class="px-10 py-6">
                                <p class="text-[10px] font-bold uppercase tracking-wider text-[#1a1a1a]">
                                    {{ $order->customer_name }}</p>
                                <p class="text-[8px] text-gray-400 mt-0.5 italic">{{ $order->external_id }}</p>
                            </td>
                            <td class="px-10 py-6 text-[10px] text-gray-500 uppercase tracking-widest">
                                {{ $order->catalog->name }}
                            </td>
                            <td class="px-10 py-6">
                                <span
                                    class="px-3 py-1 rounded-full text-[8px] font-bold uppercase tracking-[0.2em] 
                                    {{ $order->status === 'paid'
                                        ? 'bg-green-50 text-green-600'
                                        : ($order->status === 'proses'
                                            ? 'bg-blue-50 text-blue-600'
                                            : 'bg-amber-50 text-amber-600') }}">
                                    {{ $order->status }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3"
                                class="px-10 py-10 text-center text-[10px] uppercase tracking-widest text-gray-400 italic">
                                No recent transactions found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div x-data="{ showModal: @entangle('showModal') }" class="space-y-8">

    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
            <h2 class="text-sm font-utama tracking-[0.3em] uppercase">Cashflow Report</h2>
            <p class="text-[10px] text-gray-400 uppercase tracking-widest mt-1">Monthly Financial Overview</p>
        </div>

        <div class="flex items-center gap-3">
            <button @click="showModal = true"
                class="h-[37px] px-4 border border-black text-black text-[9px] uppercase tracking-widest hover:bg-black hover:text-white transition-all">
                Add Manual Transaction
            </button>
            <div class="flex items-center gap-2">
                <select wire:model.live="month"
                    class="bg-white border border-[#e5e1da]/50 text-[10px] uppercase tracking-wider px-3 py-2 outline-none focus:border-black">
                    @foreach (range(1, 12) as $m)
                        <option value="{{ $m }}">{{ date('F', mktime(0, 0, 0, $m, 1)) }}</option>
                    @endforeach
                </select>
                <select wire:model.live="year"
                    class="bg-white border border-[#e5e1da]/50 text-[10px] uppercase tracking-wider px-3 py-2 outline-none focus:border-black">
                    @for ($y = date('Y'); $y >= 2023; $y--)
                        <option value="{{ $y }}">{{ $y }}</option>
                    @endfor
                </select>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white p-6 border border-[#e5e1da]/50">
            <p class="text-[8px] uppercase tracking-[0.2em] text-gray-400 mb-2">Total Income</p>
            <p class="text-lg font-light tracking-tight text-black">IDR {{ number_format($totalIncome, 0, ',', '.') }}
            </p>
        </div>
        <div class="bg-white p-6 border border-[#e5e1da]/50">
            <p class="text-[8px] uppercase tracking-[0.2em] text-gray-400 mb-2">Total Expense</p>
            <p class="text-lg font-light tracking-tight text-red-400">IDR
                {{ number_format($totalExpense, 0, ',', '.') }}</p>
        </div>
        <div class="bg-white p-6 border border-[#e5e1da]/50">
            <p class="text-[8px] uppercase tracking-[0.2em] text-gray-400 mb-2">Balance</p>
            <p class="text-lg font-light tracking-tight text-green-600">IDR {{ number_format($balance, 0, ',', '.') }}
            </p>
        </div>
        <div class="bg-white p-6 border border-[#e5e1da]/50 flex items-center justify-center text-center">
            <button wire:click="downloadPDF" wire:loading.attr="disabled"
                class="text-[9px] uppercase tracking-[0.2em] border-b border-black pb-1 hover:text-gray-400 hover:border-gray-400 transition-all disabled:opacity-50">
                <span wire:loading.remove>Download Report (.pdf)</span>
                <span wire:loading>Generating PDF...</span>
            </button>
        </div>
    </div>

    <div class="bg-white border border-[#e5e1da]/50">
        <div class="px-8 py-6 border-b border-[#e5e1da]/30 flex justify-between items-center">
            <h3 class="text-[10px] uppercase tracking-[0.2em]">Transaction Logs —
                {{ date('F Y', mktime(0, 0, 0, $month, 1, $year)) }}</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="text-[9px] uppercase tracking-widest text-gray-400 border-b border-[#e5e1da]/30">
                        <th class="px-8 py-4 font-medium">Date</th>
                        <th class="px-8 py-4 font-medium">Note</th>
                        <th class="px-8 py-4 font-medium text-center">Type</th>
                        <th class="px-8 py-4 font-medium text-right">Amount</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#e5e1da]/20">
                    @forelse ($transactions as $item)
                        <tr class="hover:bg-[#F9F8F6] transition-colors">
                            <td class="px-8 py-4 text-[10px] tracking-wider text-gray-500">
                                {{ $item->date->format('d M Y') }}</td>
                            <td class="px-8 py-4 text-[10px] tracking-wider text-black">
                                {{ $item->description }}
                                <span
                                    class="block text-[8px] text-gray-400 uppercase mt-1">{{ $item->category }}</span>
                            </td>
                            <td class="px-8 py-4 text-center">
                                <span
                                    class="text-[8px] px-2 py-1 uppercase tracking-widest {{ $item->type == 'income' ? 'bg-green-50 text-green-600' : 'bg-red-50 text-red-600' }}">
                                    {{ $item->type }}
                                </span>
                            </td>
                            <td
                                class="px-8 py-4 text-[10px] tracking-wider text-right {{ $item->type == 'expense' ? 'text-red-400' : 'text-black' }}">
                                {{ $item->type == 'expense' ? '-' : '' }} IDR
                                {{ number_format($item->amount, 0, ',', '.') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4"
                                class="px-8 py-10 text-[10px] text-center text-gray-400 uppercase tracking-widest">No
                                transactions found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div x-show="showModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/20 backdrop-blur-sm"
        x-cloak x-transition>
        <div @click.away="showModal = false" class="bg-white border border-[#e5e1da] w-full max-w-md p-8 shadow-xl">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xs font-utama tracking-widest uppercase">Add Transaction</h3>
                <button @click="showModal = false" class="text-gray-400 hover:text-black">&times;</button>
            </div>

            <form wire:submit.prevent="saveTransaction" class="space-y-5">
                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1">
                        <label class="text-[8px] uppercase tracking-widest text-gray-400 ml-1">Date</label>
                        <input type="date" wire:model="date"
                            class="w-full border-[#e5e1da] text-[10px] p-3 outline-none border focus:border-black transition-all">
                    </div>
                    <div class="space-y-1">
                        <label class="text-[8px] uppercase tracking-widest text-gray-400 ml-1">Type</label>
                        <select wire:model="type"
                            class="w-full border-[#e5e1da] text-[10px] p-3 outline-none border focus:border-black transition-all">
                            <option value="income">Income</option>
                            <option value="expense">Expense</option>
                        </select>
                    </div>
                </div>

                <div class="space-y-1">
                    <label class="text-[8px] uppercase tracking-widest text-gray-400 ml-1">Description</label>
                    <input type="text" wire:model="description" placeholder="E.g. Facebook Ads"
                        class="w-full border-[#e5e1da] text-[10px] p-3 outline-none border focus:border-black transition-all">
                </div>

                <div class="space-y-1">
                    <label class="text-[8px] uppercase tracking-widest text-gray-400 ml-1">Amount (IDR)</label>
                    <input type="number" wire:model="amount"
                        class="w-full border-[#e5e1da] text-[10px] p-3 outline-none border focus:border-black transition-all">
                </div>

                <div class="flex gap-3 pt-4">
                    <button type="button" @click="showModal = false"
                        class="flex-1 py-3 border border-[#e5e1da] text-[9px] uppercase tracking-widest text-gray-400 hover:text-black hover:border-black transition-all">
                        Cancel
                    </button>
                    <button type="submit"
                        class="flex-1 py-3 bg-black text-white text-[9px] uppercase tracking-widest hover:bg-gray-800 transition-all">
                        Save Transaction
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>

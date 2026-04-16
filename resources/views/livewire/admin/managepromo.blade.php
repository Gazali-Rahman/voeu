<div class="space-y-8">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-4">
        <div>
            <h2 class="text-2xl font-utama tracking-widest uppercase">Manage Promo</h2>
            <p class="text-[10px] text-gray-400 tracking-widest uppercase mt-2">Atur potongan harga untuk pelanggan Voeu
            </p>
        </div>
        {{-- Input Search --}}
        <div class="w-full md:w-64">
            <input wire:model.live="search" type="text"
                class="w-full border-[#e5e1da] focus:border-black focus:ring-0 text-[10px] uppercase tracking-widest p-3 bg-white shadow-sm"
                placeholder="Search Code...">
        </div>
    </div>

    @if (session()->has('success'))
        <div
            class="bg-black text-white px-6 py-4 text-[10px] uppercase tracking-widest flex justify-between items-center animate-pulse">
            <span>{{ session('success') }}</span>
            <button @click="show = false" class="opacity-50 hover:opacity-100">×</button>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        {{-- FORM SECTION --}}
        <div class="bg-white p-8 border border-[#e5e1da]/50 shadow-sm h-fit sticky top-10">
            <h3 class="text-[11px] font-bold uppercase tracking-[0.2em] mb-6 border-b border-[#e5e1da]/30 pb-4">
                {{ $isEdit ? 'Edit Promo' : 'Create New Promo' }}
            </h3>

            <form wire:submit.prevent="save" class="space-y-5">
                <div>
                    <label class="block text-[9px] uppercase tracking-widest text-gray-500 mb-2">Promo Code</label>
                    <input wire:model="code" type="text"
                        class="w-full border-[#e5e1da] focus:border-black focus:ring-0 text-sm p-3 uppercase bg-[#F9F8F6]/30 placeholder-gray-300"
                        placeholder="VOEUHAPPY">
                    @error('code')
                        <span class="text-red-500 text-[9px] mt-1 lowercase italic leading-none">{{ $message }}</span>
                    @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[9px] uppercase tracking-widest text-gray-500 mb-2">Type</label>
                        <select wire:model="type"
                            class="w-full border-[#e5e1da] focus:border-black focus:ring-0 text-sm p-3 bg-[#F9F8F6]/30">
                            <option value="fixed">IDR</option>
                            <option value="percent">%</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[9px] uppercase tracking-widest text-gray-500 mb-2">Value</label>
                        <input wire:model="value" type="number"
                            class="w-full border-[#e5e1da] focus:border-black focus:ring-0 text-sm p-3 bg-[#F9F8F6]/30">
                        @error('value')
                            <span class="text-red-500 text-[9px] mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-[9px] uppercase tracking-widest text-gray-500 mb-2">Usage Limit</label>
                    <input wire:model="limit" type="number"
                        class="w-full border-[#e5e1da] focus:border-black focus:ring-0 text-sm p-3 bg-[#F9F8F6]/30">
                    @error('limit')
                        <span class="text-red-500 text-[9px] mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block text-[9px] uppercase tracking-widest text-gray-500 mb-2">Expiry Date</label>
                    <input wire:model="expires_at" type="datetime-local"
                        class="w-full border-[#e5e1da] focus:border-black focus:ring-0 text-sm p-3 bg-[#F9F8F6]/30">
                </div>

                <div class="pt-4 space-y-3">
                    <button type="submit"
                        class="w-full bg-black text-white py-4 text-[10px] uppercase tracking-[0.3em] hover:bg-neutral-800 transition-all shadow-md active:scale-[0.98]">
                        {{ $isEdit ? 'Update Promo' : 'Save Promo' }}
                    </button>

                    @if ($isEdit)
                        <button type="button" wire:click="cancelEdit"
                            class="w-full bg-white text-gray-400 border border-[#e5e1da] py-4 text-[10px] uppercase tracking-[0.3em] hover:text-black transition-all">
                            Cancel
                        </button>
                    @endif
                </div>
            </form>
        </div>

        {{-- TABLE SECTION --}}
        <div class="lg:col-span-2 bg-white border border-[#e5e1da]/50 shadow-sm overflow-hidden h-fit">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-[#F9F8F6]/50 border-b border-[#e5e1da]/30">
                            <th class="p-6 text-[9px] uppercase tracking-widest text-gray-400 font-medium">Promo</th>
                            <th class="p-6 text-[9px] uppercase tracking-widest text-gray-400 font-medium">Limit</th>
                            <th class="p-6 text-[9px] uppercase tracking-widest text-gray-400 font-medium">Status</th>
                            <th class="p-6 text-[9px] uppercase tracking-widest text-gray-400 font-medium">Expiry</th>
                            <th class="p-6 text-[9px] uppercase tracking-widest text-gray-400 font-medium">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#e5e1da]/20">
                        @forelse ($promos as $promo)
                            <tr
                                class="hover:bg-[#F9F8F6]/50 transition-colors {{ !$promo->is_active ? 'opacity-50' : '' }}">
                                <td class="p-6">
                                    <div class="flex flex-col">
                                        <span
                                            class="text-sm font-medium tracking-wider text-black">{{ $promo->code }}</span>
                                        <span class="text-[10px] text-gray-400 italic">
                                            {{ $promo->type == 'fixed' ? 'Rp ' . number_format($promo->value, 0, ',', '.') : $promo->value . '%' }}
                                            OFF
                                        </span>
                                    </div>
                                </td>
                                <td class="p-6">
                                    <div class="flex items-center gap-3">
                                        <div class="w-12 h-1 bg-gray-100 rounded-full overflow-hidden">
                                            <div class="h-full bg-black"
                                                style="width: {{ $promo->limit > 0 ? ($promo->used / $promo->limit) * 100 : 0 }}%">
                                            </div>
                                        </div>
                                        <span
                                            class="text-[10px] text-gray-500 tracking-tighter">{{ $promo->used }}/{{ $promo->limit }}</span>
                                    </div>
                                </td>
                                <td class="p-6">
                                    <button wire:click="toggleStatus({{ $promo->id }})"
                                        class="text-[9px] uppercase tracking-[0.2em] font-bold {{ $promo->is_active ? 'text-green-500' : 'text-red-400' }}">
                                        {{ $promo->is_active ? '● Active' : '○ Inactive' }}
                                    </button>
                                </td>
                                <td class="p-6 text-[10px] text-gray-500 tracking-widest uppercase">
                                    {{ $promo->expires_at ? \Carbon\Carbon::parse($promo->expires_at)->format('d M y') : 'No Limit' }}
                                </td>
                                <td class="p-6">
                                    <div class="flex gap-4">
                                        <button wire:click="edit({{ $promo->id }})"
                                            class="text-black hover:underline text-[9px] uppercase tracking-widest">Edit</button>
                                        <button
                                            onclick="confirm('Yakin hapus promo?') || event.stopImmediatePropagation()"
                                            wire:click="delete({{ $promo->id }})"
                                            class="text-red-300 hover:text-red-600 text-[9px] uppercase tracking-widest">Delete</button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5"
                                    class="p-20 text-center text-[10px] uppercase tracking-[0.3em] text-gray-400">
                                    No promotional data found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($promos->hasPages())
                <div class="p-6 border-t border-[#e5e1da]/30">
                    {{ $promos->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

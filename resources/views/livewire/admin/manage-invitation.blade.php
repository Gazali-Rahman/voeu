<div class="space-y-8">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-utama tracking-widest uppercase">Manage Invitations</h1>
            <p class="text-[10px] text-gray-400 uppercase tracking-widest mt-1">Total {{ $invitations->total() }}
                Undangan Terdaftar</p>
        </div>

        <div class="flex items-center gap-4">
            <button wire:click="generatePreviews" wire:loading.attr="disabled"
                onclick="confirm('Apakah Anda yakin ingin men-generate ulang semua data demo?') || event.stopImmediatePropagation()"
                class="bg-black text-white px-6 py-2 text-[10px] tracking-[0.2em] uppercase hover:bg-gray-800 transition-all disabled:opacity-50 flex items-center gap-2">

                <span wire:loading.remove>+ Generate Previews</span>

                <span wire:loading class="flex items-center gap-2">
                    <svg class="animate-spin h-3 w-3 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                    Processing...
                </span>
            </button>

            <div class="relative">
                <input wire:model.live="search" type="text" placeholder="SEARCH SLUG..."
                    class="bg-white border border-[#e5e1da]/50 px-4 py-2 text-[10px] tracking-widest uppercase focus:outline-none focus:border-black transition-all w-64">
            </div>
        </div>
    </div>

    @if (session()->has('success'))
        <div class="bg-green-50 text-green-700 p-4 text-[10px] uppercase tracking-widest border-l-4 border-green-500">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-4 text-[10px] uppercase tracking-widest">
            {{ session('error') }}
        </div>
    @endif
    <div class="bg-white border border-[#e5e1da]/30 overflow-hidden shadow-sm">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-[#e5e1da]/30 bg-[#F9F8F6]/50">
                    <th class="px-6 py-4 text-[9px] uppercase tracking-[0.2em] font-semibold text-gray-500">Slug / Type
                    </th>
                    <th class="px-6 py-4 text-[9px] uppercase tracking-[0.2em] font-semibold text-gray-500">Mempelai
                    </th>
                    <th class="px-6 py-4 text-[9px] uppercase tracking-[0.2em] font-semibold text-gray-500">Template
                    </th>
                    <th class="px-6 py-4 text-[9px] uppercase tracking-[0.2em] font-semibold text-gray-500">Status</th>
                    <th class="px-6 py-4 text-[9px] uppercase tracking-[0.2em] font-semibold text-gray-500 text-right">
                        Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#e5e1da]/20">
                @forelse ($invitations as $item)
                    <tr class="hover:bg-[#F9F8F6]/30 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex flex-col">
                                <span class="text-[11px] font-medium tracking-wider">{{ $item->slug }}</span>
                                <span
                                    class="text-[8px] {{ str_starts_with($item->slug, 'demo-') ? 'text-amber-500' : 'text-gray-400' }} uppercase tracking-widest">
                                    {{ str_starts_with($item->slug, 'demo-') ? 'Demo Account' : 'Customer' }}
                                </span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-[10px] uppercase tracking-widest">
                            {{ $item->content['nama_pria'] ?? '-' }} & {{ $item->content['nama_wanita'] ?? '-' }}
                        </td>
                        <td class="px-6 py-4">
                            <span
                                class="text-[9px] bg-[#F9F8F6] px-2 py-1 border border-[#e5e1da]/50 uppercase tracking-widest">
                                {{ $item->catalog->name ?? 'N/A' }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-2">
                                <div
                                    class="w-1.5 h-1.5 rounded-full {{ $item->is_active ? 'bg-green-400' : 'bg-red-400' }}">
                                </div>
                                <span
                                    class="text-[9px] uppercase tracking-widest">{{ $item->is_active ? 'Active' : 'Inactive' }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-right space-x-3">
                            <a href="{{ route('invitation.v', $item->slug) }}" target="_blank"
                                class="text-[9px] uppercase tracking-widest text-gray-400 hover:text-black">View</a>

                            <a href="{{ route('invitation.create', $item->order_id ?? 0) }}"
                                class="text-[9px] uppercase tracking-widest text-blue-400 hover:text-blue-600">Edit</a>

                            <button
                                onclick="confirm('Hapus undangan dan semua file di storage?') || event.stopImmediatePropagation()"
                                wire:click="delete({{ $item->id }})"
                                class="text-[9px] uppercase tracking-widest text-red-300 hover:text-red-500 focus:outline-none">
                                Delete
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5"
                            class="px-6 py-10 text-center text-[10px] text-gray-400 uppercase tracking-widest">
                            No invitations found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $invitations->links() }}
    </div>
</div>

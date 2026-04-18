<div>
    <!-- Header Section -->
    <div class="mb-10 flex flex-col md:flex-row md:justify-between md:items-end gap-6">
        <div>
            <h2 class="text-3xl font-light tracking-tight text-gray-900">Catalog Management</h2>
            <p class="text-sm text-gray-500 mt-2 font-medium">Create, update and organize your products or templates</p>
        </div>

        <div class="flex items-center gap-4 w-full md:w-auto">
            <div class="relative group flex-1 md:flex-none">
                <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-400 group-focus-within:text-indigo-500 transition-colors"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="text" wire:model.live="search" placeholder="Search catalogs..."
                    class="bg-white border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-indigo-500 focus:border-indigo-500 block w-full md:w-80 pl-10 p-2.5 shadow-sm transition-all duration-300 hover:border-gray-300 outline-none">
            </div>

            <button wire:click="openModal"
                class="bg-indigo-600 whitespace-nowrap hover:bg-indigo-700 text-white font-medium py-2.5 px-5 rounded-xl shadow-sm transition-colors duration-200 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                <span class="hidden sm:inline">Add</span> Catalog
            </button>
        </div>
    </div>

    <!-- Alert Notifications -->
    @if (session()->has('message'))
        <div x-data="{ show: true }" x-show="show"
            class="mb-6 flex items-center p-4 bg-emerald-50 text-emerald-800 rounded-xl border border-emerald-100 shadow-sm"
            role="alert">
            <svg class="shrink-0 w-4 h-4 mr-3 text-emerald-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
            </svg>
            <span class="text-sm font-medium tracking-wide">{{ session('message') }}</span>
            <button @click="show = false" type="button"
                class="ml-auto -mx-1.5 -my-1.5 bg-emerald-50 text-emerald-500 rounded-lg focus:ring-2 focus:ring-emerald-400 p-1.5 hover:bg-emerald-100 inline-flex items-center justify-center h-8 w-8"
                aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>
    @endif

    @if (session()->has('error'))
        <div x-data="{ show: true }" x-show="show"
            class="mb-6 flex items-center p-4 bg-rose-50 text-rose-800 rounded-xl border border-rose-100 shadow-sm"
            role="alert">
            <span class="text-sm font-medium tracking-wide">{{ session('error') }}</span>
            <button @click="show = false" type="button"
                class="ml-auto -mx-1.5 -my-1.5 bg-rose-50 text-rose-500 rounded-lg p-1.5 hover:bg-rose-100 inline-flex items-center justify-center h-8 w-8">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>
    @endif

    <!-- Table Section -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/50 border-b border-gray-100">
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider w-16">Image
                        </th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Information
                        </th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Price</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider text-right">
                            Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($catalogs as $catalog)
                        <tr class="hover:bg-indigo-50/30 transition-colors duration-200 group">
                            <td class="px-6 py-4">
                                <img src="{{ asset('storage/' . $catalog->image) }}" alt="{{ $catalog->name }}"
                                    class="h-14 w-20 object-cover rounded-lg shadow-sm border border-gray-100">
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-col">
                                    <span class="text-sm font-semibold text-gray-900">{{ $catalog->name }}</span>
                                    <span
                                        class="text-xs text-gray-500 mt-0.5 truncate max-w-xs">{{ $catalog->description ?? 'No description' }}</span>
                                    @if ($catalog->preview_url)
                                        <a href="{{ route('invitation.v', 'demo-' . $catalog->slug) }}" target="_blank"
                                            class="text-[10px] uppercase tracking-widest text-indigo-600 hover:text-indigo-800 mt-2 flex items-center gap-1.5 transition-colors font-medium">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            View Live Demo
                                        </a>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm font-medium text-gray-900">Rp
                                    {{ number_format($catalog->price, 0, ',', '.') }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <button wire:click="toggleActive({{ $catalog->id }})" class="focus:outline-none">
                                    @if ($catalog->is_active)
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-50 text-emerald-600 border border-emerald-200 hover:bg-emerald-100 transition-colors">
                                            Active
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-600 border border-gray-200 hover:bg-gray-200 transition-colors">
                                            Inactive
                                        </span>
                                    @endif
                                </button>
                            </td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <button wire:click="edit({{ $catalog->id }})"
                                    class="inline-flex items-center justify-center p-2 text-indigo-400 hover:text-white hover:bg-indigo-500 rounded-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-indigo-200">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                </button>
                                <button wire:click="delete({{ $catalog->id }})"
                                    wire:confirm="Are you sure you want to delete this catalog? This action cannot be undone."
                                    class="inline-flex items-center justify-center p-2 text-rose-400 hover:text-white hover:bg-rose-500 rounded-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-rose-200">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-12 h-12 text-gray-300 mb-4" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                    </svg>
                                    <p class="text-sm text-gray-500 font-medium">No catalogs found matching your search
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($catalogs->hasPages())
            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/30">
                {{ $catalogs->links() }}
            </div>
        @endif
    </div>

    <!-- Modal Form for Create / Edit -->
    @if ($isModalOpen)
        <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog"
            aria-modal="true">
            <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                <!-- Background overlay -->
                <div class="fixed inset-0 bg-gray-900 bg-opacity-50 transition-opacity backdrop-blur-sm"
                    aria-hidden="true" wire:click="closeModal"></div>

                <!-- Modal panel -->
                <div
                    class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-2xl">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4 border-b border-gray-100">
                        <div class="sm:flex sm:items-start">
                            <div
                                class="mx-auto shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-indigo-100 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-indigo-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4" />
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                <h3 class="text-lg leading-6 font-semibold text-gray-900" id="modal-title">
                                    {{ $catalog_id ? 'Edit Catalog' : 'Add New Catalog' }}
                                </h3>
                                <p class="text-sm text-gray-500 mt-1">Fill in the information below to
                                    {{ $catalog_id ? 'update the' : 'create a new' }} catalog.</p>
                            </div>
                            <button type="button" wire:click="closeModal"
                                class="ml-auto bg-white rounded-md text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <span class="sr-only">Close</span>
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                    aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <form wire:submit.prevent="store">
                        <div class="px-4 py-5 sm:p-6 bg-gray-50/50 space-y-4 max-h-[65vh] overflow-y-auto">

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Name -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Catalog Name <span
                                            class="text-rose-500">*</span></label>
                                    <input type="text" wire:model.live="name" placeholder="E.g., Undangan Rustic"
                                        class="w-full bg-white border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-indigo-500 focus:border-indigo-500 p-2.5 shadow-sm outline-none">
                                    @error('name')
                                        <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Slug (Auto generated, readonly) -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Slug</label>
                                    <input type="text" wire:model="slug" readonly
                                        class="w-full bg-gray-100 border border-gray-200 text-gray-500 text-sm rounded-xl p-2.5 shadow-sm outline-none cursor-not-allowed">
                                    @error('slug')
                                        <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Description -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                                <textarea wire:model="description" rows="3" placeholder="Describe the catalog..."
                                    class="w-full bg-white border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-indigo-500 focus:border-indigo-500 p-2.5 shadow-sm outline-none"></textarea>
                                @error('description')
                                    <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Price -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Price (Rp) <span
                                            class="text-rose-500">*</span></label>
                                    <input type="number" wire:model="price" min="0"
                                        placeholder="E.g., 150000"
                                        class="w-full bg-white border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-indigo-500 focus:border-indigo-500 p-2.5 shadow-sm outline-none">
                                    @error('price')
                                        <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Preview URL -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Preview URL (Demo
                                        Link)</label>
                                    <input type="text" wire:model="preview_url"
                                        placeholder="silahkan masukkan id video"
                                        class="w-full bg-white border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-indigo-500 focus:border-indigo-500 p-2.5 shadow-sm outline-none">
                                    @error('preview_url')
                                        <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Image Upload -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Catalog Image @if (!$catalog_id)
                                        <span class="text-rose-500">*</span>
                                    @endif
                                </label>

                                <div
                                    class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl bg-white hover:bg-gray-50 transition-colors">
                                    <div class="space-y-1 text-center">
                                        @if ($image)
                                            <img src="{{ $image->temporaryUrl() }}"
                                                class="mx-auto h-32 w-auto object-cover rounded-lg mb-4">
                                        @elseif ($oldImage)
                                            <img src="{{ asset('storage/' . $oldImage) }}"
                                                class="mx-auto h-32 w-auto object-cover rounded-lg mb-4">
                                        @else
                                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor"
                                                fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                                <path
                                                    d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                                    stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                        @endif

                                        <div class="flex text-sm text-gray-600 justify-center">
                                            <label for="file-upload"
                                                class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500 px-2 py-1">
                                                <span>Upload a file</span>
                                                <input id="file-upload" type="file" wire:model="image"
                                                    class="sr-only" accept="image/*">
                                            </label>
                                            <p class="pl-1 py-1">or drag and drop</p>
                                        </div>
                                        <p class="text-xs text-gray-500">PNG, JPG, GIF up to 2MB</p>
                                        <div wire:loading wire:target="image"
                                            class="text-sm text-indigo-600 font-medium mt-2">Uploading...</div>
                                    </div>
                                </div>
                                @error('image')
                                    <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div class="flex items-center mt-4">
                                <input id="is_active" type="checkbox" wire:model="is_active"
                                    class="w-4 h-4 text-indigo-600 bg-gray-100 border-gray-300 rounded focus:ring-indigo-500 focus:ring-2">
                                <label for="is_active" class="ml-2 text-sm font-medium text-gray-900">Set as
                                    Active</label>
                                @error('is_active')
                                    <span class="text-rose-500 text-xs mt-1 block ml-2">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>

                        <div
                            class="bg-white px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse border-t border-gray-100 rounded-b-2xl">
                            <button type="submit"
                                class="w-full inline-flex justify-center rounded-xl border border-transparent shadow-sm px-5 py-2.5 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm transition-colors duration-200">
                                {{ $catalog_id ? 'Update Catalog' : 'Save Catalog' }}
                            </button>
                            <button type="button" wire:click="closeModal"
                                class="mt-3 w-full inline-flex justify-center rounded-xl border border-gray-300 shadow-sm px-5 py-2.5 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition-colors duration-200">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>

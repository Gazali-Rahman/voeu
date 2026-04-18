<div class="min-h-screen bg-[#fcfcfc] py-12 px-4 font-sans">
    <div class="max-w-5xl mx-auto">

        <div class="mb-12 border-b border-gray-100 pb-8">
            <h2 class="text-2xl font-serif text-[#1a1a1a] tracking-tight">Create Digital Invitation</h2>
            <p class="text-[10px] text-gray-400 uppercase tracking-[0.3em] mt-2">Project: Voeu — Order
                #{{ $order->id }}</p>
        </div>

        <form wire:submit.prevent="save" class="space-y-12">

            <div class="group">
                <label
                    class="block text-[9px] uppercase tracking-[0.2em] text-gray-400 mb-1 group-focus-within:text-black transition-colors">Personalized
                    URL (Slug)</label>
                <div class="flex items-center border-b border-gray-200 group-focus-within:border-black transition-all">
                    <span class="text-gray-300 text-sm pr-2">voeudigitalinvitation.com/</span>
                    <input type="text" wire:model="slug" readonly
                        class="w-full py-3 bg-transparent text-sm font-medium focus:outline-none text-gray-500 cursor-not-allowed">
                </div>
            </div>

            <div class="space-y-6">
                <h3 class="text-[11px] uppercase tracking-[0.3em] font-bold text-black border-l-2 border-black pl-3">
                    Mempelai Pria (Groom)</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-6">
                    <div class="group">
                        <label class="block text-[9px] uppercase tracking-[0.2em] text-gray-400 mb-1">Nama
                            Panggilan</label>
                        <input type="text" wire:model="nama_pria"
                            class="w-full py-2 bg-transparent border-b border-gray-200 focus:border-black focus:outline-none text-sm">
                        @error('nama_pria')
                            <span class="text-[8px] text-red-500 mt-1 uppercase">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="group">
                        <label class="block text-[9px] uppercase tracking-[0.2em] text-gray-400 mb-1">Nama Lengkap &
                            Gelar</label>
                        <input type="text" wire:model="nama_pria_lengkap"
                            class="w-full py-2 bg-transparent border-b border-gray-200 focus:border-black focus:outline-none text-sm">
                        @error('nama_pria_lengkap')
                            <span class="text-[8px] text-red-500 mt-1 uppercase">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="group">
                        <label class="block text-[9px] uppercase tracking-[0.2em] text-gray-400 mb-1">Label
                            Silsilah</label>
                        <input type="text" wire:model="label_ortu_pria"
                            class="w-full py-2 bg-transparent border-b border-gray-200 focus:border-black focus:outline-none text-sm">
                    </div>
                    <div class="group">
                        <label class="block text-[9px] uppercase tracking-[0.2em] text-gray-400 mb-1">Nama Orang
                            Tua</label>
                        <input type="text" wire:model="nama_ortu_pria"
                            class="w-full py-2 bg-transparent border-b border-gray-200 focus:border-black focus:outline-none text-sm">
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <h3 class="text-[11px] uppercase tracking-[0.3em] font-bold text-black border-l-2 border-black pl-3">
                    Mempelai Wanita (Bride)</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-6">
                    <div class="group">
                        <label class="block text-[9px] uppercase tracking-[0.2em] text-gray-400 mb-1">Nama
                            Panggilan</label>
                        <input type="text" wire:model="nama_wanita"
                            class="w-full py-2 bg-transparent border-b border-gray-200 focus:border-black focus:outline-none text-sm">
                        @error('nama_wanita')
                            <span class="text-[8px] text-red-500 mt-1 uppercase">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="group">
                        <label class="block text-[9px] uppercase tracking-[0.2em] text-gray-400 mb-1">Nama Lengkap &
                            Gelar</label>
                        <input type="text" wire:model="nama_wanita_lengkap"
                            class="w-full py-2 bg-transparent border-b border-gray-200 focus:border-black focus:outline-none text-sm">
                        @error('nama_wanita_lengkap')
                            <span class="text-[8px] text-red-500 mt-1 uppercase">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="group">
                        <label class="block text-[9px] uppercase tracking-[0.2em] text-gray-400 mb-1">Label
                            Silsilah</label>
                        <input type="text" wire:model="label_ortu_wanita"
                            class="w-full py-2 bg-transparent border-b border-gray-200 focus:border-black focus:outline-none text-sm">
                    </div>
                    <div class="group">
                        <label class="block text-[9px] uppercase tracking-[0.2em] text-gray-400 mb-1">Nama Orang
                            Tua</label>
                        <input type="text" wire:model="nama_ortu_wanita"
                            class="w-full py-2 bg-transparent border-b border-gray-200 focus:border-black focus:outline-none text-sm">
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <h3 class="text-[11px] uppercase tracking-[0.3em] font-bold text-black border-l-2 border-black pl-3">
                    Akad</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-10">

                    <div class="group">
                        <label class="block text-[9px] uppercase tracking-[0.2em] text-gray-400 mb-1">Tanggal
                            Akad</label>
                        <input type="datetime-local" wire:model="tanggal_akad"
                            class="w-full py-3 bg-transparent border-b border-gray-200 focus:border-black focus:outline-none text-sm">
                        @error('tanggal_akad')
                            <span class="text-[8px] text-red-500 mt-1 uppercase">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="group">
                        <label class="block text-[9px] uppercase tracking-[0.2em] text-gray-400 mb-1">Tempat Akad /
                            Venue</label>
                        <input type="text" wire:model="tempat_akad"
                            class="w-full py-3 bg-transparent border-b border-gray-200 focus:border-black focus:outline-none text-sm">
                        @error('tempat_akad')
                            <span class="text-[8px] text-red-500 mt-1 uppercase">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="group">
                        <label class="block text-[9px] uppercase tracking-[0.2em] text-gray-400 mb-1">Alamat Akad /
                            Venue</label>
                        <input type="text" wire:model="alamat_akad"
                            class="w-full py-3 bg-transparent border-b border-gray-200 focus:border-black focus:outline-none text-sm">
                        @error('alamat_akad')
                            <span class="text-[8px] text-red-500 mt-1 uppercase">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <h3 class="text-[11px] uppercase tracking-[0.3em] font-bold text-black border-l-2 border-black pl-3">
                    Resepsi</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                    <div class="group">
                        <label class="block text-[9px] uppercase tracking-[0.2em] text-gray-400 mb-1">Tanggal
                            Resepsi</label>
                        <input type="datetime-local" wire:model="tanggal_resepsi"
                            class="w-full py-3 bg-transparent border-b border-gray-200 focus:border-black focus:outline-none text-sm">
                        @error('tanggal_resepsi')
                            <span class="text-[8px] text-red-500 mt-1 uppercase">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="group">
                        <label class="block text-[9px] uppercase tracking-[0.2em] text-gray-400 mb-1">Tempat Resepsi /
                            Venue</label>
                        <input type="text" wire:model="tempat_resepsi"
                            class="w-full py-3 bg-transparent border-b border-gray-200 focus:border-black focus:outline-none text-sm">
                        @error('tempat_resepsi')
                            <span class="text-[8px] text-red-500 mt-1 uppercase">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="group">
                        <label class="block text-[9px] uppercase tracking-[0.2em] text-gray-400 mb-1">Alamat Resepsi /
                            Venue</label>
                        <input type="text" wire:model="alamat_resepsi"
                            class="w-full py-3 bg-transparent border-b border-gray-200 focus:border-black focus:outline-none text-sm">
                        @error('alamat_resepsi')
                            <span class="text-[8px] text-red-500 mt-1 uppercase">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="group">
                <label class="block text-[9px] uppercase tracking-[0.2em] text-gray-400 mb-1">Maps Resepsi /
                    Venue</label>
                <input type="text" wire:model="maps"
                    class="w-full py-3 bg-transparent border-b border-gray-200 focus:border-black focus:outline-none text-sm">
                @error('maps')
                    <span class="text-[8px] text-red-500 mt-1 uppercase">{{ $message }}</span>
                @enderror
            </div>
            <div class="space-y-6 pt-12 border-t border-gray-100">
                <div class="flex items-center justify-between border-b border-gray-100 pb-4">
                    <h3 class="text-[11px] uppercase tracking-[0.3em] font-bold text-black">Our Love Story</h3>
                    <button type="button" wire:click="addStory"
                        class="text-[10px] text-blue-600 uppercase tracking-widest hover:underline">+ Add
                        Story</button>
                </div>

                <div class="grid grid-cols-1 gap-4">
                    @foreach ($love_stories as $index => $story)
                        <div class="p-6 bg-white border border-gray-100 rounded-xl shadow-sm relative group">
                            <button type="button" wire:click="removeStory({{ $index }})"
                                class="absolute top-4 right-4 text-red-300 hover:text-red-500 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>

                            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                                <div class="md:col-span-1">
                                    <label class="text-[8px] uppercase tracking-widest text-gray-400 block mb-1">Year /
                                        Period</label>
                                    <input type="text" wire:model="love_stories.{{ $index }}.year"
                                        class="w-full border-b border-gray-100 focus:border-black outline-none text-[12px] py-1 bg-transparent"
                                        placeholder="e.g. 2024">
                                    @error("love_stories.$index.year")
                                        <span class="text-[8px] text-red-500 uppercase">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="md:col-span-3 space-y-4">
                                    <div>
                                        <label
                                            class="text-[8px] uppercase tracking-widest text-gray-400 block mb-1">Headline</label>
                                        <input type="text" wire:model="love_stories.{{ $index }}.title"
                                            class="w-full border-b border-gray-100 focus:border-black outline-none text-[12px] py-1 bg-transparent"
                                            placeholder="The First Meeting">
                                        @error("love_stories.$index.title")
                                            <span class="text-[8px] text-red-500 uppercase">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div>
                                        <label
                                            class="text-[8px] uppercase tracking-widest text-gray-400 block mb-1">Description</label>
                                        <textarea wire:model="love_stories.{{ $index }}.story" rows="2"
                                            class="w-full text-[12px] border border-gray-50 rounded-lg p-2 bg-gray-50/30 focus:bg-white focus:border-black outline-none transition-all"
                                            placeholder="Share the story..."></textarea>
                                        @error("love_stories.$index.story")
                                            <span class="text-[8px] text-red-500 uppercase">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="pt-6">
                <h3 class="text-[11px] uppercase tracking-[0.3em] font-bold text-black mb-4">Background Music</h3>
                <div class="p-6 bg-white border border-gray-100 rounded-xl shadow-sm space-y-4">
                    @if ($existing_music)
                        <div class="flex items-center gap-4 bg-gray-50 p-3 rounded-lg">
                            <span class="text-[10px] text-green-600 font-bold uppercase tracking-widest">Active
                                Track</span>
                            <audio controls class="h-8 flex-1">
                                <source src="{{ asset('storage/' . $existing_music) }}" type="audio/mpeg">
                            </audio>
                        </div>
                    @endif
                    <input type="file" wire:model="music_file"
                        class="text-[10px] block w-full text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-semibold file:bg-black file:text-white hover:file:bg-gray-800">
                    <div wire:loading wire:target="music_file"
                        class="text-[10px] text-blue-500 animate-pulse tracking-widest uppercase">Uploading Audio...
                    </div>
                    @error('music_file')
                        <span class="text-red-500 text-[8px] uppercase">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="space-y-6">
                <div class="flex items-center justify-between border-b border-gray-100 pb-4">
                    <h3 class="text-[11px] uppercase tracking-[0.3em] font-bold text-black">Photo Management</h3>
                    <button type="button" wire:click="addSlot"
                        class="text-[10px] text-blue-600 uppercase tracking-widest hover:underline">+ Add Slot</button>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach ($photo_slots as $index => $slot)
                        <div class="p-4 bg-white border border-gray-100 rounded-xl shadow-sm space-y-4 relative group">
                            <button type="button" wire:click="removeSlot({{ $index }})"
                                class="absolute top-2 right-2 text-red-400 hover:text-red-600 focus:outline-none">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                            <div>
                                <label class="text-[8px] uppercase tracking-widest text-gray-400 block mb-1">Label
                                    (e.g. Cover, Gallery 1)
                                </label>
                                <input type="text" wire:model="photo_slots.{{ $index }}.label"
                                    class="w-full border-b border-gray-100 focus:border-black outline-none text-[12px] py-1">
                                @error('photo_slots.' . $index . '.label')
                                    <span class="text-[8px] text-red-500 uppercase">{{ $message }}</span>
                                @enderror
                            </div>
                            <div
                                class="relative h-40 bg-gray-50 rounded-lg overflow-hidden border-2 border-dashed border-gray-100">
                                @if (isset($photo_slots[$index]['file']) && $photo_slots[$index]['file'])
                                    <img src="{{ $photo_slots[$index]['file']->temporaryUrl() }}"
                                        class="w-full h-full object-cover">
                                @elseif (isset($photo_slots[$index]['existing']) && $photo_slots[$index]['existing'])
                                    <img src="{{ asset('storage/' . $photo_slots[$index]['existing']) }}"
                                        class="w-full h-full object-cover">
                                @else
                                    <div class="flex flex-col items-center justify-center h-full text-gray-300">
                                        <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path d="M12 4v16m8-8H4"></path>
                                        </svg>
                                        <span class="text-[8px] uppercase tracking-widest">Select Image</span>
                                    </div>
                                @endif
                                <input type="file" wire:model="photo_slots.{{ $index }}.file"
                                    class="absolute inset-0 opacity-0 cursor-pointer">
                            </div>
                            @error('photo_slots.' . $index . '.file')
                                <span class="text-[8px] text-red-500 uppercase">{{ $message }}</span>
                            @enderror
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 mt-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="font-bold text-gray-800 uppercase tracking-wider text-sm">Wedding Gift
                        (Rekening/E-Wallet)</h3>
                    <button type="button" wire:click="addGift"
                        class="text-xs bg-black text-white px-4 py-2 rounded-lg hover:bg-gray-800 transition">
                        + Tambah Rekening
                    </button>
                </div>

                <div class="space-y-4">
                    @foreach ($gifts as $index => $gift)
                        <div class="p-4 bg-gray-50 rounded-xl border border-gray-100 relative group">
                            <button type="button" wire:click="removeGift({{ $index }})"
                                class="absolute -top-2 -right-2 z-10 bg-white shadow-sm border border-red-100 p-1.5 rounded-full text-red-400 hover:text-red-600 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                </svg>

                            </button>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1">Nama Bank /
                                        E-Wallet</label>
                                    <input type="text" wire:model="gifts.{{ $index }}.bank_name"
                                        placeholder="Contoh: Bank BCA, Mandiri, atau Dana"
                                        class="w-full bg-white border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-black transition">
                                </div>
                                <div>
                                    <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1">Nomor
                                        Rekening</label>
                                    <input type="text" wire:model="gifts.{{ $index }}.account_number"
                                        placeholder="Masukkan nomor rekening..."
                                        class="w-full bg-white border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-black transition">
                                </div>
                                <div>
                                    <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1">Atas Nama
                                        (Owner)
                                    </label>
                                    <input type="text" wire:model="gifts.{{ $index }}.account_name"
                                        placeholder="Masukkan nama pemilik rekening..."
                                        class="w-full bg-white border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-black transition">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="pt-12 flex items-center justify-between border-t border-gray-100">
                <a href="{{ route('admin.orders') }}"
                    class="text-[9px] uppercase tracking-[0.2em] text-gray-400 hover:text-black transition-colors underline decoration-gray-200 underline-offset-8">Discard
                    Changes</a>
                <button type="submit" wire:loading.attr="disabled"
                    class="bg-[#1a1a1a] text-white px-12 py-4 rounded-full text-[9px] uppercase tracking-[0.3em] hover:bg-black transition-all shadow-lg hover:shadow-2xl disabled:opacity-50 flex items-center gap-3">
                    <span wire:loading.remove>Publish Invitation</span>
                    <span wire:loading>Processing...</span>
                    <svg wire:loading.remove xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </button>
            </div>
        </form>
    </div>
</div>

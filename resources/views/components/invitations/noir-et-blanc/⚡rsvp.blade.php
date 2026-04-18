<?php

use Livewire\Component;
use App\Models\Rsvp;
use Livewire\Attributes\Validate;

new class extends Component {
    public $invitation;

    #[Validate('required|string|max:255')]
    public $name = '';

    #[Validate('required|in:hadir,berhalangan,ragu-ragu')]
    public $attendance = 'hadir'; // Default value

    #[Validate('required|string|min:5')]
    public $message = '';

    public function mount($invitation)
    {
        $this->invitation = $invitation;
    }

    public function submitRsvp()
    {
        $this->validate();

        Rsvp::create([
            'invitation_id' => $this->invitation->id,
            'name' => $this->name,
            'attendance' => $this->attendance,
            'message' => $this->message,
        ]);

        $this->reset(['name', 'message', 'attendance']);
        $this->attendance = 'hadir'; // Reset ke default

        session()->flash('success', 'Pesan Anda berhasil dikirim!');
    }

    public function render()
    {
        return view('components.invitations.noir-et-blanc.⚡rsvp', [
            'wishes' => $this->invitation->rsvps()->latest()->get(),
        ]);
    }
};
?>

<!-- Section: RSVP & Guest Book (The Engagement) -->
<div class="bg-white px-8 py-24 relative overflow-hidden" x-data="{ show: false }" x-intersect="show = true">

    <!-- Header Section -->
    <div class="mb-16 text-center" x-show="show" x-transition:enter="transition duration-1000">
        <span class="font-serif italic text-xs text-gray-400 tracking-[0.4em] uppercase">Reservation</span>
        <h2 class="font-vogue text-4xl text-black tracking-tighter uppercase mt-2">Guest Book</h2>
        <p class="font-light text-[10px] text-gray-400 uppercase tracking-[0.2em] mt-4">Mohon konfirmasi kehadiran Anda
        </p>
    </div>

    <!-- RSVP Form Card -->
    <div class="relative z-10 bg-[#f9f9f9] rounded-4xl p-8 shadow-sm border border-black/3" x-show="show"
        x-transition:enter="transition ease-out duration-1000 delay-200">

        @if (session()->has('success'))
            <div class="mb-6 text-center p-4 bg-black text-white text-[10px] uppercase tracking-widest rounded-xl">
                {{ session('success') }}
            </div>
        @endif

        <form wire:submit.prevent="submitRsvp" class="space-y-10">
            <div class="relative group">
                <label
                    class="font-vogue text-[10px] tracking-[0.3em] uppercase text-gray-400 group-focus-within:text-black transition-colors">Nama
                    Lengkap</label>
                <input type="text" wire:model="name"
                    class="w-full bg-transparent border-b border-black/10 py-3 font-light text-sm focus:outline-none focus:border-black transition-all placeholder:text-gray-200"
                    placeholder="Masukkan nama Anda...">
                @error('name')
                    <span class="text-[9px] text-red-500 uppercase tracking-tighter">{{ $message }}</span>
                @enderror
            </div>

            <div class="space-y-4">
                <label class="font-vogue text-[10px] tracking-[0.3em] uppercase text-gray-400">Kehadiran</label>
                <div class="flex flex-wrap gap-4">
                    <label class="flex-1 min-w-[100px] relative cursor-pointer group">
                        <input type="radio" wire:model="attendance" value="hadir" class="peer hidden">
                        <div
                            class="py-3 text-center border border-black/10 rounded-full text-[9px] uppercase tracking-widest peer-checked:bg-black peer-checked:text-white transition-all">
                            Akan Hadir
                        </div>
                    </label>
                    <label class="flex-1 min-w-[100px] relative cursor-pointer group">
                        <input type="radio" wire:model="attendance" value="berhalangan" class="peer hidden">
                        <div
                            class="py-3 text-center border border-black/10 rounded-full text-[9px] uppercase tracking-widest peer-checked:bg-black peer-checked:text-white transition-all">
                            Berhalangan
                        </div>
                    </label>
                    <label class="flex-1 min-w-[100px] relative cursor-pointer group">
                        <input type="radio" wire:model="attendance" value="ragu-ragu" class="peer hidden">
                        <div
                            class="py-3 text-center border border-black/10 rounded-full text-[9px] uppercase tracking-widest peer-checked:bg-black peer-checked:text-white transition-all">
                            Ragu-ragu
                        </div>
                    </label>
                </div>
                @error('attendance')
                    <span class="text-[9px] text-red-500 uppercase tracking-tighter">{{ $message }}</span>
                @enderror
            </div>

            <div class="relative group">
                <label class="font-vogue text-[10px] tracking-[0.3em] uppercase text-gray-400">Pesan & Doa</label>
                <textarea rows="3" wire:model="message"
                    class="w-full bg-transparent border-b border-black/10 py-3 font-light text-sm focus:outline-none focus:border-black transition-all resize-none placeholder:text-gray-200"
                    placeholder="Tuliskan pesan manis Anda..."></textarea>
                @error('message')
                    <span class="text-[9px] text-red-500 uppercase tracking-tighter">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" wire:loading.attr="disabled"
                class="w-full bg-black text-white font-vogue text-[11px] tracking-[0.4em] py-5 uppercase hover:bg-gray-900 transition-all active:scale-[0.98] disabled:opacity-50 disabled:cursor-not-allowed">
                <span wire:loading.remove>Kirim Pesan</span>
                <span wire:loading>Mengirim...</span>
            </button>
        </form>
    </div>

    <!-- Message Display (Guest Comments) -->
    <div class="mt-20 space-y-8" x-show="show" x-transition:enter="transition duration-1000 delay-500">
        <div class="flex items-center gap-4">
            <div class="h-[0.5px] flex-1 bg-black/10"></div>
            <span class="font-serif italic text-xs text-gray-400">Recent Wishes</span>
            <div class="h-[0.5px] flex-1 bg-black/10"></div>
        </div>

        <div class="space-y-6 max-h-[500px] overflow-y-auto pr-2 custom-scrollbar">
            @forelse($wishes as $wish)
                <div class="border-b border-black/5 pb-6 last:border-0" wire:key="wish-{{ $wish->id }}">
                    <h4 class="font-vogue text-xs tracking-widest uppercase text-black">{{ $wish->name }}</h4>
                    <p class="font-serif italic text-[9px] text-gray-400 mt-1 uppercase tracking-tighter">
                        @if ($wish->attendance === 'hadir')
                            Akan Hadir
                        @elseif($wish->attendance === 'berhalangan')
                            Berhalangan
                        @else
                            Masih Ragu-ragu
                        @endif
                    </p>
                    <p class="font-light text-[11px] text-gray-600 leading-relaxed mt-3 uppercase tracking-wider">
                        "{{ $wish->message }}"
                    </p>
                    <span
                        class="text-[8px] text-gray-300 uppercase mt-2 block tracking-widest">{{ $wish->created_at->diffForHumans() }}</span>
                </div>
            @empty
                <div class="text-center py-10">
                    <p class="font-serif italic text-[10px] text-gray-400 uppercase tracking-widest">Belum ada ucapan.
                    </p>
                </div>
            @endforelse
        </div>
    </div>
</div>

<style>
    .custom-scrollbar::-webkit-scrollbar {
        width: 2px;
    }

    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #000;
    }
</style>

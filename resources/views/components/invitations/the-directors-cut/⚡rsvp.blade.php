<?php

use Livewire\Component;
use App\Models\rsvp;

new class extends Component {
    public $invitation;
    public $name, $attendance, $message;

    // Properti untuk menampung daftar ucapan
    public $wishes = [];

    public function mount($invitation)
    {
        $this->invitation = $invitation;
        $this->loadWishes();
    }

    public function loadWishes()
    {
        // Ambil data dari database berdasarkan ID undangan
        // Jika belum ada tabelnya, sementara gunakan data dummy atau query model
        $this->wishes = rsvp::where('invitation_id', $this->invitation->id)->latest()->get();
    }

    public function send()
    {
        $this->validate([
            'name' => 'required|min:3',
            'attendance' => 'required|in:hadir,berhalangan,ragu-ragu',
            'message' => 'required|min:5',
        ]);

        // Bersihkan nama dan pesan
        $cleanName = \App\Helpers\WordFilter::clean($this->name);
        $cleanMessage = \App\Helpers\WordFilter::clean($this->message);
        // Simpan ke database
        rsvp::create([
            'invitation_id' => $this->invitation->id,
            'name' => $cleanName,
            'attendance' => $this->attendance,
            'message' => $cleanMessage,
        ]);

        // Reset form
        $this->reset(['name', 'attendance', 'message']);

        // Refresh daftar ucapan
        $this->loadWishes();

        // Opsional: Tambahkan notifikasi
        session()->flash('success', 'Ucapan berhasil dikirim!');
    }
};
?>

<section class="py-24 px-6 relative overflow-hidden min-h-screen">



    <div class="relative mb-16 text-center">
        <h2 class="font-abigail text-5xl text-black/80 mb-3">RSVP</h2>
        <div class="flex justify-center items-center gap-3">
            <div class="h-px w-8 bg-black/20"></div>
            <p class="font-mono text-[9px] tracking-[0.4em] uppercase text-black/40">Confirm Presence</p>
            <div class="h-px w-8 bg-black/20"></div>
        </div>
    </div>

    <div class="relative z-10 bg-white/30 backdrop-blur-sm border border-black/5 p-8 mb-20 shadow-sm">
        <form wire:submit.prevent="send" class="space-y-8">

            <div class="relative">
                <label class="font-mono text-[10px] uppercase tracking-widest text-black/40 mb-2 block">Your
                    Name</label>
                <input type="text" wire:model="name"
                    class="w-full bg-transparent border-b border-black/10 py-2 focus:border-black transition-colors outline-none font-light text-sm tracking-tight"
                    placeholder="Enter full name...">
                @error('name')
                    <span class="text-[9px] font-mono text-red-400 mt-1 uppercase">{{ $message }}</span>
                @enderror
            </div>

            <div class="relative">
                <label
                    class="font-mono text-[10px] uppercase tracking-widest text-black/40 mb-3 block">Attendance</label>
                <div class="grid grid-cols-1 gap-3">
                    @foreach (['hadir' => 'HADIR', 'berhalangan' => 'BERHALANGAN', 'ragu-ragu' => 'RAGU-RAGU'] as $value => $label)
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="radio" wire:model="attendance" value="{{ $value }}"
                                class="hidden peer">
                            <div
                                class="w-4 h-4 border border-black/20 rounded-full flex items-center justify-center peer-checked:border-black transition-all">
                                <div
                                    class="w-2 h-2 bg-black rounded-full scale-0 peer-checked:scale-100 transition-transform duration-300">
                                </div>
                            </div>
                            <span
                                class="font-mono text-[11px] uppercase tracking-wider text-black/50 peer-checked:text-black transition-colors">{{ $label }}</span>
                        </label>
                    @endforeach
                </div>
                @error('attendance')
                    <span class="text-[9px] font-mono text-red-400 mt-1 uppercase">{{ $message }}</span>
                @enderror
            </div>

            <div class="relative">
                <label class="font-mono text-[10px] uppercase tracking-widest text-black/40 mb-2 block">Wishes &
                    Message</label>
                <textarea wire:model="message" rows="4"
                    class="w-full bg-transparent border border-black/10 p-4 focus:border-black transition-colors outline-none font-light text-sm leading-relaxed"
                    placeholder="Write your heartfelt wishes here..."></textarea>
                @error('message')
                    <span class="text-[9px] font-mono text-red-400 mt-1 uppercase">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" wire:loading.attr="disabled"
                class="w-full bg-black text-white py-4 font-mono text-[10px] uppercase tracking-[0.3em] hover:bg-zinc-800 transition-all flex items-center justify-center gap-2 group">
                <span wire:loading.remove>Send Confirmation</span>
                <span wire:loading>Processing...</span>
                <svg wire:loading.remove class="w-3 h-3 group-hover:translate-x-1 transition-transform" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3">
                    </path>
                </svg>
            </button>

            @if (session()->has('success'))
                <div
                    class="bg-black/5 text-black/70 font-mono text-[9px] uppercase p-4 text-center tracking-widest animate-pulse">
                    {{ session('success') }}
                </div>
            @endif
        </form>
    </div>

    <div class="space-y-12">
        <div class="flex items-center justify-between border-b border-black/10 pb-4">
            <h3 class="font-abigail text-2xl text-black/70">Wishes</h3>
            <span class="font-mono text-[9px] text-black/30 tracking-widest uppercase">{{ count($wishes) }} Messages
                Received</span>
        </div>

        <div class="grid grid-cols-1 gap-10 max-h-[600px] overflow-y-auto pr-2 custom-scrollbar">
            @forelse($wishes as $wish)
                <div class="relative flex flex-col gap-3 group" wire:key="wish-{{ $wish->id }}">
                    <div class="flex justify-between items-baseline">
                        <h4 class="font-mono text-[11px] font-bold uppercase tracking-wider text-black/80">
                            {{ $wish->name }}
                        </h4>
                        <span class="font-mono text-[8px] text-black/30 uppercase tracking-tighter">
                            {{ $wish->created_at->diffForHumans() }}
                        </span>
                    </div>

                    <div>
                        <span
                            class="text-[8px] font-mono uppercase tracking-[0.2em] px-2 py-0.5 border border-black/10 text-black/40">
                            {{ $wish->attendance }}
                        </span>
                    </div>

                    <p class="text-sm text-black/60 font-light leading-relaxed tracking-tight text-justify">
                        {{ $wish->message }}
                    </p>

                    <div class="w-8 h-px bg-black/10 mt-2 group-hover:w-full transition-all duration-700"></div>
                </div>
            @empty
                <div class="text-center py-10">
                    <p class="font-mono text-[9px] uppercase tracking-widest text-black/20">No messages yet.</p>
                </div>
            @endforelse
        </div>
    </div>

    <div class="mt-20 pt-10 border-t border-black/5 flex justify-center">
        <div class="flex flex-col items-center gap-4">
            <div class="w-px h-12 bg-black/10"></div>
            <p class="font-mono text-[8px] tracking-[0.4em] uppercase text-black/20">End of Record</p>
        </div>
    </div>

</section>

<style>
    .custom-scrollbar::-webkit-scrollbar {
        width: 2px;
    }

    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: rgba(0, 0, 0, 0.05);
    }
</style>

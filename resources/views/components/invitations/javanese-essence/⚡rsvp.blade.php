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

        // Simpan ke database
        rsvp::create([
            'invitation_id' => $this->invitation->id,
            'name' => $this->name,
            'attendance' => $this->attendance,
            'message' => $this->message,
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

<section class="relative flex flex-col py-24 overflow-hidden max-w-md mx-auto">
    <div class="relative w-full mb-20 flex flex-col items-start px-6">
        <h3
            class="absolute -top-10 left-4 font-abigail text-[#5a3a2e]/5 text-[5rem] leading-none pointer-events-none uppercase">
            Wishes</h3>
        <div class="relative z-10 mt-6 ml-4">
            <h2 class="font-abigail text-[#5a3a2e] text-[4rem] leading-[0.8] tracking-tighter drop-shadow-sm">
                RSVP & <br> <span class="ml-12 border-b border-[#5a3a2e]/10">Wishes</span>
            </h2>
        </div>
    </div>

    <div class="relative mx-6 p-8 bg-white shadow-2xl border border-[#5a3a2e]/5 rounded-sm overflow-hidden">
        {{-- Background Siluet --}}
        <div class="absolute -top-5 left-1/2 -translate-x-1/2 w-full opacity-10 pointer-events-none rotate-180">
            <img src="{{ asset('assets/png/javaneseessence/bgawan.png') }}" class="w-full">
        </div>

        @if (session()->has('success'))
            <div
                class="mb-4 p-3 bg-green-50 text-green-700 text-[10px] font-poppins uppercase tracking-widest text-center">
                {{ session('success') }}
            </div>
        @endif

        <form wire:submit.prevent="send" class="relative z-10 space-y-6">
            @csrf
            <div class="space-y-2">
                <label class="font-poppins text-[10px] uppercase tracking-[0.2em] text-[#5a3a2e]/60 ml-1">Nama
                    Lengkap</label>
                <input wire:model="name" type="text" placeholder="Masukkan Nama Anda"
                    class="w-full bg-transparent border-b border-[#5a3a2e]/20 py-3 px-1 font-poppins text-xs focus:outline-none focus:border-[#5a3a2e] transition-all placeholder:opacity-30">
                @error('name')
                    <span class="text-[9px] text-red-400 font-poppins italic">{{ $message }}</span>
                @enderror
            </div>

            <div class="space-y-2">
                <label class="font-poppins text-[10px] uppercase tracking-[0.2em] text-[#5a3a2e]/60 ml-1">Konfirmasi
                    Kehadiran</label>
                <select wire:model="attendance"
                    class="w-full bg-transparent border-b border-[#5a3a2e]/20 py-3 px-1 font-poppins text-xs focus:outline-none focus:border-[#5a3a2e] appearance-none cursor-pointer">
                    <option value="">Pilih Kehadiran</option>
                    <option value="hadir">Hadir</option>
                    <option value="berhalangan">Tidak Hadir</option>
                </select>
                @error('attendance')
                    <span class="text-[9px] text-red-400 font-poppins italic">{{ $message }}</span>
                @enderror
            </div>

            <div class="space-y-2">
                <label class="font-poppins text-[10px] uppercase tracking-[0.2em] text-[#5a3a2e]/60 ml-1">Ucapan &
                    Doa</label>
                <textarea wire:model="message" rows="4" placeholder="Tuliskan ucapan terbaik..."
                    class="w-full bg-[#fdfaf7]/50 border border-[#5a3a2e]/10 p-4 font-poppins text-xs focus:outline-none focus:border-[#5a3a2e] transition-all placeholder:opacity-30 rounded-sm"></textarea>
                @error('message')
                    <span class="text-[9px] text-red-400 font-poppins italic">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" wire:loading.attr="disabled"
                class="w-full bg-[#2d1e18] py-4 flex items-center justify-center gap-3 group transition-all active:scale-[0.98]">
                <span wire:loading.remove class="font-poppins text-[10px] tracking-[0.4em] uppercase text-white">Send
                    Wishes</span>
                <span wire:loading
                    class="font-poppins text-[10px] tracking-[0.4em] uppercase text-white animate-pulse">Sending...</span>
                <div class="w-4 h-[0.5px] bg-white/50 group-hover:w-8 transition-all"></div>
            </button>
        </form>
    </div>

    <div class="mt-16 px-6 space-y-6">
        <div class="flex items-center gap-4 px-2">
            <h4 class="font-abigail text-xl text-[#5a3a2e]">Wishes</h4>
            <div class="h-[0.5px] flex-1 bg-[#5a3a2e]/10"></div>
        </div>

        <div class="max-h-[500px] overflow-y-auto pr-2 space-y-4 custom-scrollbar">
            @forelse ($wishes as $wish)
                <div class="p-5 bg-white shadow-sm border border-[#5a3a2e]/5 rounded-sm">
                    <div class="flex justify-between items-start mb-3">
                        {{-- Sesuaikan $wish->name (bukan nama) --}}
                        <h5 class="font-abigail text-lg text-[#5a3a2e]">{{ $wish->name }}</h5>

                        {{-- Sesuaikan $wish->attendance (bukan kehadiran) --}}
                        <span
                            class="text-[7px] font-poppins uppercase tracking-widest {{ $wish->attendance == 'hadir' ? 'text-green-600' : 'text-red-400' }} opacity-60">
                            {{ $wish->attendance }}
                        </span>
                    </div>

                    {{-- Sesuaikan $wish->message (bukan pesan) --}}
                    <p class="font-poppins text-[11px] text-[#5a3a2e]/70 leading-relaxed italic">
                        "{{ $wish->message }}"
                    </p>

                    <div class="mt-3 flex justify-end">
                        <span class="text-[7px] font-poppins uppercase tracking-tighter opacity-30">
                            {{ $wish->created_at ? $wish->created_at->diffForHumans() : 'Baru saja' }}
                        </span>
                    </div>
                </div>
            @empty
                <p class="text-center font-poppins text-[10px] opacity-30 py-10 uppercase tracking-widest">
                    Belum ada ucapan
                </p>
            @endforelse
        </div>
    </div>
</section>

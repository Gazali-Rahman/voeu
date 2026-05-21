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
<div>
    <style>
        .custom-scroll::-webkit-scrollbar {
            width: 4px;
        }

        .custom-scroll::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scroll::-webkit-scrollbar-thumb {
            background: #3E2C2330;
            border-radius: 10px;
        }
    </style>

    <div class="py-20 px-6 relative flex flex-col items-center overflow-hidden">

        <div class="text-center z-10 mb-10">
            <p class="text-[9px] font-['Poppins'] text-[#3E2C23]/60 uppercase tracking-[0.5em] mb-3">
                Confirmation
            </p>
            <h2 class="text-4xl font-['Abigail'] text-[#3E2C23] drop-shadow-sm">RSVP</h2>
        </div>

        <div class="absolute top-1/4 -right-20 transform rotate-90 origin-center z-0 opacity-[0.03] pointer-events-none">
            <span class="text-[8rem] font-['Abigail'] text-[#3E2C23] whitespace-nowrap">Will You Come?</span>
        </div>

        <div
            class="w-full max-w-sm relative bg-[#F5EBE1] border border-[#3E2C23]/20 rounded-[2.5rem] shadow-xl p-8 z-10 overflow-hidden">

            <div class="absolute -bottom-6 -left-6 w-30 z-0   pointer-events-none">
                <img src="{{ asset('assets/png/rusticbeige/bunga1.png') }}" alt="Bunga" class="w-full object-cover">
            </div>
            <div class="absolute -top-6 -right-6 w-30 z-0 -rotate-90  pointer-events-none ">
                <img src="{{ asset('assets/png/rusticbeige/bunga3.png') }}" alt="Bunga" class="w-full object-cover">
            </div>

            <div class="relative z-10">

                @if (session()->has('success'))
                    <div
                        class="mb-6 p-4 rounded-2xl bg-green-50 border border-green-200 text-center transition-all duration-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6 text-green-600 mx-auto mb-2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-[10px] font-['Poppins'] text-green-800 leading-relaxed">
                            {{ session('success') }}
                        </p>
                    </div>
                @endif

                <form wire:submit.prevent="send" class="flex flex-col gap-5">

                    <div class="flex flex-col">
                        <label
                            class="text-[9px] font-['Poppins'] text-[#3E2C23]/80 uppercase tracking-widest mb-2 font-medium">Nama
                            Lengkap</label>
                        <input type="text" wire:model.defer="name" placeholder="Tulis nama Anda..."
                            class="w-full px-4 py-3 bg-white/70 backdrop-blur-sm border border-[#3E2C23]/20 rounded-2xl text-[11px] font-['Poppins'] text-[#3E2C23] placeholder:text-[#3E2C23]/40 focus:outline-none focus:border-[#3E2C23]/50 focus:ring-1 focus:ring-[#3E2C23]/50 transition-all">
                        @error('name')
                            <span class="text-red-500 text-[9px] mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex flex-col">
                        <label
                            class="text-[9px] font-['Poppins'] text-[#3E2C23]/80 uppercase tracking-widest mb-2 font-medium">Kehadiran</label>
                        <div class="grid grid-cols-2 gap-2">
                            <label class="cursor-pointer relative">
                                <input type="radio" wire:model.defer="attendance" value="hadir" class="peer sr-only">
                                <div
                                    class="w-full py-3 rounded-2xl border border-[#3E2C23]/20 bg-white/70 backdrop-blur-sm flex items-center justify-center text-[9px] font-['Poppins'] text-[#3E2C23]/70 peer-checked:bg-[#3E2C23] peer-checked:border-[#3E2C23] peer-checked:text-white transition-all duration-300">
                                    Hadir
                                </div>
                            </label>
                            <label class="cursor-pointer relative">
                                <input type="radio" wire:model.defer="attendance" value="berhalangan"
                                    class="peer sr-only">
                                <div
                                    class="w-full py-3 rounded-2xl border border-[#3E2C23]/20 bg-white/70 backdrop-blur-sm flex items-center justify-center text-[9px] font-['Poppins'] text-[#3E2C23]/70 peer-checked:bg-[#3E2C23] peer-checked:border-[#3E2C23] peer-checked:text-white transition-all duration-300 text-center leading-tight">
                                    Tidak Hadir
                                </div>
                            </label>
                        </div>
                        @error('attendance')
                            <span class="text-red-500 text-[9px] mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex flex-col">
                        <label
                            class="text-[9px] font-['Poppins'] text-[#3E2C23]/80 uppercase tracking-widest mb-2 font-medium">Pesan
                            & Doa Restu</label>
                        <textarea wire:model.defer="message" rows="3" placeholder="Tuliskan ucapan atau doa..."
                            class="w-full px-4 py-3 bg-white/70 backdrop-blur-sm border border-[#3E2C23]/20 rounded-2xl text-[11px] font-['Poppins'] text-[#3E2C23] placeholder:text-[#3E2C23]/40 focus:outline-none focus:border-[#3E2C23]/50 focus:ring-1 focus:ring-[#3E2C23]/50 transition-all resize-none"></textarea>
                        @error('message')
                            <span class="text-red-500 text-[9px] mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit"
                        class="w-full py-4 mt-2 rounded-full bg-[#3E2C23] text-white text-[10px] font-['Poppins'] uppercase tracking-[0.3em] hover:bg-[#2A1E17] transition-all duration-300 shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#3E2C23] disabled:opacity-50 flex justify-center items-center gap-2"
                        wire:loading.attr="disabled" wire:target="send">
                        <span wire:loading.remove wire:target="send">Kirim Ucapan</span>

                        <svg wire:loading wire:target="send" class="animate-spin h-4 w-4 text-white"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                        <span wire:loading wire:target="send">Mengirim...</span>
                    </button>
                </form>

            </div>
        </div>
        <div class="w-full max-w-sm relative z-10 mt-16">

            <div class="text-center mb-8 flex flex-col items-center">
                <h3 class="text-3xl font-['Abigail'] text-[#3E2C23] mb-2">Guestbook</h3>
                <div class="w-10 h-px bg-[#3E2C23]/20 mb-3"></div>
                <p class="text-[9px] font-['Poppins'] text-[#3E2C23]/60 uppercase tracking-[0.3em]">
                    Pesan & Doa Restu
                </p>
            </div>

            <div class="flex flex-col gap-5 max-h-[400px] overflow-y-auto custom-scroll p-2">

                @forelse($wishes as $wish)
                    <div
                        class="bg-[#F5EBE1] border border-[#3E2C23]/10 rounded-3xl p-5 shadow-sm hover:shadow-md transition-shadow duration-300 relative shrink-0">

                        <div class="flex justify-between items-start mb-3 relative z-10">
                            <h4 class="text-[11px] font-semibold font-['Poppins'] text-[#3E2C23]">
                                {{ $wish->name }}
                            </h4>

                            @if ($wish->attendance === 'hadir')
                                <span
                                    class="text-[8px] font-['Poppins'] bg-green-50 text-green-600 border border-green-100 px-2.5 py-1 rounded-full uppercase tracking-wider font-medium">Hadir</span>
                            @elseif($wish->attendance === 'ragu-ragu')
                                <span
                                    class="text-[8px] font-['Poppins'] bg-yellow-50 text-yellow-600 border border-yellow-100 px-2.5 py-1 rounded-full uppercase tracking-wider font-medium">Ragu</span>
                            @else
                                <span
                                    class="text-[8px] font-['Poppins'] bg-red-50 text-red-600 border border-red-100 px-2.5 py-1 rounded-full uppercase tracking-wider font-medium">Berhalangan</span>
                            @endif
                        </div>

                        <p class="text-[10px] font-['Poppins'] text-[#3E2C23]/70 leading-relaxed relative z-10">
                            {{ $wish->message }}
                        </p>

                        <p
                            class="text-[8px] font-['Poppins'] text-[#3E2C23]/40 mt-4 pt-3 border-t border-[#3E2C23]/5 relative z-10">
                            {{ $wish->created_at ? $wish->created_at->diffForHumans() : '' }}
                        </p>
                    </div>
                @empty
                    <div class="text-center py-10">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1"
                            stroke="currentColor" class="w-8 h-8 text-[#3E2C23]/20 mx-auto mb-3">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 11.25v8.25a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5v-8.25M12 4.875A2.625 2.625 0 109.375 7.5H12m0-2.625V7.5m0-2.625A2.625 2.625 0 1114.625 7.5H12m0 0V21m-8.625-9.75h18c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125h-18c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                        </svg>
                        <p class="text-[10px] font-['Poppins'] text-[#3E2C23]/50 italic">Belum ada ucapan. Jadilah yang
                            pertama memberikan doa!</p>
                    </div>
                @endforelse

            </div>
        </div>

    </div>
</div>

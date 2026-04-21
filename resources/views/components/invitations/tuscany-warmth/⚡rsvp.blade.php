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

<div class="py-10 overflow-hidden ">
    <div class="max-w-2xl mx-auto">

        <!-- Header Section (High-End Editorial) -->
        <div x-data="{ show: false }" x-intersect="show = true" class="mb-10">
            <div x-show="show" x-transition:enter="transition ease-out duration-1000" class="relative">
                <div class="flex flex-col px-2">
                    <div class="relative inline-block">
                        <h2 class="font-utama text-black text-5xl  leading-[0.8] z-10 relative lowercase italic">
                            Guest</h2>
                        <h2
                            class="font-utama text-[#8C5A3C] text-5xl  leading-[0.8] tracking-tighter uppercase mt-2 ml-12 opacity-90">
                            Book</h2>
                    </div>
                </div>
                <div class="absolute -left-4 top-10 w-px h-24 bg-gray-100"></div>
                <p
                    class="font-poppins text-[9px] tracking-[0.3em] text-gray-400 uppercase mt-5 ml-2 dark:text-gray-500">
                    A collection of <br> beautiful memories & wishes.
                </p>
            </div>
        </div>

        <div class="space-y-2">
            <div x-data="{ show: false }" x-intersect="show = true"
                class="bg-[#8C5A3C] p-10 rounded-3xl shadow-md transition-all duration-1000 relative overflow-hidden"
                :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">

                <form wire:submit.prevent="send" class="space-y-8 relative z-10">

                    <div class="space-y-3">
                        <label
                            class="font-poppins text-[10px] tracking-[0.2em] text-white/70 uppercase ml-1 font-semibold">Your
                            Name</label>
                        <input type="text" wire:model="name" placeholder="Write your name..."
                            class="w-full bg-white/10 border border-white/20 rounded-2xl px-6 py-4 focus:ring-2 focus:ring-white/30 outline-none transition-all font-poppins text-sm text-white placeholder:text-white/30">
                        @error('name')
                            <span class="text-xs text-red-200 mt-1 ml-2 italic">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="space-y-3">
                        <label
                            class="font-poppins text-[10px] tracking-[0.2em] text-white/70 uppercase ml-1 font-semibold">Attendance</label>
                        <div class="relative">
                            <select wire:model="attendance"
                                class="w-full bg-white/10 border border-white/20 rounded-2xl px-6 py-4 focus:ring-2 focus:ring-white/30 outline-none transition-all font-poppins text-sm text-white appearance-none cursor-pointer">
                                <option value="" class="text-black">Pilih Kehadiran</option>
                                <option value="hadir" class="text-black">Akan Hadir</option>
                                <option value="ragu-ragu" class="text-black">Masih Ragu</option>
                                <option value="berhalangan" class="text-black">Berhalangan Hadir</option>
                            </select>
                            <div
                                class="absolute right-6 top-1/2 -translate-y-1/2 pointer-events-none text-white/40 text-[10px]">
                                ▼</div>
                        </div>
                        @error('attendance')
                            <span class="text-xs text-red-200 mt-1 ml-2 italic">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="space-y-3">
                        <label
                            class="font-poppins text-[10px] tracking-[0.2em] text-white/70 uppercase ml-1 font-semibold">Your
                            Message</label>
                        <textarea wire:model="message" rows="4" placeholder="May your love last forever..."
                            class="w-full bg-white/10 border border-white/20 rounded-2xl px-6 py-4 focus:ring-2 focus:ring-white/30 outline-none transition-all font-poppins text-sm resize-none text-white placeholder:text-white/30"></textarea>
                        @error('message')
                            <span class="text-xs text-red-200 mt-1 ml-2 italic">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" wire:loading.attr="disabled"
                        class="w-full bg-white text-[#8C5A3C] font-poppins text-[11px] tracking-[0.4em] uppercase py-6 rounded-2xl hover:bg-gray-100 transition-all duration-300 shadow-xl font-bold active:scale-95 disabled:opacity-50">
                        <span wire:loading.remove>Send Wishes</span>
                        <span wire:loading>Sending...</span>
                    </button>

                    @if (session()->has('success'))
                        <div class="text-center text-white text-xs font-poppins mt-2 italic">
                            {{ session('success') }}
                        </div>
                    @endif
                </form>
            </div>

            <div class="pt-10">
                <div class="flex items-center justify-between mb-12">
                    <h3 class="font-utama text-black text-4xl lowercase italic tracking-tight">Voices of Love</h3>
                    <span class="h-px grow bg-[#8C5A3C]/20 ml-6"></span>
                </div>

                <div class="relative pb-4 px-2">
                    <div class="space-y-0 max-h-[500px] overflow-y-auto pr-6 custom-scrollbar scroll-smooth">
                        @foreach ($wishes as $msg)
                            <div
                                class="group py-5 first:pt-0 border-b border-gray-50/80 last:border-0 transition-all duration-500">
                                <div class="flex flex-col gap-4">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-baseline gap-3">
                                            <h5
                                                class="font-utama text-black text-base tracking-[0.05em] uppercase transition-colors group-hover:text-[#8C5A3C]">
                                                {{ $msg->name }}
                                            </h5>
                                            <span class="w-1 h-1 rounded-full bg-[#8C5A3C]/30"></span>
                                            <span
                                                class="text-[9px] font-poppins text-[#8C5A3C] bg-[#8C5A3C]/10 px-2 py-1 rounded-full uppercase tracking-[0.2em] font-bold">
                                                {{ $msg->attendance }}
                                            </span>
                                        </div>
                                        <span
                                            class="font-utama text-4xl text-[#8C5A3C]/10 leading-none select-none italic">“</span>
                                    </div>

                                    <div class="relative pl-0">
                                        <p
                                            class="font-poppins text-[10px] text-gray-500 leading-[1.8] italic group-hover:text-gray-700 transition-colors duration-300">
                                            {{ $msg->message }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div
                        class="absolute bottom-0 left-0 right-0 h-[1.5px] w-full bg-linear-to-r from-transparent via-[#8C5A3C]/40 to-transparent">
                    </div>
                </div>
            </div>

            <!-- Footnote -->
            <div class="mt-5 text-center border-t border-gray-50 pt-10">
                <p class="font-poppins text-[9px] tracking-[0.6em] text-gray-300 uppercase italic">
                    Thank you for being part of us
                </p>
            </div>
        </div>
    </div>

    <style>
        /* Scrollbar dibuat sedikit lebih 'kelihatan' tapi tetap elegan */
        .custom-scrollbar::-webkit-scrollbar {
            width: 3px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: rgba(140, 90, 60, 0.05);
            border-radius: 10px;
            margin-block: 20px;
            /* Jarak scrollbar dari atas-bawah container */
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #8C5A3C;
            border-radius: 10px;
        }
    </style>
</div>

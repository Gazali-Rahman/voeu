<?php

use Livewire\Component;
use App\Models\rsvp;

new class extends Component {
    public $invitation;
    public $name = '';
    public $attendance = 'hadir';
    public $message = '';
    public $wishes = [];

    public function mount($invitation)
    {
        $this->invitation = $invitation;
        $this->loadWishes();
    }

    public function loadWishes()
    {
        $this->wishes = rsvp::where('invitation_id', $this->invitation->id)->latest()->get();
    }

    public function send()
    {
        $this->validate([
            'name' => 'required|min:3',
            'attendance' => 'required|in:hadir,berhalangan,ragu-ragu',
            'message' => 'required|min:5',
        ]);

        $cleanName = \App\Helpers\WordFilter::clean($this->name);
        $cleanMessage = \App\Helpers\WordFilter::clean($this->message);

        rsvp::create([
            'invitation_id' => $this->invitation->id,
            'name' => $cleanName,
            'attendance' => $this->attendance,
            'message' => $cleanMessage,
        ]);

        $this->reset(['name', 'message']);
        $this->attendance = 'hadir';
        $this->loadWishes();

        session()->flash('success', 'Terima kasih! Doa restu Anda telah berhasil dikirim.');
    }
};
?>

<section class="relative w-full bg-[#F9F8F6] py-16 px-5 overflow-hidden max-w-md mx-auto text-gray-800">

    <style>
        .custom-scroll::-webkit-scrollbar {
            width: 4px;
        }

        .custom-scroll::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scroll::-webkit-scrollbar-thumb {
            background: rgba(0, 0, 0, 0.15);
            border-radius: 9999px;
        }
    </style>

    <div class="relative z-10 flex flex-col items-center">

        <!-- ========================================== -->
        <!-- HEADER / TITLE SECTION -->
        <!-- ========================================== -->
        <div x-data="{ show: false }" x-intersect.half.once="show = true"
            class="mb-12 flex flex-col items-center text-center relative w-full">

            {{-- <!-- Watermark Typography "Wishes" -->
            <h3 x-show="show" x-transition:enter="transition ease-in-out duration-1200 delay-200"
                x-transition:enter-start="opacity-0 -translate-x-10" x-transition:enter-end="opacity-100 translate-x-0"
                class="absolute -top-12 -left-2 font-abigail text-black/[0.05] text-[7.5rem] sm:text-[9rem] leading-none pointer-events-none select-none z-0">
                Wishes
            </h3> --}}

            <div class="relative z-10 flex flex-col items-center">
                <h2 x-show="show" x-transition:enter="transition ease-out duration-1000"
                    x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
                    class="font-samantha text-4xl text-black mb-2 select-none">
                    RSVP & Wishes
                </h2>
                <div x-show="show" x-transition:enter="transition ease-out duration-1000 delay-300"
                    x-transition:enter-start="opacity-0 scale-75" x-transition:enter-end="opacity-100 scale-100"
                    class="flex items-center gap-3">
                    <div class="h-px w-10 bg-black/20"></div>
                    <p class="font-indie text-xs tracking-[0.35em] uppercase text-black/60 font-bold">Confirm Attendance
                    </p>
                    <div class="h-px w-10 bg-black/20"></div>
                </div>
            </div>
        </div>

        <!-- ========================================== -->
        <!-- RSVP FORM CARD (SCRAPBOOK NOTEBOOK) -->
        <!-- ========================================== -->
        <div x-data="{ show: false }" x-intersect.half.once="show = true" class="w-full max-w-sm relative">

            <div x-show="show" x-transition:enter="transition ease-out duration-1000"
                x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                class="relative bg-white/95 border border-black/15 rounded-3xl p-6 sm:p-7 shadow-sm">

                <!-- Background Texture bg3.png (Inside Card) -->
                <img src="{{ asset('assets/png/esquisse/bg3.png') }}"
                    class="absolute inset-0 w-full h-full object-cover opacity-10 rounded-3xl pointer-events-none z-0"
                    alt="Card Background">



                <div class="relative z-10">
                    <!-- Success Alert -->
                    @if (session()->has('success'))
                        <div class="mb-5 p-3.5 rounded-2xl bg-emerald-50 border border-emerald-200 text-center">
                            <p class="font-indie text-xs text-emerald-800 font-bold">
                                {{ session('success') }}
                            </p>
                        </div>
                    @endif

                    <form wire:submit.prevent="send" class="flex flex-col gap-4">

                        <!-- Nama Lengkap -->
                        <div class="flex flex-col">
                            <label class="font-indie text-xs font-bold uppercase tracking-wider text-black/70 mb-1.5">
                                Nama Lengkap
                            </label>
                            <input type="text" wire:model.defer="name" placeholder="Tuliskan nama Anda..."
                                class="w-full px-4 py-2.5 bg-[#F9F8F6] border border-black/15 rounded-xl font-indie text-sm text-black placeholder:text-black/35 focus:outline-none focus:border-black focus:ring-1 focus:ring-black transition-all">
                            @error('name')
                                <span class="font-indie text-xs text-red-500 mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Konfirmasi Kehadiran -->
                        <div class="flex flex-col">
                            <label class="font-indie text-xs font-bold uppercase tracking-wider text-black/70 mb-1.5">
                                Konfirmasi Kehadiran
                            </label>
                            <div class="grid grid-cols-3 gap-2">
                                <!-- Hadir -->
                                <label class="cursor-pointer">
                                    <input type="radio" wire:model.defer="attendance" value="hadir"
                                        class="peer sr-only">
                                    <div
                                        class="w-full py-2 rounded-xl border border-black/15 bg-[#F9F8F6] text-center font-indie text-xs font-bold text-black/70 peer-checked:bg-black peer-checked:text-white peer-checked:border-black transition-all shadow-2xs">
                                        Hadir
                                    </div>
                                </label>
                                <!-- Ragu-ragu -->
                                <label class="cursor-pointer">
                                    <input type="radio" wire:model.defer="attendance" value="ragu-ragu"
                                        class="peer sr-only">
                                    <div
                                        class="w-full py-2 rounded-xl border border-black/15 bg-[#F9F8F6] text-center font-indie text-xs font-bold text-black/70 peer-checked:bg-black peer-checked:text-white peer-checked:border-black transition-all shadow-2xs">
                                        Ragu
                                    </div>
                                </label>
                                <!-- Tidak Hadir -->
                                <label class="cursor-pointer">
                                    <input type="radio" wire:model.defer="attendance" value="berhalangan"
                                        class="peer sr-only">
                                    <div
                                        class="w-full py-2 rounded-xl border border-black/15 bg-[#F9F8F6] text-center font-indie text-xs font-bold text-black/70 peer-checked:bg-black peer-checked:text-white peer-checked:border-black transition-all shadow-2xs">
                                        Berhalangan
                                    </div>
                                </label>
                            </div>
                            @error('attendance')
                                <span class="font-indie text-xs text-red-500 mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Ucapan & Doa Restu -->
                        <div class="flex flex-col">
                            <label class="font-indie text-xs font-bold uppercase tracking-wider text-black/70 mb-1.5">
                                Pesan & Doa Restu
                            </label>
                            <textarea wire:model.defer="message" rows="3" placeholder="Tuliskan ucapan dan doa terbaik Anda..."
                                class="w-full px-4 py-2.5 bg-[#F9F8F6] border border-black/15 rounded-xl font-indie text-sm text-black placeholder:text-black/35 focus:outline-none focus:border-black focus:ring-1 focus:ring-black transition-all resize-none"></textarea>
                            @error('message')
                                <span class="font-indie text-xs text-red-500 mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Tombol Kirim -->
                        <button type="submit"
                            class="w-full py-3.5 mt-1 rounded-full bg-black text-white font-indie text-sm font-bold tracking-widest uppercase hover:bg-neutral-800 transition-all duration-300 shadow-md hover:scale-[1.01] flex items-center justify-center gap-2 cursor-pointer disabled:opacity-50"
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
        </div>

        <!-- ========================================== -->
        <!-- WISHES & GUESTBOOK LIST (SCRAPBOOK CARDS) -->
        <!-- ========================================== -->
        <div x-data="{ show: false }" x-intersect.half.once="show = true" class="w-full max-w-sm mt-16">

            <!-- Subheader Guestbook -->
            <div x-show="show" x-transition:enter="transition ease-out duration-1000"
                x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
                class="flex items-center justify-between mb-6 px-1">
                <div>
                    <h3 class="font-samantha text-2xl text-black mb-2">Guestbook</h3>
                    <p class="font-indie text-xs text-black/50">Untaian Doa & Harapan</p>
                </div>
                <span
                    class="font-indie text-xs text-black/70 font-bold bg-white px-3 py-1 rounded-full border border-black/15 shadow-2xs">
                    {{ count($wishes) }} Ucapan
                </span>
            </div>

            <!-- List Ucapan -->
            <div class="flex flex-col gap-4 max-h-[420px] overflow-y-auto custom-scroll p-1">
                @forelse($wishes as $index => $wish)
                    @php
                        $rot = $index % 2 === 0 ? '-rotate-0.5' : 'rotate-0.5';
                    @endphp

                    <div x-show="show" x-transition:enter="transition ease-out duration-800"
                        x-transition:enter-start="opacity-0 translate-y-3"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        class="bg-white/95 border border-black/15 rounded-2xl p-4 shadow-xs {{ $rot }} hover:rotate-0 transition-transform duration-300 relative group">

                        <!-- Header Wish: Nama & Status -->
                        <div class="flex items-start justify-between gap-2 mb-2">
                            <h4 class="font-indie text-sm font-bold text-black tracking-wide">
                                {{ $wish->name }}
                            </h4>

                            @if ($wish->attendance === 'hadir')
                                <span
                                    class="font-indie text-[10px] font-bold bg-emerald-50 text-emerald-800 border border-emerald-200 px-2.5 py-0.5 rounded-full shrink-0">
                                    Hadir
                                </span>
                            @elseif($wish->attendance === 'ragu-ragu')
                                <span
                                    class="font-indie text-[10px] font-bold bg-amber-50 text-amber-800 border border-amber-200 px-2.5 py-0.5 rounded-full shrink-0">
                                    Ragu
                                </span>
                            @else
                                <span
                                    class="font-indie text-[10px] font-bold bg-rose-50 text-rose-800 border border-rose-200 px-2.5 py-0.5 rounded-full shrink-0">
                                    Absen
                                </span>
                            @endif
                        </div>

                        <!-- Pesan Ucapan -->
                        <p class="font-indie text-xs text-black/75 leading-relaxed text-justify mb-2.5">
                            {{ $wish->message }}
                        </p>

                        <!-- Timestamp -->
                        <div class="flex items-center justify-between pt-2 border-t border-black/5">
                            <span class="font-indie text-[10px] text-black/40">
                                {{ $wish->created_at ? $wish->created_at->diffForHumans() : 'Baru saja' }}
                            </span>
                            <span
                                class="font-indie text-xs text-black/20 group-hover:text-black/40 transition-colors">♡</span>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-4 px-4 bg-white/70 border border-black/15 rounded-2xl">
                        <p class="font-indie text-xs text-black/50 italic">
                            Belum ada ucapan. Jadilah yang pertama memberikan doa restu!
                        </p>
                    </div>
                @endforelse
            </div>
        </div>

    </div>
</section>

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

<div class="bg-[#F5E9D8] py-10 px-4 overflow-hidden">
    <div class="max-w-2xl mx-auto">

        <!-- Header Section -->
        <div x-data="{ show: false }" x-intersect="show = true" class="text-center mb-16">
            <span
                class="font-poppins text-[10px] tracking-[0.8em] text-red-950/50 uppercase block mb-4">Reservation</span>
            <h2 class="font-utama text-red-950 text-5xl">Guest Book</h2>
        </div>

        <div class="space-y-12">

            <!-- RSVP Form Card -->
            <div x-data="{ show: false }" x-intersect="show = true"
                class="bg-white/40 backdrop-blur-sm p-8 md:p-10 rounded-4xl border border-red-950/5 shadow-sm transition-all duration-1000"
                :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">

                @if (session()->has('success'))
                    <div class="mb-6 p-4 bg-green-100 text-green-700 rounded-xl text-xs font-poppins">
                        {{ session('success') }}
                    </div>
                @endif

                <form wire:submit.prevent="send" class="space-y-6">
                    <div class="space-y-2">
                        <label class="font-poppins text-[10px] tracking-[0.3em] text-red-950/60 uppercase ml-1">Nama
                            Lengkap</label>
                        <input type="text" wire:model="name" placeholder="Masukkan nama Anda"
                            class="w-full bg-white/80 mt-2 border-none rounded-xl px-6 py-2 focus:ring-2 focus:ring-red-950/10 transition-all font-poppins text-sm placeholder:text-stone-300 text-red-950">
                        @error('name')
                            <span class="text-[10px] text-red-500 font-poppins ml-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label
                            class="font-poppins text-[10px] tracking-[0.3em] text-red-950/60 uppercase ml-1">Konfirmasi
                            Kehadiran</label>
                        <select wire:model="attendance"
                            class="w-full bg-white/80 border-none mt-2 rounded-xl px-6 py-2 focus:ring-2 focus:ring-red-950/10 transition-all font-poppins text-sm text-red-950/70 appearance-none">
                            <option value="">-- Pilih Kehadiran --</option>
                            <option value="hadir">Akan Hadir</option>
                            <option value="ragu-ragu">Masih Ragu</option>
                            <option value="berhalangan">Berhalangan Hadir</option>
                        </select>
                        @error('attendance')
                            <span class="text-[10px] text-red-500 font-poppins ml-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="font-poppins text-[10px] tracking-[0.3em] text-red-950/60 uppercase ml-1">Doa &
                            Ucapan</label>
                        <textarea rows="4" wire:model="message" placeholder="Tulis doa manis..."
                            class="w-full bg-white/80 border-none mt-2 rounded-xl px-6 py-2 focus:ring-2 focus:ring-red-950/10 transition-all font-poppins text-sm resize-none placeholder:text-stone-300 text-red-950"></textarea>
                        @error('message')
                            <span class="text-[10px] text-red-500 font-poppins ml-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" wire:loading.attr="disabled"
                        class="w-full bg-red-950 text-[#F5E9D8] font-poppins text-[11px] tracking-[0.4em] uppercase py-5 rounded-2xl hover:bg-red-900 transition-all duration-300 shadow-lg shadow-red-950/20 disabled:opacity-50">
                        <span wire:loading.remove>Kirim Pesan Kehadiran</span>
                        <span wire:loading>Mengirim...</span>
                    </button>
                </form>
            </div>

            <!-- Display Messages (Guest Book List) -->
            <div class="space-y-8 pt-8">
                <div class="flex items-center gap-4">
                    <h3 class="font-utama text-red-950 text-2xl whitespace-nowrap">Wishes</h3>
                    <div class="h-px w-full bg-red-950"></div>
                </div>

                <div class="space-y-6 max-h-[500px] rounded-2xl overflow-y-auto pr-4 custom-scrollbar">

                    @forelse ($wishes as $wish)
                        <div
                            class="group px-2 py-2 space-y-2 transition-all hover:border-red-950 border-b border-red-950/5 pb-4 last:border-0">
                            <div class="flex items-center gap-3">
                                <h5 class="font-utama text-red-950 text-base">{{ $wish->name }}</h5>
                                <span class="w-1 h-1 rounded-full bg-red-950/20"></span>
                                <span class="text-[9px] font-poppins text-red-950/40 uppercase tracking-widest">
                                    @if ($wish->attendance == 'hadir')
                                        Akan Hadir
                                    @elseif($wish->attendance == 'berhalangan')
                                        Berhalangan
                                    @else
                                        Ragu-ragu
                                    @endif
                                </span>
                            </div>
                            <p
                                class="font-poppins text-xs text-red-950/70 leading-relaxed italic opacity-80 group-hover:opacity-100">
                                "{{ $wish->message }}"
                            </p>
                        </div>
                    @empty
                        <div class="text-center py-10">
                            <p class="font-poppins text-xs text-stone-400 italic">Belum ada ucapan.</p>
                        </div>
                    @endforelse

                </div>
            </div>
        </div>

        <!-- Footer Note -->
        <p class="mt-20 text-center font-poppins text-[9px] tracking-[0.3em] text-red-950/30 uppercase italic">
            Thank you for being part of our story
        </p>
    </div>
</div>

<style>
    /* Custom Scrollbar Berwarna Red-950 */
    .custom-scrollbar::-webkit-scrollbar {
        width: 2px;
    }

    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #450a0a3e;
        /* Red-950 */
        border-radius: 10px;
    }
</style>

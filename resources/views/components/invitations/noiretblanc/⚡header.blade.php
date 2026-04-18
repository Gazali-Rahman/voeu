<?php

use Livewire\Component;

new class extends Component {
    public $invitation;
    public $content;
    public $groomLetters = [];
    public $brideLetters = [];

    public function mount($invitation)
    {
        $this->invitation = $invitation;
        $this->content = $invitation->content;

        // Pecah nama menjadi array huruf untuk desain vertikal
        // mb_str_split digunakan agar aman untuk karakter khusus
        $this->groomLetters = mb_str_split(strtoupper($this->content['nama_pria'] ?? 'GROOM'));
        $this->brideLetters = mb_str_split(strtoupper($this->content['nama_wanita'] ?? 'BRIDE'));
    }

    // Helper untuk ambil foto berdasarkan label
    public function getPhoto($label)
    {
        $found = collect($this->content['dynamic_photos'] ?? [])->firstWhere('label', $label);
        return $found ? asset('storage/' . $found['path']) : asset('assets/img/placeholder.png');
    }
};
?>

<div class="mx-auto max-w-md bg-black h-screen overflow-hidden font-poppins relative" x-data="{ show: false }"
    x-init="setTimeout(() => show = true, 300)">

    <!-- Background Image - Full Screen -->
    <div class="absolute inset-0">
        <img src="{{ $this->getPhoto('c1') }}" alt="Mempelai" class="w-full h-full object-cover opacity-70">
        <!-- Overlay Gradasi Gelap yang lebih kuat di bawah untuk keterbacaan -->
        <div class="absolute inset-0 bg-linear-to-b from-black/30 via-transparent to-black/90"></div>

    </div>

    <!-- Layout Wrapper -->
    <div class="relative h-full flex flex-col justify-between py-12 px-8 text-center" x-show="show"
        x-transition:enter="transition ease-out duration-1000" x-transition:enter-start="opacity-0 scale-105"
        x-transition:enter-end="opacity-100 scale-100">
        <!-- Middle Section: Deconstructed Vertical Layout -->
        <div class="relative flex-1 w-full flex items-center justify-center py-2">
            <!-- Masukkan di dalam Middle Section Container -->
            <div
                class="absolute -left-12 top-1/2 -rotate-90 text-[8px] tracking-[0.8em] text-white/20 uppercase font-light">
                The Wedding of
            </div>
            <div
                class="absolute -right-12 top-1/2 rotate-90 text-[8px] tracking-[0.8em] text-white/20 uppercase font-light">
                Est. {{ \Carbon\Carbon::parse($content['tanggal_akad'])->format('Y') }}
            </div>
            <!-- Container Utama -->
            <div class="relative w-full h-full max-w-[300px] flex items-center justify-center">

                <!-- Nama Kiri: Baskara (Pojok Kiri Atas) -->
                <div class="absolute top-0 left-0 flex flex-col items-center gap-2 font-vogue  text-xl text-white uppercase tracking-tighter"
                    x-show="show" x-transition:enter="transition ease-out duration-1000 delay-500"
                    x-transition:enter-start="opacity-0 -translate-y-10"
                    x-transition:enter-end="opacity-100 translate-y-0">
                    @foreach ($groomLetters as $letter)
                        <span>{{ $letter }}</span>
                    @endforeach
                </div>

                <!-- Garis Vertikal Statis (Di Tengah sebagai Centerpiece) -->
                <div class="h-[60vh] w-px bg-linear-to-b from-transparent via-white/40 to-transparent"></div>

                <!-- Nama Kanan: Kirana (Pojok Kanan Bawah) -->
                <div class="absolute bottom-0 right-0 flex flex-col items-center gap-2 font-vogue  text-xl text-white uppercase tracking-tighter"
                    x-show="show" x-transition:enter="transition ease-out duration-1000 delay-700"
                    x-transition:enter-start="opacity-0 translate-y-10"
                    x-transition:enter-end="opacity-100 translate-y-0">
                    @foreach ($brideLetters as $letter)
                        <span>{{ $letter }}</span>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Bottom Section: Info & Countdown -->
        <div class="space-y-6">
            <!-- Date Info -->
            <div class="flex items-center justify-center gap-4">
                <div class="h-px w-6 bg-white/20"></div>
                <p class="text-white/90 text-[11px] tracking-[0.4em] uppercase font-light">
                    {{ \Carbon\Carbon::parse($content['tanggal_resepsi'])->format('d • m • Y') }}
                </p>
                <div class="h-px w-6 bg-white/20"></div>
            </div>

            <!-- Countdown (Minimalist Glass) -->
            <div class="py-4 border-y border-white/10 flex justify-around items-center text-white mx-4 font-vogue"
                x-data="{
                    expiry: new Date('{{ $content['tanggal_resepsi'] }}').getTime(),
                    remaining: { days: '00', hours: '00', minutes: '00', seconds: '00' },
                    update() {
                        let distance = this.expiry - new Date().getTime();
                        if (distance < 0) return;
                        this.remaining.days = String(Math.floor(distance / (1000 * 60 * 60 * 24))).padStart(2, '0');
                        this.remaining.hours = String(Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60))).padStart(2, '0');
                        this.remaining.minutes = String(Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60))).padStart(2, '0');
                        this.remaining.seconds = String(Math.floor((distance % (1000 * 60)) / 1000)).padStart(2, '0');
                    }
                }" x-init="update();
                setInterval(() => update(), 1000)">

                <div class="text-center">
                    <span class="block text-2xl font-bold tracking-tight" x-text="remaining.days">00</span>
                    <span class="text-[7px] uppercase tracking-[0.2em] text-white/50">Days</span>
                </div>
                <div class="text-center">
                    <span class="block text-2xl font-bold tracking-tight" x-text="remaining.hours">00</span>
                    <span class="text-[7px] uppercase tracking-[0.2em] text-white/50">Hours</span>
                </div>
                <div class="text-center">
                    <span class="block text-2xl font-bold tracking-tight" x-text="remaining.minutes">00</span>
                    <span class="text-[7px] uppercase tracking-[0.2em] text-white/50">Mins</span>
                </div>
                <div class="text-center">
                    <span class="block text-2xl font-bold tracking-tight" x-text="remaining.seconds">00</span>
                    <span class="text-[7px] uppercase tracking-[0.2em] text-white/50">Secs</span>
                </div>
            </div>

            <!-- Quote -->
            <p class="italic text-white/40 text-[10px] leading-relaxed max-w-[220px] mx-auto tracking-wide">
                "Two souls with but a single thought, two hearts that beat as one."
            </p>
        </div>
    </div>
</div>

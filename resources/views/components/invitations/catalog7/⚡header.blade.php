<?php

use Livewire\Component;

new class extends Component {
    public $invitation;

    public function mount($invitation)
    {
        $this->invitation = $invitation;
    }
};
?>

<div
    class="relative max-w-md mx-auto h-screen bg-[#F9F8F6] overflow-hidden flex items-center justify-center text-gray-800">

    <img src="{{ asset('assets/png/catalog7/bg3.png') }}"
        class="absolute inset-0 w-full h-full object-cover opacity-8 z-0 pointer-events-none" alt="Background">

    <div class="absolute top-10 left-0 w-full flex flex-col items-center text-center z-30 px-6">


        <h1 class="text-4xl font-samantha mb-4 text-black">
            {{ $invitation->content['nama_pria'] }} <span class="text-2xl mx-1">&</span>
            {{ $invitation->content['nama_wanita'] }}
        </h1>
        <div class="flex flex-col items-center gap-1.5">
            {{-- <!-- Lokasi -->
            <div class="flex justify-center items-center gap-2">
                <!-- Ikon Pin Lokasi SVG -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                    class="w-5 h-5 text-black">
                    <path fill-rule="evenodd"
                        d="M11.54 22.351l.07.04.028.016a.76.76 0 00.723 0l.028-.015.071-.041a16.975 16.975 0 001.144-.742 19.58 19.58 0 002.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 00-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 002.682 2.282 16.975 16.975 0 001.145.742zM12 13.5a3 3 0 100-6 3 3 0 000 6z"
                        clip-rule="evenodd" />
                </svg>
                <p class="text-xs font-indie tracking-widest text-black">
                    <!-- Ganti 'lokasi_resepsi' dengan nama key database kamu -->
                    <span>{{ $invitation->content['tempat_resepsi'] }}</span>
                </p>
            </div> --}}
            <!-- Tanggal -->
            <div class="flex justify-center items-center gap-2">
                <img src="{{ asset('assets/png/catalog7/clock.png') }}" class="w-5 h-auto" alt="">
                <p class="text-xs font-indie tracking-widest text-black">
                    <span>{{ \Carbon\Carbon::parse($invitation->content['tanggal_resepsi'])->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</span>
                </p>
            </div>


        </div>
    </div>

    <div class="relative w-[80%] flex items-center justify-center z-10">

        <div class="absolute inset-0 flex items-center justify-center z-10">
            <img src="{{ $invitation->getPhoto('c2') }}"
                class="w-[59%] h-auto aspect-[3.1/4] border-2 border-black rotate-10 object-cover shadow-lg">
        </div>

        <img src="{{ asset('assets/png/catalog7/figura3.png') }}"
            class="relative w-full h-auto rotate-10 z-0 pointer-events-none">

        <img src="{{ asset('assets/png/catalog7/lengan4.png') }}"
            class="absolute w-[62%] h-auto z-20 pointer-events-none bottom-[-50%] right-[-25%]">

    </div>
    <!-- BAGIAN BAWAH: Countdown Alpine.js -->
    <div class="absolute bottom-10 left-0 w-full flex justify-center z-30">
        <!-- x-data menginisialisasi target waktu dari database ke format yang bisa dibaca JS -->
        <div x-data="{
            targetDate: new Date('{{ \Carbon\Carbon::parse($invitation->content['tanggal_resepsi'])->toIso8601String() }}').getTime(),
            days: '00',
            hours: '00',
            mins: '00',
            secs: '00',
            updateCountdown() {
                let now = new Date().getTime();
                let distance = this.targetDate - now;
        
                if (distance > 0) {
                    this.days = String(Math.floor(distance / (1000 * 60 * 60 * 24))).padStart(2, '0');
                    this.hours = String(Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60))).padStart(2, '0');
                    this.mins = String(Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60))).padStart(2, '0');
                    this.secs = String(Math.floor((distance % (1000 * 60)) / 1000)).padStart(2, '0');
                }
            }
        }" x-init="updateCountdown();
        setInterval(() => updateCountdown(), 1000);" class="flex items-center gap-3">
            <!-- Hapus bg dari container utama, biarkan gap saja -->

            <!-- Kotak Hari -->
            <div class="flex flex-col items-center justify-center w-16 h-16  ">
                <span x-text="days" class="text-2xl font-indie text-black leading-none"></span>
                <span class="text-xs font-indie tracking-wider mt-1 text-gray-600">Hari</span>
            </div>

            <!-- Kotak Jam -->
            <div class="flex flex-col items-center justify-center w-16 h-16  ">
                <span x-text="hours" class="text-2xl font-indie text-black leading-none"></span>
                <span class="text-xs font-indie tracking-wider mt-1 text-gray-600">Jam</span>
            </div>

            <!-- Kotak Menit -->
            <div class="flex flex-col items-center justify-center w-16 h-16  ">
                <span x-text="mins" class="text-2xl font-indie text-black leading-none"></span>
                <span class="text-xs font-indie tracking-wider mt-1 text-gray-600">Menit</span>
            </div>

            <!-- Kotak Detik -->
            <div class="flex flex-col items-center justify-center w-16 h-16  ">
                <span x-text="secs" class="text-2xl font-indie text-black leading-none"></span>
                <span class="text-xs font-indie tracking-wider mt-1 text-gray-600">Detik</span>
            </div>

        </div>
    </div>
</div>

<?php

use Livewire\Component;

new class extends Component {
    //
};
?>

<div>
    <div class="py-16 px-6  relative flex flex-col items-center">
        {{-- <div class="absolute top-0 w-full overflow-hidden z-0">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                <path fill="#FFF8F0" fill-opacity="1"
                    d="M0,64L48,90.7C96,117,192,171,288,165.3C384,160,480,96,576,96C672,96,768,160,864,160C960,160,1056,96,1152,106.7C1248,117,1344,203,1392,245.3L1440,288L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z">
                </path>
            </svg>
        </div>
        <div class="absolute bottom-0 w-full overflow-hidden z-0 rotate-180">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                <path fill="#FFF8F0" fill-opacity="1"
                    d="M0,64L48,90.7C96,117,192,171,288,165.3C384,160,480,96,576,96C672,96,768,160,864,160C960,160,1056,96,1152,106.7C1248,117,1344,203,1392,245.3L1440,288L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z">
                </path>
            </svg>
        </div> --}}
        <!-- HEADER SECTION -->
        <div class="text-center z-10 mb-8">
            <p class="text-[9px] font-['Poppins'] text-[#3E2C23]/60 uppercase tracking-[0.5em] mb-3">
                Rangkaian Acara
            </p>
            <h2 class="text-4xl font-['Abigail'] text-[#3E2C23] drop-shadow-sm">Wedding Events</h2>
        </div>

        <!-- ========================================== -->
        <!-- SINGLE EVENT CARD (FOTO + COUNTDOWN + DETAIL) -->
        <!-- ========================================== -->
        <div
            class="w-full max-w-sm relative bg-[#F5EBE1]  rounded-[2.5rem] shadow-md overflow-hidden flex flex-col mb-10">

            <!-- --- BAGIAN ATAS: FOTO & COUNTDOWN (Alpine.js Inline Livewire-Safe) --- -->
            <!-- Kita ubah h-60 menjadi aspect-square agar kotaknya proporsional -->
            <div class="relative w-full h-72" x-data="{
                targetDate: '2026-05-24T08:00:00',
                days: '00',
                hours: '00',
                minutes: '00',
                seconds: '00',
                start() {
                    const countDownDate = new Date(this.targetDate).getTime();
                    setInterval(() => {
                        const now = new Date().getTime();
                        const distance = countDownDate - now;
            
                        if (distance < 0) {
                            this.days = '00';
                            this.hours = '00';
                            this.minutes = '00';
                            this.seconds = '00';
                            return;
                        }
            
                        this.days = String(Math.floor(distance / (1000 * 60 * 60 * 24))).padStart(2, '0');
                        this.hours = String(Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60))).padStart(2, '0');
                        this.minutes = String(Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60))).padStart(2, '0');
                        this.seconds = String(Math.floor((distance % (1000 * 60)) / 1000)).padStart(2, '0');
                    }, 1000);
                }
            }" x-init="start()">

                <!-- Foto Pasangan: Kembalikan ke w-full h-full agar mengisi area aspect-square -->
                <img src="{{ $invitation->getPhoto('c1') }}" alt="Pasangan"
                    class="w-full h-full object-cover object-center">

                <!-- Overlay Gelap agar Teks Countdown Terbaca -->
                <div class="absolute inset-0 bg-black/40"></div>

                <!-- Teks Countdown -->
                <div class="absolute inset-0 z-10 flex flex-col items-center pt-8 pb-6 px-6 text-white text-center">

                    <p class="text-[10px] font-['Poppins'] uppercase tracking-[0.4em] text-white/90 drop-shadow-md">
                        Menuju Hari Bahagia
                    </p>

                    <div class="flex flex-col items-center justify-center my-auto">

                        <div class="flex items-start justify-center gap-2 font-['Abigail']">
                            <div class="flex flex-col items-center w-12">
                                <span class="text-3xl leading-none drop-shadow-md" x-text="days">00</span>
                                <span
                                    class="text-[8px] font-['Poppins'] tracking-widest uppercase mt-2 text-white/80">Hari</span>
                            </div>
                            <span class="text-2xl leading-none -mt-1 text-white/50">:</span>
                            <div class="flex flex-col items-center w-12">
                                <span class="text-3xl leading-none drop-shadow-md" x-text="hours">00</span>
                                <span
                                    class="text-[8px] font-['Poppins'] tracking-widest uppercase mt-2 text-white/80">Jam</span>
                            </div>
                            <span class="text-2xl leading-none -mt-1 text-white/50">:</span>
                            <div class="flex flex-col items-center w-12">
                                <span class="text-3xl leading-none drop-shadow-md" x-text="minutes">00</span>
                                <span
                                    class="text-[8px] font-['Poppins'] tracking-widest uppercase mt-2 text-white/80">Menit</span>
                            </div>
                            <span class="text-2xl leading-none -mt-1 text-white/50">:</span>
                            <div class="flex flex-col items-center w-12">
                                <span class="text-3xl leading-none drop-shadow-md" x-text="seconds">00</span>
                                <span
                                    class="text-[8px] font-['Poppins'] tracking-widest uppercase mt-2 text-white/80">Detik</span>
                            </div>
                        </div>

                    </div>

                    <div class=" pt-4 border-t border-white/20 w-4/5">
                        <p
                            class="text-[9px] font-['Poppins'] text-white/80 leading-relaxed tracking-wider drop-shadow-md">
                            "Kami sangat menantikan momen indah ini untuk dirayakan bersama Anda."
                        </p>
                    </div>

                </div>
            </div>

            <!-- --- BAGIAN BAWAH: DETAIL AKAD & RESEPSI --- -->
            <div class="relative w-full p-8 flex flex-col items-center text-center bg-[#F5EBE1] overflow-hidden">

                <!-- ORNAMEN BUNGA DI DALAM DETAIL (Opacity Pudar) -->
                <div class="absolute -bottom-6 -left-6 w-35 z-0 pointer-events-none">
                    <img src="{{ asset('assets/png/catalog6/bunga1.png') }}" alt="Bunga" class="w-full object-cover">
                </div>
                <div class="absolute -bottom-6 -right-6 w-35 z-0 pointer-events-none">
                    <img src="{{ asset('assets/png/catalog6/bunga3.png') }}" alt="Bunga" class="w-full object-cover">
                </div>

                <!-- ========================= -->
                <!-- KONTEN AKAD -->
                <!-- ========================= -->
                <div class="relative z-10 w-full flex flex-col items-center">
                    <img src="{{ asset('assets/png/catalog6/cincin1.png') }}" alt="Akad"
                        class="w-20 object-cover mb-4">
                    <h3 class="text-[2rem] font-['Abigail'] text-[#3E2C23] mb-5">Akad Nikah</h3>

                    <!-- Format Tanggal Baru -->
                    <div class="flex flex-col items-center justify-center w-full mb-4">
                        <div class="flex items-center justify-center gap-3">
                            <!-- Kiri: Hari (Rata Kanan) -->
                            <p
                                class="text-[9px] font-['Poppins'] text-[#3E2C23]/80 uppercase tracking-widest text-right w-20">
                                Minggu</p>
                            <!-- Tengah: Tanggal Super Besar -->
                            <p class="text-[3.5rem] font-['Abigail'] text-[#3E2C23] leading-none drop-shadow-sm">24</p>
                            <!-- Kanan: Bulan (Rata Kiri) -->
                            <p
                                class="text-[9px] font-['Poppins'] text-[#3E2C23]/80 uppercase tracking-widest text-left w-20">
                                Desember</p>
                        </div>
                        <!-- Bawah: Tahun -->
                        <p class="text-[11px] font-['Poppins'] text-[#3E2C23] tracking-[0.4em] font-medium mt-2">2026
                        </p>
                    </div>

                    <p class="text-[11px] font-['Poppins'] text-[#3E2C23]/80 font-medium tracking-wide mb-5">
                        08:00 WIB - Selesai
                    </p>

                    <div class="mb-5 border-t border-[#3E2C23]/20 pt-4 w-3/4">
                        <p class="text-[12px] font-['Poppins'] text-[#3E2C23] font-semibold mb-1">Masjid Al-Ikhlas</p>
                        <p class="text-[10px] font-['Poppins'] text-[#3E2C23]/70 leading-relaxed px-4">
                            Jl. Sudirman No. 123, Jakarta Selatan
                        </p>
                    </div>
                </div>

                <!-- Pemisah Akad & Resepsi -->
                <div class="w-full relative my-8 flex justify-center items-center z-10">
                    <div class="absolute  px-3 text-[#3E2C23]/40">
                        <img src="{{ asset('assets/png/catalog6/bunga2.png') }}" alt=""
                            class="w-20 object-cover">
                    </div>
                </div>

                <!-- ========================= -->
                <!-- KONTEN RESEPSI -->
                <!-- ========================= -->
                <div class="relative z-10 w-full flex flex-col items-center">
                    <img src="{{ asset('assets/png/catalog6/glas2.png') }}" alt="Resepsi"
                        class="w-20 object-cover mb-4">
                    <h3 class="text-[2rem] font-['Abigail'] text-[#3E2C23] mb-5">Resepsi</h3>

                    <!-- Format Tanggal Baru -->
                    <div class="flex flex-col items-center justify-center w-full mb-4">
                        <div class="flex items-center justify-center gap-3">
                            <!-- Kiri: Hari (Rata Kanan) -->
                            <p
                                class="text-[9px] font-['Poppins'] text-[#3E2C23]/80 uppercase tracking-widest text-right w-20">
                                Minggu</p>
                            <!-- Tengah: Tanggal Super Besar -->
                            <p class="text-[3.5rem] font-['Abigail'] text-[#3E2C23] leading-none drop-shadow-sm">24</p>
                            <!-- Kanan: Bulan (Rata Kiri) -->
                            <p
                                class="text-[9px] font-['Poppins'] text-[#3E2C23]/80 uppercase tracking-widest text-left w-20">
                                Desember</p>
                        </div>
                        <!-- Bawah: Tahun -->
                        <p class="text-[11px] font-['Poppins'] text-[#3E2C23] tracking-[0.4em] font-medium mt-2">2026
                        </p>
                    </div>

                    <p class="text-[11px] font-['Poppins'] text-[#3E2C23]/80 font-medium tracking-wide mb-5">
                        11:00 WIB - Selesai
                    </p>

                    <div class="mb-6 border-t border-[#3E2C23]/20 pt-4 w-3/4">
                        <p class="text-[12px] font-['Poppins'] text-[#3E2C23] font-semibold mb-1">Grand Ballroom
                            Nusantara</p>
                        <p class="text-[10px] font-['Poppins'] text-[#3E2C23]/70 leading-relaxed px-4">
                            Jl. Jenderal Sudirman No. 456, Jakarta Selatan
                        </p>
                    </div>

                    <!-- Tombol Maps -->
                    <a href="#"
                        class="inline-flex items-center justify-center gap-2 px-6 py-2.5 rounded-full border border-[#3E2C23]/40 text-[#3E2C23] text-[9px] font-['Poppins'] tracking-widest uppercase hover:bg-[#3E2C23] hover:text-white transition duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-3.5 h-3.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                        </svg>
                        Google Maps
                    </a>
                </div>

            </div>
        </div>

    </div>
</div>

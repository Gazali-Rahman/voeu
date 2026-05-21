<?php

use Livewire\Component;

new class extends Component {
    //
};
?>

<div>
    <div class="py-20 px-6  relative overflow-hidden flex flex-col items-center">

        <!-- ========================================== -->
        <!-- HEADER / JUDUL UTAMA -->
        <!-- ========================================== -->
        <div class="text-center z-10 mb-14">
            <p class="text-[9px] font-['Poppins'] text-[#3E2C23]/60 uppercase tracking-[0.5em] mb-3">
                Meet The
            </p>
            <h2 class="text-4xl font-['Abigail'] text-[#3E2C23] drop-shadow-sm">Bride & Groom</h2>
        </div>

        <!-- ========================================== -->
        <!-- 1. MEMPELAI PRIA (THE GROOM) -->
        <!-- ========================================== -->
        <div class="flex flex-col items-center w-full z-10 text-center">

            <!-- Wrapper Foto Pria -->
            <div class="relative w-48 h-76 mb-8">
                <div
                    class="w-full h-full rounded-t-full rounded-b-full overflow-hidden shadow-md border-4 border-white bg-gray-50 relative z-10">
                    <img src="{{ $invitation->getPhoto('groom') }}" alt="Groom"
                        class="w-full h-full object-cover object-center">
                </div>

                <!-- Bunga Pria (Kanan Bawah) -->
                <div class="absolute -bottom-6 -right-8 w-36  z-0 pointer-events-none drop-shadow-md">
                    <img src="{{ asset('assets/png/rusticbeige/bunga3.png') }}" alt="Bunga"
                        class="w-full object-cover">
                </div>
            </div>

            <!-- Tipografi Nama (Kembali ke gaya awal) -->
            <h3 class="text-[2.75rem] font-['Abigail'] text-[#3E2C23] leading-none mb-4 drop-shadow-sm">
                {{ $invitation->content['nama_pria_lengkap'] }}
            </h3>

            <p class="text-[11px] font-['Poppins'] text-[#3E2C23]/70 leading-relaxed max-w-[250px] mb-6">
                {{ $invitation->content['label_ortu_pria'] }} <br>
                <span class="font-medium text-[#3E2C23]">{{ $invitation->content['ayah_pria'] }} &
                    {{ $invitation->content['ibu_pria'] }}</span>
            </p>

            <!-- Instagram (Kembali ke gaya tombol melengkung) -->
            <a href="#"
                class="inline-flex items-center gap-2 px-5 py-2 rounded-full border border-[#3E2C23]/20 text-[#3E2C23]/80 text-[10px] font-['Poppins'] tracking-widest hover:bg-[#3E2C23]/5 transition duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                    <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                    <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                </svg>
                @romeomontague
            </a>
        </div>

        <!-- ========================================== -->
        <!-- PEMISAH VERTIKAL -->
        <!-- ========================================== -->
        <div class="my-14 flex flex-col items-center z-10">

            <img src="{{ asset('assets/png/rusticbeige/bunga2.png ') }}" class="w-20" alt="">
        </div>

        <!-- ========================================== -->
        <!-- 2. MEMPELAI WANITA (THE BRIDE) -->
        <!-- ========================================== -->
        <div class="flex flex-col items-center w-full z-10 text-center mb-6">

            <!-- Wrapper Foto Wanita -->
            <div class="relative w-48 h-76 mb-8">
                <div
                    class="w-full h-full rounded-t-full rounded-b-full overflow-hidden shadow-md border-4 border-white  bg-gray-50 relative z-10">
                    <img src="{{ $invitation->getPhoto('bride') }}" alt="Bride"
                        class="w-full h-full object-cover object-center">
                </div>

                <!-- Bunga Wanita (Kiri Atas) -->
                <div class="absolute -bottom-6 -left-8 w-36 z-0 pointer-events-none drop-shadow-md">
                    <img src="{{ asset('assets/png/rusticbeige/bunga1.png') }}" alt="Bunga"
                        class="w-full object-cover">
                </div>
            </div>

            <!-- Tipografi Nama (Kembali ke gaya awal) -->
            <h3 class="text-[2.75rem] font-['Abigail'] text-[#3E2C23] leading-none mb-4 drop-shadow-sm">
                {{ $invitation->content['nama_wanita_lengkap'] }}
            </h3>

            <p class="text-[11px] font-['Poppins'] text-[#3E2C23]/70 leading-relaxed max-w-[250px] mb-6">
                Putri Kedua dari <br>
                <span class="font-medium text-[#3E2C23]">{{ $invitation->content['ayah_wanita'] }} &
                    {{ $invitation->content['ibu_wanita'] }}</span>
            </p>

            <!-- Instagram (Kembali ke gaya tombol melengkung) -->
            <a href="#"
                class="inline-flex items-center gap-2 px-5 py-2 rounded-full border border-[#3E2C23]/20 text-[#3E2C23]/80 text-[10px] font-['Poppins'] tracking-widest hover:bg-[#3E2C23]/5 transition duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                    <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                    <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                </svg>
                @julietcapulet
            </a>
        </div>

    </div>
</div>

<?php

use Livewire\Component;

new class extends Component {
    //
};
?>

<div>
    <div class="h-screen flex flex-col  relative overflow-hidden">

        <!-- 1. Background Pagar (Silhouette) -->
        <div class="absolute w-full h-full z-0 -right-50 opacity-5 pointer-events-none">
            <img src="{{ asset('assets/png/catalog6/pagar.png') }}" alt="Siluet Pagar" class="w-full h-full object-cover">
        </div>

        <!-- 2. Bunga (Pojok Kiri Bawah) -->
        <div class="absolute -bottom-10 -left-15 w-70 z-20 drop-shadow-lg pointer-events-none">
            <img src="{{ asset('assets/png/catalog6/bunga1.png') }}" alt="Bunga" class="w-full object-cover">
        </div>

        <!-- 3. Bagian Visual: Foto Menggantung dari Atas -->
        <div class="relative w-full h-[55%] z-10">
            <div class="absolute inset-x-8 top-0 bottom-0 rounded-b-full overflow-hidden shadow-lg  bg-gray-50">
                <img src="{{ $invitation->getPhoto('c2') }}" alt="Mempelai"
                    class="w-full h-full object-cover object-center">
            </div>
        </div>

        <!-- 4. Bagian Tipografi: Teks di Bawah Foto (Opsi 2) -->
        <div class="flex-1 flex flex-col justify-center px-8 z-10 pb-8 text-right items-end w-full">

            <p class="text-[9px] font-['Poppins'] text-[#3E2C23]/60 uppercase tracking-[0.4em] mb-3">
                Save The Date
            </p>

            <!-- Teks Rata Kanan -->
            <h2 class="text-[3.5rem] font-['Abigail'] text-[#3E2C23] leading-none">Romeo</h2>
            <span class="text-xl font-['Abigail'] text-[#3E2C23]/50 my-1 pr-16">&</span>
            <h2 class="text-[3.5rem] font-['Abigail'] text-[#3E2C23] leading-none">Juliet</h2>

            <!-- Garis & Tanggal -->
            <div class="mt-6 flex items-center justify-end gap-3 w-full">
                <div class="h-[1px] w-12 bg-[#3E2C23]/30"></div>
                <p class="text-[10px] font-['Poppins'] text-[#3E2C23]/80 tracking-[0.2em] font-medium uppercase">
                    24 . 12 . 2026
                </p>
            </div>

        </div>

    </div>
</div>

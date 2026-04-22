<div x-data="{ loading: true }" x-init="setTimeout(() => loading = false, 3000)" class="relative">

    <!-- 1. LOADING SCREEN LAYER -->
    <div x-show="loading" x-transition:leave="transition ease-in duration-1000" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-999 flex flex-col items-center justify-center bg-red-950">

        <!-- Logo Brand Voeu dengan Efek Sorot Cahaya -->
        <div class="relative flex flex-col items-center">

            <!-- Teks Logo Utama -->
            <h1 class="font-utama text-7xl tracking-[0.3em] uppercase leading-none text-shimmer">
                Voeu
            </h1>

            <!-- Tagline dengan animasi fade tipis -->
            <div class="mt-4 overflow-hidden">
                <span class="font-poppins text-[10px] tracking-[1em] text-[#F5E9D8] uppercase opacity-30 animate-pulse">
                    Digital Invitation
                </span>
            </div>
        </div>

        <!-- Progress Bar Halus -->
        <div class="mt-16 w-32 h-px bg-[#F5E9D8]/10 overflow-hidden">
            <div class="h-full bg-[#F5E9D8] animate-progress"></div>
        </div>
    </div>

    <!-- 2. MAIN CONTENT (Halaman Buka Undangan) -->
    <div class="flex flex-col items-center justify-center min-h-screen bg-red-950 overflow-hidden">
        <div class="max-w-md w-full flex flex-col items-center justify-center" x-show="!loading"
            x-transition:enter="transition ease-out duration-1000 delay-500"
            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">

            <!-- Foto -->
            <div class="relative w-[70%]">
                <div class="rounded-full aspect-3/4 bg-white bg-cover bg-center border-4 border-[#F5E9D8]"
                    style="background-image: url('{{ $invitation->getPhoto('c1') }}');">
                </div>
                <img src="{{ asset('assets/png/eternalserenity/flower1.png') }}" alt="flower"
                    class="absolute -top-15 -right-10 w-[80%] h-auto z-10">
            </div>

            <!-- Konten -->
            <div class="text-center px-6">
                <h1 class="font-utama text-4xl mt-10 text-white">{{ $invitation->content['nama_pria'] }} &
                    {{ $invitation->content['nama_wanita'] }}</h1>
                <p class="font-poppins mt-6 text-white text-sm opacity-80 uppercase tracking-widest">Kepada Yth</p>
                <p class="font-poppins text-white text-[11px] uppercase tracking-[0.4em] mt-2 opacity-60">
                    {{ $guestName }}</p>
                <button @click="document.getElementById('weddingMusic').play();" wire:click="open"
                    class="mt-10 bg-[#F5E9D8] text-red-950 px-10 py-3 rounded-full font-poppins font-bold hover:bg-white transition-all shadow-xl active:scale-95 uppercase tracking-widest text-[11px]">
                    Buka Undangan
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    /* Inti dari Efek Sorot Cahaya pada Tulisan */
    .text-shimmer {
        background: linear-gradient(to right,
                #5e0707 20%,
                #F5E9D8 40%,
                #F5E9D8 60%,
                #5e0707 80%);
        background-size: 200% auto;
        color: #000;
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: shine 3s linear infinite;
    }

    @keyframes shine {
        to {
            background-position: 200% center;
        }
    }

    @keyframes progress {
        0% {
            transform: translateX(-100%);
        }

        100% {
            transform: translateX(100%);
        }
    }

    .animate-progress {
        animation: progress 2.5s infinite ease-in-out;
    }
</style>

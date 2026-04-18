<div x-data="{ loading: true }" x-init="setTimeout(() => loading = false, 3000)" class="relative">
    <!-- 1. LOADING SCREEN LAYER -->
    <div x-show="loading" x-transition:leave="transition ease-in duration-1000" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0" class="fixed inset-0 z-999 flex flex-col items-center justify-center bg-black">

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

    <div class="mx-auto max-w-md  flex justify-center items-center h-screen">
        <div class="relative w-full h-full">

            <!-- Nama Mempelai di Sisi Kiri dan Kanan -->
            <div class="absolute top-10 left-0 w-full px-6 z-20 flex justify-between items-center">
                <!-- Nama Mempelai Pria -->
                <h2 class="font-poppins text-black tracking-[0.2em] text-[10px] font-bold drop-shadow-lg uppercase">
                    {{ $invitation->content['nama_pria'] }}
                </h2>

                <!-- Nama Mempelai Wanita -->
                <h2 class="font-poppins text-white tracking-[0.2em] text-[10px] font-bold drop-shadow-lg uppercase">
                    {{ $invitation->content['nama_wanita'] }}
                </h2>
            </div>
            <!-- Teks 'Save the Date' di Sisi Kiri (Rotated) -->
            <div class="absolute top-1/2 left-[15%] -translate-y-1/2 -rotate-90 z-20">
                <p class="font-poppins text-sm tracking-[0.4em] uppercase font-medium text-black whitespace-nowrap">
                    Save the Date
                </p>
            </div>

            <!-- Tanggal dan Lokasi di Pojok Kiri Bawah -->
            <div class="absolute bottom-10 left-6 z-20 flex flex-col gap-1">
                <p class="font-poppins font-bold text-lg tracking-tighter text-black">
                    {{ \Carbon\Carbon::parse($invitation->content['tanggal_resepsi'])->format('d • m • Y') }}
                </p>
                <p class="font-poppins text-[9px] uppercase tracking-[0.2em] font-semibold text-gray-600">
                    Kepada Yth. <br>{{ $guestName }}
                </p>

            </div>
            <!-- Tombol Open Invitation -->
            <div class="absolute bottom-10 right-6 z-30" wire:click="open"
                @click="document.getElementById('weddingMusicFirst').play();">
                <button
                    class="bg-white/20 backdrop-blur-md border border-white/30 text-white px-4 py-2 text-[10px] uppercase tracking-[0.2em] font-bold rounded-full shadow-lg hover:bg-white hover:text-black transition-all duration-300">
                    Open Invitation
                </button>
            </div>
            <!-- Gambar di sisi kanan -->
            <img src="{{ $invitation->getPhoto('c1') }}" alt=""
                class="absolute right-0 w-1/2 h-full object-cover object-[80%_center]">

            <!-- Teks Susun Vertikal dengan Background Image -->
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-10 
                    flex gap-4 flex-col items-center justify-center w-min font-extrabold text-6xl leading-none font-poppins
                    bg-clip-text text-transparent bg-cover bg-position-[70%_center]"
                style="background-image: url('{{ $invitation->getPhoto('c2') }}');">
                @foreach (str_split(strtoupper(\Carbon\Carbon::parse($invitation->content['tanggal_akad'])->translatedFormat('l'))) as $char)
                    <span>{{ $char }}</span>
                @endforeach
            </div>

        </div>
    </div>
</div>
<style>
    /* Inti dari Efek Sorot Cahaya pada Tulisan */
    .text-shimmer {
        background: linear-gradient(to right,
                #000000 20%,
                #F5E9D8 40%,
                #F5E9D8 60%,
                #000000 80%);
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

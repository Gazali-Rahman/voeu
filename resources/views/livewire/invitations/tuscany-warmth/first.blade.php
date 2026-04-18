<div x-data="{ loading: true }" x-init="setTimeout(() => loading = false, 3000)" class="relative">
    <!-- 1. LOADING SCREEN LAYER -->
    <div x-show="loading" x-transition:leave="transition ease-in duration-1000" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-999 flex flex-col items-center justify-center bg-[#8C5A3C]">

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

    <!-- 1. Tambahkan pb-10 agar button punya jarak aman di bawah -->
    <div class="max-w-md min-h-screen flex flex-col px-4 text-center justify-start pt-10 pb-10 bg-cover bg-center bg-no-repeat mx-auto"
        style="background-image: url('{{ $invitation->getPhoto('c1') }}')">

        <div class="flex gap-4 items-center justify-center">
            <h1 class="font-utama tracking-widest text-white uppercase drop-shadow-lg">
                {{ $invitation->content['nama_pria'] }}</h1>
            <div class="w-1 h-1 rounded-full bg-white drop-shadow-lg"></div>
            <h1 class="font-utama tracking-widest text-white uppercase drop-shadow-lg">
                {{ $invitation->content['nama_wanita'] }}
            </h1>
        </div>

        <div class="flex gap-4 mt-5 items-center justify-center">
            <h1 class="font-utama tracking-widest text-white uppercase text-4xl drop-shadow-lg">Save</h1>
            <h1 class="font-samantha text-white text-2xl drop-shadow-lg">the</h1>
            <h1 class="font-utama tracking-widest text-white uppercase text-4xl drop-shadow-lg">Date</h1>
        </div>

        <div class="flex  gap-2 mt-2 items-center justify-center">
            <div class="flex gap-2 items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                    class="size-4 text-white">
                    <path
                        d="M12.75 12.75a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM7.5 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM8.25 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM9.75 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM10.5 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM12.75 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM14.25 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM15 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM16.5 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM15 12.75a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM16.5 13.5a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" />
                    <path fill-rule="evenodd"
                        d="M6.75 2.25A.75.75 0 0 1 7.5 3v1.5h9V3A.75.75 0 0 1 18 3v1.5h.75a3 3 0 0 1 3 3v11.25a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3V7.5a3 3 0 0 1 3-3H6V3a.75.75 0 0 1 .75-.75Zm13.5 9a1.5 1.5 0 0 0-1.5-1.5H5.25a1.5 1.5 0 0 0-1.5 1.5v7.5a1.5 1.5 0 0 0 1.5 1.5h13.5a1.5 1.5 0 0 0 1.5-1.5v-7.5Z"
                        clip-rule="evenodd" />
                </svg>
                <h1 class="font-poppins font-light tracking-widest text-xs leading-none text-white">
                    {{ \Carbon\Carbon::parse($invitation->content['tanggal_resepsi'])->format('d M Y') }}
                </h1>
            </div>
            <div class="flex gap-2 items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                    class="size-4 text-white">
                    <path fill-rule="evenodd"
                        d="m11.54 22.351.07.04.028.016a.76.76 0 0 0 .723 0l.028-.015.071-.041a16.975 16.975 0 0 0 1.144-.742 19.58 19.58 0 0 0 2.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 0 0-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 0 0 2.682 2.282 16.975 16.975 0 0 0 1.145.742ZM12 13.5a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"
                        clip-rule="evenodd" />
                </svg>
                <h1 class="font-poppins font-light tracking-widest text-xs leading-none text-white">
                    {{ $invitation->content['tempat_resepsi'] }}
                </h1>
            </div>
        </div>
        <div class="mt-4 px-8">
            <p class=" font-poppins font-light text-[10px] tracking-[0.3em] text-white/80 uppercase drop-shadow-lg">
                Together with our families, we invite you to celebrate our wedding
            </p>
        </div>

        <!-- 2. Tambahkan class mt-auto dan w-fit agar button berada di bawah -->
        <button @click="document.getElementById('weddingMusicFirst').play();" wire:click="open"
            class="mt-auto mx-auto inline-flex justify-center items-center bg-white rounded-lg px-6 py-3 shadow-md hover:bg-gray-50 transition-all">
            <span class="font-poppins font-medium tracking-widest text-xs uppercase text-">Buka Undangan</span>
        </button>
    </div>
</div>
<style>
    /* Inti dari Efek Sorot Cahaya pada Tulisan */
    .text-shimmer {
        background: linear-gradient(to right,
                #512804 20%,
                #F5E9D8 40%,
                #F5E9D8 60%,
                #512804 80%);
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

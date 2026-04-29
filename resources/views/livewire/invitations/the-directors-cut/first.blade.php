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

    <div class="max-w-md mx-auto bg-black h-screen relative overflow-hidden flex flex-col items-center py-12">

        <div class="absolute inset-0 z-0">
            <img src="{{ $invitation->getPhoto('c1') }}" class="w-full h-full object-cover opacity-80 brightness-[0.7]"
                alt="Background Couple">
            <div class="absolute inset-0 bg-linear-to-t from-black/80 via-transparent to-black/60"></div>
        </div>

        <div class="relative z-20 w-full px-10 flex justify-between items-center font-mono mb-6">
            <div class="flex items-center gap-2">
                <div class="w-1.5 h-1.5 rounded-full bg-red-600 animate-pulse"></div>
                <span class="text-[8px] uppercase tracking-[0.3em] text-white/90">
                    REC {{ \Carbon\Carbon::parse($invitation->content['tanggal_resepsi'])->format('d.m.Y') }}
                </span>
            </div>
            <div class="flex flex-col items-end">
                <span class="text-[8px] uppercase tracking-[0.3em] text-white/90">RAW 4K F/2.8</span>
            </div>
        </div>

        <div class="relative z-10 flex flex-col items-center text-center mt-[5vh] mb-auto w-[85%] max-w-[320px]">

            <div class="absolute -inset-x-4 -inset-y-10 pointer-events-none opacity-50">
                <div class="absolute top-0 left-0 w-8 h-8 border-t border-l border-white/60"></div>
                <div class="absolute top-0 right-0 w-8 h-8 border-t border-r border-white/60"></div>
                <div class="absolute bottom-0 left-0 w-8 h-8 border-b border-l border-white/60"></div>
                <div class="absolute bottom-0 right-0 w-8 h-8 border-b border-r border-white/60"></div>
            </div>

            <p class="text-[9px] font-mono tracking-[0.6em] uppercase text-white/50 mb-4">Save The Date</p>

            <p
                class="font-abigail text-4xl text-white tracking-tighter leading-none mb-2 drop-shadow-lg wrap-break-word">
                {{ $invitation->content['nama_pria'] }} & {{ $invitation->content['nama_wanita'] }}
            </p>

            <div class="flex flex-col items-center gap-3 font-mono">
                <div class="h-px w-12 bg-white/20"></div>
                <div class="space-y-1">
                    <p class="text-[10px] tracking-[0.4em] text-white uppercase">
                        {{ \Carbon\Carbon::parse($invitation->content['tanggal_resepsi'])->format('l, d F Y') }}
                    </p>
                    <p class="text-[8px] tracking-[0.2em] text-white/60 uppercase">
                        {{ $invitation->content['tempat_resepsi'] }}
                    </p>
                </div>
            </div>
        </div>

        <div class="relative z-20 w-full px-10 flex flex-col gap-8">
            <div class="flex justify-between items-end font-mono text-white/50">
                <div class="flex flex-col gap-1 text-left">
                    <span class="text-[7px] tracking-widest uppercase">ISO 100</span>
                    <span class="text-[7px] tracking-widest uppercase">1/125 SEC</span>
                </div>
                <div class="text-right">
                    <span class="text-[8px] tracking-[0.3em] animate-pulse">● PLAYING</span>
                </div>
            </div>

            <button wire:click="open"
                class="w-full bg-white text-black py-4 flex items-center justify-center group hover:bg-zinc-200 transition-all duration-500 rounded-sm">
                <span class="font-mono text-[9px] uppercase tracking-[0.6em] font-bold">
                    View Invitation
                </span>
                <svg class="w-3 h-3 ml-2 group-hover:translate-x-1 transition-transform" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3">
                    </path>
                </svg>
            </button>
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

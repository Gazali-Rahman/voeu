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

    <div class="relative h-screen w-full bg-cover bg-center overflow-hidden max-w-md mx-auto"
        style="background-image: url('{{ $invitation->getPhoto('c1') }}')">

        {{-- TAMPILAN DEPAN --}}
        <div class="absolute inset-x-0 bottom-0 h-1/2 bg-linear-to-t from-[#5a3a2e] via-[#5a3a2e]/60 to-transparent">
        </div>

        <div
            class="absolute -bottom-75 -left-40 w-full z-10 transition-transform duration-1000 transform hover:scale-105 origin-bottom-left pointer-events-none">
            <img src="{{ asset('assets/png/javaneseessence/cowo.png') }}" alt="Wayang Pria"
                class="w-full h-auto object-contain brightness-0 opacity-10 contrast-100">
        </div>

        <div
            class="absolute -bottom-75 -right-40 w-full z-10 transition-transform duration-1000 transform hover:scale-105 origin-bottom-right pointer-events-none">
            <img src="{{ asset('assets/png/javaneseessence/cewe.png') }}" alt="Wayang Wanita"
                class="w-full h-auto object-contain brightness-0 opacity-10 contrast-100">
        </div>

        <div class="relative z-20 flex flex-col items-center h-full w-full px-8 pt-10">
            <div class="w-full max-w-5xl flex flex-col">
                <div class="flex items-baseline gap-4 mb-4 border-b border-white/20 pb-2 justify-center">
                    <span class="text-white text-[10px] md:text-xs tracking-[0.5em] uppercase font-light">The Union of
                        Two
                        Souls</span>
                </div>

                <h1
                    class="font-abigail text-white text-[5rem] leading-none self-start opacity-90 hover:opacity-100 transition-opacity">
                    {{ $invitation->content['nama_pria'] }}</h1>

                <div class="flex items-center self-end -mt-7">
                    <span class="text-white font-poppins text-xs tracking-[1em] uppercase mr-4 opacity-50">And</span>
                    <h1 class="font-abigail text-white text-[5rem] leading-none">
                        {{ $invitation->content['nama_wanita'] }}</h1>
                </div>

                <div class="self-end mt-4">
                    <p
                        class="text-white text-xs md:text-sm font-light tracking-[0.5em] uppercase bg-white/10 px-4 py-2 rounded-full">
                        {{ Carbon\Carbon::parse($invitation->content['tanggal_resepsi'])->format('F jS, Y') }}</p>
                </div>
            </div>

            <div class="flex flex-col items-center justify-center mt-auto pb-10">
                <button @click="playAudio()" wire:click="open"
                    class="group relative px-10 py-3 overflow-hidden rounded-full border border-white/30 bg-white/10 backdrop-blur-md transition-all duration-300 active:scale-95">
                    <div class="relative flex items-center gap-3">
                        <span class="text-white text-[10px] tracking-[0.4em] uppercase font-light">Open
                            Invitation</span>
                    </div>
                </button>
                <div class="mt-4 opacity-40">
                    <div class="w-px h-8 bg-linear-to-b from-white to-transparent"></div>
                </div>
            </div>
        </div>
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

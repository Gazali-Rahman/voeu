<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

    .font-abigail {
        font-family: 'Abigail', serif;
    }

    .font-poppins {
        font-family: 'Poppins', sans-serif;
    }

    .film-frame {
        border-left: 5px solid white;
        border-right: 5px solid white;
        border-top: 2px solid white;
        border-bottom: 2px solid white;
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Merapatkan border antar foto */
    .film-container>div:first-child .film-frame {
        border-top: 5px solid white;
        border-radius: 4px 4px 0 0;
    }

    .film-container>div:last-child .film-frame {
        border-bottom: 5px solid white;
        border-radius: 0 0 4px 4px;
    }
</style>

<div class="mx-auto max-w-md bg-center bg-no-repeat bg-cover h-screen relative font-poppins overflow-hidden"
    style="background-image: url('{{ $invitation->getPhoto('c1') }}');">

    {{-- Backdrop Overlay --}}
    <div class="absolute inset-0 backdrop-blur-md bg-black/45"></div>

    {{-- Main Content --}}
    <div class="relative z-10 h-full flex flex-row p-5 text-white">

        {{-- Kolom Kiri (Teks) - Dipersempit --}}
        <div class="w-2/5 flex flex-col justify-start pt-10 pr-2">
            <p class="text-[9px] tracking-[0.2em] font-light opacity-80">{{ date('d.m.y') }}</p>

            <div class="mt-4 mb-4">
                <h1 class="text-2xl font-abigail leading-none tracking-wide">The</h1>
                <h1 class="text-3xl font-abigail leading-none italic">Wedding</h1>
                <p class="text-[8px] font-light tracking-[0.1em] uppercase opacity-70 mt-2">Announcement</p>
            </div>

            <div class="border-l border-white/40 h-8 my-2"></div>

            <div class="space-y-1">
                <p class="text-[10px] font-semibold tracking-tighter">#OurSpecialDay</p>
                <p class="text-[9px] opacity-60">@namapasangan</p>
            </div>
        </div>

        {{-- Kolom Kanan (3 Foto - Fit Screen) --}}
        <div class="w-3/5 flex flex-col h-full film-container pb-10">
            {{-- Foto 1 --}}
            <div class="flex-1 overflow-hidden">
                <img src="{{ $invitation->getPhoto('c1') }}" alt="Foto 1" class="film-frame">
            </div>

            {{-- Foto 2 --}}
            <div class="flex-1 overflow-hidden">
                <img src="{{ $invitation->getPhoto('c1') }}" alt="Foto 2" class="film-frame opacity-90">
            </div>

            {{-- Foto 3 + Overlay Nama --}}
            <div class="flex-1 overflow-hidden relative">
                <img src="{{ $invitation->getPhoto('c1') }}" alt="Foto 3" class="film-frame opacity-80">

                <div
                    class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent flex flex-col justify-end p-3 text-center">
                    <p class="font-abigail text-lg leading-tight">{{ $invitation->nama_pria }} &
                        {{ $invitation->nama_wanita }}</p>
                    <p class="text-[8px] tracking-[0.2em] uppercase opacity-70">
                        {{ $invitation->tanggal_pernikahan_short }}</p>
                </div>
            </div>
        </div>

        {{-- Scroll Indicator --}}
        <div class="absolute bottom-4 left-5 flex items-center gap-2 opacity-40">
            <div class="w-6 h-px bg-white"></div>
            <p class="text-[8px] tracking-widest uppercase">Open Invitation</p>
        </div>
    </div>
</div>

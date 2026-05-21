<div
    class="relative max-w-md mx-auto h-screen bg-[#F9F8F6] overflow-hidden flex items-center justify-center text-gray-800">

    <img src="{{ asset('assets/png/catalog7/bg3.png') }}"
        class="absolute inset-0 w-full h-full object-cover opacity-8 z-0 pointer-events-none" alt="Background">

    <div class="absolute top-5 left-0 w-full flex flex-col items-center text-center z-30 px-6">
        <p class="text-xs font-indie tracking-[0.2em] uppercase  mb-8 text-black">Come to Celebrate With Us</p>

        <h1 class="text-4xl font-samantha mb-4 text-black">
            {{ $invitation->content['nama_pria'] }} <span class="text-2xl mx-1">&</span>
            {{ $invitation->content['nama_wanita'] }}
        </h1>
        <div class="flex justify-center items-center gap-2">
            <img src="{{ asset('assets/png/catalog7/clock.png') }}" class="w-6 h-auto" alt="">
            <p class="text-xs font-indie tracking-widest  text-black">
                <span>{{ \Carbon\Carbon::parse($invitation->content['tanggal_resepsi'])->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</span>
            </p>
        </div>
    </div>

    <div class="relative w-[80%] flex items-center justify-center z-10">

        <div class="absolute inset-0 flex items-center justify-center z-10">
            <img src="{{ $invitation->getPhoto('c1') }}"
                class="w-[59%] h-auto aspect-[3.1/4] border-2 border-black -rotate-10 object-cover shadow-lg">
        </div>

        <img src="{{ asset('assets/png/catalog7/figura3.png') }}"
            class="relative w-full h-auto -rotate-10 z-0 pointer-events-none">

        <img src="{{ asset('assets/png/catalog7/lengan3.png') }}"
            class="absolute w-[62%] h-auto z-20 pointer-events-none bottom-[-50%] left-[-25%]">

    </div>
    <div class="absolute bottom-10 left-0 w-full flex flex-col items-center justify-center z-40">
        <p class="font-indie text-xs mb-2">Kepada Yth. {{ $guestName }}</p>
        <button type="button" wire:click="open"
            class="flex items-center gap-2 bg-black text-white px-6 py-2.5 rounded-full font-indie tracking-wider text-sm shadow-lg hover:bg-gray-800 transition-all active:scale-95">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
            </svg>
            Buka Undangan
        </button>
    </div>
</div>

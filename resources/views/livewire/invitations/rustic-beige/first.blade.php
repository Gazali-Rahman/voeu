<div
    class="max-w-md mx-auto h-screen flex flex-col items-center justify-between py-8 relative overflow-hidden bg-[#FFF8F0]">

    <div class="text-center z-10 flex flex-col items-center mt-2 relative">
        <p class="text-[10px] tracking-[0.3em] font-['Poppins'] text-gray-400 uppercase mb-3">The Wedding Of</p>
        <div class="relative flex   items-center">
            <h1 class="text-3xl leading-none font-['Abigail'] text-[#3E2C23] ">
                {{ $invitation->content['nama_pria'] }}</h1>
            <span class="text-sm text-gray-400 mx-4">|</span>
            <h1 class="text-3xl leading-none font-['Abigail'] text-[#3E2C23]">
                {{ $invitation->content['nama_wanita'] }}</h1>
        </div>
        <p class="text-[10px] font-['Poppins'] text-gray-500 mt-2 tracking-[0.2em] uppercase font-light">
            24 <span class="mx-2 text-[#3E2C23]">|</span> 12 <span class="mx-2 text-[#3E2C23]">|</span> 2026
        </p>
    </div>

    <div class="relative w-48 h-72 my-auto">

        <div class="absolute bottom-0 right-1/2 w-32 z-0">
            <img src="{{ asset('assets/png/catalog6/pagar.png') }}" alt="" class="w-full object-cover">
        </div>

        <div class="absolute inset-0 z-10 w-full h-full rounded-t-full overflow-hidden shadow-lg bg-white">
            <img src="{{ $invitation->getPhoto('c1') }}" alt="" class="w-full h-full object-cover">
        </div>

        <div class="absolute -top-14 -right-14 w-48 h-auto z-0 pointer-events-none">
            <img src="{{ asset('assets/png/catalog6/bunga3.png') }}" alt="" class="w-full object-cover">
        </div>

    </div>

    <div class="text-center z-10 flex flex-col items-center mb-2">
        <p class="text-[11px] font-['Poppins'] text-gray-500 mb-3">Kepada Yth. {{ $guestName }}</p>

        <button wire:click="open"
            class="bg-[#3E2C23] text-white px-7 py-2.5 rounded-full flex items-center gap-2 hover:bg-[#3E2C23]/80 transition duration-300 shadow-md text-xs font-['Poppins'] tracking-wide">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-1.14.76a2 2 0 01-2.22 0l-1.14-.76" />
            </svg>
            Buka Undangan
        </button>
    </div>

</div>

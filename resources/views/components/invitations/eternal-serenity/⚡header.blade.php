<?php

use Livewire\Component;

new class extends Component {
    //
};
?>
<div x-data="{ show: false }" x-init="setTimeout(() => show = true, 100)"
    class="h-screen bg-[#F5E9D8] relative flex flex-col items-center overflow-hidden px-2">

    <!-- Frame Merah Arch -->
    <div x-show="show" x-transition:enter="transition ease-out duration-1000"
        x-transition:enter-start="opacity-0 -translate-y-10" x-transition:enter-end="opacity-100 translate-y-0"
        class="bg-red-950 rounded-b-full shadow-md w-[90%] h-[60%] relative z-0">

        <h1 class="text-center font-utama text-3xl pt-12 text-white">
            The Wedding Of
        </h1>

        <!-- Foto Pengantin -->
        <div x-show="show" x-transition:enter="transition ease-out duration-1000 delay-500"
            x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
            class="rounded-full bg-cover bg-center aspect-square w-[65%] mx-auto mt-10 border-4 border-[#F5E9D8]"
            style="background-image: url('{{ $invitation->getPhoto('c2') }}');">
        </div>
    </div>

    <!-- Bunga -->
    <img x-show="show" x-transition:enter="transition ease-out duration-1000 delay-700"
        x-transition:enter-start="opacity-0 -translate-x-10" x-transition:enter-end="opacity-100 translate-x-0"
        src="{{ asset('assets/png/eternalserenity/flower1.png') }}" alt="flower"
        class="absolute z-10 bottom-[28%] rotate-180 -left-10 w-[70%] h-auto">

    <!-- Nama Pengantin -->
    <div x-show="show" x-transition:enter="transition ease-out duration-1000 delay-1000"
        x-transition:enter-start="opacity-0 translate-y-5" x-transition:enter-end="opacity-100 translate-y-0"
        class="w-full mt-15">

        <h1 class="text-center font-utama text-5xl text-red-950">
            {{ $invitation->content['nama_pria'] }} & {{ $invitation->content['nama_wanita'] }}
        </h1>
        <p class="text-center font-poppins text-red-900/60 text-sm mt-2 uppercase tracking-widest">
            Save The Date
        </p>

        <div class="mt-2 font-poppins text-red-950 text-lg tracking-widest font-light text-center">
            {{ Carbon\Carbon::parse($invitation->content['tanggal_resepsi'])->format('d') }} <span
                class="mx-2 text-red-300">|</span>
            {{ Carbon\Carbon::parse($invitation->content['tanggal_resepsi'])->format('m') }} <span
                class="mx-2 text-red-300">|</span>
            {{ Carbon\Carbon::parse($invitation->content['tanggal_resepsi'])->format('Y') }}
        </div>
    </div>

</div>

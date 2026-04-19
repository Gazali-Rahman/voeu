<?php
use Livewire\Component;

new class extends Component {
    public $invitation;

    public function mount($invitation)
    {
        $this->invitation = $invitation;
    }
};
?>
<div class="flex flex-col py-10  overflow-hidden ">

    <!-- Header Section -->
    <div class="mb-10 relative px-2">
        <h2 class="font-utama text-5xl  text-[#8C5A3C] leading-none italic text-left">The</h2>
        <h2 class="font-utama text-5xl text-black leading-none ml-10 -mt-2 text-left">Ceremony</h2>
        <div class="w-10 h-[2px] bg-[#8C5A3C] mt-4 ml-2"></div>
    </div>

    <!-- Container Event dengan Background Coklat -->
    <div class="relative space-y-16 bg-[#8C5A3C] rounded-[3rem] py-16 px-6 shadow-md overflow-hidden">

        <!-- Ornamen Dekoratif Transparan di Background -->
        <div class="absolute top-0 right-0 w-40 h-40 bg-white/5 rounded-full -mr-20 -mt-20"></div>
        <div class="absolute bottom-0 left-0 w-40 h-40 bg-black/5 rounded-full -ml-20 -mb-20"></div>

        <!-- Bagian Akad Nikah (Rata Kiri) -->
        <div x-data="{ show: false }" x-intersect="show = true" class="relative">
            <div x-show="show" x-transition:enter="transition ease-out duration-1000"
                x-transition:enter-start="opacity-0 translate-x-10" x-transition:enter-end="opacity-100 translate-x-0"
                class="relative z-10">

                <div class="flex items-center gap-3 mb-6">
                    <!-- Icon Putih -->
                    <img src="{{ asset('/assets/png/tuscanywarmth/cincin1.png') }}" alt="Akad"
                        class="w-15 h-15 object-contain brightness-0 invert">
                    <h3 class="font-utama text-3xl text-white tracking-widest uppercase">Akad Nikah</h3>
                </div>

                <!-- Info Box dengan Garis Emas Terang -->
                <div class="border-l-[1.5px] border-white/40 pl-5 py-1">
                    <p class="font-poppins font-bold text-sm tracking-[0.2em] uppercase text-white">
                        {{ \Carbon\Carbon::parse($invitation->content['tanggal_akad'])->locale('id')->isoFormat('dddd, DD MMMM YYYY') }}
                    </p>
                    <p class="font-poppins text-[11px] text-white/70 mt-1 tracking-widest uppercase">
                        {{ \Carbon\Carbon::parse($invitation->content['tanggal_akad'])->locale('id')->isoFormat('HH:mm') }}
                        -
                        {{ \Carbon\Carbon::parse($invitation->content['tanggal_resepsi'])->locale('id')->isoFormat('HH:mm') }}
                    </p>
                    <div class="mt-6">
                        <p class="font-poppins font-semibold text-[11px] uppercase tracking-[0.15em] text-white/90">
                            {{ $invitation->content['tempat_akad'] }}</p>
                        <p class="font-poppins text-[10px] text-white/60 leading-relaxed mt-1 italic">
                            {{ $invitation->content['alamat_akad'] }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Divider Garis Putih Tipis -->
        <div class="w-full h-px bg-linear-to-r from-transparent via-white/20 to-transparent"></div>

        <!-- Bagian Resepsi (Rata Kanan) -->
        <div x-data="{ show: false }" x-intersect="show = true" class="relative">
            <div x-show="show" x-transition:enter="transition ease-out duration-1000 delay-300"
                x-transition:enter-start="opacity-0 -translate-x-10" x-transition:enter-end="opacity-100 translate-x-0"
                class="relative z-10 text-right">

                <div class="flex items-center justify-end gap-3 mb-6">
                    <h3 class="font-utama text-3xl text-white tracking-widest uppercase">Resepsi</h3>
                    <!-- Icon Putih -->
                    <img src="{{ asset('/assets/png/tuscanywarmth/glas2.png') }}" alt="Resepsi"
                        class="w-20 h-20 object-contain brightness-0 invert">
                </div>

                <!-- Info Box Rata Kanan -->
                <div class="border-r-[1.5px] border-white/40 pr-5 py-1">
                    <p class="font-poppins font-bold text-sm tracking-[0.2em] uppercase text-white">
                        {{ \Carbon\Carbon::parse($invitation->content['tanggal_resepsi'])->locale('id')->isoFormat('dddd, DD MMMM YYYY') }}
                    </p>
                    <p class="font-poppins text-[11px] text-white/70 mt-1 tracking-widest uppercase">
                        {{ \Carbon\Carbon::parse($invitation->content['tanggal_resepsi'])->locale('id')->isoFormat('HH:mm') }}
                        - Selesai
                    </p>
                    <div class="mt-6">
                        <p class="font-poppins font-semibold text-[11px] uppercase tracking-[0.15em] text-white/90">
                            {{ $invitation->content['tempat_resepsi'] }}</p>
                        <p class="font-poppins text-[10px] text-white/60 leading-relaxed mt-1 italic text-right">
                            {{ $invitation->content['alamat_resepsi'] }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tombol Google Maps -->
    <div x-data="{ show: false }" x-intersect="show = true" class="mt-12 flex justify-center w-full px-4">
        <div x-show="show" x-transition:enter="transition ease-out duration-700 delay-500"
            x-transition:enter-start="opacity-0 translate-y-5" x-transition:enter-end="opacity-100 translate-y-0"
            class="w-full">
            <a href="{{ $invitation->content['maps'] }}"
                class="group flex items-center justify-center gap-3 bg-[#8C5A3C] text-white font-poppins text-[11px] py-4 rounded-full shadow-xl tracking-[0.3em] uppercase active:scale-95 transition-all duration-300 border border-white/10">
                <i class="fa-solid fa-location-dot text-white/80"></i>
                Lihat Lokasi Acara
            </a>
        </div>
    </div>
</div>

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

<section class="relative w-full bg-[#F9F8F6] py-16 px-5 overflow-hidden max-w-md mx-auto text-gray-800">

    <div class="relative z-10 flex flex-col items-center">

        <!-- ========================================== -->
        <!-- HEADER / TITLE SECTION -->
        <!-- ========================================== -->
        <div x-data="{ show: false }" x-intersect.half.once="show = true"
            class="mb-10 flex flex-col items-center text-center">
            <h2 x-show="show" x-transition:enter="transition ease-out duration-1000"
                x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
                class="font-samantha text-4xl text-black mb-8 select-none">
                Bride & Groom
            </h2>
            <div x-show="show" x-transition:enter="transition ease-out duration-1000 delay-300"
                x-transition:enter-start="opacity-0 scale-75" x-transition:enter-end="opacity-100 scale-100"
                class="flex items-center gap-3">
                <div class="h-px w-10 bg-black/20"></div>
                <p class="font-indie text-xs tracking-[0.35em] uppercase text-black/60 font-bold">The Happy Couple</p>
                <div class="h-px w-10 bg-black/20"></div>
            </div>
        </div>

        <!-- ========================================== -->
        <!-- 1. MEMPELAI PRIA (THE GROOM) -->
        <!-- ========================================== -->
        <div x-data="{ show: false }" x-intersect.half.once="show = true"
            class="relative w-full flex flex-col items-start">

            <!-- Container Foto Figura Doodle (Di Kanan / self-end) -->
            <div class="relative w-60 sm:w-64 aspect-[3/4] self-end mr-2 sm:mr-4 z-10">

                <!-- Foto & Bingkai Doodle Sketsa -->
                <div x-show="show" x-transition:enter="transition ease-in-out duration-1200 delay-500"
                    x-transition:enter-start="opacity-0 translate-x-14"
                    x-transition:enter-end="opacity-100 translate-x-0"
                    class="relative w-full h-full flex items-center justify-center">

                    <div class="absolute inset-0 flex items-center justify-center z-10">
                        <img src="{{ $invitation->getPhoto('groom') }}" alt="Foto Mempelai Pria"
                            class="w-[59%] h-auto aspect-[3.1/4] border-2 border-black -rotate-6 object-cover shadow-md">
                    </div>

                    <img src="{{ asset('assets/png/esquisse/figura3.png') }}"
                        class="relative w-full h-auto -rotate-6 z-0 pointer-events-none drop-shadow-sm"
                        alt="Frame Groom">
                </div>
            </div>

            <!-- Nama Panggilan Mempelai Pria (Rata Kiri, Sejajar Biodata) -->
            <div x-show="show" x-transition:enter="transition ease-in-out duration-1200 delay-900"
                x-transition:enter-start="opacity-0 -translate-x-12 scale-90"
                x-transition:enter-end="opacity-100 translate-x-0 scale-100"
                class="-mt-10 ml-2 sm:ml-4 z-20 pointer-events-none select-none text-left">
                <h4 class="font-samantha text-black text-6xl sm:text-7xl leading-none drop-shadow-sm whitespace-nowrap">
                    {{ $invitation->content['nama_pria'] }}
                </h4>
            </div>

            <!-- Detail Biodata Groom (Rata Kiri dengan Border Line Vertikal) -->
            <div x-show="show" x-transition:enter="transition ease-in-out duration-1200 delay-1000"
                x-transition:enter-start="opacity-0 -translate-x-10" x-transition:enter-end="opacity-100 translate-x-0"
                class="mt-6 ml-2 sm:ml-4 text-left border-l-2 border-black/25 pl-4 max-w-[280px] z-10">

                <!-- Label Kategori -->
                <p class="font-indie text-xs text-black/50 font-bold tracking-[0.25em] uppercase mb-1">
                    The Groom
                </p>

                <!-- Nama Lengkap: Editorial Sans Poppins dengan Tracking Lebar -->
                <p class="font-poppins text-xs sm:text-[13px] tracking-[0.25em] uppercase font-bold text-black mb-2">
                    {{ $invitation->content['nama_pria_lengkap'] }}
                </p>

                <!-- Informasi Orang Tua -->
                <p class="font-indie text-xs text-gray-700 leading-relaxed mb-3">
                    {{ $invitation->content['label_ortu_pria'] }}<br>
                    <span class="font-bold text-black">Bpk. {{ $invitation->content['ayah_pria'] }}</span><br>
                    & <span class="font-bold text-black">Ibu {{ $invitation->content['ibu_pria'] }}</span>
                </p>

                <!-- Instagram Badge Link -->
                @if (!empty($invitation->content['instagram_pria']))
                    <div class="mt-3">
                        <a href="https://instagram.com/{{ ltrim($invitation->content['instagram_pria'], '@') }}"
                            target="_blank"
                            class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full border border-black/20 bg-white/70 hover:bg-black hover:text-white text-black/80 font-indie text-xs tracking-wider transition-all duration-300 shadow-2xs group">
                            <svg class="w-3.5 h-3.5 group-hover:scale-110 transition-transform" fill="currentColor"
                                viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.566.683.748 1.15.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span>{{ Str::startsWith($invitation->content['instagram_pria'], '@') ? $invitation->content['instagram_pria'] : '@' . $invitation->content['instagram_pria'] }}</span>
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <!-- ========================================== -->
        <!-- INTERLUDE CONNECTOR (AMPERSAND) -->
        <!-- ========================================== -->
        <div class="relative z-10 my-10 flex flex-col items-center justify-center" x-data="{ show: false }"
            x-intersect.half.once="show = true">
            <span x-show="show" x-transition:enter="transition ease-out duration-1000 delay-200"
                x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
                class="font-samantha text-5xl text-black/80 select-none">
                &
            </span>
        </div>

        <!-- ========================================== -->
        <!-- 2. MEMPELAI WANITA (THE BRIDE) -->
        <!-- ========================================== -->
        <div x-data="{ show: false }" x-intersect.half.once="show = true"
            class="relative w-full flex flex-col items-end">

            <!-- Container Foto Figura Doodle (Di Kiri / self-start) -->
            <div class="relative w-60 sm:w-64 aspect-[3/4] self-start ml-2 sm:ml-4 z-10">

                <!-- Foto & Bingkai Doodle Sketsa -->
                <div x-show="show" x-transition:enter="transition ease-in-out duration-1200 delay-500"
                    x-transition:enter-start="opacity-0 -translate-x-14"
                    x-transition:enter-end="opacity-100 translate-x-0"
                    class="relative w-full h-full flex items-center justify-center">

                    <div class="absolute inset-0 flex items-center justify-center z-10">
                        <img src="{{ $invitation->getPhoto('bride') }}" alt="Foto Mempelai Wanita"
                            class="w-[59%] h-auto aspect-[3.1/4] border-2 border-black rotate-6 object-cover shadow-md">
                    </div>

                    <img src="{{ asset('assets/png/esquisse/figura3.png') }}"
                        class="relative w-full h-auto rotate-6 z-0 pointer-events-none drop-shadow-sm"
                        alt="Frame Bride">
                </div>
            </div>

            <!-- Nama Panggilan Mempelai Wanita (Rata Kanan, Sejajar Biodata) -->
            <div x-show="show" x-transition:enter="transition ease-in-out duration-1200 delay-900"
                x-transition:enter-start="opacity-0 translate-x-12 scale-90"
                x-transition:enter-end="opacity-100 translate-x-0 scale-100"
                class="-mt-10 mr-2 sm:mr-4 z-20 pointer-events-none select-none text-right">
                <h4 class="font-samantha text-black text-6xl sm:text-7xl leading-none drop-shadow-sm whitespace-nowrap">
                    {{ $invitation->content['nama_wanita'] }}
                </h4>
            </div>

            <!-- Detail Biodata Bride (Rata Kanan dengan Border Line Vertikal) -->
            <div x-show="show" x-transition:enter="transition ease-in-out duration-1200 delay-1000"
                x-transition:enter-start="opacity-0 translate-x-10" x-transition:enter-end="opacity-100 translate-x-0"
                class="mt-6 mr-2 sm:mr-4 text-right border-r-2 border-black/25 pr-4 max-w-[280px] z-10">

                <!-- Label Kategori -->
                <p class="font-indie text-xs text-black/50 font-bold tracking-[0.25em] uppercase mb-1">
                    The Bride
                </p>

                <!-- Nama Lengkap: Editorial Sans Poppins dengan Tracking Lebar -->
                <p class="font-poppins text-xs sm:text-[13px] tracking-[0.25em] uppercase font-bold text-black mb-2">
                    {{ $invitation->content['nama_wanita_lengkap'] }}
                </p>

                <!-- Informasi Orang Tua -->
                <p class="font-indie text-xs text-gray-700 leading-relaxed mb-3">
                    {{ $invitation->content['label_ortu_wanita'] }}<br>
                    <span class="font-bold text-black">Bpk. {{ $invitation->content['ayah_wanita'] }}</span><br>
                    & <span class="font-bold text-black">Ibu {{ $invitation->content['ibu_wanita'] }}</span>
                </p>

                <!-- Instagram Badge Link -->
                @if (!empty($invitation->content['instagram_wanita']))
                    <div class="mt-3 flex justify-end">
                        <a href="https://instagram.com/{{ ltrim($invitation->content['instagram_wanita'], '@') }}"
                            target="_blank"
                            class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full border border-black/20 bg-white/70 hover:bg-black hover:text-white text-black/80 font-indie text-xs tracking-wider transition-all duration-300 shadow-2xs group">
                            <svg class="w-3.5 h-3.5 group-hover:scale-110 transition-transform" fill="currentColor"
                                viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.566.683.748 1.15.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span>{{ Str::startsWith($invitation->content['instagram_wanita'], '@') ? $invitation->content['instagram_wanita'] : '@' . $invitation->content['instagram_wanita'] }}</span>
                        </a>
                    </div>
                @endif
            </div>
        </div>

    </div>
</section>

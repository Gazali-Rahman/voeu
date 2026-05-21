<?php

use Livewire\Component;

new class extends Component {
    public $gallery;

    public function mount($invitation)
    {
        $content = is_string($invitation->content) ? json_decode($invitation->content, true) : $invitation->content;
        $photos = $content['dynamic_photos'] ?? [];

        $this->gallery = collect($photos)
            ->filter(function ($item) {
                return isset($item['label']) && str_contains($item['label'], 'gallery');
            })
            ->values()
            ->all();
    }
};
?>

<div>
    <style>
        .hide-scroll::-webkit-scrollbar {
            display: none;
        }

        .hide-scroll {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>

    <div class="py-20 px-6 relative flex flex-col items-center overflow-hidden">

        <div class="text-center z-10 mb-12">
            <p class="text-[9px] font-['Poppins'] text-[#3E2C23]/60 uppercase tracking-[0.5em] mb-3">
                Our Memories
            </p>
            <h2 class="text-4xl font-['Abigail'] text-[#3E2C23] drop-shadow-sm">Gallery</h2>
        </div>

        <div class="absolute top-1/3 -left-20 transform -rotate-90 origin-center z-0 opacity-[0.03] pointer-events-none">
            <span class="text-[8rem] font-['Abigail'] text-[#3E2C23] whitespace-nowrap">Amore Mio</span>
        </div>

        <div class="absolute top-0 -right-10 w-48 z-0  -rotate-90 pointer-events-none">
            <img src="{{ asset('assets/png/rusticbeige/bunga3.png') }}" alt="Bunga" class="w-full object-cover">
        </div>

        <div class="w-full flex flex-col gap-6 z-10 relative">

            <div class="flex items-end gap-4 w-full">
                <div
                    class="w-3/5 h-72 rounded-t-full rounded-b-4xl overflow-hidden shadow-lg border-4 border-white bg-gray-50 flex items-center justify-center">

                    <img src="{{ asset('storage/' . $gallery[0]['path']) }}" alt="Gallery 1"
                        class="w-full h-full object-cover object-center">

                </div>

                <div
                    class="w-2/5 h-44 rounded-tr-4xl rounded-bl-4xl rounded-tl-md rounded-br-md overflow-hidden shadow-lg border-4 border-white bg-gray-50 mb-4 flex items-center justify-center">

                    <img src="{{ asset('storage/' . $gallery[1]['path']) }}" alt="Gallery 2"
                        class="w-full h-full object-cover object-center">

                </div>
            </div>

            <div class="py-6 px-4 text-center flex flex-col items-center">
                <img src="{{ asset('assets/png/rusticbeige/bunga2.png') }}" alt="Bunga" class="w-20 h-auto mb-3">
                <p class="text-[11px] font-['Poppins'] text-[#3E2C23]/80 leading-relaxed tracking-wide italic">
                    "Dalam senyummu aku melihat sesuatu yang lebih indah dari bintang-bintang di langit."
                </p>
            </div>

            <div x-data="{ mainPhoto: '{{ count($gallery) > 0 ? asset('storage/' . $gallery[0]['path']) : $invitation->getPhoto('gallery1') }}' }" class="w-full flex flex-col gap-4 mt-4">

                <div
                    class="w-full h-128 rounded-[2.5rem] overflow-hidden shadow-xl border-4 border-white bg-gray-50 relative flex items-center justify-center">
                    <img :src="mainPhoto" alt="Main Gallery"
                        class="w-full h-full object-cover object-center transition-all duration-500">

                    <div
                        class="absolute inset-0 bg-linear-to-t from-black/50 via-transparent to-transparent pointer-events-none">
                    </div>
                    <p
                        class="absolute bottom-6 left-6 text-[10px] font-['Poppins'] text-white/90 uppercase tracking-[0.4em] drop-shadow-md">
                        Our Journey
                    </p>
                </div>

                <div class="flex gap-3 overflow-x-auto py-2 snap-x hide-scroll w-full">

                    @foreach ($gallery as $item)
                        @php
                            // Format path menggunakan 'storage/'
                            $imgUrl = asset('storage/' . $item['path']);
                        @endphp

                        <button @click="mainPhoto = '{{ $imgUrl }}'"
                            class="shrink-0 w-20 h-20 rounded-2xl overflow-hidden shadow-sm border-2 transition-all duration-300 snap-center focus:outline-none"
                            :class="mainPhoto === '{{ $imgUrl }}' ? 'border-[#3E2C23] scale-105 opacity-100 shadow-md' :
                                'border-white/50 opacity-60 hover:opacity-100'">
                            <img src="{{ $imgUrl }}" class="w-full h-full object-cover object-center">
                        </button>
                    @endforeach

                </div>
            </div>
        </div>

    </div>
</div>

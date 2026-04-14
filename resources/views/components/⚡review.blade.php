<?php

use Livewire\Component;

new class extends Component {
    public function with(): array
    {
        return [
            'reviews' => [
                [
                    'id' => 1,
                    'client_name' => 'Aditya & Sarah',
                    'date' => 'Maret 2026',
                    'rating' => 5,
                    'comment' => 'Desain Noir et Blanc benar-benar elevate pernikahan kami. Minimalis tapi terasa sangat mewah. Proses editnya juga cepat banget!',
                    'category' => 'Noir et Blanc',
                ],
                [
                    'id' => 2,
                    'client_name' => 'Dimas & Arini',
                    'date' => 'Februari 2026',
                    'rating' => 5,
                    'comment' => 'Voeu Digital memberikan pengalaman undangan yang berbeda. Tamu-tamu kami banyak yang memuji lagunya dan transisi videonya yang halus.',
                    'category' => 'Tuscany Warmth',
                ],
                [
                    'id' => 3,
                    'client_name' => 'Reza & Putri',
                    'date' => 'Januari 2026',
                    'rating' => 5,
                    'comment' => 'Suka banget sama layoutnya yang dreamy. Pas banget buat tema pernikahan garden party kami. Sangat worth it!',
                    'category' => 'Eternal Serenity',
                ],
                [
                    'id' => 4,
                    'client_name' => 'Budi & Maria',
                    'date' => 'Desember 2025',
                    'rating' => 4,
                    'comment' => 'Pelayanan ramah dan hasilnya sangat memuaskan. Terima kasih sudah membantu mewujudkan undangan impian kami.',
                    'category' => 'Noir et Blanc',
                ],
            ],
        ];
    }
};
?>

<div class="min-h-screen bg-[#F9F8F6] font-sans selection:bg-neutral-200 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-10 py-24" x-data="{
        active: 1,
        count: {{ count($reviews) }},
        scrollTo(id) {
            this.active = id;
            const el = document.getElementById('review-' + id);
            el.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
        }
    }">

        <div class="flex flex-col md:flex-row justify-between  mb-16 gap-8">
            <div class="space-y-6">
                <h1 class="text-5xl md:text-8xl font-utama tracking-[-0.04em] uppercase text-[#1a1a1a] leading-none">
                    Kind Words
                </h1>
                <div class="flex items-center gap-4">
                    <p
                        class="text-[10px] md:text-xs uppercase tracking-[0.6em] text-neutral-400 font-medium whitespace-nowrap">
                        From our lovely couples
                    </p>
                    <span class="h-px w-12 md:w-24 bg-neutral-300"></span>
                </div>
            </div>

            <div class="flex items-center gap-6">
                <button @click="active > 1 ? scrollTo(active - 1) : scrollTo(count)"
                    class="w-12 h-12 rounded-full border border-neutral-200 flex items-center justify-center hover:bg-[#1a1a1a] hover:text-white transition-all duration-500 group">
                    <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <div class="text-[10px] uppercase tracking-[0.4em] text-neutral-400">
                    <span class="text-[#1a1a1a] font-bold" x-text="active"></span> / <span x-text="count"></span>
                </div>
                <button @click="active < count ? scrollTo(active + 1) : scrollTo(1)"
                    class="w-12 h-12 rounded-full border border-neutral-200 flex items-center justify-center hover:bg-[#1a1a1a] hover:text-white transition-all duration-500 group">
                    <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
        </div>

        <div class="relative">
            <div class="flex overflow-x-auto snap-x snap-mandatory scrollbar-hide gap-8 pb-10" id="review-container">
                @foreach ($reviews as $review)
                    <div id="review-{{ $loop->iteration }}"
                        class="snap-center shrink-0 w-[85vw] md:w-[45vw] bg-white p-10 md:p-14 border border-neutral-100 flex flex-col justify-between transition-all duration-500 hover:shadow-xl hover:shadow-neutral-200/50 group first:ml-0">

                        <div class="space-y-8">
                            <div class="flex gap-1 text-[#1a1a1a]">
                                @for ($i = 0; $i < $review['rating']; $i++)
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                @endfor
                            </div>

                            <blockquote class="text-xl md:text-2xl text-[#1a1a1a] leading-relaxed font-light italic">
                                "{{ $review['comment'] }}"
                            </blockquote>
                        </div>

                        <div class="mt-12 pt-8 border-t border-neutral-50 flex items-end justify-between">
                            <div>
                                <h4 class="text-[11px] uppercase tracking-[0.4em] text-[#1a1a1a] font-bold mb-1">
                                    {{ $review['client_name'] }}
                                </h4>
                                <p class="text-[9px] uppercase tracking-[0.2em] text-neutral-400">
                                    {{ $review['date'] }} • {{ $review['category'] }}
                                </p>
                            </div>

                            <div class="text-neutral-100 group-hover:text-neutral-200 transition-colors duration-500">
                                <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.154c-2.41.913-3.996 3.638-3.996 5.845h3.997v10h-9.997z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="mt-12 w-full h-[2px] bg-neutral-100 relative">
            <div class="absolute h-full bg-[#1a1a1a] transition-all duration-500"
                :style="'width: ' + (active / count * 100) + '%;'"></div>
        </div>

    </div>
</div>

<style>
    /* Hide scrollbar for Chrome, Safari and Opera */
    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }

    /* Hide scrollbar for IE, Edge and Firefox */
    .scrollbar-hide {
        -ms-overflow-style: none;
        /* IE and Edge */
        scrollbar-width: none;
        /* Firefox */
    }
</style>

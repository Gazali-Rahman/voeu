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
<!-- Section: Love Story (The Narrative) -->
<div class="bg-white px-8 py-24 relative overflow-hidden">

    <!-- Header Section -->
    <div class="mb-20 text-center space-y-2" x-data="{ show: false }" x-intersect.once="show = true">
        <div class="transition-all duration-1000 transform"
            :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">
            <span class="font-serif italic text-xs text-gray-400 tracking-[0.4em] uppercase">Chronicles</span>
            <h2 class="font-vogue text-4xl text-black tracking-tighter uppercase">Our Narrative</h2>
            <div class="h-10 w-[0.5px] bg-black/20 mx-auto mt-6"></div>
        </div>
    </div>

    <div class="relative space-y-32">
        @if (isset($invitation->content['love_stories']))
            @foreach ($invitation->content['love_stories'] as $story)
                @if ($loop->last)
                    <div class="relative flex flex-col items-center text-center" x-data="{ show: false }"
                        x-intersect.once.margin.-10%="show = true">
                        <div class="transition-all duration-1000 transform"
                            :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">
                            <span
                                class="absolute -top-12 left-1/2 -translate-x-1/2 font-vogue text-[8rem] text-black/3 italic select-none z-0">{{ $story['year'] }}</span>
                            <div class="relative z-10 px-4">
                                <h3 class="font-vogue text-xl text-black uppercase tracking-[0.3em] mb-3">
                                    {{ $story['title'] }}</h3>
                                <p
                                    class="font-light text-[11px] text-gray-500 uppercase tracking-widest leading-relaxed max-w-[240px]">
                                    {{ $story['story'] }}
                                </p>
                            </div>

                            <div class="mt-12 flex flex-col items-center">
                                <div class="h-16 w-[0.5px] bg-linear-to-b from-black to-transparent transition-all duration-1000 delay-500"
                                    :class="show ? 'h-16 opacity-100' : 'h-0 opacity-0'"></div>
                                <img src="{{ asset('assets/png/noiretblanc/1.png') }}" class="w-6 h-6 mt-4 opacity-20">
                            </div>
                        </div>
                    </div>
                @elseif($loop->iteration % 2 != 0)
                    <div class="relative flex flex-col items-start" x-data="{ show: false }"
                        x-intersect.once.margin.-10%="show = true">
                        <div class="transition-all duration-1000 transform"
                            :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">
                            <span
                                class="absolute -top-12 left-0 font-vogue text-[8rem] text-black/3 italic select-none z-0">{{ $story['year'] }}</span>
                            <div class="relative z-10 pl-4 border-l border-black">
                                <h3 class="font-vogue text-xl text-black uppercase tracking-widest mb-3">
                                    {{ $story['title'] }}</h3>
                                <p
                                    class="font-light text-[11px] text-gray-500 uppercase tracking-widest leading-relaxed max-w-[200px]">
                                    {{ $story['story'] }}
                                </p>
                            </div>
                            <div class="mt-8 w-24 h-[0.5px] bg-black/10 transition-all duration-700 delay-500"
                                :class="show ? 'w-24 opacity-100' : 'w-0 opacity-0'"></div>
                        </div>
                    </div>
                @else
                    <div class="relative flex flex-col items-end text-right" x-data="{ show: false }"
                        x-intersect.once.margin.-10%="show = true">
                        <div class="transition-all duration-1000 transform"
                            :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">
                            <span
                                class="absolute -top-12 right-0 font-vogue text-[8rem] text-black/3 italic select-none z-0">{{ $story['year'] }}</span>
                            <div class="relative z-10 pr-4 border-r border-black">
                                <h3 class="font-vogue text-xl text-black uppercase tracking-widest mb-3">
                                    {{ $story['title'] }}</h3>
                                <p
                                    class="font-light text-[11px] text-gray-500 uppercase tracking-widest leading-relaxed max-w-[200px] ml-auto">
                                    {{ $story['story'] }}
                                </p>
                            </div>
                            <div class="mt-8 w-24 h-[0.5px] bg-black/10 ml-auto transition-all duration-700 delay-500"
                                :class="show ? 'w-24 opacity-100' : 'w-0 opacity-0'"></div>
                        </div>
                    </div>
                @endif
            @endforeach
        @endif
    </div>

    <!-- Background Accent Line -->
    <div class="absolute left-1/2 top-0 bottom-0 w-[0.5px] bg-black/3 -z-10"></div>
</div>

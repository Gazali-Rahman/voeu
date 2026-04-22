<?php
use Livewire\Component;

new class extends Component {
    public $lovestory;

    public function mount($invitation)
    {
        $this->lovestory = $invitation->content['love_stories'] ?? [];
    }
};
?>

<div class="bg-[#F5E9D8] py-10 px-4 overflow-hidden relative">


    <!-- Header Section -->
    <div x-data="{ show: false }" x-intersect="show = true" class="relative flex flex-col items-center mb-10">
        <div class="w-px h-24 bg-stone-800 mb-10 origin-top transition-transform duration-[1.5s]"
            :class="show ? 'scale-y-100' : 'scale-y-0'"></div>

        <span class="font-poppins text-[10px] tracking-[1em] text-stone-400 uppercase block mb-4 ml-2">The
            Chronicles</span>
        <h2 class="font-utama text-stone-800 text-6xl tracking-tighter text-center">
            Our <span class="italic font-light text-red-950">Story</span>
        </h2>
    </div>
    <div class="max-w-2xl mx-auto px-4">
        <div class="relative">
            <div class="absolute left-4  transform  h-full w-px bg-red-950/30"></div>

            <div class="space-y-12 relative">
                @foreach ($lovestory as $index => $story)
                    <div x-data="{ show: false }" x-intersect.margin.-20%="show = true"
                        class="relative flex items-center justify-between  w-full"
                        :style="'transition-delay: ' + ({{ $index }} * 150) + 'ms'"
                        :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10 transition-all duration-1000'">



                        <div class="absolute left-4 transform -translate-x-1/2 flex items-center justify-center z-10">
                            <div
                                class="w-4 h-4 rounded-full bg-[#F5E9D8] border-2 border-red-950 flex items-center justify-center">
                                <div class="w-1.5 h-1.5 rounded-full bg-red-950"></div>
                            </div>
                        </div>

                        <div class="w-full pl-12">
                            <div class="space-y-1">
                                <span
                                    class=" font-poppins text-[10px] tracking-[0.3em] text-red-950 font-bold uppercase block mb-1">
                                    {{ $story['year'] ?? '' }}
                                </span>

                                <h4 class="font-utama text-stone-800 text-xl leading-tight">
                                    {{ $story['title'] ?? '' }}
                                </h4>

                                <p class="font-poppins text-xs  text-stone-500 leading-relaxed italic max-w-sm">
                                    "{{ $story['story'] ?? '' }}"
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Footer Signature Left Aligned -->
    <div x-data="{ show: false }" x-intersect="show = true" class="max-w-xl mx-auto px-4 mt-10 ml-10 ">
        <div class="transition-all duration-[2s]" :class="show ? 'opacity-100' : 'opacity-0'">
            <p class="font-script text-stone-400 text-3xl mb-2">To be continued...</p>
            <div class="h-px w-24 bg-stone-300"></div>
            <h3 class="font-utama text-stone-800 text-[10px] tracking-[0.6em] uppercase mt-4 opacity-50">Endless Love
            </h3>
        </div>
    </div>
</div>

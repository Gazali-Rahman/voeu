<?php

use Livewire\Component;

new class extends Component {
    public function with(): array
    {
        return [
            'socials' => [['name' => 'Instagram', 'url' => '#'], ['name' => 'TikTok', 'url' => '#'], ['name' => 'Pinterest', 'url' => '#'], ['name' => 'WhatsApp', 'url' => '#']],
            'links' => [['name' => 'Catalog', 'url' => '#'], ['name' => 'Reviews', 'url' => '#'], ['name' => 'Terms & Conditions', 'url' => '#'], ['name' => 'Privacy Policy', 'url' => '#']],
        ];
    }
};
?>

<footer class="bg-[#1a1a1a] text-[#F9F8F6] pt-24 pb-12 font-sans">
    <div class="max-w-7xl mx-auto px-6 sm:px-10">

        <div class="grid grid-cols-1 md:grid-cols-12 gap-16 md:gap-8 mb-24">

            <div class="md:col-span-5 space-y-8">
                <h2 class="text-4xl md:text-5xl font-utama tracking-[-0.04em] uppercase leading-none">
                    Voeu<br><span class="text-neutral-500 font-poppins text-xs tracking-widest">Digital
                        Invitations</span>
                </h2>
            </div>

            <div class="md:col-span-3 space-y-6">
                <h4 class="text-[10px] uppercase tracking-[0.5em] text-neutral-500 font-bold">Explore</h4>
                <ul class="space-y-4">
                    @foreach ($links as $link)
                        <li>
                            <a href="{{ $link['url'] }}"
                                class="text-[11px] uppercase tracking-[0.2em] hover:text-neutral-400 transition-colors duration-300">
                                {{ $link['name'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="md:col-span-2 space-y-6">
                <h4 class="text-[10px] uppercase tracking-[0.5em] text-neutral-500 font-bold">Follow Us</h4>
                <ul class="space-y-4">
                    @foreach ($socials as $social)
                        <li>
                            <a href="{{ $social['url'] }}"
                                class="text-[11px] uppercase tracking-[0.2em] hover:text-neutral-400 transition-colors duration-300">
                                {{ $social['name'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="md:col-span-2 space-y-6 text-right md:text-left">
                <h4 class="text-[10px] uppercase tracking-[0.5em] text-neutral-500 font-bold">Location</h4>
                <p class="text-[11px] uppercase tracking-[0.2em] leading-loose text-neutral-300">
                    Banjarmasin,<br>South Kalimantan<br>Indonesia
                </p>
            </div>
        </div>
        <div class="flex flex-col md:flex-row justify-between items-center gap-6 pt-12 border-t border-neutral-800/50">
            <p class="text-[9px] uppercase tracking-[0.4em] text-neutral-600">
                &copy; {{ date('Y') }} Voeu Digital Invitations. All Rights Reserved.
            </p>

            <div class="flex items-center gap-4 text-[9px] uppercase tracking-[0.4em] text-neutral-600">
                <span>Created with love</span>
            </div>
        </div>
    </div>
</footer>

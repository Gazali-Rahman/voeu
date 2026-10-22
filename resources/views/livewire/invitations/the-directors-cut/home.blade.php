<div class="max-w-md mx-auto relative bg-[#EAE8E3]" x-data="{ isPlaying: true }" x-init="$nextTick(() => {
    const audio = document.getElementById('weddingMusic');
    if (audio) {
        audio.play().catch(() => {
            isPlaying = false;
        });
    }
})">

    <!-- Audio Element -->
    <audio id="weddingMusic" loop>
        <source src="{{ $invitation->getMusic() }}" type="audio/mpeg">
    </audio>

    @livewire('invitations.the-directors-cut.header', ['invitation' => $invitation])
    @livewire('invitations.the-directors-cut.qoutes')
    @livewire('invitations.the-directors-cut.bridegroom', ['invitation' => $invitation])
    @livewire('invitations.the-directors-cut.acara', ['invitation' => $invitation])
    @livewire('invitations.the-directors-cut.gallery', ['invitation' => $invitation])
    @livewire('invitations.the-directors-cut.lovestory', ['invitation' => $invitation])
    @livewire('invitations.the-directors-cut.rsvp', ['invitation' => $invitation])
    @livewire('invitations.the-directors-cut.gift', ['invitation' => $invitation])

    <!-- Floating Music Toggle -->
    <div class="fixed bottom-6 right-6 z-50">
        <button
            @click="
            const audio = document.getElementById('weddingMusic');
            if (audio.paused) { 
                audio.play(); 
                isPlaying = true; 
            } else { 
                audio.pause(); 
                isPlaying = false; 
            }
        "
            class="relative w-10 h-10 rounded-full flex items-center justify-center shadow-[0_0_20px_rgba(0,0,0,0.4)] transition-all duration-500 overflow-hidden group"
            :class="isPlaying ? 'animate-spin-slow' : ''"
            style="background: radial-gradient(circle, #1a1a1a 30%, #000 100%);">

            <!-- Tekstur Garis Piringan Hitam (Vinyl Grooves) -->
            <div class="absolute inset-0 opacity-40"
                style="background: repeating-radial-gradient(circle, transparent, transparent 2px, #333 3px);"></div>

            <!-- Label Tengah (Core Vinyl) - Monokrom (Abu-abu Gelap) Khas Director's Cut -->
            <div
                class="absolute w-5 h-5 bg-[#333333] rounded-full border-2 border-[#EAE8E3]/30 flex items-center justify-center">
            </div>

            <!-- Icon Music -->
            <div class="relative z-10 opacity-70 group-hover:opacity-100 transition-opacity">
                <!-- Icon Play -->
                <svg x-show="isPlaying" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#EAE8E3]" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                </svg>

                <!-- Icon Pause -->
                <svg x-show="!isPlaying" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#EAE8E3]"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z" />
                </svg>
            </div>
        </button>
    </div>
</div>

<style>
    @keyframes spin-slow {
        from {
            transform: rotate(0deg);
        }

        to {
            transform: rotate(360deg);
        }
    }

    .animate-spin-slow {
        animation: spin-slow 8s linear infinite;
    }
</style>

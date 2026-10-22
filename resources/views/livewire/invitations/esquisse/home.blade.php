<div class="max-w-md mx-auto relative bg-[#F9F8F6]" x-data="{ isPlaying: true }" x-init="$nextTick(() => {
    const audio = document.getElementById('weddingMusic');
    if (audio) {
        audio.play().catch(() => {
            isPlaying = false; // Jika gagal autoplay (kebijakan browser), set ke false
        });
    }
})">

    <!-- Audio Element -->
    @persist('music')
        <audio id="weddingMusic" loop>
            <source src="{{ $invitation->getMusic() }}" type="audio/mpeg">
        </audio>
    @endpersist

    @livewire('invitations.esquisse.header', ['invitation' => $invitation])

    @livewire('invitations.esquisse.qoutes')
    @livewire('invitations.esquisse.bridegroom', ['invitation' => $invitation])
    @livewire('invitations.esquisse.acara', ['invitation' => $invitation])
    @livewire('invitations.esquisse.gallery', ['invitation' => $invitation])
    @livewire('invitations.esquisse.lovestory', ['invitation' => $invitation])
    @livewire('invitations.esquisse.rsvp', ['invitation' => $invitation])
    @livewire('invitations.esquisse.gift', ['invitation' => $invitation])
    @livewire('invitations.footer')

    <!-- Floating Music Toggle (Vinyl Record) -->
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
            class="relative w-11 h-11 rounded-full flex items-center justify-center shadow-[0_0_20px_rgba(0,0,0,0.35)] transition-all duration-500 overflow-hidden group cursor-pointer focus:outline-none hover:scale-105"
            :class="isPlaying ? 'animate-spin-slow' : ''"
            style="background: radial-gradient(circle, #333333 30%, #111111 100%);">

            <!-- Tekstur Garis Piringan Hitam (Vinyl Grooves) -->
            <div class="absolute inset-0 opacity-30"
                style="background: repeating-radial-gradient(circle, transparent, transparent 2px, #555555 3px);"></div>

            <!-- Label Tengah (Core Vinyl) - Nuansa Paper Khas Esquisse -->
            <div
                class="absolute w-5 h-5 bg-[#F9F8F6] rounded-full border border-black/30 flex items-center justify-center">
            </div>

            <!-- Icon Music di Tengah -->
            <div class="relative z-10 opacity-80 group-hover:opacity-100 transition-opacity">
                <!-- Icon Play (Saat Musik Main) -->
                <svg x-show="isPlaying" xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-black" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                        d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                </svg>

                <!-- Icon Mute / Pause (Saat Musik Berhenti) -->
                <svg x-show="!isPlaying" xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-black"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
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

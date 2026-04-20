<div class="max-w-md mx-auto  overflow-hidden relative" x-data="{ isPlaying: true }" x-init="$nextTick(() => {
    const audio = document.getElementById('weddingMusic');
    if (audio) {
        audio.play().catch(() => {
            isPlaying = false; // Jika gagal autoplay, set ke false
        });
    }
})">
    <!-- Audio Element -->
    <audio id="weddingMusic" loop>
        <source src="{{ $invitation->getMusic() }}" type="audio/mpeg">
    </audio>
    @livewire('invitations.noir-et-blanc.header', ['invitation' => $invitation])
    @livewire('invitations.noir-et-blanc.qoutes')
    @livewire('invitations.noir-et-blanc.bridgegroom', ['invitation' => $invitation])
    @livewire('invitations.noir-et-blanc.acara', ['invitation' => $invitation])
    @livewire('invitations.noir-et-blanc.gallery', ['invitation' => $invitation])
    @livewire('invitations.noir-et-blanc.lovestory', ['invitation' => $invitation])
    @livewire('invitations.noir-et-blanc.rsvp', ['invitation' => $invitation])
    @livewire('invitations.noir-et-blanc.gift', ['invitation' => $invitation])
    <footer class="bg-[#1a1a1a] py-12">
        <div class="max-w-md mx-auto px-8 flex flex-col items-center">

            {{-- Brand Section --}}
            <div class="text-center group cursor-default">
                <h2 class="font-vogue text-white text-2xl tracking-[0.3em] uppercase">Voeu</h2>
                <p class="font-poppins text-white/30 text-[7px] tracking-[0.5em] uppercase mt-2">
                    The Art of Invitation
                </p>
            </div>

            {{-- Divider --}}
            <div class="w-12 h-px bg-white/10 my-8"></div>

            {{-- Links --}}
            <div class="flex gap-8 mb-8">
                <a href="https://voeudigitalinvitation.com"
                    class="font-poppins text-white/40 hover:text-white transition-all text-[9px] uppercase tracking-widest">Website</a>
                <a href="#"
                    class="font-poppins text-white/40 hover:text-white transition-all text-[9px] uppercase tracking-widest">Instagram</a>
            </div>

            {{-- Copyright --}}
            <div class="text-center space-y-1">
                <p class="font-poppins text-white/20 text-[8px] tracking-widest uppercase">
                    &copy; 2026 Voeu Digital Invitations
                </p>
                <p class="font-poppins text-white/10 text-[7px] tracking-tight">
                    Created with <span class="text-white/20">LOVE</span>
                </p>
            </div>

        </div>
    </footer>
    <!-- Floating Music Toggle -->
    <div class="fixed bottom-6 right-6 z-99">
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
            class="relative w-10 h-10 rounded-full flex items-center justify-center shadow-[0_0_20px_rgba(0,0,0,0.5)] transition-all duration-500 overflow-hidden group"
            :class="isPlaying ? 'animate-spin-slow' : ''"
            style="background: radial-gradient(circle, #222 30%, #000 100%);">

            <!-- Tekstur Garis Piringan Hitam (Vinyl Grooves) -->
            <div class="absolute inset-0 opacity-30"
                style="background: repeating-radial-gradient(circle, transparent, transparent 2px, #444 3px);"></div>

            <!-- Label Tengah (Core Vinyl) - Perpaduan Red 950 & Krem -->
            <div
                class="absolute w-5 h-5 bg-red-950 rounded-full border-2 border-[#F5E9D8]/30 flex items-center justify-center">
            </div>

            <!-- Icon Music (Muncul tipis di atas vinyl) -->
            <div class="relative z-10 opacity-60 group-hover:opacity-100 transition-opacity">
                <!-- Icon Play (Saat Musik Main) -->
                <svg x-show="isPlaying" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#F5E9D8]" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                </svg>

                <!-- Icon Pause (Saat Musik Berhenti) -->
                <svg x-show="!isPlaying" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#F5E9D8]"
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

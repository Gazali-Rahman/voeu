<div class="max-w-md mx-auto h-screen bg-[#f5e9da]">
    @livewire('invitations.javanese-essence.header', ['invitation' => $invitation])
    @livewire('invitations.javanese-essence.qoutes')
    @livewire('invitations.javanese-essence.bridgegroom', ['invitation' => $invitation])
    @livewire('invitations.javanese-essence.acara', ['invitation' => $invitation])
    @livewire('invitations.javanese-essence.gallery', ['invitation' => $invitation])
    @livewire('invitations.javanese-essence.lovestory', ['invitation' => $invitation])
    @livewire('invitations.javanese-essence.rsvp', ['invitation' => $invitation])
    @livewire('invitations.javanese-essence.gift', ['invitation' => $invitation])
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
</div>

<div class="max-w-md mx-auto h-screen bg-[#f5e9da]">
    @livewire('invitations.javanese-essence.header', ['invitation' => $invitation])
    @livewire('invitations.javanese-essence.qoutes')
    @livewire('invitations.javanese-essence.bridgegroom', ['invitation' => $invitation])
    @livewire('invitations.javanese-essence.acara', ['invitation' => $invitation])
    @livewire('invitations.javanese-essence.gallery', ['invitation' => $invitation])
    @livewire('invitations.javanese-essence.lovestory')
    {{-- <livewire:rsvp />
    <livewire:gift /> --}}
</div>

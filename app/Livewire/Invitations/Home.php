<?php

namespace App\Livewire\Invitations;

use App\Models\Invitation;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.invitation')]
class Home extends Component
{
    public $invitation;
    public $guestName;

    public function mount($slug)
    {
        // Ambil data yang sama seperti di Show
        $this->invitation = Invitation::with('catalog')
            ->where('slug', $slug)
            ->firstOrFail();
        $this->guestName = request()->query('to', 'Bapak/Ibu/Saudara/i');
    }

    public function render()
    {
        $templateName = $this->invitation->catalog->slug; // Misal: 'vintage-royal'

        // Arahkan ke blade home yang ada di dalam folder template tersebut
        return view('livewire.invitations.' . $templateName . '.home', [
            'invitation' => $this->invitation,
            'guestName' => $this->guestName
        ]);
    }
}

<?php

namespace App\Livewire\Invitations\Noiretblanc;

use App\Models\Invitation;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.invitation')]
class Home extends Component
{
    public $invitation;

    public function mount($slug)
    {
        // Ambil data yang sama seperti di Show
        $this->invitation = Invitation::with('catalog')
            ->where('slug', $slug)
            ->firstOrFail();
    }

    public function render()
    {
        $templateName = $this->invitation->catalog->slug; // Misal: 'vintage-royal'

        // Arahkan ke blade home yang ada di dalam folder template tersebut
        return view('livewire.invitations.' . $templateName . '.home');
    }
}

<?php

namespace App\Livewire\Invitations\Noiretblanc;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.invitation')]
class First extends Component
{
    public $guestName;
    public function mount()
    {
        // Ambil dari URL ?to=... jika tidak ada pakai default
        $this->guestName = request()->query('to', 'Bapak/Ibu/Saudara/i');
    }
    public function open()
    {
        // Masukkan logika tambahan di sini jika perlu
        return $this->redirect('/invitation/noiretblanc/home', navigate: true);
    }
    public function render()
    {
        return view('livewire.invitations.noiretblanc.first');
    }
}

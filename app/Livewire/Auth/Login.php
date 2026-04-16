<?php

namespace App\Livewire\Auth;

use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Layout('components.layouts.auth')]
#[Title('Voeu | Login')]
class Login extends Component
{
    public function render()
    {
        return view('livewire.auth.login');
    }
}

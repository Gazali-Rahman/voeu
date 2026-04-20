<?php

namespace App\Livewire\Invitations;

use Livewire\Component;
use App\Models\Invitation;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.invitation')]
class Show extends Component
{
    public $invitation;
    public $guestName;
    public function mount($slug)
    {
        // Mencari undangan berdasarkan slug yang ada di URL
        // Kita gunakan .with('catalog') agar bisa tahu template mana yang dipakai
        $this->invitation = Invitation::with('catalog')
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();
        $this->guestName = request()->query('to', 'Bapak/Ibu/Saudara/i');
    }
    public function open()
    {
        // Masukkan logika tambahan di sini jika perlu
        return $this->redirectRoute('invitation.home', [
            'slug' => $this->invitation->slug,
            'to' => $this->guestName
        ], navigate: true);
    }
    public function render()
    {
        $templateName = $this->invitation->catalog->slug;

        // Bagikan variabel ke layout secara global untuk request ini
        view()->share('invitation', $this->invitation);

        return view('livewire.invitations.' . $templateName . '.first', [
            'invitation' => $this->invitation,
            'guestName' => $this->guestName
        ]);
    }
}

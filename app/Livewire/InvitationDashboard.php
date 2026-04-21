<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;

#[Layout('components.layouts.app')]
#[Title('Voeu | Dashboard Undangan')]
class InvitationDashboard extends Component
{
    public $order;
    public $guestName;
    public $generatedLink;
    public $mainUrl;

    public function mount($slug)
    {
        // Pastikan hanya pemilik order yang bisa akses dashboard ini
        $this->order = Order::with('catalog')
            ->where('user_id', Auth::id())
            ->where('slug', $slug)
            ->firstOrFail();

        /**
         * Sesuai keinginanmu: wedding.voeu.id/slug
         * url() akan mengambil domain dari APP_URL di .env
         * Pastikan di .env APP_URL=https://wedding.voeu.id
         */
        $this->mainUrl = url('/v/' . $this->order->slug);
    }

    public function generateLink()
    {
        $this->validate([
            'guestName' => 'required|min:2',
        ]);

        // Link tamu dengan parameter 'to'
        $this->generatedLink = $this->mainUrl . '?to=' . urlencode($this->guestName);
    }
    public function render()
    {
        return view('livewire.invitation-dashboard');
    }
}

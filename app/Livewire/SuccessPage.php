<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class SuccessPage extends Component
{
    public $order;

    public function mount($external_id)
    {
        // Kita cari berdasarkan external_id karena Xendit mengirim balik ID ini
        $this->order = Order::where('external_id', $external_id)->firstOrFail();
    }
    public function render()
    {
        return view('livewire.success-page');
    }
}

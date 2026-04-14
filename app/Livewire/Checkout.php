<?php

namespace App\Livewire;

use App\Models\Catalog;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class Checkout extends Component
{
    public $catalog;
    public $name, $phone;
    public $groom_name, $bride_name; // Field baru untuk mempelai

    public function mount($id)
    {
        $this->catalog = Catalog::findOrFail($id);

        // Opsional: Prefill nama jika user sudah login
        if (Auth::check()) {
            $this->name = Auth::user()->name;
        }
    }


    public function processCheckout()
    {
        $this->validate([
            'name' => 'required|min:3',
            'phone' => 'required|numeric',
            'groom_name' => 'required|min:2|max:50',
            'bride_name' => 'required|min:2|max:50',
        ]);

        $externalId = 'VOEU-' . strtoupper(Str::random(10));

        /**
         * Generate Slug untuk URL: wedding.voeu.id/rinaldi-hanny-xxxxx
         * Kita tambahkan 5 karakter random di belakang agar unik 
         * meskipun ada pasangan dengan nama yang sama.
         */
        $slug = Str::slug($this->groom_name . ' ' . $this->bride_name) . '-' . Str::lower(Str::random(5));

        $order = Order::create([
            'external_id' => $externalId,
            'catalog_id' => $this->catalog->id,
            'user_id' => Auth::id(),
            'customer_name' => $this->name,
            'customer_phone' => $this->phone,
            'groom_name' => $this->groom_name,
            'bride_name' => $this->bride_name,
            'slug' => $slug,
            'amount' => $this->catalog->price,
            'status' => 'pending',
        ]);

        return redirect()->route('payment', ['order_id' => $order->id]);
    }


    public function render()
    {
        return view('livewire.checkout');
    }
}

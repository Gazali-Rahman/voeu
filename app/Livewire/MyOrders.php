<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class MyOrders extends Component
{
    public $showRatingModal = false;
    public $selectedOrder;
    public $rating_stars = 5;
    public $rating_comment = '';

    public function openRatingModal($externalId)
    {
        // Ambil data order berdasarkan externalId
        $this->selectedOrder = Order::where('external_id', $externalId)->first();

        if ($this->selectedOrder) {
            // Ini yang paling penting: Ubah status modal jadi true
            $this->showRatingModal = true;
        }
    }

    public function submitRating()
    {
        $this->validate([
            'rating_stars' => 'required|integer|min:1|max:5',
            'rating_comment' => 'nullable|string|max:500',
        ]);

        Rating::create([
            'order_id' => $this->selectedOrder->id,
            'catalog_id' => $this->selectedOrder->catalog_id,
            'user_id' => Auth::id(),
            'stars' => $this->rating_stars,
            'comment' => $this->rating_comment,
        ]);

        $this->showRatingModal = false; // Tutup modal
        $this->reset(['rating_stars', 'rating_comment']);
        session()->flash('message', 'Thank you! Your rating has been submitted.');
    }
    public function render()
    {
        $orders = Order::with(['catalog', 'ratings'])
            ->where('user_id', Auth::id()) // Pastikan user_id sudah ada di migrasi
            ->latest()
            ->get();

        return view('livewire.my-orders', [
            'orders' => $orders
        ]);
    }
}

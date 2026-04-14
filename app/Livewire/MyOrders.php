<?php

namespace App\Livewire;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class MyOrders extends Component
{
    public function render()
    {
        $orders = Order::with('catalog')
            ->where('user_id', Auth::id()) // Pastikan user_id sudah ada di migrasi
            ->latest()
            ->get();

        return view('livewire.my-orders', [
            'orders' => $orders
        ]);
    }
}

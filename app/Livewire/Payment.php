<?php

namespace App\Livewire;

use App\Models\Order;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Midtrans\Config;
use Midtrans\Snap;

#[Layout('components.layouts.app')]
class Payment extends Component
{
    public $order;

    public function mount($external_id)
    {
        $this->order = Order::with(['catalog', 'user'])
            ->where('external_id', $external_id)
            ->firstOrFail();
    }

    /**
     * Nama fungsi diubah menjadi lebih umum
     */
    public function processPayment()
    {
        // 1. Cek jika sudah ada Snap Token di database
        if ($this->order->checkout_url && $this->order->status === 'pending') {
            // Gunakan dispatch untuk memicu JavaScript Snap di front-end
            $this->dispatch('pay-via-midtrans', snapToken: $this->order->checkout_url);
            return;
        }
        // 2. Konfigurasi Midtrans
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => $this->order->external_id,
                'gross_amount' => (int) $this->order->amount,
            ],
            'customer_details' => [
                'first_name' => $this->order->customer_name,
                'phone' => $this->order->customer_phone,
                'email' => $this->order->user->email,
            ],
            // Mengaktifkan metode yang umum digunakan
        ];

        try {
            $snapToken = Snap::getSnapToken($params);

            // Simpan Snap Token agar tidak perlu generate ulang jika page reload
            $this->order->update([
                'checkout_url' => $snapToken
            ]);

            $this->dispatch('pay-via-midtrans', snapToken: $snapToken);
        } catch (\Exception $e) {
            Log::error('Midtrans Error: ' . $e->getMessage());
            session()->flash('error', 'Gagal memproses pembayaran. Silakan coba beberapa saat lagi.');
        }
    }

    public function render()
    {
        return view('livewire.payment');
    }
}

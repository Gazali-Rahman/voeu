<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\Promo;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Midtrans\Config;
use Midtrans\Snap;

#[Layout('components.layouts.app')]
#[Title('Voeu | Payment')]
class Payment extends Component
{
    public $order;
    public $promoCode;
    public $discount = 0;
    public $finalAmount;
    public $hasAppliedPromo = false;

    public function mount($external_id)
    {
        // Load order beserta relasi catalog dan promo yang baru ditambahkan
        $this->order = Order::with(['catalog', 'user', 'promo'])
            ->where('external_id', $external_id)
            ->firstOrFail();

        // Ambil harga dasar dari catalog sebagai patokan utama
        $basePrice = $this->order->catalog->price;

        // Cek apakah di database sudah ada promo_id terpasang
        if ($this->order->promo_id) {
            $this->hasAppliedPromo = true;
            $this->promoCode = $this->order->promo->code;

            // Hitung potongan dari basePrice (harga katalog)
            if ($this->order->promo->type === 'percent') {
                $this->discount = ($basePrice * $this->order->promo->value) / 100;
            } else {
                $this->discount = $this->order->promo->value;
            }
        }

        // Kalkulasi harga akhir
        $this->finalAmount = max(0, $basePrice - $this->discount);

        // Pastikan nominal amount di tabel orders selalu sinkron dengan kalkulasi
        // Ini mencegah selisih harga jika user refresh halaman setelah apply promo
        if ((int)$this->order->amount != (int)$this->finalAmount) {
            $this->order->update(['amount' => (int)$this->finalAmount]);
        }
    }

    public function applyPromo()
    {
        if ($this->order->checkout_url) {
            session()->flash('error_promo', 'Pembayaran sedang diproses, promo tidak bisa diubah.');
            return;
        }
        // Cegah apply ulang jika sudah ada promo_id di database atau variabel lokal
        if ($this->hasAppliedPromo || $this->order->promo_id) {
            session()->flash('error_promo', 'Promo sudah terpasang untuk pesanan ini.');
            return;
        }

        $promo = Promo::where('code', strtoupper($this->promoCode))
            ->where('is_active', true)
            ->where(function ($query) {
                $query->whereNull('expires_at')->orWhere('expires_at', '>=', now());
            })
            ->whereColumn('used', '<', 'limit')
            ->first();

        if (!$promo) {
            session()->flash('error_promo', 'Kode promo tidak valid atau sudah tidak tersedia.');
            return;
        }

        $basePrice = $this->order->catalog->price;

        if ($promo->type === 'percent') {
            $this->discount = ($basePrice * $promo->value) / 100;
        } else {
            $this->discount = $promo->value;
        }

        $this->finalAmount = max(0, $basePrice - $this->discount);

        // SIMPAN PERMANEN KE DATABASE
        // Menghapus checkout_url memaksa Midtrans membuat sesi baru dengan harga baru
        $this->order->update([
            'amount' => (int) $this->finalAmount,
            'promo_id' => $promo->id,
            'checkout_url' => null
        ]);

        $this->hasAppliedPromo = true;
        session()->flash('success_promo', 'Promo berhasil diterapkan!');
    }
    public function resetPromo()
    {
        if ($this->order->checkout_url) {
            session()->flash('error_promo', 'Promo tidak bisa dihapus karena sesi pembayaran sudah dibuat.');
            return;
        }
        // 1. Kembalikan harga ke harga asli katalog
        $basePrice = $this->order->catalog->price;

        // 2. Update Database: Hapus promo_id dan kembalikan amount
        // Kita juga hapus checkout_url karena harga berubah balik ke normal
        $this->order->update([
            'amount' => (int) $basePrice,
            'promo_id' => null,
        ]);

        // 3. Reset variabel lokal Livewire
        $this->discount = 0;
        $this->finalAmount = $basePrice;
        $this->promoCode = '';
        $this->hasAppliedPromo = false;

        session()->flash('success_promo', 'Promo telah dihapus.');
    }

    public function processPayment()
    {
        // Refresh data order untuk memastikan amount paling update dari DB yang digunakan
        $this->order->refresh();
        // Jika sudah ada checkout_url, jangan izinkan apply promo baru
        if ($this->order->promo_id) {
            $checkPromo = Promo::find($this->order->promo_id);

            // Cek apakah tiba-tiba promo jadi tidak aktif atau limit habis sebelum bayar
            if (!$checkPromo || !$checkPromo->is_active || ($checkPromo->used >= $checkPromo->limit)) {
                $this->resetPromo(); // Otomatis copot promo
                session()->flash('error', 'Maaf, kuota promo ini baru saja habis. Harga dikembalikan ke normal.');
                return;
            }
        }
        // 1. Jika sudah punya Snap Token dan harganya masih sama, langsung tampilkan popup
        if ($this->order->checkout_url && $this->order->status === 'pending') {
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
                'order_id' => $this->order->external_id, // Tetap ID asli tanpa suffix
                'gross_amount' => (int) $this->order->amount,
            ],
            'customer_details' => [
                'first_name' => $this->order->customer_name,
                'phone' => $this->order->customer_phone,
                'email' => $this->order->user->email,
            ],
            'item_details' => [
                [
                    'id' => $this->order->catalog->id,
                    'price' => (int) $this->order->amount,
                    'quantity' => 1,
                    'name' => $this->order->catalog->name,
                ]
            ]
        ];

        try {
            $snapToken = Snap::getSnapToken($params);

            // Simpan token baru agar jika ditutup bisa dibuka kembali tanpa hit API lagi
            $this->order->update([
                'checkout_url' => $snapToken
            ]);

            $this->dispatch('pay-via-midtrans', snapToken: $snapToken);
        } catch (\Exception $e) {
            // Menangani error 406 (Duplicate Order ID dengan harga berbeda)
            if (str_contains($e->getMessage(), '406')) {
                session()->flash('error', 'Terdapat kendala sesi pembayaran. Silakan tunggu 1-2 menit atau hubungi CS.');
            } else {
                session()->flash('error', 'Gagal memproses pembayaran. Silakan coba lagi.');
            }
        }
    }

    public function render()
    {
        return view('livewire.payment');
    }
}

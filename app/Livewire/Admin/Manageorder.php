<?php

namespace App\Livewire\Admin;

use App\Models\Order;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;


#[Layout('components.layouts.admin')]
class Manageorder extends Component
{
    use WithPagination;

    public function markAsCompleted($orderId)
    {
        $order = Order::findOrFail($orderId);

        if ($order->status === 'proses') {
            $order->update(['status' => 'selesai']);
            session()->flash('message', 'Order #' . $order->external_id . ' telah diselesaikan.');
        }
    }
    public function markAsProses($orderId)
    {
        $order = \App\Models\Order::findOrFail($orderId);
        $order->update(['status' => 'proses']);

        session()->flash('message', 'Pesanan berhasil dikonfirmasi ke proses.');
    }
    public function getWhatsAppLink($orderId)
    {
        $order = Order::with('catalog')->findOrFail($orderId);

        // 1. Bersihkan nomor dan tambahkan kode negara 62
        $phone = '62' . ltrim(preg_replace('/[^0-9]/', '', $order->customer_phone), '0');

        // 2. Susun Format Teks Lengkap
        $text = "VOEU DIGITAL INVITATIONS — DATA FORM\n\n";
        $text .= "Halo Kak {$order->customer_name}, mohon lengkapi data berikut untuk pesanan {$order->catalog->name} (ID: {$order->external_id}):\n\n";

        $text .= "1. DATA MEMPELAI\n";
        $text .= "- Nama Lengkap Pria:\n";
        $text .= "- Orang Tua Pria (Ayah & Ibu):\n";
        $text .= "- Nama Lengkap Wanita:\n";
        $text .= "- Orang Tua Wanita (Ayah & Ibu):\n\n";

        $text .= "2. DETAIL ACARA (AKAD/RESEPSI)\n";
        $text .= "- Tanggal & Waktu:\n";
        $text .= "- Lokasi/Alamat Lengkap:\n";
        $text .= "- Link Google Maps:\n\n";

        $text .= "3. KONTEN TAMBAHAN\n";
        $text .= "- Link Google Drive (Foto/Video):\n";
        $text .= "- Username IG (Mempelai):\n";
        $text .= "- No. Rekening/E-Wallet (Gift):\n";
        $text .= "- Lagu (Judul & Artis):\n\n";

        $text .= "Terima kasih.";

        // 3. Kembalikan URL lengkap
        return "https://wa.me/{$phone}?text=" . urlencode($text);
    }
    public function render()
    {
        return view('livewire.admin.manageorder', [
            'orders' => Order::with('catalog')->latest()->paginate(10)
        ]);
    }
}

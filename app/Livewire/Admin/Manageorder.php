<?php

namespace App\Livewire\Admin;

use App\Models\Order;
use Illuminate\Support\Facades\Storage;
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

        $text .= "2. DETAIL ACARA (AKAD)\n";
        $text .= "- Tanggal & Waktu:\n";
        $text .= "- Lokasi/Alamat Lengkap:\n";

        $text .= "3. DETAIL ACARA (RESEPSI)\n";
        $text .= "- Tanggal & Waktu:\n";
        $text .= "- Lokasi/Alamat Lengkap:\n";
        $text .= "- Link Google Maps:\n";

        $text .= "4. KONTEN TAMBAHAN\n";
        $text .= "- Link Google Drive (Foto/Video):\n";
        $text .= "- Username IG (Mempelai):\n";
        $text .= "- No. Rekening/E-Wallet (Gift):\n";
        $text .= "- Lagu (Judul & Artis):\n\n";

        $text .= "Terima kasih.";

        // 3. Kembalikan URL lengkap
        return "https://wa.me/{$phone}?text=" . urlencode($text);
    }

    public function deleteOrder($id)
    {
        $order = Order::with('invitation')->findOrFail($id);

        // 1. Bersihkan File di Storage jika ada undangan
        if ($order->invitation) {
            $directory = 'invitations/' . $order->invitation->slug;
            if (Storage::disk('public')->exists($directory)) {
                Storage::disk('public')->deleteDirectory($directory);
            }
        }

        // 2. Hapus Order
        // Karena onDelete('cascade'), data di tabel invitations otomatis terhapus
        $order->delete();

        session()->flash('success', 'Order dan semua asset terkait berhasil dihapus.');
    }
    public function render()
    {
        return view('livewire.admin.manageorder', [
            'orders' => Order::with('catalog')->latest()->paginate(10)
        ]);
    }
}

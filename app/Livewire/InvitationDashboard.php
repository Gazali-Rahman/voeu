<?php

namespace App\Livewire;

use App\Models\Order;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
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
        $this->order = Order::with(['catalog', 'invitation']) // Tambahkan 'invitation' di sini
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

    #[Computed()]
    public function waLink()
    {
        // 1. Ambil data dari relasi invitation
        $invitation = $this->order->invitation;
        $content = $invitation->content ?? [];

        // 2. Ambil detail dari array content
        $pria   = $content['nama_pria'] ?? '';
        $wanita = $content['nama_wanita'] ?? '';
        $lokasi = $content['tempat_resepsi'] ?? '';
        $alamat = $content['alamat_resepsi'] ?? '';

        // 3. Formatting Tanggal & Waktu (Carbon)
        $tanggalRaw = $content['tanggal_resepsi'] ?? null;

        // Hasil: Minggu, 19 April 2026
        $tanggalFormatted = $tanggalRaw
            ? Carbon::parse($tanggalRaw)->locale('id')->translatedFormat('l, d F Y')
            : '-';

        // Hasil: 23:00 WIB
        $jamFormatted = $tanggalRaw
            ? Carbon::parse($tanggalRaw)->format('H:i') . ' WITA'
            : '-';

        // Gunakan Emoji asli di dalam string (bukan kode icon)
        $message = "Assalamu’alaikum Warahmatullahi Wabarakatuh.\n\n" .
            "Tanpa mengurangi rasa hormat, izinkan kami mengundang Bapak/Ibu/Saudara/i *{$this->guestName}* untuk hadir dan memberikan doa restu pada acara pernikahan kami:\n\n" .
            "*{$pria} & {$wanita}*\n\n" .
            "Yang insya Allah akan dilaksanakan pada:\n\n" .
            "🗓️ *{$tanggalFormatted}*\n" .
            "⏰ *{$jamFormatted}*\n" .
            "📍 *{$lokasi}*\n" .
            "🏠 *{$alamat}*\n\n" .
            "Informasi lengkap mengenai acara dapat diakses melalui tautan undangan digital berikut:\n" .
            "{$this->generatedLink}\n\n" .
            "Merupakan suatu kehormatan bagi kami apabila Bapak/Ibu/Saudara/i *{$this->guestName}* berkenan hadir. Terima kasih.";

        return "https://wa.me/?text=" . rawurlencode($message);
    }
    public function render()
    {
        return view('livewire.invitation-dashboard');
    }
}

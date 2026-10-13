<?php

namespace App\Console\Commands;

use App\Models\Order;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class NotifyOrderTelegram extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:notify-telegram {order_id? : ID pesanan (opsional, jika kosong akan mengambil pesanan sukses terakhir)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Kirim ulang notifikasi pesanan ke Telegram Admin Bot';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $orderId = $this->argument('order_id');

        if ($orderId) {
            $order = Order::with('catalog')->where('id', $orderId)->orWhere('external_id', $orderId)->first();
        } else {
            $order = Order::with('catalog')
                ->whereIn('status', ['proses', 'paid', 'selesai'])
                ->latest()
                ->first();
        }

        if (!$order) {
            $this->error('Pesanan tidak ditemukan!');
            return 1;
        }

        $botToken = config('services.telegram.bot_token') ?? env('TELEGRAM_BOT_TOKEN');
        $adminId = config('services.telegram.admin_id') ?? env('TELEGRAM_ADMIN_ID');

        if (empty($botToken)) {
            $this->error('TELEGRAM_BOT_TOKEN belum diatur!');
            return 1;
        }

        if (empty($adminId)) {
            $this->error('TELEGRAM_ADMIN_ID belum diatur!');
            return 1;
        }

        $catalogName = $order->catalog ? $order->catalog->name : 'N/A';
        $amount = number_format($order->amount, 0, ',', '.');

        $text = "🚨 *ORDERAN BARU LUNAS!*\n\n"
              . "👤 Nama: {$order->customer_name}\n"
              . "📱 WA: {$order->customer_phone}\n"
              . "💰 Total: Rp {$amount}\n"
              . "🏷 Template: {$catalogName}\n\n"
              . "Pesanan sudah otomatis berstatus PROSES. Segera dicek ya Bos!";

        $response = Http::post("https://api.telegram.org/bot{$botToken}/sendMessage", [
            'chat_id' => $adminId,
            'text' => $text,
            'parse_mode' => 'Markdown'
        ]);

        if ($response->successful()) {
            $this->info("Berhasil mengirim notifikasi order #{$order->external_id} ({$order->customer_name}) ke Telegram Admin!");
            return 0;
        }

        $this->error("Gagal mengirim ke Telegram API: " . $response->body());
        return 1;
    }
}

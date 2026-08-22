<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MidtransController extends Controller
{
    public function callback(Request $request)
    {
        $serverKey = config('services.midtrans.server_key');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        // Validasi Signature: Memastikan data benar-benar dari Midtrans
        if ($hashed !== $request->signature_key) {
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        $order = Order::where('external_id', $request->order_id)->first();

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        // Logika status Midtrans
        $transactionStatus = $request->transaction_status;
        $type = $request->payment_type;
        $fraud = $request->fraud_status;
        $isSuccess = false;
        if ($transactionStatus == 'capture') {
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    $order->update(['status' => 'pending']);
                } else {
                    $order->update(['status' => 'paid']);
                    $isSuccess = true;
                }
            }
        } elseif ($transactionStatus == 'settlement') {
            // Pembayaran berhasil (QRIS, VA, dll)
            $order->update(['status' => 'proses']);
            $isSuccess = true;
        } elseif ($transactionStatus == 'pending') {
            $order->update(['status' => 'pending']);
        } elseif ($transactionStatus == 'deny' || $transactionStatus == 'expire' || $transactionStatus == 'cancel') {
            $order->update(['status' => 'failed']);
        }
        // LOGIKA INCREMENT PROMO
        // Kita hanya increment jika pembayaran sukses DAN orderan memiliki promo_id
        // Tambahkan pengecekan agar tidak increment berulang (idempotency)
        if ($isSuccess && $order->promo_id) {
            // Gunakan DB::transaction untuk memastikan data konsisten
            DB::transaction(function () use ($order) {
                $promo = $order->promo;
                if ($promo) {
                    // Cek lagi apakah 'used' sudah di-increment untuk order ini sebelumnya 
                    // (Opsional, tapi bagus untuk mencegah double count jika Midtrans kirim callback 2x)
                    $promo->increment('used');
                }
            });
        }

        // --- NOTIFIKASI TELEGRAM OTOMATIS ---
        if ($isSuccess) {
            $botToken = env('TELEGRAM_BOT_TOKEN');
            $adminId = env('TELEGRAM_ADMIN_ID');
            
            if ($botToken && $adminId) {
                $catalogName = $order->catalog ? $order->catalog->name : 'N/A';
                $amount = number_format($order->amount, 0, ',', '.');
                
                $text = "🚨 *ORDERAN BARU LUNAS!*\n\n"
                      . "👤 Nama: {$order->customer_name}\n"
                      . "📱 WA: {$order->customer_phone}\n"
                      . "💰 Total: Rp {$amount}\n"
                      . "🏷 Template: {$catalogName}\n\n"
                      . "Pesanan sudah otomatis berstatus PROSES. Segera dicek ya Bos!";

                // Kirim Notifikasi via Telegram API
                \Illuminate\Support\Facades\Http::post("https://api.telegram.org/bot{$botToken}/sendMessage", [
                    'chat_id' => $adminId,
                    'text' => $text,
                    'parse_mode' => 'Markdown'
                ]);
            }
        }

        return response()->json(['message' => 'Callback handled successfully']);
    }
}

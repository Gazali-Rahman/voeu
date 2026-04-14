<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

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

        if ($transactionStatus == 'capture') {
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    $order->update(['status' => 'pending']);
                } else {
                    $order->update(['status' => 'paid']);
                }
            }
        } elseif ($transactionStatus == 'settlement') {
            // Pembayaran berhasil (QRIS, VA, dll)
            $order->update(['status' => 'proses']);
        } elseif ($transactionStatus == 'pending') {
            $order->update(['status' => 'pending']);
        } elseif ($transactionStatus == 'deny' || $transactionStatus == 'expire' || $transactionStatus == 'cancel') {
            $order->update(['status' => 'failed']);
        }

        return response()->json(['message' => 'Callback handled successfully']);
    }
}

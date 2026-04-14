<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    public function handleXendit(Request $request)
    {
        // Xendit mengirim data dalam bentuk JSON
        $data = $request->all();

        // Cari base external_id dengan membuang '-ATTEMPT-xx' (jika ada) menggunakan explode
        $xenditExternalId = $data['external_id'] ?? '';
        $externalIdParts = explode('-ATTEMPT-', $xenditExternalId);
        $orderExternalId = $externalIdParts[0];

        // Cari order berdasarkan external_id aslinya
        $order = Order::where('external_id', $orderExternalId)->first();

        if ($order) {
            // Jika status dari Xendit adalah PAID atau SETTLED
            if ($data['status'] === 'PAID' || $data['status'] === 'SETTLED') {
                $order->update([
                    'status' => 'proses' // Sesuai flow bisnis Anda
                ]);
            }

            return response()->json(['message' => 'Success'], 200);
        }

        return response()->json(['message' => 'Order not found'], 404);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TelegramWebhookController extends Controller
{
    /**
     * Handle the incoming Telegram webhook request.
     */
    public function handle(Request $request)
    {
        // 1. Ekstrak data dari Telegram Webhook
        $update = $request->all();

        // Pastikan ini pesan teks biasa
        if (!isset($update['message']['text'])) {
            return response()->json(['status' => 'success']); // Hiraukan tipe update lain
        }

        $chatId = $update['message']['chat']['id'];
        $text = $update['message']['text'];

        // 2. Jika command /start
        if ($text === '/start') {
            $this->sendMessage($chatId, "Halo! Saya adalah Agent AI Anda. Ada yang bisa saya bantu hari ini?");
            return response()->json(['status' => 'success']);
        }

        // 3. Teruskan ke Gemini
        try {
            $aiResponseText = $this->askGemini($text);

            // 4. Kirim balik balasan ke Telegram
            $this->sendMessage($chatId, $aiResponseText);
        } catch (\Exception $e) {
            Log::error("Telegram/Gemini Error: " . $e->getMessage());
            $this->sendMessage($chatId, "Maaf, sistem AI sedang mengalami gangguan saat ini.");
        }

        return response()->json(['status' => 'success']);
    }

    /**
     * Kirim chat ke Google AI Studio (Gemini) dan dapatkan string balasannya.
     */
    private function askGemini($message)
    {
        $apiKey = env('GROQ_API_KEY');

        // --- INJEKSI KONTEKS DATA (BUSINESS SNAPSHOT) ---
        // 1. Data Pengguna
        $totalUsers = \App\Models\User::count();

        // 2. Data Pesanan & Keuangan
        $orders = \App\Models\Order::all();
        $totalOrders = $orders->count();
        $paidOrders = $orders->where('status', 'selesai')->count();
        $pendingOrders = $orders->where('status', 'pending')->count();
        $totalRevenue = $orders->where('status', 'selesai')->sum('amount');

        // 3. Kinerja Katalog/Template
        $catalogs = \App\Models\Catalog::where('is_active', 1)->get();
        $catalogInfo = "";
        foreach ($catalogs as $cat) {
            $sold = $orders->where('catalog_id', $cat->id)->where('status', 'selesai')->count();
            $catalogInfo .= "- {$cat->name} (Rp " . number_format($cat->price, 0, ',', '.') . ") | Terjual: {$sold} kali\n";
        }

        // 4. Data Promo Aktif
        $promos = \App\Models\Promo::where('is_active', 1)->get();
        $promoInfo = "";
        if ($promos->isEmpty()) {
            $promoInfo = "- Tidak ada promo aktif saat ini.\n";
        } else {
            foreach ($promos as $promo) {
                $val = $promo->type == 'percent' ? $promo->value . '%' : 'Rp ' . number_format($promo->value, 0, ',', '.');
                $promoInfo .= "- Kode '{$promo->code}' | Diskon: {$val} | Kuota terpakai: {$promo->used}/{$promo->limit}\n";
            }
        }

        // 5. Merangkai Laporan (Dashboard)
        $snapshot = "DATA BISNIS SAAT INI:\n"
            . "Total Pengguna Terdaftar: {$totalUsers}\n"
            . "Total Pesanan Keseluruhan: {$totalOrders} (Selesai: {$paidOrders}, Pending: {$pendingOrders})\n"
            . "Total Pendapatan Kotor (Selesai): Rp " . number_format($totalRevenue, 0, ',', '.') . "\n\n"
            . "Rincian Kinerja Template (Katalog):\n" . $catalogInfo . "\n"
            . "Promo Aktif:\n" . $promoInfo;

        // 6. System Prompt Sang Analis (Disesuaikan agar tidak berlebihan)
        $systemPrompt = "Anda adalah 'Voeu Analyst', Penasihat Bisnis dan Data Analyst tingkat tinggi untuk layanan undangan digital SerbaDigital. "
            . "Berikut adalah Data Bisnis saat ini:\n\n"
            . $snapshot . "\n\n"
            . "ATURAN SUPER PENTING: "
            . "1. Jawablah SECUKUPNYA saja sesuai pertanyaan. Jika user hanya menanyakan angka tertentu (misal: 'Berapa user?'), jawablah singkat dan langsung ke inti (contoh: 'Jumlah pengguna saat ini adalah 3'). "
            . "2. JANGAN pernah memberikan analisis panjang lebar, tabel, insight, atau saran strategi KECUALI pengguna secara eksplisit memintanya (misal: 'Tolong berikan analisa' atau 'Apa saranmu?'). "
            . "3. Gunakan gaya bahasa profesional namun santai.";

        // Daftar model Gemini yang diurutkan dari yang paling mutakhir (terbaik) hingga yang paling lama (terjelek)
        // $models = [
        //     'gemini-3.7-flash',
        //     'gemini-3.6-flash',
        //     'gemini-3.5-flash',
        //     'gemini-3.5-flash-lite',
        //     'gemini-3.1-flash-lite',
        //     'gemini-3-flash',
        //     'gemini-2.5-flash',
        //     'gemini-2.5-flash-lite',
        // ];
        $models = [
            'qwen/qwen3.6-27b',
        ];

        foreach ($models as $modelName) {
            // $url = 'https://generativelanguage.googleapis.com/v1beta/models/' . $modelName . ':generateContent?key=' . $apiKey;
            $url = 'https://api.groq.com/openai/v1' . $modelName . ':generateContent?key=' . $apiKey;

            $response = Http::withHeaders([
                'Content-Type' => 'application/json'
            ])->timeout(20)->post($url, [
                'system_instruction' => [
                    'parts' => [
                        ['text' => $systemPrompt]
                    ]
                ],
                'contents' => [
                    [
                        'role' => 'user',
                        'parts' => [
                            ['text' => $message]
                        ]
                    ]
                ]
            ]);

            // Jika berhasil, langsung ambil datanya dan keluar dari loop
            if ($response->successful()) {
                $data = $response->json();
                return $data['candidates'][0]['content']['parts'][0]['text'] ?? "Maaf, saya tidak mengerti respons dari AI.";
            }

            // Jika error 404 (model belum dirilis/tidak ada) atau 429 (limit), lanjut ke model berikutnya di array
        }

        // Jika semua model dalam daftar gagal (API key salah, server down, dll)
        throw new \Exception("Semua model Gemini gagal diakses. Error terakhir: " . ($response->body() ?? 'Tidak ada respons.'));
    }

    /**
     * Kirim pesan ke API Telegram.
     */
    private function sendMessage($chatId, $text)
    {
        $botToken = env('TELEGRAM_BOT_TOKEN');
        $url = "https://api.telegram.org/bot{$botToken}/sendMessage";

        Http::post($url, [
            'chat_id' => $chatId,
            'text' => $text,
            'parse_mode' => 'Markdown' // Memungkinkan format bold/italic dari Markdown AI
        ]);
    }

    /**
     * Helper route untuk set Webhook dengan mudah via browser
     */
    public function setWebhook(Request $request)
    {
        $botToken = env('TELEGRAM_BOT_TOKEN');

        // Telegram mensyaratkan HTTPS. Kita paksa menggunakan https://
        $host = $request->getHost();
        $webhookUrl = 'https://' . $host . '/webhook/telegram';

        $url = "https://api.telegram.org/bot{$botToken}/setWebhook?url=" . urlencode($webhookUrl);

        $response = Http::get($url);

        return response()->json([
            'webhook_url' => $webhookUrl,
            'telegram_response' => $response->json()
        ]);
    }
}

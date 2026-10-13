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

        // 3. Teruskan ke AI
        try {
            $aiResponse = $this->askAI($text);

            // Hapus blok <think>...</think> (Monolog internal dari model tipe Reasoning seperti Qwen/DeepSeek)
            $cleanText = preg_replace('/<think>.*?<\/think>/s', '', $aiResponse['text']);
            $cleanText = trim($cleanText);

            // Format pesan dengan watermark
            $replyText = $cleanText . "\n\n_🤖 Dijawab oleh " . $aiResponse['model'] . " (" . ucfirst($aiResponse['provider']) . ")_";

            // 4. Kirim balik balasan ke Telegram
            $this->sendMessage($chatId, $replyText);
        } catch (\Exception $e) {
            Log::error("Telegram/AI Error: " . $e->getMessage());
            $this->sendMessage($chatId, "Maaf, sistem AI sedang mengalami gangguan saat ini.");
        }

        return response()->json(['status' => 'success']);
    }

    /**
     * Kirim chat ke AI (Mencoba Groq terlebih dahulu, lalu fallback ke Gemini).
     */
    private function askAI($message)
    {
        // --- INJEKSI KONTEKS DATA (BUSINESS SNAPSHOT) ---
        // 1. Data Pengguna
        $totalUsers = \App\Models\User::count();

        // 2. Data Pesanan & Keuangan (All-Time)
        $orders = \App\Models\Order::all();
        $totalOrders = $orders->count();
        $paidStatuses = ['proses', 'selesai', 'paid'];
        $paidOrders = $orders->whereIn('status', $paidStatuses)->count();
        $pendingOrders = $orders->where('status', 'pending')->count();
        $totalRevenue = $orders->whereIn('status', $paidStatuses)->sum('amount');

        // 2.1 Metrik Berdasarkan Waktu (Bulan Ini, Minggu Ini, Hari Ini)
        $now = now();
        $todayStart = $now->copy()->startOfDay();
        $weekStart = $now->copy()->startOfWeek();
        $monthStart = $now->copy()->startOfMonth();

        // Query langsung ke DB agar lebih efisien dan akurat untuk metrik waktu
        $revenueToday = \App\Models\Order::whereIn('status', $paidStatuses)->where('created_at', '>=', $todayStart)->sum('amount');
        $ordersToday = \App\Models\Order::whereIn('status', $paidStatuses)->where('created_at', '>=', $todayStart)->count();

        $revenueWeek = \App\Models\Order::whereIn('status', $paidStatuses)->where('created_at', '>=', $weekStart)->sum('amount');
        $ordersWeek = \App\Models\Order::whereIn('status', $paidStatuses)->where('created_at', '>=', $weekStart)->count();

        $revenueMonth = \App\Models\Order::whereIn('status', $paidStatuses)->where('created_at', '>=', $monthStart)->sum('amount');
        $ordersMonth = \App\Models\Order::whereIn('status', $paidStatuses)->where('created_at', '>=', $monthStart)->count();

        // 3. Kinerja Katalog/Template
        $catalogs = \App\Models\Catalog::where('is_active', 1)->get();
        $catalogInfo = "";
        foreach ($catalogs as $cat) {
            $sold = $orders->where('catalog_id', $cat->id)->whereIn('status', $paidStatuses)->count();
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
        $snapshot = "WAKTU SAAT INI: " . $now->translatedFormat('l, d F Y H:i') . "\n\n"
            . "--- METRIK PENJUALAN ---\n"
            . "Total (Semua Waktu): Rp " . number_format($totalRevenue, 0, ',', '.') . " (Selesai: {$paidOrders} pesanan, Pending: {$pendingOrders} pesanan)\n"
            . "Bulan Ini: Rp " . number_format($revenueMonth, 0, ',', '.') . " ({$ordersMonth} pesanan lunas)\n"
            . "Minggu Ini: Rp " . number_format($revenueWeek, 0, ',', '.') . " ({$ordersWeek} pesanan lunas)\n"
            . "Hari Ini: Rp " . number_format($revenueToday, 0, ',', '.') . " ({$ordersToday} pesanan lunas)\n\n"
            . "Total Pengguna Terdaftar: {$totalUsers}\n\n"
            . "--- KINERJA TEMPLATE ---\n" . $catalogInfo . "\n"
            . "--- PROMO AKTIF ---\n" . $promoInfo;

        // 6. System Prompt Sang Analis
        $systemPrompt = "Anda adalah 'Voeu Analyst', Penasihat Bisnis dan Data Analyst tingkat tinggi untuk layanan undangan digital SerbaDigital. "
            . "Berikut adalah Data Bisnis saat ini:\n\n"
            . $snapshot . "\n\n"
            . "ATURAN SUPER PENTING: "
            . "1. Jawablah SECUKUPNYA saja sesuai pertanyaan. Jika user hanya menanyakan angka tertentu (misal: 'Berapa user?'), jawablah singkat dan langsung ke inti (contoh: 'Jumlah pengguna saat ini adalah 3'). "
            . "2. JANGAN pernah memberikan analisis panjang lebar, tabel, insight, atau saran strategi KECUALI pengguna secara eksplisit memintanya (misal: 'Tolong berikan analisa' atau 'Apa saranmu?'). "
            . "3. Gunakan gaya bahasa profesional namun santai.";

        // --- DAFTAR ANTRIAN AI (Groq -> Gemini) ---
        $aiQueue = [
            // Kasta Utama: GROQ (Sangat cepat)
            ['provider' => 'groq', 'model' => 'openai/gpt-oss-120b'],
            ['provider' => 'groq', 'model' => 'openai/gpt-oss-20b'],
            ['provider' => 'groq', 'model' => 'qwen/qwen3.8-27b'],

            // Ban Serep: GEMINI
            ['provider' => 'gemini', 'model' => 'gemini-3.8-flash'],
            ['provider' => 'gemini', 'model' => 'gemini-3.7-flash'],
            ['provider' => 'gemini', 'model' => 'gemini-3.6-flash'],
            ['provider' => 'gemini', 'model' => 'gemini-3.5-flash'],
            ['provider' => 'gemini', 'model' => 'gemini-3.1-flash-lite'],
        ];

        $groqKey = config('services.groq.api_key') ?? env('GROQ_API_KEY');
        $geminiKey = config('services.gemini.api_key') ?? env('GEMINI_API_KEY');

        $lastErrors = [];

        foreach ($aiQueue as $ai) {
            $provider = $ai['provider'];
            $modelName = $ai['model'];

            // Jika API Key tidak ada, lewati provider ini
            if ($provider === 'groq' && empty($groqKey)) {
                $lastErrors[] = "Groq: API key belum diisi";
                continue;
            }
            if ($provider === 'gemini' && empty($geminiKey)) {
                $lastErrors[] = "Gemini: API key belum diisi";
                continue;
            }

            try {
                if ($provider === 'groq') {
                    $response = Http::withHeaders([
                        'Authorization' => 'Bearer ' . $groqKey,
                        'Content-Type' => 'application/json'
                    ])->timeout(20)->post('https://api.groq.com/openai/v1/chat/completions', [
                        'model' => $modelName,
                        'messages' => [
                            ['role' => 'system', 'content' => $systemPrompt],
                            ['role' => 'user', 'content' => $message]
                        ]
                    ]);

                    if ($response->successful()) {
                        $data = $response->json();
                        return [
                            'text' => $data['choices'][0]['message']['content'] ?? "Maaf, saya tidak mengerti respons dari Groq.",
                            'provider' => 'groq',
                            'model' => $modelName
                        ];
                    }

                    $lastErrors[] = "Groq ({$modelName}) HTTP {$response->status()}: " . $response->body();
                    Log::warning("Groq model {$modelName} gagal: HTTP " . $response->status() . " - " . $response->body());
                } else if ($provider === 'gemini') {
                    $url = 'https://generativelanguage.googleapis.com/v1beta/models/' . $modelName . ':generateContent?key=' . $geminiKey;

                    $response = Http::withHeaders([
                        'Content-Type' => 'application/json'
                    ])->timeout(20)->post($url, [
                        'system_instruction' => [
                            'parts' => [['text' => $systemPrompt]]
                        ],
                        'contents' => [
                            ['role' => 'user', 'parts' => [['text' => $message]]]
                        ]
                    ]);

                    if ($response->successful()) {
                        $data = $response->json();
                        return [
                            'text' => $data['candidates'][0]['content']['parts'][0]['text'] ?? "Maaf, saya tidak mengerti respons dari Gemini.",
                            'provider' => 'gemini',
                            'model' => $modelName
                        ];
                    }

                    $lastErrors[] = "Gemini ({$modelName}) HTTP {$response->status()}: " . $response->body();
                    Log::warning("Gemini model {$modelName} gagal: HTTP " . $response->status() . " - " . $response->body());
                }
            } catch (\Throwable $e) {
                $lastErrors[] = "{$provider} ({$modelName}) Exception: " . $e->getMessage();
                Log::warning("Koneksi {$provider} ({$modelName}) error: " . $e->getMessage());
                continue;
            }
        }

        // Jika semua gagal
        throw new \Exception("Semua model Groq & Gemini gagal diakses. Detail: " . implode(" | ", array_slice($lastErrors, 0, 3)));
    }

    /**
     * Kirim pesan ke API Telegram.
     */
    private function sendMessage($chatId, $text)
    {
        $botToken = config('services.telegram.bot_token') ?? env('TELEGRAM_BOT_TOKEN');
        if (empty($botToken)) {
            Log::error("Telegram Bot Token tidak ditemukan saat ingin mengirim pesan.");
            return;
        }

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
        $botToken = config('services.telegram.bot_token') ?? env('TELEGRAM_BOT_TOKEN');

        if (empty($botToken)) {
            return response()->json([
                'status' => 'error',
                'message' => 'TELEGRAM_BOT_TOKEN belum diatur atau terbaca kosong di server! Pastikan TELEGRAM_BOT_TOKEN sudah ada di file .env server production dan jalankan `php artisan config:clear` jika config di-cache.',
            ], 500);
        }

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

    /**
     * Helper route untuk mentrigger ulang notifikasi order terbaru via browser
     */
    public function resendLatestOrder(Request $request)
    {
        $botToken = config('services.telegram.bot_token') ?? env('TELEGRAM_BOT_TOKEN');
        $adminId = config('services.telegram.admin_id') ?? env('TELEGRAM_ADMIN_ID');

        if (empty($botToken) || empty($adminId)) {
            return response()->json([
                'status' => 'error',
                'message' => 'TELEGRAM_BOT_TOKEN atau TELEGRAM_ADMIN_ID belum diatur!'
            ], 500);
        }

        $orderId = $request->query('id');
        if ($orderId) {
            $order = \App\Models\Order::with('catalog')->where('id', $orderId)->orWhere('external_id', $orderId)->first();
        } else {
            $order = \App\Models\Order::with('catalog')
                ->whereIn('status', ['proses', 'paid', 'selesai'])
                ->latest()
                ->first();
        }

        if (!$order) {
            return response()->json(['status' => 'error', 'message' => 'Pesanan tidak ditemukan!'], 404);
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

        return response()->json([
            'status' => $response->successful() ? 'success' : 'error',
            'order' => [
                'external_id' => $order->external_id,
                'customer_name' => $order->customer_name,
                'amount' => $order->amount,
                'status' => $order->status
            ],
            'telegram_response' => $response->json()
        ]);
    }
}

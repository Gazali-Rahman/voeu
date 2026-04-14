<?php

namespace App\Livewire\Admin;

use App\Models\Catalog;
use App\Models\Order;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.admin')]
class Dashboard extends Component
{
    public function render()
    {
        // 1. Ambil data statistik dasar
        $totalRevenue = Order::whereIn('status', ['paid', 'proses', 'selesai'])->sum('amount');
        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'pending')->count();

        // Variabel yang menyebabkan error jika tidak ada:
        $processOrders = Order::where('status', 'proses')->count();

        $totalCatalogs = Catalog::count();

        // 2. Ambil produk dengan views terbanyak dan hitung konversinya
        $topProducts = Catalog::orderBy('views_count', 'desc')->take(5)->get()->map(function ($product) {
            $purchaseCount = Order::where('catalog_id', $product->id)
                ->whereIn('status', ['paid', 'proses', 'selesai'])
                ->count();

            $conversionRate = $product->views_count > 0
                ? ($purchaseCount / $product->views_count) * 100
                : 0;

            $product->purchase_count = $purchaseCount;
            $product->conversion_rate = number_format($conversionRate, 1);

            return $product;
        });

        // 3. Kirim semua variabel ke view
        return view('livewire.admin.dashboard', [
            'totalRevenue' => $totalRevenue,
            'totalOrders' => $totalOrders,
            'pendingOrders' => $pendingOrders,
            'processOrders' => $processOrders, // Pastikan baris ini ada
            'totalCatalogs' => $totalCatalogs,
            'topProducts' => $topProducts,
            'totalViews' => Catalog::sum('views_count'),
            'recentOrders' => Order::with('catalog')->latest()->take(5)->get(),
        ]);
    }
}

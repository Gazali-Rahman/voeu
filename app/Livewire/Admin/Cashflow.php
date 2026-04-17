<?php

namespace App\Livewire\Admin;

use App\Models\FinancialTransaction;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Carbon\Carbon;

#[Layout('components.layouts.admin')]
class Cashflow extends Component
{
    public $month;
    public $year;

    // Properti untuk Form Input Manual
    public $date, $type = 'income', $description, $amount;
    public $showModal = false;

    public function mount()
    {
        $this->month = date('n');
        $this->year = date('Y');
        $this->date = date('Y-m-d');
    }
    public function downloadPDF()
    {
        // 1. Ambil data (Logika sama dengan render)
        $orders = Order::whereMonth('created_at', $this->month)
            ->whereYear('created_at', $this->year)
            ->where('status', 'selesai')->get();

        $manuals = FinancialTransaction::whereMonth('date', $this->month)
            ->whereYear('date', $this->year)->get();

        // 2. Olah data
        $transactions = collect();
        foreach ($orders as $o) {
            $transactions->push((object)['date' => $o->created_at, 'description' => "Order #{$o->external_id}", 'type' => 'income', 'amount' => $o->amount]);
        }
        foreach ($manuals as $m) {
            $transactions->push((object)['date' => \Carbon\Carbon::parse($m->date), 'description' => $m->description, 'type' => $m->type, 'amount' => $m->amount]);
        }

        $transactions = $transactions->sortByDesc('date');

        $totalIncome = $transactions->where('type', 'income')->sum('amount');
        $totalExpense = $transactions->where('type', 'expense')->sum('amount');
        $balance = $totalIncome - $totalExpense;

        // 3. Generate PDF
        $pdf = Pdf::loadView('admin.report', [
            'transactions' => $transactions,
            'totalIncome' => $totalIncome,
            'totalExpense' => $totalExpense,
            'balance' => $balance,
            'monthName' => date('F', mktime(0, 0, 0, $this->month, 1)),
            'year' => $this->year
        ]);

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, "Cashflow-Report-{$this->month}-{$this->year}.pdf");
    }

    public function saveTransaction()
    {
        $this->validate([
            'date' => 'required|date',
            'type' => 'required|in:income,expense',
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
        ]);

        FinancialTransaction::create([
            'date' => $this->date,
            'type' => $this->type,
            'description' => $this->description,
            'amount' => $this->amount,
        ]);

        $this->reset(['description', 'amount', 'showModal']);
        $this->date = date('Y-m-d');

        session()->flash('message', 'Transaksi berhasil dicatat.');
    }

    public function render()
    {
        // 1. Ambil Order Otomatis (Hanya status PAID)
        $orders = Order::with('catalog')
            ->whereMonth('created_at', $this->month)
            ->whereYear('created_at', $this->year)
            ->where('status', 'selesai')
            ->get();

        // 2. Ambil Transaksi Manual
        $manuals = FinancialTransaction::whereMonth('date', $this->month)
            ->whereYear('date', $this->year)
            ->get();

        // 3. Hitung Statistik
        $orderIncome = $orders->sum('amount');
        $manualIncome = $manuals->where('type', 'income')->sum('amount');

        $totalIncome = $orderIncome + $manualIncome;
        $totalExpense = $manuals->where('type', 'expense')->sum('amount');
        $balance = $totalIncome - $totalExpense;

        // 4. Gabungkan Koleksi untuk Tabel
        $transactions = collect();

        foreach ($orders as $order) {
            $transactions->push((object)[
                'date' => $order->created_at,
                'description' => "Order #{$order->external_id} - {$order->customer_name}",
                'type' => 'income',
                'amount' => $order->amount,
                'category' => 'Automatic System'
            ]);
        }

        foreach ($manuals as $manual) {
            $transactions->push((object)[
                'date' => Carbon::parse($manual->date),
                'description' => $manual->description,
                'type' => $manual->type,
                'amount' => $manual->amount,
                'category' => 'Manual Input'
            ]);
        }

        return view('livewire.admin.cashflow', [
            'transactions' => $transactions->sortByDesc('date'),
            'totalIncome' => $totalIncome,
            'totalExpense' => $totalExpense,
            'balance' => $balance
        ]);
    }
}

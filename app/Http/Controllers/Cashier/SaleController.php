<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Contracts\View\View;

class SaleController extends Controller
{
    public function index(): View
    {
        $transactions = Transaction::query()
            ->with('user:id,name')
            ->latest()
            ->paginate(15);

        return view('kasir.riwayat', compact('transactions'));
    }
}

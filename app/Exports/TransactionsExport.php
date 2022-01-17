<?php

namespace App\Exports;

use App\Models\Transaction;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class TransactionsExport implements FromView
{
    public function view(): View
    {
        return view('exports.transactions', [
            'transactions' => Transaction::where('status', 1)->latest()->get()
        ]);
    }
}

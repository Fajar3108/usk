<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class WithrawController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => ['required', 'numeric', 'min:500']
        ]);

        if ($validator->fails()) return ResponseHelper::buildError('Invalid Request', $validator->errors()->first(), 400);

        if ($request->amount % 500 !== 0) return ResponseHelper::buildError('Top up failed. amount must be a multiple of 500', [], 400);

        if ($request->amount > auth()->user()->balance) return ResponseHelper::buildError('Your balance is not sufficient', [], 400);

        Transaction::create([
            'receiver_id' => auth()->user()->id,
            'amount' => $request->amount,
            'type' => 3,
            'status' => 0,
            'code' => Str::random(6),
        ]);

        return ResponseHelper::buildSuccess('Withraw success. confirm to mini bank clerk', [], 200);
    }

    public function confirm(Transaction $transaction)
    {
        if (strtolower($transaction->status_name) !== 'pending') return back()->withError('This transaction has been completed');

        if($transaction->amount > $transaction->receiver->balance) return back()->withError('Balance is not enough');

        $transaction->receiver()->update([
            'balance' => $transaction->receiver->balance - $transaction->amount,
        ]);

        $transaction->update([
            'confirmed_by' => auth()->user()->id,
            'status' => 1
        ]);

        return back()->withSuccess('Withdraw confirmed successfuly');
    }
}

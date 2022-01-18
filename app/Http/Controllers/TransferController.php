<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Models\{User, Transaction};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class TransferController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'amount' => ['required', 'numeric', 'min:500']
        ]);

        if ($validator->fails()) return ResponseHelper::buildError($validator->errors()->first(), $validator->errors(), 400);

        if ($request->amount % 500 !== 0) return ResponseHelper::buildError('Transfer failed. Amount must be a multiple of 500', [], 400);

        if ($request->amount < auth()->user()->amount) return ResponseHelper::buildError('Your balance is not sufficient', [], 400);

        $receiver = User::where('email', $request->receiver_email)->first();

        if (!$receiver) return ResponseHelper::buildError('Receiver Not Found', [], 404);

        $transaction = Transaction::create([
            'receiver_id' => $receiver->id,
            'sender' => auth()->user()->id,
            'amount' => $request->amount,
            'type' => 1,
            'status' => 1,
            'code' => Str::random(6),
        ]);

        $transaction->sender()->update([
            'balance' => auth()->user()->balance - $transaction->amount,
        ]);

        return ResponseHelper::buildSuccess('Transfer successfuly', [], 200);
    }
}

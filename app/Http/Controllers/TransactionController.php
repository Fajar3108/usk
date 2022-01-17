<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Helpers\RoleHelper;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function topup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => ['required', 'numeric', 'min:5000']
        ]);

        if ($validator->fails()) return ResponseHelper::buildError('Top up Failed', $validator->errors()->first(), 400);

        if ($request->amount % 5000 !== 0) return ResponseHelper::buildError('Top up failed. amount must be a multiple of 5000', [], 400);

        $status = 0;

        if (strtolower(RoleHelper::getRole(auth()->user()->role)) !== 'student') $status = 1;

        if (strtolower(RoleHelper::getRole(auth()->user()->role)) == 'student') $receiver = auth()->user();
        else $receiver = User::find($request->receiver_id);

        if (!$receiver) return ResponseHelper::buildError('Receiver not found', [], 404);

        Transaction::create([
            'receiver_id' => $receiver->id,
            'amount' => $request->amount,
            'type' => 1,
            'status' => $status,
        ]);

        if (strtolower($status) == 'success') {
            $receiver->update([
                'amount' => $receiver->amout + $request->amount,
            ]);
        }

        return ResponseHelper::buildSuccess('Top Up Success', [], 200);
    }
}

<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Models\{Product, Transaction, User};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    public function index()
    {
        $role = strtolower(auth()->user()->role_name);
        if ($role == 'officer') $transactions = Transaction::where('type', 1)->latest()->paginate(10);
        else if ($role == 'seller') $transactions = Transaction::where('type', 2)->latest()->paginate(10);
        else $transactions = Transaction::latest()->paginate(10);

        return view('transactions.index', compact('transactions'));
    }

    public function topup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => ['required', 'numeric', 'min:5000']
        ]);

        if ($validator->fails()) return ResponseHelper::buildError('Top up Failed', $validator->errors()->first(), 400);

        if ($request->amount % 5000 !== 0) return ResponseHelper::buildError('Top up failed. amount must be a multiple of 5000', [], 400);

        $status = 0;

        if (strtolower(auth()->user()->roleName) !== 'student') $status = 1;

        if (strtolower(auth()->user()->roleName) == 'student') $receiver = auth()->user();
        else $receiver = User::find($request->receiver_id);

        if (!$receiver) return ResponseHelper::buildError('Receiver not found', [], 404);

        Transaction::create([
            'receiver_id' => $receiver->id,
            'amount' => $request->amount,
            'type' => 1,
            'status' => $status,
            'code' => Str::random(6),
        ]);

        if (strtolower($status) == 'success') {
            $receiver->update([
                'amount' => $receiver->balance + $request->amount,
            ]);
        }

        return ResponseHelper::buildSuccess('Top Up Success', [], 200);
    }

    public function topup_confirmation(Transaction $transaction)
    {
        if (strtolower($transaction->statusName) !== 'pending') return back()->withError('This transaction has been completed');

        $transaction->update([
            'confirmed_by' => auth()->user()->id,
            'status' => 1
        ]);

        $transaction->receiver()->update([
            'balance' => $transaction->receiver->balance + $transaction->amount,
        ]);

        return back()->withSuccess('Transaction confirmed successfuly');
    }

    public function purchase(Request $request)
    {
        $product = Product::findOrFail($request->product_id);

        if($product->price > auth()->user()->balance) return back()->withError('Balance is not enough');

        Transaction::create([
            'status' => 0,
            'amount' => $product->price,
            'type' => 2,
            'product_id' => $product->id,
            'sender_id' => auth()->user()->id,
            'description' => $request->description,
            'code' => Str::random(6),
        ]);

        return back();
    }

    public function purchase_confirmation(Transaction $transaction)
    {
        if (strtolower($transaction->status_name) !== 'pending') return back()->withError('This transaction has been completed');

        if($transaction->amount > $transaction->sender->balance) return back()->withError('Balance is not enough');

        $transaction->sender()->update([
            'balance' => $transaction->sender->balance - $transaction->amount,
        ]);

        $transaction->update([
            'confirmed_by' => auth()->user()->id,
            'status' => 1
        ]);

        return back()->withSuccess('Transaction confirmed successfuly');
    }
}

@extends('layouts.app')

@section('content')

<main class="container mt-3">
    <div class="row">
        <div class="col-12 col-md-4 mb-3">
            @include('components.sidebar')
        </div>
        <div class="col-12 col-md-8">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2>Transactions</h2>
                @if (strtolower(auth()->user()->role_name) == 'admin' || strtolower(auth()->user()->role_name)== 'officer')
                <a class="btn btn-outline-success btn-sm" href="{{ route('transactions.export') }}">Export Successfuly Transactions</a>
                @endif
                {{-- <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#CreateUserModal">Top Up</button> --}}
            </div>
            @if (Session::has('fail'))
            <div class="alert alert-danger">{{ Session::get('fail') }}</div>
            @endif
            <div class="table-responsive">
                <table class="table table-hover mt-3">
                    <tr>
                        <th>Code</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Amount</th>
                        <th>Receiver</th>
                        <th>Sender</th>
                        <th>Product</th>
                        <th>Confirmed By</th>
                        <th>Note</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->code }}</td>
                        <td>{{ $transaction->typeName }}</td>
                        <td>{{ $transaction->statusName }}</td>
                        <td>{{ CurrencyHelper::rupiah($transaction->amount) }}</td>
                        <td>{{ $transaction->receiver->name ?? '-' }}</td>
                        <td>{{ $transaction->sender->name ?? '-' }}</td>
                        <td>{{ $transaction->product->name ?? '-' }}</td>
                        <td>{{ $transaction->confirm_by->name ?? '-' }}</td>
                        <td>{{ $transaction->description ?? '-' }}</td>
                        <td>
                            <div class="d-flex">
                                {{-- Confirm Top Up --}}
                                @if(strtolower($transaction->statusName) == 'pending' && strtolower($transaction->type_name) == 'top up')
                                <form action="{{ route('topup.confirmation', $transaction->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-sm">Confirm</button>
                                </form>
                                @endif
                                {{-- Confirm Withdraw --}}
                                @if(strtolower($transaction->statusName) == 'pending' && strtolower($transaction->type_name) == 'withdraw')
                                <form action="{{ route('withdraw.confirmation', $transaction->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-sm">Confirm</button>
                                </form>
                                @endif
                                {{-- Confirm Purchase --}}
                                @if(strtolower($transaction->statusName) == 'pending' && strtolower($transaction->type_name) == 'purchase')
                                <form action="{{ route('purchase.confirmation', $transaction->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-sm">Confirm</button>
                                </form>
                                @endif
                                @if(strtolower($transaction->statusName) == 'pending')
                                <form action="{{ route('transactions.deny', $transaction->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">Deny</button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
            {{ $transactions->links() }}
        </div>
    </div>
</main>


@endsection

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
                {{-- <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#CreateUserModal">Top Up</button> --}}
            </div>
            <table class="table table-hover mt-3">
                <tr>
                    <th>Type</th>
                    <th>Amount</th>
                    <th>Confirmed By</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                @foreach ($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->typeName }}</td>
                    <td>{{ CurrencyHelper::rupiah($transaction->amount) }}</td>
                    <td>{{ $transaction->confirm_by->name ?? 'Unconfirmed' }}</td>
                    <td>{{ $transaction->statusName }}</td>
                    <td>
                        @if(strtolower($transaction->statusName) == 'pending')
                            <form action="{{ route('topup.confirmation', $transaction->id) }}" method="POST">
                                @csrf
                            <button type="submit" class="btn btn-primary btn-sm">Confirm</button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </table>
            {{ $transactions->links() }}
        </div>
    </div>
</main>


@endsection

@extends('layouts.app')

@section('content')

@php
    use App\Models\{Product, Transaction};

    $products = Product::latest()->paginate(10);
    $my_transactions = Transaction::where('receiver_id', auth()->user()->id)->latest()->get();
@endphp

<main class="container mt-3">
    <div class="row gap-1">
        <div class="col-12 col-md-4 p-0 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ auth()->user()->name }}</h5>
                    <h6 class="card-subtitle text-muted">{{ auth()->user()->email }}</h6>

                    <h2 class="text-primary my-3">{{ CurrencyHelper::rupiah(auth()->user()->balance) }}</h2>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button role="button" class="card-link btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#topupModal" onclick="event.preventDefault()">Top Up</button>
                        <button class="card-link btn text-danger m-0">Logout</button>
                    </form>
                </div>
            </div>
            <div class="row p-0 mt-3">
                <h4>History</h4>
                @foreach ($my_transactions as $transaction)
                <div class="col-12 m-0 mb-1">
                    <div class="alert alert-success m-0" role="alert">
                        <strong>{{ $transaction->typeName }}!</strong> {{ CurrencyHelper::rupiah($transaction->amount) }}
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="col-12 col-md-7">
            <div class="row">
                @foreach ($products as $product)
                <div class="card mb-3 p-0" style="max-height: 200px">
                    <div class="row g-0" style="max-height: 100%;">
                        <div class="col-md-4" style="max-height: 100%;">
                            <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded-start" alt="..." style="width: 100%; height: 100%; object-fit:cover;">
                        </div>
                        <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <h6 class="text-primary">{{ CurrencyHelper::rupiah($product->price) }}</h6>
                            <p class="card-text limit-text">{{ $product->description }}</p>
                            <button class="btn btn-outline-primary">Beli</button>
                        </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</main>

@include('transactions.partials.topup-modal')

<script src="{{ asset('js/transaction.js') }}"></script>

@endsection

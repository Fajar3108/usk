@extends('layouts.app')

@section('content')

@php
    use App\Models\{Product, Transaction};

    $products = Product::latest()->paginate(10);
    $my_transactions = Transaction::where('receiver_id', auth()->user()->id)->orWhere('sender_id', auth()->user()->id)->latest()->get();
@endphp

<main class="container">
    <div class="row gap-1 p-3">
        <div class="col-12 col-md-4 p-0 mb-3">
            <div class="card p-2">
                <div class="card-body">
                    <h5 class="card-title">{{ auth()->user()->name }}</h5>
                    <h6 class="card-subtitle text-muted">{{ auth()->user()->email }}</h6>
                    <h2 class="text-primary my-3">{{ CurrencyHelper::rupiah(auth()->user()->balance) }}</h2>

                    <div class="row">
                        <button role="button" class="btn btn-outline-primary mb-1" data-bs-toggle="modal" data-bs-target="#topupModal" onclick="event.preventDefault()">Top Up</button>
                        <button role="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#withdrawModal" onclick="event.preventDefault()">Withdraw</button>
                    </div>

                    <form action="{{ route('logout') }}" method="POST" class="w-100 text-center mt-3">
                        @csrf
                        <button class="card-link btn text-danger m-0">Logout</button>
                    </form>
                </div>
            </div>
            <div class="row p-0 mt-3">
                <h4>History</h4>
                @foreach ($my_transactions as $transaction)
                <div class="col-12 m-0 mb-1">
                    <div class="alert alert-success m-0" role="alert">
                        <strong>{{ $transaction->status_name }}!</strong> {{ $transaction->typeName }} {{ CurrencyHelper::rupiah($transaction->amount) }}
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="col-12 col-md-7">
            @if (Session::has('fail'))
                <div class="alert alert-error">{{ Session::get('fail') }}</div>
            @endif
            <div class="row">
                @foreach ($products as $product)
                <div class="card mb-1 p-0">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded-start" alt="..." style="width: 100%; height: 200px; object-fit:cover;">
                        </div>
                        <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <h6 class="text-primary">{{ CurrencyHelper::rupiah($product->price) }}</h6>
                            <p class="card-text limit-text">{{ $product->description }}</p>
                            <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#purchaseModal" id="purchaseBtn" onclick="purchase({{ $product }})">Buy</button>
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
@include('transactions.partials.withraw-modal')

<!-- Modal -->
<div class="modal fade" id="purchaseModal" tabindex="-1" aria-labelledby="purchaseModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="productPrice">Modal title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <img src="..." class="img-fluid" alt="..." id="productImage">
            <h4 id="productName"></h4>
            <p id="productDescription"></p>
            <form action="{{ route('purchase') }}" method="POST">
                @csrf
                <input type="hidden" id="productId" name="product_id">
                <textarea placeholder="Note (Optional)" name="description" class="form-control" rows="3"></textarea>
                <button type="submit" class="btn btn-primary btn-block w-100">Purchase</button>
            </form>
        </div>
    </div>
  </div>
</div>

<script src="{{ asset('js/transaction.js') }}"></script>

@endsection

@extends('layouts.app')

@section('content')

<main class="container mt-3">
    <div class="row">
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
        </div>
        <div class="col-12 col-md-8">
            <div class="row">
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-4">
                        <img src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2F4.bp.blogspot.com%2F-ICsTm2-QHzo%2FV2qqP4237kI%2FAAAAAAAAJmA%2FbJFje_yxKDIv9eO3kk2kayMYYcDvQthWwCLcB%2Fs1600%2FCara%252BMembuat%252BAyam%252BBakar%252BBetutu%252BBali%252Bdan%252BResep.jpg&f=1&nofb=1" class="img-fluid rounded-start" alt="..." style="height: 100%; object-fit:cover;">
                        </div>
                        <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Nama Product</h5>
                            <h6 class="text-primary">Rp10.000</h6>
                            <p class="card-text limit-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer. Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quibusdam cumque hic doloribus quis facere commodi sed odit earum, iusto, omnis, voluptates quia dignissimos rerum deleniti sunt. Blanditiis veniam exercitationem maiores.</p>
                            <button class="btn btn-outline-primary">Beli</button>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@include('transactions.partials.topup-modal')

<script src="{{ asset('js/transaction.js') }}"></script>

@endsection

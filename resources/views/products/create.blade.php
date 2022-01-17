@extends('layouts.app')

@section('content')

<main class="container mt-3">
    <div class="row">
        <div class="col-12 col-md-4 mb-3">
            @include('components.sidebar')
        </div>
        <div class="col-12 col-md-8">
            <h2>Create New Product</h2>
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @include('products.partials.form')
            </form>
        </div>
    </div>
</main>

@section('javascript')

<script src="{{ asset('js/product.js') }}"></script>

@endsection

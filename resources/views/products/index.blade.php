@extends('layouts.app')

@section('content')

<main class="container mt-3">
    <div class="row">
        <div class="col-12 col-md-4 mb-3">
            @include('components.sidebar')
        </div>
        <div class="col-12 col-md-8">
            <div class="d-flex justify-content-between align-items-center">
                <h2>Products</h2>
                <a href="{{ route('products.create') }}" class="btn sm btn-primary">Create</a>
            </div>
            <table class="table table-hover">
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
                @foreach ($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ CurrencyHelper::rupiah($product->price) }}</td>
                    <td>{{ $product->description }}</td>
                    <td>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="m-0">
                            @csrf
                            @method('DELETE')
                            <a href="{{ route('products.edit', $product->slug) }}" class="btn btn-outline-success btn-sm">Edit</a>
                            <button class="btn btn-outline-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</main>

@section('javascript')

<script src="{{ asset('js/product.js') }}"></script>

@endsection

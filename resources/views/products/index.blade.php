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
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#CreateUserModal">Create</button>
            </div>
            <table class="table table-hover">
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </table>
        </div>
    </div>
</main>

@section('javascript')

<script src="{{ asset('js/product.js') }}"></script>

@endsection

@extends('layouts.app')

@section('content')

<main class="container mt-3">
    <div class="row">
        <div class="col-12 col-md-4 mb-3">
            @include('components.sidebar')
        </div>
        <div class="col-12 col-md-8">
            <div class="d-flex justify-content-between align-items-center">
                <h2>Users</h2>
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#CreateUserModal">Create</button>
            </div>
            <table class="table table-hover">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->roleName }}</td>
                    <td>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="m-0">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
            {{ $users->links() }}
        </div>
    </div>
</main>

<!-- Create User Modal -->
<div class="modal fade" id="CreateUserModal" tabindex="-1" aria-labelledby="CreateUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="CreateUserModalLabel">Create New User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger alert-dismissible fade show d-none" role="alert" id="errorAlert">
            <span id="errorMessage"></span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name">
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select class="form-select" aria-label="Select Role" name="role" id="role">
                <option value="1">Admin</option>
                <option value="2">Officer</option>
                <option value="3">Seller</option>
                <option value="4">Student</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password">
        </div>
        <button role="button" class="btn btn-primary btn-block w-100" id="loginSubmit">Submit</button>
      </div>
    </div>
  </div>
</div>

@section('javascript')

<script src="{{ asset('js/user.js') }}"></script>


@endsection

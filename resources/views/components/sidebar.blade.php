<div class="card">
    <ul class="list-group list-group-flush">
        <li class="list-group-item">{{ auth()->user()->name }}</li>
        <li class="list-group-item @if(request()->is('dashboard')) {{ "bg-primary" }} @endif"><a href="{{ route('dashboard') }}" class="@if(request()->is('dashboard')) {{ "text-white" }} @endif">Dashboard</a></li>
        <li class="list-group-item @if(request()->is('users')) {{ "bg-primary" }} @endif"><a href="{{ route('users.index') }}" class="@if(request()->is('users')) {{ "text-white" }} @endif">Users</a></li>
        <li class="list-group-item @if(request()->is('products')) {{ "bg-primary" }} @endif"><a href="{{ route('products.index') }}" class="@if(request()->is('products')) {{ "text-white" }} @endif">Products</a></li>
        <li class="list-group-item @if(request()->is('transactions')) {{ "bg-primary" }} @endif"><a href="{{ route('transactions.index') }}" class="@if(request()->is('transactions')) {{ "text-white" }} @endif">Transactions</a></li>
        <li class="list-group-item">
            <form action="{{ route('logout') }}" method="POST" class="m-0">
                @csrf
                <button type="submit" class="btn text-danger p-0">Logout</button>
            </form>
        </li>
    </ul>
</div>

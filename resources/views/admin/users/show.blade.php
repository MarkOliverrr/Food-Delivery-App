@extends('admin.layouts.app')

@section('title', 'User Details')

@section('content')
<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-12">
            <h3 class="text-primary">{{ trim($user->f_name . ' ' . $user->l_name) ?: $user->username }}</h3>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <p><strong>Username:</strong> {{ $user->username }}</p>
            <p><strong>Name:</strong> {{ trim($user->f_name . ' ' . $user->l_name) ?: '—' }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Phone:</strong> {{ $user->phone ?: '—' }}</p>
            <p><strong>Address:</strong> {{ $user->address ?: '—' }}</p>
            <p><strong>Login Method:</strong> 
                @if($user->login_method === 'google')
                    <span style="background-color: #4285F4; color: white; padding: 4px 8px; border-radius: 4px;">
                        <i class="fa fa-google"></i> Google Login
                    </span>
                @else
                    <span style="background-color: #6c757d; color: white; padding: 4px 8px; border-radius: 4px;">
                        Email/Password
                    </span>
                @endif
            </p>
            <p><strong>Registration Date:</strong> {{ $user->created_at ? $user->created_at->format('Y-m-d H:i:s') : '—' }}</p>
            <h5 class="mt-4">Orders</h5>
            <ul class="list-group">
                @forelse($orders as $order)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>#{{ $order->o_id }} - {{ $order->status }}</span>
                        <span>{{ number_format($order->price, 2) }}</span>
                    </li>
                @empty
                    <li class="list-group-item">No orders.</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>
@endsection



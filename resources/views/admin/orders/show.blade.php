@extends('admin.layouts.app')

@section('title', 'Order Details')

@section('content')
<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-12">
            <h3 class="text-primary">Order #{{ $order->o_id }}</h3>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <p><strong>User:</strong> {{ optional($order->user)->username ?? trim((optional($order->user)->f_name.' '.optional($order->user)->l_name)) ?: 'guest' }}</p>
            <p><strong>Address:</strong> {{ $order->address ?? optional($order->user)->address ?? 'Not provided' }}</p>
            <p><strong>Status:</strong> {{ $order->status ?? 'Not set' }}</p>
            <p><strong>Total:</strong> ₱{{ number_format($order->price, 2) }}</p>

            <form method="POST" action="{{ route('admin.orders.update-status', $order) }}" class="form-inline">
                @csrf
                @method('PUT')
                <div class="form-group mr-2">
                    <label class="mr-2">Update Status</label>
                    <select name="status" class="form-control">
                        <option value="in process" @if($order->status==='in process') selected @endif>in process</option>
                        <option value="closed" @if($order->status==='closed') selected @endif>closed</option>
                        <option value="rejected" @if($order->status==='rejected') selected @endif>rejected</option>
                    </select>
                </div>
                <div class="form-group mr-2">
                    <input name="remark" class="form-control" placeholder="Remark (optional)" />
                </div>
                <button class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</div>
@endsection



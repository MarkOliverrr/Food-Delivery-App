@extends('admin.layouts.app')

@section('title', 'Orders')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body" style="padding-top:0;">
            <div style="background:#5b45d8;color:#fff;border-radius:4px;margin:-20px -20px 20px -20px;padding:14px 18px;">
                <strong>All Orders</strong>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th style="width:140px;">User</th>
                            <th>Title</th>
                            <th style="width:90px;">Quantity</th>
                            <th style="width:120px;">Price</th>
                            <th>Address</th>
                            <th style="width:140px;">Status</th>
                            <th style="width:150px;">Reg-Date</th>
                            <th style="width:120px;" class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                            <tr>
                                <td>{{ optional($order->user)->username ?? trim((optional($order->user)->f_name.' '.optional($order->user)->l_name)) ?: 'guest' }}</td>
                                <td>{{ $order->title ?? ($order->items_title ?? '—') }}</td>
                                <td>{{ $order->quantity ?? 1 }}</td>
                                <td>₱{{ number_format($order->price, 2) }}</td>
                                <td>{{ $order->address ?? optional($order->user)->address ?? '—' }}</td>
                                <td>
                                    <form method="POST" action="{{ route('admin.orders.update-status', $order) }}" class="form-inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="remark" value="">
                                        <select name="status" class="form-control input-sm" style="height:32px;padding:2px 6px;display:inline-block;width:auto;">
                                            <option value="in process" @if($order->status==='in process') selected @endif>in process</option>
                                            <option value="closed" @if($order->status==='closed') selected @endif>closed</option>
                                            <option value="rejected" @if($order->status==='rejected') selected @endif>rejected</option>
                                        </select>
                                        <button class="btn btn-primary btn-sm" style="margin-left:6px;">
                                            <i class="fa fa-bars"></i> Dispatch
                                        </button>
                                    </form>
                                </td>
                                <td>{{ optional($order->created_at)->format('Y-m-d H:i:s') }}</td>
                                <td class="text-right">
                                    <a class="btn btn-info btn-sm" href="{{ route('admin.orders.show', $order) }}" title="View">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.orders.destroy', $order) }}" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this order?');" title="Delete">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="8" class="text-center">No orders.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection



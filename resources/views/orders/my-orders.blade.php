@extends('layouts.app')

@section('title', 'My Orders')

@section('content')
<div class="page-wrapper">
    <div class="inner-page-hero bg-image" data-image-src="{{ asset('images/img/pimg.jpg') }}">
        <div class="container"></div>
    </div>
    <div class="result-show">
        <div class="container">
            <div class="row"></div>
        </div>
    </div>

    <section class="restaurants-page">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="bg-gray">
                        <div class="row">
                            <table class="table table-bordered table-hover">
                                <thead style="background: #404040; color:white;">
                                    <tr>
                                        <th>Item</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($orders as $order)
                                        <tr>
                                            <td data-column="Item">{{ $order->title }}</td>
                                            <td data-column="Quantity">{{ $order->quantity }}</td>
                                            <td data-column="price">₱{{ number_format($order->price, 2) }}</td>
                                            <td data-column="status">
                                                @if(empty($order->status) || $order->status == 'NULL')
                                                    <button type="button" class="btn btn-info">
                                                        <span class="fa fa-bars" aria-hidden="true"></span> Dispatch
                                                    </button>
                                                @elseif($order->status == 'in process')
                                                    <button type="button" class="btn btn-warning">
                                                        <span class="fa fa-cog fa-spin" aria-hidden="true"></span> On The Way!
                                                    </button>
                                                @elseif($order->status == 'closed')
                                                    <button type="button" class="btn btn-success">
                                                        <span class="fa fa-check-circle" aria-hidden="true"></span> Delivered
                                                    </button>
                                                @elseif($order->status == 'rejected')
                                                    <button type="button" class="btn btn-danger">
                                                        <i class="fa fa-close"></i> Cancelled
                                                    </button>
                                                @endif
                                            </td>
                                            <td data-column="Date">{{ $order->created_at->format('Y-m-d H:i:s') }}</td>
                                            <td data-column="Action">
                                                <form action="{{ route('orders.destroy', $order->o_id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-flat btn-addon btn-xs m-b-10" onclick="return confirm('Are you sure you want to cancel your order?');">
                                                        <i class="fa fa-trash-o" style="font-size:16px"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">You have No orders Placed yet.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection


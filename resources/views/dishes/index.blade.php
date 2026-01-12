@extends('layouts.app')

@section('title', 'Dishes || Online Food Ordering System')

@section('content')
<div class="page-wrapper">
    <div class="top-links">
        <div class="container">
            <ul class="row links">
                <li class="col-xs-12 col-sm-4 link-item"><span>1</span><a href="{{ route('restaurants.index') }}">Choose Restaurant</a></li>
                <li class="col-xs-12 col-sm-4 link-item active"><span>2</span><a href="#">Pick Your favorite food</a></li>
                <li class="col-xs-12 col-sm-4 link-item"><span>3</span><a href="#">Order and Pay</a></li>
            </ul>
        </div>
    </div>

    <section class="inner-page-hero bg-image" data-image-src="{{ asset('images/img/restrrr.png') }}">
        <div class="profile">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 profile-img">
                        <div class="image-wrap">
                            <figure>
                                <img src="{{ asset('admin/Res_img/' . $restaurant->image) }}" alt="Restaurant logo">
                            </figure>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 profile-desc">
                        <div class="pull-left right-text white-txt">
                            <h6><a href="#">{{ $restaurant->title }}</a></h6>
                            <p>{{ $restaurant->address }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="breadcrumb">
        <div class="container"></div>
    </div>

    <div class="container m-t-30">
        <div class="row">
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3">
                <div class="widget widget-cart">
                    <div class="widget-heading">
                        <h3 class="widget-title text-dark">Your Cart</h3>
                        <div class="clearfix"></div>
                    </div>
                    <div class="order-row bg-white">
                        <div class="widget-body">
                            @php
                                $cart = session('cart', []);
                                $item_total = 0;
                            @endphp
                            @forelse($cart as $item)
                                <div class="title-row">
                                    {{ $item['title'] }}
                                    <a href="{{ route('cart.remove', $item['d_id']) }}">
                                        <i class="fa fa-trash pull-right"></i>
                                    </a>
                                </div>
                                <div class="form-group row no-gutter">
                                    <div class="col-xs-8">
                                        <input type="text" class="form-control b-r-0" value="₱{{ number_format($item['price'], 2) }}" readonly>
                                    </div>
                                    <div class="col-xs-4">
                                        <input class="form-control" type="text" readonly value="{{ $item['quantity'] }}">
                                    </div>
                                </div>
                                @php
                                    $item_total += ($item['price'] * $item['quantity']);
                                @endphp
                            @empty
                                <p class="text-center">Your cart is empty</p>
                            @endforelse
                        </div>
                    </div>

                    <div class="widget-body">
                        <div class="price-wrap text-xs-center">
                            <p>TOTAL</p>
                            <h3 class="value"><strong>₱{{ number_format($item_total, 2) }}</strong></h3>
                            <p>Free Delivery!</p>
                            @if($item_total == 0)
                                <a href="#" class="btn btn-danger btn-lg disabled">Checkout</a>
                            @else
                                <a href="{{ route('checkout') }}" class="btn btn-success btn-lg active">Checkout</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="menu-widget" id="2">
                    <div class="widget-heading">
                        <h3 class="widget-title text-dark">
                            MENU
                            <a class="btn btn-link pull-right" data-toggle="collapse" href="#popular2" aria-expanded="true">
                                <i class="fa fa-angle-right pull-right"></i>
                                <i class="fa fa-angle-down pull-right"></i>
                            </a>
                        </h3>
                        <div class="clearfix"></div>
                    </div>
                    <div class="collapse in" id="popular2">
                        @forelse($dishes as $dish)
                            <div class="food-item">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-lg-8">
                                        <form method="post" action="{{ route('cart.add') }}">
                                            @csrf
                                            <input type="hidden" name="dish_id" value="{{ $dish->d_id }}">
                                            <div class="rest-logo pull-left">
                                                <a class="restaurant-logo pull-left" href="#">
                                                    <img src="{{ asset('admin/Res_img/dishes/' . $dish->img) }}" alt="Food logo">
                                                </a>
                                            </div>
                                            <div class="rest-descr">
                                                <h6><a href="#">{{ $dish->title }}</a></h6>
                                                <p>{{ $dish->slogan }}</p>
                                            </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-lg-3 pull-right item-cart-info">
                                        <span class="price pull-left">₱{{ number_format($dish->price, 2) }}</span>
                                        <input class="b-r-0" type="number" name="quantity" style="margin-left:30px;" value="1" size="2" min="1" required />
                                        <input type="submit" class="btn theme-btn" style="margin-left:40px;" value="Add To Cart" />
                                    </div>
                                        </form>
                                </div>
                            </div>
                        @empty
                            <p class="text-center">No dishes available</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


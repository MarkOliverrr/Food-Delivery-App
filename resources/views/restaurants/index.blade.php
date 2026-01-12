@extends('layouts.app')

@section('title', 'Restaurants')

@section('content')
<div class="page-wrapper">
    <div class="top-links">
        <div class="container">
            <ul class="row links">
                <li class="col-xs-12 col-sm-4 link-item active"><span>1</span><a href="#">Choose Restaurant</a></li>
                <li class="col-xs-12 col-sm-4 link-item"><span>2</span><a href="#">Pick Your favorite food</a></li>
                <li class="col-xs-12 col-sm-4 link-item"><span>3</span><a href="#">Order and Pay</a></li>
            </ul>
        </div>
    </div>
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
                <div class="col-xs-12 col-sm-5 col-md-5 col-lg-3"></div>
                <div class="col-xs-12 col-sm-7 col-md-7 col-lg-9">
                    <div class="bg-gray restaurant-entry">
                        <div class="row">
                            @foreach($restaurants as $restaurant)
                                <div class="col-sm-12 col-md-12 col-lg-8 text-xs-center text-sm-left">
                                    <div class="entry-logo">
                                        <a class="img-fluid" href="{{ route('dishes.show', $restaurant->rs_id) }}">
                                            <img src="{{ asset('admin/Res_img/' . $restaurant->image) }}" alt="Food logo">
                                        </a>
                                    </div>
                                    <div class="entry-dscr">
                                        <h5><a href="{{ route('dishes.show', $restaurant->rs_id) }}">{{ $restaurant->title }}</a></h5>
                                        <span>{{ $restaurant->address }}</span>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-4 text-xs-center">
                                    <div class="right-content bg-white">
                                        <div class="right-review">
                                            <a href="{{ route('dishes.show', $restaurant->rs_id) }}" class="btn btn-purple">View Menu</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection


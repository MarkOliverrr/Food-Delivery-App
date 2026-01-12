@extends('admin.layouts.app')

@section('title', 'Edit Dish')

@section('content')
<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-12">
            <h3 class="text-primary">Edit Dish</h3>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.dishes.update', $dish) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Restaurant</label>
                        <select name="rs_id" class="form-control">
                            @foreach($restaurants as $restaurant)
                                <option value="{{ $restaurant->rs_id }}" @if($dish->rs_id==$restaurant->rs_id) selected @endif>{{ $restaurant->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Title</label>
                        <input name="title" class="form-control" value="{{ $dish->title }}" required />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Slogan</label>
                        <input name="slogan" class="form-control" value="{{ $dish->slogan }}" required />
                    </div>
                    <div class="form-group col-md-6">
                        <label>Price</label>
                        <input type="number" step="0.01" name="price" class="form-control" value="{{ $dish->price }}" required />
                    </div>
                </div>
                <div class="form-group">
                    <label>Image</label>
                    <input type="file" name="img" class="form-control" />
                </div>
                <button class="btn btn-primary">Update</button>
                <a href="{{ route('admin.dishes.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection



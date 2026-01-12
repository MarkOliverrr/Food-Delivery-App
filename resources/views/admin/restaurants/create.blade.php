@extends('admin.layouts.app')

@section('title', 'Add Restaurant')

@section('content')
<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-12">
            <h3 class="text-primary">Add Restaurant</h3>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.restaurants.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Category</label>
                        <select name="c_id" class="form-control">
                            @foreach($categories as $category)
                                <option value="{{ $category->c_id }}">{{ $category->c_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Title</label>
                        <input name="title" class="form-control" required />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required />
                    </div>
                    <div class="form-group col-md-6">
                        <label>Phone</label>
                        <input name="phone" class="form-control" required />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Open Hours</label>
                        <input name="o_hr" class="form-control" required />
                    </div>
                    <div class="form-group col-md-6">
                        <label>Close Hours</label>
                        <input name="c_hr" class="form-control" required />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Open Days</label>
                        <input name="o_days" class="form-control" required />
                    </div>
                    <div class="form-group col-md-6">
                        <label>Address</label>
                        <input name="address" class="form-control" required />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Website (optional)</label>
                        <input type="url" name="url" class="form-control" />
                    </div>
                    <div class="form-group col-md-6">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control" required />
                    </div>
                </div>
                <button class="btn btn-primary">Save</button>
                <a href="{{ route('admin.restaurants.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection



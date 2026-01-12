@extends('admin.layouts.app')

@section('title', 'Restaurants')

@section('content')
<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-6 align-self-center">
            <h3 class="text-primary">Restaurants</h3>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{ route('admin.restaurants.create') }}" class="btn btn-sm btn-primary">Add Restaurant</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($restaurants as $restaurant)
                            <tr>
                                <td>{{ $restaurant->title }}</td>
                                <td>{{ optional($restaurant->category)->c_name }}</td>
                                <td>{{ $restaurant->email }}</td>
                                <td>{{ $restaurant->phone }}</td>
                                <td>
                                    <a href="{{ route('admin.restaurants.edit', $restaurant) }}" class="btn btn-sm btn-secondary">Edit</a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-center">No restaurants found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection



@extends('admin.layouts.app')

@section('title', 'Dishes')

@section('content')
<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-6 align-self-center">
            <h3 class="text-primary">Dishes</h3>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{ route('admin.dishes.create') }}" class="btn btn-sm btn-primary">Add Dish</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Restaurant</th>
                            <th>Price</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($dishes as $dish)
                            <tr>
                                <td>{{ $dish->title }}</td>
                                <td>{{ optional($dish->restaurant)->title }}</td>
                                <td>{{ number_format($dish->price, 2) }}</td>
                                <td><a href="{{ route('admin.dishes.edit', $dish) }}" class="btn btn-sm btn-secondary">Edit</a></td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="text-center">No dishes found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection



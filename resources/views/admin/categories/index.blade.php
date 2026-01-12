@extends('admin.layouts.app')

@section('title', 'Categories')

@section('content')
<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-6 align-self-center">
            <h3 class="text-primary">Categories</h3>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{ route('admin.categories.create') }}" class="btn btn-sm btn-primary">Add Category</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                            <tr>
                                <td>
                                    {{ $category->c_name }}
                                    <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm btn-secondary ml-2">Edit</a>
                                </td>
                            </tr>
                        @empty
                            <tr><td class="text-center">No categories.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection



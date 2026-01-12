@extends('admin.layouts.app')

@section('title', 'Add Category')

@section('content')
<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-12">
            <h3 class="text-primary">Add Category</h3>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.categories.store') }}">
                @csrf
                <div class="form-group">
                    <label>Name</label>
                    <input name="c_name" class="form-control" required />
                </div>
                <button class="btn btn-primary">Save</button>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-body">
            <h4 class="card-title">Existing Categories</h4>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Category Name</th>
                            <th>Date</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                            <tr>
                                <td>{{ $category->c_id }}</td>
                                <td>{{ $category->c_name }}</td>
                                <td>{{ optional($category->created_at)->format('Y-m-d H:i:s') }}</td>
                                <td class="text-right">
                                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" title="Delete" onclick="return confirm('Delete this category?');">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                    <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm btn-primary" title="Edit">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No categories yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection



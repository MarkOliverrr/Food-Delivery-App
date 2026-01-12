@extends('admin.layouts.app')

@section('title', 'Users')

@section('content')
<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-12">
            <h3 class="text-primary">Users</h3>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Login Method</th>
                            <th>Registration Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td>{{ $user->username }}</td>
                                <td>{{ trim($user->f_name . ' ' . $user->l_name) ?: '—' }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if($user->login_method === 'google')
                                        <span style="background-color: #4285F4; color: white; padding: 4px 8px; border-radius: 4px; font-size: 12px;">
                                            <i class="fa fa-google"></i> Google
                                        </span>
                                    @else
                                        <span style="background-color: #6c757d; color: white; padding: 4px 8px; border-radius: 4px; font-size: 12px;">
                                            Email
                                        </span>
                                    @endif
                                </td>
                                <td>{{ $user->created_at ? $user->created_at->format('Y-m-d H:i') : '—' }}</td>
                                <td>
                                    <div style="display: flex; gap: 5px;">
                                        <a class="btn btn-sm btn-info" href="{{ route('admin.users.show', $user) }}" title="View">
                                            <i class="fa fa-eye"></i> View
                                        </a>
                                        <a class="btn btn-sm btn-warning" href="{{ route('admin.users.edit', $user) }}" title="Edit">
                                            <i class="fa fa-edit"></i> Edit
                                        </a>
                                        <form method="POST" action="{{ route('admin.users.destroy', $user) }}" style="display: inline-block;" onsubmit="return confirm('Are you sure you want to delete this user? This action cannot be undone.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                                <i class="fa fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="text-center">No users.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: 15px;">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection



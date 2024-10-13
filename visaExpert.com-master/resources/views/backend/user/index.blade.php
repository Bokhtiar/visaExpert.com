@extends('layouts.backend.master')

@section('title', 'Users')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Users</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item active">Users</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">All Users</h4>
                     @hasPermission('Create User')
                    @can(\App\Permissions::CREATE_USER)
                        <div class="flex-shrink-0">
                            <div>
                                <a href="{{ route('admin.users.create') }}" class="btn btn-clr-red rounded-pill">
                                    Create New User
                                </a>
                            </div>
                        </div>
                    @endcan
                    @endhasPermission
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless align-middle table-nowrap mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Current Balance</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Salary</th>
                                    <th scope="col">Joined At</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $key => $user)
                                    <tr>
                                        <td class="fw-medium">{{ $key + 1 }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->role->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->balance }}Tk</td>
                                        <td>
                                            @if ($user->status)
                                                <div class="badge badge-gradient-success"> Active</div>
                                            @else
                                                <div class="badge badge-gradient-danger bg-danger">Inactive</div>
                                            @endif
                                        </td>
                                        <td>{{$user->salary}}</td>
                                        <td>{{ $user->created_at->diffForHumans() }}</td>
                                        <td>
                                            <div class="hstack gap-3 fs-15">
                                                @hasPermission('Edit User')
                                                    @can(\App\Permissions::EDIT_USER)
                                                        <a href="{{ route('admin.users.edit', $user->id) }}"
                                                            class="btn btn-primary waves-effect waves-light">
                                                            <i class="ri-pencil-line align-bottom me-1"></i>
                                                            Edit
                                                        </a>
                                                    @endcan
                                                @endhasPermission
                                                
                                                @hasPermission('Delete User')
                                                        {{-- @if ($user->deletable == true) --}}
                                                            <button type="button" class="btn btn-danger waves-effect waves-light"
                                                                onclick="deleteData({{ $user->id }})">
                                                                <i class="ri-delete-bin-5-line align-bottom me-1"></i>
                                                                Delete
                                                            </button>
                                                            <form id="delete-form-{{ $user->id }}"
                                                                action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                                                style="display: none;">
                                                                @csrf()
                                                                @method('DELETE')
                                                            </form>
                                                        {{-- @endif --}}
                                                    
                                                @endhasPermission
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

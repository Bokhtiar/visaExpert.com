@extends('layouts.backend.master')

@section('title', 'User Roles')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">User Roles</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item active">User Roles</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">All Roles</h4>
                    @can(\App\Permissions::CREATE_ROLE)
                        <div class="flex-shrink-0">
                            <div>
                                <a href="{{ route('admin.roles.create') }}" class="btn rounded-pill btn-clr-red">
                                    Add New Role
                                </a>
                            </div>
                        </div>
                    @endcan
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless align-middle table-nowrap mb-0">
                            <thead>
                            <tr>
                                <th scope="col">SL</th>
                                <th scope="col">Name</th>
                                <th scope="col">Total Users</th>
                                <th scope="col">Total Permissions</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($roles as $key=>$role)
                                <tr>
                                    <td class="fw-medium">{{ $key + 1 }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        @if ($role->users_count > 0)
                                            <span class="text-muted fw-bold">{{ $role->users_count }}</span>
                                        @else
                                            <span class="badge badge-label bg-danger"><i
                                                    class="mdi mdi-circle-medium"></i> No user found :(</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($role->permissions_count > 0)
                                            <span class="badge badge-label bg-primary"><i
                                                    class="mdi mdi-circle-medium"></i> {{ $role->permissions_count }}</span>
                                        @else
                                            <span class="badge badge-label bg-danger"><i
                                                    class="mdi mdi-circle-medium"></i> No permission found :(</span>
                                        @endif
                                    </td>
                                    <td>{{ $role->created_at->diffForHumans() }}</td>
                                    <td>
                                        <div class="hstack gap-3 fs-15">
                                            @can(\App\Permissions::EDIT_ROLE)
                                                <a href="{{ route('admin.roles.edit',$role->id) }}"
                                                   class="btn btn-primary waves-effect waves-light">
                                                    <i class="ri-pencil-line align-bottom me-1"></i>
                                                    Edit
                                                </a>
                                            @endcan
                                            @can(\App\Permissions::DELETE_ROLE)
                                                @if ($role->deletable == true)
                                                    <button type="button"
                                                            class="btn btn-danger waves-effect waves-light"
                                                            onclick="deleteData({{ $role->id }})">
                                                        <i class="ri-delete-bin-5-line align-bottom me-1"></i>
                                                        Delete
                                                    </button>
                                                    <form id="delete-form-{{ $role->id }}"
                                                          action="{{ route('admin.roles.destroy',$role->id) }}"
                                                          method="POST"
                                                          style="display: none;">
                                                        @csrf()
                                                        @method('DELETE')
                                                    </form>
                                                @endif
                                            @endcan
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

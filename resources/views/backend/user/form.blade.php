@extends('layouts.backend.master')

@section('title', isset($user) ? 'Edit User' : 'Create New User')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Users</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">Dashboard</li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Users</a></li>
                        <li class="breadcrumb-item active">{{ isset($user) ? 'Edit' : 'Create New' }} User</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <!-- form start -->
            <form role="form" id="userFrom" method="POST"
                  action="{{ isset($user) ? route('admin.users.update',$user->id) : route('admin.users.store') }}"
                  enctype="multipart/form-data">
                @csrf
                @if (isset($user))
                    @method('PUT')
                @endif
                <div class="row">
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <h5 class="card-title">User Information</h5>
                                    <div>
                                        <a href="{{ route('admin.users.index') }}" class="btn btn-success">
                                           <i class="ri-arrow-go-back-line"></i> Back to list
                                        </a>
                                        <button type="submit" class="btn btn-clr-red">
                                            @isset($user)
                                                <i class="ri-save-2-line"></i>
                                                Update
                                            @else
                                                <i class="ri-file-add-line"></i>
                                                Save
                                            @endisset
                                        </button>
                                    </div>
                                </div>
                                <div class="my-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input id="name" type="text"
                                           class="form-control @error('name') is-invalid @enderror" name="name"
                                           value="{{ $user->name ?? old('name') }}" required autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="my-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           value="{{ $user->email ?? old('email') }}" required>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="my-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror"
                                           name="password" {{ !isset($user) ? 'required' : '' }}>

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="my-3">
                                    <label for="confirm_password" class="form-label">Confirm Password</label>
                                    <input id="confirm_password" type="password"
                                           class="form-control @error('password') is-invalid @enderror"
                                           name="password_confirmation" {{ !isset($user) ? 'required' : '' }}>

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Select Role and Status</h5>
                                <div class="my-3">
                                    <label for="role" class="form-label">Select Role</label>
                                    <select name="role" id="role"
                                            class="form-control js-example-basic-single @error('role') is-invalid @enderror"
                                            name="role" required>
                                        @foreach ($roles as $key => $role)
                                            <option value="{{ $role->id }}" @isset($user)
                                                {{ $user->role->id == $role->id ? 'selected' : '' }}
                                                @endisset>{{ $role->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('role')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-check form-check-right mb-2">
                                    <input class="form-check-input" type="checkbox" name="status"
                                           id="formCheckboxRight1"
                                    @isset($user)
                                        {{ $user->status ? 'checked' : '' }}
                                        @endisset>
                                    <label class="form-check-label" for="formCheckboxRight1">
                                        Status
                                    </label>
                                    @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            {{-- permission user --}}
            <div class="card-body">
                    <form id="roleForm" method="POST"
                          {{-- action="{{ isset($role) ? route('admin.permission-user.update', $user->id) : route('admin.permission-user.store') }}"> --}}
                          action="{{ route('admin.permission-user.store') }}" >
                        @csrf
                        {{-- @if (isset($role)) 
                            @method('PUT')
                        @endif --}}
                        <input type="hidden" name="user_id" value="{{ $user->id }}" id="">
                        <div>
                            <label for="Role Name" class="form-label">Role Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   name="name"
                                   id="Role Name"
                                   value="{{ $role->name ?? old('name') }}"
                                   placeholder="Enter role name" required autofocus>

                            @error('name')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>

                        <div class="text-center my-3">
                            <strong>Manage permissions for role</strong>
                            @error('permissions')
                            <div class="p-2 text-danger">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="select-all">
                            <label class="form-check-label" for="select-all">
                                Select All
                            </label>
                        </div>
                        @forelse($modules->chunk(2) as $key => $chunks)
                            <div class="row mt-5">
                                @foreach ($chunks as $key => $module)
                                    <div class="col-md-6">
                                        <div class="form-check mb-4 form-check-inline">
                                            <input type="checkbox" class="form-check-input module-checkbox me-4"
                                                   id="module-{{ $module->id }}" value="{{ $module->id }}"
                                                   name="modules[]">
                                            <label class="form-check-label" for="module-{{ $module->id }}">
                                                <span class="h5">{{ $module->name }}</span>
                                            </label>
                                        </div> 
                                        @foreach ($module->permissions as $key => $permission)
                                            {{-- {{ dd($permission) }} --}}
                                            <div class="mb-3">
                                                
                                                <div
                                                    class="form-check form-switch form-switch-md form-switch-danger mb-2"
                                                    dir="ltr">
                                                    <input type="checkbox"
                                                           class="form-check-input"
                                                           id="permission-{{ $permission->id }}"
                                                           value="{{ $permission->id }}"
                                                           name="permissions[]"
                                                    @if (isset($specificUserPermission))
                                                        @foreach ($specificUserPermission as $rPermission)
                                                        {{-- {{ dd($rPermission) }}
                                                        {{ dd($permission->id == $rPermission->permission_id) }} --}}
                                                            {{ $permission->id == $rPermission->permission_id ? 'checked' : '' }}
                                                            @endforeach
                                                        @endif>
                                                    <label class="form-check-label"
                                                           for="permission-{{ $permission->id }}">{{ $permission->name }}</label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        @empty
                            <div class="row">
                                <div class="col text-center">
                                    <strong>No Module Found.</strong>
                                </div>
                            </div>
                        @endforelse
                        <div class="text-center mt-5">
                            @if (!isset($role))
                                <button type="button" class="btn btn-outline-dark" onClick="resetForm('roleForm')">
                                    <i class="fas fa-redo"></i>
                                    <span>Clear</span>
                                </button>
                            @endif
                            <button type="submit" class="btn btn-clr-red text-center">
                                @isset($role)
                                    <i class="fas fa-arrow-circle-up"></i>
                                    <span>Update</span>
                                @else
                                    <i class="fas fa-plus-circle"></i>
                                    <span>Create</span>
                                @endisset
                            </button>
                        </div>

                    </form>
                </div>
        </div>
    </div>

    @push('js')
    <script type="text/javascript">
        $('#select-all').click(function () {
            if (this.checked) {
                $(':checkbox').prop('checked', true);
            } else {
                $(':checkbox').prop('checked', false);
            }
        });

        $('.module-checkbox').change(function () {
            // let moduleId = $(this).val();
            let modulePermissions = $(this).closest('.col-md-6').find('.form-check-input[name^="permissions"]');
            modulePermissions.prop('checked', this.checked);
        });
    </script>
@endpush
@endsection

@extends('layouts.backend.master')

@section('title', isset($role) ? 'Edit Role' : 'Create New Role')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Roles</h4>
 
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">Dashboard</li>
                        <li class="breadcrumb-item">Roles</li>
                        <li class="breadcrumb-item active">{{ isset($role) ? 'Edit' : 'Create New' }} Role</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">{{ isset($role) ? 'Edit' : 'Create New' }} Role</h4>
                    <div class="flex-shrink-0">
                        <div>
                            <a href="{{ route('admin.roles.index') }}" class="btn btn-clr-red">
                                <i class="ri-arrow-go-back-line align-bottom me-1"></i>
                                Back to list
                            </a>
                        </div>
                    </div>
                </div> 
                <div class="card-body">
                    <form id="roleForm" method="POST"
                          action="{{ isset($role) ? route('admin.roles.update', $role->id) : route('admin.roles.store') }}">
                        @csrf
                        @if (isset($role)) 
                            @method('PUT')
                        @endif
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
                                            <div class="mb-3">
                                                <div
                                                    class="form-check form-switch form-switch-md form-switch-danger mb-2"
                                                    dir="ltr">
                                                    <input type="checkbox"
                                                           class="form-check-input"
                                                           id="permission-{{ $permission->id }}"
                                                           value="{{ $permission->id }}"
                                                           name="permissions[]"
                                                    @if (isset($role))
                                                        @foreach ($role->permissions as $rPermission)
                                                            {{ $permission->id == $rPermission->id ? 'checked' : '' }}
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
    </div>
@endsection

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

@extends('layouts.backend.master')

@section('title', 'Staff Duty & Salary')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Staff Duty & Salary</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item active">Staff Duty & Salary</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">All Staff Duties</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-card mb-1">
                        <table class="table table-borderless table-nowrap align-middle">
                            <thead class="text-muted table-light">
                                <tr class="text-uppercase">
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Duty Finger In</th>
                                    <th scope="col">Duty Finger Out</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @forelse($staffDutySalaries as $staff)
                                    <tr>
                                        <td class="fw-medium">
                                            {{ $staff->id }}
                                        </td>
                                        <td>
                                            {!! $staff->name !!}
                                        </td>
                                        <td>
                                            {{ date('g:i a', strtotime($staff->duty_finger_in)) }}
                                        </td>
                                        <td>
                                            {{ date('g:i a', strtotime($staff->duty_finger_out)) }}
                                        </td>
                                        <td>
                                            {{ $staff->created_at->format('d M Y') }}
                                        </td>
                                        <td>
                                            <div class="hstack gap-3 fs-15">
                                                @hasPermission('Edit Duty')
                                                    @can(\App\Permissions::EDIT_STAFF_DUTY_SALARY)
                                                        <a href="{{ route('admin.staff-duty-salaries.edit', $staff->id) }}"
                                                            class="btn btn-primary waves-effect waves-light">
                                                            <i class="ri-pencil-line align-bottom me-1"></i>
                                                            Edit
                                                        </a>
                                                    @endcan
                                                @endhasPermission
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td>No record Found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                {{ $staffDutySalaries->links('pagination.default') }}
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">{{ isset($staffDutySalary) ? 'Update' : 'Add' }} duty
                        time</h4>
                </div>
                <div class="card-body">
                    <form
                        action="{{ isset($staffDutySalary) ? route('admin.staff-duty-salaries.update', $staffDutySalary->id) : route('admin.staff-duty-salaries.store') }}"
                        method="POST">
                        @csrf
                        @if (isset($staffDutySalary))
                            @method('PUT')
                        @endif
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" id="name"
                                class="form-control mb-3 @error('name') is-invalid @enderror" name="name"
                                value="{{ $staffDutySalary->name ?? old('name') }}">

                            @error('name')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="duty_finger_in" class="form-label">Duty Finger In</label>
                            <input type="time" id="duty_finger_in"
                                class="form-control mb-3 @error('duty_finger_in') is-invalid @enderror"
                                name="duty_finger_in"
                                value="{{ $staffDutySalary->duty_finger_in ?? old('duty_finger_in') }}">

                            @error('duty_finger_in')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="duty_finger_out" class="form-label">Duty Finger Out</label>
                            <input type="time" id="duty_finger_out"
                                class="form-control mb-3 @error('duty_finger_out') is-invalid @enderror"
                                name="duty_finger_out"
                                value="{{ $staffDutySalary->duty_finger_out ?? old('duty_finger_out') }}">

                            @error('duty_finger_out')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                        <div class="mt-3">
                            @isset($staffDutySalary)
                                @hasPermission('Edit Duty')
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-plus-circle"></i>
                                        <span>Update</span>
                                    </button>
                                @endhasPermission
                            @else
                                @hasPermission('Create Duty')
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-plus-circle"></i>
                                        <span>Add</span>
                                    </button>
                                @endhasPermission
                            @endisset
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <!-- ckeditor -->
    <script src="{{ asset('backend/assets/libs/%40ckeditor/ckeditor5-build-classic/build/ckeditor.js') }}"></script>

    <!-- init js -->
    <script src="{{ asset('backend/assets/js/pages/form-editor.init.js') }}"></script>
@endpush

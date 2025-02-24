@extends('layouts.backend.master')

@section('title', 'Profile')

@section('content')
    <div class="position-relative mx-n4 mt-n4">
        <div class="profile-wid-bg profile-setting-img">
            <img src="{{ asset('backend/assets/images/profile-bg.jpg') }}" class="profile-wid-img" alt="">
        </div>
    </div>

    <div class="row">
        <div class="col-xxl-3">
            <div class="card mt-n5">
                <div class="card-body p-4">
                    <div class="text-center">
                        <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                            <img src="{{ asset('backend/assets/images/users/user.svg') }}"
                                class="rounded-circle avatar-xl img-thumbnail user-profile-image" alt="user-profile-image">
                        </div>
                        <h5 class="fs-16 mb-1">{{ Auth::user()->name }}</h5>
                        <p class="text-muted mb-0">{{ Str::ucfirst(Auth::user()->user_type) }}</p>
                    </div>
                </div>
            </div>
            <!--end card-->
        </div>
        <!--end col-->
        <div class="col-xxl-9">
            <div class="card mt-xxl-n5">
                <div class="card-header">
                    <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab">
                                <i class="fas fa-home"></i>
                                Personal Details
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#changePassword" role="tab">
                                <i class="far fa-user"></i>
                                Change Password
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#statement" role="tab">
                                <i class="far fa-user"></i>
                                Statement
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#attendance" role="tab">
                                <i class="far fa-user"></i>
                                Attendance
                            </a>
                        </li>

                         <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#Duty_Time_Salary" role="tab">
                                <i class="far fa-user"></i>
                                Duty Time & Salary
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body p-4">
                    <div class="tab-content">
                        <div class="tab-pane active" id="personalDetails" role="tabpanel">
                            <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Full Name</label>
                                            <input type="text" name="name" class="form-control" id="name"
                                                value="{{ $user->name }}">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Phone
                                                Number</label>
                                            <input type="number" name="phone" class="form-control" id="phone"
                                                value="{{ $user->phone }}">
                                        </div>
                                    </div>

                                    <!--end col-->
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="salary" class="form-label">Salary</label>
                                            <input type="number" name="salary" class="form-control" id="salary"
                                                value="{{ $user->salary }}">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email
                                                Address</label>
                                            <input type="email" name="email" class="form-control" id="email"
                                                value="{{ $user->email }}">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-12">
                                        <div class="mb-3 pb-2">
                                            <label for="address" class="form-label">Address</label>
                                            <textarea class="form-control" id="address" name="address" rows="3">{{ $user->address }}</textarea>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-12">
                                        <div class="hstack gap-2 justify-content-end">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                            <button type="button" class="btn btn-soft-secondary">Cancel</button>
                                        </div>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </form>
                        </div>
                        <!--end tab-pane-->
                        <div class="tab-pane" id="changePassword" role="tabpanel">
                            <form action="{{ route('admin.password.update') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row g-2">
                                    <div class="col-lg-4">
                                        <div>
                                            <label for="current_password" class="form-label">Current
                                                Password*</label>
                                            <input type="password" name="current_password" class="form-control"
                                                id="current_password" autocomplete="current-password">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4">
                                        <div>
                                            <label for="password" class="form-label">New
                                                Password*</label>
                                            <input type="password" class="form-control" name="password" id="password"
                                                autocomplete="new-password">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4">
                                        <div>
                                            <label for="password_confirmation" class="form-label">Confirm
                                                Password*</label>
                                            <input type="password" name="password_confirmation" class="form-control"
                                                id="password_confirmation" autocomplete="new-password">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-12">
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-primary">Change
                                                Password
                                            </button>
                                        </div>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </form>
                        </div>

                        <div class="tab-pane" id="statement" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-borderless align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col">SL</th>
                                            <th scope="col">Transfer</th>
                                            <th scope="col">Receiver</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col">Status</th>
                                    </thead>
                                    <tbody>

                                        @forelse($transfers as $key=>$transfer)
                                            <tr>
                                                <td class="fw-medium">{{ $key + 1 }}</td>
                                                <td>{{ $transfer->transfer ? $transfer->transfer->name : '' }}</td>
                                                <td>{{ $transfer->reciver ? $transfer->reciver->name : '' }}</td>
                                                <td>{{ $transfer->amount }} Tk</td>
                                                <td>{{ $transfer->status }}</td>
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

                        <div class="tab-pane" id="attendance" role="tabpanel">
                            <h5>Current Month Attendance History: ({{ $year }}-{{ $month }})</h5>
                            <div class="table-responsive">
                                <table class="table table-borderless align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col">SL</th>
                                            <th scope="col">Employee Name</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Punch-in</th>
                                            <th scope="col">Punch-out</th>

                                    </thead>
                                    <tbody>
                                        @forelse($attendanceRecords as $key=>$at)
                                            <tr>
                                                <td class="fw-medium">{{ $key + 1 }}</td>
                                                <td>{{ $at->user ? $at->user->name : '' }}</td>
                                                <td>{{ $at->date }}</td>
                                                <td>{{ $at->punch_in }}</td>
                                                <td>{{ $at->punch_out }}</td>
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


                        <div class="tab-pane active" id="Duty_Time_Salary" role="tabpanel">
                            <form action="{{ route('admin.profile.update') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="row">
                                    <!--end col-->
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="salary" class="form-label">Salary</label>
                                            <input type="number" name="salary" class="form-control" id="salary"
                                                value="{{ $user->salary }}">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="duty_time_start" class="form-label">Duty Time Start</label>
                                            <input type="time" name="duty_time_start" class="form-control" id="duty_time_start"
                                                value="{{ $user->duty_time_start }}">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="duty_time_end" class="form-label">Duty Time End</label>
                                            <input type="time" name="duty_time_end" class="form-control" id="duty_time_end"
                                                value="{{ $user->duty_time_end }}">
                                        </div>
                                    </div>

                                    <!--end col-->
                                    <div class="col-lg-12">
                                        <div class="hstack gap-2 justify-content-end">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                            <button type="button" class="btn btn-soft-secondary">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                                <!--end row-->
                            </form>
                        </div>


                        <!--end tab-pane-->
                    </div>
                </div>
            </div>
        </div>
        <!--end col-->
    </div>
@endsection

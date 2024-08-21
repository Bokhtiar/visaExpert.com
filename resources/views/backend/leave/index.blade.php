@extends('layouts.backend.master')

@section('title', 'Leave')
@section('content')
    <div class="row">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Leave</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Leave</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">All Leave</h4>

                                    <div class="flex-shrink-0">
                                        <div>
                                            @hasPermission('Leave Create')
                                            <a href="{{ route('admin.leave.create') }}"
                                                class="btn btn-clr-red rounded-pill">
                                                Create Leave
                                            </a>
                                            @endhasPermission
                                        </div>
                                    </div>

                                </div>
                                <div class="card-body">

                                    {{-- filter --}}
                                    <form method="POST" action="{{ route('admin.leave.filter') }}" class="mb-4">
                                        @csrf
                                        <div class="row mb-4">


                                            {{-- <div class="col-md-3">
                                                <label for="month" class="form-label">Month</label>
                                                <select name="month" id="month" class="form-control">
                                                    @for ($m = 1; $m <= 12; $m++)
                                                        <option value="{{ $m }}"
                                                            {{ $m == request('month', date('m')) ? 'selected' : '' }}>
                                                            {{ \Carbon\Carbon::create()->month($m)->format('F') }}
                                                        </option>
                                                    @endfor
                                                </select>
                                            </div> --}}

                                            <div class="col-md-3">
                                                <label for="month" class="form-label">Month</label>
                                                <select name="month" id="month" class="form-control">
                                                    @foreach (range(1, 12) as $m)
                                                        <option value="{{ $m }}"
                                                            {{ $m == $month ? 'selected' : '' }}>
                                                            {{ \Carbon\Carbon::create()->month($m)->format('F') }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-3">
                                                <label for="year" class="form-label">Year</label>
                                                <select name="year" id="year" class="form-control">
                                                    @for ($y = date('Y'); $y >= 2020; $y--)
                                                        <option value="{{ $y }}"
                                                            {{ $y == $year ? 'selected' : '' }}>
                                                            {{ $y }}
                                                        </option>
                                                    @endfor
                                                </select>
                                            </div>


                                            <div class="col-md-3 d-flex align-items-end">
                                                <button type="submit" class="btn btn-primary">Filter</button>
                                            </div>
                                        </div>
                                    </form>


                                    <div class="table-responsive">
                                        <table class="table table-borderless align-middle mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <td>Employee</td>
                                                    <th>Leave Type</th>
                                                    <th>Leave Date</th>
                                                    <th>Reason</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- {{dd($leaves)}} --}}
                                                @forelse($leaves as $leave)
                                                    {{-- {{dd($leave)}} --}}
                                                    <tr>
                                                        <td>{{ $leave->user_id }}</td>
                                                        <td>{{ $leave->leave_type }}</td>
                                                        <td>{{ $leave->date }}</td>
                                                        <td>{{ $leave->reason }}</td>
                                                        <td>{{ $leave->status }}</td>
                                                        <td>
                                                            @if ($leave->status == 'pending')
                                                                @hasPermission('Leave Approve-reject')
                                                                    <a href="{{ route('admin.leave.approved', $leave->id) }}"
                                                                        class="btn btn-success">Approved</a>
                                                                    <a href="{{ route('admin.leave.rejected', $leave->id) }}"
                                                                        class="btn btn-danger">Reject</a>
                                                                @endhasPermission
                                                                @hasPermission('Leave Edit')
                                                                    <a href="{{ route('admin.leave.edit', $leave->id) }}"
                                                                        class="btn btn-warning">Edit</a>
                                                                @endhasPermission
                                                                @hasPermission('Leave Delete')
                                                                    <form
                                                                        action="{{ route('admin.leave.destroy', $leave->id) }}"
                                                                        method="POST" style="display:inline-block;">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit"
                                                                            class="btn btn-danger">Delete</button>
                                                                    </form>
                                                                @endhasPermission
                                                            @endif

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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

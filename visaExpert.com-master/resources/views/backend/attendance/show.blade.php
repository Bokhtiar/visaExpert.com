@extends('layouts.backend.master')

@section('title', 'Attendance Sheet')

@section('content')

    <div class="">
        <form action="{{ url('admin/attendance/filter') }}" method="POST">
            @csrf
            <div class="row mb-4">
                <div class="col-md-3">
                    <label for="employee" class="form-label">Employee</label>
                    <select name="user_id" id="user_id" class="form-control">
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="month" class="form-label">Month</label>
                    <select name="month" id="month" class="form-control">
                        @for ($m = 1; $m <= 12; $m++)
                            <option value="{{ $m }}" {{ $m == request('month', date('m')) ? 'selected' : '' }}>
                                {{ \Carbon\Carbon::create()->month($m)->format('F') }}
                            </option>
                        @endfor
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="year" class="form-label">Year</label>
                    <select name="year" id="year" class="form-control">
                        @for ($y = date('Y'); $y >= 2020; $y--)
                            <option value="{{ $y }}" {{ $y == request('year', date('Y')) ? 'selected' : '' }}>
                                {{ $y }}
                            </option>
                        @endfor
                    </select>
                </div>
                @hasPermission('Attendance Filter')
                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
                @endhasPermission
            </div>
        </form>
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Today Attendance Sheet</h4>
            </div>
            <div class="">
                <table id="example" class="table table-borderless align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Punch In</th>
                            <th>Punch Out</th>
                            <th>Total Hours</th>
                            <th>Late Hours</th>
                            <th>Early Out Hours</th>
                            <th>Fine</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($attendances as $attendance)
                            <tr>
                                <td>{{ $attendance->date->format('Y-m-d') }}</td>
                                <td>
                                    @if ($attendance->status == 'late')
                                        <span class="btn btn-sm btn-danger">{{ $attendance->status }}</span>
                                    @elseif ($attendance->status == 'normal')
                                        <span class="btn btn-sm btn-success">{{ $attendance->status }}</span>
                                    @elseif ($attendance->status == 'leave')
                                        <span class="btn btn-sm btn-danger">{{ $attendance->status }}</span>
                                    @elseif ($attendance->status == 'early_out')
                                        <span class="btn btn-sm btn-danger">{{ $attendance->status }}</span>
                                    @endif

                                </td>
                                <td>{{ $attendance ? \Carbon\Carbon::parse($attendance->punch_in)->format('g:i A') : 'N/A' }}
                                </td>
                                <td>{{ $attendance ? \Carbon\Carbon::parse($attendance->punch_out)->format('g:i A') : 'N/A' }}
                                </td>
                                <td>{{ $attendance ? $attendance->total_hour : 'N/A' }}</td>
                                <td>{{ $attendance ? $attendance->late_hour : 'N/A' }}</td>
                                <td>{{ $attendance ? $attendance->early_out_hour : 'N/A' }}</td>
                                <td>
                                    @hasPermission('Attendance Fine Update')
                                    <form action="{{ url('/admin/attendance/find-cancel', $attendance->id) }}"
                                        method="POST">
                                        @csrf
                                        <input style="width:80px " type="text" name="fine" id=""
                                            value="{{ $attendance->fine }}">
                                        <input type="submit" name="" value="Update" class="btn btn-success btn-sm"
                                            id="">
                                    </form>
                                    @endhasPermission
                                </td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>

            </div>
        </div>
    </div>

@endsection

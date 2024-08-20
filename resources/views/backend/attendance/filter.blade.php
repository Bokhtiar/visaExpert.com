{{-- @extends('layouts.backend.master')

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
                            <option value="{{ $user->id }}" {{ $user->id == $findUser->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="month" class="form-label">Month</label>
                    <select name="month" id="month" class="form-control">
                        @for ($m = 1; $m <= 12; $m++)
                            <option value="{{ $m }}" {{ $m == $month ? 'selected' : '' }}>
                                {{ \Carbon\Carbon::create()->month($m)->format('F') }}
                            </option>
                        @endfor
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="year" class="form-label">Year</label>
                    <select name="year" id="year" class="form-control">
                        @for ($y = date('Y'); $y >= 2020; $y--)
                            <option value="{{ $y }}" {{ $y == $year ? 'selected' : '' }}>
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

        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Attendance Sheet</h4>
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
                                    <form
                                        action="{{ url('admin/attendance/fine-cancel-filter', ['id' => $attendance->id, 'month' => $month, 'user' => $findUser->id, 'year' => $year]) }}"
                                        method="POST">
                                        @csrf
                                        <input style="width:80px" type="text" name="fine"
                                            value="{{ $attendance->fine }}">
                                        <input type="submit" value="Update" class="btn btn-success btn-sm">
                                    </form>

                                </td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection --}}


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
                            <option value="{{ $user->id }}" {{ $user->id == $findUser->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="month" class="form-label">Month</label>
                    <select name="month" id="month" class="form-control">
                        @for ($m = 1; $m <= 12; $m++)
                            <option value="{{ $m }}" {{ $m == $month ? 'selected' : '' }}>
                                {{ \Carbon\Carbon::create()->month($m)->format('F') }}
                            </option>
                        @endfor
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="year" class="form-label">Year</label>
                    <select name="year" id="year" class="form-control">
                        @for ($y = date('Y'); $y >= 2020; $y--)
                            <option value="{{ $y }}" {{ $y == $year ? 'selected' : '' }}>
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

        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">{{ $user->name }} Attendance Sheet
                    ({{ \Carbon\Carbon::create()->month($month)->format('F') }})</h4>
                <div>
                    {{-- <p>Total File: {{$user->salary .-. $totalFine  .=. $user->salary - $totalFine}}</p> --}}
                    <p>
                        <sapn class="bg-danger rounded text-white px-2">Total Fine ({{ \Carbon\Carbon::create()->month($month)->format('F') }}): {{ $totalFine }} Tk
                        </sapn>
                        <span class="bg-info text-white rounded px-2 mx-2">Salary : {{ $findUser->salary }} Tk</span>
                        <span class="bg-success text-white rounded px-2"> Salary ({{ \Carbon\Carbon::create()->month($month)->format('F') }}): {{$findUser->salary - $totalFine}} Tk</span>
                    </p>

                </div>
            </div>
            <div class="">
                <table id="example" class="table table-borderless align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Status / Name</th>
                            <th>Punch In</th>
                            <th>Punch Out</th>
                            <th>Total Hours</th>
                            <th>Late Hours</th>
                            <th>Early Out Hours</th>
                            <th>Fine</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($combinedRecords as $record)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($record->date)->format('Y-m-d') }}</td>
                                <td>
                                    @if ($record instanceof \App\Models\Holiday)
                                        <span class="badge bg-primary">Holiday</span>
                                    @elseif($record instanceof \App\Models\Leave)
                                        <span class="badge bg-primary">Leave</span>
                                    @else
                                        @if ($record->status == 'late')
                                            <span class="btn btn-sm btn-danger">{{ $record->status }}</span>
                                        @elseif ($record->status == 'normal')
                                            <span class="btn btn-sm btn-success">{{ $record->status }}</span>
                                        @elseif ($record->status == 'leave')
                                            <span class="btn btn-sm btn-danger">{{ $record->status }}</span>
                                        @elseif ($record->status == 'early_out')
                                            <span class="btn btn-sm btn-danger">{{ $record->status }}</span>
                                        @endif
                                    @endif
                                </td>
                                <td>
                                    @if ($record instanceof \App\Models\Holiday)
                                        {{ $record->name }}
                                    @else
                                        {{ $record->status }} <!-- Or other relevant info -->
                                    @endif
                                </td>
                                <td>
                                    @if (!$record instanceof \App\Models\Holiday)
                                        {{ $record->punch_in ? \Carbon\Carbon::parse($record->punch_in)->format('g:i A') : 'N/A' }}
                                    @endif
                                </td>
                                <td>
                                    @if (!$record instanceof \App\Models\Holiday)
                                        {{ $record->punch_out ? \Carbon\Carbon::parse($record->punch_out)->format('g:i A') : 'N/A' }}
                                    @endif
                                </td>
                                <td>
                                    @if (!$record instanceof \App\Models\Holiday)
                                        {{ $record->total_hour ?? 'N/A' }}
                                    @endif
                                </td>
                                <td>
                                    @if (!$record instanceof \App\Models\Holiday)
                                        {{ $record->late_hour ?? 'N/A' }}
                                    @endif
                                </td>
                                <td>
                                    @if (!$record instanceof \App\Models\Holiday)
                                        {{ $record->early_out_hour ?? 'N/A' }}
                                    @endif
                                </td>
                                <td>
                                    @if (!$record instanceof \App\Models\Holiday)
                                        <form
                                            action="{{ url('admin/attendance/fine-cancel-filter', ['id' => $record->id, 'month' => $month, 'user' => $findUser->id, 'year' => $year]) }}"
                                            method="POST">
                                            @csrf
                                            <input style="width:80px" type="text" name="fine"
                                                value="{{ $record->fine }}">
                                            <input type="submit" value="Update" class="btn btn-success btn-sm">
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection

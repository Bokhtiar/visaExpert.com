@extends('layouts.backend.master')

@section('title', 'Attendance Sheet')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xxl-12">
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
                                            <form action="{{ url('/admin/attendance/find-cancel', $attendance->id) }}"
                                                method="POST">
                                                <input style="width:80px " type="text" name="fine" id=""
                                                    value="{{ $attendance->fine }}">
                                                <input type="submit" name="" value="Update"
                                                    class="btn btn-success btn-sm" id="">
                                            </form>
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

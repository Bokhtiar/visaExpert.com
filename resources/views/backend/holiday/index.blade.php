@extends('layouts.backend.master')

@section('title', 'Holiday')
@section('content')
    <div class="row">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Holiday</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Holiday</li>
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
                                    <h4 class="card-title mb-0 flex-grow-1">All Holiday</h4>

                                    <div class="flex-shrink-0">
                                        <div>
                                            @hasPermission('Holiday Create')
                                                <a href="{{ route('admin.holiday.create') }}"
                                                    class="btn btn-clr-red rounded-pill">
                                                    Create Holiday
                                                </a>
                                            @endhasPermission
                                        </div>
                                    </div>

                                </div>
                                <div class="card-body">

                                    {{-- filter --}}
                                    <form method="POST" action="{{ route('admin.holiday.filter') }}" class="mb-4">
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
                                                    <th>Name</th>
                                                    <th>Date</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @forelse($holidays as $holiday)
                                                    <tr>
                                                        <td>{{ $holiday->name }}</td>
                                                        <td>{{ $holiday->date }}</td>
                                                        <td>
                                                            @hasPermission('Holiday Edit')
                                                                <a href="{{ route('admin.holiday.edit', $holiday->id) }}"
                                                                    class="btn btn-warning">Edit</a>
                                                            @endhasPermission
                                                            @hasPermission('Holiday Delete')
                                                                <form
                                                                    action="{{ route('admin.holiday.destroy', $holiday->id) }}"
                                                                    method="POST" style="display:inline-block;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="btn btn-danger">Delete</button>
                                                                </form>
                                                            @endhasPermission
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

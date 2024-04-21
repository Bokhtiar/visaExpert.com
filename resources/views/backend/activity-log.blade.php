@extends('layouts.backend.master')

@section('title', 'Activity Logs')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Activity Logs</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item active">Activity Logs</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">All Logs</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-card mb-1">
                        <table class="table table-nowrap align-middle">
                            <thead class="text-muted table-light">
                            <tr class="text-uppercase">
                                <th scope="col" class="text-center">SL</th>
                                <th scope="col" class="text-center">Description</th>
                            </tr>
                            </thead>
                            <tbody class="list">
                            @forelse($activityLogs as $key=>$log)
                                <tr>
                                    <td class="fw-medium text-center">{{$key + $activityLogs->firstItem()}}</td>
                                    <td class="text-center">{{ $log->content }}</td>
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
                {{ $activityLogs->links('pagination.default') }}
            </div>
        </div>
    </div>
    </div>
@endsection

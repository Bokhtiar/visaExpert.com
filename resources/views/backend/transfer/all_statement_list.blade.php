@extends('layouts.backend.master')

@section('title', 'Transfer')
@section('content')
<div class="row">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Transfer</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item active">Transfer</li>
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
                                <h4 class="card-title mb-0 flex-grow-1">All Transfer</h4>

                                <div class="flex-shrink-0">
                                    <div>
                                        @hasPermission('Transfer Create')
                                        <a href="{{ route('admin.transfer.create') }}"
                                            class="btn btn-clr-red rounded-pill">
                                            Create transfer
                                        </a>
                                        @endhasPermission

                                    </div>
                                </div>

                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-borderless align-middle mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th scope="col">SL</th>
                                                <th scope="col">Date & Time</th>
                                                <th scope="col">Transfer</th>
                                                <th scope="col">Amount</th>
                                                <th scope="col">Status</th>
                                        </thead>
                                        <tbody>

                                            @forelse($transfers as $key=>$transfer)
                                            <tr>
                                                <td class="fw-medium">{{ $key + 1 }}</td>
                                                <td>{{ $transfer->created_at }}</td>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
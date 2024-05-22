@extends('layouts.backend.master')

@section('title', 'Service Configuration')

@section('content')
    <div class="row">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Service Charge</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">All Service Charges</li>
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
                                    <h4 class="card-title mb-0 flex-grow-1">All Service Charges</h4>
                                    @can(\App\Permissions::CREATE_SERVICE)
                                        <div class="flex-shrink-0">
                                            <div>
                                                @hasPermission('Create Service')
                                                <a href="{{ route('admin.services.create') }}"
                                                   class="btn btn-clr-red rounded-pill">
                                                    Create New Service
                                                </a>
                                                @endhasPermission

                                            </div>
                                        </div>
                                    @endcan
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive table-card">
                                        <table class="table table-nowrap table-striped-columns mb-0">
                                            <thead class="table-light">
                                            <tr>
                                                <th scope="col">SL</th>
                                                <th scope="col">Service Type</th>
                                                <th scope="col">Agent Amount (in BDT)</th>
                                                <th scope="col">Customer Amount (in BDT)</th>
                                                @can(\App\Permissions::EDIT_SERVICE, \App\Permissions::DELETE_SERVICE)
                                                    <th scope="col">Actions</th>
                                                @endcan
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @forelse($services as $key=>$service)
                                                <tr>
                                                    <td class="fw-medium text-center">{{ $key + 1 }}</td>
                                                    <td>{{ Str::ucfirst($service->title) }}</td>
                                                    <td>{{ $service->agent_amount }}</td>
                                                    <td>{{ $service->customer_amount }}</td>
                                                    <td>
                                                        <div class="hstack gap-3 fs-15">
                                                            @hasPermission('Update Service')
                                                            @can(\App\Permissions::EDIT_SERVICE)
                                                                <a href="{{ route('admin.services.edit', $service->id) }}"
                                                                   class="btn btn-primary waves-effect waves-light">
                                                                    <i class="ri-pencil-line align-bottom me-1"></i>
                                                                    Edit
                                                                </a>
                                                            @endcan
                                                            @endhasPermission
                                                            @hasPermission('Delete Service')
                                                            @can(\App\Permissions::DELETE_SERVICE)
                                                                <button type="button"
                                                                        class="btn btn-danger waves-effect waves-light"
                                                                        onclick="deleteData({{ $service->id }})">
                                                                    <i class="ri-delete-bin-5-line align-bottom me-1"></i>
                                                                    Delete
                                                                </button>
                                                                <form id="delete-form-{{ $service->id }}"
                                                                      action="{{ route('admin.services.destroy',$service->id) }}"
                                                                      method="POST"
                                                                      style="display: none;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                </form>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

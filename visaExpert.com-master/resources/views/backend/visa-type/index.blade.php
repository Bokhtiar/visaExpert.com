@extends('layouts.backend.master')

@section('title', 'Visa Types')
@section('content')
    <div class="row">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Visa Types</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Visa Types</li>
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
                                    <h4 class="card-title mb-0 flex-grow-1">All Visa Types</h4>
                                    @can(\App\Permissions::CREATE_VISA_TYPE)
                                        <div class="flex-shrink-0">
                                            <div>
                                                <a href="{{ route('admin.visa-types.create') }}"
                                                    class="btn btn-clr-red rounded-pill">
                                                    Create New Type
                                                </a>
                                            </div>
                                        </div>
                                    @endcan
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-borderless align-middle mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th scope="col">SL</th>
                                                    <th scope="col">Visa Type</th>
                                                    <th scope="col">Required Documents</th>
                                                    <th scope="col">Admin</th>
                                                    <th scope="col">User</th>
                                                    @can(\App\Permissions::EDIT_VISA_TYPE,
                                                        \App\Permissions::DELETE_VISA_TYPE)
                                                        <th scope="col">Actions</th>
                                                    @endcan
                                            </thead>
                                            <tbody>

                                                @forelse($visaTypes as $key=>$visaType)

                                                    <tr>
                                                        <td class="fw-medium">{{ $key + 1 }}</td>
                                                        <td>{{ $visaType->title }}</td>
                                                        <td>
                                                            @if ($visaType->required_documents !== null)
                                                                <ul>
                                                                    @foreach (json_decode($visaType->required_documents) as $document)
                                                                        <li>{{ $document }}</li>
                                                                    @endforeach
                                                                </ul>
                                                            @else
                                                                No required documents available.
                                                            @endif
                                                            {!! $visaType->required_document !!}

                                                        </td>
                                                        <td class="my-2">
                                                            @if ($visaType->is_admin == 1)
                                                                <a class="" 
                                                                    href="{{ route('admin.visa-types.admin.status', $visaType->id) }}">
                                                                    <img src="{{ asset('backend/assets/images/active.png') }}"
                                                                        height="30px" alt="">
                                                                </a>
                                                            @else
                                                                <a class=""
                                                                    href="{{ route('admin.visa-types.admin.status', $visaType->id) }}">
                                                                    <img src="{{ asset('backend/assets/images/inactive.png') }}"
                                                                        height="30px" alt="">
                                                                </a>
                                                            @endif
                                                        </td>
                                                        <td class="my-2">
                                                            @if ($visaType->is_user == 1)
                                                                <a class="" 
                                                                    href="{{ route('admin.visa-types.user.status', $visaType->id) }}">
                                                                    <img src="{{ asset('backend/assets/images/active.png') }}"
                                                                        height="30px" alt="">
                                                                </a>
                                                            @else
                                                                <a class=""
                                                                    href="{{ route('admin.visa-types.user.status', $visaType->id) }}">
                                                                    <img src="{{ asset('backend/assets/images/inactive.png') }}"
                                                                        height="30px" alt="">
                                                                </a>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @hasPermission('Visa Update Type')
                                                                <div class="hstack gap-3 fs-15">
                                                                    @can(\App\Permissions::EDIT_VISA_TYPE)
                                                                        <a href="{{ route('admin.visa-types.edit', $visaType->id) }}"
                                                                            class="btn btn-primary waves-effect waves-light">
                                                                            <i class="ri-pencil-line align-bottom me-1"></i>
                                                                            Edit
                                                                        </a>
                                                                    @endcan
                                                                @endhasPermission
                                                                @hasPermission('Visa Delete Type')
                                                                    @can(\App\Permissions::DELETE_VISA_TYPE)
                                                                        <button type="button"
                                                                            class="btn btn-danger waves-effect waves-light"
                                                                            onclick="deleteData({{ $visaType->id }})">
                                                                            <i class="ri-delete-bin-5-line align-bottom me-1"></i>
                                                                            Delete
                                                                        </button>
                                                                        <form id="delete-form-{{ $visaType->id }}"
                                                                            action="{{ route('admin.visa-types.destroy', $visaType->id) }}"
                                                                            method="POST" style="display: none;">
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
                                {{ $visaTypes->links('pagination.default') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

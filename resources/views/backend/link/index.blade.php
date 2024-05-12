@extends('layouts.backend.master')

@section('title', 'Link')
@section('content')
    <div class="row">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Link</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Link</li>
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
                                    <h4 class="card-title mb-0 flex-grow-1">All Link</h4>

                                    <div class="flex-shrink-0">
                                        <div>
                                            <a href="{{ route('admin.link.create') }}" class="btn btn-clr-red rounded-pill">
                                                Create Link
                                            </a>
                                        </div>
                                    </div>

                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-borderless align-middle mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th scope="col">SL</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Website Link</th>
                                                    <th scope="col">Actions</th>
                                            </thead>
                                            <tbody>

                                                @forelse($links as $link)
                                                    <tr>
                                                        <td class="fw-medium">{{ $loop->index + 1 }}</td>
                                                        <td>{{ $link->name }}</td>
                                                        <td>{{ $link->link }}</td>

                                                        <td>
                                                            <div class="hstack gap-3 fs-15">
                                                                @can(\App\Permissions::EDIT_LINK)
                                                                    <a href="{{ route('admin.link.edit', $link->id) }}"
                                                                        class="btn btn-primary waves-effect waves-light">
                                                                        <i class="ri-pencil-line align-bottom me-1"></i>
                                                                        Edit
                                                                    </a>
                                                                @endcan
                                                                @can(\App\Permissions::DELETE_LINK)
                                                                    <button type="button"
                                                                        class="btn btn-danger waves-effect waves-light"
                                                                        onclick="deleteData({{ $link->id }})">
                                                                        <i class="ri-delete-bin-5-line align-bottom me-1"></i>
                                                                        Delete
                                                                    </button>
                                                                    <form id="delete-form-{{ $link->id }}"
                                                                        action="{{ route('admin.link.destroy', $link->id) }}"
                                                                        method="POST" style="display: none;">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                    </form>
                                                                @endcan
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

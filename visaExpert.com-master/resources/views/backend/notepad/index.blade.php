@extends('layouts.backend.master')

@section('title', 'Notepad')
@section('content')
    <div class="row">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Notepad</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Notepad</li>
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
                                    <h4 class="card-title mb-0 flex-grow-1">All notepad</h4>

                                    <div class="flex-shrink-0">
                                        <div>
                                              @hasPermission('Notepad create')
                                            <a href="{{ route('admin.notepad.create') }}"
                                                class="btn btn-clr-red rounded-pill">
                                                Create notepad
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
                                                    <th scope="col">Title</th>
                                                    <th scope="col">Actions</th>
                                            </thead>
                                            <tbody>

                                                @forelse($notepads as $notepad)
                                                    <tr>
                                                        <td class="fw-medium">{{ $loop->index + 1 }}</td>
                                                        <td>{{ $notepad->title }}</td>

                                                        <td>
                                                            <div class="hstack gap-3 fs-15">
                                                                @hasPermission('Notepad edit')
                                                                    <a href="{{ route('admin.notepad.edit', $notepad->id) }}"
                                                                        class="btn btn-primary waves-effect waves-light">
                                                                        <i class="ri-pencil-line align-bottom me-1"></i>
                                                                        Edit
                                                                    </a>
                                                                @endhasPermission
                                                                @hasPermission('Notepad show')
                                                                    <a href="{{ route('admin.notepad.show', $notepad->id) }}"
                                                                        class="btn btn-success waves-effect waves-light">
                                                                        <i class="ri-eye-line align-bottom me-1"></i>
                                                                        Show
                                                                    </a>
                                                                @endhasPermission
                                                                @hasPermission('Notepad delete')
                                                                    <button type="button"
                                                                        class="btn btn-danger waves-effect waves-light"
                                                                        onclick="deleteData({{ $notepad->id }})">
                                                                        <i class="ri-delete-bin-5-line align-bottom me-1"></i>
                                                                        Delete
                                                                    </button>
                                                                    <form id="delete-form-{{ $notepad->id }}"
                                                                        action="{{ route('admin.notepad.destroy', $notepad->id) }}"
                                                                        method="POST" style="display: none;">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                    </form>
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

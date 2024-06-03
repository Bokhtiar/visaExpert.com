@extends('layouts.backend.master')

@section('title', 'View Notepad')

@section('content')
    <div class="row">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">View Notepad</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">Dashboard</li>
                                <li class="breadcrumb-item">Notepad</li>
                                <li class="breadcrumb-item active">View Notepad</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">View Notepad</h4>
                            <div class="flex-shrink-0">
                                <div>
                                    <a href="{{ route('admin.notepad.index') }}" class="btn btn-secondary">
                                        <i class="ri-arrow-left-line align-bottom me-1"></i>
                                        Back to list
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form id="visa-form"
                                  method="POST">
                                <div>
                                    <label for="title" class="form-label">Name</label>
                                    <input type="text" id="title"
                                           class="form-control mb-3" value="{{ $show->title }}"
                                           disabled=""
                                    >
                                </div>
                                
                                <div class="mt-3">
                                    <a href="{{ route('admin.notepad.edit', $show->id) }}"
                                       class="btn btn-primary">
                                        <i class="ri-pencil-line align-bottom me-1"></i>
                                        <span>Edit</span>
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <!-- ckeditor -->
    <script src="{{ asset('backend/assets/libs/%40ckeditor/ckeditor5-build-classic/build/ckeditor.js') }}"></script>
    <!-- init js -->
    <script src="{{ asset('backend/assets/js/pages/form-editor.init.js') }}"></script>
@endpush


@extends('layouts.backend.master')

@section('title', isset($edit) ? 'Edit Holiday' : 'Create New Holiday')

@section('content')

    <div class="row">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">New Holiday</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">Dashboard</li>
                                <li class="breadcrumb-item">Holiday</li>
                                <li class="breadcrumb-item active">Create Holiday</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">{{ isset($edit) ? 'Edit' : 'Create New' }}
                                Holiday</h4>
                            <div class="flex-shrink-0">
                                <div>
                                    <a href="{{ route('admin.holiday.index') }}" class="btn btn-clr-red">
                                        <i class="ri-arrow-left-line align-bottom me-1"></i>
                                        Back to list
                                    </a>
                                </div>
                            </div>
                        </div>
 
                        <div class="card-body">
                            <form id="holiday-form"
                                action="{{ isset($edit) ? route('admin.holiday.update', $edit->id) : route('admin.holiday.store') }}"
                                method="POST">
                                @csrf
                                @if (isset($edit))
                                    @method('PUT')
                                @endif
                          
                                <!-- Name Field -->
                                <div>
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" id="name"
                                        class="form-control mb-3 @error('name') is-invalid @enderror" name="name"
                                        value="{{ $edit->name ?? old('name') }}">

                                    @error('name')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>

                                <!-- Date Field -->
                                <div>
                                    <label for="date" class="form-label">Date</label>
                                    <input type="date" id="date"
                                        class="form-control mb-3 @error('date') is-invalid @enderror" name="date"
                                        value="{{ $edit->date ?? old('date') }}">

                                    @error('date')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>

                                <!-- Submit Button -->
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-plus-circle"></i>
                                        <span>{{ isset($edit) ? 'Update' : 'Create' }}</span>
                                    </button>
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

    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
    </script>


    <!-- init js -->
    <script src="{{ asset('backend/assets/js/pages/form-editor.init.js') }}"></script>
@endpush

@extends('layouts.backend.master')

@section('title', isset($edit) ? 'Edit Leave' : 'Create New Leave')

@section('content')

    <div class="row">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">New Leave</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">Dashboard</li>
                                <li class="breadcrumb-item">Leave</li>
                                <li class="breadcrumb-item active">Create Leave</li>
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
                                Leave</h4>
                            <div class="flex-shrink-0">
                                <div>
                                    <a href="{{ route('admin.leave.index') }}" class="btn btn-clr-red">
                                        <i class="ri-arrow-left-line align-bottom me-1"></i>
                                        Back to list
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <form id="leave-form"
                                action="{{ isset($edit) ? route('admin.leave.update', $edit->id) : route('admin.leave.store') }}"
                                method="POST">
                                @csrf
                                @if (isset($edit))
                                    @method('PUT')
                                @endif

                            

                               

                                <!--leave_date Date Field -->
                                <div>
                                    <label for="leave_date" class="form-label">Leave date</label>
                                    <input type="date" id="leave_date"
                                        class="form-control mb-3 @error('date') is-invalid @enderror" name="leave_date"
                                        value="{{ $edit->leave_date ?? old('leave_date') }}">

                                    @error('leave_date')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>


                                 <!-- leave_type Field -->
                                <div>
                                    <label for="leave_type" class="form-label">Leave Type</label>
                                    <input type="text" id="leave_type"
                                        class="form-control mb-3 @error('leave_type') is-invalid @enderror" name="leave_type"
                                        value="{{ $edit->leave_type ?? old('leave_type') }}">

                                    @error('leave_type')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>


                                 <!-- reason Field -->
                                <div>
                                    <label for="reason" class="form-label">Leave reason</label>
                                    <input type="text" id="reason"
                                        class="form-control mb-3 @error('reason') is-invalid @enderror" name="reason"
                                        value="{{ $edit->reason ?? old('reason') }}">

                                    @error('reason')
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

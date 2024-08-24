@extends('layouts.backend.master')

@section('title',  isset($visaType) ? 'Edit Visa Type' : 'Create New Visa Type')

@section('content')
    <div class="row">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">New Visa Type</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">Dashboard</li>
                                <li class="breadcrumb-item">Visa Type</li>
                                <li class="breadcrumb-item active">Create New</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">{{ isset($visaType) ? 'Edit' : 'Create New' }}
                                Visa Type</h4>
                            <div class="flex-shrink-0">
                                <div>
                                    <a href="{{ route('admin.visa-types.index') }}" class="btn btn-clr-red">
                                        <i class="ri-arrow-left-line align-bottom me-1"></i>
                                        Back to list
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form id="visa-form"
                                  action="{{ isset($visaType) ? route('admin.visa-types.update', $visaType->id) : route('admin.visa-types.store') }}"
                                  method="POST">
                                @csrf
                                @if (isset($visaType))
                                    @method('PUT')
                                @endif
                                <div>
                                    <label for="title" class="form-label">Name</label>
                                    <input type="text" id="title"
                                           class="form-control mb-3 @error('title') is-invalid @enderror"
                                           name="title" value="{{ $visaType->title ?? old('title') }}">

                                    @error('title')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>
                                <div class="my-2">
                                    <label for="required_documents" class="form-label">Required Documents</label>
                                    <textarea name="required_documents" class="form-control"
                                              rows="3">{{ isset($visaType) ? implode(", ", json_decode($visaType->required_documents)) : "" }}</textarea>
                                    @error('description')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>
                                <div class="mt-3">
                                    @isset($visaType)
                                        <button type="submit" class="btn btn-success">
                                            <i class="fas fa-plus-circle"></i>
                                            <span>Update</span>
                                        </button>
                                    @else
                                        <button type="submit" class="btn btn-success">
                                            <i class="fas fa-plus-circle"></i>
                                            <span>Create</span>
                                        </button>
                                    @endisset
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
        .create( document.querySelector( '#editor' ) )
        .then( editor => {
            console.log( editor );
        } )
        .catch( error => {
            console.error( error );
        } );
</script>


    <!-- init js -->
    <script src="{{ asset('backend/assets/js/pages/form-editor.init.js') }}"></script>
@endpush


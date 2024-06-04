@extends('layouts.backend.master')

@section('title',  isset($edit) ? 'Edit notepad' : 'Create New notepad')

@section('content')
    <div class="row">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">New Notepad</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">Dashboard</li>
                                <li class="breadcrumb-item">Notepad</li>
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
                            <h4 class="card-title mb-0 flex-grow-1">{{ isset($edit) ? 'Edit' : 'Create New' }}
                                Notepad</h4>
                            <div class="flex-shrink-0">
                                <div>
                                      @hasPermission('Notepad List')
                                    <a href="{{ route('admin.notepad.index') }}" class="btn btn-clr-red">
                                        <i class="ri-arrow-left-line align-bottom me-1"></i>
                                        Back to list
                                    </a>
                                    @endhasPermission
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form id="visa-form"
                                  action="{{ isset($edit) ? route('admin.notepad.update', $edit->id) : route('admin.notepad.store') }}"
                                  method="POST">
                                @csrf
                                @if (isset($edit))
                                    @method('PUT')
                                @endif
                                <div>
                                    <label for="title" class="form-label">Title *</label>
                                    <input type="text" id="title"
                                           class="form-control mb-3 @error('title') is-invalid @enderror"
                                           name="title" placeholder="title" value="{{ $edit->title ?? old('title') }}">

                                    @error('title')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>

                               <div class="">
                                    <label for="description" class="form-label">Notepad</label>
                                    <textarea name="description" class="ckeditor-classic" id="description">{{ $edit->description ?? old('description') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>

                            
                                <div class="mt-3">
                                    @isset($edit)
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


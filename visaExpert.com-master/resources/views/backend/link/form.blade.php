@extends('layouts.backend.master')

@section('title',  isset($edit) ? 'Edit Link' : 'Create New Link')

@section('content')
    <div class="row">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">New Link</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">Dashboard</li>
                                <li class="breadcrumb-item">Link</li>
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
                                Link</h4>
                            <div class="flex-shrink-0">
                                <div>
                                    <a href="{{ route('admin.link.index') }}" class="btn btn-clr-red">
                                        <i class="ri-arrow-left-line align-bottom me-1"></i>
                                        Back to list
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form id="visa-form"
                                  action="{{ isset($edit) ? route('admin.link.update', $edit->id) : route('admin.link.store') }}"
                                  method="POST">
                                @csrf
                                @if (isset($edit))
                                    @method('PUT')
                                @endif
                                <div>
                                    <label for="name" class="form-label">Name *</label>
                                    <input type="text" id="name"
                                           class="form-control mb-3 @error('name') is-invalid @enderror"
                                           name="name" placeholder="Govt" value="{{ $edit->name ?? old('name') }}">

                                    @error('name')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>

                               

                                <div>
                                    <label for="link" class="form-label">link *</label>
                                    <input type="text" id="link"
                                           class="form-control mb-3 @error('link') is-invalid @enderror"
                                           name="link" placeholder="https://bangladesh.gov.bd/index.php" value="{{ $edit->link ?? old('link') }}">

                                    @error('link')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>


                                 <div>
                                    <label for="color" class="form-label">Color *</label>
                                    <input type="text" id="color"
                                           class="form-control mb-3 @error('color') is-invalid @enderror"
                                           name="color" placeholder="097233" value="{{ $edit->color ?? old('color') }}">

                                    @error('color')
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


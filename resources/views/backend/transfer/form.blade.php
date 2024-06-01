@extends('layouts.backend.master')

@section('title', isset($edit) ? 'Edit Transfer' : 'Create New Transfer')

@section('content')

    <div class="row">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">New Transfer</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">Dashboard</li>
                                <li class="breadcrumb-item">Transfer</li>
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
                                Transfer</h4>
                            <div class="flex-shrink-0">
                                <div>
                                    <a href="{{ route('admin.transfer.index') }}" class="btn btn-clr-red">
                                        <i class="ri-arrow-left-line align-bottom me-1"></i>
                                        Back to list
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <form id="visa-form"
                                action="{{ isset($edit) ? route('admin.transfer.update', $edit->id) : route('admin.transfer.store') }}"
                                method="POST">
                                @csrf
                                @if (isset($edit))
                                    @method('PUT')
                                @endif

                                <!-- select user -->
                                <div>
                                    <label for="cart-total">Select transfer account</label>
                                    <select class="form-control" name="recive_id" id="recive_id" required>
                                        <option value="">Select please</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}"
                                                {{ isset($edit) && $edit->recive_id == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }} (Role:
                                                {{ $user->role ? $user->role->name : 'No Role' }})
                                            </option>
                                        @endforeach
                                    </select>

                                </div>
                                <!-- remark -->
                                <div>
                                    <label for="remark" class="form-label">Remark</label>
                                    <input required type="text" id="remark"
                                        class="form-control mb-3 @error('remark') is-invalid @enderror" name="remark"
                                        value="{{ $edit->remark ?? old('remark') }}">

                                    @error('name')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                                <!-- amount -->
                                <div>
                                    <label for="amount" class="form-label">Amount</label>
                                    <input required type="text" id="amount"
                                        class="form-control mb-3 @error('amount') is-invalid @enderror" name="amount"
                                        value="{{ $edit->amount ?? old('name') }}">

                                    @error('name')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                                {{-- note --}}
                                <div class="my-2">
                                    <label for="description" class="form-label">Note</label>
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

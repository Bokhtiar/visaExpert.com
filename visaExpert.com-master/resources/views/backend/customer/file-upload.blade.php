@use ('App\Enums\DocumentStatus', 'Status')
@extends('layouts.backend.master')

@section('title', 'View Customer')

@push('css')
    <!-- glightbox css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />
@endpush

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-xxl-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Visa Application Form</h4>
                    </div>
                    <div class="card-body">

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">SL</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Document</th>
                                    <th scope="col">View</th>
                                    <th scope="col">Upload</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            @foreach (json_decode($documents, true) as $file)
                                @php
                                    $exist = App\Models\VisaForm::exitDocument($file, $customer_form_id);
                                    
                                @endphp

                                @if ($exist)
                                    <form action="{{ route('admin.customers.single.document.update', $exist->id) }}"
                                        method="POST" enctype="multipart/form-data">
                                        @method('PUT')
                                    @else
                                        <form action="{{ route('admin.customers.single.document.store') }}" method="POST"
                                            enctype="multipart/form-data">
                                @endif

                                @csrf
                                <tr>
                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                    <td>
                                        {{ $exist ? $exist->title : $file }}
                                    </td>
                                    <td> {{ $exist ? $exist->documents : '' }}</td>

                                    @if ($exist)
                                        @if ($exist->document_type != 'pdf')
                                            <td>
                                                <a class="image-popup"
                                                    href="{{ asset('uploads/visa-forms/documents/' . $exist->documents) }}"
                                                    title="{{ $exist->title }}">
                                                    View
                                                </a>
                                            </td>
                                        @else
                                            <td>
                                                <a href="{{ asset('uploads/visa-forms/documents/' . $exist->documents) }}"
                                                    target="_blank">
                                                    View PDF
                                                </a>
                                            </td>
                                        @endif
                                    @else
                                        <td></td>
                                    @endif
                                    <td>
                                        <input type="file" name="doc" id="">
                                    </td>

                                    <input type="hidden" name="customer_form_id" value="{{ $customer_form_id }}"
                                        id="">
                                    <input type="hidden" name="customer_id" value="{{ $customer_id }}" id="">
                                    <input type="hidden" name="title" value="{{ $file }}" id="">
                                    <td>
                                        @if ($exist)
                                            <input type="submit" name="" class="btn btn-success" value="update"
                                                id="">
                                        @else
                                            <input type="submit" name="" class="btn btn-info" value="submit"
                                                id="">
                                        @endif
                                    </td>
                                </tr>

                                </form>
                            @endforeach
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

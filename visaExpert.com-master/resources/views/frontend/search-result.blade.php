@extends('layouts.frontend.master')

@section('title', 'Your Search Result')

@push('css')
    <!-- glightbox css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css"/>
@endpush

@section('content')
    <div class="vertical-overlay" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent.show"></div>
    <!-- start hero section -->
    <section class="section mt-5 pb-0">
        <div class="container-fluid mb-2 px-0 overflow-x-hidden">
            <div class="row">
                <div>
                    <img src="{{ asset('backend/assets/images/home-bg.jpg') }}" alt="homepage-banner"
                         class="img-fluid w-100 h-100 object-fit-cover">
                </div>
            </div>
        </div>

        <div class="bg-overlay bg-overlay-pattern"></div>
        <div class="container">
            <div class="row">
                <div class="col-xxl-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Visa Application Form</h4>
                            @forelse($forms as $key=>$form)
                                <div class="page-title-right">
                                    <p> <span class="">Visa Status:</span> <span class="fw-semibold">{{ $form->visa_status }}</span></p>
                                </div>
                            @empty
                            @endforelse
                        </div>
                        <div class="card-body">
                            <p class="text-muted mb-4">
                                All the data you have submitted for your application are displaying below.
                            </p>

                            @session('success')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ $value }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                            </div>
                            @endsession

                            @forelse($forms as $key=>$form)
                                <div class="row mb-3">
                                    <div class="col-lg-3">
                                        <label for="visa_type_id" class="col-form-label">Visa Type<span
                                                class="text-danger">*</span> :</label>
                                    </div>
                                    <div class="col-lg-9">
                                        <input type="text"
                                               class="form-control form-control-lg mb-3"
                                               value="{{ $form->visaType->title}}"
                                               readonly disabled
                                        >
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg-3">
                                        <label for="name" class="col-form-label">Name<span
                                                class="text-danger">*</span> :</label>
                                    </div>
                                    <div class="col-lg-9 custom-message">
                                        <input type="text"
                                               class="form-control form-control-lg mb-3"
                                               value="{{ $form->customer->name }}"
                                               readonly disabled
                                        >
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg-3">
                                        <label for="phone" class="col-form-label">Contact Number<span
                                                class="text-danger">*</span> :</label>
                                    </div>
                                    <div class="col-lg-9 custom-message">
                                        <input type="number"
                                               class="form-control form-control-lg mb-3"
                                               value="{{ $form->customer->phone }}"
                                               readonly disabled
                                        >
                                    </div>
                                </div>
                                <div class="row mt-5 mb-3">
                                    <div class="col-xxl-12">
                                        <div class="card">
                                            <div class="card-header align-items-center d-flex">
                                                <h4 class="card-title mb-0 flex-grow-1">Submitted Document
                                                    List</h4>
                                            </div>
                                            <div class="card-body">
                                                <p class="text-muted">
                                                    All the required documents are listed below. Please check this
                                                    out
                                                    before submitting
                                                    visa application form.
                                                </p>
                                                @if(count($form->documents) > 0)
                                                    <div>
                                                        <div class="row mb-3">
                                                            <div class="table-responsive">
                                                                <table
                                                                    class="table table-striped align-middle table-nowrap mb-0">
                                                                    <thead>
                                                                    <tr>
                                                                        <th scope="col">Type</th>
                                                                        <th scope="col">File</th>
                                                                        <th scope="col">Status</th>
                                                                        @php
                                                                            $showResubmitFileColumn = false;
                                                                            $resubmitFormDisplayed = false;
                                                                        @endphp
                                                                        @foreach($form->documents as $document)
                                                                            @if($document->status === \App\Enums\DocumentStatus::REJECTED->toString())
                                                                                @php
                                                                                    $showResubmitFileColumn = true;
                                                                                    break;
                                                                                @endphp
                                                                            @endif
                                                                        @endforeach
                                                                        @if($showResubmitFileColumn)
                                                                            <th scope="col" class="text-center">
                                                                                Resubmit File
                                                                            </th>
                                                                        @endif
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    @forelse($form->documents as $key => $document)
                                                                        <tr>
                                                                            <td>
                                                                                <input type="text" class="form-control"
                                                                                       placeholder="{{ $document->title }}"
                                                                                       readonly disabled>
                                                                            </td>
                                                                            @if($document->document_type != 'pdf')
                                                                                <td>
                                                                                    <a class="image-popup"
                                                                                       href="{{ asset('uploads/visa-forms/documents/' . $document->documents) }}"
                                                                                       title="{{ $document->title }}">
                                                                                        View
                                                                                    </a>
                                                                                </td>
                                                                            @else
                                                                                <td>
                                                                                    <a href="{{ asset('uploads/visa-forms/documents/' .$document->documents) }}"
                                                                                       target="_blank">
                                                                                        View
                                                                                    </a>
                                                                                </td>
                                                                            @endif
                                                                            <td>{{ $document->status ? $document->status : "In Review..." }}</td>
                                                                            @if($document->status === \App\Enums\DocumentStatus::REJECTED->toString() && !$resubmitFormDisplayed)
                                                                                <td>
                                                                                    <form id="resubmitForm"
                                                                                          action="{{ route('resubmit.form') }}"
                                                                                          method="post"
                                                                                          enctype="multipart/form-data">
                                                                                        @csrf
                                                                                        <input type="hidden"
                                                                                               name="document_id"
                                                                                               value="{{ $document->id }}">
                                                                                        <div class="input-group">
                                                                                            <input type="file"
                                                                                                   class="form-control"
                                                                                                   id="documents"
                                                                                                   name="resubmitted_document"
                                                                                                   aria-describedby="documents"
                                                                                                   aria-label="Upload"
                                                                                                   required>
                                                                                            <button
                                                                                                class="btn btn-clr-red"
                                                                                                type="submit"
                                                                                                id="documentsBtn">
                                                                                                Resubmit
                                                                                            </button>
                                                                                        </div>
                                                                                    </form>
                                                                                    @php
                                                                                        $resubmitFormDisplayed = true;
                                                                                    @endphp

                                                                                </td>
                                                                            @else
                                                                                <td></td>
                                                                            @endif
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
                                                @else
                                                    <strong>No documents found.</strong>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-5 mb-3">
                                    <div class="col-xxl-12">
                                        <div class="card">
                                            <div class="card-header align-items-center d-flex">
                                                <h4 class="card-title mb-0 flex-grow-1">
                                                    Application Status & Payments
                                                </h4>
                                            </div>
                                            <div class="card-body">
                                                <p class="text-muted">
                                                    In this section, you will find your application status and
                                                    payment,status
                                                </p>
                                                <div>
                                                    <div class="row mb-3">
                                                        <div class="table-responsive">
                                                            <table
                                                                class="table table-striped align-middle table-nowrap mb-0">
                                                                <thead>
                                                                <tr>
                                                                    <th scope="col">Application Status</th>
                                                                    <th scope="col">Total Amount (BDT)</th>
                                                                    <th scope="col">Invoice</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <tr>
                                                                    <td>
                                                                        {{ $form->visa_status }}
                                                                    </td>
                                                                    <td>
                                                                        {{ isset($form->customer->invoices) && count($form->customer->invoices) > 0 ? number_format($form->customer->invoices->sum('total_amount')) : "-" }}
                                                                    </td>
                                                                    <td>
                                                                        @if($form->invoice)
                                                                            <a href="{{ route('my-invoice.view', ['encodedInvoice' => base64_encode($form->invoice->id)]) }}"
                                                                               class="btn btn-clr-red waves-effect waves-light">
                                                                                <i class="ri-eye-2-line align-bottom me-1"></i>
                                                                                View
                                                                            </a>
                                                                        @else
                                                                            No Invoice found.
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <h2>Result Found.</h2>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
    <!-- glightbox js -->
    <script src="{{ asset('backend/assets/libs/glightbox/js/glightbox.min.js') }}"></script>

    <script src="{{ asset('backend/assets/js/pages/gallery.init.js') }}"></script>
@endpush

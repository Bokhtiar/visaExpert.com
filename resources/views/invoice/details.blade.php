@extends('layouts.backend.master')

@section('title', 'Invoice Details')

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Invoice Details</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Invoices</a></li>
                        <li class="breadcrumb-item active">Invoice Details</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row justify-content-center">
        <div class="col-xxl-9">
            <div class="card" id="demo">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-header border-bottom-dashed p-4">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <h4 style="user-select: none;">{{ config('app.name') }}</h4>
                                    <div class="mt-sm-5 mt-4">
                                        <h6 class="text-muted text-uppercase fw-semibold">Address</h6>
                                        <p class="text-muted mb-1"
                                           id="address-details">Office Address</p>
                                    </div>
                                </div>
                                <div class="flex-shrink-0 mt-sm-0 mt-3">
                                    <h6><span class="text-muted fw-normal">Email:</span><span
                                                id="email">email@email.com</span>
                                    </h6>
                                    <h6><span class="text-muted fw-normal">Website:</span> <a
                                                href="{{ config('app.url') }}" class="link-primary"
                                                target="_blank" id="website">{{ config('app.name') }}</a></h6>
                                    <h6 class="mb-0"><span
                                                class="text-muted fw-normal">Contact No: </span><span
                                                id="contact-no">12345678</span></h6>
                                </div>
                            </div>
                        </div>
                        <!--end card-header-->
                    </div><!--end col-->
                    <div class="col-lg-12">
                        <div class="card-body p-4">
                            <div class="row g-3">
                                <div class="col-lg-3 col-6">
                                    <p class="text-muted mb-2 text-uppercase fw-semibold">Invoice No</p>
                                    <h5 class="fs-14 mb-0"><span
                                                id="invoice-no">{{ $form->invoice->invoice_number }}</span></h5>
                                </div>
                                <!--end col-->
                                <div class="col-lg-3 col-6">
                                    <p class="text-muted mb-2 text-uppercase fw-semibold">Date</p>
                                    <h5 class="fs-14 mb-0"><span
                                                id="invoice-date">{{ $form->created_at->format('d M Y') }}</span>
                                        <small class="text-muted"
                                               id="invoice-time">{{ $form->created_at->format('g:i A') }}</small></h5>
                                </div>
                                <!--end col-->
                                <div class="col-lg-3 col-6">
                                    <p class="text-muted mb-2 text-uppercase fw-semibold">Payment Status</p>
                                    <span class="badge bg-success-subtle text-success fs-11"
                                          id="payment-status">{!! displayPaymentStatusBadge($form->payment_status) !!}</span>
                                </div>
                                <!--end col-->
                                <div class="col-lg-3 col-6">
                                    <p class="text-muted mb-2 text-uppercase fw-semibold">Total Amount (BDT)</p>
                                    <h5 class="fs-14 mb-0">
                                        {{--@if($form->service)
                                            {{ $form->invoice->amount }}
                                        @else
                                            @if($form->user->user_type == 'agent')
                                                {{ $form->service->agent_amount }}
                                            @else
                                                {{ $form->service->customer_amount }}
                                            @endif
                                        @endif--}}
                                        00
                                    </h5>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </div>
                        <!--end card-body-->
                    </div><!--end col-->
                    <div class="col-lg-12">
                        <div class="card-body p-4 border-top border-top-dashed">
                            <div class="row g-3">
                                <div class="col-12">
                                    <h6 class="text-muted text-uppercase fw-semibold mb-3">Customer
                                        Address</h6>
                                    <p class="fw-medium mb-2" id="billing-name">{{ $form->customer->name }}</p>
                                    <p class="text-muted mb-1">Phone: <span
                                                id="billing-phone-no">{{ $form->customer->phone }}</span></p>
                                </div>
                            </div>
                            <!--end row-->
                        </div>
                        <!--end card-body-->
                    </div><!--end col-->
                    <div class="col-lg-12">
                        <div class="card-body p-4">
                            <div class="table-responsive">
                                <table
                                        class="table table-borderless text-center table-nowrap align-middle mb-0">
                                    <thead>
                                    <tr class="table-active">
                                        <th scope="col" style="width: 50px;">#</th>
                                        <th scope="col">Details</th>
                                        <th scope="col" class="text-end">Amount (BDT)</th>
                                    </tr>
                                    </thead>
                                    <tbody id="products-list">
                                    <tr>
                                        <th scope="row">01</th>
                                        <td class="text-center">
                                            <span class="fw-medium">Visa Application Form</span>
                                        </td>
                                        <td class="text-end">
                                            {{--@if($form->service)
                                                {{ $form->invoice->amount }}
                                            @else
                                                @if($form->user->user_type == 'agent')
                                                    {{ $form->service->agent_amount }}
                                                @else
                                                    {{ $form->service->customer_amount }}
                                                @endif
                                            @endif--}}
                                            00
                                        </td>
                                    </tr>
                                    </tbody>
                                </table><!--end table-->
                            </div>
                            <div class="border-top border-top-dashed mt-2">
                                <table class="table table-borderless table-nowrap align-middle mb-0 ms-auto"
                                       style="width:250px">
                                    <tbody>

                                    <tr class="border-top border-top-dashed fs-15">
                                        <th scope="row">Total Amount (BDT)</th>
                                        <th class="text-end">
                                            {{--@if($form->service)
                                                {{ $form->invoice->amount }}
                                            @else
                                                @if($form->user->user_type == 'agent')
                                                    {{ $form->service->agent_amount }}
                                                @else
                                                    {{ $form->service->customer_amount }}
                                                @endif
                                            @endif--}}
                                            00
                                        </th>
                                    </tr>
                                    </tbody>
                                </table>
                                <!--end table-->
                            </div>
                            <div class="hstack gap-2 justify-content-end d-print-none mt-4">
                                <a href="javascript:window.print()" class="btn btn-soft-primary"><i
                                            class="ri-printer-line align-bottom me-1"></i> Print</a>
                                <a href="{{ route('admin.visa-forms.invoiceDownload', $form->id) }}"
                                   class="btn btn-primary"><i
                                            class="ri-download-2-line align-bottom me-1"></i> Download
                                </a>
                            </div>
                        </div>
                        <!--end card-body-->
                    </div><!--end col-->
                </div><!--end row-->
            </div>
            <!--end card-->
        </div>
        <!--end col-->
    </div>
    <!--end row-->

@endsection

@push('js')
    <script src="{{asset('backend/assets/js/pages/invoicedetails.js')}}"></script>
@endpush

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="An Admin Dashboard for your applications">
    <meta name="author" content="Fahad Ahmed Chowdhury">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Invoice | {{ config('app.name') }}</title>
    <link rel="shortcut icon" href="{{ asset('backend/assets/images/favicon.ico') }}">
    <!-- Bootstrap Css -->
    <link href="{{ asset('backend/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <!-- backend Css-->
    <link href="{{ asset('backend/assets/css/app.min.css') }}" rel="stylesheet" type="text/css">
    <!-- custom Css-->
    <link href="{{ asset('backend/assets/css/custom.min.css') }}" rel="stylesheet" type="text/css">
</head>
<body>
<div id="layout-wrapper">
    <div class="vertical-overlay"></div>
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
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
                                                       id="address-details">{{ $contact->office_address }}</p>
                                                </div>
                                            </div>
                                            <div class="flex-shrink-0 mt-sm-0 mt-3">
                                                <h6><span class="text-muted fw-normal">Email:</span><span
                                                        id="email">{{ $contact->office_email }}</span>
                                                </h6>
                                                <h6><span class="text-muted fw-normal">Website:</span> <a
                                                        href="{{ config('app.url') }}" class="link-primary"
                                                        target="_blank" id="website">{{ config('app.name') }}</a>
                                                </h6>
                                                <h6 class="mb-0"><span
                                                        class="text-muted fw-normal">Contact No: </span><span
                                                        id="contact-no">{{ $contact->office_phone }}</span></h6>
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
                                                        id="invoice-no">{{ $form->invoice->invoice_number }}</span>
                                                </h5>
                                            </div>
                                            <!--end col-->
                                            <div class="col-lg-3 col-6">
                                                <p class="text-muted mb-2 text-uppercase fw-semibold">Date</p>
                                                <h5 class="fs-14 mb-0"><span
                                                        id="invoice-date">{{ $form->created_at->format('d M Y') }}</span>
                                                    <small class="text-muted"
                                                           id="invoice-time">{{ $form->created_at->format('g:i A') }}</small>
                                                </h5>
                                            </div>
                                            <!--end col-->
                                            <div class="col-lg-3 col-6">
                                                <p class="text-muted mb-2 text-uppercase fw-semibold">Payment Status</p>
                                                <span class="badge bg-success-subtle text-success fs-11"
                                                      id="payment-status">{!! displayPaymentStatusBadge($form->payment_status) !!}</span>
                                            </div>
                                            <!--end col-->
                                            <div class="col-lg-3 col-6">
                                                <p class="text-muted mb-2 text-uppercase fw-semibold">Total Amount
                                                    (BDT)</p>
                                                <h5 class="fs-14 mb-0">
                                                    @if($form->user->user_type == 'agent')
                                                        {{ $form->service->agent_amount }}
                                                    @else
                                                        {{ $form->service->customer_amount }}
                                                    @endif
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
                                                <p class="fw-medium mb-2" id="billing-name">{{ $form->user->name }}</p>
                                                <p class="text-muted mb-1"
                                                   id="billing-address-line-1">{{ $form->user->address }}</p>
                                                <p class="text-muted mb-1">Phone: <span
                                                        id="billing-phone-no">{{ $form->user->phone }}</span></p>
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
                                                        @if($form->user->user_type == 'agent')
                                                            {{ $form->service->agent_amount }}
                                                        @else
                                                            {{ $form->service->customer_amount }}
                                                        @endif
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
                                                        @if($form->user->user_type == 'agent')
                                                            {{ $form->service->agent_amount }}
                                                        @else
                                                            {{ $form->service->customer_amount }}
                                                        @endif
                                                    </th>
                                                </tr>
                                                </tbody>
                                            </table>
                                            <!--end table-->
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
            </div>
        </div>
    </div>
</div>

<!-- JAVASCRIPT -->
<script src="{{ asset('backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- backend js -->
<script src="{{ asset('backend/assets/js/app.js')}}"></script>

</body>
</html>

@extends('layouts.frontend.master')

@section('title', 'Invoice Details')

@section('content')

    <div class="container" style="margin-top: 140px">
        <div class="col-xxl-12">
            <div class="card">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-header border-bottom-dashed p-4">
                            <div class="row">
                                {{-- logo --}}
                                <div class="col-md-2 col-lg-2 col-sm-2">
                                    <img src="{{ asset('backend/assets/images/logo.jpg') }}" alt="Logo" height="96px"
                                        width="96">
                                    <h5 style="font-size: 16px;">{{ config('app.name') }}</h5>
                                </div>
                                {{-- card --}}
                                <div class="col-md-6 col-lg-6 col-sm-6">
                                    <img src="{{ asset('backend/assets/images/visiting-card.jpg') }}" alt="Visiting Card"
                                        class="" height="180px" width="100%">
                                </div>
                                {{-- contact --}}
                                <div class="col-md-4 col-lg-4 col-sm-4 my-auto">
                                    <p class="m-0" style="font-weight: 600; font-size: 20px">Visa Expert</p>
                                    <p class="m-0" style="font-weight: 600">Rahim Tower.Subhanighat, sylhet-3100,
                                        Bangladesh</p>
                                    <p class="m-0" style="font-weight: 600">Emial: helpline@visaxpert.net</p>
                                    <p class="m-0" style="font-weight: 600">Helpline: 09617447744</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card-body p-4">
                            {{-- content --}}
                            <div style="font-size: 14px; line-height: 16px; margin-bottom: 12px">
                                Dear {{ $customers[0]->name }}, <br />
                                Thank you fo choosing Visa Expert. Your invoice has been confirmed on
                                {{ $invoice->created_at->format('D, jS M Y - H:i') }}.
                                Your Booking ID/User ID #{{ $customers[0]->id }}, & Payment status Paid as the payable
                                amount {{ $invoice->total_amount - $invoice->discount }}(BDT)
                            </div>
                            {{-- table --}}
                            <div class="row g-3 mt-2">
                                <div>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col">USER ID</th>
                                                <th scope="col">CUSTOMER NAME</th>
                                                <th scope="col">CUSTOMER PHONE</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($customers as $item)
                                                <tr>
                                                    <td>{{ $item->id }}</td>
                                                    <td>{{ $item->name }}</td>
                                                    <td>{{ $item->phone }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                {{--                                <div class="col-lg-3 col-6"> --}}
                                {{--                                    <p class="text-muted mb-2 text-uppercase fw-semibold">Date</p> --}}
                                {{--                                    <h5 class="fs-14 mb-0"><span --}}
                                {{--                                            id="invoice-date">{{ $invoice->created_at->format('d M Y') }}</span> --}}
                                {{--                                        <small class="text-muted" --}}
                                {{--                                               id="invoice-time">{{ $invoice->created_at->format('g:i A') }}</small> --}}
                                {{--                                    </h5> --}}
                                {{--                                </div> --}}
                                {{--                                <div class="col-lg-3 col-6"> --}}
                                {{--                                    <p class="text-muted mb-2 text-uppercase fw-semibold">Payment Status</p> --}}
                                {{--                                    <span id="payment-status">{{ $invoice->status }}</span> --}}
                                {{--                                </div> --}}
                                {{--                                <div class="col-lg-3 col-6"> --}}
                                {{--                                    <p class="text-muted mb-2 text-uppercase fw-semibold">Total Amount (BDT)</p> --}}
                                {{--                                    <h5 class="fs-14 mb-0"> --}}
                                {{--                                        {{ $invoice->total_amount }} --}}
                                {{--                                    </h5> --}}
                                {{--                                </div> --}}
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-lg-12">
                        <div class="card-body p-4 border-top border-top-dashed">
                            <div class="row g-3">
                                <div class="col-12">
                                    <h6 class="text-muted text-uppercase fw-semibold mb-3">Customer
                                        Address</h6>
                                    <p class="fw-medium mb-2" id="billing-name">{{ $invoice->customer->name }}</p>
                                    <p class="text-muted mb-1">Phone: <span
                                            id="billing-phone-no">{{ $invoice->customer->phone }}</span></p>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <div class="col-lg-12">
                        <div class="card-body p-4">
                            <div class="table-responsive">
                                <table class="table table-borderless text-center table-nowrap align-middle mb-0">
                                    <thead>
                                        <tr class="table-active">
                                            <th scope="col">#SL</th>
                                            <th scope="col">Details</th>
                                            <th scope="col">Qty</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Amount (BDT)</th>
                                        </tr>
                                    </thead>
                                    <tbody id="products-list">
                                        @foreach ($invoice->items as $key => $invoiceItem)
                                            <tr>
                                                <th scope="">{{ $key + 1 }}</th>
                                                <td class="">

                                                    {{ $invoiceItem->item }}

                                                </td>
                                                <td>
                                                    {{ $invoiceItem->qty }}
                                                </td>

                                                <td>{{ $invoiceItem->qty . 'X' . $invoiceItem->amount / $invoiceItem->qty }}
                                                </td>

                                                <td>
                                                    {{ $invoiceItem->amount }}
                                                </td>
                                            </tr>
                                        @endforeach


                                    </tbody>
                                </table>
                            </div>


                            <style>
                                .container1 {
                                    width: 100%;
                                    overflow: hidden;
                                    /* Clearfix to contain floated elements */
                                }

                                .left {
                                    float: left;
                                    width: 60%;
                                }

                                .right {
                                    float: right;
                                    width: 40%;
                                    text-align: end
                                }
                            </style>

                            <div class="container1">
                                <div class="left">

                                </div>

                                <div class="right text-end">
                                    <p class="d-flex justify-content-between" style="margin-bottom: 0px;">
                                        <strong style="font-size: 16px;margin-right: 30px"> Total Amount (BDT) </strong>
                                        <strong style="font-size: 16px">{{ $invoice->total_amount }}</strong>
                                    </p>

                                    <p class="d-flex justify-content-between" style="margin-bottom: 0px;">
                                        <strong style="font-size: 16px;margin-right: 36px"> Discount(
                                            {{ number_format(($invoice->discount / $invoice->total_amount) * 100, 0) }}%)
                                        </strong>
                                        <strong style="font-size: 16px">{{ $invoice->discount }}
                                        </strong>
                                    </p>

                                    <p class="d-flex justify-content-between" style="margin-bottom: 0px;">
                                        <strong style="font-size: 16px;margin-right: 30px"> Payable </strong>
                                        <strong
                                            style="font-size: 16px">{{ $invoice->total_amount - $invoice->discount }}</strong>
                                    </p>

                                    <p class="d-flex justify-content-between" style="margin-bottom: 0px;">
                                        <strong style="font-size: 16px;margin-right: 30px"> Received </strong>
                                        <strong style="font-size: 16px">
                                            {{ App\Models\PaymentLog::where('invoice_id', $invoice->id)->sum('pay') }}
                                        </strong>
                                    </p>

                                    {{-- <p class="d-flex justify-content-between" style="margin-bottom: 0px;">
                                        <strong style="font-size: 16px;margin-right: 36px"> Discount Amount </strong>
                                        <strong
                                            style="font-size: 16px">{{ $invoice->discount }}
                                            </strong>
                                    </p> --}}










                                    <p class="d-flex justify-content-between" style="margin-bottom: 0px;">
                                        <strong style="font-size: 16px;margin-right: 30px"> Due </strong>
                                        <strong style="font-size: 16px">
                                            @php
                                                $totalDue =
                                                    $invoice->total_amount -
                                                    App\Models\PaymentLog::where('invoice_id', $invoice->id)->sum(
                                                        'pay',
                                                    );
                                            @endphp
                                            {{ $totalDue - $invoice->discount }}
                                        </strong>
                                    </p>

                                    {{-- <p class="d-flex justify-content-between" style="margin-bottom: 0px;">
                                        <strong style="font-size: 16px;margin-right: 30px"> Total Amount (BDT) </strong>
                                        <strong
                                            style="font-size: 16px">{{ $invoice->total_amount - $invoice->discount }}</strong>
                                    </p> --}}

                                </div>
                            </div>












                            <p class="" style="font-size: 11px; line-height: 10px; margin-top: 15px">
                                <Strong> Note:</Strong> Customer must check the file/task before receiving because after
                                delivery the task
                                authority will not take any responsibility and risk. The invoice will be valueless after 3
                                days from the
                                issuing date and customer must collect the work before expiry the invoice.
                            </p>

                            @hasPermission('Download Invoice')
                                @can(\App\Permissions::DOWNLOAD_CUSTOMER_INVOICE)
                                    <div class="hstack gap-2 justify-content-end d-print-none mt-4">
                                        <a href="javascript:window.print()" class="btn btn-soft-primary"><i
                                                class="ri-printer-line align-bottom me-1"></i> Print</a>
                                        <a href="{{ route('admin.customers-invoices.download', $invoice->id) }}"
                                            class="btn btn-primary"><i class="ri-download-2-line align-bottom me-1"></i> Download
                                        </a>
                                    </div>
                                @endcan
                            @endhasPermission
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('backend/assets/js/pages/invoicedetails.js') }}"></script>
@endpush

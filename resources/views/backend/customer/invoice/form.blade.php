@extends('layouts.backend.master')

@section('title', isset($invoice) ? 'Edit Invoice' : 'Create Invoice')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">{{ isset($invoice) ? 'Edit Invoice' : 'Create Invoice' }}</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Invoices</a></li>
                        <li class="breadcrumb-item active">{{ isset($invoice) ? 'Edit Invoice' : 'Create Invoice' }}</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-xxl-9">
            <div class="card">
                <form
                    action="{{ isset($invoice) ? route('admin.customers-invoices.update', $invoice->id) : route('admin.customers-invoices.store') }}"
                    class="needs-validation" novalidate id="invoice_form" method="POST">
                    @if (isset($invoice))
                        @method('PATCH')
                    @endif
                    @csrf
                    <div class="card-body border-bottom border-bottom-dashed p-4">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="profile-user mx-auto mb-3">
                                    <h4 class="overflow-hidden border border-dashed d-flex align-items-center justify-content-start rounded"
                                        style="height: 60px; width: 256px;">
                                        <span>{{ config('app.name') }}</span>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-3">
                            <input type="hidden" name="form_id"
                                value="{{ isset($invoice) ? $invoice->customer->forms[0]->id : $customer->forms[0]->id }}">
                            <input type="hidden" name="customer_id"
                                value="{{ isset($invoice) ? $invoice->customer->id : $customer->id }}">
                            <div class="col-lg-3 col-sm-6">
                                <label for="invoicenoInput">User ID</label>
                                <input type="text" class="form-control bg-light border-0" id="invoicenoInput"
                                    value="#{{ isset($invoice) ? $invoice->customer->unique_id : $customer->unique_id }}"
                                    readonly="readonly" />
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div>
                                    <label for="date-field">Date</label>
                                    <input type="date" min="{{ date('Y-m-d') }}" class="form-control bg-light border-0"
                                        id="date-field" value="{{ date('Y-m-d') }}" data-provider="flatpickr"
                                        data-time="true" readonly disabled>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <label for="choices-payment-status">Payment Status</label>
                                <div class="input-light">
                                    @isset($invoice)
                                        <select class="form-control bg-light border-0 @error('status') is-invalid @enderror"
                                            name="status" id="choices-payment-status" required="">
                                            @foreach ($paymentStatus as $status)
                                                <option value="{{ $status }}"
                                                    {{ $invoice->status == $status ? 'selected' : '' }}>
                                                    {{ $status }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    @else
                                        <select class="form-control bg-light border-0 @error('status') is-invalid @enderror"
                                            name="status" id="choices-payment-status" required="">
                                            <option selected disabled>Select Payment Status</option>
                                            @foreach ($paymentStatus as $status)
                                                <option value="{{ $status }}">{{ $status }}</option>
                                            @endforeach
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    @endisset
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div>
                                    <label for="cart-total">Total Amount</label>
                                    @isset($invoice)
                                        <input type="text" name="amount" class="form-control bg-light border-0"
                                            value="{{ $invoice->total_amount }}" readonly="readonly" />
                                    @else
                                        <input type="text" name="amount" id="invoice-total"
                                            class="form-control bg-light border-0" placeholder="0.00" readonly="readonly" />
                                    @endisset
                                </div>
                            </div>

                            <div class="col-lg-3 col-sm-6">
                                <div>
                                    <label for="cart-total">By Road</label>
                                    @isset($invoice)
                                        <select class="form-control" name="road_id" id="">
                                            @foreach ($roads as $road)
                                                <option value="{{ $road->id }}"
                                                    {{ $road->id == $invoice->road_id ? 'selected' : '' }}>{{ $road->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    @else
                                        <select class="form-control" name="road_id" id="">
                                            <option value="">Select by road</option>
                                            @foreach ($roads as $road)
                                                <option value="{{ $road->id }}">{{ $road->name }}</option>
                                            @endforeach
                                        </select>
                                    @endisset
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-4 border-top border-top-dashed">
                        <div class="row">
                            <div class="col-lg-4 col-sm-6">
                                <div>
                                    <label for="billingName" class="text-muted text-uppercase fw-semibold">Customer
                                        Address</label>
                                </div>
                                <div class="mb-2">
                                    <input type="text" class="form-control bg-light border-0" id="billingName"
                                        value="{{ isset($invoice) ? $invoice->customer->name : $customer->name }}"
                                        readonly="readonly">
                                </div>
                                <div class="mb-2">
                                    <input type="text" class="form-control bg-light border-0" data-plugin="cleave-phone"
                                        id="billingPhoneno"
                                        value="{{ isset($invoice) ? $invoice->customer->phone : $customer->phone }}"
                                        readonly="readonly">
                                    <div class="invalid-feedback">
                                        Please enter a phone number
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- {{ dd('test s  d') }} --}}
                    @isset($invoice)
                        <div class="card-body p-4">
                            <div class="table-responsive">
                                <table class="table table-borderless text-center table-nowrap align-middle mb-0">
                                    <thead>
                                        <tr class="table-active">
                                            <th scope="col" style="width: 50px;">#</th>
                                            <th scope="col">Details</th>
                                            <th scope="col" class="text-end">Amount (BDT)</th>
                                        </tr>
                                    </thead>
                                    <tbody id="products-list">
                                        @foreach ($invoice->items as $key => $invoiceItem)
                                            <tr>
                                                <th scope="row">{{ $key + 1 }}</th>
                                                <td class="text-center">
                                                    <span class="fw-medium">
                                                        {{ $invoiceItem->item }}
                                                    </span>
                                                </td>
                                                <td class="text-end">
                                                    {{ $invoiceItem->amount }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="border-top border-top-dashed mt-2">
                                <table class="table table-borderless table-nowrap align-middle mb-0 ms-auto"
                                    style="width:550px">
                                    <tbody>
                                        {{-- <tr class="border-top border-top-dashed fs-15">
                                            <th scope="row">Total Amount (BDT)</th>
                                            <th class="text-end">
                                                {{ $invoice->total_amount }}
                                            </th>
                                        </tr> --}}

                                        <tr class="border-top border-top-dashed mt-2">
                                            <td colspan="2" class="text-end">
                                                <h6>Total Amount (BDT) :</h6>
                                            </td>
                                            <td colspan="3" class="p-0">
                                                <table class="table table-borderless table-sm table-nowrap align-middle mb-0">
                                                    <tbody>
                                                        <tr class="border-top border-top-dashed">
                                                            <th scope="row"></th>
                                                            <td>
                                                                {{ $invoice->total_amount }}
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>





                                        {{-- new added --}}
                                        {{-- percentage --}}
                                        @php
                                            $total_pay = 0;
                                        @endphp
                                        @foreach ($payables as $pay)
                                            {{-- {{ dd($pay->pay) }} --}}
                                            @php
                                                $total_pay += $pay->pay;
                                            @endphp
                                            <tr class="border-top border-top-dashed mt-2">
                                                <td colspan="2" class="text-end">
                                                    <h6>Pay {{ $loop->index + 1 }} ({{ $pay->created_at->format('Y-m-d') }})
                                                    </h6>
                                                </td>
                                                <td colspan="3" class="p-0">
                                                    <table
                                                        class="table table-borderless table-sm table-nowrap align-middle mb-0">
                                                        <tbody>
                                                            <tr class="border-top border-top-dashed">
                                                                <th scope="row"></th>
                                                                <td>

                                                                    <input type="number" name=""
                                                                        value="{{ $pay->pay }}"
                                                                        class="form-control bg-light border-0" placeholder="0"
                                                                        readonly />
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        @endforeach

                                        <tr class="border-top border-top-dashed mt-2">
                                            <td colspan="2" class="text-end">
                                                <h6>Total Paid:</h6>
                                            </td>
                                            <td colspan="3" class="p-0">
                                                <table class="table table-borderless table-sm table-nowrap align-middle mb-0">
                                                    <tbody>
                                                        <tr class="border-top border-top-dashed">
                                                            <th scope="row"></th>
                                                            <td>
                                                                <input type="number" name=""
                                                                    value="{{ $total_pay }}"
                                                                    class="form-control bg-light border-0" placeholder="0"
                                                                    readonly />
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>

                                        {{-- percentage --}}
                                        <tr class="border-top border-top-dashed mt-2">
                                            <td colspan="2" class="text-end">
                                                <h6>Discount (%) :</h6>
                                            </td>
                                            <td colspan="3" class="p-0">
                                                <table class="table table-borderless table-sm table-nowrap align-middle mb-0">
                                                    <tbody>
                                                        <tr class="border-top border-top-dashed">
                                                            <th scope="row"></th>
                                                            <td>
                                                                <input type="number" name="discount"
                                                                    class="form-control bg-light border-0" id="cart-total"
                                                                    placeholder="0" />
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>






                                        <tr class="border-top border-top-dashed mt-2">
                                            <td colspan="2" class="text-end">
                                                <h6>Received:</h6>
                                            </td>
                                            <td colspan="3" class="p-0">
                                                <table class="table table-borderless table-sm table-nowrap align-middle mb-0">
                                                    <tbody>
                                                        <tr class="border-top border-top-dashed">
                                                            <th scope="row"></th>
                                                            <td>
                                                                <input type="number" name="pay"
                                                                    class="form-control bg-light border-0"
                                                                    id="receive_payment" placeholder="0" />
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>

                                        <tr class="border-top border-top-dashed mt-2">
                                            <td colspan="2" class="text-end">
                                                <h6>Due:</h6>
                                            </td>
                                            <td colspan="3" class="p-0">
                                                <table class="table table-borderless table-sm table-nowrap align-middle mb-0">
                                                    <tbody>
                                                        <tr class="border-top border-top-dashed">
                                                            <th scope="row"></th>
                                                            <td>
                                                                <input type="number" name="due" id="due_amount"
                                                                    value="{{ $invoice->total_amount - $total_pay }}"
                                                                    class="form-control bg-light border-0" placeholder="0" />
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                            <div class="hstack gap-2 justify-content-end d-print-none mt-4">
                                <button type="submit" class="btn btn-success"><i
                                        class="ri-file-add-line align-bottom me-1"></i> Update
                                </button>
                            </div>
                        </div>
                    @else
                        <div class="card-body p-4">
                            <div class="table-responsive">
                                <table class="invoice-table table table-borderless table-nowrap mb-0">
                                    <thead class="align-middle">
                                        <tr class="table-active">
                                            <th scope="col" style="width: 50px;">#</th>
                                            <th scope="col">
                                                Details
                                            </th>
                                            <th scope="col" class="text-end" style="width: 150px;">Amount (BDT)</th>
                                            <th scope="col" class="text-end" style="width: 105px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="newlink">
                                        <tr id="1" class="product">
                                            <th scope="row" class="product-id">1</th>
                                            <td>
                                                <div class="input-light">
                                                    <select class="form-control bg-light border-0" name="items[]"
                                                        id="serviceDropdown" required="">
                                                        <option selected disabled>Select a Service type</option>
                                                        @foreach ($services as $service)
                                                            <option value="{{ $service->title }}"
                                                                @if (old($service->title) == $service->title) selected @endif
                                                                data-amount="{{ auth()->user()->role->name == 'agent' ? $service->agent_amount : $service->customer_amount }}">
                                                                {{ $service->title }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </td>
                                            <td class="text-end">
                                                <div>
                                                    <input type="text" name="amount[]"
                                                        class="form-control bg-light border-0 product-line-price"
                                                        id="totalamountInput" placeholder="0.00">
                                                </div>
                                            </td>
                                            <td class="product-removal">
                                                <a href="javascript:void(0)" class="btn btn-danger"
                                                    disabled="disabled">Delete</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tbody>
                                        <tr id="newForm" style="display: none;">
                                            <td class="d-none" colspan="5">
                                                <p>Add New Form</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="5">
                                                <a href="javascript:new_link()" id="add-item"
                                                    class="btn btn-soft-secondary fw-medium"><i
                                                        class="ri-add-fill me-1 align-bottom"></i> Add Item</a>
                                            </td>
                                        </tr>
                                        <tr class="border-top border-top-dashed mt-2">
                                            <td colspan="2" class="text-end">
                                                <h6>Total Amount :</h6>
                                            </td>
                                            <td colspan="3" class="p-0">
                                                <table class="table table-borderless table-sm table-nowrap align-middle mb-0">
                                                    <tbody>
                                                        <tr class="border-top border-top-dashed">
                                                            <th scope="row"></th>
                                                            <td>
                                                                <input type="text" name="total_amount"
                                                                    class="form-control bg-light border-0" id="cart-total"
                                                                    placeholder="0.00" readonly />
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>



                                        {{-- percentage --}}
                                        @php
                                            $total_pay = 0;
                                        @endphp
                                        @foreach ($payables as $pay)
                                            @php
                                                $total_pay += $pay->pay;
                                            @endphp
                                            <tr class="border-top border-top-dashed mt-2">
                                                <td colspan="2" class="text-end">
                                                    <h6>Pay {{ $loop->index + 1 }} ({{ $pay->created_at->format('Y-m-d') }})
                                                    </h6>
                                                </td>
                                                <td colspan="3" class="p-0">
                                                    <table
                                                        class="table table-borderless table-sm table-nowrap align-middle mb-0">
                                                        <tbody>
                                                            <tr class="border-top border-top-dashed">
                                                                <th scope="row"></th>
                                                                <td>
                                                                    <input type="number" name=""
                                                                        value="{{ $pay->pay }}"
                                                                        class="form-control bg-light border-0" id="cart-total"
                                                                        placeholder="0" readonly />
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        @endforeach

                                        <tr class="border-top border-top-dashed mt-2">
                                            <td colspan="2" class="text-end">
                                                <h6>Total Paid:</h6>
                                            </td>
                                            <td colspan="3" class="p-0">
                                                <table class="table table-borderless table-sm table-nowrap align-middle mb-0">
                                                    <tbody>
                                                        <tr class="border-top border-top-dashed">
                                                            <th scope="row"></th>
                                                            <td>
                                                                <input type="number" name=""
                                                                    value="{{ $total_pay }}"
                                                                    class="form-control bg-light border-0" id="cart-total"
                                                                    placeholder="0" readonly />
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>

                                        {{-- percentage --}}
                                        <tr class="border-top border-top-dashed mt-2">
                                            <td colspan="2" class="text-end">
                                                <h6>Discount (%) :</h6>
                                            </td>
                                            <td colspan="3" class="p-0">
                                                <table class="table table-borderless table-sm table-nowrap align-middle mb-0">
                                                    <tbody>
                                                        <tr class="border-top border-top-dashed">
                                                            <th scope="row"></th>
                                                            <td>
                                                                <input type="number" name="discount"
                                                                    class="form-control bg-light border-0" id=""
                                                                    placeholder="0" />
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>






                                        <tr class="border-top border-top-dashed mt-2">
                                            <td colspan="2" class="text-end">
                                                <h6>Received:</h6>
                                            </td>
                                            <td colspan="3" class="p-0">
                                                <table class="table table-borderless table-sm table-nowrap align-middle mb-0">
                                                    <tbody>
                                                        <tr class="border-top border-top-dashed">
                                                            <th scope="row"></th>
                                                            <td>
                                                                <input type="number" name="pay"
                                                                    class="form-control bg-light border-0"
                                                                    id="receive_payment_save" placeholder="0" />
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>

                                        <tr class="border-top border-top-dashed mt-2">
                                            <td colspan="2" class="text-end">
                                                <h6>Due:</h6>
                                            </td>
                                            <td colspan="3" class="p-0">
                                                <table class="table table-borderless table-sm table-nowrap align-middle mb-0">
                                                    <tbody>
                                                        <tr class="border-top border-top-dashed">
                                                            <th scope="row"></th>
                                                            <td>
                                                                <input type="number" name="due"
                                                                    class="form-control bg-light border-0"
                                                                    id="due_amount_save" placeholder="0" />

                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                            <div class="hstack gap-2 justify-content-end d-print-none mt-4">
                                <button type="submit" class="btn btn-success"><i
                                        class="ri-printer-line align-bottom me-1"></i> Save
                                </button>
                            </div>
                        </div>

                    @endisset

                </form>
            </div>

        </div>
    </div>
@endsection


@push('js')
    <script>
        function calculateTotal() {
            let total = 0;
            $('.product-line-price').each(function() {
                let amount = parseFloat($(this).val()) || 0;
                total += amount;
            });
            $('#cart-total').val(total.toFixed(2)).trigger('input');
            $('#invoice-total').val(total.toFixed(2));

            $('#due_amount_save').val(total.toFixed(2));

        }

        $(document).ready(function() {
            calculateTotal();
        });

        $('#newlink').on('change', 'select[name="items[]"]', function() {
            let selectedOption = $(this).find(':selected');
            let amount = selectedOption.data('amount') || 0;
            $(this).closest('tr').find('.product-line-price').val(amount);
            calculateTotal();
        });

        $('#newlink').on('click', 'a.btn-danger:not(:first)', function() {
            $(this).closest('tr.product').remove();
            calculateTotal();
        });

        function new_link() {
            let tr = $('#newlink tr:last').clone();
            let currentId = parseInt(tr.attr('id'));
            let newId = currentId + 1;
            tr.attr('id', newId);
            tr.find('.product-id').text(newId);
            tr.find('input, textarea').val('');
            tr.appendTo('#newlink');
            calculateTotal();
        }
    </script>


    {{-- revice ammount and due amont save --}}
    <script>
     $(document).ready(function() {
    $('#receive_payment_save').on('keyup', function() {
        // Get the due amount
        var dueAmount = parseFloat($('#due_amount_save').val());
        console.log("due amount save:", dueAmount);

        // Get the received payment
        var receivedPayment = parseFloat($(this).val());
        console.log("received payment save:", receivedPayment);

        // Check for NaN values
        if (isNaN(dueAmount) || isNaN(receivedPayment)) {
            console.log("Invalid input. Please enter valid numbers.");
            return; // Exit the function if input values are not valid
        }

        // Calculate the remaining due amount
        var remainingDue = dueAmount - receivedPayment;

        // Update the remaining due amount field
        $('#due_amount_save').val(remainingDue.toFixed(2)); // Assuming you want to display 2 decimal places
    });
});


    </script>

    {{-- revice ammount and due amont update --}}
    <script>
        $(document).ready(function() {


            $('#receive_payment').on('input', function() {

                // Get the received payment
                var receivedPayment = parseFloat($(this).val());
            var dueAmount = parseFloat($('#due_amount').val());
                // Get the due amount

                console.log("due amount", dueAmount);

                // Calculate the remaining due amount
                var remainingDue = dueAmount - receivedPayment;



                // Update the remaining due amount field
                $('#due_amount').val(remainingDue.toFixed(
                    2)); // Assuming you want to display 2 decimal places
            });
        });
    </script>
@endpush

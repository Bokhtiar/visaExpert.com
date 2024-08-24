@extends('layouts.backend.master')

@section('title',  isset($visaForm) ? 'Edit Form' : 'View Form')

@section('content')
    <div class="row">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">{{ isset($visaForm) ? 'Edit Form' : 'View Form' }}</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">Dashboard</li>
                                <li class="breadcrumb-item">Visa Application Form</li>
                                <li class="breadcrumb-item active">{{ isset($visaForm) ? 'Edit Form' : 'View Form' }}</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">{{ isset($visaForm) ? 'Edit' : 'View' }}
                                Application Form</h4>
                            <div class="flex-shrink-0">
                                <div>
                                    <a href="{{ route('admin.visa-forms.index') }}" class="btn btn-secondary">
                                        <i class="ri-arrow-left-line align-bottom me-1"></i>
                                        Back to list
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form id="visa-form"
                                  action="{{ route('admin.visa-forms.update', $visaForm->id) }}"
                                  method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="visaTypeSelect" class="form-label">Visa Type</label>
                                    <input type="text" class="form-control" id="visaTypeSelect"
                                           name="visa_type_id" value="{{ $visaForm->service->visaType->title }}"
                                           disabled="">
                                </div>

                                <div class="mb-3">
                                    <label for="customer_id" class="form-label">Customer ID</label>
                                    <input type="text" class="form-control" id="customer_id"
                                           name="customer_id"
                                           value="{{ $visaForm->submit_for_other ? $visaForm->customer_id : $visaForm->user->id }}"
                                           required="" disabled="">
                                </div>

                                <div class="mb-3">
                                    <label for="nameInput" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="nameInput"
                                           name="name"
                                           value="{{ $visaForm->submit_for_other ? $visaForm->applicant_name : $visaForm->user->name }}"
                                           required="" disabled="">
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email"
                                           name="email"
                                           value="{{ $visaForm->submit_for_other ? $visaForm->applicant_email : $visaForm->user->email }}"
                                           required="" disabled="">
                                </div>

                                <div class="mb-3">
                                    <label for="phone" class="form-label">Contact Number</label>
                                    <input type="text" class="form-control" id="phone"
                                           name="phone"
                                           value="{{ $visaForm->submit_for_other ? $visaForm->applicant_phone : $visaForm->user->phone }}"
                                           required="" disabled="">


                                </div>

                                <div class="mb-3">
                                    <label for="addressInput" class="form-label">Address</label>
                                    <textarea class="form-control" id="addressInput" rows="3" name="address" required="" disabled=""
                                    >{{ $visaForm->submit_for_other ? $visaForm->applicant_address : $visaForm->user->address }}</textarea>
                                </div>
                                @if($visaForm->service)
                                    <div class="mb-3">
                                        <label for="visaFee" class="form-label">Fees</label>
                                        <input type="text" class="form-control" id="visaFee"
                                               name="visa_fee"
                                               value="{{ $visaForm->invoice->amount }}"
                                               readonly
                                        >
                                    </div>
                                @else
                                    <div class="mb-3">
                                        <label for="visaFee" class="form-label">Fees</label>
                                        <input type="text" class="form-control" id="visaFee"
                                               name="visa_fee"
                                               value="{{ $visaForm->user->user_type == 'agent' ?  $visaForm->service->agent_amount  : $visaForm->service->customer_amount }}"
                                        >
                                    </div>
                                @endif
                                <div class="mb-3">
                                    <p class="form-label">Additional Charges</p>
                                    @foreach($services as $service)
                                        <div class="form-check form-check-dark">
                                            @php
                                                $serviceAmount = $visaForm->user->user_type == 'agent' ? $service->agent_amount : $service->customer_amount;
                                            @endphp
                                            <input class="form-check-input service-checkbox" type="checkbox"
                                                   id="service_{{ $service->id }}"
                                                   data-amount="{{ $serviceAmount }}">
                                            <label class="form-check-label" for="service_{{ $service->id }}">
                                                {{ $service->title }} (+{{ $serviceAmount }})
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="mb-3">
                                    <label for="visaStatusSelect" class="form-label">Visa Status</label>

                                    <select class="form-select" id="visaStatusSelect" name="visa_status" required="">
                                        @foreach($visaStatus as $status)
                                            <option value="{{ $status }}"
                                                    {{ $visaForm->visa_status == $status ? 'selected' : '' }}>
                                                {{ $status }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="paymentStatusSelect" class="form-label">Payment Status</label>

                                    <select class="form-select" id="paymentStatusSelect" name="payment_status"
                                            required="">
                                        @foreach($paymentStatus as $status)
                                            <option value="{{ $status }}"
                                                    {{ $visaForm->payment_status == $status ? 'selected' : '' }}>
                                                {{ $status }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mt-3">
                                    <button type="button" class="btn btn-danger" onClick="resetForm('visa-form')">
                                        <i class="fas fa-redo"></i>
                                        <span>Reset</span>
                                    </button>
                                    @isset($visaForm)
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-plus-circle"></i>
                                            <span>Update</span>
                                        </button>
                                    @else
                                        <button type="submit" class="btn btn-primary">
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
    <script>
        $(document).ready(function () {
            // Initial visa fee value
            let visaFee = parseFloat($("#visaFee").val());

            // Checkbox click event handler
            $(".service-checkbox").on("change", function () {
                let serviceAmount = parseFloat($(this).data("amount"));

                // Check if checkbox is checked
                if ($(this).is(":checked")) {
                    visaFee += serviceAmount; // Add service amount to visa fee
                } else {
                    visaFee -= serviceAmount; // Subtract service amount from visa fee
                }

                // Update visa fee field
                $("#visaFee").val(visaFee.toFixed(2)); // Set the updated value to the visa fee field
            });
        });
    </script>
@endpush


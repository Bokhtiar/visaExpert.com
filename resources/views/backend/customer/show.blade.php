@use ('App\Enums\DocumentStatus', 'Status')
@extends('layouts.backend.master')

@section('title', 'View Customer')

@push('css')
    <!-- glightbox css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />

    {{-- jqery --}}
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
@endpush

@section('content')





    <div class="row">
        <div class="container">
            <div class="row mt-4">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Customer Details</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">Dashboard</li>
                                <li class="breadcrumb-item">Customers</li>
                                <li class="breadcrumb-item active">View Customer Profile</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            @if (count($parent_customers) > 1)


                <h5>Relavent Customer List: </h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">SL</th>
                            <th scope="col">Customer</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($parent_customers as $cus)
                            <tr>
                                <th scope="row">{{ $loop->index + 1 }}</th>
                                <td>{{ $cus->name }} <span class=""
                                        style="color: red">{{ $cus->id == $cus->parent_customer_id ? '(Owner)' : '' }}</span>
                                </td>
                                <td>{{ $cus->phone }}</td>
                                <td>
                                    <a href="{{ route('admin.customers.show', $cus->id) }}"
                                        class="btn btn-clr-red waves-effect waves-light"> Show</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            @endif



            <div class="row mt-5 shadow-lg">
                <div class="col-xxl-3">
                    <div class="card mt-n5">
                        <div class="card-body p-4">
                            <div class="text-center">
                                <div class="profile-user position-relative d-inline-block mx-auto mb-4">
                                    <img src="{{ asset('backend/assets/images/users/user.svg') }}"
                                        class="rounded-circle avatar-xl img-thumbnail user-profile-image"
                                        alt="user-profile-image">
                                </div>
                                <h5 class="fs-16 mb-1">
                                    {{ ucfirst($customer->name) }}
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-n4">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-2">
                                <div class="flex-grow-1">
                                    <h5 class="card-title mb-0">User ID : </h5>
                                </div>
                                <div class="flex-shrink-0">
                                    #{{ $customer->unique_id }}
                                </div>
                            </div>

                            <div class="d-flex align-items-center mb-2">
                                <div class="flex-grow-1">
                                    <h5 class="card-title mb-0">Work Status : </h5>
                                </div>
                                <div class="flex-shrink-1 custom-badge-style">
                                    {!! displayVisaStatusBadge($customer->forms[0]->visa_status) !!}
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <div class="flex-grow-1">
                                    <h5 class="card-title mb-0">Payment Status : </h5>
                                </div>
                                <div class="flex-shrink-0">
                                    {{ count($customer->invoices) > 0 ? $customer->invoices[0]->status : $customer->forms[0]->payment_status }}
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <div class="flex-grow-1">
                                    <h5 class="card-title mb-0">Creation Date : </h5>
                                </div>
                                <div class="flex-shrink-0">
                                    {{ $customer->created_at->format('d M Y') }}
                                </div>
                            </div>
                            <div class="d-grid align-items-center my-4">
                                @can(\App\Permissions::EDIT_CUSTOMER)
                                    <button class="btn btn-clr-red mb-2" onclick="toggleVisaStatusDropdown()">
                                        <i class="ri-edit-box-line"></i>
                                        Update Information
                                    </button>
                                @endcan
                                <a href="{{ route('admin.customers.index') }}" class="btn btn-outline-primary">
                                    <i class="ri-arrow-left-s-line align-bottom me-1"></i>
                                    Go to Customer List
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-9">
                    <div class="card mt-xxl-n5">
                        <div class="card-header">
                            <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link text-dark active" data-bs-toggle="tab" href="#serviceInformation"
                                        role="tab">
                                        Service Information
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-dark" data-bs-toggle="tab" href="#personalInformation"
                                        role="tab">
                                        Personal Information
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-dark" data-bs-toggle="tab" href="#submittedDocuments"
                                        role="tab">
                                        Submitted Documents
                                    </a>
                                </li>
                                @can(\App\Permissions::CREATE_CUSTOMER_INVOICE)
                                    @if ($customer->id == $customer->parent_customer_id)
                                        <li class="nav-item">
                                            <a class="nav-link text-dark" data-bs-toggle="tab" href="#generatedBill"
                                                role="tab">
                                                Generated & Updated Bill/Invoices
                                            </a>
                                        </li>
                                    @endif

                                @endcan
                            </ul>
                        </div>
                        <div class="card-body p-4 bg-light">
                            <div class="tab-content">
                                <div class="tab-pane active" id="serviceInformation" role="tabpanel">
                                    <div class="row">
                                        <div class="bg-clr-red mb-4 rounded-1">
                                            <h5 class="mb-sm-0 text-light py-2">Visa Application Service</h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="row mb-3">
                                            <div class="col-lg-3">
                                                <label for="nameInput" class="form-label">Customer Name :</label>
                                            </div>
                                            <div class="col-lg-9">
                                                {{ $customer->name }}
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-lg-3">
                                                <label for="nameInput" class="form-label">Visa Type :</label>
                                            </div>
                                            <div class="col-lg-9">
                                                {{ $customer->forms[0]->visaType->title }}
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-lg-3">
                                                <label for="note" class="form-label">Note :</label>
                                            </div>
                                            <div class="col-lg-9">
                                                {{ $customer->forms[0]->note }}
                                            </div>
                                        </div>




                                        <div class="row mb-3">
                                            <div class="col-lg-3">
                                                <label for="nameInput" class="form-label">Work Status :</label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div id="mainContent">
                                                    {!! displayVisaStatusBadge($customer->forms[0]->visa_status) !!}
                                                </div>



                                                <form id="updateVisaStatusForm" method="POST"
                                                    action="{{ route('admin.customers.updateVisaStatus', $customer->id) }}"
                                                    style="display: none;" enctype="multipart/form-data">
                                                    @method('PATCH')
                                                    @csrf
                                                    <select name="visa_status" id="visa_status" class="form-select mb-3">
                                                        @foreach ($visaStatuses as $status)
                                                            <option value="{{ $status }}"
                                                                {{ $customer->forms[0]->visa_status == $status ? 'selected' : '' }}>
                                                                {{ $status }}
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                    <!--new code added start here-->
                                                    <div class="row mb-3">
                                                        <div class="col-lg-3">
                                                            <label for="note" class="form-label">Note
                                                                :</label>
                                                        </div>
                                                        <div class="col-lg-9">
                                                            <input type="text" name="note" id="note"
                                                                class="form-control"
                                                                value="{{ $customer->forms[0]->note }}">
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <div class="col-lg-3">
                                                            <label for="type_remarks1" class="form-label">Type Remarks
                                                                :</label>
                                                        </div>
                                                        <div class="col-lg-9">
                                                            <input type="text" name="type_remarks1" id="type_remarks1"
                                                                class="form-control"
                                                                value="{{ $customer->forms[0]->type_remarks1 }}">
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <div class="col-lg-3">
                                                            <label for="application_id" class="form-label">Temporary
                                                                Application ID :</label>
                                                        </div>
                                                        <div class="col-lg-9">
                                                            <input type="text" name="application_id"
                                                                id="application_id" class="form-control"
                                                                value="{{ $customer->forms[0]->application_id }}"
                                                                maxlength="15" placeholder="max 15 chr.">
                                                        </div>
                                                    </div>


                                                    <div class="row mb-3">
                                                        <div class="col-lg-3">
                                                            <label for="web_file_app_id" class="form-label">Web File /
                                                                Application ID :</label>
                                                        </div>
                                                        <div class="col-lg-9">
                                                            <input type="file" name="web_file_app_id"
                                                                id="web_file_app_id" class="form-control"
                                                                value="{{ $customer->forms[0]->web_file_app_id }}"
                                                                accept=".pdf" maxlength="2097152">

                                                            <span>Already added: <span class="text-success cursor-pointer"
                                                                    onclick="printPDF('{{ $customer->forms[0]->web_file_app_id }}')">Print
                                                                </span>/
                                                                <a class="text-success"
                                                                    href="{{ asset('uploads/visa-forms/documents/' . $customer->forms[0]->web_file_app_id) }}"
                                                                    download="{{ $customer->forms[0]->web_file_app_id }}">
                                                                    PDF
                                                                </a>
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <div class="col-lg-3">
                                                            <label for="type_remarks2" class="form-label">Type Remarks
                                                                :</label>
                                                        </div>
                                                        <div class="col-lg-9">
                                                            <input type="text" name="type_remarks2" id="type_remarks2"
                                                                class="form-control"
                                                                value="{{ $customer->forms[0]->type_remarks2 }}">
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <div class="col-lg-3">
                                                            <label for="image" class="form-label">Image Upload
                                                                :</label>
                                                        </div>
                                                        <div class="col-lg-9">
                                                            <input type="file" name="image" id="image"
                                                                class="form-control"
                                                                value="{{ $customer->forms[0]->image }}"
                                                                accept="image/*">
                                                            <span>Already added: <span class="text-success cursor-pointer"
                                                                    onclick="printPDF('{{ $customer->forms[0]->image }}')">Print
                                                                </span>/
                                                                <a class="text-success"
                                                                    href="{{ asset('uploads/visa-forms/documents/' . $customer->forms[0]->web_file_app_id) }}"
                                                                    download="{{ $customer->forms[0]->image }}">
                                                                    PDF
                                                                </a>
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <!--new code added end here-->



                                                    <button type="submit" class="btn btn-clr-red">Save</button>
                                                    <button type="button" class="btn btn-outline-danger"
                                                        onclick="cancelUpdate()">Cancel
                                                    </button>
                                                </form>




                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-lg-3">
                                                <label for="type_remarks1" class="form-label">Type Remarks :</label>
                                            </div>
                                            <div class="col-lg-9">
                                                {{ $customer->forms[0]->type_remarks1 }}
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-lg-3">
                                                <label for="application_id" class="form-label">Temporary Application ID
                                                    :</label>
                                            </div>
                                            <div class="col-lg-9">
                                                {{ $customer->forms[0]->application_id }}
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-lg-3">
                                                <label for="web_file_app_id" class="form-label">Web File / Application ID
                                                    :</label>
                                            </div>
                                            <div class="col-lg-9">
                                                <a href="{{ asset('public/' . $customer->forms[0]->web_file_app_id) }}"
                                                    target="_blank">{{ $customer->name }} PDF</a> <br>



                                                <span class="text-success cursor-pointer"
                                                    onclick="printPDF('{{ $customer->forms[0]->web_file_app_id }}')">Print
                                                </span>/
                                                <a class="text-success"
                                                    href="{{ asset('uploads/visa-forms/documents/' . $customer->forms[0]->web_file_app_id) }}"
                                                    download="{{ $customer->forms[0]->web_file_app_id }}">
                                                    PDF
                                                </a>


                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-lg-3">
                                                <label for="type_remarks2" class="form-label">Type Remarks :</label>
                                            </div>
                                            <div class="col-lg-9">
                                                {{ $customer->forms[0]->type_remarks2 }}
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-lg-3">
                                                <label for="image" class="form-label">Image Upload :</label>
                                            </div>
                                            <div class="col-lg-9">

                                                <span class="text-success cursor-pointer"
                                                    onclick="printPDF('{{ $customer->forms[0]->image }}')">Print
                                                </span>/
                                                <a class="text-success"
                                                    href="{{ asset('uploads/visa-forms/documents/' . $customer->forms[0]->image) }}"
                                                    download="{{ $customer->forms[0]->image }}">
                                                    PDF
                                                </a>

                                            </div>
                                        </div>


                                        <div class="row mb-3">
                                            <div class="col-lg-3">
                                                <label for="websiteUrl" class="form-label">Total Charges(BDT) :</label>
                                            </div>
                                            <div class="col-lg-9">
                                                {{ isset($customer->invoices) && count($customer->invoices) > 0 ? number_format($customer->invoices->sum('total_amount')) : '-' }}
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-lg-3">
                                                <label for="websiteUrl" class="form-label">Payment Status :</label>
                                            </div>
                                            <div class="col-lg-9">
                                                @if ($customer->forms[0]->invoice)
                                                    {!! displayPaymentStatusBadge($customer->forms[0]->invoice->status) !!}
                                                @else
                                                    {!! displayPaymentStatusBadge($customer->forms[0]->payment_status) !!}
                                                @endif
                                            </div>
                                        </div>


                                    </div>
                                    <a href="{{ route('admin.customers.add-more', $customer->id) }}"
                                        class="btn btn-clr-red">Add More Customer</a>
                                </div>
                                <!--end Service tab-pane-->
                                <div class="tab-pane" id="personalInformation" role="tabpanel">
                                    <div class="row">
                                        <div class="bg-clr-red mb-4 rounded-1">
                                            <h5 class="mb-sm-0 text-light py-2">Personal Information</h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="row mb-3">
                                            <div class="col-lg-3">
                                                <label for="nameInput" class="form-label">User ID :</label>
                                            </div>
                                            <div class="col-lg-9">
                                                {{ $customer->unique_id }}
                                            </div>
                                        </div>
                                        <div id="customerItems">
                                            <div class="row mb-3">
                                                <div class="col-lg-3">
                                                    <label for="CustomerName" class="form-label">Name :</label>
                                                </div>
                                                <div class="col-lg-9">
                                                    {{ ucfirst($customer->name) }}
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-lg-3">
                                                    <label for="customerPhone" class="form-label">Phone Number :</label>
                                                </div>
                                                <div class="col-lg-9">
                                                    {{ $customer->phone }}
                                                </div>
                                            </div>

                                            @foreach ($passport as $pass)
                                                <div class="row mb-3">
                                                    <div class="col-lg-3">
                                                        <label for="customerPhone" class="form-label">Passport No.
                                                            {{ $loop->index + 1 }} :</label>
                                                    </div>
                                                    <div class="col-lg-9">
                                                        {{ $pass->passport }}
                                                    </div>
                                                </div>
                                            @endforeach


                                        </div>
                                        <form id="updateCustomerForm"
                                            action="{{ route('admin.customers.update', $customer->id) }}" method="POST"
                                            style="display: none;" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="row mb-3">
                                                <div class="col-lg-3">
                                                    <label for="customerName" class="form-label">Name :</label>
                                                </div>
                                                <div class="col-lg-9">
                                                    <input type="text" name="name" id="customerName"
                                                        class="form-control" value="{{ ucfirst($customer->name) }}">
                                                </div>
                                            </div>


                                            <div class="row mb-3">
                                                <div class="col-lg-3">
                                                    <label for="customerPhone" class="form-label">Phone Number :</label>
                                                </div>
                                                <div class="col-lg-9">
                                                    <input type="number" name="phone" id="customerPhone"
                                                        class="form-control" value="{{ $customer->phone }}">
                                                </div>
                                            </div>




                                            <table class="table table-bordered" id="dynamicTable">
                                                <h4>Passport</h4>
                                                <tr>
                                                    @foreach ($passport as $key => $value)
                                                        <td><input type="text"
                                                                name="addmore_update[{{ $value['id'] }}][name]"
                                                                placeholder="Enter your passport" class="form-control"
                                                                value="{{ $value['passport'] }}" /></td>
                                                        <input type="hidden" value="{{ $value['id'] }}"
                                                            name="addmore_update[{{ $value['id'] }}][id]"
                                                            placeholder="Enter your passport" class="form-control" /></td>
                                                    @endforeach
                                                    <td><button type="button" name="add" id="add"
                                                            class="btn btn-success">Add More Passport</button></td>
                                                </tr>

                                                {{-- @foreach ($passport as $key => $value)
                                                    <tr>
                                                        <td><input type="text" value="{{ $value['passport'] }}"
                                                                name="addMore[{{ $value['id'] }}][name]"
                                                                placeholder="Enter your passport"
                                                                class="form-control" />
                                                            <input type="hidden"
                                                                value="{{ $value['id'] }}"
                                                                name="addMore[{{ $value['id'] }}][id]"
                                                                placeholder="Enter your passport" class="form-control" /></td>
                                                        
                                                        <td><button type="button"
                                                                class="btn btn-danger remove-tr">Remove</button></td>
                                                    </tr>
                                                @endforeach --}}
                                            </table>



                                            <button type="submit" class="btn btn-clr-red">Save</button>
                                            <button type="button" class="btn btn-outline-danger"
                                                onclick="cancelUpdate()">Cancel
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <!--end Personal Information tab-pane-->
                                <div class="tab-pane" id="submittedDocuments" role="tabpanel">
                                    <div class="row">
                                        <div class="bg-clr-red mb-4 rounded-1">
                                            <h5 class="mb-sm-0 text-light py-2">Submitted Documents</h5>
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="d-flex align-items-center">
                                            <h5 class="card-title mb-0 flex-grow-1">Documents update</h5>
                                            <div class="flex-shrink-0">
                                                {{-- <div>
                                                    <a href="{{ route('admin.customers.documents-upload', $customer->id) }}"
                                                        class="btn btn-clr-red waves-effect waves-light">
                                                        <i class="ri-file-add-line align-bottom me-1"></i>
                                                        Upload Documetns
                                                    </a>
                                                </div> --}}
                                            </div>
                                        </div>
                                        {{-- document create update --}}
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-xxl-12">
                                                    <div class="card">
                                                        
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
                                                                        $exist = App\Models\VisaForm::exitDocument(
                                                                            $file,
                                                                            $customer_form_id,
                                                                        );

                                                                    @endphp

                                                                    @if ($exist)
                                                                        <form
                                                                            action="{{ route('admin.customers.single.document.update', $exist->id) }}"
                                                                            method="POST" enctype="multipart/form-data">
                                                                            @method('PUT')
                                                                        @else
                                                                            <form
                                                                                action="{{ route('admin.customers.single.document.store') }}"
                                                                                method="POST"
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
                                                                            <input type="file" name="doc"
                                                                                id="">
                                                                        </td>

                                                                        <input type="hidden" name="customer_form_id"
                                                                            value="{{ $customer_form_id }}"
                                                                            id="">
                                                                        <input type="hidden" name="customer_id"
                                                                            value="{{ $customer_id }}" id="">
                                                                        <input type="hidden" name="title"
                                                                            value="{{ $file }}" id="">
                                                                        <td>
                                                                            @if ($exist)
                                                                                <input type="submit" name=""
                                                                                    class="btn btn-success" value="update"
                                                                                    id="">
                                                                            @else
                                                                                <input type="submit" name=""
                                                                                    class="btn btn-info" value="submit"
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
                                        {{-- document view --}}
                                        <div class="table-responsive">
                                            <table class="table table-borderless align-middle table-nowrap mb-0">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">SL</th>
                                                        <th scope="col">Document Name</th>
                                                        <th scope="col">Submitted Files</th>
                                                        <th scope="col">Print/PDF</th>
                                                        <th scope="col">Status</th>
                                                        @can(\App\Permissions::EDIT_CUSTOMER)
                                                            <th scope="col">Action</th>
                                                        @endcan
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($customer->forms as $form)
                                                        @forelse($form->documents as $key => $document)
                                                            <tr>
                                                                <td class="fw-medium text-center">{{ $key + 1 }}</td>
                                                                <td>{{ $document->title }}</td>
                                                                @if ($document->document_type != 'pdf')
                                                                    <td>
                                                                        <a class="image-popup"
                                                                            href="{{ asset('uploads/visa-forms/documents/' . $document->documents) }}"
                                                                            title="{{ $document->title }}">
                                                                            View
                                                                        </a>
                                                                    </td>
                                                                @else
                                                                    <td>
                                                                        <a href="{{ asset('uploads/visa-forms/documents/' . $document->documents) }}"
                                                                            target="_blank">
                                                                            View PDF
                                                                        </a>
                                                                    </td>
                                                                @endif
                                                                <td>
                                                                    <span class="text-success cursor-pointer"
                                                                        onclick="printPDF('{{ $document->documents }}')">Print
                                                                    </span>/
                                                                    <a class="text-success"
                                                                        href="{{ asset('uploads/visa-forms/documents/' . $document->documents) }}"
                                                                        download="{{ $document->documents }}">
                                                                        PDF
                                                                    </a>
                                                                </td>

                                                                {{-- <a href="{{ route('admin.customers.print.pdf', $document->documents) }}">print</a> --}}
                                                                <td id="document-status-{{ $document->id }}">
                                                                    {{ $document->status ?? 'Waiting for Review' }}</td>
                                                                @can(\App\Permissions::EDIT_CUSTOMER)
                                                                    <td>
                                                                        <div class="d-flex gap-2 align-items-center">
                                                                            <div class="form-check form-radio-success">
                                                                                <input class="form-check-input document-status"
                                                                                    type="radio"
                                                                                    data-document-id="{{ $document->id }}"
                                                                                    data-form-id="{{ $form->id }}"
                                                                                    name="document_status_{{ $document->id }}"
                                                                                    value="Accepted"
                                                                                    {{ $document->status === Status::ACCEPTED->toString() ? 'checked' : '' }}>
                                                                                <label class="form-check-label"
                                                                                    for="document_status_{{ $document->id }}">
                                                                                    Accept
                                                                                </label>
                                                                            </div>
                                                                            <div class="form-check form-radio-danger">
                                                                                <input class="form-check-input document-status"
                                                                                    type="radio"
                                                                                    data-customer-id="{{ $customer->id }}"
                                                                                    data-document-id="{{ $document->id }}"
                                                                                    data-form-id="{{ $form->id }}"
                                                                                    name="document_status_{{ $document->id }}"
                                                                                    value="Rejected"
                                                                                    {{ $document->status === Status::REJECTED->toString() ? 'checked' : '' }}>
                                                                                <label class="form-check-label"
                                                                                    for="document_status_{{ $document->id }}">
                                                                                    Reject
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                @endcan
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td>No record Found.</td>
                                                            </tr>
                                                        @endforelse
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
                                <!--end Personal Information tab-pane-->
                                @can(\App\Permissions::CREATE_CUSTOMER_INVOICE)
                                    @if (count($customer->invoices) > 0)
                                        <div class="tab-pane" id="generatedBill" role="tabpanel">
                                            <div class="row">
                                                <div class="bg-clr-red mb-4 rounded-1">
                                                    <h5 class="mb-sm-0 text-light py-2">Generated Customer Bills</h5>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="card" id="invoiceList">
                                                        <div class="card-header border-0">
                                                            <div class="d-flex align-items-center">
                                                                <h5 class="card-title mb-0 flex-grow-1">Invoices</h5>
                                                                <div class="flex-shrink-0">
                                                                    <div>
                                                                        @can(\App\Permissions::CREATE_CUSTOMER_INVOICE)
                                                                            <a href="{{ route('admin.customers-invoices.create', $customer->id) }}"
                                                                                class="btn btn-clr-red waves-effect waves-light">
                                                                                <i class="ri-file-add-line align-bottom me-1"></i>
                                                                                Create Invoice
                                                                            </a>
                                                                        @endcan
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card-body">
                                                            <div>
                                                                <div class="table-responsive table-card">
                                                                    <table class="table align-middle table-nowrap"
                                                                        id="invoiceTable">
                                                                        <thead class="text-muted">
                                                                            <tr>
                                                                                <th scope="col">SL</th>
                                                                                <th class="text-uppercase"
                                                                                    data-sort="invoice_id">User ID
                                                                                </th>
                                                                                <th class="text-uppercase"
                                                                                    data-sort="customer_name">
                                                                                    Customer
                                                                                </th>
                                                                                <th class="text-uppercase" data-sort="date">
                                                                                    Date
                                                                                </th>
                                                                                <th class="text-uppercase"
                                                                                    data-sort="invoice_amount">
                                                                                    Amount
                                                                                </th>
                                                                                <th class="text-uppercase" data-sort="status">
                                                                                    Payment
                                                                                    Status
                                                                                </th>
                                                                                <th class="text-uppercase" data-sort="action">
                                                                                    Action
                                                                                </th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @forelse($customer->invoices as $key=>$invoice)
                                                                                <tr>
                                                                                    <td class="fw-medium text-center">
                                                                                        {{ $key + 1 }}</td>
                                                                                    <td>{{ $invoice->customer->unique_id }}
                                                                                    </td>
                                                                                    <td>{{ ucfirst($invoice->customer->name) }}
                                                                                    </td>
                                                                                    <td>{{ $invoice->created_at->format('d M Y') }}
                                                                                    </td>
                                                                                    <td>{{ number_format($invoice->total_amount) }}
                                                                                    </td>
                                                                                    <td>{!! displayPaymentStatusBadge($invoice->status) !!}</td>
                                                                                    <td>
                                                                                        <div class="hstack gap-1">
                                                                                            <a href="{{ route('admin.customers-invoices.show', $invoice->id) }}"
                                                                                                class="btn btn-sm btn-clr-red waves-effect waves-light">
                                                                                                <i
                                                                                                    class="ri-eye-2-line align-bottom me-1"></i>
                                                                                                View
                                                                                            </a>
                                                                                            @can(\App\Permissions::EDIT_CUSTOMER_INVOICE)
                                                                                                <a href="{{ route('admin.customers-invoices.edit', $invoice->id) }}"
                                                                                                    class="btn btn-sm btn-outline-primary waves-effect waves-light">
                                                                                                    <i
                                                                                                        class="ri-pencil-line align-bottom me-1"></i>
                                                                                                    Edit
                                                                                                </a>
                                                                                            @endcan
                                                                                            @can(\App\Permissions::DELETE_CUSTOMER_INVOICE)
                                                                                                <button type="button"
                                                                                                    class="btn btn-sm btn-outline-danger waves-effect waves-light"
                                                                                                    onclick="deleteData({{ $invoice->id }})">
                                                                                                    <i
                                                                                                        class="ri-delete-bin-5-line align-bottom me-1"></i>
                                                                                                    Delete
                                                                                                </button>
                                                                                                <form
                                                                                                    id="delete-form-{{ $invoice->id }}"
                                                                                                    action="{{ route('admin.customers-invoices.destroy', $invoice->id) }}"
                                                                                                    method="POST"
                                                                                                    style="display: none;">
                                                                                                    @csrf
                                                                                                    @method('DELETE')
                                                                                                </form>
                                                                                            @endcan
                                                                                        </div>
                                                                                    </td>
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
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="tab-pane" id="generatedBill" role="tabpanel">
                                            <div class="row">
                                                <div class="bg-clr-red mb-4 rounded-1">
                                                    <h5 class="mb-sm-0 text-light py-2">Generated Customer Bills</h5>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="card" id="invoiceList">
                                                        <div class="card-header border-0">
                                                            <div class="d-flex align-items-center">
                                                                <h5 class="card-title mb-0 flex-grow-1">Invoices</h5>
                                                                <div class="flex-shrink-0">
                                                                    <div>
                                                                        @can(\App\Permissions::CREATE_CUSTOMER_INVOICE)
                                                                            <a href="{{ route('admin.customers-invoices.create', $customer->id) }}"
                                                                                class="btn btn-clr-red waves-effect waves-light">
                                                                                <i class="ri-file-add-line align-bottom me-1"></i>
                                                                                Create Invoice
                                                                            </a>
                                                                        @endcan
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card-body">
                                                            <div>
                                                                <div class="table-responsive table-card">
                                                                    <table class="table align-middle table-nowrap"
                                                                        id="invoiceTable">
                                                                        <thead class="text-muted">
                                                                            <tr>
                                                                                <th scope="col">SL</th>
                                                                                <th class="text-uppercase"
                                                                                    data-sort="invoice_id">User ID
                                                                                </th>
                                                                                <th class="text-uppercase"
                                                                                    data-sort="customer_name">
                                                                                    Customer
                                                                                </th>
                                                                                <th class="text-uppercase" data-sort="date">
                                                                                    Date
                                                                                </th>
                                                                                <th class="text-uppercase"
                                                                                    data-sort="invoice_amount">
                                                                                    Amount
                                                                                </th>
                                                                                <th class="text-uppercase" data-sort="status">
                                                                                    Payment
                                                                                    Status
                                                                                </th>
                                                                                <th class="text-uppercase" data-sort="action">
                                                                                    Action
                                                                                </th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                                <td>No record Found.</td>
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
                                    @endif
                                @endcan
                                <!--end Generated Bill tab-pane-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        function toggleVisaStatusDropdown() {
            $('#updateVisaStatusForm').show();
            $('#mainContent').hide();

            $('#updateCustomerForm').show();
            $('#customerItems').hide();
        }

        function cancelUpdate() {
            $('#mainContent').show();
            $('#customerItems').show();

            $('#updateVisaStatusForm').hide();
            $('#updateCustomerForm').hide();
        }

        $(document).ready(function() {
            $(document).on('change', '.document-status', function() {
                const customerId = $(this).data('customer-id');
                const documentId = $(this).data('document-id');
                const formId = $(this).data('form-id');
                const status = $(`input[name=document_status_${documentId}]:checked`).val();

                $.ajax({
                    type: 'PATCH',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '/admin/customers/' + customerId + '/forms/' + formId + '/documents/' +
                        documentId + '/update-status',
                    data: {
                        customer_id: customerId,
                        document_id: documentId,
                        form_id: formId,
                        status: status
                    },
                    success: function(response) {
                        $(`#document-status-${response.document_id}`).text(response.status);
                        Toastify({
                            text: response.message,
                            duration: 3000,
                            newWindow: false,
                            close: true,
                            gravity: "top",
                            position: "right",
                            stopOnFocus: true,
                            style: {
                                background: "linear-gradient(to right, #00b09b, #96c93d)",
                            },
                            onClick: function() {}
                        }).showToast();
                    },
                    error: function(error) {
                        Toastify({
                            text: error.message,
                            duration: 3000,
                            newWindow: true,
                            close: true,
                            gravity: "top",
                            position: "right",
                            stopOnFocus: true,
                            style: {
                                background: "linear-gradient(to right, #ff5f6d, #ffc371)",
                            },
                            onClick: function() {}
                        }).showToast();
                    }
                });
            });
        });
    </script>




    {{-- print --}}
    <script>
        // Function to open the PDF in a new window and trigger print dialog
        function printPDF(docs) {
            var pdfWindow = window.open("{{ asset('uploads/visa-forms/documents/') }}" + "/" + docs, "_blank");
            pdfWindow.onload = function() {
                pdfWindow.print();
                pdfWindow.onafterprint = function() {
                    pdfWindow.close(); // Close the window after printing
                };
            };
        }
    </script>


    {{-- dynamic form --}}

    <script type="text/javascript">
        var i = 0;

        $("#add").click(function() {
            ++i;
            $("#dynamicTable").append('<tr><td><input type="text" name="addMore[' + i +
                '][name]" placeholder="Enter your Name" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>'
            );
        });

        $(document).on('click', '.remove-tr', function() {
            $(this).parents('tr').remove();
        });
    </script>

    <!-- glightbox js -->
    <script src="{{ asset('backend/assets/libs/glightbox/js/glightbox.min.js') }}"></script>

    <script src="{{ asset('backend/assets/js/pages/gallery.init.js') }}"></script>
@endpush

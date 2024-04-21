@extends('layouts.backend.master')

@section('title', 'All VisaForm')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Visa Forms</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item active">Visa Forms</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">All Forms</h4>
                </div>
                <div class="card-body bg-light-subtle border border-dashed border-start-0 border-end-0">
                    <form>
                        <div class="row g-3">
                            <div class="col-xxl-4 col-sm-12">
                                <div class="search-box">
                                    <input type="text" class="form-control search bg-light border-light"
                                           id="search" name="search" value="{{ $searchTerm ?? '' }}"
                                           placeholder="Search for User ID, Customer Name or something...">
                                    <i class="ri-search-line search-icon"></i>
                                </div>
                            </div>
                            <div class="col-xxl-1 col-sm-4">
                                <div>
                                    <button type="submit" class="btn btn-secondary w-100" onclick="SearchData();"><i
                                            class="ri-search-line me-1 align-bottom"></i>
                                        Search
                                    </button>
                                </div>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </form>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-card mb-1">
                        <table class="table table-bordered table-nowrap align-middle">
                            <thead class="text-muted table-light">
                            <tr class="text-uppercase">
                                <th scope="col">SL</th>
                                <th scope="col">User ID</th>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Visa Type</th>
                                <th scope="col">Total Service</th>
                                <th scope="col">Submitted Documents</th>
                                <th scope="col">Visa Status</th>
                                <th scope="col">Visa Fee (BDT)</th>
                                <th scope="col">Payment Status</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Created By</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody class="list">
                            @forelse($forms as $key=>$form)
                                <tr>
                                    <td class="fw-medium text-center">{{$key + $forms->firstItem()}}</td>
                                    <td class="text-center">
                                        #{{ $form->customer->unique_id }}
                                    </td>
                                    <td>
                                        {{ $form->customer->name }}
                                    </td>
                                    <td>
                                        {{ Str::ucfirst($form?->visaType?->title) }}</td>
                                    <td>
                                        {{ Str::ucfirst($form?->visaType?->title) }}
                                    </td>
                                    <td>
                                        @if(count($form->documents) > 0)
                                            <a href="{{ route('admin.documents.show', ['id' => $form->id]) }}">
                                                View Submitted Documents
                                            </a>
                                        @else
                                            No documents submitted.
                                        @endif
                                    </td>
                                    <td>
                                        {!! displayVisaStatusBadge($form->visa_status) !!}
                                    </td>
                                    <td>
                                        {{ $form->invoice->amount ?? "-" }}
                                    </td>
                                    <td>
                                        {!! displayPaymentStatusBadge($form->payment_status) !!}
                                    </td>
                                    <td>{{ $form->created_at->format('d M Y') }}</td>
                                    <td>{{ Str::ucfirst($form->created_by) }}</td>
                                    <td>
                                        <div class="hstack gap-3 fs-15">
                                            <a href="{{ route('admin.visa-forms.invoice',$form->id) }}"
                                               class="btn btn-soft-dark waves-effect waves-light">
                                                <i class="ri-file-2-line align-bottom me-1"></i>
                                                Invoice
                                            </a>
                                            <a href="{{ route('admin.visa-forms.edit',$form->id) }}"
                                               class="btn btn-primary waves-effect waves-light">
                                                <i class="ri-pencil-line align-bottom me-1"></i>
                                                Edit
                                            </a>
                                            <button type="button"
                                                    class="btn btn-danger waves-effect waves-light"
                                                    onclick="deleteData({{ $form->id }})">
                                                <i class="ri-delete-bin-5-line align-bottom me-1"></i>
                                                Delete
                                            </button>
                                            <form id="delete-form-{{ $form->id }}"
                                                  action="{{ route('admin.visa-forms.destroy',$form->id) }}"
                                                  method="POST"
                                                  style="display: none;">
                                                @csrf()
                                                @method('DELETE')
                                            </form>
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
                {{ $forms->links('pagination.default') }}
            </div>
        </div>
    </div>
    </div>
@endsection

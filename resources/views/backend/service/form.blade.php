@extends('layouts.backend.master')

@section('title',  isset($service) ? 'Edit Service' : 'Create New Service')

@section('content')
    <div class="row">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">New Service</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">Dashboard</li>
                                <li class="breadcrumb-item">Services</li>
                                <li class="breadcrumb-item active">{{ isset($service) ? 'Edit ' : 'Create New' }}
                                    Service
                                </li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">{{ isset($service) ? 'Edit' : 'Create New' }}
                                Service</h4>
                            <div class="flex-shrink-0">
                                <div>
                                    <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">
                                        <i class="ri-arrow-left-line align-bottom me-1"></i>
                                        Back to list
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form id="visa-form"
                                  action="{{ isset($service) ? route('admin.services.update', $service->id) : route('admin.services.store') }}"
                                  method="POST">
                                @csrf
                                @if (isset($service))
                                    @method('PUT')
                                @endif
                                <div class="mb-3">
                                    <label for="title" class="form-label">Service Name</label>
                                    <input type="text" id="title"
                                           class="form-control mb-3 @error('title') is-invalid @enderror"
                                           name="title" value="{{ $service->title ?? old('title') }}">

                                    @error('title')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="agent_amount" class="form-label">Agent Amount</label>
                                    <input type="number" id="agent_amount"
                                           class="form-control mb-3 @error('agent_amount') is-invalid @enderror"
                                           name="agent_amount"
                                           value="{{ $service->agent_amount ?? old('agent_amount') }}">

                                    @error('agent_amount')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="customer_amount" class="form-label">Customer Amount</label>
                                    <input type="number" id="customer_amount"
                                           class="form-control mb-3 @error('customer_amount') is-invalid @enderror"
                                           name="customer_amount"
                                           value="{{ $service->customer_amount ?? old('customer_amount') }}">

                                    @error('customer_amount')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>
                                <div class="mt-3">
                                    <button type="button" class="btn btn-danger" onClick="resetForm('visa-form')">
                                        <i class="fas fa-redo"></i>
                                        <span>Reset</span>
                                    </button>
                                    @isset($service)
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


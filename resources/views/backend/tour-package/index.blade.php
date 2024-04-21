@extends('layouts.backend.master')

@section('title', 'Tour Package Configuration')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Tour Package</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item active">Tour Package</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    @can(\App\Permissions::EDIT_TOUR_PACKAGE, \App\Permissions::CREATE_TOUR_PACKAGE)
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">{{ isset($tourPackage) ? 'Edit' : 'Create' }} a
                            package</h4>
                    </div>
                    <div class="card-body">
                        <form
                            action="{{ isset($tourPackage) ? route('admin.tour-packages.update', $tourPackage->id) : route('admin.tour-packages.store') }}"
                            method="POST">
                            @csrf
                            @if (isset($tourPackage))
                                @method('PUT')
                            @endif
                            <div class="row g-3">
                                <div class="col-lg-4">
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                               name="name" id="packageName"
                                               placeholder="Enter a package name"
                                               value="{{ $tourPackage->name ?? old('name') }}" required>
                                        <label for="packageName">Package Name</label>

                                        @error('name')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-floating">
                                        <input type="text"
                                               class="form-control @error('place_name') is-invalid @enderror"
                                               id="nameOfPlace"
                                               name="place_name" placeholder="Enter the name of place"
                                               value="{{ $tourPackage->place_name ?? old('place_name') }}" required>
                                        <label for="nameOfPlace">Name of Place</label>

                                        @error('place_name')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-floating">
                                        <input type="date" id="journeyDate"
                                               class="form-control @error('journey_date') is-invalid @enderror"
                                               min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                               name="journey_date" placeholder="Enter your journey date"
                                               value="{{ $tourPackage->journey_date ?? old('journey_date') }}" required>
                                        <label for="journeyDate">Journey Date</label>

                                        @error('journey_date')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    @isset($tourPackage)
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-success">Update</button>
                                        </div>
                                    @else
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-success">Create</button>
                                        </div>
                                    @endisset
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">All Tour Packages</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-card mb-1">
                        <table class="table table-borderless table-nowrap align-middle">
                            <thead class="text-muted table-light">
                            <tr class="text-uppercase">
                                <th scope="col">SL</th>
                                <th scope="col">Package Name</th>
                                <th scope="col">Name of Place</th>
                                <th scope="col">Journey Date</th>
                                @can(\App\Permissions::EDIT_TOUR_PACKAGE, \App\Permissions::DELETE_TOUR_PACKAGE)
                                    <th scope="col">Actions</th>
                                @endcan
                            </tr>
                            </thead>
                            <tbody class="list">
                            @forelse($packages as $key=>$package)
                                <tr>
                                    <td class="fw-medium">
                                        {{$key + $packages->firstItem()}}
                                    </td>
                                    <td>
                                        {{ $package->name }}
                                    </td>
                                    <td>
                                        {{ $package->place_name }}
                                    </td>
                                    <td>
                                        {{ date('d M Y', strtotime($package->journey_date)) }}
                                    </td>
                                    <td>
                                        <div class="hstack gap-3 fs-15">
                                            @can(\App\Permissions::EDIT_TOUR_PACKAGE)
                                                <a href="{{ route('admin.tour-packages.edit',$package->id) }}"
                                                   class="btn btn-primary waves-effect waves-light">
                                                    <i class="ri-pencil-line align-bottom me-1"></i>
                                                    Edit
                                                </a>
                                            @endcan
                                            @can(\App\Permissions::DELETE_TOUR_PACKAGE)
                                                <button type="button"
                                                        class="btn btn-danger waves-effect waves-light"
                                                        onclick="deleteData({{ $package->id }})">
                                                    <i class="ri-delete-bin-5-line align-bottom me-1"></i>
                                                    Delete
                                                </button>
                                                <form id="delete-form-{{ $package->id }}"
                                                      action="{{ route('admin.tour-packages.destroy', $package->id) }}"
                                                      method="POST"
                                                      style="display: none;">
                                                    @csrf()
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
                {{ $packages->links('pagination.default') }}
            </div>
        </div>
    </div>
@endsection

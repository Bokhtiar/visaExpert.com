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

@extends('layouts.backend.master')

@section('title', 'All Customers')

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
@endpush
@section('content')
    <div class="row">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">All Customers</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Customers</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">All Customer</h4>


                                    <!-- create new cusmer offline mood -->
                                    @hasPermission('Create Customer')
                                        <a href="{{ route('admin.customers.offline') }}" class="btn btn-success">
                                            Create New Customer (Offline mood)
                                        </a>
                                    @endhasPermission



                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example" class="table table-borderless align-middle mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th scope="col">SL</th>
                                                    <th scope="col">ID Number</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Whatsapp</th>
                                                    <th scope="col">Phone Number</th>
                                                    <th scope="col">Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($customers as $key=>$customer)
                                                    <tr>
                                                        <td class="fw-medium text-center">{{ $key + 1 }}</td>
                                                        <th scope="col">{{ $customer->id }}</th>

                                                        <td>{{ $customer->name }}</td>

                                                        <td>
                                                            <a href="https://wa.me/+88{{ $customer->phone }}">
                                                                <img height="40" width="40"
                                                                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTs0OQohCvwwikklzYqaMr7EGNYjw5bawOZcKbEGk1n-A&s"
                                                                    alt="">
                                                            </a>
                                                        </td>
                                                        <td><a href="tel:{{ $customer->phone }}">{{ $customer->phone }}</a>
                                                        </td>
                                                        <td>
                                                            @hasPermission('Edit Customer')
                                                                @can(\App\Permissions::VIEW_CUSTOMER)
                                                                    <a href="{{ route('admin.customers.show', $customer->id) }}"
                                                                        class="btn btn-sm btn-clr-red waves-effect waves-light">
                                                                        <i class="ri-eye-2-line align-bottom me-1"></i>
                                                                        {{-- View Profile --}}
                                                                    </a>
                                                                @endcan
                                                            @endhasPermission
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
                                {{-- {{ $customers->links('pagination.default') }} --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>

    <script src="{{ asset('backend/assets/js/pages/datatables.init.js') }}"></script>

    <script>
        $(document).ready(function() {
            var table = $('#example').DataTable();
            table.page.len(100).draw(); // Set the default pagination limit to 100
        });
    </script>





    {{-- 
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <script>
        $(document).ready(function() {
            @foreach ($customers as $customer)
                $('#saveChangesBtn{{ $customer->id }}').click(function() {
                    var customerId = $(this).data('customer-id');
                    var formData = $('#updateStatusForm' + customerId).serialize(); // Serialize form data

                    $.ajax({
                        url: "{{ route('admin.update.visa.status', $customer->id) }}",
                        type: 'POST',
                        data: formData,
                        success: function(response) {
                            // Update the visa status badge in real-time
                            $('#visaStatusBadge' + customerId).html(response
                                .statusBadge); // Update the badge

                            // Change the "Update Status" button text to indicate success
                            $('#saveChangesBtn' + customerId).text(
                                'Status Updated'); // Change button text

                            // Optionally, disable the button to prevent further clicks
                            $('#saveChangesBtn' + customerId).prop('disabled', true);

                            // Close the modal
                            $('#exampleModal' + customerId).modal('hide');
                        },
                        error: function(xhr) {
                            alert('An error occurred. Please try again.');
                        }
                    });
                });
            @endforeach
        });
    </script>
@endpush

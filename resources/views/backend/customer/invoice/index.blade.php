@extends('layouts.backend.master')

@section('title', 'Customer Invoice')
@section('content')
    <div class="row">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Customer Invoice</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Customer Invoice</li>
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
                                    <h4 class="card-title mb-0 flex-grow-1">All Customer Invoice</h4>
                                </div> 
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example" class="table table-borderless align-middle mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <td>Customer</td>
                                                    <th>Invoice Number</th>
                                                    <th>Payment Status</th>
                                                    <th>Total Amount</th>
                                                    <th>Discount</th>
                                                    <th>Created by</th>
                                                    <th>Created Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- {{dd($leaves)}} --}}
                                                @forelse($invoices as $invoice)
                                                    {{-- {{dd($leave)}} --}}
                                                    <tr>
                                                        <td>
                                                            {{ $invoice->customer ? $invoice->customer->name . ' (ID: ' . $invoice->customer->id . ')' : '' }}
                                                        </td>

                                                        <td>{{ $invoice->invoice_number }}</td>
                                                        <td>
                                                            @if ($invoice->status == 'Paid')
                                                                <span
                                                                    class="bg-success btn btn-sm">{{ $invoice->status }}</span>
                                                            @else
                                                                <span
                                                                    class="bg-danger btn btn-sm">{{ $invoice->status }}</span>
                                                            @endif
                                                        </td>
                                                        <td>Tk {{ $invoice->total_amount }}</td>
                                                        <td>{{ $invoice->discount }}</td>
                                                        <td>{{ $invoice->user->name }}</td>
                                                        <td>{{ $invoice->created_at }}</td>
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
@endpush

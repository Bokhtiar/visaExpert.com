@extends('layouts.backend.master')

@section('title', 'Dashboard')

@section('css')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection


@section('content')
    <div class="row">
        <div class="col">
            <div class="h-100">
                <div class="row mb-3 pb-1">
                    <div class="col-12">
                        <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                            <div class="flex-grow-1">
                                <h4 class="fs-16 mb-1">Good Morning, @role('admin')
                                        Admin!
                                        @endrole @role('staff')
                                        Staff!
                                        @endrole @role('agent')
                                        Agent!
                                    @endrole
                                </h4>
                                <p class="text-muted mb-0">
                                    Wish you a wonderful day ahead.
                                </p>
                            </div>

                            {{-- attendance  --}}
                            <div class="mx-2">
                                {{-- <p>
                                    @if (Auth::user()->duty_time_start)
                                        <span class="font-bold bg-success text-white rounded mx-2">Duty Start Time: {{ Auth::user()->duty_time_start }}</span>
                                    @endif

                                    @if (Auth::user()->duty_time_end)
                                        <span class="bg-danger text-white px-2 rounded">Duty End Time: {{ Auth::user()->duty_time_end }}</span>
                                    @endif
                                </p> --}}

                                @if ($dashboardData['attendance'])
                                    <a href="#" class="font-bold bg-success text-white p-2 rounded mx-2"
                                        style="pointer-events: none; opacity: 0.5;">
                                        Punch In
                                        ({{ $dashboardData['attendance']->punch_in ? \Carbon\Carbon::parse($dashboardData['attendance']->punch_in)->format('g:i A') : '' }})
                                    </a>

                                    <a href="{{ url('admin/attendance/punch-out') }}"
                                        class="bg-danger text-white p-2 rounded">
                                        Punch Out
                                        ({{ $dashboardData['attendance']->punch_out ? \Carbon\Carbon::parse($dashboardData['attendance']->punch_out)->format('g:i A') : '' }})
                                    </a>
                                @else
                                    <a href="{{ url('admin/attendance/punch-in') }}"
                                        class="font-bold bg-success text-white p-2 rounded">
                                        Punch In
                                    </a>
                                @endif
                            </div>




                            @can(\App\Permissions::ACCESS_ACTIVITY_LOGS)
                                <div class="mt-3 mt-lg-0">
                                    <form action="javascript:void(0);">
                                        <div class="row g-3 mb-0 align-items-center">
                                            <div class="col-auto">
                                                <button type="button"
                                                    class="btn btn-soft-secondary btn-icon waves-effect waves-light layout-rightside-btn">
                                                    <i class="ri-pulse-line"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            @endcan
                        </div>
                    </div>
                </div>
                {{-- {{ dd($dashboardData['total_earnings']) }} --}}

                <div class="row">
                    @hasPermission('Dashboard Total Eearning')
                        <div class="col-xl-3 col-md-6">
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                                Total Earnings
                                            </p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-end justify-content-between mt-4">
                                        <div>
                                            <h4 class="fs-22 fw-semibold ff-secondary mb-4">

                                                <span class="counter-value"
                                                    data-target="{{ $dashboardData['total_earnings'] }}">0</span> BDT

                                            </h4>
                                        </div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-primary-subtle rounded fs-3">
                                                <i class="bx bx-dollar-circle text-primary"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endhasPermission

                    <div class="col-xl-3 col-md-6">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                            Total Spending
                                        </p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                            <span class="counter-value"
                                                data-target="{{ $dashboardData['total_spending'] }}">0</span> BDT
                                        </h4>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-primary-subtle rounded fs-3">
                                            <i class="bx bx-dollar-circle text-primary"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                            Application Forms
                                        </p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                            <span class="counter-value"
                                                data-target="{{ $dashboardData['total_forms'] }}">0</span>
                                        </h4>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-primary-subtle rounded fs-3">
                                            <i class="bx bxs-file text-primary"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                            Total Customers
                                        </p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                            <span class="counter-value"
                                                data-target="{{ $dashboardData['total_customers'] }}">0</span>
                                        </h4>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-primary-subtle rounded fs-3">
                                            <i class="bx bx-user-circle text-primary"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                            Services
                                        </p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                            <span class="counter-value"
                                                data-target="{{ $dashboardData['total_services'] }}">0</span>
                                        </h4>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-primary-subtle rounded fs-3">
                                            <i class="bx bx-user-circle text-primary"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- monthly_client --}}
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                            Current Month Client
                                        </p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                            <span class="counter-value"
                                                data-target="{{ $dashboardData['monthly_client'] }}">0</span>
                                        </h4>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-primary-subtle rounded fs-3">
                                            <i class="bx bx-user-circle text-primary"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- monthly_bills --}}
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                            Current Month Bills
                                        </p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                            <span class="counter-value"
                                                data-target="{{ $dashboardData['monthly_bills'] }}">0</span>
                                        </h4>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-primary-subtle rounded fs-3">
                                            <i class="bx bx-user-circle text-primary"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- current_month_collected_bill --}}
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                            Current Month Collected Bill
                                        </p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                            <span class="counter-value"
                                                data-target="{{ $dashboardData['current_month_collected_bill'] }}">0</span>
                                        </h4>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-primary-subtle rounded fs-3">
                                            <i class="bx bx-user-circle text-primary"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- current_month_due_bill --}}
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                            Current Month Due Bill
                                        </p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                            <span class="counter-value"
                                                data-target="{{ $dashboardData['current_month_due_bill'] }}">0</span>
                                        </h4>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-primary-subtle rounded fs-3">
                                            <i class="bx bx-user-circle text-primary"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- monthly_discount --}}
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                            Current Month Discount
                                        </p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                            <span class="counter-value"
                                                data-target="{{ $dashboardData['monthly_discount'] }}">0</span>
                                        </h4>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-primary-subtle rounded fs-3">
                                            <i class="bx bx-user-circle text-primary"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        @can(\App\Permissions::ACCESS_ACTIVITY_LOGS)
            <div class="col-auto layout-rightside-col">
                <div class="overlay"></div>
                <div class="layout-rightside">
                    <div class="card rounded-0">
                        <div class="card-body p-0">
                            <div class="p-3">
                                <h6 class="text-muted mb-0 text-uppercase fw-semibold">
                                    Recent Activity
                                </h6>
                            </div>
                            <div data-simplebar style="height: 100%" class="p-3 pt-0">
                                <div class="acitivity-timeline acitivity-main">
                                    @forelse($notifications as $notification)
                                        <div class="acitivity-item d-flex">
                                            <div class="flex-shrink-0 avatar-xs acitivity-avatar">
                                                <div class="avatar-title bg-primary-subtle text-primary rounded-circle">
                                                    <i class="bx bx-badge-check"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-1">{{ Str::ucFirst($notification->action_type) }}
                                                    by {{ $notification->user->name }}</h6>
                                                <p class="text-muted mb-1">
                                                    {{ $notification->content }}
                                                </p>
                                                <small class="mb-0 text-muted">
                                                    {{ $notification->formatted_created_at }}
                                                </small>
                                            </div>
                                        </div>
                                    @empty
                                        <p>No New Notification.</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endcan

        <section class="container py-4">
            <div class="row">
                <div class="col-12 col-md-6 d-flex justify-content-center mb-4">
                    <canvas id="barChart" style="max-width:100%; height: 330px"></canvas>
                </div>
                <div class="col-12 col-md-6 d-flex justify-content-center mb-4">
                    <canvas id="newCustomerBarChart" style="max-width:100%; height: 330px"></canvas>
                </div>
            </div>
        </section>


        {{-- invoice list --}}
        <section class="">
            <h5>Invoice List By Today</h5>
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
                                    <span class="bg-success btn btn-sm">{{ $invoice->status }}</span>
                                @else
                                    <span class="bg-danger btn btn-sm">{{ $invoice->status }}</span>
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
        </section>


        {{-- bar chant --}}

    </div>
    @section('js')
        {{-- <script>
            var ctx = document.getElementById('barChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($barChartData['labels']),
                    datasets: [{
                        label: 'Monthly New Customers',
                        data: @json($barChartData['data']),
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script> --}}

        {{-- new customer per month --}}
        <script>
            var ctx = document.getElementById('barChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($barChartData['labels']),
                    datasets: [{
                        label: 'Monthly New Customers',
                        data: @json($barChartData['data']),
                        backgroundColor: @json($barChartData['colors']), // Use different colors
                        borderColor: @json($barChartData['colors']), // Border colors match bars
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>


        {{-- <script>
            var ctx = document.getElementById('newCustomerBarChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($newCustomerChartData['monthLabels']),
                    datasets: [{
                        label: 'New Customers Per Month',
                        data: @json($newCustomerChartData['newCustomerData']),
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script> --}}
        <script>
            // Function to generate different colors for each month
            function generateColorPalette(count) {
                let colors = [];
                let borderColors = [];
                const predefinedColors = [
                    'rgba(255, 99, 132, 0.6)', // Red
                    'rgba(54, 162, 235, 0.6)', // Blue
                    'rgba(255, 206, 86, 0.6)', // Yellow
                    'rgba(75, 192, 192, 0.6)', // Green
                    'rgba(153, 102, 255, 0.6)', // Purple
                    'rgba(255, 159, 64, 0.6)' // Orange
                ];

                for (let i = 0; i < count; i++) {
                    colors.push(predefinedColors[i % predefinedColors.length]); // Cycle through colors
                    borderColors.push(colors[i].replace('0.6', '1')); // Make border fully opaque
                }

                return {
                    backgroundColors: colors,
                    borderColors: borderColors
                };
            }

            var labels = @json($newCustomerChartData['monthLabels']);
            var dataValues = @json($newCustomerChartData['newCustomerData']);

            // Generate color palette for 6 months
            var {
                backgroundColors,
                borderColors
            } = generateColorPalette(dataValues.length);

            var ctx = document.getElementById('newCustomerBarChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Company Performance (Active Customer)',
                        data: dataValues,
                        backgroundColor: backgroundColors, // Assign different colors
                        borderColor: borderColors, // Border color for each bar
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>

    @endsection

@endsection

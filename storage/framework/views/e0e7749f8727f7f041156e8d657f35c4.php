<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('css'); ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col">
            <div class="h-100">
                <div class="row mb-3 pb-1">
                    <div class="col-12">
                        <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                            <div class="flex-grow-1">
                                <h4 class="fs-16 mb-1">Good Morning, <?php if (\Illuminate\Support\Facades\Blade::check('role', 'admin')): ?>
                                        Admin!
                                        <?php endif; ?> <?php if (\Illuminate\Support\Facades\Blade::check('role', 'staff')): ?>
                                        Staff!
                                        <?php endif; ?> <?php if (\Illuminate\Support\Facades\Blade::check('role', 'agent')): ?>
                                        Agent!
                                    <?php endif; ?>
                                </h4>
                                <p class="text-muted mb-0">
                                    Wish you a wonderful day ahead.
                                </p>
                            </div>

                            
                            <div class="mx-2">
                                

                                <?php if($dashboardData['attendance']): ?>
                                    <a href="#" class="font-bold bg-success text-white p-2 rounded mx-2"
                                        style="pointer-events: none; opacity: 0.5;">
                                        Punch In
                                        (<?php echo e($dashboardData['attendance']->punch_in ? \Carbon\Carbon::parse($dashboardData['attendance']->punch_in)->format('g:i A') : ''); ?>)
                                    </a>

                                    <a href="<?php echo e(url('admin/attendance/punch-out')); ?>"
                                        class="bg-danger text-white p-2 rounded">
                                        Punch Out
                                        (<?php echo e($dashboardData['attendance']->punch_out ? \Carbon\Carbon::parse($dashboardData['attendance']->punch_out)->format('g:i A') : ''); ?>)
                                    </a>
                                <?php else: ?>
                                    <a href="<?php echo e(url('admin/attendance/punch-in')); ?>"
                                        class="font-bold bg-success text-white p-2 rounded">
                                        Punch In
                                    </a>
                                <?php endif; ?>
                            </div>




                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check(\App\Permissions::ACCESS_ACTIVITY_LOGS)): ?>
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
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                

                <div class="row">
                    <?php if (\Illuminate\Support\Facades\Blade::check('hasPermission', 'Dashboard Total Eearning')): ?>
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
                                                    data-target="<?php echo e($dashboardData['total_earnings']); ?>">0</span> BDT

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
                    <?php endif; ?>

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
                                                data-target="<?php echo e($dashboardData['total_spending']); ?>">0</span> BDT
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
                                                data-target="<?php echo e($dashboardData['total_forms']); ?>">0</span>
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
                                                data-target="<?php echo e($dashboardData['total_customers']); ?>">0</span>
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
                                                data-target="<?php echo e($dashboardData['total_services']); ?>">0</span>
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
                                            Current Month Client
                                        </p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                            <span class="counter-value"
                                                data-target="<?php echo e($dashboardData['monthly_client']); ?>">0</span>
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
                                            Current Month Bills
                                        </p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                            <span class="counter-value"
                                                data-target="<?php echo e($dashboardData['monthly_bills']); ?>">0</span>
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
                                            Current Month Collected Bill
                                        </p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                            <span class="counter-value"
                                                data-target="<?php echo e($dashboardData['current_month_collected_bill']); ?>">0</span>
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
                                            Current Month Due Bill
                                        </p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                            <span class="counter-value"
                                                data-target="<?php echo e($dashboardData['current_month_due_bill']); ?>">0</span>
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
                                            Current Month Discount
                                        </p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                            <span class="counter-value"
                                                data-target="<?php echo e($dashboardData['monthly_discount']); ?>">0</span>
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
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check(\App\Permissions::ACCESS_ACTIVITY_LOGS)): ?>
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
                                    <?php $__empty_1 = true; $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <div class="acitivity-item d-flex">
                                            <div class="flex-shrink-0 avatar-xs acitivity-avatar">
                                                <div class="avatar-title bg-primary-subtle text-primary rounded-circle">
                                                    <i class="bx bx-badge-check"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-1"><?php echo e(Str::ucFirst($notification->action_type)); ?>

                                                    by <?php echo e($notification->user->name); ?></h6>
                                                <p class="text-muted mb-1">
                                                    <?php echo e($notification->content); ?>

                                                </p>
                                                <small class="mb-0 text-muted">
                                                    <?php echo e($notification->formatted_created_at); ?>

                                                </small>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <p>No New Notification.</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

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

                
                <?php $__empty_1 = true; $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    
                    <tr>
                        <td>
                            <?php echo e($invoice->customer ? $invoice->customer->name . ' (ID: ' . $invoice->customer->id . ')' : ''); ?>

                        </td>

                        <td><?php echo e($invoice->invoice_number); ?></td>
                        <td>
                            <?php if($invoice->status == 'Paid'): ?>
                                <span class="bg-success btn btn-sm"><?php echo e($invoice->status); ?></span>
                            <?php else: ?>
                                <span class="bg-danger btn btn-sm"><?php echo e($invoice->status); ?></span>
                            <?php endif; ?>
                        </td>
                        <td>Tk <?php echo e($invoice->total_amount); ?></td>
                        <td><?php echo e($invoice->discount); ?></td>
                        <td><?php echo e($invoice->user->name); ?></td>
                        <td><?php echo e($invoice->created_at); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td>No record Found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
            </section>


        

    </div>
    <?php $__env->startSection('js'); ?>
        <script>
            var ctx = document.getElementById('barChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: <?php echo json_encode($barChartData['labels'], 15, 512) ?>,
                    datasets: [{
                        label: 'Monthly New Customers',
                        data: <?php echo json_encode($barChartData['data'], 15, 512) ?>,
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
        </script>

        <script>
            var ctx = document.getElementById('newCustomerBarChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: <?php echo json_encode($newCustomerChartData['monthLabels'], 15, 512) ?>,
                    datasets: [{
                        label: 'New Customers Per Month',
                        data: <?php echo json_encode($newCustomerChartData['newCustomerData'], 15, 512) ?>,
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
        </script>
    <?php $__env->stopSection(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.backend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/bokhtiartoshar/Desktop/Project/Sajon Bhai/visaExpert.com-master/resources/views/backend/dashboard.blade.php ENDPATH**/ ?>
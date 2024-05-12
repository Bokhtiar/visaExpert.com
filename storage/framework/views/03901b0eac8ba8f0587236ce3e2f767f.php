<?php $__env->startSection('title', 'Customers'); ?>

<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Customers</h4>
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
                                    <a href="<?php echo e(route('admin.customers.offline')); ?>" class="btn btn-success">
                                        Create New Customer (Offline mood)
                                    </a>



                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example" class="table table-borderless align-middle mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th scope="col">SL</th>
                                                    <th scope="col">User ID</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Owner</th>
                                                    <th scope="col">Work Status</th>
                                                    <th scope="col">Whatsapp</th>
                                                    <th scope="col">Phone Number</th>
                                                    <th scope="col">Payment Status</th>
                                                    <th scope="col">Search Active</th>
                                                    <th scope="col">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $__empty_1 = true; $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                    <tr>
                                                        <td class="fw-medium text-center"><?php echo e($key + 1); ?></td>


                                                        <td>#<?php echo e($customer->unique_id); ?></td>
                                                        <td><?php echo e($customer->name . '(' . App\Models\Customer::countChaild($customer->id) . ')'); ?>

                                                        </td>
                                                        <td><?php echo e($customer->customer ? $customer->customer->name : ''); ?></td>
                                                        <td><?php echo e(App\Models\VisaForm::customerListStatus($customer->id)); ?>

                                                        </td>
                                                        <td>
                                                            <a href="https://wa.me/+88<?php echo e($customer->phone); ?>">
                                                                <img height="40" width="40"
                                                                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTs0OQohCvwwikklzYqaMr7EGNYjw5bawOZcKbEGk1n-A&s"
                                                                    alt="">
                                                            </a>
                                                        </td>
                                                        <td><a href="tel:<?php echo e($customer->phone); ?>"><?php echo e($customer->phone); ?></a>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $invoice = App\Models\Invoice::where(
                                                                    'customer_id',
                                                                    $customer->id,
                                                                )
                                                                    ->latest()
                                                                    ->first();

                                                            ?>

                                                            <?php if($invoice): ?>
                                                                <?php
                                                                    $discount = App\Models\PaymentLog::where(
                                                                        'invoice_id',
                                                                        $invoice->id,
                                                                    )
                                                                        ->where('due', $invoice->discount)
                                                                        ->first();
                                                                ?>
                                                                <?php if($discount): ?>
                                                                    <a
                                                                        href="<?php echo e(route('admin.customers-invoices.show', $invoice->id)); ?>"><span
                                                                            class="btn btn-success btn-sm">Paid</span></a>
                                                                <?php else: ?>
                                                                    <?php if($invoice->status == 'Paid'): ?>
                                                                        <a
                                                                            href="<?php echo e(route('admin.customers-invoices.show', $invoice->id)); ?>"><span
                                                                                class="btn btn-success btn-sm">Paid</span></a>
                                                                    <?php elseif($invoice->status == 'Due'): ?>
                                                                        <a class="btn btn-info btn-sm"
                                                                            href="<?php echo e(route('admin.customers-invoices.edit', $invoice->id)); ?>">
                                                                            Pay
                                                                        </a>
                                                                        <span class="">
                                                                            <a class="btn btn-danger btn-sm"
                                                                                href="<?php echo e(route('admin.customers-invoices.show', $invoice->id)); ?>">
                                                                                Due
                                                                            </a>

                                                                        </span>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>
                                                            <?php else: ?>
                                                                <span class="">Paynment not initiat</span>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <?php if($customer->search_active == 1): ?>
                                                                <a class=""
                                                                    href="<?php echo e(route('admin.customers.search-active', $customer->id)); ?>">
                                                                    <img src="<?php echo e(asset('backend/assets/images/active.png')); ?>"
                                                                        height="30px" alt="">
                                                                </a>
                                                            <?php else: ?>
                                                                <a class=""
                                                                    href="<?php echo e(route('admin.customers.search-active', $customer->id)); ?>">
                                                                    <img src="<?php echo e(asset('backend/assets/images/inactive.png')); ?>"
                                                                        height="30px" alt="">
                                                                </a>
                                                            <?php endif; ?>

                                                        </td>
                                                        <td>
                                                            <div class="hstack gap-3 fs-15">
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check(\App\Permissions::CREATE_CUSTOMER_INVOICE)): ?>
                                                                    <a href="<?php echo e(route('admin.customers-invoices.create', $customer->id)); ?>"
                                                                        class="btn btn-dark waves-effect waves-light">
                                                                        <i class="ri-file-add-line align-bottom me-1"></i>
                                                                        Create Invoice
                                                                    </a>
                                                                <?php endif; ?>
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check(\App\Permissions::VIEW_CUSTOMER)): ?>
                                                                    <a href="<?php echo e(route('admin.customers.show', $customer->id)); ?>"
                                                                        class="btn btn-clr-red waves-effect waves-light">
                                                                        <i class="ri-eye-2-line align-bottom me-1"></i>
                                                                        View Profile
                                                                    </a>
                                                                <?php endif; ?>
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check(\App\Permissions::DELETE_CUSTOMER)): ?>
                                                                    <button type="button"
                                                                        class="btn btn-soft-success waves-effect waves-light"
                                                                        onclick="deleteData(<?php echo e($customer->id); ?>)">
                                                                        <i class="ri-delete-bin-5-line align-bottom me-1"></i>
                                                                        Delete Customer
                                                                    </button>
                                                                    <form id="delete-form-<?php echo e($customer->id); ?>"
                                                                        action="<?php echo e(route('admin.customers.destroy', $customer->id)); ?>"
                                                                        method="POST" style="display: none;">
                                                                        <?php echo csrf_field(); ?>
                                                                        <?php echo method_field('DELETE'); ?>
                                                                    </form>
                                                                <?php endif; ?>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                    <tr>
                                                        <td>No record Found.</td>
                                                    </tr>
                                                <?php endif; ?>
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
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>

    <script src="<?php echo e(asset('backend/assets/js/pages/datatables.init.js')); ?>"></script>

    <script>
        $(document).ready(function() {
            var table = $('#example').DataTable();
            table.page.len(100).draw(); // Set the default pagination limit to 100
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.backend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\visa\resources\views/backend/customer/index.blade.php ENDPATH**/ ?>
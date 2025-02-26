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
                                    <?php if (\Illuminate\Support\Facades\Blade::check('hasPermission', 'Create Customer')): ?>
                                        <a href="<?php echo e(route('admin.customers.offline')); ?>" class="btn btn-success">
                                            Create New Customer (Offline mood)
                                        </a>
                                    <?php endif; ?>



                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example" class="table table-borderless align-middle mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th scope="col">SL</th>
                                                    <th scope="col">Name</th>
                                                    
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
                                                        <?php
                                                            $childData = App\Models\Customer::countChaild(
                                                                $customer->id,
                                                            );
                                                        ?>

                                                        <td><?php echo e($customer->name . ' (' . $childData['count'] . ')'); ?>

                                                            <?php if($childData['count'] > 0): ?>
                                                                <span style="font-size: 12px; color: gray;">
                                                                    (<?php echo e($childData['ids']->implode(', ')); ?>)
                                                                    <!-- Display the list of child IDs -->
                                                                </span>
                                                            <?php endif; ?>
                                                        </td>

                                                        




                                                        <td class="visa-status-badge"
                                                            id="visaStatusBadge<?php echo e($customer->id); ?>"
                                                            data-customer-id="<?php echo e($customer->id); ?>">
                                                            <?php echo displayVisaStatusBadge(App\Models\VisaForm::customerListStatus($customer->id)); ?>

                                                            <button type="button" class="btn btn-primary btn-sm"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#exampleModal<?php echo e($customer->id); ?>">
                                                                <i class="ri-pencil-line align-bottom me-1"></i>
                                                            </button>
                                                        </td>

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="exampleModal<?php echo e($customer->id); ?>"
                                                            tabindex="-1" aria-labelledby="exampleModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                                            Update Visa Status</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <!-- Dropdown to select status -->
                                                                        <form id="updateStatusForm<?php echo e($customer->id); ?>"
                                                                            action="<?php echo e(route('admin.update.visa.status', $customer->id)); ?>"
                                                                            method="POST">
                                                                            <?php echo csrf_field(); ?>
                                                                            <?php echo method_field('PUT'); ?>
                                                                            <div class="form-group">
                                                                                <label for="visa_status">Visa Status</label>
                                                                                <select class="form-control"
                                                                                    id="visa_status<?php echo e($customer->id); ?>"
                                                                                    name="visa_status">
                                                                                    <option value="Pending">Pending</option>
                                                                                    <option value="Processing">Processing
                                                                                    </option>
                                                                                    <option
                                                                                        value="Checking Completed almost Ready">
                                                                                        Checking</option>
                                                                                    <option value="Ready to Delivery">Ready
                                                                                        to Delivery</option>
                                                                                    <option value="Delivered">Delivered
                                                                                    </option>
                                                                                </select>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Close</button>
                                                                        <button type="button"
                                                                            id="saveChangesBtn<?php echo e($customer->id); ?>"
                                                                            class="btn btn-primary"
                                                                            data-customer-id="<?php echo e($customer->id); ?>">Save
                                                                            changes</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>




                                                        <td>
                                                            <a href="https://wa.me/+88<?php echo e($customer->phone); ?>">
                                                                <img height="40" width="40"
                                                                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTs0OQohCvwwikklzYqaMr7EGNYjw5bawOZcKbEGk1n-A&s"
                                                                    alt="">
                                                            </a>
                                                        </td>
                                                        <td><a
                                                                href="tel:<?php echo e($customer->phone); ?>"><?php echo e($customer->phone); ?></a>
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
                                                                            class="btn btn-success btn-sm">Paid
                                                                            <?php echo e(App\Models\PaymentLog::where('invoice_id', $invoice->id)->sum('pay')); ?>

                                                                        </span></a>
                                                                <?php else: ?>
                                                                    <?php if($invoice->status == 'Paid'): ?>
                                                                        <a class="btn btn-success btn-sm"
                                                                            href="<?php echo e(route('admin.customers-invoices.show', $invoice->id)); ?>"><span
                                                                                class="">Paid</span>
                                                                            <?php echo e(App\Models\PaymentLog::where('invoice_id', $invoice->id)->sum('pay')); ?>

                                                                        </a>
                                                                    <?php elseif($invoice->status == 'Due'): ?>
                                                                        <a class="btn btn-info btn-sm"
                                                                            href="<?php echo e(route('admin.customers-invoices.edit', $invoice->id)); ?>">
                                                                            Pay

                                                                        </a>


                                                                        <span class="">
                                                                            <a class="btn btn-danger btn-sm"
                                                                                href="<?php echo e(route('admin.customers-invoices.show', $invoice->id)); ?>">
                                                                                Due
                                                                                <?php echo e(App\Models\PaymentLog::where('invoice_id', $invoice->id)->latest()->value('due') - $invoice->discount); ?>

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
                                                                <?php if (\Illuminate\Support\Facades\Blade::check('hasPermission', 'Create Invoice')): ?>
                                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check(\App\Permissions::CREATE_CUSTOMER_INVOICE)): ?>
                                                                        <a href="<?php echo e(route('admin.customers-invoices.create', $customer->id)); ?>"
                                                                            class="btn btn-sm btn-dark waves-effect waves-light">
                                                                            <i class="ri-file-add-line align-bottom me-1"></i>
                                                                            
                                                                        </a>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>

                                                                <?php if (\Illuminate\Support\Facades\Blade::check('hasPermission', 'Edit Customer')): ?>
                                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check(\App\Permissions::VIEW_CUSTOMER)): ?>
                                                                        <a href="<?php echo e(route('admin.customers.show', $customer->id)); ?>"
                                                                            class="btn btn-sm btn-clr-red waves-effect waves-light">
                                                                            <i class="ri-eye-2-line align-bottom me-1"></i>
                                                                            
                                                                        </a>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>

                                                                <?php if (\Illuminate\Support\Facades\Blade::check('hasPermission', 'Delete Customer')): ?>
                                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check(\App\Permissions::DELETE_CUSTOMER)): ?>
                                                                        <button type="button"
                                                                            class="btn btn-sm btn-soft-success waves-effect waves-light"
                                                                            onclick="deleteData(<?php echo e($customer->id); ?>)">
                                                                            <i class="ri-delete-bin-5-line align-bottom me-1"></i>
                                                                            
                                                                        </button>
                                                                        <form id="delete-form-<?php echo e($customer->id); ?>"
                                                                            action="<?php echo e(route('admin.customers.destroy', $customer->id)); ?>"
                                                                            method="POST" style="display: none;">
                                                                            <?php echo csrf_field(); ?>
                                                                            <?php echo method_field('DELETE'); ?>
                                                                        </form>
                                                                    <?php endif; ?>
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





    
    <script>
        $(document).ready(function() {
            <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                $('#saveChangesBtn<?php echo e($customer->id); ?>').click(function() {
                    var customerId = $(this).data('customer-id');
                    var formData = $('#updateStatusForm' + customerId).serialize(); // Serialize form data

                    $.ajax({
                        url: "<?php echo e(route('admin.update.visa.status', $customer->id)); ?>",
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
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.backend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/bokhtiartoshar/Desktop/Project/Sajon Bhai/visaExpert.com-master/resources/views/backend/customer/index.blade.php ENDPATH**/ ?>
<?php $__env->startSection('title', 'Customer Invoice'); ?>
<?php $__env->startSection('content'); ?>
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

                                        <form action="<?php echo e(route('admin.customers-invoices.filter')); ?>" method="POST">

                                            <?php echo csrf_field(); ?>
                                            <div class="row mb-4">


                                                <div class="col-md-3">
                                                    <label for="date" class="form-label">Date</label>
                                                    <input type="date" name="date" id="date" class="form-control"
                                                        value="<?php echo e(@$date ? $date : now()->toDateString()); ?>">
                                                </div>


                                                
                                                <div class="col-md-3 d-flex align-items-end">
                                                    <button type="submit" class="btn btn-primary">Filter</button>
                                                </div>
                                                
                                            </div>
                                        </form>



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
                                                                <span
                                                                    class="bg-success btn btn-sm"><?php echo e($invoice->status); ?></span>
                                                            <?php else: ?>
                                                                <span
                                                                    class="bg-danger btn btn-sm"><?php echo e($invoice->status); ?></span>
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

<?php echo $__env->make('layouts.backend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/bokhtiartoshar/Desktop/Project/Sajon Bhai/visaExpert.com-master/resources/views/backend/customer/invoice/index.blade.php ENDPATH**/ ?>
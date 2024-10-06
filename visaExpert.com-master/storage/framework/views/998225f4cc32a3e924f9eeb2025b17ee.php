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
                                        <table class="table table-borderless align-middle mb-0">
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
                                                        <td><?php echo e($invoice->customer  ?$invoice->customer->name : ""); ?></td>
                                                        <td><?php echo e($invoice->invoice_number); ?></td>
                                                        <td>
                                                            <?php if($invoice->status == "Paid"): ?>
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

<?php echo $__env->make('layouts.backend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/bokhtiartoshar/Desktop/Project/Sajon Bhai/visxpert/visaExpert.com-master/resources/views/backend/customer/invoice/index.blade.php ENDPATH**/ ?>
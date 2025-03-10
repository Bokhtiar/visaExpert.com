<?php $__env->startSection('title', 'Transfer'); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Transfer</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item active">Transfer</li>
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
                                <h4 class="card-title mb-0 flex-grow-1">All Transfer</h4>

                                <div class="flex-shrink-0">
                                    <div>
                                        <?php if (\Illuminate\Support\Facades\Blade::check('hasPermission', 'Transfer Create')): ?>
                                        <a href="<?php echo e(route('admin.transfer.create')); ?>"
                                            class="btn btn-clr-red rounded-pill">
                                            Create transfer
                                        </a>
                                        <?php endif; ?>

                                    </div>
                                </div>

                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-borderless align-middle mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th scope="col">SL</th>
                                                <th scope="col">Date & Time</th>
                                                <th scope="col">Transfer</th>
                                                <th scope="col">Amount</th>
                                                <th scope="col">Status</th>
                                        </thead>
                                        <tbody>

                                            <?php $__empty_1 = true; $__currentLoopData = $transfers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$transfer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <tr>
                                                <td class="fw-medium"><?php echo e($key + 1); ?></td>
                                                <td><?php echo e($transfer->created_at); ?></td>
                                                <td><?php echo e($transfer->reciver ? $transfer->reciver->name : ''); ?></td>
                                                <td><?php echo e($transfer->amount); ?> Tk</td>
                                                <td><?php echo e($transfer->status); ?></td>
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
<?php echo $__env->make('layouts.backend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/bokhtiartoshar/Desktop/Project/Sajon Bhai/visaExpert.com-master/resources/views/backend/transfer/all_statement_list.blade.php ENDPATH**/ ?>
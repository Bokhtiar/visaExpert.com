<?php $__env->startSection('title', 'Search Result'); ?>
<?php $__env->startSection('content'); ?>
    <div class="section mt-5">
        <div class="bg-overlay bg-overlay-pattern"></div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">My Forms</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-borderless align-middle table-nowrap mb-0">
                                    <thead>
                                    <tr>
                                        <th scope="col">SL</th>
                                        <th scope="col">Customer ID</th>
                                        <th scope="col">Customer Name</th>
                                        <th scope="col">Visa Type</th>
                                        <th scope="col">Submitted Documents</th>
                                        <th scope="col">Visa Status</th>
                                        <th scope="col">Visa Fee (BDT)</th>
                                        <th scope="col">Payment Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $forms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$form): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            <td class="fw-medium text-center"><?php echo e($key + 1); ?></td>
                                            <td class="text-center">#<?php echo e($form->customer->unique_id); ?></td>
                                            <td>
                                                <?php echo e($form->customer->name); ?>

                                            </td>
                                            <td><?php echo e(Str::ucfirst($form->visaType->title)); ?></td>
                                            <td>
                                                <?php if(count($form->documents) > 0): ?>
                                                    <a href="<?php echo e(route('my-documents.show', ['id' => $form->id])); ?>">
                                                        View Submitted Documents
                                                    </a>
                                                <?php else: ?>
                                                    No documents submitted.
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php echo displayVisaStatusBadge($form->visa_status); ?>

                                            </td>
                                            <td>
                                                1234





                                            </td>
                                            <td>
                                                <?php echo displayPaymentStatusBadge($form->payment_status); ?>

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
                        <?php echo e($forms->links('pagination.default')); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/visatuey/visa.visaxpert.net/resources/views/frontend/search-result.blade.php ENDPATH**/ ?>
<?php $__env->startSection('title', 'My Documents'); ?>

<?php $__env->startSection('content'); ?>
    <div class="section">
        <div class="bg-overlay bg-overlay-pattern"></div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">My Documents</h4>
                            <div class="flex-shrink-0">
                                <div>
                                    <a href="<?php echo e(route('my-forms')); ?>" class="btn btn-secondary">
                                        <i class="ri-arrow-left-line align-bottom me-1"></i>
                                        Back to list
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-borderless align-middle table-nowrap mb-0">
                                    <thead>
                                    <tr>
                                        <th scope="col">SL</th>
                                        <th scope="col">Document Name</th>
                                        <th scope="col">Submitted Files</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            <td class="fw-medium text-center"><?php echo e($key + 1); ?></td>
                                            <td><?php echo e($document->title); ?></td>
                                            <?php if($document->document_type != 'pdf'): ?>
                                                <td>
                                                    <figure class="figure">
                                                        <img
                                                                src="<?php echo e(asset('uploads/visa-forms/documents/' . $document->documents)); ?>"
                                                                class="figure-img img-fluid rounded" alt="..."
                                                                width="200"
                                                                height="200">
                                                        <figcaption
                                                                class="figure-caption"><?php echo e($document->title); ?></figcaption>
                                                    </figure>
                                                </td>
                                            <?php else: ?>
                                                <td>
                                                    <a href="<?php echo e(asset('uploads/visa-forms/documents/' .$document->documents)); ?>"
                                                       target="_blank">
                                                        View PDF
                                                    </a>
                                                </td>
                                            <?php endif; ?>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/visatuey/visa.visaxpert.net/resources/views/frontend/customer/my-forms/documents.blade.php ENDPATH**/ ?>
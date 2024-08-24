<?php use \App\Enums\DocumentStatus as Status; ?>


<?php $__env->startSection('title', 'View Customer'); ?>

<?php $__env->startPush('css'); ?>
    <!-- glightbox css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

    <div class="container">
        <div class="row">
            <div class="col-xxl-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Visa Application Form</h4>
                    </div>
                    <div class="card-body">

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">SL</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Document</th>
                                    <th scope="col">View</th>
                                    <th scope="col">Upload</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <?php $__currentLoopData = json_decode($documents, true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $exist = App\Models\VisaForm::exitDocument($file, $customer_form_id);
                                    
                                ?>

                                <?php if($exist): ?>
                                    <form action="<?php echo e(route('admin.customers.single.document.update', $exist->id)); ?>"
                                        method="POST" enctype="multipart/form-data">
                                        <?php echo method_field('PUT'); ?>
                                    <?php else: ?>
                                        <form action="<?php echo e(route('admin.customers.single.document.store')); ?>" method="POST"
                                            enctype="multipart/form-data">
                                <?php endif; ?>

                                <?php echo csrf_field(); ?>
                                <tr>
                                    <th scope="row"><?php echo e($loop->index + 1); ?></th>
                                    <td>
                                        <?php echo e($exist ? $exist->title : $file); ?>

                                    </td>
                                    <td> <?php echo e($exist ? $exist->documents : ''); ?></td>

                                    <?php if($exist): ?>
                                        <?php if($exist->document_type != 'pdf'): ?>
                                            <td>
                                                <a class="image-popup"
                                                    href="<?php echo e(asset('uploads/visa-forms/documents/' . $exist->documents)); ?>"
                                                    title="<?php echo e($exist->title); ?>">
                                                    View
                                                </a>
                                            </td>
                                        <?php else: ?>
                                            <td>
                                                <a href="<?php echo e(asset('uploads/visa-forms/documents/' . $exist->documents)); ?>"
                                                    target="_blank">
                                                    View PDF
                                                </a>
                                            </td>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <td></td>
                                    <?php endif; ?>
                                    <td>
                                        <input type="file" name="doc" id="">
                                    </td>

                                    <input type="hidden" name="customer_form_id" value="<?php echo e($customer_form_id); ?>"
                                        id="">
                                    <input type="hidden" name="customer_id" value="<?php echo e($customer_id); ?>" id="">
                                    <input type="hidden" name="title" value="<?php echo e($file); ?>" id="">
                                    <td>
                                        <?php if($exist): ?>
                                            <input type="submit" name="" class="btn btn-success" value="update"
                                                id="">
                                        <?php else: ?>
                                            <input type="submit" name="" class="btn btn-info" value="submit"
                                                id="">
                                        <?php endif; ?>
                                    </td>
                                </tr>

                                </form>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.backend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\visa\resources\views/backend/customer/file-upload.blade.php ENDPATH**/ ?>
<?php $__env->startSection('title', 'Your Search Result'); ?>

<?php $__env->startPush('css'); ?>
    <!-- glightbox css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css"/>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="vertical-overlay" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent.show"></div>
    <!-- start hero section -->
    <section class="section mt-5 pb-0">
        <div class="container-fluid mb-2 px-0 overflow-x-hidden">
            <div class="row">
                <div>
                    <img src="<?php echo e(asset('backend/assets/images/home-bg.jpg')); ?>" alt="homepage-banner"
                         class="img-fluid w-100 h-100 object-fit-cover">
                </div>
            </div>
        </div>

        <div class="bg-overlay bg-overlay-pattern"></div>
        <div class="container">
            <div class="row">
                <div class="col-xxl-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Visa Application Form</h4>
                            <?php $__empty_1 = true; $__currentLoopData = $forms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$form): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <div class="page-title-right">
                                    <p> <span class="">Visa Status:</span> <span class="fw-semibold"><?php echo e($form->visa_status); ?></span></p>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <?php endif; ?>
                        </div>
                        <div class="card-body">
                            <p class="text-muted mb-4">
                                All the data you have submitted for your application are displaying below.
                            </p>

                            <?php $__sessionArgs = ['success'];
if (session()->has($__sessionArgs[0])) :
if (isset($value)) { $__sessionPrevious[] = $value; }
$value = session()->get($__sessionArgs[0]); ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong><?php echo e($value); ?></strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                            </div>
                            <?php unset($value);
if (isset($__sessionPrevious) && !empty($__sessionPrevious)) { $value = array_pop($__sessionPrevious); }
if (isset($__sessionPrevious) && empty($__sessionPrevious)) { unset($__sessionPrevious); }
endif;
unset($__sessionArgs); ?>

                            <?php $__empty_1 = true; $__currentLoopData = $forms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$form): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <div class="row mb-3">
                                    <div class="col-lg-3">
                                        <label for="visa_type_id" class="col-form-label">Visa Type<span
                                                class="text-danger">*</span> :</label>
                                    </div>
                                    <div class="col-lg-9">
                                        <input type="text"
                                               class="form-control form-control-lg mb-3"
                                               value="<?php echo e($form->visaType->title); ?>"
                                               readonly disabled
                                        >
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg-3">
                                        <label for="name" class="col-form-label">Name<span
                                                class="text-danger">*</span> :</label>
                                    </div>
                                    <div class="col-lg-9 custom-message">
                                        <input type="text"
                                               class="form-control form-control-lg mb-3"
                                               value="<?php echo e($form->customer->name); ?>"
                                               readonly disabled
                                        >
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg-3">
                                        <label for="phone" class="col-form-label">Contact Number<span
                                                class="text-danger">*</span> :</label>
                                    </div>
                                    <div class="col-lg-9 custom-message">
                                        <input type="number"
                                               class="form-control form-control-lg mb-3"
                                               value="<?php echo e($form->customer->phone); ?>"
                                               readonly disabled
                                        >
                                    </div>
                                </div>
                                <div class="row mt-5 mb-3">
                                    <div class="col-xxl-12">
                                        <div class="card">
                                            <div class="card-header align-items-center d-flex">
                                                <h4 class="card-title mb-0 flex-grow-1">Submitted Document
                                                    List</h4>
                                            </div>
                                            <div class="card-body">
                                                <p class="text-muted">
                                                    All the required documents are listed below. Please check this
                                                    out
                                                    before submitting
                                                    visa application form.
                                                </p>
                                                <?php if(count($form->documents) > 0): ?>
                                                    <div>
                                                        <div class="row mb-3">
                                                            <div class="table-responsive">
                                                                <table
                                                                    class="table table-striped align-middle table-nowrap mb-0">
                                                                    <thead>
                                                                    <tr>
                                                                        <th scope="col">Type</th>
                                                                        <th scope="col">File</th>
                                                                        <th scope="col">Status</th>
                                                                        <?php
                                                                            $showResubmitFileColumn = false;
                                                                            $resubmitFormDisplayed = false;
                                                                        ?>
                                                                        <?php $__currentLoopData = $form->documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <?php if($document->status === \App\Enums\DocumentStatus::REJECTED->toString()): ?>
                                                                                <?php
                                                                                    $showResubmitFileColumn = true;
                                                                                    break;
                                                                                ?>
                                                                            <?php endif; ?>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        <?php if($showResubmitFileColumn): ?>
                                                                            <th scope="col" class="text-center">
                                                                                Resubmit File
                                                                            </th>
                                                                        <?php endif; ?>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <?php $__empty_2 = true; $__currentLoopData = $form->documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_2 = false; ?>
                                                                        <tr>
                                                                            <td>
                                                                                <input type="text" class="form-control"
                                                                                       placeholder="<?php echo e($document->title); ?>"
                                                                                       readonly disabled>
                                                                            </td>
                                                                            <?php if($document->document_type != 'pdf'): ?>
                                                                                <td>
                                                                                    <a class="image-popup"
                                                                                       href="<?php echo e(asset('uploads/visa-forms/documents/' . $document->documents)); ?>"
                                                                                       title="<?php echo e($document->title); ?>">
                                                                                        View
                                                                                    </a>
                                                                                </td>
                                                                            <?php else: ?>
                                                                                <td>
                                                                                    <a href="<?php echo e(asset('uploads/visa-forms/documents/' .$document->documents)); ?>"
                                                                                       target="_blank">
                                                                                        View
                                                                                    </a>
                                                                                </td>
                                                                            <?php endif; ?>
                                                                            <td><?php echo e($document->status ? $document->status : "In Review..."); ?></td>
                                                                            <?php if($document->status === \App\Enums\DocumentStatus::REJECTED->toString() && !$resubmitFormDisplayed): ?>
                                                                                <td>
                                                                                    <form id="resubmitForm"
                                                                                          action="<?php echo e(route('resubmit.form')); ?>"
                                                                                          method="post"
                                                                                          enctype="multipart/form-data">
                                                                                        <?php echo csrf_field(); ?>
                                                                                        <input type="hidden"
                                                                                               name="document_id"
                                                                                               value="<?php echo e($document->id); ?>">
                                                                                        <div class="input-group">
                                                                                            <input type="file"
                                                                                                   class="form-control"
                                                                                                   id="documents"
                                                                                                   name="resubmitted_document"
                                                                                                   aria-describedby="documents"
                                                                                                   aria-label="Upload"
                                                                                                   required>
                                                                                            <button
                                                                                                class="btn btn-clr-red"
                                                                                                type="submit"
                                                                                                id="documentsBtn">
                                                                                                Resubmit
                                                                                            </button>
                                                                                        </div>
                                                                                    </form>
                                                                                    <?php
                                                                                        $resubmitFormDisplayed = true;
                                                                                    ?>

                                                                                </td>
                                                                            <?php else: ?>
                                                                                <td></td>
                                                                            <?php endif; ?>
                                                                        </tr>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_2): ?>
                                                                        <tr>
                                                                            <td>No record Found.</td>
                                                                        </tr>
                                                                    <?php endif; ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php else: ?>
                                                    <strong>No documents found.</strong>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-5 mb-3">
                                    <div class="col-xxl-12">
                                        <div class="card">
                                            <div class="card-header align-items-center d-flex">
                                                <h4 class="card-title mb-0 flex-grow-1">
                                                    Application Status & Payments
                                                </h4>
                                            </div>
                                            <div class="card-body">
                                                <p class="text-muted">
                                                    In this section, you will find your application status and
                                                    payment,status
                                                </p>
                                                <div>
                                                    <div class="row mb-3">
                                                        <div class="table-responsive">
                                                            <table
                                                                class="table table-striped align-middle table-nowrap mb-0">
                                                                <thead>
                                                                <tr>
                                                                    <th scope="col">Application Status</th>
                                                                    <th scope="col">Total Amount (BDT)</th>
                                                                    <th scope="col">Invoice</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <tr>
                                                                    <td>
                                                                        <?php echo e($form->visa_status); ?>

                                                                    </td>
                                                                    <td>
                                                                        <?php echo e(isset($form->customer->invoices) && count($form->customer->invoices) > 0 ? number_format($form->customer->invoices->sum('total_amount')) : "-"); ?>

                                                                    </td>
                                                                    <td>
                                                                        <?php if($form->invoice): ?>
                                                                            <a href="<?php echo e(route('my-invoice.view', ['encodedInvoice' => base64_encode($form->invoice->id)])); ?>"
                                                                               class="btn btn-clr-red waves-effect waves-light">
                                                                                <i class="ri-eye-2-line align-bottom me-1"></i>
                                                                                View
                                                                            </a>
                                                                        <?php else: ?>
                                                                            No Invoice found.
                                                                        <?php endif; ?>
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <h2>Result Found.</h2>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <!-- glightbox js -->
    <script src="<?php echo e(asset('backend/assets/libs/glightbox/js/glightbox.min.js')); ?>"></script>

    <script src="<?php echo e(asset('backend/assets/js/pages/gallery.init.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.frontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/bokhtiartoshar/Desktop/Project/Sajon Bhai/visaExpert.com-master/resources/views/frontend/search-result.blade.php ENDPATH**/ ?>
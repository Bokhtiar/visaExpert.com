<?php $__env->startSection('title', 'View Customer'); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="container">
            <div class="row mt-4">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Customer Details</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">Dashboard</li>
                                <li class="breadcrumb-item">Customers</li>
                                <li class="breadcrumb-item active">View Customer Profile</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row mt-5 shadow-lg">
                <div class="col-xxl-3">
                    <div class="card mt-n5">
                        <div class="card-body p-4">
                            <div class="text-center">
                                <div class="profile-user position-relative d-inline-block mx-auto mb-4">
                                    <img src="<?php echo e(asset('backend/assets/images/users/user.svg')); ?>"
                                         class="rounded-circle avatar-xl img-thumbnail user-profile-image"
                                         alt="user-profile-image">
                                </div>
                                <h5 class="fs-16 mb-1">
                                    <?php echo e($customer->name); ?>

                                </h5>
                                <p class="text-muted mb-0">
                                    User ID: #<?php echo e($customer->unique_id); ?>

                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-9">
                    <div class="card mt-xxl-n5">
                        <div class="card-header">
                            <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link text-dark active" data-bs-toggle="tab" href="#serviceInformation"
                                       role="tab">
                                        Service Information
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-dark" data-bs-toggle="tab" href="#personalInformation"
                                       role="tab">
                                        Personal Information
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-dark" data-bs-toggle="tab" href="#submittedDocuments"
                                       role="tab">
                                        Submitted Documents
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-dark" data-bs-toggle="tab" href="#generatedBill"
                                       role="tab">
                                        Generated & Updated Bill/Invoices
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body p-4 bg-light">
                            <div class="tab-content">
                                <div class="tab-pane active" id="serviceInformation" role="tabpanel">
                                    <div class="row">
                                        <div class="row mb-3">
                                            <div class="col-lg-3">
                                                <label for="nameInput" class="form-label">Visa Type :</label>
                                            </div>
                                            <div class="col-lg-9">
                                                <?php echo e($customer->forms[0]->visaType->title); ?>

                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-lg-3">
                                                <label for="nameInput" class="form-label">Visa Status :</label>
                                            </div>
                                            <div class="col-lg-9">
                                                <?php echo displayVisaStatusBadge($customer->forms[0]->visa_status); ?>

                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-lg-3">
                                                <label for="websiteUrl" class="form-label">Total Charges :</label>
                                            </div>
                                            <div class="col-lg-9">
                                                <?php echo e($customer->form[0]->invoice->amount ?? "-"); ?>

                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-lg-3">
                                                <label for="websiteUrl" class="form-label">Payment Status :</label>
                                            </div>
                                            <div class="col-lg-9">
                                                <?php echo displayPaymentStatusBadge($customer->forms[0]->payment_status); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end Service tab-pane-->
                                <div class="tab-pane" id="personalInformation" role="tabpanel">
                                    <div class="row">
                                        <div class="row mb-3">
                                            <div class="col-lg-3">
                                                <label for="nameInput" class="form-label">User ID :</label>
                                            </div>
                                            <div class="col-lg-9">
                                                <?php echo e($customer->unique_id); ?>

                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-lg-3">
                                                <label for="nameInput" class="form-label">Name :</label>
                                            </div>
                                            <div class="col-lg-9">
                                                <?php echo e($customer->name); ?>

                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-lg-3">
                                                <label for="websiteUrl" class="form-label">Phone Number :</label>
                                            </div>
                                            <div class="col-lg-9">
                                                <?php echo e($customer->phone); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end Personal Information tab-pane-->
                                <div class="tab-pane" id="submittedDocuments" role="tabpanel">
                                    <div class="row">
                                        <div class="table-responsive">
                                            <table class="table table-borderless align-middle table-nowrap mb-0">
                                                <thead>
                                                <tr>
                                                    <th scope="col">SL</th>
                                                    <th scope="col">Document Name</th>
                                                    <th scope="col">Submitted Files</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php $__empty_1 = true; $__currentLoopData = $customer->forms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $form): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                    <?php $__empty_2 = true; $__currentLoopData = $form->documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_2 = false; ?>
                                                        <tr>
                                                            <td class="fw-medium text-center"><?php echo e($key + 1); ?></td>
                                                            <td><?php echo e($document->title); ?></td>
                                                            <?php if($document->document_type != 'pdf'): ?>
                                                                <td>
                                                                    <figure class="figure">
                                                                        <img
                                                                            src="<?php echo e(asset('uploads/visa-forms/documents/' . $document->documents)); ?>"
                                                                            class="figure-img img-fluid rounded"
                                                                            alt="..."
                                                                            width="200"
                                                                            height="200">
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
                                                            <td>Accepted</td>
                                                            <td>
                                                                <div class="d-flex gap-2 align-items-center">
                                                                    <div class="form-check form-radio-success">
                                                                        <input class="form-check-input" type="radio"
                                                                               name="formradiocolor5"
                                                                               id="formradioRight9"
                                                                               checked>
                                                                        <label class="form-check-label"
                                                                               for="formradioRight9">
                                                                            Accept
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-radio-danger">
                                                                        <input class="form-check-input" type="radio"
                                                                               name="formradiocolor5"
                                                                               id="formradioRight9"
                                                                               checked>
                                                                        <label class="form-check-label"
                                                                               for="formradioRight9">
                                                                            Decline
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_2): ?>
                                                        <tr>
                                                            <td>No record Found.</td>
                                                        </tr>
                                                    <?php endif; ?>
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
                                <!--end Personal Information tab-pane-->
                                <div class="tab-pane" id="generatedBill" role="tabpanel">
                                    <div class="row justify-content-center">
                                        <div class="col-xxl-12">
                                            <div class="card" id="demo">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="card-header border-bottom-dashed p-4">
                                                            <div class="d-flex">
                                                                <div class="flex-grow-1">
                                                                    <h4 style="user-select: none;"><?php echo e(config('app.name')); ?></h4>
                                                                    <div class="mt-sm-5 mt-4">
                                                                        <h6 class="text-muted text-uppercase fw-semibold">
                                                                            Address</h6>
                                                                        <p class="text-muted mb-1"
                                                                           id="address-details">Office Address</p>
                                                                    </div>
                                                                </div>
                                                                <div class="flex-shrink-0 mt-sm-0 mt-3">
                                                                    <h6><span class="text-muted fw-normal">Email:</span><span
                                                                            id="email">email@email.com</span>
                                                                    </h6>
                                                                    <h6><span
                                                                            class="text-muted fw-normal">Website:</span>
                                                                        <a
                                                                            href="<?php echo e(config('app.url')); ?>"
                                                                            class="link-primary"
                                                                            target="_blank"
                                                                            id="website"><?php echo e(config('app.name')); ?></a>
                                                                    </h6>
                                                                    <h6 class="mb-0"><span
                                                                            class="text-muted fw-normal">Contact No: </span><span
                                                                            id="contact-no">12345678</span></h6>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--end card-header-->
                                                    </div><!--end col-->
                                                    <div class="col-lg-12">
                                                        <div class="card-body p-4">
                                                            <div class="row g-3">
                                                                <div class="col-lg-3 col-6">
                                                                    <p class="text-muted mb-2 text-uppercase fw-semibold">
                                                                        Invoice No</p>
                                                                    <h5 class="fs-14 mb-0"><span
                                                                            id="invoice-no"><?php echo e($form->invoice->invoice_number); ?></span>
                                                                    </h5>
                                                                </div>
                                                                <!--end col-->
                                                                <div class="col-lg-3 col-6">
                                                                    <p class="text-muted mb-2 text-uppercase fw-semibold">
                                                                        Date</p>
                                                                    <h5 class="fs-14 mb-0"><span
                                                                            id="invoice-date"><?php echo e($form->created_at->format('d M Y')); ?></span>
                                                                        <small class="text-muted"
                                                                               id="invoice-time"><?php echo e($form->created_at->format('g:i A')); ?></small>
                                                                    </h5>
                                                                </div>
                                                                <!--end col-->
                                                                <div class="col-lg-3 col-6">
                                                                    <p class="text-muted mb-2 text-uppercase fw-semibold">
                                                                        Payment Status</p>
                                                                    <span
                                                                        class="badge bg-success-subtle text-success fs-11"
                                                                        id="payment-status"><?php echo displayPaymentStatusBadge($form->payment_status); ?></span>
                                                                </div>
                                                                <!--end col-->
                                                                <div class="col-lg-3 col-6">
                                                                    <p class="text-muted mb-2 text-uppercase fw-semibold">
                                                                        Total Amount (BDT)</p>
                                                                    <h5 class="fs-14 mb-0">
                                                                        
                                                                        00
                                                                    </h5>
                                                                </div>
                                                                <!--end col-->
                                                            </div>
                                                            <!--end row-->
                                                        </div>
                                                        <!--end card-body-->
                                                    </div><!--end col-->
                                                    <div class="col-lg-12">
                                                        <div class="card-body p-4 border-top border-top-dashed">
                                                            <div class="row g-3">
                                                                <div class="col-12">
                                                                    <h6 class="text-muted text-uppercase fw-semibold mb-3">
                                                                        Customer
                                                                        Address</h6>
                                                                    <p class="fw-medium mb-2"
                                                                       id="billing-name"><?php echo e($form->customer->name); ?></p>
                                                                    <p class="text-muted mb-1">Phone: <span
                                                                            id="billing-phone-no"><?php echo e($form->customer->phone); ?></span>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <!--end row-->
                                                        </div>
                                                        <!--end card-body-->
                                                    </div><!--end col-->
                                                    <div class="col-lg-12">
                                                        <div class="card-body p-4">
                                                            <div class="table-responsive">
                                                                <table
                                                                    class="table table-borderless text-center table-nowrap align-middle mb-0">
                                                                    <thead>
                                                                    <tr class="table-active">
                                                                        <th scope="col" style="width: 50px;">#</th>
                                                                        <th scope="col">Details</th>
                                                                        <th scope="col" class="text-end">Amount (BDT)
                                                                        </th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody id="products-list">
                                                                    <tr>
                                                                        <th scope="row">01</th>
                                                                        <td class="text-center">
                                                                            <span class="fw-medium">Visa Application Form</span>
                                                                        </td>
                                                                        <td class="text-end">
                                                                            
                                                                            00
                                                                        </td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table><!--end table-->
                                                            </div>
                                                            <div class="border-top border-top-dashed mt-2">
                                                                <table
                                                                    class="table table-borderless table-nowrap align-middle mb-0 ms-auto"
                                                                    style="width:250px">
                                                                    <tbody>

                                                                    <tr class="border-top border-top-dashed fs-15">
                                                                        <th scope="row">Total Amount (BDT)</th>
                                                                        <th class="text-end">
                                                                            
                                                                            00
                                                                        </th>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                                <!--end table-->
                                                            </div>
                                                            <div
                                                                class="hstack gap-2 justify-content-end d-print-none mt-4">
                                                                <a href="<?php echo e(route('admin.visa-forms.invoiceDownload', $form->id)); ?>"
                                                                   class="btn btn-primary"><i
                                                                        class="ri-download-2-line align-bottom me-1"></i>
                                                                    Download
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <!--end card-body-->
                                                    </div><!--end col-->
                                                </div><!--end row-->
                                            </div>
                                            <!--end card-->
                                        </div>
                                        <!--end col-->
                                    </div>
                                </div>
                                <!--end tab-pane-->
                            </div>
                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.backend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/visatuey/visa.visaxpert.net/resources/views/backend/customer/show.blade.php ENDPATH**/ ?>
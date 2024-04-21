<?php use \App\Enums\DocumentStatus as Status; ?>


<?php $__env->startSection('title', 'View Customer'); ?>

<?php $__env->startPush('css'); ?>
    <!-- glightbox css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css"/>
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
                            <p class="text-muted">
                                Please make sure you check out all the required documents before submitting the Visa
                                Application form.
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


                            <form id="visaForm" action="<?php echo e(route('application.forms.store')); ?>" method="POST"
                                  enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <div class="row mb-3">
                                    <div class="col-lg-3">
                                        <label for="visa_type_id" class="col-form-label">Visa Type<span
                                                class="text-danger">*</span> :</label>
                                    </div>
                                    <div class="col-lg-9 custom-message">
                                        <select
                                            class="form-select form-select-lg mb-3 <?php $__errorArgs = ['visa_type_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            id="visa_type_id"
                                            name="visa_type_id">
                                            <option selected disabled>Choose a type</option>
                                            <?php $__currentLoopData = $visaType; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($type->id); ?>">
                                                    <?php echo e(ucfirst($type->title)); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php $__errorArgs = ['visa_type_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback">
                                            <?php echo e($message); ?>

                                        </div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg-3">
                                        <label for="name" class="col-form-label">Name<span
                                                class="text-danger">*</span> :</label>
                                    </div>
                                    <div class="col-lg-9 custom-message">
                                        <input type="text"
                                               class="form-control form-control-lg mb-3 <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                               id="name"
                                               name="name"
                                               placeholder="Enter your full name"
                                        >
                                        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback">
                                            <strong><?php echo e($message); ?></strong>
                                        </div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg-3">
                                        <label for="phone" class="col-form-label">Contact Number<span
                                                class="text-danger">*</span> :</label>
                                    </div>
                                    <div class="col-lg-9 custom-message">
                                        <input type="number"
                                               class="form-control form-control-lg mb-3 <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                               id="phone"
                                               name="phone"
                                               placeholder="01xxxxxxxxx"
                                        >
                                        <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback">
                                            <?php echo e($message); ?>

                                        </div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <div class="row mt-5 mb-3">
                                    <div class="col-xxl-12">
                                        <div class="card">
                                            <div class="card-header align-items-center d-flex">
                                                <h4 class="card-title mb-0 flex-grow-1">Required Document List</h4>
                                            </div>
                                            <div class="card-body">
                                                <p class="text-muted">
                                                    All the required documents are listed below. Please check this out
                                                    before submitting
                                                    visa application form.
                                                </p>
                                                <p id="requiredDocumentsDisplay">Select a visa type to checkout the
                                                    list</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-lg btn-clr-red rounded-pill">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <script>
        $(document).ready(function () {
            $('#visa_type_id').change(function () {
                let visa_type_id = $(this).val();

                $.ajax({
                    url: '/get-required-documents/' + visa_type_id,
                    type: 'GET',
                    success: function (response) {
                        let requiredDocumentsDisplay = $('#requiredDocumentsDisplay');
                        if (response.documents) {
                            requiredDocumentsDisplay.empty();
                            let documents = response.documents.split(', ');
                            documents.forEach(function (document, index) {
                                let documentInput = $('<input/>', {
                                    type: 'text',
                                    class: 'form-control',
                                    name: 'title[]',
                                    value: document,
                                    readonly: 'readonly'
                                });

                                let fileInput = $('<input/>', {
                                    type: 'file',
                                    name: 'documents[]',
                                    multiple: false
                                });

                                let documentRow = $('<div/>', {
                                    class: 'row mb-3'
                                });

                                let documentCol = $('<div/>', {
                                    class: 'col-lg-6'
                                });

                                let fileCol = $('<div/>', {
                                    class: 'col-lg-6'
                                });

                                documentCol.append(documentInput);
                                fileCol.append(fileInput);

                                documentRow.append(documentCol);
                                documentRow.append(fileCol);

                                requiredDocumentsDisplay.append(documentRow);


                            });

                            $('#requiredDocumentsSection').show();
                        } else {
                            requiredDocumentsDisplay.text("No documents found for this visa type.");
                            $('#requiredDocumentsSection').hide();
                        }
                    },
                    error: function () {
                        console.log('Error loading documents');
                    }
                });
            });

            $('#visaForm').submit(function (e) {
                e.preventDefault();

                let formData = new FormData(this);

                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    // headers: {
                    //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    // },
                   
         
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        location.reload();
                        $('.alert-success').text(response.message).show();
                        $('#visaForm')[0].reset();
                    },
                    error: function (error) {
                        if (error.status === 422) {

                            $('.invalid-feedback').remove();
                            $('.is-invalid').removeClass('is-invalid');

                            let errors = error.responseJSON.errors;

                            $.each(errors, function (field, messages) {
                                let inputField = $('#' + field);

                                let errorMessage = messages[0];

                                inputField.closest('.custom-message').append('<div class="invalid-feedback">' + errorMessage + '</div>');

                                inputField.addClass('is-invalid');
                            });
                        } else {
                            console.log(error.responseJSON.errors)
                        }
                    }
                });
            });
        });

    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.backend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/visatuey/public_html/resources/views/backend/customer/offline-create.blade.php ENDPATH**/ ?>
<?php use \App\Enums\DocumentStatus as Status; ?>


<?php $__env->startSection('title', 'View Customer'); ?>

<?php $__env->startPush('css'); ?>
    <!-- glightbox css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />

    
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<?php $__env->stopPush(); ?>

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

            <?php if(count($parent_customers) > 1): ?>


                <h5>Relavent Customer List: </h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">SL</th>
                            <th scope="col">Customer</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $parent_customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cus): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <th scope="row"><?php echo e($loop->index + 1); ?></th>
                                <td><?php echo e($cus->name); ?> <span class=""
                                        style="color: red"><?php echo e($cus->id == $cus->parent_customer_id ? '(Owner)' : ''); ?></span>
                                </td>
                                <td><?php echo e($cus->phone); ?></td>
                                <td>
                                    <a href="<?php echo e(route('admin.customers.show', $cus->id)); ?>"
                                        class="btn btn-sm btn-clr-red waves-effect waves-light px-4"> <i class="ri-eye-2-line align-bottom me-1"></i></a>

                                    <?php if (\Illuminate\Support\Facades\Blade::check('hasPermission', 'Delete Customer')): ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check(\App\Permissions::DELETE_CUSTOMER)): ?>
                                            <button type="button" class="btn btn-sm btn-soft-success waves-effect waves-li"
                                                onclick="deleteData(<?php echo e($customer->id); ?>)">
                                                <i class="ri-delete-bin-5-line align-bottom me-1"></i>
                                                
                                            </button>
                                            <form id="delete-form-<?php echo e($customer->id); ?>"
                                                action="<?php echo e(route('admin.customers.destroy', $customer->id)); ?>" method="POST"
                                                style="display: none;">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                            </form>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>

            <?php endif; ?>



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
                                    <?php echo e(ucfirst($customer->name)); ?>

                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-n4">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-2">
                                <div class="flex-grow-1">
                                    <h5 class="card-title mb-0">User ID : </h5>
                                </div>
                                <div class="flex-shrink-0">
                                    #<?php echo e($customer->unique_id); ?>

                                </div>
                            </div>

                            <div class="d-flex align-items-center mb-2">
                                <div class="flex-grow-1">
                                    <h5 class="card-title mb-0">Work Status : </h5>
                                </div>
                                <div class="flex-shrink-1 custom-badge-style">
                                    <?php echo displayVisaStatusBadge($customer->forms[0]->visa_status); ?>

                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <div class="flex-grow-1">
                                    <h5 class="card-title mb-0">Payment Status : </h5>
                                </div>
                                <div class="flex-shrink-0">
                                    <?php echo e(count($customer->invoices) > 0 ? $customer->invoices[0]->status : $customer->forms[0]->payment_status); ?>

                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <div class="flex-grow-1">
                                    <h5 class="card-title mb-0">Creation Date : </h5>
                                </div>
                                <div class="flex-shrink-0">
                                    <?php echo e($customer->created_at->format('d M Y')); ?>

                                </div>
                            </div>
                            <div class="d-grid align-items-center my-4">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check(\App\Permissions::EDIT_CUSTOMER)): ?>
                                    <button class="btn btn-clr-red mb-2" onclick="toggleVisaStatusDropdown()">
                                        <i class="ri-edit-box-line"></i>
                                        Update Information
                                    </button>
                                <?php endif; ?>
                                <a href="<?php echo e(route('admin.customers.index')); ?>" class="btn btn-outline-primary">
                                    <i class="ri-arrow-left-s-line align-bottom me-1"></i>
                                    Go to Customer List
                                </a>


                            </div>
                            <?php $__currentLoopData = $links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e($link->link); ?>" target="_blank" class="btn"
                                    style="color: white ;background-color: #<?php echo e($link->color); ?>"><?php echo e($link->name); ?></a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check(\App\Permissions::CREATE_CUSTOMER_INVOICE)): ?>
                                    <?php if($customer->id == $customer->parent_customer_id): ?>
                                        <li class="nav-item">
                                            <a class="nav-link text-dark" data-bs-toggle="tab" href="#generatedBill"
                                                role="tab">
                                                Generated & Updated Bill/Invoices
                                            </a>
                                        </li>
                                    <?php endif; ?>

                                <?php endif; ?>
                            </ul>
                        </div>
                        <div class="card-body p-4 bg-light">
                            <div class="tab-content">
                                <div class="tab-pane active" id="serviceInformation" role="tabpanel">
                                    <div class="row">
                                        <div class="bg-clr-red mb-4 rounded-1">
                                            <h5 class="mb-sm-0 text-light py-2">Visa Application Service</h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="row mb-3">
                                            <div class="col-lg-3">
                                                <label for="nameInput" class="form-label">Customer Name :</label>
                                            </div>
                                            <div class="col-lg-9">
                                                <?php echo e($customer->name); ?>

                                            </div>
                                        </div>

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
                                                <label for="note" class="form-label">Note :</label>
                                            </div>
                                            <div class="col-lg-9">
                                                <?php echo $customer->forms[0]->note; ?>

                                            </div>
                                        </div>




                                        <div class="row mb-3">
                                            <div class="col-lg-3">
                                                <label for="nameInput" class="form-label">Work Status :</label>
                                            </div>
                                            <div class="col-lg-9">
                                                <div id="mainContent">
                                                    <?php echo displayVisaStatusBadge($customer->forms[0]->visa_status); ?>

                                                </div>



                                                <form id="updateVisaStatusForm" method="POST"
                                                    action="<?php echo e(route('admin.customers.updateVisaStatus', $customer->id)); ?>"
                                                    style="display: none;" enctype="multipart/form-data">
                                                    <?php echo method_field('PATCH'); ?>
                                                    <?php echo csrf_field(); ?>
                                                    <select name="visa_status" id="visa_status" class="form-select mb-3">
                                                        <?php $__currentLoopData = $visaStatuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($status); ?>"
                                                                <?php echo e($customer->forms[0]->visa_status == $status ? 'selected' : ''); ?>>
                                                                <?php echo e($status); ?>

                                                            </option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>

                                                    <!--new code added start here-->
                                                    <div class="row mb-3">
                                                        <div class="col-lg-3">
                                                            <label for="note" class="form-label">Note
                                                                :</label>
                                                        </div>
                                                        <div class="col-lg-9">
                                                            
                                                            <textarea name="note" class="ckeditor-classic" id="description"><?php echo $customer->forms[0]->note ? $customer->forms[0]->note : ''; ?></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <div class="col-lg-3">
                                                            <label for="type_remarks1" class="form-label">Type Remarks
                                                                :</label>
                                                        </div>
                                                        <div class="col-lg-9">
                                                            <input type="text" name="type_remarks1" id="type_remarks1"
                                                                class="form-control"
                                                                value="<?php echo e($customer->forms[0]->type_remarks1); ?>">
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <div class="col-lg-3">
                                                            <label for="application_id" class="form-label">Temporary
                                                                Application ID :</label>
                                                        </div>
                                                        <div class="col-lg-9">
                                                            <input type="text" name="application_id"
                                                                id="application_id" class="form-control"
                                                                value="<?php echo e($customer->forms[0]->application_id); ?>"
                                                                 placeholder="type here temporary application ID ">
                                                        </div>
                                                    </div>


                                                    <div class="row mb-3">
                                                        <div class="col-lg-3">
                                                            <label for="" class="form-label">Web File /
                                                                Application ID :</label>
                                                        </div>
                                                        <div class="col-lg-9">
                                                            <input type="file" name="web_file_app_id"
                                                                id="web_file_app_id" class="form-control"
                                                                value="<?php echo e($customer->forms[0]->web_file_app_id); ?>"
                                                                accept=".pdf" maxlength="2097152">

                                                            <span>Already added: <span class="text-success cursor-pointer"
                                                                    onclick="printPDF('<?php echo e($customer->forms[0]->web_file_app_id); ?>')">Print
                                                                </span>/
                                                                <a class="text-success"
                                                                    href="<?php echo e(asset('uploads/visa-forms/documents/' . $customer->forms[0]->web_file_app_id)); ?>"
                                                                    download="<?php echo e($customer->forms[0]->web_file_app_id); ?>">
                                                                    Download
                                                                </a>
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <div class="col-lg-3">
                                                            <label for="type_remarks2" class="form-label">Type Remarks
                                                                :</label>
                                                        </div>
                                                        <div class="col-lg-9">
                                                            <input type="text" name="type_remarks2" id="type_remarks2"
                                                                class="form-control"
                                                                value="<?php echo e($customer->forms[0]->type_remarks2); ?>">
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <div class="col-lg-3">
                                                            <label for="" class="form-label">Image Upload
                                                                :</label>
                                                        </div>
                                                        <div class="col-lg-9">
                                                            <input type="file" name="image" id="image"
                                                                class="form-control"
                                                                value="<?php echo e($customer->forms[0]->image); ?>"
                                                                accept="image/*">
                                                            <span>Already added: <span class="text-success cursor-pointer"
                                                                    onclick="printPDF('<?php echo e($customer->forms[0]->image); ?>')">Print
                                                                </span>/
                                                                <a class="text-success"
                                                                    href="<?php echo e(asset('uploads/visa-forms/documents/' . $customer->forms[0]->web_file_app_id)); ?>"
                                                                    download="<?php echo e($customer->forms[0]->image); ?>">
                                                                    Download
                                                                </a>
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <!--new code added end here-->



                                                    <button type="submit" class="btn btn-clr-red px-5">Save</button>
                                                    <button type="button" class="btn btn-outline-danger"
                                                        onclick="cancelUpdate()">Cancel
                                                    </button>
                                                </form>




                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-lg-3">
                                                <label for="type_remarks1" class="form-label">Type Remarks :</label>
                                            </div>
                                            <div class="col-lg-9">
                                                <?php echo e($customer->forms[0]->type_remarks1); ?>

                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-lg-3">
                                                <label for="application_id" class="form-label">Temporary Application ID
                                                    :</label>
                                            </div>
                                            <div class="col-lg-9">
                                                <?php echo e($customer->forms[0]->application_id); ?>

                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-lg-3">
                                                <label for="web_file_app_id" class="form-label">Web File / Application ID
                                                    :</label>
                                            </div>
                                            <div class="col-lg-9">

                                                <span><?php echo e($customer->name); ?> PDF</span> <br>


                                                <span class="text-success cursor-pointer"
                                                    onclick="printPDF('<?php echo e($customer->forms[0]->web_file_app_id); ?>')">Print
                                                </span>/
                                                <a class="text-success"
                                                    href="<?php echo e(asset('uploads/visa-forms/documents/' . $customer->forms[0]->web_file_app_id)); ?>"
                                                    download="<?php echo e($customer->forms[0]->web_file_app_id); ?>">
                                                    Download
                                                </a>


                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-lg-3">
                                                <label for="type_remarks2" class="form-label">Type Remarks :</label>
                                            </div>
                                            <div class="col-lg-9">
                                                <?php echo e($customer->forms[0]->type_remarks2); ?>

                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-lg-3">
                                                <label for="image" class="form-label">Image Upload :</label>
                                            </div>
                                            <div class="col-lg-9">

                                                <span class="text-success cursor-pointer"
                                                    onclick="printPDF('<?php echo e($customer->forms[0]->image); ?>')">Print
                                                </span>/
                                                <a class="text-success"
                                                    href="<?php echo e(asset('uploads/visa-forms/documents/' . $customer->forms[0]->image)); ?>"
                                                    download="<?php echo e($customer->forms[0]->image); ?>">
                                                    Download
                                                </a>

                                            </div>
                                        </div>


                                        <div class="row mb-3">
                                            <div class="col-lg-3">
                                                <label for="websiteUrl" class="form-label">Total Charges(BDT) :</label>
                                            </div>
                                            <div class="col-lg-9">
                                                <?php echo e(isset($customer->invoices) && count($customer->invoices) > 0 ? number_format($customer->invoices->sum('total_amount')) : '-'); ?>

                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-lg-3">
                                                <label for="websiteUrl" class="form-label">Payment Status :</label>
                                            </div>
                                            <div class="col-lg-9">
                                                <?php if($customer->forms[0]->invoice): ?>
                                                    <?php echo displayPaymentStatusBadge($customer->forms[0]->invoice->status); ?>

                                                <?php else: ?>
                                                    <?php echo displayPaymentStatusBadge($customer->forms[0]->payment_status); ?>

                                                <?php endif; ?>
                                            </div>
                                        </div>


                                    </div>
                                    <?php if($customer->id == $customer->parent_customer_id): ?>
                                        <a href="<?php echo e(route('admin.customers.add-more', $customer->id)); ?>"
                                            class="btn btn-clr-red">Add More Customer</a>
                                    <?php endif; ?>
                                </div>
                                <!--end Service tab-pane-->
                                <div class="tab-pane" id="personalInformation" role="tabpanel">
                                    <div class="row">
                                        <div class="bg-clr-red mb-4 rounded-1">
                                            <h5 class="mb-sm-0 text-light py-2">Personal Information</h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="row mb-3">
                                            <div class="col-lg-3">
                                                <label for="nameInput" class="form-label">User ID :</label>
                                            </div>
                                            <div class="col-lg-9">
                                                <?php echo e($customer->unique_id); ?>

                                            </div>
                                        </div>
                                        <div id="customerItems">
                                            <div class="row mb-3">
                                                <div class="col-lg-3">
                                                    <label for="CustomerName" class="form-label">Name :</label>
                                                </div>
                                                <div class="col-lg-9">
                                                    <?php echo e(ucfirst($customer->name)); ?>

                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-lg-3">
                                                    <label for="customerPhone" class="form-label">Phone Number :</label>
                                                </div>
                                                <div class="col-lg-9">
                                                    <?php echo e($customer->phone); ?>

                                                </div>
                                            </div>

                                            <?php $__currentLoopData = $passport; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pass): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="row mb-3">
                                                    <div class="col-lg-3">
                                                        <label for="customerPhone" class="form-label">Passport No.
                                                            <?php echo e($loop->index + 1); ?> :</label>
                                                    </div>
                                                    <div class="col-lg-9">
                                                        <?php echo e($pass->passport); ?>

                                                    </div>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                        </div>
                                        <form id="updateCustomerForm"
                                            action="<?php echo e(route('admin.customers.update', $customer->id)); ?>" method="POST"
                                            style="display: none;" enctype="multipart/form-data">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('PUT'); ?>
                                            <div class="row mb-3">
                                                <div class="col-lg-3">
                                                    <label for="customerName" class="form-label">Name :</label>
                                                </div>
                                                <div class="col-lg-9">
                                                    <input type="text" name="name" id="customerName"
                                                        class="form-control" value="<?php echo e(ucfirst($customer->name)); ?>">
                                                </div>
                                            </div>


                                            <div class="row mb-3">
                                                <div class="col-lg-3">
                                                    <label for="customerPhone" class="form-label">Phone Number :</label>
                                                </div>
                                                <div class="col-lg-9">
                                                    <input type="text" name="phone" id="customerPhone"
                                                        class="form-control" value="<?php echo e($customer->phone); ?>">
                                                </div>
                                            </div>




                                            <table class="table table-bordered" id="dynamicTable">
                                                <h4>Passport</h4>
                                                <tr>
                                                    <?php $__currentLoopData = $passport; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <td><input type="text"
                                                                name="addmore_update[<?php echo e($value['id']); ?>][name]"
                                                                placeholder="Enter your passport" class="form-control"
                                                                value="<?php echo e($value['passport']); ?>" /></td>
                                                        <input type="hidden" value="<?php echo e($value['id']); ?>"
                                                            name="addmore_update[<?php echo e($value['id']); ?>][id]"
                                                            placeholder="Enter your passport" class="form-control" /></td>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <td><button type="button" name="add" id="add"
                                                            class="btn btn-success">Add More Passport</button></td>
                                                </tr>

                                                
                                            </table>



                                            <button type="submit" class="btn btn-clr-red px-10">Save</button>
                                            <button type="button" class="btn btn-outline-danger"
                                                onclick="cancelUpdate()">Cancel
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <!--end Personal Information tab-pane-->
                                <div class="tab-pane" id="submittedDocuments" role="tabpanel">
                                    <div class="row">
                                        <div class="bg-clr-red mb-4 rounded-1">
                                            <h5 class="mb-sm-0 text-light py-2">Submitted Documents</h5>
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="d-flex align-items-center">
                                            <h5 class="card-title mb-0 flex-grow-1">Documents update</h5>
                                            <div class="flex-shrink-0">
                                                
                                            </div>
                                        </div>
                                        
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-xxl-12">
                                                    <div class="card">

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
                                                                        $exist = App\Models\VisaForm::exitDocument(
                                                                            $file,
                                                                            $customer_form_id,
                                                                        );
                                                                    ?>

                                                                    <?php if($exist): ?>
                                                                        <form
                                                                            action="<?php echo e(route('admin.customers.single.document.update', $exist->id)); ?>"
                                                                            method="POST" enctype="multipart/form-data">
                                                                            <?php echo method_field('PUT'); ?>
                                                                        <?php else: ?>
                                                                            <form
                                                                                action="<?php echo e(route('admin.customers.single.document.store')); ?>"
                                                                                method="POST"
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
                                                                            <input type="file" name="doc"
                                                                                id="">
                                                                        </td>

                                                                        <input type="hidden" name="customer_form_id"
                                                                            value="<?php echo e($customer_form_id); ?>"
                                                                            id="">
                                                                        <input type="hidden" name="customer_id"
                                                                            value="<?php echo e($customer_id); ?>" id="">
                                                                        <input type="hidden" name="title"
                                                                            value="<?php echo e($file); ?>" id="">
                                                                        <td>
                                                                            <?php if($exist): ?>
                                                                                <input type="submit" name=""
                                                                                    class="btn btn-success" value="update"
                                                                                    id="">
                                                                            <?php else: ?>
                                                                                <input type="submit" name=""
                                                                                    class="btn btn-info" value="submit"
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
                                        
                                        <div class="table-responsive">
                                            <table class="table table-borderless align-middle table-nowrap mb-0">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">SL</th>
                                                        <th scope="col">Document Name</th>
                                                        <th scope="col">Submitted Files</th>
                                                        <th scope="col">Print/PDF</th>
                                                        <th scope="col">Status</th>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check(\App\Permissions::EDIT_CUSTOMER)): ?>
                                                            <th scope="col">Action</th>
                                                        <?php endif; ?>
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
                                                                        <a class="image-popup"
                                                                            href="<?php echo e(asset('uploads/visa-forms/documents/' . $document->documents)); ?>"
                                                                            title="<?php echo e($document->title); ?>">
                                                                            View
                                                                        </a>
                                                                    </td>
                                                                <?php else: ?>
                                                                    <td>
                                                                        <a href="<?php echo e(asset('uploads/visa-forms/documents/' . $document->documents)); ?>"
                                                                            target="_blank">
                                                                            View PDF
                                                                        </a>
                                                                    </td>
                                                                <?php endif; ?>
                                                                <td>
                                                                    <span class="text-success cursor-pointer"
                                                                        onclick="printPDF('<?php echo e($document->documents); ?>')">Print
                                                                    </span>/
                                                                    <a class="text-success"
                                                                        href="<?php echo e(asset('uploads/visa-forms/documents/' . $document->documents)); ?>"
                                                                        download="<?php echo e($document->documents); ?>">
                                                                        Download
                                                                    </a>
                                                                </td>

                                                                
                                                                <td id="document-status-<?php echo e($document->id); ?>">
                                                                    <?php echo e($document->status ?? 'Waiting for Review'); ?></td>
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check(\App\Permissions::EDIT_CUSTOMER)): ?>
                                                                    <td>
                                                                        <div class="d-flex gap-2 align-items-center">
                                                                            <div class="form-check form-radio-success">
                                                                                <input class="form-check-input document-status"
                                                                                    type="radio"
                                                                                    data-document-id="<?php echo e($document->id); ?>"
                                                                                    data-form-id="<?php echo e($form->id); ?>"
                                                                                    name="document_status_<?php echo e($document->id); ?>"
                                                                                    value="Accepted"
                                                                                    <?php echo e($document->status === Status::ACCEPTED->toString() ? 'checked' : ''); ?>>
                                                                                <label class="form-check-label"
                                                                                    for="document_status_<?php echo e($document->id); ?>">
                                                                                    Accept
                                                                                </label>
                                                                            </div>
                                                                            <div class="form-check form-radio-danger">
                                                                                <input class="form-check-input document-status"
                                                                                    type="radio"
                                                                                    data-customer-id="<?php echo e($customer->id); ?>"
                                                                                    data-document-id="<?php echo e($document->id); ?>"
                                                                                    data-form-id="<?php echo e($form->id); ?>"
                                                                                    name="document_status_<?php echo e($document->id); ?>"
                                                                                    value="Rejected"
                                                                                    <?php echo e($document->status === Status::REJECTED->toString() ? 'checked' : ''); ?>>
                                                                                <label class="form-check-label"
                                                                                    for="document_status_<?php echo e($document->id); ?>">
                                                                                    Reject
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                <?php endif; ?>
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
                                <?php if (\Illuminate\Support\Facades\Blade::check('hasPermission', 'Create Invoice')): ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check(\App\Permissions::CREATE_CUSTOMER_INVOICE)): ?>
                                        <?php if(count($customer->invoices) > 0): ?>
                                            <div class="tab-pane" id="generatedBill" role="tabpanel">
                                                <div class="row">
                                                    <div class="bg-clr-red mb-4 rounded-1">
                                                        <h5 class="mb-sm-0 text-light py-2">Generated Customer Bills</h5>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="card" id="invoiceList">
                                                            <div class="card-header border-0">
                                                                <div class="d-flex align-items-center">
                                                                    <h5 class="card-title mb-0 flex-grow-1">Invoices</h5>
                                                                    <div class="flex-shrink-0">
                                                                        <div>
                                                                            <?php if (\Illuminate\Support\Facades\Blade::check('hasPermission', 'Create Invoice')): ?>
                                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check(\App\Permissions::CREATE_CUSTOMER_INVOICE)): ?>
                                                                                    <a href="<?php echo e(route('admin.customers-invoices.create', $customer->id)); ?>"
                                                                                        class="btn btn-clr-red waves-effect waves-light">
                                                                                        <i class="ri-file-add-line align-bottom me-1"></i>
                                                                                        Create Invoice
                                                                                    </a>
                                                                                <?php endif; ?>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card-body">
                                                                <div>
                                                                    <div class="table-responsive table-card">
                                                                        <table class="table align-middle table-nowrap"
                                                                            id="invoiceTable">
                                                                            <thead class="text-muted">
                                                                                <tr>
                                                                                    <th scope="col">SL</th>
                                                                                    <th class="text-uppercase"
                                                                                        data-sort="invoice_id">User ID
                                                                                    </th>
                                                                                    <th class="text-uppercase"
                                                                                        data-sort="customer_name">
                                                                                        Customer
                                                                                    </th>
                                                                                    <th class="text-uppercase" data-sort="date">
                                                                                        Date
                                                                                    </th>
                                                                                    <th class="text-uppercase"
                                                                                        data-sort="invoice_amount">
                                                                                        Amount
                                                                                    </th>
                                                                                    <th class="text-uppercase" data-sort="status">
                                                                                        Payment
                                                                                        Status
                                                                                    </th>
                                                                                    <th class="text-uppercase" data-sort="action">
                                                                                        Action
                                                                                    </th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <?php $__empty_1 = true; $__currentLoopData = $customer->invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                                                    <tr>
                                                                                        <td class="fw-medium text-center">
                                                                                            <?php echo e($key + 1); ?></td>
                                                                                        <td><?php echo e($invoice->customer->unique_id); ?>

                                                                                        </td>
                                                                                        <td><?php echo e(ucfirst($invoice->customer->name)); ?>

                                                                                        </td>
                                                                                        <td><?php echo e($invoice->created_at); ?>

                                                                                        </td>
                                                                                        <td><?php echo e(number_format($invoice->total_amount)); ?>

                                                                                        </td>
                                                                                        <td><?php echo displayPaymentStatusBadge($invoice->status); ?></td>
                                                                                        <td>
                                                                                            <div class="hstack gap-1">
                                                                                                <?php if (\Illuminate\Support\Facades\Blade::check('hasPermission', 'Update Invoice')): ?>
                                                                                                    <a href="<?php echo e(route('admin.customers-invoices.show', $invoice->id)); ?>"
                                                                                                        class="btn btn-sm btn-clr-red waves-effect waves-light">
                                                                                                        <i
                                                                                                            class="ri-eye-2-line align-bottom me-1"></i>
                                                                                                        View
                                                                                                    </a>
                                                                                                <?php endif; ?>
                                                                                                <?php if (\Illuminate\Support\Facades\Blade::check('hasPermission', 'Update Invoice')): ?>
                                                                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check(\App\Permissions::EDIT_CUSTOMER_INVOICE)): ?>
                                                                                                        <a href="<?php echo e(route('admin.customers-invoices.edit', $invoice->id)); ?>"
                                                                                                            class="btn btn-sm btn-outline-primary waves-effect waves-light">
                                                                                                            <i
                                                                                                                class="ri-pencil-line align-bottom me-1"></i>
                                                                                                            Edit
                                                                                                        </a>
                                                                                                    <?php endif; ?>
                                                                                                <?php endif; ?>
                                                                                                <?php if (\Illuminate\Support\Facades\Blade::check('hasPermission', 'Delete Invoice')): ?>
                                                                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check(\App\Permissions::DELETE_CUSTOMER_INVOICE)): ?>
                                                                                                        <button type="button"
                                                                                                            class="btn btn-sm btn-outline-danger waves-effect waves-light"
                                                                                                            onclick="deleteData(<?php echo e($invoice->id); ?>)">
                                                                                                            <i
                                                                                                                class="ri-delete-bin-5-line align-bottom me-1"></i>
                                                                                                            Delete
                                                                                                        </button>
                                                                                                        <form
                                                                                                            id="delete-form-<?php echo e($invoice->id); ?>"
                                                                                                            action="<?php echo e(route('admin.customers-invoices.destroy', $invoice->id)); ?>"
                                                                                                            method="POST"
                                                                                                            style="display: none;">
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
                                        <?php else: ?>
                                            <div class="tab-pane" id="generatedBill" role="tabpanel">
                                                <div class="row">
                                                    <div class="bg-clr-red mb-4 rounded-1">
                                                        <h5 class="mb-sm-0 text-light py-2">Generated Customer Bills</h5>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="card" id="invoiceList">
                                                            <div class="card-header border-0">
                                                                <div class="d-flex align-items-center">
                                                                    <h5 class="card-title mb-0 flex-grow-1">Invoices</h5>
                                                                    <div class="flex-shrink-0">
                                                                        <div>
                                                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check(\App\Permissions::CREATE_CUSTOMER_INVOICE)): ?>
                                                                                <a href="<?php echo e(route('admin.customers-invoices.create', $customer->id)); ?>"
                                                                                    class="btn btn-clr-red waves-effect waves-light">
                                                                                    <i class="ri-file-add-line align-bottom me-1"></i>
                                                                                    Create Invoice
                                                                                </a>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card-body">
                                                                <div>
                                                                    <div class="table-responsive table-card">
                                                                        <table class="table align-middle table-nowrap"
                                                                            id="invoiceTable">
                                                                            <thead class="text-muted">
                                                                                <tr>
                                                                                    <th scope="col">SL</th>
                                                                                    <th class="text-uppercase"
                                                                                        data-sort="invoice_id">User ID
                                                                                    </th>
                                                                                    <th class="text-uppercase"
                                                                                        data-sort="customer_name">
                                                                                        Customer
                                                                                    </th>
                                                                                    <th class="text-uppercase" data-sort="date">
                                                                                        Date
                                                                                    </th>
                                                                                    <th class="text-uppercase"
                                                                                        data-sort="invoice_amount">
                                                                                        Amount
                                                                                    </th>
                                                                                    <th class="text-uppercase" data-sort="status">
                                                                                        Payment
                                                                                        Status
                                                                                    </th>
                                                                                    <th class="text-uppercase" data-sort="action">
                                                                                        Action
                                                                                    </th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td>No record Found.</td>
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
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <!--end Generated Bill tab-pane-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <script>
        function toggleVisaStatusDropdown() {
            $('#updateVisaStatusForm').show();
            $('#mainContent').hide();

            $('#updateCustomerForm').show();
            $('#customerItems').hide();
        }

        function cancelUpdate() {
            $('#mainContent').show();
            $('#customerItems').show();

            $('#updateVisaStatusForm').hide();
            $('#updateCustomerForm').hide();
        }

        $(document).ready(function() {
            $(document).on('change', '.document-status', function() {
                const customerId = $(this).data('customer-id');
                const documentId = $(this).data('document-id');
                const formId = $(this).data('form-id');
                const status = $(`input[name=document_status_${documentId}]:checked`).val();

                $.ajax({
                    type: 'PATCH',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '/admin/customers/' + customerId + '/forms/' + formId + '/documents/' +
                        documentId + '/update-status',
                    data: {
                        customer_id: customerId,
                        document_id: documentId,
                        form_id: formId,
                        status: status
                    },
                    success: function(response) {
                        $(`#document-status-${response.document_id}`).text(response.status);
                        Toastify({
                            text: response.message,
                            duration: 3000,
                            newWindow: false,
                            close: true,
                            gravity: "top",
                            position: "right",
                            stopOnFocus: true,
                            style: {
                                background: "linear-gradient(to right, #00b09b, #96c93d)",
                            },
                            onClick: function() {}
                        }).showToast();
                    },
                    error: function(error) {
                        Toastify({
                            text: error.message,
                            duration: 3000,
                            newWindow: true,
                            close: true,
                            gravity: "top",
                            position: "right",
                            stopOnFocus: true,
                            style: {
                                background: "linear-gradient(to right, #ff5f6d, #ffc371)",
                            },
                            onClick: function() {}
                        }).showToast();
                    }
                });
            });
        });
    </script>




    
    <script>
        // Function to open the PDF in a new window and trigger print dialog
        function printPDF(docs) {
            var pdfWindow = window.open("<?php echo e(asset('uploads/visa-forms/documents/')); ?>" + "/" + docs, "_blank");
            pdfWindow.onload = function() {
                pdfWindow.print();
                pdfWindow.onafterprint = function() {
                    pdfWindow.close(); // Close the window after printing
                };
            };
        }
    </script>


    

    <script type="text/javascript">
        var i = 0;

        $("#add").click(function() {
            ++i;
            $("#dynamicTable").append('<tr><td><input type="text" name="addMore[' + i +
                '][name]" placeholder="Enter your Name" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>'
            );
        });

        $(document).on('click', '.remove-tr', function() {
            $(this).parents('tr').remove();
        });
    </script>

    <!-- glightbox js -->
    <script src="<?php echo e(asset('backend/assets/libs/glightbox/js/glightbox.min.js')); ?>"></script>

    <script src="<?php echo e(asset('backend/assets/js/pages/gallery.init.js')); ?>"></script>


    <!-- ckeditor -->
    <script src="<?php echo e(asset('backend/assets/libs/%40ckeditor/ckeditor5-build-classic/build/ckeditor.js')); ?>"></script>
    <!-- init js -->
    <script src="<?php echo e(asset('backend/assets/js/pages/form-editor.init.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.backend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/bokhtiartoshar/Desktop/Project/Sajon Bhai/visaExpert.com-master/resources/views/backend/customer/show.blade.php ENDPATH**/ ?>
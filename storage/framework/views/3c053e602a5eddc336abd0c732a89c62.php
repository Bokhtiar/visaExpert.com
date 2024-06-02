<?php $__env->startSection('title', 'Invoice Details'); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Invoice Details</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Invoices</a></li>
                        <li class="breadcrumb-item active">Invoice Details</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-xxl-9">
            <div class="card">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-header border-bottom-dashed p-4">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <h4 style="user-select: none;text-wrap: nowrap;">
                                        <img src="<?php echo e(asset('backend/assets/images/logo.jpg')); ?>" alt="Logo"
                                            height="40">
                                        <?php echo e(config('app.name')); ?>

                                    </h4>
                                </div>
                                <div class="flex-grow-1 text-center">
                                    <img src="<?php echo e(asset('backend/assets/images/visiting-card.jpg')); ?>" alt="Visiting Card"
                                        class="visiting-card">
                                </div>
                                <div class="flex-grow-1">
                                    <div class="">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <div>
                                                <h6 class="text-muted text-uppercase fw-semibold">Date</h6>
                                                <p class="text-muted text-nowrap mb-1" id="address-details">
                                                    <?php echo e($invoice->created_at->format('d M Y')); ?>

                                                </p>
                                            </div>
                                            <div class="text-nowrap ms-5">
                                                <h6 class="text-muted text-uppercase fw-semibold">Payment Status</h6>
                                                <p class="text-muted mb-1" id="payment-status"><?php echo e($invoice->status); ?>

                                                </p>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <h6 class="text-muted text-uppercase fw-semibold">Total Amount (BDT)</h6>
                                            <p class="text-muted mb-1" id=""><?php echo e($invoice->total_amount); ?>

                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card-body p-4">
                            <div class="row g-3">
                                <div class="col-lg-3 col-6">
                                    <p class="text-muted mb-2 text-uppercase fw-semibold">User ID</p>
                                    <h5 class="fs-14 mb-0"><span id="invoice-no">#<?php echo e($invoice->customer->unique_id); ?></span>
                                    </h5>
                                </div>
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card-body p-4 border-top border-top-dashed">
                            <div class="row g-3">
                                <div class="col-12">
                                    <h6 class="text-muted text-uppercase fw-semibold mb-3">Customer
                                        Address</h6>
                                    <p class="fw-medium mb-2" id="billing-name"><?php echo e($invoice->customer->name); ?></p>
                                    <p class="text-muted mb-1">Phone: <span
                                            id="billing-phone-no"><?php echo e($invoice->customer->phone); ?></span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card-body p-4">
                            <div class="table-responsive">
                                <table class="table table-borderless text-center table-nowrap align-middle mb-0">
                                    <thead>
                                        <tr class="table-active">
                                            <th scope="col">#</th>
                                            <th scope="col">Details</th>
                                            <th scope="col">Qty</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Amount (BDT)</th>
                                        </tr>
                                    </thead>
                                    <tbody id="products-list">
                                        <?php $__currentLoopData = $invoice->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $invoiceItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <th scope=""><?php echo e($key + 1); ?></th>
                                                <td class="">

                                                    <?php echo e($invoiceItem->item); ?>


                                                </td>
                                                <td>
                                                    <?php echo e($invoiceItem->qty); ?>

                                                </td>

                                                <td><?php echo e($invoiceItem->qty . 'X' . $invoiceItem->amount / $invoiceItem->qty); ?>

                                                </td>

                                                <td>
                                                    <?php echo e($invoiceItem->amount); ?>

                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                    </tbody>
                                </table>
                            </div>


                            <style>
                                .container1 {
                                    width: 100%;
                                    overflow: hidden;
                                    /* Clearfix to contain floated elements */
                                }

                                .left {
                                    float: left;
                                    width: 60%;
                                }

                                .right {
                                    float: right;
                                    width: 40%;
                                    text-align: end
                                }
                            </style>

                            <div class="container1">
                                <div class="left">

                                </div>
                               
                                <div class="right text-end">
                                    <p class="d-flex justify-content-between" style="margin-bottom: 0px;">
                                        <strong style="font-size: 16px;margin-right: 30px"> Total Amount (BDT) </strong>
                                        <strong style="font-size: 16px"><?php echo e($invoice->total_amount); ?></strong>
                                    </p>

                                     <p class="d-flex justify-content-between" style="margin-bottom: 0px;">
                                        <strong style="font-size: 16px;margin-right: 36px"> Discount(%) </strong>
                                        <strong
                                            style="font-size: 16px"><?php echo e(number_format(($invoice->discount / $invoice->total_amount) * 100, 0)); ?>

                                            %</strong>
                                    </p>

                                     <p class="d-flex justify-content-between" style="margin-bottom: 0px;">
                                        <strong style="font-size: 16px;margin-right: 30px"> Payable </strong>
                                        <strong style="font-size: 16px"><?php echo e($invoice->total_amount); ?></strong>
                                    </p>

                                    <p class="d-flex justify-content-between" style="margin-bottom: 0px;">
                                        <strong style="font-size: 16px;margin-right: 30px"> Recived </strong>
                                        <strong style="font-size: 16px">
                                            <?php echo e(App\Models\PaymentLog::where('invoice_id', $invoice->id)->sum('pay')); ?>

                                        </strong>
                                    </p>

                                    

                                    

                                    

                                   

                                    


                                    <p class="d-flex justify-content-between" style="margin-bottom: 0px;">
                                        <strong style="font-size: 16px;margin-right: 30px"> Due </strong>
                                        <strong style="font-size: 16px">
                                            

                                            <?php echo e($invoice->total_amount -  App\Models\PaymentLog::where('invoice_id', $invoice->id)->sum('pay')); ?>

                                        </strong>
                                    </p>

                                    

                                </div>
                            </div>












                            <p class="" style="font-size: 11px; line-height: 10px;">
                                <Strong> Note:</Strong> Customer must check the file/task before receiving because after
                                delivery the task
                                authority will not take any responsibility and risk. The invoice will be valueless after 3
                                days from the
                                issuing date and customer must collect the work before expiry the invoice.
                            </p>
                            
                            <?php if (\Illuminate\Support\Facades\Blade::check('hasPermission', 'Download Invoice')): ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check(\App\Permissions::DOWNLOAD_CUSTOMER_INVOICE)): ?>
                                <div class="hstack gap-2 justify-content-end d-print-none mt-4">
                                    <a href="javascript:window.print()" class="btn btn-soft-primary"><i
                                            class="ri-printer-line align-bottom me-1"></i> Print</a>
                                    <a href="<?php echo e(route('admin.customers-invoices.download', $invoice->id)); ?>"
                                        class="btn btn-primary"><i class="ri-download-2-line align-bottom me-1"></i> Download
                                    </a>
                                </div>
                            <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <script src="<?php echo e(asset('backend/assets/js/pages/invoicedetails.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.backend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\visa\resources\views/backend/customer/invoice/details.blade.php ENDPATH**/ ?>
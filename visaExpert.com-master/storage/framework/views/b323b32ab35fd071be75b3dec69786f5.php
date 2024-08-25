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
                            <div class="row">
                                
                                <div class="col-md-2 col-lg-2 col-sm-2">
                                    <img src="<?php echo e(asset('backend/assets/images/logo.jpg')); ?>" alt="Logo" height="96px"
                                        width="96">
                                    <h5 style="font-size: 16px;"><?php echo e(config('app.name')); ?></h5>
                                </div>
                                
                                <div class="col-md-6 col-lg-6 col-sm-6">
                                    <img src="<?php echo e(asset('backend/assets/images/visiting-card.jpg')); ?>" alt="Visiting Card"
                                        class="" height="180px" width="100%">
                                </div>
                                
                                <div class="col-md-4 col-lg-4 col-sm-4 my-auto">
                                    <p class="m-0" style="font-weight: 600; font-size: 20px">Visa Expert</p>
                                    <p class="m-0" style="font-weight: 600">Rahim Towe.Subhanighat, sylhet-3100,
                                        Bangladesh</p>
                                    <p class="m-0" style="font-weight: 600">Emial: helpline@visaxpert.net</p>
                                    <p class="m-0" style="font-weight: 600">Hotline: +8801703605660</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card-body p-4"> 
                            
                            <div style="font-size: 14px; line-height: 16px; margin-bottom: 12px">
                               Dear <?php echo e($customers[0]->name); ?>,
                                Thank you fo choosing Visa Expert. Your invoice has been confirmed on <?php echo e($invoice->created_at->format('D, jS M Y - H:i')); ?>.
                                Your Booking ID/User ID #<?php echo e($customers[0]->id); ?>, & Payment status Paid as the payable amount <?php echo e($invoice->total_amount - $invoice->discount); ?>(BDT)
                            </div>
                             
                            <div class="row g-3 mt-2">
                                <div>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col">USER ID</th>
                                                <th scope="col">CUSTOMER NAME</th>
                                                <th scope="col">CUSTOMER PHONE</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($item->id); ?></td>
                                                    <td><?php echo e($item->name); ?></td>
                                                    <td><?php echo e($item->phone); ?></td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
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
                                            <th scope="col">#SL</th>
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
                                        <strong style="font-size: 16px;margin-right: 36px"> Discount(
                                            <?php echo e(number_format(($invoice->discount / $invoice->total_amount) * 100, 0)); ?>%)
                                        </strong>
                                        <strong style="font-size: 16px"><?php echo e($invoice->discount); ?>

                                        </strong>
                                    </p>

                                    <p class="d-flex justify-content-between" style="margin-bottom: 0px;">
                                        <strong style="font-size: 16px;margin-right: 30px"> Payable </strong>
                                        <strong
                                            style="font-size: 16px"><?php echo e($invoice->total_amount - $invoice->discount); ?></strong>
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
                                            <?php
                                                $totalDue =
                                                    $invoice->total_amount -
                                                    App\Models\PaymentLog::where('invoice_id', $invoice->id)->sum(
                                                        'pay',
                                                    );
                                            ?>
                                            <?php echo e($totalDue - $invoice->discount); ?>

                                        </strong>
                                    </p>

                                    

                                </div>
                            </div>












                            <p class="" style="font-size: 11px; line-height: 10px; margin-top: 15px">
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

<?php echo $__env->make('layouts.backend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/bokhtiartoshar/Desktop/Project/Sajon Bhai/visxpert/visaExpert.com-master/resources/views/backend/customer/invoice/details.blade.php ENDPATH**/ ?>
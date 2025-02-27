<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice Details</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 0;
            /* Remove default margin */
            padding: 0;
            /* Remove default padding */
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -15px;
        }

        .col {
            padding: 0 15px;
            box-sizing: border-box;
        }

        .col-12 {
            width: 100%;
        }

        .card {
            /* border: 1px solid #ccc; */
            padding: 20px;
            margin-bottom: 20px;
        }

        .three-columns-flex {
            display: flex;
            /* Use Flexbox */
            justify-content: space-between;
            /* Distribute space between items */
            align-items: center;
            /* Center items vertically */
            margin-bottom: 20px;
            /* Space below the header */
        }

        .column {
            flex: 1;
            /* Each column takes equal space */
            text-align: center;
            /* Center text in columns */
        }

        .logo img,
        .visiting-card img {
            max-width: 100%;
            /* Ensures images are responsive */
            height: auto;
            /* Maintain aspect ratio */
        }

        .logo {
            max-width: 20%;
            /* Logo can take up to 20% of the space */
        }

        .visiting-card {
            max-width: 40%;
            /* Visiting card can take up to 40% of the space */
        }

        .contact-info {
            max-width: 35%;
            /* Contact info can take up to 35% of the space */
            text-align: left;
            /* Align text to the left */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            /* Add margin to the top of the table */
        }

        table,
        th,
        td {
            border: 1px solid gray;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        .d-flex {
            display: flex;
            justify-content: space-between;
        }

        .container1 {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }


        .flex {
            display: flex;
            flex-flow: row wrap;
            /*justify-content: space-between;*/
            /* space-around */
            align-content: center;
            align-items: baseline;
        }

        /* body */
        .flex-item {
            width: 100%;
            height: 300px;
        }
    </style>
</head>

<body>




    <div class="row">
        <div class="col-12">
            <div class="card">


                <table style="border: 0; width: 100%; border-collapse: collapse; cellspacing: 0;">
                    <tr style="border: 0;">
                        <td style="width: 33%; text-align: center; border: 0; vertical-align: top;">
                            <!-- Align logo to the top -->
                            <img src="<?php echo e(public_path('backend/assets/images/logo.jpg')); ?>" alt="Logo" height="96px"
                                width="100%">
                            <h5 style="font-size: 16px; margin: 0;"><?php echo e(config('app.name')); ?></h5>
                        </td>
                        <td style="width: 34%; text-align: center; border: 0; vertical-align: top;">
                            <!-- Centered visiting card -->
                            <img src="<?php echo e(public_path('backend/assets/images/visiting-card.jpeg')); ?>" alt="Visiting Card"
                                height="200px" width="auto"> <!-- Increased height -->
                        </td>
                        <td style="width: 33%; vertical-align: top; border: 0; font-size: 16px; color:gray">
                            <!-- Align text to the top -->
                            <p style="font-size: 20px; margin-top: 0;">Visa Expert</p>
                            <p style="margin: 0;">Rahim Tower, Subhanighat, Sylhet-3100, Bangladesh</p>
                            <p style="margin: 0;">Email: helpline@visaxpert.net</p>
                            <p style="margin: 0;">Hotline: +8801703605660</p>
                        </td>
                    </tr>
                </table>




                <div class="card-body" style="color:gray">
                    <p>Dear <?php echo e($customers[0]->name); ?>,</p>
                    <p>Thank you for choosing Visa Expert. Your invoice was confirmed on
                        <?php echo e($invoice->created_at->format('D, jS M Y - H:i')); ?>. Your Booking ID/User ID is
                        #<?php echo e($customers[0]->id); ?>, & Payment status: Paid (BDT
                        <?php echo e($invoice->total_amount - $invoice->discount); ?>).</p>

                    <table>
                        <thead>
                            <tr>
                                <th>USER ID</th>
                                <th>CUSTOMER NAME</th>
                                <th>CUSTOMER PHONE</th>
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

                    <table class="" style="margin-top: 20px">
                        <thead>
                            <tr>
                                <th>#SL</th>
                                <th>Details</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Amount (BDT)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $invoice->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $invoiceItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($key + 1); ?></td>
                                    <td><?php echo e($invoiceItem->item); ?></td>
                                    <td><?php echo e($invoiceItem->qty); ?></td>
                                    <td><?php echo e($invoiceItem->qty); ?> X
                                        <?php echo e(number_format($invoiceItem->amount / $invoiceItem->qty, 2)); ?></td>
                                    <td><?php echo e($invoiceItem->amount); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>

                    <div style="display: flex; justify-content: space-between; align-items: flex-start; padding: 20px;">

                        <div style="margin-left: 67%">
                            <p style="margin: 0; padding: 5px 0;">
                                <strong>Total Amount (BDT):</strong> <?php echo e($invoice->total_amount); ?>

                            </p>
                            <p style="margin: 0; padding: 5px 0;">
                                <strong>Discount
                                    (<?php echo e(number_format(($invoice->discount / $invoice->total_amount) * 100, 0)); ?>%):</strong>
                                <?php echo e($invoice->discount); ?>

                            </p>
                            <p style="margin: 0; padding: 5px 0;">
                                <strong>Payable:</strong> <?php echo e($invoice->total_amount - $invoice->discount); ?>

                            </p>
                            <p style="margin: 0; padding: 5px 0;">
                                <strong>Received:</strong>
                                <?php echo e(App\Models\PaymentLog::where('invoice_id', $invoice->id)->sum('pay')); ?>

                            </p>
                            <p style="margin: 0; padding: 5px 0;">
                                <strong>Due:</strong>
                                <?php
                                    $totalDue =
                                        $invoice->total_amount -
                                        App\Models\PaymentLog::where('invoice_id', $invoice->id)->sum('pay');
                                ?>
                                <?php echo e($totalDue - $invoice->discount); ?>

                            </p>
                        </div>
                    </div>




                    <p class="" style="font-size: 13px; line-height: 11px; margin-top: 15px">
                        <Strong> Note:</Strong> Customer must check the file/task before receiving because after
                        delivery the task
                        authority will not take any responsibility and risk. The invoice will be valueless after 3
                        days from the
                        issuing date and customer must collect the work before expiry the invoice.
                    </p>

                    <?php if($invoice->remarks): ?>
                        <p class="" style="font-size: 11px; line-height: 10px; margin-top: 15px">
                            <Strong> Remarks:</Strong> <?php echo e($invoice->remarks); ?>

                        </p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
<?php /**PATH /Users/bokhtiartoshar/Desktop/Project/Sajon Bhai/visaExpert.com-master/resources/views/backend/customer/invoice/pdf.blade.php ENDPATH**/ ?>
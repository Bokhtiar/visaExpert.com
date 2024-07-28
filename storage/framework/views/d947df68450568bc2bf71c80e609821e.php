<?php $__env->startSection('title', isset($invoice) ? 'Edit Invoice' : 'Create Invoice'); ?>

<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0"><?php echo e(isset($invoice) ? 'Edit Invoice' : 'Create Invoice'); ?></h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Invoices</a></li>
                        <li class="breadcrumb-item active"><?php echo e(isset($invoice) ? 'Edit Invoice' : 'Create Invoice'); ?></li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <h5>Relavent Customer List: </h5>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">SL</th>
                <th scope="col">Customer</th>
                <th scope="col">Phone</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $customerList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cus): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <th scope="row"><?php echo e($loop->index + 1); ?></th>
                    <td><?php echo e($cus->name); ?> <span class=""
                            style="color: red"><?php echo e($cus->id == $cus->parent_customer_id ? '(Owner)' : ''); ?></span> </td>
                    <td><?php echo e($cus->phone); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    <div class="row justify-content-center">
        <div class="col-xxl-9">
            <div class="card">
                <form
                    action="<?php echo e(isset($invoice) ? route('admin.customers-invoices.update', $invoice->id) : route('admin.customers-invoices.store')); ?>"
                    class="needs-validation" novalidate id="invoice_form" method="POST">
                    <?php if(isset($invoice)): ?>
                        <?php echo method_field('PATCH'); ?>
                    <?php endif; ?>
                    <?php echo csrf_field(); ?>
                    <div class="card-body border-bottom border-bottom-dashed p-4">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="profile-user mx-auto mb-3">
                                    <h4 class="overflow-hidden border border-dashed d-flex align-items-center justify-content-start rounded"
                                        style="height: 60px; width: 256px;">
                                        <span><?php echo e(config('app.name')); ?></span>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-3">
                            <input type="hidden" name="form_id"
                                value="<?php echo e(isset($invoice) ? $invoice->customer->forms[0]->id : $customer->forms[0]->id); ?>">
                            <input type="hidden" name="customer_id"
                                value="<?php echo e(isset($invoice) ? $invoice->customer->id : $customer->id); ?>">
                            <div class="col-lg-3 col-sm-6">
                                <label for="invoicenoInput">User ID</label>
                                <input type="text" class="form-control bg-light border-0" id="invoicenoInput"
                                    value="#<?php echo e(isset($invoice) ? $invoice->customer->unique_id : $customer->unique_id); ?>"
                                    readonly="readonly" />
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div>
                                    <label for="date-field">Date</label>
                                    <input type="date" min="<?php echo e(date('Y-m-d')); ?>" class="form-control bg-light border-0"
                                        id="date-field" value="<?php echo e(date('Y-m-d')); ?>" data-provider="flatpickr"
                                        data-time="true" readonly disabled>
                                </div>
                            </div>
                            
                            <input type="hidden" name="status" value="Due" id="">
                            <div class="col-lg-3 col-sm-6">
                                <div>
                                    <label for="cart-total">Total Amount</label>
                                    <?php if(isset($invoice)): ?>
                                        <input type="text" name="amount" class="form-control bg-light border-0"
                                            value="<?php echo e($invoice->total_amount); ?>" readonly="readonly" />
                                    <?php else: ?>
                                        <input type="text" name="amount" id="invoice-total"
                                            class="form-control bg-light border-0" placeholder="0.00" readonly="readonly" />
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="col-lg-3 col-sm-6">
                                <div>
                                    <label for="cart-total">By Road</label>
                                    <?php if(isset($invoice)): ?>
                                        <select class="form-control" name="road_id"  id="">
                                            <?php $__currentLoopData = $roads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $road): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($road->id); ?>"
                                                    <?php echo e($road->id == $invoice->road_id ? 'selected' : ''); ?>><?php echo e($road->name); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    <?php else: ?>
                                        <select class="form-control" name="road_id" required id="">
                                            <option value="">Select by road</option>
                                            <?php $__currentLoopData = $roads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $road): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($road->id); ?>"><?php echo e($road->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-4 border-top border-top-dashed">
                        <div class="row">
                            <div class="col-lg-4 col-sm-6">
                                <div>
                                    <label for="billingName" class="text-muted text-uppercase fw-semibold">Customer
                                        Address</label>
                                </div>
                                <div class="mb-2">
                                    <input type="text" class="form-control bg-light border-0" id="billingName"
                                        value="<?php echo e(isset($invoice) ? $invoice->customer->name : $customer->name); ?>"
                                        readonly="readonly">
                                </div>
                                <div class="mb-2">
                                    <input type="text" class="form-control bg-light border-0"
                                        data-plugin="cleave-phone" id="billingPhoneno"
                                        value="<?php echo e(isset($invoice) ? $invoice->customer->phone : $customer->phone); ?>"
                                        readonly="readonly">
                                    <div class="invalid-feedback">
                                        Please enter a phone number
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <?php if(isset($invoice)): ?>
                        <div class="card-body p-4">
                            <div class="table-responsive">
                                <table class="table table-borderless text-center table-nowrap align-middle mb-0">
                                    <thead>
                                        <tr class="table-active">
                                            <th scope="col" style="width: 50px;">#</th>
                                            <th scope="col">Details</th>
                                            <th scope="col">Qty</th>
                                            <th scope="col" class="text-end">Amount (BDT)</th>
                                        </tr>
                                    </thead>
                                    <tbody id="products-list">
                                        <?php $__currentLoopData = $invoice->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $invoiceItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <th scope="row"><?php echo e($key + 1); ?></th>
                                                <td class="text-center">
                                                    <span class="fw-medium">
                                                        <?php echo e($invoiceItem->item); ?>

                                                    </span>
                                                </td>
                                                <td><?php echo e($invoiceItem->qty); ?></td>
                                                <td class="text-end">
                                                    <?php echo e($invoiceItem->amount); ?>

                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="border-top border-top-dashed mt-2">
                                <table class="table table-borderless table-nowrap align-middle mb-0 ms-auto"
                                    style="width:550px">
                                    <tbody>
                                        

                                        <tr class="border-top border-top-dashed mt-2">
                                            <td colspan="2" class="text-end">
                                                <h6>Total Amount (BDT) :</h6>
                                            </td>
                                            <td colspan="3" class="p-0">
                                                <table class="table table-borderless table-sm table-nowrap align-middle mb-0">
                                                    <tbody>
                                                        <tr class="border-top border-top-dashed">
                                                            <th scope="row"></th>
                                                            <td>
                                                                <?php echo e($invoice->total_amount); ?>

                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>





                                        
                                        
                                        <?php
                                            $total_pay = 0;
                                        ?>
                                        <?php $__currentLoopData = $payables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pay): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            
                                            <?php
                                                $total_pay += $pay->pay;
                                            ?>
                                            <tr class="border-top border-top-dashed mt-2">
                                                <td colspan="2" class="text-end">
                                                    <h6>Pay <?php echo e($loop->index + 1); ?> (<?php echo e($pay->created_at->format('Y-m-d')); ?>)
                                                    </h6>
                                                </td>
                                                <td colspan="3" class="p-0">
                                                    <table
                                                        class="table table-borderless table-sm table-nowrap align-middle mb-0">
                                                        <tbody>
                                                            <tr class="border-top border-top-dashed">
                                                                <th scope="row"></th>
                                                                <td>

                                                                    <input type="number" name=""
                                                                        value="<?php echo e($pay->pay); ?>"
                                                                        class="form-control bg-light border-0" placeholder="0"
                                                                        readonly />
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        <tr class="border-top border-top-dashed mt-2">
                                            <td colspan="2" class="text-end">
                                                <h6>Total Paid:</h6>
                                            </td>
                                            <td colspan="3" class="p-0">
                                                <table class="table table-borderless table-sm table-nowrap align-middle mb-0">
                                                    <tbody>
                                                        <tr class="border-top border-top-dashed">
                                                            <th scope="row"></th>
                                                            <td>
                                                                <input type="number" name=""
                                                                    value="<?php echo e($total_pay); ?>"
                                                                    class="form-control bg-light border-0" placeholder="0"
                                                                    readonly />
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>

                                           <tr class="border-top border-top-dashed mt-2">
                                            <td colspan="2" class="text-end">
                                                <h6>Due amount:</h6>
                                            </td>
                                            <td colspan="3" class="p-0">
                                                <table class="table table-borderless table-sm table-nowrap align-middle mb-0">
                                                    <tbody>
                                                        <tr class="border-top border-top-dashed">
                                                            <th scope="row"></th>
                                                            <td> 
                                                                <input type="number" name=""
                                                                    value="<?php echo e($invoice->total_amount -  $total_pay); ?>"
                                                                    class="form-control bg-light border-0" placeholder="0"
                                                                    readonly />
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>

                                        
                                        <tr class="border-top border-top-dashed mt-2">
                                            <td colspan="2" class="text-end">
                                                <h6>Discount (Taka) : </h6>
                                            </td>
                                            <td colspan="3" class="p-0">
                                                <table class="table table-borderless table-sm table-nowrap align-middle mb-0">
                                                    <tbody>
                                                        <tr class="border-top border-top-dashed">
                                                            <th scope="row"></th>
                                                            <td>
                                                                <input type="text" name="discount"
                                                                    value="<?php echo e($invoice->discount); ?>"
                                                                    class="form-control bg-light border-0" placeholder="0" />
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>








                                        <tr class="border-top border-top-dashed mt-2">
                                            <td colspan="2" class="text-end">
                                                <h6>Received:</h6>
                                            </td>
                                            <td colspan="3" class="p-0">
                                                <table class="table table-borderless table-sm table-nowrap align-middle mb-0">
                                                    <tbody>
                                                        <tr class="border-top border-top-dashed">
                                                            <th scope="row"></th>
                                                            <td>
                                                                <input type="number" name="pay"
                                                                    class="form-control bg-light border-0"
                                                                    id="receive_payment" placeholder="0" required />
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>


                                        <tr class="border-top border-top-dashed mt-2">
                                            <td colspan="2" class="text-end">

                                            </td>
                                            <td colspan="3" class="p-0">
                                                <table class="table table-borderless table-sm table-nowrap align-middle mb-0">
                                                    <tbody>
                                                        <tr class="border-top border-top-dashed">
                                                            <th scope="row"></th>
                                                            <td>
                                                                <input type="hidden" name="due"
                                                                    value="<?php echo e($invoice->total_amount - $total_pay); ?>"
                                                                    class="form-control bg-light border-0" placeholder="0" />
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                            <div class="hstack gap-2 justify-content-end d-print-none mt-4">
                                <button type="submit" class="btn btn-success"><i
                                        class="ri-file-add-line align-bottom me-1"></i> Update
                                </button>
                            </div>
                        </div>
                    <?php else: ?>
                    
                        <div class="card-body p-4">
                            <div class="table-responsive">
                                <table class="invoice-table table table-borderless table-nowrap mb-0">
                                    <thead class="align-middle">
                                        <tr class="table-active">
                                            <th scope="col" style="width: 50px;">#</th>
                                            <th scope="col">
                                                Details
                                            </th>

                                            <th scope="col">
                                                Qty
                                            </th>

                                            <th scope="col" class="text-end" style="width: 150px;">Amount (BDT)</th>
                                            <th scope="col" class="text-end" style="width: 105px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="newlink">
                                        <tr id="1" class="product">
                                            <th scope="row" class="product-id">1</th>
                                            <td>
                                                <div class="input-light">
                                                    <select class="form-control bg-light border-0" name="items[]"
                                                        id="serviceDropdown" required="">
                                                        <option selected disabled>Select a Service type</option>
                                                        <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($service->title); ?>"
                                                                <?php if(old($service->title) == $service->title): ?> selected <?php endif; ?>
                                                                data-amount="<?php echo e(auth()->user()->role->name == 'agent' ? $service->agent_amount : $service->customer_amount); ?>">
                                                               <?php echo e($service->title); ?> (<?php echo e(auth()->user()->role->name == 'agent' ? $service->agent_amount : $service->customer_amount); ?>Tk)
                                                            </option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <input type="text" name="qty[]" class="product-qty" id="">
                                            </td>
                                            <td class="text-end">
                                                <div>
                                                    <input type="text" name="amount[]"
                                                        class="form-control bg-light border-0 product-line-price"
                                                        id="totalamountInput" placeholder="0.00">
                                                </div>
                                            </td>
                                            <td class="product-removal">
                                                <a href="javascript:void(0)" class="btn btn-danger"
                                                    disabled="disabled">Delete</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tbody>
                                        <tr id="newForm" style="display: none;">
                                            <td class="d-none" colspan="5">
                                                <p>Add New Form</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="5">
                                                <a href="javascript:new_link()" id="add-item"
                                                    class="btn btn-soft-secondary fw-medium"><i
                                                        class="ri-add-fill me-1 align-bottom"></i> Add Item</a>
                                            </td>
                                        </tr>
                                        <tr class="border-top border-top-dashed mt-2">
                                            <td colspan="2" class="text-end">
                                                <h6>Total Amount :</h6>
                                            </td>
                                            <td colspan="3" class="p-0">
                                                <table class="table table-borderless table-sm table-nowrap align-middle mb-0">
                                                    <tbody>
                                                        <tr class="border-top border-top-dashed">
                                                            <th scope="row"></th>
                                                            <td>
                                                                <input type="text" name="total_amount"
                                                                    class="form-control bg-light border-0" id="cart-total"
                                                                    placeholder="0.00" readonly />
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>



                                        
                                        

                                        
                                        <tr class="border-top border-top-dashed mt-2">
                                            <td colspan="2" class="text-end">
                                                <h6>Discount (Taka) :</h6>
                                            </td>
                                            <td colspan="3" class="p-0">
                                                <table class="table table-borderless table-sm table-nowrap align-middle mb-0">
                                                    <tbody>
                                                        <tr class="border-top border-top-dashed">
                                                            <th scope="row"></th>
                                                            <td>
                                                                <input type="number" name="discount" value=""
                                                                    class="form-control bg-light border-0" id=""
                                                                    placeholder="0" />
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>






                                        <tr class="border-top border-top-dashed mt-2">
                                            <td colspan="2" class="text-end">
                                                <h6>Received:</h6>
                                            </td>
                                            <td colspan="3" class="p-0">
                                                <table class="table table-borderless table-sm table-nowrap align-middle mb-0">
                                                    <tbody>
                                                        <tr class="border-top border-top-dashed">
                                                            <th scope="row"></th>
                                                            <td>
                                                                <input type="number" name="pay"
                                                                    class="form-control bg-light border-0"
                                                                    id="receive_payment_save" placeholder="0" required />
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>

                                        <tr class="border-top border-top-dashed mt-2">
                                            
                                            <td colspan="3" class="p-0">
                                                <table class="table table-borderless table-sm table-nowrap align-middle mb-0">
                                                    <tbody>
                                                        <tr class="border-top border-top-dashed">
                                                            <th scope="row"></th>
                                                            <td>
                                                                <input type="hidden" name="due" value="0"
                                                                    class="form-control bg-light border-0" placeholder="0" />

                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                            <div class="hstack gap-2 justify-content-end d-print-none mt-4">
                                <button type="submit" class="btn btn-success"><i
                                        class="ri-printer-line align-bottom me-1"></i> Save
                                </button>
                            </div>
                        </div>
                    <?php endif; ?>

                </form>
            </div>

        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('js'); ?>
    



    <script>
        function calculateTotal() {
            let total = 0;
            $('.product-line-price').each(function() {
                let amount = parseFloat($(this).val()) || 0;
                total += amount;
            });
            $('#cart-total').val(total.toFixed(2));
        }

        function calculateRow(row) {
            let price = parseFloat(row.find('select[name="items[]"] option:selected').data('amount')) || 0;
            let qty = parseFloat(row.find('input[name="qty[]"]').val()) || 0;
            let total = price * qty;
            row.find('.product-line-price').val(total.toFixed(2));
            calculateTotal();
        }

        $(document).ready(function() {
            // Initial calculation
            calculateTotal();

            // Service dropdown change
            $('#newlink').on('change', 'select[name="items[]"]', function() {
                let row = $(this).closest('tr');
                calculateRow(row);
            });

            // Quantity change
            $('#newlink').on('input', 'input[name="qty[]"]', function() {
                let row = $(this).closest('tr');
                calculateRow(row);
            });

            // Remove row
            $('#newlink').on('click', 'a.btn-danger', function() {
                $(this).closest('tr').remove();
                calculateTotal();
            });

            // Add new row
            $('#add-item').on('click', function() {
                let tr = $('#newlink tr:first').clone();
                let currentId = parseInt(tr.attr('id'));
                let newId = currentId + 1;
                tr.attr('id', newId);
                tr.find('.product-id').text(newId);
                tr.find('input, textarea').val('');
                tr.find('.product-line-price').val('0.00');
                tr.appendTo('#newlink');
                calculateTotal();
            });
        });
    </script>

  
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.backend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/bokhtiartoshar/Desktop/laravel/visxpert/visaExpert.com-master/resources/views/backend/customer/invoice/form.blade.php ENDPATH**/ ?>
<?php $__env->startSection('title', 'Transfer'); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Transfer</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Transfer</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header align-items-center">
                                    <h4 class="card-title mb-0 flex-grow-1">All statement</h4>
                                    <div class="flex-shrink-0 shadow p-3">
                                        <form action="<?php echo e(route('admin.statement.index')); ?>" method="GET">
                                            <div class="row mb-3">
                                                <div class="col-md-3">
                                                    <label for="">Start date</label>
                                                    <input type="date" name="start_date" class="form-control"
                                                        value="<?php echo e(request('start_date')); ?>" placeholder="Start Date">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="">End date</label>
                                                    <input type="date" name="end_date" class="form-control"
                                                        value="<?php echo e(request('end_date')); ?>" placeholder="End Date">
                                                </div>
                                                
                                                <div class="col-md-3">
                                                    <label for="">User</label>
                                                    <select name="created_by" class="form-control">
                                                        <option value="">Select User</option>
                                                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($user->id); ?>"
                                                                <?php echo e(request('created_by') == $user->id ? 'selected' : ''); ?>>
                                                                <?php echo e($user->name); ?>

                                                            </option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>


                                                <div class="col-md-3 mt-4">
                                                    <button type="submit" class="btn btn-primary">Filter</button>
                                                </div>
                                            </div>
                                        </form>


                                    </div>

                                </div>
                                <div class="">


                                    <div class="table-responsive">
                                        <table class="table table-borderless align-middle mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th scope="col">SL</th>
                                                    <th scope="col">Date & Time</th>
                                                    <th scope="col">Work details</th>
                                                    <th scope="col">Earning</th>
                                                    <th scope="col">Spending</th>
                                                    <th scope="col">Balance</th>
                                            </thead>
                                            <tbody>

                                                <?php $__empty_1 = true; $__currentLoopData = $transfers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$transfer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                    <tr>
                                                        <td class="fw-medium"><?php echo e($key + 1); ?></td>
                                                        <td><?php echo e($transfer->created_at); ?></td>
                                                        <?php
                                                            $user = App\Models\User::find($transfer->created_by);
                                                        ?>
                                                        <?php if($transfer->type == 'expense_create' || $transfer->type == 'expense_update'): ?>
                                                            <td>
                                                                <?php echo $user->name .
                                                                    ' (' .
                                                                    ($user->role ? $user->role->name : '') .
                                                                    ')' .
                                                                    ' spending update ' .
                                                                    ($transfer->expense ? $transfer->expense->description : ''); ?>

                                                            </td>
                                                        <?php elseif($transfer->type == 'invoice_recive' || $transfer->type == 'invoice_due' || $transfer->type == 'invoice_delete'): ?>
                                                            <td><?php echo $user->name .
                                                                ' (' .
                                                                ($user->role ? $user->role->name : '') .
                                                                ')' .
                                                                $transfer->type .
                                                                ' ' .
                                                                ($transfer->customer ? $transfer->customer->name : '') .
                                                                '&' .
                                                                $transfer->customer_id; ?></td>
                                                        <?php elseif(
                                                            $transfer->type == 'balance_transfer' ||
                                                                $transfer->type == 'balance_transfer_updated' ||
                                                                $transfer->type == 'transfer_recieve'): ?>
                                                            <?php if($transfer->type == 'balance_transfer' || $transfer->type == 'balance_transfer_updated'): ?>
                                                                <td><?php echo $user->name .
                                                                    ' (' .
                                                                    ($user->role ? $user->role->name : '') .
                                                                    ')' .
                                                                    $transfer->type .
                                                                    ' ' .
                                                                    ($transfer->reciver ? $transfer->reciver->name : '') .
                                                                    '&' .
                                                                    $transfer->recive_id; ?></td>
                                                            <?php elseif($transfer->type == 'transfer_recieve' || $transfer->type == 'transfer_rejected'): ?>
                                                                <td>
                                                                    <?php echo ($transfer->reciver ? $transfer->reciver->name : '') .
                                                                        '(' .
                                                                        ($transfer->reciver ? $transfer->reciver->role->name : '') .
                                                                        ')' .
                                                                        ' ' .
                                                                        $transfer->type .
                                                                        ' from ' .
                                                                        ($transfer->transfer ? $transfer->transfer->name : '') .
                                                                        '&' .
                                                                        $transfer->created_by; ?>

                                                                </td>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                        <td>
                                                            <?php if(
                                                                $transfer->type == 'transfer_recieve' ||
                                                                    $transfer->type == 'transfer_rejected' ||
                                                                    $transfer->type == 'invoice_recive' ||
                                                                    $transfer->type == 'invoice_due' ||
                                                                    $transfer->type == 'invoice_delete'): ?>
                                                                <?php echo e($transfer->amount); ?>

                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <?php if(
                                                                $transfer->type == 'expense_create' ||
                                                                    $transfer->type == 'expense_update' ||
                                                                    $transfer->type == 'balance_transfer' ||
                                                                    $transfer->type == 'balance_transfer_updated'): ?>
                                                                <?php echo e($transfer->amount); ?>

                                                            <?php endif; ?>
                                                        </td>

                                                        <td><?php echo e($transfer->current_amount); ?> Tk</td>

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
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.backend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/bokhtiartoshar/Desktop/Project/Sajon Bhai/visaExpert.com-master/resources/views/backend/transfer/statement.blade.php ENDPATH**/ ?>
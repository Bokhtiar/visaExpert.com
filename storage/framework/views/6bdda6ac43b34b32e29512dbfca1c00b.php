<?php $__env->startSection('title', 'Daily Office Expense'); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Daily Office Expense</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item active">Daily Office Expense</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">All Expenses</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-card mb-1">
                        <table class="table table-borderless table-nowrap align-middle">
                            <thead class="text-muted table-light">
                                <tr class="text-uppercase">
                                    <th scope="col">SL</th>
                                    <th scope="col">Expense Details</th>
                                    <th scope="col">Amount (Tk)</th>
                                    <th scope="col">Date and Time</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                <?php $__empty_1 = true; $__currentLoopData = $expenses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$expense): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td class="fw-medium">
                                            <?php echo e($key + $expenses->firstItem()); ?>

                                        </td>
                                        <td>
                                            <?php echo $expense->description; ?>

                                        </td>
                                        <td>
                                            <?php echo e($expense->amount); ?>

                                        </td>
                                        <td>
                                            <?php echo e($expense->created_at->format('d M Y - g:i a')); ?>

                                        </td>
                                        <td>
                                            <div class="hstack gap-3 fs-15">
                                                <?php if (\Illuminate\Support\Facades\Blade::check('hasPermission', 'Edit Expense')): ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check(\App\Permissions::EDIT_DAILY_OFFICE_EXPENSE)): ?>
                                                    <a href="<?php echo e(route('admin.daily-office-expenses.edit', $expense->id)); ?>"
                                                        class="btn btn-primary waves-effect waves-light">
                                                        <i class="ri-pencil-line align-bottom me-1"></i>
                                                        Edit
                                                    </a>
                                                <?php endif; ?>
                                                <?php endif; ?>
                                                <?php if (\Illuminate\Support\Facades\Blade::check('hasPermission', 'Delete Expense')): ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check(\App\Permissions::DELETE_DAILY_OFFICE_EXPENSE)): ?>
                                                    <button type="button" class="btn btn-danger waves-effect waves-light"
                                                        onclick="deleteData(<?php echo e($expense->id); ?>)">
                                                        <i class="ri-delete-bin-5-line align-bottom me-1"></i>
                                                        Delete
                                                    </button>
                                                    <form id="delete-form-<?php echo e($expense->id); ?>"
                                                        action="<?php echo e(route('admin.daily-office-expenses.destroy', $expense->id)); ?>"
                                                        method="POST" style="display: none;">
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
                <?php echo e($expenses->links('pagination.default')); ?>

            </div>
        </div>
        <div class="col-lg-4">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check(\App\Permissions::CREATE_DAILY_OFFICE_EXPENSE, \App\Permissions::EDIT_DAILY_OFFICE_EXPENSE)): ?>
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1"><?php echo e(isset($dailyOfficeExpense) ? 'Edit' : 'Add'); ?> an
                            expense</h4>
                    </div>
                    <div class="card-body">
                        <form
                            action="<?php echo e(isset($dailyOfficeExpense) ? route('admin.daily-office-expenses.update', $dailyOfficeExpense->id) : route('admin.daily-office-expenses.store')); ?>"
                            method="POST">
                            <?php echo csrf_field(); ?>
                            <?php if(isset($dailyOfficeExpense)): ?>
                                <?php echo method_field('PUT'); ?>
                            <?php endif; ?>
                            <div class="my-2">
                                <label for="description" class="form-label">Expense Details</label>
                                <textarea name="description" class="ckeditor-classic" id="description"><?php echo e($dailyOfficeExpense->description ?? old('description')); ?></textarea>
                                <?php $__errorArgs = ['description'];
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
                            <div class="mb-3">
                                <label for="amount" class="form-label">Amount (Tk)</label>
                                <input type="number" id="amount"
                                    class="form-control mb-3 <?php $__errorArgs = ['amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="amount"
                                    value="<?php echo e($dailyOfficeExpense->amount ?? old('amount')); ?>">

                                <?php $__errorArgs = ['amount'];
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
                            <div class="mt-3">

                                <?php if(isset($dailyOfficeExpense)): ?>
                                    <?php if (\Illuminate\Support\Facades\Blade::check('hasPermission', 'Edit Expense')): ?>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-plus-circle"></i>
                                            <span>Update</span>
                                        </button>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <?php if (\Illuminate\Support\Facades\Blade::check('hasPermission', 'Create Expense')): ?>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-plus-circle"></i>
                                            <span>Add</span>
                                        </button>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </form>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <!-- ckeditor -->
    <script src="<?php echo e(asset('backend/assets/libs/%40ckeditor/ckeditor5-build-classic/build/ckeditor.js')); ?>"></script>

    <!-- init js -->
    <script src="<?php echo e(asset('backend/assets/js/pages/form-editor.init.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.backend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/bokhtiartoshar/Desktop/laravel/visxpert/visaExpert.com-master/resources/views/backend/daily-office-expense/index.blade.php ENDPATH**/ ?>
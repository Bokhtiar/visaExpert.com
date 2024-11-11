<?php $__env->startSection('title', 'Staff Duty & Salary'); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Staff Duty & Salary</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item active">Staff Duty & Salary</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">All Staff Duties</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-card mb-1">
                        <table class="table table-borderless table-nowrap align-middle">
                            <thead class="text-muted table-light">
                                <tr class="text-uppercase">
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Duty Finger In</th>
                                    <th scope="col">Duty Finger Out</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                <?php $__empty_1 = true; $__currentLoopData = $staffDutySalaries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td class="fw-medium">
                                            <?php echo e($staff->id); ?>

                                        </td>
                                        <td>
                                            <?php echo $staff->name; ?>

                                        </td>
                                        <td>
                                            <?php echo e(date('g:i a', strtotime($staff->duty_finger_in))); ?>

                                        </td>
                                        <td>
                                            <?php echo e(date('g:i a', strtotime($staff->duty_finger_out))); ?>

                                        </td>
                                        <td>
                                            <?php echo e($staff->created_at->format('d M Y')); ?>

                                        </td>
                                        <td>
                                            <div class="hstack gap-3 fs-15">
                                                <?php if (\Illuminate\Support\Facades\Blade::check('hasPermission', 'Edit Duty')): ?>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check(\App\Permissions::EDIT_STAFF_DUTY_SALARY)): ?>
                                                        <a href="<?php echo e(route('admin.staff-duty-salaries.edit', $staff->id)); ?>"
                                                            class="btn btn-primary waves-effect waves-light">
                                                            <i class="ri-pencil-line align-bottom me-1"></i>
                                                            Edit
                                                        </a>
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
                <?php echo e($staffDutySalaries->links('pagination.default')); ?>

            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1"><?php echo e(isset($staffDutySalary) ? 'Update' : 'Add'); ?> duty
                        time</h4>
                </div>
                <div class="card-body">
                    <form
                        action="<?php echo e(isset($staffDutySalary) ? route('admin.staff-duty-salaries.update', $staffDutySalary->id) : route('admin.staff-duty-salaries.store')); ?>"
                        method="POST">
                        <?php echo csrf_field(); ?>
                        <?php if(isset($staffDutySalary)): ?>
                            <?php echo method_field('PUT'); ?>
                        <?php endif; ?>
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" id="name"
                                class="form-control mb-3 <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="name"
                                value="<?php echo e($staffDutySalary->name ?? old('name')); ?>">

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
                        <div class="mb-3">
                            <label for="duty_finger_in" class="form-label">Duty Finger In</label>
                            <input type="time" id="duty_finger_in"
                                class="form-control mb-3 <?php $__errorArgs = ['duty_finger_in'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                name="duty_finger_in"
                                value="<?php echo e($staffDutySalary->duty_finger_in ?? old('duty_finger_in')); ?>">

                            <?php $__errorArgs = ['duty_finger_in'];
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
                            <label for="duty_finger_out" class="form-label">Duty Finger Out</label>
                            <input type="time" id="duty_finger_out"
                                class="form-control mb-3 <?php $__errorArgs = ['duty_finger_out'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                name="duty_finger_out"
                                value="<?php echo e($staffDutySalary->duty_finger_out ?? old('duty_finger_out')); ?>">

                            <?php $__errorArgs = ['duty_finger_out'];
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
                            <?php if(isset($staffDutySalary)): ?>
                                <?php if (\Illuminate\Support\Facades\Blade::check('hasPermission', 'Edit Duty')): ?>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-plus-circle"></i>
                                        <span>Update</span>
                                    </button>
                                <?php endif; ?>
                            <?php else: ?>
                                <?php if (\Illuminate\Support\Facades\Blade::check('hasPermission', 'Create Duty')): ?>
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
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <!-- ckeditor -->
    <script src="<?php echo e(asset('backend/assets/libs/%40ckeditor/ckeditor5-build-classic/build/ckeditor.js')); ?>"></script>

    <!-- init js -->
    <script src="<?php echo e(asset('backend/assets/js/pages/form-editor.init.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.backend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/bokhtiartoshar/Desktop/Project/Sajon Bhai/visaExpert.com-master/resources/views/backend/staff-duty-salary/index.blade.php ENDPATH**/ ?>
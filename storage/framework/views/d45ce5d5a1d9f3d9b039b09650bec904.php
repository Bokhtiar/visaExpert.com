<?php $__env->startSection('title', isset($edit) ? 'Edit Transfer' : 'Create New Transfer'); ?>

<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">New Transfer</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">Dashboard</li>
                                <li class="breadcrumb-item">Transfer</li>
                                <li class="breadcrumb-item active">Create New</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1"><?php echo e(isset($edit) ? 'Edit' : 'Create New'); ?>

                                Transfer</h4>
                            <div class="flex-shrink-0">
                                <div>
                                    <?php if (\Illuminate\Support\Facades\Blade::check('hasPermission', 'Transfer List')): ?>
                                    <a href="<?php echo e(route('admin.transfer.index')); ?>" class="btn btn-clr-red">
                                        <i class="ri-arrow-left-line align-bottom me-1"></i>
                                        Back to list
                                    </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <form id="visa-form"
                                action="<?php echo e(isset($edit) ? route('admin.transfer.update', $edit->id) : route('admin.transfer.store')); ?>"
                                method="POST">
                                <?php echo csrf_field(); ?>
                                <?php if(isset($edit)): ?>
                                    <?php echo method_field('PUT'); ?>
                                <?php endif; ?>

                                <!-- select user -->
                                <div>
                                    <label for="cart-total">Select transfer account</label>
                                    <select class="form-control" name="recive_id" id="recive_id" required>
                                        <option value="">Select please</option>
                                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($user->id); ?>"
                                                <?php echo e(isset($edit) && $edit->recive_id == $user->id ? 'selected' : ''); ?>>
                                                <?php echo e($user->name); ?> (Role:
                                                <?php echo e($user->role ? $user->role->name : 'No Role'); ?>)
                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>

                                </div>
                                <!-- remark -->
                                <div>
                                    <label for="remark" class="form-label">Remark</label>
                                    <input required type="text" id="remark"
                                        class="form-control mb-3 <?php $__errorArgs = ['remark'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="remark"
                                        value="<?php echo e($edit->remark ?? old('remark')); ?>">

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
                                <!-- amount -->
                                <div>
                                    <label for="amount" class="form-label">Amount</label>
                                    <input required type="text" id="amount"
                                        class="form-control mb-3 <?php $__errorArgs = ['amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="amount"
                                        value="<?php echo e($edit->amount ?? old('name')); ?>">

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
                                
                                <div class="my-2">
                                    <label for="description" class="form-label">Note</label>
                                    <textarea name="description" class="ckeditor-classic" id="description"><?php echo e($edit->description ?? old('description')); ?></textarea>
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

                                <div class="mt-3">
                                    <?php if(isset($edit)): ?>
                                        <button type="submit" class="btn btn-success">
                                            <i class="fas fa-plus-circle"></i>
                                            <span>Update</span>
                                        </button>
                                    <?php else: ?>
                                        <button type="submit" class="btn btn-success">
                                            <i class="fas fa-plus-circle"></i>
                                            <span>Create</span>
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <!-- ckeditor -->
    <script src="<?php echo e(asset('backend/assets/libs/%40ckeditor/ckeditor5-build-classic/build/ckeditor.js')); ?>"></script>

    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
    </script>


    <!-- init js -->
    <script src="<?php echo e(asset('backend/assets/js/pages/form-editor.init.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.backend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/bokhtiartoshar/Desktop/laravel/visxpert/visaExpert.com-master/resources/views/backend/transfer/form.blade.php ENDPATH**/ ?>
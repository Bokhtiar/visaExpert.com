<?php $__env->startSection('title', isset($role) ? 'Edit Role' : 'Create New Role'); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Roles</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">Dashboard</li>
                        <li class="breadcrumb-item">Roles</li>
                        <li class="breadcrumb-item active"><?php echo e(isset($role) ? 'Edit' : 'Create New'); ?> Role</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1"><?php echo e(isset($role) ? 'Edit' : 'Create New'); ?> Role</h4>
                    <div class="flex-shrink-0">
                        <div>
                            <a href="<?php echo e(route('admin.roles.index')); ?>" class="btn btn-clr-red">
                                <i class="ri-arrow-go-back-line align-bottom me-1"></i>
                                Back to list
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form id="roleForm" method="POST"
                          action="<?php echo e(isset($role) ? route('admin.roles.update', $role->id) : route('admin.roles.store')); ?>">
                        <?php echo csrf_field(); ?>
                        <?php if(isset($role)): ?>
                            <?php echo method_field('PUT'); ?>
                        <?php endif; ?>
                        <div>
                            <label for="Role Name" class="form-label">Role Name</label>
                            <input type="text" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                   name="name"
                                   id="Role Name"
                                   value="<?php echo e($role->name ?? old('name')); ?>"
                                   placeholder="Enter role name" required autofocus>

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

                        <div class="text-center my-3">
                            <strong>Manage permissions for role</strong>
                            <?php $__errorArgs = ['permissions'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="p-2 text-danger">
                                <strong><?php echo e($message); ?></strong>
                            </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="select-all">
                            <label class="form-check-label" for="select-all">
                                Select All
                            </label>
                        </div>
                        <?php $__empty_1 = true; $__currentLoopData = $modules->chunk(2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $chunks): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="row mt-5">
                                <?php $__currentLoopData = $chunks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-md-6">
                                        <div class="form-check mb-4 form-check-inline">
                                            <input type="checkbox" class="form-check-input module-checkbox me-4"
                                                   id="module-<?php echo e($module->id); ?>" value="<?php echo e($module->id); ?>"
                                                   name="modules[]">
                                            <label class="form-check-label" for="module-<?php echo e($module->id); ?>">
                                                <span class="h5"><?php echo e($module->name); ?></span>
                                            </label>
                                        </div>
                                        <?php $__currentLoopData = $module->permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="mb-3">
                                                <div
                                                    class="form-check form-switch form-switch-md form-switch-danger mb-2"
                                                    dir="ltr">
                                                    <input type="checkbox"
                                                           class="form-check-input"
                                                           id="permission-<?php echo e($permission->id); ?>"
                                                           value="<?php echo e($permission->id); ?>"
                                                           name="permissions[]"
                                                    <?php if(isset($role)): ?>
                                                        <?php $__currentLoopData = $role->permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rPermission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php echo e($permission->id == $rPermission->id ? 'checked' : ''); ?>

                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php endif; ?>>
                                                    <label class="form-check-label"
                                                           for="permission-<?php echo e($permission->id); ?>"><?php echo e($permission->name); ?></label>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="row">
                                <div class="col text-center">
                                    <strong>No Module Found.</strong>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="text-center mt-5">
                            <?php if(!isset($role)): ?>
                                <button type="button" class="btn btn-outline-dark" onClick="resetForm('roleForm')">
                                    <i class="fas fa-redo"></i>
                                    <span>Clear</span>
                                </button>
                            <?php endif; ?>
                            <button type="submit" class="btn btn-clr-red text-center">
                                <?php if(isset($role)): ?>
                                    <i class="fas fa-arrow-circle-up"></i>
                                    <span>Update</span>
                                <?php else: ?>
                                    <i class="fas fa-plus-circle"></i>
                                    <span>Create</span>
                                <?php endif; ?>
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <script type="text/javascript">
        $('#select-all').click(function () {
            if (this.checked) {
                $(':checkbox').prop('checked', true);
            } else {
                $(':checkbox').prop('checked', false);
            }
        });

        $('.module-checkbox').change(function () {
            // let moduleId = $(this).val();
            let modulePermissions = $(this).closest('.col-md-6').find('.form-check-input[name^="permissions"]');
            modulePermissions.prop('checked', this.checked);
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.backend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/visatuey/public_html/resources/views/backend/user/roles/form.blade.php ENDPATH**/ ?>
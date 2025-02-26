<?php $__env->startSection('title', isset($user) ? 'Edit User' : 'Create New User'); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Users</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">Dashboard</li>
                        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.users.index')); ?>">Users</a></li>
                        <li class="breadcrumb-item active"><?php echo e(isset($user) ? 'Edit' : 'Create New'); ?> User</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <!-- form start -->
            <form role="form" id="userFrom" method="POST"
                action="<?php echo e(isset($user) ? route('admin.users.update', $user->id) : route('admin.users.store')); ?>"
                enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php if(isset($user)): ?>
                    <?php echo method_field('PUT'); ?>
                <?php endif; ?>
                <div class="row">
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <h5 class="card-title">User Information</h5>
                                    <div>
                                        <a href="<?php echo e(route('admin.users.index')); ?>" class="btn btn-success">
                                            <i class="ri-arrow-go-back-line"></i> Back to list
                                        </a>
                                        <button type="submit" class="btn btn-clr-red">
                                            <?php if(isset($user)): ?>
                                                <i class="ri-save-2-line"></i>
                                                Update
                                            <?php else: ?>
                                                <i class="ri-file-add-line"></i>
                                                Save
                                            <?php endif; ?>
                                        </button>
                                    </div>
                                </div>
                                <div class="my-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input id="name" type="text"
                                        class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="name"
                                        value="<?php echo e($user->name ?? old('name')); ?>" required autofocus>

                                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="my-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input id="email" type="email"
                                        class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email"
                                        value="<?php echo e($user->email ?? old('email')); ?>" required>

                                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <div class="my-3">
                                    <label for="salary" class="form-label">Salary</label>
                                    <input id="salary" type="number"
                                        class="form-control <?php $__errorArgs = ['salary'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="salary"
                                        value="<?php echo e($user->salary ?? old('salary')); ?>" required autofocus>

                                    <?php $__errorArgs = ['salary'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <div class="row">
                                    <div class="my-3 col-span-6">
                                        <label for="duty_time_start" class="form-label">Duty Start Time</label>
                                        <input id="duty_time_start" type="time"
                                            class="form-control <?php $__errorArgs = ['duty_time_start'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="duty_time_start"
                                            value="<?php echo e($user->duty_time_start ?? old('duty_time_start')); ?>" required autofocus>

                                        <?php $__errorArgs = ['duty_time_start'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>

                                    <div class="my-3 col-span-6">
                                        <label for="duty_time_end" class="form-label">Duty Start Time</label>
                                        <input id="duty_time_end" type="time"
                                            class="form-control <?php $__errorArgs = ['duty_time_end'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="duty_time_end"
                                            value="<?php echo e($user->duty_time_end ?? old('duty_time_end')); ?>" required autofocus>

                                        <?php $__errorArgs = ['duty_time_end'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>

                                </div>

                                <div class="my-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input id="password" type="password"
                                        class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password"
                                        <?php echo e(!isset($user) ? 'required' : ''); ?>>

                                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="my-3">
                                    <label for="confirm_password" class="form-label">Confirm Password</label>
                                    <input id="confirm_password" type="password"
                                        class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        name="password_confirmation" <?php echo e(!isset($user) ? 'required' : ''); ?>>

                                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Select Role and Status</h5>
                                <div class="my-3">
                                    <label for="role" class="form-label">Select Role</label>
                                    <select name="role" id="role"
                                        class="form-control js-example-basic-single <?php $__errorArgs = ['role'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        name="role" required>
                                        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($role->id); ?>"
                                                <?php if(isset($user)): ?>
                                                <?php echo e($user->role->id == $role->id ? 'selected' : ''); ?>

                                                <?php endif; ?>>
                                                <?php echo e($role->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>

                                    <?php $__errorArgs = ['role'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-check form-check-right mb-2">
                                    <input class="form-check-input" type="checkbox" name="status"
                                        id="formCheckboxRight1"
                                        <?php if(isset($user)): ?>
                                        <?php echo e($user->status ? 'checked' : ''); ?>

                                        <?php endif; ?>>
                                    <label class="form-check-label" for="formCheckboxRight1">
                                        Status
                                    </label>
                                    <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            
            <?php if(isset($user)): ?>
                <div class="card-body">
                    <form id="roleForm" method="POST" 
                        action="<?php echo e(route('admin.permission-user.store')); ?>">
                        <?php echo csrf_field(); ?>
                        
                        <input type="hidden" name="user_id" value="<?php echo e($user->id); ?>" id="">
                        <div>
                            <label for="Role Name" class="form-label">Role Name</label>
                            <input type="text" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="name"
                                id="Role Name" value="<?php echo e($role->name ?? old('name')); ?>" placeholder="Enter role name"
                                required autofocus>

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
                            <strong>Manage permissions for role(Total Permission
                                <?php echo e(App\Models\PermissionUser::where('user_id', Auth::id())->count()); ?> )</strong>
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

                                                <div class="form-check form-switch form-switch-md form-switch-danger mb-2"
                                                    dir="ltr">
                                                    <input type="checkbox" class="form-check-input"
                                                        id="permission-<?php echo e($permission->id); ?>" value="<?php echo e($permission->id); ?>"
                                                        name="permissions[]"
                                                        <?php if(isset($specificUserPermission)): ?> <?php $__currentLoopData = $specificUserPermission; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rPermission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        
                                                            <?php echo e($permission->id == $rPermission->permission_id ? 'checked' : ''); ?>

                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php endif; ?>>
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
            <?php endif; ?>

        </div>
    </div>

    <?php $__env->startPush('js'); ?>
        <script type="text/javascript">
            $('#select-all').click(function() {
                if (this.checked) {
                    $(':checkbox').prop('checked', true);
                } else {
                    $(':checkbox').prop('checked', false);
                }
            });

            $('.module-checkbox').change(function() {
                // let moduleId = $(this).val();
                let modulePermissions = $(this).closest('.col-md-6').find('.form-check-input[name^="permissions"]');
                modulePermissions.prop('checked', this.checked);
            });
        </script>
    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.backend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/bokhtiartoshar/Desktop/Project/Sajon Bhai/visaExpert.com-master/resources/views/backend/user/form.blade.php ENDPATH**/ ?>
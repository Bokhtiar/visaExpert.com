<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1"><?php echo e(isset($tourPackage) ? 'Edit' : 'Create'); ?> a
                    package</h4>
            </div>
            <div class="card-body">
                <form
                    action="<?php echo e(isset($tourPackage) ? route('admin.tour-packages.update', $tourPackage->id) : route('admin.tour-packages.store')); ?>"
                    method="POST">
                    <?php echo csrf_field(); ?>
                    <?php if(isset($tourPackage)): ?>
                        <?php echo method_field('PUT'); ?>
                    <?php endif; ?>
                    <div class="row g-3">
                        <div class="col-lg-4">
                            <div class="form-floating">
                                <input type="text" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                       name="name" id="packageName"
                                       placeholder="Enter a package name"
                                       value="<?php echo e($tourPackage->name ?? old('name')); ?>" required>
                                <label for="packageName">Package Name</label>

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
                        </div>
                        <div class="col-lg-4">
                            <div class="form-floating">
                                <input type="text"
                                       class="form-control <?php $__errorArgs = ['place_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                       id="nameOfPlace"
                                       name="place_name" placeholder="Enter the name of place"
                                       value="<?php echo e($tourPackage->place_name ?? old('place_name')); ?>" required>
                                <label for="nameOfPlace">Name of Place</label>

                                <?php $__errorArgs = ['place_name'];
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
                        </div>
                        <div class="col-lg-4">
                            <div class="form-floating">
                                <input type="date" id="journeyDate"
                                       class="form-control <?php $__errorArgs = ['journey_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                       min="<?php echo e(date('Y-m-d', strtotime('+1 day'))); ?>"
                                       name="journey_date" placeholder="Enter your journey date"
                                       value="<?php echo e($tourPackage->journey_date ?? old('journey_date')); ?>" required>
                                <label for="journeyDate">Journey Date</label>

                                <?php $__errorArgs = ['journey_date'];
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
                        </div>
                        <div class="col-lg-12">
                            <?php if(isset($tourPackage)): ?>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success">Update</button>
                                </div>
                            <?php else: ?>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success">Create</button>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\visa\resources\views/backend/tour-package/form.blade.php ENDPATH**/ ?>
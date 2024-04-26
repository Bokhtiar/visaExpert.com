<?php $__env->startSection('title', 'Tour Package Configuration'); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Tour Package</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item active">Tour Package</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check(\App\Permissions::EDIT_TOUR_PACKAGE, \App\Permissions::CREATE_TOUR_PACKAGE)): ?>
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
    <?php endif; ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">All Tour Packages</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-card mb-1">
                        <table class="table table-borderless table-nowrap align-middle">
                            <thead class="text-muted table-light">
                            <tr class="text-uppercase">
                                <th scope="col">SL</th>
                                <th scope="col">Package Name</th>
                                <th scope="col">Name of Place</th>
                                <th scope="col">Journey Date</th>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check(\App\Permissions::EDIT_TOUR_PACKAGE, \App\Permissions::DELETE_TOUR_PACKAGE)): ?>
                                    <th scope="col">Actions</th>
                                <?php endif; ?>
                            </tr>
                            </thead>
                            <tbody class="list">
                            <?php $__empty_1 = true; $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td class="fw-medium">
                                        <?php echo e($key + $packages->firstItem()); ?>

                                    </td>
                                    <td>
                                        <?php echo e($package->name); ?>

                                    </td>
                                    <td>
                                        <?php echo e($package->place_name); ?>

                                    </td>
                                    <td>
                                        <?php echo e(date('d M Y', strtotime($package->journey_date))); ?>

                                    </td>
                                    <td>
                                        <div class="hstack gap-3 fs-15">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check(\App\Permissions::EDIT_TOUR_PACKAGE)): ?>
                                                <a href="<?php echo e(route('admin.tour-packages.edit',$package->id)); ?>"
                                                   class="btn btn-primary waves-effect waves-light">
                                                    <i class="ri-pencil-line align-bottom me-1"></i>
                                                    Edit
                                                </a>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check(\App\Permissions::DELETE_TOUR_PACKAGE)): ?>
                                                <button type="button"
                                                        class="btn btn-danger waves-effect waves-light"
                                                        onclick="deleteData(<?php echo e($package->id); ?>)">
                                                    <i class="ri-delete-bin-5-line align-bottom me-1"></i>
                                                    Delete
                                                </button>
                                                <form id="delete-form-<?php echo e($package->id); ?>"
                                                      action="<?php echo e(route('admin.tour-packages.destroy', $package->id)); ?>"
                                                      method="POST"
                                                      style="display: none;">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                </form>
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
                <?php echo e($packages->links('pagination.default')); ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.backend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\visa\resources\views/backend/tour-package/index.blade.php ENDPATH**/ ?>
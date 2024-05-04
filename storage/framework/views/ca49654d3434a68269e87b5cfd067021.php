<?php $__env->startSection('title',  isset($service) ? 'Edit Service' : 'Create New Service'); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">New Service</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">Dashboard</li>
                                <li class="breadcrumb-item">Services</li>
                                <li class="breadcrumb-item active"><?php echo e(isset($service) ? 'Edit ' : 'Create New'); ?>

                                    Service
                                </li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1"><?php echo e(isset($service) ? 'Edit' : 'Create New'); ?>

                                Service</h4>
                            <div class="flex-shrink-0">
                                <div>
                                    <a href="<?php echo e(route('admin.services.index')); ?>" class="btn btn-secondary">
                                        <i class="ri-arrow-left-line align-bottom me-1"></i>
                                        Back to list
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form id="visa-form"
                                  action="<?php echo e(isset($service) ? route('admin.services.update', $service->id) : route('admin.services.store')); ?>"
                                  method="POST">
                                <?php echo csrf_field(); ?>
                                <?php if(isset($service)): ?>
                                    <?php echo method_field('PUT'); ?>
                                <?php endif; ?>
                                <div class="mb-3">
                                    <label for="title" class="form-label">Service Name</label>
                                    <input type="text" id="title"
                                           class="form-control mb-3 <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                           name="title" value="<?php echo e($service->title ?? old('title')); ?>">

                                    <?php $__errorArgs = ['title'];
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
                                    <label for="agent_amount" class="form-label">Agent Amount</label>
                                    <input type="number" id="agent_amount"
                                           class="form-control mb-3 <?php $__errorArgs = ['agent_amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                           name="agent_amount"
                                           value="<?php echo e($service->agent_amount ?? old('agent_amount')); ?>">

                                    <?php $__errorArgs = ['agent_amount'];
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
                                    <label for="customer_amount" class="form-label">Customer Amount</label>
                                    <input type="number" id="customer_amount"
                                           class="form-control mb-3 <?php $__errorArgs = ['customer_amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                           name="customer_amount"
                                           value="<?php echo e($service->customer_amount ?? old('customer_amount')); ?>">

                                    <?php $__errorArgs = ['customer_amount'];
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
                                    <button type="button" class="btn btn-danger" onClick="resetForm('visa-form')">
                                        <i class="fas fa-redo"></i>
                                        <span>Reset</span>
                                    </button>
                                    <?php if(isset($service)): ?>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-plus-circle"></i>
                                            <span>Update</span>
                                        </button>
                                    <?php else: ?>
                                        <button type="submit" class="btn btn-primary">
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


<?php echo $__env->make('layouts.backend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\visa\resources\views/backend/service/form.blade.php ENDPATH**/ ?>
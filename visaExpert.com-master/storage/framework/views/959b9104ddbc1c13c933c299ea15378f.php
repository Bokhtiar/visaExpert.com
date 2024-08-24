<?php $__env->startSection('title', 'Customers'); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Customers</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Customers</li>
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
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">All Customer</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-borderless align-middle mb-0">
                                            <thead class="table-light">
                                            <tr>
                                                <th scope="col">SL</th>
                                                <th scope="col">User ID</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Phone Number</th>
                                                <th scope="col">Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $__empty_1 = true; $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <tr>
                                                    <td class="fw-medium text-center"><?php echo e($key + 1); ?></td>
                                                    <td>#<?php echo e($customer->unique_id); ?></td>
                                                    <td><?php echo e(ucfirst($customer->name)); ?></td>
                                                    <td><a href="tel:<?php echo e($customer->phone); ?>"><?php echo e($customer->phone); ?></a>
                                                    </td>
                                                    <td>
                                                        <div class="hstack gap-3 fs-15">
                                                            <a href="<?php echo e(route('admin.customers-invoice.create', $customer->id)); ?>"
                                                               class="btn btn-dark waves-effect waves-light">
                                                                <i class="ri-file-add-line align-bottom me-1"></i>
                                                                Create Bill
                                                            </a>
                                                            <a href="<?php echo e(route('admin.customers.show', $customer->id)); ?>"
                                                               class="btn btn-primary waves-effect waves-light">
                                                                <i class="ri-eye-2-line align-bottom me-1"></i>
                                                                View Profile
                                                            </a>
                                                            <button type="button"
                                                                    class="btn btn-danger waves-effect waves-light"
                                                                    onclick="deleteData(<?php echo e($customer->id); ?>)">
                                                                <i class="ri-delete-bin-5-line align-bottom me-1"></i>
                                                                Delete Customer
                                                            </button>
                                                            <form id="delete-form-<?php echo e($customer->id); ?>"
                                                                  action="<?php echo e(route('admin.customers.destroy',$customer->id)); ?>"
                                                                  method="POST"
                                                                  style="display: none;">
                                                                <?php echo csrf_field(); ?>
                                                                <?php echo method_field('DELETE'); ?>
                                                            </form>
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
                                <?php echo e($customers->links('pagination.default')); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.backend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/visatuey/visa.visaxpert.net/resources/views/backend/customer/index.blade.php ENDPATH**/ ?>
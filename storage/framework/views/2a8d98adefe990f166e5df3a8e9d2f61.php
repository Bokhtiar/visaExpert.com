<?php $__env->startSection('title', 'Link'); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Link</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Link</li>
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
                                    <h4 class="card-title mb-0 flex-grow-1">All Link</h4>

                                    <div class="flex-shrink-0">
                                        <div>
                                            <a href="<?php echo e(route('admin.link.create')); ?>" class="btn btn-clr-red rounded-pill">
                                                Create Link
                                            </a>
                                        </div>
                                    </div>

                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-borderless align-middle mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th scope="col">SL</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Website Link</th>
                                                    <th scope="col">Actions</th>
                                            </thead>
                                            <tbody>

                                                <?php $__empty_1 = true; $__currentLoopData = $links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                    <tr>
                                                        <td class="fw-medium"><?php echo e($loop->index + 1); ?></td>
                                                        <td><?php echo e($link->name); ?></td>
                                                        <td><?php echo e($link->link); ?></td>

                                                        <td>
                                                            <div class="hstack gap-3 fs-15">
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check(\App\Permissions::EDIT_LINK)): ?>
                                                                    <a href="<?php echo e(route('admin.link.edit', $link->id)); ?>"
                                                                        class="btn btn-primary waves-effect waves-light">
                                                                        <i class="ri-pencil-line align-bottom me-1"></i>
                                                                        Edit
                                                                    </a>
                                                                <?php endif; ?>
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check(\App\Permissions::DELETE_LINK)): ?>
                                                                    <button type="button"
                                                                        class="btn btn-danger waves-effect waves-light"
                                                                        onclick="deleteData(<?php echo e($link->id); ?>)">
                                                                        <i class="ri-delete-bin-5-line align-bottom me-1"></i>
                                                                        Delete
                                                                    </button>
                                                                    <form id="delete-form-<?php echo e($link->id); ?>"
                                                                        action="<?php echo e(route('admin.link.destroy', $link->id)); ?>"
                                                                        method="POST" style="display: none;">
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.backend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\visa\resources\views/backend/link/index.blade.php ENDPATH**/ ?>
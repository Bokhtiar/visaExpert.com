<?php $__env->startSection('title', 'Visa Types'); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Visa Types</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Visa Types</li>
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
                                    <h4 class="card-title mb-0 flex-grow-1">All Visa Types</h4>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check(\App\Permissions::CREATE_VISA_TYPE)): ?>
                                    <div class="flex-shrink-0">
                                        <div>
                                            <a href="<?php echo e(route('admin.visa-types.create')); ?>"
                                               class="btn btn-clr-red rounded-pill">
                                                Create New Type
                                            </a>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-borderless align-middle mb-0">
                                            <thead class="table-light">
                                            <tr>
                                                <th scope="col">SL</th>
                                                <th scope="col">Visa Type</th>
                                                <th scope="col">Required Documents</th>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check(\App\Permissions::EDIT_VISA_TYPE, \App\Permissions::DELETE_VISA_TYPE)): ?>

                                                    <th scope="col">Actions</th>
                                            <?php endif; ?>
                                            </thead>
                                            <tbody>
                                                
                                            <?php $__empty_1 = true; $__currentLoopData = $visaTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$visaType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                          
                                                <tr>
                                                    <td class="fw-medium"><?php echo e($key + 1); ?></td>
                                                    <td><?php echo e($visaType->title); ?></td>
                                                    <td>
                                                        <?php if($visaType->required_documents !== null): ?>
                                                            <ul>
                                                                <?php $__currentLoopData = json_decode($visaType->required_documents); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <li><?php echo e($document); ?></li>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </ul>
                                                        <?php else: ?>
                                                            No required documents available.
                                                        <?php endif; ?>
                                                        <?php echo $visaType->required_document; ?>

                                                        
                                                    </td>
                                                    <td>
                                                        <div class="hstack gap-3 fs-15">
                                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check(\App\Permissions::EDIT_VISA_TYPE)): ?>
                                                                <a href="<?php echo e(route('admin.visa-types.edit', $visaType->id)); ?>"
                                                                   class="btn btn-primary waves-effect waves-light">
                                                                    <i class="ri-pencil-line align-bottom me-1"></i>
                                                                    Edit
                                                                </a>
                                                            <?php endif; ?>
                                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check(\App\Permissions::DELETE_VISA_TYPE)): ?>
                                                                <button type="button"
                                                                        class="btn btn-danger waves-effect waves-light"
                                                                        onclick="deleteData(<?php echo e($visaType->id); ?>)">
                                                                    <i class="ri-delete-bin-5-line align-bottom me-1"></i>
                                                                    Delete
                                                                </button>
                                                                <form id="delete-form-<?php echo e($visaType->id); ?>"
                                                                      action="<?php echo e(route('admin.visa-types.destroy',$visaType->id)); ?>"
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
                                <?php echo e($visaTypes->links('pagination.default')); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.backend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/visatuey/public_html/resources/views/backend/visa-type/index.blade.php ENDPATH**/ ?>
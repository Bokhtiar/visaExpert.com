<?php $__env->startSection('title', 'User Roles'); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">User Roles</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item active">User Roles</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">All Roles</h4>
                     <?php if (\Illuminate\Support\Facades\Blade::check('hasPermission', 'Create Role')): ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check(\App\Permissions::CREATE_ROLE)): ?>
                        <div class="flex-shrink-0">
                            <div>
                                <a href="<?php echo e(route('admin.roles.create')); ?>" class="btn rounded-pill btn-clr-red">
                                    Add New Role
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php endif; ?>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless align-middle table-nowrap mb-0">
                            <thead>
                            <tr>
                                <th scope="col">SL</th>
                                <th scope="col">Name</th>
                                <th scope="col">Total Users</th>
                                <th scope="col">Total Permissions</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="fw-medium"><?php echo e($key + 1); ?></td>
                                    <td><?php echo e($role->name); ?></td>
                                    <td>
                                        <?php if($role->users_count > 0): ?>
                                            <span class="text-muted fw-bold"><?php echo e($role->users_count); ?></span>
                                        <?php else: ?>
                                            <span class="badge badge-label bg-danger"><i
                                                    class="mdi mdi-circle-medium"></i> No user found :(</span>
                                        <?php endif; ?>
                                    </td>

                                    <td>
                                        <?php if($role->permissions_count > 0): ?>
                                            <span class="badge badge-label bg-primary"><i
                                                    class="mdi mdi-circle-medium"></i> <?php echo e($role->permissions_count); ?></span>
                                        <?php else: ?>
                                            <span class="badge badge-label bg-danger"><i
                                                    class="mdi mdi-circle-medium"></i> No permission found :(</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e($role->created_at->diffForHumans()); ?></td>
                                    <td>
                                        <div class="hstack gap-3 fs-15">
                                            <?php if (\Illuminate\Support\Facades\Blade::check('hasPermission', 'Edit Role')): ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check(\App\Permissions::EDIT_ROLE)): ?>
                                                <a href="<?php echo e(route('admin.roles.edit',$role->id)); ?>"
                                                   class="btn btn-primary waves-effect waves-light">
                                                    <i class="ri-pencil-line align-bottom me-1"></i>
                                                    Edit
                                                </a>
                                            <?php endif; ?>
                                            <?php endif; ?>
                                            <?php if (\Illuminate\Support\Facades\Blade::check('hasPermission', 'Delete Role')): ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check(\App\Permissions::DELETE_ROLE)): ?>
                                                <?php if($role->deletable == true): ?>
                                                    <button type="button"
                                                            class="btn btn-danger waves-effect waves-light"
                                                            onclick="deleteData(<?php echo e($role->id); ?>)">
                                                        <i class="ri-delete-bin-5-line align-bottom me-1"></i>
                                                        Delete
                                                    </button>
                                                    <form id="delete-form-<?php echo e($role->id); ?>"
                                                          action="<?php echo e(route('admin.roles.destroy',$role->id)); ?>"
                                                          method="POST"
                                                          style="display: none;">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('DELETE'); ?>
                                                    </form>
                                                <?php endif; ?>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.backend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\visa\resources\views/backend/user/roles/index.blade.php ENDPATH**/ ?>
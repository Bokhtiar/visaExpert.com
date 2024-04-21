<?php $__env->startSection('title', 'Users'); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Users</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item active">Users</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">All Users</h4>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check(\App\Permissions::CREATE_USER)): ?>
                        <div class="flex-shrink-0">
                            <div>
                                <a href="<?php echo e(route('admin.users.create')); ?>" class="btn btn-clr-red rounded-pill">
                                    Create New User
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless align-middle table-nowrap mb-0">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Role</th>
                                <th scope="col">Email</th>
                                <th scope="col">Status</th>
                                <th scope="col">Joined At</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="fw-medium"><?php echo e($key + 1); ?></td>
                                    <td><?php echo e($user->name); ?></td>
                                    <td><?php echo e($user->role->name); ?></td>
                                    <td><?php echo e($user->email); ?></td>
                                    <td>
                                        <?php if($user->status): ?>
                                            <div class="badge badge-gradient-success"> Active</div>
                                        <?php else: ?>
                                            <div class="badge badge-gradient-danger bg-danger">Inactive</div>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e($user->created_at->diffForHumans()); ?></td>
                                    <td>
                                        <div class="hstack gap-3 fs-15">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check(\App\Permissions::EDIT_USER)): ?>
                                                <a href="<?php echo e(route('admin.users.edit',$user->id)); ?>"
                                                   class="btn btn-primary waves-effect waves-light">
                                                    <i class="ri-pencil-line align-bottom me-1"></i>
                                                    Edit
                                                </a>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check(\App\Permissions::DELETE_USER)): ?>
                                                <?php if($user->deletable == true): ?>
                                                    <button type="button"
                                                            class="btn btn-danger waves-effect waves-light"
                                                            onclick="deleteData(<?php echo e($user->id); ?>)">
                                                        <i class="ri-delete-bin-5-line align-bottom me-1"></i>
                                                        Delete
                                                    </button>
                                                    <form id="delete-form-<?php echo e($user->id); ?>"
                                                          action="<?php echo e(route('admin.users.destroy',$user->id)); ?>"
                                                          method="POST"
                                                          style="display: none;">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('DELETE'); ?>
                                                    </form>
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

<?php echo $__env->make('layouts.backend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/visatuey/public_html/resources/views/backend/user/index.blade.php ENDPATH**/ ?>
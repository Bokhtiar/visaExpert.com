<?php $__env->startSection('title', 'Leave'); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Leave</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Leave</li>
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
                                    <h4 class="card-title mb-0 flex-grow-1">All Leave</h4>

                                    <div class="flex-shrink-0">
                                        <div>
                                            <a href="<?php echo e(route('admin.leave.create')); ?>"
                                                class="btn btn-clr-red rounded-pill">
                                                Create Leave
                                            </a>
                                        </div>
                                    </div>

                                </div>
                                <div class="card-body">
                                
                                    
                                    <form method="POST" action="<?php echo e(route('admin.leave.filter')); ?>" class="mb-4">
                                        <?php echo csrf_field(); ?>
                                        <div class="row mb-4">


                                            

                                            <div class="col-md-3">
                                                <label for="month" class="form-label">Month</label>
                                                <select name="month" id="month" class="form-control">
                                                    <?php $__currentLoopData = range(1, 12); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($m); ?>"
                                                            <?php echo e($m == $month ? 'selected' : ''); ?>>
                                                            <?php echo e(\Carbon\Carbon::create()->month($m)->format('F')); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>

                                            <div class="col-md-3">
                                                <label for="year" class="form-label">Year</label>
                                                <select name="year" id="year" class="form-control">
                                                    <?php for($y = date('Y'); $y >= 2020; $y--): ?>
                                                        <option value="<?php echo e($y); ?>"
                                                            <?php echo e($y == $year ? 'selected' : ''); ?>>
                                                            <?php echo e($y); ?>

                                                        </option>
                                                    <?php endfor; ?>
                                                </select>
                                            </div>


                                            <div class="col-md-3 d-flex align-items-end">
                                                <button type="submit" class="btn btn-primary">Filter</button>
                                            </div>
                                        </div>
                                    </form>


                                    <div class="table-responsive">
                                        <table class="table table-borderless align-middle mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <td>Employee</td>
                                                    <th>Leave Type</th>
                                                    <th>Leave Date</th>
                                                    <th>Reason</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                <?php $__empty_1 = true; $__currentLoopData = $leaves; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $leave): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                
                                                    <tr>
                                                        <td><?php echo e($leave->user_id); ?></td>
                                                        <td><?php echo e($leave->leave_type); ?></td>
                                                        <td><?php echo e($leave->leave_date); ?></td>
                                                        <td><?php echo e($leave->reason); ?></td>
                                                        <td><?php echo e($leave->status); ?></td>
                                                        <td>
                                                            <a href="<?php echo e(route('admin.leave.edit', $leave->id)); ?>"
                                                                class="btn btn-warning">Edit</a>
                                                            <form
                                                                action="<?php echo e(route('admin.leave.destroy', $leave->id)); ?>"
                                                                method="POST" style="display:inline-block;">
                                                                <?php echo csrf_field(); ?>
                                                                <?php echo method_field('DELETE'); ?>
                                                                <button type="submit"
                                                                    class="btn btn-danger">Delete</button>
                                                            </form>
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

<?php echo $__env->make('layouts.backend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/bokhtiartoshar/Desktop/laravel/visxpert/visaExpert.com-master/resources/views/backend/leave/index.blade.php ENDPATH**/ ?>
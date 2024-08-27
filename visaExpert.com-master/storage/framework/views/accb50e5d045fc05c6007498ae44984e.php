<?php $__env->startSection('title', 'Attendance Sheet'); ?>

<?php $__env->startSection('content'); ?>

    <div class="">
        <form action="<?php echo e(url('admin/attendance/filter')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="row mb-4">
                <div class="col-md-3">
                    <label for="employee" class="form-label">Employee</label>
                    <select name="user_id" id="user_id" class="form-control">
                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($user->id); ?>">
                                <?php echo e($user->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="month" class="form-label">Month</label>
                    <select name="month" id="month" class="form-control">
                        <?php for($m = 1; $m <= 12; $m++): ?>
                            <option value="<?php echo e($m); ?>" <?php echo e($m == request('month', date('m')) ? 'selected' : ''); ?>>
                                <?php echo e(\Carbon\Carbon::create()->month($m)->format('F')); ?>

                            </option>
                        <?php endfor; ?>
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="year" class="form-label">Year</label>
                    <select name="year" id="year" class="form-control">
                        <?php for($y = date('Y'); $y >= 2020; $y--): ?>
                            <option value="<?php echo e($y); ?>" <?php echo e($y == request('year', date('Y')) ? 'selected' : ''); ?>>
                                <?php echo e($y); ?>

                            </option>
                        <?php endfor; ?>
                    </select>
                </div>
                <?php if (\Illuminate\Support\Facades\Blade::check('hasPermission', 'Attendance Filter')): ?>
                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
                <?php endif; ?>
            </div> 
        </form>
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Today Attendance Sheet</h4>
                <form action="<?php echo e(url('admin/attendance/day/filter')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                <input type="date" value="<?php echo e($date); ?>" name="day" id="">
                <input type="submit">
                </form>
            </div>
            <div class="">
                <table id="example" class="table table-borderless align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Punch In</th>
                            <th>Punch Out</th>
                            <th>Total Hours</th>
                            <th>Late Hours</th>
                            <th>Early Out Hours</th>
                            <th>Fine</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $attendances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attendance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($attendance->date->format('Y-m-d')); ?></td>
                                <td>
                                    <?php if($attendance->status == 'late'): ?>
                                        <span class="btn btn-sm btn-danger"><?php echo e($attendance->status); ?></span>
                                    <?php elseif($attendance->status == 'normal'): ?>
                                        <span class="btn btn-sm btn-success"><?php echo e($attendance->status); ?></span>
                                    <?php elseif($attendance->status == 'leave'): ?>
                                        <span class="btn btn-sm btn-danger"><?php echo e($attendance->status); ?></span>
                                    <?php elseif($attendance->status == 'early_out'): ?>
                                        <span class="btn btn-sm btn-danger"><?php echo e($attendance->status); ?></span>
                                    <?php endif; ?>

                                </td>
                                <td><?php echo e($attendance ? \Carbon\Carbon::parse($attendance->punch_in)->format('g:i A') : 'N/A'); ?>

                                </td>
                                <td><?php echo e($attendance ? \Carbon\Carbon::parse($attendance->punch_out)->format('g:i A') : 'N/A'); ?>

                                </td>
                                <td><?php echo e($attendance ? $attendance->total_hour : 'N/A'); ?></td>
                                <td><?php echo e($attendance ? $attendance->late_hour : 'N/A'); ?></td>
                                <td><?php echo e($attendance ? $attendance->early_out_hour : 'N/A'); ?></td>
                                <td>
                                    <?php if (\Illuminate\Support\Facades\Blade::check('hasPermission', 'Attendance Fine Update')): ?>
                                    <form action="<?php echo e(url('/admin/attendance/find-cancel', $attendance->id)); ?>"
                                        method="POST">
                                        <?php echo csrf_field(); ?>
                                        <input style="width:80px " type="text" name="fine" id=""
                                            value="<?php echo e($attendance->fine); ?>">
                                        <input type="submit" name="" value="Update" class="btn btn-success btn-sm"
                                            id="">
                                    </form>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                    </tbody>
                </table>

            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.backend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/bokhtiartoshar/Desktop/Project/Sajon Bhai/visxpert/visaExpert.com-master/resources/views/backend/attendance/show.blade.php ENDPATH**/ ?>
<?php $__env->startSection('title', 'Attendance Sheet'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-xxl-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Attendance Sheet</h4>
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
                                            <form action="<?php echo e(url('/admin/attendance/find-cancel', $attendance->id)); ?>"
                                                method="POST">
                                                <input style="width:80px " type="text" name="fine" id=""
                                                    value="<?php echo e($attendance->fine); ?>">
                                                <input type="submit" name="" value="Update"
                                                    class="btn btn-success btn-sm" id="">
                                            </form>
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

<?php echo $__env->make('layouts.backend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/bokhtiartoshar/Desktop/laravel/visxpert/visaExpert.com-master/resources/views/backend/attendance/show.blade.php ENDPATH**/ ?>
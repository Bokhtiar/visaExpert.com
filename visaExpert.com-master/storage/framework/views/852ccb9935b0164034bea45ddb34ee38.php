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
                            <option value="<?php echo e($user->id); ?>" <?php echo e($user->id == $findUser->id ? 'selected' : ''); ?>>
                                <?php echo e($user->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="month" class="form-label">Month</label>
                    <select name="month" id="month" class="form-control">
                        <?php for($m = 1; $m <= 12; $m++): ?>
                            <option value="<?php echo e($m); ?>" <?php echo e($m == $month ? 'selected' : ''); ?>>
                                <?php echo e(\Carbon\Carbon::create()->month($m)->format('F')); ?>

                            </option>
                        <?php endfor; ?>
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="year" class="form-label">Year</label>
                    <select name="year" id="year" class="form-control">
                        <?php for($y = date('Y'); $y >= 2020; $y--): ?>
                            <option value="<?php echo e($y); ?>" <?php echo e($y == $year ? 'selected' : ''); ?>>
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
                <h4 class="card-title mb-0 flex-grow-1"><?php echo e($user->name); ?> Attendance Sheet
                    (<?php echo e(\Carbon\Carbon::create()->month($month)->format('F')); ?>)</h4>
                <div>
                    <sapn class="bg-danger rounded text-white px-2 mx-1">Total Fine
                        (<?php echo e(\Carbon\Carbon::create()->month($month)->format('F')); ?>): <?php echo e($totalFine); ?> Tk
                    </sapn>
                    <span class="bg-info text-white rounded px-2 mx-1">Salary : <?php echo e($findUser->salary); ?> Tk</span>
                    
                    <span class="bg-warning text-white rounded px-2 mx-1"> Total Absent Day :
                        <?php echo e($missedDatesCount); ?></span>
                    <span class="bg-danger rounded text-white px-2 mx-1"> Total Absent fine :
                        <?php echo e(number_format($deductionPerDay * $missedDatesCount, 2)); ?></span>
                    <br>
                    <span class="bg-success text-white rounded px-2 mx-1">Pay of Salary
                        (<?php echo e(\Carbon\Carbon::create()->month($month)->format('F')); ?>):
                        <?php echo e(number_format($findUser->salary - $totalFine - $deductionPerDay * $missedDatesCount)); ?>

                        Tk</span>


                </div>
            </div>
            <div class="">
                <div class="px-3">
                    <span class="bg-warning text-white px-2 rounded">Absend Date on
                        (<?php echo e(\Carbon\Carbon::create()->month($month)->format('F')); ?>): </span>
                    <?php $__currentLoopData = $missedDates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $date): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <span class="bg-danger px-2 text-white rounded mx-1"><?php echo e($date); ?></span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <table id="example" class="table table-borderless align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Status / Name</th>
                            <th>Punch In</th>
                            <th>Punch Out</th>
                            <th>Total Hours</th>
                            <th>Late Hours</th>
                            <th>Early Out Hours</th>
                            <th>Fine</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $combinedRecords; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e(\Carbon\Carbon::parse($record->date)->format('Y-m-d')); ?></td>
                                <td>
                                    <?php if($record instanceof \App\Models\Holiday): ?>
                                        <span class="badge bg-primary">Holiday</span>
                                    <?php elseif($record instanceof \App\Models\Leave): ?>
                                        <span class="badge bg-primary">Leave</span>
                                    <?php else: ?>
                                        <?php if($record->status == 'late'): ?>
                                            <span class="btn btn-sm btn-danger"><?php echo e($record->status); ?></span>
                                        <?php elseif($record->status == 'normal'): ?>
                                            <span class="btn btn-sm btn-success"><?php echo e($record->status); ?></span>
                                        <?php elseif($record->status == 'leave'): ?>
                                            <span class="btn btn-sm btn-danger"><?php echo e($record->status); ?></span>
                                        <?php elseif($record->status == 'early_out'): ?>
                                            <span class="btn btn-sm btn-danger"><?php echo e($record->status); ?></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($record instanceof \App\Models\Holiday): ?>
                                        <?php echo e($record->name); ?>

                                    <?php else: ?>
                                        <?php echo e($record->status); ?> <!-- Or other relevant info -->
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if(!$record instanceof \App\Models\Holiday): ?>
                                        <?php echo e($record->punch_in ? \Carbon\Carbon::parse($record->punch_in)->format('g:i A') : 'N/A'); ?>

                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if(!$record instanceof \App\Models\Holiday): ?>
                                        <?php echo e($record->punch_out ? \Carbon\Carbon::parse($record->punch_out)->format('g:i A') : 'N/A'); ?>

                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if(!$record instanceof \App\Models\Holiday): ?>
                                        <?php echo e($record->total_hour ?? 'N/A'); ?>

                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if(!$record instanceof \App\Models\Holiday): ?>
                                        <?php echo e($record->late_hour ?? 'N/A'); ?>

                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if(!$record instanceof \App\Models\Holiday): ?>
                                        <?php echo e($record->early_out_hour ?? 'N/A'); ?>

                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($record instanceof \App\Models\Holiday): ?>
                                    <?php elseif($record instanceof \App\Models\Leave): ?>
                                    <?php else: ?>
                                        <form
                                            action="<?php echo e(url('admin/attendance/fine-cancel-filter', ['id' => $record->id, 'month' => $month, 'user' => $findUser->id, 'year' => $year])); ?>"
                                            method="POST">
                                            <?php echo csrf_field(); ?>
                                            <input style="width:80px" type="text" name="fine"
                                                value="<?php echo e($record->fine); ?>">
                                            <input type="submit" value="Update" class="btn btn-success btn-sm">
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

<?php echo $__env->make('layouts.backend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/bokhtiartoshar/Desktop/Project/Sajon Bhai/visxpert/visaExpert.com-master/resources/views/backend/attendance/filter.blade.php ENDPATH**/ ?>
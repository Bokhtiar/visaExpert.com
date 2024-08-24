

<?php $__env->startSection('title', 'Transfer'); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Transfer</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Transfer Show</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="container">
                    
                    <div class="row">
                        <div class="col-sm-12 col-md-2 col-lg-2" style="font-weight: bold">
                            Transfer account name
                        </div>
                        <div class="col-sm-12 col-md-10 col-lg-10">
                            <?php echo e($show->reciver ? $show->reciver->name : ""); ?>

                        </div>
                    </div>

                    
                    <div class="row">
                        <div class="col-sm-12 col-md-2 col-lg-2" style="font-weight: bold">
                            Transfer amount
                        </div>
                        <div class="col-sm-12 col-md-10 col-lg-10">
                            <?php echo e($show->amount); ?>

                        </div>
                    </div>

                    
                    <div class="row">
                        <div class="col-sm-12 col-md-2 col-lg-2" style="font-weight: bold">
                            Transfer status
                        </div>
                        <div class="col-sm-12 col-md-10 col-lg-10">
                            <?php echo e($show->status); ?>

                        </div>
                    </div>

                    
                    <div class="row">
                        <div class="col-sm-12 col-md-2 col-lg-2" style="font-weight: bold">
                            Remark
                        </div>
                        <div class="col-sm-12 col-md-10 col-lg-10">
                            <?php echo e($show->remark); ?>

                        </div>
                    </div>

                    
                    <div class="row">
                        <div class="col-sm-12 col-md-2 col-lg-2" style="font-weight: bold">
                            Note
                        </div>
                        <div class="col-sm-12 col-md-10 col-lg-10">
                            <?php echo $show->description; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.backend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\visa\resources\views/backend/transfer/show.blade.php ENDPATH**/ ?>
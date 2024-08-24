<?php $__env->startSection('title', 'Error'); ?>

<?php $__env->startSection('guest-content'); ?>

    <div class="row justify-content-center">
        <div class="col-xl-5">
            <div class="card overflow-hidden">
                <div class="card-body p-4">
                    <div class="text-center">
                        <h1 class="text-primary mb-4">Oops !</h1>
                        <h4 class="text-uppercase">Sorry, Page not Found 😭</h4>
                        <p class="text-muted mb-4">The page you are looking for not available!</p>
                        <a href="<?php echo e(url()->previous()); ?>" class="btn btn-success"><i
                                class="mdi mdi-hand-back-left me-1"></i>
                            Go Back
                        </a>
                    </div>
                </div>
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->

    </div>
    <!-- end row -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.guest', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/visatuey/public_html/resources/views/errors/404.blade.php ENDPATH**/ ?>
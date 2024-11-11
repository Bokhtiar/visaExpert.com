<?php $__env->startSection('title',  isset($edit) ? 'Edit Road' : 'Create New Roa d'); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">New Road</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">Dashboard</li>
                                <li class="breadcrumb-item">Road</li>
                                <li class="breadcrumb-item active">Create New</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1"><?php echo e(isset($edit) ? 'Edit' : 'Create New'); ?>

                                Road</h4>
                            <div class="flex-shrink-0">
                                <div>
                                    <a href="<?php echo e(route('admin.road.index')); ?>" class="btn btn-clr-red">
                                        <i class="ri-arrow-left-line align-bottom me-1"></i>
                                        Back to list
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form id="visa-form"
                                  action="<?php echo e(isset($edit) ? route('admin.road.update', $edit->id) : route('admin.road.store')); ?>"
                                  method="POST">
                                <?php echo csrf_field(); ?>
                                <?php if(isset($edit)): ?>
                                    <?php echo method_field('PUT'); ?>
                                <?php endif; ?>
                                <div>
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" id="name"
                                           class="form-control mb-3 <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                           name="name" value="<?php echo e($edit->name ?? old('name')); ?>">

                                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback">
                                        <strong><?php echo e($message); ?></strong>
                                    </div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            
                                <div class="mt-3">
                                    <?php if(isset($edit)): ?>
                                        <button type="submit" class="btn btn-success">
                                            <i class="fas fa-plus-circle"></i>
                                            <span>Update</span>
                                        </button>
                                    <?php else: ?>
                                        <button type="submit" class="btn btn-success">
                                            <i class="fas fa-plus-circle"></i>
                                            <span>Create</span>
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>


    <!-- ckeditor -->
    <script src="<?php echo e(asset('backend/assets/libs/%40ckeditor/ckeditor5-build-classic/build/ckeditor.js')); ?>"></script>
    
    <script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .then( editor => {
            console.log( editor );
        } )
        .catch( error => {
            console.error( error );
        } );
</script>


    <!-- init js -->
    <script src="<?php echo e(asset('backend/assets/js/pages/form-editor.init.js')); ?>"></script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.backend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/bokhtiartoshar/Desktop/Project/Sajon Bhai/visaExpert.com-master/resources/views/backend/road/form.blade.php ENDPATH**/ ?>
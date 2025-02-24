<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title><?php echo $__env->yieldContent('title'); ?> | <?php echo e(config('app.name')); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Visa application center in Sylhet" name="description"/>
    <meta content="Pencil Design Studio" name="author"/>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?php echo e(asset('frontend/assets/images/favicon.ico')); ?>">
    <!-- Bootstrap Css -->
    <link href="<?php echo e(asset('frontend/assets/css/bootstrap.min.css')); ?>" rel="stylesheet" type="text/css"/>
    <!-- Icons Css -->
    <link href="<?php echo e(asset('frontend/assets/css/icons.min.css')); ?>" rel="stylesheet" type="text/css"/>
    <!-- App Css-->
    <link href="<?php echo e(asset('frontend/assets/css/app.min.css')); ?>" rel="stylesheet" type="text/css"/>
    <!-- Custom Css-->
    <link href="<?php echo e(asset('frontend/assets/css/custom.min.css')); ?>" rel="stylesheet" type="text/css"/>

    <?php echo $__env->yieldPushContent('css'); ?>

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
</head>

<body data-bs-spy="scroll" data-bs-target="#navbar-example">

<div class="layout-wrapper landing">
    <nav class="navbar navbar-expand-lg navbar-landing fixed-top bg-light shadow-lg" id="navbar">
        <div class="container">
            <a class="navbar-brand" href="<?php echo e(route('home')); ?>">
                <img src="<?php echo e(asset('backend/assets/images/logo.jpg')); ?>" alt="logo" height="80">
            </a>
            <button class="navbar-toggler py-0 fs-20 text-body" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <i class="mdi mdi-menu"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <form action="<?php echo e(route('search-form')); ?>" class="d-flex align-items-center mx-auto search-box"
                      role="search">
                    <input class="form-control me-2 <?php $__errorArgs = ['user_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="search" name="user_id"
                           placeholder="Search by User ID"
                           aria-label="Search">
                    <button class="btn btn-clr-red rounded" type="submit">Search</button>
                </form>
                <ul class="navbar-nav mt-2 mt-lg-0 d-flex justify-content-between gap-2" id="navbar-example">
                    <li class="nav-item">
                        <a class="nav-link fs-5 <?php echo e(request()->routeIs('home') ? 'active' : ''); ?>"
                           href="<?php echo e(route('home')); ?>">
                            <i class=" las la-file"></i> Visa
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-5"
                           href="#">
                            <i class="las la-plane"></i> Flight
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-5"
                           href="#">
                            <i class="las la-wifi"></i> Wifi
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    </nav>
    <?php echo $__env->yieldContent('content'); ?>
</div>

<script src="<?php echo e(asset('frontend/assets/libs/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
<script src="<?php echo e(asset('frontend/assets/js/plugins.js')); ?>"></script>
<script src="<?php echo e(asset('frontend/assets/js/custom.js')); ?>"></script>

<?php echo $__env->yieldPushContent('js'); ?>

</body>
</html>
<?php /**PATH /Users/bokhtiartoshar/Desktop/Project/Sajon Bhai/visaExpert.com-master/resources/views/layouts/frontend/master.blade.php ENDPATH**/ ?>
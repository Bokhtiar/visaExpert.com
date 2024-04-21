<?php if($paginator->hasPages()): ?>
    <div class="d-flex justify-content-end">
        <div class="pagination-wrap hstack gap-2">

            <?php if($paginator->onFirstPage()): ?>
                <a class="page-item pagination-prev disabled" href="javascrpit:void(0)">
                    Previous
                </a>
            <?php else: ?>
                <a class="page-item pagination-prev" href="<?php echo e($paginator->previousPageUrl()); ?>">
                    Previous
                </a>
            <?php endif; ?>

            <ul class="pagination listjs-pagination mb-0">
                <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(is_string($element)): ?>
                        <li class="disabled">
                            <a class="page" href="javascript:void(0)">
                                <?php echo e($element); ?>

                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if(is_array($element)): ?>
                        <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page=>$url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($page == $paginator->currentPage()): ?>
                                <li class="active">
                                    <a class="page-link" href="javascript:void(0)">
                                        <?php echo e($page); ?>

                                    </a>
                                </li>
                            <?php else: ?>
                                <li>
                                    <a class="page" href="<?php echo e($url); ?>"><?php echo e($page); ?></a>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>

            <?php if($paginator->hasMorePages()): ?>
                <a class="page-item pagination-next" href="<?php echo e($paginator->nextPageUrl()); ?>">
                    Next
                </a>
            <?php else: ?>
                <a class="page-item pagination-next disabled" href="javascript:void(0);">
                    Next
                </a>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>
<?php /**PATH /home/visatuey/visa.visaxpert.net/resources/views/pagination/default.blade.php ENDPATH**/ ?>
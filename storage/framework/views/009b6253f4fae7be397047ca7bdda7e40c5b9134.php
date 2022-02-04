
<?php $__env->startSection('title'); ?>
<?php echo e(__('sentence.View Prescription')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div>
        
        <?php echo e($patient['1']->name); ?>

    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\DELL\Desktop\doctorino\resources\views/appointment/view.blade.php ENDPATH**/ ?>
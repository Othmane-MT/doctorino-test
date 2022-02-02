

<?php $__env->startSection('title'); ?>
<?php echo e(__('sentence.Appointment')); ?>

<?php $__env->stopSection(); ?>

    <div class="Appointment-view" >
        <h1>
            Name : <strong>
                <?php echo e($patient->name); ?>

            </strong>
        </h1>
    </div>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\DELL\Desktop\doctorino\resources\views/appointment/view.blade.php ENDPATH**/ ?>
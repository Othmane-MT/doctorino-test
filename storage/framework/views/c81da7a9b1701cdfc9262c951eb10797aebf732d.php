<?php $__env->startSection('title'); ?>
<?php echo e(__('sentence.All Patients')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php if($errors->any()): ?>
<div class="alert alert-danger">
   <ul>
      <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <li><?php echo e($error); ?></li>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
   </ul>
</div>
<?php endif; ?>
<?php if(session('success')): ?>
<div class="alert alert-success">
   <?php echo e(session('success')); ?>

</div>
<?php endif; ?>
<!-- DataTales  -->
<div class="card shadow mb-4">
   <div class="card-header py-3">
      <div class="row">
         <div class="col-8">
            <h6 class="m-0 font-weight-bold text-primary w-75 p-2"><?php echo e(__('sentence.All Appointments')); ?></h6>
         </div>
         <div class="col-4">
            <a href="<?php echo e(route('appointment.create')); ?>" class="btn btn-primary float-right"><i class="fa fa-plus"></i> <?php echo e(__('sentence.New Appointment')); ?></a>
         </div>
      </div>
   </div>
   <div class="calendar">
      <div class="calendar-header">
         
            <div class="btns-left" >
                  <div class="btns-left-right" >
                     <button class="button-left" >
                        <i class="fas fa-arrow-left" ></i>
                     </button>
                     <button class="button-right" >
                        <i class="fas fa-arrow-right" ></i>
                     </button>
                  </div>
                  <button class="button-today">
                     today
                  </button>
            </div>

            <div class="calendar-title" > 
               <h2>
                  September 2019
               </h2>
            </div>
            <div class="btns-right" >
               <ul>
                  <li>
                     <button>
                        month
                     </button>
                  </li>
                  <li>
                     <button>
                        week
                     </button>
                  </li>
                  <li>
                     <button>
                        day
                     </button>
                  </li>
               </ul>
            </div>
      </div>
      <div class="calendar-body">
      </div>
   </div>
</div>
<!--EDIT Appointment Modal-->
<div class="modal fade" id="EDITRDVModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><?php echo e(__('sentence.You are about to modify an appointment')); ?></h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
         </div>
         <div class="modal-body">
            <p><b><?php echo e(__('sentence.Patient')); ?> :</b> <span id="patient_name"></span></p>
            <p><b><?php echo e(__('sentence.Date')); ?> :</b> <span id="rdv_date"></span></p>
            <p><b><?php echo e(__('sentence.Time Slot')); ?> :</b> <span id="rdv_time"></span></p>
         </div>
         <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal"><?php echo e(__('sentence.Close')); ?></button>
            <a class="btn btn-primary text-white" onclick="event.preventDefault(); document.getElementById('rdv-form-confirm').submit();"><?php echo e(__('sentence.Confirm Appointment')); ?></a>
            <form id="rdv-form-confirm" action="<?php echo e(route('appointment.store_edit')); ?>" method="POST" class="d-none">
               <input type="hidden" name="rdv_id" id="rdv_id">
               <input type="hidden" name="rdv_status" value="1">
               <?php echo csrf_field(); ?>
            </form>
            <a class="btn btn-primary text-white" onclick="event.preventDefault(); document.getElementById('rdv-form-cancel').submit();"><?php echo e(__('sentence.Cancel Appointment')); ?></a>
            <form id="rdv-form-cancel" action="<?php echo e(route('appointment.store_edit')); ?>" method="POST" class="d-none">
               <input type="hidden" name="rdv_id" id="rdv_id2">
               <input type="hidden" name="rdv_status" value="2">
               <?php echo csrf_field(); ?>
            </form>
         </div>
      </div>
   </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\DELL\Desktop\doctorino\resources\views/appointment/all.blade.php ENDPATH**/ ?>
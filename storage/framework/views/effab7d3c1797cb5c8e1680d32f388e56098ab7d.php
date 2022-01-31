<?php
                             @component('Illuminate\View\AnonymousComponent', 'modal', ['view' => 'components.modal','data' => ['id' => 'modal-lg','title' => 'Modal LG','size' => 'lg']])
<?php $component->withAttributes(['id' => 'modal-lg','title' => 'Modal LG','size' => 'lg']); ?>
                               <?php $__env->slot('body'); ?> 
                                Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
                               <?php $__env->endSlot(); ?>
                               <?php $__env->slot('footer'); ?> 
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                               <?php $__env->endSlot(); ?>
                             <?php if (isset($__componentOriginal)): ?>
<?php $component = $__componentOriginal; ?>
<?php unset($__componentOriginal); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> 
                            ?><?php /**PATH C:\Users\DELL\Desktop\doctorino\resources\views/components/modal.blade.php ENDPATH**/ ?>
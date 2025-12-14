<form method="POST" action="<?php echo e(route('login')); ?>">
        <?php echo csrf_field(); ?> 
        <input id="email" 
                style="margin-top:20px; border-radius: 10px; text-align:center;" 
                placeholder="Email" 
                type="email" 
                class="<?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                name="email" 
                value="<?php echo e(old('email')); ?>" 
                required 
                autocomplete="email"><br>
                
        <input id="password" 
                style="margin-top:30px; margin-bottom:30px; border-radius: 10px; text-align:center;" 
                placeholder="Password" 
                type="password" 
                class="<?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                name="password" 
                required 
                autocomplete="current-password"><br>
                
        <button type="submit" class="btn btn-primary" style="width:160px;">
                <?php echo e(__('Login')); ?>

        </button>
</form>
    


<?php /**PATH /Users/carlosrobles/Desktop/Trollers/resources/views/general/Login/login.blade.php ENDPATH**/ ?>
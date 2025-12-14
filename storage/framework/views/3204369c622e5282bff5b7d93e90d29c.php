<?php echo $__env->make('general.Header.rainbow', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="row justify-content-center">
    <div class="col-md-12 text-center py-5">
        <p><a href="https://www.instagram.com/trollers.es/">Trollers</a> &copy; 2013 - <?php echo e(now()->year); ?></p>
        <!-- <p class="rainbow_text animated">- Hasta que la poli nos separe -</p> -->
        <!-- Idiomas -->
          
        <a href="<?php echo e(route('change_lang', ['lang' => 'es'])); ?>" class="bandera"><img src="https://cdn-icons-png.flaticon.com/512/555/555635.png" alt="Smiley face" height="32" width="32"></a>
        <a href="<?php echo e(route('change_lang', ['lang' => 'en'])); ?>" ><img src="https://cdn-icons-png.flaticon.com/512/555/555417.png" alt="Smiley face" height="32" width="32"></a>
        <br><br>

        <!-- Idiomas End -->
        <?php if(Auth::check()): ?>
        <p><a href="cuenta" style="color:white"><?php echo e(Auth::user()->name); ?></a></p>
        <a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <span style="color:white"><?php echo e(trans('messages.cs')); ?></span>
        </a>
        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
            <?php echo csrf_field(); ?>
        </form>
        <?php endif; ?>
    </div>
    </div>
</div><?php /**PATH /Users/carlosrobles/Desktop/Trollers/resources/views/general/Footer/footer.blade.php ENDPATH**/ ?>
<header class="header-bar d-flex d-lg-block align-items-center">
  <div class="site-logo">
    <?php $cumple = \App\Models\Calendar::where("fecha",date("Y-m-d"))->where("tipo",1)->get();?> 
    <?php if($cumple->count() > 0): ?>
    <?php echo $__env->make('general.Header.rainbow', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <h2 class="rainbow_text animated">¡Felicidades <?php echo e($cumple[0]->titulo); ?>!</h2>
    <?php else: ?>
    <a href="/">The Trollers</a>
    <?php endif; ?>
  </div>

  <div class="d-inline-block d-xl-none ml-md-0 ml-auto py-3" style="position: relative; top: 3px;"><a href="#" class="site-menu-toggle js-menu-toggle text-white"><span class="icon-menu h3"></span></a></div>
  <div class="main-menu">
    <ul class="js-clone-nav">
      <li><a href="/"><?php echo e(trans('messages.home')); ?></a></li>
      <li><a href="/trollers-gpt">Trollers AI</a></li>
      <li><a href="/test">Test</a></li>
      <li><a href="/enigma">Enigma</a></li>
      <li><a href="/timeline">Timeline</a></li>
      <li><a href="/minijuego">Minijuego</a></li>
      <li><a href="/proyectos"><?php echo e(trans('messages.pr')); ?></a></li>
      <li><a href="/formacion"><?php echo e(trans('messages.for')); ?></a></li>
      <li><a href="/calendario"><?php echo e(trans('messages.calendar')); ?></a></li>
      <li><a href="https://tv.trollers.es" target="_blank">Trollers TV</a></li>
      <li><a href="/spotify">Spotify Wrapped</a></li>
      <li><a href="/boe">BOE</a></li>
      <li><a href="/mw3">MW3</a></li>
      <li><a href="https://www.instagram.com/trollers.es/"><span class="icon-instagram"></span></a></li>
      <?php if(Auth::check()): ?>
      <?php $notificaciones = \App\Models\Notificacion::get()->where("id_destino",Auth::user()->id)->where("leido",false)->count();?> 
      <li><a href="/cuenta"><?php echo e(Auth::user()->name); ?></a></li>
      <?php if($notificaciones > 0): ?>
        <li><a style="color:#FF6666;" href="/notificaciones"><?php echo e(trans('messages.not')); ?> (<?php echo e($notificaciones); ?>)</a></li>
      <?php else: ?>
        <li><a href="/notificaciones"><?php echo e(trans('messages.not')); ?> (<?php echo e($notificaciones); ?>)</a></li>
      <?php endif; ?>
      <li><a href="/netflix">Netflix</a></li>
      <li><a href="/protocolos"><?php echo e(trans('messages.pro')); ?></a></li>
      <?php if(Auth::user()->rol==1): ?>
      <li><a href="/manager">Manager Pro</a></li>
      <li><a href="/crear-evento"><?php echo e(trans('messages.addev')); ?></a></li>
      <li><a href="/imagen"><?php echo e(trans('messages.addimg')); ?></a></li>
      <li><a href="/eliminar"><?php echo e(trans('messages.delimg')); ?></a></li>
      <li><a href="/crear-boe"><?php echo e(trans('messages.adda')); ?></a></li>
      <li><a href="/proyecto"><?php echo e(trans('messages.addpr')); ?></a></li>
      <li><a href="/crear-protocolo"><?php echo e(trans('messages.addpro')); ?></a></li>
      <li>
        <a href="#" onclick="event.preventDefault(); document.getElementById('delete-all-stories-form').submit();" style="color: #ff4444;">
          Eliminar Stories
        </a>
      </li>
      <form id="delete-all-stories-form" action="<?php echo e(route('stories.deleteAll')); ?>" method="POST" style="display: none;">
        <?php echo csrf_field(); ?>
        <?php echo method_field('DELETE'); ?>
      </form>
      <?php endif; ?>
      <li><a href="/pagos"><?php echo e(trans('messages.pay')); ?></a></li>
      <?php endif; ?>
      <?php if(!Auth::check()): ?>
      <br><br><br><br>
      <?php echo $__env->make('general.Login.login', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <?php else: ?>
      <li href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <span style="color:white; cursor: pointer;"><?php echo e(trans('messages.cs')); ?></span>
      </li>
      <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
        <?php echo csrf_field(); ?>
      </form>
      <?php endif; ?>
    </ul>
  </div>
</header>
<?php /**PATH /Users/carlosrobles/Desktop/Trollers/resources/views/general/Header/header.blade.php ENDPATH**/ ?>
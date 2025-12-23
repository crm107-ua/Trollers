<!DOCTYPE html>
<html lang="en">
<?php echo $__env->make('general.Head.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7315335954466454" crossorigin="anonymous"></script>
<body>
  <div class="site-wrap" >

    <div class="site-mobile-menu">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>

    <?php echo $__env->make('general.Header.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
    <main class="main-content">
      <div class="container-fluid photos">
        <div class="row pt-4 text-center">
          <div class="col-12">
            <?php if(!$isLive): ?>
             <!--  <h2 class="text-white mb-2" id="header">Bienvenid<span style="background: linear-gradient(45deg, #F6E58D, #FF7979, #FFD93D, #FFA8A1); background-size: 400%; animation: gradientAnimationHome 5s ease infinite; -webkit-background-clip: text; -webkit-text-fill-color: transparent;">@</span>
              </h2> -->
            <?php else: ?>
            <h2 class="text-white mb-2" id="header" style="cursor: pointer;">
              <a href="https://tv.trollers.es/">
                <div class="background-video w-background-video w-background-video-atom">
                    <video id="video" autoplay loop muted playsinline data-object-fit="cover" data-wf-ignore="true"></video>
                    <img src="https://drive.carlosrobles.es/apps/files_sharing/publicpreview/sqpiK7t6T3pd4ne?file=/&fileId=27200&x=3024&y=1964&a=true&etag=25feda7786ba70536b2914cd6459bd4a" alt="Trollers tv" class="trollers-image" />
                </div>
              </a>
              <style>
                  .trollers-image {
                      position: absolute; /* Para superponerla sobre el video */
                      top: 30%;
                      left: 50%;
                      transform: translate(-50%, -50%); /* Centrar la imagen */
                      max-width: 30%; /* Ajustar el ancho máximo a un 20% */
                      height: auto; /* Mantener la proporción */
                      z-index: 10; /* Asegurarse de que esté por encima del video */
                  }
          
                  /* Media query para pantallas más pequeñas */
                  @media (max-width: 768px) { /* Cambia 768px según el breakpoint deseado */
                      .trollers-image {
                          max-width: 80%; /* Aumenta el tamaño en dispositivos móviles */
                      }
                  }
              </style>
          </h2>                  
            <?php endif; ?>
                <?php echo $__env->make('general.Home.countdown', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php if($alerta->alternative): ?>
              <?php echo $__env->make('general.Home.info.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
            <?php if($serverStatus): ?>
                <?php echo $__env->make('general.Home.minecraft', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
          </div>

        </div>

        <?php echo $__env->make('general.Stories.stories-circles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="row align-items-stretch">

          <?php $__currentLoopData = $imagenes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $imagen): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="col-6 col-md-6 col-lg-6 " data-aos="fade-up">
            <a href="images/fotos/<?php echo e($imagen->name); ?>" class="d-block photo-item" data-fancybox="gallery">
              <img src="images/fotos/<?php echo e($imagen->name); ?>" alt="Image" class="img-fluid">
              <div class="photo-text-more">
                <span class="icon icon-expand"></span>
              </div>
            </a>
            <?php if($edit): ?>
            <form action="<?php echo e(route('eliminar')); ?>" method="post">
              <?php echo csrf_field(); ?>
              <div class="form-group" hidden>
                <input name="id" value="<?php echo e($imagen->id); ?>">
              </div>
              <div class="form-group" hidden>
                <input name="name" value="<?php echo e($imagen->name); ?>">
              </div>
              <div class="form-group">
                <input type="submit" style="margin-bottom:15px;" onclick="return confirm('¿Seguro que quieres eliminar esta foto?')" class="btn btn-danger" value="<?php echo e(trans('messages.del')); ?>" name="submit">
              </div>
            </form>
            <?php endif; ?>
          </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

          <iframe src="https://open.spotify.com/embed/playlist/2KVu7MJkFM5uZ0oaAlOB3V" style="margin:15px;" width="100%" height="500px" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>
          <iframe src="https://discordapp.com/widget?id=538027285580873728&theme=dark" style="margin:15px;" width="100%" height="500px" allowtransparency="true" frameborder="0"></iframe>

        </div>

        <?php echo $__env->make('general.Footer.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

      </div>
    </main>

    <?php echo $__env->make('general.Links.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</body>

</html>
<?php /**PATH /Users/carlosrobles/Desktop/Trollers/resources/views/general/Home/home.blade.php ENDPATH**/ ?>
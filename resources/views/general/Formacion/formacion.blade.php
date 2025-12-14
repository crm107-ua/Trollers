<!DOCTYPE html>
<html lang="en">
@include('general.Head.head')
  <body>
  <div class="site-wrap">
  <div class="site-mobile-menu">
    <div class="site-mobile-menu-header">
      <div class="site-mobile-menu-close mt-3">
        <span class="icon-close2 js-menu-toggle"></span>
      </div>
    </div>
    <div class="site-mobile-menu-body"></div>
  </div>

  @include('general.Header.header')

   <div class="row pt-4 text-center">
        <div class="col-12">
          <h2 class="text-white mb-4" id="header">{{ trans('messages.gab') }}</h2>
        </div>
  </div>

  <main class="main-content">
    <div class="container-fluid photos">
      <div class="row justify-content-center">

        <div class="col-md-6 pt-4">

          <div class="row">
              @foreach($usuarios as $usuario)
                @if($usuario->id == 1000) <!-- Usuario grupal -->
                    @continue
                @endif
              <div class="col-md-12" style="margin-bottom:40px;" data-aos="fade-up">
                    <div class="d-flex blog-entry align-items-start">
                        <div class="col-md-12">
                          <div class="img-wrap row justify-content-center"><img src="images/perfiles/{{$usuario->imagen}}" alt="Image" width="260px" height="260px" style="object-fit:cover;"></div><br>
                          <h2 class="mt-0 mb-4 row justify-content-center" style="color:white;">{{$usuario->name}}</h2>
                          <h2 class="mt-0 mb-4 ml-1 row justify-content-center" style="color:white;"><?php echo $usuario->cargo ?></h2>                                                
                          @if($usuario->id == 3)
                          <div class="img-wrap row justify-content-center">
                            <video class="mt-0 mb-3" id="video" playsinline loop autoplay preload muted>
                              <source src="./archivos/animaciones/guerra_activo.mov" type="video/mp4" />
                            </video>
                          </div>
                          @endif

                          @if($usuario->id == 11)
                          <div class="img-wrap row justify-content-center">
                            <video class="mt-0 mb-3" id="video"  playsinline loop autoplay preload muted>
                              <source src="./archivos/animaciones/inversion.mov" type="video/mp4" />
                            </video>
                          </div>
                          @endif

                          @if($usuario->id == 4)
                          <div class="img-wrap row justify-content-center">
                            <video class="mt-0 mb-3" id="video"  playsinline loop autoplay preload muted>
                              <source src="./archivos/animaciones/md_animacion.mov" type="video/mp4" />
                            </video>
                          </div>
                          @endif

                          @if($usuario->id == 2)
                          <div class="row justify-content-center">
                            <a href="./archivos/escudos/MI.png"><img src="./archivos/escudos/MI.png" style="margin:20px;" alt="Image" width="150px" height="150px"></a>
                            <a href="./archivos/escudos/PT.png"><img src="./archivos/escudos/PT.png" style="margin:20px;" alt="Image" width="150px" height="150px"></a>
                            <a href="./archivos/escudos/A2030.jpg"><img src="./archivos/escudos/A2030.jpg" style="margin:20px; border-radius:20px;" alt="Image" width="150px" height="200px"></a>
                          </div>
                          <div class="img-wrap row justify-content-center">
                            <video id="video" playsinline loop autoplay preload muted>
                              <source src="./archivos/animaciones/acp_logo.mov" type="video/mp4" />
                            </video>
                          </div>
                          @endif

                          @if($usuario->id == 12)
                          <div class="img-wrap row justify-content-center">
                            <video class="mt-0 mb-3" id="video" playsinline loop autoplay preload muted>
                              <source src="./archivos/animaciones/inteligencia.mov" type="video/mp4" />
                            </video>
                          </div>
                          @endif
                          <h6 class="text-white"><?php echo $usuario->descripcion ?></h6>
                        </div>
                    </div>
                </div><br>
              @endforeach
            </div>
          </div>
        </div>
      </div>
      @include('general.Footer.footer')
      
    </main>

  @include('general.Links.scripts')

  </body>
</html>


<style>
 #cabecera{
 width: 100%;
 height: 500px;
 }
 #video {
 width: 65%;
 }
</style>

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
  
  <main class="main-content">
    <div class="container-fluid photos">
      <div class="row justify-content-center">
        <div class="col-md-6 pt-4">
          <figure class="mb-5" data-aos="fade-up">
            <img style="display:block; margin:auto;" src="images/perfiles/{{Auth::user()->imagen}}" alt="Image" class="img-fluid" width="350px" height="300px">
          </figure>
          <h2 class="text-white mb-4" data-aos="fade-up">{{Auth::user()->name}}</h2>

          <h4 class="text-white mb-4" data-aos="fade-up">{{Auth::user()->cargo}}</h4>

          <h6 class="text-white mb-4" data-aos="fade-up"><?php echo Auth::user()->descripcion ?></h6>
            <a href="editar" style="margin:15px;" class="btn btn-light">{{ trans('messages.userimg') }}</a>
            <a href="descripcion"  style="margin:15px;" class="btn btn-light">{{ trans('messages.edit') }}</a>
            <a href="password" style="margin:15px;" class="btn btn-light">{{ trans('messages.pass') }}</a>
            <a href="alerta" style="margin:15px;" class="btn btn-danger">{{ trans('messages.alert') }}</a>
            <a href="certificado-covid" style="margin:15px;" class="btn btn-success">Certificado COVID-19</a>
        </div>
      </div>
    </div>
  </main>

  @include('general.Links.scripts')

  </body>
</html>

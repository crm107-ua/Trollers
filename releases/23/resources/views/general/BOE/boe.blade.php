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
          <h2 class="text-white mb-4" id="header">Boletín Oficial del Estado</h2>
        </div>
  </div>

  @foreach($articulos as $articulo)
  @if($articulo->mode == 0)
  <main class="main-content">
    <div class="container-fluid photos">
      <div class="row justify-content-center">
        <div class="col-md-10 pt-4">
          <h2 class="text-white mb-4" data-aos="fade-up">{{$articulo->titulo}}</h2>
          <h4 class="text-white mb-4" data-aos="fade-up">Decretado por el {{$articulo->ministerio}}</h4>
          <h4 class="text-white mb-4" data-aos="fade-up">Publicado el día {{$articulo->fecha}}</h4>
          <h6 class="text-white"><?php echo $articulo->descripcion ?></h6>
            @if($articulo->link)
               @if(Auth::check())
                <a href="{{$articulo->link}}" style="color: blue;" >Enlace para ver el documento: {{$articulo->titulo}}</a><br><br>
              @else
                <a style="color: red;" >Si eres miembro inicia sesión para visualizar</a><br><br>
              @endif
            @endif
            @if(Auth::check() && Auth::user()->rol==1)
                <a href="editar-boe/{{$articulo->id}}"  style="margin:15px; float:left;" class="btn btn-light">Editar</a>
                <form action="{{ route('eliminar-boe') }}" method="post" style="float:left;">
                    @csrf 
                    <div hidden>
                        <input name="id" value="{{$articulo->id}}">
                    </div>
                    <input type="submit" onclick="return confirm('¿Seguro que quieres eliminarlo?')" style="margin:15px;" class="btn btn-danger" value="Eliminar" name="submit">
                </form>
            @endif
        </div>
      </div>
    </div>
  </main>
  @endif
  @endforeach

  @include('general.Links.scripts')

  </body>
</html>

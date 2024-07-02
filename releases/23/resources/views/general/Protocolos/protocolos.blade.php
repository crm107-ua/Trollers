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
          <h2 class="text-white mb-4" id="header">Protocolos</h2>
        </div>
  </div>
  
  @foreach($protocolos as $protocolo)
  <main class="main-content">
    <div class="container-fluid photos">
      <div class="row justify-content-center">
        <div class="col-md-10 pt-4">
          <h4 class="text-white mb-4" data-aos="fade-up">{{$protocolo->titulo}} en el día del {{$protocolo->fecha}}</h4>
          <h6 class="text-white"><?php echo $protocolo->descripcion ?><h6>
            @if(Auth::check() && Auth::user()->rol==1)
                <a href="editar-protocolo/{{$protocolo->id}}"  style="margin:15px; float:left;" class="btn btn-light">Editar</a>
                <form action="{{ route('eliminar-protocolo') }}" method="post" style="float:left;">
                    @csrf 
                    <div hidden>
                        <input name="id" value="{{$protocolo->id}}">
                    </div>
                    <input type="submit" style="margin:15px;" onclick="return confirm('¿Seguro que quieres eliminarlo?')" class="btn btn-danger" value="Eliminar" name="submit">
                </form>
            @endif
        </div>
      </div>
    </div>
  </main>
  @endforeach

  @include('general.Links.scripts')

  </body>
</html>

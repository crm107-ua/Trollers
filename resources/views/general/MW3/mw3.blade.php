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

  <main class="main-content" style="padding: 30px;">  
      <div class="row">
              <div class="col-12 text-center">
                  <h2 class="text-white mb-4" id="header">Tablas de puntuaciones MW3</h2>
                  <a href="./crear-mw3" class="btn btn-success mb-4">Añadir puntuación</a>
                  <br><br>
                  <h4 class="text-white mb-5" id="header">Un solo jugador</4>
              </div><br><br>
           @foreach($individual as $key => $puntuacion)
                <div class="card" style="width: 18rem; border-radius: 10px; padding: 10px; margin-left: auto;margin-right: auto;margin-top: 20px; text-align:center;">
                  <a href="./images/mw3/{{$puntuacion->image}}">
                    <img src="./images/mw3/{{$puntuacion->image}}" class="card-img-top" alt="{{$puntuacion->image}}" width="50" height="200">
                  </a>
                  <div class="card-body">
                  @if($key==0)
                       <h5 class="card-title" style="color: gold">Primera posición ⭐</h5>
                  @endif
                  @if($key==1)
                       <h5 class="card-title" style="color: silver">Segunda posición</h5>
                  @endif
                  @if($key==2)
                       <h5 class="card-title" style="color: #977816">Tercera posición</h5>
                  @endif
                    <p class="card-text">Nombre: <b>{{$puntuacion->name}}</b></p>
                    <p class="card-text">Ronda: {{$puntuacion->ronda}}</p>
                    <p class="card-text">Mapa: {{$puntuacion->mapa}}</p>
                    <p class="card-text">Puntos: {{$puntuacion->puntos}}</p>
                    <p class="card-text">Tiempo: {{$puntuacion->tiempo}}</p>
                    <p class="card-text">Código: {{$puntuacion->code}}</p>
                    <p class="card-text">Fecha: {{$puntuacion->fecha}}</p>
                  </div>
                </div><br>
            @endforeach  

            <div class="col-12 text-center">
               <br><br>
                  <h4 class="text-white mb-5" id="header">Juego por parejas</4>
              </div><br><br>
           @foreach($parejas as $key => $puntuacion)
           <div class="card" style="width: 18rem; border-radius: 10px; padding: 10px; margin-left: auto;margin-right: auto;margin-top: 20px; text-align:center;">
                  <a href="./images/mw3/{{$puntuacion->image}}">
                    <img src="./images/mw3/{{$puntuacion->image}}" class="card-img-top" alt="{{$puntuacion->image}}" width="50" height="200">
                  </a>
                  <div class="card-body">
                  @if($key==0)
                       <h5 class="card-title" style="color: gold">Primera posición ⭐</h5>
                  @endif
                  @if($key==1)
                       <h5 class="card-title" style="color: silver">Segunda posición</h5>
                  @endif
                  @if($key==2)
                       <h5 class="card-title" style="color: #977816">Tercera posición</h5>
                  @endif
                    <p class="card-text">Nombre: <b>{{$puntuacion->name}}</b></p>
                    <p class="card-text">Ronda: {{$puntuacion->ronda}}</p>
                    <p class="card-text">Mapa: {{$puntuacion->mapa}}</p>
                    <p class="card-text">Puntos: {{$puntuacion->puntos}}</p>
                    <p class="card-text">Tiempo: {{$puntuacion->tiempo}}</p>
                    <p class="card-text">Código: {{$puntuacion->code}}</p>
                    <p class="card-text">Fecha: {{$puntuacion->fecha}}</p>
                  </div>
                </div><br>
            @endforeach     
    </div>
    </main>

  @include('general.Links.scripts')

  </body>
</html>

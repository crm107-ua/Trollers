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

  @include('general.Notificaciones.estilos')
  @include('general.Header.header')
  
  <main class="main-content">
    <div class="container-fluid photos">
      <div class="row justify-content-center">
        <div class="col-md-6 pt-4">
        <div class="row pt-4 mb-3 text-center">
        </div>
          <a class='button' style="color: white;" href='nueva-notificacion'>
                Escribir
           </a><br><br>
        <main class="page">
            <section class="page__container">
            <h1>
            Notificaciones
              </h1><br>
                <p>
                  Total de notificaciones sin leer: {{ $notificaciones->where("leido",false)->count() }}
                </p>
                <main>
                  <table>
                    <thead>
                      <tr>
                        <th>
                          Ministerio
                        </th>
                        <th>
                          Asunto
                        </th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($notificaciones as $notificacion)
                      <tr>
                        <td data-title='Ministerio'>
                            @if($notificacion->leido)
                            {{ App\Models\User::where("id",$notificacion->id_origen)->get()[0]->cargo  }}
                            @else
                            <b>{{ App\Models\User::where("id",$notificacion->id_origen)->get()[0]->cargo  }}</b>
                            @endif
                        </td>
                        <td data-title='Asunto'>
                          @if($notificacion->leido)
                              {{ $notificacion->cabecera }}
                          @else
                              <b>{{ $notificacion->cabecera }}</b>
                          @endif
                        </td>
                        <td class='select'>
                          <a class='button' style="color: white;" href='/ver-notificacion-{{$notificacion->id}}'>
                            Ver
                          </a>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </main>
        </main>
        <br>
        @if($recientes->count() > 0)
        <main class="page">
            <section class="page__container">
            <h1>
            Enviadas Recientemente
              </h1><br>
                <main>
                  <table>
                    <thead>
                      <tr>
                        <th>
                          Destinatario
                        </th>
                        <th>
                          Asunto
                        </th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($recientes as $reciente)
                      <tr>
                        <td data-title='Destino'>
                            @if($reciente->leido)
                            {{ App\Models\User::where("id",$reciente->id_destino)->get()[0]->cargo  }}
                            @else
                            <b>{{ App\Models\User::where("id",$reciente->id_destino)->get()[0]->cargo  }}</b>
                            @endif
                        </td>
                        <td data-title='Asunto'>
                        @if($reciente->leido)
                          {{ $reciente->cabecera }}
                        @else
                          <b>{{ $reciente->cabecera }}</b>
                        @endif
                        </td>
                        <td class='select'>
                          <a class='button' style="color: white;" href='/ver-notificacion-{{$reciente->id}}'>
                            Ver
                          </a>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </main>
        </main>
        @endif
        </div>
      </div>
      @include('general.Footer.footer')
    </div>
  </main>

  @include('general.Links.scripts')
  </body>
</html>

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
          <a class='button' style="color: white;" href='/notificaciones'>
                Volver
           </a>
           @if($notificacion[0]->id_origen != Auth::user()->id)
           <a class='button' style="color: white; float:right;" href='responder-notificacion-{{ $notificacion[0]->id }}'>
                Responder
           </a>
           @endif
           <br><br><br>
        <main class="page">
    <section class="page__container">
            <h1>
            {{ $notificacion[0]->cabecera }}
              </h1><br>
                <p>
                  Escrita por el {{App\Models\User::where("id",$notificacion[0]->id_origen)->get()[0]->cargo  }}
                </p>
                <p>
                  Dirigida al {{App\Models\User::where("id",$notificacion[0]->id_destino)->get()[0]->cargo  }}
                </p>
                @if($notificacion[0]->grupal)
                <p>
                  Notificacion enviada a todos los Ministerios, el dia {{ $notificacion[0]->fecha }}
                </p>
                @else
                <p>
                  Fecha de envio: {{ $notificacion[0]->fecha }}
                </p>
                @endif
                @if($notificacion[0]->id_destino != Auth::user()->id)
                @if(!$notificacion[0]->leido)
                <p><b>Notificación no leida por el destinatario</b></p>
                @else
                <p>Notificación leida por el destinatario</p>
                @endif
                @endif
                <main>
                  <table>
                    <thead>
                      <tr>
                        <th>
                          Mensaje
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td data-title='Mensaje'>
                            <?php echo $notificacion[0]->mensaje ?>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </main>
                @if($notificacion[0]->imagen)
                <main>
                  <table>
                    <thead>
                      <tr>
                        <th>
                          Imagen adjunta
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td data-title='Imagen'>
                            <img src="images/fotos/{{ $notificacion[0]->imagen }}" alt="Image" class="img-fluid">
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </main>
                @endif
            </section>
        </main>
        </div>
      </div>
      @include('general.Footer.footer')
    </div>
  </main>

  @include('general.Links.scripts')
  </body>
</html>

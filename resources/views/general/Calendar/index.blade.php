<!DOCTYPE html>
<html lang="en">
@include('general.Head.head')
@include('general.Calendar.estilos')
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

    @include('general.Header.header')
    <!-- calendar modal -->
    <div id="modal-view-event" class="modal modal-top fade calendar-modal">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-body">
              <h4 class="modal-title"><span class="event-icon"></span><span class="event-title"></span></h4>
              <div class="event-body"></div>
              <div class="event-image"></div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
              <form action="{{ route('eliminar-evento') }}" method="post">
              @csrf 
              <div class="form-group event-delete">
              </div>
              @if(Auth::check() && Auth::user()->rol==1)
              <button type="submit" style="margin-bottom:6px;" onclick="return confirm('¿Seguro que quieres eliminar este evento?')" class="btn btn-danger">Eliminar</button>
              @endif
              </form>
            </div>
          </div>
        </div>
    </div>
    
    <!-- calendar modal - finish -->
    <main class="main-content">
      <div class="container-fluid">
        <div class="row">
              <div class="card">
                <div class="card-body">
<a href="https://drive.carlosrobles.es/s/oZ7D4jW3i4yjBX6/download/cumples_validado.ics" 
   download 
   class="mt-3 mb-3"
   style="display: inline-flex; justify-content: center; align-items: center; width: 100%; background-color: #1a73e8; color: white; padding: 10px 20px; font-family: sans-serif; font-size: 18px; font-weight: 600; border-radius: 8px; text-decoration: none; box-shadow: 0 4px 10px rgba(0,0,0,0.15); transition: all 0.3s ease;">
   📅 <span style="margin-left: 10px;">Guardar en el calendario</span>
</a>
 
                 <div id="calendar"></div>
                </div>
             </div>
            </div>
          </div>
        @include('general.Footer.footer')
      </div>
    </main>

    <script type='text/javascript'>
    <?php
    $js_array = json_encode($fechas);
    echo "var fechas = ". $js_array . ";\n";
    ?>
    </script>

    @include('general.Links.scripts')
    @include('general.Calendar.scripts')

</body>

</html>






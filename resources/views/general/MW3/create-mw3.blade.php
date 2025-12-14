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
          <h4 class="text-white mb-4" data-aos="fade-up">Añadir puntuación - Modern Warfare 3</h4>
          <form action="{{ route('crear-mw3') }}" method="post" enctype="multipart/form-data">
            @csrf 
                <div class="form-group">
                    <select name="mode" id="mode" style="background-color: white; color:black; border-radius: 10px; padding: 15px; width: 80%;">
                        <option value="0">Modo: Individual</option>
                        <option value="1">Modo: Dos jugadores</option>
                    </select>             
                </div>
                <div class="form-group">
                    <input name="name" style="background-color: white; color:black; border-radius: 10px; padding: 15px; width: 80%;" placeholder="Nombre" maxlength="95" required>                
                </div>
                <div class="form-group">
                    <input name="ronda" type="number" style="background-color: white; color:black; border-radius: 10px; padding: 15px; width: 80%;" placeholder="Ronda" maxlength="3" min="1" required>                
                </div>
                <div class="form-group">
                    <input name="mapa" style="background-color: white; color:black; border-radius: 10px; padding: 15px; width: 80%;" placeholder="Mapa" maxlength="100" required>                
                </div>
                <div class="form-group">
                    <input name="puntos" type="number" style="background-color: white; color:black; border-radius: 10px; padding: 15px; width: 80%;" placeholder="Puntos" maxlength="3" min="1" required>                
                </div>
                <div class="form-group">
                    <input name="tiempo" style="background-color: white; color:black; border-radius: 10px; padding: 15px; width: 80%;" placeholder="Tiempo (hh:mm:ss)" maxlength="20" required>                
                </div><br>
                <div class="form-group">
                    <label class="text-white mb-4" style="margin-right:20px;">{{ trans('messages.i') }}:</label>
                    <input type="file" name="fileToUpload" id="fileToUpload" required>
                </div>
                <div class="form-group">
                    <input type="submit" style="border-radius: 10px; background-color: #FFC686;" value="Crear" name="submit">
                    <a href="./mw3" style="margin:10px;" class="btn btn-light">{{ trans('messages.volver') }}</a>
                </div>
          </form>
        </div>
      </div>
    </div>
  </main>

  @include('general.Links.scripts')
  </body>
</html>

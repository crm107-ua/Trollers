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
          <h2 class="text-white mb-4" data-aos="fade-up">Centro de Alertas y Comunicados de Emergencia</h2>
          <h4 class="text-white mb-4" data-aos="fade-up">Tutelaje del {{Auth::user()->cargo}}</h4>
          <form action="{{ route('activacion-alerta') }}" method="post">
            @csrf 
                @if($alerta->alternative == 0)
                <div class="form-group" hidden>
                    <input name="alternative" value="1">
                </div>
                <div class="form-group">
                    <label class="text-white mb-4">Activación de alerta oficial:&nbsp;&nbsp;</label>
                    <input type="submit" style="border-radius: 10px; background-color: red;" value="Activar alerta" name="submit">
                </div>
                @else
                <div class="form-group" hidden>
                    <input name="alternative" value="0">
                </div>
                <div class="form-group">
                    <label class="text-white mb-4">Desactivación de alerta oficial:&nbsp;&nbsp;</label>
                    <input type="submit" style="border-radius: 10px; background-color: green;'" value="Desactivar alerta" name="submit">
                </div>
                @endif
          </form>
          <form action="{{ route('crear-alerta') }}" method="post">
            @csrf 
                <div class="form-group">
                    <textarea id="textArea" class="form-control" name="texto" style="background-color: white; color:black; border-radius: 10px; padding: 15px;" rows="15" maxlength="200"></textarea>
                </div>
                <div class="form-group">
                    <label class="text-white mb-4" style="margin-right:20px;">{{ trans('messages.lvl') }} de alerta:</label>
                    <select name="nivel" class="form-control mb-4" required> 
                        <option value="1" selected="selected">1</option>
                        <option value="2">2</option> 
                        <option value="3">3</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="submit" style="border-radius: 10px; background-color: #FFC686;" value="Crear alerta" name="submit">
                    <a href="cuenta" style="margin:10px;" class="btn btn-light">{{ trans('messages.volver') }}</a>
                </div>
          </form>
        </div>
      </div>
    </div>
  </main>

  @include('general.Links.scripts')
  @include('general.Editor.editor')

  </body>
</html>

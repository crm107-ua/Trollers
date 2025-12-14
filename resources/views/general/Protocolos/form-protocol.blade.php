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
        <h4 class="text-white mb-4" data-aos="fade-up">Edición de protocolo</h4>
          <h4 class="text-white mb-4" data-aos="fade-up">Protocolo titulado "{{$protocolo->titulo}}" en el dia del {{$protocolo->fecha}}</h4>
          <h4 class="text-white mb-4" data-aos="fade-up">Excmo. Sr {{Auth::user()->name}}</h4>
          <form action="{{ route('editar-protocolo') }}" method="post">
            @csrf 
                <div class="form-group">
                    <input name="titulo" style="background-color: white; color:black; border-radius: 10px; padding: 15px; width: 100%;" maxlength="180" value="{{$protocolo->titulo}}">                
                </div>
                <div class="form-group">
                    <textarea id="textArea" class="form-control" name="descripcion" style="background-color: white; color:black; border-radius: 10px; padding: 15px;" rows="15" maxlength="4000">{{$protocolo->descripcion}}</textarea>
                </div>
                <div class="form-group" hidden>
                    <input name="id" value="{{$protocolo->id}}">
                </div>
                <div class="form-group">
                    <input type="submit" style="border-radius: 10px; background-color: #FFC686;" value="Guardar" name="submit">
                    <a href="../../../protocolos" style="margin:10px;" class="btn btn-light">{{ trans('messages.volver') }}</a>
                </div>
          </form>
        </div>
      </div>
    </div>
  </main>

  @include('general.Links.scripts')
  </body>
</html>

@include('general.Editor.editor')

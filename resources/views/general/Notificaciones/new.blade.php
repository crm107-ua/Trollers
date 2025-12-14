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
          <h4 class="text-white mb-4" data-aos="fade-up">Nueva notificación</h4>
          <h5 class="text-white mb-4" data-aos="fade-up">Redacción del {{App\Models\User::where("id",Auth::user()->id)->get()[0]->cargo  }}</h5>
          <h5 class="text-white mb-4" data-aos="fade-up">Excelentísimo señor {{App\Models\User::where("id",Auth::user()->id)->get()[0]->name  }}</h5>
          <form action="{{ route('nueva-notificacion') }}" method="post" enctype="multipart/form-data">
            @csrf 
                <div class="form-group">
                    <input name="cabecera" style="background-color: white; color:black; border-radius: 10px; padding: 15px; width: 100%;" placeholder="Cabecera" maxlength="250" required>                
                </div>
                <div class="form-group">
                    <textarea id="textArea" class="form-control" name="mensaje" style="background-color: white; border-radius: 10px; padding: 15px; width: 100%;" placeholder="Mensaje" rows="15" maxlength="4000"></textarea>
                </div>
                <div class="form-group">
                    <select name="id_destino" id="id_destino" style="background-color: white; color:black; border-radius: 10px; padding: 15px; width: 100%;">
                            <option value="0">Envio: Grupal</option>
                        @foreach($usuarios as $usuario)
                            <option value="{{$usuario->id}}">Destinatario: {{$usuario->cargo}}</option>
                        @endforeach
                    </select>             
                </div>
                <div class="form-group">
                    <label class="text-white mb-4" style="margin-top:10px;">{{ trans('messages.i') }} (Opcional):</label>
                    <input type="file" name="fileToUpload" id="fileToUpload">
                </div>
                <div class="form-group">
                    <input type="submit" style="border-radius: 10px; background-color: #FFC686;" value="Crear notificación" name="submit">
                    <a href="./notificaciones" style="margin:10px;" class="btn btn-light">{{ trans('messages.volver') }}</a>
                </div>
          </form>
        </div>
      </div>
    </div>
  </main>

  @include('general.Links.scripts')
  </body>
</html>

<style>
.form-control{
    border-bottom: 2px solid white;
}
</style>

@include('general.Editor.editor')
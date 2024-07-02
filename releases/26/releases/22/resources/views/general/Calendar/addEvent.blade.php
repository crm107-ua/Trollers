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
          <h4 class="text-white mb-4" data-aos="fade-up">Añadir evento</h4>
          <form action="{{ route('crear-evento') }}" method="post" enctype="multipart/form-data">
            @csrf 
                <div class="form-group">
                    <input name="titulo" style="background-color: white; color:black; border-radius: 10px; padding: 15px; width: 100%;" placeholder="Título" maxlength="40" required>                
                </div>
                <div class="form-group">
                    <textarea id="textArea" class="form-control" name="descripcion" style="background-color: white; border-radius: 10px; padding: 15px; width: 100%;" placeholder="Descripcion" rows="15" maxlength="4000"></textarea>
                </div>
                <div class="form-group" style="background-color: white; border-radius: 10px; padding: 15px; width: 100%;">
                    <input type="input" style="background-color: white; color:black;" class="form-control" id="inputDate" name="inputDate" placeholder="Fecha de inicio" required>                
                </div>
                <div class="form-group" style="background-color: white; border-radius: 10px; padding: 15px; width: 100%;">
                    <input type="input" style="background-color: white; color:black;" class="form-control" id="finaltDate" name="finalDate" placeholder="Fecha de finalización" required>                
                </div>
                <div class="form-group">
                    <select name="tipo" id="tipo" style="background-color: white; color:black; border-radius: 10px; padding: 15px; width: 100%;">
                        <option value="1">Modo: Cumple</option>
                        <option value="2">Modo: Comida / Cena</option>
                        <option value="3" selected>Modo: Fiesta</option>
                    </select>             
                </div>
                <div class="form-group">
                    <label class="text-white mb-4" style="margin-top:10px;">{{ trans('messages.i') }} promocional (Opcional):</label>
                    <input type="file" name="fileToUpload" id="fileToUpload">
                </div>
                <div class="form-group">
                    <input type="submit" style="border-radius: 10px; background-color: #FFC686;" value="Añadir al calendario" name="submit">
                    <a href="./calendario" style="margin:10px;" class="btn btn-light">{{ trans('messages.volver') }}</a>
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

<script>$('#inputDate').datepicker({
});
</script>

<script>$('#finaltDate').datepicker({
});
</script>

@include('general.Editor.editor')
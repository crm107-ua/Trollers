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
        <h4 class="text-white mb-4" data-aos="fade-up">Minecraft Wiki</h4>
          <h4 class="text-white mb-4" data-aos="fade-up">Creación de nuevo post</h4>
          <h4 class="text-white mb-4" data-aos="fade-up"></h4>
          <form action="{{ route('add-minecraft') }}" method="post">
            @csrf 
                <div class="form-group">
                    <textarea id="textArea" class="form-control" name="descripcion" style="background-color: white; color:black; border-radius: 10px; padding: 15px;" rows="15" maxlength="4000"></textarea>
                </div>
                <div class="form-group">
                    <input name="name" style="background-color: white; color:black; border-radius: 10px; padding: 15px; width: 100%;" maxlength="180" placeholder="Titulo del link">                
                </div>
                <div class="form-group">
                    <input name="link" style="background-color: white; color:black; border-radius: 10px; padding: 15px; width: 100%;" maxlength="180" placeholder="Link de descarga">                
                </div>
                <div class="form-group">
                    <input type="submit" style="border-radius: 10px; background-color: #FFC686;" value="Crear Post" name="submit">
                    <a href="../minecraft" style="margin:10px;" class="btn btn-light">{{ trans('messages.volver') }}</a>
                </div>
          </form>
        </div>
      </div>
    </div>
  </main>

  @include('general.Links.scripts')
  </body>
</html>

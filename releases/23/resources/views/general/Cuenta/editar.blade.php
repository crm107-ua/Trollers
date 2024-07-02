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
          <h2 class="text-white mb-4" data-aos="fade-up">{{Auth::user()->name}}</h2>
          <h4 class="text-white mb-4" data-aos="fade-up">{{ trans('messages.e_d') }}</h4>
          <form action="{{ route('descripcion') }}" method="post">
            @csrf 
                <div class="form-group">
                    <textarea id="textArea" class="form-control" name="texto" style="background-color: white; color:black; border-radius: 10px; padding: 15px;" rows="15" maxlength="4000">{{Auth::user()->descripcion}}</textarea>
                </div>
                <div class="form-group" hidden>
                    <input name="id" value="{{Auth::user()->id}}">
                </div>
                <div class="form-group">
                    <input type="submit" style="border-radius: 10px; background-color: #FFC686;" value="{{ trans('messages.e_d2') }}" name="submit">
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

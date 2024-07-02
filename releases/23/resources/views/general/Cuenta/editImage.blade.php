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
          <h4 class="text-white mb-4" data-aos="fade-up">{{ trans('messages.e_pf') }}</h4>
          <p>{{ trans('messages.e_pf2') }}</p>
          <form action="{{ route('editar') }}" method="post" enctype="multipart/form-data">
            @csrf 
                <div class="form-group">
                    <label class="text-white mb-4" style="margin-right:20px;">{{ trans('messages.i') }}:</label>
                    <input type="file" name="fileToUpload" id="fileToUpload" required>
                </div>
                <div class="form-group" hidden>
                    <input name="id" value="{{Auth::user()->id}}">
                </div>
                <div class="form-group">
                    <input type="submit" style="border-radius: 10px; background-color: #FFC686;" value="{{ trans('messages.e_pf3') }}" name="submit">
                    <a href="cuenta" style="margin:10px;" class="btn btn-light">{{ trans('messages.volver') }}</a>
                </div>
          </form>
        </div>
      </div>
    </div>
  </main>

  @include('general.Links.scripts')
  </body>
</html>

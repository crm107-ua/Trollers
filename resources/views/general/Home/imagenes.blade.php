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
          <h2 class="text-white mb-4" data-aos="fade-up">{{ trans('messages.a_i') }}</h2>
          <h7 class="text-white mb-4" data-aos="fade-up">{{ trans('messages.a_i2') }}</h7><br><br>
          <form action="{{ route('imagen') }}" method="post" enctype="multipart/form-data">
            @csrf 
                <div class="form-group">
                    <label class="text-white mb-4" style="margin-right:20px;">{{ trans('messages.i') }}:</label>
                    <input type="file" name="fileToUpload" id="fileToUpload" required>
                </div>
                <div class="form-group mb-4">
                <div class="form-group">
                    <input type="submit" style="border-radius: 10px; background-color: #FFC686;" value="{{ trans('messages.a_i3') }}" name="submit">
                </div>
          </form>
        </div>
      </div>
    </div>
  </main>

  @include('general.Links.scripts')
  </body>
</html>

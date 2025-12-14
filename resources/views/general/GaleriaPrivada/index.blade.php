<!DOCTYPE html>
<html lang="en">
@include('general.Head.head')
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
    <main class="main-content">
      <div class="container-fluid photos">

        <div class="row pt-4 mb-5 text-center">
          <div class="col-12">
            <h2 class="text-white mb-4" id="header">{{ trans('messages.o') }}</h2>
          </div>
        </div>

        <div class="row align-items-stretch">

          @foreach($imagenes as $imagen)
          <div class="col-6 col-md-6 col-lg-6 " data-aos="fade-up">
            <a href="images/fotos/{{$imagen->name}}" class="d-block photo-item" data-fancybox="gallery">
              <img src="images/fotos/{{$imagen->name}}" alt="Image" class="img-fluid">
              <div class="photo-text-more">
                <span class="icon icon-expand"></span>
              </div>
            </a>
            @if($edit)
            <form action="{{ route('eliminar-privada') }}" method="post">
              @csrf
              <div class="form-group" hidden>
                <input name="id" value="{{$imagen->id}}">
              </div>
              <div class="form-group" hidden>
                <input name="name" value="{{$imagen->name}}">
              </div>
              <div class="form-group">
                <input type="submit" style="margin-bottom:15px;" onclick="return confirm('¿Seguro que quieres eliminar esta foto privada?')" class="btn btn-danger" value="{{ trans('messages.del') }}" name="submit">
              </div>
            </form>
            @endif
          </div>
          @endforeach

        </div>

        @include('general.Footer.footer')

      </div>
    </main>

    @include('general.Links.scripts')

</body>

</html>

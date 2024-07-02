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
        
        <div class="row pt-4 text-center">
          <div class="col-12">
            <h2 class="text-white mb-4" id="header">Perfil</h2>
          </div>
        </div>
        
      <div class="row align-items-stretch">
          <div class="col-9 col-md-9 col-lg-9" style="width:70%; margin:30px;" data-aos="fade-up">
            @if(count($usuario->images) > 0)
              <a href="{{$usuario->images[0]->url}}" class="d-block photo-item" data-fancybox="gallery">
              <img src="{{$usuario->images[0]->url}}" alt="Image" class="img-fluid">
            @endif
              <h3 class="text-white">Usuario: {{$usuario->display_name}}</h3>
              @if($usuario->product=='premium')
                <h3 style="color:green">Premium</h3>
              @else
                <h3  style="color:blue">No premium</h3>
              @endif
              <h3 class="text-white">Seguidores: {{$usuario->followers->total}}</h3>
            </a>
            @if(count($artistas) != 0)
            <h3 class="text-white"><a href="/spotify-biblioteca" style="color:#5FB9DA;">Ver vista de biblioteca</a></h3>
            @endif  
          </div>     
      </div>

    <div class="container-fluid photos">
        
      <div class="row pt-4 mb-5 text-center">
        <div class="col-12">
          <h2 class="text-white mb-4" id="header">Tus Artistas Favoritos</h2>
        </div>
      </div>
      
	  <div class="row align-items-stretch">

      @foreach($artistas as $artista)
        <div class="col-6 col-md-6 col-lg-6" data-aos="fade-up">
          <a href="{{$artista->images[0]->url}}" class="d-block photo-item" data-fancybox="gallery">
            <img src="{{$artista->images[0]->url}}" alt="Image" class="img-fluid">
            <h3 class="text-white mb-4" style="text-align:center">{{$artista->name}}</h3>
            <div class="photo-text-more">
              <span><h3 class="text-white mb-4">{{$artista->name}}</h3></span>
            </div>
          </a>
        </div>
      @endforeach    
        @if(count($artistas) == 0)
            <h2 style="width:70%; margin:30px; color:red">No existen artistas favoritos, debes de escuchar más música</h2>
        @endif  
      </div>

    </div>

    <div class="container-fluid photos">
        
      <div class="row pt-4 mb-5 text-center">
        <div class="col-12">
          <h2 class="text-white mb-4" id="header">Tus Canciones Favoritas</h2>
        </div>
      </div>
      
	  <div class="row align-items-stretch">

      @foreach($temas as $tema)
        <div class="col-6 col-md-6 col-lg-6" data-aos="fade-up">
          <a href="{{$tema->album->images[0]->url}}" class="d-block photo-item" data-fancybox="gallery">
            <img src="{{$tema->album->images[0]->url}}" alt="Image" class="img-fluid">
            <h3 class="text-white mb-4" style="text-align:center">{{$tema->name}}</h3>
            <div class="photo-text-more">
              <span><h3 class="text-white mb-4">{{$tema->name}}</h3></span>
            </div>
          </a>
        </div>
      @endforeach
        @if(count($temas) == 0)
            <h2 style="width:70%; margin:30px; color:red">No existen caniones favoritas, debes de escuchar más música</h2>
        @endif
      </div>

      @include('general.Footer.footer')

    </div>
  </main>

  @include('general.Links.scripts')
  </body>
</html>

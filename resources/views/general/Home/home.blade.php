<!DOCTYPE html>
<html lang="en">
@include('general.Head.head')
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7315335954466454" crossorigin="anonymous"></script>
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
            <h2 class="text-white mb-4" id="header">Bienvenid<span style="background: linear-gradient(45deg, #F6E58D, #FF7979, #FFD93D, #FFA8A1); background-size: 400%; animation: gradientAnimationHome 5s ease infinite; -webkit-background-clip: text; -webkit-text-fill-color: transparent;">@</span></h2>
            <?php /* <!-- @include('general.Home.countdown') --> */ ?> 
            @if($alerta->alternative)
              @include('general.Home.info.index')
            @endif
            @if($serverStatus)
                <div class="alert" style="position: relative; overflow: hidden; color: #fff; padding: 50px 20px; border-radius: 10px; min-height: 80px;">
                    <div style="background: url('https://drive.carlosrobles.es/apps/files_sharing/publicpreview/qNDsHcXZFZ85PCP?file=/&fileId=27142&x=3024&y=1964&a=true&etag=5e512e44cf2e69e98d9ffde46a7dc8e0') no-repeat center center; background-size: cover; height: 100%; width: 100%; position: absolute; top: 0; left: 0; z-index: 1;"></div>
                    <div style="background-color: rgba(0, 0, 0, 0.5); position: absolute; top: 0; left: 0; height: 100%; width: 100%; z-index: 2;"></div>
                    <div style="position: relative; z-index: 3;">
                        <strong>Servidor: <b style="color:greenyellow">minecraft.trollers.es</b></strong><br>
                        <strong>Estado del servidor:</strong><b style="color:greenyellow"> Online</b><br>
                        <strong>Jugadores conectados:</strong> {{ $serverStatus['players'] }} / {{ $serverStatus['maxPlayers'] }} <br>
                        <strong>Nombre:</strong> {{ $serverStatus['motd'] }} <br>
                        <strong>Versión:</strong> {{ $serverStatus['version'] }} <br>
                        <strong>Ping:</strong> <b style="color:greenyellow">{{ $serverStatus['ping'] }} ms</b><br>
                        <strong style="background: linear-gradient(45deg, #dfc647, #FF7979, #FFD93D, #ff857c); background-size: 400%; animation: gradientAnimationHome 5s ease infinite; -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-style: italic;">Disponible para PC y Móvil</strong>
                      </div>
                </div>
            @endif


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
            <form action="{{ route('eliminar') }}" method="post">
              @csrf
              <div class="form-group" hidden>
                <input name="id" value="{{$imagen->id}}">
              </div>
              <div class="form-group" hidden>
                <input name="name" value="{{$imagen->name}}">
              </div>
              <div class="form-group">
                <input type="submit" style="margin-bottom:15px;" onclick="return confirm('¿Seguro que quieres eliminar esta foto?')" class="btn btn-danger" value="{{ trans('messages.del') }}" name="submit">
              </div>
            </form>
            @endif
          </div>
          @endforeach

          <iframe src="https://open.spotify.com/embed/playlist/2KVu7MJkFM5uZ0oaAlOB3V" style="margin:15px;" width="100%" height="500px" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>
          <iframe src="https://discordapp.com/widget?id=538027285580873728&theme=dark" style="margin:15px;" width="100%" height="500px" allowtransparency="true" frameborder="0"></iframe>

        </div>

        @include('general.Footer.footer')

      </div>
    </main>

    @include('general.Links.scripts')

</body>

</html>

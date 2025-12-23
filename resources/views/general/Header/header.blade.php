<header class="header-bar d-flex d-lg-block align-items-center">
  <div class="site-logo">
    <?php $cumple = \App\Models\Calendar::where("fecha",date("Y-m-d"))->where("tipo",1)->get();?> 
    @if($cumple->count() > 0)
    @include('general.Header.rainbow')
    <h2 class="rainbow_text animated">¡Felicidades {{$cumple[0]->titulo}}!</h2>
    @else
    <a href="/">The Trollers</a>
    @endif
  </div>

  <div class="d-inline-block d-xl-none ml-md-0 ml-auto py-3" style="position: relative; top: 3px;"><a href="#" class="site-menu-toggle js-menu-toggle text-white"><span class="icon-menu h3"></span></a></div>
  <div class="main-menu">
    <ul class="js-clone-nav">
      <li><a href="/">{{trans('messages.home')}}</a></li>
      <li><a href="/test">Test</a></li>
      <li><a href="/enigma">Enigma</a></li>
      <li><a href="/timeline">Timeline</a></li>
      <li><a href="/minijuego">Minijuego</a></li>
      <li><a href="/proyectos">{{trans('messages.pr')}}</a></li>
      <li><a href="/formacion">{{trans('messages.for')}}</a></li>
      <li><a href="/calendario">{{trans('messages.calendar')}}</a></li>
      <li><a href="https://tv.trollers.es" target="_blank">Trollers TV</a></li>
      <li><a href="/spotify">Spotify Wrapped</a></li>
      <li><a href="/boe">BOE</a></li>
      <li><a href="/mw3">MW3</a></li>
      <li><a href="https://www.instagram.com/trollers.es/"><span class="icon-instagram"></span></a></li>
      @if(Auth::check())
      <?php $notificaciones = \App\Models\Notificacion::get()->where("id_destino",Auth::user()->id)->where("leido",false)->count();?> 
      <li><a href="/cuenta">{{Auth::user()->name}}</a></li>
      @if($notificaciones > 0)
        <li><a style="color:#FF6666;" href="/notificaciones">{{trans('messages.not')}} ({{$notificaciones}})</a></li>
      @else
        <li><a href="/notificaciones">{{trans('messages.not')}} ({{$notificaciones}})</a></li>
      @endif
      <li><a href="/netflix">Netflix</a></li>
      <li><a href="/protocolos">{{trans('messages.pro')}}</a></li>
      @if(Auth::user()->rol==1)
      <li><a href="/manager">Manager Pro</a></li>
      <li><a href="/crear-evento">{{trans('messages.addev')}}</a></li>
      <li><a href="/imagen">{{trans('messages.addimg')}}</a></li>
      <li><a href="/eliminar">{{trans('messages.delimg')}}</a></li>
      <li><a href="/crear-boe">{{trans('messages.adda')}}</a></li>
      <li><a href="/proyecto">{{trans('messages.addpr')}}</a></li>
      <li><a href="/crear-protocolo">{{trans('messages.addpro')}}</a></li>
      <li>
        <a href="#" onclick="event.preventDefault(); document.getElementById('delete-all-stories-form').submit();" style="color: #ff4444;">
          Eliminar Stories
        </a>
      </li>
      <form id="delete-all-stories-form" action="{{ route('stories.deleteAll') }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
      </form>
      @endif
      <li><a href="/pagos">{{trans('messages.pay')}}</a></li>
      @endif
      @if(!Auth::check())
      <br><br><br><br>
      @include('general.Login.login')
      @else
      <li href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <span style="color:white; cursor: pointer;">{{ trans('messages.cs') }}</span>
      </li>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
      </form>
      @endif
    </ul>
  </div>
</header>

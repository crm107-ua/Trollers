@include('general.Header.rainbow')

<div class="row justify-content-center">
    <div class="col-md-12 text-center py-5">
        <p><a href="https://www.instagram.com/trollers.es/">Trollers</a> &copy; 2013 - {{now()->year}}</p>
        <!-- <p class="rainbow_text animated">- Hasta que la poli nos separe -</p> -->
        <!-- Idiomas -->
          
        <a href="{{ route('change_lang', ['lang' => 'es']) }}" class="bandera"><img src="https://cdn-icons-png.flaticon.com/512/555/555635.png" alt="Smiley face" height="32" width="32"></a>
        <a href="{{ route('change_lang', ['lang' => 'en']) }}" ><img src="https://cdn-icons-png.flaticon.com/512/555/555417.png" alt="Smiley face" height="32" width="32"></a>
        <br><br>

        <!-- Idiomas End -->
        @if(Auth::check())
        <p><a href="cuenta" style="color:white">{{Auth::user()->name}}</a></p>
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <span style="color:white">{{ trans('messages.cs') }}</span>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        @endif
    </div>
    </div>
</div>
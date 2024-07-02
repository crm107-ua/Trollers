
@include('general.Cuenta.spotify.estilos')

<div class="boxes">
@foreach($artistas as $key => $artista)
  <div class="box" style="--src: url({{$artista->images[0]->url}})"><span>{{ $key+1 }}</span><img src="{{$artista->images[0]->url}}"/></div>
@endforeach 
  <div class="controls">
    <button class="next"><span>Siguiente artista</span>
      <svg viewBox="0 0 448 512" width="100" title="Previous Album">
        <path d="M424.4 214.7L72.4 6.6C43.8-10.3 0 6.1 0 47.9V464c0 37.5 40.7 60.1 72.4 41.3l352-208c31.4-18.5 31.5-64.1 0-82.6z"></path>
      </svg>
    </button>
    <button class="prev"><span>Artista previo</span>
      <svg viewBox="0 0 448 512" width="100" title="Next Album">
        <path d="M424.4 214.7L72.4 6.6C43.8-10.3 0 6.1 0 47.9V464c0 37.5 40.7 60.1 72.4 41.3l352-208c31.4-18.5 31.5-64.1 0-82.6z"></path>
      </svg>
    </button>
  </div>
</div>
<svg class="scroll-icon" viewBox="0 0 24 24">
  <path fill="currentColor" d="M20 6H23L19 2L15 6H18V18H15L19 22L23 18H20V6M9 3.09C11.83 3.57 14 6.04 14 9H9V3.09M14 11V15C14 18.3 11.3 21 8 21S2 18.3 2 15V11H14M7 9H2C2 6.04 4.17 3.57 7 3.09V9Z"></path>
</svg>
<div class="drag-proxy"></div>

@include('general.Cuenta.spotify.scripts')






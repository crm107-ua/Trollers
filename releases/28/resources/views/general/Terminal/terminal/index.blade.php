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

  @include('general.Terminal.terminal.estilos')
  @include('general.Header.header')

  <main class="main-content"> 
        <div id="terminal-window">
        <span id="cursor"></span>
        <p>
            <span>ACCEDIENDO A SERVICIOS DE INTELIGENCIA</span>
        </p>
        <p>
            <span>SERVICIO DE INFRAESTRUCTURAS DIGITALES &copy; 2013 - {{now()->year}}</span>
        </p>
        <p>
            <span>AUTENTICANDO DESDE EL {{strtoupper(Auth::user()->cargo)}}</span>
        </p>
        <p>
            <span>UBICACIÓN: {{strtoupper($ciudad)}}</span>
        </p>
        <!-- <p>
            <span class="animate"></span><span class="animate">***********</span>
            <br>
            <span class="animate"></span><span class="animate">COMPROBANDO CONEXIÓN</span>
        </p>
        <p>
            <span class="animate"></span><span class="animate">***********</span>
            <br>
            <span class="animate"></span><span class="animate">BIENVENIDO {{strtoupper(Auth::user()->name)}}</span>
        </p> -->
        <p>
            <span class="animate">> </span><span autofocus contenteditable="true" id="inputcmd"></span>
        </p>
        <p><span id="output"></span></p>
        </div>
        <div class="scanlines"></div> 
  </main>

  @include('general.Links.scripts')
  @include('general.Terminal.terminal.scripts')

  </body>
</html>


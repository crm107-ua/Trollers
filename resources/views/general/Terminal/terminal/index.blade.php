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
        <p>
            <span>ACCEDIENDO A SERVICIOS DE INTELIGENCIA</span>
        </p>
        <p>
            <span>SERVICIO DE INFRAESTRUCTURAS DIGITALES &copy; 2013 - {{ now()->year }}</span>
        </p>
        <p>
            <span>TROLLERS GPT (1.0 BETA)</span>
        </p>
        <p>
            <span class="animate"> > </span><span autofocus contenteditable="true" id="inputcmd"></span>
        </p>
        <p><span id="output" >{!! $output ?? '' !!}</span></p>
    </div>
    <div class="scanlines"></div> 
  </main>

  @include('general.Links.scripts')
  @include('general.Terminal.terminal.scripts')

  </body>
</html>


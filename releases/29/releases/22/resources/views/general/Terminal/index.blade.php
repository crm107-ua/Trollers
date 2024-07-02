
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
@include('general.Terminal.scripts')


<!DOCTYPE html>
<html lang="en">
@include('general.Head.head')
  <link rel="stylesheet" href="https://minecraft--duck132912.repl.co/minecraft.css" />
	<link rel="shortcut icon" href="https://minecraft--duck132912.repl.co/icon.png" type="image/x-icon" />
	<link rel="icon" href="https://minecraft--duck132912.repl.co/icon.png" type="image/x-icon" />
  <script src="https://minecraft--duck132912.repl.co/script.js">	</script>
	<link rel="stylesheet" type="text/css" href="https://minecraft--duck132912.repl.co/style.css"> 

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

  @include('general.Terminal.estilos')
  @include('general.Header.header')

  <main class="main-content">  
  <div>
  <img  alt="Minecraft" id="logo" src="https://minecraft--duck132912.repl.co/minecraft.svg"/>
  </div><br>

<div id="flashingtext">Trollers Edition</div>
<main>
<div class="row justify-content-center">
<button class="button" onclick="play()">Un Jugador</button>
<br>
<button class="button" onclick="playmulti()" id="playmulti">Multijugador</button> <br>
<button class="button" onclick="alert(intro.descripcion)">Servidor</button>
<button class="button" onclick="how()">Como jugar</button>
<audio id="audio">
  <source src="minecraft.mp4">
</audio>
<div class="row justify-content-center">
    <div class="text-center py-5">
        <p class="button" onclick="alert('Delegación oficial del Ministerio de la Guerra')">Servicio de &nbsp;Infraestructuras&nbsp; Digitales</p>
    </div>
  </main>
</div>


  @include('general.Links.scripts')
  <script src="https://minecraft--duck132912.repl.co/minecraft.js"></script>
    <script type='text/javascript'>
    <?php
    $js_array = json_encode($page);
    echo "var intro = ". $page[0]. ";\n";
    ?>
    </script>

  </body>
</html>


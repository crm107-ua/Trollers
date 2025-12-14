<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
<div class="alert" style="
  position: relative;
  overflow: hidden;
  color: #fff;
  padding: 50px 20px;
  border-radius: 12px;
  min-height: 80px;
  margin-top: 30px;
  border: 2px solid #00ffc3;
  box-shadow: 0 0 25px #00ffc3cc, 0 0 5px #00ffc3aa;
  font-family: 'Segoe UI', sans-serif;
  backdrop-filter: blur(5px);
">
  <div style="background: url('https://www.trollers.es/images/fotos/mine25_3.png') no-repeat center center; background-size: cover; height: 100%; width: 100%; position: absolute; top: 0; left: 0; z-index: 1;"></div>
  <div style="background-color: rgba(0, 0, 0, 0.3); position: absolute; top: 0; left: 0; height: 100%; width: 100%; z-index: 2;"></div>
  
  <div style="position: relative; z-index: 3;">
    <strong>Servidor: <b style="color:greenyellow">minecraft.trollers.es</b></strong><br>
    <strong>Jugadores conectados:</strong> {{ $serverStatus['players'] }} / {{ $serverStatus['maxPlayers'] }} <br>      
    <strong>Puerto: <b style="color:greenyellow">25593</b></strong> <br>
    <strong>Versión:</strong> {{ $serverStatus['version'] }} <br>
    <strong>Ping:</strong> <b style="color:greenyellow">{{ $serverStatus['ping'] }} ms</b><br>

<!--  
    <strong>
      <a style="
        background: linear-gradient(45deg, #68b6ea, #44c2f8);
        background-size: 400%;
        animation: gradientAnimationHome 5s ease infinite;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        display: inline-flex;
        align-items: center;
      " href="https://mapa.trollers.es" target="_blank">
        Acceso al mapa online 
        <span class="material-symbols-outlined">login</span>
      </a>
    </strong>  
-->

  </div>
</div>

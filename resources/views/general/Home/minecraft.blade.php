<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" /><div class="alert" style="position: relative; overflow: hidden; color: #fff; padding: 50px 20px; border-radius: 10px; min-height: 80px;">
    <div style="background: url('https://drive.carlosrobles.es/apps/files_sharing/publicpreview/qNDsHcXZFZ85PCP?file=/&fileId=27142&x=3024&y=1964&a=true&etag=5e512e44cf2e69e98d9ffde46a7dc8e0') no-repeat center center; background-size: cover; height: 100%; width: 100%; position: absolute; top: 0; left: 0; z-index: 1;"></div>
    <div style="background-color: rgba(0, 0, 0, 0.5); position: absolute; top: 0; left: 0; height: 100%; width: 100%; z-index: 2;"></div>
    <div style="position: relative; z-index: 3;">
        <strong>Servidor: <b style="color:greenyellow">minecraft.trollers.es</b></strong><br>
        <strong>Estado del servidor:</strong><b style="color:greenyellow"> Online</b><br>
        <strong>Jugadores conectados:</strong> {{ $serverStatus['players'] }} / {{ $serverStatus['maxPlayers'] }} <br>      
        <strong>Versión:</strong> {{ $serverStatus['version'] }} <br>
        <strong>Ping:</strong> <b style="color:greenyellow">{{ $serverStatus['ping'] }} ms</b><br>
        <strong>
            <a style="background: linear-gradient(45deg, #68b6ea, #68b6ea, #68b6ea, #44c2f8); background-size: 400%; animation: gradientAnimationHome 5s ease infinite; -webkit-background-clip: text; -webkit-text-fill-color: transparent; display: inline-flex; align-items: center;" href="https://mapa.trollers.es">
              Acceso al mapa online 
              <span class="material-symbols-outlined">
                login
              </span>
            </a>
          </strong><br>  
        <strong style="background: linear-gradient(45deg, #dfc647, #FF7979, #FFD93D, #ff857c); background-size: 400%; animation: gradientAnimationHome 5s ease infinite; -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-style: italic;">Disponible para PC y Móvil</strong>
      </div>
</div>
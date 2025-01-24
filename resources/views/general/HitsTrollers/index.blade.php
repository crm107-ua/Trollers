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

  <style>
   @keyframes gradientBackground {
        0% {
            background-position: 0% 50%;
        }
        50% {
            background-position: 100% 50%;
        }
        100% {
            background-position: 0% 50%;
        }
    }

    .main-content {
        padding: 30px;
        background: linear-gradient(270deg, #ff7e5f, #feb47b, #ff7e5f, #ff6f61, #ff9a8b, #ff6f61, #ff7e5f, #feb47b, #ff7e5f);
        background-size: 800% 800%;
        animation: gradientBackground 10s ease infinite;
    }
</style>

      <main class="main-content" style="padding: 30px;">  

        <h1 style="text-align: center; color:white;" class="mb-5">Hits Trollers</h1>

        <!-- VIDEO (cámara) -->
        <video
          id="camera"
          autoplay
          playsinline
          style="width: 100%;"
        ></video>

        <!-- CANVAS (oculto, para escanear cada frame y leer el QR) -->
        <canvas id="canvas" style="display: none; position:absolute; z-index:-10;"></canvas>

        <!-- DIV donde se inyecta el reproductor de Spotify (iFrame) -->
        <div id="embed-iframe" style="margin-top:20px;position:absolute important!; z-index:-10; important!"></div>

        <div id="embed-cover" style="position: absolute; z-index:10; background: linear-gradient(270deg, #ff7e5f, #feb47b, #ff7e5f); padding: 10px; top:48%; right: 1%; width: 100%; height: 70%">

        </div>

        <!-- BOTÓN para reproducir o pausar la canción en curso -->
        <button id="playPauseBtn" style="
            padding: 10px 20px; 
            margin-top: 20px; 
            cursor: pointer; 
            font-size: 16px;
            position: absolute;
            top: 60%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 11;
            background-color: #1DB954;
            border-radius: 10px;
            color: white;
            font-weight: bolder;">
          Reproducir / Pausar
        </button>
      </main>
    </div>

    @include('general.Links.scripts')

    <!-- Librería jsQR -->
    <script src="https://cdn.jsdelivr.net/npm/jsqr@1.4.0/dist/jsQR.min.js"></script>

    <!-- Spotify iFrame API -->
    <script src="https://open.spotify.com/embed-podcast/iframe-api/v1" async></script>

    <script>
      /*******************************************************
       * 1) CONFIGURAR EL iFrame API DE SPOTIFY
       *******************************************************/
      let embedController = null;

      // Se llama automáticamente cuando la API iFrame está lista
      window.onSpotifyIframeApiReady = (IFrameAPI) => {
        const element = document.getElementById('embed-iframe');
        const options = {
          uri: 'spotify:track:1jJci4qxiYcOHhQR247rEU', // Pista inicial
          width: 300,
          height: 380
        };

        IFrameAPI.createController(element, options, (controller) => {
          embedController = controller;
          
          // Listeners opcionales
          embedController.addListener('ready', () => {
            console.log('El reproductor iFrame está listo');
          });
          
          embedController.addListener('playback_update', (e) => {
            console.log('Estado de reproducción:', e.data);
            // e.data => { isPaused, isBuffering, duration, position }
            // Podrías actualizar el texto del botón según isPaused
          });
        });
      };

      /*******************************************************
       * 2) LÓGICA DE ESCANEO DE QR (jsQR)
       *******************************************************/
      const video = document.getElementById("camera");
      const canvas = document.getElementById("canvas");
      const context = canvas.getContext("2d");

      // Variable para almacenar el último track URI reproducido y evitar repeticiones
      let lastDetectedUri = null;

      // Iniciar la cámara
      async function startCamera() {
        try {
          const stream = await navigator.mediaDevices.getUserMedia({
            video: { facingMode: "environment" },
          });
          video.srcObject = stream;
        } catch (err) {
          console.error("Error al acceder a la cámara:", err);
        }
      }

      // Escaneo continuo
      function scanQRCode() {
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;

        context.drawImage(video, 0, 0, canvas.width, canvas.height);
        const imageData = context.getImageData(0, 0, canvas.width, canvas.height);
        const code = jsQR(imageData.data, canvas.width, canvas.height);

        if (code) {
          // Ejemplo de code.data: "https://open.spotify.com/track/1jJci4qxiYcOHhQR247rEU?autoplay=true"
          if (code.data.toLowerCase().includes("spotify.com/track/")) {
            const trackId = code.data.split("/")[4]?.split("?")[0]; 
            if (trackId) {
              const uri = "spotify:track:" + trackId;
              if (uri !== lastDetectedUri) {
                lastDetectedUri = uri;
                console.log("QR de Spotify detectado, cargando:", uri);
                
                if (embedController) {
                  embedController.loadUri(uri);
                  // Intentamos reproducir (el navegador puede bloquearlo si no hay interacción previa)
                  embedController.play();
                  playPauseBtn.style.color = "red";
                  playPauseBtn.style.backgroundColor = "white";
                  setTimeout(function() {
                      playPauseBtn.style.color = ""; // Restablece el color original
                  }, 2000); 
                } else {
                  console.warn("EmbedController no está listo");
                }
              }
            }
          }
        }
        
        requestAnimationFrame(scanQRCode);
      }

      // Cuando el video comience, inicia el bucle de escaneo
      video.addEventListener("play", () => {
        scanQRCode();
      });

      // Al cargar la página, arranca la cámara
      startCamera();

      /*******************************************************
       * 3) Botón para reproducir/pausar
       *******************************************************/
      const playPauseBtn = document.getElementById("playPauseBtn");
      playPauseBtn.addEventListener("click", () => {
        if (embedController) {
          // togglePlay() alterna entre play() y pause() según el estado actual
          embedController.togglePlay();
        } else {
          console.warn("EmbedController no está listo aún");
        }
      });
    </script>
  </body>
</html>

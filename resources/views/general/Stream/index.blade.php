<!DOCTYPE html>
<html lang="en">
@include('general.Head.head')
@include('general.Minijuego.assets.styles')
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

    <main class="main-content">
        <div class="game-container">
            <div class="container-fluid photos">
                <div class="row justify-content-center">
                    <div class="col-md-10 pt-7">
                        <div class="row pt-4 mb-3 text-center">
                            <div class="col-12">
                                <h2 class="text-white mb-4" id="header">Trollers TV</h2>
                            </div>
                        </div>

                        <!-- Mostrar el botón de iniciar stream si no está activo -->
                        @if(!$is_active)
                            <div class="row justify-content-center">
                                <div class="col-md-12 text-center">
                                    <form method="POST" action="{{ route('start-tv') }}">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">Iniciar Stream</button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <div class="row justify-content-center">
                                <div class="col-md-12 text-center">
                                    <form method="POST" action="{{ route('end-tv') }}" class="mb-5">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">Parar Stream</button>
                                    </form>
                                </div>
                            </div>

                            <!-- Video para mostrar el stream en directo -->
                            <div class="row justify-content-center">
                                <div class="col-md-12 text-center">
                                  <video id="live-video" autoplay playsinline style="width: 100%; height: auto; max-width: 100vw; background-color: black;"></video>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        @include('general.Links.scripts')
        @include('general.Footer.footer')

        <!-- Script para manejar la captura de video con WebRTC y WebSockets -->
        <script>
            const videoElement = document.getElementById('live-video');
            
            @if($is_active)
            // El stream ya está activo, capturamos el video con WebRTC
            navigator.mediaDevices.getUserMedia({ video: true, audio: true })
                .then((stream) => {
                    videoElement.srcObject = stream;

                    // Establecer la conexión WebSocket con el servidor usando el dominio
                    const ws = new WebSocket('wss://www.trollers.es/websocket'); // Cambiar a tu dominio

                    ws.onopen = () => {
                        const mediaRecorder = new MediaRecorder(stream, {
                            mimeType: 'video/webm; codecs=vp9'
                        });

                        // Enviar el video grabado en partes a través del WebSocket
                        mediaRecorder.ondataavailable = (event) => {
                            if (event.data.size > 0) {
                                ws.send(event.data);
                            }
                        };

                        mediaRecorder.start(1000); // Enviar datos cada segundo
                    };

                    ws.onerror = (error) => {
                        console.error('WebSocket error:', error);
                    };
                })
                .catch((error) => {
                    console.error('Error accediendo a la cámara:', error);
                });
            @endif
        </script>
    </main>
</div>
</body>
</html>

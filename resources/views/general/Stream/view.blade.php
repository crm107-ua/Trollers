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
                                <h2 class="text-white mb-4" id="header">Transmisión en Vivo - Trollers TV</h2>
                            </div>
                        </div>

                        <!-- Video para mostrar el stream en directo -->
                        <div class="row justify-content-center">
                            <div class="col-md-12 text-center">
                                <video id="live-stream" autoplay playsinline style="width: 100%; height: auto; max-width: 100vw; background-color: black;"></video>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('general.Links.scripts')
        @include('general.Footer.footer')

        <!-- Script para manejar la conexión WebSocket y recibir el stream -->
        <script>
            const videoElement = document.getElementById('live-stream');

            // Establecer la conexión WebSocket con el servidor
            const ws = new WebSocket('wss://www.trollers.es/websocket'); // Cambiar a tu dominio

            ws.onmessage = (event) => {
                const arrayBuffer = event.data;

                // Crear un Blob a partir de los datos recibidos
                const blob = new Blob([arrayBuffer], { type: 'video/webm' });

                // Crear un objeto URL y asignarlo al video
                const url = URL.createObjectURL(blob);
                videoElement.src = url;
            };

            ws.onerror = (error) => {
                console.error('WebSocket error:', error);
            };
        </script>
    </main>
</div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
@include('general.Head.head')
@include('general.Minijuego.assets.styles')

<!-- Incluir el CSS de Video.js -->
<link href="https://vjs.zencdn.net/7.20.3/video-js.css" rel="stylesheet" />

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

                            <!-- Video para mostrar el stream en directo con Video.js -->
                            <div class="row justify-content-center">
                                <div class="col-md-12 text-center">
                                    <video id="live-stream" class="video-js vjs-default-skin" controls autoplay playsinline preload="auto" width="640" height="360">
                                        <source src="https://stream.trollers.es/hls/stream.m3u8" type="application/x-mpegURL">
                                        Tu navegador no soporta el elemento de video.
                                    </video>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Incluir el JS de Video.js -->
            <script src="https://vjs.zencdn.net/7.20.3/video.min.js"></script>

            @include('general.Links.scripts')
            @include('general.Footer.footer')
        </main>
    </div>
</body>
</html>

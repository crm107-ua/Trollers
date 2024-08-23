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
        <div class="col-md-6 pt-4">
        <div class="row pt-4 mb-3 text-center">
          <div class="col-12">
            <h2 class="text-white mb-4" id="header">¿Quién dice qué?</h2>
          </div>
        </div>
        <div style="display: flex; justify-content: space-between; align-items: center;">
          <div id="cita"></div>
          <span id="puntos" style="margin-bottom: 15px; color: white;"></span>
        </div>
        <div class="options">
            <div class="option" onclick="checkAnswer(1)">
                <img src="default.jpg">
                <div></div>
            </div>
            <div class="option" onclick="checkAnswer(2)">
                <img src="default.jpg">
                <div></div>
            </div>
            <div class="option" onclick="checkAnswer(3)">
                <img src="default.jpg">
                <div></div>
            </div>
            <div class="option" onclick="checkAnswer(4)">
                <img src="default.jpg">
                <div></div>
            </div>
        </div>
        <div class="cercle" onclick="checkAnswer(5)">
          <div class="rainbow-background">
            <span class="circle-text">Grupal</span>
          </div>
        </div>
    </div>
    </div>
  </div>
  <script type='text/javascript'>
    <?php
    $citas_array = json_encode($citas);
    $users_array = json_encode($users);
    echo "var citas = ". $citas_array . ";\n";
    echo "var users = ". $users_array . ";\n";
    ?>
  </script>
  
    @include('general.Links.scripts')
    @include('general.Minijuego.assets.scripts')
    @include('general.Footer.footer')
  </main>

  </body>
</html>

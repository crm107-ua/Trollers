<!DOCTYPE html>
<html lang="en">
@include('general.Head.head')
<link rel="stylesheet" href="../css/enigma.css">
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
    <div class="container-fluid photos">
      <div class="row justify-content-center">
        <div class="col-md-6 pt-4">
        <div class="row pt-4 mb-3 text-center">
          <div class="col-12">
            <h2 class="text-white mb-4" id="header">Enigma</h2>
          </div>
        </div>
        <form action="{{ route('codificar') }}" method="post">
          <div class="contador">@include('general.Enigma.contador')</div>
          <h4 class="text-white mb-4" data-aos="fade-up">Codificación</h4>
            @csrf 
                <div class="form-group">
                    <textarea class="form-control" name="code" style="background-color: white; color:black; border-radius: 10px; padding: 15px;" rows="5" maxlength="9000" required >{{ $resultado ?? ''}}</textarea>
                </div>
                <div class="form-group">
                    <input type="submit" style="border-radius: 10px; background-color: #FFC686;" value="Procesar" name="submit">
                    <a style="margin-left:20px; border-radius: 10px; background-color: black; color:#72FA96;"  href="whatsapp://send?text={{ $resultado ?? ''}}">WhatsApp</a>
                </div>
          </form><br>
          <a class="row justify-content-center" href="./archivos/escudos/CTI.png"><img src="./archivos/escudos/CTI.png" style="margin-bottom:20px;" alt="Image" width="130px" height="130px"></a>
        </div>

      </div>
      @include('general.Footer.footer')
    </div>
  </main>

  @include('general.Links.scripts')
  </body>
  <script src="../js/enigma.js"></script>
</html>

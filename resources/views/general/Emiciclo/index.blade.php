<!DOCTYPE html>
<html lang="en">
@include('general.Head.head')
@include('general.Emiciclo.estilos')
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
            <div id="container" style="background-color:black;"></div>
            <div id="tribuna" style="height: 600px; max-width: 700px; margin: auto;"></div>

          </div>
        </div>
        </div>    
      </div>
      @include('general.Footer.footer')
    </div>
  </main>

  @include('general.Links.scripts')
  </body>
  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/modules/item-series.js"></script>
  @include('general.Emiciclo.scripts')
</html>


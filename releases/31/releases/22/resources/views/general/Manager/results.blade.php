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
            <h2 class="text-white mb-4" id="header">Manager Pro</h2>
          </div>
        </div>
        @foreach($tablaResultados as $miembro => $pago)
            <label style="width:40%; float:left; margin: 5%; text-align:center;" placeholder="Miembro" class="form-control input-md">{{ $miembro }}</label>
            <label style="width:40%; float:left; margin: 5%; text-align:center;" placeholder="Pago" class="form-control input-md">{{ round($pago,2) }} gramos</label>
        @endforeach
          <br>
          <div id="chartContainer" style="margin-bottom: 400px" class="row"></div>
        </div>
      </div>
      <a class="row justify-content-center" href="./archivos/escudos/MI.png"><img src="./archivos/escudos/MI.png" style="margin-top:40px; margin-bottom:20px;" alt="Image" width="130px" height="130px"></a>

      @include('general.Footer.footer')
    </div>
  </main>

  @include('general.Links.scripts')
  <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
  </body>
</html>

<script type='text/javascript'>
<?php
$js_array = json_encode($grafica);
echo "var datos = ". $js_array . ";\n";
?>
</script>


<script type='text/javascript'>

  window.onload = function() {

  var chart = new CanvasJS.Chart("chartContainer", {
    animationEnabled: true,
    backgroundColor: "transparent",
    data: [{
      type: "pie",
      startAngle: 240,
      indexLabelFontColor: "white",
      yValueFormatString: "##0.00\"%\"",
      dataPoints: []
    }]
  });
  chart.render();

  for (var dato in datos) {
    chart.data[0].addTo("dataPoints", {y: datos[dato], label: dato})
  }

  }

</script>

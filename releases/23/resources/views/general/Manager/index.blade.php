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
        <form action="{{ route('manager-generate') }}" method="post" enctype="multipart/form-data">
            @csrf 
            <fieldset>
            <div id="items" class="form-group">
            <div class="col-md-12 margin-bottom">
            <input id="textinput" name="cantidad" type="number" style="width:70%;margin: 5%;" placeholder="Cantidad adquirida en gramos" class="form-control input-md" step="0.01" required>
            <input id="textinput" name="miembros[]" type="text" style="width:40%; float:left; margin: 5%;" placeholder="Miembro" class="form-control input-md" required>
            <input id="textinput" name="aportaciones[]" type="number" style="width:40%; float:left; margin: 5%;" placeholder="Aportacion €" class="form-control input-md" step="0.01" required>
            </div>
            </div>
            </fieldset>
            <button id="add" style="margin: 7%;" class="btn add-more button-yellow uppercase" type="button">+ Añadir participante</button> <button class="delete btn button-white uppercase" style="margin: 7%;">- Eliminar participante</button>
            <input type="submit" style="margin-left: 7%;" class="btn add-more button-yellow uppercase" value="Procesar" name="submit">

        </form>
          <br><br>
          <a class="row justify-content-center" href="./archivos/escudos/MI.png"><img src="./archivos/escudos/MI.png" style="margin-bottom:20px;" alt="Image" width="130px" height="130px"></a>
        </div>

      </div>
      @include('general.Footer.footer')
    </div>
  </main>

  @include('general.Links.scripts')

  </body>
</html>


<script>
$(document).ready(function() {
  $(".delete").hide();
  //when the Add Field button is clicked
  $("#add").click(function(e) {
    $(".delete").fadeIn("1500");
    //Append a new row of code to the "#items" div
    $("#items").append(
      '<div class="next-referral col-md-12 margin-bottom"><input id="textinput" name="miembros[]" type="text" style="width:40%; float:left; margin: 5%;" placeholder="Miembro" class="form-control input-md" required><input id="textinput" name="aportaciones[]" type="number" style="width:40%; float:left; margin: 5%;" placeholder="Aportacion €" class="form-control input-md" step="0.01" required></div>'
    );
  });
  $("body").on("click", ".delete", function(e) {
    $(".next-referral").last().remove();
  });
});

</script>
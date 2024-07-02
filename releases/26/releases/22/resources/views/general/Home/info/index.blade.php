@include('general.Home.info.estilos')
<div class="table center">
  <div class="monitor-wrapper center">
    <div class="monitor center">
      @if($alerta->nivel==3)
      <a style="color: red;"><?php echo $alerta->texto ?></a>
      @elseif($alerta->nivel==2)
      <a style="color: #AD45FF"><?php echo $alerta->texto ?></a>
      @elseif($alerta->nivel==1)
      <a style="color: #454DFF"><?php echo $alerta->texto ?></a>
      @endif
    </div>
  </div>
</div>



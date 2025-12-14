
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

  @include('general.usuarios.estilos')
  @include('general.Header.header')


  <main class="main-content">

  <h2>Tabla de pagos</h2>
  <div class="table-wrapper">
    <table class="fl-table">
        <thead>
        <tr>
            <th>Nombre</th>
            <th>Estado</th>
            <th>Fecha</th>
            @if(Auth::user()->id==1)
            <th>Acciones</th>
            @endif
        </tr>
        </thead>
        <tbody>
        @foreach($usuarios as $usuario)
        <tr>
            <td style="color:black;"><b>{{$usuario->name}}</b></td>
            @if($usuario->pago==1)
                    <td style="color:green"><b>Pagado</b></td>
                    @else
                    <td style="color:red"><b>No Pagado</b></td>
                @endif   
            <td>
                @if($usuario->fecha_pago)
                <b>{{$usuario->fecha_pago}}</b>
                @else 
                -
                @endif
            </td>
            @if(Auth::user()->id==1)
            <td>
              <form action="{{ route('pagar') }}" method="post">
                  @csrf 
                  <div class="form-group" hidden>
                      <input name="id" value="{{$usuario->id}}">
                  </div>
                  <div class="form-group">
                  @if(Auth::user()->id==1 && $usuario->pago==0)
                      <input type="submit" style="border-radius: 10px; background-color: #83DFA4;" value="{{ trans('messages.2p') }}" name="submit"></div>
                  @endif
              </form>
              <form action="{{ route('renovar') }}" method="post">
                  @csrf 
                  <div class="form-group" hidden>
                      <input name="id" value="{{$usuario->id}}">
                  </div>
                  <div class="form-group">
                  @if(Auth::user()->id==1 && $usuario->pago==1)
                      <input type="submit" style="border-radius: 10px; background-color: #83D3DF;" value="{{ trans('messages.re') }}" name="submit"></div>
                  @endif
              </form>
            </td>
            @endif
        </tr>
        @endforeach
        <tbody>
    </table>
    <p style="color:white; margin-top:40px; text-align:center;"><a style="color:white;" href="/archivos/documentacion/facturas.png">Ver ficha de facturaciones del año 2021</a></p>
    @include('general.Footer.footer')
    </main>
  </body>
  @include('general.Links.scripts')
</html>

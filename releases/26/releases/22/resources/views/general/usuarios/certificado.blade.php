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

  @include('general.Header.header')

@if(Auth::user()->covid==0)
<style>
body {
  background: #dd3f3e;
  font-family: 'Montserrat', sans-serif ,!important;
  margin: 0;
  padding: 0;
}
.ticket {
  justify-content: center;
  align-items: center;
  width: 100%;
  margin: 20px auto;
}
.ticket .stub,
.ticket .check {
  box-sizing: border-box;
}
.stub {
  background: #ef5658;
  height: 250px;
  width: 100%;
  color: white;
  padding: 20px;
  position: relative;
}
.stub:before {
  content: '';
  position: absolute;
  top: 0;
  right: 0;
  border-left: 20px solid #ef5658;
  width: 0;
}
.stub:after {
  content: '';
  position: absolute;
  bottom: 0;
  right: 0;
  border-left: 20px solid #ef5658;
  width: 0;
}
.stub .top {
  display: flex;
  align-items: center;
  height: 40px;
  text-transform: uppercase;
}
.stub .top .line {
  display: block;
  background: #fff;
  height: 40px;
  width: 1px;
  margin: 0 20px;
}
.stub .top .num {
  font-size: 10px;
}
.stub .top .num span {
  color: #000;
}
.stub .number {
  position: absolute;
  left: 30px;
  top: 30px;
  font-size: 150px;
  font-family: 'Montserrat', sans-serif ,!important;

}
.stub .invite {
  font-size: 20px;
  position: absolute;
  left: 150px;
  bottom: 45px;
  color: white;
  width: 60%;
}

.check {
  background: #fff;
  height: 250px;
  width: 100%;
  padding: 25px;
  position: relative;
}
.check:before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  border-right: 20px solid #fff;
  width: 0;
}
.check:after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 0;
  border-right: 20px solid #fff;
  width: 0;
}
.check .big {
  font-size: 60px;
  font-weight: 900;
  line-height: 0.8em;
}
.check .number {
  position: absolute;
  top: 20px;
  right: 30px;
  color: #ef5658;
  font-size: 40px;
}
.check .info {
  display: flex;
  justify-content: flex-start;
  font-size: 12px;
  margin-top: 40px;
  width: 100%;
}
.check .info section {
  margin-right: 50px;
}
.check .info section:before {
  content: '';
  background: #ef5658;
  display: block;
  width: 40px;
  height: 3px;
  margin-bottom: 5px;
}
.check .info section .title {
  font-size: 12px;
  text-transform: uppercase;
}
</style>
@else
<style>
body {
  background: #1DCEB0;
  font-family: 'Montserrat', sans-serif ,!important;
  margin: 0;
  padding: 0;
}
.ticket {
  justify-content: center;
  align-items: center;
  width: 100%;
  margin: 20px auto;
}
.ticket .stub,
.ticket .check {
  box-sizing: border-box;
}
.stub {
  background: #10CB43;
  height: 250px;
  width: 100%;
  color: white;
  padding: 20px;
  position: relative;
}
.stub:before {
  content: '';
  position: absolute;
  top: 0;
  right: 0;
  border-left: 20px solid #10CB43;
  width: 0;
}
.stub:after {
  content: '';
  position: absolute;
  bottom: 0;
  right: 0;
  border-left: 20px solid #10CB43;
  width: 0;
}
.stub .top {
  display: flex;
  align-items: center;
  height: 40px;
  text-transform: uppercase;
}
.stub .top .line {
  display: block;
  background: #fff;
  height: 40px;
  width: 1px;
  margin: 0 20px;
}
.stub .top .num {
  font-size: 10px;
}
.stub .top .num span {
  color: #000;
}
.stub .number {
  position: absolute;
  left: 30px;
  top: 30px;
  font-size: 150px;
  font-family: 'Montserrat', sans-serif ,!important;

}
.stub .invite {
  font-size: 20px;
  position: absolute;
  left: 150px;
  bottom: 45px;
  color: white;
  width: 60%;
}

.check {
  background: #fff;
  height: 250px;
  width: 100%;
  padding: 25px;
  position: relative;
}
.check:before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  border-right: 20px solid #fff;
  width: 0;
}
.check:after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 0;
  border-right: 20px solid #fff;
  width: 0;
}
.check .big {
  font-size: 60px;
  font-weight: 900;
  line-height: 0.8em;
}
.check .number {
  position: absolute;
  top: 20px;
  right: 30px;
  color: #10CB43;
  font-size: 40px;
}
.check .info {
  display: flex;
  justify-content: flex-start;
  font-size: 12px;
  margin-top: 40px;
  width: 100%;
}
.check .info section {
  margin-right: 50px;
}
.check .info section:before {
  content: '';
  background: #10CB43;
  display: block;
  width: 40px;
  height: 3px;
  margin-bottom: 5px;
}
.check .info section .title {
  font-size: 12px;
  text-transform: uppercase;
}
</style>
@endif


  <main class="main-content">
    <div class="container-fluid photos">
        <div class="row justify-content-center">
            
            <div class="col-md-10 pt-4">
        

            <h2 class="text-white mb-4 text-center" id="header">Certificado Covid</h2><br>

                    <div class="ticket">
                    <div class="stub">
                        <div class="top">
                        @if(Auth::user()->covid==0)
                        <span class="admit">No Apto</span>
                        @else
                        <span class="admit">Apto</span>
                        @endif
                        <span class="line"></span>
                        <span class="num">
                            Certificado<br><br><br>
                            <br><br><br>
                            <br><br><br>
                            <span>Vacunación</span>
                        </span>
                        </div>
                        <div class="number">T</div>
                        <div class="invite">
                        Ministerio de Sanidad y Seguridad Ciudadana - Trollers © 2021
                        </div>
                    </div>
                    <div class="check">
                        <div class="big">
                        Acceso <br> 
                        

                        @if(Auth::user()->covid==0)
                            Denegado
                        @else
                            Permitido
                        @endif

                        </div>
                        <div class="number">#1</div>
                        <div class="info">
                        <section>
                            <div class="title">DOCUMENTACIÓN</div>
                            <div>AUTORIZADA <br>BOE 08/2021</div>
                        </section>
                        <section>
                        @if(Auth::user()->covid==0)
                            <div class="title">ESTADO:</div>
                            <div>PENDIENTE VACUNACIÓN</div>
                        @else
                            <div class="title">ESTADO:</div>
                            <div>VACUNADO</div>
                        @endif
                        </section>
                        <section>
                            <div class="title">Titular:</div>
                            <div>{{Auth::user()->name}}</div>
                        </section>
                        </div>
                    </div>
                    </div>

                <p style="color:white;">El Certificado COVID Digital facilita la circulación libre y segura dentro de territorio Troller durante la pandemia de COVID-19.
El certificado es gratuito, seguro y accesible a todos los miembros. Se obtiene de forma sencilla, garantiza la interoperabilidad en todas las instituciones de Trollers y respeta plenamente los derechos fundamentales, incluida la protección de los datos personales.
Para solicitarlo debes haber recibido al menos una dosis de la vacuna, haberte realizado alguna prueba diagnóstica de la COVID-19 o haber pasado la enfermedad.
Su uso será necesario para acceder a cualquier institución o delegación oficial del Estado, puedan ser Embajadas, Ministerios o Delegaciones Extraterritoriales.<br><br>
El Inspector General de Sanidad, como autoridad competente del Ministerio de Sanidad y Seguridad Ciudadana, emitirá los certificados a todo miembro que haya sido vacunado por el Servicio de Vacunación Valenciano.

<br>El certificado de vacunación estará disponible 24 horas después de la administración de la vacuna y podrá obtenerse por las siguientes vías:
<br>
<br>- A través del portal personal de la intranet de cada ministerio.
<br>- A través de la sede electrónica del Ministerio de Sanidad y Seguridad Ciudadana.
<br>
                </p>
        </div>
    </div>
  </main>
  @include('general.Trollplayer.scripts')
  @include('general.Links.scripts')

  </body>
</html>

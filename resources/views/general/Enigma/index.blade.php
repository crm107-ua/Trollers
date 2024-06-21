<!DOCTYPE html>
<html lang="en">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
  <style>
    @import url('https://fonts.googleapis.com/css?family=Allerta+Stencil');

    .container {
      width: 100%;
      overflow: auto; /* Permitir desplazamiento horizontal y vertical */
    }

    .game-container, .site-header, .site-footer {
      min-width: 720px; /* Asegura que el contenido mínimo sea más amplio que la pantalla del móvil */
      width: 100%;
    }

    /* Estilos para dispositivos móviles */
    @media (max-width: 768px) {
      #enigmaWrapper, #enigma, #lampboard, #keyboard, #plugboard {
        width: 720px; /* Asegura que el ancho del contenido no se reduzca más de 720px */
        padding: 10px;
        box-sizing: border-box;
      }
      .rotor {
        margin: 0 10px;
        width: 20px;  /* Ajusta el ancho del rotor para que quepa mejor */
        height: 100px; /* Ajusta la altura del rotor para que quepa mejor */
      }
      .letter {
        font-size: 10pt;  /* Reduce el tamaño de la fuente para ajustarse al rotor más pequeño */
        padding: 8px 0;  /* Ajusta el padding para que quepa en el rotor más pequeño */
      }
      .light, .key, .plug {
        width: 25px;  /* Ajusta el ancho de las luces, teclas y enchufes */
        height: 25px; /* Ajusta la altura de las luces, teclas y enchufes */
        margin: 2px 5px;  /* Reduce el margen para que quepa mejor */
      }
      #plaintext, #ciphertext {
        width: 100%;
        padding: 10px;
        box-sizing: border-box;
      }
      #rotorSettings {
        width: 90%;
        left: 5%;
        margin-left: 0;
      }
    }
  </style>
@include('general.Head.head')
<style>@import url('https://fonts.googleapis.com/css?family=Allerta+Stencil');</style>
@include('general.Enigma.assets.styles')
  <body>
  <div class="container">
  <div class="site-wrap">
  <div class="site-mobile-menu">
    <div class="site-mobile-menu-header">
      <div class="site-mobile-menu-close mt-6">
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
            <div id="enigmaZoom">
                <div id=enigmaWrapper><div id=enigma>
                 <div id="rotorSettings" class="standalone">
                 <table border=1 cellpadding=4 cellspacing=0 width=100%><tr>
                   <td>Reflector:&nbsp;<select id="reflector"><option>UKW-B</option><option>UKW-C</option></select></td>
                   <td>Rotor 1:</td>
                   <td>Rotor 2:</td>
                   <td>Rotor 3:</td>
                   </tr>
                   <tr><td>Rotor</td><td><select id="rotor1Select"><option>I</option><option>II</option><option>III</option><option>IV</option><option>V</option></select></td>
                     <td><select id="rotor2Select"><option>I</option><option selected>II</option><option>III</option><option>IV</option><option>V</option></select></td>
                     <td><select id="rotor3Select"><option>I</option><option>II</option><option selected>III</option><option>IV</option><option>V</option></select></td></tr>
               <tr><td>Ring Setting</td><td><select id="rotor1Setting"><option>A</option><option>B</option><option>C</option><option>D</option><option>E</option><option>F</option><option>G</option><option>H</option><option>I</option><option>J</option><option>K</option><option>L</option><option>M</option><option>N</option><option>O</option><option>P</option><option>Q</option><option>R</option><option>S</option><option>T</option><option>U</option><option>V</option><option>W</option><option>X</option><option>Y</option><option>Z</option></select></td>
               <td><select id="rotor2Setting"><option>A</option><option>B</option><option>C</option><option>D</option><option>E</option><option>F</option><option>G</option><option>H</option><option>I</option><option>J</option><option>K</option><option>L</option><option>M</option><option>N</option><option>O</option><option>P</option><option>Q</option><option>R</option><option>S</option><option>T</option><option>U</option><option>V</option><option>W</option><option>X</option><option>Y</option><option>Z</option></select></td><td><select id="rotor3Setting"><option>A</option><option>B</option><option>C</option><option>D</option><option>E</option><option>F</option><option>G</option><option>H</option><option>I</option><option>J</option><option>K</option><option>L</option><option>M</option><option>N</option><option>O</option><option>P</option><option>Q</option><option>R</option><option>S</option><option>T</option><option>U</option><option>V</option><option>W</option><option>X</option><option>Y</option><option>Z</option></select></td></tr>
               <tr><td>Posición inicial</td><td><select id="rotor1Position"><option>A</option><option>B</option><option>C</option><option>D</option><option>E</option><option>F</option><option>G</option><option>H</option><option>I</option><option>J</option><option>K</option><option>L</option><option>M</option><option>N</option><option>O</option><option>P</option><option>Q</option><option>R</option><option>S</option><option>T</option><option>U</option><option>V</option><option>W</option><option>X</option><option>Y</option><option>Z</option></select></td>
               <td><select id="rotor2Position"><option>A</option><option>B</option><option>C</option><option>D</option><option>E</option><option>F</option><option>G</option><option>H</option><option>I</option><option>J</option><option>K</option><option>L</option><option>M</option><option>N</option><option>O</option><option>P</option><option>Q</option><option>R</option><option>S</option><option>T</option><option>U</option><option>V</option><option>W</option><option>X</option><option>Y</option><option>Z</option></select></td><td><select id="rotor3Position"><option>A</option><option>B</option><option>C</option><option>D</option><option>E</option><option>F</option><option>G</option><option>H</option><option>I</option><option>J</option><option>K</option><option>L</option><option>M</option><option>N</option><option>O</option><option>P</option><option>Q</option><option>R</option><option>S</option><option>T</option><option>U</option><option>V</option><option>W</option><option>X</option><option>Y</option><option>Z</option></select></td></tr>    
                 </table>  
                   <button onclick="cancelSettings();">Cancelar</button>
                   <button onclick="applySettings();">Aceptar</button>
               </div>
                 <div id=rotors onclick="displayRotorSettings();">
                 <div class=rotor id=rotor1>
                   <div class="letter nextLetter" id=rotor1Next onclick="previousRotor(1);">B</div>
                   <div class="letter currentLetter" id=rotor1Current>A</div>
                   <div class="letter previousLetter" id=rotor1Previous onclick="nextRotor(1);">Z</div>
                   </div>
                 <div class=rotor id=rotor2>
                   <div class="letter nextLetter" id=rotor2Next onclick="previousRotor(2);">B</div>
                   <div class="letter currentLetter" id=rotor2Current>A</div>
                   <div class="letter previousLetter" id=rotor2Previous onclick="nextRotor(2);">Z</div>
                   </div>
                 <div class=rotor id=rotor3>
                   <div class="letter nextLetter" id=rotor3Next onclick="previousRotor(3);">B</div>
                   <div class="letter currentLetter" id=rotor3Current>A</div>
                   <div class="letter previousLetter" id=rotor3Previous onclick="nextRotor(3);">Z</div>
                   </div> 
                 </div>
                 
                 <div id="lampboard">
                   <div class=light id="lightQ">Q</div>
                   <div class=light id="lightW">W</div>
                   <div class=light id="lightE">E</div>
                   <div class=light id="lightR">R</div>
                   <div class=light id="lightT">T</div>
                   <div class=light id="lightZ">Z</div>
                   <div class=light id="lightU">U</div>
                   <div class=light id="lightI">I</div>
                   <div class=light id="lightO">O</div>
                   <div class=light id="lightA" style="clear: left; margin-left:48px;">A</div>
                   <div class=light id="lightS">S</div>
                   <div class=light id="lightD">D</div>
                   <div class=light id="lightF"> F</div>
                   <div class=light id="lightG">G</div>
                   <div class=light id="lightH">H</div>
                   <div class=light id="lightJ">J</div>
                   <div class=light id="lightK">K</div>
                   <div class=light id="lightP" style="clear: left;">P</div>
                   <div class=light id="lightY">Y</div>
                   <div class=light id="lightX">X</div>
                   <div class=light id="lightC">C</div>
                   <div class=light id="lightV">V</div>
                   <div class=light id="lightB">B</div>
                   <div class=light id="lightN">N</div>
                   <div class=light id="lightM">M</div>
                   <div class=light id="lightL">L</div>
                 </div> 
                 <div class=line></div>
                 
                 <div id="keyboard">
                   <div class=key onclick="pressKey(this);" id="keyQ">Q</div>
                   <div class=key onclick="pressKey(this);" id="keyW">W</div>
                   <div class=key onclick="pressKey(this);" id="keyE">E</div>
                   <div class=key onclick="pressKey(this);" id="keyR">R</div>
                   <div class=key onclick="pressKey(this);" id="keyT">T</div>
                   <div class=key onclick="pressKey(this);" id="keyZ">Z</div>
                   <div class=key onclick="pressKey(this);" id="keyU">U</div>
                   <div class=key onclick="pressKey(this);" id="keyI">I</div>
                   <div class=key onclick="pressKey(this);" id="keyO">O</div>
                   <div class=key onclick="pressKey(this);" id="keyA" style="clear: left; margin-left:48px;">A</div>
                   <div class=key onclick="pressKey(this);" id="keyS">S</div>
                   <div class=key onclick="pressKey(this);" id="keyD">D</div>
                   <div class=key onclick="pressKey(this);" id="keyF">F</div>
                   <div class=key onclick="pressKey(this);" id="keyG">G</div>
                   <div class=key onclick="pressKey(this);" id="keyH">H</div>
                   <div class=key onclick="pressKey(this);" id="keyJ">J</div>
                   <div class=key onclick="pressKey(this);" id="keyK">K</div>
                   <div class=key onclick="pressKey(this);" id="keyP" style="clear: left;">P</div>
                   <div class=key onclick="pressKey(this);" id="keyY">Y</div>
                   <div class=key onclick="pressKey(this);" id="keyX">X</div>
                   <div class=key onclick="pressKey(this);" id="keyC">C</div>
                   <div class=key onclick="pressKey(this);" id="keyV">V</div>
                   <div class=key onclick="pressKey(this);" id="keyB">B</div>
                   <div class=key onclick="pressKey(this);" id="keyN">N</div>
                   <div class=key onclick="pressKey(this);" id="keyM">M</div>
                   <div class=key onclick="pressKey(this);" id="keyL">L</div>
                 </div> 
                 <div class=line></div>
                 
                 <div id=plugboard>
                   <div class=plug onclick="plug(this);">Q</div>
                   <div class=plug onclick="plug(this);">W</div>
                   <div class=plug onclick="plug(this);">E</div>
                   <div class=plug onclick="plug(this);">R</div>
                   <div class=plug onclick="plug(this);">T</div>
                   <div class=plug onclick="plug(this);">Z</div>
                   <div class=plug onclick="plug(this);">U</div>
                   <div class=plug onclick="plug(this);">I</div>
                   <div class=plug onclick="plug(this);">O</div>
                   <div class=plug style="clear: left; margin-left:48px;" onclick="plug(this);">A</div>
                   <div class=plug onclick="plug(this);">S</div>
                   <div class=plug onclick="plug(this);">D</div>
                   <div class=plug onclick="plug(this);">F</div>
                   <div class=plug onclick="plug(this);">G</div>
                   <div class=plug onclick="plug(this);">H</div>
                   <div class=plug onclick="plug(this);">J</div>
                   <div class=plug onclick="plug(this);">K</div>
                   <div class=plug style="clear: left;" onclick="plug(this);">P</div>
                   <div class=plug onclick="plug(this);">Y</div>
                   <div class=plug onclick="plug(this);">X</div>
                   <div class=plug onclick="plug(this);">C</div>
                   <div class=plug onclick="plug(this);">V</div>
                   <div class=plug onclick="plug(this);">B</div>
                   <div class=plug onclick="plug(this);">N</div>
                   <div class=plug onclick="plug(this);">M</div>
                   <div class=plug onclick="plug(this);">L</div>
                 </div>
               
                   
                 </div></div>
               
               <div id="enigma-book"class="page1">
                 <div id="plaintext" ><h1>Texto plano:</h1></div>
                 <div id="ciphertext" ><h1>Cibertexto:</h1></div>
                 <div id="options"><a onclick="decrypt();">Desencriptar</a><a onclick="encrypt();">Encriptar</a><a onclick="clearText();">Limpiar libreta</a></div>
               </div>
               
               <div id="log" style="display: none;"><h1>Encryption Steps:</h1></div>
               </div>
 
      </div>
    </div>
  </div>

  
    @include('general.Links.scripts')
    @include('general.Footer.footer')
    @include('general.Enigma.assets.scripts')
  </main>

  </div>
  </body>
</html>

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
  @include('general.Tests.estilos')

  <main class="main-content" style="padding: 30px;">  
      <div class="row">
              <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500&display=swap" rel="stylesheet" />
<div class="container">
  <div class="heading">
    <h1 class="heading__text">Test de acceso</h1>
  </div>

  <!-- Quiz section -->
  <div class="quiz">
    <div class="quiz__heading">
      <h3 class="quiz__heading-text">
        Has acertado el: <span class="result"></span>
      </h3>
    </div>

    <form class="quiz-form">
      <div class="quiz-form__quiz">
        <p class="quiz-form__question">
          1. ¿Qué simboliza la T mayúscula según la Constitución Troller?
        </p>
        <label class="quiz-form__ans" for="q11">
          <input type="radio" name="q1" id="q11" value="A"/>
          <span class="design"></span>
          <span class="text">a) La tradición del grupo.</span>
        </label>
        <label class="quiz-form__ans" for="q12">
          <input type="radio" name="q1" id="q12" value="B" />
          <span class="design"></span>
          <span class="text">b) El territorio del grupo.</span>
        </label>
        <label class="quiz-form__ans" for="q13">
          <input type="radio" name="q1" id="q13" value="C" />
          <span class="design"></span>
          <span class="text">c) El único y verdadero símbolo del grupo.</span>
        </label>
        <label class="quiz-form__ans" for="q14">
          <input type="radio" name="q1" id="q14" value="D" />
          <span class="design"></span>
          <span class="text">d) La totalidad de los integrantes.</span>
        </label>
      </div>
    
      <!-- Repite el mismo formato para las demás preguntas. Aquí tienes un ejemplo de la segunda pregunta: -->
    
      <div class="quiz-form__quiz">
        <p class="quiz-form__question">
          2. ¿A qué edad se alcanza la mayoría de edad en el grupo Troller?
        </p>
        <label class="quiz-form__ans" for="q21">
          <input type="radio" name="q2" id="q21" value="A"  />
          <span class="design"></span>
          <span class="text">a) 18 años.</span>
        </label>
        <label class="quiz-form__ans" for="q22">
          <input type="radio" name="q2" id="q22" value="B" />
          <span class="design"></span>
          <span class="text">b) 21 años.</span>
        </label>
        <label class="quiz-form__ans" for="q23">
          <input type="radio" name="q2" id="q23" value="C" />
          <span class="design"></span>
          <span class="text">c) 16 años.</span>
        </label>
        <label class="quiz-form__ans" for="q24">
          <input type="radio" name="q2" id="q24" value="D" />
          <span class="design"></span>
          <span class="text">d) 20 años.</span>
        </label>
      </div>

      <div class="quiz-form__quiz">
        <p class="quiz-form__question">
          3. ¿Qué organismo tiene la capacidad de ratificar la guerra y la paz?
        </p>
        <label class="quiz-form__ans" for="q31">
          <input type="radio" name="q3" id="q31" value="A"  />
          <span class="design"></span>
          <span class="text">a) El Consejo de Ministros.</span>
        </label>
        <label class="quiz-form__ans" for="q32">
          <input type="radio" name="q3" id="q32" value="B" />
          <span class="design"></span>
          <span class="text">b) El Consejo Interterritorial de Guerra.</span>
        </label>
        <label class="quiz-form__ans" for="q33">
          <input type="radio" name="q3" id="q33" value="C" />
          <span class="design"></span>
          <span class="text">c) La unanimidad del grupo.</span>
        </label>
        <label class="quiz-form__ans" for="q34">
          <input type="radio" name="q3" id="q34" value="D" />
          <span class="design"></span>
          <span class="text">d) El Consejo de Guerra.</span>
        </label>
    </div>
    
    <div class="quiz-form__quiz">
        <p class="quiz-form__question">
          4. ¿Cuál es la lengua oficial del grupo Troller?
        </p>
        <label class="quiz-form__ans" for="q41">
          <input type="radio" name="q4" id="q41" value="A"  />
          <span class="design"></span>
          <span class="text">a) Inglés.</span>
        </label>
        <label class="quiz-form__ans" for="q42">
          <input type="radio" name="q4" id="q42" value="B" />
          <span class="design"></span>
          <span class="text">b) Francés.</span>
        </label>
        <label class="quiz-form__ans" for="q43">
          <input type="radio" name="q4" id="q43" value="C" />
          <span class="design"></span>
          <span class="text">c) Castellano.</span>
        </label>
        <label class="quiz-form__ans" for="q44">
          <input type="radio" name="q4" id="q44" value="D" />
          <span class="design"></span>
          <span class="text">d) Catalán.</span>
        </label>
    </div>
    
    <div class="quiz-form__quiz">
        <p class="quiz-form__question">
          5. ¿Qué tipo de democracia se establece en el grupo Troller?
        </p>
        <label class="quiz-form__ans" for="q51">
          <input type="radio" name="q5" id="q51" value="A" />
          <span class="design"></span>
          <span class="text">a) Democracia representativa.</span>
        </label>
        <label class="quiz-form__ans" for="q52">
          <input type="radio" name="q5" id="q52" value="B" />
          <span class="design"></span>
          <span class="text">b) Democracia directa.</span>
        </label>
        <label class="quiz-form__ans" for="q53">
          <input type="radio" name="q5" id="q53" value="C" />
          <span class="design"></span>
          <span class="text">c) Democracia parlamentaria.</span>
        </label>
        <label class="quiz-form__ans" for="q54">
          <input type="radio" name="q5" id="q54" value="D" />
          <span class="design"></span>
          <span class="text">d) Democracia federal.</span>
        </label>
    </div>

    <div class="quiz-form__quiz">
      <p class="quiz-form__question">
        6. ¿Qué organismo tiene la legitimidad de cada cargo ministerial?
      </p>
      <label class="quiz-form__ans" for="q61">
        <input type="radio" name="q6" id="q61" value="A" />
        <span class="design"></span>
        <span class="text">a) La propia voluntad de las Cortes.</span>
      </label>
      <label class="quiz-form__ans" for="q62">
        <input type="radio" name="q6" id="q62" value="B" />
        <span class="design"></span>
        <span class="text">b) El Consejo de Ministros.</span>
      </label>
      <label class="quiz-form__ans" for="q63">
        <input type="radio" name="q6" id="q63" value="C" />
        <span class="design"></span>
        <span class="text">c) El Consejo Interterritorial de Guerra.</span>
      </label>
      <label class="quiz-form__ans" for="q64">
        <input type="radio" name="q6" id="q64" value="D" />
        <span class="design"></span>
        <span class="text">d) La unanimidad del grupo.</span>
      </label>
  </div>
  
  <div class="quiz-form__quiz">
      <p class="quiz-form__question">
        7. ¿Qué derecho se garantiza en el artículo 3?
      </p>
      <label class="quiz-form__ans" for="q71">
        <input type="radio" name="q7" id="q71" value="A" />
        <span class="design"></span>
        <span class="text">a) Derecho a la libertad de expresión.</span>
      </label>
      <label class="quiz-form__ans" for="q72">
        <input type="radio" name="q7" id="q72" value="B" />
        <span class="design"></span>
        <span class="text">b) Derecho a la posesión de armas.</span>
      </label>
      <label class="quiz-form__ans" for="q73">
        <input type="radio" name="q7" id="q73" value="C" />
        <span class="design"></span>
        <span class="text">c) Derechos inherentes al honor, intimidad, dignidad, libertad, igualdad y seguridad.</span>
      </label>
      <label class="quiz-form__ans" for="q74">
        <input type="radio" name="q7" id="q74" value="D" />
        <span class="design"></span>
        <span class="text">d) Derecho a la soberanía individual.</span>
      </label>
  </div>
  
  <div class="quiz-form__quiz">
      <p class="quiz-form__question">
        8. ¿Bajo qué circunstancias el grupo Troller reserva el derecho a la posesión de armas?
      </p>
      <label class="quiz-form__ans" for="q81">
        <input type="radio" name="q8" id="q81" value="A" />
        <span class="design"></span>
        <span class="text">a) En cualquier situación.</span>
      </label>
      <label class="quiz-form__ans" for="q82">
        <input type="radio" name="q8" id="q82" value="B" />
        <span class="design"></span>
        <span class="text">b) Bajo una declaración oficial del Estado de Sitio.</span>
      </label>
      <label class="quiz-form__ans" for="q83">
        <input type="radio" name="q8" id="q83" value="C" />
        <span class="design"></span>
        <span class="text">c) Cuando el Consejo de Ministros lo decida.</span>
      </label>
      <label class="quiz-form__ans" for="q84">
        <input type="radio" name="q8" id="q84" value="D" />
        <span class="design"></span>
        <span class="text">d) Durante estados de emergencia.</span>
      </label>
  </div>

  <div class="quiz-form__quiz">
    <p class="quiz-form__question">
      9. ¿Qué organismo tiene la capacidad de redactar cualquier documento legal?
    </p>
    <label class="quiz-form__ans" for="q91">
      <input type="radio" name="q9" id="q91" value="A" />
      <span class="design"></span>
      <span class="text">a) El Consejo de Ministros.</span>
    </label>
    <label class="quiz-form__ans" for="q92">
      <input type="radio" name="q9" id="q92" value="B" />
      <span class="design"></span>
      <span class="text">b) Las Cortes Generales.</span>
    </label>
    <label class="quiz-form__ans" for="q93">
      <input type="radio" name="q9" id="q93" value="C" />
      <span class="design"></span>
      <span class="text">c) Cada integrante, a título ministerial.</span>
    </label>
    <label class="quiz-form__ans" for="q94">
      <input type="radio" name="q9" id="q94" value="D" />
      <span class="design"></span>
      <span class="text">d) El Consejo Interterritorial de Guerra.</span>
    </label>
</div>

<div class="quiz-form__quiz">
    <p class="quiz-form__question">
      10. ¿Qué relación tiene el grupo Troller con España según la Constitución?
    </p>
    <label class="quiz-form__ans" for="q101">
      <input type="radio" name="q10" id="q101" value="A" />
      <span class="design"></span>
      <span class="text">a) Es un territorio autónomo de España.</span>
    </label>
    <label class="quiz-form__ans" for="q102">
      <input type="radio" name="q10" id="q102" value="B" />
      <span class="design"></span>
      <span class="text">b) Es un grupo enemigo de España.</span>
    </label>
    <label class="quiz-form__ans" for="q103">
      <input type="radio" name="q10" id="q103" value="C" />
      <span class="design"></span>
      <span class="text">c) Es considerado hijo de España.</span>
    </label>
    <label class="quiz-form__ans" for="q104">
      <input type="radio" name="q10" id="q104" value="D" />
      <span class="design"></span>
      <span class="text">d) No tiene ninguna relación con España.</span>
    </label>
    <p style="color:white; margin-top:40px; text-align:center;"><a style="color:white;" href="/archivos/documentacion/control_acceso.pdf">Ver control de acceso 2023 - 2024</a></p>

</div>
  

      <input class="submit" type="submit" value="Enviar resultados" />
    </form>
  </div>
</div>
    </div>
    </main>
    

  @include('general.Links.scripts')
  @include('general.Tests.scripts')

  </body>
</html>

<script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/js-polyfills/0.1.43/polyfill.min.js" integrity="sha512-lvWiOP+aMKHllm4THsjzNleVuGOh0WGniJ3lgu/nvCbex1LlaQSxySUjAu/LTJw9FhnSL/PVYoQcckg1Q03+fQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
  // setup vars
  const expectedPasswordHash = "0b0197edf9687a0c2186d96caba2fc006f2086f6bd86e561ca436d6f00b47751";
  var typeSpeed = 20; // Reduce the speed for faster typing
  var pauseLength = 1000;
  let jsonData = null;
  let apiKey = null;
  let isLocked = true;

  fetch('/api/key')
    .then(response => response.json())
    .then(data => {
      apiKey = data.key;
    })
    .catch(error => console.error("Error fetching API key:", error));

  // Load JSON data from the URL
  fetch('https://www.trollers.es/archivos/gpt/trainer_data.json')
    .then(response => response.json())
    .then(data => {
      jsonData = data;
    })
    .catch(error => console.error("Error loading JSON data:", error));

  // get ref to DOM Elements
  var input = $("#inputcmd");
  var output = $("#output");

  // Inicializar con mensaje de contraseña
  $(document).ready(function() {
        appendMessage("assistant", "Introduce la contraseña para acceder al terminal.");
  });
  input.focus();

  // set up Event Listeners
  input.keypress(handleInput);
  $("#terminal-window").click(() => input.focus());

  function handleInput(e) {
    if (isLocked && e.keyCode === 13) {
      // Manejar ingreso de contraseña
      const inputText = input.text().trim();
      sha256(inputText).then((inputHash) => {
        if (inputHash === expectedPasswordHash) {
          isLocked = false; // Desbloquear terminal
          output.text("");  
          output.removeClass("password");
          appendMessage("assistant", "Acceso concedido. Bienvenido.");
          enableTerminal(); // Habilitar terminal
        } else {
          output.text("");
          appendMessage("assistant", "Contraseña incorrecta. Inténtalo de nuevo.");
        }
        input.text(""); // Limpiar el campo
      });
      e.preventDefault();
    }
  }

  function enableTerminal() {
    input.text("");
    input.keypress((e) => {
      if (e.keyCode === 13) {
        var question = input.text().trim();
        if (question) {
          appendMessage("assistant", "Cargando...", true);
          processQuestion(question).then(response => {
            appendMessage("user", question);
            appendMessage("assistant", response);
          }).catch(error => {
            appendMessage("assistant", "Error: " + error.message);
          });
        } else {
          appendMessage("assistant", "Por favor, escribe una pregunta.");
        }
        input.text(""); // Limpiar el campo
        e.preventDefault();
      }
    });
  }

  async function sha256(message) {
    const msgBuffer = new TextEncoder().encode(message);
    const hashBuffer = await crypto.subtle.digest("SHA-256", msgBuffer);
    const hashArray = Array.from(new Uint8Array(hashBuffer));
    return hashArray.map(b => b.toString(16).padStart(2, "0")).join("");
  }

  function appendMessage(role, text, isLoading = false) {
    const messageClass = isLoading ? "loading" : role;
    const message = $(`<div class="message ${messageClass}"></div>`);
    output.append(message);

    if (isLoading) {
      message.text(text);
    } else {
      animateText(message, text).then(() => {
        $(".message.loading").remove();
        MathJax.typesetPromise(); // Procesa las fórmulas matemáticas
      });
    }

    output.scrollTop(output.prop("scrollHeight"));
  }

  function animateText(element, text) {
    return new Promise((resolve) => {
        let index = 0;
        let formattedText = ""; // Texto acumulado con saltos de línea procesados

        function type() {
            if (index < text.length) {
                const char = text.charAt(index);

                // Agregar el carácter al texto acumulado
                if (char === "\n") {
                    formattedText += "<br>"; // Reemplazar saltos de línea con <br>
                } else {
                    formattedText += char; // Agregar cualquier otro carácter normalmente
                }

                // Actualizar el contenido del elemento
                element.html(formattedText);

                // Procesar fórmulas matemáticas dinámicamente
                MathJax.typesetPromise([element[0]]).then(() => {
                    // Continúa animando el texto después de procesar las fórmulas
                    index++;
                    setTimeout(type, typeSpeed);
                });
            } else {
                resolve(); // Resuelve la promesa cuando se completa la animación
            }
        }
        type();
    });
}

  async function processQuestion(question) {
    // Verifica si ya se cargaron los datos JSON
    if (jsonData) {
      const messages = [
        {"role": "system", "content": "Eres un experto en la historia de Trollers, una organizacion secreta repleta de secretos oficiales, te llamas Trollers GPT y estas en versión Beta. Responde basándote en el contexto proporcionado y muy sarcásticamente."},
        {"role": "user", "content": `Aquí tienes información para aprender:\n${JSON.stringify(jsonData)}`},
        {"role": "user", "content": question}
      ];

      const url = "https://api.x.ai/v1/chat/completions";
      const headers = {
        "Content-Type": "application/json",
        "Authorization": `Bearer ${apiKey}`
      };

      const data = {
        "model": "grok-beta",
        "messages": messages,
        "temperature": 0.7
      };

      try {
        let response = await fetch(url, {
          method: "POST",
          headers: headers,
          body: JSON.stringify(data)
        });

        if (!response.ok) {
          throw new Error(`HTTP error! Status: ${response.status}`);
        }

        let json = await response.json();
        return formatResponse(json.choices[0].message.content);
      } catch (error) {
        throw error;
      }
    } else {
      return "Esperando la carga de los datos JSON...";
    }
  }

  function formatResponse(text) {
    text = text.replace(/\*\*(.*?)\*\*/g, "<strong>$1</strong>");
    text = text.replace(/\n/g, "<br>");
    return text;
  }
</script>

  
  <style>
  #output {
    max-height: 300px;
    overflow-y: auto;
    margin-bottom: 10px;
    padding: 10px;
    background-color: #000;
    color: #fff;
    font-family: monospace;
    white-space: pre-wrap;  /* Para que respete los espacios y saltos de línea */
  }
  
  .message {
    margin-bottom: 10px;
  }
  
  .message.user {
    text-align: right;
    color: #0f0;
  }
  
  .message.assistant {
    text-align: left;
    color: #0ff;
  }
  
  .loading {
    font-style: italic;
    color: #ffa500;
  }
  </style>
  
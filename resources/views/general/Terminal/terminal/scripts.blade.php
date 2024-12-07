<script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/js-polyfills/0.1.43/polyfill.min.js" integrity="sha512-lvWiOP+aMKHllm4THsjzNleVuGOh0WGniJ3lgu/nvCbex1LlaQSxySUjAu/LTJw9FhnSL/PVYoQcckg1Q03+fQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
  // setup vars
  var typeSpeed = 20;  // Reduce the speed for faster typing
  var pauseLength = 1000;
  let jsonData = null;
  let apiKey = null;

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
  
  // set up Event Listeners
  input.keypress(keypressInput);
  $("#terminal-window").click(openKeyboard);
  
  function keypressInput(e) {
    if (e.keyCode == 13) {
      var question = input.text().trim();
      if (question) {
        appendMessage("assistant", "Cargando...", true);  // Show loading message with loading style
        processQuestion(question).then(response => {
          appendMessage("user", question);
          appendMessage("assistant", response);
        }).catch(error => {
          appendMessage("assistant", "Error: " + error.message);
        });
      } else {
        appendMessage("assistant", "Por favor, escribe una pregunta.");
      }
      input.html("");
      e.preventDefault();
    }
  }
  
  function openKeyboard() {
    input.focus();
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
  
  // Process the question and format the response
  async function processQuestion(question) {
    // Verifica si ya se cargaron los datos JSON
    if (jsonData) {
      // Prepara el mensaje para la API con el JSON y la pregunta
      const messages = [
        {"role": "system", "content": "Eres un experto en la historia de Trollers, te llamas Trollers GPT y estas en versión Beta. Responde basándote en el contexto proporcionado."},
        {"role": "user", "content": `Aquí tienes información para aprender:\n${JSON.stringify(jsonData)}`},
        {"role": "user", "content": question}
      ];
  
      // Configuración de la solicitud a la API
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
        return formatResponse(json.choices[0].message.content);  // Formatted response
      } catch (error) {
        throw error;
      }
    } else {
      return "Esperando la carga de los datos JSON...";
    }
  }
  
  // Function to format text with bold and line breaks
  function formatResponse(text) {
    // Convert **bold** to <strong>bold</strong>
    text = text.replace(/\*\*(.*?)\*\*/g, "<strong>$1</strong>");
    // Convert newlines to <br> tags
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
    color: #ffa500; /* Color naranja */
  }
  
  </style>
  
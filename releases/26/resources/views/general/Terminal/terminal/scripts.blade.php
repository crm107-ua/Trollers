<script>
// setup vars
var currentLine = "";
var typeSpeed = 70;
var pauseLength = 1000;

// get ref to DOM Elements
var cursor = $("#cursor");
var animate = $(".animate");
var input = $("#inputcmd");
var output = $("#output");

// set up Event Listeners
input.keypress(keypressInput);
$("#terminal-window").click(openKeyboard);

// hide text so we can animate it
animate.each(function(index) {
  $(this).addClass("hide");
});

// make first call to printCharaters() for animation
var temp = setTimeout(printCharaters, typeSpeed);

// this function animates printing of text inside DOMS with the .animate class.
function printCharaters() {
  // check if current line array is empty
  if (currentLine.length == 0) {
    // stop cursor from blinking
    cursor.removeClass("blink");

    // get first line of text and add it to an array
    currentLine = animate.first().text().split("");
    currentLine = currentLine.reverse();

    // remove text from dom and unhide element
    animate.first().html("");
    animate.first().removeClass("hide");
    cursor.appendTo(animate.first());
  }

  // animate typing
  animate.first().append(currentLine.pop()).append(cursor);

  // check if we just popped the last element of the array off
  if (currentLine.length == 0) {
    // remove animated DOM Element from animation
    animate.first().removeClass("animate");
    // get new list of DOM Elements to animate
    animate = $(".animate");
    // make cursor blink at the end-of-line.
    cursor.addClass("blink");

    // Animate next DOM Element if any remain
    if (animate.length > 0) {
      setTimeout(printCharaters, pauseLength);
    } else {
      // all text in the DOM Elements have been animated
      input.after(cursor);
      input.focus();
    }
  } else {
    // Animate next character in DOM Element
    setTimeout(printCharaters, typeSpeed);
  }
}

function keypressInput(e) {
  // received enter key, send cmd and clear input
  if (e.keyCode == 13) {
    var command = input.text();
    output.html(proccessCMD(command));
    input.html("");
    e.preventDefault();
  }
}

function proccessCMD(cmd) {
  cmd = cmd.trim().toLowerCase();
  switch (cmd.split(" ")[0]) {
    case "/help":
      return "Comandos activos:<br>" + 
             "/date: Se obtiene la fecha actual <br>"+
             "/for x [cadena_de_repeticion]<br>"+
             "/sum x y<br>"+
             "/res x y<br>"+
             "/div x y<br>"+
             "/mult x y<br>"
             ;
      break; 
    case "/date":
      var f = new Date();
      return f.getDate() + "-"+ (f.getMonth()+1)+ "-" +f.getFullYear();
      break;
    case "/sum":
      return parseFloat(cmd.split(" ")[1])+parseFloat(cmd.split(" ")[2]);
      break;
    case "/res":
      return parseFloat(cmd.split(" ")[1])-parseFloat(cmd.split(" ")[2]);
      break;
    case "/div":
      return parseFloat(cmd.split(" ")[1])/parseFloat(cmd.split(" ")[2]);
      break;
    case "/mult":
      return parseFloat(cmd.split(" ")[1])*parseFloat(cmd.split(" ")[2]);
      break;
    case "/for":
      var cadena = "";
      if(parseInt(cmd.split(" ")[1]) <= 100){
        if(cmd.split(" ")[2]==''){
          for (let index = 1; index <= parseInt(cmd.split(" ")[1]); index++) {
            cadena += index + " ";
          }
        }else{
          for (let index = 1; index <= parseInt(cmd.split(" ")[1]); index++) {
            cadena += cmd.split(" ")[2] + " ";
          }
        }
      }else{
        cadena="No te pases de listo";
      }
      return cadena;
      break;
    default:
      return "Comando no reconocido. Escribe /help para abrir el asistente.";
      break;
  }
}

//open iOS keyboard
function openKeyboard(){
  input.focus();
}
</script>
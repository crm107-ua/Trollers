<script>

function updateidea() {
  if (!("Notification" in window)) {
    alert("Este navegador no soporta Minecraft");
  }
  else if (Notification.permission === "granted") {
    var notification = new Notification("updates? chat--duck132912.repl.co I am duck1321912");
  }
  else if (Notification.permission !== "denied") {
    Notification.requestPermission().then(function (permission) {
      if (permission === "granted") {
        var notification = new Notification("updates? chat--duck132912.repl.co I am duck1321912");
      }
    });
  }
}Notification.requestPermission().then(function(result) {
  console.log(result);
});function spawnNotification(body, icon, title) {
  var options = {
      body: body,
      icon: icon
  };
}
var button = document.getElementById("button");
var audio = document.getElementById("audio");
button.addEventListener("click", function(){
  if(audio.paused){
    audio.play();
    button.innerHTML = "Pause audio";
  } else {
    audio.pause();
    button.innerHTML = "Play audio";
}
});

</script>

<style>
.rainbow_text {
  margin-top: 2%;
  background: black;
  background: linear-gradient(to right, red, orange , yellow, green, blue, indigo, violet);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent;
}

.rainbow_text.animated {
      animation: rainbow_animation 5s ease-in-out infinite;
      background-size: 400%;
}

@keyframes rainbow_animation {
    0%,100% {
        background-position: 0
    }

    50% {
        background-position: 100%
    }
}


</style>
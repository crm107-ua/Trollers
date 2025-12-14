<style>
body, #inputcmd{
  color: #00ff00;
  font-family: "andale mono",	/* MS WebFont */ "monotype.com",	/* MS WebFont, former name */ monaco,	/* MacOS */ /* Fallback options */ "courier new",	/* Windows, MacOS */ courier,	/* Unix+X, MacOS */ monospace;
}

#terminal-window {
  padding: 30px;
}


#cursor {
  color: #00ff00;
  box-sizing: border-box;
  border-left: .5em solid;
}
.blink {
  animation: typing 6s steps(13, end) infinite, blinking 1s step-end infinite;  
}
.scanlines {
  z-index: 4100;
}
.hide {
  display: none;
}

#inputcmd{
  background-color: #111;
  border: 1px;
  font-size: 1em;
  /*hide default cursor*/
  color: transparent;
  text-shadow: 0 0 0 #00ff00;
}
#inputcmd:focus{
    outline: none;
}
</style>
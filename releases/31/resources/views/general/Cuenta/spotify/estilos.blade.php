<style>

* {
  box-sizing: border-box;
}
:root {
  --bg: #1a1a1a;
  --min-size: 200px;
}
body {
  display: grid;
  place-items: center;
  min-height: 100vh;
  padding: 0;
  margin: 0;
  overflow-y: hidden;
  background: var(--bg);
}
.drag-proxy {
  visibility: hidden;
  position: absolute;
}
.controls {
  position: absolute;
  top: calc(50% + clamp(var(--min-size), 20vmin, 20vmin));
  left: 50%;
  transform: translate(-50%, -50%) scale(1.5);
  display: flex;
  justify-content: space-between;
  min-width: var(--min-size);
  height: 44px;
  width: 20vmin;
  z-index: 300;
}
button {
  height: 48px;
  width: 48px;
  border-radius: 50%;
  position: absolute;
  top: 0%;
  outline: transparent;
  cursor: pointer;
  background: none;
  -webkit-appearance: none;
     -moz-appearance: none;
          appearance: none;
  border: 0;
  transition: transform 0.1s;
  transform: translate(0, calc(var(--y, 0)));
}
button:before {
  border: 2px solid #e6e6e6;
  background: linear-gradient(rgba(204,204,204,0.65), #000) #000;
  content: '';
  box-sizing: border-box;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  height: 80%;
  width: 80%;
  border-radius: 50%;
}
button:active:before {
  background: linear-gradient(#000, rgba(204,204,204,0.65)) #000;
}
button:nth-of-type(1) {
  right: 100%;
}
button:nth-of-type(2) {
  left: 100%;
}
button span {
  position: absolute;
  width: 1px;
  height: 1px;
  padding: 0;
  margin: -1px;
  overflow: hidden;
  clip: rect(0, 0, 0, 0);
  white-space: nowrap;
  border-width: 0;
}
button:hover {
  --y: -5%;
}
button svg {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%) rotate(0deg) translate(2%, 0);
  height: 30%;
  fill: #e6e6e6;
}
button:nth-of-type(1) svg {
  transform: translate(-50%, -50%) rotate(180deg) translate(2%, 0);
}
.scroll-icon {
  height: 30px;
  position: fixed;
  top: 1rem;
  right: 1rem;
  color: #e6e6e6;
  -webkit-animation: action 4s infinite;
          animation: action 4s infinite;
}
.boxes {
  height: 100vh;
  width: 100%;
  overflow: hidden;
  position: absolute;
  transform-style: preserve-3d;
  perspective: 800px;
  touch-action: none;
}
.box {
  transform-style: preserve-3d;
  position: absolute;
  top: 50%;
  left: 50%;
  height: 20vmin;
  width: 20vmin;
  min-height: var(--min-size);
  min-width: var(--min-size);
  display: none;
}
.box:after {
  content: '';
  position: absolute;
  top: 50%;
  left: 50%;
  height: 100%;
  width: 100%;
  background-image: var(--src);
  background-size: cover;
  transform: translate(-50%, -50%) rotate(180deg) translate(0, -100%) translate(0, -0.5vmin);
  opacity: 0.75;
}
.box:before {
  content: '';
  position: absolute;
  top: 50%;
  left: 50%;
  height: 100%;
  width: 100%;
  background: linear-gradient(var(--bg) 50%, transparent);
  transform: translate(-50%, -50%) rotate(180deg) translate(0, -100%) translate(0, -0.5vmin) scale(1.01);
  z-index: 2;
}
.box img {
  position: absolute;
  height: 100%;
  width: 100%;
  top: 0;
  left: 0;
  -o-object-fit: cover;
     object-fit: cover;
}
.box:nth-of-type(odd) {
  background: #b3f075;
}
.box:nth-of-type(even) {
  background: #66b814;
}
@supports (-webkit-box-reflect: below) {
  .box {
    -webkit-box-reflect: below 0.5vmin linear-gradient(transparent 0 50%, #fff 100%);
  }
  .box:after,
  .box:before {
    display: none;
  }
}
@-webkit-keyframes action {
  0%, 25%, 50%, 100% {
    transform: translate(0, 0);
  }
  12.5%, 37.5% {
    transform: translate(0, 25%);
  }
}
@keyframes action {
  0%, 25%, 50%, 100% {
    transform: translate(0, 0);
  }
  12.5%, 37.5% {
    transform: translate(0, 25%);
  }
}


</style>

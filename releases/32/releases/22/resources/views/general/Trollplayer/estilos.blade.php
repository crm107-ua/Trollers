<style>
*,
*:before,
*:after {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

[class^="swiper-button-"],
.swiper-container-horizontal
  > .swiper-pagination-bullets
  .swiper-pagination-bullet,
.swiper-container-horizontal
  > .swiper-pagination-bullets
  .swiper-pagination-bullet::before {
  -webkit-transition: all 0.3s ease;
  transition: all 0.3s ease;
}

.swiper-container {
  width: 100%;
  height: auto;
  -webkit-transition: opacity 0.6s ease;
  transition: opacity 0.6s ease;
}
.swiper-container.swiper-container-coverflow {
  margin-top: 60px;
}
.swiper-container.loading {
  opacityx: 0;
  visibilityx: hidden;
}
.swiper-container:hover .swiper-button-prev,
.swiper-container:hover .swiper-button-next {
  -webkit-transform: translateX(0);
  transform: translateX(0);
  opacity: 1;
  visibility: visible;
}

.swiper-slide {
  background-position: center;
  background-size: cover;
}
.swiper-slide img {
  position: absolute;
  width: 100%;
  height: auto;
}
.swiper-slide .content {
  position: absolute;
  top: 40%;
  left: 0;
  width: 50%;
  padding-left: 5%;
  color: #fff;
}
.swiper-slide .content .title {
  font-size: 2.6em;
  font-weight: bold;
  margin-bottom: 30px;
}
.swiper-slide .content .caption {
  display: block;
  font-size: 13px;
  line-height: 1.4;
}
.ratioWrapper {
  position: relative;
  width: 100%;
  height: 0;
  background-color: #000;
  padding-top: 56%;
}
.ratioWrapper img {
  position: absolute;
  top: 0;
  right: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
}
.slide-caption {
  font-family: helvetica;
  color: white;
  letter-spacing: 2px;
  font-size: 15px;
  padding-top: 10px;
  text-align: center;
}

[class^="swiper-button-"] {
  width: 44px;
  opacity: 0;
  visibility: hidden;
}

.swiper-button-prev {
  -webkit-transform: translateX(50px);
  transform: translateX(50px);
}

.swiper-button-next {
  -webkit-transform: translateX(-50px);
  transform: translateX(-50px);
}

.swiper-container-horizontal
  > .swiper-pagination-bullets
  .swiper-pagination-bullet {
  margin: 0px 9px;
  position: relative;
  width: 12px;
  height: 12px;
  background-color: #fff;
  opacity: 0.5;
  visibility: hidden;
}
.swiper-container-horizontal
  > .swiper-pagination-bullets
  .swiper-pagination-bullet::before {
  content: "";
  position: absolute;
  top: 50%;
  left: 50%;
  width: 18px;
  height: 18px;
  -webkit-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
  border: 0px solid #fff;
  border-radius: 50%;
}
.swiper-container-horizontal
  > .swiper-pagination-bullets
  .swiper-pagination-bullet:hover,
.swiper-container-horizontal
  > .swiper-pagination-bullets
  .swiper-pagination-bullet.swiper-pagination-bullet-active {
  opacity: 1;
}
.swiper-container-horizontal
  > .swiper-pagination-bullets
  .swiper-pagination-bullet.swiper-pagination-bullet-active::before {
  border-width: 1px;
}

@media (max-width: 1023px) {
  .swiper-container {
    height: auto;
  }
  .swiper-container.swiper-container-coverflow {
    margin-top: 0;
  }
  
  .slide-caption {
    font-size: 12px;
  }
}

/* **************
  VIDEO WRAPPER 
************* */

.videoWrapper {
  position: relative;
  width: 100%;
  height: 0;
  background-color: #000;
  padding-top: 56%;
}

.videoIframe {
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: transparent;
}

.videoPoster {
  position: absolute;
  top: 0;
  right: 0;
  left: 0;
  width: 100%;
  height: 100%;
  margin: 0;
  padding: 0;
  cursor: pointer;
  border: 0;
  outline: none;
  background-position: 50% 50%;
  background-size: 100% 100%;
  background-size: cover;
  text-indent: -999em;
  overflow: hidden;
  opacity: 1;
  -webkit-transition: opacity 800ms, height 0s;
  -moz-transition: opacity 800ms, height 0s;
  transition: opacity 800ms, height 0s;
  -webkit-transition-delay: 0s, 0s;
  -moz-transition-delay: 0s, 0s;
  transition-delay: 0s, 0s;
}
.videoWrapperActive .videoPoster {
  opacity: 0;
  height: 0;
  -webkit-transition-delay: 0s, 800ms;
  -moz-transition-delay: 0s, 800ms;
  transition-delay: 0s, 800ms;
}
.videoIframe {
  position: absolute;
  top: 0;
}
/* *********
  SVG PLAY BUTTON
********** */

.stroke-dotted {
  stroke-dasharray: 4, 5;
  stroke-width: 1px;
  -webkit-transform-origin: 50% 50%;
  transform-origin: 50% 50%;
  -webkit-animation: spin 4s infinite linear;
  animation: spin 4s infinite linear;
  -webkit-transition: opacity 1s ease, stroke-width 1s ease;
  transition: opacity 1s ease, stroke-width 1s ease;
}
.stroke-solid {
  stroke-dashoffset: 0;
  stroke-dasharray: 300;
  stroke-width: 4px;
  -webkit-transition: stroke-dashoffset 1s ease, opacity 1s ease;
  transition: stroke-dashoffset 1s ease, opacity 1s ease;
  opacity: 0;
}
.vid-icon {
  -webkit-transition: -webkit-transform 200ms ease-out;
  transition: -webkit-transform 200ms ease-out;
  transition: transform 200ms ease-out;
  transition: transform 200ms ease-out, -webkit-transform 200ms ease-out;
}

.play-vid:hover .stroke-dotted {
  stroke-width: 4px;
  opacity: 1;
}
.play-vid:hover .stroke-solid {
  opacity: 1;
  stroke-dashoffset: 300;
}
.play-vid:hover .icon {
  -webkit-transform: scale(1.05);
  transform: scale(1.05);
  opacity: 1;
}
.play-vid {
  cursor: pointer;
  margin: auto;
  position: absolute;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
  opacity: 0.85;
  width: 110px;
  height: 110px;
}
@-webkit-keyframes spin {
  to {
    -webkit-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@keyframes spin {
  to {
    -webkit-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}


</style>
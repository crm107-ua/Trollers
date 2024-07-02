<style>
.container_visitors {
  text-align: center;
  gap: 100px;
  height: 100px;
  color: white;
}

.social {
  height: 100px;
  width: 100%;
  justify-content: center;
  align-content: center;
  display: flex;
  gap: 10px;
  position: relative;
}

.social a {
  color: #5f6368;
  align-self: center;
  text-decoration: none;
  position: relative;
}

.social a::after {
  content: "";
  position: absolute;
  width: 0;
  height: 100px;
  bottom: -4px;
  left: 0;
  transition: width 0.2s linear;
  background: linear-gradient(
    180deg,
    #fe0000 16.66%,
    #fd8c00 16.66%,
    33.32%,
    #ffe500 33.32%,
    49.98%,
    #119f0b 49.98%,
    66.64%,
    #0644b3 66.64%,
    83.3%,
    #c22edc 83.3%
  );
}

.social a:hover {
  font-weight: bold;
}
.social a:hover::after {
  width: 100%;
}

.container span {
  font-size: 2rem;
  font-weight: 200;
}

.places_container {
  height: 3rem;
  overflow: hidden;
}

.places {
  display: flex;
  flex-direction: column;
  animation: change 28s linear infinite alternate;
}

.places span {
  font-size: 2.0rem;
  font-weight: 400;
  height: 3rem;
}

@keyframes change {
  0%,
  3% {
    transform: translate3d(0, 0rem, 0);
  }
  3.5%,
  6.5% {
    transform: translate3d(0, -3rem, 0);
  }
  7%,
  10% {
    transform: translate3d(0, -6rem, 0);
  }
  10.5%,
  13.5% {
    transform: translate3d(0, -9rem, 0);
  }
  14%,
  17% {
    transform: translate3d(0, -12rem, 0);
  }
  17.5%,
  20.5% {
    transform: translate3d(0, -15rem, 0);
  }
  21%,
  24% {
    transform: translate3d(0, -18rem, 0);
  }
  24.5%,
  27.5% {
    transform: translate3d(0, -21rem, 0);
  }
  28%,
  31% {
    transform: translate3d(0, -24rem, 0);
  }
  31.5%,
  34.5% {
    transform: translate3d(0, -27rem, 0);
  }
  35%,
  38% {
    transform: translate3d(0, -30rem, 0);
  }
  38.5%,
  41.5% {
    transform: translate3d(0, -33rem, 0);
  }
  42%,
  45% {
    transform: translate3d(0, -36rem, 0);
  }
  45.5%,
  48.5% {
    transform: translate3d(0, -39rem, 0);
  }
  49%,
  52% {
    transform: translate3d(0, -42rem, 0);
  }
  52.5%,
  55.5% {
    transform: translate3d(0, -45rem, 0);
  }
  56%,
  59% {
    transform: translate3d(0, -48rem, 0);
  }
  59.5%,
  62.5% {
    transform: translate3d(0, -51rem, 0);
  }
  63%,
  66% {
    transform: translate3d(0, -54rem, 0);
  }
  66.5%,
  69.5% {
    transform: translate3d(0, -57rem, 0);
  }
  70%,
  73% {
    transform: translate3d(0, -60rem, 0);
  }
  73.5%,
  76.5% {
    transform: translate3d(0, -63rem, 0);
  }
  77%,
  80% {
    transform: translate3d(0, -66rem, 0);
  }
  80.5%,
  83.5% {
    transform: translate3d(0, -69rem, 0);
  }
  84%,
  87% {
    transform: translate3d(0, -72rem, 0);
  }
  87.5%,
  90.5% {
    transform: translate3d(0, -75rem, 0);
  }
  91%,
  94% {
    transform: translate3d(0, -78rem, 0);
  }
  94.5%,
  97.5%,
  100% {
    transform: translate3d(0, -81rem, 0);
  }
}
</style>
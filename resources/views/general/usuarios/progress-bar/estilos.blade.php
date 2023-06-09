<style>

* {
	box-sizing: border-box;
}

.progreso {
	width: 100%;
	max-width: 260px;
	height: 6px;
	background: #e1e4e8;
	border-radius: 3px;
	overflow: hidden;
    border: 1px solid white;
    margin: auto;
}

.progreso-barra {
    display: block;
    height: 100%;
    background: linear-gradient(90deg,#ffd33d,#ea4aaa 17%,#b34bff 34%,#01feff 51%,#ffd33d 68%,#ea4aaa 85%,#b34bff);
    background-size: 300% 100%;
    animation: progress-animation 2s linear infinite;
}

@keyframes progresso-animation {
	0% {
		background-position: 100%;
	}

	100% {
		background-position: 0;
	}
}

</style>
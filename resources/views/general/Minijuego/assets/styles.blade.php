<style>

.game-container {
    background-color: #000;
    padding: 20px;
    border-radius: 10px;
    display: flex;
    flex-direction: column;
    align-items: center;
    transition: background-color 0.3s;
}

.game-container.correct {
    background-color: rgb(128, 217, 128);
}

.game-container.incorrect {
    background-color: rgb(234, 107, 107);
}

#cita {
    color: white;
    font-size: 24px;
    margin-bottom: 20px;
}

.options {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
}

.option {
    border-radius: 10px;
    overflow: hidden;
    cursor: pointer;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    width: 80px;  /* Ajusta el tamaño del contenedor */
    height: 80px; /* Para que el contenedor sea cuadrado */
    border: 2px solid white;
}

.option img {
    width: 100%; /* La imagen ocupará todo el ancho del contenedor */
    height: 100%; /* La imagen ocupará toda la altura del contenedor */
    object-fit: cover; /* Asegura que la imagen cubra el contenedor sin deformarse */
    border-radius: 10px; /* Mantener el borde redondeado en la imagen */
}

.option div {
    text-align: center;
    padding: 10px;
    color: white;
}

/* Asegurando que el contenedor de la imagen sea cuadrado */
.option {
    width: 100%;
    padding-top: 100%; /* Esto asegura que el contenedor sea cuadrado */
    position: relative;
}

.option img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* Estilos generales para el círculo */
.cercle {
    border-radius: 50%;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    position: absolute;
    transform: translate(-50%, -50%);
    z-index: 10;
    overflow: hidden;
    border: 2px solid white;
}

/* Estilos para pantallas grandes (PC) */
@media (min-width: 769px) {
    .cercle {
        width: 120px;
        height: 120px;
        left: 50%;
        top: 62%; /* Ajusta según sea necesario */
    }
}

/* Estilos para pantallas pequeñas (Móviles) */
@media (max-width: 768px) {
    .cercle {
        width: 100px;
        height: 100px;
        left: 50%;
        top: 69%; /* Ajusta según sea necesario */
    }
}


.rainbow-background {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: radial-gradient(circle, 
                rgba(180, 77, 77, 1), /* Rojo más oscuro */
                rgba(204, 85, 0, 1),  /* Naranja más oscuro */
                rgba(204, 204, 0, 1), /* Amarillo más oscuro */
                rgba(0, 204, 0, 1),   /* Verde más oscuro */
                rgba(0, 0, 153, 1),   /* Azul más oscuro */
                rgba(51, 0, 102, 1),  /* Índigo más oscuro */
                rgba(102, 0, 153, 1));/* Violeta más oscuro */
    background-size: 400% 400%;
    animation: rainbowAnimation 10s ease-in-out infinite;
    z-index: -10; /* Asegura que esté detrás del texto */
}

@keyframes rainbowAnimation {
    0% { background-position: 0% 0%; }
    100% { background-position: 100% 100%; }
}



.circle-text {
    color: white;
    font-size: 20px;
    font-weight: bold;
    z-index: 30; /* Asegura que el texto esté encima del fondo */
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.8);
    position: relative; /* Asegura que el texto no sea afectado por el desenfoque del fondo */
    padding: 10px; /* Añade espacio alrededor del texto */
    border-radius: 5px; /* Opcional: Bordes redondeados para el fondo del texto */
}

</style>
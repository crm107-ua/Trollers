<script>

let currentcitaIndex = 0;
let totalPuntos = 0;

function loadcita() {
    const citaElement = document.getElementById('cita');
    const currentcita = citas[currentcitaIndex];
    citaElement.textContent = currentcita.cita;
    loadOptions(currentcita.id_user);
}

function loadOptions(id_user) {

    const options = document.querySelectorAll('.option');
    let shuffledUsers = shuffleArray(users.filter(user => user.id !== id_user));
    let correctOption = users.find(user => user.id === id_user);
    
    let optionElements = Array.from(options);
    let usedNames = [];

    if(id_user === 1000) {
        usedNames = ["Grupal"];
    }else{
        usedNames = [correctOption.name];
    }

    optionElements.forEach((option, index) => {
        const label = option.querySelector('div');
        const img = option.querySelector('img');
        const isFirstOption = index === 0;
        const isGroupUser = id_user === 1000;

        assignOption(option, label, img, shuffledUsers, usedNames, correctOption, isFirstOption, isGroupUser);
    });

    optionElements = shuffleArray(optionElements);

    const optionsContainer = document.querySelector('.options');
    optionsContainer.innerHTML = '';
    optionElements.forEach(option => optionsContainer.appendChild(option));

    console.log(optionElements);
}

function assignOption(option, label, img, shuffledUsers, usedNames, correctOption, isFirstOption, isGroupUser) {
    let user, randomName, randomId;

    if (isFirstOption && isGroupUser) {
        // Si es la primera opción y el usuario es el grupo (id_user === 1000)
        ({ user, randomName, randomId } = getRandomUnusedUser(shuffledUsers, usedNames));
        option.setAttribute('onclick', `checkAnswer(${randomId})`);
    } else if (isFirstOption) {
        // Si es la primera opción pero no es el grupo (usuario individual)
        randomName = correctOption.name;
        randomId = correctOption.id;
        option.setAttribute('onclick', `checkAnswer(${correctOption.id})`);
    } else {
        // Para todas las demás opciones
        ({ user, randomName, randomId } = getRandomUnusedUser(shuffledUsers, usedNames));
        option.setAttribute('onclick', `checkAnswer(${randomId})`);
    }

    usedNames.push(randomName);
    label.textContent = randomName;
    img.src = `/images/minijuego/user_img_${randomId}.png`;
}

function getRandomUnusedUser(shuffledUsers, usedNames) {
    let user, randomName, randomId;

    do {
        user = shuffledUsers[Math.floor(Math.random() * shuffledUsers.length)];
        randomName = user.name;
        randomId = user.id;
    } while (usedNames.includes(randomName));

    return { user, randomName, randomId };
}


function shuffleArray(array) {
    for (let i = array.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]];
    }
    return array;
}

function checkAnswer(selectedId) {

    console.log(selectedId);

    const gameContainer = document.querySelector('.game-container');
    const currentcita = citas[currentcitaIndex];
    if (selectedId === currentcita.id_user || selectedId === 5 && currentcita.id_user === 1000) {
        gameContainer.classList.add('correct');
        puntos.textContent = `Puntuación: ${totalPuntos += 10}`;
        setTimeout(() => {
            gameContainer.classList.remove('correct');
        }, 1000);
    } else {
        gameContainer.classList.add('incorrect');
        if (totalPuntos > 0) {
            puntos.textContent = `Puntuación: ${totalPuntos -= 10}`;
        }
        setTimeout(() => {
            gameContainer.classList.remove('incorrect');
        }, 1000);
    }
    currentcitaIndex = (currentcitaIndex + 1) % citas.length;
    setTimeout(loadcita, 1000);
}

const puntos = document.getElementById('puntos');
puntos.textContent = `Puntuación: ${totalPuntos}`;
document.addEventListener('DOMContentLoaded', loadcita);

</script>
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
    let filteredUsers = users.filter(user => user.id !== 1000 && user.id !== id_user);
    let shuffledUsers = shuffleArray(filteredUsers);
    let correctOption = users.find(user => user.id === id_user);
    
    let optionElements = Array.from(options);
    let usedNames = [correctOption.name];
    
    optionElements.forEach((option, index) => {
        const label = option.querySelector('div');
        const img = option.querySelector('img');

        if (index === 0) {
            label.textContent = correctOption.name;
            option.setAttribute('onclick', `checkAnswer(${correctOption.id})`);
            img.src = `/images/minijuego/user_img_${correctOption.id}.png`;
        } else {
            let randomName;
            do {
                user = shuffledUsers[Math.floor(Math.random() * shuffledUsers.length)];
                randomName = user.name;
                randomId = user.id;
            } while (usedNames.includes(randomName));
            usedNames.push(randomName);
            label.textContent = randomName;
            img.src = `/images/minijuego/user_img_${randomId}.png`;
            option.setAttribute('onclick', `checkAnswer(${users.find(user => user.name === randomName).id})`);
        }
    });

    optionElements = shuffleArray(optionElements);

    const optionsContainer = document.querySelector('.options');
    optionsContainer.innerHTML = '';
    optionElements.forEach(option => optionsContainer.appendChild(option));
}

function shuffleArray(array) {
    for (let i = array.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]];
    }
    return array;
}

function checkAnswer(selectedId) {
    const gameContainer = document.querySelector('.game-container');
    const currentcita = citas[currentcitaIndex];
    if (selectedId === currentcita.id_user) {
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
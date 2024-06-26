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
    background-color: green;
}

.game-container.incorrect {
    background-color: red;
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
    background-color: #ef6c57;
    border-radius: 10px;
    overflow: hidden;
    cursor: pointer;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

.option img {
    margin-top: 20px;
    width: 70%;
    height: 70%;
}

.option div {
    text-align: center;
    padding: 10px;
    color: white;
}
</style>
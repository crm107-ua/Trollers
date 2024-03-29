<style>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

::selection {
  background: #fff;
  color: #117eeb;
}

body {
  background: #252c4a;
  font-family: "Montserrat", sans-serif;
  font-weight: 300;
  color: #fff;
}

.container {
  max-width: 50rem;
  width: 90vw;
  margin: 2rem auto;
}

.quiz__heading {
  display: none;
}

.result {
  font-size: 2rem;
  color: #117eeb;
}

.heading__text {
  margin-bottom: 1.5rem;
  text-align: center;
  font-size: 3rem;
  font-weight: 300;
}

.quiz__heading-text {
  margin-bottom: 2rem;
  text-align: center;
  font-weight: 300;
}

.quiz-form__question {
  margin-bottom: 0.8rem;
  font-size: 1.2rem;
}

.quiz-form__quiz:not(:last-child) {
  margin-bottom: 1.5rem;
}

.quiz-form__ans {
  border-radius: 0.8rem;
  border: 2px solid #264868;
  padding: 0.8rem;
  color: #a1a9bd;
  position: relative;
  display: flex;
  justify-content: flex-start;
  align-items: center;
  flex-wrap: nowrap;
  cursor: pointer;
}

.quiz-form__ans:not(:last-child) {
  margin-bottom: 0.5rem;
}

input[type=radio] {
  opacity: 0;
  position: absolute;
  left: 15px;
  z-index: -1;
}

.design {
  width: 1rem;
  height: 1rem;
  border: 1px solid #a1a9bd;
  border-radius: 100%;
  margin-right: 1rem;
  position: relative;
  display: flex;
  justify-content: center;
  align-items: center;
}

.design::before,
.design::after {
  content: "";
  position: absolute;
  width: inherit;
  height: inherit;
  border-radius: inherit;
  transform: scale(0);
  transform-origin: center center;
}

.design:before {
  background: #a1a9bd;
  opacity: 0;
  transition: 0.3s;
}

.design::after {
  background: #117eeb;
  opacity: 0.4;
  transition: 0.6s;
}

.text {
  backface-visibility: hidden;
  transition: transform 200ms ease-in;
}

input[type=radio]:hover ~ .text {
  transform: translateX(0.4rem);
}

input[type=radio]:hover .quiz-form__ans {
  color: #117eeb;
}

input[type=radio]:checked + .design::before {
  opacity: 1;
  transform: scale(0.6);
}

input[type=radio]:hover + .design,
input[type=radio]:focus + .design {
  border: 1px solid #117eeb;
}

input[type=radio]:hover + .design:before,
input[type=radio]:focus + .design:before {
  background: #117eeb;
}

input[type=radio]:focus + .design::after,
input[type=radio]:active + .design::after {
  opacity: 0.1;
  transform: scale(2);
}

.submit {
  border: none;
  border-radius: 100vh;
  padding: 0.8rem 1.5rem;
  background: #117eeb;
  color: #fff;
  font-family: inherit;
  text-transform: uppercase;
  font-size: 1rem;
  font-weight: 300;
  display: block;
  margin: 1rem auto 4rem auto;
  cursor: pointer;
  transition: transform 200ms ease, box-shadow 200ms ease;
}

.submit:focus {
  outline: none;
}

.submit:hover {
  transform: translateY(-2px) scale(1.015);
  box-shadow: 0 1rem 2rem rgba(0, 0, 0, 0.35);
}

.submit:active {
  transform: translateY(0) scale(1);
  box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
}

.correct {
  color: #117eeb;
}

.wrong {
  color: crimson;
}

</style>
// ***
// Combination Lock
// ***

var day = new Date().getDate();
var month = new Date().getMonth()+1;

var combinationLock = {
	combination: parseInt(day+""+month),
	locked: true,
	wheels: [0, 0, 0, 0],
	increment: function(wheel) {
		if (this.wheels[wheel] === 9) {
			this.wheels[wheel] = 0;
		} else {
			this.wheels[wheel]++;
		}
	},
	decrement: function(wheel) {
		if (this.wheels[wheel] === 0) {
			this.wheels[wheel] = 9;
		} else {
			this.wheels[wheel]--;
		}
	},
	check: function() {
		if (this.combination === parseInt(this.wheels.join(''))) {
			this.locked = false;
		} else {
			this.locked = true;
		}
	},
	spin: function() {
		// randomize the wheels
		for (i = 0; i < 4; i++) {
			this.wheels[i] = getRandomInt(10, -1);
		}
	}
}

// ***
// Reusable Functions
// ***

function getRandomInt(min, max) {
    min = Math.ceil(min);
    max = Math.floor(max);
    return Math.floor(Math.random() * (max - min + 1)) + min;
}


// ***
// Presentation
// ***

// Increment buttons
var increments = document.getElementsByClassName('increment');

for (var i = 0; i < increments.length; i++) {
    increments[i].addEventListener('click', function(){
    	let wheelIndex = parseInt(this.getAttribute('index'));
    	combinationLock.increment(wheelIndex);
    	document.querySelectorAll('.digit')[wheelIndex].value = combinationLock.wheels[wheelIndex];
    });
}

// Decrement buttons
var decrements = document.getElementsByClassName('decrement');

for (var i = 0; i < decrements.length; i++) {
    decrements[i].addEventListener('click', function(){
    	let wheelIndex = parseInt(this.getAttribute('index'));
    	combinationLock.decrement(wheelIndex);
    	document.querySelectorAll('.digit')[wheelIndex].value = combinationLock.wheels[wheelIndex];
    });
}


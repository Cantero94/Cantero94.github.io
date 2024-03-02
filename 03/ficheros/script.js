var PIEDRA = "piedra";
var PAPEL = "papel";
var TIJERAS = "tijeras";
var LAGARTO = "lagarto";
var SPOCK = "spock";

var EMPATE = 0;
var VICTORIA = 1;
var DERROTA = 2;

let isPlaying = false;

var piedraBtn = document.getElementById("piedra");
var papelBtn = document.getElementById("papel");
var tijerasBtn = document.getElementById("tijeras");
var lagartoBtn = document.getElementById("lagarto");
var spockBtn = document.getElementById("spock");
var hackBtn = document.getElementById("hack");
var vsText = document.getElementById("vs");
var usuImg = document.getElementById("img-usuario");
var pcImg = document.getElementById("img-pc");
var vicGif = document.getElementById('victory');
var lossGif = document.getElementById('loss');

var userScoreSpan = document.getElementById('userScore');
var computerScoreSpan = document.getElementById('computerScore');
let userScore = 0;
let computerScore = 0;

var originalText = vsText.innerHTML;

// Deshabilita los botones del juego
function disableGameButtons() {
    piedraBtn.disabled = true;
    papelBtn.disabled = true;
    tijerasBtn.disabled = true;
    lagartoBtn.disabled = true;
    spockBtn.disabled = true;
    hackBtn.disabled = true;
}

// Habilita los botones del juego
function enableGameButtons() {
    piedraBtn.disabled = false;
    papelBtn.disabled = false;
    tijerasBtn.disabled = false;
    lagartoBtn.disabled = false;
    spockBtn.disabled = false;
    hackBtn.disabled = false;
}

// Finaliza el juego y muestra el resultado
function endGame(winner) {
    isPlaying = false; // Asegura que el estado del juego indique que ya no se está jugando
    if (winner === 'user') {
        vsText.innerHTML = "¡Has ganado el juego!";
        vicGif.style.display = 'block';
        document.getElementById('victmp3').play();
    } else if (winner === 'computer') {
        vsText.innerHTML = "Has perdido el juego.";
        lossGif.style.display = 'block';
        document.getElementById('lossmp3').loop = true;
        document.getElementById('lossmp3').play();
    }
    disableGameButtons();
    userScore = 0;
    computerScore = 0;

    setTimeout(function() {
        vicGif.style.display = 'none';
        lossGif.style.display = 'none';
        document.getElementById('victmp3').pause();
        document.getElementById('victmp3').currentTime = 0;
        document.getElementById('lossmp3').pause();
        document.getElementById('lossmp3').currentTime = 0;
        enableGameButtons();
        userScoreSpan.textContent = userScore;
        computerScoreSpan.textContent = computerScore;
        vsText.innerHTML = originalText;
    }, winner === 'user' ? 12000 : 6000);
}
// Evento de clic para el botón hack
hackBtn.addEventListener("click", () => {
    if(isPlaying) return;
    isPlaying = true; // Evita que el juego continue después de usar el hack
    userScore = 6; // Establece la puntuación necesaria para ganar
    endGame('user'); // Finaliza el juego como una victoria para el usuario
});
// Función para jugar
function play(userOption) {
    if(isPlaying) return;
    isPlaying = true; // Indica que el juego ha comenzado
    disableGameButtons(); // Deshabilita los botones mientras se juega

    usuImg.src = "imagenes/" + userOption + ".webp";
    document.getElementById('tic').loop = true;
    document.getElementById('tic').play();
    vsText.innerHTML = "Eligiendo!";
    var interval = setInterval(function() {
        var pcOption = calcpcOpcion();
        pcImg.src = "imagenes/" + pcOption + ".webp";
    }, 50);

    setTimeout(function () {
        clearInterval(interval);
        var pcOption = calcpcOpcion();
        document.getElementById('tic').pause();
        document.getElementById('tic').currentTime = 0;
        pcImg.src = "imagenes/" + pcOption + ".webp";
        var result = calcularResultado(userOption, pcOption);

        switch (result) {
            case EMPATE:
                vsText.innerHTML = "Empate!";
                break;
            case VICTORIA:
                vsText.innerHTML = "Ganaste!";
                userScore++;
                break;
            case DERROTA:
                vsText.innerHTML = "Perdiste!";
                computerScore++;
                break;
        }

        userScoreSpan.textContent = userScore;
        computerScoreSpan.textContent = computerScore;

        if (userScore > 5) {
            endGame('user');
        } else if (computerScore > 5) {
            endGame('computer');
        } else {
            isPlaying = false; // Permite iniciar un nuevo juego
            enableGameButtons(); // Vuelve a habilitar los botones si nadie ha ganado aún
        }
    }, 1000); // Tiempo antes de mostrar el resultado y continuar
}
// Eventos de clic para las opciones del jugador
piedraBtn.addEventListener("click", () => { play(PIEDRA); });
papelBtn.addEventListener("click", () => { play(PAPEL); });
tijerasBtn.addEventListener("click", () => { play(TIJERAS); });
lagartoBtn.addEventListener("click", () => { play(LAGARTO); });
spockBtn.addEventListener("click", () => { play(SPOCK); });

// Genera la elección de la computadora
function calcpcOpcion() {
    var num = Math.floor(Math.random() * 5);
    switch (num) {
        case 0: return PIEDRA;
        case 1: return PAPEL;
        case 2: return TIJERAS;
        case 3: return LAGARTO;
        case 4: return SPOCK;
    }
}
// Calcula el resultado del juego
function calcularResultado(userOption, pcOption) {
    if (userOption === pcOption) {
        return EMPATE;
    } else if ((userOption === PIEDRA && (pcOption === TIJERAS || pcOption === LAGARTO)) ||
               (userOption === PAPEL && (pcOption === PIEDRA || pcOption === SPOCK)) ||
               (userOption === TIJERAS && (pcOption === PAPEL || pcOption === LAGARTO)) ||
               (userOption === LAGARTO && (pcOption === PAPEL || pcOption === SPOCK)) ||
               (userOption === SPOCK && (pcOption === PIEDRA || pcOption === TIJERAS))) {
        return VICTORIA;
    } else {
        return DERROTA;
    }
}

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

// Finaliza el juego y muestra gifs y sonidos
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
    disableGameButtons(); // Deshabilita los botones y reinica contadores
    userScore = 0; 
    computerScore = 0;

    setTimeout(function() {  // Vuelve a ocultar los gif, para música, habilita botones y pone a 0  las puntuaciones.
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
    }, winner === 'user' ? 12000 : 6000); //Operador ternario, si es jugador le da 12 segundos al gif de victoria, sino muestra el gif de derrota durante 6 segundos
}
// Evento de clic para el botón hack
hackBtn.addEventListener("click", () => {
    if(isPlaying) return; //Evita que la función continue si ya hay un juego en curso
    isPlaying = true;
    userScore = 6; // Establece la puntuación necesaria para ganar
    endGame('user'); // Finaliza el juego como una victoria para el usuario
});
// Función para jugar
function play(userOption) {
    if(isPlaying) return; //Evita que la función continue si ya hay un juego en curso
    isPlaying = true;
    
    usuImg.src = "imagenes/" + userOption + ".webp"; //Cambia la imagen del jugador por la elección
    disableGameButtons(); // Deshabilita los botones mientras se la máquina elige resultado
    
    vsText.innerHTML = "Eligiendo!";
    var interval = setInterval(function() { //setInterval hace que se repita la función cada 50 milisegundos
        var pcOption = calcpcOpcion();
        pcImg.src = "imagenes/" + pcOption + ".webp";
        document.getElementById('tic').loop = true;
        document.getElementById('tic').play();
    }, 50);

    setTimeout(function () {
        clearInterval(interval); //Corta la repetición de interval que cambia la imagen de la máquina
        var pcOption = calcpcOpcion();
        document.getElementById('tic').pause();
        document.getElementById('tic').currentTime = 0;
        pcImg.src = "imagenes/" + pcOption + ".webp";
        var result = calcularResultado(userOption, pcOption);

        switch (result) { //Muestra los resultados de los turnos
            case EMPATE:
                vsText.innerHTML = "Empate!";
                document.getElementById('tied').play();
                break;
            case VICTORIA:
                vsText.innerHTML = "Ganaste!";
                userScore++;
                document.getElementById('coin').play();
                break;
            case DERROTA:
                vsText.innerHTML = "Perdiste!";
                document.getElementById('doh').play();
                computerScore++;
                break;
        }
        //Muestra resultado en el marcador
        userScoreSpan.textContent = userScore;
        computerScoreSpan.textContent = computerScore;

        if (userScore > 5) {
            endGame('user');
        } else if (computerScore > 5) {
            endGame('computer');
        } else {
            isPlaying = false; // Permite iniciar un nuevo juego
            enableGameButtons(); // Vuelve a habilitar los botones
        }
    }, 1000); // Tiempo antes de mostrar el resultado y continuar
}
// Si escucha click en uno de los botones ejecuta la función play con la opción del jugador
piedraBtn.addEventListener("click", function() { play(PIEDRA); });
papelBtn.addEventListener("click", function() { play(PAPEL); });
tijerasBtn.addEventListener("click", function() { play(TIJERAS); });
lagartoBtn.addEventListener("click", function() { play(LAGARTO); });
spockBtn.addEventListener("click", function() { play(SPOCK); });
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
/*Uso igualdad exacta ("===") para comparar tipo y valor, aunque en el caso de mi código 
siempre estas variables se van a comparar con variables del mismo tipo se considera mejor 
práctica que hacerlo con igualdad abstracta ("==")*/
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

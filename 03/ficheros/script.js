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

//PAUSAR ANIMACIÓN BOTONES CUANDO HAY MOUSEOVER Y REACTIVAR CUANDO NO
var grupo = document.querySelectorAll('.grupo button');
function pausarAnimacion() {
grupo.forEach(function(boton) {
    boton.style.animationPlayState = 'paused';
});
}
function reanudarAnimacion() {
    grupo.forEach(function(boton) {
        boton.style.animationPlayState = 'running';
    });
}
grupo.forEach(function(boton) {
    boton.addEventListener('mouseover', pausarAnimacion);
    boton.addEventListener('mouseout', reanudarAnimacion);
});
//////////////////////////////////////////////////////////////////////
//EMPIEZA EL JUEGO
function play(usuOpcion) {
//CAMBIA LA IMAGEN DEL JUGADOR POR LA ELECCIÓN
    usuImg.src = "imagenes/" + usuOpcion + ".webp";
//INICIA SONIDO MIENTRAS LA MÁQUINA ELIGE OPCIÓN
    document.getElementById('tic').loop = true;
    document.getElementById('tic').play();
//CAMBIA LA IMAGEN DE MÁQUINA DURANTE LA ELECCIÓN CADA 50 MILISEGUNDOS    
    var interval = setInterval(function(){
        var pcOpcion = calcpcOpcion();
        pcImg.src = "imagenes/" + pcOpcion + ".webp";
    }, 50);    
//CAMBIA EL VS
    vsText.innerHTML = "Eligiendo!";
//ESTABLECE EL RETARDO ENTRE QUE ELEGIMOS LA OPCIÓN Y LA MAQUINA ELIGE LA SUYA
    setTimeout(function () {
//IGUALA LA VARIABLE pcOpcion A LA ELECCIÓN EN LA FUNCIÓN
        var pcOpcion = calcpcOpcion();
//UNA VEZ QUE TERMINA EL TIEMPO DE ELECCIÓN SE PARA EL SONIDO
        document.getElementById('tic').pause();
        document.getElementById('tic').currentTime = 0;
        pcImg.src = "imagenes/" + pcOpcion + ".webp";
//PARA EL CAMBIO DE IMAGENES DE LA MAQUINA
        clearInterval(interval);
//RECOGE EL RESULTADO DEVUELTO EN LA FUNCIÓN calcularResultado
        var resultado = calcularResultado (usuOpcion, pcOpcion);
        switch (resultado) {
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
//Actualiza en cada turno la puntuación de cada jugador
        userScoreSpan.textContent = userScore;
        computerScoreSpan.textContent = computerScore;
   
//VERIFICA SI ALGÚN JUGADOR TIENE YA MÁS DE 5 VICTORIAS Y LE DA LA PARTIDA Y BLOQUEA BOTONES, 
//TRAS 15 SEGUNDOS PONE EN 0 LOS MARCADORES Y REHABILITA LOS BOTONES
            if (userScore > 5) {
                vsText.innerHTML = "¡Has ganado el juego!";
                vicGif.style.display = 'block';
                document.getElementById('victmp3').play();
                disableGameButtons();
                userScore = 0;
                computerScore = 0;
                setTimeout(function() {
                vicGif.style.display = 'none';
                enableGameButtons();
                userScoreSpan.textContent = userScore;
                computerScoreSpan.textContent = computerScore;
                vsText.innerHTML = originalText;
                }, 12000);
            } else if (computerScore > 5) {
                vsText.innerHTML = "Has perdido el juego.";
                lossGif.style.display = 'block';
                document.getElementById('lossmp3').loop = true;
                document.getElementById('lossmp3').play();
                disableGameButtons();
                userScore = 0;
                computerScore = 0;
                setTimeout(function() {
                lossGif.style.display = 'none';
                document.getElementById('lossmp3').pause();
                document.getElementById('lossmp3').currentTime = 0;
                enableGameButtons();
                userScoreSpan.textContent = userScore;
                computerScoreSpan.textContent = computerScore;
                vsText.innerHTML = originalText;
                }, 12000);
            }
    }, 1000);
    
}
//ELECCIÓN DEL JUGADOR
piedraBtn.addEventListener("click", () => {
    play(PIEDRA);
});
papelBtn.addEventListener("click", () => {
    play(PAPEL);
});
tijerasBtn.addEventListener("click", () => {
    play(TIJERAS);
});
lagartoBtn.addEventListener("click", () => {
    play(LAGARTO);
});
spockBtn.addEventListener("click", () => {
    play(SPOCK);
});
//ELECCIÓN DE LA MAQUINA
function calcpcOpcion() {
    var num = Math.floor(Math.random() * 5);
    switch (num) {
        case 0:
            return PIEDRA;
        case 1:
            return PAPEL;
        case 2:
            return TIJERAS;
        case 3:
            return LAGARTO;
        case 4:
            return SPOCK;
    }
}
//CÁLCULO DE RESULTADOS
function calcularResultado (usuOpcion, pcOpcion) {
    if (usuOpcion === pcOpcion) {
        return EMPATE;
    } else if (usuOpcion === PIEDRA) {
        if (pcOpcion === PAPEL || pcOpcion === SPOCK)
            return DERROTA;
        else if (pcOpcion === TIJERAS || pcOpcion === LAGARTO)
            return VICTORIA;

    } else if (usuOpcion === PAPEL) {
        if (pcOpcion === TIJERAS || pcOpcion === LAGARTO)
            return DERROTA;
        else if (pcOpcion === PIEDRA  || pcOpcion === SPOCK)
            return VICTORIA;

    } else if (usuOpcion === TIJERAS) {
        if (pcOpcion === PIEDRA || pcOpcion === SPOCK)
            return DERROTA;
        else if (pcOpcion === PAPEL || pcOpcion === LAGARTO)
            return VICTORIA;

    } else if (usuOpcion === LAGARTO) {
        if (pcOpcion === PIEDRA || pcOpcion === TIJERAS)
            return DERROTA;
        else if (pcOpcion === PAPEL || pcOpcion === SPOCK)
            return VICTORIA;
    } else if (usuOpcion === SPOCK) {
        if (pcOpcion === PAPEL || pcOpcion === LAGARTO)
            return DERROTA;
        else if (pcOpcion === PIEDRA || pcOpcion === TIJERAS)
            return VICTORIA;
    }
}
function disableGameButtons() {
    piedraBtn.disabled = true;
    papelBtn.disabled = true;
    tijerasBtn.disabled = true;
    lagartoBtn.disabled = true;
    spockBtn.disabled = true;
}
function enableGameButtons() {
    piedraBtn.disabled = false;
    papelBtn.disabled = false;
    tijerasBtn.disabled = false;
    lagartoBtn.disabled = false;
    spockBtn.disabled = false;
}
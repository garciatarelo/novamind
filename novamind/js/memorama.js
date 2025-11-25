         // Variables globales
        let tarjetasDestapadas = 0;
        let tarjeta1 = null;
        let tarjeta2 = null;
        let primerResultado = null;
        let segundoResultado = null;
        let movimientos = 0;
        let aciertos = 0;
        let temporizador = false;
        let timer = 30;
        let tiempoRegresivoId = null;
        let numeros = [];
        let bloquearTablero = false;

        // Referencias del DOM
        const mostrarMovimientos = document.getElementById('movimientos');
        const mostrarAciertos = document.getElementById('aciertos');
        const mostrarTiempo = document.getElementById('t-restante');

        //Audio
        let clickAudio = new Audio('./sounds/click.mp3'); 
        let correctAudio = new Audio('./sounds/correct.mp3'); 
        let errorAudio = new Audio('./sounds/error.mp3'); 
        let loseAudio = new Audio('./sounds/lose.mp3'); 
        let winAudio = new Audio('./sounds/win1.mp3'); 
        
        // Función para inicializar el juego
        function inicializarJuego() {
            // Reiniciar variables
            tarjetasDestapadas = 0;
            tarjeta1 = null;
            tarjeta2 = null;
            primerResultado = null;
            segundoResultado = null;
            movimientos = 0;
            aciertos = 0;
            temporizador = false;
            timer = 30;
            bloquearTablero = false;

            // Actualizar estadísticas
            mostrarMovimientos.innerHTML = `Movimientos: 0`;
            mostrarAciertos.innerHTML = `Aciertos: 0`;
            mostrarTiempo.innerHTML = `Tiempo: ${timer} segundos`;

            // Generar números aleatorios y crear tablero
            numeros = [1, 1, 2, 2, 3, 3, 4, 4, 5, 5, 6, 6, 7, 7, 8, 8];
            numeros = numeros.sort(() => Math.random() - 0.5);

             // Renderizar tarjetas y restaurar color de fondo original
            for (let i = 0; i => 15; i++) {
                const boton = document.getElementById(i);
                boton.innerHTML = ''; // Eliminar contenido de la tarjeta
                boton.disabled = false; // Habilitar el botón (tarjeta)
                boton.style.backgroundColor = ""; // Restaurar el color de fondo original
            }

            // Detener temporizador si estaba corriendo
            clearInterval(tiempoRegresivoId);
        }

        // Función para contar tiempo
        function contarTiempo() {
            tiempoRegresivoId = setInterval(() => {
                timer--;
                mostrarTiempo.innerHTML = `Tiempo: ${timer}`;
                if (timer === 0) {
                    clearInterval(tiempoRegresivoId);
                    bloquearTarjetas();
                    loseAudio.play();
                    Swal.fire({
                        icon: 'error',
                        title: '¡Tiempo agotado!',
                        text: 'Perdiste el juego. Intenta de nuevo.',
                    }).then(() => {
                        inicializarJuego();
                    });
                }
            }, 1000);
        }

        // Función para bloquear todas las tarjetas al perder
        function bloquearTarjetas() {
            for (let i = 0; i < 16; i++) {
                const tarjetaBloqueada = document.getElementById(i);
                tarjetaBloqueada.innerHTML = `<img class="imgMemo" src="./img/memorama/${numeros[i]}.png" alt="imagen">`;
                tarjetaBloqueada.disabled = true;
            }
        }

        // Función para manejar la lógica de destapar tarjetas
        function destapar(id) {
            if (bloquearTablero) return; // No permitir más clics mientras se evalúan las tarjetas
        
            if (!temporizador) {
                contarTiempo();
                temporizador = true;
            }
        
            tarjetasDestapadas++;
        
            if (tarjetasDestapadas === 1) {
                // Mostrar primer número
                tarjeta1 = document.getElementById(id);
                primerResultado = numeros[id];
                tarjeta1.innerHTML = `<img class="imgMemo" src="./img/memorama/${primerResultado}.png" alt="imagen">`;
                tarjeta1.style.backgroundColor = "#3e4e63"; // Cambiar el fondo al hacer clic
                clickAudio.play();
        
                // Deshabilitar primer botón
                tarjeta1.disabled = true;
            } else if (tarjetasDestapadas === 2) {
                // Mostrar segundo número
                tarjeta2 = document.getElementById(id);
                segundoResultado = numeros[id];
                tarjeta2.innerHTML = `<img class="imgMemo" src="./img/memorama/${segundoResultado}.png" alt="imagen">`;
                tarjeta2.style.backgroundColor = "#3e4e63"; // Cambiar el fondo al hacer clic
        
                // Deshabilitar segundo botón
                tarjeta2.disabled = true;
        
                // Incrementar movimientos
                movimientos++;
                mostrarMovimientos.innerHTML = `Movimientos: <span class="color-negro">${movimientos}</span>`;
        
                // Evaluar si hay coincidencia
                bloquearTablero = true; // Bloquear temporalmente
                if (primerResultado === segundoResultado) {
                    tarjetasDestapadas = 0;
                    aciertos++;
                    mostrarAciertos.innerHTML = `Aciertos: <span class="color-negro">${aciertos}</span>`;
        
                    if (aciertos === 8) {
                        winAudio.play();
                        clearInterval(tiempoRegresivoId);
                        Swal.fire({
                            icon: 'success',
                            title: '¡Felicidades!',
                            text: `Ganaste el juego con ${movimientos} movimientos.`,
                        }).then(() => {
                            inicializarJuego();
                        });
                    }
                    bloquearTablero = false;
                    correctAudio.play();
                } else {
                    errorAudio.play();
                    // Ocultar las tarjetas y restaurar el color después de un tiempo
                    setTimeout(() => {
                        tarjeta1.innerHTML = ''; // Vuelve a tapar la tarjeta 1
                        tarjeta2.innerHTML = ''; // Vuelve a tapar la tarjeta 2
                        tarjeta1.style.backgroundColor = ""; // Restaurar el color original
                        tarjeta2.style.backgroundColor = ""; // Restaurar el color original
                        tarjeta1.disabled = false; // Habilitar la tarjeta 1
                        tarjeta2.disabled = false; // Habilitar la tarjeta 2
                        tarjetasDestapadas = 0; // Reiniciar contador de tarjetas destapadas
                        bloquearTablero = false; // Liberar el tablero para más clics
                    }, 800); // Esperar 800ms antes de restaurar las tarjetas
                }
            }
        }

        // Inicializar el juego al cargar la página
        inicializarJuego();
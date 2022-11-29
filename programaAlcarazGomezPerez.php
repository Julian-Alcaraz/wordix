<?php
include_once("wordix.php");

/**************************************/
/***** DATOS DE LOS INTEGRANTES *******/
/**************************************/

/* Apellido, Nombre. Legajo. Carrera. mail. Usuario Github */
/* ... COMPLETAR ... */


/**************************************/
/*********** PROGRAMA PRINCIPAL *******/
/**************************************/

//Declaración de variables:


//Inicialización de variables:
$coleccionPalabras=cargarColeccionPalabras();
$coleccionPartidas=cargarPartidas();
//Proceso:

//$partida = jugarWordix("MELON", strtolower("MaJo"));
//print_r($partida);
//imprimirResultado($partida);
echo"Ingrese un usuario \n";
$usuario=trim(fgets(STDIN));
escribirMensajeBienvenida($usuario);
do {
    $opcion=seleccionarOpcion();
    switch ($opcion) {
        case 0: 
            //jugar wordix con nuna partida elegida
            //$bandera =true;
            $jugador = solicitarJugador();
            echo "Selecciones una de las siguientes palabras segun el numero";
            print_r($coleccionPalabras);
            $numPalabra = trim(fgets(STDIN));
            //"!!!!verifico que la palabra no la haya usado el jugador
            $partida = jugarWordix($coleccionPalabras[$numPalabra],$jugador);//juego la partida
            $coleccionPartidas=agregarPartida($coleccionPartidas,$partida);//agrego la partida al a coleccion
            break;
        case 1: 
            $jugador = solicitarJugador();
            //elegir palabra aleatoria ($numPalabra)
            //"!!!!verifico que la palabra no la haya usado el jugador(usar misma funcion que en el anterior)
            $partida = jugarWordix($coleccionPalabras[$numPalabra],$jugador);//juego la partida
            $coleccionPartidas=agregarPartida($coleccionPartidas,$partida);//agrego la partida al a coleccion

            break;
        case 2: 
            $cantPartidas=count($coleccionPartidas);
            $min=0;
            $numero = solicitarNumeroEntre($min,$cantPartidas);
            datosPartida($coleccionPartidas,$numero);
            break;
        case 3: 
            $jugador = solicitarJugador();
            $cantPartidas=count($coleccionPartidas);
            $min=0;
            $numero = primerPartidaGanada($coleccionPartidas,$jugador);//revisar por que da -1 con los usuario(problema en funcio primerPartidaGanada)
            datosPartida($coleccionPartidas,$numero);
            break;
        case 4: 
                //completar qué secuencia de pasos ejecutar si el usuario elige la opción 3        
            break;
                    
        case 5: 
            mostrarColeccion($coleccionPartidas);
            break;
        case 6: 
            //agrear palabra de 5 letras
            $palabra=leerPalabra5Letras();
            agregarPalabra($coleccionPalabras,$palabra);
            break;
        case 7:
            echo"saliste";
            break;
        }
} while ($opcion==8);


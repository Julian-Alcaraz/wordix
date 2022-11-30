<?php
include_once("wordix.php");

/**************************************/
/***** DATOS DE LOS INTEGRANTES *******/
/**************************************/

/* Apellido, Nombre. Legajo. Carrera. mail. Usuario Github */
/*  
- **Julian Jorge Alcaraz** - Legajo: FAI-4261 - TUDW-mail: julianalcaraz4@gmail.com - GitHub: Julian-Alcaraz 
- **Gomez Zuñiga Gonzalo** - Legajo: FAI-4381 -TUDW- mail: gzg95-@hotmail.es -GitHub: GonzaGomez9522
- **Catalina Perez Moriena** - Legajo: FAI-3126 -TUDW- mail: morienacata@gmail.com -GitHub: catamoriena
*/


/**************************************/
/*********** PROGRAMA PRINCIPAL *******/
/**************************************/

//STRING $usuario,$jugador,$palabra,INT $opcion,$numPalabra,$cantPartidas,$min,$numero
//,BOOLEAN $estadoPalabra,ARRAY $coleccionPartidas,$coleccionPartidas,$datosResumen
//FLOAT $porcentaje


//Inicialización de variables:
$coleccionPalabras=cargarColeccionPalabras();
$coleccionPartidas=cargarPartidas();

echo"Ingrese un usuario \n";
$usuario=trim(fgets(STDIN));
//escribirMensajeBienvenida($usuario);
do {
    $opcion=seleccionarOpcion();
    switch ($opcion) {
        case 1: 
            //jugar wordix con una partida elegida
            $jugador = solicitarJugador();
            echo "Seleccione una de las siguientes palabras segun el numero";
            print_r($coleccionPalabras);
            $numPalabra = trim(fgets(STDIN));
            //"!!!!verifico que la palabra no la haya usado el jugador
            do{
            $estadoPalabra=verificarPalabra($coleccionPartidas,$coleccionPalabras[$numPalabra],$jugador);
            if(!$estadoPalabra){
                    echo "seleccione otra palabra";
                    $numPalabra = trim(fgets(STDIN));
            }
            }while(!$estadoPalabra);
            $partida = jugarWordix($coleccionPalabras[$numPalabra],$jugador);//juego la partida
            $coleccionPartidas=agregarElemento($coleccionPartidas,$partida);//agrego la partida al a coleccion
            break;
        case 2: 
            $jugador = solicitarJugador();
            //elegir palabra aleatoria ($numPalabra)            
            $numPalabra= rand($min =0,count($coleccionPalabras));
            //"!!!!verifico que la palabra no la haya usado el jugador(usar misma funcion que en el anterior)
            do{
                $estadoPalabra=verificarPalabra($coleccionPartidas,$coleccionPalabras[$numPalabra],$jugador);
                if(!$estadoPalabra){
                    //vuelvo a buscar otra palabra
                    $numPalabra = rand($min =0,count($coleccionPalabras));
                }
            }while(!$estadoPalabra);
            $partida = jugarWordix($coleccionPalabras[$numPalabra],$jugador);//juego la partida
            $coleccionPartidas=agregarElemento($coleccionPartidas,$partida);//agrego la partida al a coleccion
            break;
        case 3: 
            //muestra los datos de una partida elejida por el usuario
            $cantPartidas=count($coleccionPartidas);
            $min=0;
            $numero = solicitarNumeroEntre($min,$cantPartidas);
            datosPartida($coleccionPartidas,$numero);
            break;
        case 4: 
            //muestra la primer partida ganadora
            $jugador = solicitarJugador();
            $cantPartidas=count($coleccionPartidas);
            $min=0;
            $numero = primerPartidaGanada($coleccionPartidas,$jugador);//revisar por que da -1 con los usuario(problema en funcio primerPartidaGanada)
            datosPartida($coleccionPartidas,$numero);
            break;
        case 5: 
            //mostrar estadisticas de un jugador
            $jugador = solicitarJugador();
            $datosResumen=resumenJugador($coleccionPartidas, $jugador);
            echo"************************************************\n";
            if($datosResumen["partidas"]!=0){
            $porcentaje=$datosResumen["victorias"]*100/$datosResumen["partidas"];//ver
            echo"Jugador: ".$datosResumen["nombre"]."\n";
            echo"Partidas: ".$datosResumen["partidas"]."\n";
            echo"Puntaje Total: ".$datosResumen["puntaje"]."\n";
            echo"Victorias: ".$datosResumen["victorias"];
            echo"Porcentaje Victorias: ".$porcentaje."%\n";
            echo"Adivinidas: \n";
            echo"   Intento 1: ".$datosResumen["intento1"]."\n";
            echo"   Intento 2: ".$datosResumen["intento2"]."\n";
            echo"   Intento 3: ".$datosResumen["intento3"]."\n";
            echo"   Intento 4: ".$datosResumen["intento4"]."\n";
            echo"   Intento 5: ".$datosResumen["intento5"]."\n";
            echo"   Intento 6: ".$datosResumen["intento6"]."\n";
            echo"************************************************\n";
        }else{
            echo"************************************************\n";
            echo "el Jugador no tiene partidas \n";
            echo"************************************************\n";
        }
            break;
                    
        case 6: 
            //Mostrar listado de partidas ordenadas por jugador y por palabra
            mostrarColeccion($coleccionPartidas);
            break;
        case 7: 
            //agrear palabra de 5 letras
            $palabra=leerPalabra5Letras();
            $coleccionPalabras=agregarElemento($coleccionPalabras,$palabra);
            break;
        case 8:
            //sale del juego
            echo"JUEGO FINALIZADO";
            break;
        }
} while ($opcion!=8);


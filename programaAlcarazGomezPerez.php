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

//STRING $usuario,$jugador,$palabra,INT $opcion,$numPalabra,$cantPartidas,$min,$numero, $elementos, $max
//BOOLEAN $estadoPalabra,ARRAY $coleccionPartidas,$coleccionPartidas,$datosResumen

//Inicialización de variables:
$coleccionPalabras=cargarColeccionPalabras();
$coleccionPartidas=cargarPartidas();

echo"Ingrese un usuario \n";
$usuario=trim(fgets(STDIN));

do {
    $opcion=seleccionarOpcion();
    switch ($opcion) {
        case 1: 
            //jugar wordix con una partida elegida
            $jugador = solicitarJugador();
            echo "Seleccione una de las siguientes palabras segun el numero";
            print_r($coleccionPalabras);
            $min=0;
            $max=count($coleccionPalabras)-1;
            $numPalabra = solicitarNumeroEntre($min,$max);
            //verifico que la palabra no la haya usado el jugador anteriormente
            do{
            $estadoPalabra=verificarPalabra($coleccionPartidas,$coleccionPalabras[$numPalabra],$jugador);
            if(!$estadoPalabra){
                echo "seleccione otra palabra";
                $numPalabra = trim(fgets(STDIN));
            }
            }while(!$estadoPalabra);
            $partida = jugarWordix($coleccionPalabras[$numPalabra],$jugador);//juego la partida
            $elementos= count($coleccionPartidas);
            $coleccionPartidas[$elementos]=$partida;//agrego la partida a la coleccion
            break;
        case 2: 
            $jugador = solicitarJugador();
            $numPalabra= rand($min =0,count($coleccionPalabras));//elegir palabra aleatoria ($numPalabra)
            //verifico que la palabra no la haya usado el jugador anteriormente
            do{
                $estadoPalabra=verificarPalabra($coleccionPartidas,$coleccionPalabras[$numPalabra],$jugador);
                if(!$estadoPalabra){
                    //vuelvo a buscar otra palabra
                    $numPalabra = rand($min =0,count($coleccionPalabras));
                }
            }while(!$estadoPalabra);
            $partida = jugarWordix($coleccionPalabras[$numPalabra],$jugador);//juego la partida
            $elementos= count($coleccionPartidas);
            $coleccionPartidas [$elementos] = $partida;
            break;
        case 3: //muestra los datos de una partida elejida por el usuario
            $cantPartidas=count($coleccionPartidas)-1;
            $min=0;
            $numero = solicitarNumeroEntre($min,$cantPartidas);
            datosPartida($coleccionPartidas,$numero);
            break;
        case 4: //muestra la primer partida ganadora
            $jugador = solicitarJugador();
            $cantPartidas=count($coleccionPartidas);
            $min=0;
            $numero = primerPartidaGanada($coleccionPartidas,$jugador);
            if($numero==1){
                datosPartida($coleccionPartidas,$numero);

            }elseif($numero==-1){
                echo "El usuario no gano ninguna partida";
            }elseif($numero==-2){
                echo "El usuario ingresado no jugo ninguna partida";
            }
            break;
        case 5: //mostrar estadisticas de un jugador
            $jugador = solicitarJugador();
            $datosResumen=resumenJugador($coleccionPartidas, $jugador);
            mostrarResumen($datosResumen);
            break;
                    
        case 6: //Mostrar listado de partidas ordenadas por jugador y por palabra
            mostrarColeccion($coleccionPartidas);
            break;
        case 7: //agrear palabra de 5 letras
            $palabra=leerPalabra5Letras();
            $coleccionPalabras=agregarPalabra($coleccionPalabras,$palabra);
            break;
        case 8: //sale del juego
            echo"JUEGO FINALIZADO";
            break;
        }
} while ($opcion!=8);


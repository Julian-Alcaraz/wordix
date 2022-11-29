<?php

/*
La librería JugarWordix posee la definición de constantes y funciones necesarias
para jugar al Wordix.
Puede ser utilizada por cualquier programador para incluir en sus programas.
*/

/**************************************/
/***** DEFINICION DE CONSTANTES *******/
/**************************************/
const CANT_INTENTOS = 6;

/*
    disponible: letra que aún no fue utilizada para adivinar la palabra
    encontrada: letra descubierta en el lugar que corresponde
    pertenece: letra descubierta, pero corresponde a otro lugar
    descartada: letra descartada, no pertence a la palabra
*/
const ESTADO_LETRA_DISPONIBLE = "disponible";
const ESTADO_LETRA_ENCONTRADA = "encontrada";
const ESTADO_LETRA_DESCARTADA = "descartada";
const ESTADO_LETRA_PERTENECE = "pertenece";

/**************************************/
/***** DEFINICION DE FUNCIONES ********/
/**************************************/


/**
 * Escrbir un texto en color ROJO
 * @param string $texto)
 */
function escribirRojo($texto)
{
    echo "\e[1;37;41m $texto \e[0m";
}

/**
 * Escrbir un texto en color VERDE
 * @param string $texto)
 */
function escribirVerde($texto)
{
    echo "\e[1;37;42m $texto \e[0m";
}

/**
 * Escrbir un texto en color AMARILLO
 * @param string $texto)
 */
function escribirAmarillo($texto)
{
    echo "\e[1;37;43m $texto \e[0m";
}

/**
 * Escrbir un texto en color GRIS
 * @param string $texto)
 */
function escribirGris($texto)
{
    echo "\e[1;34;47m $texto \e[0m";
}

/**
 * Escrbir un texto pantalla.
 * @param string $texto)
 */
function escribirNormal($texto)
{
    echo "\e[0m $texto \e[0m";
}

/**
 * Escribe un texto en pantalla teniendo en cuenta el estado.
 * @param string $texto
 * @param string $estado
 */
function escribirSegunEstado($texto, $estado)
{
    switch ($estado) {
        case ESTADO_LETRA_DISPONIBLE:
            escribirNormal($texto);
            break;
        case ESTADO_LETRA_ENCONTRADA:
            escribirVerde($texto);
            break;
        case ESTADO_LETRA_PERTENECE:
            escribirAmarillo($texto);
            break;
        case ESTADO_LETRA_DESCARTADA:
            escribirRojo($texto);
            break;
        default:
            echo " $texto ";
            break;
    }
}

/**escribe el mensaje de bienvenida
 * @param string $usuario
 */
function escribirMensajeBienvenida($usuario)
{
    echo "***************************************************\n";
    echo "** Hola ";
    escribirAmarillo($usuario);
    echo " Juguemos una PARTIDA de WORDIX! **\n";
    echo "***************************************************\n";
}

/** verifica que el string ingresado sea una palabra
 * @param string $cadena
 */
function esPalabra($cadena)
{
    //int $cantCaracteres, $i, boolean $esLetra
    $cantCaracteres = strlen($cadena);
    $esLetra = true;
    $i = 0;
    while ($esLetra && $i < $cantCaracteres) {
        $esLetra =  ctype_alpha($cadena[$i]);
        $i++;
    }
    return $esLetra;
}

/**
 * Función para que el usuario ingrese una nueva palabra de 5 letras
 * @return string
 */
function leerPalabra5Letras()
{
    //string $palabra
    echo "Ingrese una palabra de 5 letras: ";
    $palabra = trim(fgets(STDIN));
    $palabra  = strtoupper($palabra); //convierte la palabra en mayúscula

    //Mientras la palabra sea incorrecta, se va a pedir hasta que sea una palabra valida
    while (strlen($palabra) != 5 || !esPalabra($palabra)) {//strlen verifica la cantidad de caracteres
        echo "Debe ingresar una palabra de 5 letras:";
        $palabra = strtoupper(trim(fgets(STDIN)));
    }
    return $palabra;
}



/**
 * Inicia una estructura de datos Teclado. La estructura es de tipo: ¿Indexado, asociativo o Multidimensional?
 *@return array
 */
function iniciarTeclado()
{
    //array $teclado (arreglo asociativo, cuyas claves son las letras del alfabeto)
    $teclado = [
        "A" => ESTADO_LETRA_DISPONIBLE, "B" => ESTADO_LETRA_DISPONIBLE, "C" => ESTADO_LETRA_DISPONIBLE, "D" => ESTADO_LETRA_DISPONIBLE, "E" => ESTADO_LETRA_DISPONIBLE,
        "F" => ESTADO_LETRA_DISPONIBLE, "G" => ESTADO_LETRA_DISPONIBLE, "H" => ESTADO_LETRA_DISPONIBLE, "I" => ESTADO_LETRA_DISPONIBLE, "J" => ESTADO_LETRA_DISPONIBLE,
        "K" => ESTADO_LETRA_DISPONIBLE, "L" => ESTADO_LETRA_DISPONIBLE, "M" => ESTADO_LETRA_DISPONIBLE, "N" => ESTADO_LETRA_DISPONIBLE, 
        "O" => ESTADO_LETRA_DISPONIBLE, "P" => ESTADO_LETRA_DISPONIBLE, "Q" => ESTADO_LETRA_DISPONIBLE, "R" => ESTADO_LETRA_DISPONIBLE, "S" => ESTADO_LETRA_DISPONIBLE,
        "T" => ESTADO_LETRA_DISPONIBLE, "U" => ESTADO_LETRA_DISPONIBLE, "V" => ESTADO_LETRA_DISPONIBLE, "W" => ESTADO_LETRA_DISPONIBLE, "X" => ESTADO_LETRA_DISPONIBLE,
        "Y" => ESTADO_LETRA_DISPONIBLE, "Z" => ESTADO_LETRA_DISPONIBLE
    ];
    return $teclado;
}

/**
 * Escribe en pantalla el estado del teclado. Acomoda las letras en el orden del teclado QWERTY
 * @param array $teclado
 */
function escribirTeclado($teclado)
{
    //array $ordenTeclado (arreglo indexado con el orden en que se debe escribir el teclado en pantalla)
    //string $letra, $estado
    $ordenTeclado = [
        "salto",
        "Q", "W", "E", "R", "T", "Y", "U", "I", "O", "P", "salto",
        "A", "S", "D", "F", "G", "H", "J", "K", "L", "salto",
        "Z", "X", "C", "V", "B", "N", "M", "salto"
    ];

    foreach ($ordenTeclado as $letra) {
        switch ($letra) {
            case 'salto':
                echo "\n";
                break;
            default:
                $estado = $teclado[$letra];
                escribirSegunEstado($letra, $estado);
                break;
        }
    }
    echo "\n";
};


/**
 * Escribe en pantalla los intentos de Wordix para adivinar la palabra
 * @param array $estruturaIntentosWordix
 */
function imprimirIntentosWordix($estructuraIntentosWordix)
{
    $cantIntentosRealizados = count($estructuraIntentosWordix);
    //$cantIntentosFaltantes = CANT_INTENTOS - $cantIntentosRealizados;

    for ($i = 0; $i < $cantIntentosRealizados; $i++) {
        $estructuraIntento = $estructuraIntentosWordix[$i];
        echo "\n" . ($i + 1) . ")  ";
        foreach ($estructuraIntento as $intentoLetra) {
            escribirSegunEstado($intentoLetra["letra"], $intentoLetra["estado"]);
        }
        echo "\n";
    }

    for ($i = $cantIntentosRealizados; $i < CANT_INTENTOS; $i++) {
        echo "\n" . ($i + 1) . ")  ";
        for ($j = 0; $j < 5; $j++) {
            escribirGris(" ");
        }
        echo "\n";
    }
    //echo "\n" . "Le quedan " . $cantIntentosFaltantes . " Intentos para adivinar la palabra!";
}

/**
 * Dada la palabra wordix a adivinar, la estructura para almacenar la información del intento 
 * y la palabra que intenta adivinar la palabra wordix.
 * devuelve la estructura de intentos Wordix modificada con el intento.
 * @param string $palabraWordix
 * @param array $estruturaIntentosWordix
 * @param string $palabraIntento
 * @return array estructura wordix modificada
 */
function analizarPalabraIntento($palabraWordix, $estruturaIntentosWordix, $palabraIntento)
{
    $cantCaracteres = strlen($palabraIntento);
    $estructuraPalabraIntento = []; /*almacena cada letra de la palabra intento con su estado */
    for ($i = 0; $i < $cantCaracteres; $i++) {
        $letraIntento = $palabraIntento[$i];
        $posicion = strpos($palabraWordix, $letraIntento);
        if ($posicion === false) {
            $estado = ESTADO_LETRA_DESCARTADA;
        } else {
            if ($letraIntento == $palabraWordix[$i]) {
                $estado = ESTADO_LETRA_ENCONTRADA;
            } else {
                $estado = ESTADO_LETRA_PERTENECE;
            }
        }
        array_push($estructuraPalabraIntento, ["letra" => $letraIntento, "estado" => $estado]);
    }

    array_push($estruturaIntentosWordix, $estructuraPalabraIntento);
    return $estruturaIntentosWordix;
}

/**
 * Actualiza el estado de las letras del teclado. 
 * Teniendo en cuenta que una letra sólo puede pasar:
 * de ESTADO_LETRA_DISPONIBLE a ESTADO_LETRA_ENCONTRADA, 
 * de ESTADO_LETRA_DISPONIBLE a ESTADO_LETRA_DESCARTADA, 
 * de ESTADO_LETRA_DISPONIBLE a ESTADO_LETRA_PERTENECE
 * de ESTADO_LETRA_PERTENECE a ESTADO_LETRA_ENCONTRADA
 * @param array $teclado
 * @param array $estructuraPalabraIntento
 * @return array el teclado modificado con los cambios de estados.
 */
function actualizarTeclado($teclado, $estructuraPalabraIntento)
{
    foreach ($estructuraPalabraIntento as $letraIntento) {
        $letra = $letraIntento["letra"];
        $estado = $letraIntento["estado"];
        switch ($teclado[$letra]) {
            case ESTADO_LETRA_DISPONIBLE:
                $teclado[$letra] = $estado;
                break;
            case ESTADO_LETRA_PERTENECE:
                if ($estado == ESTADO_LETRA_ENCONTRADA) {
                    $teclado[$letra] = $estado;
                }
                break;
        }
    }
    return $teclado;
}

/**
 * Determina si se ganó una palabra intento posee todas sus letras "Encontradas".
 * @param array $estructuraPalabraIntento
 * @return bool
 */
function esIntentoGanado($estructuraPalabraIntento)
{
    $cantLetras = count($estructuraPalabraIntento);
    $i = 0;

    while ($i < $cantLetras && $estructuraPalabraIntento[$i]["estado"] == ESTADO_LETRA_ENCONTRADA) {
        $i++;
    }

    if ($i == $cantLetras) {
        $ganado = true;
    } else {
        $ganado = false;
    }

    return $ganado;
}

/**
 * ****COMPLETAR***** documentación de la intefaz
 */
function obtenerPuntajeWordix()  /* ****COMPLETAR***** parámetros formales necesarios */
{

    /* ****COMPLETAR***** cuerpo de la función*/
    return 0;
}

/**
 * Dada una palabra para adivinar, juega una partida de wordix intentando que el usuario adivine la palabra.
 * @param string $palabraWordix
 * @param string $nombreUsuario
 * @return array estructura con el resumen de la partida, para poder ser utilizada en estadísticas.
 */
function jugarWordix($palabraWordix, $nombreUsuario)
{
    /*Inicialización*/
    $arregloDeIntentosWordix = [];
    $teclado = iniciarTeclado();
    escribirMensajeBienvenida($nombreUsuario);
    $nroIntento = 1;
    do {

        echo "Comenzar con el Intento " . $nroIntento . ":\n";
        $palabraIntento = leerPalabra5Letras();
        $indiceIntento = $nroIntento - 1;
        $arregloDeIntentosWordix = analizarPalabraIntento($palabraWordix, $arregloDeIntentosWordix, $palabraIntento);
        $teclado = actualizarTeclado($teclado, $arregloDeIntentosWordix[$indiceIntento]);
        /*Mostrar los resultados del análisis: */
        imprimirIntentosWordix($arregloDeIntentosWordix);
        escribirTeclado($teclado);
        /*Determinar si la plabra intento ganó e incrementar la cantidad de intentos */

        $ganoElIntento = esIntentoGanado($arregloDeIntentosWordix[$indiceIntento]);
        $nroIntento++;
    } while ($nroIntento <= CANT_INTENTOS && !$ganoElIntento);


    if ($ganoElIntento) {
        $nroIntento--;
        $puntaje = obtenerPuntajeWordix();
        echo "Adivinó la palabra Wordix en el intento " . $nroIntento . "!: " . $palabraIntento . " Obtuvo $puntaje puntos!";
    } else {
        $nroIntento = 0; //reset intento
        $puntaje = 0;
        echo "Seguí Jugando Wordix, la próxima será! ";
    }

    $partida = [
        "palabraWordix" => $palabraWordix,
        "jugador" => $nombreUsuario,
        "intentos" => $nroIntento,
        "puntaje" => $puntaje
    ];

    return $partida;
}
/**Funcion solicita nombre de jugador, verifica que sean todas letras y le devuelve en minusculas
 * no tiene parametros
 */
function solicitarJugador(){
    /** string $nombre
     * boolean $nombreBienIngresado
     */
    echo "Ingrese el nombre del jugador " ;
    $nombre = trim(fgets(STDIN));
    do{
    if (esPalabra($nombre)){
        $nombreBienIngresado=true;
    }else{
        $nombreBienIngresado=false;
        echo"el nombre ingresado no es valido";
        echo "Ingrese otro porfavor";
        $nombre = trim(fgets(STDIN));
    }
    }while(!$nombreBienIngresado);
return strtolower($nombre);
}

/**
 * Obtiene una colección de palabras
 * @return array
 */
function cargarColeccionPalabras(){
    //array $cargarColeccionPalabras
    //print_r
    $coleccionPalabras = [
        "MUJER", "QUESO", "FUEGO", "CASAS", "RASGO",
        "GATOS", "GOTAS", "HUEVO", "TINTO", "NAVES",
        "VERDE", "MELON", "YUYOS", "PIANO", "PISOS", 
        "NEGRO", "PERRO", "AMIGO", "DATOS", "MESAS",
        "TECLA", "PIEZA", "LAPIZ", "COLOR"
    ];

    return ($coleccionPalabras);
}


/**
 * Estructura de datos de ejemplos de partidas
 * @return array
 */
function cargarPartidas(){
    //array $coleccionPartidas
    //print_r
    $coleccionPartidas[0] = ["palabraWordix" => "MUJER", "jugador" => "maría", "intentos" => 0, "puntaje" => 0];
    $coleccionPartidas[1] = ["palabraWordix" => "QUESO", "jugador" => "pedro", "intentos" => 3, "puntaje" => 14];
    $coleccionPartidas[2] = ["palabraWordix" => "FUEGO", "jugador" => "jorge", "intentos" => 6, "puntaje" => 10];
    $coleccionPartidas[3] = ["palabraWordix" => "CASAS", "jugador" => "daniela", "intentos" => 2, "puntaje" => 13];
    $coleccionPartidas[4] = ["palabraWordix" => "RASGO", "jugador" => "luisa", "intentos" => 4, "puntaje" => 10];
    $coleccionPartidas[5] = ["palabraWordix" => "GATOS", "jugador" => "pablo", "intentos" => 1, "puntaje" => 13];
    $coleccionPartidas[6] = ["palabraWordix" => "GOTAS", "jugador" => "vanina", "intentos" => 6, "puntaje" => 8];
    $coleccionPartidas[7] = ["palabraWordix" => "HUEVO", "jugador" => "veronica", "intentos" => 5, "puntaje" => 8];
    $coleccionPartidas[8] = ["palabraWordix" => "TINTO", "jugador" => "alejandro", "intentos" => 1, "puntaje" => 14];
    $coleccionPartidas[9] = ["palabraWordix" => "NAVES", "jugador" => "ana", "intentos" => 0, "puntaje" => 0];
    $coleccionPartidas[10] = ["palabraWordix" => "VERDE", "jugador" => "luisa", "intentos" => 2, "puntaje" => 12];
    $coleccionPartidas[11] = ["palabraWordix" => "MELON", "jugador" => "trinidad", "intentos" => 3, "puntaje" => 10];
    $coleccionPartidas[12] = ["palabraWordix" => "YUYOS", "jugador" => "pablo", "intentos" => 6, "puntaje" => 9];
    $coleccionPartidas[13] = ["palabraWordix" => "PIANO", "jugador" => "ana", "intentos" => 4, "puntaje" => 10];
    $coleccionPartidas[14] = ["palabraWordix" => "PISOS", "jugador" => "alejandro", "intentos" => 5, "puntaje" => 10];
    $coleccionPartidas[15] = ["palabraWordix" => "NEGRO", "jugador" => "luana", "intentos" => 2, "puntaje" => 12];
    $coleccionPartidas[16] = ["palabraWordix" => "PERRO", "jugador" => "jorge", "intentos" => 1, "puntaje" => 14];
    $coleccionPartidas[17] = ["palabraWordix" => "AMIGO", "jugador" => "guillermo", "intentos" => 4, "puntaje" => 8];
    $coleccionPartidas[18] = ["palabraWordix" => "DATOS", "jugador" => "vanina", "intentos" => 0, "puntaje" => 0];
    $coleccionPartidas[19] = ["palabraWordix" => "MESAS", "jugador" => "trinidad", "intentos" => 3, "puntaje" => 11];
    $coleccionPartidas[20] = ["palabraWordix" => "TECLA", "jugador" => "pedro", "intentos" => 6, "puntaje" => 7];
    $coleccionPartidas[21] = ["palabraWordix" => "PIEZA", "jugador" => "maría", "intentos" => 2, "puntaje" => 12];
    $coleccionPartidas[22] = ["palabraWordix" => "LAPIZ", "jugador" => "luana", "intentos" => 4, "puntaje" => 10];
    $coleccionPartidas[23] = ["palabraWordix" => "COLOR", "jugador" => "guillermo", "intentos" => 1, "puntaje" => 12];
    
    return $coleccionPartidas;
}

/**
 * Pide que se seleccione una de las opciones
 * De ser una opción fuera de la lista, se vuelve a pedir hasta que ingrese una correcta
 * @return array
 */
function seleccionarOpcion(){
    //array $menuOpciones
    //int $opcion
    print_r($menuOpciones = [
        "1) Jugar al Wordix con una palabra elegida",
        "2) Jugar al Wordix con una palabra aleatoria",
        "3) Mostrar una partida",
        "4) Mostrar la primer partida ganadora",
        "5) Mostrar resumen de Jugador",
        "6) Mostrar listado de partidas ordenadas por jugador y por palabra",
        "7) Agregar una palabra de 5 letras a Wordix",
        "8) Salir"
    ]);
    //Cartel para la selección de opción
    echo "Seleccionar una opción: ";
    $opcion = trim(fgets(STDIN));

    if($opcion >= 1 && $opcion <= 8){
        $opcion = $opcion - 1; //Le resto uno para que sea mas intuitivo para le usuario
        echo "Seleccionaste ";
        print_r($menuOpciones[$opcion]."\n");
    }else{
        //Si ingresa un opción no valida, vuelve a pedirla hasta que sea correcta
        while($opcion <= 0 || $opcion >= 9){
            echo "Seleccionar una opcion: ";
            $opcion = trim(fgets(STDIN));
        }
        $opcion = $opcion - 1;
        echo "Seleccionaste ";
        print_r($menuOpciones[$opcion]."\n");
    }
    return $opcion;
}
/** funcion resumen de jugador de todas las partidas que jugo el Jugador con nombre"x", se saca un resumen
 * parametros
 * @param array $estructuraPartidas
 * @param string $nombreJugador
 * @return array
 */
function resumenJugador($estructuraPartidas, $nombreJugador){
    /** int $cantPartidas,$puntajeTotal,$intento1,$intento2,$intento3,$intento,$intento5,$intento6,$derrotas,$elementos,$victorias
     * array $resumen
     */
    $cantPartidas=0;
    $puntajeTotal=0;
    $intento1=0;
    $intento2=0;
    $intento3=0;
    $intento4=0;
    $intento5=0;
    $intento6=0;
    $derrotas=0;
    $elementos= count($estructuraPartidas);
    for($i=0;$i<$elementos;$i++){
        if( $estructuraPartidas[$i]["nombre"]==$nombreJugador){
            $cantPartidas = $cantPartidas+1;
            $puntajeTotal=$puntajeTotal + $estructuraPartidas[$i]["puntaje"];
            switch($estructuraPartidas[$i]["intento"]){
                case 1: $intento1=$intento1 +1; break;
                case 2: $intento2=$intento2 +1; break;
                case 3: $intento3=$intento3 +1; break;
                case 4: $intento4=$intento4 +1; break;
                case 5: $intento5=$intento5 +1; break;
                case 6: $intento6=$intento6 +1; break;
                default: $derrotas= $derrotas +1;
            } 
            $i=$i+1;
        };
    };
    $victorias= $cantPartidas - $derrotas;
    $resumen=["nombre"=>$nombreJugador, "partidas"=> $cantPartidas, "puntaje"=>$puntajeTotal, "victorias"=>$victorias, "intento1"=>$intento1,
                "intento2"=>$intento2,"intento3"=>$intento3,"intento4"=>$intento4,"intento5"=>$intento5,"intento6"=>$intento6, ];
    return $resumen;
}
/**funcion de comparacion para uasort
 * @param array $partida1, $partida2
 * @return int 
 */
function cmp($partida1,$partida2){
    //int $orden
    if($partida1["jugador"]==$partida2["jugador"]){
        if($partida1["palabraWordix"]==$partida2["palabraWordix"]){
            $orden= 0;
        }elseif($partida1["palabraWordix"]>$partida2["palabraWordix"]){
            $orden=1;
        }else{
            $orden=-1;
        }
    }elseif($partida1["jugador"]>$partida2["jugador"]){
        $orden=1;
    }else{
        $orden=-1;
    }
    return $orden;
}
/**funcion mostrar coleccion ordena por nombre y palabra
 * @param array $estructuraPartidas
 */
function mostrarColeccion($estructuraPartidas){
    uasort($estructuraPartidas,'cmp');
    print_r($estructuraPartidas);
}
//consigna numero 5
/** la funcion pide un numero al usuario entre un rango de valores, 
    *si el usuario ingresa un numero que no es valido, vuelve a pedirlo, retorna un numero valido
*@param int $numero
*@return int
*/
function solicitarNumeroEntre($min, $max){
    //int $numero
    echo "ingrese un numero: ";
    $numero = trim(fgets(STDIN));
	if (is_numeric($numero)) { 
        $numero  = $numero * 1; 
    }
    while (!is_numeric($numero) ||( is_int($numero) && !($numero >= $min && $numero <= $max))) {
        echo "Debe ingresar un número entre " . $min . " y " . $max . ": ";
        $numero = trim(fgets(STDIN));
		if (is_numeric($numero)) {
			$numero  = $numero * 1; 
		}
    }
    return $numero;
}
/*$min1=0;
$max1=100;
$numeroRetorno=solicitarNumeroEntre($min1,$max1);
echo"el numero de retorno es: ".$numeroRetorno;*/

//consigna numero 6
/**Una función que, dado un número de partida, muestre en pantalla los datos de la partida
*@param array $estructuraPartida
*@return 
*/
function datosPartida($estructuraPartida1,$nPartida1){ 
    /*Int $nPartida, String $msj*/
    $msj="";
    $palabra1=$estructuraPartida1[$nPartida1]["palabraWordix"];
    $nombre1=$estructuraPartida1[$nPartida1]["jugador"];
    $puntaje1=$estructuraPartida1[$nPartida1]["puntaje"];
    $intentos1=$estructuraPartida1[$nPartida1]["intentos"];
    if($intentos1>6){
        $msj="No adivino la palabra";
    }else{
        $msj="Adivino la palabra en ".$intentos1." intentos";
    }
    /*$estructuraPartida1=[$palabra1,$nombre1,$puntaje1,$intentos1];*/
    echo"Partida WORDIX ".$nPartida1." : palabra ".$palabra1."\n";
    echo"Jugador: ".$nombre1."\n";
    echo"Puntaje: ".$puntaje1." puntos\n";
    echo"Intentos: ".$msj."\n";
    //if($intentos1>6)
    }
    //programa principal//
    /*$estructuraPartida = array();
    $estructuraPartida[0]= array("palabra"=> "MUJER" , "jugador" => "maria", "puntaje"=>13 , "intentos"=>4);
    $estructuraPartida[1]= array("palabra"=> "QUESO" , "jugador" => "pedro", "puntaje"=> 5 , "intentos"=>6);
    $estructuraPartida[2]= array("palabra"=> "HUEVO" , "jugador" => "jorge", "puntaje"=> 2 , "intentos"=>6);
    
    echo"ingrese el N° de partida que desea ver";
    $nPartida=trim(fgets(STDIN));
    datosPartida($estructuraPartida,$nPartida);*/

    //consigna numero 7
/** Una función agregarPalabra cuya entrada sea la colección de palabras y una palabra, y la función retorna
*la colección modificada al agregarse la nueva palabra
*@param array $coleccionPalabras
*@param string $nuevaPalabra
*return array
*/
function agregarPalabra($coleccionPalabras,$nuevaPalabra){
    //array $nuevaColeccion
    $i=0;
    $i=count($coleccionPalabras);
    $j=$i+1;
    $coleccionPalabras[$j]=$nuevaPalabra;
    return $coleccionPalabras;
}
function agregarPartida($coleccionPartidas,$partidaNueva){
    $i=0;
    $i=count($coleccionPartidas);
    $j=$i+1;
    $coleccionPalabras[$j]=$partidaNueva;
    return $coleccionPartidas;

}
//agregar al principal
/*echo" ingrese una palabra para agregar a la coleccion";
$nuevaPalabra=strtoupper(trim(fgets(STDIN)));*/

//consigna numero 8
/** una función que dada una colección de partidas y el nombre de un jugador, retorna el índice de la primera
*partida ganada por dicho jugador. Si el jugador ganó ninguna partida, la función debe retornar el valor -1.
*@param array $estructuraPartidas
*@param string $nombre1
*return Int
*/
function primerPartidaGanada($estructuraPartidas1,$nombre1){
    //int $j,$i,$indice
    $indice=0;
    $j=count($estructuraPartidas1);
    $i=0;
    while($i<$j){    
        if(($estructuraPartidas1[$i]["puntaje"]>0)&&($estructuraPartidas1[$i]["jugador"]==$nombre1)){
            $indice=$i;
            $i=$j;
        }elseif($estructuraPartidas1[$i]["puntaje"]==0){  
            $indice=-1;  
    }       
     $i=$i+1; 
    }    
    return $indice;
    }
/**
 *  **COMPLETAR**
 */

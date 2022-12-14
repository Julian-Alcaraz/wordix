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
function esPalabra($cadena){
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
 * Inicia una estructura de datos Teclado. La estructura es de tipo:  asociativo
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
 * Calcula el puntaje obtenido en la partida con una palabra especifica
 * @param int $intentos
 * @param string $palabra
 * @return int retorna el puntaje
 */
function obtenerPuntajeWordix($intentos, $palabra){
    //int $puntaje, $i
    //array $palabra[]
    //Se incializa el puntaje con 0
    $puntaje = 0;
    switch($intentos){//Empiezan las alternativa dados la cantidad de intentos
        case 1:
            $puntaje=$puntaje +6;
            break;
        case 2:
            $puntaje=$puntaje +5;
            break;
        case 3:
            $puntaje=$puntaje +4;
            break;
        case 4:
            $puntaje=$puntaje +3;
            break;
        case 5:
            $puntaje=$puntaje +2;
            break;
        case 6:
            $puntaje=$puntaje +1;
            break;
    }
    //Puntos dado el valor por letra
    for($i = 0; $i < strlen($palabra); $i++){ 
        //Recorre cuales de ellas son vocales
        if ($palabra[$i] == "A" || $palabra[$i] == "E" ||
        $palabra[$i] == "I" || $palabra[$i] == "O" ||
        $palabra[$i] == "U" ){
            $puntaje = $puntaje + 1;//Las vocales suman 1 punto cada una  
        //Recorre cuales son consonates anterirores a "M"(inclusive)
        }elseif ($palabra[$i] == "B" || $palabra[$i] == "C" ||
        $palabra[$i] == "D" || $palabra[$i] == "F" ||
        $palabra[$i] == "G" || $palabra[$i] == "H" ||
        $palabra[$i] == "J" || $palabra[$i] == "K" ||
        $palabra[$i] == "L" || $palabra[$i] == "M"){
            $puntaje = $puntaje + 2;//Las consonates anteriores a "M"(inclusive) suman 2 punto cada una
        //Recorre cuales son consonantes posteriores a "M"
        }elseif ($palabra[$i] == "N" || $palabra[$i] == "P" ||
        $palabra[$i] == "Q" || $palabra[$i] == "R" ||
        $palabra[$i] == "S" || $palabra[$i] == "T" ||
        $palabra[$i] == "V" || $palabra[$i] == "W" ||
        $palabra[$i] == "X" || $palabra[$i] == "Y" ||
        $palabra[$i] == "Z"){
            $puntaje = $puntaje + 3;//Las consonantes posteriores a "M" suman 3 puntos cada una
        }
    }
    //Retorna al int $puntaje
    return $puntaje;
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
        $puntaje = obtenerPuntajeWordix($nroIntento,$palabraIntento);
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
 * @return string 
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
        echo"el nombre ingresado no es valido\n";
        echo "Ingrese otro porfavor";
        $nombre = trim(fgets(STDIN));
    }
    }while(!$nombreBienIngresado);
return strtolower($nombre);
}

/**
 * Obtiene una colección de palabras
 * @return array coleccion palabras
 */
function cargarColeccionPalabras(){
    //array $cargarColeccionPalabras
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
    $coleccion = [];
    $pa1 = ["palabraWordix" => "SUECO", "jugador" => "kleiton", "intentos" => 0, "puntaje" => 0];
    $pa2 = ["palabraWordix" => "YUYOS", "jugador" => "briba", "intentos" => 0, "puntaje" => 0];
    $pa3 = ["palabraWordix" => "HUEVO", "jugador" => "zrack", "intentos" => 3, "puntaje" => 9];
    $pa4 = ["palabraWordix" => "TINTO", "jugador" => "cabrito", "intentos" => 4, "puntaje" => 8];
    $pa5 = ["palabraWordix" => "RASGO", "jugador" => "briba", "intentos" => 0, "puntaje" => 0];
    $pa6 = ["palabraWordix" => "VERDE", "jugador" => "cabrito", "intentos" => 5, "puntaje" => 7];
    $pa7 = ["palabraWordix" => "CASAS", "jugador" => "kleiton", "intentos" => 5, "puntaje" => 7];
    $pa8 = ["palabraWordix" => "GOTAS", "jugador" => "kleiton", "intentos" => 0, "puntaje" => 0];
    $pa9 = ["palabraWordix" => "ZORRO", "jugador" => "zrack", "intentos" => 4, "puntaje" => 8];
    $pa10=["palabraWordix" => "ZORRO", "jugador" => "julian", "intentos" => 0, "puntaje" => 0];
    $pa11 = ["palabraWordix" => "GOTAS", "jugador" => "cabrito", "intentos" => 0, "puntaje" => 0];
    $pa12 = ["palabraWordix" => "FUEGO", "jugador" => "cabrito", "intentos" => 2, "puntaje" => 10];
    $pa13 = ["palabraWordix" => "TINTO", "jugador" => "briba", "intentos" => 0, "puntaje" => 0];

    array_push($coleccion, $pa1, $pa2, $pa3, $pa4, $pa5, $pa6, $pa7, $pa8, $pa9, $pa10, $pa11, $pa12);
    
    return $coleccion;
}

/**
 * Pide que se seleccione una de las opciones
 * De ser una opción fuera de la lista, se vuelve a pedir hasta que ingrese una correcta
 * @return int numero de opcion
 */
function seleccionarOpcion(){
    //int $opcion
    echo"
    Seleccione una opcion
        1) Jugar al Wordix con una palabra elegida 
        2) Jugar al Wordix con una palabra aleatoria
        3) Mostrar una partida
        4) Mostrar la primer partida ganadora
        5) Mostrar resumen de Jugador
        6) Mostrar listado de partidas ordenadas por jugador y por palabra
        7) Agregar una palabra de 5 letras a Wordix
        8) Salir\n";
    //Cartel para la selección de opción
    $opcion = trim(fgets(STDIN));

    if($opcion < 1 && $opcion > 8){
        //Si ingresa un opción no valida, vuelve a pedirla hasta que sea correcta
        while($opcion <= 0 || $opcion >= 9){
            echo "Seleccionar una opcion valida: ";
            $opcion = trim(fgets(STDIN));
        }
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
    //acumulador
    $puntajeTotal=0;
    //inico contadores
    $cantPartidas=0;
    $intento1=0;
    $intento2=0;
    $intento3=0;
    $intento4=0;
    $intento5=0;
    $intento6=0;
    $derrotas=0;

    $elementos= count($estructuraPartidas);//cuento la cantidad de elementos del arreglo
    for($i=0;$i<$elementos;$i++){
        if( ($estructuraPartidas[$i]["jugador"])==$nombreJugador){
            $cantPartidas = $cantPartidas+1;
            $puntajeTotal=$puntajeTotal + $estructuraPartidas[$i]["puntaje"];
            switch($estructuraPartidas[$i]["intentos"]){
                case 1: $intento1=$intento1 +1; break;
                case 2: $intento2=$intento2 +1; break;
                case 3: $intento3=$intento3 +1; break;
                case 4: $intento4=$intento4 +1; break;
                case 5: $intento5=$intento5 +1; break;
                case 6: $intento6=$intento6 +1; break;
                default: $derrotas= $derrotas +1;
            } 
            //$i=$i+1;
        };
    };
    $victorias= $cantPartidas - $derrotas;
    $resumen=["nombre"=>$nombreJugador, "partidas"=> $cantPartidas, "puntaje"=>$puntajeTotal, "victorias"=>$victorias, "intento1"=>$intento1,
                "intento2"=>$intento2,"intento3"=>$intento3,"intento4"=>$intento4,"intento5"=>$intento5,"intento6"=>$intento6, ];
    return $resumen;
}
/**funcion de comparacion para uasort ordena por nombre y por palabra
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

/** la funcion pide un numero al usuario entre un rango de valores, 
    *si el usuario ingresa un numero que no es valido, vuelve a pedirlo, retorna un numero valido
*@param int $min
*@param int $max
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



/**Una función que, dado un número de partida, muestre en pantalla los datos de la partida
* @param array $estructuraPartida
*/
function datosPartida($estructuraPartida1,$nPartida1){ 
    /*Int $nPartida, $puntaje1,$intentos1
     String $msj, $palabra1*/
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
    echo"******************************************************************\n";
    echo"Partida WORDIX ".$nPartida1." : palabra ".$palabra1."\n";
    echo"Jugador: ".$nombre1."\n";
    echo"Puntaje: ".$puntaje1." puntos\n";
    echo"Intentos: ".$msj."\n";
    echo"******************************************************************";
}
/** la funcion agrega la palabra a la coleccion de palabras
 * @param array $coleccion
 * @param string $palabra 
 * @return array
 */
function agregarPalabra($coleccion,$palabra){
    //int $i, $j
    $j=count($coleccion);
    for($i=0;$i<$j;$i++){
        if($coleccion[$i]==$palabra){
            echo "Palabra ya ingresada, porfavor ingrese otra palabra";
            $palabra=leerPalabra5Letras();
            $i=-1;
        }
    }
    array_push($coleccion, $palabra);
    echo"Su palabra fue agregada con exito\n";
    return $coleccion;
}

/** una función que dada una colección de partidas y el nombre de un jugador, retorna el índice de la primera
*partida ganada por dicho jugador. Si el jugador no ganó ninguna partida, la función debe retornar el valor -1.
*@param array $estructuraPartidas
*@param string $nombre1
*@return Int
*/
function primerPartidaGanada($estructuraPartidas1,$nombre1){
    //int $j,$i,$indice
    $indice=0;
    $j=count($estructuraPartidas1);
    $i=0;
    $bandera=true;
    $jugoPartidaPerdio=false;
    while(($i<$j) && $bandera){    
        if(($estructuraPartidas1[$i]["puntaje"]>0)&&($estructuraPartidas1[$i]["jugador"]==$nombre1)){
            $indice=$i;
            $bandera=false;
        }elseif(($estructuraPartidas1[$i]["puntaje"]==0)&&($estructuraPartidas1[$i]["jugador"]==$nombre1)){ 
            $jugoPartidaPerdio=true;
        }
     $i=$i+1; 
    } 
    if(($jugoPartidaPerdio==true) && ($bandera==true)){
        $indice=-1;
    } else{
        $indice=-2;
    }
    return $indice;
    }
/**ingresa una palabra y un jugador a la coleccion de partidas y la funcion se encarga de verificar que 
 * no se vuelva a repetir la misma palabra para el mismo jugador**
 * @param array $coleccionPartidas
 * @param string $palabra
 * @param string $jugador
 * @return Boolean
 */
function verificarPalabra($coleccionPartidas, $palabra,$jugador,){
    $validez=true;
    $i=0;
    $elementos=count($coleccionPartidas);
    while($i<$elementos&& $validez){
        if($coleccionPartidas[$i]["jugador"] == $jugador && $coleccionPartidas[$i]["palabraWordix"] ==$palabra){ 
            echo "Palabra ya usada ";
            $validez=FALSE;
        }
        $i++;
    }
    return $validez; 

} 
/**muestra el resumen de un jugador
 * @param array $datosResumen 
 */
function mostrarResumen($datosResumen){
    //float $porcentaje
    echo"************************************************\n";
            if($datosResumen["partidas"]!=0){
            $porcentaje=$datosResumen["victorias"]*100/$datosResumen["partidas"];
            echo"Jugador: ".$datosResumen["nombre"]."\n";
            echo"Partidas: ".$datosResumen["partidas"]."\n";
            echo"Puntaje Total: ".$datosResumen["puntaje"]."\n";
            echo"Victorias: ".$datosResumen["victorias"]." ";
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
}
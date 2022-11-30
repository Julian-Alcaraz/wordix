<?php
/**
 * Calcula el puntaje obtenido en la partida con una palabra especifica
 * @param int $intentos
 * @param string $palabra
 */
function obtenerPuntajeWordix(int $intentos, string $palabra){
    //int $puntaje, $i
    //array $palabra[]

    //Se incializa el puntaje con 0
    $puntaje = 0;

    //Empiezan las alternativa dados la cantidad de intentos
    if($intentos == 6){ //Primera alternativa si se hizo en 6 intentos

        //strlen calcula la cantidad de caracteres de un string
        //Luego se hace el recorrido del string como un array
        for($i = 0; $i < $palabra; $i++){

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
                $puntaje = $puntaje + 1;//Las consonates anteriores a "M"(inclusive) suman 1 punto cada una

            //Recorre cuales son consonantes posteriores a "M"
            }elseif ($palabra[$i] == "N" || $palabra[$i] == "P" ||
            $palabra[$i] == "Q" || $palabra[$i] == "R" ||
            $palabra[$i] == "S" || $palabra[$i] == "T" ||
            $palabra[$i] == "V" || $palabra[$i] == "W" ||
            $palabra[$i] == "X" || $palabra[$i] == "Y" ||
            $palabra[$i] == "Z"){
                $puntaje = $puntaje + 2;//Las consonantes posteriores a "M" suman 2 puntos cada una
            }
        }
        //Si se resulve en 6 intentos suma 1 punto
        $puntaje = $puntaje + 1;

    }elseif($intentos == 5){ //Segunda alternativa si se hizo en 5 intentos

        //strlen calcula la cantidad de caracteres de un string
        //Luego se hace el recorrido del string como un array
        for($i = 0; $i < $palabra; $i++){

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
                $puntaje = $puntaje + 1;//Las consonates anteriores a "M"(inclusive) suman 1 punto cada una
            
            //Recorre cuales son consonantes posteriores a "M"
            }elseif ($palabra[$i] == "N" || $palabra[$i] == "P" ||
            $palabra[$i] == "Q" || $palabra[$i] == "R" ||
            $palabra[$i] == "S" || $palabra[$i] == "T" ||
            $palabra[$i] == "V" || $palabra[$i] == "W" ||
            $palabra[$i] == "X" || $palabra[$i] == "Y" ||
            $palabra[$i] == "Z"){
                $puntaje = $puntaje + 2;//Las consonantes posteriores a "M" suman 2 puntos cada una
            }
        }
        //Si se resulve en 5 intentos suma 2 puntos
        $puntaje = $puntaje + 2;

    }elseif($intentos == 4){ //Tercera alternativa si se hizo en 4 intentos

        //strlen calcula la cantidad de caracteres de un string
        //Luego se hace el recorrido del string como un array
        for($i = 0; $i < $palabra; $i++){
            
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
                $puntaje = $puntaje + 1;//Las consonates anteriores a "M"(inclusive) suman 1 punto cada una
            
            //Recorre cuales son consonantes posteriores a "M"
            }elseif ($palabra[$i] == "N" || $palabra[$i] == "P" ||
            $palabra[$i] == "Q" || $palabra[$i] == "R" ||
            $palabra[$i] == "S" || $palabra[$i] == "T" ||
            $palabra[$i] == "V" || $palabra[$i] == "W" ||
            $palabra[$i] == "X" || $palabra[$i] == "Y" ||
            $palabra[$i] == "Z"){
                $puntaje = $puntaje + 2;//Las consonantes posteriores a "M" suman 2 puntos cada una
            }
        }
        //Si se resulve en 4 intentos suma 3 puntos
        $puntaje = $puntaje + 3;

    }elseif($intentos == 3){ //Cuarta alternativa si se hizo en 3 intentos
        
        //strlen calcula la cantidad de caracteres de un string
        //Luego se hace el recorrido del string como un array
        for($i = 0; $i < $palabra; $i++){
            
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
                $puntaje = $puntaje + 1;//Las consonates anteriores a "M"(inclusive) suman 1 punto cada una
            
            //Recorre cuales son consonantes posteriores a "M"
            }elseif ($palabra[$i] == "N" || $palabra[$i] == "P" ||
            $palabra[$i] == "Q" || $palabra[$i] == "R" ||
            $palabra[$i] == "S" || $palabra[$i] == "T" ||
            $palabra[$i] == "V" || $palabra[$i] == "W" ||
            $palabra[$i] == "X" || $palabra[$i] == "Y" ||
            $palabra[$i] == "Z"){
                $puntaje = $puntaje + 2;//Las consonantes posteriores a "M" suman 2 puntos cada una
            }
        }
        //Si se resulve en 3 intentos suma 4 puntos
        $puntaje = $puntaje + 4;

    }elseif($intentos == 2){ //Quinta alternativa si se hizo en 2 intentos
        
        //strlen calcula la cantidad de caracteres de un string
        //Luego se hace el recorrido del string como un array
        for($i = 0; $i < $palabra; $i++){
            
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
                $puntaje = $puntaje + 1;//Las consonates anteriores a "M"(inclusive) suman 1 punto cada una
            
            //Recorre cuales son consonantes posteriores a "M"
            }elseif ($palabra[$i] == "N" || $palabra[$i] == "P" ||
            $palabra[$i] == "Q" || $palabra[$i] == "R" ||
            $palabra[$i] == "S" || $palabra[$i] == "T" ||
            $palabra[$i] == "V" || $palabra[$i] == "W" ||
            $palabra[$i] == "X" || $palabra[$i] == "Y" ||
            $palabra[$i] == "Z"){
                $puntaje = $puntaje + 2;//Las consonantes posteriores a "M" suman 2 puntos cada una
            }
        }
        //Si se resulve en 2 intentos suma 5 puntos
        $puntaje = $puntaje + 5;

    }elseif($intentos == 1){ //Sexta alternativa si se hizo en 1 intento
        
        //strlen calcula la cantidad de caracteres de un string
        //Luego se hace el recorrido del string como un array
        for($i = 0; $i < $palabra; $i++){
            
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
                $puntaje = $puntaje + 1;//Las consonates anteriores a "M"(inclusive) suman 1 punto cada una
            
            //Recorre cuales son consonantes posteriores a "M"
            }elseif ($palabra[$i] == "N" || $palabra[$i] == "P" ||
            $palabra[$i] == "Q" || $palabra[$i] == "R" ||
            $palabra[$i] == "S" || $palabra[$i] == "T" ||
            $palabra[$i] == "V" || $palabra[$i] == "W" ||
            $palabra[$i] == "X" || $palabra[$i] == "Y" ||
            $palabra[$i] == "Z"){
                $puntaje = $puntaje + 2;//Las consonantes posteriores a "M" suman 2 puntos cada una
            }
        }
        //Si se resulve en 2 intentos suma 6 puntos
        $puntaje = $puntaje + 6;

    }else{ //Séptima alternativa si no resolvió la palabra
        //Suma 0 puntos
        $puntaje = 0;
    }
    
    //Retorna al int $puntaje
    return $puntaje;
}
echo"ingrese intentos";
$intentos1=trim(fgets(STDIN));
echo "ingrese palabra";
$palabra1=trim(fgets(STDIN));
$puntaje1=obtenerPuntajeWordix($intentos1,$palabra1);
echo" su puntaje es: ".$puntaje;
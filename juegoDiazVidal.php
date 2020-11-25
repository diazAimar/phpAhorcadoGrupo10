<?php
/******************************************
DIAZ AIMAR, FEDERICO; FAI-2859
VIDAL, ADRIAN SANTIAGO; FAI-2758
******************************************/
/* REPOSITORIOS: 

https://github.com/diazAimar/phpAhorcadoGrupo10
https://github.com/Santiago-FAI/phpAhorcadoGrupo10 */


/**
* genera un arreglo de palabras para jugar
* @return array
*/
function cargarPalabras(){
  $coleccionPalabras = array();
  $coleccionPalabras[0]= array("palabra"=> "papa" , "pista" => "se cultiva bajo tierra", "puntosPalabra"=>4);
  $coleccionPalabras[1]= array("palabra"=> "hepatitis" , "pista" => "enfermedad que inflama el higado", "puntosPalabra"=> 9);
  $coleccionPalabras[2]= array("palabra"=> "volkswagen" , "pista" => "marca de vehiculo", "puntosPalabra"=> 9);
  $coleccionPalabras[3]= array("palabra"=>"bariloche", "pista"=> "Ciudad turística patagónica", "puntosPalabra" => 9);
  $coleccionPalabras[4]= array("palabra" => "alemania", "pista"=>"pais de Europa", "puntosPalabra"=> 8);
  $coleccionPalabras[5]= array("palabra" => "eolica", "pista"=>"tipo de generación electrica","puntosPalabra" => 6);
  $coleccionPalabras[6]= array("palabra" => "ukelele","pista"=>"instrumento de cuerdas", "puntosPalabra" => 7);
  return $coleccionPalabras;
}

/**
* genera un arreglo con las partidas ya jugadas
* @return array
*/
function cargarJuegos(){
	$coleccionJuegos = array();
	$coleccionJuegos[0] = array("puntos"=> 0, "indicePalabra" => 1);
	$coleccionJuegos[1] = array("puntos"=> 10,"indicePalabra" => 2);
    $coleccionJuegos[2] = array("puntos"=> 0, "indicePalabra" => 1);
    $coleccionJuegos[3] = array("puntos"=> 8, "indicePalabra" => 0);
    $coleccionJuegos[4] = array("puntos"=> 9, "indicePalabra" => 5);
    $coleccionJuegos[5] = array("puntos"=> 11, "indicePalabra" => 4);
    $coleccionJuegos[6] = array("puntos"=> 8, "indicePalabra" => 6);   
    return $coleccionJuegos;
}

/**
* a partir de la palabra genera un arreglo para determinar si sus letras fueron o no descubiertas
* @param string $palabra
* @return array
*/
function dividirPalabraEnLetras($palabra){
    $coleccionLetras=array ();
    for ($i=0; $i<strlen($palabra);$i++ ){
        $coleccionLetras[$i]=array ("letra" => $palabra[$i], "descubierta"=> false);
    }
    return $coleccionLetras;
}

/**
* revisa si la opcion elegida por el usuario es valida o no.
* @return boolean
*/

function esOpcionValida($opcionVerif) {
    $esValida = false;
    if ($opcionVerif >= 1 && $opcionVerif <= 8) {
        $esValida = true;
    }
    return $esValida;
}

/**
* muestra y obtiene una opcion de menú ***válida***
* @return int
*/
function seleccionarOpcion(){
    echo "--------------------------------------------------------------\n";
    echo "\n( 1 ) Jugar con una palabra aleatoria."; 
    echo "\n( 2 ) Jugar con una palabra elegida.";
    echo "\n( 3 ) Agregar una palabra al listado.";
    echo "\n( 4 ) Mostrar la informacion completa de un número de juego.";
    echo "\n( 5 ) Mostrar la informacion completa del primer juego con mas puntaje.";
    echo "\n( 6 ) Mostrar la informacion completa del primer juego que supere un puntaje indicado por el usuario.";
    echo "\n( 7 ) Mostrar la lista de palabras ordenada por orden alfabético.";
    echo "\n( 8 ) Salir del juego.";
    echo "\n";
    do {
        echo "\nIngrese una opcion: ";
        $opcion = trim(fgets(STDIN));
        if (!esOpcionValida($opcion)) {
            echo "Opcion invalida. Ingrese una opcion entre 1 y 8.";
        }
    } while (!esOpcionValida($opcion));
    echo "--------------------------------------------------------------\n";
    return $opcion;
}

/**
* Determina si una palabra existe en el arreglo de palabras
* @param array $coleccionPalabras
* @param string $palabra
* @return boolean
*/
function existePalabra($coleccionPalabras,$palabra){
    $i=0;
    $cantPal = count($coleccionPalabras);
    $existe = false;
    while($i<$cantPal && !$existe){
        $existe = $coleccionPalabras[$i]["palabra"] == $palabra;
        $i++;
    }
    return $existe;
}


/**
* Determina si una letra existe en el arreglo de letras
* @param array $coleccionLetras
* @param string $letra
* @return boolean
*/
function existeLetra($coleccionLetras,$letra){
    $existeLet=false;
    for($i=0;$i<count($coleccionLetras);$i++){
        if ($coleccionLetras[$i]["letra"]==$letra){
            $existeLet=true;
        }
    }
    return ($existeLet);
}

/**
* Solicita los datos correspondientes a un elemento de la coleccion de palabras: palabra, pista y puntaje. 
* Internamente la función también verifica que la palabra ingresada por el usuario no exista en la colección de palabras.
* @param array $coleccionPalabras
* @return array  colección de palabras modificada con la nueva palabra.
*/


function agregarPalabra($coleccionPalabras) {
    $n = count($coleccionPalabras);
    echo "Ingrese la palabra que desea agregar al juego: ";
    $palabraNueva = strtolower(trim(fgets(STDIN)));
    if (existePalabra($coleccionPalabras, $palabraNueva)) {
        echo "Esa palabra ya existe. \n";
    } else {
        $coleccionPalabras[$n]["palabra"] = $palabraNueva;
        echo "Ingrese la pista: ";
        $pistaNueva = trim(fgets(STDIN));
        $coleccionPalabras[$n]["pista"] = $pistaNueva;
        echo "Ingrese la cantidad de puntos que otorga la palabra '" . $palabraNueva . "': ";
        $puntospalabraNueva = trim(fgets(STDIN));
        $coleccionPalabras[$n]["puntosPalabra"] = $puntospalabraNueva;
    }
    return $coleccionPalabras;
}


/**
* Obtener indice aleatorio
* Determina un numero aleatorio para la eleccion de la palabra.
*/
function indiceAleatorioEntre($min,$max){
    $i = rand($min,$max);
    /*>>> documente qué hace la función rand según el manual php.net en internet <<<*/
    /* La función rand genera un valor aleatorio.
     int rand ( [int min [, int max]]) \linebreak
     Si es llamada sin los argumentos opcionales min y max, rand() devuelve un valor pseudo-aleatorio entre
     0 y RAND_MAX. Si quiere un número aleatorio entre 5 y 15 (inclusive), por ejemplo, use rand(5,15).
     */
    
    
    return $i;
}

/**
* solicitar un valor entre min y max
* @param int $min
* @param int $max
* @return int
*/
function solicitarIndiceEntre($min,$max){ 
    do{
        echo "Seleccione un valor entre $min y $max: ";
        $i = trim(fgets(STDIN));
    }while(!($i>=$min && $i<=$max));
    return $i;
}



/**
* Determinar si la palabra fue descubierta, es decir, todas las letras fueron descubiertas
* @param array $coleccionLetras
* @return boolean
*/
function palabraDescubierta($coleccionLetrasMod){
    $p=0;
    $descubierta=false;
    for ($j=0; $j< count($coleccionLetrasMod); $j++){
        if($coleccionLetrasMod[$j]["descubierta"]==true){
            $p++;//contador de true en descubierta.
        }
        if($p==count($coleccionLetrasMod)){
            // si $p=count(coleccionLetrasMod) sisgnifica que todas la letras fueron descubiertas, todas true.
            $descubierta=true;
        }
    }
    return($descubierta);
}

/**
* La funcion le pide ingresar una letra al usuario. QUE MAS?
* /*>>> Completar documentacion <<<
*/
function solicitarLetra(){
    $letraCorrecta = false;
    do{
        echo "\nIngrese una letra: ";
        $letra = strtolower(trim(fgets(STDIN)));
        if(strlen($letra)!=1){
            echo "Debe ingresar 1 letra!\n";
        }else{
            $letraCorrecta = true;
        }
    }while(!$letraCorrecta);
    return $letra;
}

/**
* Descubre todas las letras de la colección de letras iguales a la letra ingresada.
* Devuelve la coleccionLetras modificada, con las letras descubiertas
* @param array $coleccionLetras
* @param string $letra
* @return array colección de letras modificada.
*/
function destaparLetra($coleccionLetras, $letra){
    for ($i=0;$i<count($coleccionLetras);$i++){
        if($letra==$coleccionLetras[$i]["letra"]){
            $coleccionLetras[$i]["descubierta"]=true;
        }
    }
    return($coleccionLetras);
}

/**
* obtiene la palabra con las letras descubiertas y * (asterisco) en las letras no descubiertas. Ejemplo: he**t*t*s
* @param array $coleccionLetras
* @return string  Ejemplo: "he**t*t*s"
*/
function stringLetrasDescubiertas($coleccionLetras,$letra){
    
    for ($i=0;$i<count($coleccionLetras);$i++){
        if($letra==$coleccionLetras[$i]["letra"]){
            
            $coleccionLetras[$i]["descubierta"]=true;
        }
        if($coleccionLetras[$i]["descubierta"]==true){
            
            echo $coleccionLetras[$i]["letra"];
        }
        else{echo "*";}
    }
}

/**
* Obtiene una expresión gráfica del estado del juego.
* @param int $cantidadDeIntentos
*/
function imprimirAhorcado ($cantidadDeIntentos) {
    switch($cantidadDeIntentos) {
        case 6:
            echo "\n+-----+";
            echo "\n|     ";
            echo "\n|     ";
            echo "\n|     " ;
            echo "\n| ";
            echo "\n| ";
            echo "\n---";
        break;
        case 5: 
            echo "\n+-----+";
            echo "\n|     O";
            echo "\n|     ";
            echo "\n|     " ;
            echo "\n| ";
            echo "\n| ";
            echo "\n---";
        break;
        case 4: 
            echo "\n+-----+";
            echo "\n|     O";
            echo "\n|    / ";
            echo "\n|     " ;
            echo "\n| ";
            echo "\n| ";
            echo "\n---";
        break;
        case 3: 
            echo "\n+-----+";
            echo "\n|     O";
            echo "\n|    /|";
            echo "\n|     " ;
            echo "\n| ";
            echo "\n| ";
            echo "\n---";
        break;
        case 2: 
            echo "\n+-----+";
            echo "\n|     O";
            echo "\n|    /|\ ";
            echo "\n|     " ;
            echo "\n| ";
            echo "\n| ";
            echo "\n---";
        break;
        case 1: 
            echo "\n+-----+";
            echo "\n|     O";
            echo "\n|    /|\ ";
            echo "\n|    / " ;
            echo "\n| ";
            echo "\n| ";
            echo "\n---";
        break;
        case 0: 
            echo "\n+-----+";
            echo "\n|     O";
            echo "\n|    /|\ ";
            echo "\n|    / \ " ;
            echo "\n| ";
            echo "\n| ";
            echo "\n---";
        break;
    }
}

/**
* Desarrolla el juego y retorna el puntaje obtenido
* Si descubre la palabra se suma el puntaje de la palabra más la cantidad de intentos que quedaron
* Si no descubre la palabra el puntaje es 0.
* @param array $coleccionPalabras
* @param int $indicePalabra
* @param int $cantIntentos
* @return int puntaje obtenido
*/
function jugar($coleccionPalabras,$indicePalabra, $cantIntentos){    
    $fuePalabraDescubierta=false;
    $pal = $coleccionPalabras[$indicePalabra]["palabra"];
    $coleccionLetras = dividirPalabraEnLetras($pal);
    $puntaje = 0;
    echo "PISTA: " . $coleccionPalabras[$indicePalabra]["pista"] . "\n";
  //  $coleccionLetras2=$coleccionLetras;
    do{
        echo "\nCantidad de intentos restantes: " . $cantIntentos . "\n";
        $letra=solicitarLetra();
        $perteneceLetra=false;
        $perteneceLetra= existeLetra($coleccionLetras,$letra);
        if(!$perteneceLetra) {
            $cantIntentos=$cantIntentos-1;
        }
        echo stringLetrasDescubiertas($coleccionLetras,$letra);
        $coleccionLetras=destaparLetra($coleccionLetras,$letra);
        $fuePalabraDescubierta=palabraDescubierta($coleccionLetras);
        imprimirAhorcado($cantIntentos);
        if ($perteneceLetra) {
            echo "\nLa letra " . $letra . " es correcta!";
        } else echo "\nLa letra " . $letra . " es incorrecta.";
    } while($cantIntentos>0 && $fuePalabraDescubierta==false);    
    if($fuePalabraDescubierta){
        //obtener puntaje:
        $puntaje = $coleccionPalabras[$indicePalabra]["puntosPalabra"] + $cantIntentos;
        echo "\n¡¡¡¡¡¡GANASTE ".$puntaje." puntos!!!!!!\n";
    }
    else{
        echo "\n¡¡¡¡¡¡AHORCADO AHORCADO!!!!!!\n";
    }
    return $puntaje;
}

/**
* Agrega un nuevo juego al arreglo de juegos
* @param array $coleccionJuegos
* @param int $ptos
* @param int $indicePalabra
* @return array coleccion de juegos modificada
*/
function agregarJuego($coleccionJuegos,$puntos,$indicePalabra){
    $coleccionJuegos[] = array("puntos"=> $puntos, "indicePalabra" => $indicePalabra);    
    return $coleccionJuegos;
}

/**
* Muestra los datos completos de un registro en la colección de palabras
* @param array $coleccionPalabras
* @param int $indicePalabra
*/
function mostrarPalabra($coleccionPalabras,$indicePalabra){
    //$coleccionPalabras[0]= array("palabra"=> "papa" , "pista" => "se cultiva bajo tierra", "puntosPalabra"=>7);
    echo "Palabra: " .$coleccionPalabras[$indicePalabra]["palabra"] . "\n";
    echo "Pista: " .$coleccionPalabras[$indicePalabra]["pista"] . "\n";
    echo "Puntos que da la palabra: " .$coleccionPalabras[$indicePalabra]["puntosPalabra"] . "\n";
}


/**
* Muestra los datos completos de un juego
* @param array $coleccionJuegos
* @param array $coleccionPalabras
* @param int $indiceJuego
*/
function mostrarJuego($coleccionJuegos,$coleccionPalabras,$indiceJuego){
    //array("puntos"=> 8, "indicePalabra" => 1)
    echo "\n\n";
    echo "<-<-< Juego ".($indiceJuego)." >->->\n";
    echo "Puntos ganados: ".$coleccionJuegos[$indiceJuego]["puntos"]."\n";
    echo "Información de la palabra:\n";
    mostrarPalabra($coleccionPalabras,$coleccionJuegos[$indiceJuego]["indicePalabra"]);
    echo "\n";
}

/**
* Determina el juego que supera un puntaje indicado por el usuario
* @param int $puntaje
* @param array $coleccionJuegos
* @return int;
*/
function superaPuntajeIndicado($puntaje,$coleccionJuegos){
    $i = 0;
    $indice = -1;
    do {
        if ($puntaje < $coleccionJuegos[$i]["puntos"]) {                
            $indice = $i;
        }
        $i++;
    } while ($puntaje >= $coleccionJuegos[$i-1]["puntos"] && $i < count($coleccionJuegos));
    return $indice;
}

/**
* Muestra las palabras ordenadas por orden alfabético
* @param array $coleccionPalabras
*/
function mostrarPalabrasOrdenadas($coleccionPalabras) {
    sort($coleccionPalabras);
    for ($i = 0; $i < count($coleccionPalabras) ; $i++) {
        echo $i+1 . ": ";
        print_r($coleccionPalabras[$i]["palabra"]);
        echo "\n";
    }
}

/** 
* Determina el indice del juego con mayor puntaje de la colección de juegos.
* @param array $coleccionJuegos
* @return int;
*/
function buscarIndiceMayorPuntaje($coleccionJuegos) {
    $mayorPuntaje = -1;
    $indice = -1;
    for ($i = 0; $i < count($coleccionJuegos); $i++) {
        if ($coleccionJuegos[$i]["puntos"] > $mayorPuntaje) {
            $mayorPuntaje = $coleccionJuegos[$i]["puntos"];
            $indice = $i;
        }
    }
    return $indice;
}

$arregloPalabras = cargarPalabras();
$arregloJuegos = cargarJuegos();

/******************************************/
/************** PROGRAMA PRINCIAL *********/
/******************************************/
define("CANT_INTENTOS", 6); //Constante en php para cantidad de intentos que tendrá el jugador para adivinar la palabra.
do{
    $opcion = seleccionarOpcion();
    switch ($opcion) {
        // la funcion switch es similar al IF. Nos sirve para comparar la misma expresion o variable con muchos valores diferentes y ejecutar X parte de la instruccion dependiendo de esa comparacion.
        case 1: //Jugar con una palabra aleatoria
            $min=0;
            $max=count($arregloPalabras);       
            $indiceBuscado=indiceAleatorioEntre($min, $max);        
            $puntos = jugar($arregloPalabras,$indiceBuscado,CANT_INTENTOS);
            $arregloJuegos = agregarJuego($arregloJuegos,$puntos,$indiceBuscado);
            break;
        case 2: 
            echo "Ingrese el indice de la palabra con la que desea jugar: ";
            $indiceBuscado = trim(fgets(STDIN));
            if (is_numeric($indiceBuscado)) {
                if ($indiceBuscado >= 0 && $indiceBuscado < count($arregloPalabras)){ 
                    $puntos = jugar($arregloPalabras, $indiceBuscado, CANT_INTENTOS);
                    $arregloJuegos = agregarJuego($arregloJuegos,$puntos,$indiceBuscado);
                }
            }
            else echo "Ha ingresado un indice incorrecto.\n";

            break;
        case 3: //Agregar una palabra al listado
            $arregloPalabras = agregarPalabra($arregloPalabras);
            break;
        case 4: //Mostrar la información completa de un número de juego
            echo "Ingrese número de juego: ";
            $numJuego=trim(fgets(STDIN));
            if (is_numeric($numJuego) && $numJuego >= 0 && $numJuego<count($arregloJuegos)) {
                mostrarJuego($arregloJuegos,$arregloPalabras,$numJuego);
            }
            else {
                echo "El numero de juego ingresado no pertenece a la lista de juegos o no ingreso un numero. \n";
                echo "Ingrese un valor entre 0 y " . count($arregloJuegos) . "\n";
            }        
            
            break;
        case 5: //Mostrar la información completa del primer juego con más puntaje\
            $indiceBuscado = buscarIndiceMayorPuntaje($arregloJuegos);
            mostrarJuego($arregloJuegos,$arregloPalabras,$indiceBuscado);
            break;
        case 6: //Mostrar la información completa del primer juego que supere un puntaje indicado por el usuario
            echo "Ingrese la cantidad de puntos que desea buscar: ";
            $puntajeBuscado = trim(fgets(STDIN));
            if (is_numeric($puntajeBuscado)) {
                $indiceBuscado = superaPuntajeIndicado($puntajeBuscado,$arregloJuegos);
                if ($indiceBuscado != -1) {
                    echo "\nEl juego con mayor puntos que " . $puntajeBuscado . " es el juego numero " . ($indiceBuscado). ".\n";
                    mostrarJuego($arregloJuegos,$arregloPalabras,$indiceBuscado);
                }
                else echo "\nNo hay ningun juego que supere los " . $puntajeBuscado . " puntos.\n";
            }
            else echo "No ha ingresado un numero. \n";

            break;
        case 7: //Mostrar la lista de palabras ordenada por orden alfabetico      
            echo "La lista de palabras ordenadas por orden alfabetico: \n";
            $arregloPalabrasAux = $arregloPalabras; 
            mostrarPalabrasOrdenadas($arregloPalabrasAux);
            break;
            
        }
    }while($opcion != 8);


<?php

/*************************************************************************************/
//Una función nos va  a servir para realizar procesos que se van a usar más de una vez.

//Su estructura es la siguiente:
function nombreDeLaFuncion(){
    //Código de la función
}


/*************************************************************************************/
//Vamos a realizar nuestra primera función
function saludar(){
    echo "Hola, ¿Cómo estás?";
}

saludar();
echo "<br>";

/*************************************************************************************/
//Las funciones pueden recibir parámetros, esto quiere decir que nosotros les podemos 
//dar datos para que los procesen.
function saludo($nombre){
    echo "Hola $nombre";
}

saludo('Carlos');
echo "<br>";


/*************************************************************************************/
//Las variables que pertenecen a una función solo viven dentro de esa función, y no las podemos 
//utilizar desde fuera de la función.
//echo $nombre;
//Podemos pasar tantos parámetros como necesitemos, estos deben ir separados por comas
function suma($a, $b){

    echo $a + $b;
}

suma(4,6);
echo "<br>";

/*************************************************************************************/
//Las funciones pueden retornar el valor en vez de imprimirlo, este valor que se regresa 
//lo tenemos que asignar a una variable para guardarlo.
//También lo podemos usar directamente en un echo
function multiplicacion($a, $b){
    return $a * $b;
    //Recordemos que las variables solo viven dentro de su función, así que a y b de multiplicacion son diferentes de a y b de suma
}

$resultado = multiplicacion(10,10);
echo $resultado;
echo "<br>";
echo multiplicacion(5,5);
echo "<br>";

//Tambien podemos pasar variables
$var1 = 3;
$var2 = 6;

echo multiplicación($var1, $var2);

?>

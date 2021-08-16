<?php
//Se define el archivo donde se va a escribir
$archivo = "escribir en txt.txt";
//se define el contenido a escribir
$contenido = "Este es otro contenido";
//se abre archivo
$manejador = fopen($archivo, 'a+');
//se escribe en el archivo
fwrite($manejador,$contenido);

?>

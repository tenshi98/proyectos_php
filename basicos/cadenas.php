<?php
//Diferentes usos de una cadena en php y como este la interpreta
echo "Soy una 'cadena'<br>";
echo 'Soy una "cadena"<br>';
echo "soy una \"cadena\" y estoy obligada<br>";
echo "yo soy una linea \n y yo soy otra";

//variables distintas
$mi = "mi nombre es ";
$nombre = "Jose Vicente";
$saludo = " y yo te saludo";

echo $mi.$nombre.$saludo;

//misma variable
$Nombre = "mi nombre es ";
$Nombre .= "Jose Vicente";
$Nombre .= " y yo te saludo";

echo $Nombre;
?>

<?php
//verifico la existencia
if ( !empty($_POST['id']) )        $id        = $_POST['id'];
if ( !empty($_POST['Artista']) )   $Artista   = $_POST['Artista'];
if ( !empty($_POST['Disco']) )     $Disco     = $_POST['Disco'];
if ( !empty($_POST['Anio']) )      $Anio      = $_POST['Anio'];

//Se crea la query
$a  = "id='".$id."'" ; 
$a .= ",Artista='".$Artista."'" ;
$a .= ",Disco='".$Disco."'" ;
$a .= ",Anio='".$Anio."'" ;
$query  = "UPDATE Discos SET ".$a." WHERE id = ".$id;

//se actualiza dato
$db        = new SQLite3('../database/db_biblioteca.db');
$sentencia = $db->prepare($query);
$result    = $sentencia->execute();
									
//redirijo					
header( 'Location: ../index.php' );
die;

?>

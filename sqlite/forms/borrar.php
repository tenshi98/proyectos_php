<?php
//verifico la existencia
if ( !empty($_GET['id']) ){
	
	//Se crea la query
	$query  = "DELETE FROM Discos WHERE id = ".$_GET['id'];
	
	//se borra dato
	$db        = new SQLite3('../database/db_biblioteca.db');
	$sentencia = $db->prepare($query);
	$result    = $sentencia->execute();
										
	//redirijo					
	header( 'Location: ../index.php' );
	die;
	
}
	


?>

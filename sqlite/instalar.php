<?php
//se borra la base de datos
unlink('database/db_biblioteca.db');
//se crea la base de datos
$db = new SQLite3('database/db_biblioteca.db');
//se crea la tabla
$db->exec('CREATE TABLE Discos (id int(11) NOT NULL , Artista Char(20) Not Null,Disco Char(40),Anio Integer)');
//redirijo					
header( 'Location: index.php' );
die;
?>

<?php
/************************ FUNCIONES ************************/
function fecha_actual(){
	// Establecer la zona horaria predeterminada a usar.
	date_default_timezone_set('America/Santiago');
	//Devolvemos la fecha actual dandole un formato
	return date("Y-m-d");
}
function hora_actual(){
	// Establecer la zona horaria predeterminada a usar.
	date_default_timezone_set('America/Santiago');
	//Devolvemos la hora actual dandole un formato
	return date("H:i:s");
}
function Fecha_archivos($Fecha){
	//Se verifica que se recibe algo
	if($Fecha!=''){
		$Fecha = str_replace('/', '-', $Fecha);
		//valido la fecha
		if($Fecha=='0000-00-00' OR $Fecha=='00-00-0000'){
			return 'Sin Fecha';
		}else{
			$date = date_create($Fecha);
			return date_format($date, 'Ymd');
		}
	}else{
		return 'Sin Fecha';
	}	
}
function Hora_archivos($Hora){	
	//valido la hora
	if($Hora!='00:00:00'){
		return date("His", strtotime($Hora));
	}else{
		return 'Sin Hora';
	}	
}
/************************ CONFIGURACION ************************/
$Nombre_zip = 'Respaldo_'.Fecha_archivos(fecha_actual()).'_'.Hora_archivos(hora_actual()).'.zip';
$Origen     = 'files/';
$Destino    = 'backups/'.$Nombre_zip;

/************************ EJECUCION ************************/
//Compresion de archivos
$zip = new ZipArchive;
if ($zip->open($Nombre_zip, ZipArchive::CREATE) === TRUE){
	// Archivos a comprimir
    $zip->addFile($Origen.'log_example_1.txt', $Origen.'log_example_1.txt');
    //$zip->addFile($Origen.'log_example_2.txt', $Origen.'log_example_2.txt');
    // Cerrar el archivo
    $zip->close();
}
/**********************************************************/
//Se copia el archivo comprimido en el destino
copy($Nombre_zip,$Destino);
//se elimina archivo comprimido original
unlink($Nombre_zip);
//Opcional tambien se pueden eliminar los archivos de origen
unlink($Origen.'log_example_1.txt');
?>

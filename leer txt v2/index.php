<?php
/************************ CONFIGURACION ************************/
//Datos
$Archivo  = 'files/logs_ardu_log_id_3.txt';  //archivo a leer
$Escribir = 'files/query_id_3.txt';          //archivo a escribir
//verifico si ignoro los valores 999
//	1: ignorar
//	2: guardar los valores 999
$dis_999 = 2;
//Cantidad total de sensores
$Tot_sensores = 72;
/************************    VARIABLES  ************************/
//Obtengo el id telemetria desde el nombre del archivo
$idTelemetria = str_replace("files/logs_ardu_log_id_", '', $Archivo);
$idTelemetria = str_replace(".txt", '', $idTelemetria);
//Variables vacias
$LastUpdateFecha = '';
$LastUpdateHora  = '';


//recorro
if (file_exists($Archivo)) {
	//se trata de leer el archivo
	try {
		$myfile = fopen($Archivo, "r") or die("Unable to open file!");
		while(!feof($myfile)) {
			//Genero las variables vacias temporales
			$Identificador  = '';
			$Fecha          = '';
			$Hora           = '';
			$GeoLatitud     = '';
			$GeoLongitud    = '';
			$GeoVelocidad   = '';
			$GeoDireccion   = '';
			$GeoMovimiento  = '';
			$ups            = '';
			for ($i_num = 1; $i_num <= $Tot_sensores; $i_num++) {
				$Sensor[$i_num]['valor'] = '';
			}
			/************************************/
			//Reemplazo los datos
			$newDato = fgets($myfile);
			$newDato = str_replace(" - http://webapp.crosstech.cl/crosstech/ardu.php?", '&', $newDato);
			$newDato = str_replace(" ", '&', $newDato);
			$newDato = str_replace("%20", '', $newDato);
			$newDato = str_replace("'", '', $newDato);
			$newDato = str_replace(array("\r", "\n"), '', $newDato);
			/************************************/
			//separo lo que obtengo
			$INT_piezas = explode("&", $newDato);
			//recorro los elementos
			foreach ($INT_piezas as $INT_valor) {
				//Datos
				if(strstr($INT_valor, '2021-')) { $FechaSistema   = $INT_valor;}
				if(strstr($INT_valor, ':')) {     $HoraSistema    = $INT_valor;}
				if(strstr($INT_valor, 'id=')) {   $Identificador  = str_replace('id=', '', $INT_valor);}
				if(strstr($INT_valor, 'lt=')) {   $GeoLatitud     = str_replace('lt=', '', $INT_valor);}
				if(strstr($INT_valor, 'lg=')) {   $GeoLongitud    = str_replace('lg=', '', $INT_valor);}
				if(strstr($INT_valor, 'v=')) {    $GeoVelocidad   = str_replace('v=', '', $INT_valor);}
				if(strstr($INT_valor, 'd=')) {    $GeoDireccion   = str_replace('d=', '', $INT_valor);}
				if(strstr($INT_valor, 'm=')) {    $GeoMovimiento  = str_replace('m=', '', $INT_valor);}
				if(strstr($INT_valor, 'ups=')) {  $ups            = str_replace('ups=', '', $INT_valor);}
				
				//Sensores
				for ($i_num = 1; $i_num <= $Tot_sensores; $i_num++) {
					//elimino el dato del sensor y me quedo solo con el valor
					if(strstr($INT_valor, 's'.$i_num.'=')) { $Sensor[$i_num]['valor'] = str_replace('s'.$i_num.'=', '', $INT_valor);}
				}
			}
			/************************************/
			//Creo la consulta
			if(isset($idTelemetria) && $idTelemetria != ''){    $a  = "'".$idTelemetria."'" ;      }else{$a  ="''";}
			if(isset($Fecha) && $Fecha != ''){                  $a .= ",'".$Fecha."'" ;            }else{$a .=",''";}
			if(isset($Hora) && $Hora != ''){                    $a .= ",'".$Hora."'" ;             }else{$a .=",''";}
			if(isset($FechaSistema) && $FechaSistema != ''){    $a .= ",'".$FechaSistema."'" ;     }else{$a .=",''";}
			if(isset($HoraSistema) && $HoraSistema != ''){      $a .= ",'".$HoraSistema."'" ;      }else{$a .=",''";}
			//El timestamp
			if(isset($FechaSistema) && $FechaSistema != ''&&isset($HoraSistema) && $HoraSistema != ''){
				$a .= ",'".$FechaSistema." ".$HoraSistema."'" ;                    
			}else{
				$a .= ",''";
			}
			//Geolocalizacion		
			if(isset($GeoLatitud) && $GeoLatitud != '' && $GeoLatitud != 0){            $a .= ",'".$GeoLatitud."'" ;        }else{$a .=",''";}
			if(isset($GeoLongitud) && $GeoLongitud != '' && $GeoLongitud != 0){         $a .= ",'".$GeoLongitud."'" ;       }else{$a .=",''";}
			if(isset($GeoVelocidad) && $GeoVelocidad != '' && $GeoVelocidad != 0){      $a .= ",'".$GeoVelocidad."'" ;      }else{$a .=",''";}
			if(isset($GeoDireccion) && $GeoDireccion != '' && $GeoDireccion != 0){      $a .= ",'".$GeoDireccion."'" ;      }else{$a .=",''";}
			if(isset($GeoMovimiento) && $GeoMovimiento != '' && $GeoMovimiento != 0){   $a .= ",'".$GeoMovimiento."'" ;     }else{$a .=",''";}
				

			$a .=",''";//contratos
			$a .=",''";//Si se esta usando el predio
			$a .=",''";//Si se esta usando la geocerca

			/*********************************************************************/		
			//Armo arreglo para guardar los datos
			$c_sensor = '';
			/*********************************************************************/		
			//Mientras la hora actual sea superior a la ultima hora
			if($HoraSistema!=''&&$LastUpdateHora!=''&&$HoraSistema>$LastUpdateHora){
				
				//Variables
				$diaInicio   = $LastUpdateFecha;
				$diaTermino  = $FechaSistema;
				//calculo diferencia de dias
				$n_dias   = dias_transcurridos($diaInicio,$diaTermino);
				$segundos = restahoras($LastUpdateHora,$HoraSistema);
				//Calculo del tiempo transcurrido
				if($n_dias!=0){
					if($n_dias>=2){
						$n_dias      = $n_dias-1;
						$horas_trans = multHoras('24:00:00',$n_dias);
						$segundos    = sumahoras($segundos,$horas_trans);
					}
				}
				$segundos = horas2segundos($segundos);
				//Se guarda el tiempo transcurrido
				$a .= ",'".$segundos."'" ; 
				$c_sensor .= ',Segundos';
					
				//Si los sensores de flujo estan funcionando
				if($Sensor[1]['valor']>0 OR $Sensor[2]['valor']>0){
					$Suma  = ($Sensor[1]['valor'] + $Sensor[2]['valor'])/60;
					$flujo = $Suma * $segundos;
					//Se guarda el tiempo transcurrido
					$a .= ",'".$flujo."'" ; 
					$c_sensor .= ',Diferencia';
					
				}				
			}
			/*********************************************************************/		
			//Armo arreglo para guardar los datos
			for ($i = 1; $i <= $Tot_sensores; $i++) {
				//verifico si ignoro los valores 99900 al actualizar
				if(isset($dis_999)&&$dis_999==1){
					if(isset($Sensor[$i]['valor'])&&$Sensor[$i]['valor']<99900){
						$a .= ",'".$Sensor[$i]['valor']."'" ; 
						//constante??
						$c_sensor .= ',Sensor_'.$i;
					//si es un valor condicionado
					}elseif(isset($Sensor[$i]['valor'])&&$Sensor[$i]['valor']==99901){
						$a .= ",'0'" ; 
						//constante??
						$c_sensor .= ',Sensor_'.$i;
					}else{
						$a .= ",'".$Sensor[$i]['valor']."'" ; 
						//constante??
						$c_sensor .= ',Sensor_'.$i;
					}
						
				//si no los ignoro
				}elseif(isset($dis_999)&&$dis_999==2){
					//si es un valor condicionado
					if(isset($Sensor[$i]['valor'])&&$Sensor[$i]['valor']==99901){
						$a .= ",'0'" ; 
						//constante??
						$c_sensor .= ',Sensor_'.$i;
					}else{
						$a .= ",'".$Sensor[$i]['valor']."'" ; 
						//constante??
						$c_sensor .= ',Sensor_'.$i;
					}
				}	
			}
						
			// inserto los datos de registro en la db
			$query  = "INSERT INTO `telemetria_listado_tablarelacionada_".$idTelemetria."` (idTelemetria, Fecha, Hora, FechaSistema, HoraSistema, TimeStamp, GeoLatitud, GeoLongitud, GeoVelocidad, GeoDireccion, GeoMovimiento, idContrato, idZona, idGeocerca ".$c_sensor." ) VALUES (".$a.");
";
			//imprimo resultado
			EscribirLog($Escribir, $query, 5);
			//guardo la hora y la fecha
			$LastUpdateFecha  = $FechaSistema;
			$LastUpdateHora   = $HoraSistema;
			
		}
		fclose($myfile);
		echo 'Listo';
	} catch (Exception $e) {
		echo "Ha ocurrido un error (".$e->getMessage().")";
	}
}







/***********************************************************************/
//Funciones
function dias_transcurridos($fecha_i,$fecha_f){
	$dias	= (strtotime($fecha_i)-strtotime($fecha_f))/86400;
	$dias 	= abs($dias); 
	$dias   = floor($dias);	
}
function restahoras($hora, $horaresta){
		
	//Se verifica cual es el mayor
	if(strtotime($hora)>strtotime($horaresta)){
		$horaresta  = sumahoras($horaresta, '24:00:00');
	}
		
	//Separo la hora
	$hora      = explode(":",$hora);
	$horaresta = explode(":",$horaresta);
		
	//obtengo valores por separado
	$horai = $hora[0];
	$mini  = $hora[1];
	$segi  = $hora[2];

	//obtengo valores por separado
	$horaf = $horaresta[0];
	$minf  = $horaresta[1];
	$segf  = $horaresta[2];
		
	//transformo a segundos
	$ini   = ((($horai*60)*60)+($mini*60)+$segi);
	$fin   = ((($horaf*60)*60)+($minf*60)+$segf);
		
	//ejecuto operacion
	$dif   = $fin-$ini;
		
	//devuelvo
	return segundos2horas($dif);
}
function sumahoras($hora,$horasuma){
	//Separo la hora
	$hora     = explode(":",$hora);
	$horasuma = explode(":",$horasuma);
		
	//obtengo valores por separado
	$horai = $hora[0];
	$mini  = $hora[1];
	$segi  = $hora[2];

	//obtengo valores por separado
	$horaf = $horasuma[0];
	$minf  = $horasuma[1];
	$segf  = $horasuma[2];
		
	//transformo a segundos
	$ini   = ((($horai*60)*60)+($mini*60)+$segi);
	$fin   = ((($horaf*60)*60)+($minf*60)+$segf);
		
	//ejecuto operacion
	$dif   = $fin+$ini;
		
	//devuelvo
	return segundos2horas($dif);
 
}
function segundos2horas($segundos) {
	//se verifica si es un numero lo que se recibe
	$t = round($segundos);
	return sprintf('%02d:%02d:%02d', ($t/3600),($t/60%60), $t%60);
}
function multHoras($hora,$multiplicador) {
	$seconds  = strtotime("1970-01-01 $hora UTC");
	$multiply = $seconds * $multiplicador;  //Aqui se multiplica
	$seconds  = $multiply;
	$zero     = new DateTime("@0");
	$offset   = new DateTime("@$seconds");
	$diff     = $zero->diff($offset);
	return sprintf("%02d:%02d:%02d", $diff->days * 24 + $diff->h, $diff->i, $diff->s);
	
}
function horas2segundos($horas){
	$timeExploded = explode(':', $horas);
	if (isset($timeExploded[2])) {
		return $timeExploded[0] * 3600 + $timeExploded[1] * 60 + $timeExploded[2];
	}
	return $timeExploded[0] * 3600 + $timeExploded[1] * 60;
    
}
function EscribirLog($file, $data, $type){
    switch ($type) {
		case 1:  $tipo = 'r';  break;	//Apertura para s??lo lectura; coloca el puntero al fichero al principio del fichero.
		case 2:  $tipo = 'r+'; break; 	//Apertura para lectura y escritura; coloca el puntero al fichero al principio del fichero.
		case 3:  $tipo = 'w';  break; 	//Apertura para s??lo escritura; coloca el puntero al fichero al principio del fichero y trunca el fichero a longitud cero. Si el fichero no existe se intenta crear.
		case 4:  $tipo = 'w+'; break; 	//Apertura para lectura y escritura; coloca el puntero al fichero al principio del fichero y trunca el fichero a longitud cero. Si el fichero no existe se intenta crear.
		case 5:  $tipo = 'a';  break; 	//Apertura para s??lo escritura; coloca el puntero del fichero al final del mismo. Si el fichero no existe, se intenta crear. En este modo, fseek() solamente afecta a la posici??n de lectura; las lecturas siempre son pospuestas.
		case 6:  $tipo = 'a+'; break; 	//Apertura para lectura y escritura; coloca el puntero del fichero al final del mismo. Si el fichero no existe, se intenta crear. En este modo, fseek() no tiene efecto, las escrituras siempre son pospuestas.
		case 7:  $tipo = 'x';  break; 	//Creaci??n y apertura para s??lo escritura; coloca el puntero del fichero al principio del mismo. Si el fichero ya existe, la llamada a fopen() fallar?? devolviendo false y generando un error de nivel E_WARNING. Si el fichero no existe se intenta crear. Esto es equivalente a especificar las banderas O_EXCL|O_CREAT para la llamada al sistema de open(2) subyacente.
		case 8:  $tipo = 'x+'; break; 	//Creaci??n y apertura para lectura y escritura; de otro modo tiene el mismo comportamiento que 'x'.
		case 9:  $tipo = 'c';  break; 	//Abrir el fichero para s??lo escritura. Si el fichero no existe, se crea. Si existe no es truncado (a diferencia de 'w'), ni la llamada a esta funci??n falla (como en el caso con 'x'). El puntero al fichero se posiciona en el principio del fichero. Esto puede ser ??til si se desea obtener un bloqueo asistido (v??ase flock()) antes de intentar modificar el fichero, ya que al usar 'w' se podr??a truncar el fichero antes de haber obtenido el bloqueo (si se desea truncar el fichero, se puede usar ftruncate() despu??s de solicitar el bloqueo).
		case 10: $tipo = 'c+'; break; 	//Abrir el fichero para lectura y escritura; de otro modo tiene el mismo comportamiento que 'c'.
		case 11: $tipo = 'e';  break; 	//Establecer la bandera 'close-on-exec' en el descriptor de fichero abierto. Disponible solamente en PHP compilado en sistemas que se ajustan a POSIX.1-2008. 
	}
    //Se verifica si archivo existe
    if (file_exists($file)) {
        //se guarda en el archivo
		try {
			if ($FP = fopen ($file, $tipo)){
				fwrite ($FP, $data);
				fclose ($FP);
			}
		} catch (Exception $e) {
			error_log('No se ha podido abrir el archivo '.$file.', verifiqoe el siguiente error: '.$e->getMessage(), 0);
		}	
    }
}

?>

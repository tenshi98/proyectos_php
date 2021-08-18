<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" href="resources/img/favicon.png">
		<title>Mostrar dia</title>
		<!-- Bootstrap core CSS -->
		<link href="resources/css/bootstrap.min.css" rel="stylesheet">
		<!-- Estilos propios -->
		<link href="resources/css/form-validation.css" rel="stylesheet">
	</head>

	<body class="bg-light">

		<div class="container">
			<div class="py-5 text-center">
				<h2>Mostrar dia</h2>
			</div>

			<div class="row">
				
				<?php
				function dameTiempo(){
					//se establece ciudad y pais de origen
					date_default_timezone_set('America/Santiago');
					//seleccion del dia
					switch (date("l")){
						case "Monday":    $dia = "Lunes";     break;
						case "Tuesday":   $dia = "Martes";    break;
						case "Wednesday": $dia = "Miercoles"; break;
						case "Thursday":  $dia = "Jueves";    break;
						case "Friday":    $dia = "Viernes";   break;
						case "Saturday":  $dia = "Sabado";    break;
						case "Sunday":    $dia = "Domingo";   break;
					}
					//seleccion del mes
					switch(date("F")){
						case "January":    $mes = "Enero";      break;
						case "February":   $mes = "Febrero";    break;
						case "March":      $mes = "Marzo";      break;
						case "April":      $mes = "Abril";      break;
						case "May":        $mes = "Mayo";       break;
						case "June":       $mes = "Junio";      break;
						case "July":       $mes = "Julio";      break;
						case "August":     $mes = "Agosto";     break;
						case "September":  $mes = "Septiembre"; break;
						case "October":    $mes = "Octubre";    break;
						case "November":   $mes = "November";   break;
						case "December":   $mes = "Diciembre";  break;	
					}

					echo "Hoy es ".$dia.", ".date("j")." de ".$mes." de ".date("Y");
				}
				dameTiempo();
				?>
				
				
			</div>

		</div>

		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="resources/js/popper.min.js"></script>
		<script src="resources/js/bootstrap.min.js"></script>
		<script src="resources/js/holder.min.js"></script>
		<script>
		// Example starter JavaScript for disabling form submissions if there are invalid fields
		(function() {
			'use strict';
			window.addEventListener('load', function() {
				// Fetch all the forms we want to apply custom Bootstrap validation styles to
				var forms = document.getElementsByClassName('needs-validation');

				// Loop over them and prevent submission
				var validation = Array.prototype.filter.call(forms, function(form) {
					form.addEventListener('submit', function(event) {
						if (form.checkValidity() === false) {
							event.preventDefault();
							event.stopPropagation();
						}
						form.classList.add('was-validated');
					}, false);
				});
			}, false);
		})();
		</script>
	</body>
</html>

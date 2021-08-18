<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" href="../resources/img/favicon.png">
		<title>Crear nuevo Elemento</title>
		<!-- Bootstrap core CSS -->
		<link href="../resources/css/bootstrap.min.css" rel="stylesheet">
		<!-- Estilos propios -->
		<link href="../resources/css/form-validation.css" rel="stylesheet">
	</head>

	<body class="bg-light">

		<div class="container">
			<div class="py-5 text-center">
				<h2>Crear nuevo Elemento</h2>
			</div>

			<div class="row">
				
				<div class="col-md-12">
					<form class="needs-validation" novalidate action="forms/crear_procesar.php" method="POST">
						
						<div class="row">
							<div class="col-md-6 mb-3">
								<label for="nombre">id</label>
								<input type="text" class="form-control" name="id" id="id" placeholder="id" value="" required onkeypress="return soloNumerosNaturales(event)">
								<div class="invalid-feedback">
									Un id numerico es requerido.
								</div>
							</div>
							<div class="col-md-6 mb-3">
								<label for="apellido">Artista</label>
								<input type="text" class="form-control" name="Artista" id="Artista" placeholder="Artista" value="" required onkeypress="return soloLetras(event)">
								<div class="invalid-feedback">
									Artista es requerido.
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-6 mb-3">
								<label for="nombre">Disco</label>
								<input type="text" class="form-control" name="Disco" id="Disco" placeholder="Disco" value="" required onkeypress="return soloLetras(event)">
								<div class="invalid-feedback">
									Disco es requerido.
								</div>
							</div>
							<div class="col-md-6 mb-3">
								<label for="apellido">Año del disco</label>
								<input type="text" class="form-control" name="Anio" id="Anio" placeholder="Año del disco" value="" required onkeypress="return soloNumerosNaturales(event)">
								<div class="invalid-feedback">
									Año del disco es requerido.
								</div>
							</div>
						</div>
						
						<hr class="mb-4">
						<button class="btn btn-primary btn-lg btn-block" type="submit">Guardar</button>
					</form>
				</div>
				
			</div>
			
			<script>
				//solo permitir numeros
				function soloNumerosNaturales(evt){
					var charCode = (evt.which) ? evt.which : event.keyCode
					if (charCode > 31 && (charCode < 48 || charCode > 57)){
						//verifico si presiono el punto
						if (charCode == 46) {
							return true;
						//valor negativo
						}else if(charCode == 45){
							return true;
						}else{
							return false;
						}
					}else{
						return true;
					}
				}
				//solo permitir letras
				function soloLetras(e){
					key = e.keyCode || e.which;
					tecla = String.fromCharCode(key).toLowerCase();
					letras = " áéíóúabcdefghijklmnñopqrstuvwxyz1234567890-_?¿°()=/+-,.<>:;*@";
					especiales = [8,37,38,39,40,46];

					tecla_especial = false
					for(var i in especiales){
						if(key == especiales[i]){
							tecla_especial = true;
							break;
						} 
					}		 
					if(letras.indexOf(tecla)==-1 && !tecla_especial)
					return false;
				}
			</script>
		
		
		</div>

		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="../resources/js/popper.min.js"></script>
		<script src="../resources/js/bootstrap.min.js"></script>
		<script src="../resources/js/holder.min.js"></script>
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

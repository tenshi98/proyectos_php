<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" href="resources/img/favicon.png">
		<title>Formularios</title>
		<!-- Bootstrap core CSS -->
		<link href="resources/css/bootstrap.min.css" rel="stylesheet">
		<!-- Estilos propios -->
		<link href="resources/css/form-validation.css" rel="stylesheet">
	</head>

	<body class="bg-light">

		<div class="container">
			<div class="py-5 text-center">
				<h2>Formularios</h2>
			</div>

			<div class="row">
				
				<div class="col-md-12">
					<form class="needs-validation" novalidate action="formularios_procesar.php" method="GET">
						<div class="row">
							<div class="col-md-6 mb-3">
								<label for="nombre">Nombre</label>
								<input type="text" class="form-control" name="nombre" id="nombre" placeholder="" value="" required>
								<div class="invalid-feedback">
									Un nombre es requerido.
								</div>
							</div>
							<div class="col-md-6 mb-3">
								<label for="apellido">Apellido</label>
								<input type="text" class="form-control" name="apellido" id="apellido" placeholder="" value="" required>
								<div class="invalid-feedback">
									Un apellido es requerido.
								</div>
							</div>
						</div>
						<hr class="mb-4">
						<button class="btn btn-primary btn-lg btn-block" type="submit">Continuar</button>
					</form>
				</div>
				
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

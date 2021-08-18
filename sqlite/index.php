<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" href="../resources/img/favicon.png">
		<title>CRUD</title>
		<!-- Bootstrap core CSS -->
		<link href="../resources/css/bootstrap.min.css" rel="stylesheet">
		<!-- Estilos propios -->
		<link href="../resources/css/form-validation.css" rel="stylesheet">
	</head>

	<body class="bg-light">

		<div class="container">
			<div class="py-5 text-center">
				<h2>CRUD</h2>
			</div>

			<div class="row">
				
				<div class="col-md-12">
					<a class="btn btn-primary" href="instalar.php">Crear base de datos</a> 
					<a class="btn btn-primary" href="crear.php">Crear Nuevo</a> 
				</div>
				<hr class="mb-4">
				<div class="col-md-12">
					
					
					<?php
					/**********************************************************************************************************************************/
					/*                                                      Ejecucion                                                                 */
					/**********************************************************************************************************************************/
					//Se llama a la conexion
					$db = new SQLite3('database/db_biblioteca.db');
					//Consulto todos los datos
					$arrListado = array();
					$query = "SELECT id, Artista, Disco, Anio FROM Discos ORDER BY id ASC;";
					//Consulta
					$sentencia = $db->prepare($query);
					$result    = $sentencia->execute();
					while ( $row = $result->fetchArray()) {
					array_push( $arrListado,$row );
					}
					?>				
					
					<table class="table table-bordered table-sm">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Disco</th>
								<th scope="col">Artista</th>
								<th scope="col">Año</th>
								<th scope="col">Acciones</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($arrListado as $list) { ?>
								<tr>
									<th scope="row"><?php echo $list['id']; ?></th>
									<td><?php echo $list['Disco']; ?></td>
									<td><?php echo $list['Artista']; ?></td>
									<td><?php echo $list['Anio']; ?></td>
									<td>
										<div class="btn-group" role="group" aria-label="Acciones">
											<a class="btn btn-primary btn-sm" href="editar.php?id=<?php echo $list['id']; ?>">Editar</a>
											<a class="btn btn-danger btn-sm" href="forms/borrar.php?id=<?php echo $list['id']; ?>">Borrar</a>
										</div>
									</td>

								</tr>
							<?php }  ?>   
						</tbody>
					</table>
				</div>
				
			</div>

			
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

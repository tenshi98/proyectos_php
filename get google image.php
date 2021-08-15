<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" href="resources/img/favicon.png">
		<title>Template</title>
		<!-- Bootstrap core CSS -->
		<link href="resources/css/bootstrap.min.css" rel="stylesheet">
		<!-- Estilos propios -->
		<link href="resources/css/form-validation.css" rel="stylesheet">
	</head>

	<body class="bg-light">

		<div class="container">
			<div class="py-5 text-center">
				<h2>Get Google Image</h2>
			</div>

			<div class="row">
				
				<?php
				function getGoogleImage($consulta, $max_img){
					//Se da permiso para el acceso remoto
					ini_set("allow_url_fopen", 1);
					//se verifica si el permiso fue concedido
					if( ini_get('allow_url_fopen') ) {
						//Direccion con la consulta a google image
						$url = "https://www.google.com/search?q=".$consulta."&tbm=isch&source=hp&biw=1366&bih=636&ei=NWOAYIeGIpDJ1sQPjcYQ&oq=".$consulta."&gs_lcp=CgNpbWcQAzoCCAA6CAgAELEDEIMBOgUIABCxAzoECAAQE1CqHFjAlQFgo5gBaABwAHgAgAFiiAGTB5IBAjE1mAEAoAEBqgELZ3dzLXdpei1pbWc&sclient=img&ved=0ahUKEwjH9L_O8I_wAhWQpJUCHQ0jBAAQ4dUDCAY&uact=5";
						
						//obtengo el contenido							
						$html = file_get_contents($url);
						preg_match_all( '|<img.*?src=[\'"](.*?)[\'"].*?>|i',$html, $matches ); 
						
						//recorro
						$i = 0;
						
						//recorro
						foreach($matches as $image1){
							foreach($image1 as $image){
								if($i > $max_img) break;
								//mientras tenga al menos un resultado
								if($i>0){
									echo '<div class="col-md-4">';
										echo '<div class="card mb-4 box-shadow">';
											echo $image;
										echo '</div>';
									echo '</div>';
								}
								$i++;
							}
						} 
					}
				}
				//Busco la imagen
				getGoogleImage('automovil+nissan+versa+rojo', 10);
				?>
				
				
			</div>

			<footer class="my-5 pt-5 text-muted text-center text-small">
				<p class="mb-1">&copy; 2017-2018 Company Name</p>
				<ul class="list-inline">
					<li class="list-inline-item"><a href="#">Privacy</a></li>
					<li class="list-inline-item"><a href="#">Terms</a></li>
					<li class="list-inline-item"><a href="#">Support</a></li>
				</ul>
			</footer>
		</div>

		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
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

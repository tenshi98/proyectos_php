<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" href="resources/img/favicon.png">
		<title>Lista de videos de un canal de youtuve</title>
		<!-- Bootstrap core CSS -->
		<link href="resources/css/bootstrap.min.css" rel="stylesheet">
		<!-- Estilos propios -->
		<link href="resources/css/form-validation.css" rel="stylesheet">
	</head>

	<body class="bg-light">

		<div class="container">
			<div class="py-5 text-center">
				<h2>Lista de videos de un canal de youtuve</h2>
			</div>

			<div class="row">
				
				<?php
				$Identif    = 'UCioNNjH3S7X8byCjPDEqZkA'; //Channel_ID
				$myApiKey   = '';                         // Google API Key
				$maxResults = '20';                       // Numero de videos a mostrar

				$myChannelID  = $Identif; 
				$myQuery      = "https://www.googleapis.com/youtube/v3/search?key=".$myApiKey."&channelId=".$myChannelID."&part=snippet,id&order=date&maxResults=".$maxResults;
				$videoList    = file_get_contents($myQuery);
				$decoded      = json_decode($videoList, true);
				
				// Recorrer respuesta
				foreach ($decoded['items'] as $items){
					$id           = $items['id']['videoId'];
					$title        = $items['snippet']['title'];
					$description  = $items['snippet']['description'];
					$thumbnail    = $items['snippet']['thumbnails']['default']['url']; ?>
					
					
					<div class="col-md-4">
						<div class="card mb-4 box-shadow">
							<img class="card-img-top" src="<?php echo $thumbnail; ?>" alt="<?php echo $title; ?>">
							<div class="card-body">
								<p class="card-text"><?php echo $description; ?></p>
								<div class="d-flex justify-content-between align-items-center">
									<div class="btn-group">
										<a class="btn btn-sm btn-outline-secondary" target="_blank" rel="noopener noreferrer" href="https://www.youtube.com/watch?v=<?php echo $id; ?>" title="<?php echo $title; ?>">Ver</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					
				<?php } ?>
				
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

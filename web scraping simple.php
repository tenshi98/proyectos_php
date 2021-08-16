<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" href="resources/img/favicon.png">
		<title>Web Scraping Simple</title>
		<!-- Bootstrap core CSS -->
		<link href="resources/css/bootstrap.min.css" rel="stylesheet">
		<!-- Estilos propios -->
		<link href="resources/css/form-validation.css" rel="stylesheet">
	</head>

	<body class="bg-light">

		<div class="container">
			<div class="py-5 text-center">
				<h2>Web Scraping Simple</h2>
			</div>

			<div class="row">
				
				
				<div class="blog-post">
					<h2 class="blog-post-title">Explicacion</h2>
					<p>Se trae informacion del sitio https://www.feriados.cl/ y se reformatea para ser mostrado en la pagina deseada</p>
					<hr>
				</div>
            
				<?php
				function web_scraping($sitio){
					
					//Se da permiso para el acceso remoto
					ini_set("allow_url_fopen", 1);
					//se verifica si el permiso fue concedido
					if( ini_get('allow_url_fopen') ) {
						//Obtengo los datos
						$feriado = file_get_contents($sitio);
						
						//modifico el html obtenido
						$feriado = str_replace('<!DOCTYPE html>','', $feriado);
						$feriado = str_replace('<html lang="es">','', $feriado);
						$feriado = str_replace('<head>','', $feriado);
						$feriado = str_replace('<!-- Global site tag (gtag.js) - Google Analytics -->','', $feriado);
						$feriado = str_replace('<script async src="https://www.googletagmanager.com/gtag/js?id=UA-11741389-1"></script>','', $feriado);
						$feriado = str_replace('<script>','', $feriado);
						$feriado = str_replace('window.dataLayer = window.dataLayer || [];','', $feriado);
						$feriado = str_replace('function gtag(){dataLayer.push(arguments);}','', $feriado);
						$feriado = str_replace('gtag(\'js\', new Date());','', $feriado);
						$feriado = str_replace("gtag('config', 'UA-11741389-1');", '', $feriado);
						$feriado = str_replace('<meta charset = "UTF-8" >','', $feriado);
						$feriado = str_replace('<meta name="description"','', $feriado);
						$feriado = str_replace('content="Sitio con la información de los días feriados de Chile y las leyes que los rigen.">','', $feriado);
						$feriado = str_replace('<link rel="shortcut icon" href="favicon.ico">','', $feriado);
						$feriado = str_replace('<link rel="stylesheet" type="text/css" href="style18-4.css">','', $feriado);
						$feriado = str_replace('<meta name="keywords"','', $feriado);
						$feriado = str_replace('content="Feriados de Chile, Feriados, 2021, Año Nuevo, Viernes Santo, Sábado Santo, Día Nacional de Trabajo, San Pedro y San Pablo, Día de la Virgen del Carmen, Asunsión de la Virgen, Independencia Nacional, Día de la Glorias del Ejército, Encuentro de Dos Mundos, Día de las Iglesias Evangélicas y Protestantes, Día de Todos los Santos, Inmaculada Concepción, Navidad, Elecciones Municipales, Plebiscito, Asamblea Constituyente, Constitución">','', $feriado);
						$feriado = str_replace('<title>Feriados de Chile - Año 2021</title>','', $feriado);
						$feriado = str_replace('<link rel="canonical" href="https://www.feriados.cl/index.php">','', $feriado);
						$feriado = str_replace('<meta name="viewport" content="width=device-width, initial-scale=1">','', $feriado);
						$feriado = str_replace('<!-- Anuncio Automatico -->','', $feriado);
						$feriado = str_replace('<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>','', $feriado);
						$feriado = str_replace('(adsbygoogle = window.adsbygoogle || []).push({','', $feriado);
						$feriado = str_replace('google_ad_client: "pub-1764294017474123",','', $feriado);
						$feriado = str_replace('enable_page_level_ads: true','', $feriado);
						$feriado = str_replace('});','', $feriado);
						$feriado = str_replace('</head>','', $feriado);
						$feriado = str_replace('<body style="background-color: #ffffff; margin-top: 1%; margin-left: 2%; margin-right: 2%; margin-bottom: 1%;">','', $feriado);
						$feriado = str_replace('<header>','', $feriado);
						$feriado = str_replace('<div class="logo"><a href="#sobre">','', $feriado);
						$feriado = str_replace('<img src="logoferiados.png" alt="Logo" style="width:75%; margin-left: auto; margin-right: auto; display: block;"></a></div>','', $feriado);
						$feriado = str_replace('<div class="titulo"><h1 style="text-align:center;  color: #ffffff;">Feriados de Chile Año 2021','', $feriado);
						$feriado = str_replace('<a href="#menutarget" style="text-decoration: none;"><span class="menulink"></span></a></h1></div>','', $feriado);
						$feriado = str_replace('</header>','', $feriado);
						$feriado = str_replace('<main>','', $feriado);
						$feriado = str_replace('</main>','', $feriado);
						$feriado = str_replace('<aside>','', $feriado);
						$feriado = str_replace('<nav id="menu">','', $feriado);
						$feriado = str_replace('</nav>','', $feriado);
						$feriado = str_replace('<div class="share">','', $feriado);
						$feriado = str_replace('<a href="https://twitter.com/share" class="twitter-share-button" data-url="https://feriados.cl/" data-via="feriados" ','', $feriado);
						$feriado = str_replace('data-size="large" data-count="none" data-hashtags="Feriados" style="vertical-align: text-bottom;" >Tweet</a>','', $feriado);
						$feriado = str_replace('<a href="whatsapp://send?text=Hola! Te recomiendo Feriados de Chile https://feriados.cl/" ','', $feriado);
						$feriado = str_replace('data-action="share/whatsapp/share"><img src="ws.png" alt="WhatsApp" height="28"></a>','', $feriado);
						$feriado = str_replace('<div>','', $feriado);
						$feriado = str_replace('<!-- BloqueResponsivo -->','', $feriado);
						$feriado = str_replace('<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>','', $feriado);
						$feriado = str_replace('<ins class="adsbygoogle"','', $feriado);
						$feriado = str_replace('style="display:block"','', $feriado);
						$feriado = str_replace('data-ad-client="ca-pub-1764294017474123"','', $feriado);
						$feriado = str_replace('data-ad-slot="5711300468"','', $feriado);
						$feriado = str_replace('data-ad-format="auto"></ins>','', $feriado);
						$feriado = str_replace('(adsbygoogle = window.adsbygoogle || []).push({});','', $feriado);
						$feriado = str_replace('</div>','', $feriado);
						$feriado = str_replace('<div style="display:block; margin:auto; ">','', $feriado);
						$feriado = str_replace('<p><span style=" color: #004080; font-weight: bold;">Actualizaciones Twitter</span></p>','', $feriado);
						$feriado = str_replace('<a class="twitter-timeline"  data-tweet-limit="5" data-chrome="noheader;nofooter" data-width="100%"  data-height="auto"  ','', $feriado);
						$feriado = str_replace('href="https://twitter.com/feriados">Twitter @Feriados</a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>','', $feriado);
						$feriado = str_replace('<p><span style="color: #004080; font-weight: bold;">Licencia</span></p>','', $feriado);
						$feriado = str_replace('<p style="font-size:smaller;"><a class="navblack" rel="license" href="https://creativecommons.org/licenses/by-nc-sa/4.0/">','', $feriado);
						$feriado = str_replace('<img alt="Licencia Creative Commons" style="border-width:0" src="https://i.creativecommons.org/l/by-nc-sa/4.0/88x31.png" /></a>','', $feriado);
						$feriado = str_replace('<br />Esta obra está bajo una <a class="navblack" style="font-weight:normal;" ','', $feriado);
						$feriado = str_replace('rel="license" href="https://creativecommons.org/licenses/by-nc-sa/4.0/">','', $feriado);
						$feriado = str_replace('Licencia Creative Commons Atribución-NoComercial-CompartirIgual 4.0 Internacional</a>.</p>','', $feriado);
						$feriado = str_replace('</aside>','', $feriado);
						$feriado = str_replace('</body>','', $feriado);
						$feriado = str_replace('</html>','', $feriado);
						$feriado = str_replace('<table>','<table style="width: 100%;white-space: initial;">', $feriado);
						$feriado = str_replace('<p><span style=" color: #004080; font-weight: bold;">Sobre el sitio</span></p>','', $feriado);
						$feriado = str_replace('<p style="padding: 0px 6px 0px 6px;">En Feriados de Chile creemos que la familia y comunidad son la base de la sociedad, ','', $feriado);
						$feriado = str_replace('y que cada momento que pasan juntas, contribuye a una sociedad más fuerte. Nosotros te contamos cuándo es feriado, para que','', $feriado);
						$feriado = str_replace('disfrutes junto a los tuyos. Fuente de información: ','', $feriado);
						$feriado = str_replace('<a class="navblack" style="font-weight: normal;" href="https://www.bcn.cl/" target="_blank">Biblioteca Congreso Nacional</a>.</p>','', $feriado);
						$feriado = str_replace('<p><span style=" color: #004080; font-weight: bold;">Otros sitios </span></p>','', $feriado);
						$feriado = str_replace('<p>','', $feriado);
						$feriado = str_replace('</p>','', $feriado);
						$feriado = str_replace('<a href="https://www.preparados.cl/"','', $feriado);
						$feriado = str_replace('<a href="https://www.datoutil.cl/"','', $feriado);
						$feriado = str_replace('<a href="https://www.efemerides.cl/"','', $feriado);
						$feriado = str_replace('target','', $feriado);
						$feriado = str_replace('_blank','', $feriado);
						$feriado = str_replace('=>','', $feriado);
						$feriado = str_replace('<img class="logott"','', $feriado);
						$feriado = str_replace('alt="Estar Preparados"','', $feriado);
						$feriado = str_replace('alt="Dato Util"','', $feriado);
						$feriado = str_replace('alt="Efemérides Chile"','', $feriado);
						$feriado = str_replace('src="preparadostt.png" >','', $feriado);
						$feriado = str_replace('src="datoutiltt.png" >','', $feriado);
						$feriado = str_replace('src="efemeridestt.png" >','', $feriado);
						$feriado = str_replace('<span  class="menuitemcur">Feriados Año 2021</span>','', $feriado);
						$feriado = str_replace('<a class="navwhite"','', $feriado);
						$feriado = str_replace('href="2022.htm">Feriados Año 2022','', $feriado);
						$feriado = str_replace('href="leyes.htm">Leyes','', $feriado);
						$feriado = str_replace('href="faq.htm">Preguntas Frecuentes','', $feriado);
						$feriado = str_replace('</a>','', $feriado);	
						
						//se da estilo
						$feriado = str_replace('<th>Día</th>','<th><strong><span style="color:#fff">Día</span></strong></th>', $feriado);	
						$feriado = str_replace('<th>Festividad</th>','<th><strong><span style="color:#fff">Festividad</span></strong></th>', $feriado);	
						$feriado = str_replace('<th>Tipo</th>','<th><strong><span style="color:#fff">Tipo</span></strong></th>', $feriado);	
						$feriado = str_replace('<th class="rl">Respaldo Legal</th>','<th><strong><span style="color:#fff">Respaldo Legal</span></strong></th>', $feriado);	
						
						
						//genero cuerpo
						$s_body = '
							<div class="table-responsive">
									'.$feriado.' 
							</div>';
						
						//devuelvo cuerpo								
						return $s_body;
					//si no fue concedido
					} else {
						return '<div class="alert alert-danger" role="alert">La funcion allow_url_fopen no esta activa</div>';
					}
					
				}

				//Consigo el sitio
				$sitio = 'https://www.feriados.cl/';
				echo web_scraping($sitio);

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

<!DOCTYPE html>
<html>
<head>
	<title>Reporte de la empresa</title>
	<style>
		/* Estilos CSS para la página */
		body {
			font-family: Arial, sans-serif;
			font-size: 14px;
			margin: 0;
			padding: 0;
		}
		.container {
			max-width: 100%;
			margin: 0 0;
			padding: 10px;
			box-sizing: content-box;
			background-image: url({{asset('image/bg_intranet_admin.jpg'); }});
		}
		h1 {
			text-align: center;
			color: white;
			margin-bottom: 20px;
		}
		.logo {
			max-width: 200px;
			margin: 0 auto;
			display: block;
		}
	</style>
</head>
<body>
	
	<div class="container">
		<img src="https://static.wixstatic.com/media/08547c_e7dc5092cad4472189d3be634557e720~mv2.png/v1/fill/w_314,h_89,al_c,q_85,usm_0.66_1.00_0.01,enc_auto/GREENEX_logo.png" alt="Logo de la empresa" class="logo">
		<h1>Informe de Recepcion Guia N° {{$recepcion->numero_g_recepcion}} | {{$recepcion->n_especie}} | <br> {{$recepcion->n_variedad}} | CSG {{$recepcion->id_emisor}} </h1>
		<!-- Aquí puedes incluir tus gráficos en formato HTML -->
		<!-- Ejemplo: <div id="grafico"></div> -->
		<!-- También puedes incluir texto e imágenes como lo desees -->
	</div>
</body>
</html>
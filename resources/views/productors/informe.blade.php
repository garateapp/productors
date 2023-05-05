<!DOCTYPE html>
<html>
<head>
	<title>Reporte de la empresa</title>
	<link href=”https://fonts.googleapis.com/css?family=Pacifico” rel=”stylesheet”>
	<style>
		/* Estilos CSS para la página */
		body {
			font-family: 'Roboto', 'Segoe UI', Tahoma, sans-serif;
			font-size: 14px;
			width: 100%;
			margin: 0;
			padding: 0;
			background-color:#ececec;
		}
		table{
			background-color:#ececec;
			border-spacing: 5px;
			border-radius: 5px;
		}
		th, td {
  			background-color:#ffffff;
			padding-top: 10px;
			padding-bottom: 10px;
			padding-left: 10px;
			padding-right: 10px;
			border-radius: 5px;
		}

		.container {
			max-width: 100%;
			margin: 0 0;
			padding: 10px;
			background-image: url({{asset('image/bg_intranet_admin.jpg'); }});
			
			background-size: cover;
			background-position: center; 
		}
		h1 {
			text-align: center;
			color: white;
			margin-bottom: 20px;
			background-color: rgb(0,0,0,0.5);
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
	</div>
		<table style="width:100%">
  
			<tr>
			  <td style="color: green;"><h3>Fecha</h3></td>
			  <td style="color: green;"><h3>N° <br>Lote</h3></td>
			  <td style="color: green;"><h3>Kilos <br>Recibidos</h3></td>
			  <td style="color: green;"><h3>N°<br> Envases</h3></td>
			  <td style="color: teal;"><h3>T°<br> Pulpa</h3></td>
			  <td style="color: teal;"><h3>Seteo <br> Camión</h3></td>
			  <td style="color: teal;"><h3>Nota<br> Calidad</h3></td>
			  <td style="color: teal;"><h3>Estimación<br> Exportación</h3></td>
			</tr>
		  </table>
			
		<!-- Aquí puedes incluir tus gráficos en formato HTML -->
		<!-- Ejemplo: <div id="grafico"></div> -->
		<!-- También puedes incluir texto e imágenes como lo desees -->
	
</body>
</html>
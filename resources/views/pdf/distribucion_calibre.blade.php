<!DOCTYPE html>
<html>
<head>
	<title>Informe de Recepción Nro° {{$recepcion->numero_g_recepcion}}</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link href=”https://fonts.googleapis.com/css?family=Pacifico” rel=”stylesheet”>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

	<style>
		/* Estilos CSS para la página */

	</style>
</head>
<body>

	
	
	
				
				<div>
		            <div id="grafico" style="width: 100%; max-width:1800px; height: 1000px; "></div>
				</div>
		
	<script type="text/javascript">
		google.charts.load('current', { 'packages': ['corechart'] });
		google.charts.setOnLoadCallback(dibujarGrafico);
	  
		function dibujarGrafico() {
		  var datos = google.visualization.arrayToDataTable([
			['Task', 'Hours per Day'],
			['Work', 8],
			['Eat', 2],
			['Sleep', 8],
			['Other', 6]
		  ]);
	  
		  var opciones = {
			title: 'Actividades diarias',
			pieHole: 0.4
		  };

          var chart_area=document.getElementById('grafico');
		  var chart = new google.visualization.PieChart(chart_area);
          
          google.visualization.events.addListener(chart, 'ready', function(){
            chart_area.innerHTML = '<img src="' + chart.getImageURI() + '" class="img-responsive">';
            });

		  chart.draw(datos, opciones);

		}
	  </script>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
	<title>Informe de Recepción Nro° {{$recepcion->numero_g_recepcion}}</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link href=”https://fonts.googleapis.com/css?family=Pacifico” rel=”stylesheet”>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

	<style>
		/* Estilos CSS para la página */

	</style>
</head>
<body>

	
	
	<div style="width: 100%; margin: auto; margin-top: 30px;">
        <canvas id="myChart"></canvas>
    </div>
				
			
        <script>
            const labels = [
    'January',
    'February',
    'March',
    'April',
    'May',
    'June',
];

const data = {
    labels: labels,
    datasets: [{
        label: 'My First dataset',
        backgroundColor: 'rgb(255, 99, 132)',
        borderColor: 'rgb(255, 99, 132)',
        data: [0, 10, 5, 2, 20, 30, 45],
    }]
};

const config = {
    type: 'line',
    data: data,
    options: {}
};

new Chart(
    document.getElementById('myChart'),
    config
);
        </script>
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
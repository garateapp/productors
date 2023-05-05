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

		  <table style="width:100%">
  
			<tr>
			  <td>
				<div>
					<figure class="highcharts-figure mx-1 mt-4">
					   <div id="grafico">
						  
					   </div>
					</figure>
				</div>
			  </td>
			  
			  <td><h3>N° <br>Lote</h3></td>
			  
			</tr>
		  </table>
			
		<!-- Aquí puedes incluir tus gráficos en formato HTML -->
		<!-- Ejemplo: <div id="grafico"></div> -->
		<!-- También puedes incluir texto e imágenes como lo desees -->
	<script src="{!! asset('js/highcharts.js') !!}"></script>
	<script src="{!! asset('js/series-label.js') !!}"></script>
	<script src="{!! asset('js/exporting.js') !!}"></script>
	<script src="{!! asset('js/export-data.js') !!}"></script>
	<script src="{!! asset('js/accessibility.js') !!}"></script>
	
	<script>
	Highcharts.chart('grafico', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Monthly Average Rainfall'
    },
    subtitle: {
        text: 'Source: WorldClimate.com'
    },
    xAxis: {
        categories: [
            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'May',
            'Jun',
            'Jul',
            'Aug',
            'Sep',
            'Oct',
            'Nov',
            'Dec'
        ],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Rainfall (mm)'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Tokyo',
        data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4,
            194.1, 95.6, 54.4]

    }, {
        name: 'New York',
        data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5,
            106.6, 92.3]

    }, {
        name: 'London',
        data: [48.9, 38.8, 39.3, 41.4, 47.0, 48.3, 59.0, 59.6, 52.4, 65.2, 59.3,
            51.2]

    }, {
        name: 'Berlin',
        data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8,
            51.1]

    }]
});
              
              
	</script>
</body>
</html>
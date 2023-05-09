<!DOCTYPE html>
<html>
<head>
	<title>Reporte de la empresa</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link href=”https://fonts.googleapis.com/css?family=Pacifico” rel=”stylesheet”>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
          ['Mushrooms', 3],
          ['Onions', 1],
          ['Olives', 1],
          ['Zucchini', 1],
          ['Pepperoni', 2]
        ]);

        // Set chart options
        var options = {'title':'How Much Pizza I Ate Last Night',
                       'width':400,
                       'height':300};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
	<style>
		/* Estilos CSS para la página */
		@page {
			margin-top: 15px;
			margin-bottom: 15px;
			margin-left: 15px;
			margin-right: 15px;
		}
		body {
			font-family: 'Roboto', 'Segoe UI', Tahoma, sans-serif;
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
		.page-break {
			page-break-after: always;
		}
	</style>
</head>
<body>

	
	<div class="container">
		<img src="{{asset('image/logogreenex.png')}}" alt="Logo de la empresa" class="logo">
		<h1>Informe de Recepcion Guia N° {{$recepcion->numero_g_recepcion}} | {{$recepcion->n_especie}} | <br> {{$recepcion->n_variedad}} | CSG {{$recepcion->id_emisor}} </h1>
	</div>
		<table style="width:100%">
  
			<tr style="padding-top: 10px;
			padding-bottom: 10px;
			padding-left: 10px;
			padding-right: 10px;
			border-radius: 5px;">
			  <td style="background-color:#ffffff;padding-top: 10px;
			padding-bottom: 10px;
			padding-left: 10px;
			padding-right: 10px;
			border-radius: 5px;"><h3 style="color: #47ac34;">Fecha</h3> {{date('d M Y', strtotime($recepcion->fecha_g_recepcion))}}</td>
			  <td style="background-color:#ffffff;padding-top: 10px;
			padding-bottom: 10px;
			padding-left: 10px;
			padding-right: 10px;
			border-radius: 5px;"><h3 style="color: #47ac34;">N° <br>Lote</h3>  {{$recepcion->numero_g_recepcion}}</td>
			  <td style="background-color:#ffffff;padding-top: 10px;
			padding-bottom: 10px;
			padding-left: 10px;
			padding-right: 10px;
			border-radius: 5px;"><h3 style="color: #47ac34;">Kilos <br>Recibidos</h3> {{number_format($recepcion->peso_neto)}}</td>
			  <td style="background-color:#ffffff;padding-top: 10px;
			padding-bottom: 10px;
			padding-left: 10px;
			padding-right: 10px;
			border-radius: 5px;"><h3 style="color: #47ac34;">N°<br> Envases</h3>{{number_format($recepcion->cantidad)}}</td>
			  	@if ($recepcion->calidad->detalles->where('tipo_detalle','ss')->first())
					<td style="background-color:#ffffff;padding-top: 10px;
			padding-bottom: 10px;
			padding-left: 10px;
			padding-right: 10px;
			border-radius: 5px;"><h3  style="color: teal;">T°<br> Pulpa</h3>
					
						{{$recepcion->calidad->detalles->where('tipo_detalle','ss')->first()->temperatura}}
					</td>
				@endif

			 

			  	@if ($recepcion->calidad->detalles->where('detalle_item','SETEO CAMION')->first())
				  	<td style="background-color:#ffffff;padding-top: 10px;
			padding-bottom: 10px;
			padding-left: 10px;
			padding-right: 10px;
			border-radius: 5px;"><h3  style="color: teal;">Seteo <br> Camión</h3>
						{{$recepcion->calidad->detalles->where('detalle_item','SETEO CAMION')->first()->cantidad}}
					</td>
				@endif
			  <td style="background-color:#ffffff;padding-top: 10px;
			padding-bottom: 10px;
			padding-left: 10px;
			padding-right: 10px;
			border-radius: 5px;"><h3  style="color: teal;">Nota<br> Calidad</h3>  
																	@if ($recepcion->nota_calidad==0)   
																		S/N
																	@elseif($recepcion->nota_calidad)
																		{{number_format($recepcion->nota_calidad)}}
																	@endif
																</td>
			  <td style="background-color:#ffffff;padding-top: 10px;
			padding-bottom: 10px;
			padding-left: 10px;
			padding-right: 10px;
			border-radius: 5px;"><h3  style="color: teal;">Estimación<br> Exportación</h3></td>
			</tr>
		</table>

		  <table style="width:100%">
  
			<tr>
			  <td>
				<div>
					<div id="chart_div">
						
					</div>
				</div>
			  </td>
			  
			  <td>
				
				<div>
					<figure class="highcharts-figure mx-1 mt-4">
					   <div id="container">
						  
					   </div>
					</figure>
				</div>
			  </td>
			  
			</tr>
		  </table>
			

		  <div class="page-break"></div>
		
		  <table style="width:100%;  font-size: 12px; border-spacing: 2px;">
  
			<tr>
			  	<td style="background-color:#47ac34; color: white; padding-left: 5px;"><b>DEFECTOS DE CALIDAD</b> </td>
			  	<td style="background-color:#47ac34; color: white; padding-left: 5px;"><b>DEFECTOS DE CONDICIÓN</b> </td>
			  	<td style="background-color:#47ac34; color: white; padding-left: 5px;"><b>DAÑOS DE PLAGA </b></td>
				<td style="background-color:#47ac34; color: white; padding-left: 5px;"><b>CALIDAD DE LLEGADA</b> </td>
			  
			</tr>
			@php
				$d_calidad=$recepcion->calidad->detalles->where('tipo_item','DEFECTOS DE CALIDAD');
				$d_condicion=$recepcion->calidad->detalles->where('tipo_item','DEFECTOS DE CONDICIÓN');
				$d_plaga=$recepcion->calidad->detalles->where('tipo_item','DAÑO DE PLAGA');
			@endphp
			

				
						
					<tr>
						<td style="vertical-align: text-top;font-size: 14px;">
							@if ($d_calidad)
								@foreach ($d_calidad as $item)
									<div> <div style="display: inline;"> {{$item->detalle_item}}  </div>			<div style="display: inline; text-align: right; justify-items: end;">{{$item->cantidad}}%</div></div>
								@endforeach
								<div style="background-color:#47ac34; color: white; font-size: 12px; padding-left: 3px;"> <div style=""><b> TOTAL DEFECTOS DE CALIDAD </b></div>			<div style="text-align: left; justify-items: end;"><b>{{$item->cantidad}}%</b></div></div>
							@else
							-
							@endif
						</td>
						<td style="vertical-align: text-top;font-size: 14px;">
							@if ($d_condicion)
								@foreach ($d_condicion as $item)
									<div> <div style="display: inline;"> {{$item->detalle_item}}  </div>			<div style="display: inline; text-align: right; justify-items: end;">{{$item->cantidad}}%</div></div>
								@endforeach
								<div style="background-color:#47ac34; color: white; font-size: 12px; padding-left: 3px;"> <div style=""> <b>TOTAL DEFECTOS DE CONDICIÓN </b></div>			<div style="text-align: left; justify-items: end;"><b>{{$item->cantidad}}%</b></div></div>
							@else
							-
							@endif
						</td>
						<td style="vertical-align: text-top;font-size: 14px;">
							@if ($d_plaga)
								@foreach ($d_plaga as $item)
									<div> <div style="display: inline;"> {{$item->detalle_item}}  </div>			<div style="display: inline; text-align: right; justify-items: end;">{{$item->cantidad}}%</div></div>
								@endforeach
								<div style="background-color:#47ac34; color: white; font-size: 12px; padding-left: 3px;"> <div style=""><b> TOTAL DAÑOS DE PLAGA </b></div>			<div style="text-align: left; justify-items: end;"><b>{{$item->cantidad}}%</b></div></div>
							@else
							-
							@endif
						</td>
					</tr>

		</table>			
		<table style="width:100%;  font-size: 12px; background-color:#47ac34; border-spacing: 0px; ">	
		  <tr>
			<td style="background-color:#47ac34; color: white; padding-left: 5px;"><b>TOTAL DEFECTOS: </b>
				@php
					$total=0;
				@endphp
				@if ($d_calidad)
					@foreach ($d_calidad as $item)
						@php
							$total+=$item->cantidad;
						@endphp	
					@endforeach
				@endif
				@if ($d_condicion)
					@foreach ($d_condicion as $item)
						@php
							$total+=$item->cantidad;
						@endphp	
					@endforeach
				@endif
				@if ($d_plaga)
					@foreach ($d_plaga as $item)
						@php
							$total+=$item->cantidad;
						@endphp	
					@endforeach
				@endif



				@if ($total>0)
					
					{{$total;}}%
				@else
				-
				@endif
			</td>
			<td style="background-color:#47ac34; color: white;"><b>PRECALIBRE:  </b>
				@if ($recepcion->calidad->detalles->where('detalle_item','PRECALIBRE')->first())
					{{$recepcion->calidad->detalles->where('detalle_item','PRECALIBRE')->first()->cantidad}} %
				@else
				-
				@endif
				
			</td>
			<td style="background-color:#47ac34; color: white;"><b>FUEREA DE COLOR:  </b>
				@if ($recepcion->calidad->detalles->where('detalle_item','FUERA DE COLOR')->first())
					{{$recepcion->calidad->detalles->where('detalle_item','FUERA DE COLOR')->first()->cantidad}} %
				@else
				-
				@endif
			</td>
		  	<td style="background-color:#47ac34; color: white;"><b>FRUTA BLANDA: </b></td>
		
	  </tr>
	</table>
	<div style="background-color:#47ac34; color: white; font-size: 12px; padding-left: 3px; border-top: 1px solid white;"> <div style="text-align: center;"><b> OBSERVACIONES: </b></div>		</div>
	<div style="background-color:#bad047; color: white; font-size: 12px; padding-left: 3px; border-bottom: 5px solid #47ac34;"> <div style="text-align: center;"><img src="{{asset('image/logogreenex.png')}}" alt="Logo de la empresa" class="logo"></div>		</div>
	
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
	<script>
		Highcharts.chart('container', {
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
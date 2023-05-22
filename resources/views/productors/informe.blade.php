<!DOCTYPE html>
<html>
<head>
	<title>Informe de Recepción Nro° {{$recepcion->numero_g_recepcion}}</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link href=”https://fonts.googleapis.com/css?family=Pacifico” rel=”stylesheet”>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script type="text/javascript" >
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
		<table style="width:100%;">
			<tr>
				<td>
					<img src="{{asset('image/logogreenex.png')}}" alt="Logo de la empresa" class="logo">
				</td>
				<td>
					<h1>{{$recepcion->n_emisor}}</h1>
	
				</td>
			</tr>
		</table>
		
		<h1>Informe de Recepcion Guia N° {{$recepcion->numero_g_recepcion}} | {{$recepcion->n_especie}} | <br> {{$recepcion->n_variedad}} | CSG {{$recepcion->id_emisor}} </h1>
	</div>
		<table style="width:100%; background-color:#ececec;">
  
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
		
	<table style="width:100%;">
		<tr>
			@isset($distribucion_calibre)
				<td>
					<img style="width:100%;" src="{{$distribucion_calibre}}" alt="" >
				</td>
			@endif
		
		
		</tr>
	</table>

	<table style="width:100%;">
		<tr>
			@isset($distribucion_color)
				<td>
					<img style="width:100%;" src="{{$distribucion_color}}" alt="" >
				</td>
			@endif
			@isset($distribucion_color_fondo)
				<td>
					<img style="width:100%;" src="{{$distribucion_color_fondo}}" alt="" >
				</td>
			@endif
			
		</tr>
	</table>
	
	<table style="width:100%;">
		<tr>
			@isset($firmezas_grande)
				<td>
					<img style="width:100%;" src="{{$firmezas_grande}}" alt="" >
				</td>
			@endif
		
		
		</tr>
	</table>
	<table style="width:100%;">
		<tr>
			@isset($firmezas_mediana)
				<td>
					<img style="width:100%;" src="{{$firmezas_mediana}}" alt="" >
				</td>
			@endif
		
		
		</tr>
	</table>
	<table style="width:100%;">
		<tr>
			@isset($firmezas_chica)
				<td>
					<img style="width:100%;" src="{{$firmezas_chica}}" alt="" >
				</td>
			@endif
		
		
		</tr>
	</table>
	
		
<table style="width:100%; border:1px solid black;  border-collapse: collapse;  text-align: center;">
	<tr style="width:100%; border:1px solid black;  border-collapse: collapse;">
		<th colspan="2" style="border:1px solid black;  border-collapse: collapse;">
			Corazon Acuoso
		</th>
		<th colspan="2" style="border:1px solid black;  border-collapse: collapse;">
			Corazon Mohoso
		</th>
	</tr>
	<tr style="border:1px solid black;">
		<td style="border:1px solid black;  border-collapse: collapse;">
			Leve
		</td>
		<td style="border:1px solid black;  border-collapse: collapse;">
			@if ($recepcion->calidad->detalles->where('tipo_item','CARAZÓN ACUOSO')->where('detalle_item','Leve')->first())
				{{$recepcion->calidad->detalles->where('tipo_item','CARAZÓN ACUOSO')->where('detalle_item','Leve')->first()->valor_ss}} %
			@else
			-
			@endif
		</td>
		<td style="border:1px solid black;  border-collapse: collapse;">
			Leve
		</td>
		<td style="border:1px solid black;  border-collapse: collapse;">
			@if ($recepcion->calidad->detalles->where('tipo_item','CORAZÓN MOHOSO')->where('detalle_item','Leve')->first())
				{{$recepcion->calidad->detalles->where('tipo_item','CORAZÓN MOHOSO')->where('detalle_item','Leve')->first()->valor_ss}} %
			@else
			-
			@endif
		</td>
	</tr>
	<tr style="border:1px solid black;">
		<td style="border:1px solid black;  border-collapse: collapse;">
			Moderado
		</td>
		<td style="border:1px solid black;  border-collapse: collapse;">
			@if ($recepcion->calidad->detalles->where('tipo_item','CARAZÓN ACUOSO')->where('detalle_item','Moderado')->first())
				{{$recepcion->calidad->detalles->where('tipo_item','CARAZÓN ACUOSO')->where('detalle_item','Moderado')->first()->valor_ss}} %
			@else
			-
			@endif
		</td>
		<td style="border:1px solid black;  border-collapse: collapse;">
			Moderado
		</td>
		<td style="border:1px solid black;  border-collapse: collapse;">
			@if ($recepcion->calidad->detalles->where('tipo_item','CORAZÓN MOHOSO')->where('detalle_item','Moderado')->first())
				{{$recepcion->calidad->detalles->where('tipo_item','CORAZÓN MOHOSO')->where('detalle_item','Moderado')->first()->valor_ss}} %
			@else
			-
			@endif
		</td>
	</tr>
	<tr style="border:1px solid black;  border-collapse: collapse;">
		<td style="border:1px solid black;  border-collapse: collapse;">
			Severo
		</td>
		<td style="border:1px solid black;  border-collapse: collapse;">
			@if ($recepcion->calidad->detalles->where('tipo_item','CARAZÓN ACUOSO')->where('detalle_item','Severo')->first())
				{{$recepcion->calidad->detalles->where('tipo_item','CARAZÓN ACUOSO')->where('detalle_item','Severo')->first()->valor_ss}} %
			@else
			-
			@endif
		</td>
		<td style="border:1px solid black;  border-collapse: collapse;">
			Severo
		</td>
		<td style="border:1px solid black;  border-collapse: collapse;">
			@if ($recepcion->calidad->detalles->where('tipo_item','CORAZÓN MOHOSO')->where('detalle_item','Severo')->first())
				{{$recepcion->calidad->detalles->where('tipo_item','CORAZÓN MOHOSO')->where('detalle_item','Severo')->first()->valor_ss}} %
			@else
			-
			@endif
		</td>
	</tr>
</table>


		
	{{-- comment
		  <div class="page-break"></div>
		 --}}


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
							@if ($d_calidad->count())
								@foreach ($d_calidad as $item)
									<div> <div style="display: inline;"> {{$item->detalle_item}}  </div>			<div style="display: inline; text-align: right; justify-items: end;">{{$item->cantidad}}%</div></div>
								@endforeach
								<div style="background-color:#47ac34; color: white; font-size: 12px; padding-left: 3px;"> <div style=""><b> TOTAL DEFECTOS DE CALIDAD </b></div>			<div style="text-align: left; justify-items: end;"><b>{{$item->cantidad}}%</b></div></div>
							@else
							-
							@endif
						</td>
						<td style="vertical-align: text-top;font-size: 14px;">
							@if ($d_condicion->count())
								@foreach ($d_condicion as $item)
									<div> <div style="display: inline;"> {{$item->detalle_item}}  </div>			<div style="display: inline; text-align: right; justify-items: end;">{{$item->cantidad}}%</div></div>
								@endforeach
								<div style="background-color:#47ac34; color: white; font-size: 12px; padding-left: 3px;"> <div style=""> <b>TOTAL DEFECTOS DE CONDICIÓN </b></div>			<div style="text-align: left; justify-items: end;"><b>{{$item->cantidad}}%</b></div></div>
							@else
							-
							@endif
						</td>
						<td style="vertical-align: text-top;font-size: 14px;">
							@if ($d_plaga->count())
								@foreach ($d_plaga as $item)
									<div> <div style="display: inline;"> {{$item->detalle_item}}  </div>			<div style="display: inline; text-align: right; justify-items: end;">{{$item->cantidad}}%</div></div>
								@endforeach
								<div style="background-color:#47ac34; color: white; font-size: 12px; padding-left: 3px;"> <div style=""><b> TOTAL DAÑOS DE PLAGA </b></div>			<div style="text-align: left; justify-items: end;"><b>{{$item->cantidad}}%</b></div></div>
							@else
							-
							@endif
						</td>
						<td style="vertical-align: text-top;font-size: 12px;">
							<table>
								<tr>
									<td>Materia Vegetal </td> <td style=" text-align: center; justify-items: center; background-color:#47ac34; color: white; padding-top: 4px; padding-bottom: 3px;padding-left: 7px; padding-right: 7px ">  
									@if ($recepcion->calidad->materia_vegetal==NULL)
										-
									@else
										{{$recepcion->calidad->materia_vegetal}}
									@endif 
								</td>
								</tr>
								<tr>
									<td> Presencia de Piedras </td> <td style=" text-align: center; justify-items: center; background-color:#47ac34; color: white; padding-top: 4px; padding-bottom: 3px;padding-left: 7px; padding-right: 7px "> 
										@if ($recepcion->calidad->piedras==NULL)
											-
										@else
											{{$recepcion->calidad->piedras}}
										@endif
									</td>
								</tr>
								<tr>
									<td>Precencia de Barro y/o <br> Polvo </td> <td style=" text-align: center; justify-items: center; background-color:#47ac34; color: white; padding-top: 4px; padding-bottom: 3px;padding-left: 7px; padding-right: 7px ">
										@if ($recepcion->calidad->barro==NULL)
											-
										@else
											{{$recepcion->calidad->barro}}
										@endif
									</td>
								</tr>
								<tr>
									<td>Llenado de Bins y/o Tottes  </td> <td style=" text-align: center; justify-items: center; background-color:#47ac34; color: white; padding-top: 4px; padding-bottom: 3px;padding-left: 7px; padding-right: 7px "> 
										@if ($recepcion->calidad->esponjas==NULL)
											-
										@else
											{{$recepcion->calidad->esponjas}}
										@endif
									 </td>
								</tr>
							</table>
							
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
	
			
	

	
</body>
</html>
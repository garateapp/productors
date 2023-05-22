<!DOCTYPE html>
<html>
<head>
	<title>Informe de Recepción Nro° {{$recepcion->numero_g_recepcion}}</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link href=”https://fonts.googleapis.com/css?family=Pacifico” rel=”stylesheet”>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/series-label.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
	<style>
		#container {
        height: 700px;
    }

	</style>
</head>
<body>

    <figure class="highcharts-figure mx-1 mt-4 h-screen">
        <div id="circular">
           
        </div>
     </figure>
	
	
				
			

             
         
    @php
        $series=[];

         if ($recepcion->calidad->detalles){

    
             foreach ($recepcion->calidad->detalles->where('tipo_item','COLOR DE FONDO') as $detalle){
                
                //$categories[]=$detalle->detalle_item;
                //$series[]=$detalle->porcentaje_muestra;
                             $name=$detalle->detalle_item;

                             $series[]=['name' =>$name,
                                          'y' => $detalle->porcentaje_muestra];
                 }
             } 
    @endphp
   <script>
 var series = <?php echo json_encode($series) ?>;
 
 Highcharts.chart('circular', {
         chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
         },
         title: {
            text: 'DISTRIBUCIÓN DE COLOR DE FONDO',
            align: 'left'
         },
         tooltip: {
            pointFormat: '<b><b>{point.y}</b>({point.percentage:.0f}%)<br/>',
         },
         accessibility: {
            point: {
                  valueSuffix: '%'
            }
         }, 
         legend: {
                        layout: 'vertical',
                        align: 'right',
                        verticalAlign: 'middle'
                    },
         colors: ['#24a745','#96AE51','#f9e8cf','#ffd700'],
         plotOptions: {
            pie: {
                     allowPointSelect: true,
                     cursor: 'pointer',
                     dataLabels: {
                        enabled: true,
                        inside: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                        distance: -50,
                        style: {
                            fontSize: '16px'
                        },
                     },
                     showInLegend: true
               }
         },
         series: [{
            name: 'Brands',
            colorByPoint: true,
            data: series
         }]
      });
      
   </script>
</body>
</html>
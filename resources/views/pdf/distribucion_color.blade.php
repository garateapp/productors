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
		#circular {
        height: 350px;
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

       
                foreach ($recepcion->calidad->detalles->where('tipo_item','COLOR DE CUBRIMIENTO') as $detalle){
          
             
                    //$categories[]=$detalle->detalle_item;
                    //$series[]=$detalle->porcentaje_muestra;
     
                                $name=$detalle->detalle_item;

                                if ($recepcion->n_especie=='Cherries') {
                                    $series[]=['name' =>$name,
                                    'y' => $detalle->valor_ss];
                                }else {
                                    $series[]=['name' =>$name,
                                    'y' => $detalle->porcentaje_muestra];
                                }
                    }
                }

         
            
    @endphp
    @if ($recepcion->n_especie=='Cherries')
        @php
            $colors=['#800000','#600000','#400000','#000000'];
        @endphp
    @elseif($recepcion->n_especie=='Apples')
        @php
            $colors=['#830d13','#E01620','#ED3F3F'];
        @endphp
     @elseif($recepcion->n_especie=='Peaches' || $recepcion->n_especie=='Nectarines' || $recepcion->n_especie=='Plums')
        @php
            $colors=['#e3e014','#722a1c','#722a1c'];
        @endphp
 
    @elseif($recepcion->n_especie=='Paltas')
        @php
            $colors=['#3f4729','#5c6c2d','#738813','#c0e22e'];
        @endphp

    @elseif($recepcion->n_especie=='Pears')
        @php
            $colors=['#78851b','#bec31f','#d9e53d'];
        @endphp
    @elseif($recepcion->n_especie=='Membrillos')
        @php
            $colors=['#fedf00','#bec31f','#d9eb00'];
        @endphp
    @elseif($recepcion->n_especie=='Orange' || $recepcion->n_especie=='Mandarinas')
        @php
             $colors=['#c6d406','#f8d34c','#fcad03','#fb8603'];
        @endphp
   @elseif($recepcion->n_variedad=='Dagen')
        @php
            $colors=['#70444d','#90595b','#56343b'];
        @endphp
    @else 
        @php
            $colors=['#24a745','#96AE51','#f9e8cf','#ffd700'];
        @endphp
    @endif
      <script>
    var series = <?php echo json_encode($series) ?>;
    var col = <?php echo json_encode($colors) ?>;
    
    Highcharts.chart('circular', {
            chart: {
               plotBackgroundColor: null,
               plotBorderWidth: null,
               plotShadow: false,
               type: 'pie'
            },
            title: {
               text: 'DISTRIBUCIÓN DE COLOR DE CUBRIMIENTO',
               align: 'left'
            },
            tooltip: {
               pointFormat: '<b><b>{point.y}</b>({point.percentage:.0f}%)<br/>',
            },
            legend: {
                        layout: 'vertical',
                        align: 'right',
                        verticalAlign: 'middle'
                    },
            accessibility: {
               point: {
                     valueSuffix: '%'
               }
            }, 
            colors: col,
            plotOptions: {
                series: {
                animation: false // Desactivar la animación de carga
                },
               pie: {
                     allowPointSelect: true,
                     cursor: 'pointer',
                     dataLabels: {
                        enabled: true,
                        inside: true,
                        format: '{point.percentage:.1f} %',
                        distance: -50,
                        filter: {
                            property: 'y',
                            operator: '>',
                            value: 5
                        },
                        style: {
                            fontSize: '22px'
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
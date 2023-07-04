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
        height: 200px;
    }

	</style>
</head>
<body>

    <figure class="highcharts-figure mx-1 mt-4">
        <div id="container">
           
        </div>
     </figure>


    
	
    @php
        $categories=[];
        $series=[];
    @endphp

    @if ($recepcion->calidad->detalles)
        @foreach ($recepcion->calidad->detalles->where('tipo_item','CHICO') as $detalle)
          
                @php
                    $categories[]=$detalle->detalle_item;
                    $series[]=$detalle->valor_ss;
                @endphp
         
        @endforeach
    @endif

    @if ($recepcion->n_especie=='Cherries')
        @php
            $colors=['#24a745'];
        @endphp
    @elseif($recepcion->n_especie=='Apples')
        @php
            $colors=['#831816'];
        @endphp
     @elseif($recepcion->n_especie=='Peaches' || $recepcion->n_especie=='Nectarines' || $recepcion->n_especie=='Plums')
        @php
            $colors=['#730000'];
        @endphp
    @elseif($recepcion->n_especie=='Pears')
        @php
            $colors=['#788527'];
        @endphp
    @elseif($recepcion->n_especie=='Membrillos')
        @php
            $colors=['#fddf09'];
        @endphp
    @else 
        @php
            $colors=['#24a745'];
        @endphp
    @endif
                    
	
    <script>
        var categories = <?php echo json_encode($categories) ?>;
        var series = <?php echo json_encode($series) ?>;
        var col = <?php echo json_encode($colors) ?>;

                Highcharts.chart('container', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'FIRMEZAS (lb) y BRIX / CHICO (125 al 216)'
            },
            legend: {
                        layout: 'vertical',
                        align: 'right',
                        verticalAlign: 'middle'
                    },
            xAxis: {
                categories: categories,
                crosshair: false
            },
            yAxis: {
               
                title: {
                    text: '%'
                }
            },
            colors: col,
            tooltip: {
                shared: true,
                headerFormat: '<span style="font-size: 15px">{point.point.name}</span><br/>',
                pointFormat: '<span style="color:{point.color}">\u25CF</span> {series.name}: <b>{point.y} %</b><br/>'
            },
            plotOptions: {
                column: {
                    pointPadding: 0,
                    borderWidth: 0
                }
            },
            series: [{
                name: '%',
                data: series,
                dataLabels: [{
                    enabled: true,
                    inside: true,
                    style: {
                        fontSize: '16px'
                    },
                    format: '{point.y:.1f}%'
                }]

            }]
        });
      </script>
</body>
</html>
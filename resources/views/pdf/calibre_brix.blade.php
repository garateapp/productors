<!DOCTYPE html>
<html>
<head>
	<title>Informe de Recepción Nro° {{$recepcion->numero_g_recepcion}}</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link href=”https://fonts.googleapis.com/css?family=Pacifico” rel=”stylesheet”>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://code.highcharts.com/highcharts.js" defer></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.highcharts.com/modules/series-label.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
	<style>
		#container {
        height: 350px;
    }

	</style>
</head>
<body>

    <figure class="mx-1 mt-4 highcharts-figure">
        <div id="container">

        </div>
     </figure>




    @php
        $categories=[];
        $series=[];
        //$items=['LIGHT','DARK','BLACK'];
    @endphp


        @if ($recepcion->calidad->detalles->where('tipo_item','SOLIDOS SOLUBLES')->count()>0)
            @foreach ($recepcion->calidad->detalles->where('tipo_item','SOLIDOS SOLUBLES') as $detalle)

                    @php
                        $categories[]=$detalle->detalle_item;
                        $series[]=$detalle->valor_ss;
                    @endphp

            @endforeach
        @else
                    @php
                        $categories[]='NONAME';
                        $series[]=0;
                    @endphp
        @endif



    @if ($recepcion->n_especie=='Cherries')
        @php
            $colors=['#800000','#400000','#000000'];
        @endphp
    @elseif($recepcion->n_variedad=='Dagen')
        @php
            $colors=['#70444d','#90595b','#56343b'];
        @endphp
    @else
        @php
            $colors=['#f18515'];
        @endphp
    @endif
    <script>
          $(document).ready(function() {
        var categories = <?php echo json_encode($categories) ?>;
        var series = <?php echo json_encode($series) ?>;
        var col = <?php echo json_encode($colors) ?>;

                Highcharts.chart('container', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'CALIBRE VS BRIX'
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
                min: 0,
                title: {
                    text: '°Brix'
                }
            },
            colors: col,
            tooltip: {
                shared: true,
                headerFormat: '<span style="font-size: 15px">{point.point.name}</span><br/>',
                pointFormat: '<span style="color:{point.color}">\u25CF</span> {series.name}: <b>{point.y}</b><br/>'
            },
            plotOptions: {
                column: {
                    pointPadding: 0,
                    borderWidth: 0
                }
            },
            series: [{
                name: '°BRIX',
                data: series,
                colorByPoint: true,
                dataLabels: [{
                    enabled: true,
                    inside: true,
                    style: {
                        fontSize: '16px'
                    },
                    format: '{point.y:.1f}'
                }]

            }]
        });
    });
      </script>
</body>
</html>

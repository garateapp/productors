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
        height: 200px;
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
    @endphp

    @if ($recepcion->calidad->detalles)
        @foreach ($recepcion->calidad->detalles->where('tipo_item','GRANDE') as $detalle)

                @php
                    $categories[]=$detalle->detalle_item;
                    $series[]=$detalle->valor_ss;
                @endphp

        @endforeach
    @endif

    @if ($recepcion->n_especie=='Cherries')
        @php
            $colors=['#24a745'];
            $titulo='FIRMEZAS (lb) y BRIX / GRANDE (30 al 48)';
        @endphp
    @elseif($recepcion->n_especie=='Apples')
        @php
            $colors=['#831816'];
            $titulo='FIRMEZAS (lb) y BRIX / GRANDE (56 al 88)';
        @endphp
    @elseif($recepcion->n_especie=='Plums')
        @php
            $colors=['#730000'];
            $titulo='FIRMEZAS (lb) y BRIX / GRANDE (32 al 48)';
        @endphp
        @elseif($recepcion->n_especie=='Peaches' || $recepcion->n_especie=='Nectarines')
        @php
            $colors=['#730000'];
            $titulo='FIRMEZAS (lb) y BRIX / GRANDE (24 al 48)';
        @endphp
    @elseif($recepcion->n_especie=='Pears')
        @php
            $colors=['#788527'];
            $titulo='FIRMEZAS (lb) y BRIX / GRANDE';
        @endphp
    @elseif($recepcion->n_especie=='Membrillos')
        @php
            $colors=['#fddf09'];
            $titulo='FIRMEZAS (lb) y BRIX / GRANDE (30 al 48)';
        @endphp
    @else
        @php
            $colors=['#24a745'];
            $titulo='FIRMEZAS (lb) y BRIX / GRANDE (30 al 48)';
        @endphp
    @endif

    <script>
          $(document).ready(function() {
        var titulo = <?php echo json_encode($titulo) ?>;
        var categories = <?php echo json_encode($categories) ?>;
        var series = <?php echo json_encode($series) ?>;
        var col = <?php echo json_encode($colors) ?>;

                Highcharts.chart('container', {
            chart: {
                type: 'column'
            },
            title: {
                text: titulo
            },
            xAxis: {
                categories: categories,
                crosshair: false
            },
            legend: {
                enabled: false
                    } ,
            yAxis: {
                min:0,
                max: 20,
                title: {
                    text: 'Lbs/°Brix'
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
                    format: '{point.y:.1f}'
                }]

            }]
        });
    });
      </script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Informe de Recepción Nro° {{$recepcion->numero_g_recepcion}}</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link href=”https://fonts.googleapis.com/css?family=Pacifico” rel=”stylesheet”>

    {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> --}}
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <!-- Correcto -->
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
        $colors=[];
        if ($recepcion->n_variedad=='Dagen') {
            $items=['<30','30-50','>50'];
        } else {
            $items=['LIGHT','DARK','BLACK'];
        }


    @endphp

    @foreach ($items as $item)
        @if ($recepcion->n_variedad=='Dagen')
            @if ($recepcion->calidad->detalles->where('tipo_item','BRIX DAGEN')->where('detalle_item',$item)->count()>0)
                @foreach ($recepcion->calidad->detalles->where('tipo_item','BRIX DAGEN')->where('detalle_item',$item) as $detalle)

                        @php
                            $categories[]=$detalle->detalle_item;
                            $series[]=$detalle->valor_ss;
                            if ($recepcion->n_variedad=='Dagen') {
                                    if ($detalle->detalle_item=='<30') {
                                        $colors[]='#D26FDE';
                                    }elseif ($detalle->detalle_item=='30-50') {
                                        $colors[]='#9817BB';
                                    }elseif($detalle->detalle_item=='>50'){
                                        $colors[]='#8C1651';
                                    }
                                }
                        @endphp


                @endforeach
            @else
                        @php
                            $categories[]=$item;
                            $series[]=0;
                        @endphp
            @endif

        @else
            @if ($recepcion->calidad->detalles->where('tipo_item','SOLIDOS SOLUBLES')->where('detalle_item',$item)->count()>0)
                @foreach ($recepcion->calidad->detalles->where('tipo_item','SOLIDOS SOLUBLES')->where('detalle_item',$item) as $detalle)

                        @php
                            $categories[]=$detalle->detalle_item;
                            $series[]=$detalle->valor_ss;
                        @endphp

                @endforeach
            @else
                        @php
                            $categories[]=$item;
                            $series[]=0;
                        @endphp
            @endif
        @endif
    @endforeach

    @if ($recepcion->n_especie=='Cherries')
        @php
            $colors=['#800000','#400000','#000000'];
        @endphp
    @elseif($recepcion->n_variedad=='Dagen')
        @php

        @endphp
    @else
        @php
            $colors=['#600000','#400000','#000000'];
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
                text: 'PROMEDIO BRIX'
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
                pointFormat: '<span style="color:{point.color}">\u25CF</span> {series.name}: <b>{point.y} °Brix</b><br/>'
            },
            plotOptions: {
                column: {
                    pointPadding: 0,
                    borderWidth: 0
                }
            },
            series: [{
                name: '',
                data: series,
                colorByPoint: true,
                dataLabels: [{
                    enabled: true,
                    inside: true,
                    style: {
                        fontSize: '16px'
                    },
                    format: '{point.y:.1f}°'
                }]

            }]
        });
    });
      </script>
</body>
</html>

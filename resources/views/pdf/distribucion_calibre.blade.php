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
	@if ($recepcion->n_especie=='Cherries')
        <style>
            #container {
            height: 360px;
        }
        </style>
    @else
        <style>
            #container {
            height: 280px;
        }
        </style>
    @endif
   
</head>
<body>

    <figure class="highcharts-figure mx-1 mt-4">
        <div id="container">
           
        </div>
     </figure>


    
	
     @php
        $categories=[];
        $series=[];
        $cantidad=0;
    @endphp

        @if ($recepcion->calidad->detalles)
                @foreach ($recepcion->calidad->detalles->where('tipo_item','DISTRIBUCIÓN DE CALIBRES') as $detalle)
                
                        @php
                           
                            if ($recepcion->n_especie=='Cherries') {
                                $cantidad+=$detalle->cantidad;
                            }else {
                                $cantidad+=$detalle->cantidad;
                            }
                            
                        @endphp
                
                @endforeach
        @endif
    @if ($recepcion->calidad->detalles)
        @foreach ($recepcion->calidad->detalles->where('tipo_item','DISTRIBUCIÓN DE CALIBRES') as $detalle)
          
                @php
                    $categories[]=$detalle->detalle_item;
                    if ($recepcion->n_especie=='Cherries') {
                        $series[]=$detalle->valor_ss;
                    }else {
                        if ($cantidad>0) {
                            $series[]=$detalle->porcentaje_muestra*100/$cantidad;
                        } else {
                            $series[]=$detalle->porcentaje_muestra;
                        }
                        
                        
                    }
                    
                @endphp
         
        @endforeach
    @endif
                    
	@if ($recepcion->n_especie=='Cherries')
        @php
            $colors=['#7f1710'];
        @endphp
    @elseif($recepcion->n_especie=='Apples')
        @php
            $colors=['#831816'];
        @endphp
    @elseif($recepcion->n_especie=='Pears')
        @php
            $colors=['#788527'];
        @endphp
    @elseif($recepcion->n_especie=='Paltas')
        @php
            $colors=['#5e6c28'];
        @endphp
    @elseif($recepcion->n_especie=='Membrillos')
        @php
            $colors=['#fddf09'];
        @endphp
    @elseif($recepcion->n_especie=='Orange'  || $recepcion->n_especie=='Mandarinas')
        @php
            $colors=['#f18515'];
        @endphp
    @elseif($recepcion->n_variedad=='Dagen')
        @php
            $colors=['#56343b'];
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
                text: 'Distribucion de Calibre'
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
                name: '% Según muestra',
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
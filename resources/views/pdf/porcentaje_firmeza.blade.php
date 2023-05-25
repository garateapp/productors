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
        height: 280px;
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
        $rangos=[279,219,179,1];
        $l=[];
        $d=[];
        $b=[];
        $light=0;
        $dark=0;
        $black=0;
    @endphp
    @foreach ($rangos as $rango)
        @foreach ($firmpro as $items)
            @php
                $n=1;
            @endphp
            @foreach ($items as $item)
            <p>{{$n.')'.$item}}</p> <br>
            
            @php
                if ($n==4) {
                    $firmeza=$item;
                }
                if ($n==13) {
                    $color=$item;
                }
                if ($n==14) {
                            

                    if ($firmeza>$rango) {
                            if($color=='Rojo'){
                                $light+=1;
                            }
                            if($color=='Rojo caoba'){
                                $dark+=1;
                            }
                            if($color=='Santina'){
                                $dark+=1;
                            }
                            if($color=='Caoba oscuro'){
                                $black+=1;
                            }
                            if($color=='Negro'){
                                $black+=1;
                            }
                    }
                   


                }
                $n+=1;
            @endphp
            @endforeach
           
            
        @endforeach
        @php
            $l[]=$light;
            $d[]=$dark;
            $b[]=$black;
        @endphp
    @endforeach
    @if ($recepcion->calidad->detalles)
        @foreach ($recepcion->calidad->detalles->where('tipo_item','DISTRIBUCIÓN DE CALIBRES') as $detalle)
          
                @php
                    $categories[]=$detalle->detalle_item;
                    if ($recepcion->n_especie=='Cherries') {
                        $series[]=$detalle->valor_ss;
                        $rango1[]=$detalle->valor_ss;
                    }else {
                        $series[]=$detalle->porcentaje_muestra;
                        $rango1[]=$detalle->porcentaje_muestra;
                    }
                    
                @endphp
         
        @endforeach
    @endif
                    
	
    <script>
        var categories = <?php echo json_encode($categories) ?>;
        var l = <?php echo json_encode($l) ?>;
        var d = <?php echo json_encode($d) ?>;
        var b = <?php echo json_encode($b) ?>;

                Highcharts.chart('container', {
            chart: {
                type: 'column'
            },
            title: {
                text: '% Distribución de Firmezas por Segregación de Color'
            },
            legend: {
                        layout: 'vertical',
                        align: 'right',
                        verticalAlign: 'middle'
                    },
            xAxis: {
                categories: ['RANGO 1','RANGO 2','RANGO 3','RANGO 4',],
                crosshair: false
            },
            yAxis: {
                min: 0,
                title: {
                    text: '%'
                }
            },
            colors: ['#24a745'],
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
            series: [
                {
                name: 'LIGHT',
                data: l,
                dataLabels: [{
                    enabled: true,
                    inside: true,
                    style: {
                        fontSize: '16px'
                    },
                    format: '{point.y:.2f}%'
                }]}
                ,{
                name: 'DARK',
                data: d,
                dataLabels: [{
                    enabled: true,
                    inside: true,
                    style: {
                        fontSize: '16px'
                    },
                    format: '{point.y:.2f}%'
                }]}
                ,{
                name: 'BLACK',
                data: b,
                dataLabels: [{
                    enabled: true,
                    inside: true,
                    style: {
                        fontSize: '16px'
                    },
                    format: '{point.y:.2f}%'
                }]}
                
            ]
        });
      </script>
</body>
</html>
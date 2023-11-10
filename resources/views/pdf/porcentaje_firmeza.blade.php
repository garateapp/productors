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
        height: 310px;
    }

	</style>
</head>
<body>

    <figure class="highcharts-figure mx-1 mt-4">
        <div id="container">
           
        </div>
     </figure>


    
	{{-- comment 
     @php
        $categories=[];
        $series=[];
        $rangos=[279,219,179,1];
        $l=[];
        $d=[];
        $b=[];
        
       
    @endphp
    @foreach ($rangos as $rango)
        @php
            $light=0;
            $dark=0;
            $black=0;
            $tlight=0;
            $tdark=0;
            $tblack=0;
        @endphp 
        @foreach ($firmpro as $items)
            @php
                $n=1;
            @endphp
            @foreach ($items as $item)
          
            
            @php
                if ($n==4) {
                    $firmeza=$item;
                }
                if ($n==13) {
                    $color=$item;
                }
                if ($n==14) {
                    
                            if($color=='Rojo'){
                                $tlight+=1;
                            }
                            if($color=='Rojo caoba'){
                                $tdark+=1;
                            }
                            if($color=='Santina'){
                                $tdark+=1;
                            }
                            if($color=='Caoba oscuro'){
                                $tblack+=1;
                            }
                            if($color=='Negro'){
                                $tblack+=1;
                            }
                            

                    if ($rango==279) {
                        if ($firmeza>=280) {
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
                    if ($rango==219) {
                        if ($firmeza>=220 && $firmeza<280) {
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
                    if ($rango==179) {
                        if ($firmeza>=180 && $firmeza<220) {
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
                    if ($rango==1) {
                        if ($firmeza>=1 && $firmeza<180) {
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
                   


                }
                $n+=1;
            @endphp
            @endforeach
           
            
        @endforeach
       
    @endforeach
 --}}

    @if ($recepcion->calidad->detalles)
        @foreach ($recepcion->calidad->detalles->where('tipo_item','DISTRIBUCIÓN DE FIRMEZA')->where('detalle_item','LIGHT') as $detalle)
          
                @php
                        $l[]=$detalle->valor_ss;
                   
                @endphp
         
        @endforeach
        @foreach ($recepcion->calidad->detalles->where('tipo_item','DISTRIBUCIÓN DE FIRMEZA')->where('detalle_item','DARK') as $detalle)
          
                @php
                        $d[]=$detalle->valor_ss;
                @endphp
         
        @endforeach
        @foreach ($recepcion->calidad->detalles->where('tipo_item','DISTRIBUCIÓN DE FIRMEZA')->where('detalle_item','BLACK') as $detalle)
          
                @php
                        $b[]=$detalle->valor_ss;
                @endphp
         
        @endforeach
    @endif
                    
	@if ($recepcion->n_especie=='Cherries')
        @php
            $colors=['#dc0c15','#71160e','#2b1d16'];
        @endphp
    @elseif($recepcion->n_especie=='Apples')
        @php
            $colors=['#831816'];
        @endphp
    @elseif($recepcion->n_especie=='Pears')
        @php
            $colors=['#788527'];
        @endphp
    @elseif($recepcion->n_variedad=='Dagen')
        @php
            $colors=['#70444d','#90595b','#56343b'];
        @endphp
    @else 
        @php
            $colors=['#24a745'];
        @endphp
    @endif
    <script>
        var col = <?php echo json_encode($colors) ?>;
        var l = <?php echo json_encode($l) ?>;
        var d = <?php echo json_encode($d) ?>;
        var b = <?php echo json_encode($b) ?>;

                Highcharts.chart('container', {
            chart: {
                type: 'column',
                 overflow: 'justify'
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
                categories: ['Muy Firme >280 - 1000 <br>Durofel >75','Firme 200 - 279 <br> Durofel 72 - 74.9','Sensible 180 - 199 <br> Durofel 65 - 69.9','Blando 0,1 - 179<br>  Durofel <65,4'],
                crosshair: false
            },
            yAxis: {
                max: 100,
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
                dataLabels: {
                    enabled: true,
                    inside: true,
                    style: {
                        fontSize: '9px'
                    },
                    format: '{point.y:.1f}%'
                },
                pointPadding: 0.01,
                borderWidth: 1.9            }
        },
            series: [
                {
                name: 'LIGHT',
                data: l,
                dataLabels: [{
                    enabled: true,
                    inside: true,
                    style: {
                        fontSize: '9px'
                    },
                    format: '{point.y:.1f}%'
                }]}
                ,{
                name: 'DARK',
                data: d,
                dataLabels: [{
                    enabled: true,
                    inside: true,
                    style: {
                        fontSize: '9px'
                    },
                    format: '{point.y:.1f}%'
                }]}
                ,{
                name: 'BLACK',
                data: b,
                dataLabels: [{
                    enabled: true,
                    inside: true,
                    style: {
                        fontSize: '9px'
                    },
                    format: '{point.y:.1f}%'
                }]}
                
            ]
        });
      </script>
</body>
</html>
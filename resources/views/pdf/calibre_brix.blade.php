<!DOCTYPE html>
<html>
<head>
	<title>Informe de Recepción Nro° {{$recepcion->numero_g_recepcion}}</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link href=”https://fonts.googleapis.com/css?family=Pacifico” rel=”stylesheet”>

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

	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
          $(document).ready(function() {

        var categories = <?php echo json_encode($categories) ?>;
        var series = <?php echo json_encode($series) ?>;
        var col = <?php echo json_encode($colors) ?>;
        console.log(categories);
        console.log(series);
        console.log(col);

        var ctx = document.getElementById('barChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: categories,
                    datasets: [{
                        label: '°Brix',
                        data: series,
                        backgroundColor: colors,
                        borderColor: colors,
                        borderWidth: 1,
                        datalabels: {
                            anchor: 'end',
                            align: 'top',
                            font: {
                                size: 16
                            },
                            formatter: function (value) {
                                return value.toFixed(1);
                            }
                        }
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function (tooltipItem) {
                                    return tooltipItem.label + ': ' + tooltipItem.raw.toFixed(1);
                                }
                            }
                        },
                        datalabels: {
                            anchor: 'end',
                            align: 'top',
                            font: {
                                size: 16
                            }
                        }
                    },
                    scales: {
                        x: {
                            beginAtZero: true
                        },
                        y: {
                            min: 0,
                            title: {
                                display: true,
                                text: '°Brix'
                            }
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>

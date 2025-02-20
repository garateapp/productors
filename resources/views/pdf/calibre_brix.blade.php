<!DOCTYPE html>
<html>
<head>
	<title>Informe de Recepción Nro° {{$recepcion->numero_g_recepcion}}</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link href=”https://fonts.googleapis.com/css?family=Pacifico” rel=”stylesheet”>

    <style>
		#container {
            /* height: 200px !important;

            width: 100% !important; */
            .container {
    position: relative;
    max-width: 800px;
    margin: 20px auto;
    aspect-ratio: 16/9; /* Ratio 1:1 para gráficos circulares */
    /* Para gráficos de barras: aspect-ratio: 16/9; */
}
}

.container canvas {
    width: 100%!important;
    height: 100%!important;
}
	</style>
</head>
<body>

    <figure class="container mx-1 mt-4" id="container">
        <div id="container2">

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
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>
    <script>
          $(document).ready(function() {
            Chart.register(ChartDataLabels);
        var categories = <?php echo json_encode($categories) ?>;
        var series = <?php echo json_encode($series) ?>;
        var col = <?php echo json_encode($colors) ?>;
        console.log(categories);
        console.log(series);
        console.log(col);

        var ctx = document.getElementById('container2').getContext('2d');
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
                    aspectRatio: 16/9, // Ratio directo en Chart.js (sobrescribe CSS)
    responsive: true,
    maintainAspectRatio: true, // Activa el cálculo automático
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function (tooltipItem) {
                                    return tooltipItem.label + ': ' + tooltipItem.raw.toFixed(1);
                                }
                            }
                        },
                        datalabels: {
                        anchor: 'center', // Posición del label
                        align: 'center', // Alineación del texto
                        color: '#fff', // Color del texto
                        font: {
                            size: 12,
                            weight: 'bold'
                        },
                        formatter: function(value) {
                            return value.toFixed(1) + '%'; // Formato con 1 decimal
                        },
                        offset: 4, // Espaciado desde la barra
                        clamp: true // Evitar que salgan del canvas
                    },
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

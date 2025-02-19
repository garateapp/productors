<!DOCTYPE html>
<html>
<head>
	<title>Informe de Recepción Nro° {{$recepcion->numero_g_recepcion}}</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link href=”https://fonts.googleapis.com/css?family=Pacifico” rel=”stylesheet”>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<style>
		#container {
        height: 200px;
    }

	</style>
</head>
<body>

    <figure class="mx-1 mt-4 highcharts-figure">
        <canvas id="container">

        </canvas>
     </figure>




    @php
        $categories=[];
        $series=[];
    @endphp

    @if ($recepcion->calidad->detalles)
        @foreach ($recepcion->calidad->detalles->where('tipo_item','MEDIANO') as $detalle)

                @php
                    $categories[]=$detalle->detalle_item;
                    $series[]=$detalle->valor_ss;
                @endphp

        @endforeach
    @endif

    @if ($recepcion->n_especie=='Cherries')
        @php
            $colors=['#24a745'];
            $titulo='FIRMEZAS (lb) y BRIX / MEDIANO (52 al 56)';
        @endphp
    @elseif($recepcion->n_especie=='Apples')
        @php
            $colors=['#831816'];
            $titulo='FIRMEZAS (lb) y BRIX / MEDIANO (100 al 113)';
        @endphp
     @elseif($recepcion->n_especie=='Peaches' || $recepcion->n_especie=='Nectarines')
        @php
            $colors=['#730000'];
            $titulo='FIRMEZAS (lb) y BRIX / MEDIANO (52 al 56)';
        @endphp
        @elseif($recepcion->n_especie=='Plums')
        @php
            $colors=['#730000'];
            $titulo='FIRMEZAS (lb) y BRIX / MEDIANO (52 al 66)';
        @endphp
    @elseif($recepcion->n_especie=='Pears')
        @php
            $colors=['#788527'];
            $titulo='FIRMEZAS (lb) y BRIX / MEDIANO';
        @endphp
    @elseif($recepcion->n_especie=='Membrillos')
        @php
            $colors=['#fddf09'];
            $titulo='FIRMEZAS (lb) y BRIX / MEDIANO (52 al 56)';
        @endphp
    @else
        @php
            $colors=['#24a745'];
            $titulo='FIRMEZAS (lb) y BRIX / MEDIANO (52 al 56)';
        @endphp
    @endif


    <script>
          $(document).ready(function() {
        var titulo = <?php echo json_encode($titulo) ?>;
        var categories = <?php echo json_encode($categories) ?>;
        var series = <?php echo json_encode($series) ?>;
        var col = <?php echo json_encode($colors) ?>;

                var ctx=document.getElementById('container').getContext('2d');
                    new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: categories,
                    datasets: [{
                        label: titulo,
                        data: series,
                        backgroundColor: colors,
                        borderColor: colors.map(color => color.replace("#", "rgba(") + ", 1)"),
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Lbs/°Brix'
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function (tooltipItem) {
                                    return tooltipItem.raw.toFixed(1) + ' %';
                                }
                            }
                        }
                    }
                }
            });
        });
      </script>
</body>
</html>

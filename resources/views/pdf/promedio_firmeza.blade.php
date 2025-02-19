<!DOCTYPE html>
<html>
<head>
	<title>Informe de Recepción Nro° {{$recepcion->numero_g_recepcion}}</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link href=”https://fonts.googleapis.com/css?family=Pacifico” rel=”stylesheet”>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    {{-- <script src="https://code.highcharts.com/highcharts.js" defer></script> --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- <script src="https://code.highcharts.com/modules/series-label.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script> --}}
	<style>
		#container {
        height: 350px;
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
        @if ($recepcion->n_variedad=='Dagen')
            @foreach ($recepcion->calidad->detalles->where('tipo_item','FIRMEZAS') as $detalle)

                    @php
                        $categories[]=$detalle->detalle_item;
                        if ($recepcion->n_especie=='Cherries') {
                            $series[]=$detalle->valor_ss;
                        }else {
                            $series[]=$detalle->porcentaje_muestra;
                        }

                    @endphp
            @endforeach
        @else
            @foreach ($recepcion->calidad->detalles->where('tipo_item','FIRMEZAS') as $detalle)

                @if ($detalle->detalle_item=='LIGHT' || $detalle->detalle_item=='DARK' || $detalle->detalle_item=='BLACK')
                    @php
                        $categories[]=$detalle->detalle_item;
                        if ($recepcion->n_especie=='Cherries') {
                            $series[]=$detalle->valor_ss;
                        }else {
                            $series[]=$detalle->porcentaje_muestra;
                        }

                    @endphp
                @endif
            @endforeach
        @endif
    @endif

    @if ($recepcion->n_especie=='Cherries')
         @php
            $colors=['#800000','#400000','#000000'];
        @endphp
    @elseif($recepcion->n_variedad=='Dagen')
        @php
            $colors=['#9817BB'];
        @endphp
    @else
        @php
            $colors=['#24a745'];
        @endphp
    @endif
    <script>
        $(document).ready(function() {
            var categories = <?php echo json_encode($categories); ?>;
            var series = <?php echo json_encode($series); ?>;
            var colors = <?php echo json_encode($colors); ?>;

            console.log(categories);
            console.log(series);
            console.log(colors);

            var ctx = document.getElementById("container").getContext("2d");

            new Chart(ctx, {
                type: "bar",
                data: {
                    labels: categories,
                    datasets: [{
                        label: "Firmeza (gf/mm)",
                        data: series,
                        backgroundColor: colors,
                        borderColor: colors,
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { position: "top" },
                        title: { display: true, text: "PROMEDIO FIRMEZAS (gf/mm)" },
                        datalabels: {
                        anchor: 'end',
                        align: 'top',
                        color: '#fff',
                        font: {
                            size: 14,
                            weight: 'bold'
                        },
                        formatter: (value) => `${value}`,
                        clamp: true
                    }
                    },

                    scales: {
                        x: {
                            title: { display: true, text: "Categorías" }
                        },
                        y: {
                            beginAtZero: true,
                            title: { display: true, text: "(gf/mm)" }
                        }
                    }
                }
            });
        });
    </script>

</body>
</html>

<!DOCTYPE html>
<html>

<head>
    <title>Informe de Recepción Nro° {{ $recepcion->numero_g_recepcion }}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href=”https://fonts.googleapis.com/css?family=Pacifico” rel=”stylesheet”>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    {{-- <script src="https://code.highcharts.com/highcharts.js" defer></script> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- <script src="https://code.highcharts.com/modules/series-label.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script> --}}
    <style>
        .container {
            position: relative;
            max-width: 800px;
            margin: 20px auto;
            aspect-ratio: 16/9;
            /* Ratio 1:1 para gráficos circulares */
            /* Para gráficos de barras: aspect-ratio: 16/9; */
        }

        .container canvas {
            width: 100% !important;
            height: 100% !important;
        }
    </style>
</head>

<body>

    <figure class="container mx-1 mt-4" id="container" style="height:60vh; width:60vw">
        <canvas id="container2">

        </canvas>
    </figure>




    @php
        $categories = [];
        $series = [];
    @endphp

    @if ($recepcion->calidad->detalles)
        @foreach ($recepcion->calidad->detalles->where('tipo_item', 'CHICO') as $detalle)
            @php
                $categories[] = $detalle->detalle_item;
                $series[] = $detalle->valor_ss;
            @endphp
        @endforeach
    @endif

    @if ($recepcion->n_especie == 'Cherries')
        @php
            $colors = ['#24a745'];
            $titulo = 'FIRMEZAS (lb) y BRIX / CHICO (125 al 216)';
        @endphp
    @elseif($recepcion->n_especie == 'Apples')
        @php
            $colors = ['#831816'];
            $titulo = 'FIRMEZAS (lb) y BRIX / CHICO (125 al 216)';
        @endphp
    @elseif($recepcion->n_especie == 'Peaches' || $recepcion->n_especie == 'Nectarines')
        @php
            $colors = ['#730000'];
            $titulo = 'FIRMEZAS (lb) y BRIX / CHICO (60 a 78)';
        @endphp
    @elseif($recepcion->n_especie == 'Plums')
        @php
            $colors = ['#730000'];
            $titulo = 'FIRMEZAS (lb) y BRIX / CHICO (72 a 120)';
        @endphp
    @elseif($recepcion->n_especie == 'Pears')
        @php
            $colors = ['#788527'];
            $titulo = 'FIRMEZAS (lb) y BRIX / CHICO';
        @endphp
    @elseif($recepcion->n_especie == 'Membrillos')
        @php
            $colors = ['#fddf09'];
            $titulo = 'FIRMEZAS (lb) y BRIX / CHICO (125 al 216)';
        @endphp
    @else
        @php
            $colors = ['#24a745'];
            $titulo = 'FIRMEZAS (lb) y BRIX / CHICO (125 al 216)';
        @endphp
    @endif


    <script>
        $(document).ready(function() {
            Chart.register(ChartDataLabels);
            var titulo = <?php echo json_encode($titulo); ?>;
            var categories = <?php echo json_encode($categories); ?>;
            var series = <?php echo json_encode($series); ?>;
            var col = <?php echo json_encode($colors); ?>;
            var ctx = document.getElementById('container2').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: categories,
                    datasets: [{
                        label: titulo,
                        data: series,
                        backgroundColor: col,
                        borderColor: col.map(color => color.replace("#", "rgba(") + ", 1)"),
                        borderWidth: 1
                    }]
                },

                options: {
                    aspectRatio: 16 / 9, // Ratio directo en Chart.js (sobrescribe CSS)
                    responsive: true,
                    maintainAspectRatio: false, // Activa el cálculo automático
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Lbs/°Brix'
                            },
                            grid: {
                                drawOnChartArea: false // ❌ Evita que se dibujen líneas en el área del gráfico
                            }
                        },
                        x: {
                            grid: {
                                drawOnChartArea: false // ❌ Evita que se dibujen líneas en el área del gráfico
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    return tooltipItem.raw.toFixed(1) + '';
                                }
                            }
                        },
                        title: {
                            display: true,
                            text: titulo
                        },
                        datalabels: {
                            anchor: function(context) {
                                let value = context.dataset.data[context.dataIndex];
                                return value < 5 ? 'end' :
                                    'center'; // Mueve etiquetas pequeñas hacia afuera
                            }, // Posición del label
                            align: 'center', // Alineación del texto
                            //color: '#c0c3c0', // Color del texto
                            color: function(context) {
                                return context.raw < 6 ? "black" : "white"; // Menos de 6: texto negro
                            },
                            backgroundColor: function(context) {
                                return context.raw < 6 ? "white" :
                                "rgba(0, 0, 0, 0.7)"; // Menos de 6: fondo blanco
                            },
                            borderColor: function(context) {
                                return context.raw < 6 ? "black" :
                                "transparent"; // Menos de 6: borde negro
                            },
                            borderWidth: function(context) {
                                return context.raw < 6 ? 2 : 0; // Menos de 6: borde visible
                            },
                            borderRadius: 4,
                            padding: 4,
                            offset: function(context) {
                                let value = context.dataset.data[context.dataIndex];
                                return value < 5 ? 45 : 0; // Agrega espacio a los valores pequeños
                            },
                            font: {
                                size: 14,
                                weight: 'bold'
                            },
                            formatter: function(value) {
                                return value.toFixed(1) + ''; // Formato con 1 decimal
                            },
                            //offset: 4, // Espaciado desde la barra
                            clamp: true // Evitar que salgan del canvas
                        }
                    }
                }
            });
        });
    </script>
</body>

</html>

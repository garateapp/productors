<!DOCTYPE html>
<html>

<head>
    <title>Informe de Recepción Nro° {{ $recepcion->numero_g_recepcion }}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href=”https://fonts.googleapis.com/css?family=Pacifico” rel=”stylesheet”>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .container {
            position: relative;
            margin: 20px auto;
            aspect-ratio: 1;
            max-width: 600px;

            /* Ratio 1:1 para gráficos circulares */
            /* Para gráficos de barras: aspect-ratio: 16/9; */

        }

        .container canvas {
            width: 100%!important;
    height: 100%!important;
        }
    </style>
</head>

<body>

    <figure class="container" id="container" style="height:90vh; width:90vw">
        <canvas id="container2">

        </canvas>
    </figure>







    @php
    $datalabelColor="#fff";
        $series = [];

        if ($recepcion->calidad->detalles) {
            foreach ($recepcion->calidad->detalles->where('tipo_item', 'COLOR DE FONDO') as $detalle) {
                //$categories[]=$detalle->detalle_item;
                //$series[]=$detalle->porcentaje_muestra;
                $name = $detalle->detalle_item;

                $series[] = ['name' => $name, 'y' => $detalle->porcentaje_muestra];

                if ($recepcion->n_variedad == 'Dagen') {
                    if ($name == 'VERDE') {
                        $colors[] = '#ABAB3B';
                    } elseif ($name == 'VERDE CREMA') {
                        $colors[] = '#DFF95D';
                    } elseif ($name == 'CREMA') {
                        $colors[] = '#F0E770';
                    } elseif ($name == 'AMARILLO') {
                        $colors[] = '#E8DA20';
                    }
                    $datalabelColor="#333";
                }
            }
        }

    @endphp

    @if ($recepcion->n_especie == 'Cherries')
        @php
            $colors = ['#24a745', '#96AE51', '#f9e8cf', '#ffd700'];
        @endphp
    @elseif($recepcion->n_especie == 'Apples')
        @php
            $colors = ['#abab3b', '#DFF95D', '#f0e770', '#e8da20'];
        @endphp
    @elseif($recepcion->n_especie == 'Pears')
        @php
            $colors = ['#abab3b', '#DFF95D', '#F0E770', '#E8DA20'];
        @endphp
    @elseif($recepcion->n_especie == 'Membrillos')
        @php
            $colors = ['#abab3b', '#dff95d', '#f0e770', '#e8da20'];
        @endphp
    @elseif($recepcion->n_variedad == 'Dagen')
        @php

        @endphp
    @else
        @php
            $colors = ['#24a745', '#96AE51', '#f9e8cf', '#ffd700'];
        @endphp
    @endif
    <script>
        $(document).ready(function() {
            // Registrar plugins necesarios
            Chart.register(ChartDataLabels);

            const series = <?php echo json_encode($series); ?>;
            const col = <?php echo json_encode($colors); ?>;

            // Mapear datos a formato Chart.js
            const labels = series.map(item => item.name);
            const data = series.map(item => item.y);

            const ctx = document.getElementById('container2').getContext('2d');

            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        data: data,
                        backgroundColor: col,
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        title: {
                            display: true,
                            text: 'DISTRIBUCIÓN DE COLOR DE FONDO',
                            align: 'start',
                            font: {
                                size: 18
                            },
                            padding: 20
                        },
                        legend: {
                            position: 'right',
                        },
                        tooltip: {
                            callbacks: {
                                label: (context) => {
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = ((context.raw / total) * 100).toFixed(0);
                                    return `${context.label}: ${context.raw} (${percentage}%)`;
                                }
                            }
                        },
                        datalabels: {
                            color: '#666',
                            font: {
                                size: 12,
                                weight: 'bold'
                            },
                            formatter: (value, context) => {
                                const total = context.chart.data.datasets[0].data.reduce((a, b) => a +
                                    b, 0);
                                const percentage = ((value / total) * 100).toFixed(1);
                                return value > total * 0.01 ? `${percentage}%` : '';
                            },
                            anchor: 'end',
                            align: 'center',
                            clamp:false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                drawOnChartArea: false
                            }

                        },
                        x: {
                            grid: {
                                drawOnChartArea: false
                            }
                        }
                    },
                    animation: false
                },
                layout: {
                    padding: {
                        top: 20,
                        right: 30,
                        bottom: 20,
                        left: 30
                    }
                }
            });
        });
    </script>
</body>

</html>

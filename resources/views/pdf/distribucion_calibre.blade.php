<!DOCTYPE html>
<html>

<head>
    <title>Informe de Recepción Nro° {{ $recepcion->numero_g_recepcion }}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href=”https://fonts.googleapis.com/css?family=Pacifico” rel=”stylesheet”>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    @if ($recepcion->n_especie == 'Cherries')
        <style>
            #container {
                height: 360px;
            }
        </style>
    @else
        <style>
            #container {
                max-height: 250px;
            }

            canvas {
                width: 100% !important;
                height: auto !important;
            }
        </style>
    @endif

</head>

<body>

    <figure class="mx-1 mt-4">
        <canvas id="container"></canvas>
    </figure>




    @php
        $categories = [];
        $series = [];
        $cantidad = 0;
    @endphp

    @if ($recepcion->calidad->detalles)
        @foreach ($recepcion->calidad->detalles->where('tipo_item', 'DISTRIBUCIÓN DE CALIBRES') as $detalle)
            @php

                if ($recepcion->n_especie == 'Cherries') {
                    $cantidad += $detalle->cantidad;
                } else {
                    $cantidad += $detalle->cantidad;
                }

            @endphp
        @endforeach
    @endif
    @if ($recepcion->calidad->detalles)
        @foreach ($recepcion->calidad->detalles->where('tipo_item', 'DISTRIBUCIÓN DE CALIBRES') as $detalle)
            @php
                $categories[] = $detalle->detalle_item;
                if ($recepcion->n_especie == 'Cherries') {
                    $series[] = $detalle->valor_ss;
                } else {
                    if ($cantidad > 0) {
                        $series[] = ($detalle->porcentaje_muestra * 100) / $cantidad;
                    } else {
                        $series[] = $detalle->porcentaje_muestra;
                    }
                }

            @endphp
        @endforeach
    @endif

    @if ($recepcion->n_especie == 'Cherries')
        @php
            $colors = ['#7f1710'];
        @endphp
    @elseif($recepcion->n_especie == 'Apples')
        @php
            $colors = ['#831816'];
        @endphp
    @elseif($recepcion->n_especie == 'Pears')
        @php
            $colors = ['#788527'];
        @endphp
    @elseif($recepcion->n_especie == 'Paltas')
        @php
            $colors = ['#5e6c28'];
        @endphp
    @elseif($recepcion->n_especie == 'Membrillos')
        @php
            $colors = ['#fddf09'];
        @endphp
    @elseif($recepcion->n_especie == 'Orange' || $recepcion->n_especie == 'Mandarinas')
        @php
            $colors = ['#f18515'];
        @endphp
    @elseif($recepcion->n_variedad == 'Dagen')
        @php
            $colors = ['#9817BB'];
        @endphp
    @else
        @php
            $colors = ['#24a745'];
        @endphp
    @endif
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>
    <script>
        $(document).ready(function() {
            Chart.register(ChartDataLabels);

            var ctx = document.getElementById('container').getContext('2d');

            var chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: <?php echo json_encode($categories); ?>,
                    datasets: [{
                        label: '', //'% Según muestra',
                        data: <?php echo json_encode($series); ?>,
                        backgroundColor: <?php echo json_encode($colors); ?>,
                        borderColor: <?php echo json_encode($colors); ?>,
                        borderWidth: 1,

                    }]
                },
                options: {
                    // Ratio directo en Chart.js (sobrescribe CSS)
                    responsive: true,
                    maintainAspectRatio: false, // Activa el cálculo automático
                    aspectRatio: 2.5, // Establece la relación de aspecto deseada
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Calibre'
                            },
                            grid: {
                                drawOnChartArea: false // ❌ Evita que se dibujen líneas en el área del gráfico
                            }
                        },
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: '%'
                            },
                            ticks: {
                                callback: function(value) {
                                    return value + '%';
                                }
                            },
                            grid: {
                                drawOnChartArea: false // ❌ Evita que se dibujen líneas en el área del gráfico
                            }
                        }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    return tooltipItem.dataset.label + ': ' + tooltipItem.raw.toFixed(
                                        1) + '%';
                                }
                            }
                        },
                        datalabels: {
                            display: true
                        },
                        datalabels: {
                            anchor: 'center', // Posición del label
                            align: 'center', // Alineación del texto
                            color: '#fff', // Color del texto
                            font: {
                                size: 16,
                                weight: 'bold'
                            },
                            formatter: function(value) {
                                return value.toFixed(1) + '%'; // Formato con 1 decimal
                            },
                            offset: 4, // Espaciado desde la barra
                            clamp: true // Evitar que salgan del canvas
                        }
                    },
                    layout: {
                        padding: {
                            top: 20,
                            right: 30,
                            bottom: 20,
                            left: 30
                        }
                    }
                }
            });
        });
    </script>
</body>

</html>

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
    max-width: 800px;
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

    <figure class="container h-screen mx-1 mt-4" id="container">

        <canvas id="container2"></canvas>


    </figure>



    @php
        $series = [];
        $colors = [];

        if ($recepcion->calidad->detalles) {
            foreach ($recepcion->calidad->detalles->where('tipo_item', 'COLOR DE CUBRIMIENTO') as $detalle) {
                //$categories[]=$detalle->detalle_item;
                //$series[]=$detalle->porcentaje_muestra;

                $name = $detalle->detalle_item;

                if ($recepcion->n_especie == 'Cherries') {
                    $series[] = ['name' => $name, 'y' => $detalle->valor_ss];
                } else {
                    $series[] = ['name' => $name, 'y' => $detalle->porcentaje_muestra];
                }

                if ($recepcion->n_especie == 'Cherries') {
                    if ($name == 'Fuera de Color') {
                        $colors[] = '#FF9999';
                    } elseif ($name == 'ROJO') {
                        $colors[] = '#FF0000';
                    } elseif ($name == 'ROJO CAOBA') {
                        $colors[] = '#D60000';
                    } elseif ($name == 'SANTINA') {
                        $colors[] = '#960000';
                    } elseif ($name == 'CAOBA OSCURO') {
                        $colors[] = '#640000';
                    } elseif ($name == 'NEGRO') {
                        $colors[] = '#000000';
                    }
                }
                if ($recepcion->n_especie == 'Peaches' || $recepcion->n_especie == 'Nectarines') {
                    if ($name == '<30') {
                        $colors[] = '#F0E770';
                    } elseif ($name == '30-50') {
                        $colors[] = '#f05e5e';
                    } elseif ($name == '50-70') {
                        $colors[] = '#e01620';
                    } elseif ($name == '>70') {
                        $colors[] = '#830d13';
                    }
                }
                if ($recepcion->n_variedad == 'Dagen') {
                    if ($name == '<30') {
                        $colors[] = '#D26FDE';
                    } elseif ($name == '30-50') {
                        $colors[] = '#9817BB';
                    } elseif ($name == '>50') {
                        $colors[] = '#8C1651';
                    }
                }
                if ($recepcion->n_especie == 'Plums' && $recepcion->n_variedad != 'Dagen') {
                    if ($name == '<30') {
                        $colors[] = '#F0E770';
                    } elseif ($name == '30-50') {
                        $colors[] = '#f05e5e';
                    } elseif ($name == '50-70') {
                        $colors[] = '#e01620';
                    } elseif ($name == '>70') {
                        $colors[] = '#830d13';
                    }
                }
            }
        }

    @endphp
    @if ($recepcion->n_especie == 'Cherries')
        @php

        @endphp
    @elseif($recepcion->n_especie == 'Apples')
        @php
            $colors = ['#830d13', '#E01620', '#ED3F3F'];
        @endphp
    @elseif($recepcion->n_especie == 'Peaches' || $recepcion->n_especie == 'Nectarines')

    @elseif($recepcion->n_especie == 'Plums' && $recepcion->n_variedad != 'Dagen')
        @php

        @endphp
    @elseif($recepcion->n_especie == 'Paltas')
        @php
            $colors = ['#3f4729', '#5c6c2d', '#738813', '#c0e22e'];
        @endphp
    @elseif($recepcion->n_especie == 'Pears')
        @php
            $colors = ['#78851b', '#bec31f', '#d9e53d'];
        @endphp
    @elseif($recepcion->n_especie == 'Membrillos')
        @php
            $colors = ['#fedf00', '#bec31f', '#d9eb00'];
        @endphp
    @elseif($recepcion->n_especie == 'Orange' || $recepcion->n_especie == 'Mandarinas')
        @php
            $colors = ['#c6d406', '#f8d34c', '#fcad03', '#fb8603'];
        @endphp
    @elseif($recepcion->n_variedad == 'Dagen')
    @else
        @php
            $colors = ['#24a745', '#96AE51', '#f9e8cf', '#ffd700'];
        @endphp
    @endif
    @php
        if ($recepcion->n_variedad == 'Dagen') {
            $titulo = 'DISTRIBUCIÓN DE COLOR DE CUBRIMIENTO';
        } else {
            $titulo = 'DISTRIBUCIÓN DE COLOR';
        }

    @endphp
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>
    <script>
          $(document).ready(function() {
            Chart.register(ChartDataLabels);
            var series = <?php echo json_encode($series); ?>;
            var titulo = <?php echo json_encode($titulo); ?>;
            var col = <?php echo json_encode($colors); ?>;

            var labels = series.map(item => item.name);
            var data = series.map(item => item.y);

            var ctx = document.getElementById('container2').getContext('2d');
            var circularChart = new Chart(ctx, {
                type: 'pie', // Tipo de gráfico
                data: {
                    labels: labels, // Etiquetas de los segmentos del gráfico
                    datasets: [{
                        data: data, // Datos de los segmentos
                        backgroundColor: col, // Colores de los segmentos
                        borderColor: col, // Color del borde
                        borderWidth: 1
                    }]
                },
                options: {
                    aspectRatio: 1, // Ratio directo en Chart.js (sobrescribe CSS)
                    responsive: true,
                    maintainAspectRatio: false,// Activa el cálculo automático
                    plugins: {
                        // Añadir configuración del título aquí
                        title: {
                            display: true,
                            text: 'DISTRIBUCIÓN DE COLOR',
                            font: {
                                size: 16,
                                weight: 'bold'
                            },
                            padding: 10,
                            align: 'center'
                        },
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    return `${tooltipItem.raw}%`;
                                }
                            }
                        },
                        legend: {
                            position: 'right',
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
                    }
                }, layout: {
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

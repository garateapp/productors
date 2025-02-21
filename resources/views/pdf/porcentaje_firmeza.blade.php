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

    <figure class="container mx-1 mt-4" id="container">
        <canvas id="container2">

        </canvas>
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
    @php
        $categories = [];
        $series = [];
    @endphp

    @if ($recepcion->calidad->detalles)
        @if ($recepcion->n_variedad == 'Dagen')
            @foreach ($recepcion->calidad->detalles->where('tipo_item', 'DISTRIBUCIÓN DE FIRMEZA') as $detalle)
                @php
                    $categories[] = $detalle->detalle_item;
                    $series[] = $detalle->porcentaje_muestra;

                @endphp
            @endforeach
        @else
            @foreach ($recepcion->calidad->detalles->where('tipo_item', 'DISTRIBUCIÓN DE FIRMEZA')->where('detalle_item', 'LIGHT') as $detalle)
                @php
                    $l[] = $detalle->valor_ss;

                @endphp
            @endforeach
            @foreach ($recepcion->calidad->detalles->where('tipo_item', 'DISTRIBUCIÓN DE FIRMEZA')->where('detalle_item', 'DARK') as $detalle)
                @php
                    $d[] = $detalle->valor_ss;
                @endphp
            @endforeach
            @foreach ($recepcion->calidad->detalles->where('tipo_item', 'DISTRIBUCIÓN DE FIRMEZA')->where('detalle_item', 'BLACK') as $detalle)
                @php
                    $b[] = $detalle->valor_ss;
                @endphp
            @endforeach
        @endif

    @endif

    @if ($recepcion->n_especie == 'Cherries')
        @php
            $colors = ['#dc0c15', '#71160e', '#2b1d16'];
        @endphp
    @elseif($recepcion->n_especie == 'Apples')
        @php
            $colors = ['#831816'];
        @endphp
    @elseif($recepcion->n_especie == 'Pears')
        @php
            $colors = ['#788527'];
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


    <script>
        $(document).ready(function() {


            @if ($recepcion->n_variedad == 'Dagen')
                // Configuración para Dagen
                var categories = @json($categories);
                var series = @json($series);
                var col = @json($colors);
                const ctx = document.getElementById('container2').getContext('2d');
                Chart.register(ChartDataLabels);
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: categories,
                        datasets: [{
                            data: series,
                            backgroundColor: col,
                        }]
                    },

                    options: {
                        aspectRatio: 16/9, // Ratio directo en Chart.js (sobrescribe CSS)
                        responsive: true,
                        maintainAspectRatio: true, // Activa el cálculo automático
                        plugins: {
                            title: {
                                display: true,
                                text: 'PROMEDIO FIRMEZAS (gf/mm)',
                                font: {
                                    size: 16
                                }
                            },
                            legend: {
                                display: false
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
                            tooltip: {
                                callbacks: {
                                    title: (context) => context[0].label,
                                    label: (context) => `${context.parsed.y} gf/mm`
                                }
                            }
                        },
                        scales: {
                            y: {
                                title: {
                                    display: true,
                                    text: '(gf/mm)'
                                },
                                beginAtZero: true,
                                grid: {
                                    drawOnChartArea: false // ❌ Evita que se dibujen líneas en el área del gráfico
                                }
                            },
                            x: {
                                grid: {
                                    drawOnChartArea: false // ❌ Evita que se dibujen líneas en el área del gráfico
                                }
                            }
                        }
                    }
                });
            @else
                // Configuración para otras variedades
                var l = @json($l);
                var d = @json($d);
                var b = @json($b);
                var col = @json($colors);

                var categories = [
                    ['Muy Firme >280 - 1000', 'Durofel >75'],
                    ['Firme 200 - 279', 'Durofel 72 - 74.9'],
                    ['Sensible 180 - 199', 'Durofel 65 - 69.9'],
                    ['Blando 0,1 - 179', 'Durofel <65,4']
                ];

                new Chart(document.getElementById('container'), {
                    type: 'bar',
                    data: {
                        labels: categories,
                        datasets: [{
                                label: 'LIGHT',
                                data: l,
                                backgroundColor: col[0],
                                barThickness: 25,
                            },
                            {
                                label: 'DARK',
                                data: d,
                                backgroundColor: col[1],
                                barThickness: 25,
                            },
                            {
                                label: 'BLACK',
                                data: b,
                                backgroundColor: col[2],
                                barThickness: 25,
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            title: {
                                display: true,
                                text: '% Distribución de Firmezas por Segregación de Color',
                                font: {
                                    size: 16
                                }
                            },
                            legend: {
                                position: 'right',
                                labels: {
                                    boxWidth: 12,
                                    padding: 20
                                }
                            },
                            datalabels: {
                                formatter: (value) => value.toFixed(1) + '%',
                                color: 'black',
                                anchor: 'end',
                                align: 'end',
                                font: {
                                    size: 9
                                },
                                offset: 2
                            },
                            tooltip: {
                                callbacks: {
                                    title: (context) => context[0].label.join('\n'),
                                    label: (context) =>
                                        `${context.dataset.label}: ${context.parsed.y.toFixed(1)}%`
                                }
                            }
                        },
                        scales: {
                            x: {
                                ticks: {
                                    autoSkip: false,
                                    maxRotation: 0,
                                    minRotation: 0,
                                    padding: 10
                                }
                            },
                            y: {
                                max: 100,
                                title: {
                                    display: true,
                                    text: '%'
                                },
                                beginAtZero: true
                            }
                        },
                        interaction: {
                            mode: 'index'
                        }
                    }
                });
            @endif
        });
    </script>
</body>

</html>

<!DOCTYPE html>
<html>

<head>
    <title>Informe de Recepción Nro° {{ $recepcion->numero_g_recepcion }}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href=”https://fonts.googleapis.com/css?family=Pacifico” rel=”stylesheet”>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        #container {
            height: 310px;
        }
    </style>
</head>

<body>

    <figure class="mx-1 mt-4 highcharts-figure">
        <canvas id="container">

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
            var col = <?php echo json_encode($colors); ?>;
            var categories = <?php echo json_encode($categories); ?>;
            var series = <?php echo json_encode($series); ?>;
            var l = <?php echo json_encode($l); ?>;
            var d = <?php echo json_encode($d); ?>;
            var b = <?php echo json_encode($b); ?>;
            var ctx = document.getElementById("container").getContext("2d");

            // Definir el tipo de gráfico basado en la variedad
            var chartType = "{{ $recepcion->n_variedad }}" === "Dagen" ? "bar" : "bar";

            // Definir los datos del gráfico
            var data = {
                labels: categories,
                datasets: [{
                    label: "Firmeza",
                    data: series, // Usamos 'series' para Dagen y 'd' para el resto
                    backgroundColor: col,
                    borderColor: col,
                    borderWidth: 1
                }]
            };

            // Crear el gráfico con Chart.js
            new Chart(ctx, {
                type: chartType,
                data: data,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: "top"
                        },
                        title: {
                            display: true,
                            text: "PROMEDIO FIRMEZAS (gf/mm)"
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: categories.length ? undefined : 100
                        }
                    }
                }
            });
        });
    </script>
</body>

</html>

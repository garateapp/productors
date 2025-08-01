<!DOCTYPE html>
<html>

<head>
    <title>Informe de Recepción Nro° {{ $recepcion->numero_g_recepcion }}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href=”https://fonts.googleapis.com/css?family=Pacifico” rel=”stylesheet”>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(dibujarGrafico);

        function dibujarGrafico() {
            var datos = google.visualization.arrayToDataTable([
                ['Task', 'Hours per Day'],
                ['Work', 8],
                ['Eat', 2],
                ['Sleep', 8],
                ['Other', 6]
            ]);

            var opciones = {
                title: 'Actividades diarias',
                pieHole: 0.4
            };

            var chart_area = document.getElementById('grafico');
            var chart = new google.visualization.PieChart(chart_area);

            google.visualization.events.addListener(chart, 'ready', function() {
                chart_area.innerHTML = '<img src="' + chart.getImageURI() + '" class="img-responsive">';
            });

            chart.draw(datos, opciones);


        }
    </script>
    <style>
        @font-face {
            font-family: "Roboto";
            src: url("' . public_path('fonts/Roboto-Regular.ttf') . '") format("truetype");
            /* Agrega aquí otras variantes de la fuente si las necesitas */
        }

        /* Estilos CSS para la página */
        @page {
            margin-top: 15px;
            margin-bottom: 15px;
            margin-left: 15px;
            margin-right: 15px;
        }

        body {
            font-family: 'Roboto', 'Segoe UI', Tahoma, sans-serif;
            width: 100%;
            margin: 0;
            padding: 0;
            background-color: #ececec;
        }

        table {

            border-spacing: 5px;
            border-radius: 5px;
        }

        th,
        td {}

        .container {

            background-image: url({{ asset('image/bg_intranet_admin.jpg') }});

        }

        h1 {
            font-family: 'Roboto';
            text-align: center;
            color: white;
            margin-bottom: 20px;
            font-size: 1.5rem;

        }

        .logo {
            max-width: 150px;
            max-height: 71px !important;
            margin: 0 auto;
            display: block;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>
    @php
        $d_calidad = $recepcion->calidad->detalles->where('tipo_item', 'DEFECTOS DE CALIDAD');
        $d_condicion = $recepcion->calidad->detalles->where('tipo_item', 'DEFECTOS DE CONDICIÓN');
        $d_plaga = $recepcion->calidad->detalles->where('tipo_item', 'DAÑO DE PLAGA');
    @endphp

    @php
        $total = 0;
        $total_cat1 = 0;
        $total_cat2 = 0;
    @endphp
    @if ($d_calidad)
        @foreach ($d_calidad as $item)
            @php
                $total += $item->porcentaje_muestra;
                if ($item->categoria == '1') {
                    $total_cat1 += $item->porcentaje_muestra;
                }
                if ($item->categoria == '2') {
                    $total_cat2 += $item->porcentaje_muestra;
                }
            @endphp
        @endforeach
    @endif
    @if ($d_condicion)
        @foreach ($d_condicion as $item)
            @php
                $total += $item->porcentaje_muestra;
                if ($item->categoria == '1') {
                    $total_cat1 += $item->porcentaje_muestra;
                }
                if ($item->categoria == '2') {
                    $total_cat2 += $item->porcentaje_muestra;
                }
            @endphp
        @endforeach
    @endif
    @if ($d_plaga)
        @foreach ($d_plaga as $item)
            @php
                $total += $item->porcentaje_muestra;
                if ($item->categoria == '1') {
                    $total_cat1 += $item->porcentaje_muestra;
                }
                if ($item->categoria == '2') {
                    $total_cat2 += $item->porcentaje_muestra;
                }
            @endphp
        @endforeach
    @endif


    <div class="container">
        <table style="width:100%;">
            <tr>
                <td>
                    @if ($user)
                        @if ($user->profile_photo_path)
                            <img src="{{ 'https://appgreenex.cl/storage/' . $user->profile_photo_path }}"
                                alt="Logo de la empresa" class="logo">
                        @else
                            <img src="{{ asset('image/logogreenex.png') }}" alt="Logo de la empresa" class="logo">
                        @endif
                    @else
                        <img src="{{ asset('image/logogreenex.png') }}" alt="Logo de la empresa" class="logo">
                    @endif


                </td>
                <td>
                    <h1>{{ $recepcion->n_emisor }}</h1>

                </td>
            </tr>
        </table>

        <h1 style="background-color: rgb(0,0,0,0.5);">Informe de Recepcion Guia N°
            {{ $recepcion->numero_documento_recepcion }} | {{ $recepcion->n_especie }} | <br>
            {{ $recepcion->n_variedad }} | Cuartel GE001 | CSG <br> {{ $recepcion->Codigo_Sag_emisor }} </h1>
    </div>
    <table style="width:100%; background-color:#ececec;font-size:12px;">

        <tr
            style="
			border-radius: 5px;
			font-family: 'Roboto';">
            <td
                style="background-color:#ffffff;padding-top: 10px;
			padding-bottom: 5px;
			padding-left: 5px;
			padding-right: 5px;
			border-radius: 5px;
			font-family: 'Roboto';">
                <h3 style="color: #47ac34;">Fecha<br></h3>
                {{ date('d M Y', strtotime($recepcion->fecha_g_recepcion)) }}
            </td>
            <td
                style="background-color:#ffffff;padding-top: 10px;
			padding-bottom: 5px;
			padding-left: 5px;
			padding-right: 5px;
			border-radius: 5px;
			font-family: 'Roboto';">
                <h3 style="color: #47ac34;">N° <br>Lote</h3> {{ $recepcion->numero_g_recepcion }}
            </td>
            <td
                style="background-color:#ffffff;padding-top: 10px;
			padding-bottom: 5px;
			padding-left: 5px;
			padding-right: 5px;
			border-radius: 5px;
			font-family: 'Roboto';">
                <h3 style="color: #47ac34;">Kilos <br>Recibidos</h3>
                {{ number_format($recepcion->peso_neto, 0, '.', '.') }}
            </td>
            <td
                style="background-color:#ffffff;padding-top: 10px;
			padding-bottom: 5px;
			padding-left: 5px;
			padding-right: 5px;
			border-radius: 5px;
			font-family: 'Roboto';">
                <h3 style="color: #47ac34;">N°<br> Envases</h3>{{ number_format($recepcion->cantidad, 0, '.', '.') }}
            </td>
            @if ($recepcion->calidad->detalles->where('tipo_detalle', 'ss')->first())
                <td
                    style="background-color:#ffffff;padding-top: 10px;
			padding-bottom: 5px;
			padding-left: 5px;
			padding-right: 5px;
			border-radius: 5px;
			font-family: 'Roboto';">
                    <h3 style="color: teal;">T°<br> Pulpa</h3>
                    @if ($recepcion->calidad->detalles->where('tipo_detalle', 'ss')->where('temperatura', '>', 0)->first())

                        {{ $recepcion->calidad->detalles->where('tipo_detalle', 'ss')->where('temperatura', '>', 0)->first()->temperatura }}°C
                    @endif

                </td>
            @endif



            @if ($recepcion->calidad->detalles->where('detalle_item', 'SETEO CAMION')->first())
                <td
                    style="background-color:#ffffff;padding-top: 10px;
			padding-bottom: 5px;
			padding-left: 5px;
			padding-right: 5px;
			border-radius: 5px;">
                    <h3 style="color: teal;">Seteo <br> Camión</h3>
                    {{ $recepcion->calidad->detalles->where('detalle_item', 'SETEO CAMION')->first()->cantidad }}°C
                </td>
            @endif
            <td
                style="background-color:#ffffff;padding-top: 10px;
			padding-bottom: 5px;
			padding-left: 5px;
			padding-right: 5px;
			border-radius: 5px;">
                <h3 style="color: teal;">Nota<br> Calidad</h3>
                @if ($recepcion->calidad->detalles->where('detalle_item', 'EXTERNA')->first())
                    {{ $recepcion->calidad->detalles->where('detalle_item', 'EXTERNA')->first()->cantidad }}
                @else
                    @if ($recepcion->nota_calidad == 0)
                        N/A
                    @elseif($recepcion->nota_calidad)
                        {{ number_format($recepcion->nota_calidad) }}
                    @endif
                @endif

            </td>
            <td
                style="background-color:#ffffff;padding-top: 5px;
			padding-bottom: 5px;
			padding-left: 5px;
			padding-right: 5px;
			border-radius: 5px;">

                @php
                    $a = 0;
                    $b = 0;
                    $c = 0;
                    $e = 0;

                    if ($recepcion->n_especie == 'Orange') {
                        if (
                            $recepcion->calidad->detalles
                                ->where('tipo_item', 'DISTRIBUCIÓN DE CALIBRES')
                                ->where('detalle_item', 'PRECALIBRE')
                                ->first()
                        ) {
                            $a = $recepcion->calidad->detalles
                                ->where('tipo_item', 'DISTRIBUCIÓN DE CALIBRES')
                                ->where('detalle_item', 'PRECALIBRE')
                                ->first()->porcentaje_muestra;
                        }
                        if (
                            $recepcion->calidad->detalles
                                ->where('tipo_item', 'DISTRIBUCIÓN DE CALIBRES')
                                ->where('detalle_item', 'SOBRECALIBRE')
                                ->first()
                        ) {
                            $b = $recepcion->calidad->detalles
                                ->where('tipo_item', 'DISTRIBUCIÓN DE CALIBRES')
                                ->where('detalle_item', 'SOBRECALIBRE')
                                ->first()->porcentaje_muestra;
                        }
                    } elseif ($recepcion->n_especie == 'Mandarinas') {
                        if (
                            $recepcion->calidad->detalles
                                ->where('tipo_item', 'DISTRIBUCIÓN DE CALIBRES')
                                ->where('detalle_item', '<47mm')
                                ->first()
                        ) {
                            //$a=$recepcion->calidad->detalles->where('tipo_item','DISTRIBUCIÓN DE CALIBRES')->where('detalle_item','<47mm')->first()->cantidad;
                        }
                        if (
                            $recepcion->calidad->detalles
                                ->where('tipo_item', 'DISTRIBUCIÓN DE CALIBRES')
                                ->where('detalle_item', '>80mm')
                                ->first()
                        ) {
                            $b = $recepcion->calidad->detalles
                                ->where('tipo_item', 'DISTRIBUCIÓN DE CALIBRES')
                                ->where('detalle_item', '>80mm')
                                ->first()->porcentaje_muestra;
                        }
                    } else {
                        if (
                            $recepcion->calidad->detalles
                                ->where('tipo_item', 'DISTRIBUCIÓN DE CALIBRES')
                                ->where('detalle_item', 'PRECALIBRE')
                                ->first()
                        ) {
                            $a = $recepcion->calidad->detalles
                                ->where('tipo_item', 'DISTRIBUCIÓN DE CALIBRES')
                                ->where('detalle_item', 'PRECALIBRE')
                                ->first()->porcentaje_muestra;
                        }
                        if (
                            $recepcion->calidad->detalles
                                ->where('tipo_item', 'DISTRIBUCIÓN DE CALIBRES')
                                ->where('detalle_item', 'SOBRECALIBRE')
                                ->first()
                        ) {
                            $b = $recepcion->calidad->detalles
                                ->where('tipo_item', 'DISTRIBUCIÓN DE CALIBRES')
                                ->where('detalle_item', 'SOBRECALIBRE')
                                ->first()->porcentaje_muestra;
                        }
                    }

                    if ($recepcion->calidad->detalles->where('tipo_item', 'COLOR DE CUBRIMIENTO')) {
                        $col = 0;

                        foreach ($recepcion->calidad->detalles->where('tipo_item', 'COLOR DE CUBRIMIENTO') as $item) {
                            if ($recepcion->n_especie == 'Apples') {
                                if ($recepcion->n_variedad == 'Pink Lady' || $recepcion->n_variedad == 'Rossy Glo') {
                                    if ($item->detalle_item == '<40') {
                                        $col += $item->porcentaje_muestra;
                                    }
                                }
                                if ($item->detalle_item == '<50') {
                                    $col += $item->porcentaje_muestra;
                                }
                            }
                            if ($recepcion->n_especie == 'Mandarinas') {
                                if ($item->detalle_item == '<30') {
                                    $col += $item->porcentaje_muestra;
                                }
                            }
                            if ($recepcion->n_especie == 'Membrillos') {
                                if ($item->detalle_item == '<7' || $item->detalle_item == '>9') {
                                    $col += $item->porcentaje_muestra;
                                }
                            }
                            if ($recepcion->n_especie == 'Orange') {
                                if ($item->detalle_item == '<30') {
                                    $col += $item->porcentaje_muestra;
                                }
                            }
                            if ($recepcion->n_especie == 'Cherries') {
                                if ($item->detalle_item == 'Fuera de Color') {
                                    $col += $item->valor_ss;
                                }
                            }
                            if ($recepcion->n_especie == 'Pears') {
                                if ($item->detalle_item == '<40') {
                                    $col += $item->porcentaje_muestra;
                                }
                            }
                        }
                    }

                @endphp
                @if ($recepcion->n_variedad == 'Dagen')
                    @if ($recepcion->calidad->detalles->where('tipo_item', 'DISTRIBUCIÓN DE FIRMEZA')->where('detalle_item', 'MUY BLANDO')->first())
                        @php
                            $e = $recepcion->calidad->detalles
                                ->where('tipo_item', 'DISTRIBUCIÓN DE FIRMEZA')
                                ->where('detalle_item', 'MUY BLANDO')
                                ->first()->porcentaje_muestra;
                        @endphp

                    @endif
                @else
                    @if ($recepcion->calidad->detalles->where('tipo_item', 'FIRMEZAS')->where('detalle_item', 'FRUTA BLANDA')->first())
                        @php
                            $e = $recepcion->calidad->detalles
                                ->where('tipo_item', 'FIRMEZAS')
                                ->where('detalle_item', 'FRUTA BLANDA')
                                ->first()->porcentaje_muestra;
                        @endphp

                    @endif
                @endif
                <h3 style="color: teal;">Estimación Exportación</h3>

                    <table style="width:100%;">
                        <tr>
                            <td style="text-align: center;">

                                @if ($total_cat1 > 0)

                                    {{ number_format(100 - ($total -$total_cat1 + $a + $b + $col), 0) }} %

                                @else
                                    {{ number_format(100 - ($total + $a + $b + $col), 0) }} %
                                @endif

                                @if ($total_cat1 > 0)
                            <table style="width:100%;">
                                <tr>
                                    <td>CAT 1</td>
                                    <td>CAT 2</td>
                                </tr>

                                <tr>
                                    <td>

                                        {{ number_format(100 - ($total + $a + $b + $col), 0) }} %

                                    </td>
                                    <td>
                                        {{ number_format($total_cat1, 0) }} %
                                    </td>

                                </tr>
                            </table>
                            @endif


                {{-- Se modifica a solicitud de Viviana se eliminó el item $e FRUTA BLANDA --}}



            </td>
        </tr>
    </table>
    </td>
    </tr>
    </table>

    <table style="width:100%;">
        <tr>
            @isset($distribucion_calibre)
                @if ($recepcion->n_especie == 'Cherries' || $recepcion->n_variedad == 'Dagen')
                    <td>
                        <img style="width:100%;height:360px;" src="{{ $distribucion_calibre }}" alt="">
                    </td>
                @else
                    <td>
                        <img style="width:100%;height:300px;" src="{{ $distribucion_calibre }}" alt="">
                    </td>
                @endif
                @endif

                @if ($recepcion->n_especie == 'Cherries' || $recepcion->n_variedad == 'Dagen')
                    @isset($distribucion_color)
                        <td>
                            <img style="width:100%;:360px;" src="{{ $distribucion_color }}" alt="">
                        </td>
                    @endif
                    @endif

                </tr>
            </table>

            {{-- <table style="width:100%;">
                <tr>
                    @if ($recepcion->n_especie == 'Cherries' || $recepcion->n_variedad == 'Dagen')
                        @isset($promedio_firmeza)
                            <td>
                                <img style="width:100%;" src="{{ $promedio_firmeza }}" alt="">
                            </td>
                        @endif
                    @else
                        @isset($distribucion_color)
                        <td style="align:center;">
                                <img style="width:100%; max-width:400px;" src="{{ $distribucion_color }}" alt="">
                        </td>
                        @endif
                    @endif
                    @if ($recepcion->n_especie == 'Cherries' || $recepcion->n_variedad == 'Dagen')
                        @isset($promedio_brix)
                                    <td>
                                        <img style="width:100%;" src="{{ $promedio_brix }}" alt="">
                                    </td>
                        @endif
                    @else
                        @isset($distribucion_color_fondo)
                            @if ($distribucion_color_fondo != '')
                                    <td style="align:center;">
                                        <img style="width:100%; max-width:400px;" src="{{ $distribucion_color_fondo }}" alt="">
                                    </td>
                            @endif
                        @endif
                    @endif



                                </tr>
                            </table> --}}
            @php
                $imageCount = 0;
                if (
                    ($recepcion->n_especie == 'Cherries' || $recepcion->n_variedad == 'Dagen') &&
                    isset($promedio_firmeza)
                ) {
                    $imageCount++;
                }
                if (
                    ($recepcion->n_especie == 'Cherries' || $recepcion->n_variedad == 'Dagen') &&
                    isset($promedio_brix)
                ) {
                    $imageCount++;
                }
                if (
                    !($recepcion->n_especie == 'Cherries' || $recepcion->n_variedad == 'Dagen') &&
                    isset($distribucion_color)
                ) {
                    $imageCount++;
                }
                if (
                    !($recepcion->n_especie == 'Cherries' || $recepcion->n_variedad == 'Dagen') &&
                    isset($distribucion_color_fondo) &&
                    $distribucion_color_fondo != ''
                ) {
                    $imageCount++;
                }
            @endphp

            <table style="width:100%; text-align:center;">
                <tr>
                    @if ($recepcion->n_especie == 'Cherries' || $recepcion->n_variedad == 'Dagen')
                        @isset($promedio_firmeza)
                            <td @if ($imageCount == 1) colspan="2" @endif>
                                <img style="width:100%; max-width:400px; display:block; margin:auto;" src="{{ $promedio_firmeza }}"
                                    alt="">
                            </td>
                        @endisset
                        @isset($promedio_brix)
                            <td @if ($imageCount == 1) colspan="2" @endif>
                                <img style="width:100%; max-width:400px; display:block; margin:auto;" src="{{ $promedio_brix }}"
                                    alt="">
                            </td>
                        @endisset
                    @else
                        @isset($distribucion_color)
                            <td @if ($imageCount == 1) colspan="2" @endif>
                                <img style="width:100%; max-width:400px; display:block; margin:auto;"
                                    src="{{ $distribucion_color }}" alt="">
                            </td>
                        @endisset
                        @isset($distribucion_color_fondo)
                            @if ($distribucion_color_fondo != '')
                                <td @if ($imageCount == 1) colspan="2" @endif>
                                    <img style="width:100%; max-width:400px; display:block; margin:auto;"
                                        src="{{ $distribucion_color_fondo }}" alt="">
                                </td>
                            @endif
                        @endisset
                    @endif
                </tr>
            </table>


            @if ($recepcion->calidad->detalles->where('tipo_item', 'GRANDE')->first())
                <table style="width:100%;">
                    <tr>
                        @isset($firmezas_grande)
                            <td>
                                <img style="width:100%;" src="{{ $firmezas_grande }}" alt="">
                            </td>
                @endif


                </tr>
                </table>
                @endif
                @if ($recepcion->calidad->detalles->where('tipo_item', 'MEDIANO')->first())
                    <table style="width:100%;">
                        <tr>
                            @isset($firmezas_mediana)
                                <td>
                                    <img style="width:100%;" src="{{ $firmezas_mediana }}" alt="">
                                </td>
                    @endif


                    </tr>
                    </table>
                    @endif
                    @if ($recepcion->calidad->detalles->where('tipo_item', 'CHICO')->first())
                        <table style="width:100%;">
                            <tr>
                                @isset($firmezas_chica)
                                    <td>
                                        <img style="width:100%;" src="{{ $firmezas_chica }}" alt="">
                                    </td>
                        @endif


                        </tr>
                        </table>
                        @endif
                        @if ($recepcion->n_especie == 'Cherries' || $recepcion->n_variedad == 'Dagen')
                            <table style="width:100%;">
                                <tr>
                                    @isset($porcentaje_firmeza)
                                        <td>
                                            <img style="width:100%;" src="{{ $porcentaje_firmeza }}" alt="">
                                        </td>
                            @endif
                            @if ($recepcion->n_variedad == 'Dagen')
                                @isset($distribucion_color_fondo)
                                    <td>
                                        <img style="width:100%;" src="{{ $distribucion_color_fondo }}" alt="">
                                    </td>
                                @endif
                                @endif
                                </tr>
                                </table>
                            @else
                                @if ($recepcion->n_especie == 'Apples')
                                    <div class="page-break"></div>

                                    <table style="width:100%; border:1px solid black;  border-collapse: collapse;  text-align: center;">
                                        <tr style="width:100%; border:1px solid black;  border-collapse: collapse;">
                                            <th colspan="2" style="border:1px solid black;  border-collapse: collapse;">
                                                Corazon Acuoso
                                            </th>
                                            <th colspan="2" style="border:1px solid black;  border-collapse: collapse;">
                                                Corazon Mohoso
                                            </th>
                                        </tr>
                                        <tr style="border:1px solid black;">
                                            <td style="border:1px solid black;  border-collapse: collapse;">
                                                Leve
                                            </td>
                                            <td style="border:1px solid black;  border-collapse: collapse;">
                                                @if ($recepcion->calidad->detalles->where('tipo_item', 'CARAZÓN ACUOSO')->where('detalle_item', 'Leve')->first())
                                                    {{ $recepcion->calidad->detalles->where('tipo_item', 'CARAZÓN ACUOSO')->where('detalle_item', 'Leve')->first()->valor_ss }}
                                                    %
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td style="border:1px solid black;  border-collapse: collapse;">
                                                Leve
                                            </td>
                                            <td style="border:1px solid black;  border-collapse: collapse;">
                                                @if ($recepcion->calidad->detalles->where('tipo_item', 'CORAZÓN MOHOSO')->where('detalle_item', 'Leve')->first())
                                                    {{ $recepcion->calidad->detalles->where('tipo_item', 'CORAZÓN MOHOSO')->where('detalle_item', 'Leve')->first()->valor_ss }}
                                                    %
                                                @else
                                                    -
                                                @endif
                                            </td>
                                        </tr>
                                        <tr style="border:1px solid black;">
                                            <td style="border:1px solid black;  border-collapse: collapse;">
                                                Moderado
                                            </td>
                                            <td style="border:1px solid black;  border-collapse: collapse;">
                                                @if ($recepcion->calidad->detalles->where('tipo_item', 'CARAZÓN ACUOSO')->where('detalle_item', 'Moderado')->first())
                                                    {{ $recepcion->calidad->detalles->where('tipo_item', 'CARAZÓN ACUOSO')->where('detalle_item', 'Moderado')->first()->valor_ss }}
                                                    %
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td style="border:1px solid black;  border-collapse: collapse;">
                                                Moderado
                                            </td>
                                            <td style="border:1px solid black;  border-collapse: collapse;">
                                                @if ($recepcion->calidad->detalles->where('tipo_item', 'CORAZÓN MOHOSO')->where('detalle_item', 'Moderado')->first())
                                                    {{ $recepcion->calidad->detalles->where('tipo_item', 'CORAZÓN MOHOSO')->where('detalle_item', 'Moderado')->first()->valor_ss }}
                                                    %
                                                @else
                                                    -
                                                @endif
                                            </td>
                                        </tr>
                                        <tr style="border:1px solid black;  border-collapse: collapse;">
                                            <td style="border:1px solid black;  border-collapse: collapse;">
                                                Severo
                                            </td>
                                            <td style="border:1px solid black;  border-collapse: collapse;">
                                                @if ($recepcion->calidad->detalles->where('tipo_item', 'CARAZÓN ACUOSO')->where('detalle_item', 'Severo')->first())
                                                    {{ $recepcion->calidad->detalles->where('tipo_item', 'CARAZÓN ACUOSO')->where('detalle_item', 'Severo')->first()->valor_ss }}
                                                    %
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td style="border:1px solid black;  border-collapse: collapse;">
                                                Severo
                                            </td>
                                            <td style="border:1px solid black;  border-collapse: collapse;">
                                                @if ($recepcion->calidad->detalles->where('tipo_item', 'CORAZÓN MOHOSO')->where('detalle_item', 'Severo')->first())
                                                    {{ $recepcion->calidad->detalles->where('tipo_item', 'CORAZÓN MOHOSO')->where('detalle_item', 'Severo')->first()->valor_ss }}
                                                    %
                                                @else
                                                    -
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                @endif

                                @if ($recepcion->n_especie == 'Apples' || $recepcion->n_especie == 'Pears')
                                    <table
                                        style="width:100%; border:1px solid black;  border-collapse: collapse;  text-align: center; margin-top: 30px; ">
                                        <tr style="width:100%; border:1px solid black;  border-collapse: collapse;">
                                            <th colspan="{{ $presiones->count() }}" style="border:1px solid black;  border-collapse: collapse;">
                                                % Distribución de Presiones (Lbs)
                                            </th>
                                            @if ($recepcion->n_especie == 'Apples')
                                                @if ($almidons->count())
                                                    <th colspan="{{ $almidons->count() }}"
                                                        style="border:1px solid black;  border-collapse: collapse;">
                                                        % Distribución Almidón
                                                    </th>
                                                @endif
                                            @endif
                                        </tr>
                                        <tr style="border:1px solid black;">
                                            @foreach ($presiones as $item)
                                                <td style="border:1px solid black;  border-collapse: collapse;">
                                                    {{ $item->name }}
                                                </td>
                                            @endforeach
                                            @if ($recepcion->n_especie == 'Apples')
                                                @if ($almidons->count())
                                                    @foreach ($almidons as $item)
                                                        <td style="border:1px solid black;  border-collapse: collapse;">
                                                            {{ $item->name }}
                                                        </td>
                                                    @endforeach
                                                @endif
                                            @endif
                                        </tr>
                                        <tr style="border:1px solid black;">
                                            @foreach ($presiones as $item)
                                                <td style="border:1px solid black;  border-collapse: collapse;">

                                                    @if ($recepcion->calidad->detalles->where('tipo_item', 'PRESIONES')->where('detalle_item', $item->name)->first())
                                                        {{ $recepcion->calidad->detalles->where('tipo_item', 'PRESIONES')->where('detalle_item', $item->name)->first()->valor_ss }}
                                                        %
                                                    @else
                                                        0 %
                                                    @endif

                                                </td>
                                            @endforeach
                                            @if ($recepcion->n_especie == 'Apples')
                                                @if ($almidons->count())
                                                    @foreach ($almidons as $item)
                                                        <td style="border:1px solid black;  border-collapse: collapse;">

                                                            @if ($recepcion->calidad->detalles->where('tipo_item', 'ALMIDON')->where('detalle_item', $item->name)->first())
                                                                {{ $recepcion->calidad->detalles->where('tipo_item', 'ALMIDON')->where('detalle_item', $item->name)->first()->valor_ss }}
                                                                %
                                                            @else
                                                                0 %
                                                            @endif

                                                        </td>
                                                    @endforeach
                                                @endif
                                            @endif
                                        </tr>

                                    </table>
                                @endif
                                @endif

                                @if (
                                    $recepcion->n_especie != 'Pears' &&
                                        $recepcion->n_especie != 'Peaches' &&
                                        $recepcion->n_especie != 'Apples' &&
                                        $recepcion->n_especie != 'Nectarines' &&
                                        $recepcion->n_especie != 'Plums' &&
                                        $recepcion->n_especie != 'Membrillos')
                                    <div class="page-break"></div>
                                @endif

                                @if ($recepcion->n_variedad == 'Dagen')
                                    <div class="page-break"></div>
                                @endif

                                @if ($recepcion->n_especie == 'Orange' || $recepcion->n_especie == 'Mandarinas')
                                    <table style="width:100%;">
                                        <tr>
                                            @isset($calibrix)
                                                <td>
                                                    <img style="width:100%;" src="{{ $calibrix }}" alt="">
                                                </td>
                                    @endif

                                    </tr>
                                    </table>
                                    @endif

                                    <table style="width:100%;  font-size: 12px; border-spacing: 2px;">

                                        <tr>
                                            <td style="background-color:#47ac34; color: white; padding-left: 5px;"><b>DEFECTOS DE CALIDAD</b> </td>
                                            <td style="background-color:#47ac34; color: white; padding-left: 5px;"><b>DEFECTOS DE CONDICIÓN</b> </td>
                                            <td style="background-color:#47ac34; color: white; padding-left: 5px;"><b>DAÑOS DE PLAGA </b></td>
                                            <td style="background-color:#47ac34; color: white; padding-left: 5px;"><b>CALIDAD DE LLEGADA</b> </td>

                                        </tr>





                                        <tr>
                                            <td style="vertical-align: text-top;font-size: 14px;">
                                                @php
                                                    $totalcalidad = 0;
                                                @endphp
                                                @if ($d_calidad->count())
                                                    @foreach ($d_calidad as $item)
                                                        @if ($item->categoria != '1')
                                                            <div>
                                                                <div style="display: inline;"> {{ $item->detalle_item }} </div>
                                                                <div style="display: inline; text-align: right; justify-items: end;">
                                                                    {{ $item->porcentaje_muestra }}%</div>
                                                            </div>
                                                            @php
                                                                $totalcalidad += $item->porcentaje_muestra;
                                                            @endphp
                                                        @endif
                                                    @endforeach
                                                    <div style="background-color:#47ac34; color: white; font-size: 12px; padding-left: 3px;">
                                                        <div style=""><b> TOTAL DEFECTOS DE CALIDAD </b></div>
                                                        <div style="text-align: left; justify-items: end;"><b>{{ $totalcalidad }}%</b></div>
                                                    </div>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td style="vertical-align: text-top;font-size: 14px;">
                                                @php
                                                    $totalcondicion = 0;
                                                @endphp
                                                @if ($d_condicion->count())

                                                    @foreach ($d_condicion as $item)
                                                        @if ($item->categoria != '1')
                                                            <div>
                                                                <div style="display: inline;"> {{ $item->detalle_item }} </div>
                                                                <div style="display: inline; text-align: right; justify-items: end;">
                                                                    {{ $item->porcentaje_muestra }}%</div>
                                                            </div>
                                                            @php
                                                                $totalcondicion += $item->porcentaje_muestra;
                                                            @endphp
                                                        @endif
                                                    @endforeach
                                                    <div style="background-color:#47ac34; color: white; font-size: 12px; padding-left: 3px;">
                                                        <div style=""> <b>TOTAL DEFECTOS DE CONDICIÓN </b></div>
                                                        <div style="text-align: left; justify-items: end;"><b>{{ $totalcondicion }}%</b></div>
                                                    </div>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td style="vertical-align: text-top;font-size: 14px;">
                                                @php
                                                    $totalplaga = 0;
                                                @endphp
                                                @if ($d_plaga->count())
                                                    @foreach ($d_plaga as $item)
                                                        <div>
                                                            <div style="display: inline;"> {{ $item->detalle_item }} </div>
                                                            <div style="display: inline; text-align: right; justify-items: end;">
                                                                {{ $item->porcentaje_muestra }}%</div>
                                                        </div>
                                                        @php
                                                            $totalplaga += $item->porcentaje_muestra;
                                                        @endphp
                                                    @endforeach
                                                    <div style="background-color:#47ac34; color: white; font-size: 12px; padding-left: 3px;">
                                                        <div style=""><b> TOTAL DAÑOS DE PLAGA </b></div>
                                                        <div style="text-align: left; justify-items: end;"><b>{{ $totalplaga }}%</b></div>
                                                    </div>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td style="vertical-align: text-top;font-size: 12px;">
                                                <table>
                                                    <tr>
                                                        <td>Materia Vegetal </td>
                                                        <td
                                                            style=" text-align: center; justify-items: center; background-color:#47ac34; color: white; padding-top: 4px; padding-bottom: 3px;padding-left: 7px; padding-right: 7px ">
                                                            @if ($recepcion->calidad->materia_vegetal == null)
                                                                -
                                                            @else
                                                                {{ $recepcion->calidad->materia_vegetal }}
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td> Presencia de Piedras </td>
                                                        <td
                                                            style=" text-align: center; justify-items: center; background-color:#47ac34; color: white; padding-top: 4px; padding-bottom: 3px;padding-left: 7px; padding-right: 7px ">
                                                            @if ($recepcion->calidad->piedras == null)
                                                                -
                                                            @else
                                                                {{ $recepcion->calidad->piedras }}
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Presencia de Barro y/o <br> Polvo </td>
                                                        <td
                                                            style=" text-align: center; justify-items: center; background-color:#47ac34; color: white; padding-top: 4px; padding-bottom: 3px;padding-left: 7px; padding-right: 7px ">
                                                            @if ($recepcion->calidad->barro == null)
                                                                -
                                                            @else
                                                                {{ $recepcion->calidad->barro }}
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Humedad Esponjas </td>
                                                        <td
                                                            style=" text-align: center; justify-items: center; background-color:#47ac34; color: white; padding-top: 4px; padding-bottom: 3px;padding-left: 7px; padding-right: 7px ">
                                                            @if ($recepcion->calidad->esponjas == null)
                                                                -
                                                            @else
                                                                {{ $recepcion->calidad->esponjas }}
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Llenado de Bins y/o Tottes </td>
                                                        <td
                                                            style=" text-align: center; justify-items: center; background-color:#47ac34; color: white; padding-top: 4px; padding-bottom: 3px;padding-left: 7px; padding-right: 7px ">
                                                            @if ($recepcion->calidad->llenado_tottes == null)
                                                                -
                                                            @else
                                                                {{ $recepcion->calidad->llenado_tottes }}
                                                            @endif
                                                        </td>
                                                    </tr>
                                                </table>

                                            </td>
                                        </tr>

                                    </table>
                                    <table style="width:100%;  font-size: 12px; background-color:#47ac34; border-spacing: 0px; ">
                                        <tr>
                                            <td style="background-color:#47ac34; color: white; padding-left: 5px;"><b>TOTAL DEFECTOS: </b>



                                                @if ($total > 0)

                                                    {{ $total }}%
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td style="background-color:#47ac34; color: white;"><b>PRECALIBRE: </b>
                                                @if ($recepcion->calidad->detalles->where('tipo_item', 'DISTRIBUCIÓN DE CALIBRES')->where('detalle_item', 'PRECALIBRE')->first())
                                                    {{ $recepcion->calidad->detalles->where('tipo_item', 'DISTRIBUCIÓN DE CALIBRES')->where('detalle_item', 'PRECALIBRE')->first()->porcentaje_muestra }}
                                                    %
                                                @elseif($recepcion->n_especie == 'Orange' || $recepcion->n_especie == 'Mandarinas' )
                                                    {{ $a }}%
                                                @else
                                                    -
                                                @endif

                                            </td>
                                            <td style="background-color:#47ac34; color: white;"><b>SOBRECALIBRE: </b>
                                                @if ($recepcion->calidad->detalles->where('tipo_item', 'DISTRIBUCIÓN DE CALIBRES')->where('detalle_item', 'SOBRECALIBRE')->first())
                                                    {{ $recepcion->calidad->detalles->where('tipo_item', 'DISTRIBUCIÓN DE CALIBRES')->where('detalle_item', 'SOBRECALIBRE')->first()->porcentaje_muestra }}
                                                    %
                                                @elseif($recepcion->n_especie == 'Orange' || $recepcion->n_especie == 'Mandarinas')
                                                    {{ $b }}%
                                                @else
                                                    -
                                                @endif

                                            </td>
                                            <td style="background-color:#47ac34; color: white;"><b>FUERA DE COLOR: </b>
                                                @if ($col > 0)
                                                    {{ $col }}%
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            {{-- <td style="background-color:#47ac34; color: white;">
                                                                <b>FRUTA BLANDA: </b>

                                                                @if ($recepcion->n_variedad == 'Dagen')
                                                                    @if ($recepcion->calidad->detalles->where('tipo_item', 'DISTRIBUCIÓN DE FIRMEZA')->where('detalle_item', 'MUY BLANDO')->first())

                                                                        {{ $recepcion->calidad->detalles->where('tipo_item', 'DISTRIBUCIÓN DE FIRMEZA')->where('detalle_item', 'MUY BLANDO')->first()->porcentaje_muestra }}
                                                                        %


                                                                    @endif
                                                                @else
                                                                    @if ($recepcion->calidad->detalles->where('tipo_item', 'FIRMEZAS')->where('detalle_item', 'FRUTA BLANDA')->first())
                                                                        {{ $recepcion->calidad->detalles->where('tipo_item', 'FIRMEZAS')->where('detalle_item', 'FRUTA BLANDA')->first()->porcentaje_muestra }}
                                                                        %
                                                                    @else
                                                                        -
                                                                    @endif
                                                                @endif


                                                            </td> --}}

                                        </tr>
                                    </table>
                                    <div
                                        style="background-color:#47ac34; color: white; font-size: 12px; padding-left: 3px; border-top: 1px solid white;">
                                        <div style="text-align: center;"><b> OBSERVACIONES: </b>
                                            @if ($recepcion->calidad->obs_ext)
                                                {{ $recepcion->calidad->obs_ext }}
                                            @else
                                                -
                                            @endif
                                        </div>
                                    </div>
                                    <div
                                        style="background-color:#bad047; color: white; font-size: 12px; padding-left: 3px; border-bottom: 5px solid #47ac34;">
                                        <div style="text-align: center;">

                                            @if ($user)
                                                @if ($user->profile_photo_path)
                                                    <img src="{{ 'https://appgreenex.cl/storage/' . $user->profile_photo_path }}"
                                                        alt="Logo de la empresa" class="logo">
                                                @else
                                                    <img src="{{ asset('image/logogreenex.png') }}" alt="Logo de la empresa" class="logo">
                                                @endif
                                            @else
                                                <img src="{{ asset('image/logogreenex.png') }}" alt="Logo de la empresa" class="logo">
                                            @endif



                                        </div>
                                    </div>
                                    <div class="page-break"></div>
                                @if(in_array($recepcion->id_emisor,[6955,8557,8558,8559,8560,8561,8563,8564,8630,8657,8665,8666,8683,8666,8683]))


                                    <div style="text-align: center; font-size: 12px; padding-left: 3px; padding-right: 3px;">
                                        <h3>Distribución de Calibres</h3>
                                        @php
                                            echo $html_tabla_distribucion_calibre;
                                        @endphp
                                        <h3>Distribución de Color</h3>
                                        @php
                                            echo $html_tabla_color;
                                        @endphp
                                         @if ($recepcion->n_especie != 'Cherries' && $recepcion->n_especie != 'Dagen' )
                                            <h3>Distribución de Firmeza Grande</h3>
                                            @php
                                                echo $html_tabla_firmeza_grande;
                                            @endphp
                                            <h3>Distribución de Firmeza Mediana</h3>
                                            @php
                                                echo $html_tabla_firmeza_mediana;
                                            @endphp
                                            <h3>Distribución de Firmeza Pequeña</h3>
                                            @php
                                                echo $html_tabla_firmeza_pequena;
                                            @endphp
                                            <h3>Distribución de Color Fondo</h3>
                                            @php
                                                echo $html_tabla_color_fondo;
                                            @endphp
                                        @endif
                                        <h3>Distribución de Calibrix</h3>
                                        @php
                                            echo $html_tabla_calibrix;
                                        @endphp
                                        <h3>Promedio de Firmeza</h3>
                                        @php
                                            echo $html_tabla_porc_firmeza;
                                        @endphp
                                        <h3>Distribución de Porcentaje de Firmeza</h3>
                                        @php
                                            echo $html_tabla_porcentaje_firmeza;
                                        @endphp

                                    </div>

                                @endif
                                </body>

                                </html>

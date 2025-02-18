<div x-data="temporadas()">

    @php
    $cant=0;

        foreach($recepcions as $recepcion){
            $cant+=$recepcion->peso_neto;
        }


                $export=0;
                $comerc=0;
                $desec=0;
                $mer=0;
                foreach ($procesosall as $proceso) {


                        $export+=$proceso->exp;
                        $comerc+=$proceso->comercial;
                        $desec+=$proceso->desecho;
                        $mer+=($proceso->kilos_netos-$proceso->desecho-$proceso->comercial-$proceso->exp);



                }
                $exp_total=$export;
               $com_total=$comerc;
               $des_total=$desec;
               $merm_total=$mer;



    @endphp

    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="grid items-center content-center w-full grid-cols-1 mt-2 mb-4 md:grid-cols-3 xl:grid-cols-3 gap-x-2 gap-y-2">
           <div class="max-w-xl p-4 mx-4 my-2 bg-white rounded-lg shadow sm:p-6 xl:p-4">
              <div class="flex items-center">
               @if ($user)
                  <p class="text-2xl font-bold text-justify">Productor:<br> {{$user->name}}</p>
               @else
                  <p class="text-2xl font-bold text-justify">Hola<br> {{Auth()->user()->name}}</p>
               @endif




              </div>
               @foreach (auth()->user()->roles as $role)
                  <h3 class="text-base font-normal text-gray-500">
                     {{$role->name}}
                  </h3>
               @endforeach
           </div>
           <div class="max-w-xl p-4 mx-4 my-2 bg-white rounded-lg shadow sm:p-6 xl:p-4">
              <div class="flex-shrink-0">
                 <span class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl">
                    <h1 class="block my-2 text-xl font-bold text-cyan-500">% EXPORTACION</h1>


                 </span>
              </div>
              <div class="flex items-center">
                 @if (($exp_total+$com_total+$des_total+$merm_total)>0)
                     <h1 class="block my-2 text-xl font-bold">{{number_format($exp_total*100/($exp_total+$com_total+$des_total+$merm_total),1)}}%</h1>
                     <div class="relative w-full py-2 mx-4">
                        <div class="flex w-full h-4 overflow-hidden text-4xl bg-gray-200 rounded">
                           <div style="width: {{$exp_total*100/($exp_total+$com_total+$des_total+$merm_total)}}%" class="flex flex-col justify-center text-center text-white transition-all duration-500 bg-blue-500 shadow-none whitespace-nowrap">
                              </div>
                        </div>
                     </div>
                 @else
                     <h1 class="block my-2 text-xl font-bold">0%</h1>
                     <div class="relative w-full py-2 mx-4">
                        <div class="flex w-full h-4 overflow-hidden text-4xl bg-gray-200 rounded">
                           <div style="width: 0%" class="flex flex-col justify-center text-center text-white transition-all duration-500 bg-blue-500 shadow-none whitespace-nowrap">
                              </div>
                        </div>
                     </div>
                 @endif


                  <i class="mb-4 text-blue-500 fas fa-ship fa-2x"></i>


              </div>
           </div>
           <div class="max-w-xl p-4 mx-4 my-2 bg-white rounded-lg shadow sm:p-6 xl:p-4">
              <div class="flex-shrink-0">
                 <span class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl">
                    <h1 class="block my-2 text-xl font-bold text-green-500">KILOS RECIBIDOS</h1>

                 </span>

              </div>
              <div class="flex items-center justify-between">


                 <h1 class="block my-2 text-xl font-bold">{{number_format($cant)}}</h1>
                 <i class="justify-end mb-4 text-green-500 fas fa-truck fa-2x fa-flip-horizontal"></i>
              </div>
           </div>


        </div>
     </div>

      <ul class="flex items-center justify-center mt-2 mb-6">
         <template x-for="(tab, index) in tabs" :key="index">
            <li class="px-4 py-3 transition rounded cursor-pointer"
               :class="activeTab===index ? 'bg-red-500 text-white' : ' text-gray-500'" @click="activeTab = index"
               x-text="tab"></li>
         </template>

      </ul>

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/series-label.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <div class="grid content-center justify-between grid-cols-3 mx-2 mt-4 sm:mx-12 md:mx-14 sm:grid-cols-3 md:grid-cols-6 lg:grid-cols-9 gap-y-4 gap-x-3">
      @php
            $varieds=[];
            $exportacion=[];
            $comercial=[];
            $desecho=[];
            $merma=[];
      @endphp
      @if ($espec)
         <button wire:click="espec_clean"   class="items-center content-center w-full px-3 py-3 rounded focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 hover:bg-gray-500 focus:outline-none" style="background-color: #FF8000;">
               <p class="text-sm font-medium leading-none text-white">{{$espec->name}}</p>
         </button>

         @if ($variedades)

               @if ($varie)
                  <button wire:click="varie_clean"  class="items-center w-full px-3 py-3 rounded focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 hover:bg-gray-500 focus:outline-none" style="background-color: #008d39;">
                     <p class="text-sm font-medium leading-none text-white whitespace-nowrap">{{$varie->name}}</p>
                  </button>
               @else
                  @foreach ($variedades as $variedad)
                     @if ($variedad->especie_id==$espec->id)
                        <div class="flex justify-center">
                           <button wire:click="set_varie({{$variedad->id}})"  class="items-center w-full px-2 py-3 rounded focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 hover:bg-gray-500 focus:outline-none" style="background-color: #008d39;">
                              <p class="text-sm font-medium leading-none text-white whitespace-nowrap">{{$variedad->name}}</p>
                           </button>
                        </div>
                        @php
                           $varieds[]=$variedad->name;
                        @endphp
                     @endif
                  @endforeach

               @endif


         @endif
      @else

         @foreach ($especies as $especie)
            <div class="justify-center ">
               <a href="{{route('dashboard.especie',$especie)}}">
                  <button  class="items-center w-full px-4 py-3 rounded focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 hover:bg-gray-500 focus:outline-none" style="background-color: #008d39;">
                        <p class="text-sm font-medium leading-none text-white whitespace-nowrap">{{$especie->name}}</p>
                  </button>
               </a>
            </div>
            @php

                        $export=0;
                        $comerc=0;
                        $desec=0;
                        $mer=0;
                        foreach ($procesosall as $proceso) {

                              if ($proceso->especie==$especie->name) {
                                 $export+=$proceso->exp;
                                 $comerc+=$proceso->comercial;
                                 $desec+=$proceso->desecho;
                                 $mer+=($proceso->kilos_netos-$proceso->desecho-$proceso->comercial-$proceso->exp);

                              }

                        }
                              if ($recepcions->count()) {
                                 $inicio=date('W', strtotime($recepcions->first()->fecha_g_recepcion));
                              } else {
                                 $inicio=date('W', strtotime($now));
                              }



                              $final=date('W', strtotime($now));

                              if ($inicio>$final) {
                                 $final=$final+52;
                              }

                              $name=$especie->name;
                              $array=[];

                              foreach (range($inicio,($final)) as $number) {
                                 $kilos=0;
                                 if($number>52){
                                    $nro=($number-52);
                                 }else{
                                    $nro=$number;
                                 }
                                 foreach($recepcions as $recepcion){

                                       if ($recepcion->n_especie==$especie->name) {
                                          if (date('W', strtotime($recepcion->fecha_g_recepcion))==$nro) {
                                             $kilos+=$recepcion->peso_neto;
                                          }
                                       }
                                    }
                                 $array[]=$kilos;
                              }

                                 $series[]=['name' =>$name,
                                          'data'=> $array];


                           $exportacion[]=$export;
                           $comercial[]=$comerc;
                           $desecho[]=$desec;
                           $merma[]=$mer;

                           $varieds[]=$especie->name;
            @endphp
         @endforeach

      @endif

   </div>

   <div x-show="activeTab===0">
      <div class="mx-2 sm:mx-12">



         @php
            if ($recepcions->count()) {
               $inicio=date('W', strtotime($recepcions->first()->fecha_g_recepcion));
            } else {
               $inicio=date('W', strtotime($now));
            }
            $final=date('W', strtotime($now));

            if ($inicio>$final) {
               $final=$final+52;
            }
            $semenas=[];
            foreach (range($inicio,($final)) as $number) {
               if($number>52){
                  $semanas[]='Semana '.($number-52);
               }else{
                  $semanas[]='Semana '.$number;
               }
            }

         @endphp

         <figure class="my-6 highcharts-figure mx-14" wire:ignore>
            <div id="grafico" wire:ignore>

            </div>
         </figure>

         <div class="grid grid-cols-3">
            <div class="col-span-2">
               <figure class="mx-1 mt-4 highcharts-figure" wire:ignore>
                  <div id="container" wire:ignore>

                  </div>
               </figure>
            </div>
            <div>
               <figure class="mx-1 mt-4 highcharts-figure" wire:ignore>
                  <div id="circular" wire:ignore>

                  </div>
               </figure>
            </div>

         </div>
         @php
            $espec=[];
         @endphp
         <div x-data="setup()">


            <div class="flex justify-center mx-auto mt-6 mb-2 max-w-7xl sm:px-6 lg:px-8">

               <div class="w-full mx-4 my-2 bg-white rounded-lg shadow max-w-7xl">
                  <div class="w-full px-4 py-2 bg-gray-100 rounded-lg shadow max-w-7xl sm:px-6 lg:px-8 sm:p-6 xl:p-4">
                     <h6 class="font-bold text-green-500">Kilos Exportables por Variedades</h6>
                  </div>
                  <div class="px-4 py-2 sm:px-6 lg:px-8 sm:p-6 xl:p-4">

                     <ul class="flex items-center justify-center mt-2 mb-6">
                        <template x-for="(tab, index) in tabs" :key="index">
                           <li class="px-4 py-3 transition rounded cursor-pointer"
                              :class="activeTab===index ? 'bg-red-500 text-white' : ' text-gray-500'" @click="activeTab = index"
                              x-text="tab"></li>
                        </template>

                     </ul>

                     @php
                        $active=0;
                     @endphp
                     @foreach ($especies as $especie)
                        @php
                           $espec[]=$especie->name;
                        @endphp
                        <div x-show="activeTab==={{$active}}">
                           @foreach ($especie->variedads as $variedad)
                              @if ($variedades->contains($variedad->id))


                              @php
                                    $export=0;
                                    $comerc=0;
                                    $desec=0;
                                    $mer=0;
                                    foreach ($procesosall as $proceso) {

                                          if ($proceso->variedad==$variedad->name) {
                                             $export+=$proceso->exp;
                                             $comerc+=$proceso->comercial;
                                             $desec+=$proceso->desecho;
                                             $mer+=($proceso->kilos_netos-$proceso->desecho-$proceso->comercial-$proceso->exp);
                                          }

                                          }



                                    @endphp




                                    <p>{{$variedad->name}} -> <b>{{number_format($export)}} de {{number_format(($export+$comerc+$desec+$mer))}} Kilos</b> </p>
                                       @if (($export+$comerc+$desec+$mer)==0)
                                          <div class="relative w-full py-2">
                                             <div class="flex w-full h-5 overflow-hidden text-4xl bg-gray-200 rounded">
                                                <div style="width: 0%" class="flex flex-col justify-center p-1 text-center text-white transition-all duration-500 bg-blue-500 shadow-none whitespace-nowrap">
                                                <p class="p-1 text-base font-bold">0%</p>
                                                </div>
                                             </div>
                                          </div>
                                       @else
                                          <div class="relative w-full py-2">
                                             <div class="flex w-full h-5 overflow-hidden text-4xl bg-gray-200 rounded">
                                                <div style="width: {{$export*100/($export+$comerc+$desec+$mer)}}%" class="flex flex-col justify-center p-1 text-center text-white transition-all duration-500 bg-blue-500 shadow-none whitespace-nowrap">
                                                <p class="p-1 text-base font-bold">{{number_format($export*100/($export+$comerc+$desec+$mer),1)}}%</p>
                                                </div>
                                             </div>
                                          </div>

                                       @endif

                                 @endif
                           @endforeach

                        </div>
                        @php
                           $active+=1;
                        @endphp
                     @endforeach


                  </div>
               </div>
            </div>


         </div>
      </div>
   </div>
   <div x-show="activeTab===1">
      <div class="mx-2 sm:mx-12">



         @php
            if ($recepcions->count()) {
               $inicio=date('W', strtotime($recepcions->first()->fecha_g_recepcion));
            } else {
               $inicio=date('W', strtotime($now));
            }
            $final=date('W', strtotime($now));

            if ($inicio>$final) {
               $final=$final+52;
            }
            $semenas=[];
            foreach (range($inicio,($final)) as $number) {
               if($number>52){
                  $semanas[]='Semana '.($number-52);
               }else{
                  $semanas[]='Semana '.$number;
               }
            }

         @endphp

         <figure class="my-6 highcharts-figure mx-14" wire:ignore>
            <div id="graficos" wire:ignore>

            </div>
         </figure>

         <div class="grid grid-cols-3">
            <div class="col-span-2">
               <figure class="mx-1 mt-4 highcharts-figure" wire:ignore>
                  <div id="containers" wire:ignore>

                  </div>
               </figure>
            </div>
            <div>
               <figure class="mx-1 mt-4 highcharts-figure" wire:ignore>
                  <div id="circulars" wire:ignore>

                  </div>
               </figure>
            </div>

         </div>
         @php
            $espec=[];
         @endphp
         <div x-data="setup()">


            <div class="flex justify-center mx-auto mt-6 mb-2 max-w-7xl sm:px-6 lg:px-8">

               <div class="w-full mx-4 my-2 bg-white rounded-lg shadow max-w-7xl">
                  <div class="w-full px-4 py-2 bg-gray-100 rounded-lg shadow max-w-7xl sm:px-6 lg:px-8 sm:p-6 xl:p-4">
                     <h6 class="font-bold text-green-500">Kilos Exportables por Variedades</h6>
                  </div>
                  <div class="px-4 py-2 sm:px-6 lg:px-8 sm:p-6 xl:p-4">

                     <ul class="flex items-center justify-center mt-2 mb-6">
                        <template x-for="(tab, index) in tabs" :key="index">
                           <li class="px-4 py-3 transition rounded cursor-pointer"
                              :class="activeTab===index ? 'bg-red-500 text-white' : ' text-gray-500'" @click="activeTab = index"
                              x-text="tab"></li>
                        </template>

                     </ul>

                     @php
                        $active=0;
                     @endphp
                     @foreach ($especies as $especie)
                        @php
                           $espec[]=$especie->name;
                        @endphp
                        <div x-show="activeTab==={{$active}}">
                           @foreach ($especie->variedads as $variedad)
                              @if ($variedades->contains($variedad->id))


                              @php
                                    $export=0;
                                    $comerc=0;
                                    $desec=0;
                                    $mer=0;
                                    foreach ($procesosall as $proceso) {

                                          if ($proceso->variedad==$variedad->name) {
                                             $export+=$proceso->exp;
                                             $comerc+=$proceso->comercial;
                                             $desec+=$proceso->desecho;
                                             $mer+=($proceso->kilos_netos-$proceso->desecho-$proceso->comercial-$proceso->exp);
                                          }

                                          }



                                    @endphp




                                    <p>{{$variedad->name}} -> <b>{{number_format($export)}} de {{number_format(($export+$comerc+$desec+$mer))}} Kilos</b> </p>
                                       @if (($export+$comerc+$desec+$mer)==0)
                                          <div class="relative w-full py-2">
                                             <div class="flex w-full h-5 overflow-hidden text-4xl bg-gray-200 rounded">
                                                <div style="width: 0%" class="flex flex-col justify-center p-1 text-center text-white transition-all duration-500 bg-blue-500 shadow-none whitespace-nowrap">
                                                <p class="p-1 text-base font-bold">0%</p>
                                                </div>
                                             </div>
                                          </div>
                                       @else
                                          <div class="relative w-full py-2">
                                             <div class="flex w-full h-5 overflow-hidden text-4xl bg-gray-200 rounded">
                                                <div style="width: {{$export*100/($export+$comerc+$desec+$mer)}}%" class="flex flex-col justify-center p-1 text-center text-white transition-all duration-500 bg-blue-500 shadow-none whitespace-nowrap">
                                                <p class="p-1 text-base font-bold">{{number_format($export*100/($export+$comerc+$desec+$mer),1)}}%</p>
                                                </div>
                                             </div>
                                          </div>

                                       @endif

                                 @endif
                           @endforeach

                        </div>
                        @php
                           $active+=1;
                        @endphp
                     @endforeach


                  </div>
               </div>
            </div>


      </div>
      </div>

   </div>

      @isset ($series)

      @else
         @php
             $series=[];
         @endphp
      @endif




    <script>
        var titulo = <?php echo json_encode($titulo) ?>;
       var variedades = <?php echo json_encode($varieds) ?>;
       var semanas = <?php echo json_encode($semanas) ?>;
       var series = <?php echo json_encode($series) ?>;
        var exportacion = <?php echo json_encode($exportacion) ?>;
        var comercial = <?php echo json_encode($comercial) ?>;
        var desecho = <?php echo json_encode($desecho) ?>;
        var merma = <?php echo json_encode($merma) ?>;
       // Data retrieved from https://en.wikipedia.org/wiki/Winter_Olympic_Games
        Highcharts.chart('grafico', {

        chart: {
            type: 'column'
        },

        title: {
            text: titulo,
            align: 'center'
        },

        xAxis: {
            categories: variedades
        },

        yAxis: {
            allowDecimals: false,
            min: 0,
            title: {
                text: 'Kilos'
            }
        },

        tooltip: {
         pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.percentage:.0f}%)<br/>',
         shared: true
       },

        plotOptions: {
            column: {
                stacking: 'percent'
            }
        },

        series: [{
             name: 'Exportacion',
             data: exportacion,
             stack: 'variedades'
         }, {
             name: 'Nacional',
             data: comercial,
             stack: 'variedades'
         }, {
             name: 'Desecho',
             data: desecho,
             stack: 'variedades'
         }, {
             name: 'Merma',
             data: merma,
             stack: 'variedades'
         }]
         });

         Highcharts.chart('container', {

         title: {
            text: 'Kilos Recibidos Por Semana',
            align: 'left'
         },
         xAxis: {
            categories: semanas
         },
         yAxis: {
            title: {
               text: 'Kilos'
            }
         },

         legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
         },

         plotOptions: {

         },

         series: series
         ,

         responsive: {
            rules: [{
               condition: {
                     maxWidth: 500
               },
               chartOptions: {
                     legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                     }
               }
            }]
         }

         });

    </script>
    <script>
        var titulo = <?php echo json_encode($titulo) ?>;
       var variedades = <?php echo json_encode($varieds) ?>;
       var exportacion = <?php echo json_encode($exp_total) ?>;
       var comercial = <?php echo json_encode($com_total) ?>;
       var desecho = <?php echo json_encode($des_total) ?>;
       var merma = <?php echo json_encode($merm_total) ?>;

        Highcharts.chart('circular', {
            chart: {
               plotBackgroundColor: null,
               plotBorderWidth: null,
               plotShadow: false,
               type: 'pie'
            },
            title: {
               text: 'Distribución Por Categoría',
               align: 'left'
            },
            tooltip: {
               pointFormat: '<b><b>{point.y}</b>({point.percentage:.0f}%)<br/>',
            },
            accessibility: {
               point: {
                     valueSuffix: '%'
               }
            },
            plotOptions: {
               pie: {
                     allowPointSelect: true,
                     cursor: 'pointer',
                     dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                     },
                     showInLegend: true
               }
            },
            series: [{
               name: 'Brands',
               colorByPoint: true,
               data: [{
                     name: 'Exportacion',
                     y: exportacion,
                     sliced: true,
                     selected: true
               },  {
                     name: 'Comercial',
                     y: comercial
               },  {
                     name: 'Desecho',
                     y: desecho
               }, {
                     name: 'Merma',
                     y: merma
               }]
            }]
         });
    </script>
    {{-- comment
    <script>
        var titulo = <?php echo json_encode($titulo) ?>;
       var variedades = <?php echo json_encode($varieds) ?>;
       var semanas = <?php echo json_encode($semanas) ?>;
       var series = <?php echo json_encode($series) ?>;
        var exportacion = <?php echo json_encode($exportacion) ?>;
        var comercial = <?php echo json_encode($comercial) ?>;
        var desecho = <?php echo json_encode($desecho) ?>;
        var merma = <?php echo json_encode($merma) ?>;
       // Data retrieved from https://en.wikipedia.org/wiki/Winter_Olympic_Games
        Highcharts.chart('graficos', {

        chart: {
            type: 'column'
        },

        title: {
            text: titulo,
            align: 'center'
        },

        xAxis: {
            categories: variedades
        },

        yAxis: {
            allowDecimals: false,
            min: 0,
            title: {
                text: 'Kilos'
            }
        },

        tooltip: {
         pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.percentage:.0f}%)<br/>',
         shared: true
       },

        plotOptions: {
            column: {
                stacking: 'percent'
            }
        },

        series: [{
             name: 'Exportacion',
             data: exportacion,
             stack: 'variedades'
         }, {
             name: 'Nacional',
             data: comercial,
             stack: 'variedades'
         }, {
             name: 'Desecho',
             data: desecho,
             stack: 'variedades'
         }, {
             name: 'Merma',
             data: merma,
             stack: 'variedades'
         }]
         });

         Highcharts.chart('containers', {

         title: {
            text: 'Kilos Recibidos Por Semana',
            align: 'left'
         },
         xAxis: {
            categories: semanas
         },
         yAxis: {
            title: {
               text: 'Kilos'
            }
         },

         legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
         },

         plotOptions: {

         },

         series: series
         ,

         responsive: {
            rules: [{
               condition: {
                     maxWidth: 500
               },
               chartOptions: {
                     legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                     }
               }
            }]
         }

         });

    </script>
    <script>
        var titulo = <?php echo json_encode($titulo) ?>;
       var variedades = <?php echo json_encode($varieds) ?>;
       var exportacion = <?php echo json_encode($exp_total) ?>;
       var comercial = <?php echo json_encode($com_total) ?>;
       var desecho = <?php echo json_encode($des_total) ?>;
       var merma = <?php echo json_encode($merm_total) ?>;

        Highcharts.chart('circulars', {
            chart: {
               plotBackgroundColor: null,
               plotBorderWidth: null,
               plotShadow: false,
               type: 'pie'
            },
            title: {
               text: 'Distribución Por Categoría',
               align: 'left'
            },
            tooltip: {
               pointFormat: '<b><b>{point.y}</b>({point.percentage:.0f}%)<br/>',
            },
            accessibility: {
               point: {
                     valueSuffix: '%'
               }
            },
            plotOptions: {
               pie: {
                     allowPointSelect: true,
                     cursor: 'pointer',
                     dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                     },
                     showInLegend: true
               }
            },
            series: [{
               name: 'Brands',
               colorByPoint: true,
               data: [{
                     name: 'Exportacion',
                     y: exportacion,
                     sliced: true,
                     selected: true
               },  {
                     name: 'Comercial',
                     y: comercial
               },  {
                     name: 'Desecho',
                     y: desecho
               }, {
                     name: 'Merma',
                     y: merma
               }]
            }]
         });
    </script>
    --}}
    <script>
         var espec = <?php echo json_encode($espec) ?>;
            function setup() {
               return {
               activeTab: 0,
               tabs: espec
               };
         };
      </script>

   <script>
         function temporadas() {
            return {
            activeTab: 0,
            tabs: [
                                 "Temporada Actual",
                                 "Temporada Anterior"
                           ]
                           };
      };
   </script>

 </div>
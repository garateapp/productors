<div>
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
                    
                    if ($proceso->especie==$espec->name) {
                        $export+=$proceso->exp;
                        $comerc+=$proceso->comercial;
                        $desec+=$proceso->desecho;
                        $mer+=($proceso->kilos_netos-$proceso->desecho-$proceso->comercial-$proceso->exp);

                    }

                }
                $exp_total=$export;
               $Com_total=$comerc;
               $des_total=$desec;
               $merm_total=$mer; 
                  
                
               

       
 
    @endphp

<section id="graf">   
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="mt-2 mb-2 w-full grid grid-cols-1 md:grid-cols-3 xl:grid-cols-3 gap-x-2 gap-y-2 items-center content-center">
           <div class="max-w-xl  bg-white shadow rounded-lg p-4 sm:p-6 xl:p-4 my-2 mx-4">
              <div class="flex items-center">
                 <div class="flex-shrink-0">
                    <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900"><h1 class="block text-2xl font-bold">Hola<br> {{Auth()->user()->name}}</h1></span>
                   
                       @foreach (auth()->user()->roles as $role)
                          <h3 class="text-base font-normal text-gray-500">
                             {{$role->name}}
                          </h3>
                       @endforeach
                    
                 </div>
                 
              </div>
           </div>
           <div class="max-w-xl  bg-white shadow rounded-lg p-4 sm:p-6 xl:p-4 my-2 mx-4">
              <div class="flex-shrink-0">
                 <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">
                    <h1 class="block my-2 text-xl font-bold text-cyan-500">% EXPORTACION</h1>
                    
                    
                 </span>
              </div>
              <div class="flex items-center">
                 @if (($exp_total+$Com_total+$des_total+$merm_total)==0)
                     <h1 class="block my-2 text-xl font-bold">0%</h1>
                     <div class="relative py-2 w-full mx-4">
                        <div class="w-full overflow-hidden h-4 text-4xl flex rounded bg-gray-200">
                           <div style="width: 0%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-500 transition-all duration-500">
                              </div>
                        </div>
                     </div>
                     <i class="fas fa-ship fa-2x mb-4 text-blue-500"></i>
                     
                 @else
                     <h1 class="block my-2 text-xl font-bold">{{number_format($exp_total*100/($exp_total+$Com_total+$des_total+$merm_total),1)}}%</h1>
                     <div class="relative py-2 w-full mx-4">
                        <div class="w-full overflow-hidden h-4 text-4xl flex rounded bg-gray-200">
                           <div style="width: {{$exp_total*100/($exp_total+$Com_total+$des_total+$merm_total)}}%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-500 transition-all duration-500">
                              </div>
                        </div>
                     </div>
                     <i class="fas fa-ship fa-2x mb-4 text-blue-500"></i>
                 @endif
                
                 
                 
              </div>
           </div>
           <div class="max-w-xl  bg-white shadow rounded-lg p-4 sm:p-6 xl:p-4 my-2 mx-4">
              <div class="flex-shrink-0">
                 <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">
                    <h1 class="block my-2 text-xl font-bold text-green-500">KILOS RECIBIDOS DE {{strtoupper($espec->name.' - '.$varie->name)}}</h1>
                 </span>
               
              </div>
              <div class="flex items-center justify-between">
               
  
                 <h1 class="block my-2 text-xl font-bold">{{number_format($cant)}}</h1>
                 <i class="fas fa-truck fa-2x mb-4 text-green-500 justify-end fa-flip-horizontal"></i>
              </div>
           </div>
  
        </div>
     </div>
</section>

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/series-label.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
 
    
 
       <div class="mx-2 sm:mx-12 md:mx-14 grid grid-cols-3 sm:grid-cols-3 md:grid-cols-6 lg:grid-cols-9 gap-y-4 gap-x-3 justify-between  content-center">
          @php
              $varieds=[];
              $series=[];
              $exportacion=[];
              $comercial=[];
              $desecho=[];
              $merma=[];
          @endphp
          @if ($espec)
                <a href="{{route('dashboard.especie',$espec)}}">
                    <button class="w-full items-center focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 px-3 py-3 hover:bg-gray-500 focus:outline-none rounded content-center" style="background-color: #FF8000;">
                        <p class="text-sm font-medium leading-none text-white">{{$espec->name}}</p>
                    </button>
                </a>
              @if ($variedades)
 
                  @if ($varie)
                    <a href="{{route('dashboard.especie',$espec)}}">
                        <button  class="w-full items-center focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 px-3 py-3 hover:bg-gray-500 focus:outline-none rounded" style="background-color: #008d39;">
                            <p class="whitespace-nowrap text-sm font-medium leading-none text-white">{{$varie->name}}</p>
                        </button>
                    </a>
                        @php
                            $export=0;
                            $comerc=0;
                            $desec=0;
                            $mer=0;
                            foreach ($procesosall as $proceso) {
                                
                                if ($proceso->variedad==$varie->name) {
                                    $export+=$proceso->exp;
                                    $comerc+=$proceso->comercial;
                                    $desec+=$proceso->desecho;
                                    $mer+=($proceso->kilos_netos-$proceso->desecho-$proceso->comercial-$proceso->exp);

                                }

                            }
                               $varieds[]=$varie->name;
                               $exportacion[]=$export;
                               $comercial[]=$comerc;
                               $desecho[]=$desec;
                               $merma[]=$mer;
                        @endphp
                  @else
                      @foreach ($variedades as $variedad)
                          @if ($variedad->especie_id==$espec->id)
                                <div class="flex justify-center">
                                <button  class=" w-full items-center focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 px-2 py-3 hover:bg-gray-500 focus:outline-none rounded" style="background-color: #008d39;">
                                    <p class="whitespace-nowrap text-sm font-medium leading-none text-white">{{$variedad->name}}</p>
                                </button>
                                </div>
                            
                          @endif
                      @endforeach
                      
                  @endif
 
                
              @endif
          @else
          
              @foreach ($especies as $especie)
                <div class="justify-center">
                   <button wire:click="set_especie({{$especie->id}})"  class="w-full items-center focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 px-4 py-3 hover:bg-gray-500 focus:outline-none rounded" style="background-color: #008d39;">
                         <p class="whitespace-nowrap text-sm font-medium leading-none text-white">{{$especie->name}}</p>
                   </button>
                </div>
                @php
                   $varieds[]=$especie->name;
                @endphp
              @endforeach
              
          @endif
      
      </div>
      
    <div class="mx-2 sm:mx-12">
        
        <div class="grid grid-cols-3">
            <figure class="highcharts-figure mx-1 mt-6" wire:ignore>
                <div id="grafico" wire:ignore>
                   
                </div>
            </figure>
            <figure class="highcharts-figure mx-1 mt-6 col-span-2" wire:ignore>
                <div id="container" wire:ignore>
                   
                </div>
            </figure>

        </div>
        <figure class="highcharts-figure mt-2" wire:ignore>
            <div id="barras" wire:ignore>
               
            </div>
        </figure>
       
      
        
    </div>   
    <script>
        
       var titulo = <?php echo json_encode($titulo) ?>;
       var variedades = <?php echo json_encode($varieds) ?>;
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
            text: 'Gráfico de Barras',
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

        // Data retrieved from: https://www.uefa.com/uefachampionsleague/history/
    Highcharts.chart('barras', {
    chart: {
        type: 'bar'
    },
    title: {
        text: titulo,
        align: 'left'
    },
    xAxis: {
        categories: variedades,
        title: {
            text: null
        },
        gridLineWidth: 1,
        lineWidth: 0
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Kilos',
            align: 'high'
        },
        labels: {
            overflow: 'justify'
        },
        gridLineWidth: 0
    },
    tooltip: {
        valueSuffix: ' Kg'
    },
    plotOptions: {
        bar: {
            borderRadius: '50%',
            dataLabels: {
                enabled: true
            },
            groupPadding: 0.1
        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'top',
        x: -10,
        y: 230,
        floating: true,
        borderWidth: 1,
        backgroundColor:
            Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
        shadow: true
    },
    credits: {
        enabled: false
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
             
                
    </script>  

    <script>
        var titulo = <?php echo json_encode($titulo) ?>;
       var variedades = <?php echo json_encode($varieds) ?>;
       var exportacion = <?php echo json_encode($export) ?>;
       var comercial = <?php echo json_encode($comerc) ?>;
       var desecho = <?php echo json_encode($desec) ?>;
       var merma = <?php echo json_encode($mer) ?>;
        Highcharts.chart('container', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Gráfico Circular',
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
                enabled: false
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
 </div>
 

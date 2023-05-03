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
    
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="mt-2 mb-4 w-full grid grid-cols-1 md:grid-cols-3 xl:grid-cols-3 gap-x-2 gap-y-2 items-center content-center">
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
                 
                 <h1 class="block my-2 text-xl font-bold">{{number_format($exp_total*100/($exp_total+$com_total+$des_total+$merm_total),1)}}%</h1>
                    <div class="relative py-2 w-full mx-4">
                       <div class="w-full overflow-hidden h-4 text-4xl flex rounded bg-gray-200">
                         <div style="width: {{$exp_total*100/($exp_total+$com_total+$des_total+$merm_total)}}%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-500 transition-all duration-500">
                           </div>
                       </div>
                   </div>
  
                  <i class="fas fa-ship fa-2x mb-4 text-blue-500"></i>
                 
                 
              </div>
           </div>
           <div class="max-w-xl  bg-white shadow rounded-lg p-4 sm:p-6 xl:p-4 my-2 mx-4">
              <div class="flex-shrink-0">
                 <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">
                    <h1 class="block my-2 text-xl font-bold text-green-500">KILOS RECIBIDOS</h1>
                  
                 </span>
               
              </div>
              <div class="flex items-center justify-between">
               
  
                 <h1 class="block my-2 text-xl font-bold">{{number_format($cant)}}</h1>
                 <i class="fas fa-truck fa-2x mb-4 text-green-500 justify-end fa-flip-horizontal"></i>
              </div>
           </div>
  
       
        </div>
     </div>

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/series-label.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
 
    <div class="flex justify-center mb-2 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="max-w-7xl w-full sm:px-6 lg:px-8 bg-white shadow rounded-lg p-4 sm:p-6 xl:p-4 my-2 mx-4">
           <h1 class="font-bold">Buscador: </h1>
           <div class="px-6 py-4">
            <input wire:keydown="limpiar_page" wire:model="search"  class="form-input flex-1 w-full shadow-sm  border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg focus:outline-none" placeholder="Ingrese el nombre, rut o csg del productor" autocomplete="off">
        </div>
        </div>
     </div>

            <div class="mx-2 sm:mx-12 md:mx-14 grid grid-cols-3 sm:grid-cols-3 md:grid-cols-6 lg:grid-cols-9 gap-y-4 gap-x-3 justify-between  content-center">
               @php
                     $varieds=[];
                     $exportacion=[];
                     $comercial=[];
                     $desecho=[];
                     $merma=[];
               @endphp
               @if ($espec)
                  <button wire:click="espec_clean"   class="w-full items-center focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 px-3 py-3 hover:bg-gray-500 focus:outline-none rounded content-center" style="background-color: #FF8000;">
                        <p class="text-sm font-medium leading-none text-white">{{$espec->name}}</p>
                  </button>
               
                  @if ($variedades)
      
                        @if ($varie)
                           <button wire:click="varie_clean"  class="w-full items-center focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 px-3 py-3 hover:bg-gray-500 focus:outline-none rounded" style="background-color: #008d39;">
                              <p class="whitespace-nowrap text-sm font-medium leading-none text-white">{{$varie->name}}</p>
                           </button>
                        @else
                           @foreach ($variedades as $variedad)
                              @if ($variedad->especie_id==$espec->id)
                                 <div class="flex justify-center">
                                    <button wire:click="set_varie({{$variedad->id}})"  class=" w-full items-center focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 px-2 py-3 hover:bg-gray-500 focus:outline-none rounded" style="background-color: #008d39;">
                                       <p class="whitespace-nowrap text-sm font-medium leading-none text-white">{{$variedad->name}}</p>
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
                           <button class="w-full items-center focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 px-4 py-3 hover:bg-gray-500 focus:outline-none rounded" style="background-color: #008d39;">
                                 <p class="whitespace-nowrap text-sm font-medium leading-none text-white">{{$especie->name}}</p>
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

                                 $kilos=0;

                                 foreach($recepcions as $recepcion){
                                       if ($recepcion->n_especie==$especie->name) {
                                          $kilos+=$recepcion->peso_neto;
                                       } 
                                    }
                                    
                                    
                                    $exportacion[]=$export;
                                    $comercial[]=$comerc;
                                    $desecho[]=$desec;
                                    $merma[]=$mer;
                                 
                                    $varieds[]=$especie->name;
                     @endphp
                  @endforeach
                  
               @endif
            
            </div>

    <div class="mx-2 sm:mx-12">
 
       <figure class="highcharts-figure mx-1 mt-4" wire:ignore>
          <div id="grafico" wire:ignore>
             
          </div>
      </figure>
      <div class="grid grid-cols-3">
         <div class="col-span-2">
            <figure class="highcharts-figure mx-1 mt-4" wire:ignore>
               <div id="container" wire:ignore>
                  
               </div>
            </figure>
         </div>
         <div>
            <figure class="highcharts-figure mx-1 mt-4" wire:ignore>
               <div id="container" wire:ignore>
                  
               </div>
            </figure>
         </div>
         
      </div>
        
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
                text: 'Kilos / %'
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

            subtitle: {
               text: 'Source: <a href="https://irecusa.org/programs/solar-jobs-census/" target="_blank">IREC</a>',
               align: 'left'
            },
            xAxis: {
               categories: ['Semana 1', 'Semana 2', 'Semana 3', 'Semana 4', 'Semana 5', 'Semana 6', 'Semana 7', 'Semana 8', 'Semana 9', 'Semana 9', 'Semana 11', 'Semana 12']
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

            series: [{
               name: 'Installation & Developers',
               data: [43934, 48656, 65165, 81827, 112143, 142383,
                  171533, 165174, 155157, 161454, 154610]
            }, {
               name: 'Manufacturing',
               data: [24916, 37941, 29742, 29851, 32490, 30282,
                  38121, 36885, 33726, 34243, 31050]
            }, {
               name: 'Sales & Distribution',
               data: [11744, 30000, 16005, 19771, 20185, 24377,
                  32147, 30912, 29243, 29213, 25663]
            }, {
               name: 'Operations & Maintenance',
               data: [null, null, null, null, null, null, null,
                  null, 11164, 11218, 10077]
            }, {
               name: 'Other',
               data: [21908, 5548, 8105, 11248, 8989, 11816, 18274,
                  17300, 13053, 11906, 10073]
            }],

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
 </div>
 
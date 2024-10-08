<div>
   <div class="flex justify-center max-w-4xl my-2">
      @if (session('info'))
         <div x-data="{open: true}">
            <div x-show="open"  class="bg-white border border-gray-400 text-gray-700 px-4 py-3 rounded relative" role="alert">
               <strong class="font-bold">Felicidades!</strong>
               <span class="block sm:inline mr-6">{{session('info')}}</span>
               <span x-on:click="open=false" class="absolute top-0 bottom-0 right-0 px-4 py-3">
               <svg class="fill-current h-6 w-6 text-gray-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
               </span>
            </div>
         </div>
      @endif
    </div>
   <script src="https://code.highcharts.com/highcharts.js"></script>
   <script src="https://code.highcharts.com/modules/series-label.js"></script>
   <script src="https://code.highcharts.com/modules/exporting.js"></script>
   <script src="https://code.highcharts.com/modules/export-data.js"></script>
   <script src="https://code.highcharts.com/modules/accessibility.js"></script>

   <div class="flex justify-center mt-2">
      <div>
          @if ($temporada=='actual')
              <button class="mx-2 items-center focus:ring-2 focus:ring-offset-2 focus:red-green-500 sm:mt-0 px-6 py-3 bg-red-500 hover:bg-red-500 focus:outline-none rounded">
                  <p class="text-sm font-medium leading-none text-white">T24/25</p>
              </button>
          @else
          <a href="{{route('procesos.index')}}">
              <button class="mx-2 items-center focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:mt-0 px-6 py-3 bg-green-500 hover:bg-green-500 focus:outline-none rounded">
                  <p class="text-sm font-medium leading-none text-white">T24/25</p>
              </button>
          </a>
          @endif

         
      </div>
      <div>
          @if ($temporada=='anterior')
              <button class="mx-2 items-center focus:ring-2 focus:ring-offset-2 focus:red-green-500 sm:mt-0 px-6 py-3 bg-red-500 hover:bg-red-500 focus:outline-none rounded">
                  <p class="text-sm font-medium leading-none text-white">T23/24</p>
              </button>
          @else
              <a href="{{route('procesos.index.anterior')}}">
                  <button  class="mx-2 items-center focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:mt-0 px-6 py-3 bg-green-500 hover:bg-green-500 focus:outline-none rounded">
                      <p class="text-sm font-medium leading-none text-white">T23/24</p>
                  </button>
              </a>
          @endif
      </div>
  </div>

   <div class="flex justify-between my-2 items-center content-end mx-4 md:mx-12 "> 

      <div class="max-w-7xl bg-white shadow rounded-lg p-4 sm:p-4 xl:p-4 my-4 mr-2 ml-12">
         <div class="flex items-center justify-center">
            <div class="flex-shrink-0 text-center">
               <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">{{number_format($procesosall->count())}}</span>
               <h3 class="text-base font-normal text-gray-500">Procesos</h3>
            </div>
           
         </div>
      </div>

      <h1 class="text-center text-sm my-4 mx-6"><b>Ultima Sincronizacion:</b> {{date('d M Y g:i a', strtotime($sync->fecha))}} <b>Tipo:</b> {{$sync->tipo}} <b>Cantidad:</b> {{$sync->cantidad}}</h1>

      <div class="flex">
         <div class="grid grid-cols-1">
            @if ($temporada=='anterior')
               <a href="{{route('proceso.refresh.anterior')}}">
                  <button  class="my-1 items-center focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 px-6 py-3 bg-gray-500 hover:bg-gray-600 focus:outline-none rounded">
                     <p class="text-sm font-medium leading-none text-white">PROCESO IMPORT</p>
                     <p class="text-xs font-medium leading-none text-white">ANTERIOR</p>
                  </button>
               </a>
            
            @else
               <a href="{{route('proceso.refresh')}}">
                  <button  class="my-1 items-center focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 px-6 py-3 bg-gray-500 hover:bg-gray-600 focus:outline-none rounded">
                     <p class="text-sm font-medium leading-none text-white">PROCESO IMPORT</p>
                     <p class="text-xs font-medium leading-none text-white">ACTUAL</p>
                  </button>
               </a>
            @endif
         </div>
         <div class="items-center my-auto grid grid-cols-1 gap-y-2">
            <button wire:click="generateReport" class="mx-2 items-center focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 px-6 py-3 bg-gray-500 hover:bg-gray-600 focus:outline-none rounded">
               <p class="text-sm font-medium leading-none text-white">Descargar Excel</p>
           </button>
           
            <a href="{{route('download.procesosallzip')}}">
               <button class="mx-2 items-center focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 px-6 py-3 bg-gray-500 hover:bg-gray-600 focus:outline-none rounded">
                  <p class="text-sm font-medium leading-none text-white">Descargar PDF'S .zip</p>
               </button>
            </a>


          
       
         </div>

             
         @if(Route::currentRouteName() == 'procesos.index.anterior')
            <a href="{{route('subir.procesos.anterior')}}">
               <button  class="my-1 items-center focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 px-6 py-3 bg-green-500 hover:bg-green-600 focus:outline-none rounded ml-2">
                  <p class="text-sm font-medium leading-none text-white">SUBIR PROCESO</p>
               </button>
            </a>
         @else
            <a href="{{route('subir.procesos')}}">
               <button  class="my-1 items-center focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 px-6 py-3 bg-green-500 hover:bg-green-600 focus:outline-none rounded ml-2">
                  <p class="text-sm font-medium leading-none text-white">SUBIR PROCESO</p>
               </button>
            </a>
         @endif

        
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
                  <a href="{{route('procesos.admin.especie',$especie)}}">
                     <button  class="w-full items-center focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 px-4 py-3 hover:bg-gray-500 focus:outline-none rounded" style="background-color: #008d39;">
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

      <figure class="highcharts-figure mx-1 mt-6" wire:ignore>
         <div id="grafico" wire:ignore>
            
         </div>
     </figure>

         <div class="px-6 py-4">
            <input wire:keydown="limpiar_page" wire:model="search"  class="form-input flex-1 w-full shadow-sm  border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg focus:outline-none" placeholder="Ingrese la variedad, especie o lote del proceso" autocomplete="off">
         </div>

                     
         <div class="bg-white py-4 md:py-7 px-4 md:px-8 xl:px-10 ">

         
            
            <x-table-responsive>   
               <table class="min-w-full divide-y divide-gray-200 mb-20 pb-20">
         
                  <thead class="bg-gray-50 rounded-full">
               
                     <th>Agricola</th>
                     <th>Nro Proceso</th>
                     <th>Especie</th>
                     <th>Variedad</th>
                     <th class="text-center">Fecha</th>
                     <th class="text-center">Kg<br>Procesados</th>
                     <th class="text-center">%<br>Exportación</th>
                     <th class="text-center">%<br>Comercial</th>
                     <th class="text-center">%<br>Desecho</th>
                     <th class="text-center">%<br>Merma</th>
                     <th class="text-center">Informe</th>
                     <th> </th>
                     
                     
                  </thead>

                  <tbody>
                     @php
                           $n=1;
                     @endphp
                  
                        @foreach ($procesos as $proceso)
                         
                           <tr class="h-16 border border-gray-100 rounded">
                              
                                 <td class="text-center">
                                    <p class="text-base font-medium  text-gray-700">
         
                                    
         
                                          @if ($proceso->agricola)
                                             {{$proceso->agricola}}
                                             
                                          @endif
                                    
                                          
                                    </p>
                                 
                                 </td>
                                 <td class="">
                                    <div class="flex items-center pl-5">
                                          <p class="text-base font-medium leading-none text-gray-700 mr-2">
         
                                          
                                             @if ($proceso->n_proceso)
                                             {{$proceso->n_proceso}}
                                             
                                             @endif
                                          
                                             
                                          </p>
                                    
                                    </div>
                                 </td> 
                                 <td class="">
                                    <div class="flex items-center pl-5">
                                          <p class="text-base font-medium leading-none text-gray-700 mr-2">
         
                                          
                                             @if ($proceso->especie)
                                             {{$proceso->especie}}
                                             
                                             @endif
                                          
                                             
                                          </p>
                                    
                                    </div>
                                 </td>
                                 <td class="pl-5">
                                    <div class="whitespace-nowrap flex items-center text-center">
                                          
                                          <p class="whitespace-nowrap text-sm leading-none text-gray-600 ml-2">
                                    
                                             @if ($proceso->variedad)
                                                {{$proceso->variedad}}
                                                
                                             @endif
                                          </p>
                                    </div>
                                 </td>
                                 <td class="pl-5 text-center whitespace-nowrap">
                                    <p class="whitespace-nowrap text-base text-center font-medium leading-none text-gray-700 mr-2">
         
                                 
                                       @if ($proceso->fecha)
                                             {{date('d M Y g:i a', strtotime($proceso->fecha))}}
                                             
                                       @endif
                                    
                                    </p>
                                 
                                 </td>
                                       <td class="pl-5 whitespace-nowrap">
                                          <p class="whitespace-nowrap  text-base flex font-medium leading-none text-gray-700 mr-2">
         
                                          
         
                                          @if ($proceso->kilos_netos)
                                             {{number_format($proceso->kilos_netos)}}
                                          @endif
                                                            
                                          </p>
                                       </td>
                                    
                                             <td class="pl-5 whitespace-nowrap">
                                                      <p class="whitespace-nowrap  text-base flex font-medium leading-none text-gray-700 mr-2">

                                                      

                                                      @if ($proceso->kilos_netos>0)
                                                         {{round($proceso->exp*100/$proceso->kilos_netos, 1)}}%
                                                      @endif
                                                </p>
                                                
                                             </td>
                                             <td class="pl-5 whitespace-nowrap">
                                                <p class="whitespace-nowrap  text-base flex font-medium leading-none text-gray-700 mr-2">

                                                

                                                @if ($proceso->kilos_netos>0)
                                                   {{round($proceso->comercial*100/$proceso->kilos_netos, 1)}}%
                                                @endif
                                                
                                          </p>
                                          
                                       </td>
                                       <td class="pl-5 whitespace-nowrap">
                                          <p class="whitespace-nowrap  text-base flex font-medium leading-none text-gray-700 mr-2">

                                          

                                          @if ($proceso->kilos_netos>0)
                                             {{round($proceso->desecho*100/$proceso->kilos_netos, 1)}}%
                                          @endif
                                          
                                    </p>
                                    
                                 </td>
                                 <td class="pl-5 whitespace-nowrap">
                                    <p class="whitespace-nowrap  text-base flex font-medium leading-none text-gray-700 mr-2">

                                    

                                    @if ($proceso->kilos_netos>0)
                                       {{round(($proceso->kilos_netos-$proceso->exp-$proceso->comercial-$proceso->desecho)*100/$proceso->kilos_netos, 1)}}%
                                    @endif
                                    
                                 
                                    
                                    </p>
                              
                                 </td>
                                 
                                 <td class="pl-5">
                                 
                                       <div class="content-center items-center">
                                          @if ($proceso->informe)
                                          <div class="flex justify-center">
                                             <a href="{{route('download.proceso',$proceso)}}" target="_blank" class="items-center content-center justify-center mx-auto">   
                                                <img class="h-8 object-contain mx-2" src="{{asset('image/pdf_icon2.png')}}" title="Descargar" alt="">
                                             </a>
                                          </div>
                                             <button wire:click="reenviar_informe({{$proceso}})" class="font-bold py-1 px-3 mt-2 rounded-full bg-green-500 text-white text-xs mb-2" type="submit" title="Reenviar Whatsapp">Reenviar Whatsapp</button>
           
                                           
                                             
                                          @else
                                             
                                          @endif
                                       
                                       
                                       </div>                            
                                 
                              
                                 
                              
                                 </td>
                                 <td class="mr-2">
                                 
                                    <div class="block w-full">
                                       @if ($proceso->informe)
                                         
                                          <form action="{{route('delete.proceso',$proceso)}}" method="POST">
                                             @csrf
                                             @method('delete')
                           
                                             <button class="font-bold py-1 px-3 rounded-full bg-red-500 text-white text-xl" type="submit" title="Eliminar">x</button>
                                             
                                       </form>
                                          
                                       @else
                                          
                                       @endif
                                    
                                    
                                    </div>                            
                              
                           
                              
                           
                              </td>
                              
                                 
                              
                              
                           </tr>
                        
                        @endforeach
         
                  
                     
                     
                  
                  
                  </tbody>
               </table>
            </x-table-responsive>
         
            <div class="flex justify-between mt-4 mx-12">
               @if ($procesos->count())
                  <div class="">
                     {{$procesos->links()}}
                  </div>
               
               
         
               @endif 
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
               
   </script>  
</div>

<div>
     
   <script src="https://code.highcharts.com/highcharts.js"></script>
   <script src="https://code.highcharts.com/modules/series-label.js"></script>
   <script src="https://code.highcharts.com/modules/exporting.js"></script>
   <script src="https://code.highcharts.com/modules/export-data.js"></script>
   <script src="https://code.highcharts.com/modules/accessibility.js"></script>
   
         <div class="flex justify-between my-2 items-center content-center mx-12"> 
        
            <button  class="items-center focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 px-6 py-3 bg-gray-500 hover:bg-gray-600 focus:outline-none rounded">
                <p class="text-sm font-medium leading-none text-white">Descargar Excel</p>
            </button>

           
         
             
               <select wire:model="ctd" class="max-w-xl  mx-2 bg-gray-200 border border-gray-200 text-gray-700 py-3 px-6 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                   <option value="25" class="text-left px-10">25 </option>
                   <option value="50" class="text-left px-10">50 </option>
                   <option value="100" class="text-left px-10">100 </option>
                   <option value="500" class="text-left px-10">500 </option>
                   
               </select>
         
       

    </div>

    <div class="mx-2 sm:mx-12">

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
                  <a href="{{route('procesos.productor.especie',$especie)}}">
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

      
      <figure class="highcharts-figure mx-14 mt-6" wire:ignore>
         <div id="grafico" wire:ignore>
            
         </div>
     </figure>

      <div class="px-6 py-4">
         <input wire:keydown="limpiar_page" wire:model="search"  class="form-input flex-1 w-full shadow-sm  border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg focus:outline-none" placeholder="Ingrese la variedad, especie o lote de la recepción" autocomplete="off">
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
                      {{-- comment        {{$n.') '.$proceso}}<br>
                                        @php
                                           $m=1;
                                           $n+=1;
                                        @endphp
                                     
                                  @foreach ($proceso as $item)
                                  {{$m}}) {{$item}}<br>
                                        
                                           @php
                                                 $m+=1;
                                           @endphp
                                     @endforeach
                                     --}}  
                         {{-- comment  --}}    
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
                                        {{$proceso->kilos_netos}}
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
                                          
                        <div class="content-center">
                           @if ($proceso->informe)
                              <a href="{{route('download.proceso',$proceso)}}" target="_blank" class="h-10 m-2 w-full mr-2 items-center content-center">   
                                 <img class="h-10 m-2 w-full mr-2" src="{{asset('image/pdf_icon2.png')}}" title="Descargar" alt="">
                              </a>
                           
                              
                           @else
                              
                           @endif
                        
                        
                        </div>                            
                  
               
                  
               
                  </td>
                  <td class="pl-5">
                  
                           <div class="block w-full">
                            
                           
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

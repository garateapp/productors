<div>
   <script src="https://code.highcharts.com/highcharts.js"></script>
   <script src="https://code.highcharts.com/modules/series-label.js"></script>
   <script src="https://code.highcharts.com/modules/exporting.js"></script>
   <script src="https://code.highcharts.com/modules/export-data.js"></script>
   <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <div class="flex justify-end  my-2 items-center content-end mx-4 md:mx-12 "> 

      
      <a href="{{route('proceso.refresh')}}">
         <button  class="items-center focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 px-6 py-3 bg-gray-500 hover:bg-gray-600 focus:outline-none rounded">
             <p class="text-sm font-medium leading-none text-white">PROCESO IMPORT</p>
         </button>
     </a>

      <a href="{{route('subir.procesos')}}">
            <button  class="items-center focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 px-6 py-3 bg-green-500 hover:bg-green-600 focus:outline-none rounded ml-2">
               <p class="text-sm font-medium leading-none text-white">SUBIR PROCESO</p>
            </button>
      </a>
        
   
 </div>

      <div class="mx-2 sm:mx-12 grid grid-cols-3 sm:grid-cols-3 md:grid-cols-6 lg:grid-cols-9 gap-y-4 gap-x-2 justify-center content-center">
         @if ($espec)
             <button wire:click="espec_clean"   class="items-center focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 px-6 py-3 hover:bg-gray-500 focus:outline-none rounded content-center" style="background-color: #FF8000;">
                 <p class="text-sm font-medium leading-none text-white">{{$espec->name}}</p>
             </button>
         
             @if ($variedades)

                 @if ($varie)
                     <button wire:click="varie_clean"  class="items-center focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 px-6 py-3 hover:bg-gray-500 focus:outline-none rounded" style="background-color: #008d39;">
                         <p class="whitespace-nowrap text-sm font-medium leading-none text-white">{{$varie->name}}</p>
                     </button>
                 @else
                     @foreach ($variedades as $variedad)
                         @if ($variedad->especie_id==$espec->id)
                             <button wire:click="set_varie({{$variedad->id}})"  class="items-center focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 px-3 py-3 hover:bg-gray-500 focus:outline-none rounded" style="background-color: #008d39;">
                                 <p class="whitespace-nowrap text-sm font-medium leading-none text-white">{{$variedad->name}}</p>
                             </button>
                         @endif
                     @endforeach
                 @endif

               
             @endif
         @else
             @foreach ($especies as $especie)
             <div class="justify-center ">
                 <button wire:click="set_especie({{$especie->id}})"  class="items-center focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 px-6 py-3 hover:bg-gray-500 focus:outline-none rounded" style="background-color: #008d39;">
                     <p class="whitespace-nowrap text-sm font-medium leading-none text-white">{{$especie->name}}</p>
                 </button>
             </div>
             @endforeach
             
         @endif
     
     </div>
     
   <div class="mx-2 sm:mx-12">

      <figure class="highcharts-figure mx-14 mt-6" wire:ignore>
         <div id="grafico" wire:ignore>
            
         </div>
     </figure>

         <div class="px-6 py-4">
            <input wire:keydown="limpiar_page" wire:model="search"  class="form-input flex-1 w-full shadow-sm  border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg focus:outline-none" placeholder="Ingrese el variedad, especie o lote de la recepción" autocomplete="off">
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
                                 
                                 <div class="block md:flex">
                                    @if ($proceso->informe)
                                       <a href="{{route('download.proceso',$proceso)}}" target="_blank" >   
                                          <img class="w-10 my-2 mr-2" src="{{asset('image/pdf_icon2.png')}}" title="Descargar" alt="">
                                       </a>
                                       <form action="{{route('delete.proceso',$proceso)}}" method="POST">
                                          @csrf
                                          @method('delete')
                        
                                          <button class="font-bold py-1 px-3 mt-2 rounded-full bg-red-500 text-white text-2xl" type="submit" title="Eliminar">x</button>
                                          
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
      var ventas = <?php echo json_encode($titulo) ?>;
      // Data retrieved from https://en.wikipedia.org/wiki/Winter_Olympic_Games
       Highcharts.chart('grafico', {

       chart: {
           type: 'column'
       },

       title: {
           text: ventas,
           align: 'center'
       },

       xAxis: {
           categories: ['Gold', 'Silver', 'Bronze']
       },

       yAxis: {
           allowDecimals: false,
           min: 0,
           title: {
               text: 'Kilos'
           }
       },

       tooltip: {
           formatter: function () {
               return '<b>' + this.x + '</b><br/>' +
                   this.series.name + ': ' + this.y + '<br/>' +
                   'Total: ' + this.point.stackTotal;
           }
       },

       plotOptions: {
           column: {
               stacking: 'normal'
           }
       },

       series: [{
           name: 'Norway',
           data: [148, 133, 124],
           stack: 'Europe'
       }, {
           name: 'Germany',
           data: [102, 98, 65],
           stack: 'Europe'
       }, {
           name: 'United States',
           data: [113, 122, 95],
           stack: 'North America'
       }, {
           name: 'Canada',
           data: [77, 72, 80],
           stack: 'North America'
       }]
       });
               
   </script>  
</div>

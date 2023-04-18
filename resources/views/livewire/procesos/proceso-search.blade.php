<div>
    <div class="flex justify-center my-2 items-center content-center"> 
        <a href="{{route('proceso.refresh')}}">
            <button  class="items-center focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 px-6 py-3 bg-gray-500 hover:bg-gray-500 focus:outline-none rounded">
                <p class="text-sm font-medium leading-none text-white">PROCESO IMPORT</p>
            </button>
        </a>
           
      
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

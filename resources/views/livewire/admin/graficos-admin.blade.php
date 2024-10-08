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
    
    @php
    $cant2=0;
 
      foreach($recepcions2 as $recepcion2){
          $cant2+=$recepcion2->peso_neto;
      }
      
          
              $export2=0;
              $comerc2=0;
              $desec2=0;
              $mer2=0;
              foreach ($procesosall2 as $proceso2) {
                  

                      $export2+=$proceso2->exp;
                      $comerc2+=$proceso2->comercial;
                      $desec2+=$proceso2->desecho;
                      $mer2+=($proceso2->kilos_netos-$proceso2->desecho-$proceso2->comercial-$proceso2->exp);
                   }

             $exp_total2=$export2;
             $com_total2=$comerc2;
             $des_total2=$desec2;
             $merm_total2=$mer2; 
                
     

  @endphp
  
   <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="mt-2 mb-4 w-full grid grid-cols-1 md:grid-cols-3 xl:grid-cols-3 gap-x-2 gap-y-2 items-center content-center">
           <div class="max-w-xl  bg-white shadow rounded-lg p-4 sm:p-6 xl:p-4 my-2 mx-4">
              <div class="flex items-center">
                  <p class="text-2xl font-bold text-justify">Hola<br> {{Auth()->user()->name}}</p>
               
              
                 
               </div>
               @foreach (auth()->user()->roles as $role)
                  <h3 class="text-base font-normal text-gray-500">
                     {{$role->name}}
                  </h3>
               @endforeach
           </div>
           <div class="max-w-xl  bg-white shadow rounded-lg p-4 sm:p-6 xl:p-4 my-2 mx-4">
              <div class="flex justify-between">
                 <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">
                    <h1 class="block my-2 text-xl font-bold text-cyan-500">% EXPORTACION</h1>
                    
                  
                 </span>
                 <i class="fas fa-ship fa-2x mb-4 text-blue-500"></i>
              </div>
              <div class="flex items-center">
               @if (($exp_total2+$com_total2+$des_total2+$merm_total2)>0)
                  <h1 class="block my-2 text-xl font-bold">{{number_format($exp_total2*100/($exp_total2+$com_total2+$des_total2+$merm_total2),1)}}%</h1>
                  <div class="relative py-2 w-full mx-4">
                     <div class="w-full overflow-hidden h-4 text-4xl flex rounded bg-gray-200">
                        <div style="width: {{$exp_total2*100/($exp_total2+$com_total2+$des_total2+$merm_total2)}}%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-500 transition-all duration-500">
                           </div>
                     </div>
                  </div>
               @else
                  <h1 class="block my-2 text-xl font-bold">0%</h1>
                  <div class="relative py-2 w-full mx-4">
                     <div class="w-full overflow-hidden h-4 text-4xl flex rounded bg-gray-200">
                        <div style="width: 0%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-500 transition-all duration-500">
                           </div>
                     </div>
                  </div>
               @endif
            

           
             <h1 class="block my-2 text-xl font-bold">T23/24</h1>
            
         </div>
              <div class="flex items-center">
                 @if (($exp_total+$com_total+$des_total+$merm_total)>0)
                     <h1 class="block my-2 text-xl font-bold">{{number_format($exp_total*100/($exp_total+$com_total+$des_total+$merm_total),1)}}%</h1>
                     <div class="relative py-2 w-full mx-4">
                        <div class="w-full overflow-hidden h-4 text-4xl flex rounded bg-gray-200">
                           <div style="width: {{$exp_total*100/($exp_total+$com_total+$des_total+$merm_total)}}%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-500 transition-all duration-500">
                              </div>
                        </div>
                     </div>
                 @else
                     <h1 class="block my-2 text-xl font-bold">0%</h1>
                     <div class="relative py-2 w-full mx-4">
                        <div class="w-full overflow-hidden h-4 text-4xl flex rounded bg-gray-200">
                           <div style="width: 0%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-500 transition-all duration-500">
                              </div>
                        </div>
                     </div>
                 @endif
                 
  
                
                  <h1 class="block my-2 text-xl font-bold">T24/25</h1>
                 
              </div>
             
           </div>
           <div class="max-w-xl  bg-white shadow rounded-lg p-4 sm:p-6 xl:p-4 my-2 mx-4">
              <div class="flex justify-between">
                 <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">
                    <h1 class="block my-2 text-xl font-bold text-green-500">KILOS RECIBIDOS</h1>
                  
                 </span>
                 <i class="fas fa-truck fa-2x mb-4 text-green-500 justify-end fa-flip-horizontal"></i>
              </div>
              <table class="my-2 text-xl font-bold gap-x-4 w-full">
               <tr class="">
                  <td class="mx-2 text-center">{{number_format($cant2)}} </td> <td class="ml-4">  T23/24</td>
               </tr>
               <tr class="">
                  <td class="mx-2 text-center">{{number_format($cant)}} </td> <td class="ml-4">  T24/25</td>
               </tr>
              
              </table>
             
           </div>
  
       
        </div>
   </div>

   <ul class="flex justify-center items-center mb-6 mt-2">
      <template x-for="(tab, index) in tabs" :key="index">
         <li class="cursor-pointer py-3 px-4 rounded transition"
            :class="activeTab===index ? 'bg-red-500 text-white' : ' text-gray-500'" @click="activeTab = index"
            x-text="tab"></li>
      </template>

   </ul>

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/series-label.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
   
   <div >
      <div class="flex justify-center mb-2 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="max-w-7xl w-full sm:px-6 lg:px-8 bg-white shadow rounded-lg p-4 sm:p-6 xl:p-4 my-2 mx-4">
           <h1 class="font-bold">Buscador Temporada Actual: </h1>
           <div class="px-6 py-4">
            <input wire:keydown="limpiar_page" wire:model="search"  class="form-input flex-1 w-full shadow-sm  border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg focus:outline-none" placeholder="Ingrese el nombre, rut o csg del productor" autocomplete="off">
           
            @if ($search)
                  <ul class="relative z-1 left-0 w-full bg-white mt-1 rounded-lg overflow-hidden px-4">
                     @foreach ($productors as $productor)
                        <li class="leading-10 px-5 text-sm cursor-pointer hover:bg-gray-300">
                              <a href="{{route('dashboard.productor',$productor->id)}}">{{$productor->name}}</a>
                        </li>
                    

                     @endforeach
                  
                     
                  </ul>
         
          
                  
            @endif
         </div>
        </div>
      </div>

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
                  @if ($recepcions->count()>0)
                      
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

                                    $inicio=date('W', strtotime($recepcions->first()->fecha_g_recepcion));
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
               @endif
            
         </div>
         @if ($recepcions->count()>0)
            @php
               $semenas=[];
                foreach (range($inicio,($final)) as $number) {
                  if($number>52){
                     $semanas[]='Semana '.($number-52);
                  }else{
                     $semanas[]='Semana '.$number;
                  }  
               }

            @endphp
         @endif
              
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
               <div id="circular" wire:ignore>
                  
               </div>
            </figure>
         </div>
         
      </div>
            @php
                $espec=[];
            @endphp
      <div x-data="setup()">
        
            
            <div class="flex justify-center mb-2 mt-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
               
               <div class="max-w-7xl w-full bg-white shadow rounded-lg my-2 mx-4">
                  <div class="max-w-7xl w-full sm:px-6 lg:px-8 bg-gray-100 shadow rounded-lg px-4 py-2 sm:p-6 xl:p-4">
                     <h6 class="font-bold text-green-500">Kilos Exportables por Variedades</h6>
                  </div>
                  <div class="sm:px-6 lg:px-8  px-4 py-2 sm:p-6 xl:p-4">
                    
                     <ul class="flex justify-center items-center mb-6 mt-2">
                        <template x-for="(tab, index) in tabs" :key="index">
                           <li class="cursor-pointer py-3 px-4 rounded transition"
                              :class="activeTab===index ? 'bg-red-500 text-white' : ' text-gray-500'" @click="activeTab = index"
                              x-text="tab"></li>
                        </template>
                  
                     </ul>


                     @foreach ($especies as $especie)
                        @php
                           $espec2[]=$especie->name;
                        @endphp
                        <div x-show="activeTab==={{$especie->id-1}}">

                           @foreach ($especie->variedads as $variedad)

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
                                    <div class="relative py-2 w-full">
                                       <div class="w-full overflow-hidden h-5 text-4xl flex rounded bg-gray-200">
                                          <div style="width: 0%" class="shadow-none flex flex-col text-center whitespace-nowrap p-1 text-white justify-center bg-blue-500 transition-all duration-500">
                                          <p class="text-base font-bold p-1">0%</p> 
                                          </div>
                                       </div>
                                    </div>  
                                 @else
                                    <div class="relative py-2 w-full">
                                       <div class="w-full overflow-hidden h-5 text-4xl flex rounded bg-gray-200">
                                          <div style="width: {{$export*100/($export+$comerc+$desec+$mer)}}%" class="shadow-none flex flex-col text-center whitespace-nowrap p-1 text-white justify-center bg-blue-500 transition-all duration-500">
                                          <p class="text-base font-bold p-1">{{number_format($export*100/($export+$comerc+$desec+$mer),1)}}%</p> 
                                          </div>
                                       </div>
                                    </div>  
                                       
                                 @endif
                           @endforeach

                        </div>

                     @endforeach
                     

                  </div>
               </div>
            </div>
         
        
      </div>
     
      </div> 

   </div>
   {{-- comment 
   <div x-show="activeTab===1">

      <div class="flex justify-center mb-2 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="max-w-7xl w-full sm:px-6 lg:px-8 bg-white shadow rounded-lg p-4 sm:p-6 xl:p-4 my-2 mx-4">
           <h1 class="font-bold">Buscador Temporada Anterior: </h1>
           <div class="px-6 py-4">
            <input wire:keydown="limpiar_page" wire:model="search"  class="form-input flex-1 w-full shadow-sm  border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg focus:outline-none" placeholder="Ingrese el nombre, rut o csg del productor" autocomplete="off">
           
            @if ($search)
                  <ul class="relative z-1 left-0 w-full bg-white mt-1 rounded-lg overflow-hidden px-4">
                     @foreach ($productors as $productor)
                        <li class="leading-10 px-5 text-sm cursor-pointer hover:bg-gray-300">
                              <a href="{{route('dashboard.productor',$productor->id)}}">{{$productor->name}}</a>
                        </li>
                    

                     @endforeach
                  
                     
                  </ul>
         
          
                  
            @endif
         </div>
        </div>
      </div>

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

                                 $inicio=date('W', strtotime($recepcions->first()->fecha_g_recepcion));
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

            @php
               $semenas=[];
                foreach (range($inicio,($final)) as $number) {
                  if($number>52){
                     $semanas[]='Semana '.($number-52);
                  }else{
                     $semanas[]='Semana '.$number;
                  }  
               }

            @endphp
             
              
    <div class="mx-2 sm:mx-12">
 
       <figure class="highcharts-figure mx-1 mt-4" wire:ignore>
          <div id="graficos" wire:ignore>
             
          </div>
      </figure>
      <div class="grid grid-cols-3">
         <div class="col-span-2">
            <figure class="highcharts-figure mx-1 mt-4" wire:ignore>
               <div id="containers" wire:ignore>
                  
               </div>
            </figure>
         </div>
         <div>
            <figure class="highcharts-figure mx-1 mt-4" wire:ignore>
               <div id="circulars" wire:ignore>
                  
               </div>
            </figure>
         </div>
         
      </div>
            @php
                $espec2=[];
            @endphp
      <div x-data="setup()">
        
            
            <div class="flex justify-center mb-2 mt-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
               
               <div class="max-w-7xl w-full bg-white shadow rounded-lg my-2 mx-4">
                  <div class="max-w-7xl w-full sm:px-6 lg:px-8 bg-gray-100 shadow rounded-lg px-4 py-2 sm:p-6 xl:p-4">
                     <h6 class="font-bold text-green-500">Kilos Exportables por Variedades</h6>
                  </div>
                  <div class="sm:px-6 lg:px-8  px-4 py-2 sm:p-6 xl:p-4">
                    
                     <ul class="flex justify-center items-center mb-6 mt-2">
                        <template x-for="(tab, index) in tabs" :key="index">
                           <li class="cursor-pointer py-3 px-4 rounded transition"
                              :class="activeTab===index ? 'bg-red-500 text-white' : ' text-gray-500'" @click="activeTab = index"
                              x-text="tab"></li>
                        </template>
                  
                     </ul>


                     @foreach ($especies as $especie)
                        @php
                           $espec2[]=$especie->name;
                        @endphp
                        <div x-show="activeTab==={{$especie->id-1}}">

                           @foreach ($especie->variedads as $variedad)

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
                                    <div class="relative py-2 w-full">
                                       <div class="w-full overflow-hidden h-5 text-4xl flex rounded bg-gray-200">
                                          <div style="width: 0%" class="shadow-none flex flex-col text-center whitespace-nowrap p-1 text-white justify-center bg-blue-500 transition-all duration-500">
                                          <p class="text-base font-bold p-1">0%</p> 
                                          </div>
                                       </div>
                                    </div>  
                                 @else
                                    <div class="relative py-2 w-full">
                                       <div class="w-full overflow-hidden h-5 text-4xl flex rounded bg-gray-200">
                                          <div style="width: {{$export*100/($export+$comerc+$desec+$mer)}}%" class="shadow-none flex flex-col text-center whitespace-nowrap p-1 text-white justify-center bg-blue-500 transition-all duration-500">
                                          <p class="text-base font-bold p-1">{{number_format($export*100/($export+$comerc+$desec+$mer),1)}}%</p> 
                                          </div>
                                       </div>
                                    </div>  
                                       
                                 @endif
                           @endforeach

                        </div>

                     @endforeach
                     

                  </div>
               </div>
            </div>
         
        
      </div>
     
      </div> 

   </div>
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
--}}

    <script>
      var espec = <?php echo json_encode($espec2) ?>;
         function setup() {
            return {
            activeTab: 0,
            tabs: espec
            };
      };
   </script>

   @if($recepcions->count()>0)
    <script>
       var titulo = <?php echo json_encode($titulo) ?>;
       var variedades = <?php echo json_encode($varieds) ?>;
       var semanas = <?php echo json_encode($semanas) ?>;
       var series = <?php echo json_encode($series) ?>;
        var exportacion = <?php echo json_encode($exportacion) ?>;
        var comercial = <?php echo json_encode($comercial) ?>;
        var desecho = <?php echo json_encode($desecho) ?>;
        var merma = <?php echo json_encode($merma) ?>;
      
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
   @endif

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

 </div>
 
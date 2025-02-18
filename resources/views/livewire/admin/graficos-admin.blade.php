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

   <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="grid items-center content-center w-full grid-cols-1 mt-2 mb-4 md:grid-cols-3 xl:grid-cols-3 gap-x-2 gap-y-2">
           <div class="max-w-xl p-4 mx-4 my-2 bg-white rounded-lg shadow sm:p-6 xl:p-4">
              <div class="flex items-center">
                  <p class="text-2xl font-bold text-justify">Hola<br> {{Auth()->user()->name}}</p>



               </div>
               @foreach (auth()->user()->roles as $role)
                  <h3 class="text-base font-normal text-gray-500">
                     {{$role->name}}
                  </h3>
               @endforeach
           </div>
           <div class="max-w-xl p-4 mx-4 my-2 bg-white rounded-lg shadow sm:p-6 xl:p-4">
              <div class="flex justify-between">
                 <span class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl">
                    <h1 class="block my-2 text-xl font-bold text-cyan-500">% EXPORTACION</h1>


                 </span>
                 <i class="mb-4 text-blue-500 fas fa-ship fa-2x"></i>
              </div>
              <div class="flex items-center">
               @if (($exp_total2+$com_total2+$des_total2+$merm_total2)>0)
                  <h1 class="block my-2 text-xl font-bold">{{number_format($exp_total2*100/($exp_total2+$com_total2+$des_total2+$merm_total2),1)}}%</h1>
                  <div class="relative w-full py-2 mx-4">
                     <div class="flex w-full h-4 overflow-hidden text-4xl bg-gray-200 rounded">
                        <div style="width: {{$exp_total2*100/($exp_total2+$com_total2+$des_total2+$merm_total2)}}%" class="flex flex-col justify-center text-center text-white transition-all duration-500 bg-blue-500 shadow-none whitespace-nowrap">
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



             <h1 class="block my-2 text-xl font-bold">T23/24</h1>

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



                  <h1 class="block my-2 text-xl font-bold">T24/25</h1>

              </div>

           </div>
           <div class="max-w-xl p-4 mx-4 my-2 bg-white rounded-lg shadow sm:p-6 xl:p-4">
              <div class="flex justify-between">
                 <span class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl">
                    <h1 class="block my-2 text-xl font-bold text-green-500">KILOS RECIBIDOS</h1>

                 </span>
                 <i class="justify-end mb-4 text-green-500 fas fa-truck fa-2x fa-flip-horizontal"></i>
              </div>
              <table class="w-full my-2 text-xl font-bold gap-x-4">
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

   <div >
      <div class="flex justify-center mx-auto mb-2 max-w-7xl sm:px-6 lg:px-8">
        <div class="w-full p-4 mx-4 my-2 bg-white rounded-lg shadow max-w-7xl sm:px-6 lg:px-8 sm:p-6 xl:p-4">
           <h1 class="font-bold">Buscador Temporada Actual: </h1>
           <div class="px-6 py-4">
            <input wire:keydown="limpiar_page" wire:model="search"  class="flex-1 w-full h-10 px-5 pr-16 bg-white border-2 border-gray-300 rounded-lg shadow-sm form-input focus:outline-none" placeholder="Ingrese el nombre, rut o csg del productor" autocomplete="off">

            @if ($search)
                  <ul class="relative left-0 w-full px-4 mt-1 overflow-hidden bg-white rounded-lg z-1">
                     @foreach ($productors as $productor)
                        <li class="px-5 text-sm leading-10 cursor-pointer hover:bg-gray-300">
                              <a href="{{route('dashboard.productor',$productor->id)}}">{{$productor->name}}</a>
                        </li>


                     @endforeach


                  </ul>



            @endif
         </div>
        </div>
      </div>

         <div class="grid content-center justify-between grid-cols-3 mx-2 sm:mx-12 md:mx-14 sm:grid-cols-3 md:grid-cols-6 lg:grid-cols-9 gap-y-4 gap-x-3">
               @php
                     $varieds=[];
                     $series=[];
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
                                    <button wire:click="set_varie({{$variedad->id}})"  class="items-center w-full px-2 py-3 rounded  focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 hover:bg-gray-500 focus:outline-none" style="background-color: #008d39;">
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
                  @if ($recepcions->count()>0)

                     @foreach ($especies as $especie)
                        <div class="justify-center ">
                           <a href="{{route('dashboard.especie',$especie)}}">
                              <button class="items-center w-full px-4 py-3 rounded focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 hover:bg-gray-500 focus:outline-none" style="background-color: #008d39;">
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

       <figure class="mx-1 mt-4 highcharts-figure" wire:ignore>
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

      <div class="flex justify-center mx-auto mb-2 max-w-7xl sm:px-6 lg:px-8">
        <div class="w-full p-4 mx-4 my-2 bg-white rounded-lg shadow max-w-7xl sm:px-6 lg:px-8 sm:p-6 xl:p-4">
           <h1 class="font-bold">Buscador Temporada Anterior: </h1>
           <div class="px-6 py-4">
            <input wire:keydown="limpiar_page" wire:model="search"  class="flex-1 w-full h-10 px-5 pr-16 bg-white border-2 border-gray-300 rounded-lg shadow-sm form-input focus:outline-none" placeholder="Ingrese el nombre, rut o csg del productor" autocomplete="off">

            @if ($search)
                  <ul class="relative left-0 w-full px-4 mt-1 overflow-hidden bg-white rounded-lg z-1">
                     @foreach ($productors as $productor)
                        <li class="px-5 text-sm leading-10 cursor-pointer hover:bg-gray-300">
                              <a href="{{route('dashboard.productor',$productor->id)}}">{{$productor->name}}</a>
                        </li>


                     @endforeach


                  </ul>



            @endif
         </div>
        </div>
      </div>

         <div class="grid content-center justify-between grid-cols-3 mx-2 sm:mx-12 md:mx-14 sm:grid-cols-3 md:grid-cols-6 lg:grid-cols-9 gap-y-4 gap-x-3">
               @php
                     $varieds=[];
                     $series=[];
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
                                    <button wire:click="set_varie({{$variedad->id}})"  class="items-center w-full px-2 py-3 rounded  focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 hover:bg-gray-500 focus:outline-none" style="background-color: #008d39;">
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
                           <button class="items-center w-full px-4 py-3 rounded focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 hover:bg-gray-500 focus:outline-none" style="background-color: #008d39;">
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

       <figure class="mx-1 mt-4 highcharts-figure" wire:ignore>
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
                $espec2=[];
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
                           @endforeach

                        </div>

                     @endforeach


                  </div>
               </div>
            </div>


      </div>

      </div>

   </div>

--}}
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

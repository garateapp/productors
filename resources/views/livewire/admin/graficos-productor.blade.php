<div>
     
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/series-label.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    
       
 
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
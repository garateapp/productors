<x-app-layout>
    <x-slot name="header">
       
    </x-slot>


    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/series-label.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

   
    <h1 class="text-center my-6 font-bold text-2xl">Estadisticas de Uso</h1>

    <div class="flex justify-center">
        <div class="max-w-7xl">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                    <div class="overflow-hidden">
                        <div class="grid grid-cols-2">

                       
                       
                            <div>
                                <table class="min-w-full text-left text-sm font-light">
                                    <thead class="border-b font-medium dark:border-neutral-500">
                                        <tr>
                                            <th scope="col" class="px-6 py-4"></th>
                                            <th scope="col" class="px-6 py-4">Detalle</th>
                                            <th scope="col" class="px-6 py-4 text-center">Ultimos 30 Dias<br>({{$sus30->count()}})</th>
                                            <th scope="col" class="px-6 py-4 text-center">Total<br>({{$sustot->count()}})</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $n=1;
                                        @endphp
                                        
                                        @foreach ($estadistica_types as $item)
                                        
                                                <tr class="border-b dark:border-neutral-500 cursor-pointer">
                                                    <td class="whitespace-nowrap px-6 py-4 font-medium">{{$n}}</td>
                                                    <td class="whitespace-nowrap px-6 py-4">
                                                        <a href="{{route('estadistica.type',$item)}}">
                                                            {{$item->name}}
                                                        </a>
                                                    </td>

                                                    <td class="whitespace-nowrap px-6 py-4 text-center">
                                                            <a href="{{route('estadistica.type',$item)}}">
                                                                {{$sus30->where('type',$item->search)->count()}}
                                                            </a>
                                                        </td>
                                                    <td class="whitespace-nowrap px-6 py-4 text-center">
                                                            <a href="{{route('estadistica.type',$item)}}">
                                                                {{$sustot->where('type',$item->search)->count()}}
                                                            </a>
                                                        </td>
                                                    
                                                

                                                </tr>
                                        
                                            @php
                                                $n+=1;
                                            @endphp
                                        
                                        @endforeach
                                        <!-- Agrega más filas aquí si es necesario -->
                                    </tbody>
                                </table>
                            </div>
                            <div class="items-center my-auto">
                                <figure class="highcharts-figure mx-1 mt-4" wire:ignore>
                                <div id="gastotreinta" wire:ignore>
                                    
                                </div>
                                </figure>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>

    <h1 class="text-center my-6 font-bold text-2xl">Ultimos Registros</h1>

    <div class="flex justify-center">
        <div class="max-w-7xl">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                    <div class="overflow-hidden">
                   
                            <div>
                                <table class="min-w-full text-left text-sm font-light">
                                    <thead class="border-b font-medium dark:border-neutral-500">
                                        <tr>
                                            <th scope="col" class="px-6 py-4"></th>
                                            <th scope="col" class="px-6 py-4">Usuario</th>
                                            <th scope="col" class="px-6 py-4">Detalle</th>
                                            <th scope="col" class="px-6 py-4 text-center">Dia</th>
                                            <th scope="col" class="px-6 py-4">Hora</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $n=1;
                                        @endphp
                                    
                                        @foreach ($sus30->reverse()->take(10) as $item)
                                                
                                            <tr class="border-b dark:border-neutral-500">
                                            
                                                    <td class="whitespace-nowrap px-6 py-4 font-medium cursor-pointer">
                                                        <a href="{{route('estadisticas')}}">
                                                            {{$sustot->count()-$n+1}}
                                                        </a>
                                                    </td>

                                                    <td class="whitespace-nowrap px-6 py-4">
                                                        <a href="{{route('estadisticas')}}">
                                                            {{$item->user->name}}
                                                        </a>
                                                    </td>
                                                    
                                                    <td class="whitespace-nowrap px-6 py-4">
                                                        <a href="{{route('estadisticas')}}">
                                                            @foreach ($estadistica_types as $type)
                                                                @if ($item->type==$type->search)
                                                                    {{$type->name}}
                                                                @endif
                                                            @endforeach
                                                           
                                                        </a>
                                                    </td>

                                                  

                                                    <td class="whitespace-nowrap px-6 py-4">
                                                        <a href="{{route('estadisticas')}}">
                                                            {{$item->created_at->format('d/m/Y')}}
                                                        </a>
                                                    </td>

                                                    <td class="whitespace-nowrap px-6 py-4"> 
                                                        <a href="{{route('estadisticas')}}">
                                                            {{$item->created_at->format('H:i')}}
                                                        </a>
                                                    </td>
                                            

                                            </tr>
                                            @php
                                                $n+=1;
                                            @endphp
                                        
                                        @endforeach
                                        <!-- Agrega más filas aquí si es necesario -->
                                    </tbody>
                                </table>
                            </div>
                      
                    </div> 
                    @php
                        $serieestadistica=[];
                    @endphp

                  

                </div>
            </div>
        </div>
    </div>

    @php
        
        $serieestadistica=[];
        foreach($estadistica_types as $item){
                    //inserta el gasto si la suma es mayor a cero 
                    if ($sustot->where('type',$item->search)->count()>0) {
                            $serieestadistica[]=['name' =>$item->name,
                                                    'y'=> $sustot->where('type',$item->search)->count()];
                    }
        }

    @endphp   

    <script>
        var seriegastos30 = <?php echo json_encode($serieestadistica) ?>;


         Highcharts.chart('gastotreinta', {
                chart: {
                   plotBackgroundColor: null,
                   plotBorderWidth: null,
                   plotShadow: false,
                   type: 'pie'
                },
                title: {
                    text: 'Grafico de Estadisticas',
                    align: 'left'
                },
                tooltip: {
                   pointFormat: '<b><b>{point.y} Vistas</b>({point.percentage:.0f}%)<br/>',
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
                   data: seriegastos30
                }]
             });
    </script>

            
</x-app-layout>

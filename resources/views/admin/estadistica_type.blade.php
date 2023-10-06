<x-app-layout>
    <x-slot name="header">
       
    </x-slot>


   
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/series-label.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

   
    <h1 class="text-center my-6 font-bold text-2xl">Estadisticas de Uso:  {{$estadistica_type->name}}</h1>

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
                                            <th scope="col" class="px-6 py-4">Dia</th>
                                            <th scope="col" class="px-6 py-4">Hora</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $n=1;
                                        @endphp
                                    
                                        @foreach ($estadisticas->reverse() as $item)
                                                
                                            <tr class="border-b dark:border-neutral-500">
                                            
                                                    <td class="whitespace-nowrap px-6 py-4 font-medium cursor-pointer">
                                                        <a href="{{route('estadisticas')}}">
                                                            {{$estadisticas->count()-$n+1}}
                                                        </a>
                                                    </td>
                                                
                                                    <td class="whitespace-nowrap px-6 py-4">
                                                        <a href="{{route('estadisticas')}}">
                                                            {{$item->user->name}}
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
                            <div class="items-center my-auto">
                                <figure class="highcharts-figure mx-1 mt-4" wire:ignore>
                                   <div id="gastotreinta" wire:ignore>
                                      
                                   </div>
                                </figure>
                             </div>
                        </div>
                        {{$estadisticas->links()}}
                    </div> 
                    @php
                        $serieestadistica=[];
                    @endphp

                    @foreach ($usuarios as $item)

                        @php
                            
                            $serieestadistica[]=['name' =>$item->user->name,
                                                'y'=> $item->repeticiones];
                            
                        @endphp
                    @endforeach

                </div>
            </div>
        </div>
    </div>
    
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
                   pointFormat: '<b><b>${point.y}</b>({point.percentage:.0f}%)<br/>',
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

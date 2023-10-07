<x-app-layout>
  
    @section('css')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.min.css" integrity="sha512-3g+prZHHfmnvE1HBLwUnVuunaPOob7dpksI7/v6UnF/rnKGwHf/GdEq9K7iEN7qTtW+S0iivTcGpeTBqqB04wA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @endsection
    

    
    <section class="flex justify-center pt-3 w-8/12 mx-auto bg-gray-50 h-full overflow-y-scroll">
         
      
        <ul  class="mt-6 w-full">
            @foreach ($items as $item)
               
               
                    <li class="py-5 border-b px-3 transition hover:bg-indigo-100">
                        <div class="flex justify-between items-center">
                        <h3 class="text-lg font-semibold">{{$item->tipo}} Para Productores De {{$item->especie}}</h3>
                        <div>
                            <p class="text-md text-gray-400 text-center">{{$item->created_at->format('d/m/Y')}}</p>
                            @if ($item->status==1)
                                <div class="text-md">Mensaje Pendiente de Leer!</div>
                            @else
                                <div class="text-md">Mensaje leido!</div>
                            @endif
                        </div>
                    </div>
                        <div class="text-md italic text-gray-400">
                            @foreach ($users as $user)
                                @if ($user->id==$item->receptor_id)
                                    {{$user->name}}
                                @endif
                            @endforeach
                        </div>
                       
                        
                    </li>
               
               
            @endforeach
          
         
        </ul>
      </section>
  
</x-app-layout>

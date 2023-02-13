<x-app-layout>
    <x-slot name="header">
       
    </x-slot>


    <div class="bg-white py-4 md:py-7 px-4 md:px-8 xl:px-10 ">
        <x-table-responsive>   
           <table class="min-w-full divide-y divide-gray-200 mb-20 pb-20">
    
              <thead class="bg-gray-50 rounded-full">
           
                 <th>Roles</th>
                 <th>Permisos</th>
                
               
                
              </thead>
              <tbody>
             
    
                   @forelse ($roles as $role)
                       
                  
                   
                         {{-- comment  --}}    
                         <tr tabindex="0" class="focus:outline-none h-16 border border-gray-100 rounded">
                        
                            <td class="text-center">
                               <p class="text-base font-medium leading-none text-gray-700 mr-2">
    
                               
                                                             Administrador
                               
                                     
                               </p>
                            
                            </td>
                          
                         </tr>
                         <tr tabindex="0" class="focus:outline-none h-16 border border-gray-100 rounded">
                        
                            <td class="text-center">
                               <p class="text-base font-medium leading-none text-gray-700 mr-2">
    
                               
                                                             Control Calidad
                               
                                     
                               </p>
                            
                            </td>
                          
                         </tr>
                         <tr tabindex="0" class="focus:outline-none h-16 border border-gray-100 rounded">
                        
                            <td class="text-center">
                               <p class="text-base font-medium leading-none text-gray-700 mr-2">
    
                               
                                                             Productor
                               
                                     
                               </p>
                            
                            </td>
                          
                         </tr>
                   
                    @empty

                 
                         {{-- comment  --}}    
                         <tr tabindex="0" class="focus:outline-none h-16 border border-gray-100 rounded">
                        
                            <td class="text-center">
                               <p class="text-base font-medium leading-none text-gray-700 mr-2">
    
                               
                                                             Administrador
                               
                                     
                               </p>
                            
                            </td>
                          
                         </tr>
                         <tr tabindex="0" class="focus:outline-none h-16 border border-gray-100 rounded">
                        
                            <td class="text-center">
                               <p class="text-base font-medium leading-none text-gray-700 mr-2">
    
                               
                                                             Control Calidad
                               
                                     
                               </p>
                            
                            </td>
                          
                         </tr>
                         <tr tabindex="0" class="focus:outline-none h-16 border border-gray-100 rounded">
                        
                            <td class="text-center">
                               <p class="text-base font-medium leading-none text-gray-700 mr-2">
    
                               
                                                             Productor
                               
                                     
                               </p>
                            
                            </td>
                          
                         </tr>
                   
                       
                    @endforelse ($roles as $role)
    
              
                
               
              
              
              </tbody>
           </table>
        </x-table-responsive>
    </div>
               
             
            
</x-app-layout>

<div>
    
 
    <p class="p-3 text-gray-900">
        Paso 1: Eliminar 'Recepcions', 'Calidads' y 'Procesos' de temporada anterior y dejar como anterior lo que esta como actual
      </p>
      <button onclick="confirmSyncProceso()" class="mt-4 ml-4 bg-red-500 items-center focus:ring-2 focus:ring-offset-2 focus:ring-red-600 sm:mt-0 px-3 py-3 hover:bg-red-600 focus:outline-none rounded content-center">
        <p class="text-sm font-medium leading-none text-white">Eliminar y Proceder</p>
        </button>
    
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
             function confirmSyncProceso() {
            const now = new Date();
            const formattedTime = now.toLocaleTimeString('es-ES', { hour: '2-digit', minute: '2-digit', second: '2-digit' });

            Swal.fire({
                title: '¿Esta seguro de proceder?',
                text: `Este proceso es irreversible y no se podran recuperar los datos eliminados.`,
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar y proceder',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Procesando...',
                        text: 'Estamos eliminando los datos de la temporada actual y actualizando los actuales como anteriores.',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    
                    @this.call('eliminar_anterior').then(() => {
                        Swal.close(); // Cerrar la alerta de "Sincronizando" cuando se complete la sincronización
                        Swal.fire(
                            'Proceso completado!',
                            'Los data a sido eliminada y actualizada exitosamente.',
                            'success'
                        );
                    }).catch(() => {
                        Swal.close(); // Cerrar la alerta en caso de error
                        Swal.fire(
                            'Error en el proceso',
                            'Ocurrió un problema al procesar los datos. Por favor, inténtalo de nuevo más tarde.',
                            'error'
                        );
                    });
                }
            });
        }
        </script>


</div>

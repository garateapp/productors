<?php

namespace App\Http\Livewire;

use App\Models\Proceso;
use App\Models\Recepcion;
use Livewire\Component;

class CambiarTemporada extends Component
{
    public function render()
    {
        return view('livewire.cambiar-temporada');
    }

    public function eliminar_anterior(){
        $allreceptions_anterior=Recepcion::where('temporada', 'anterior')->get();
        foreach($allreceptions_anterior as $recepcion){
            $recepcion->delete();
        }

        $allreceptions_actual=Recepcion::where('temporada', 'actual')->get();
        foreach($allreceptions_actual as $recepcion){
            $recepcion->update(['temporada'=>'anterior']);
        }

        $allprocesos_anterior=Proceso::where('temporada', 'anterior')->get();
        foreach($allprocesos_anterior as $proceso){
            $proceso->delete();
        }

        $allprocesos_actual=Proceso::where('temporada', 'actual')->get();
        foreach($allprocesos_actual as $proceso){
            $proceso->update(['temporada'=>'anterior']);
        }


    }

}

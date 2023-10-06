<?php

namespace App\Http\Livewire\Admin;

use App\Models\Especie;
use App\Models\Mensaje;
use App\Models\User;
use Livewire\Component;

class EnvioMasivo extends Component
{   public $selectedespecie, $productors, $especie, $selectedarchivo, $tipo, $mensaje;
    
    public function render()
    {   $mensajes =Mensaje::all();
        $especies=Especie::pluck('name','id');
        return view('livewire.admin.envio-masivo',compact('especies','mensajes'));
    }

    public function updatedselectedespecie($especie_id){
        $especie=Especie::find($especie_id);
        $this->productors = $especie->comercializado()->get();
        $this->especie = $especie;
    
    }
    public function updatedselectedarchivo($archivo){
        $this->tipo = 'PDF';
        
    }
    public function set_mensaje($mensaje_id){
        $this->mensaje=Mensaje::find($mensaje_id);
        
    }
}

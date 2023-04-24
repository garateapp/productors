<?php

namespace App\Http\Livewire\Admin;

use App\Models\Especie;
use App\Models\User;
use Livewire\Component;

class EnvioMasivo extends Component
{   public $selectedespecie, $productors, $especie, $selectedarchivo, $tipo;
    
    public function render()
    {   $especies=Especie::pluck('name','id');
        return view('livewire.admin.envio-masivo',compact('especies'));
    }

    public function updatedselectedespecie($especie_id){
        $especie=Especie::find($especie_id);
        $this->productors = $especie->comercializado()->get();
        
        $this->especie = $especie;
    
    }
    public function updatedselectedarchivo($archivo){
        $this->tipo = 'PDF';
        
    }
}

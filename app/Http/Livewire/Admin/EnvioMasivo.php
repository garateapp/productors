<?php

namespace App\Http\Livewire\Admin;

use App\Models\Especie;
use App\Models\Mensaje;
use App\Models\Mensaje_hist;
use App\Models\Ticket;
use App\Models\User;
use Livewire\Component;

class EnvioMasivo extends Component
{   public $selectedespecie, $productors, $especie, $selectedarchivo, $tipo, $mensaje;

    public function render()
    {   $mensajes =Mensaje_hist::all();
        $especies=Especie::pluck('name','id');
        $users=User::all();
        return view('livewire.admin.envio-masivo',compact('especies','mensajes','users'));
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
        $this->mensaje=Mensaje_hist::find($mensaje_id);

    }

}

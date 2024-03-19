<?php

namespace App\Http\Livewire\Agronomo;

use App\Models\Especie;
use App\Models\Ficha;
use App\Models\User;
use App\Models\Variedad;
use Livewire\Component;

class FichaCreate extends Component
{   public $user, $especieid, $variedades, $selectedespecie,$selectedvariedad, $type, $ficha;
    
    public function mount(User $user, $tipo){
        $this->user=$user;
        if($tipo=='create'){
            $this->type=$tipo;
        }else{
            $this->ficha=Ficha::find($tipo);
            $this->selectedespecie=$this->ficha->especie_id;
            $this->especieid=$this->selectedespecie;
            $this->selectedvariedad=$this->ficha->variedad_id;
            $this->variedades = Variedad::where('especie_id',$this->especieid)->get();
        }
    }
    public function render()
    {   $especies=Especie::all();
        
        return view('livewire.agronomo.ficha-create',compact('especies'));
    }

    public function updatedselectedespecie($especie){
        
        $this->especieid=$especie;

        $this->variedades = Variedad::where('especie_id',$this->especieid)->get();

    
    }

    public function updatedselectedvariedad($variedad){
        
        $this->selectedvariedad=$variedad;
    
    }
}

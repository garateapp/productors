<?php

namespace App\Http\Livewire\Agronomo;

use App\Models\CampoStaff;
use App\Models\User;
use Livewire\Component;

class ListadoView extends Component
{   public $user;

    public function mount(User $user){
        $this->user=$user;
    }

    public function render()
    {   $campos=CampoStaff::where('agronomo_id',$this->user->id)->get();

        return view('livewire.agronomo.listado-view',compact('campos'));
    }
}

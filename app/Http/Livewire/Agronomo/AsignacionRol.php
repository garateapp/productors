<?php

namespace App\Http\Livewire\Agronomo;

use App\Models\User;
use Livewire\Component;

class AsignacionRol extends Component
{
    public $search;
    
    public function render()
    {
        return view('livewire.agronomo.asignacion-rol');
    }

    public function getUsersProperty(){
        return  User::where('name','LIKE','%'. $this->search .'%')
        ->orwhere('email','LIKE','%'. $this->search .'%')
        ->latest('id')
        ->paginate(3);
    }
}

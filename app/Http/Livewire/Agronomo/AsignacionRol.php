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
        return User::where(function($query) {
            $query->where('name','LIKE','%'. $this->search .'%')
                  ->orWhere('email','LIKE','%'. $this->search .'%');
        })
        ->whereDoesntHave('roles', function ($query) {
            $query->where('name', 'Agrónomo');
        })
        ->latest('id')
        ->paginate(3);
    }
}

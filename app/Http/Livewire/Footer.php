<?php

namespace App\Http\Livewire;

use App\Models\Soporte;
use Livewire\Component;

class Footer extends Component
{
    public function render()
    {   $soportes=Soporte::all();
        return view('livewire.footer',compact('soportes'));
    }
}

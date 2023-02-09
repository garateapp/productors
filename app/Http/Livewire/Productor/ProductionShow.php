<?php

namespace App\Http\Livewire\Productor;

use App\Models\Recepcion;
use Livewire\Component;
use Livewire\WithPagination;

class ProductionShow extends Component
{   use withpagination;

    public function render()
    {   
        $recepcions=Recepcion::where('r_emisor',auth()->user()->rut)->latest('id')->paginate(6);
        return view('livewire.productor.production-show',compact('recepcions'));
    }
}

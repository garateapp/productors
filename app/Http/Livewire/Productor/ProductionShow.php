<?php

namespace App\Http\Livewire\Productor;

use App\Models\Recepcion;
use Livewire\Component;
use Livewire\WithPagination;

class ProductionShow extends Component
{   use withpagination;

    public function render()
    {   
        $recepcions=Recepcion::where('n_emisor',auth()->user()->name)->latest('id')->paginate(6);
        return view('livewire.productor.production-show',compact('recepcions'));
    }
}

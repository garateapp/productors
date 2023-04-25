<?php

namespace App\Http\Livewire\Productor;

use App\Models\Proceso;
use Livewire\Component;
use Livewire\WithPagination;

class ProcesoSearch extends Component
{   use WithPagination;

    public $search, $ctd=25;

    public function render()
    {   $procesos=Proceso::where('agricola',auth()->user()->name)
        ->latest('id')->paginate($this->ctd);

        return view('livewire.productor.proceso-search',compact('procesos'));
    }
}

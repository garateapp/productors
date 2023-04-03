<?php

namespace App\Http\Livewire\Procesos;

use App\Models\Proceso;
use Livewire\Component;
use Livewire\WithPagination;

class ProcesoSearch extends Component
{   use WithPagination;

    public $search, $ctd=25;

    public function render()
    {   $procesos=Proceso::where('agricola','LIKE','%'. $this->search .'%')
        ->orwhere('n_proceso','LIKE','%'. $this->search .'%')
        ->orwhere('especie','LIKE','%'. $this->search .'%')
        ->orwhere('variedad','LIKE','%'. $this->search .'%')
        ->orwhere('fecha','LIKE','%'. $this->search .'%')
        ->orwhere('categoria','LIKE','%'. $this->search .'%')
        ->orwhere('id_empresa','LIKE','%'. $this->search .'%')
        ->latest('id')->paginate($this->ctd);

        return view('livewire.procesos.proceso-search',compact('procesos'));
    }
}

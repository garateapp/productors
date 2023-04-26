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
        ->orwhere('id_empresa','LIKE','%'. $this->search .'%')
        ->latest('n_proceso')->paginate($this->ctd);

        return view('livewire.procesos.proceso-search',compact('procesos'));
    }

    public function limpiar_page(){
        $this->resetPage();
    }
}

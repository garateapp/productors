<?php

namespace App\Http\Livewire\Productor;

use App\Models\Recepcion;
use Livewire\Component;
use Livewire\WithPagination;

class ProductionSearch extends Component
{   use WithPagination;
    public $search, $ctd=25;

    public function render()
    {   $recepcions=Recepcion::where('id_g_recepcion','LIKE','%'. $this->search .'%')
        ->orwhere('tipo_g_recepcion','LIKE','%'. $this->search .'%')
        ->orwhere('numero_g_recepcion','LIKE','%'. $this->search .'%')
        ->orwhere('fecha_g_recepcion','LIKE','%'. $this->search .'%')
        ->orwhere('id_emisor','LIKE','%'. $this->search .'%')
        ->orwhere('r_emisor','LIKE','%'. $this->search .'%')
        ->orwhere('n_emisor','LIKE','%'. $this->search .'%')
        ->orwhere('Codigo_Sag_emisor','LIKE','%'. $this->search .'%')
        ->orwhere('tipo_documento_recepcion','LIKE','%'. $this->search .'%')
        ->orwhere('numero_documento_recepcion','LIKE','%'. $this->search .'%')
        ->orwhere('n_especie','LIKE','%'. $this->search .'%')
        ->orwhere('n_variedad','LIKE','%'. $this->search .'%')
        ->orwhere('n_estado','LIKE','%'. $this->search .'%')
        ->latest('id')->paginate($this->ctd);
        $allrecepcions=Recepcion::all();
        
        return view('livewire.productor.production-search',compact('recepcions','allrecepcions'));
    }
    
    public function limpiar_page(){
        $this->resetPage();
    }
}

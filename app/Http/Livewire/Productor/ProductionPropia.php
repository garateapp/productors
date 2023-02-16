<?php

namespace App\Http\Livewire\Productor;

use App\Models\Recepcion;
use App\Models\Sync;
use Livewire\Component;
use Livewire\WithPagination;

class ProductionPropia extends Component
{   use WithPagination;
    public $search, $ctd=25;

    public function render()
    {   $recepcions=Recepcion::where('r_emisor',auth()->user()->rut)
        ->latest('id')->paginate($this->ctd);
        $allsubrecepcions=Recepcion::where('r_emisor',auth()->user()->rut)
        ->where('n_especie','LIKE','%'. $this->search .'%')
        ->latest('id')->get();
        $allrecepcions=Recepcion::where('r_emisor',auth()->user()->rut)
        ->latest('id')->get();
        $sync=Sync::where('entidad','RECEPCIONES')
        ->orderby('id','DESC')
        ->first();

        return view('livewire.productor.production-propia',compact('recepcions','allrecepcions','allsubrecepcions','sync'));
    }

    public function limpiar_page(){
        $this->resetPage();
    }
}


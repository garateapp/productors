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
    {   $recepcions=Recepcion::where('id_emisor',auth()->user()->idprod)
        ->orwhere('id_g_recepcion','LIKE','%'. $this->search .'%')
        ->where('tipo_g_recepcion','LIKE','%'. $this->search .'%')
        ->where('numero_g_recepcion','LIKE','%'. $this->search .'%')
        ->where('fecha_g_recepcion','LIKE','%'. $this->search .'%')
        ->where('id_emisor','LIKE','%'. $this->search .'%')
        ->where('r_emisor','LIKE','%'. $this->search .'%')
        ->where('n_emisor','LIKE','%'. $this->search .'%')
        ->where('Codigo_Sag_emisor','LIKE','%'. $this->search .'%')
        ->where('tipo_documento_recepcion','LIKE','%'. $this->search .'%')
        ->where('numero_documento_recepcion','LIKE','%'. $this->search .'%')
        ->where('n_especie','LIKE','%'. $this->search .'%')
        ->where('n_variedad','LIKE','%'. $this->search .'%')
        ->where('n_estado','LIKE','%'. $this->search .'%')
        ->latest('id')->paginate($this->ctd);
        $allsubrecepcions=Recepcion::where('r_emisor',auth()->user()->rut)
        ->where('id_g_recepcion','LIKE','%'. $this->search .'%')
        ->where('tipo_g_recepcion','LIKE','%'. $this->search .'%')
        ->where('numero_g_recepcion','LIKE','%'. $this->search .'%')
        ->where('fecha_g_recepcion','LIKE','%'. $this->search .'%')
        ->where('id_emisor','LIKE','%'. $this->search .'%')
        ->where('r_emisor','LIKE','%'. $this->search .'%')
        ->where('n_emisor','LIKE','%'. $this->search .'%')
        ->where('Codigo_Sag_emisor','LIKE','%'. $this->search .'%')
        ->where('tipo_documento_recepcion','LIKE','%'. $this->search .'%')
        ->where('numero_documento_recepcion','LIKE','%'. $this->search .'%')
        ->where('n_especie','LIKE','%'. $this->search .'%')
        ->where('n_variedad','LIKE','%'. $this->search .'%')
        ->where('n_estado','LIKE','%'. $this->search .'%')
        ->latest('id')->get();
        $allrecepcions=Recepcion::where('r_emisor',auth()->user()->rut);
        $sync=Sync::where('entidad','RECEPCIONES')
        ->orderby('id','DESC')
        ->first();

        return view('livewire.productor.production-propia',compact('recepcions','allrecepcions','allsubrecepcions','sync'));
    }

    public function limpiar_page(){
        $this->resetPage();
    }
}


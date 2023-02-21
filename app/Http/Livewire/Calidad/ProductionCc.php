<?php

namespace App\Http\Livewire\Calidad;

use App\Models\Calidad;
use App\Models\Recepcion;
use App\Models\Sync;
use Livewire\Component;
use Livewire\WithPagination;

class ProductionCc extends Component
{   use WithPagination;
    public $search, $ctd=25, $recep, $recepcion_id, $calidad, $nro_muestra;

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

        $allsubrecepcions=Recepcion::where('id_g_recepcion','LIKE','%'. $this->search .'%')
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
        ->latest('id')->get();
        $allrecepcions=Recepcion::all();
        $sync=Sync::where('entidad','RECEPCIONES')
        ->orderby('id','DESC')
        ->first();
        
        return view('livewire.calidad.production-cc',compact('recepcions','allrecepcions','allsubrecepcions','sync'));
    }

    public function set_recepcion($id){
        $this->recepcion_id=$id;
        $this->recep=Recepcion::find($this->recepcion_id);
        if($this->recep->calidad){
            $this->calidad=$this->recep->calidad;
        }
    }

    public function calidad_store(){
        $rules = [
            'nro_muestra'=>'required'
            ];
      
        $this->validate ($rules);

        $this->calidad = Calidad::create([
            'nro_muestra'=> $this->nro_muestra,
            'recepcion_id'=>$this->recep->id
        ]);
        
        $this->reset(['nro_muestra']);
        $this->recep = Recepcion::find($this->recepcion_id);
    }

    public function recep_clean(){
        $this->recepcion_id=NULL;
        $this->recep=NULL;
        $this->calidad=Null;
    }
    
    public function limpiar_page(){
        $this->resetPage();
    }
}

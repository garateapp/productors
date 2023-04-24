<?php

namespace App\Http\Livewire\Productor;

use App\Models\Especie;
use App\Models\Recepcion;
use App\Models\Sync;
use App\Models\Variedad;
use Livewire\Component;
use Livewire\WithPagination;

class ProductionPropia extends Component
{   use WithPagination;
    public $search, $ctd=25,$espec, $especieid, $especiename, $varie, $variedadid;

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
        $especies=auth()->user()->especies_comercializas()->get();
        $variedades=Variedad::all();

        return view('livewire.productor.production-propia',compact('variedades','especies','recepcions','allrecepcions','allsubrecepcions','sync'));
    }

    public function set_especie($id){
        $this->especieid=$id;
        $this->variedadid=NULL;
        $this->varie =NULL;
        $this->espec=Especie::find($this->especieid);
        $this->search=$this->espec->name;
    }

    public function set_varie($id){
        $this->variedadid=$id;
        $this->varie=Variedad::find($this->variedadid);
        $this->search=$this->varie->name;
    }

    public function limpiar_page(){
        $this->resetPage();
    }

    public function espec_clean(){
        $this->especieid=NULL;
        $this->espec=NULL;
        $this->search=NULL;

    }
    public function varie_clean(){
        $this->variedadid=NULL;
        $this->varie =NULL;
        $this->search=$this->espec->name;

    }
}


<?php

namespace App\Http\Livewire\Admin;

use App\Models\Especie;
use App\Models\Proceso;
use App\Models\Recepcion;
use App\Models\User;
use App\Models\Variedad;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class GraficosProductor extends Component
{   use WithPagination;

    public $search, $espec, $ctd=25, $especieid, $especiename, $varie, $variedadid, $titulo='Gráfico por Especies';

    public $user;

    public function mount(User $user){
        $this->user=$user;
      
    }
    public function render()
    {   $now = Carbon::now();
        if($this->espec){
            if($this->varie){
                $procesos=Proceso::where('agricola',$this->user->name)
                            ->where('variedad', $this->varie->name)
                         ->latest('n_proceso')->paginate($this->ctd);
            }else{
                    $procesos=Proceso::where('agricola',$this->user->name)
                        ->where('especie', $this->espec->name)
                         ->latest('n_proceso')->paginate($this->ctd);
                    $procesosall=Proceso::where('agricola',$this->user->name)
                        ->where('especie','LIKE', $this->search)
                         ->latest('n_proceso')->get();
            }

        }else{
            $procesos=Proceso::where('agricola',$this->user->name)
            ->latest('n_proceso')->paginate($this->ctd);
            $procesosall=Proceso::where('agricola',$this->user->name)
            ->latest('n_proceso')->get();
        }
            
           
        $especies=$this->user->especies_comercializas()->get();
        $variedades=$this->user->variedades_comercializas()->get();
        
        $recepcions=Recepcion::where('n_emisor',$this->user->name)
        ->get();
        
        return view('livewire.admin.graficos-productor',compact('now','recepcions','procesosall','procesos','especies','variedades'));
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

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

class GraficosAdmin extends Component
{   use WithPagination;

    public  $search, $espec, $ctd=25, $especieid, $especiename, $varie, $variedadid, $titulo='Gráfico por Especies',$cant;
    

    public function render()
    {   
        $now = Carbon::now();
        if($this->espec){
            if($this->varie){
                $procesos=Proceso::where('variedad','LIKE', $this->varie->name)
                         ->latest('n_proceso')->paginate($this->ctd);
            }else{
                    $procesos=Proceso::where('especie',$this->espec->name)
                         ->latest('n_proceso')->paginate($this->ctd);
            }

        }else{
            $procesos=Proceso::where('agricola','LIKE','%'. $this->search .'%')
                ->orwhere('n_proceso','LIKE','%'. $this->search .'%')
                ->orwhere('especie','LIKE','%'. $this->search .'%')
                ->orwhere('variedad','LIKE','%'. $this->search .'%')
                ->orwhere('fecha','LIKE','%'. $this->search .'%')
                ->orwhere('id_empresa','LIKE','%'. $this->search .'%')
                ->latest('n_proceso')->paginate($this->ctd);
        }
        
        $procesosall=Proceso::where('temporada', 'anterior')->get();
        $procesosall2=Proceso::where('temporada', 'actual')->get();
        
        $especies=Especie::where('id','>=',1)->get();
        $variedades=Variedad::all();

        $recepcions=Recepcion::where('temporada', 'anterior')->get();
        $recepcions2=Recepcion::where('temporada', 'actual')->get();
        $productors=User::where('rut','LIKE','%'. $this->search .'%')
                        ->orwhere('name','LIKE','%'. $this->search .'%')
                        ->orwhere('csg','LIKE','%'. $this->search .'%')
                        ->orwhere('idprod','LIKE','%'. $this->search .'%')
                        ->orwhere('user','LIKE','%'. $this->search .'%')
                        ->latest('id')->paginate(5);

        return view('livewire.admin.graficos-admin',compact('productors','now','recepcions','recepcions2','procesosall','procesosall2','procesos','variedades','especies'));
    }
    
    public function set_especie($id){
        $this->especieid=$id;
        $this->variedadid=NULL;
        $this->varie =NULL;
        $this->espec=Especie::find($this->especieid);
        
        
    }

    public function set_varie($id){
        $this->variedadid=$id;
        $this->varie=Variedad::find($this->variedadid);
        
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

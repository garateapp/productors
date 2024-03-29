<?php

namespace App\Http\Livewire\Procesos;

use App\Exports\ProcesostotalExport;
use App\Models\Especie;
use App\Models\Proceso;
use App\Models\Sync;
use App\Models\Variedad;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class ProcesoEspecie extends Component
{   use WithPagination;

    public $search, $espec, $ctd=25, $especieid, $especiename, $varie, $variedadid, $temporada;
    
    public function mount(Especie $especie,$temporada){
        $this->espec=$especie;
        $this->temporada=$temporada;
        $this->titulo='Gráfico por Variedades de '.$especie->name;
    }
    
    public function render()
    {
        if($this->espec){
            if($this->varie){
                $procesos=Proceso::where('variedad', $this->varie->name)
                        ->where('agricola','LIKE','%'. $this->search .'%')->where('temporada',$this->temporada)
                         ->latest('n_proceso')->paginate($this->ctd);
                $procesosall=Proceso::where('variedad', $this->varie->name)->where('temporada',$this->temporada)
                        ->where('agricola','LIKE','%'. $this->search .'%')
                         ->latest('n_proceso')->get();
                
            }else{
                    $procesos=Proceso::where('especie',$this->espec->name)->where('temporada',$this->temporada)
                        ->where('agricola','LIKE','%'. $this->search .'%')
                         ->latest('n_proceso')->paginate($this->ctd);
                    $procesosall=Proceso::where('especie', $this->espec->name)->where('temporada',$this->temporada)
                    ->where('agricola','LIKE','%'. $this->search .'%')
                         ->latest('n_proceso')->get();
            }

        }else{
            $procesos=Proceso::where('agricola','LIKE','%'. $this->search .'%')->where('temporada',$this->temporada)
                ->orwhere('n_proceso','LIKE','%'. $this->search .'%')
                ->orwhere('especie','LIKE','%'. $this->search .'%')
                ->orwhere('variedad','LIKE','%'. $this->search .'%')
                ->orwhere('fecha','LIKE','%'. $this->search .'%')
                ->orwhere('id_empresa','LIKE','%'. $this->search .'%')
                ->latest('n_proceso')->paginate($this->ctd);
        }
        
        
        $especies=Especie::where('id','>=',1)->latest('id')->get();
        $variedades=Variedad::all();

        $sync=Sync::where('entidad','PROCESOS')
        ->orderby('id','DESC')
        ->first();

        return view('livewire.procesos.proceso-especie',compact('sync','procesosall','procesos','variedades','especies'));
    }

    public function generateReport(){
        return Excel::download(new ProcesostotalExport($this->espec),'Procesos_total_'.$this->espec->name.'.xlsx');
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

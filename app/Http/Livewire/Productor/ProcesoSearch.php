<?php

namespace App\Http\Livewire\Productor;

use App\Exports\ProcesosExport;
use App\Models\Especie;
use App\Models\Proceso;
use App\Models\User;
use App\Models\Variedad;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class ProcesoSearch extends Component
{   use WithPagination;

    public $search, $espec, $ctd=25, $especieid, $especiename, $varie, $productor, $variedadid, $titulo='Gráfico por Especies';

    public function mount($user_id){
        $this->productor=User::find($user_id);
    }

    public function render()
    {       
           
            if($this->espec){
                if($this->varie){
                    $procesos=Proceso::where('agricola',auth()->user()->name)
                                ->where('variedad','LIKE', $this->search)->where('temporada','actual')
                             ->latest('n_proceso')->paginate($this->ctd);
                }else{
                        $procesos=Proceso::where('agricola',auth()->user()->name)->where('temporada','actual')
                            ->where('especie','LIKE', $this->search)
                             ->latest('n_proceso')->paginate($this->ctd);
                        $procesosall=Proceso::where('agricola',auth()->user()->name)
                            ->where('especie','LIKE', $this->search)->where('temporada','actual')
                             ->latest('n_proceso')->get();
                }
    
            }else{
                $procesos=Proceso::where('agricola',auth()->user()->name)->where('temporada','actual')
                ->latest('n_proceso')->paginate($this->ctd);
                $procesosall=Proceso::where('agricola',auth()->user()->name)->where('temporada','actual')
                ->latest('n_proceso')->get();
            }
            
            if($this->varie){
                $procesos=Proceso::where('agricola',auth()->user()->name)->where('temporada','actual')
                ->where('variedad','LIKE', $this->search)
                ->latest('n_proceso')->paginate($this->ctd);
            }else{
                $procesos=Proceso::where('agricola',auth()->user()->name)->where('temporada','actual')
                ->where('especie','LIKE', $this->search)
                 ->latest('n_proceso')->paginate($this->ctd);
            }
        $especies=auth()->user()->especies_comercializas()->get();
        $variedades=auth()->user()->variedades_comercializas()->get();
        return view('livewire.productor.proceso-search',compact('procesosall','procesos','especies','variedades'));
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
    
    public function generateReport(){
        return Excel::download(new ProcesosExport($this->productor->id),'Procesos '.$this->productor->name.'.xlsx');
    }
}

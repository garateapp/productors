<?php

namespace App\Http\Livewire\Admin;

use App\Models\Especie;
use App\Models\Proceso;
use App\Models\Recepcion;
use App\Models\Variedad;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class GraficosAdminEspecie extends Component
{   use WithPagination;

    public $search, $espec, $ctd=25, $especieid, $especiename, $varie, $variedadid, $recepcions, $cant;
    
    public function mount(Especie $especie){
        $this->espec=$especie;
        $this->titulo='Gráfico por Variedades de '.$especie->name;
        $this->titulo_circular='Gráfico Circular de '.$especie->name;
        $this->recepcions=Recepcion::where('n_especie',$this->espec->name)->get();
    }

    public function render()
    {   $now = Carbon::now();
        if($this->espec){
            if($this->varie){
                $procesos=Proceso::where('variedad', $this->varie->name)
                            ->latest('n_proceso')->paginate($this->ctd);
                    $procesosall=Proceso::where('variedad', $this->varie->name)
                            ->latest('n_proceso')->get();
                    
                }else{
                        $procesos=Proceso::where('especie',$this->espec->name)
                            ->latest('n_proceso')->paginate($this->ctd);
                        $procesosall=Proceso::where('especie', $this->espec->name)
                            ->latest('n_proceso')->get();
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
            
            
            $especies=Especie::where('id','>=',1)->get();
            $variedades=Variedad::all();

            

        return view('livewire.admin.graficos-admin-especie',compact('now','procesosall','procesos','variedades','especies'))->section('graf');
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
        $this->recepcions=Recepcion::where('n_variedad',$this->varie->name)->get();
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
        $this->recepcions=Recepcion::where('n_especie',$this->espec->name)->get();
    }

}

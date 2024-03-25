<?php

namespace App\Http\Livewire\Calidad;

use App\Exports\DanostotalExport;
use App\Models\Detalle;
use App\Models\Especie;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class DanosFruta extends Component
{   use WithPagination;

    public $selectedproductor,$productor, $selectedespecie,$especie;
    public function mount(){
        $this->selectedespecie=Especie::all()->first()->id;
        $this->especie=Especie::find($this->selectedespecie);
    }

    public function render()
    {   
        if ($this->selectedproductor) {
            $detalles = Detalle::whereHas('calidad.recepcion', function ($query) {
                $query->where('temporada', 'actual')->where('n_especie',$this->especie->name)->where('n_emisor',$this->productor->name);
            })->paginate(300);
        } else {
            $detalles = Detalle::whereHas('calidad.recepcion', function ($query) {
                $query->where('temporada', 'actual')->where('n_especie',$this->especie->name);
            })->paginate(300);
        }
        
        

        $especies=Especie::all();
        $productors= User::orderBy('name')->get();


        return view('livewire.calidad.danos-fruta',compact('detalles','especies','productors'));
    }

    public function updatedselectedespecie($id){
        $this->especie=Especie::find($id);
    }
    public function updatedselectedproductor($id){
        $this->productor=User::find($id);
    }

    public function export(){
        return Excel::download(new DanostotalExport($this->especie->name,$this->productor->name),'Daños '.$this->especie->name.'.xlsx');
    }
}

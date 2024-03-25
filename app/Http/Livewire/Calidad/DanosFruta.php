<?php

namespace App\Http\Livewire\Calidad;

use App\Exports\DanostotalExport;
use App\Models\Detalle;
use App\Models\Especie;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class DanosFruta extends Component
{   use WithPagination;

    public $selectedespecie,$especie;
    public function mount(){
        $this->selectedespecie=Especie::all()->first()->id;
        $this->especie=Especie::find($this->selectedespecie);
    }

    public function render()
    {   

        $detalles = Detalle::whereHas('calidad.recepcion', function ($query) {
                        $query->where('temporada', 'actual')->where('n_especie',$this->especie->name);
                    })->paginate(300);
        $especies=Especie::all();

        return view('livewire.calidad.danos-fruta',compact('detalles','especies'));
    }

    public function updatedselectedespecie($id){
        $this->especie=Especie::find($id);
    }

    public function export(){
        return Excel::download(new DanostotalExport($this->especie->name,null),'Daños '.$this->especie->name.'.xlsx');
    }
}

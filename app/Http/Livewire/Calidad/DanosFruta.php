<?php

namespace App\Http\Livewire\Calidad;

use App\Models\Detalle;
use Livewire\Component;
use Livewire\WithPagination;

class DanosFruta extends Component
{   use WithPagination;

    public function render()
    {    $detalles = Detalle::whereHas('calidad.recepcion', function ($query) {
                        $query->where('temporada', 'actual');
                    })->paginate(300);

        return view('livewire.calidad.danos-fruta',compact('detalles'));
    }
}

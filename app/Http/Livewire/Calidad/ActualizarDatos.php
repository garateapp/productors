<?php

namespace App\Http\Livewire\Calidad;

use App\Models\Recepcion;
use Livewire\Component;

class ActualizarDatos extends Component
{   
    public $materia_vegetal, $recepcion, $piedras, $barro, $pedicelo_largo, $racimo, $esponjas, $h_esponjas,$llenado_tottes;

    public function mount(Recepcion $recepcion){
        $this->recepcion=$recepcion;
        $this->materia_vegetal=$recepcion->calidad->materia_vegetal;
        $this->piedras=$recepcion->calidad->piedras;
        $this->barro=$recepcion->calidad->barro;
        $this->pedicelo_largo=$recepcion->calidad->pedicelo_largo;
        $this->racimo=$recepcion->calidad->racimo;
        $this->esponjas=$recepcion->calidad->esponjas;
        $this->h_esponjas=$recepcion->calidad->h_esponjas;
        $this->llenado_tottes=$recepcion->calidad->llenado_tottes;
    }

    public function render()
    {
        return view('livewire.calidad.actualizar-datos');
    }

    public function actualizar_datos(){
        if($this->materia_vegetal){
            $this->recepcion->calidad->update([
                'materia_vegetal'=>$this->materia_vegetal
            ]);
        }
        if($this->piedras){
            $this->recepcion->calidad->update([
                'piedras'=>$this->piedras
            ]);
        }
        if($this->barro){
            $this->recepcion->calidad->update([
                'barro'=>$this->barro
            ]);
        }
        if($this->pedicelo_largo){
            $this->recepcion->calidad->update([
                'pedicelo_largo'=>$this->pedicelo_largo
            ]);
        }
        if($this->racimo){
            $this->recepcion->calidad->update([
                'racimo'=>$this->racimo
            ]);
        }
        if($this->esponjas){
            $this->recepcion->calidad->update([
                'esponjas'=>$this->esponjas
            ]);
        }
        if($this->h_esponjas){
            $this->recepcion->calidad->update([
                'h_esponjas'=>$this->h_esponjas
            ]);
        }
        if($this->llenado_tottes){
            $this->recepcion->calidad->update([
                'llenado_tottes'=>$this->llenado_tottes
            ]);
        }
        
    }

    public function editar(Recepcion $recepcion) {
        $recepcion->n_estado='Finalizado';
        $recepcion->save();
       return redirect()->route('productioncc.index');
    }
}

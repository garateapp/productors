<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    const PENDIENTE =1;
    const APROBADO =2;

     // relacion uno a muchos inversa
    public function calidad(){
        return $this->BelongsTo('App\Models\Calidad');
    }

    public function parametro(){
        return $this->BelongsTo('App\Models\Parametro');
    }

    public function valor(){
        return $this->BelongsTo('App\Models\Valor');
    }
}

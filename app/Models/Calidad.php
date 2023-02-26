<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calidad extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

     // relacion uno a muchos inversa
    public function recepcion(){
        return $this->BelongsTo('App\Models\Recepcion');
    }

    public function detalles(){
        return $this->hasMany('App\Models\Detalle');
    }
}

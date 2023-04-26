<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variedad extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

     // relacion uno a muchos inversa
     public function especie(){
        return $this->BelongsTo('App\Models\Especie');
    }

    public function comercializado(){
        return $this->BelongsToMany('App\Models\User');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especie extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function comercializado(){
        return $this->BelongsToMany('App\Models\User');
    }

    public function variedads(){
        return $this->hasMany('App\Models\Variedad');
    }
}

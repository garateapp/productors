<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDocumentacion extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = [
        'nombre',
        'descripcion',
        'estado'
    ];



    /**
     * Relacion con el modelo Documentacion
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function documentacions(){
        return $this->hasMany('App\Models\Documentacions');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDocumentacions extends Model
{
    use HasFactory;


    protected $guarded = ['id'];

    protected $fillable = [
        'nombre',
        'descripcion',
        'estado',
        'nombre_guardado',
        'tiene_vigencia',
        'fecha_vigencia',
        'obligatorio',
        'creado_por',
        'pais_id',
        'especie_id'
    ];



    /**
     * Relacion con el modelo Documentacion
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function documentacions(){
        return $this->hasMany('App\Models\Documentacions','tipo_documentacion_id');
    }
    public function especie(){
        return $this->belongsTo('App\Models\Especie','especie_id');
    }
    public function pais(){
        return $this->belongsTo('App\Models\Paises','pais_id');
    }
    public function user(){
        return $this->belongsTo('App\Models\User','creado_por');
    }

}

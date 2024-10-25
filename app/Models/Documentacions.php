<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documentacions extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $fillable = ['nombre', 'file', 'user_id','fecha_vigencia','tipodocumentacion_id','csg','descripcion'];


    /**
     * Relacion con el modelo User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
       return $this->BelongsTo('App\Models\User');
    }

    /**
     * Relacion con el modelo TipoDocumentacion
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function TipoDocumentacion(){
        return $this->BelongsTo('App\Models\TipoDocumentacions','tipo_documentacion_id');
     }
}



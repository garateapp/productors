<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paises extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $fillable = ['nombre', 'codigo','codigo_sag','cap','codigo_facturacion','Tipo_identificador','
    Activo','Nacionalidad','predeterminado','id_PRO_P_Paises_grupo','codigo_multipuerto','created_at','updated_at'];

    public function TipoDocumentacion(){
        return $this->hasMany('App\Models\TipoDocumentacions','pais_id');
     }

}



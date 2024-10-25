<?php

namespace App\Http\Controllers;

use App\Models\TipoDocumentacions;
use App\Http\Requests\StoreTipoDocumentacionRequest;
use App\Http\Requests\UpdateTipoDocumentacionRequest;
use App\Models\TipoDocumentacion;
use App\Models\Paises;
use App\Models\User;
use App\Models\Especie;
use App\Http\Controllers\Auth;
//use GuzzleHttp\Psr7\Request;
use Illuminate\Http\Request;
use Illuminate\Contracts\Cache\Store;

class TipoDocumentacionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tipos = TipoDocumentacions::where('global',0)->get();
        $productores=User::where('csg','!=',null)->get();
        $tiposglobales = TipoDocumentacions::where('global',1)->get();

        return view('tipodcumentacions.index',compact('tipos','productores','tiposglobales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user=auth()->user();
        $paises=Paises::all()->pluck('nombre','id');

        $especies=Especie::all()->pluck('name','id');

        return view('tipodcumentacions.create',compact('paises','especies','user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if(isset($request->id) && $request->id!='' || $request->id!=null){
            $tipoDocumentacion=TipoDocumentacions::find($request->id);
        }
        else{
            $tipoDocumentacion=new TipoDocumentacions();
        }
        $tipoDocumentacion->nombre=$request->nombre;
        $tipoDocumentacion->descripcion=$request->descripcion;
        $tipoDocumentacion->estado=$request->estado;
        $tipoDocumentacion->nombre_guardado=$request->nombre_guardado;
        $tipoDocumentacion->tiene_vigencia=$request->tiene_vigencia;
        $tipoDocumentacion->fecha_vigencia=$request->fecha_vigencia;
        $tipoDocumentacion->obligatorio=$request->obligatorio?1:0;
        $tipoDocumentacion->creado_por=$request->creado_por;
        $tipoDocumentacion->pais_id=$request->pais_id;
        $tipoDocumentacion->especie_id=$request->especie_id;
        $tipoDocumentacion->global=$request->global;

       // dd($tipoDocumentacion);
        $tipoDocumentacion->save();
        return redirect()->back()->with('info','El Tipo de Documento fue creado con exito!!!!!.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TipoDocumentacions  $tipoDocumentacion
     * @return \Illuminate\Http\Response
     */
    public function show(TipoDocumentacions $tipoDocumentacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TipoDocumentacions  $tipoDocumentacion
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoDocumentacions $tipodocumentacion)
    {
        //
        $user=auth()->user();
        $paises=Paises::all()->pluck('nombre','id');
        $usuario=User::find($tipodocumentacion->creado_por);
        $especies=Especie::all()->pluck('name','id');
        $tipodocumentacion = TipoDocumentacions::find($tipodocumentacion->id);

        return view('tipodcumentacions.edit',compact('tipodocumentacion','user','paises','usuario','especies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TipoDocumentacions  $tipoDocumentacion
     * @return \Illuminate\Http\Response
     */
    public function update(\Illuminate\Http\Request $request)
    {

        $tipoDocumentacion=TipoDocumentacions::find($request->id);
        //$tipoDocumentacion=new TipoDocumentacions();
        $tipoDocumentacion->nombre=$request->nombre;
        $tipoDocumentacion->descripcion=$request->descripcion;
        $tipoDocumentacion->estado=$request->estado;
        $tipoDocumentacion->nombre_guardado=$request->nombre_guardado;
        $tipoDocumentacion->tiene_vigencia=$request->tiene_vigencia;
        $tipoDocumentacion->fecha_vigencia=$request->fecha_vigencia;
        $tipoDocumentacion->obligatorio=$request->obligatorio?1:0;
        $tipoDocumentacion->creado_por=$request->creado_por;
        $tipoDocumentacion->pais_id=$request->pais_id;
        $tipoDocumentacion->especie_id=$request->especie_id;
        $tipoDocumentacion->global=$request->global;


       // dd($tipoDocumentacion);
        $tipoDocumentacion->save();
        return redirect()->back()->with('info','El Tipo de Documento fue mdificado con exito!!!!!.');
        //return redirect()->route('tipodocumentacions.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TipoDocumentacions  $tipoDocumentacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $tipoDocumentacion=TipoDocumentacions::find($request->id);
        $tipoDocumentacion->delete();
        return redirect()->back()->with('info','El Tipo de Documento fue eliminado con exito!!!!!.');
        //return redirect()->route('tipodocumentacions.index');
    }
}

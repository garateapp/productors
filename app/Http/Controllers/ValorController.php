<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dagnos;
use App\Models\Especie;
use App\Models\Parametro;
use App\Models\Valor;

class ValorController extends Controller
{
    //
    public function index()
    {
        $dagnos=Valor::join('parametros', 'parametros.id', '=', 'valors.parametro_id')
        ->select('valors.*', 'parametros.name as parametro')
        ->get();

        return view('valor.index',compact('dagnos'));
    }
    public function create()
    {
        $especies=Especie::pluck('name','id')->prepend('Seleccione la especie');
        $parametros=Parametro::pluck('name','id')->prepend('Seleccione el parámetro');
        return view('valor.create',compact('parametros','especies'));
    }
    public function store(Request $request)
    {


        $dagnos=new Valor();
        $dagnos->name=$request->valor;
        $dagnos->parametro_id=$request->parametro;
        $dagnos->especie=$request->especie;

        $dagnos->save();
        return redirect()->route('valor.index');
    }
    public function edit($id)
    {
        $dagnos=Valor::find($id);
        $especies=Especie::pluck('name','id')->prepend('Seleccione la especie');
        $parametros=Parametro::pluck('name','id')->prepend('Seleccione el parámetro');
        return view('valor.edit',compact('dagnos','parametros','especies'));
    }
    public function update(Request $request, $id)
    {
        $dagnos=Valor::find($id);
        $dagnos->name=$request->valor;
        $dagnos->parametro_id=$request->parametro;
        $dagnos->especie=$request->especie;
        $dagnos->save();
        return redirect()->route('valor.index');
    }
    public function destroy($id)
    {
        $dagnos=Valor::find($id);
        $dagnos->delete();
        return redirect()->route('valor.index');
    }
    public function show($id)
    {
        $dagnos=Valor::find($id);
        return view('valor.show',compact('dagnos'));
    }
}

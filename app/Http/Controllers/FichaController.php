<?php

namespace App\Http\Controllers;

use App\Models\Certificacion;
use App\Models\Especie;
use App\Models\Ficha;
use App\Models\User;
use App\Models\Variedad;
use Illuminate\Http\Request;

class FichaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {    $request->validate([
             'kilos_entregables'=>'required'
        ]);

        $ficha=Ficha::create($request->all());

        return redirect(route('productor.edit',$ficha->user).'/#especies');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Ficha $ficha)
    {   $user=User::find($ficha->user_id);
        $certificacions=Certificacion::where('rut',$user->rut)->get();
        $especies=Especie::all()->pluck('name','id');
        $variedades=Variedad::all()->pluck('name','id');
        
        return view('admin.agronomos.editficha',compact('ficha','user','certificacions','especies','variedades'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ficha $ficha)
    {
        $ficha->update($request->all());

        return redirect(route('productor.edit',$ficha->user).'/#especies');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ficha $ficha)
    {
        $ficha->delete();
        return redirect()->back();
    }
}

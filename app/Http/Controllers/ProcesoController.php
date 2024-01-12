<?php

namespace App\Http\Controllers;

use App\Models\Especie;
use App\Models\Estadisticas;
use App\Models\User;
use App\Models\Variedad;
use Illuminate\Http\Request;

class ProcesoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {     $estadistica = Estadisticas::create([
                'type'=> 'vistaprocesoproductor',
                'user_id'=>auth()->user()->id
            ]);
        return view('productors.procesosproductor',compact('user'));
    }

    public function especie(Especie $especie)
    {
        return view('proceso.procesoespecie',compact('especie'));
    }

    public function especie_anterior(Especie $especie)
    {
        return view('proceso.procesoespecieanterior',compact('especie'));
    }

    public function variedad(Variedad $variedad)
    {
        return view('proceso.procesovariedad',compact('variedad'));
    }
    public function variedad_anterior(Variedad $variedad)
    {
        return view('proceso.procesovariedadanterior',compact('variedad'));
    }

    public function productorespecie(Especie $especie)
    {
        return view('productors.procesoespecie',compact('especie'));
    }

    public function productorvariedad(Variedad $variedad)
    {
        return view('productors.procesovariedad',compact('variedad'));
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
    {
        //
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

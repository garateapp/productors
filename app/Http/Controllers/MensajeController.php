<?php

namespace App\Http\Controllers;

use App\Models\Especie;
use App\Models\Estadisticas;
use App\Models\Mensaje;
use App\Models\Mensaje_hist;
use Illuminate\Http\Request;
use Illuminate\support\Str;

class MensajeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $estadistica = Estadisticas::create([
            'type'=> 'infotecnicaproductor',
            'user_id'=>auth()->user()->id
        ]);
        
        return view('productors.mensaje');
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
    {   $request->validate([
        'file'=>'required'
        ]);
    
        $especie=Especie::find($request->especie);
        $productors = $especie->comercializado()->get();

        $name = Str::random(5).$request->file('file')->getClientOriginalName();
        $url = $request->file('file')->storeAs(
            'app/archivos', $name
        );
        
        $mensaje_hist=Mensaje_hist::create([
            'observacion'=>$request->observacion,
            'especie'=>$especie->name,
            'tipo'=>$request->tipo,
            'archivo'=>$url,
            'emisor_id'=>auth()->user()->id
        ]);

        foreach($productors as $productor){
            $mensaje=Mensaje::create([
                'observacion'=>$request->observacion,
                'especie'=>$especie->name,
                'tipo'=>$request->tipo,
                'archivo'=>$url,
                'emisor_id'=>auth()->user()->id,
                'receptor_id'=>$productor->id,
                'mensaje_hist_id'=>$mensaje_hist->id
            ]);
        }

        return redirect()->back();

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

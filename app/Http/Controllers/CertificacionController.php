<?php

namespace App\Http\Controllers;

use App\Models\Certificacion;
use App\Models\User;
use Illuminate\Http\Request;

class CertificacionController extends Controller
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
        {
            $request->validate([
                'name' => 'required'
            ]);

        $mensaje=Certificacion::create([
            'rut'=>$request->rut,
            'name'=>$request->name,
            'vigencia'=>$request->vigencia,
            'documento'=>$request->file,            
        ]);
        $user=User::find($request->user_id);
        return redirect(route('productor.edit',$user).'/#certificaciones');

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
    public function destroy(Certificacion $certificacion)
    {
        $certificacion->delete();
        return redirect()->back();
    }
}

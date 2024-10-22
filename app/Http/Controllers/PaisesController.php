<?php

namespace App\Http\Controllers;

use App\Models\Paises;
use App\Http\Requests\StorePaisesRequest;
use App\Http\Requests\UpdatePaisesRequest;

class PaisesController extends Controller
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
     * @param  \App\Http\Requests\StorePaisesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePaisesRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Paises  $paises
     * @return \Illuminate\Http\Response
     */
    public function show(Paises $paises)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Paises  $paises
     * @return \Illuminate\Http\Response
     */
    public function edit(Paises $paises)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePaisesRequest  $request
     * @param  \App\Models\Paises  $paises
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePaisesRequest $request, Paises $paises)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Paises  $paises
     * @return \Illuminate\Http\Response
     */
    public function destroy(Paises $paises)
    {
        //
    }
}

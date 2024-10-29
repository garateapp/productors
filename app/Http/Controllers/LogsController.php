<?php

namespace App\Http\Controllers;

use App\Models\logs;
use App\Http\Requests\StorelogsRequest;
use App\Http\Requests\UpdatelogsRequest;

class LogsController extends Controller
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
     * @param  \App\Http\Requests\StorelogsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorelogsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\logs  $logs
     * @return \Illuminate\Http\Response
     */
    public function show(logs $logs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\logs  $logs
     * @return \Illuminate\Http\Response
     */
    public function edit(logs $logs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatelogsRequest  $request
     * @param  \App\Models\logs  $logs
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatelogsRequest $request, logs $logs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\logs  $logs
     * @return \Illuminate\Http\Response
     */
    public function destroy(logs $logs)
    {
        //
    }
}

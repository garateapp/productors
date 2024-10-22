<?php

namespace App\Http\Controllers;

use App\Models\Especie;
use App\Models\Estadisticas;
use App\Models\Mensaje;
use App\Models\Mensaje_hist;
use Illuminate\Http\Request;
use Illuminate\support\Str;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

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
        $url2 = $request->file('file')->storeAs(
           'public/archivos', $name
        );

        // $mensaje_hist=Mensaje_hist::create([
        //     'observacion'=>$request->observacion,
        //     'especie'=>$especie->name,
        //     'tipo'=>$request->tipo,
        //     'archivo'=>$url,
        //     'emisor_id'=>auth()->user()->id
        // ]);
        $token = env('WS_TOKEN');
                            $phoneid= env('WS_PHONEID');
                            $link= $url2;//'https://appgreenex.cl/'+asset('storage/'.$zipFileName);
                            $version='v16.0';
                            $url=asset('storage/archivos/'.$name);
                            dd($url,$name);
        //foreach($productors as $productor){


            $wsload=[
                'messaging_product' => 'whatsapp',
                "preview_url"=> false,
                'to'=>'56966291494',
                'type'=>'document',

                                        'document' => [
                'link' => $url,
                'caption' => 'Aquí está el documento solicitado.',
            ],




            ];

            Http::withToken($token)->post('https://graph.facebook.com/'.$version.'/'.$phoneid.'/messages',$wsload)->throw()->json();


            // $mensaje=Mensaje::create([
            //     'observacion'=>$request->observacion,
            //     'especie'=>$especie->name,
            //     'tipo'=>$request->tipo,
            //     'archivo'=>$url,
            //     'emisor_id'=>auth()->user()->id,
            //     'receptor_id'=>$productor->id,
            //     'mensaje_hist_id'=>$mensaje_hist->id
            // ]);

        //}

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

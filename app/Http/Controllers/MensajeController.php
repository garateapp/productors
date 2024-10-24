<?php

namespace App\Http\Controllers;

use App\Models\Especie;
use App\Models\Estadisticas;
use App\Models\Mensaje;
use App\Models\Mensaje_hist;
use App\Models\Telefono;
use Illuminate\Http\Request;
use Illuminate\support\Str;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Log as FacadesLog;
use Log;
use Exception;

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
    {

        $request->validate([
        'file'=>'required'
        ]);

        $especie=Especie::find($request->especie);
        $productors = $especie->comercializado()->get();

        $name = Str::random(5).$request->file('file')->getClientOriginalName();
        $url2 = $request->file('file')->storeAs(
           'public/archivos', $name
        );
        $token = env('WS_TOKEN');
        $phoneid= env('WS_PHONEID');
        $link= $url2;//'https://appgreenex.cl/'+asset('storage/'.$zipFileName);
        $version='v16.0';
        $url=asset('storage/archivos/'.$name);

        $mensaje_hist=Mensaje_hist::create([
            'observacion'=>$request->observacion,
            'especie'=>$especie->name,
            'tipo'=>$request->tipo,
            'archivo'=>$url,
            'emisor_id'=>auth()->user()->id
        ]);


        foreach($productors as $productor){
           //dd($productor);
            $telefonos=Telefono::where('user_id',$productor->id)->get();

            foreach($productor->telefonos as $telefono){
                $fono='569'.substr(str_replace(' ', '', $telefono->numero), -8);

                try{
                    $wsload=[
                        'messaging_product' => 'whatsapp',
                        "preview_url"=> false,
                        'to'=>$fono,

                        'type'=>'template',
                            'template'=>[
                                'name'=>'proceso',
                                'language'=>[
                                    'code'=>'es'],
                                'components'=>[
                                    [
                                        'type'=>'header',
                                        'parameters'=>[
                                            [
                                                'type'=>'document',
                                                'document'=> [
                                                    'link'=>$url,
                                                    'filename'=>"prueba.pdf",
                                                    ]
                                            ]
                                        ]
                                    ],
                                    [
                                        'type'=>'body',
                                        'parameters'=>[
                                            [
                                                'type'=>'text',
                                                'text'=> "2"
                                            ]
                                        ]
                                    ]
                                ]
                            ]


                    ];


                    $response=Http::withToken($token)->post('https://graph.facebook.com/'.$version.'/'.$phoneid.'/messages',$wsload)->throw()->json();
                    FacadesLog::info('Mensaje enviado a '.$productor->name.', Telefono: '.$fono.', CSG: '.$productor->csg.' ID Mensaje='.$response->json_decode());
                }catch(Exception $e){
                        FacadesLog::error('Error al enviar mensaje: '.$e->getMessage());
                            //dd($e->getMessage());
                }

            }
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

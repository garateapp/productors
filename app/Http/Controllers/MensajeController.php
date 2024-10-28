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
use App\Mail\MensajeGenericoMailable;
use App\Models\CampoStaff;
use App\Models\Certificacion;
use App\Models\Ficha;
use Illuminate\Support\Facades\Mail;

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

        //Para Pruebas de Whatsapp
        // $mensaje=New Mensaje();
        // $mensaje->observacion=$request->observacion;
        // $mensaje->especie=$especie->name;
        // $mensaje->tipo=$request->tipo;
        // $mensaje->archivo=$url2;
        // $mensaje->emisor_id=auth()->user()->id;
        // $fono="56966291494";
        // try{

        //     $wsload=[
        //         'messaging_product' => 'whatsapp',
        //         "preview_url"=> false,
        //         'to'=>$fono,

        //         'type'=>'template',
        //             'template'=>[
        //                 'name'=>'envios_masivos',
        //                 'language'=>[
        //                     'code'=>'es'],
        //                 'components'=>[
        //                     [
        //                         'type'=>'header',
        //                         'parameters'=>[
        //                             [
        //                                 'type'=>'document',
        //                                 'document'=> [
        //                                     'link'=>$url,
        //                                     'filename'=>$name,
        //                                     ]
        //                             ]
        //                         ]
        //                     ],
        //                     [
        //                         'type'=>'body',
        //                         'parameters'=>[
        //                             [
        //                                 'type'=>'text',
        //                                 'text'=> "Documento ".$request->tipo." de la Especie ". $mensaje->especie,
        //                             ]
        //                         ]
        //                     ]
        //                 ]
        //             ]


        //     ];
        //     $response=Http::withToken($token)->post('https://graph.facebook.com/'.$version.'/'.$phoneid.'/messages',$wsload)->throw()->json();

        //     }catch(Exception $e){
        //                 FacadesLog::error('Error al enviar mensaje: '.$e->getMessage());
        //                     //dd($e->getMessage());
        //         }
             //Para Pruebas de Whatsapp
        $contador=0;
        foreach($productors as $productor){

            $telefonos=Telefono::where('user_id',$productor->id)->get();
            if($productor->emnotification==1){


                $mensaje=New Mensaje();
                $mensaje->observacion=$request->observacion;
                $mensaje->especie=$especie->name;
                $mensaje->tipo=$request->tipo;
                $mensaje->archivo=$url2;
                $mensaje->emisor_id=auth()->user()->id;

                $subject="Envío de Archivo: ".$request->tipo." para ".$especie->name;

                if($contador>=35){
                    if($contador%20==0){
                        sleep(10);
                    }
                    if($productor->email!=null && $productor->email!='')
                    {
                            Mail::to($productor->email)->send(new MensajeGenericoMailable($mensaje,$url2));
                            FacadesLog::info('Mensaje enviado a '.$productor->name.', Email: '.$productor->email.', CSG: '.$productor->csg.' para '.$especie->name.' por '.$request->tipo);

                    }
                    $contador++;
                }
                else{
                    FacadesLog::info($contador.'Mensaje Saltado '.$productor->name.', Email: '.$productor->email.', CSG: '.$productor->csg.' para '.$especie->name.' por '.$request->tipo);
                    $contador++;
                }
            }
            else{
                    FacadesLog::info($productor->name.' no tiene correo electronico');
                }




            //dd($productor);
                foreach($productor->telefonos as $telefono){
                    $fono='569'.substr(str_replace(' ', '', $telefono->numero), -8);

                    //$fono="56966291494"; //Solo Testing
                    try{

                        $wsload=[
                            'messaging_product' => 'whatsapp',
                            "preview_url"=> false,
                            'to'=>$fono,

                            'type'=>'template',
                                'template'=>[
                                    'name'=>'envios_masivos',
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
                                                        'filename'=>$name,
                                                        ]
                                                ]
                                            ]
                                        ],
                                        [
                                            'type'=>'body',
                                            'parameters'=>[
                                                [
                                                    'type'=>'text',
                                                    'text'=> "Documento ".$request->tipo." de la Especie ". $mensaje->especie,
                                                ]
                                            ]
                                        ]
                                    ]
                                ]


                        ];

                    // dd($wsload);

                        $response=Http::withToken($token)->post('https://graph.facebook.com/'.$version.'/'.$phoneid.'/messages',$wsload)->throw()->json();
                    // }
                        //$response2=Http::withToken($token)->post('https://graph.facebook.com/'.$version.'/'.$phoneid.'/messages',$wsload2)->throw()->json();
                    // dd($response);

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

<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\CreateNewUser;
use App\Models\Calidad;
use App\Models\Especie;
use App\Models\Proceso;
use App\Models\Recepcion;
use App\Models\Sync;
use App\Models\User;
use App\Models\Variedad;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Spatie\Permission\Models\Role;
use PDF;
use Illuminate\support\Str;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index()
    {        
        return view('productors.index');
    }
    

    public function envio_masivo()
    {  try {
        
        //TOKEN QUE NOS DA FACEBOOK
        $token = 'EABVGwJYpNswBAEZBAkttf9xCesIiieZCGpr38okLtFZCK9J5SJmFw6ta1BmZBBwE8buEePOcgpe01LtBuK0PA009lkosW7xBe0B8ouQHqSZBu8zeyVAhda5nyPZAY0AuljLO1z4lHm9yBAsIkIG80nDPTP1LeeRg8wqPckD8SYt8Go0ZCJzAkgZCcZAgvHfuSwW0pE3MyxtBTo232J2npCRFm';
        $phoneid='100799979656074';
        $version='v16.0';
        $url="https://appgreenex.cl/";
        $payload=[
            'messaging_product' => 'whatsapp',
            "preview_url"=> false,
            'to'=>'56963176726',
            "text"=>[
                "body"=> "La recepcion nro 20 esta lista en la ur: ".$url." Haz click y descarga el informe de procesos"
                    
            ]
        ];
        
        Http::withToken($token)->post('https://graph.facebook.com/'.$version.'/'.$phoneid.'/messages',$payload)->throw()->json();

        $especies=Especie::all();
        return view('productors.envio-masivo',compact('especies'));

    } catch (Exception $e) {
        $especies=Especie::all();
        return view('productors.envio-masivo',compact('especies'));
        /*
        return response()->json([
            'success'=> false,
            'error'=>$e->getMessage(),
        ],500);*/
    }
       
    }

    public function subir_procesos()
    {         
        return view('productors.subir-proceso');
    }

    public function proceso_upload(Request $request)
    {   
        //$nombre = $request->file('file')->getClientOriginalName();
        $file = $request->file('file');
        $name = $file->getClientOriginalName();
        $proceso=Proceso::find(explode("-",$name)[0]);
        if($proceso){
            $nombre = $request->file('file')->storeAs(
                'pdf-procesos', $name
            );
            $proceso->update([
                'informe'=>$nombre
            ]);

        }
        
        //$fono='569'.substr(str_replace(' ', '', $telefono->numero), -8);
        //TOKEN QUE NOS DA FACEBOOK
        $token = env('WS_TOKEN');
        $phoneid= env('WS_PHONEID');
        $link= 'https://appgreenex.cl/download/'.$proceso->id.'.pdf';
        $version='v16.0';
        $url="https://appgreenex.cl/";
        $payload=[
            'messaging_product' => 'whatsapp',
            "preview_url"=> false,
            'to'=>'56963176726',
            
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
                                        'link'=>$link,
                                        'filename'=>$name
                                        ]
                                ]
                            ]
                        ],
                        [
                            'type'=>'body',
                            'parameters'=>[
                                [
                                    'type'=>'text',
                                    'text'=> $proceso->n_proceso
                                ]
                            ]
                        ]
                    ]
                ]
                
            
        ];
        
        Http::withToken($token)->post('https://graph.facebook.com/'.$version.'/'.$phoneid.'/messages',$payload)->throw()->json();

       


        return view('productors.subir-proceso',compact('nombre'))->with('info','Archivo subido con exito');
    }

    public function download_proceso(Proceso $proceso) {

        return response()->download(storage_path('app/'.$proceso->informe));
    }

    public function proceso_destroy(Proceso $proceso) {
        Storage::delete($proceso->informe);

        $proceso->update([
            'informe'=>NULL
        ]);


        return redirect()->back();
    }

    public function procesos()
    {    
        return view('productors.procesos');
    }

    public function sync_proces()
    {       
        $procesos=Http::post('https://apigarate.azurewebsites.net/api/v1.0/Produccion/ObtenerProduccion');
        $procesos = $procesos->json();

        $ri=Proceso::all();
        $totali=$ri->count();

        foreach ($procesos as $proceso){
            $agricola=Null;//1
            $n_proceso=Null;//2
            $especie=Null;//3
            $variedad=Null;//4
            $kilos_netos=Null;//5
            $categoria=Null;//6
            //7
            $id_empresa=Null;//8
            
            $m=1;
            foreach ($proceso as $item){
                
                if($m==1){
                    $agricola=$item;
                }
                if($m==2){
                    $n_proceso=$item;
                }
                if($m==3){
                    $especie=$item;
                }
                if($m==4){
                    $variedad=$item;
                }
                if($m==5){
                    $fecha=$item;
                }
                if($m==6){
                    $kilos_netos=$item;
                }
                if($m==7){
                    $categoria=$item;
                }
                if($m==8){
                    $id_empresa=$item;
                }
               if($m==8){

                        $cont=Proceso::where('n_proceso',$n_proceso)->first();
                        if($cont){
                            if($categoria=='Sin Procesar'){
                                $cont->forceFill([
                                    'agricola' => $agricola,//1
                                    'n_proceso' => $n_proceso,//2
                                    'especie' => $especie,//3
                                    'variedad' => $variedad,//4
                                    'fecha' => $fecha,//5
                                    'kilos_netos' => $kilos_netos,//6
                                    'id_empresa' => $id_empresa,//8
                                ])->save();
                            }elseif($categoria=='Exportacion'){
                                $cont->forceFill([
                                    'agricola' => $agricola,//1
                                    'n_proceso' => $n_proceso,//2
                                    'especie' => $especie,//3
                                    'variedad' => $variedad,//4
                                    'fecha' => $fecha,//5
                                    'exp' => $kilos_netos,//6
                                    'id_empresa' => $id_empresa,//8
                                ])->save();
                            }elseif($categoria=='Mercado Interno'){
                                $cont->forceFill([
                                    'agricola' => $agricola,//1
                                    'n_proceso' => $n_proceso,//2
                                    'especie' => $especie,//3
                                    'variedad' => $variedad,//4
                                    'fecha' => $fecha,//5
                                    'comercial' => $kilos_netos,//6
                                    'id_empresa' => $id_empresa,//8
                                ])->save();
                            }elseif($categoria=='Desecho'){
                                $cont->forceFill([
                                    'agricola' => $agricola,//1
                                    'n_proceso' => $n_proceso,//2
                                    'especie' => $especie,//3
                                    'variedad' => $variedad,//4
                                    'fecha' => $fecha,//5
                                    'desecho' => $kilos_netos,//6
                                    'id_empresa' => $id_empresa,//8
                                ])->save();
                            }
                            
                        }else{
                            
                            if($categoria=='Sin Procesar'){
                                $rec=Proceso::create([
                                    'agricola' => $agricola,//1
                                    'n_proceso' => $n_proceso,//2
                                    'especie' => $especie,//3
                                    'variedad' => $variedad,//4
                                    'fecha' => $fecha,//5
                                    'kilos_netos' => $kilos_netos,//6
                                    'exp' => 0,//6
                                    'comercial' => 0,//6
                                    'desecho' => 0,//6
                                    'merma' => 0,//6
                                    'id_empresa' => $id_empresa,//8
                                ]);
                            }elseif($categoria=='Exportacion'){
                                $rec=Proceso::create([
                                    'agricola' => $agricola,//1
                                    'n_proceso' => $n_proceso,//2
                                    'especie' => $especie,//3
                                    'variedad' => $variedad,//4
                                    'fecha' => $fecha,//5
                                    'kilos_netos' => 0,//6
                                    'exp' => $kilos_netos,//6
                                    'comercial' => 0,//6
                                    'desecho' => 0,//6
                                    'merma' => 0,//6
                                    'id_empresa' => $id_empresa,//8
                                ]);
                            }elseif($categoria=='Mercado Interno'){
                                $rec=Proceso::create([
                                    'agricola' => $agricola,//1
                                    'n_proceso' => $n_proceso,//2
                                    'especie' => $especie,//3
                                    'variedad' => $variedad,//4
                                    'fecha' => $fecha,//5
                                    'kilos_netos' => 0,//6
                                    'exp' => 0,
                                    'comercial' => $kilos_netos,//6
                                    'desecho' => 0,//6
                                    'merma' => 0,//6
                                    'id_empresa' => $id_empresa,//8
                                ]);
                            }elseif($categoria=='Desecho'){
                                $rec=Proceso::create([
                                    'agricola' => $agricola,//1
                                    'n_proceso' => $n_proceso,//2
                                    'especie' => $especie,//3
                                    'variedad' => $variedad,//4
                                    'fecha' => $fecha,//5
                                    'kilos_netos' => 0,//6
                                    'exp' => 0,
                                    'comercial' => 0,//6
                                    'desecho' => $kilos_netos,//6
                                    'merma' => 0,//6
                                    'id_empresa' => $id_empresa,//8
                                ]);
                            }	
                               
                        }
                    
                }
                $m+=1;
                
            } 
        }

        
        $rf=Proceso::all();
        $total=$rf->count()-$ri->count();
        Sync::create([
            'tipo'=>'MANUAL',
            'entidad'=>'PROCESOS',
            'fecha'=>Carbon::now(),
            'cantidad'=>$total
        ]);

        return redirect()->route('procesos.index');

    }

    public function dashboard () {
        $users=User::all();
        $recepcions=Recepcion::all();
        $prop_recep=Recepcion::where('r_emisor',auth()->user()->rut)
        ->latest('id')->get();
        return view('dashboard',compact('users','recepcions','prop_recep'));
    }

    public function downloadpdf(Recepcion $recepcion) {

        view()->share('productors.informe',$recepcion);
 
         $pdf = PDF::loadView('productors.informe', ['recepcion' => $recepcion]);
 
         return $pdf->download($recepcion->id_g_recepcion.'-'.$recepcion->id_emisor.'.pdf');
    }

    public function production()
    {  
        $recepcions=Recepcion::all();
        

        return view('productors.production',compact('recepcions'));
    }

    public function productionpropia()
    {  
        //$recepcions = $recepcions->json();

        return view('productors.productionpropia');
    }

    public function productioncc()
    {  
        //$recepcions = $recepcions->json();

        return view('productors.productioncc');
    }

    public function production_refresh()
    {        
        $productions=Http::post('https://apigarate.azurewebsites.net/api/v1.0/Recepcion/ObtenerRecepcion');
        $productions = $productions->json();
        $ri=Recepcion::all();
        $totali=$ri->count();

        foreach ($productions as $production){
            $id_g_recepcion=Null;//1
            $tipo_g_recepcion=Null;//2
            $numero_g_recepcion=Null;//3
            $fecha_g_recepcion=Null;//4
            $id_emisor=Null;//5
            $r_emisor=Null;//6
            //7
            $n_emisor=Null;//8
            $Codigo_Sag_emisor=Null;//9
            $tipo_documento_recepcion=Null;//10
            $numero_documento_recepcion=Null;//11
            $n_especie=Null;//12
            $n_variedad=Null;//13
            $cantidad=Null;//14
            $peso_neto=Null;//15
            $nota_calidad=Null;//16
            $n_estado=Null;//17

            $m=1;
            foreach ($production as $item){
                
                if($m==2){
                    $id_g_recepcion=$item;
                }
                if($m==3){
                    $tipo_g_recepcion=$item;
                }
                if($m==4){
                    $numero_g_recepcion=$item;
                }
                if($m==5){
                    $fecha_g_recepcion=$item;
                }
                if($m==6){
                    $id_emisor=$item;
                }
                if($m==7){
                    $r_emisor=$item;
                }
                if($m==8){
                    $Codigo_Sag_emisor=$item;
                }
                if($m==9){
                    $n_emisor=$item;
                }
                if($m==10){
                    $tipo_documento_recepcion=$item;
                }
                if($m==11){
                    $numero_documento_recepcion=$item;
                }
                if($m==12){
                    $n_especie=$item;

                }
                if($m==13){
                    $n_variedad=$item;
                }
                if($m==14){
                    $cantidad=$item;
                }
                if($m==15){
                    $peso_neto=$item;
                }
                if($m==16){
                    $nota_calidad=$item;
                }
               if($m==17){
                    $n_estado=$item;

                        $espec=Especie::where('name',$n_especie)->first();
                        if($espec){
                            $espec->forceFill([
                                'name'=> $n_especie
                            ]);
                            $varie=Variedad::where('name',$n_variedad)->first();
                            if($varie){
                                $varie->forceFill([
                                    'name'=> $n_variedad,
                                    'especie_id='=> $espec->id
                                ]);
                            }else{
                                Variedad::create([
                                    'name'=> $n_variedad,
                                    'especie_id'=>$espec->id
                                ]);
                            }
                        }else{
                            $especie=Especie::create([
                            'name'=> $n_especie
                            ]);
                            $varie=Variedad::where('name',$n_variedad)->first();
                            if($varie){
                                $varie->forceFill([
                                    'name'=> $n_variedad,
                                    'especie_id='=> $especie->id
                                ]);
                            }else{
                                Variedad::create([
                                    'name'=> $n_variedad,
                                    'especie_id'=>$especie->id
                                ]);
                            }
                        }
                    
                        $cont=Recepcion::where('id_g_recepcion',$id_g_recepcion)->first();
                        if($cont){
                            $cont->forceFill([
                                'id_g_recepcion' => $id_g_recepcion,//1
                                'tipo_g_recepcion' => $tipo_g_recepcion,//2
                                'numero_g_recepcion' => $numero_g_recepcion,//3
                                'fecha_g_recepcion' => $fecha_g_recepcion,//4
                                'id_emisor' => $id_emisor,//5
                                'r_emisor' => $r_emisor,//6
                                'n_emisor' => $n_emisor,//8
                                'Codigo_Sag_emisor' => $Codigo_Sag_emisor,//9
                                'tipo_documento_recepcion' => $tipo_documento_recepcion,//10
                                'numero_documento_recepcion' => $numero_documento_recepcion,//11
                                'n_especie' => $n_especie,//12
                                'n_variedad' => $n_variedad,
                                'cantidad' => $cantidad,
                                'peso_neto' => $peso_neto,
                                'nota_calidad' => $nota_calidad,
                                'n_estado' => $n_estado,
                            ])->save();
                            if(IS_NULL($cont->calidad)){
                                Calidad::create([
                                    'recepcion_id'=>$cont->id
                                ]);
                            }
                            }
                        else{
                            if($n_estado=='Finalizado'){
                                $rec=Recepcion::create([
                                    'id_g_recepcion' => $id_g_recepcion,//1
                                    'tipo_g_recepcion' => $tipo_g_recepcion,//2
                                    'numero_g_recepcion' => $numero_g_recepcion,//3
                                    'fecha_g_recepcion' => $fecha_g_recepcion,//4
                                    'id_emisor' => $id_emisor,//5
                                    'r_emisor' => $r_emisor,//6
                                    'n_emisor' => $n_emisor,//8
                                    'Codigo_Sag_emisor' => $Codigo_Sag_emisor,//9
                                    'tipo_documento_recepcion' => $tipo_documento_recepcion,//10
                                    'numero_documento_recepcion' => $numero_documento_recepcion,//11
                                    'n_especie' => $n_especie,//12
                                    'n_variedad' => $n_variedad,
                                    'cantidad' => $cantidad,
                                    'peso_neto' => $peso_neto,
                                    'nota_calidad' => $nota_calidad,
                                    'n_estado' => $n_estado,
                                ]);
                                Calidad::create([
                                    'recepcion_id'=>$rec->id
                                ]);
                            }
                        }
                    
                }
                $m+=1;
                
            } 
        }

        
        $rf=Recepcion::all();
        $total=$rf->count()-$ri->count();
        Sync::create([
            'tipo'=>'MANUAL',
            'entidad'=>'RECEPCIONES',
            'fecha'=>Carbon::now(),
            'cantidad'=>$total
        ]);

        return redirect()->route('production.index');

        //return view('productors.production',compact('productions'));
    }

    public function productor_refresh()
    {  

        $users= Http::post('https://apigarate.azurewebsites.net/api/v1.0/Productor/ObtenerProductor');

        $users = $users->json();

        $ri=User::all();
        $totali=$ri->count();

       
        foreach ($users as $user){
            $id=null;
            $nombre=null;
            $rut=null;
            $csg=null;
            $us=null;
            
            $m=1;
            foreach ($user as $item){
                
                if($m==1){
                    $id=$item;
                }
                if($m==3){
                    $us=$item;
                }
                if($m==4){
                    $nombre=$item;
                }
                if($m==3){
                    $rut=$item;
                }
                if($m==2){
                    $csg=$item;
                }
               
                if($m==14){
                    $cont=User::where('rut',$rut)->first();
                    $search=['.','-'];
                    if($cont){
                         $cont->forceFill([
                            'name' => $nombre,
                            'idprod' => $id,
                            'csg' => $csg,
                            'user' => 'gre-'.str_replace($search, '', $us),
                            'rut' => $rut
                        ])->save();
                        $roleid=Role::where('name','Productor')->first();
                        $cont->roles()->sync([$roleid->id]);
                    }else{
                        $user=User::create([
                            'name' => $nombre,
                            'idprod' => $id,
                            'csg' => $csg,
                            'user' => 'gre-'.str_replace($search, '', $us),
                            'rut' => $rut,
                            'password' => Hash::make('gre1234'),
                        ]);
                        $roleid=Role::where('name','Productor')->first();
                        $user->roles()->sync([$roleid->id]);
                    }
                }
                $m+=1;
                
            } 
        }

        $rf=User::all();
        $total=$rf->count()-$ri->count();
        Sync::create([
            'tipo'=>'MANUAL',
            'entidad'=>'PRODUCTORES',
            'fecha'=>Carbon::now(),
            'cantidad'=>$total
        ]);

        return redirect()->route('productors.index');


        //return view('productors.index',compact('users'));
    }


}

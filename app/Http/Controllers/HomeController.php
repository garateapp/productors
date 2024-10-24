<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\CreateNewUser;
use App\Exports\DanostotalExport;
use App\Exports\ProcesosExport;
use App\Models\Calidad;
use App\Models\Detalle;
use App\Models\Especie;
use App\Models\Estadistica_type;
use App\Models\Estadisticas;
use App\Models\Proceso;
use App\Models\Recepcion;
use App\Models\Soporte;
use App\Models\Sync;
use App\Models\User;
use App\Models\Valor;
use App\Models\Variedad;
use App\Models\Documentacions;
use App\Models\TipoDocumentacions;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Spatie\Permission\Models\Role;
use PDF;
use Illuminate\support\Str;
use Illuminate\Support\Facades\Storage;
use ConsoleTVs\Charts\Facades\Charts;
use DateTime;
use Illuminate\Support\Facades\Validator;
use Laravel\Jetstream\Jetstream;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use App\Mail\NotificacionMailable;
use App\Models\CampoStaff;
use App\Models\Certificacion;
use App\Models\Ficha;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use ZipArchive;

class HomeController extends Controller
{
    public function index()
    {   $estadistica = Estadisticas::create([
            'type'=> 'vistaproductoradmin',
            'user_id'=>auth()->user()->id
        ]);
        return view('productors.index');
    }

    public function danoreport()
    {   $detalles = Detalle::all();

        return view('calidad.danos',compact('detalles'));
    }

    public function danoexport()
    {
        return Excel::download(new DanostotalExport(null,null),'Reporte de Calidad.xlsx');
    }


    public function envio_masivo()
    {  try {


        $especies=Especie::all();
        return view('productors.envio-masivo',compact('especies'));

    } catch (Exception $e) {
        $especies=Especie::all();
        return view('productors.envio-masivo',compact('especies'));

    }

    }

    public function subir_procesos()
    {
        return view('productors.subir-proceso');
    }

    public function subir_procesos_anterior()
    {
        return view('productors.subir-procesoanterior');
    }

    public function subir_recepciones()
    {
        return view('productors.subir-recepciones');
    }

    public function proceso_upload(Request $request)
    {

        $file = $request->file('file');
        //obtener Nombre del archivo
        $name = $file->getClientOriginalName();

        //Con dicho nombre, encontrar el proceso correspondiente al archivo
        $proceso=Proceso::where('n_proceso',explode("-",$name)[0])->where('temporada','actual')->first();


        if($proceso){
            //si existe el proceso, guardar el archivo, si no existe, no lo guarda
            $nombre = $request->file('file')->storeAs(
                'pdf-procesos', $name
            );
            //una vez guardado el archivo, se asocia al proceso
            $proceso->update([
                'informe'=>$nombre
            ]);
            //luego se busca al productor que tiene el nombre de la agricola del proceso
            $user=User::where('name',$proceso->agricola)->first();


            if(!is_null($user)){

                if($user->emnotification==TRUE){
                    Mail::to($user->email)->send(new NotificacionMailable($proceso));
                   //en caso que exista el usuarioo consultar si tiene telefonos registrados
                    if($user->telefonos->count()){
                        foreach($user->telefonos as $telefono){
                            $fono='569'.substr(str_replace(' ', '', $telefono->numero), -8);
                            //TOKEN QUE NOS DA FACEBOOK
                            $token = env('WS_TOKEN');
                            $phoneid= env('WS_PHONEID');
                            $link= 'https://appgreenex.cl/download/'.$proceso->id.'.pdf';
                            $version='v16.0';
                            $url="https://appgreenex.cl/";
                            $payload=[
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

                            $token = env('WS_TOKEN');
                            $phoneid= env('WS_PHONEID');
                            $link= 'https://appgreenex.cl/download/'.$proceso->id.'.pdf';
                            $version='v16.0';
                            $url="https://appgreenex.cl/";
                            $wsload=[
                                'messaging_product' => 'whatsapp',
                                "preview_url"=> false,
                                'to'=>'56939245158',

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

                            Http::withToken($token)->post('https://graph.facebook.com/'.$version.'/'.$phoneid.'/messages',$wsload)->throw()->json();
                        }
                    }

                }
            }

        }


        return view('productors.subir-proceso')->with('info','Archivo subido con exito');
    }

    public function proceso_upload_anterior(Request $request)
    {

        $file = $request->file('file');
        //obtener Nombre del archivo
        $name = $file->getClientOriginalName();

        //Con dicho nombre, encontrar el proceso correspondiente al archivo
        $proceso=Proceso::where('n_proceso',explode("-",$name)[0])->where('temporada','anterior')->first();


        if($proceso){
            //si existe el proceso, guardar el archivo, si no existe, no lo guarda
            $nombre = $request->file('file')->storeAs(
                'pdf-procesos', $name
            );
            //una vez guardado el archivo, se asocia al proceso
            $proceso->update([
                'informe'=>$nombre
            ]);
            //luego se busca al productor que tiene el nombre de la agricola del proceso
            $user=User::where('name',$proceso->agricola)->first();


            if(!is_null($user)){
                if($user->emnotification==TRUE){
                    //en caso que exista el usuarioo consultar si tiene telefonos registrados
                        if($user->telefonos->count()){
                            foreach($user->telefonos as $telefono){
                            $fono='569'.substr(str_replace(' ', '', $telefono->numero), -8);
                            //TOKEN QUE NOS DA FACEBOOK
                            $token = env('WS_TOKEN');
                            $phoneid= env('WS_PHONEID');
                            $link= 'https://appgreenex.cl/download/'.$proceso->id.'.pdf';
                            $version='v16.0';
                            $url="https://appgreenex.cl/";
                            $payload=[
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

                            $token = env('WS_TOKEN');
                            $phoneid= env('WS_PHONEID');
                            $link= 'https://appgreenex.cl/download/'.$proceso->id.'.pdf';
                            $version='v16.0';
                            $url="https://appgreenex.cl/";
                            $wsload=[
                                'messaging_product' => 'whatsapp',
                                "preview_url"=> false,
                                'to'=>'56939245158',

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

                            Http::withToken($token)->post('https://graph.facebook.com/'.$version.'/'.$phoneid.'/messages',$wsload)->throw()->json();

                        }
                    }
                }
            }

        }


        return view('productors.subir-proceso')->with('info','Archivo subido con exito');
    }
    public function recepcion_upload(Request $request)
    {

        $file = $request->file('file');
        //obtener Nombre del archivo
        $name = $file->getClientOriginalName();

        //Con dicho nombre, encontrar el proceso correspondiente al archivo
        $recepcion=Recepcion::where('numero_g_recepcion',explode("-",$name)[0])->where('temporada','actual')->first();


        if($recepcion){
            //si existe el proceso, guardar el archivo, si no existe, no lo guarda
            $nombre = $request->file('file')->storeAs(
                'pdf-recepciones', $name
            );
            //una vez guardado el archivo, se asocia al proceso
            $recepcion->update([
                'informe'=>$nombre
            ]);

            $recepcion->n_estado='CERRADO';
            $recepcion->save();
            //luego se busca al productor que tiene el nombre de la agricola del proceso
            /*
            $user=User::where('name',$recepcion->n_emisor)->first();
            if($user){
                //en caso que exista el usuarioo consultar si tiene telefonos registrados
                if($user->telefonos->count()){
                    foreach($user->telefonos as $telefono){
                        $fono='569'.substr(str_replace(' ', '', $telefono->numero), -8);
                        //TOKEN QUE NOS DA FACEBOOK
                        $token = env('WS_TOKEN');
                        $phoneid= env('WS_PHONEID');
                        $link= 'https://appgreenex.cl/download/'.$proceso->id.'.pdf';
                        $version='v16.0';
                        $url="https://appgreenex.cl/";
                        $payload=[
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
                    }
                }
            }*/
        }


        return view('productors.subir-recepciones')->with('info','Archivo subido con exito');
    }

    public function download_proceso(Proceso $proceso) {

        return response()->download(storage_path('app/'.$proceso->informe));
    }



    public function download_proceso_user(User $user){

        return Excel::download(new ProcesosExport($user->id),'Procesos '.$user->name.'.xlsx');
    }



    public function descargarInformes() {
        $procesos = Proceso::whereNotNull('informe')->where('temporada','actual')->get(); // Suponiendo que Proceso es el nombre de tu modelo
        $zipFileName = 'informes_de_procesos_all.zip';
        $zip = new ZipArchive;
        $zip->open(storage_path('app/'.$zipFileName), ZipArchive::CREATE | ZipArchive::OVERWRITE);

        foreach ($procesos as $proceso) {
            $rutaInforme = $proceso->informe;
            $nombreArchivo = basename($rutaInforme); // Obtiene el nombre del archivo PDF

            // Verifica si el archivo existe en el almacenamiento
            if (Storage::exists($rutaInforme)) {
                // Agrega el archivo al archivo ZIP
                $zip->addFile(storage_path('app/'.$rutaInforme), $nombreArchivo);
            }
        }

        $zip->close();

        // Descarga el archivo ZIP y envía la respuesta al cliente
        return response()->download(storage_path('app/'.$zipFileName))->deleteFileAfterSend();
    }

    public function descargarInformespecies(Especie $especie) {
        $procesos = Proceso::whereNotNull('informe')->where('temporada','actual')->where('especie',$especie->name)->get(); // Suponiendo que Proceso es el nombre de tu modelo
        $zipFileName = 'Infomes_de_proceso_'.$especie->name.'.zip';
        $zip = new ZipArchive;
        $zip->open(storage_path('app/'.$zipFileName), ZipArchive::CREATE | ZipArchive::OVERWRITE);

        foreach ($procesos as $proceso) {
            $rutaInforme = $proceso->informe;
            $nombreArchivo = basename($rutaInforme); // Obtiene el nombre del archivo PDF

            // Verifica si el archivo existe en el almacenamiento
            if (Storage::exists($rutaInforme)) {
                // Agrega el archivo al archivo ZIP
                $zip->addFile(storage_path('app/'.$rutaInforme), $nombreArchivo);
            }
        }

        $zip->close();

        // Descarga el archivo ZIP y envía la respuesta al cliente
        return response()->download(storage_path('app/'.$zipFileName))->deleteFileAfterSend();
    }

    public function descargarInformevariedad(Variedad $variedad) {
        $procesos = Proceso::whereNotNull('informe')->where('temporada','actual')->where('variedad',$variedad->name)->get(); // Suponiendo que Proceso es el nombre de tu modelo
        $zipFileName = 'Infomes_de_proceso_'.$variedad->name.'.zip';
        $zip = new ZipArchive;
        $zip->open(storage_path('app/'.$zipFileName), ZipArchive::CREATE | ZipArchive::OVERWRITE);

        foreach ($procesos as $proceso) {
            $rutaInforme = $proceso->informe;
            $nombreArchivo = basename($rutaInforme); // Obtiene el nombre del archivo PDF

            // Verifica si el archivo existe en el almacenamiento
            if (Storage::exists($rutaInforme)) {
                // Agrega el archivo al archivo ZIP
                $zip->addFile(storage_path('app/'.$rutaInforme), $nombreArchivo);
            }
        }

        $zip->close();

        // Descarga el archivo ZIP y envía la respuesta al cliente
        return response()->download(storage_path('app/'.$zipFileName))->deleteFileAfterSend();
    }

    public function descargarInformeusers(User $user) {
        $procesos = Proceso::whereNotNull('informe')->where('temporada','actual')->where('agricola',$user->name)->get(); // Suponiendo que Proceso es el nombre de tu modelo
        $zipFileName = 'Infomes_de_proceso_'.$user->name.'.zip';
        $zip = new ZipArchive;
        $zip->open(storage_path('app/'.$zipFileName), ZipArchive::CREATE | ZipArchive::OVERWRITE);

        foreach ($procesos as $proceso) {
            $rutaInforme = $proceso->informe;
            $nombreArchivo = basename($rutaInforme); // Obtiene el nombre del archivo PDF

            // Verifica si el archivo existe en el almacenamiento
            if (Storage::exists($rutaInforme)) {
                // Agrega el archivo al archivo ZIP
                $zip->addFile(storage_path('app/'.$rutaInforme), $nombreArchivo);
            }
        }

        $zip->close();

        // Descarga el archivo ZIP y envía la respuesta al cliente
        return response()->download(storage_path('app/'.$zipFileName))->deleteFileAfterSend();
    }



    public function proceso_destroy(Proceso $proceso) {

        Storage::delete($proceso->informe);
        $proceso->update([
            'informe'=>NULL
        ]);


        return redirect()->back();
    }

    public function procesos()
    {    $estadistica = Estadisticas::create([
            'type'=> 'vistaprocesoadmin',
            'user_id'=>auth()->user()->id
        ]);
        return view('productors.procesos');
    }

    public function procesos_anterior()
    {    $estadistica = Estadisticas::create([
            'type'=> 'vistaprocesoadminanterior',
            'user_id'=>auth()->user()->id
        ]);
        return view('productors.procesosanterior');
    }


    //Sincrinización proceso temporada "Actual"
    public function sync_proces()
    {   $fechaActual = new DateTime();

        // Restar 5 días a la fecha actual
        $fechaActual->modify('-3 days');

        // Formatear la fecha para mostrarla


        $procesos=Http::post('https://api.greenexweb.cl/api/DatosProduccion');
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
            $c_productor=Null;

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
                if($m==9){
                    $c_productor=$item;
                }

               if($m==9){

                        $cont=Proceso::where('n_proceso',$n_proceso)->where('temporada','actual')->first();
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
                                     'temporada' => 'actual',//9,
                                     'c_productor'=>$c_productor
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
                                     'temporada' => 'actual',//9,
                                     'c_productor'=>$c_productor
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
                                     'temporada' => 'actual',//9,
                                     'c_productor'=>$c_productor
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
                                     'temporada' => 'actual',//9,
                                     'c_productor'=>$c_productor
                                ])->save();
                            }

                        }else{


                                if($kilos_netos>0){
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
                                             'temporada' => 'actual',//9,
                                             'c_productor'=>$c_productor
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
                                             'temporada' => 'actual',//9,
                                             'c_productor'=>$c_productor
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
                                             'temporada' => 'actual',//9,
                                             'c_productor'=>$c_productor
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
                                                 'temporada' => 'actual',//9,
                                                 'c_productor'=>$c_productor
                                            ]);

                                    }
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

     //Sincrinización proceso temporada "Actual"
     public function sync_proces_anterior()
     {
         $procesos=Http::post('https://api.greenexweb.cl/api/TemporadasPacking/9/DatosProduccion');
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

                         $cont=Proceso::where('n_proceso',$n_proceso)->where('temporada','anterior')->first();
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
                                      'temporada' => 'anterior'//9
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
                                      'temporada' => 'anterior'//9
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
                                      'temporada' => 'anterior'//9
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
                                      'temporada' => 'anterior'//9
                                 ])->save();
                             }

                         }else{


                                 if($kilos_netos>0){
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
                                              'temporada' => 'anterior'//9
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
                                              'temporada' => 'anterior'//9
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
                                              'temporada' => 'anterior'//9
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
                                                  'temporada' => 'anterior'//9
                                             ]);

                                     }
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

    public function sync_consolidado()
    {   $users=User::all();
        foreach ($users as $user){

            $procesos=Proceso::where('agricola',$user->name)->latest('n_proceso')->get();

            $kilos_netos=0;
            $exportacion=0;
            $comercial=0;
            $desecho=0;
            $merma=0;

            foreach ($procesos as $proceso){

                $kilos_netos+=$proceso->kilos_netos;
                $exportacion+=$proceso->exp;
                $comercial+=$proceso->comercial;
                $desecho=+$proceso->desecho;
                $merma+=($proceso->kilos_netos-$proceso->exp-$proceso->comercial-$proceso->desecho);

            }

            $user->update(['kilos_netos'=>$kilos_netos,
                            'comercial'=>$comercial,
                            'desecho'=>$desecho,
                            'merma'=>$merma,
                            'exp'=>$exportacion]);
        }


        return redirect()->route('productors.index');

    }

    public function dashboard () {
        $users=User::all();




        return view('dashboard',compact('users'));
    }

    public function dashboard_especie (Especie $especie) {
        $users=User::all();


        return view('dashboardespecie',compact('users','especie'));
    }

    public function dashboard_variedad (Variedad $variedad) {
        $users=User::all();
        return view('dashboardvariedad',compact('users','variedad'));
    }

    public function dashboard_productor (User $user) {
        $users=User::all();
        return view('dashboard',compact('users','user'));
    }

    public function downloadpdf(Recepcion $recepcion) {

        return response()->download(storage_path('app/'.$recepcion->informe));

    }
    //PERAS // MANZANAS //CEREZAS //DAGEN
    public function distribucion_calibre(Recepcion $recepcion) {

        return view('pdf.distribucion_calibre',compact('recepcion'));
    }
    //PERAS // MANZANAS //CEREZAS //DAGEN
    public function distribucion_color(Recepcion $recepcion) {
        return view('pdf.distribucion_color',compact('recepcion'));
    }

    //
    //PERAS // MANZANAS //CEREZAS //DAGEN
    public function firmeza_grande(Recepcion $recepcion) {
        return view('pdf.firmeza_grande',compact('recepcion'));
    }
    //PERAS // MANZANAS //CEREZAS //DAGEN
    public function firmeza_mediano(Recepcion $recepcion) {
        return view('pdf.firmeza_mediana',compact('recepcion'));
    }
    //PERAS // MANZANAS //CEREZAS //DAGEN
    public function firmeza_chico(Recepcion $recepcion) {
        return view('pdf.firmeza_chica',compact('recepcion'));
    }
    //

    //CEREZAS //DAGEN
    public function promedio_firmeza(Recepcion $recepcion) {

        return view('pdf.promedio_firmeza',compact('recepcion'));
    }
     //NARANJAS
     public function calibre_brix(Recepcion $recepcion) {

        return view('pdf.calibre_brix',compact('recepcion'));
    }
    //CEREZAS //DAGEN
    public function promedio_brix(Recepcion $recepcion) {

        return view('pdf.promedio_brix',compact('recepcion'));
    }
    //CEREZAS //DAGEN
    public function porcentaje_firmeza(Recepcion $recepcion) {
        //$firmpro=Http::post('https://apigarate.azurewebsites.net/api/v1.0/Recepcion/BuscarRecepcionCloud?Numero_recepcion='.$recepcion->numero_g_recepcion);

        //$firmpro = $firmpro->json();

        return view('pdf.porcentaje_firmeza',compact('recepcion'));
    }
    //PERAS // MANZANAS //CEREZAS //DAGEN
    public function distribucion_color_fondo(Recepcion $recepcion) {

        return view('pdf.distribucion_color_fondo',compact('recepcion'));
    }

    public function observacion_externa(Recepcion $recepcion) {

        return view('calidad.observacionext',compact('recepcion'));
    }

    public function documentacion() {

        return view('admin.documentacion');
    }

    public function contacto() {
        $soportes=Soporte::all();
        return view('admin.soporte',compact('soportes'));
    }

    public function estadisticas() {

        $estadisticas=Estadisticas::all();
        $e1=null;
        foreach($estadisticas as $estadistica){
            if($e1){
                $fecha_e1 = new DateTime($e1->created_at);
                $fecha_item = new DateTime($estadistica->created_at);

                $intervalo = $fecha_e1->diff($fecha_item);

                if($intervalo->s<10 && $e1->type==$estadistica->type){
                    $e1->delete();
                }
            }

            $e1=$estadistica;
        }

        $sus30=Estadisticas::where('created_at', '>=', now()->subDays(30))->get();
        $sustot=Estadisticas::all();

        // Obtén la fecha actual
       $estadistica_types=Estadistica_type::all();


        return view('admin.estadisticas',compact('sus30','sustot','estadistica_types'));
    }

    public function estadistica_type(Estadistica_type $estadistica_type) {



        $estadisticas=Estadisticas::where('type',$estadistica_type->search)->paginate(50);
        $usuarios = Estadisticas::selectRaw('user_id, COUNT(*) as repeticiones')
        ->where('type', $estadistica_type->search)
        ->groupBy('user_id')
        ->get();


        return view('admin.estadistica_type',compact('estadisticas','estadistica_type','usuarios'));
    }

    public function user_create() {

        return view('admin.users.create');
    }

    public function listado_agronomos() {

        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'Agrónomo');
        })->get();

        $campos2=CampoStaff::all();

        $uniqueUsers = User::select('*')
                    ->whereIn('id', function ($query) {
                        $query->selectRaw('MIN(id)')
                              ->from('users')
                              ->groupBy('rut');
                    })
                    ->get();

        return view('admin.agronomos.index',compact('users','campos2','uniqueUsers'));
    }

    public function agronomo_show(User $user) {

        $campos=CampoStaff::where('campo_rut',$user->rut)->get();

        return view('admin.agronomos.show',compact('user','campos'));
    }

    public function productor_index(User $user) {
        $campos=CampoStaff::all();
        foreach ($campos as $campo){
            if(IS_NULL($campo->campo_rut)){
                $campo->update(['campo_rut'=>$campo->user->rut]);
            }
        }

        $campos=CampoStaff::where('agronomo_id',$user->id)->get();

        $campos2=CampoStaff::where('agronomo_id',$user->id)->pluck('campo_rut');

        $uniqueUsers = User::select('*')
                    ->whereIn('id', function ($query) {
                        $query->selectRaw('MIN(id)')
                              ->from('users')
                              ->groupBy('rut');
                    })
                    ->get();


        return view('admin.agronomos.showindex',compact('user','campos','campos2','uniqueUsers'));
    }

    public function productor_edit(User $user)
    {   $certificacions=Certificacion::where('rut',$user->rut)->get();
        $especies=Especie::all()->pluck('name','id');
        $variedades=Variedad::all()->pluck('name','id');
       $tipodocumentacions=TipoDocumentacions::where('estado',1)->with('especie','pais')->get();
        //$documentacion=TipoDocumentacions::where('estado',1)->with('especie','pais')->has('Documentacions')->where('user_id',$user->id)->get();
        $documentacion=Documentacions::where('user_id',$user->id)->with(['TipoDocumentacion','TipoDocumentacion.especie', 'TipoDocumentacion.pais'])->get();

        return view('admin.agronomos.editproductor',compact('user','certificacions','especies','variedades','documentacion','tipodocumentacions'));
    }




    public function user_store(Request $request) {

        if($request['password']==$request['password_confirmation']){
            User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
            ]);

            return redirect()->back()->with('info','El usuario fue creado con éxito.');
        }else{
            return redirect()->back()->with('fail','La Contraseña no coincide');
        }

    }

    public function detalle_update(Calidad $calidad, Request $request) {
        $calidad->update([
            'obs_ext'=>$request->obs_ext
        ]);

        return redirect()->back()->with('info','La observación fue agregada con éxito.');
    }

    public function viewpdf(Recepcion $recepcion) {

        $distribucion_calibre='https://v1.nocodeapi.com/greenex/screen/CbrYLdYsupiNNAot/screenshot?url=https://appgreenex.cl/calibre/'.$recepcion->id.'.html&viewport=800x300';
        $distribucion_color='https://v1.nocodeapi.com/greenex/screen/CbrYLdYsupiNNAot/screenshot?url=https://appgreenex.cl/color/'.$recepcion->id.'.html&delay=5&viewport=800x400';
        if ($recepcion->calidad->detalles->where('tipo_item','COLOR DE FONDO')->count()) {
            $distribucion_color_fondo='https://v1.nocodeapi.com/greenex/screen/CbrYLdYsupiNNAot/screenshot?url=https://appgreenex.cl/color/fondo/'.$recepcion->id.'.html&delay=1&viewport=800x400';
        }else{
            $distribucion_color_fondo=NULL;
        }

        if ($recepcion->n_especie!='Orange' || $recepcion->n_especie=="Cherries") {
            $firmezas_grande='https://v1.nocodeapi.com/greenex/screen/CbrYLdYsupiNNAot/screenshot?url=https://appgreenex.cl/firmeza/grande/'.$recepcion->id.'.html&viewport=800x220';
            $firmezas_mediana='https://v1.nocodeapi.com/greenex/screen/CbrYLdYsupiNNAot/screenshot?url=https://appgreenex.cl/firmeza/mediana/'.$recepcion->id.'.html&viewport=800x220';
            $firmezas_chica='https://v1.nocodeapi.com/greenex/screen/CbrYLdYsupiNNAot/screenshot?url=https://appgreenex.cl/firmeza/chica/'.$recepcion->id.'.html&viewport=800x220';
        }else{
            $firmezas_grande=NULL;
            $firmezas_mediana=NULL;
            $firmezas_chica=NULL;
        }

        if ($recepcion->n_especie=="Cherries" || $recepcion->n_variedad=='Dagen') {
            $distribucion_calibre='https://v1.nocodeapi.com/greenex/screen/CbrYLdYsupiNNAot/screenshot?url=https://appgreenex.cl/calibre/'.$recepcion->id.'.html&viewport=800x380';
            $promedio_firmeza='https://v1.nocodeapi.com/greenex/screen/CbrYLdYsupiNNAot/screenshot?url=https://appgreenex.cl/firmeza/'.$recepcion->id.'.html&viewport=800x400';
            $promedio_brix='https://v1.nocodeapi.com/greenex/screen/CbrYLdYsupiNNAot/screenshot?url=https://appgreenex.cl/brix/'.$recepcion->id.'.html&viewport=800x400';
            $porcentaje_firmeza='https://v1.nocodeapi.com/greenex/screen/CbrYLdYsupiNNAot/screenshot?url=https://appgreenex.cl/porcentaje/firmeza/'.$recepcion->id.'.html&viewport=800x330';
        }else{
            $promedio_firmeza=NULL;
            $promedio_brix=NULL;
            $porcentaje_firmeza=NULL;
        }
        if ($recepcion->n_especie=='Orange'  || $recepcion->n_especie=='Mandarinas') {
            $calibrix='https://v1.nocodeapi.com/greenex/screen/CbrYLdYsupiNNAot/screenshot?url=https://appgreenex.cl/calibrix/'.$recepcion->id.'.html&viewport=800x380';
        }else{
            $calibrix=NULL;
        }
        //view()->share('productors.informe',$recepcion,$distribucion_calibre);
        $user=User::where('name',$recepcion->n_emisor)->first();

        $presiones=Valor::where('parametro_id',16)->where('especie',$recepcion->n_especie)->orderby('id','ASC')->get();
        $almidons=Valor::where('parametro_id',8)->where('especie',$recepcion->n_especie)->orderby('id','ASC')->get();

         $pdf = PDF::loadView('productors.informe', ['recepcion' => $recepcion,
                                                     'distribucion_calibre'=>$distribucion_calibre,
                                                     'distribucion_color'=>$distribucion_color,
                                                    'distribucion_color_fondo'=> $distribucion_color_fondo,
                                                    'firmezas_grande'=>$firmezas_grande,
                                                    'firmezas_mediana'=>$firmezas_mediana,
                                                    'firmezas_chica'=>$firmezas_chica,
                                                    'presiones'=>$presiones,
                                                    'promedio_firmeza'=>$promedio_firmeza,
                                                    'promedio_brix'=>$promedio_brix,
                                                    'porcentaje_firmeza'=>$porcentaje_firmeza,
                                                    'almidons'=>$almidons,
                                                    'calibrix'=>$calibrix,
                                                    'user'=>$user]);

        $pdfContent = $pdf->output();
        $filename = $recepcion->numero_g_recepcion.'-'.$recepcion->id_emisor.'.pdf';

        Storage::put('pdf-recepciones/' . $filename, $pdfContent);

        $recepcion->update([
            'informe'=>'pdf-recepciones/'.$filename
        ]);


         return $pdf->stream($recepcion->numero_g_recepcion.'-'.$recepcion->id_emisor.'.pdf');

         //return view('productors.informe',compact('recepcion','distribucion_calibre'));

    }

    public function production()
    {  $estadistica = Estadisticas::create([
            'type'=> 'vistarecepcionadmin',
            'user_id'=>auth()->user()->id
        ]);

        $recepcions=Recepcion::all();
        return view('productors.production',compact('recepcions'));
    }

    public function productionanterior()
    {  $estadistica = Estadisticas::create([
            'type'=> 'vistarecepcionadminanterior',
            'user_id'=>auth()->user()->id
        ]);

        $recepcions=Recepcion::all();

        return view('productors.productionanterior',compact('recepcions'));
    }

    public function productionpropia()
    {
        //$recepcions = $recepcions->json();
        $estadistica = Estadisticas::create([
            'type'=> 'vistarecepcionproductor',
            'user_id'=>auth()->user()->id
        ]);

        return view('productors.productionpropia');
    }

    public function productionccindex()
    {   $estadistica = Estadisticas::create([
                'type'=> 'recepcioncc',
                'user_id'=>auth()->user()->id
            ]);

        //$recepcions = $recepcions->json();

        return view('productors.productioncc');
    }
    public function productionccindexanterior()
    {
        $estadistica = Estadisticas::create([
                'type'=> 'recepcionccanterior',
                'user_id'=>auth()->user()->id
            ]);

        //$recepcions = $recepcions->json();

        return view('productors.productionccanterior');
    }

    public function productioncc(Recepcion $recepcion)
    {  $estadistica = Estadisticas::create([
            'type'=> 'agregarcc',
            'user_id'=>auth()->user()->id
        ]);
        //$recepcions = $recepcions->json();

        return view('productors.agregarcc',compact('recepcion'));
    }
    public function productionss(Recepcion $recepcion)
    {  $estadistica = Estadisticas::create([
                'type'=> 'agregarss',
                'user_id'=>auth()->user()->id
            ]);
        //$recepcions = $recepcions->json();

        return view('productors.agregarss',compact('recepcion'));
    }

    public function production_refresh()
    {
        $productions=Http::post('https://api.greenexweb.cl/api/ObtenerRecepcion');
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
                if($m==11){
                    $tipo_documento_recepcion=$item;
                }
                if($m==12){
                    $numero_documento_recepcion=$item;
                }
                if($m==13){
                    $n_especie=$item;

                }
                if($m==14){
                    $n_variedad=$item;
                }
                if($m==15){
                    $cantidad=$item;
                }
                if($m==16){
                    $peso_neto=$item;
                }
                if($m==17){
                    $nota_calidad=$item;
                }
               if($m==18){
                    $n_estado=$item;

                        $espec=Especie::where('name',$n_especie)->first();
                        if($espec){
                            $espec->forceFill([
                                'name'=> $n_especie
                            ]);

                            $user=User::where('csg',$Codigo_Sag_emisor)->first();
                            if(!IS_NULL($user)){
                                if($espec->comercializado->contains($user->id)){

                                }else{
                                    $espec->comercializado()->attach($user->id);

                                }
                            }

                            $varie=Variedad::where('name',$n_variedad)->first();
                            if($varie){
                                $varie->forceFill([
                                    'name'=> $n_variedad,
                                    'especie_id='=> $espec->id
                                ]);

                            }else{
                                $varie=Variedad::create([
                                    'name'=> $n_variedad,
                                    'especie_id'=>$espec->id
                                ]);

                            }

                            if(!IS_NULL($user)){
                                if($varie){
                                    if($varie->comercializado->contains($user->id)){

                                    }else{
                                        $varie->comercializado()->attach($user->id);
                                    }
                                }
                            }

                        }else{
                            $especie=Especie::create([
                            'name'=> $n_especie
                            ]);
                            $user=User::where('csg',$Codigo_Sag_emisor)->first();

                            if(!IS_NULL($user)){
                                if($especie->comercializado->contains($user->id)){


                                }else{
                                    $especie->comercializado()->attach($user->id);

                                }
                            }
                            $varie=Variedad::where('name',$n_variedad)->first();
                            if($varie){
                                $varie->forceFill([
                                    'name'=> $n_variedad,
                                    'especie_id='=> $especie->id
                                ]);
                            }else{
                                $varie=Variedad::create([
                                    'name'=> $n_variedad,
                                    'especie_id'=>$especie->id
                                ]);
                            }

                            if(!IS_NULL($user)){
                                if($varie){
                                    if($varie->comercializado->contains($user->id)){

                                    }else{
                                        $varie->comercializado()->attach($user->id);
                                    }
                                }
                            }
                        }

                        $cont=Recepcion::where('id_g_recepcion',$id_g_recepcion)->where('temporada','actual')->first();

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
                                'temporada'=>'actual'

                            ])->save();
                          /*  if(IS_NULL($cont->calidad)){
                                Calidad::create([
                                    'recepcion_id'=>$cont->id
                                ]);
                            }*/
                            }
                        else{

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
                                    'temporada'=>'actual'

                                ]);
                                Calidad::create([
                                    'recepcion_id'=>$rec->id
                                ]);

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

    public function production_refresh_anterior()
    {
        $productions=Http::post('https://api.greenexweb.cl/api/TemporadasPacking/9/ObtenerRecepcion');
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

                                $user=User::where('name',$n_emisor)->first();

                            if(!IS_NULL($user)){
                                if($espec->comercializado->contains($user->id)){

                                }else{
                                    $espec->comercializado()->attach($user->id);

                                }
                            }

                            $varie=Variedad::where('name',$n_variedad)->first();
                            if($varie){
                                $varie->forceFill([
                                    'name'=> $n_variedad,
                                    'especie_id='=> $espec->id
                                ]);

                            }else{
                                $varie=Variedad::create([
                                    'name'=> $n_variedad,
                                    'especie_id'=>$espec->id
                                ]);

                            }

                            if(!IS_NULL($user)){
                                if($varie){
                                    if($varie->comercializado->contains($user->id)){

                                    }else{
                                        $varie->comercializado()->attach($user->id);
                                    }
                                }
                            }

                        }else{
                            $especie=Especie::create([
                            'name'=> $n_especie
                            ]);
                            $user=User::where('name',$n_emisor)->first();
                            if(!IS_NULL($user)){
                                if($especie->comercializado->contains($user->id)){


                                }else{
                                    $especie->comercializado()->attach($user->id);

                                }
                            }
                            $varie=Variedad::where('name',$n_variedad)->first();
                            if($varie){
                                $varie->forceFill([
                                    'name'=> $n_variedad,
                                    'especie_id='=> $especie->id
                                ]);
                            }else{
                                $varie=Variedad::create([
                                    'name'=> $n_variedad,
                                    'especie_id'=>$especie->id
                                ]);
                            }

                            if(!IS_NULL($user)){
                                if($varie){
                                    if($varie->comercializado->contains($user->id)){

                                    }else{
                                        $varie->comercializado()->attach($user->id);
                                    }
                                }
                            }
                        }

                        $cont=Recepcion::where('id_g_recepcion',$id_g_recepcion)->where('temporada','anterior')->first();

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
                                'temporada'=>'anterior'

                            ])->save();
                          /*  if(IS_NULL($cont->calidad)){
                                Calidad::create([
                                    'recepcion_id'=>$cont->id
                                ]);
                            }*/
                            }
                        else{

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
                                    'temporada'=>'anterior'

                                ]);
                                Calidad::create([
                                    'recepcion_id'=>$rec->id
                                ]);

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

        $users= Http::post('https://api.greenexweb.cl/api/ObtenerProductor');

        $users = $users->json();

        $ri=User::all();
        $totali=$ri->count();


        foreach ($users as $user){
            $id=null;
            $nombre=null;
            $rut=null;
            $csg=null;
            $us=null;
            $predio=null;
            $comuna=null;
            $provincia=null;
            $direccion=null;

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


                if($m==8){
                    $predio=$item;
                }
                if($m==10){
                    $comuna=$item;
                }
                if($m==12){
                    $provincia=$item;
                }
                if($m==9){
                    $direccion=$item;
                }


                if($m==14){
                    $cont=User::where('csg',$csg)->first();
                    $search=['.','-'];
                    if($cont){
                         $cont->forceFill([
                            'name' => $nombre,
                            'idprod' => $id,
                            'csg' => $csg,
                            'user' => 'gre-'.str_replace($search, '', $us),
                            'rut' => $rut,
                            'predio'=>$predio,
                            'comuna'=>$comuna,
                            'provincia'=>$provincia,
                            'direccion'=>$direccion
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
                            'predio'=>$predio,
                            'comuna'=>$comuna,
                            'provincia'=>$provincia,
                            'direccion'=>$direccion,
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

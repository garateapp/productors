<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\CreateNewUser;
use App\Models\Calidad;
use App\Models\Detalle;
use App\Models\Especie;
use App\Models\Proceso;
use App\Models\Recepcion;
use App\Models\Sync;
use App\Models\User;
use App\Models\Valor;
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
use ConsoleTVs\Charts\Facades\Charts;
use Illuminate\Support\Facades\Validator;
use Laravel\Jetstream\Jetstream;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class HomeController extends Controller
{
    public function index()
    {
        return view('productors.index');
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

    public function proceso_upload(Request $request)
    {   
    
        $file = $request->file('file');
        //obtener Nombre del archivo
        $name = $file->getClientOriginalName();
        
        //Con dicho nombre, encontrar el proceso correspondiente al archivo
        $proceso=Proceso::where('n_proceso',explode("-",$name)[0])->first();
        

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
        }
    }


        return view('productors.subir-proceso')->with('info','Archivo subido con exito');
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
                if($m==9){
                    $estado=$item;
                }
               if($m==9){

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
                            
                            if($estado=='Finalizado'){
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
        /*
        $distribucion_calibre='https://v1.nocodeapi.com/greenex/screen/CbrYLdYsupiNNAot/screenshot?url=https://appgreenex.cl/calibre/'.$recepcion->id.'.html&viewport=800x300';
        $distribucion_color='https://v1.nocodeapi.com/greenex/screen/CbrYLdYsupiNNAot/screenshot?url=https://appgreenex.cl/color/'.$recepcion->id.'.html&viewport=800x400';
        $distribucion_color_fondo='https://v1.nocodeapi.com/greenex/screen/CbrYLdYsupiNNAot/screenshot?url=https://appgreenex.cl/color/fondo/'.$recepcion->id.'.html&viewport=800x400';
        
        $firmezas_grande='https://v1.nocodeapi.com/greenex/screen/CbrYLdYsupiNNAot/screenshot?url=https://appgreenex.cl/firmeza/grande/'.$recepcion->id.'.html&viewport=800x220';
        $firmezas_mediana='https://v1.nocodeapi.com/greenex/screen/CbrYLdYsupiNNAot/screenshot?url=https://appgreenex.cl/firmeza/mediana/'.$recepcion->id.'.html&viewport=800x220';
        $firmezas_chica='https://v1.nocodeapi.com/greenex/screen/CbrYLdYsupiNNAot/screenshot?url=https://appgreenex.cl/firmeza/chica/'.$recepcion->id.'.html&viewport=800x220';

        view()->share('productors.informe',$recepcion);
 
        $pdf = PDF::loadView('productors.informe', ['recepcion' => $recepcion,
                                    'distribucion_calibre'=>$distribucion_calibre,
                                    'distribucion_color'=>$distribucion_color,
                                    'distribucion_color_fondo'=> $distribucion_color_fondo,
                                    'firmezas_grande'=>$firmezas_grande,
                                    'firmezas_mediana'=>$firmezas_mediana,
                                    'firmezas_chica'=>$firmezas_chica]);
 
         return $pdf->download($recepcion->numero_g_recepcion.'-'.$recepcion->id_emisor.'.pdf');*/
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
    //CEREZAS //DAGEN
    public function promedio_brix(Recepcion $recepcion) {

        return view('pdf.promedio_brix',compact('recepcion'));
    }
    //CEREZAS //DAGEN
    public function porcentaje_firmeza(Recepcion $recepcion) {
        $firmpro=Http::post('https://apigarate.azurewebsites.net/api/v1.0/Recepcion/BuscarRecepcionCloud?Numero_recepcion='.$recepcion->numero_g_recepcion);
        $firmpro = $firmpro->json();

        return view('pdf.porcentaje_firmeza',compact('recepcion','firmpro'));
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

    public function user_create() {

        return view('admin.users.create');
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
           
        $firmezas_grande='https://v1.nocodeapi.com/greenex/screen/CbrYLdYsupiNNAot/screenshot?url=https://appgreenex.cl/firmeza/grande/'.$recepcion->id.'.html&viewport=800x220';
        $firmezas_mediana='https://v1.nocodeapi.com/greenex/screen/CbrYLdYsupiNNAot/screenshot?url=https://appgreenex.cl/firmeza/mediana/'.$recepcion->id.'.html&viewport=800x220';
        $firmezas_chica='https://v1.nocodeapi.com/greenex/screen/CbrYLdYsupiNNAot/screenshot?url=https://appgreenex.cl/firmeza/chica/'.$recepcion->id.'.html&viewport=800x220';

        if ($recepcion->n_especie=="Cherries") {
            $distribucion_calibre='https://v1.nocodeapi.com/greenex/screen/CbrYLdYsupiNNAot/screenshot?url=https://appgreenex.cl/calibre/'.$recepcion->id.'.html&viewport=800x380';
            $promedio_firmeza='https://v1.nocodeapi.com/greenex/screen/CbrYLdYsupiNNAot/screenshot?url=https://appgreenex.cl/firmeza/'.$recepcion->id.'.html&viewport=800x400';
            $promedio_brix='https://v1.nocodeapi.com/greenex/screen/CbrYLdYsupiNNAot/screenshot?url=https://appgreenex.cl/brix/'.$recepcion->id.'.html&viewport=800x400';
            $porcentaje_firmeza='https://v1.nocodeapi.com/greenex/screen/CbrYLdYsupiNNAot/screenshot?url=https://appgreenex.cl/porcentaje/firmeza/'.$recepcion->id.'.html&viewport=800x330';
        }else{
            $promedio_firmeza=NULL;
            $promedio_brix=NULL;
            $porcentaje_firmeza=NULL;
        }
        //view()->share('productors.informe',$recepcion,$distribucion_calibre);
 
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
                                                    'almidons'=>$almidons]);

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
    {  
        $recepcions=Recepcion::all();
        

        return view('productors.production',compact('recepcions'));
    }

    public function productionpropia()
    {  
        //$recepcions = $recepcions->json();

        return view('productors.productionpropia');
    }

    public function productionccindex()
    {  
        //$recepcions = $recepcions->json();

        return view('productors.productioncc');
    }

    public function productioncc(Recepcion $recepcion)
    {  
        //$recepcions = $recepcions->json();

        return view('productors.agregarcc',compact('recepcion'));
    }
    public function productionss(Recepcion $recepcion)
    {  
        //$recepcions = $recepcions->json();

        return view('productors.agregarss',compact('recepcion'));
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
                                'n_estado' => $n_estado
                                
                            ])->save();
                            if(IS_NULL($cont->calidad)){
                                Calidad::create([
                                    'recepcion_id'=>$cont->id
                                ]);
                            }
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
                                    'n_estado' => $n_estado
                                    
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

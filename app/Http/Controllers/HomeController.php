<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\CreateNewUser;
use App\Models\Recepcion;
use App\Models\Sync;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;



class HomeController extends Controller
{
    public function index()
    {        
        $users=User::all();

        return view('productors.index',compact('users'));
    }
    public function dashboard () {
        $users=User::all();
        return view('dashboard',compact('users'));
    }

    public function production()
    {  
        $recepcions=Recepcion::all();
        //$recepcions = $recepcions->json();

        return view('productors.production',compact('recepcions'));
    }

    public function production_refresh()
    {        
        $productions=Http::get('http://api.appgreenex.cl/production');
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
                
                if($m==1){
                    $id_g_recepcion=$item;
                }
                if($m==2){
                    $tipo_g_recepcion=$item;
                }
                if($m==3){
                    $numero_g_recepcion=$item;
                }
                if($m==4){
                    $fecha_g_recepcion=$item;
                }
                if($m==5){
                    $id_emisor=$item;
                }
                if($m==6){
                    $r_emisor=$item;
                }
                if($m==8){
                    $n_emisor=$item;
                }
                if($m==9){
                    $Codigo_Sag_emisor=$item;
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

                    $cont=Recepcion::where('id_g_recepcion',$id_g_recepcion);
                    if($cont->count()>0){
                    //nothing
                    }else{
                        Recepcion::create([
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
        $users= Http::get('http://api.appgreenex.cl/productors');
        
        $users = $users->json();

       
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
                if($m==29){
                    $rut=$item;
                }
                if($m==35){
                    $csg=$item;
                }
               
                if($m==41){
                    $cont=User::where('rut',$rut);
                    if($cont->count()>0){
                    //nothing
                    }else{
                        User::create([
                            'name' => $nombre,
                            'idprod' => $id,
                            'csg' => $csg,
                            'user' => 'gre-'.$us,
                            'rut' => $rut,
                            'password' => Hash::make('gre1234'),
                        ]);
                    }
                }
                $m+=1;
                
            } 
        }

        return redirect()->route('productors.index');


        //return view('productors.index',compact('users'));
    }


}

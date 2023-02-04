<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\CreateNewUser;
use App\Models\User;
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

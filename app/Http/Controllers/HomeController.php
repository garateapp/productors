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
    {          //$productors = json_decode($productors);
        $users=User::all();

        return view('productors.index',compact('users'));
    }

    public function productor_refresh()
    {  
        $users= Http::get('http://api.appgreenex.cl:8080/productors');
        
        $users = $users->json();

        /*
        foreach ($users as $user){
            $m=1;
            foreach ($user as $item){
                
                if($m==1){
                    $id=$item;
                }
                if($m==4){
                    $nombre=$item;
                }
                if($m==29){
                    $rut=$item;
                }
                if($m==41){
                    User::create([
                        'name' => $nombre,
                        'password' => Hash::make('hola123'),
                    ]);
                }
                $m+=1;
                
            } 
        }
*/
        //$users=User::all();


        return view('productors.index',compact('users'));
    }


}

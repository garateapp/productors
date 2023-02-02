<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
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
        $users= Http::get('http://api.appgreenex.cl/productors');
        
        $users = $users->json();

        return view('productors.index',compact('users'));
    }


}

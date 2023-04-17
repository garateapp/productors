<?php

namespace App\Http\Controllers\Productor;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
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
    public function update(Request $request, User $user)
    {   $request->validate([
            'email'=>'email'
        ]);
        
        $user->update($request->all());

        

         //TOKEN QUE NOS DA FACEBOOK
         $token = env('WS_TOKEN');
         $phoneid='100799979656074';
         $version='v16.0';
         $url="https://appgreenex.test/";
         $payload=[
             'messaging_product' => 'whatsapp',
             "preview_url"=> false,
             'to'=>'56963176726',
             
             'type'=>'template',
                 'template'=>[
                     'name'=>'nuevo_pedido',
                     'language'=>[
                         'code'=>'es'],
                     'components'=>[ 
                         [
                             'type'=>'body',
                             'parameters'=>[
                                 [
                                     'type'=>'text',
                                     'text'=> 'JUAN'
                                 ],
                                 [
                                     'type'=>'text',
                                     'text'=> 'DIEGO'
                                 ],
                                 [
                                     'type'=>'text',
                                     'text'=> '$10.000'
                                 ]
                             ]
                         ]
                     ]
                 ]
                 
             
             
             /*
             "text"=>[
                 "body"=> "Buena Rider, Bienvenido al club"
              ]*/
         ];
         
         Http::withToken($token)->post('https://graph.facebook.com/'.$version.'/'.$phoneid.'/messages',$payload)->throw()->json();
 

        return redirect()->back();
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

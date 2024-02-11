<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\support\Str;

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
    public function edit(User $user)
    {   $roles=Role::all();
        return view('admin.users.edit',compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->roles()->sync($request->roles);
        
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

    public function password_rec(User $user){
    
        $user->forceFill([
            'password' => Hash::make('gre1234'),
        ])->save();

         

        return redirect()->back()->with('info','La contraseña de '.$user->name.' fue actualizada con éxito');
    }

    public function logo_create(User $user) {
        
        return view('admin.users.logo',compact('user'));
    }

    public function logo_update(Request $request, User $user)
    {   $request->validate([
            'email'=>'email',
            'profile_photo_path' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->file('profile_photo_path')) {
            $name = Str::random(5) . $request->file('profile_photo_path')->getClientOriginalName();

            $url = $request->file('profile_photo_path')->storeAs(
                'public/profile-photos', $name
            );


            $user->forceFill([
                'profile_photo_path' => 'profile-photos/'.$name
            ]);
        
            $user->save(); // Guardar los cambios en la base de datos
        }


        return redirect()->back();
    }
    
    public function logo_delete(Request $request, User $user)
    {   
       

            $user->forceFill([
                'profile_photo_url' => null
            ]);
        

        return redirect()->back();
    }
}

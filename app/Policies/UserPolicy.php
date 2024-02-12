<?php

namespace App\Policies;

use App\Models\CampoStaff;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function rellenar(User $user, User $user2){
       
        if (CampoStaff::where('user_id', $user->id)->where('agronomo_id',$user2->id)->where('rol','admin')->count()>0){
            return true;
        }else{
            return false;
        }   
    }
}

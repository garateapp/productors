<?php

namespace App\Providers;

use App\Actions\Jetstream\DeleteUser;
use App\Models\Estadisticas;
use Illuminate\Support\ServiceProvider;
use Laravel\Jetstream\Jetstream;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Fortify;

class JetstreamServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->configurePermissions();
        
        Fortify::authenticateUsing(function (Request $request) {
        $user = User::where('email', $request->user)
                    ->orwhere('user', $request->user)->latest()->first();

            if ($user && Hash::check($request->password, $user->password)) {

                $estadistica = Estadisticas::create([
                        'type'=> 'login',
                        'user_id'=>$user->id
                    ]);
                    
                return $user;
                
            }   

            
        });
        

        Jetstream::deleteUsersUsing(DeleteUser::class);
    }

    /**
     * Configure the permissions that are available within the application.
     *
     * @return void
     */
    protected function configurePermissions()
    {
        Jetstream::defaultApiTokenPermissions(['read']);

        Jetstream::permissions([
            'create',
            'read',
            'update',
            'delete',
        ]);
    }
}

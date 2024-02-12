<?php

namespace App\Http\Livewire\Agronomo;

use App\Models\CampoStaff;
use App\Models\User;
use Livewire\Component;

class AsignacionRol extends Component
{
    public $search,$type,$user_id;
    public function mount($type, $user_id){
        $this->type=$type;
        $this->user_id=$user_id;
        
    }
    public function render()
    {
        return view('livewire.agronomo.asignacion-rol');
    }

    public function getUsersProperty(){
        if ($this->type=='Agronomo') {
            return User::where(function($query) {
                $query->where('name','LIKE','%'. $this->search .'%')
                      ->orWhere('email','LIKE','%'. $this->search .'%');
            })
            ->whereDoesntHave('roles', function ($query) {
                $query->where('name', 'Agrónomo');
            })
            ->latest('id')
            ->paginate(3);
        } else {

            $campos = CampoStaff::where('agronomo_id', $this->user_id)->pluck('user_id'); // Obtener los IDs de los usuarios relacionados con CampoStaff

            $users = User::where(function($query) {
                            $query->where('name','LIKE','%'. $this->search .'%')
                                  ->orWhere('email','LIKE','%'. $this->search .'%');
                        })
                        ->whereHas('roles', function ($query) {
                            $query->where('name', 'Productor');
                        })
                        ->whereNotIn('id', $campos) // Excluir los IDs de usuarios relacionados con CampoStaff
                        ->latest('id')
                        ->paginate(3);
            
            return $users;
        } 
    }
    public function storecampo($user_id){
        CampoStaff::create(['user_id'=>$user_id,
                            'agronomo_id'=>$this->user_id,
                            'rol'=>'admin']);
        $user=User::find($this->user_id);
        return redirect(route('agronomo.show',$user));
    }
}

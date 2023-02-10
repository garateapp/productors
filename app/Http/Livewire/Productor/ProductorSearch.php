<?php

namespace App\Http\Livewire\Productor;

use App\Models\Telefono;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ProductorSearch extends Component
{   use WithPagination;

    public $search, $cellid, $phone, $user, $ctd=25;

    public function render()
    {   $users=User::where('rut','LIKE','%'. $this->search .'%')
                ->orwhere('email','LIKE','%'. $this->search .'%')
                ->orwhere('name','LIKE','%'. $this->search .'%')
                ->orwhere('csg','LIKE','%'. $this->search .'%')
                ->orwhere('idprod','LIKE','%'. $this->search .'%')
                ->orwhere('user','LIKE','%'. $this->search .'%')
                ->latest('id')->paginate($this->ctd);
        $allusers=User::all();

        return view('livewire.productor.productor-search',compact('users','allusers'));
    }


    public function limpiar_page(){
        $this->resetPage();
    }

    public function set_iduser($id){
        $this->cellid=$id;
        $this->user=User::find($this->cellid);
    }

    public function cellid_clean(){
        $this->cellid=NULL;
        $this->user=NULL;
    }

    public function storephone(){
        $rules = [
            'phone'=>'required',
        ];
       
        $this->validate ($rules);

        $telefono = Telefono::create([
            'numero'=> $this->phone,
            'user_id'=>$this->cellid
        ]);
        
        $this->reset(['phone']);
        $this->user = User::find($this->cellid);

    }
    public function phone_destroy(Telefono $telefono){
        $telefono->delete();
        $this->user=User::find($this->cellid);
    }

    

}

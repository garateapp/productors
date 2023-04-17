<?php

namespace App\Http\Livewire\Productor;

use App\Models\Sync;
use App\Models\Telefono;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Http;


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
        $sync=Sync::where('entidad','PRODUCTORES')
        ->orderby('id','DESC')
        ->first();

        return view('livewire.productor.productor-search',compact('users','allusers','sync'));
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
        $this->user->ForceFill([
            'updated_at'=> Carbon::now()
        ])->save();
        $this->user = User::find($this->cellid);
       
        $fono='569'.substr(str_replace(' ', '', $telefono->numero), -8);
        //TOKEN QUE NOS DA FACEBOOK
        $token = env('WS_TOKEN');
        $phoneid= env('WS_PHONEID');
        $version='v16.0';
        $url="https://appgreenex.cl/";
        $payload=[
            'messaging_product' => 'whatsapp',
            "preview_url"=> false,
            'to'=>$fono,
            
            'type'=>'template',
                'template'=>[
                    'name'=>'bienvenida',
                    'language'=>[
                        'code'=>'es'],
                    'components'=>[ 
                        [
                            'type'=>'body',
                            'parameters'=>[
                                [
                                    'type'=>'text',
                                    'text'=> $this->user->name
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


    }
    public function phone_destroy(Telefono $telefono){
        $telefono->delete();
        $this->user->ForceFill([
            'updated_at'=> Carbon::now()
        ])->save();
        $this->user=User::find($this->cellid);
    }

    

}

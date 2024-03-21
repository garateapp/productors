<?php

namespace App\Http\Livewire\Productor;

use App\Exports\ProcesosExport;
use App\Models\CampoStaff;
use App\Models\Sync;
use App\Models\Telefono;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;

class ProductorSearch extends Component
{   use WithPagination;

    

    public $search, $cellid, $agronomoid, $phone, $user, $ctd=25; 

    public function render()
    {   $users = User::select(
        'users.id',
        'users.name',
        'users.profile_photo_path',
        'users.rut',
        'users.email',
        'users.csg',
        'users.idprod',
        'users.user',
        'users.kilos_netos',
        'users.comercial',
        'users.desecho',
        'users.merma',
        'users.exp',
        'users.emnotification',
        DB::raw('COUNT(especie_user.id) as especies_comercializadas')
                    )
                    ->leftJoin('especie_user', 'users.id', '=', 'especie_user.user_id')
                    ->where(function ($query) {
                        $query->where('rut', 'LIKE', '%' . $this->search . '%')
                            ->orWhere('email', 'LIKE', '%' . $this->search . '%')
                            ->orWhere('name', 'LIKE', '%' . $this->search . '%')
                            ->orWhere('csg', 'LIKE', '%' . $this->search . '%')
                            ->orWhere('idprod', 'LIKE', '%' . $this->search . '%')
                            ->orWhere('user', 'LIKE', '%' . $this->search . '%');
                    })
                    ->groupBy('users.id', 'users.name','users.profile_photo_path', 'users.rut', 'users.email', 'users.csg', 'users.idprod', 'users.user','users.kilos_netos','users.comercial', 'users.desecho', 'users.merma','users.exp', 'users.emnotification')
                    ->orderByDesc(DB::raw('SUM(users.kilos_netos)'))
                    ->latest('users.id')
                    ->paginate($this->ctd);
    
    
    
        $allusers=User::all();
        $sync=Sync::where('entidad','PRODUCTORES')
        ->orderby('id','DESC')
        ->first();

        return view('livewire.productor.productor-search',compact('users','allusers','sync'));
    }

    

    public function toggleEmailNotification($userId)
    {
        $user = User::find($userId);
        
        if ($user->emnotification==true) {
            $user->update(['emnotification' => false]);
        }else{
            $user->update(['emnotification' => true]);
        }
        
      
    }

    public function limpiar_page(){
        $this->resetPage();
    }

    public function set_iduser($id){
        $this->cellid=$id;
        $this->user=User::find($this->cellid);
    }

    public function set_idagronomo($id){
        $this->agronomoid=$id;
        $this->user=User::find($this->agronomoid);
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
            
        ];
        
        Http::withToken($token)->post('https://graph.facebook.com/'.$version.'/'.$phoneid.'/messages',$payload)->throw()->json();
    
    
    }

    public function agronomodelete(CampoStaff $campostaff){
        $campostaff->delete();
    }

    public function phone_destroy(Telefono $telefono){
        $telefono->delete();
        $this->user->ForceFill([
            'updated_at'=> Carbon::now()
        ])->save();
        $this->user=User::find($this->cellid);
    }

    

}

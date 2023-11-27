<?php

namespace App\Http\Livewire\Productor;

use App\Mail\RecepcionMailable;
use App\Models\Detalle;
use App\Models\Especie;
use App\Models\Recepcion;
use App\Models\Sync;
use App\Models\User;
use App\Models\Variedad;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithPagination;

class ProductionSearch extends Component
{   use WithPagination;
    public $search, $ctd=25, $espec, $especieid, $especiename, $varie, $variedadid, $temporada;
    
    public function mount($temporada){
        $this->temporada=$temporada;
    }

    public function render()
    {   
        $recepcions=Recepcion::where('temporada', $this->temporada) // Agregar esta condición
                ->where(function($query) {
                    $query->where('id_g_recepcion','LIKE','%'. $this->search .'%')
                        ->orwhere('tipo_g_recepcion','LIKE','%'. $this->search .'%')
                        ->orwhere('numero_g_recepcion','LIKE','%'. $this->search .'%')
                        ->orwhere('fecha_g_recepcion','LIKE','%'. $this->search .'%')
                        ->orwhere('id_emisor','LIKE','%'. $this->search .'%')
                        ->orwhere('r_emisor','LIKE','%'. $this->search .'%')
                        ->orwhere('n_emisor','LIKE','%'. $this->search .'%')
                        ->orwhere('Codigo_Sag_emisor','LIKE','%'. $this->search .'%')
                        ->orwhere('tipo_documento_recepcion','LIKE','%'. $this->search .'%')
                        ->orwhere('numero_documento_recepcion','LIKE','%'. $this->search .'%')
                        ->orwhere('n_especie','LIKE','%'. $this->search .'%')
                        ->orwhere('n_variedad','LIKE','%'. $this->search .'%')
                        ->orwhere('n_estado','LIKE','%'. $this->search .'%');
                })
                ->orderby('numero_g_recepcion','desc')
                ->paginate($this->ctd);

                $allsubrecepcions = Recepcion::where('temporada', $this->temporada)
                ->where(function ($query) {
                    $query->where('id_g_recepcion','LIKE','%'. $this->search .'%')
                        ->orWhere('tipo_g_recepcion','LIKE','%'. $this->search .'%')
                        ->orWhere('numero_g_recepcion','LIKE','%'. $this->search .'%')
                        ->orWhere('fecha_g_recepcion','LIKE','%'. $this->search .'%')
                        ->orWhere('id_emisor','LIKE','%'. $this->search .'%')
                        ->orWhere('r_emisor','LIKE','%'. $this->search .'%')
                        ->orWhere('n_emisor','LIKE','%'. $this->search .'%')
                        ->orWhere('Codigo_Sag_emisor','LIKE','%'. $this->search .'%')
                        ->orWhere('tipo_documento_recepcion','LIKE','%'. $this->search .'%')
                        ->orWhere('numero_documento_recepcion','LIKE','%'. $this->search .'%')
                        ->orWhere('n_especie','LIKE','%'. $this->search .'%')
                        ->orWhere('n_variedad','LIKE','%'. $this->search .'%')
                        ->orWhere('n_estado','LIKE','%'. $this->search .'%');
                })
                ->latest('id')
                ->get();
            
        
        $allrecepcions=Recepcion::where('temporada', $this->temporada)->get();
        $sync=Sync::where('entidad','RECEPCIONES')
        ->orderby('id','DESC')
        ->first();
        $especies=Especie::all();
        $variedades=Variedad::all();
        
        return view('livewire.productor.production-search',compact('variedades','especies','recepcions','allrecepcions','allsubrecepcions','sync'));
    }
    public function update_temporada(){
        if($this->temporada=='actual'){
            $this->temporada='anterior';
        }else{
            $this->temporada='actual';
        }
    }

    public function reenviar_informe(Recepcion $recepcion) {
    
        $user=User::where('name',$recepcion->n_emisor)->first();

        if($user->emnotification==TRUE){
            Mail::to($user->email)->send(new RecepcionMailable($recepcion));
        }

        if($user){
            
            if($user->telefonos->count()){
                    foreach($user->telefonos as $telefono){
                        $fono='569'.substr(str_replace(' ', '', $telefono->numero), -8);
                        //TOKEN QUE NOS DA FACEBOOK
                        $token = env('WS_TOKEN');
                        $phoneid= env('WS_PHONEID');
                        $link= 'https://appgreenex.cl/download/recepcion/'.$recepcion->id.'.pdf';
                        $version='v16.0';
                        $url="https://appgreenex.cl/";
                        $payload=[
                            'messaging_product' => 'whatsapp',
                            "preview_url"=> false,
                            'to'=>$fono,
                            
                            'type'=>'template',
                                'template'=>[
                                    'name'=>'recepcion',
                                    'language'=>[
                                        'code'=>'es'],
                                    'components'=>[ 
                                        [
                                            'type'=>'header',
                                            'parameters'=>[
                                                [
                                                    'type'=>'document',
                                                    'document'=> [
                                                        'link'=>$link,
                                                        'filename'=>$recepcion->numero_g_recepcion.'-'.$recepcion->id_emisor.'.pdf'
                                                        ]
                                                ]
                                            ]
                                        ],
                                        [
                                            'type'=>'body',
                                            'parameters'=>[
                                                [
                                                    'type'=>'text',
                                                    'text'=> $recepcion->numero_g_recepcion
                                                ],
                                                [
                                                    'type'=>'text',
                                                    'text'=> $recepcion->n_especie
                                                ]
                                            ]
                                        ]
                                    ]
                                ]
                                
                            
                        ];
                        
                      Http::withToken($token)->post('https://graph.facebook.com/'.$version.'/'.$phoneid.'/messages',$payload)->throw()->json();
                    }
            }    
        }

       return redirect()->route('production.index');
    }
    
    public function set_especie($id){
        $this->especieid=$id;
        $this->variedadid=NULL;
        $this->varie =NULL;
        $this->espec=Especie::find($this->especieid);
        $this->search=$this->espec->name;
        
    }

    public function set_varie($id){
        $this->variedadid=$id;
        $this->varie=Variedad::find($this->variedadid);
        $this->search=$this->varie->name;
    }

    public function limpiar_page(){
        $this->resetPage();
    }

    public function espec_clean(){
        $this->especieid=NULL;
        $this->espec=NULL;
        $this->search=NULL;

    }
    public function varie_clean(){
        $this->variedadid=NULL;
        $this->varie =NULL;
        $this->search=$this->espec->name;

    }
}

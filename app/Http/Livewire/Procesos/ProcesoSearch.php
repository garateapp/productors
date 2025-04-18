<?php

namespace App\Http\Livewire\Procesos;

use App\Exports\ProcesostotalExport;
use App\Mail\NotificacionMailable;
use App\Models\Especie;
use App\Models\Proceso;
use App\Models\Recepcion;
use App\Models\Sync;
use App\Models\User;
use App\Models\Variedad;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;

class ProcesoSearch extends Component
{   use WithPagination;

    public $search, $espec, $ctd=25, $especieid, $especiename, $varie, $variedadid, $titulo='Gráfico por Especies', $temporada;

    public function mount($temporada){
        $this->temporada=$temporada;
    }

    public function render()
    {


        if($this->espec){
            if($this->varie){
                $procesos=Proceso::where('variedad','LIKE', $this->varie->name)
                            ->orderBy('n_proceso', 'asc') // Ordenar por ID de forma ascendente
                            ->paginate($this->ctd);
            }else{
                    $procesos=Proceso::where('especie',$this->espec->name)
                            ->orderBy('n_proceso', 'asc') // Ordenar por ID de forma ascendente
                            ->paginate($this->ctd);
            }

        }else{
            $procesos = Proceso::where('temporada', $this->temporada)
                        ->where(function($query) {
                            $query->where('agricola', 'LIKE', '%' . $this->search . '%')
                                ->orWhere('n_proceso', 'LIKE', '%' . $this->search . '%')
                                ->orWhere('especie', 'LIKE', '%' . $this->search . '%')
                                ->orWhere('variedad', 'LIKE', '%' . $this->search . '%')
                                ->orWhere('fecha', 'LIKE', '%' . $this->search . '%')
                                ->orWhere('id_empresa', 'LIKE', '%' . $this->search . '%');
                        })
                        ->orderBy('n_proceso', 'desc')
                        ->paginate($this->ctd);

        }

        $procesosall = Proceso::where('temporada', $this->temporada)->get();


        $especies=Especie::where('id','>=',1)->latest('id')->get();
        $variedades=Variedad::all();

        $sync=Sync::where('entidad','PROCESOS')
        ->orderby('id','DESC')
        ->first();

        return view('livewire.procesos.proceso-search',compact('sync','procesosall','procesos','variedades','especies'));
    }

    public function generateReport(){
        return Excel::download(new ProcesostotalExport($this->espec),'Procesos_total'.'.xlsx');
    }

    public function reenviar_informe(Proceso $proceso) {



        if($proceso){
            //si existe el proceso, guardar el archivo, si no existe, no lo guarda

            //luego se busca al productor que tiene el nombre de la agricola del proceso
            $user=User::where('name',$proceso->agricola)->first();

            if($user->emnotification==TRUE){
                if($user->email){
                    Mail::to($user->email)->send(new NotificacionMailable($proceso));
                }
            }

            if($user){
                    //en caso que exista el usuarioo consultar si tiene telefonos registrados
                    if($user->telefonos->count()){
                        foreach($user->telefonos as $telefono){
                        $fono='569'.substr(str_replace(' ', '', $telefono->numero), -8);
                        //TOKEN QUE NOS DA FACEBOOK
                        $token = env('WS_TOKEN');
                        $phoneid= env('WS_PHONEID');
                        $link= 'https://appgreenex.cl/download/'.$proceso->id.'.pdf';
                        $version='v16.0';
                        $url="https://appgreenex.cl/";
                        $payload=[
                            'messaging_product' => 'whatsapp',
                            "preview_url"=> false,
                            'to'=>$fono,

                            'type'=>'template',
                                'template'=>[
                                    'name'=>'proceso',
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
                                                        'filename'=>$proceso->informe
                                                        ]
                                                ]
                                            ]
                                        ],
                                        [
                                            'type'=>'body',
                                            'parameters'=>[
                                                [
                                                    'type'=>'text',
                                                    'text'=> $proceso->n_proceso
                                                ]
                                            ]
                                        ]
                                    ]
                                ]


                        ];

                       $resp=Http::withToken($token)->post('https://graph.facebook.com/'.$version.'/'.$phoneid.'/messages',$payload)->throw()->json();
                       Log::info('Mensaje enviado a '.$fono.' '.$resp. "-Pagina: ProcesosSearch.php");


                    }
                }
            }
        }

        return redirect()->route('procesos.index')->with('info','Informe Reenviado con Éxito.');
    }

    public function set_especie($id){
        $this->especieid=$id;
        $this->variedadid=NULL;
        $this->varie =NULL;
        $this->espec=Especie::find($this->especieid);


    }

    public function set_varie($id){
        $this->variedadid=$id;
        $this->varie=Variedad::find($this->variedadid);

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

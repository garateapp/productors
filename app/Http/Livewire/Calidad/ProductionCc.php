<?php

namespace App\Http\Livewire\Calidad;

use App\Models\Calidad;
use App\Models\Detalle;
use App\Models\Especie;
use App\Models\Parametro;
use App\Models\Recepcion;
use App\Models\Sync;
use App\Models\User;
use App\Models\Valor;
use App\Models\Variedad;
use Carbon\Carbon;
use Livewire\Component;
use PDF;
use Illuminate\Support\Facades\Http;
use Livewire\WithPagination;


class ProductionCc extends Component
{   use WithPagination;


    public $firmpro, $calibres, $search, $ctd=25,$espec, $varie, $variedadid, $recep, $especieid, $materia_vegetal, $temperatura, $valor, $tipo_control, $fecha, $embalaje=1, $cantidad, $detalle, $porcentaje_muestra, $total_muestra=100, $detalles, $recepcion_id, $calidad, $nro_muestra, $parametros, $valores, $selectedparametro, $selectedvalor;
    public function render()
    {   
        $recepcions=Recepcion::where('id_g_recepcion','LIKE','%'. $this->search .'%')
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
        ->orwhere('n_estado','LIKE','%'. $this->search .'%')
        ->latest('id')->paginate($this->ctd);

        $allsubrecepcions=Recepcion::where('id_g_recepcion','LIKE','%'. $this->search .'%')
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
        ->orwhere('n_estado','LIKE','%'. $this->search .'%')
        ->latest('id')->get();
        $allrecepcions=Recepcion::all();
        $sync=Sync::where('entidad','RECEPCIONES')
        ->orderby('id','DESC')
        ->first();
        $especies=Especie::all();
        $variedades=Variedad::all();

        
        return view('livewire.calidad.production-cc',compact('especies','variedades','recepcions','allrecepcions','allsubrecepcions','sync'));
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

    public function updatedselectedparametro($parametro){
        
        $this->valores = Valor::where('parametro_id',$parametro)->get();
        $this->reset(['detalle']);
    }

    public function updatedselectedvalor($valor){
        
        $this->detalle = Valor::find($valor);
    }

    public function set_recepcion_cc($id){
        $this->recepcion_id=$id;
        $this->recep=Recepcion::find($this->recepcion_id);
        $this->parametros=Parametro::where('tipo',"cc")->get();
        $this->tipo_control='cc';
        
    }

    public function set_recep($id){
        $this->recepcion_id=$id;
        $this->recep=Recepcion::find($this->recepcion_id);
        
    }

    public function clean_recep(){
      
        $this->reset(['recepcion_id','recep']);
    }

    

    public function set_recepcion_ss($id){
        $this->recepcion_id=$id;
        $this->recep=Recepcion::find($this->recepcion_id);
        $this->parametros=Parametro::where('tipo',"ss")->get();
        $this->tipo_control='ss';
        
    }

    public function detalle_store(){
        $rules = [
            'cantidad'=>'required',
            'detalle'=>'required'
            
            ];
      
        $this->validate ($rules);

        Detalle::create([
            'calidad_id'=>$this->recep->calidad->id,
            'embalaje'=>$this->embalaje,
            'cantidad'=>$this->cantidad,
            'porcentaje_muestra'=>$this->porcentaje_muestra,
            'tipo_item'=>$this->detalle->parametro->name,
            'tipo_detalle'=>$this->tipo_control,
            'detalle_item'=>$this->detalle->name,
            'fecha'=>$this->fecha                
        ]);
        
        $this->reset(['detalle','porcentaje_muestra','selectedvalor','selectedparametro','cantidad','fecha','embalaje']);
        $this->recep = Recepcion::find($this->recepcion_id);
    }

    public function ss_store(){
        $rules = [
            'valor'=>'required',
            'detalle'=>'required'
            
            ];
      
        $this->validate ($rules);

        Detalle::create([
            'calidad_id'=>$this->recep->calidad->id,
            'temperatura'=>$this->temperatura,
            'valor_ss'=>$this->valor,
            'tipo_item'=>$this->detalle->parametro->name,
            'tipo_detalle'=>$this->tipo_control,
            'detalle_item'=>$this->detalle->name,
            'fecha'=>$this->fecha                
        ]);
        
        $this->reset(['detalle','selectedvalor','selectedparametro','valor','fecha']);
        $this->recep = Recepcion::find($this->recepcion_id);
    }

    public function recep_clean(){
        $this->recepcion_id=NULL;
        $this->recep=NULL;
        $this->calidad=Null;
        $this->cantidad=Null;
        $this->porcentaje_muestra=Null;
        $this->detalle=Null;
        $this->total_muestra=100;

    }
    public function muestra_clean(){
        $this->total_muestra=100;
        $this->porcentaje_muestra=$this->cantidad*100/$this->total_muestra;
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

    public function delete_detalle(Detalle $detalle){
        $detalle->delete();
        $this->recep = Recepcion::find($this->recepcion_id);
    }

    public function actualizar_porcentaje(){
        if($this->total_muestra==0){
            $this->porcentaje_muestra='NO SE PUEDE INGRESAR 0 MUESTRAS';
        }else{
            $this->porcentaje_muestra=$this->cantidad*100/$this->total_muestra;
        }
        
    }

    public function validar_informe(Recepcion $recepcion) {
        $recepcion->n_estado='CERRADO';
        $recepcion->save();
        $user=User::where('name',$recepcion->n_emisor)->first();

        

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

       return redirect()->route('productioncc.index');
    }

    public function cargar_firmpro(Recepcion $recepcion){
        $this->calibres=Http::post('https://apigarate.azurewebsites.net/api/v1.0/Recepcion/BuscarConsolidadoFruitCloud?Numero_recepcion='.$recepcion->numero_g_recepcion);
        $this->calibres = $this->calibres->json();


        foreach ($this->calibres as $items){              
            $n=1;        
                foreach ($items as $item){
                    if($n==5){
                        $cantidad_frutos=$item;
                    }
                    if ($n==24) {
                        if($item==0){
                            
                        }else{
                            Detalle::create([
                                'calidad_id'=>$this->recep->calidad->id,
                                'embalaje'=>$this->embalaje,
                                'valor_ss'=>$item*100,
                                'porcentaje_muestra'=>$item*100,
                                'tipo_item'=>'DISTRIBUCIÓN DE CALIBRES',
                                'tipo_detalle'=>'cc',
                                'detalle_item'=>'PRECALIBRE',
                                'fecha'=>$this->fecha                
                            ]);
                        }
                    }
                    if ($n==25) {
                        if($item==0){
                            
                        }else{
                            Detalle::create([
                                'calidad_id'=>$this->recep->calidad->id,
                                'embalaje'=>$this->embalaje,
                                'valor_ss'=>$item*100,
                                'porcentaje_muestra'=>$item*100,
                                'tipo_item'=>'DISTRIBUCIÓN DE CALIBRES',
                                'tipo_detalle'=>'cc',
                                'detalle_item'=>'L',
                                'fecha'=>$this->fecha                
                            ]);
                        }
                    }
                    if ($n==26) {
                        if($item==0){
                            
                        }else{
                            Detalle::create([
                                'calidad_id'=>$this->recep->calidad->id,
                                'embalaje'=>$this->embalaje,
                                'valor_ss'=>$item*100,
                                'porcentaje_muestra'=>$item*100,
                                'tipo_item'=>'DISTRIBUCIÓN DE CALIBRES',
                                'tipo_detalle'=>'cc',
                                'detalle_item'=>'XL',
                                'fecha'=>$this->fecha                
                            ]);
                        }
                    }
                    if ($n==27) {
                        if($item==0){
                            
                        }else{
                            Detalle::create([
                                'calidad_id'=>$this->recep->calidad->id,
                                'embalaje'=>$this->embalaje,
                                'valor_ss'=>$item*100,
                                'porcentaje_muestra'=>$item*100,
                                'tipo_item'=>'DISTRIBUCIÓN DE CALIBRES',
                                'tipo_detalle'=>'cc',
                                'detalle_item'=>'J',
                                'fecha'=>$this->fecha                
                            ]);
                        }
                    }
                    if ($n==28) {
                        if($item==0){
                            
                        }else{
                           Detalle::create([
                                'calidad_id'=>$this->recep->calidad->id,
                                'embalaje'=>$this->embalaje,
                                'valor_ss'=>$item*100,
                                'porcentaje_muestra'=>$item*100,
                                'tipo_item'=>'DISTRIBUCIÓN DE CALIBRES',
                                'tipo_detalle'=>'cc',
                                'detalle_item'=>'2J',
                                'fecha'=>$this->fecha                
                            ]);
                        }
                    }
                    if ($n==29) {
                        if($item==0){
                            
                        }else{
                          Detalle::create([
                                'calidad_id'=>$this->recep->calidad->id,
                                'embalaje'=>$this->embalaje,
                                'valor_ss'=>$item*100,
                                'porcentaje_muestra'=>$item*100,
                                'tipo_item'=>'DISTRIBUCIÓN DE CALIBRES',
                                'tipo_detalle'=>'cc',
                                'detalle_item'=>'3J',
                                'fecha'=>$this->fecha                
                            ]);
                        }
                    }
                    if ($n==30) {
                        if($item==0){
                            
                        }else{
                         Detalle::create([
                                'calidad_id'=>$this->recep->calidad->id,
                                'embalaje'=>$this->embalaje,
                                'valor_ss'=>$item*100,
                                'porcentaje_muestra'=>$item*100,
                                'tipo_item'=>'DISTRIBUCIÓN DE CALIBRES',
                                'tipo_detalle'=>'cc',
                                'detalle_item'=>'4J',
                                'fecha'=>$this->fecha                
                            ]);
                        }
                    }
                    if ($n==31) {
                        if($item==0){
                            
                        }else{
                          Detalle::create([
                                'calidad_id'=>$this->recep->calidad->id,
                                'embalaje'=>$this->embalaje,
                                'valor_ss'=>$item*100,
                                'porcentaje_muestra'=>$item*100,
                                'tipo_item'=>'DISTRIBUCIÓN DE CALIBRES',
                                'tipo_detalle'=>'cc',
                                'detalle_item'=>'5J',
                                'fecha'=>$this->fecha                
                            ]);
                        }
                    }
                    $n+=1;

                }                                              

            }

        $this->firmpro=Http::post('https://apigarate.azurewebsites.net/api/v1.0/Recepcion/BuscarRecepcionCloud?Numero_recepcion='.$recepcion->numero_g_recepcion);
        $this->firmpro = $this->firmpro->json();
        $subpromedio_light=0;
        $subpromedio_dark=0;
        $subpromedio_black=0;
        $subpromedio_light2=0;
        $subpromedio_dark2=0;
        $subpromedio_black2=0;
        $rojo=0;
        $rojocaoba=0;
        $santina=0;
        $caobaoscuro=0;
        $negro=0;

        foreach ($this->firmpro as $items){              
            $n=1;   

                //CADA REGISTRO:
                foreach ($items as $item){
                    if($n==4){
                        $firmeza=$item;
                       
                    }
                    if($n==5){
                        $calibre=$item;
                    }
                    if($n==13){
                        $color=$item;
                        if($color=='Rojo'){
                            $rojo+=1;
                            $subpromedio_light+=$firmeza;
                            $subpromedio_light2+=$calibre;
                        }
                        if($color=='Rojo caoba'){
                            $rojocaoba+=1;
                            $subpromedio_dark+=$firmeza;
                            $subpromedio_dark2+=$calibre;
                        }
                        if($color=='Santina'){
                            $santina+=1;
                            $subpromedio_dark+=$firmeza;
                            $subpromedio_dark2+=$calibre;
                        }
                        if($color=='Caoba oscuro'){
                            $caobaoscuro+=1;
                            $subpromedio_black+=$firmeza;
                            $subpromedio_black2+=$calibre;
                        }
                        if($color=='Negro'){
                            $negro+=1;
                            $subpromedio_black+=$firmeza;
                            $subpromedio_black2+=$calibre;
                        }
                       
                    }
                    $n+=1;
                }                                              

        }
            if($rojo>0){
                Detalle::create([
                    'calidad_id'=>$this->recep->calidad->id,
                    'embalaje'=>$this->embalaje,
                    'valor_ss'=>$negro*100/$cantidad_frutos,
                    'tipo_item'=>'COLOR DE CUBRIMIENTO',
                    'tipo_detalle'=>'cc',
                    'detalle_item'=>'ROJO',
                    'fecha'=>$this->fecha                
                ]);
            }
            if($rojocaoba>0){
                Detalle::create([
                    'calidad_id'=>$this->recep->calidad->id,
                    'embalaje'=>$this->embalaje,
                    'valor_ss'=>$rojocaoba*100/$cantidad_frutos,
                    'tipo_item'=>'COLOR DE CUBRIMIENTO',
                    'tipo_detalle'=>'cc',
                    'detalle_item'=>'ROJO CAOBA',
                    'fecha'=>$this->fecha                
                ]);
            }
            if($santina>0){
                Detalle::create([
                    'calidad_id'=>$this->recep->calidad->id,
                    'embalaje'=>$this->embalaje,
                    'valor_ss'=>$santina*100/$cantidad_frutos,
                    'tipo_item'=>'COLOR DE CUBRIMIENTO',
                    'tipo_detalle'=>'cc',
                    'detalle_item'=>'SANTINA',
                    'fecha'=>$this->fecha                
                ]);
            }
            if($caobaoscuro>0){
                Detalle::create([
                    'calidad_id'=>$this->recep->calidad->id,
                    'embalaje'=>$this->embalaje,
                    'valor_ss'=>$caobaoscuro*100/$cantidad_frutos,
                    'tipo_item'=>'COLOR DE CUBRIMIENTO',
                    'tipo_detalle'=>'cc',
                    'detalle_item'=>'CAOBA OSCURO',
                    'fecha'=>$this->fecha                
                ]);
            }
             if($negro>0){
                Detalle::create([
                    'calidad_id'=>$this->recep->calidad->id,
                    'embalaje'=>$this->embalaje,
                    'valor_ss'=>$negro*100/$cantidad_frutos,
                    'tipo_item'=>'COLOR DE CUBRIMIENTO',
                    'tipo_detalle'=>'cc',
                    'detalle_item'=>'NEGRO',
                    'fecha'=>$this->fecha                
                ]);
            }

            if($rojo>0){
                Detalle::create([
                    'calidad_id'=>$this->recep->calidad->id,
                    'embalaje'=>$this->embalaje,
                    'valor_ss'=>$subpromedio_light/$rojo,
                    'tipo_item'=>'FIRMEZAS',
                    'tipo_detalle'=>'ss',
                    'detalle_item'=>'LIGHT',
                    'fecha'=>$this->fecha                
                ]);
                Detalle::create([
                    'calidad_id'=>$this->recep->calidad->id,
                    'embalaje'=>$this->embalaje,
                    'valor_ss'=>$subpromedio_light2/$rojo,
                    'tipo_item'=>'BRIX DAGEN',
                    'tipo_detalle'=>'ss',
                    'detalle_item'=>'SLIGHT',
                    'fecha'=>$this->fecha                
                ]);
                }else{
                Detalle::create([
                    'calidad_id'=>$this->recep->calidad->id,
                    'embalaje'=>$this->embalaje,
                    'valor_ss'=>0,
                    'tipo_item'=>'FIRMEZAS',
                    'tipo_detalle'=>'ss',
                    'detalle_item'=>'LIGHT',
                    'fecha'=>$this->fecha   ]);
                    Detalle::create([
                        'calidad_id'=>$this->recep->calidad->id,
                        'embalaje'=>$this->embalaje,
                        'valor_ss'=>0,
                        'tipo_item'=>'BRIX DAGEN',
                        'tipo_detalle'=>'ss',
                        'detalle_item'=>'SLIGHT',
                        'fecha'=>$this->fecha   ]);
            }
            if (($rojocaoba+$santina)>0) {
                Detalle::create([
                    'calidad_id'=>$this->recep->calidad->id,
                    'embalaje'=>$this->embalaje,
                    'valor_ss'=>$subpromedio_dark/($rojocaoba+$santina),
                    'tipo_item'=>'FIRMEZAS',
                    'tipo_detalle'=>'ss',
                    'detalle_item'=>'DARK',
                    'fecha'=>$this->fecha                
                ]);
                Detalle::create([
                    'calidad_id'=>$this->recep->calidad->id,
                    'embalaje'=>$this->embalaje,
                    'valor_ss'=>$subpromedio_dark2/($rojocaoba+$santina),
                    'tipo_item'=>'BRIX DAGEN',
                    'tipo_detalle'=>'ss',
                    'detalle_item'=>'SDARK',
                    'fecha'=>$this->fecha                
                ]);
                } else {
                Detalle::create([
                    'calidad_id'=>$this->recep->calidad->id,
                    'embalaje'=>$this->embalaje,
                    'valor_ss'=>0,
                    'tipo_item'=>'FIRMEZAS',
                    'tipo_detalle'=>'ss',
                    'detalle_item'=>'DARK',
                    'fecha'=>$this->fecha                
                ]);
                Detalle::create([
                    'calidad_id'=>$this->recep->calidad->id,
                    'embalaje'=>$this->embalaje,
                    'valor_ss'=>0,
                    'tipo_item'=>'BRIX DAGEN',
                    'tipo_detalle'=>'ss',
                    'detalle_item'=>'SDARK',
                    'fecha'=>$this->fecha                
                ]);
            }
            
            if (($negro+$caobaoscuro)>0) {
                Detalle::create([
                    'calidad_id'=>$this->recep->calidad->id,
                    'embalaje'=>$this->embalaje,
                    'valor_ss'=>$subpromedio_black/($negro+$caobaoscuro),
                    'tipo_item'=>'FIRMEZAS',
                    'tipo_detalle'=>'ss',
                    'detalle_item'=>'BLACK',
                    'fecha'=>$this->fecha                
                ]);
                Detalle::create([
                    'calidad_id'=>$this->recep->calidad->id,
                    'embalaje'=>$this->embalaje,
                    'valor_ss'=>$subpromedio_black2/($negro+$caobaoscuro),
                    'tipo_item'=>'BRIX DAGEN',
                    'tipo_detalle'=>'ss',
                    'detalle_item'=>'SBLACK',
                    'fecha'=>$this->fecha                
                ]);
                } else {
                Detalle::create([
                    'calidad_id'=>$this->recep->calidad->id,
                    'embalaje'=>$this->embalaje,
                    'valor_ss'=>0,
                    'tipo_item'=>'FIRMEZAS',
                    'tipo_detalle'=>'ss',
                    'detalle_item'=>'BLACK',
                    'fecha'=>$this->fecha                
                ]);
                Detalle::create([
                    'calidad_id'=>$this->recep->calidad->id,
                    'embalaje'=>$this->embalaje,
                    'valor_ss'=>0,
                    'tipo_item'=>'BRIX DAGEN',
                    'tipo_detalle'=>'ss',
                    'detalle_item'=>'SBLACK',
                    'fecha'=>$this->fecha                
                ]);
            }

           
 
    
}
}

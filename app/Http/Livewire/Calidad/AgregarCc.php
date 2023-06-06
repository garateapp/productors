<?php

namespace App\Http\Livewire\Calidad;

use App\Models\Detalle;
use App\Models\Parametro;
use App\Models\Recepcion;
use App\Models\Sync;
use App\Models\Valor;
use Livewire\Component;
use Livewire\WithPagination;

class AgregarCc extends Component
{   use WithPagination;


    public $search, $ctd=25, $recep, $materia_vegetal, $temperatura, $valor, $tipo_control, $fecha, $embalaje=1, $cantidad, $detalle, $porcentaje_muestra, $total_muestra=100, $detalles, $recepcion_id, $calidad, $nro_muestra, $parametros, $valores, $selectedparametro, $selectedvalor;
    
    public function mount(Recepcion $recepcion){
        $this->recepcion_id=$recepcion->id;
        $this->recep=Recepcion::find($this->recepcion_id);
        $this->parametros=Parametro::where('tipo',"cc")->get();
        $this->tipo_control='cc';
    }

    public function render()
    {   $recepcions=Recepcion::where('id_g_recepcion','LIKE','%'. $this->search .'%')
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

        return view('livewire.calidad.agregar-cc',compact('recepcions','allrecepcions','allsubrecepcions','sync'));
    }
    public function updatedselectedparametro($parametro){
        if($this->recep->n_variedad=='Dagen'){
            $this->valores = Valor::where('parametro_id',$parametro)->where('especie',$this->recep->n_variedad)->orderby('name','ASC')->get();
        }else{
            $this->valores = Valor::where('parametro_id',$parametro)->where('especie',$this->recep->n_especie)->orderby('name','ASC')->get();
        }
            
        $this->reset(['detalle']);
    }

    public function updatedselectedvalor($valor){
        
        $this->detalle = Valor::find($valor);
    }

    public function set_recepcion_cc($id){
        $this->recepcion_id=$id;
        $this->recep=Recepcion::find($this->recepcion_id);
        $this->parametros=Parametro::where('tipo',"cc")->orderby('name','ASC')->get();
        $this->tipo_control='cc';
        
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
}

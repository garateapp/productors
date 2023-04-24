<?php

namespace App\Http\Livewire\Admin;

use App\Models\Mensaje;
use App\Models\User;
use Livewire\Component;

class Inbox extends Component
{   public $mensajes, $current, $emisor;
    
    public function mount(){
        $this->mensajes =Mensaje::where('receptor_id',auth()->user()->id)->get();
        foreach ($this->mensajes as $mensaje){
            if ($mensaje->status==1){
                $this->current = $mensaje;
                $this->emisor = User::find($this->current->emisor_id);
                break;
            }
        }
        if(!$this->current){
            $this->current = $this->mensajes->first();
            if($this->current){
                $this->emisor = User::find($this->current->emisor_id);
            }
            
        }
    }

    public function render()
    {   $mensajes=Mensaje::where('receptor_id',auth()->user()->id)->get();
        $mensajespendientes=Mensaje::where('receptor_id',auth()->user()->id)->where('status',1)->get();
        
        return view('livewire.admin.inbox',compact('mensajes','mensajespendientes'));
    }

    public function changemensaje(Mensaje $mensaje){
        $this->current = $mensaje;     
        $this->emisor = User::find($this->current->emisor_id);   
    }

    public function download(Mensaje $mensaje){
        $mensaje->status = 2;
        $mensaje->save();
        $this->mensajes=Mensaje::where('receptor_id',auth()->user()->id)->get();

        return response()->download(storage_path('app/'.$mensaje->archivo));
    }

    public function leido(Mensaje $mensaje){
        $mensaje->status = 2;
        $mensaje->save();
        $this->mensajes=Mensaje::where('receptor_id',auth()->user()->id)->get();
    }
}

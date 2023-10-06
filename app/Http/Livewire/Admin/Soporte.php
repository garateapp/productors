<?php

namespace App\Http\Livewire\Admin;

use App\Models\Mensaje;
use App\Models\Ticket;
use App\Models\User;
use Livewire\Component;

class Soporte extends Component
{    public $mensajes, $current, $emisor, $receptor;
    
    public function mount(){
        $this->mensajes =Ticket::all();
        foreach ($this->mensajes as $mensaje){
            if ($mensaje->status==1){
                $this->current = $mensaje;
                $this->emisor = User::find($this->current->emisor_id);
                 $this->receptor =   User::find($this->current->receptor_id);
                break;
            }
        }
        if(!$this->current){
            $this->current = $this->mensajes->first();
            if($this->current){
                $this->emisor = User::find($this->current->emisor_id);
                 $this->receptor =   User::find($this->current->receptor_id);
            }
            
        }
    }
    
    public function render()
    {    $mensajes=Ticket::all();
        $mensajespendientes=Ticket::where('status',1)->get();
        
        return view('livewire.admin.soporte',compact('mensajes','mensajespendientes'));
       
    }

    public function changemensaje(Ticket $ticket){
        $this->current = $ticket;     
        $this->emisor = User::find($this->current->emisor_id); 
        $this->receptor =   User::find($this->current->receptor_id); 
    }

    

    public function leido(Mensaje $mensaje){
        $mensaje->status = 2;
        $mensaje->save();
        $this->mensajes=Mensaje::where('receptor_id',auth()->user()->id)->get();
    }
}

<?php

namespace App\Http\Livewire\Productor;

use App\Models\Recepcion;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ProductionShow extends Component
{   use withpagination;
    public $user;

    public function mount(User $user){
        $this->user=$user;
      
    }

    public function render()
    {   
        $recepcions=Recepcion::where('n_emisor',$this->user->name)->latest('id')->paginate(6);
        return view('livewire.productor.production-show',compact('recepcions'));
    }
}

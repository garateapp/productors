<?php

namespace App\Http\Livewire\Agronomo;

use App\Models\CampoStaff;
use App\Models\User;
use Livewire\Component;

class SearchCampo extends Component
{   public $user,$search;

    public function mount(User $user){
        $this->user=$user;
    }

    public function render()
    {   $campos=CampoStaff::where('agronomo_id',$this->user->id)->get();

        $campos2=CampoStaff::where('agronomo_id',$this->user->id)->pluck('campo_rut');

        $search = $this->search;

        $uniqueUsers = User::select('*')
            ->where(function ($query) use ($search) {
                if ($search) {
                    $query->where('name', 'LIKE', '%' . $search . '%')
                        ->orWhere('rut', 'LIKE', '%' . $search . '%');
                }
            })
            ->whereIn('id', function ($query) {
                $query->selectRaw('MIN(id)')
                    ->from('users')
                    ->groupBy('rut');
            })
            ->get();


        return view('livewire.agronomo.search-campo',compact('uniqueUsers','campos2','campos'));
    }
}

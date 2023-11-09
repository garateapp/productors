<?php

namespace App\Http\Livewire\Productor;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class LogoStore extends Component
{   use WithFileUploads;
    public $user, $image, $file;

    public function mount(User $user){
        $this->user=$user;
    }
    public function render()
    {   
        return view('livewire.productor.logo-store');
    }

    public function store(){
        $rules = [
            'image'=>'required|image|max:2048'
        ];

        $this->validate ($rules);

        $image = $this->file->store('profile-photos');



        $this->user->update([
            'photo_profile_url'=>$image
        ]);

        $this->user = User::find($this->user->id);

    }

    public function imageupdate()
    {   
        $this->validate([
            'file'=>'required|image|max:2048'
        ]);

        
        if($this->user->photo_profile_url){
            
            $url = $this->file->store('profile-photos');
            Storage::delete($this->user->photo_profile_url);
            $this->user->update([
                'photo_profile_url'=>$url
            ]);
        }
        else{
            $url = $this->file->store('profile-photos');
            $this->user->update([
                'photo_profile_url'=>$url
            ]);
        }

        $this->user = User::find($this->user->id);

        $this->reset(['file']);
    }

}

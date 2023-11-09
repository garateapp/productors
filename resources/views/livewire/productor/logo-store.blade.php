<div>
    <form wire:submit.prevent="imageupdate">
        <div class="flex items-center" >
            <input wire:model="file" type="file" class="form-input flex-1 bg-gray-200"> 
            <button type="submit" class="btn btn-primary text-sm ml-2" >Guardar</button>
    
        </div>

        <div class="text-red-500  text-sm font-bold mt-1" wire:loading wire:target="file ">
            CARGANDO ...
        </div>

        @error('file')
            <span class="text-xs text-red-500">{{$message}}</span>
        @enderror
    </form>
</div>

<div>
    <div class="flex justify-end my-4">
        <div class="flex">
            <select wire:model.live="selectedespecie"
                class="block w-full px-4 py-3 pr-8 mx-auto leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500">
                <option value="" class="text-center"> - </option>
                @foreach ($especies as $especie)
                    <option value="{{ $especie->id }}" class="mx-4 text-center">{{ $especie->name }}</option>
                @endforeach

            </select>

            <select wire:model.live="selectedproductor"
                class="block w-full px-4 py-3 pr-8 mx-4 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500">
                <option value="" class="text-center">¿Productor?</option>
                @foreach ($productors as $item)
                    <option value="{{ $item->id }}" class="mx-4 text-center">{{ $item->name }}</option>
                @endforeach

            </select>

            <button wire:click="export()"
                class="items-center px-6 py-3 mx-2 bg-gray-500 rounded focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 hover:bg-gray-600 focus:outline-none">
                <p class="text-sm font-medium leading-none text-white">Exportar en Excel</p>
            </button>
        </div>
    </div>
    <div class="px-4 py-4 mt-6 bg-white md:py-7 md:px-8 xl:px-10">
    </div>
</div>

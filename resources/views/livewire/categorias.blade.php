<x-slot name="header">
    <h1 class="text-gray-800">Todas las categorias de los ducumentos</h1>
</x-slot>
<!-- component 
Resolver alineacion de la tabla-->
<div class="text-gray-900 container w-1/2">
    <div class="p-4 flex">
        <button type="button" 
            wire:click="crear()"
            class="mr-3 text-sm bg-green-500 hover:bg-green-700 text-white py-1 px-3 rounded rounded-tl-2xl rounded-br-2xl focus:outline-none focus:shadow-outline">
                Nuevo
        </button>
        @if($modal)
            @include('livewire.crearCategoria')
        @endif
    </div>
    <div class="px-3 py-4 flex  justify-center">
        <table class="w-full text-md bg-white shadow-md rounded mb-4">
            <thead>
                <tr class="border-b">
                    <th class="text-left p-3 px-5">Id</th>
                    <th class="text-left p-3 px-5">Tipo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categorias as $item)                        

                <tr class="border-b hover:bg-orange-100 bg-gray-100">
                    <td class="p-3 px-5">{{ $item->id}}</td>
                    <td class="p-3 px-5">{{ $item->tipo}}</td>
                    <td class="p-3 px-5 flex justify-center">
                        <button type="button" class="mr-1 text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded rounded-l-2xl focus:outline-none focus:shadow-outline">Editar</button>
                        <button type="button" class="text-sm bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded rounded-r-2xl focus:outline-none focus:shadow-outline">Borrar</button>
                    </td>
                </tr>
                @endforeach
                
            </tbody>
        </table>
    </div>
</div>

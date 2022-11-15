<x-slot name="header">
    <h1 class="font-semibold text-xl text-gray-800 leading-tight">
        Documentos subidos al repositorio</h1>
</x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
           @if (session()->has('message'))
               <div class="p-3 bg-blue-900 text-white rounded shadow-lg">
                   {{session('message')}}
               </div>
           @endif
    <div class="p-4 flex">
        <x-jet-button wire:click="crear()" type="button">
            Nuevo
        </x-jet-button>
        {{-- modal de editar y crear  --}}
        @if($modal)
            @include('livewire.crearDocumento')
        @endif

        {{-- modal de eliminacion  --}}
        @if($modal_confirmar)
            @include('livewire.confirmarEliminacion')
        @endif
    </div>
    <div class="px-3 py-4 flex justify-center">
        <table class="w-full text-md bg-blue-300 shadow-md rounded mb-4">
            <thead>
                <tr class="border-b">
                    <th class="text-left p-3 px-3">Titulo</th>
                    <th class="text-left p-3 px-1">Autor</th>
                    <th class="text-left p-3 px-1">Idioma</th>
                    <th class="text-left p-3 px-1">Departamento</th>
                    <th class="text-left p-3 px-1">Categoria</th>

                    <th class="p-3 px-5 flex justify-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @if (!is_null($documentos))
                    @foreach ($documentos as $item)                        
                        <tr class="border-b hover:bg-orange-100 bg-gray-100">
                            <td class="p-3 px-3">{{ $item->titulo}}</td>
                            <td class="p-3 px-1">{{ $item->autor}}</td>
                            <td class="p-3 px-1">{{ $item->idioma}}</td>
                            <td class="p-3 px-1">{{ $item->departamento->nombre}}</td>
                            <td class="p-3 px-1">{{ $item->categoria->tipo}}</td>

                            <td class="p-3 px-5 flex justify-center">
                                <button type="button"
                                    wire:click="$set('detalles',true)" 
                                    class="mr-1 text-sm bg-green-700 hover:bg-green-800 text-white py-1 px-2 rounded rounded-l-2xl focus:outline-none focus:shadow-outline">
                                        Ver +
                                </button>
                                <button type="button"
                                    wire:click="editar({{$item->id}})" 
                                    class="mr-1 text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 focus:outline-none focus:shadow-outline">
                                        Editar
                                </button>
                                <button type="button" 
                                    wire:click="eliminar({{$item->id}})" 
                                    class="text-sm bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded rounded-r-2xl focus:outline-none focus:shadow-outline">
                                    Borrar
                                </button>
                            </td>
                        </tr>
                        @if ($detalles)
                            <tr class="border-b bg-cyan-100 hover:bg-green-100 bg-gray-100">
                                <td colspan="5" class="p-3 px-3">
                                    Resumen: {{$item->resumen}}; Subido por: {{$item->user->name}}; Url: {{$item->url}};
                                    Año: {{$item->anio}}
                                </td>
                                <td class="p-3 px-3 flex justify-center">
                                    <x-jet-button class="ml-3" wire:click.prevent="$set('detalles',false)">
                                        Cerrar
                                    </x-jet-danger-button>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    
                @else
                    <tr>
                        <td class="p-3 px-5">No hay documentos cargados</td>
                    </tr>
                @endif
                
            </tbody>
        </table>
    </div>
</div>
</div>
</div>
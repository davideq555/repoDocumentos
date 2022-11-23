<div>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">Todas los usuarios registrados</h1>
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
            <x-jet-button wire:click="" type="button">
                Nuevo
            </x-jet-button>
            {{-- modal de editar y crear  --}}
            @if($modal)
                @include('livewire.crearUser')
            @endif

            {{-- modal de eliminacion  --}}
            @if($modal_confirmar)
                @include('livewire.confirmarEliminacion')
            @endif
        </div>
        <div class="px-3 py-4 flex  justify-center">
            <table class="w-full text-md bg-blue-300 shadow-md rounded mb-4">
                <thead>
                    <tr class="border-b">
                        <th class="text-left p-3 px-5">Id</th>
                        <th class="text-left p-3 px-5">Nombre</th>
                        <th class="text-left p-3 px-5">Email</th>
                        <th class="text-left p-3 px-5">Rol</th>
                        <th class="text-left p-3 px-5">Creado el</th>
                        <th class="text-left p-3 px-5">Ultimo acceso</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $item)                        

                    <tr class="border-b hover:bg-orange-100 bg-gray-100">
                        <td class="p-3 px-5">{{ $item->id}}</td>
                        <td class="p-3 px-5">{{ $item->name}}</td>
                        <td class="p-3 px-5">{{ $item->email}}</td>
                        <td class="p-3 px-5">{{ $item->getRoleNames()[0]}}</td>
                        <td class="p-3 px-5">{{ $item->created_at}}</td>
                        <td class="p-3 px-5">{{ $item->updated_at}}</td>
                        <td class="p-3 px-5 flex justify-center">
                            <button type="button"
                                wire:click="editar({{$item->id}})" 
                                class="mr-1 text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded rounded-l-2xl focus:outline-none focus:shadow-outline">
                                    Editar
                            </button>
                            <button type="button" 
                                wire:click="eliminar({{$item->id}})" 
                                class="text-sm bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded rounded-r-2xl focus:outline-none focus:shadow-outline">
                                    Borrar
                            </button>
                        </td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
    </div>
    </div>
</div>
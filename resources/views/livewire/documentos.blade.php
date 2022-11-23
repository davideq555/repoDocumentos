<div>
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
            <div class="p-2 flex">
                <div class="flex items-center pb-2">
                    <div class="flex items-center justify-between space-x-2">
                        <x-jet-button action="{{ route('exportExcel')}}" type="button" class="space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                <path fill-rule="evenodd" d="M13.75 7h-3V3.66l1.95 2.1a.75.75 0 101.1-1.02l-3.25-3.5a.75.75 0 00-1.1 0L6.2 4.74a.75.75 0 001.1 1.02l1.95-2.1V7h-3A2.25 2.25 0 004 9.25v7.5A2.25 2.25 0 006.25 19h7.5A2.25 2.25 0 0016 16.75v-7.5A2.25 2.25 0 0013.75 7zm-3 0h-1.5v5.25a.75.75 0 001.5 0V7z" clip-rule="evenodd" />
                            </svg>
                            <div>Export</div>
                            <a href="{{route('exportExcel')}}" target="_blank" rel="noopener noreferrer">excel</a>
                        </x-jet-button>
                        @livewire('crear-documento')
                        <div class="flex bg-gray-50 items-center p-2 rounded-md self-right">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd" />
                            </svg>
                            <x-jet-input type="text" 
                                wire:model="search"
                                placeholder="Buscar..." class="w-full"/>
                        </div>
                    </div>
                </div>
            
            {{-- modal de editar y crear  --}}
            @if($modal)
                @include('livewire.editarDocumento')
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
                        <th class="text-center p-3 px-1 text-sm tracking-wide cursor-pointer"
                            wire:click="order('id')">Id</th>
                        <th class="text-left p-3 px-3 text-sm tracking-wide cursor-pointer"
                            wire:click="order('titulo')">Titulo</th>
                        <th class="text-left p-3 px-1 text-sm tracking-wide cursor-pointer"
                            wire:click="order('autor')">Autor</th>
                        <th class="text-left p-3 px-1 text-sm tracking-wide cursor-pointer"
                            wire:click="order('departamento_id')">Departamento</th>
                        <th class="text-left p-3 px-1 text-sm tracking-wide cursor-pointer"
                            wire:click="order('categoria_id')">Categoria</th>

                        <th class="p-3 px-5 flex justify-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide">
                    @if ($documentos->count())
                        @foreach ($documentos as $item)                        
                            <tr class="border-b hover:bg-orange-100 bg-gray-100 ">
                                <td class="p-3 px-1 w-16 text-sm">{{ $item->id}}</td>
                                <td class="p-3 px-3 text-sm">{{ $item->titulo}}</td>
                                <td class="p-3 px-1 text-sm">{{ $item->autor}}</td>
                                <td class="p-3 px-1 w-24 text-sm">{{ $item->departamento->nombre}}</td>
                                <td class="p-3 px-1 w-24 text-sm">{{ $item->categoria->tipo}}</td>
                                <div class="hidden md:block">
                                <td class="p-3 px-5 w-20">
                                    <button type="button"
                                        wire:click="detalles({{$item->id}})" 
                                        class="bg-green-800 flex hover:bg-green-500 text-white py-1 px-2 rounded-2xl focus:outline-none focus:shadow-outline">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        
                                    </button>
                                    <button type="button"
                                        wire:click="editar({{$item}})" 
                                        class="bg-blue-800 flex hover:bg-blue-500 text-white py-1 px-2 rounded-2xl focus:outline-none focus:shadow-outline">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                        </svg>
                                        
                                    </button>
                                    <button type="button" 
                                        wire:click="eliminar({{$item->id}})" 
                                        class="bg-red-800 hover:bg-red-500 text-white py-1 px-2 rounded-2xl focus:outline-none focus:shadow-outline">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>                                      
                                    </button>
                                    @if($modal_detalle)
                                        @include('livewire.detalleDocumento')
                                    @endif
                                </td>
                                </div>
                            </tr>
                        @endforeach
                        @else
                        <tr>
                            <td class="p-3 px-5">No hay documentos</td>
                        </tr>
                        @endif                
                    </tbody>
                </table>
            </div>
            <div class="m-4">
                {{ $documentos->links() }}
            </div>
    </div>
    </div>
    </div>
</div>
<div>
    {{-- Metodo directo para cambiar estado de una variable con set --}}
    <x-jet-dialog-modal wire:model="modal">
        <x-slot name='title'>
            Editar documento
        </x-slot>
        <x-slot name='content'>
            <div class="mb-4">
                <x-jet-label value="Titulo del documento" for='docu.titulo'/>
                <x-jet-input type='text' name="docu.titulo" class="w-full" wire:model='docu.titulo' />
                <x-jet-input-error for='docu.titulo' class="mt-2" />
            </div>
            <div class="mb-4">
                <x-jet-label value="Resumen del documento" for='docu.resumen'/>
                <textarea rows="4" name="docu.resumen" wire:model='docu.resumen'
                    class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                </textarea>
                <x-jet-input-error for='docu.resumen' class="mt-2" />
            </div>
            <div class="mb-8 flex">
                <div class="w-1/2">
                    <x-jet-label value="Autor" for="docu.autor"/>
                    <x-jet-input type='text' name="docu.autor" class="" wire:model='docu.autor'/>
                    <x-jet-input-error for='docu.autor' class="mt-2" />
                </div>
                <div class="w-1/2">
                    <x-jet-label value="Fecha de su publicacion" for="docu.fecha" />
                    <x-jet-input type='date' name="docu.fecha" class="" wire:model='docu.fecha' />
                    <x-jet-input-error for='docu.fecha' class="mt-2" />
                </div>
            </div>
            {{-- <div class="mb-4" wire:model.updated='docu.url'> --}}
                {{-- @if ($this->url != '')
                    <a href="{{Storage::url($this->url)}}" target="_blank" rel="noopener noreferrer">Archivo cargado: {{$this->titulo}}</a>
                    <x-jet-danger-button wire:click="eliminarArchivo" class="justify-left">Borrar Archivo</x-jet-danger-button>
                @else
                    <x-jet-label value="Documento en formato pdf" for="url" />
                    <x-jet-input type='file' name="url" class="w-full" wire:model='{{$this->url}}' id="{{$identificador}}" />
                    <div wire:loading wire:target="url" class="mt-2">Cargando...</div>
                    <x-jet-input-error for='url' class="mt-2" />
                @endif --}}
                {{-- Crear un fi para sabir si existe el pdf url previamente --}}
            {{-- </div> --}}
            <div class="mb-4">
                <x-jet-label value="Categoria" for="docu.categoria_id" />
                <select name="docu.categoria_id" class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    wire:model.defer='docu.categoria_id' required>
                    <option value="0" >Seleccione uno</option>
                    @foreach ($categorias as $item)
                        @if ($item==$docu->categoria)
                            <option value="{{$item->id}}" selected>{{$item->tipo}}</option>
                        @else
                            <option value="{{$item->id}}">{{$item->tipo}}</option>
                        @endif
                    @endforeach
                </select>
                <x-jet-input-error for='docu.categoria_id' class="mt-2" />
            </div>
            <div class="mb-4">
                <x-jet-label value="Departamento" for="docu.departamento_id" />
                <select name="docu.departamento_id" class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                wire:model.prevent='docu.departamento_id' required>
                    <option value="0" disabled="disabled">Seleccione uno</option>
                    @foreach ($departamentos as $item)
                        @if ($item==$docu->departamento) 
                            <option value="{{$item->id}}" selected="">{{$item->nombre}}</option>
                        @else
                            <option value="{{$item->id}}" >{{$item->nombre}}</option>
                        @endif
                    @endforeach
                </select>
                <x-jet-input-error for='docu.departamento_id' class="mt-2" />
            </div>
        </x-slot>
        <x-slot name='footer'>
            <x-jet-secondary-button wire:click="cerrarModal()">
                Cancelar
            </x-jet-secondary-button>
            <x-jet-button class="ml-3" wire:click="actualizar()">
                Actualizar
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
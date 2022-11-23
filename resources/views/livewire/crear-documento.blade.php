<div>
    <x-jet-button wire:click="$set('open',true)" type="button" class="space-x-2">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
            <path fill-rule="evenodd" d="M4.5 2A1.5 1.5 0 003 3.5v13A1.5 1.5 0 004.5 18h11a1.5 1.5 0 001.5-1.5V7.621a1.5 1.5 0 00-.44-1.06l-4.12-4.122A1.5 1.5 0 0011.378 2H4.5zM10 8a.75.75 0 01.75.75v1.5h1.5a.75.75 0 010 1.5h-1.5v1.5a.75.75 0 01-1.5 0v-1.5h-1.5a.75.75 0 010-1.5h1.5v-1.5A.75.75 0 0110 8z" clip-rule="evenodd" />
        </svg>
        <div> Nuevo</div>
    </x-jet-button>

    <div id="modal">
        {{-- Metodo directo para cambiar estado de una variable con set --}}
        <x-jet-dialog-modal wire:model="open">
            <x-slot name='title'>
                Agregar nuevo documento
            </x-slot>
            <x-slot name='content'>
                <div class="mb-4">
                    <x-jet-label value="Titulo del documento" for='titulo'/>
                    <x-jet-input type='text' name="titulo" class="w-full" wire:model.defer='titulo' />
                    <x-jet-input-error for='titulo' class="mt-2" />
                </div>
                <div class="mb-4">
                    <x-jet-label value="Resumen del documento" for='resumen'/>
                    <textarea rows="4" name="resumen" wire:model='resumen'
                        class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    </textarea>
                    <x-jet-input-error for='resumen' class="mt-2" />
                </div>
                <div class="mb-8 flex">
                    <div class="w-1/2">
                        <x-jet-label value="Autor" for="autor"/>
                        <x-jet-input type='text' name="autor" class="" wire:model='autor'/>
                        <x-jet-input-error for='autor' class="mt-2" />
                    </div>
                    <div class="w-1/2">
                        <x-jet-label value="Fecha de su publicacion" for="fecha" />
                        <x-jet-input type='date' name="fecha" class="" wire:model='fecha' />
                        <x-jet-input-error for='fecha' class="mt-2" />
                    </div>
                </div>
                <div class="mb-4">
                    <x-jet-label value="Documento en formato pdf" for="url" />
                        <x-jet-input type='file' name="url" class="w-full" wire:model='url' id="{{$identificador}}" />
                        <div wire:loading wire:target="url" class="mt-2">Cargando...</div>
                    <x-jet-input-error for='url' class="mt-2" />
                </div>
                <div class="mb-4">
                    <x-jet-label value="Categoria" for="id_cate" />
                    <select name="id_cate" class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                        wire:model.defer='id_cate'>
                        <option value="0">Seleccione un valor</option>
                        @foreach ($categorias as $item)
                                <option value="{{$item->id}}">{{$item->tipo}}</option>
                        @endforeach
                    </select>
                    <x-jet-input-error for='id_cate' class="mt-2" />
                </div>
                <div class="mb-4">
                    <x-jet-label value="Departamento" for="id_depa" />
                    <select name="id_depa" class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    wire:model.defer='id_depa'>
                        <option value="0">Seleccione un valor</option>
                        @foreach ($departamentos as $depa)
                                <option value="{{$depa->id}}">{{$depa->nombre}}</option>
                        @endforeach
                        
                    </select>
                    <x-jet-input-error for='id_depa' class="mt-2" />
                </div>
            </x-slot>
            <x-slot name='footer'>
                <x-jet-secondary-button wire:click="set('open',false)">
                    Cancelar
                </x-jet-secondary-button>
                <x-jet-button class="ml-3" wire:click.prevent="guardar()">
                    Agregar
                </x-jet-danger-button>
            </x-slot>
        </x-jet-dialog-modal>
    </div>
</div>

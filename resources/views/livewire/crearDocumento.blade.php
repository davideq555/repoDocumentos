<div id="modal">
    {{-- Metodo directo para cambiar estado de una variable con set --}}
    <x-jet-dialog-modal wire:model="modal">
        <x-slot name='title'>
            Agregar nuevo documento
        </x-slot>
        <x-slot name='content'>
            <div class="mb-4">
                <x-jet-label value="Titulo del documento" for='titulo'/>
                <x-jet-input type='text' name="titulo" class="w-full" wire:model='titulo' />
                <x-jet-input-error for='titulo' class="mt-2" />
            </div>
            <div class="mb-4">
                <x-jet-label value="Autor" for="autor"/>
                <x-jet-input type='text' name="autor" class="w-full" wire:model='autor'/>
                <x-jet-input-error for='autor' class="mt-2" />
            </div>
            <div class="mb-4">
                <x-jet-label value="Año" for="anio" />
                <x-jet-input type='number' name="anio" class="w-full" wire:model='anio' />
                <x-jet-input-error for='anio' class="mt-2" />
            </div>
            <div class="mb-4">
                <x-jet-label value="Idioma" for="idioma" />
                <x-jet-input type='text' name="idioma" class="w-full" wire:model='idioma' />
                <x-jet-input-error for='idioma' class="mt-2" />
            </div>
            <div class="mb-4">
                <x-jet-label value="Documento en formato pdf" for="url" />
                <x-jet-input type='file' name="url" class="w-full" wire:model='url' />
                <div wire:loading wire:target="url" class="mt-2">Cargando...</div>
                <x-jet-input-error for='url' class="mt-2" />
            </div>
            <div class="mb-4">
                <x-jet-label value="Categoria" for="id_categoria" />
                <select name="id_categoria" class="w-full" wire:model='id_categoria'>
                    @if (!is_null($categorias))
                        <option value="null" >Seleccione uno</option>
                    @foreach ($categorias as $item)
                        <option value="{{$item->id}}">{{$item->tipo}}</option>
                    @endforeach
                    @else
                        <option>No hay nada</option>
                    @endif
                    
                </select>
            </div>
            <div class="mb-4">
                <x-jet-label value="Departamento" for="id_departamento" />
                <select  class="w-full" wire:model='id_departamento'>
                    @if (!is_null($departamentos))
                        <option value="null">Seleccione uno</option>
                    @foreach ($departamentos as $depa)
                        <option value="{{$depa->id}}" name="id_departamento">{{$depa->nombre}}</option>
                    @endforeach
                    @else
                        <option>No hay nada</option>
                    @endif
                    
                </select>
            </div>
        </x-slot>
        <x-slot name='footer'>
            <x-jet-secondary-button wire:click="cerrarModal()">
                Cancelar
            </x-jet-secondary-button>
            <x-jet-button class="ml-3" wire:click.prevent="guardar()">
                Agregar
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
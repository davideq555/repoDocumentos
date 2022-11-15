<div id="modal">
    {{-- Metodo directo para cambiar estado de una variable con set --}}
    <x-jet-dialog-modal wire:model="modal">
        <x-slot name='title'>
            Agregar nuevo documento
        </x-slot>
        <x-slot name='content'>
            <div class="mb-4">
                <x-jet-label value="Titulo del documento" />
                <x-jet-input type='text' class="w-full" />
            </div>
            <div class="mb-4">
                <x-jet-label value="Autor" />
                <x-jet-input type='text' class="w-full" />
            </div>
            <div class="mb-4">
                <x-jet-label value="Anio" />
                <x-jet-input type='number' class="w-full" />
            </div>
            <div class="mb-4">
                <x-jet-label value="Idioma" />
                <x-jet-input type='text' class="w-full" />
            </div>
            <div class="mb-4">
                <x-jet-label value="Titulo del documento" />
                <x-jet-input type='text' class="w-full" />
            </div>
            <div class="mb-4">
                <x-jet-label value="Titulo del documento" />
                <x-jet-input type='text' class="w-full" />
            </div>
        </x-slot>
        <x-slot name='footer'>
            <x-jet-secondary-button wire:click="cerrarModal()">
                Cancelar
            </x-jet-secondary-button>
            <x-jet-button class="ml-3" wire:click="">
                Agregar
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
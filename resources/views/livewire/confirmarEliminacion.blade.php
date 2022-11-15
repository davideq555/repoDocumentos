<div id="modal_confirmar">
    {{-- Metodo directo para cambiar estado de una variable con set --}}
    <x-jet-dialog-modal wire:model="modal_confirmar">
        <x-slot name='title'>
            Eliminacion
        </x-slot>
        <x-slot name='content'>
            ¿Estas seguro de eliminar elemento?
        </x-slot>
        <x-slot name='footer'>
            <x-jet-secondary-button wire:click="cerrarModalConfirm()">
                Cancelar
            </x-jet-secondary-button>
            <x-jet-danger-button class="ml-3" wire:click="borrar({{$modal_confirmar}})">
                Confirmar
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
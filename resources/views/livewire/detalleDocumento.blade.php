
    <x-jet-dialog-modal wire:model="modal_detalle">
        <x-slot name='title'>
            Detalles del documento
            <button class="cursor-pointer absolute top-0 right-0 mt-4 mr-5 text-gray-400 hover:text-gray-600 transition duration-150 ease-in-out rounded focus:ring-2 focus:outline-none focus:ring-gray-600" wire:click="cerrarModalDetalle()" aria-label="close modal" role="button">
                <svg  xmlns="http://www.w3.org/2000/svg"  class="icon icon-tabler icon-tabler-x" width="20" height="20" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" />
                    <line x1="18" y1="6" x2="6" y2="18" />
                    <line x1="6" y1="6" x2="18" y2="18" />
                </svg>
            </button>
        </x-slot>
        <x-slot name='content'>
            <div class="mb-4">
                Titulo del documento: <strong>{{$this->titulo}}</strong>
            </div>
            <div class="mb-4">
                Resumen: <strong>{{$this->resumen}}</strong>
            </div>
            <div class="mb-4">
                Autor: <strong>{{$this->autor}}</strong> Fecha de publicacion: {{$this->fecha}}
            </div>           
            <div class="mb-4">
                <x-jet-label value="Idioma del documento"  />
                {{$this->idioma}}
            </div>
            <div class="mb-4">
                Categoria y departamento del documento: <strong>{{$this->categoria->tipo}}/{{$this->departamento->nombre}}</strong>          
            </div>
            <div class="mb-4">
                Subido por: <strong>{{$this->user->name}}</strong> Idioma: <strong>{{$this->idioma}}</strong>
            </div>
            <div class="mb-4">
                Publico: <input type="checkbox" checked={{$this->publico}} disabled> 
            </div>
            <div class="mb-4">
                <embed src='{{Storage::url($this->url)}}' type="application/pdf" width="100%" height="600px" id="{{$identificador}}"/>
            </div>
            <div class="mb-4">
                <a href='{{Storage::url($this->url)}}' target="_blank" rel="noopener noreferrer" id="{{$identificador}}">Ampliar</a>
            </div>
        </x-slot>
        <x-slot name='footer'>
            <x-jet-secondary-button wire:click='cerrarModalDetalle()'>
                Cerrar
            </x-jet-secondary-button>
        </x-slot>
    </x-jet-dialog-modal>

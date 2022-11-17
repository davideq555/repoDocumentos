
    <x-jet-dialog-modal wire:model="modal_detalle">
        <x-slot name='title'>
            Detalles del documento
        </x-slot>
        <x-slot name='content'>
            <div class="mb-4">
                Titulo del documento: <strong>{{$this->titulo}}</strong>
            </div>
            <div class="mb-4">
                Resumen: <strong>{{$this->resumen}}</strong>
            </div>
            <div class="mb-4">
                Autor: <strong>{{$this->autor}}</strong> Fecha de publicacion: {{$this->anio}}
            </div>           
            <div class="mb-4">
                <x-jet-label value="Idioma del documento"  />
                {{$this->idioma}}
            </div>
            <div class="mb-4">
                Categoria y departamento del documento: <strong>{{$this->categoria->tipo}}/{{$this->departamento->nombre}}</strong>          
            </div>
            <div class="mb-4">
                Subido por: <strong></strong> Idioma: <strong>{{$this->idioma}}</strong>
                {{--$this->user->name--}}
            </div>
            <div class="mb-4">
                Publico: <input type="checkbox" checked={{$this->publico}} disabled> </input>
            <div class="mb-4">
                <embed src='{{$this->pdf_url}}' type="application/pdf" width="100%" height="600px" />
            </div>
            <div class="mb-4">
                <a href='{{$this->pdf_url}}' target="_blank" rel="noopener noreferrer">Ampliar</a>
            </div>
        </x-slot>
        <x-slot name='footer'>
            <x-jet-secondary-button wire:click='cerrarModalDetalle()'>
                Cerrar
            </x-jet-secondary-button>
        </x-slot>
    </x-jet-dialog-modal>

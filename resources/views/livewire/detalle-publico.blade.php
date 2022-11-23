<div class="py-12 bg-gray-200 bg-opacity-50 transition duration-150 ease-in-out z-10 absolute top-0 right-0 bottom-0 left-0" id="modal">
    <div role="alert" class="container mx-auto w-11/12 md:w-2/3 max-w-lg">
        <div class="relative py-8 px-5 md:px-10 bg-white dark:bg-slate-600 shadow-md rounded border border-gray-400 dark:border-gray-900">

            <h1 class="text-gray-800 dark:text-white font-xl font-bold tracking-normal leading-tight mb-4">
                Detalles del documento
            </h1>
            <h2 class="text-gray-800 dark:text-white font-lg tracking-normal leading-tight mb-4">
                Titulo: {{$docu->titulo}}
            </h2>
            <h2 class="text-gray-800 dark:text-white font-lg tracking-normal leading-tight mb-4">
                Resumen: {{$docu->resumen}}
            </h2>
            <h2 class="text-gray-800 dark:text-white font-lg tracking-normal leading-tight mb-4">
                Autor: {{$docu->autor}}
            </h2>
            <h2 class="text-gray-800 dark:text-white font-lg tracking-normal leading-tight mb-4">
                Fecha de publicacion {{$docu->fecha}}
            </h2>
            <h2 class="text-gray-800 dark:text-white font-lg tracking-normal leading-tight mb-4">
                Subido por: {{$docu->user->name}}
            </h2>
            <h2 class="text-gray-800 dark:text-white font-lg tracking-normal leading-tight mb-4">
                Idioma {{$docu->idioma}}
            </h2>
            <h2 class="text-gray-800 dark:text-white font-lg tracking-normal leading-tight mb-4">
                Departamento {{$docu->departamento->nombre}}
            </h2>
            <h2 class="text-gray-800 dark:text-white font-lg tracking-normal leading-tight mb-4">
                Categoria: {{$docu->categoria->tipo}}
            </h2>
            <h2 class="text-gray-800 dark:text-white font-lg tracking-normal leading-tight mb-4">
                Vista preliminar:
            </h2>
            <embed src='{{Storage::url($docu->url)}}' type="application/pdf" width="100%" height="600px" class="mb-4" id="{{$identificador}}"/>
            <div class="flex items-center justify-start w-full">
                <x-jet-secondary-button class="px-2 dark:bg-neutral-800 dark:text-white"
                    wire:click="$set('open',false)">
                        Cerrar
                </x-jet-secondary-button>
            </div>
            <button class="cursor-pointer absolute top-0 right-0 mt-4 mr-5 text-gray-400 hover:text-gray-600 transition duration-150 ease-in-out rounded focus:ring-2 focus:outline-none focus:ring-gray-600" wire:click="$set('open',false)" aria-label="close modal" role="button">
                <svg  xmlns="http://www.w3.org/2000/svg"  class="icon icon-tabler icon-tabler-x" width="20" height="20" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" />
                    <line x1="18" y1="6" x2="6" y2="18" />
                    <line x1="6" y1="6" x2="18" y2="18" />
                </svg>
            </button>
        </div>
    </div>
</div>

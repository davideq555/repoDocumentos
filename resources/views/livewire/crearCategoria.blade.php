<!-- component -->
<!-- Code block starts -->
<div class="py-12  transition duration-150 ease-in-out z-10 absolute top-0 right-0 bottom-0 left-0" id="modal">
    <div role="alert" class="container mx-auto w-11/12 md:w-2/3 max-w-lg">
        <div class="relative py-8 px-5 md:px-10 bg-white shadow-md rounded border border-gray-400">

            <div class="w-full flex justify-start text-gray-600 mb-3">
                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAABmJLR0QA/wD/AP+gvaeTAAAAvUlEQVRoge3YQQ6CMBSE4R/CJYC7eQzB84mHYqULwJCmoXVhmOp8yUtYsHhDW5o8MDMzs6gH8BSvKRWiF2gyt7p943UQ5JJKKiTaaw/cgJnzv3RuzcDIbmVKOBOpmqr1oXjhGSmWg6hxEDXNB+9WX+viWNZf9WdWxPeIGgdR4yBqfI+o8T2ixkHUOIiammUcVLr3CLUDBsob0F0JRqebUaDB3BpiATatQIO51R4FgWW/nd1kqu6pEGZmZn/pBQ4DZEv+U6CwAAAAAElFTkSuQmCC">
            </div>
            <h1 class="text-gray-800 font-lg font-bold tracking-normal leading-tight mb-4">Añadir una nueva categoria</h1>
            <label for="tipo" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Tipo</label>
            <input id="tipo" 
                type="text"
                class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border" 
                placeholder="Documento" 
                wire:model="tipo"/>
            <div class="flex items-center justify-start w-full">
                <x-jet-button 
                    wire:click.prevent="guardar()">
                        Guardar
                </x-jet-button>
                <x-jet-secondary-button class="px-2"
                    wire:click="cerrarModal()">
                        Cancelar
                </x-jet-secondary-button>
            </div>
            <button class="cursor-pointer absolute top-0 right-0 mt-4 mr-5 text-gray-400 hover:text-gray-600 transition duration-150 ease-in-out rounded focus:ring-2 focus:outline-none focus:ring-gray-600" wire:click="cerrarModal()" aria-label="close modal" role="button">
                <svg  xmlns="http://www.w3.org/2000/svg"  class="icon icon-tabler icon-tabler-x" width="20" height="20" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" />
                    <line x1="18" y1="6" x2="6" y2="18" />
                    <line x1="6" y1="6" x2="18" y2="18" />
                </svg>
            </button>
        </div>
    </div>
</div>

<!-- Code block ends -->
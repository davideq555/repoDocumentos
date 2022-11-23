<div id="modal" class="py-12  transition duration-150 ease-in-out z-10 absolute top-0 right-0 bottom-0 left-0" >
    <div role="alert" class="container mx-auto w-11/12 md:w-2/3 max-w-lg">
        <div class="relative py-8 px-5 md:px-10 bg-white shadow-md rounded border border-gray-400">

            <div class="w-full flex justify-start text-gray-600 mb-3">
                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAABmJLR0QA/wD/AP+gvaeTAAABb0lEQVRoge2ZPUoDURRGT6KIgQhaaKGVnZ2ljVtwC9bpXIKW2igBV+AW1B0IlnaChZUWI0QLi4BojMXcQPIyL/PjZN6N3gNfk7x5+U5xLwkB4/+wCLSAB0lLXpsZloAD4BnoO3kBjoCVYO0ysEZc8o1xATfvQBvYCNLUwyZxqS7pAm4+gAtgq/LWQ2xLiU/yC7jpAZfATpUCu/Kh3yUIJOUG2JtW+bpcfjul8km5A/aBuTIEFuSy+woF3DwSb8FCq7spDz8FFHATEW/F5SwCq3L4VUFxXware90ncUixFRoqXekMQG1I5IuSBqtCesA8jIr0w3T5NbX0I4YeTgg/zL4c5xFpAtcKSru5km5jZBmUpCWQ9FyWc2XeNUJ90puzhIlow0S0YSLaMBFtmIg2TEQbJmIYxWgA50CH8D9vB+lIp0YekTMFxX05zSMSKSjsS5RHxNCAxgEvNPiaBzzX4Gse8NTB/zN/K9h3LcOYzA9CLFQRgQpHYQAAAABJRU5ErkJggg==">
            </div>
            <h1 class="text-gray-800 font-lg font-bold tracking-normal leading-tight mb-4">Añadir un nuevo departamento</h1>
            <label for="name" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Nombre</label>
            <input id="name" 
                type="text"
                class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border" 
                wire:model="name"/>
            <label for="email" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Email</label>
            <input id="email" 
                type="email"
                class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border" 
                wire:model="email" disabled/>
            <label for="rol" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Rol</label>
            <select name="rol" class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mb-4"
                wire:model.prevent='rol' required>
                    <option value="" disabled="disabled">Seleccione uno</option>
                @foreach ($roles as $item)
                    @if ($item->name==$rol)
                        <option value="{{$item->name}}" selected>{{$item->name}}</option>
                    @else
                        <option value="{{$item->name}}">{{$item->name}}</option>
                    @endif
                @endforeach                    
            </select>
            <div class="flex items-center justify-start w-full">
                <x-jet-button 
                    wire:click.prevent="guardar()">
                        Guardar
                </x-jet-button>
                <x-jet-secondary-button class="ml-3"
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
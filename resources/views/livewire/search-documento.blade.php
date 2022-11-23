<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 justify-center">
            <div class="flex items-center justify-end text-slate-500">
                <x-jet-input type='search' name="titulo" class="w-1/2 dark:bg-slate-800 dark:text-white" wire:model="search" 
                placeholder="Buscar documento por titulo, resumen o autor..."/>
            </div>
            @if($open)
                @include('livewire.detalle-publico')
            @endif
            @foreach ($documentos as $item)
            <div class="rounded-xl p-5 shadow-md bg-white dark:bg-gray-800 my-4">
                <div class="flex w-full items-center justify-between border-b pb-3">
                    <div class="flex items-center space-x-3">
                        <div class="text-xl font-bold dark:text-white">{{$item->titulo}}</div>
                    </div>
                            <div class="flex items-center space-x-3">
                            <button class="rounded-2xl border bg-neutral-100 px-3 py-1 text-xs font-semibold">{{$item->departamento->nombre}}</button>
                            <button class="rounded-2xl border bg-neutral-100 px-3 py-1 text-xs font-semibold">{{$item->categoria->tipo}}</button>
                            {{-- <div class="text-xs text-neutral-500">2 hours ago</div> --}}
                            </div>
                        </div>
                        
                        <div class="mt-4 mb-6">
                            <div class="mb-3 text-lg font-bold text-slate-700 dark:text-slate-400">{{$item->autor}}</div>
                            <div class="text-sm text-neutral-600 dark:text-neutral-200">{{$item->resumen}}</div>
                        </div>
                        
                        <div>
                            <div class="flex items-center justify-end text-slate-500">
                                <div class="flex space-x-4 md:space-x-8" wire:click="detalles({{$item}})">
                                    <div class="flex cursor-pointer items-center transition hover:text-slate-600" >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500 cursor-pointer" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                </div>
                                <div class="flex cursor-pointer items-center transition hover:text-slate-600">
                                    <a href="{{Storage::url($item->url)}}" target="_blank" rel="noopener noreferrer">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-blue-500">
                                            <path d="M10.75 2.75a.75.75 0 00-1.5 0v8.614L6.295 8.235a.75.75 0 10-1.09 1.03l4.25 4.5a.75.75 0 001.09 0l4.25-4.5a.75.75 0 00-1.09-1.03l-2.955 3.129V2.75z" />
                                            <path d="M3.5 12.75a.75.75 0 00-1.5 0v2.5A2.75 2.75 0 004.75 18h10.5A2.75 2.75 0 0018 15.25v-2.5a.75.75 0 00-1.5 0v2.5c0 .69-.56 1.25-1.25 1.25H4.75c-.69 0-1.25-.56-1.25-1.25v-2.5z" />
                                        </svg>    
                                    </a>                      
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="m-4">
                {{ $documentos->links() }}
            </div>
           </div>
    </div>
</div>
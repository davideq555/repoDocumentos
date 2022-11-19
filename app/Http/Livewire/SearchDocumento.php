<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SearchDocumento extends Component
{
    public $search;
    protected $queryString = ['search'];

    public function render()
    {
        return view('livewire.search-documento',[
            'documentos' => Documento::where('titulo', 'like', '%'.$this->search.'%')
                ->orWhere('resumen','LIKE', "%$search%")
                ->orWhere('autor','LIKE', "%$search%")->get(),
        ]);
    }
}

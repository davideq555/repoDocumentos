<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Documento;
use Livewire\WithPagination;


class SearchDocumento extends Component
{
    use WithPagination; 

    public $foo;
    public $search = '';
    public $page = 1;

    protected $queryString = [
        'foo',
        'search' => ['except' => '', 'as' => 's'],
        'page' => ['except' => 1],
    ];

    public function render()
    {
        return view('livewire.search-documento', [
            'documentos' => Documento::when(
                $this->search, function( $query, $search){
                    return $query->where('titulo','LIKE', "%$search%")
                        ->orWhere('resumen','LIKE', "%$search%")
                        ->orWhere('autor','LIKE', "%$search%");
                }
            )->paginate(2),])->layout('layouts.app-public');
    }

    public function colorCategoria(){

    }
}

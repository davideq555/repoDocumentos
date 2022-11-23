<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Documento;
use Livewire\WithPagination;


class SearchDocumento extends Component
{
    use WithPagination; 

    public $search = '';
    public $page = 1;
    public $open = false;
    public $docu, $identificador;

    public function mount(){
        $this->identificador = rand();
        $this->docu = new Documento();
    }

    protected $queryString = [
        'search' => ['except' => '', 'as' => 's'],
        'page' => ['except' => 1, 'as' => 'p'],
    ];

    public function updatingSearch(){
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.search-documento', [
            'documentos' => Documento::when(
                $this->search, function( $query, $search){
                    return $query->where('titulo','LIKE', "%$search%")
                        ->orWhere('resumen','LIKE', "%$search%")
                        ->orWhere('autor','LIKE', "%$search%");
                }
            )->paginate(10),])->layout('layouts.app-public');
    }

    public function descarga(Documento $item){
        return Storage::disk('public')->download($item->url);
    }

    public function detalles(Documento $item){
        $this->docu = $item;
        $this->identificador = rand();
        $this->open = true;
    }
}

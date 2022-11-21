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
}

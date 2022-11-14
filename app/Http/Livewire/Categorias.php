<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Categoria;

class Categorias extends Component
{
    public $categorias,$tipo,$id_categoria;
    public $modal = false;

    public function render()
    {
        $this->categorias = Categoria::all();
        return view('livewire.categorias');
    }

    public function crear(){
        $this->limpiarCampos();
        $this->abrirModal();
    }

    public function abrirModal(){
        $this->modal= true;
    }
    public function cerrarModal(){
        $this->modal= false;
    }

    public function limpiarCampos(){
        $this->tipo = '';
    }
    public function guardar()
    {
        Categoria::updateOrCreate(['id'=>$this->id_categoria],
            [
                'tipo' => $this->tipo,
            ]);
         
         session()->flash('message',
            $this->id_categoria ? '¡Actualización exitosa!' : '¡Alta Exitosa!');
         
         $this->cerrarModal();
         $this->limpiarCampos();
    }
    public function editar($id){
        $cate = Categoria::findOrFail($id);
        $this->id_categoria = $id;
        $this->tipo = $cate->tipo;
        $this->abrirModal();
    }
    public function borrar($id){
        Categoria::find($id)->delete();
        session()->flash('message', 'Categoria eliminada correctamente');

    }
}

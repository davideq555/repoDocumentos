<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Documento;

class Documentos extends Component
{
    //añadir todas los campos de los documenntos + variable q contenga todos
    public $documentos, $titulo, $autor, $anio, $idioma, $publico, $departamento,
    $categoria, $usuario, $id_documento;
    //Pantalla emergente para crear, editar y confirmar eliminacion
    public $modal = false;
    public $modal_confirmar = false;
 
    public function render()
    {
        $this->documentos = Documento::all();
        return view('livewire.documentos');
    }

    public function crear(){
        $this->limpiarCampos();
        $this->abrirModal();
    }
    public function eliminar($id){
        $this->modal_confirmar = $id;        
    }

    public function abrirModal(){
        $this->modal= true;
    }
    public function cerrarModal(){
        $this->modal= false;
    }

    public function abrirModalConfirm(){
        $this->modal_confirmar= true;
    }
    public function cerrarModalConfirm(){
        $this->modal_confirmar= false;
    }

    public function limpiarCampos(){
        $this->titulo = '';
        $this->autor = '';
        $this->anio = '';
        $this->idioma = '';
        $this->departamento = null;
        $this->categoria = null;
        $this->usuario = null;
    }
    public function guardar()
    {
        Departamento::updateOrCreate(['id'=>$this->id_documento],
            [
                'titulo' => $this->titulo,
                'autor' => $this->titulo,
                'anio' => $this->anio,
                'idioma' => $this->idioma,
                'departamento' => $this->titulo,
                'categoria' => $this->titulo,
                'publico' => TRUE,
            ]);
         
         session()->flash('message',
            $this->id_documento ? '¡Actualización exitosa!' : '¡Alta Exitosa!');
         //pregunto si existe documento para editar, sino fue una alta
         $this->cerrarModal();
         $this->limpiarCampos();
    }
    public function editar($id){
        $depa = Documento::findOrFail($id);
        $this->id_documento = $id;
        $this->titulo = $depa->titulo;
        $this->autor = $depa->autor;
        $this->anio = $depa->anio;
        $this->idioma = $depa->idioma;
        $this->departamento = $depa->departamento;
        $this->categoria = $depa->categoria;
        $this->abrirModal();
    }
    public function borrar(Documento $item){
        $item->delete();
        session()->flash('message', 'Documento eliminado correctamente');
        $this->cerrarModalConfirm();
    }

}

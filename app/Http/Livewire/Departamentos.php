<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Departamento;

class Departamentos extends Component
{
    public $departamentos,$nombre,$id_departamento;
    //Pantalla emergente para crear, editar y confirmar eliminacion
    public $modal = false;
    public $modal_confirmar = false;

    public function render()
    {
        $this->departamentos = Departamento::all();
        return view('livewire.departamentos');
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
        $this->nombre = '';
    }
    public function guardar()
    {
        Departamento::updateOrCreate(['id'=>$this->id_departamento],
            [
                'nombre' => $this->nombre,
            ]);
         
         session()->flash('message',
            $this->id_departamento ? '¡Actualización exitosa!' : '¡Alta Exitosa!');
         
         $this->cerrarModal();
         $this->limpiarCampos();
    }
    public function editar($id){
        $depa = Departamento::findOrFail($id);
        $this->id_departamento = $id;
        $this->nombre = $depa->nombre;
        $this->abrirModal();
    }
    public function borrar(Departamento $item){
        //Departamento::find($id)->delete();
        $item->delete();
        session()->flash('message', 'Departamento eliminado correctamente');
        $this->cerrarModalConfirm();
    }

}

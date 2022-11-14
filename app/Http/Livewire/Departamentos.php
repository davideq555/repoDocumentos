<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Departamento;

class Departamentos extends Component
{
    public $departamentos,$nombre,$id_departamento;
    //Pantalla emergente para crear y editar
    public $modal = false;

    public function render()
    {
        $this->departamentos = Departamento::all();
        return view('livewire.departamentos');
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
    public function borrar($id){
        Departamento::find($id)->delete();
        session()->flash('message', 'Departamento eliminada correctamente');
    }

}

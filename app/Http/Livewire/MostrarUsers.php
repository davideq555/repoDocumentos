<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Spatie\Permission\Models\Role;

class MostrarUsers extends Component
{

    public $name, $email, $rol, $roles;

    public $modal, $modal_confirmar = false;

    public function render()
    {
        return view('livewire.mostrar-users', [
            'users' => User::all(),
        ]);
    }
    public function crear(){
        $this->limpiarCampos();
        $this->abrirModal();
    }
    public function eliminar(User $id){
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
        $this->name = '';
        $this->email = '';
    }
    public function guardar()
    {
        $user = User::updateOrCreate(['email'=>$this->email],
            [
                'name' => $this->name,
                'email' => $this->email,
                'password' => bcrypt('pass1234'),
            ]);
        $user->syncRoles($this->rol);
         
         session()->flash('message',
            $this->id ? '¡Actualización exitosa!' : '¡Alta Exitosa!');
         
         $this->cerrarModal();
         $this->limpiarCampos();
    }
    public function editar($id){
        $user = User::findOrFail($id);
        $this->roles = Role::all();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->rol = $user->getRoleNames()[0];
        $this->abrirModal();
    }
    public function borrar(User $item){
        //Departamento::find($id)->delete();
        $item->delete();
        session()->flash('message', 'Usuario eliminado correctamente');
        $this->cerrarModalConfirm();
    }
}

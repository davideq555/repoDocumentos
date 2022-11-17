<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;

use Livewire\Component;
use App\Models\Documento;
use App\Models\Categoria;
use App\Models\Departamento;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

class Documentos extends Component
{
    use WithFileUploads;
    use WithPagination;

    //añadir todas los campos de los documenntos + variable q contenga todos
    public $documentos, $titulo, $autor, $anio, $idioma, $publico, $id_departamento,
    $id_categoria, $id_documento;
    //Variable para guardar pdf
    public $url;
    //variables para traer todas las categorias y departamentos
    public $categorias,$departamentos;
    //Pantalla emergente para crear, editar, ver mas detalles y confirmar eliminacion
    public $modal = false;
    public $modal_confirmar = false;
    public $detalles = false;

    //Validacion de campos (ver documentacion de liveware)
    protected $rules = [
        'titulo' => 'required|min:6|max:100',
        'autor' => 'required|max:40',
        'anio' => 'numeric|max:4',
        'idioma' => 'required|max:2',
        'url' => 'required|file|max:150000|mimes:pdf'
    ];

    //Mensaje de campos relacionado a las reglas (ver documentacion de liveware)
    protected $messages = [
        'titulo' => 'El titulo es requerido con un minimo de 6 a 100 caracteres',
        'autor' => 'Autor es requerido con un maximo de 40 caracteres',
        'anio' => 'Requerido y solo se acepta numeros',
        'idioma' => 'Solo se acepta 2 caracteres',
        'url' => 'Seleccione un archivo pdf',
    ];

 
    public function render()
    {
        $this->documentos = Documento::all();
        $this->categorias = Categoria::all();
        $this->departamentos = Departamento::all();
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
        $this->id_departamento = null;
        $this->id_categoria = null;
    }
    public function guardar()
    {
        //primero valida y luego crea o actualiza
        $this->validate();
        //Hay q verificar que no exista una url igual, si existe, concatenar la cadena con -copia
        // Manually specify a filename...
        // $path = Storage::putFileAs('photos', new File('/path/to/photo'), 'photo.jpg');
        $path = $this->url->storeAs('pdfs', str_replace(' ','-',$this->titulo), 'public');
        Documento::updateOrCreate(['id'=>$this->id_documento],
            [
                'titulo' => $this->titulo,
                'resumen' => 'Default',
                'url' => $path,
                'autor' => $this->autor,
                'anio' => $this->anio,
                'idioma' => $this->idioma,
                'departamento_id' => $this->id_departamento,
                'categoria_id' => $this->id_categoria,
                'user_id' => auth()->id(),
                'formato' => 'pdf',
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

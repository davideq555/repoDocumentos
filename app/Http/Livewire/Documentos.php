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
    public  $titulo, $autor, $anio, $idioma, $publico, $user, $pdf_url, $id_departamento,
    $id_categoria, $id_documento, $resumen;
    //Variable para guardar pdf
    public $url;
    //variables para traer todas las categorias y departamentos
    public $categorias,$departamentos;
    //Pantalla emergente para crear, editar, ver mas detalles y confirmar eliminacion
    public $modal = false;
    public $modal_confirmar = false;
    public $modal_detalle = false;
    //variable para busqueda
    public $search;

    //Validacion de campos (ver documentacion de liveware)
    protected $rules = [
        'titulo' => 'required|min:4|max:100',
        'resumen' => 'required|min:6|max:150',
        'autor' => 'required|max:40',
        'anio' => 'numeric|max:4',
        'idioma' => 'required|max:2',
        'url' => 'required|file|max:150000|mimes:pdf'
    ];

    //Mensaje de campos relacionado a las reglas (ver documentacion de liveware)
    protected $messages = [
        'titulo' => 'El titulo es requerido con un minimo de 4 a 100 caracteres',
        'resumen' => 'El resumen es requerido con un minimo de 6 a 150 caracteres',
        'autor' => 'Autor es requerido con un maximo de 40 caracteres',
        'anio' => 'Requerido y solo se acepta numeros',
        'idioma' => 'Solo se acepta 2 caracteres',
        'url' => 'Seleccione un archivo pdf',
    ];

 
    public function render()
    {
        //$this->documentos = Documento::all();
        return view('livewire.documentos', [
            'documentos' => Documento::when(
                $this->search, function( $query, $search){
                    return $query->where('titulo','LIKE', "%$search%")
                        ->orWhere('resumen','LIKE', "%$search%")
                        ->orWhere('autor','LIKE', "%$search%");
                }
            )->paginate(10),]);
    }

    public function crear(){
        $this->categorias = Categoria::all();
        $this->departamentos = Departamento::all();
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

    public function abrirModalDetalle(){
        $this->modal_detalle= true;
    }
    public function cerrarModalDetalle(){
        $this->modal_detalle= false;
        $this->limpiarCampos();
    }
    public function limpiarCampos(){
        $this->titulo = '';
        $this->autor = '';
        $this->anio = '';
        $this->idioma = '';
        $this->id_departamento = '';
        $this->id_categoria = '';
        $this->url = '';
        $this->user = '';
        $this->publico = '';
        $this->resumen = '';
        $this->pdf_url = '';
        $this->departamento= '';
        $this->categoria= '';
    }
    public function guardar()
    {
        //primero valida y luego crea o actualiza
        $this->validate();
        //Hay q verificar que no exista una url igual, si existe, concatenar la cadena con -copia
        // Manually specify a filename...
        // $path = Storage::putFileAs('photos', new File('/path/to/photo'), 'photo.jpg');
        $path = $this->url->store('pdfs','public');
        Documento::updateOrCreate(['id'=>$this->id_documento],
            [
                'titulo' => $this->titulo,
                'resumen' => $this->resumen,
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
    //Arreglar editar
    public function editar($id){
        $depa = Documento::findOrFail($id);
        $this->categorias = Categoria::all();
        $this->departamentos = Departamento::all();
        $this->id_documento = $id;
        $this->titulo = $depa->titulo;
        $this->autor = $depa->autor;
        $this->anio = $depa->anio;
        $this->idioma = $depa->idioma;
        $this->departamento = $depa->departamento;
        $this->categoria = $depa->categoria;
        $this->resumen = $depa->resumen;
        $this->url = $depa->url;
        //Para q se visualice bien los select
        //revisar la url de la imagen
        $this->id_departamento = $depa->departamento->id;
        $this->id_categoria = $depa->categoria->id;
        $this->abrirModal();
    }
    public function detalles($id){
        $depa = Documento::find($id);
        $this->id_documento = $id;
        $this->titulo = $depa->titulo;
        $this->autor = $depa->autor;
        $this->anio = $depa->anio;
        $this->idioma = $depa->idioma;
        $this->departamento = $depa->departamento;
        $this->categoria = $depa->categoria;
        $this->user = $depa->user;
        $this->url = $depa->pdf_url;
        $this->publico = $depa->publico;
        $this->resumen = $depa->resumen;

        $this->abrirModalDetalle();
    }
    public function borrar(Documento $item){
        $item->delete();
        session()->flash('message', 'Documento eliminado correctamente');
        $this->cerrarModalConfirm();
    }


}

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
    public  $titulo, $autor, $fecha, $publico, $user, $id_departamento,
    $id_categoria, $id_documento, $resumen;
    //Variable para guardar pdf
    public $url, $identificador;
    //variables para traer todas las categorias y departamentos
    public $categorias,$departamentos;
    //Pantalla emergente para crear, editar, ver mas detalles y confirmar eliminacion
    public $modal = false;
    public $modal_confirmar = false;
    public $modal_detalle = false;
    //variable para busqueda
    public $search;
    //Variables para ordenar
    public $sort = 'id';
    public $direction = 'desc';

    //Validacion de campos (ver documentacion de liveware)
    protected $rules = [
        'titulo' => 'required|min:4|max:100',
        'resumen' => 'required|min:6|max:150',
        'autor' => 'required|max:40',
        'fecha' => 'required',
        'url' => 'required|file|max:150000|mimes:pdf'
    ];

    //Mensaje de campos relacionado a las reglas (ver documentacion de liveware)
    protected $messages = [
        'titulo' => 'El titulo es requerido con un minimo de 4 a 100 caracteres',
        'resumen' => 'El resumen es requerido con un minimo de 6 a 150 caracteres',
        'autor' => 'Autor es requerido con un maximo de 40 caracteres',
        'fecha' => 'Requerido, fecha de publicacion',
        'url' => 'Seleccione un archivo pdf',
    ];

    public function mount(){
        $this->identificador = rand();

    }

    public function updatingSearch(){
        $this->resetPage();
    }
 
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
            )->orderBy($this->sort,$this->direction)->paginate(10),]);
    }

    public function order($sort){
        if($this->sort==$sort){
            if ($this->direction == 'desc') {
                $this->direction = 'asc';
            } else {
                $this->direction = 'desc';
            }
            
        } else {
            $this->direction = 'asc';
            $this->sort = $sort;
        }
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
        $this->limpiarCampos();
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
        $this->fecha = '';
        $this->id_departamento = '';
        $this->id_categoria = '';
        $this->url = '';
        $this->user = '';
        $this->publico = '';
        $this->resumen = '';
        $this->pdf_url = '';
        $this->departamento= '';
        $this->categoria= '';
        // tambien hay una funcion reset general por parte de livewire
    }
    public function guardar()
    {
        //primero valida y luego crea o actualiza
        $this->validate();

        // Manually specify a filename...
        // $path = Storage::putFileAs('photos', new File('/path/to/photo'), 'photo.jpg');
        $path = $this->url->store('pdfs');
        //$path = Storage::put($this->url);
        Documento::updateOrCreate(['id'=>$this->id_documento],
            [
                'titulo' => $this->titulo,
                'resumen' => $this->resumen,
                'url' => $path,
                'autor' => $this->autor,
                'fecha' => $this->fecha,
                'idioma' => 'ES',
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
         $this->identificador = rand();
    }
    //Arreglar editar
    public function editar($id){
        $depa = Documento::findOrFail($id);
        $this->categorias = Categoria::all();
        $this->departamentos = Departamento::all();
        $this->id_documento = $id;
        $this->titulo = $depa->titulo;
        $this->autor = $depa->autor;
        $this->fecha = $depa->fecha;
        $this->idioma = $depa->idioma;
        $this->departamento = $depa->departamento;
        $this->categoria = $depa->categoria;
        $this->resumen = $depa->resumen;
        
        $this->url = $depa->url;

        $this->id_departamento = $depa->departamento->id;
        $this->id_categoria = $depa->categoria->id;

        $this->abrirModal();
    }
    public function detalles($id){
        $depa = Documento::find($id);
        $this->id_documento = $id;
        $this->titulo = $depa->titulo;
        $this->autor = $depa->autor;
        $this->fecha = $depa->fecha;
        $this->idioma = $depa->idioma;
        $this->departamento = $depa->departamento;
        $this->categoria = $depa->categoria;
        $this->user = $depa->user;
        $this->url = $depa->url;
        $this->publico = $depa->publico;
        $this->resumen = $depa->resumen;

        $this->abrirModalDetalle();
    }
    public function borrar(Documento $item){
        if($item->url){
            Storage::delete($item->url);
            $item->delete();
            session()->flash('message', 'Documento eliminado correctamente');
            $this->cerrarModalConfirm();
        } else {
            session()->flash('message', 'no se encontro documento con url');
            $this->cerrarModalConfirm();
        }
    }


}

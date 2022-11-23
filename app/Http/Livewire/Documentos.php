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
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DocumentosExport;

class Documentos extends Component
{
    use WithFileUploads;
    use WithPagination;

    //añadir todas los campos de los documenntos + variable q contenga todos
    public  $titulo, $autor, $fecha, $publico, $user, $id_departamento,
    $id_categoria, $id_documento, $resumen, $docu;
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
        'docu.titulo' => 'required|min:4|max:100',
        'docu.resumen' => 'required|min:6|max:150',
        'docu.autor' => 'required|max:40',
        'docu.fecha' => 'required',
        'docu.url' => 'required|file|max:150000|mimes:pdf',
        'docu.categoria_id' => 'required',
        'docu.departamento_id' => 'required'
    ];

    protected $listeners = ['render'];

    //Mensaje de campos relacionado a las reglas (ver documentacion de liveware)
    protected $messages = [
        'docu.titulo' => 'El titulo es requerido con un minimo de 4 a 100 caracteres',
        'docu.resumen' => 'El resumen es requerido con un minimo de 6 a 150 caracteres',
        'docu.autor' => 'Autor es requerido con un maximo de 40 caracteres',
        'docu.fecha' => 'Requerido, fecha de publicacion',
        'docu.url' => 'Seleccione un archivo pdf',
        'docu.categoria_id' => 'Requirido',
        'docu.departamento_id' => 'Requirido',
    ];

    public function mount(){
        $this->identificador = rand();
        $this->docu = new Documento();

    }
// Accion - variaable (en este caso, cuando la variable Search cambie, se resetea la pagina)
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
        $this->departamento= '';
        $this->categoria= '';
        $this->docu= '';
        // tambien hay una funcion reset general por parte de livewire
    }
    //Arreglar editar
    public function editar(Documento $docuAux){
        $this->docu = $docuAux;
        $this->categorias = Categoria::all();
        $this->departamentos = Departamento::all();
        $this->abrirModal();
    }
    
    public function actualizar(){
        //primero valida y luego crea o actualiza
        $this->validate();
        
        // Manually specify a filename...
        // $path = Storage::putFileAs('photos', new File('/path/to/photo'), 'photo.jpg');
        // if (Storage::url($this->url)){
        //     $path = $this->url;
        // } else {
        //     $path = $this->url->store('pdfs');
        // }
        // if($this->url){
        //     Storage::delete([$this->docu->url]);
        //     $this->docu->url = $this->url->store('pdfs');
        // }
        $this->docu->saved();
         
        session()->flash('message','¡Actualización exitosa!');
        $this->cerrarModal();
        $this->limpiarCampos();
        $this->identificador = rand();
    }

    public function detalles($id){
        $docu = Documento::find($id);
        $this->id_documento = $docu->id;
        $this->titulo = $docu->titulo;
        $this->autor = $docu->autor;
        $this->fecha = $docu->fecha;
        $this->idioma = $docu->idioma;
        $this->departamento = $docu->departamento;
        $this->categoria = $docu->categoria;
        $this->user = $docu->user;
        $this->url = $docu->url;
        $this->publico = $docu->publico;
        $this->resumen = $docu->resumen;
        $this->identificador = rand();

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

    public function eliminarArchivo(){
        Storage::delete($this->url);
        $this->url = '';
    }

    public function export() 
    {
        return Excel::download(new DocumentosExport, 'documentosAll.xlsx');
    }

}

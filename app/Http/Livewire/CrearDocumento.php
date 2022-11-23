<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Documento;
use App\Models\Categoria;
use App\Models\Departamento;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class CrearDocumento extends Component
{

    use WithFileUploads;
    //modal
    public $open =false;

    //atributos
    public $titulo, $autor, $fecha, $publico, 
    $user, $resumen, $id_depa, $id_cate;

    public $url;
    //variables para traer todas las categorias y departamentos
    public $categorias,$departamentos;

    public function render()
    {
        $this->categorias = Categoria::all();
        $this->departamentos = Departamento::all();
        return view('livewire.crear-documento');
    }

     //Validacion de campos (ver documentacion de liveware)
     protected $rules = [
        'titulo' => 'required|min:4|max:100',
        'resumen' => 'required|min:6|max:150',
        'autor' => 'required|max:40',
        'fecha' => 'required',
        'url' => 'required|file|max:150000|mimes:pdf',
        'id_depa' => 'required',
        'id_cate' => 'required'
    ];

    //Mensaje de campos relacionado a las reglas (ver documentacion de liveware)
    protected $messages = [
        'titulo' => 'El titulo es requerido con un minimo de 4 a 100 caracteres',
        'resumen' => 'El resumen es requerido con un minimo de 6 a 150 caracteres',
        'autor' => 'Autor es requerido con un maximo de 40 caracteres',
        'fecha' => 'Requerido, fecha de publicacion',
        'url' => 'Seleccione un archivo pdf',
        'id_depa' => 'Seleccione un departamento',
        'id_cate' => 'Seleccione una categoria'
    ];

    public function mount(){
        $this->identificador = rand();

    }

    public function guardar()
    {
        //primero valida y luego crea o actualiza
        $this->validate();

        $path = $this->url->store('pdfs');

        Documento::create([
                'titulo' => $this->titulo,
                'resumen' => $this->resumen,
                'url' => $path,
                'autor' => $this->autor,
                'fecha' => $this->fecha,
                'idioma' => 'ES',
                'departamento_id' => $this->id_depa,
                'categoria_id' => $this->id_cate,
                'user_id' => auth()->id(),
                'formato' => 'pdf',
            ]);
        $this->emit('render');
        //session()->flash('message','¡Alta Exitosa!');
        $this->open = false;
        $this->reset = ['titulo','resumen','url','autor',
        'fecha','idioma','id_depa','id_cate','user_id','formato'];
    }

}

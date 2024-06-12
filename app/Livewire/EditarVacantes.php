<?php

namespace App\Livewire;

use App\Models\Categorias;
use App\Models\Salarios;
use App\Models\Vacante;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class EditarVacantes extends Component
{
    public $vacante_id;
    public $titulo;
    public $salario;
    public $categoria;
    public $empresa;
    public $ultimo_dia;
    public $descripcion;
    public $imagen;
    public $imagen_nueva;

    use WithFileUploads;

    protected $rules = [
        'titulo' => 'required|string',
        'categoria' => 'required',
        'salario' => 'required',
        'empresa' => 'required',
        'ultimo_dia' => 'required',
        'descripcion' => 'required',
        'imagen_nueva' => 'nullable|image|max:1024',
    ];


    public function mount(Vacante $vacante){
        $this->vacante_id = $vacante->id;
        $this->titulo = $vacante->titulo;
        $this->salario = $vacante->salario_id;
        $this->categoria = $vacante->categoria_id;
        $this->empresa = $vacante->empresa;
        $this->ultimo_dia = Carbon::parse($vacante->ultimo_dia)->format('Y-m-d');
        $this->descripcion = $vacante->descripcion;
        $this->imagen= $vacante->imagen;
    }

    public function editarVacante(){
        $datos= $this->validate();
        //si hay una nueva imagen

        if($this->imagen_nueva){
            //Almacenar la imagen
            $imagen=$this->imagen_nueva->store('public/vacantes');
            $datos['imagen']=str_replace('public/vacantes/','',$imagen);
        }
        //Encontrar la vacante a editar
        $vacante = Vacante::find($this->vacante_id);


        //Asignar los valores
        $vacante->titulo = $datos['titulo'];
        $vacante->salario_id = $datos['salario'];
        $vacante->categoria_id = $datos['categoria'];
        $vacante->empresa = $datos['empresa'];
        $vacante->ultimo_dia = $datos['ultimo_dia'];
        $vacante->descripcion = $datos['descripcion'];
        $vacante->imagen = $datos['imagen'] ?? $vacante->imagen;

        //Redireccionar
        $vacante->save();

        session()->flash('mensaje','La Vacante se editó correctamente');
        return redirect()->route('vacantes.index');

    }

    public function render()
    {

        $salarios = Salarios::all();
        $categorias = Categorias::all();
        return view('livewire.editar-vacantes', [
            'salarios' => $salarios,
            'categorias' => $categorias
        ]);
    }
}

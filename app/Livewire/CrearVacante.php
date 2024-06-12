<?php

namespace App\Livewire;

use App\Models\Categorias;
use App\Models\Salario;
use App\Models\Salarios;
use App\Models\Vacante;
use Livewire\Component;
use Livewire\WithFileUploads;

class CrearVacante extends Component
{
    public $titulo;
    public $salario;
    public $categoria;
    public $empresa;
    public $ultimo_dia;
    public $descripcion;
    public $imagen;

    use WithFileUploads;

    protected $rules = [
        'titulo' => 'required|string',
        'categoria' => 'required',
        'salario' => 'required',
        'empresa' => 'required',
        'ultimo_dia' => 'required',
        'descripcion' => 'required',
        'imagen' => 'required|image|max:1024',
    ];


    public function crearVacante()
    {
       $datos= $this->validate();
       //Almacenar la imagen
       $imagen=$this->imagen->store('public/vacantes');
       $nombreImagen=str_replace('public/vacantes/','',$imagen);
        $datos['imagen']=$nombreImagen;
       //Crear el objeto vacante
       $vacante = Vacante::create([
        'titulo'=> $datos['titulo'],
        'salario_id'=> $datos['salario'],
        'categoria_id'=> $datos['categoria'],
        'empresa'=> $datos['empresa'],
        'ultimo_dia'=> $datos['ultimo_dia'],
        'descripcion'=> $datos['descripcion'],
        'imagen'=> $datos['imagen'],
        'user_id'=> auth()->user()->id
       ]);
       //Crear Mnesaje
       session()->flash('mensaje','La Vacante se publicó correctamente');
       //Redireccionar al listado de vacantes
       return redirect()->route('vacantes.index');
    }




    public function render()
    {
        //Consultar base de datos
        $salarios = Salarios::all();
        $categorias = Categorias::all();
        return view('livewire.crear-vacante', [
            'salarios' => $salarios,
            'categorias' => $categorias
        ]);
    }
}

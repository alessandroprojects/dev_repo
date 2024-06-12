<?php

namespace App\Livewire;

use App\Models\Categorias;
use App\Models\Salarios;
use Livewire\Component;

class FiltrarBacantes extends Component
{
    public $termino;
    public $categoria;
    public $salario;


    public function leerDatosFormulario()
    {

        $this->dispatch('terminosBusqueda', $this->termino, $this->categoria, $this->salario);
    }


    public function render()
    {
        $salarios=Salarios::all();
        $categorias=Categorias::all();
        return view('livewire.filtrar-bacantes',[
            'categorias' => $categorias,
            'salarios' => $salarios
        ]);
    }
}
